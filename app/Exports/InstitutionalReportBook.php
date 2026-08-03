<?php

namespace App\Exports;

use App\Models\Announcement;
use App\Models\BranchActivity;
use App\Models\Coordination;
use App\Models\Event;
use App\Models\SubEvent;
use App\Models\Workshop;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Chart\Axis;
use PhpOffice\PhpSpreadsheet\Chart\Chart;
use PhpOffice\PhpSpreadsheet\Chart\DataSeries;
use PhpOffice\PhpSpreadsheet\Chart\DataSeriesValues;
use PhpOffice\PhpSpreadsheet\Chart\Legend;
use PhpOffice\PhpSpreadsheet\Chart\PlotArea;
use PhpOffice\PhpSpreadsheet\Chart\Title;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

/**
 * Libro consolidado de gestión institucional.
 *
 * Reemplaza al reporte de una sola hoja, que solo cubría Actividades Operativas
 * (Event → SubEvent) y se quedó corto frente a los módulos que se sumaron
 * después: talleres/capacitaciones, coordinaciones institucionales, actividades
 * de las sedes desconcentradas y la difusión en redes sociales.
 *
 * Estructura del libro (las hojas se generan según los módulos solicitados):
 *   1. Resumen Ejecutivo   — KPIs transversales y comparativo por módulo.
 *   2. Metas y Avances     — detalle Event/SubEvent con acumulados y gráficos.
 *   3. Talleres y Capacitaciones — ciclo programado ⇄ ejecutado.
 *   4. Coordinaciones      — mesas de trabajo interinstitucionales.
 *   5. Actividades por Sede — intervenciones desconcentradas con subtotales.
 *
 * Todas las consultas se agrupan en PHP (no con DATE_FORMAT ni funciones JSON
 * del motor) para que el libro se genere igual sobre TiDB/MySQL y sobre SQLite.
 */
class InstitutionalReportBook
{
    /** Módulos disponibles, en el orden en que se crean las hojas. */
    public const MODULES = ['metas', 'talleres', 'coordinaciones', 'sedes'];

    private const AZUL_OSCURO = '1F4E78';

    private const AZUL_MEDIO = '4F81BD';

    private const GRIS_SUAVE = 'F2F5F9';

    /**
     * @param  array<int, string>  $modules  Módulos a incluir (subconjunto de MODULES).
     */
    public function __construct(
        private Carbon $start,
        private Carbon $end,
        private string $periodLabel,
        private string $fundingSource = 'all',
        private string $department = 'all',
        private array $modules = self::MODULES,
    ) {
        $this->modules = array_values(array_intersect(self::MODULES, $modules));

        if ($this->modules === []) {
            $this->modules = self::MODULES;
        }
    }

    /** ¿Hay al menos un registro en alguno de los módulos pedidos? */
    public function hasData(): bool
    {
        foreach ($this->modules as $module) {
            $exists = match ($module) {
                'metas' => $this->subEventsQuery()->exists(),
                'talleres' => $this->workshopsQuery()->exists(),
                'coordinaciones' => $this->coordinationsQuery()->exists(),
                'sedes' => $this->branchActivitiesQuery()->exists(),
            };

            if ($exists) {
                return true;
            }
        }

        return false;
    }

    public function build(): Spreadsheet
    {
        $book = new Spreadsheet;
        $book->getProperties()
            ->setCreator('Intranet DRTPE Puno')
            ->setTitle('Reporte Institucional Consolidado')
            ->setSubject($this->periodLabel);

        // La primera hoja (activa por defecto) es siempre el resumen.
        $resumen = $book->getActiveSheet();
        $resumen->setTitle('Resumen Ejecutivo');

        foreach ($this->modules as $module) {
            match ($module) {
                'metas' => $this->sheetMetas($book->createSheet()),
                'talleres' => $this->sheetTalleres($book->createSheet()),
                'coordinaciones' => $this->sheetCoordinaciones($book->createSheet()),
                'sedes' => $this->sheetSedes($book->createSheet()),
            };
        }

        // El resumen se llena al final: necesita los conteos que dejan las hojas.
        $this->sheetResumen($resumen);
        $book->setActiveSheetIndex(0);

        return $book;
    }

    public function filename(): string
    {
        return sprintf(
            'reporte-institucional-%s_%s.xlsx',
            $this->start->format('Y-m-d'),
            $this->end->format('Y-m-d')
        );
    }

    // ═════════════════════════════════════════════════════════════════════
    // CONSULTAS FILTRADAS
    // ═════════════════════════════════════════════════════════════════════

    /**
     * Actividades operativas con los filtros de gestión aplicados.
     *
     * El departamento vive en la categoría y se compara en minúsculas: la
     * colación binaria de TiDB (utf8mb4_bin) haría fallar un where directo.
     */
    private function eventsQuery(): Builder
    {
        $query = Event::query();

        if ($this->fundingSource !== 'all') {
            $query->where('funding_source', $this->fundingSource);
        }

        if ($this->department !== 'all') {
            $dept = mb_strtolower($this->department);
            $query->whereHas('category', fn (Builder $q) => $q->whereRaw('LOWER(department) = ?', [$dept]));
        }

        return $query;
    }

    private function subEventsQuery(): Builder
    {
        return SubEvent::query()
            ->whereBetween('event_date', [$this->start, $this->end])
            ->whereIn('event_id', $this->eventsQuery()->select('id'));
    }

    /**
     * Un taller entra al periodo si su fecha programada o su fecha de ejecución
     * cae dentro del rango: así el reporte cubre tanto la convocatoria abierta
     * como el evento ya realizado.
     */
    private function workshopsQuery(): Builder
    {
        return Workshop::query()->where(function (Builder $q) {
            $q->whereBetween('scheduled_date', [$this->start, $this->end])
                ->orWhereBetween('executed_date', [$this->start, $this->end]);
        });
    }

    private function coordinationsQuery(): Builder
    {
        return Coordination::query()->whereBetween('coordination_date', [$this->start, $this->end]);
    }

    private function branchActivitiesQuery(): Builder
    {
        return BranchActivity::query()->whereBetween('created_at', [$this->start, $this->end]);
    }

    // ═════════════════════════════════════════════════════════════════════
    // HOJA 1 — RESUMEN EJECUTIVO
    // ═════════════════════════════════════════════════════════════════════

    private function sheetResumen(Worksheet $sheet): void
    {
        foreach (['A' => 46, 'B' => 20, 'C' => 4, 'D' => 34, 'E' => 16] as $col => $width) {
            $sheet->getColumnDimension($col)->setWidth($width);
        }

        $row = $this->titleBlock($sheet, 'REPORTE INSTITUCIONAL CONSOLIDADO', 'E');

        // ── Indicadores de metas físicas (Actividades Operativas) ──
        $metaTotal = (int) $this->eventsQuery()->sum('goal_people');
        $eventIds = $this->eventsQuery()->pluck('id');

        $avanceHistorico = (int) SubEvent::whereIn('event_id', $eventIds)
            ->where('event_date', '<=', $this->end)->sum('attendees_count');
        $avancePeriodo = (int) $this->subEventsQuery()->sum('attendees_count');
        $cumplimiento = $metaTotal > 0 ? round($avanceHistorico / $metaTotal * 100, 1) : 0.0;

        $row = $this->kpiTable($sheet, $row, 'AVANCE DE METAS FÍSICAS (ACTIVIDADES OPERATIVAS)', [
            ['Meta física programada (personas)', $metaTotal],
            ['Avance histórico acumulado al cierre del periodo', $avanceHistorico],
            ['Avance logrado dentro del periodo', $avancePeriodo],
            ['Meta pendiente', max(0, $metaTotal - $avanceHistorico)],
            ['Porcentaje de cumplimiento', $cumplimiento / 100, 'porcentaje'],
            ['Actividades operativas consideradas', $this->eventsQuery()->count()],
            ['Reportes de avance registrados en el periodo', $this->subEventsQuery()->count()],
        ]);

        // ── Indicadores de los módulos complementarios ──
        $talleresProg = (clone $this->workshopsQuery())->where('status', 'programado')->count();
        $talleresEjec = (clone $this->workshopsQuery())->where('status', 'ejecutado')->count();
        $asistTalleres = (int) (clone $this->workshopsQuery())->where('status', 'ejecutado')->sum('attendees_count');
        $coordinaciones = $this->coordinationsQuery()->count();
        $actsSede = $this->branchActivitiesQuery()->count();
        $atendidosSede = (int) $this->branchActivitiesQuery()->sum('attendees_count');

        $row = $this->kpiTable($sheet, $row, 'MÓDULOS COMPLEMENTARIOS DE GESTIÓN', [
            ['Talleres y capacitaciones programados', $talleresProg],
            ['Talleres y capacitaciones ejecutados', $talleresEjec],
            ['Asistentes a talleres ejecutados', $asistTalleres],
            ['Coordinaciones institucionales realizadas', $coordinaciones],
            ['Actividades de sedes desconcentradas', $actsSede],
            ['Ciudadanos atendidos en sedes desconcentradas', $atendidosSede],
            ['Comunicados oficiales vigentes en el periodo', $this->announcementsCount()],
        ]);

        // ── Difusión en redes sociales (transversal) ──
        $difusion = $this->difusionTotals();

        $row = $this->kpiTable($sheet, $row, 'DIFUSIÓN EN REDES SOCIALES', [
            ['Videos publicados en YouTube', $difusion['youtube']],
            ['Videos publicados en Facebook', $difusion['facebook']],
            ['Videos publicados en TikTok', $difusion['tiktok']],
            ['Total de videos difundidos', $difusion['total']],
            ['Registros con cobertura audiovisual', $difusion['registros']],
        ]);

        // ── Cobertura total de personas por módulo (tabla + gráfico) ──
        $cobertura = [
            'Actividades Operativas' => $avancePeriodo,
            'Talleres y Capacitaciones' => $asistTalleres,
            'Sedes Desconcentradas' => $atendidosSede,
        ];

        $row = $this->comparativoCobertura($sheet, $row, $cobertura);

        $this->footerNote($sheet, $row + 1, 'A', 'E');
    }

    /**
     * Bloque de indicadores etiqueta → valor con encabezado de sección.
     *
     * @param  array<int, array{0: string, 1: int|float, 2?: string}>  $rows
     */
    private function kpiTable(Worksheet $sheet, int $row, string $titulo, array $rows): int
    {
        $sheet->setCellValue('A'.$row, $titulo);
        $sheet->mergeCells('A'.$row.':B'.$row);
        $sheet->getStyle('A'.$row.':B'.$row)->applyFromArray([
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF'], 'size' => 10],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => self::AZUL_MEDIO]],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_LEFT, 'vertical' => Alignment::VERTICAL_CENTER],
        ]);
        $sheet->getRowDimension($row)->setRowHeight(20);
        $row++;

        $primera = $row;

        foreach ($rows as $item) {
            [$etiqueta, $valor] = $item;
            $formato = $item[2] ?? 'entero';

            $sheet->setCellValue('A'.$row, $etiqueta);
            $sheet->setCellValueExplicit('B'.$row, $valor, DataType::TYPE_NUMERIC);
            $sheet->getStyle('B'.$row)->getNumberFormat()
                ->setFormatCode($formato === 'porcentaje' ? '0.0%' : '#,##0');
            $row++;
        }

        $sheet->getStyle('A'.$primera.':B'.($row - 1))->applyFromArray([
            'font' => ['size' => 10],
            'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'D6DEE8']]],
        ]);
        $sheet->getStyle('B'.$primera.':B'.($row - 1))->applyFromArray([
            'font' => ['bold' => true],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_RIGHT],
        ]);

        return $row + 1;
    }

    /**
     * Comparativo de personas alcanzadas por módulo, con gráfico de barras
     * nativo apoyado en las celdas auxiliares D/E.
     *
     * @param  array<string, int>  $cobertura
     */
    private function comparativoCobertura(Worksheet $sheet, int $row, array $cobertura): int
    {
        $sheet->setCellValue('A'.$row, 'COBERTURA DE PERSONAS POR MÓDULO');
        $sheet->mergeCells('A'.$row.':B'.$row);
        $sheet->getStyle('A'.$row.':B'.$row)->applyFromArray([
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF'], 'size' => 10],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => self::AZUL_MEDIO]],
        ]);
        $row++;

        $inicio = $row;
        $sheet->setCellValueExplicit('D'.($row - 1), 'Personas', DataType::TYPE_STRING);

        foreach ($cobertura as $modulo => $personas) {
            $sheet->setCellValue('A'.$row, $modulo);
            $sheet->setCellValueExplicit('B'.$row, $personas, DataType::TYPE_NUMERIC);
            $sheet->getStyle('B'.$row)->getNumberFormat()->setFormatCode('#,##0');

            // Celdas auxiliares que alimentan la serie del gráfico.
            $sheet->setCellValueExplicit('C'.$row, $modulo, DataType::TYPE_STRING);
            $sheet->setCellValueExplicit('D'.$row, $personas, DataType::TYPE_NUMERIC);
            $row++;
        }

        $sheet->getStyle('A'.$inicio.':B'.($row - 1))->applyFromArray([
            'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'D6DEE8']]],
        ]);
        $sheet->getStyle('B'.$inicio.':B'.($row - 1))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
        $sheet->getStyle('B'.$inicio.':B'.($row - 1))->getFont()->setBold(true);

        // Las auxiliares se ocultan para no ensuciar la lectura del resumen.
        $sheet->getColumnDimension('C')->setVisible(false);
        $sheet->getColumnDimension('D')->setVisible(false);

        $total = count($cobertura);

        if ($total > 0 && array_sum($cobertura) > 0) {
            $ref = $this->sheetRef('Resumen Ejecutivo');

            $chart = new Chart(
                'coberturaModulos',
                new Title('Personas Alcanzadas por Modulo'),
                new Legend(Legend::POSITION_BOTTOM, null, false),
                new PlotArea(null, [
                    (new DataSeries(
                        DataSeries::TYPE_BARCHART,
                        DataSeries::GROUPING_CLUSTERED,
                        range(0, 0),
                        [new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_STRING, $ref.'!$D$'.($inicio - 1), null, 1)],
                        [new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_STRING, $ref.'!$C$'.$inicio.':$C$'.($row - 1), null, $total)],
                        [new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_NUMBER, $ref.'!$D$'.$inicio.':$D$'.($row - 1), null, $total)]
                    ))->setPlotDirection(DataSeries::DIRECTION_BAR),
                ]),
                true, 'gap', null, null, new Axis, new Axis
            );

            $chart->setTopLeftPosition('D'.($inicio - 1));
            $chart->setBottomRightPosition('E'.($inicio + 12));
            $sheet->addChart($chart);
        }

        return $row + 1;
    }

    /** Comunicados con vigencia solapada al periodo consultado. */
    private function announcementsCount(): int
    {
        return Announcement::where('published_at', '<=', $this->end)
            ->where(function (Builder $q) {
                $q->whereNull('expired_at')->orWhere('expired_at', '>=', $this->start);
            })->count();
    }

    /**
     * Conteo de difusión audiovisual por red, atravesando los cuatro módulos.
     *
     * @return array{youtube:int, facebook:int, tiktok:int, total:int, registros:int}
     */
    private function difusionTotals(): array
    {
        $tally = ['youtube' => 0, 'facebook' => 0, 'tiktok' => 0, 'total' => 0, 'registros' => 0];

        $fuentes = [
            $this->subEventsQuery()->get(),
            $this->workshopsQuery()->get(),
            $this->coordinationsQuery()->get(),
            $this->branchActivitiesQuery()->get(),
        ];

        foreach ($fuentes as $coleccion) {
            foreach ($coleccion as $registro) {
                $videos = $registro->videoEmbeds();

                if ($videos === []) {
                    continue;
                }

                $tally['registros']++;

                foreach ($videos as $video) {
                    $tally[$video['provider']]++;
                    $tally['total']++;
                }
            }
        }

        return $tally;
    }

    // ═════════════════════════════════════════════════════════════════════
    // HOJA 2 — METAS Y AVANCES (Event → SubEvent)
    // ═════════════════════════════════════════════════════════════════════

    private function sheetMetas(Worksheet $sheet): void
    {
        $sheet->setTitle('Metas y Avances');

        $encabezados = [
            'Código PP', 'Cód. Actividad', 'Actividad Operativa', 'Fuente Financiamiento',
            'Área', 'Fecha', 'Detalle del Reporte', 'Asistentes',
            'Acumulado Previo', 'Nuevo Acumulado', 'Fotos', 'Videos', 'Redes',
        ];

        $anchos = ['A' => 12, 'B' => 14, 'C' => 38, 'D' => 20, 'E' => 14, 'F' => 12,
            'G' => 40, 'H' => 11, 'I' => 16, 'J' => 16, 'K' => 8, 'L' => 8, 'M' => 22];

        $row = $this->tableHeader($sheet, $encabezados, $anchos, 'REPORTE DE METAS Y AVANCES FÍSICOS', 'M');
        $primeraFila = $row;

        $reportes = $this->subEventsQuery()
            ->with(['event.category'])
            ->get()
            ->sortBy([
                ['event.category.pp_code', 'asc'],
                ['event.event_code', 'asc'],
                ['event_date', 'asc'],
            ]);

        $acumuladores = [];
        $totalPeriodo = 0;
        $codigoAnterior = null;

        $chartBar = [];   // código de actividad => asistentes
        $chartPie = [];   // categoría => asistentes
        $chartLine = [];  // fecha => asistentes

        foreach ($reportes as $reporte) {
            $evento = $reporte->event;
            $categoria = $evento->category->name ?? 'Sin Categoría';
            $codigo = $evento->event_code ?? 'N/A';

            if (! isset($acumuladores[$reporte->event_id])) {
                $acumuladores[$reporte->event_id] = (int) SubEvent::where('event_id', $reporte->event_id)
                    ->where('event_date', '<', $this->start)
                    ->sum('attendees_count');
            }

            $previo = $acumuladores[$reporte->event_id];
            $nuevo = $previo + (int) $reporte->attendees_count;
            $acumuladores[$reporte->event_id] = $nuevo;

            // Los datos de la actividad madre solo se repiten al cambiar de código.
            if ($codigo !== $codigoAnterior) {
                $sheet->setCellValue('A'.$row, $evento->category->pp_code ?? 'N/A');
                $sheet->setCellValue('B'.$row, $codigo);
                $sheet->setCellValue('C'.$row, $evento->description ?? '');
                $sheet->setCellValue('D'.$row, $this->fundingLabel($evento->funding_source));
                $sheet->setCellValue('E'.$row, ucfirst((string) ($evento->category->department ?? '—')));
            }
            $codigoAnterior = $codigo;

            $fecha = Carbon::parse($reporte->event_date);
            $videos = $reporte->videoEmbeds();

            $sheet->setCellValue('F'.$row, $fecha->format('d/m/Y'));
            $sheet->setCellValue('G'.$row, $reporte->report_title);
            $sheet->setCellValueExplicit('H'.$row, (int) $reporte->attendees_count, DataType::TYPE_NUMERIC);
            $sheet->setCellValueExplicit('I'.$row, $previo, DataType::TYPE_NUMERIC);
            $sheet->setCellValueExplicit('J'.$row, $nuevo, DataType::TYPE_NUMERIC);
            $sheet->setCellValueExplicit('K'.$row, count($reporte->photos ?? []), DataType::TYPE_NUMERIC);
            $sheet->setCellValueExplicit('L'.$row, count($videos), DataType::TYPE_NUMERIC);
            $sheet->setCellValue('M'.$row, $this->providerList($videos));

            $totalPeriodo += (int) $reporte->attendees_count;

            $chartBar[$codigo] = ($chartBar[$codigo] ?? 0) + (int) $reporte->attendees_count;
            $chartPie[$categoria] = ($chartPie[$categoria] ?? 0) + (int) $reporte->attendees_count;
            $claveFecha = $fecha->format('Y-m-d');
            $chartLine[$claveFecha] = ($chartLine[$claveFecha] ?? 0) + (int) $reporte->attendees_count;

            $row++;
        }

        if ($row === $primeraFila) {
            $this->emptyNotice($sheet, $row, 'M', 'No se registraron reportes de avance en el periodo con los filtros aplicados.');

            return;
        }

        $this->bodyStyle($sheet, 'A'.$primeraFila.':M'.($row - 1));
        $sheet->getStyle('H'.$primeraFila.':L'.($row - 1))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('C'.$primeraFila.':C'.($row - 1))->getAlignment()->setWrapText(true);
        $sheet->getStyle('G'.$primeraFila.':G'.($row - 1))->getAlignment()->setWrapText(true);

        // ── Fila de totales ──
        $previoGlobal = 0;
        $nuevoGlobal = 0;
        foreach ($acumuladores as $eventId => $ultimo) {
            $previoGlobal += (int) SubEvent::where('event_id', $eventId)
                ->where('event_date', '<', $this->start)->sum('attendees_count');
            $nuevoGlobal += $ultimo;
        }

        $sheet->mergeCells('A'.$row.':G'.$row);
        $sheet->setCellValue('A'.$row, 'TOTALES DEL PERIODO');
        $sheet->setCellValueExplicit('H'.$row, $totalPeriodo, DataType::TYPE_NUMERIC);
        $sheet->setCellValueExplicit('I'.$row, $previoGlobal, DataType::TYPE_NUMERIC);
        $sheet->setCellValueExplicit('J'.$row, $nuevoGlobal, DataType::TYPE_NUMERIC);
        $sheet->setCellValueExplicit('K'.$row, array_sum(array_map(fn ($r) => count($r->photos ?? []), $reportes->all())), DataType::TYPE_NUMERIC);
        $sheet->setCellValueExplicit('L'.$row, array_sum(array_map(fn ($r) => count($r->videoEmbeds()), $reportes->all())), DataType::TYPE_NUMERIC);
        $this->totalsStyle($sheet, 'A'.$row.':M'.$row);

        $this->metasCharts($sheet, $row, $chartBar, $chartPie, $chartLine);
    }

    /**
     * Gráficos nativos de la hoja de metas. Los rangos auxiliares viven a partir
     * de la columna P para no interferir con la tabla ni con la impresión.
     *
     * @param  array<string, int>  $bar
     * @param  array<string, int>  $pie
     * @param  array<string, int>  $line
     */
    private function metasCharts(Worksheet $sheet, int $rowTotales, array $bar, array $pie, array $line): void
    {
        $ref = $this->sheetRef('Metas y Avances');
        $anchor = $rowTotales + 3;

        // Serie A: asistentes por actividad (P/Q)
        $sheet->setCellValueExplicit('P1', 'Actividad', DataType::TYPE_STRING);
        $sheet->setCellValueExplicit('Q1', 'Asistentes', DataType::TYPE_STRING);
        $i = 2;
        foreach ($bar as $codigo => $valor) {
            $sheet->setCellValueExplicit('P'.$i, (string) $codigo, DataType::TYPE_STRING);
            $sheet->setCellValueExplicit('Q'.$i, (int) $valor, DataType::TYPE_NUMERIC);
            $i++;
        }

        if (($n = count($bar)) > 0) {
            $chart = new Chart(
                'barMetas',
                new Title('Asistencias por Actividad Operativa'),
                new Legend(Legend::POSITION_BOTTOM, null, false),
                new PlotArea(null, [
                    (new DataSeries(
                        DataSeries::TYPE_BARCHART, DataSeries::GROUPING_CLUSTERED, range(0, 0),
                        [new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_STRING, $ref.'!$Q$1', null, 1)],
                        [new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_STRING, $ref.'!$P$2:$P$'.($n + 1), null, $n)],
                        [new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_NUMBER, $ref.'!$Q$2:$Q$'.($n + 1), null, $n)]
                    ))->setPlotDirection(DataSeries::DIRECTION_COL),
                ]),
                true, 'gap', null, null, new Axis, new Axis
            );
            $chart->setTopLeftPosition('A'.$anchor);
            $chart->setBottomRightPosition('E'.($anchor + 16));
            $sheet->addChart($chart);
        }

        // Serie B: distribución por categoría (R/S)
        $sheet->setCellValueExplicit('R1', 'Categoría', DataType::TYPE_STRING);
        $sheet->setCellValueExplicit('S1', 'Distribución', DataType::TYPE_STRING);
        $i = 2;
        foreach ($pie as $categoria => $valor) {
            $sheet->setCellValueExplicit('R'.$i, (string) $categoria, DataType::TYPE_STRING);
            $sheet->setCellValueExplicit('S'.$i, (int) $valor, DataType::TYPE_NUMERIC);
            $i++;
        }

        if (($n = count($pie)) > 0) {
            $chart = new Chart(
                'pieCategorias',
                new Title('Distribucion por Categoria'),
                new Legend(Legend::POSITION_BOTTOM, null, false),
                new PlotArea(null, [
                    new DataSeries(
                        DataSeries::TYPE_PIECHART, null, range(0, 0),
                        [new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_STRING, $ref.'!$S$1', null, 1)],
                        [new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_STRING, $ref.'!$R$2:$R$'.($n + 1), null, $n)],
                        [new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_NUMBER, $ref.'!$S$2:$S$'.($n + 1), null, $n)]
                    ),
                ]),
                true, 'gap'
            );
            $chart->setTopLeftPosition('F'.$anchor);
            $chart->setBottomRightPosition('J'.($anchor + 16));
            $sheet->addChart($chart);
        }

        // Serie C: evolución cronológica (T/U)
        ksort($line);
        $sheet->setCellValueExplicit('T1', 'Fecha', DataType::TYPE_STRING);
        $sheet->setCellValueExplicit('U1', 'Evolución', DataType::TYPE_STRING);
        $i = 2;
        foreach ($line as $fecha => $valor) {
            $sheet->setCellValueExplicit('T'.$i, Carbon::parse($fecha)->format('d/m'), DataType::TYPE_STRING);
            $sheet->setCellValueExplicit('U'.$i, (int) $valor, DataType::TYPE_NUMERIC);
            $i++;
        }

        if (($n = count($line)) > 1) {
            $chart = new Chart(
                'lineEvolucion',
                new Title('Linea de Tiempo de Asistencias'),
                new Legend(Legend::POSITION_TOP, null, false),
                new PlotArea(null, [
                    new DataSeries(
                        DataSeries::TYPE_LINECHART, DataSeries::GROUPING_STANDARD, range(0, 0),
                        [new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_STRING, $ref.'!$U$1', null, 1)],
                        [new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_STRING, $ref.'!$T$2:$T$'.($n + 1), null, $n)],
                        [new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_NUMBER, $ref.'!$U$2:$U$'.($n + 1), null, $n)]
                    ),
                ]),
                true, 'gap', null, null, new Axis, new Axis
            );
            $chart->setTopLeftPosition('A'.($anchor + 18));
            $chart->setBottomRightPosition('J'.($anchor + 34));
            $sheet->addChart($chart);
        }

        foreach (['P', 'Q', 'R', 'S', 'T', 'U'] as $col) {
            $sheet->getColumnDimension($col)->setVisible(false);
        }
    }

    // ═════════════════════════════════════════════════════════════════════
    // HOJA 3 — TALLERES Y CAPACITACIONES
    // ═════════════════════════════════════════════════════════════════════

    private function sheetTalleres(Worksheet $sheet): void
    {
        $sheet->setTitle('Talleres y Capacitaciones');

        $encabezados = ['Tipo', 'Título', 'Estado', 'Fecha Programada', 'Horario',
            'Lugar', 'Fecha Ejecución', 'Asistentes', 'Fotos', 'Videos', 'Redes', 'Comunicado'];

        $anchos = ['A' => 16, 'B' => 42, 'C' => 14, 'D' => 17, 'E' => 14, 'F' => 26,
            'G' => 16, 'H' => 12, 'I' => 8, 'J' => 8, 'K' => 22, 'L' => 13];

        $row = $this->tableHeader($sheet, $encabezados, $anchos, 'TALLERES Y CAPACITACIONES (CICLO PROGRAMADO ⇄ EJECUTADO)', 'L');
        $primeraFila = $row;

        $talleres = $this->workshopsQuery()
            ->orderByRaw('CASE WHEN status = ? THEN 0 ELSE 1 END', ['programado'])
            ->orderBy('scheduled_date')
            ->get();

        $asistentes = 0;

        foreach ($talleres as $taller) {
            $videos = $taller->videoEmbeds();

            $sheet->setCellValue('A'.$row, $taller->type_label);
            $sheet->setCellValue('B'.$row, $taller->title);
            $sheet->setCellValue('C'.$row, $taller->status === 'ejecutado' ? 'Ejecutado' : 'Programado');
            $sheet->setCellValue('D'.$row, optional($taller->scheduled_date)->format('d/m/Y') ?: '—');
            $sheet->setCellValue('E'.$row, $taller->horario() ?: '—');
            $sheet->setCellValue('F'.$row, $taller->location ?: '—');
            $sheet->setCellValue('G'.$row, optional($taller->executed_date)->format('d/m/Y') ?: '—');
            $sheet->setCellValueExplicit('H'.$row, (int) ($taller->attendees_count ?? 0), DataType::TYPE_NUMERIC);
            $sheet->setCellValueExplicit('I'.$row, count($taller->photos ?? []), DataType::TYPE_NUMERIC);
            $sheet->setCellValueExplicit('J'.$row, count($videos), DataType::TYPE_NUMERIC);
            $sheet->setCellValue('K'.$row, $this->providerList($videos));
            $sheet->setCellValue('L'.$row, $taller->announcement_id ? 'Publicado' : 'No');

            // Realce visual del estado del ciclo de vida.
            $sheet->getStyle('C'.$row)->getFont()->getColor()->setRGB(
                $taller->status === 'ejecutado' ? '15803D' : 'B45309'
            );
            $sheet->getStyle('C'.$row)->getFont()->setBold(true);

            $asistentes += (int) ($taller->attendees_count ?? 0);
            $row++;
        }

        if ($row === $primeraFila) {
            $this->emptyNotice($sheet, $row, 'L', 'No se registraron talleres ni capacitaciones en el periodo.');

            return;
        }

        $this->bodyStyle($sheet, 'A'.$primeraFila.':L'.($row - 1));
        $sheet->getStyle('B'.$primeraFila.':B'.($row - 1))->getAlignment()->setWrapText(true);
        $sheet->getStyle('H'.$primeraFila.':J'.($row - 1))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $sheet->mergeCells('A'.$row.':G'.$row);
        $sheet->setCellValue('A'.$row, 'TOTAL ('.$talleres->count().' eventos)');
        $sheet->setCellValueExplicit('H'.$row, $asistentes, DataType::TYPE_NUMERIC);
        $sheet->setCellValueExplicit('I'.$row, $talleres->sum(fn ($t) => count($t->photos ?? [])), DataType::TYPE_NUMERIC);
        $sheet->setCellValueExplicit('J'.$row, $talleres->sum(fn ($t) => count($t->videoEmbeds())), DataType::TYPE_NUMERIC);
        $this->totalsStyle($sheet, 'A'.$row.':L'.$row);
    }

    // ═════════════════════════════════════════════════════════════════════
    // HOJA 4 — COORDINACIONES INSTITUCIONALES
    // ═════════════════════════════════════════════════════════════════════

    private function sheetCoordinaciones(Worksheet $sheet): void
    {
        $sheet->setTitle('Coordinaciones');

        $encabezados = ['Fecha', 'Título', 'Detalle / Acuerdos', 'Fotos', 'Videos', 'Redes'];
        $anchos = ['A' => 14, 'B' => 42, 'C' => 62, 'D' => 8, 'E' => 8, 'F' => 22];

        $row = $this->tableHeader($sheet, $encabezados, $anchos, 'COORDINACIONES INSTITUCIONALES REALIZADAS', 'F');
        $primeraFila = $row;

        $coordinaciones = $this->coordinationsQuery()->orderByDesc('coordination_date')->get();

        foreach ($coordinaciones as $coord) {
            $videos = $coord->videoEmbeds();

            $sheet->setCellValue('A'.$row, optional($coord->coordination_date)->format('d/m/Y'));
            $sheet->setCellValue('B'.$row, $coord->title);
            $sheet->setCellValue('C'.$row, preg_replace('/\s+/', ' ', (string) $coord->description));
            $sheet->setCellValueExplicit('D'.$row, count($coord->photos ?? []), DataType::TYPE_NUMERIC);
            $sheet->setCellValueExplicit('E'.$row, count($videos), DataType::TYPE_NUMERIC);
            $sheet->setCellValue('F'.$row, $this->providerList($videos));
            $row++;
        }

        if ($row === $primeraFila) {
            $this->emptyNotice($sheet, $row, 'F', 'No se registraron coordinaciones institucionales en el periodo.');

            return;
        }

        $this->bodyStyle($sheet, 'A'.$primeraFila.':F'.($row - 1));
        $sheet->getStyle('B'.$primeraFila.':C'.($row - 1))->getAlignment()->setWrapText(true);
        $sheet->getStyle('D'.$primeraFila.':E'.($row - 1))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $sheet->mergeCells('A'.$row.':C'.$row);
        $sheet->setCellValue('A'.$row, 'TOTAL ('.$coordinaciones->count().' coordinaciones)');
        $sheet->setCellValueExplicit('D'.$row, $coordinaciones->sum(fn ($c) => count($c->photos ?? [])), DataType::TYPE_NUMERIC);
        $sheet->setCellValueExplicit('E'.$row, $coordinaciones->sum(fn ($c) => count($c->videoEmbeds())), DataType::TYPE_NUMERIC);
        $this->totalsStyle($sheet, 'A'.$row.':F'.$row);
    }

    // ═════════════════════════════════════════════════════════════════════
    // HOJA 5 — ACTIVIDADES DE SEDES DESCONCENTRADAS
    // ═════════════════════════════════════════════════════════════════════

    private function sheetSedes(Worksheet $sheet): void
    {
        $sheet->setTitle('Actividades por Sede');

        $encabezados = ['Sede', 'Fecha', 'Tipo de Intervención', 'Título', 'Atendidos', 'Fotos', 'Videos', 'Redes', 'Responsable'];
        $anchos = ['A' => 16, 'B' => 14, 'C' => 22, 'D' => 42, 'E' => 12, 'F' => 8, 'G' => 8, 'H' => 22, 'I' => 26];

        $row = $this->tableHeader($sheet, $encabezados, $anchos, 'ACTIVIDADES DE LAS SEDES DESCONCENTRADAS', 'I');
        $primeraFila = $row;

        $actividades = $this->branchActivitiesQuery()
            ->with('user')
            ->orderBy('sede')
            ->orderBy('created_at')
            ->get()
            ->groupBy(fn ($a) => mb_strtolower((string) $a->sede));

        $totalAtendidos = 0;
        $totalRegistros = 0;

        foreach ($actividades as $sede => $registros) {
            $sedeLabel = $this->sedeLabel($sede);
            $subtotal = 0;
            $inicioBloque = $row;

            foreach ($registros as $actividad) {
                $videos = $actividad->videoEmbeds();

                $sheet->setCellValue('A'.$row, $sedeLabel);
                $sheet->setCellValue('B'.$row, $actividad->created_at->format('d/m/Y'));
                $sheet->setCellValue('C'.$row, ucfirst((string) ($actividad->type ?? 'asesoria')));
                $sheet->setCellValue('D'.$row, $actividad->title);
                $sheet->setCellValueExplicit('E'.$row, (int) ($actividad->attendees_count ?? 0), DataType::TYPE_NUMERIC);
                $sheet->setCellValueExplicit('F'.$row, count($actividad->photos ?? []), DataType::TYPE_NUMERIC);
                $sheet->setCellValueExplicit('G'.$row, count($videos), DataType::TYPE_NUMERIC);
                $sheet->setCellValue('H'.$row, $this->providerList($videos));
                $sheet->setCellValue('I'.$row, $actividad->user->name ?? '—');

                $subtotal += (int) ($actividad->attendees_count ?? 0);
                $row++;
            }

            $this->bodyStyle($sheet, 'A'.$inicioBloque.':I'.($row - 1));
            $sheet->getStyle('D'.$inicioBloque.':D'.($row - 1))->getAlignment()->setWrapText(true);
            $sheet->getStyle('E'.$inicioBloque.':G'.($row - 1))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

            // Subtotal por sede: es la lectura que pide la gerencia por jurisdicción.
            $sheet->mergeCells('A'.$row.':D'.$row);
            $sheet->setCellValue('A'.$row, 'Subtotal '.$sedeLabel.' ('.$registros->count().' actividades)');
            $sheet->setCellValueExplicit('E'.$row, $subtotal, DataType::TYPE_NUMERIC);
            $sheet->getStyle('A'.$row.':I'.$row)->applyFromArray([
                'font' => ['bold' => true, 'color' => ['rgb' => '1F4E78']],
                'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => self::GRIS_SUAVE]],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_RIGHT],
            ]);

            $totalAtendidos += $subtotal;
            $totalRegistros += $registros->count();
            $row += 2;
        }

        if ($row === $primeraFila) {
            $this->emptyNotice($sheet, $row, 'I', 'No se registraron actividades de sedes desconcentradas en el periodo.');

            return;
        }

        $sheet->mergeCells('A'.$row.':D'.$row);
        $sheet->setCellValue('A'.$row, 'TOTAL GENERAL ('.$totalRegistros.' actividades)');
        $sheet->setCellValueExplicit('E'.$row, $totalAtendidos, DataType::TYPE_NUMERIC);
        $this->totalsStyle($sheet, 'A'.$row.':I'.$row);
    }

    // ═════════════════════════════════════════════════════════════════════
    // UTILIDADES DE PRESENTACIÓN
    // ═════════════════════════════════════════════════════════════════════

    /**
     * Cabecera institucional común: entidad, título, periodo y filtros vigentes.
     * Devuelve la primera fila libre para el contenido de la hoja.
     */
    private function titleBlock(Worksheet $sheet, string $titulo, string $ultimaColumna): int
    {
        $sheet->mergeCells('A1:'.$ultimaColumna.'1');
        $sheet->setCellValue('A1', 'GOBIERNO REGIONAL DE PUNO · GERENCIA REGIONAL DE TRABAJO Y PROMOCIÓN DEL EMPLEO');
        $sheet->getStyle('A1')->applyFromArray([
            'font' => ['bold' => true, 'size' => 9, 'color' => ['rgb' => '64748B']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ]);

        $sheet->mergeCells('A2:'.$ultimaColumna.'2');
        $sheet->setCellValue('A2', $titulo);
        $sheet->getStyle('A2')->applyFromArray([
            'font' => ['bold' => true, 'size' => 14, 'color' => ['rgb' => self::AZUL_OSCURO]],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ]);
        $sheet->getRowDimension('2')->setRowHeight(24);

        $sheet->mergeCells('A3:'.$ultimaColumna.'3');
        $sheet->setCellValue('A3', $this->periodLabel.'   |   '.$this->filtrosLegibles());
        $sheet->getStyle('A3')->applyFromArray([
            'font' => ['bold' => true, 'size' => 10, 'color' => ['rgb' => '334155']],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => self::GRIS_SUAVE]],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ]);
        $sheet->getRowDimension('3')->setRowHeight(18);

        return 5;
    }

    /**
     * Encabezado de tabla con su título de sección.
     *
     * @param  array<int, string>  $encabezados
     * @param  array<string, int>  $anchos
     */
    private function tableHeader(Worksheet $sheet, array $encabezados, array $anchos, string $titulo, string $ultimaColumna): int
    {
        foreach ($anchos as $col => $ancho) {
            $sheet->getColumnDimension($col)->setWidth($ancho);
        }

        $row = $this->titleBlock($sheet, $titulo, $ultimaColumna);

        $sheet->fromArray($encabezados, null, 'A'.$row);
        $sheet->getStyle('A'.$row.':'.$ultimaColumna.$row)->applyFromArray([
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF'], 'size' => 10],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => self::AZUL_OSCURO]],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ],
            'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]],
        ]);
        $sheet->getRowDimension($row)->setRowHeight(28);

        // La cabecera queda fija al desplazarse: son tablas largas.
        $sheet->freezePane('A'.($row + 1));

        return $row + 1;
    }

    private function bodyStyle(Worksheet $sheet, string $range): void
    {
        $sheet->getStyle($range)->applyFromArray([
            'font' => ['size' => 10],
            'alignment' => ['vertical' => Alignment::VERTICAL_CENTER],
            'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'D6DEE8']]],
        ]);
    }

    private function totalsStyle(Worksheet $sheet, string $range): void
    {
        $sheet->getStyle($range)->applyFromArray([
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => self::AZUL_MEDIO]],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_RIGHT, 'vertical' => Alignment::VERTICAL_CENTER],
            'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]],
        ]);

        // Se toma el número de fila del inicio del rango (ej. "A12:M12" → 12).
        if (preg_match('/^[A-Z]+(\d+)/', $range, $m)) {
            $sheet->getRowDimension((int) $m[1])->setRowHeight(20);
        }
    }

    private function emptyNotice(Worksheet $sheet, int $row, string $ultimaColumna, string $mensaje): void
    {
        $sheet->mergeCells('A'.$row.':'.$ultimaColumna.$row);
        $sheet->setCellValue('A'.$row, $mensaje);
        $sheet->getStyle('A'.$row)->applyFromArray([
            'font' => ['italic' => true, 'color' => ['rgb' => '94A3B8'], 'size' => 10],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ]);
        $sheet->getRowDimension($row)->setRowHeight(24);
    }

    private function footerNote(Worksheet $sheet, int $row, string $primeraColumna, string $ultimaColumna): void
    {
        $sheet->mergeCells($primeraColumna.$row.':'.$ultimaColumna.$row);
        $sheet->setCellValue(
            $primeraColumna.$row,
            'Generado el '.now()->format('d/m/Y H:i').' desde la Intranet DRTPE Puno. '
            .'Los filtros de financiamiento y área aplican únicamente a las Actividades Operativas (metas físicas); '
            .'talleres, coordinaciones y actividades de sede no manejan esas dimensiones.'
        );
        $sheet->getStyle($primeraColumna.$row)->applyFromArray([
            'font' => ['italic' => true, 'size' => 8, 'color' => ['rgb' => '94A3B8']],
            'alignment' => ['wrapText' => true, 'vertical' => Alignment::VERTICAL_TOP],
        ]);
        $sheet->getRowDimension($row)->setRowHeight(30);
    }

    /** Referencia de hoja para las fórmulas de gráficos (comillas si hay espacios). */
    private function sheetRef(string $titulo): string
    {
        return str_contains($titulo, ' ') ? "'".$titulo."'" : $titulo;
    }

    private function filtrosLegibles(): string
    {
        $financiamiento = match ($this->fundingSource) {
            'gobierno_regional' => 'Gobierno Regional',
            'gobierno_central' => 'SUNAFIL / Gobierno Central',
            default => 'Todas las fuentes',
        };

        $area = $this->department === 'all' ? 'Todas las áreas' : ucfirst($this->department);

        return 'Financiamiento: '.$financiamiento.'   |   Área: '.$area;
    }

    private function fundingLabel(?string $source): string
    {
        return match ($source) {
            'gobierno_regional' => 'Gobierno Regional',
            'gobierno_central' => 'SUNAFIL / Central',
            default => '—',
        };
    }

    /** Nombre legible de la sede; null/vacío corresponde a la Sede Central. */
    private function sedeLabel(?string $sede): string
    {
        return match ((string) $sede) {
            'juliaca' => 'Sede Juliaca',
            'taraco' => 'Sede Taraco',
            '' => 'Sede Central',
            default => 'Sede '.ucfirst((string) $sede),
        };
    }

    /**
     * Redes involucradas en un conjunto de videos, sin repetir (ej. "YouTube, TikTok").
     *
     * @param  array<int, array<string, mixed>>  $videos
     */
    private function providerList(array $videos): string
    {
        if ($videos === []) {
            return '—';
        }

        return implode(', ', array_unique(array_column($videos, 'provider_label')));
    }
}
