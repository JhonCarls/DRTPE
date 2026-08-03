<?php

namespace App\Http\Controllers;

use App\Exports\InstitutionalReportBook;
use App\Models\BranchActivity;
use App\Models\Coordination;
use App\Models\Event;
use App\Models\SubEvent;
use App\Models\Workshop;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Chart\Axis;
use PhpOffice\PhpSpreadsheet\Chart\Chart;
// Importaciones de PhpSpreadsheet
use PhpOffice\PhpSpreadsheet\Chart\DataSeries;
use PhpOffice\PhpSpreadsheet\Chart\DataSeriesValues;
use PhpOffice\PhpSpreadsheet\Chart\Legend;
use PhpOffice\PhpSpreadsheet\Chart\PlotArea;
use PhpOffice\PhpSpreadsheet\Chart\Title;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ReportController extends Controller
{
    /**
     * Panel del generador de reportes.
     *
     * Además del catálogo de actividades para el selector, entrega el resumen
     * pre-compilado que alimenta el "Dashboard de Monitoreo Global" de la vista
     * (bloque condicionado a $metaFisicaTotal) y los contadores por módulo que
     * se muestran junto al selector de contenido del libro.
     */
    public function index()
    {
        $events = Event::with('category')
            ->withSum('subEvents as total_attendees', 'attendees_count')
            ->orderBy('event_code')
            ->get();

        $metaFisicaTotal = (int) $events->sum('goal_people');
        $avanceHistorico = (int) $events->sum('total_attendees');
        $metaFaltante = max(0, $metaFisicaTotal - $avanceHistorico);

        // Top 8 de actividades por cobertura: más barras que eso vuelven
        // ilegible el gráfico del panel.
        $top = $events->sortByDesc('total_attendees')->take(8)->values();
        $barrasLabels = $top->map(fn ($e) => $e->event_code)->all();
        $barrasData = $top->map(fn ($e) => (int) $e->total_attendees)->all();

        $porCategoria = $events->groupBy(fn ($e) => $e->category->name ?? 'Sin categoría')
            ->map(fn ($grupo) => (int) $grupo->sum('total_attendees'))
            ->sortDesc();
        $tortaLabels = $porCategoria->keys()->all();
        $tortaData = $porCategoria->values()->all();

        // Volumen de cada módulo, para que el operador sepa qué esperar del libro.
        $moduleStats = [
            'metas' => SubEvent::count(),
            'talleres' => Workshop::count(),
            'coordinaciones' => Coordination::count(),
            'sedes' => BranchActivity::count(),
        ];

        return view('reports.index', compact(
            'events',
            'metaFisicaTotal',
            'avanceHistorico',
            'metaFaltante',
            'barrasLabels',
            'barrasData',
            'tortaLabels',
            'tortaData',
            'moduleStats'
        ));
    }

    /**
     * Libro Excel institucional consolidado.
     *
     * Antes producía una sola hoja con las metas físicas e ignoraba en silencio
     * los filtros de financiamiento y área que el formulario ya enviaba. Ahora
     * ambos filtros se aplican y el libro cubre además talleres, coordinaciones
     * y actividades de sedes desconcentradas, según los módulos solicitados.
     */
    public function generateGeneral(Request $request)
    {
        $request->validate([
            'period' => 'required|in:day,week,month,quarter,year',
            'date' => 'required|date',
            'funding_source' => 'nullable|in:all,gobierno_regional,gobierno_central',
            'department' => 'nullable|in:all,prevencion,formaliza,empleo',
            'modules' => 'nullable|array',
            'modules.*' => 'in:'.implode(',', InstitutionalReportBook::MODULES),
        ]);

        $period = $request->period;
        $range = $this->getDateRange($period, Carbon::parse($request->date));

        $book = new InstitutionalReportBook(
            start: $range['start'],
            end: $range['end'],
            periodLabel: $this->periodLabel($period, $range),
            fundingSource: $request->input('funding_source', 'all'),
            department: $request->input('department', 'all'),
            modules: $request->input('modules', InstitutionalReportBook::MODULES),
        );

        if (! $book->hasData()) {
            $nombre = ['day' => 'el día', 'week' => 'la semana', 'month' => 'el mes', 'quarter' => 'el trimestre', 'year' => 'el año'][$period];

            return redirect()->route('reports.index')
                ->with('error', "No se encontraron registros en $nombre seleccionado para los módulos y filtros elegidos.");
        }

        return $this->stream($book->build(), $book->filename());
    }

    public function generateSpecific(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'period' => 'required|in:day,week,month,quarter,year',
            'date' => 'required|date',
        ]);

        $event = Event::findOrFail($request->event_id);
        $period = $request->period;
        $date = Carbon::parse($request->date);
        $range = $this->getDateRange($period, $date);

        $reportes = SubEvent::where('event_id', $event->id)
            ->whereBetween('event_date', [$range['start'], $range['end']])
            ->orderBy('event_date')
            ->get();

        if ($reportes->isEmpty()) {
            $periodName = ['day' => 'el día', 'week' => 'la semana', 'month' => 'el mes', 'quarter' => 'el trimestre', 'year' => 'el año'][$period];

            return redirect()->route('reports.index')
                ->with('error', "La actividad \"{$event->event_code}\" no tiene reportes en $periodName seleccionado.");
        }

        $spreadsheet = new Spreadsheet;
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Reporte Actividad');

        // --- ENCABEZADOS ---
        // Se suman las columnas de evidencia (fotografías y difusión en redes),
        // que hoy forman parte del expediente de cada reporte de avance.
        $encabezados = ['Fecha', 'Título', 'Asistentes', 'Acumulado Previo', 'Nuevo Acumulado', 'Fotos', 'Videos', 'Redes'];
        $sheet->fromArray($encabezados, null, 'A1');

        $sheet->getStyle('A1:H1')->applyFromArray([
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '1F4E78']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
            'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]],
        ]);

        foreach (['A' => 12, 'B' => 35, 'C' => 12, 'D' => 18, 'E' => 18, 'F' => 9, 'G' => 9, 'H' => 22] as $col => $width) {
            $sheet->getColumnDimension($col)->setWidth($width);
        }

        // --- DATOS ---
        $rowNum = 2;
        $acumuladoPrevioInicial = SubEvent::where('event_id', $event->id)
            ->where('event_date', '<', $range['start'])
            ->sum('attendees_count');
        $runningAcum = $acumuladoPrevioInicial;
        $totalPeriodo = 0;

        $chartLineData = []; // fecha => asistentes

        foreach ($reportes as $reporte) {
            $acumuladoPrevio = $runningAcum;
            $nuevoAcumulado = $acumuladoPrevio + $reporte->attendees_count;
            $runningAcum = $nuevoAcumulado;

            $fechaStr = Carbon::parse($reporte->event_date)->format('Y-m-d');
            $fechaFormat = Carbon::parse($fechaStr)->format('d/m/Y');

            $videos = $reporte->videoEmbeds();

            $sheet->setCellValue('A'.$rowNum, $fechaFormat);
            $sheet->setCellValue('B'.$rowNum, $reporte->report_title);
            $sheet->setCellValue('C'.$rowNum, $reporte->attendees_count);
            $sheet->setCellValue('D'.$rowNum, $acumuladoPrevio);
            $sheet->setCellValue('E'.$rowNum, $nuevoAcumulado);
            $sheet->setCellValue('F'.$rowNum, count($reporte->photos ?? []));
            $sheet->setCellValue('G'.$rowNum, count($videos));
            $sheet->setCellValue('H'.$rowNum, $videos === []
                ? '—'
                : implode(', ', array_unique(array_column($videos, 'provider_label'))));

            $totalPeriodo += $reporte->attendees_count;
            if (! isset($chartLineData[$fechaStr])) {
                $chartLineData[$fechaStr] = 0;
            }
            $chartLineData[$fechaStr] += $reporte->attendees_count;

            $rowNum++;
        }

        // Fila de totales de la actividad
        $sheet->mergeCells('A'.$rowNum.':B'.$rowNum);
        $sheet->setCellValue('A'.$rowNum, 'TOTAL DE LA ACTIVIDAD');
        $sheet->setCellValue('C'.$rowNum, $totalPeriodo);
        $sheet->setCellValue('D'.$rowNum, $acumuladoPrevioInicial);
        $sheet->setCellValue('E'.$rowNum, $runningAcum);
        $sheet->setCellValue('F'.$rowNum, $reportes->sum(fn ($r) => count($r->photos ?? [])));
        $sheet->setCellValue('G'.$rowNum, $reportes->sum(fn ($r) => count($r->videoEmbeds())));

        $sheet->getStyle('A'.$rowNum.':H'.$rowNum)->applyFromArray([
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '4F81BD']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_RIGHT],
            'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]],
        ]);

        // --- GRÁFICOS ---
        $sheetTitle = "'Reporte Actividad'";

        // Línea de evolución diaria
        if (count($chartLineData) > 1) {
            $rowL = 2;
            $sheet->setCellValueExplicit('G1', 'Fecha', DataType::TYPE_STRING);
            $sheet->setCellValueExplicit('H1', 'Asistentes', DataType::TYPE_STRING);
            ksort($chartLineData);
            foreach ($chartLineData as $fecha => $valor) {
                $fechaFormatShort = Carbon::parse($fecha)->format('d/m');
                $sheet->setCellValueExplicit('G'.$rowL, (string) $fechaFormatShort, DataType::TYPE_STRING);
                $sheet->setCellValueExplicit('H'.$rowL, (int) $valor, DataType::TYPE_NUMERIC);
                $rowL++;
            }
            $lineRows = count($chartLineData);

            $lineLabels = [new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_STRING, $sheetTitle.'!$H$1', null, 1)];
            $lineCategories = [new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_STRING, $sheetTitle.'!$G$2:$G$'.($lineRows + 1), null, $lineRows)];
            $lineValues = [new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_NUMBER, $sheetTitle.'!$H$2:$H$'.($lineRows + 1), null, $lineRows)];

            $lineSeries = new DataSeries(DataSeries::TYPE_LINECHART, DataSeries::GROUPING_STANDARD, range(0, count($lineValues) - 1), $lineLabels, $lineCategories, $lineValues);
            $xAxisLine = new Axis;
            $yAxisLine = new Axis;
            $lineChart = new Chart('lineSpecific', new Title('Evolución Diaria de Asistentes'), new Legend(Legend::POSITION_TOP, null, false), new PlotArea(null, [$lineSeries]), true, 'gap', null, null, $xAxisLine, $yAxisLine);
            $lineChart->setTopLeftPosition('A'.($rowNum + 3));
            $lineChart->setBottomRightPosition('E'.($rowNum + 18));
            $sheet->addChart($lineChart);
        }

        // Torta de avance vs meta de la actividad
        $metaActividad = (int) $event->goal_people;
        $avanceHistoricoActividad = (int) SubEvent::where('event_id', $event->id)
            ->where('event_date', '<=', $range['end'])
            ->sum('attendees_count');
        $faltanteActividad = max(0, $metaActividad - $avanceHistoricoActividad);

        $sheet->setCellValueExplicit('J1', 'Estado', DataType::TYPE_STRING);
        $sheet->setCellValueExplicit('K1', 'Personas', DataType::TYPE_STRING);
        $sheet->setCellValueExplicit('J2', 'Avance Realizado', DataType::TYPE_STRING);
        $sheet->setCellValueExplicit('K2', (int) $avanceHistoricoActividad, DataType::TYPE_NUMERIC);
        $sheet->setCellValueExplicit('J3', 'Meta Faltante', DataType::TYPE_STRING);
        $sheet->setCellValueExplicit('K3', (int) $faltanteActividad, DataType::TYPE_NUMERIC);

        $pieLabels = [new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_STRING, $sheetTitle.'!$K$1', null, 1)];
        $pieCategories = [new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_STRING, $sheetTitle.'!$J$2:$J$3', null, 2)];
        $pieValues = [new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_NUMBER, $sheetTitle.'!$K$2:$K$3', null, 2)];

        $pieSeries = new DataSeries(DataSeries::TYPE_PIECHART, null, range(0, 0), $pieLabels, $pieCategories, $pieValues);
        $pieChart = new Chart('pieSpecific', new Title('Meta: Avance vs Faltante'), new Legend(Legend::POSITION_BOTTOM, null, false), new PlotArea(null, [$pieSeries]), true, 'gap');
        $pieChart->setTopLeftPosition('F'.($rowNum + 3));
        $pieChart->setBottomRightPosition('J'.($rowNum + 18));
        $sheet->addChart($pieChart);

        // --- DESCARGA ---
        $fileName = 'reporte-actividad-'.$event->event_code.'-'.$range['start']->format('Y-m-d').'_'.$range['end']->format('Y-m-d').'.xlsx';

        return $this->stream($spreadsheet, $fileName);
    }

    /**
     * Envía el libro como descarga en streaming (evita cargar el .xlsx completo
     * en memoria) con los gráficos nativos incluidos.
     */
    private function stream(Spreadsheet $spreadsheet, string $fileName): StreamedResponse
    {
        $writer = new Xlsx($spreadsheet);
        $writer->setIncludeCharts(true);

        $response = new StreamedResponse(function () use ($writer) {
            $writer->save('php://output');
        });

        $response->headers->set('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $response->headers->set('Content-Disposition', 'attachment; filename="'.urlencode($fileName).'"');
        $response->headers->set('Cache-Control', 'max-age=0');

        return $response;
    }

    /**
     * Descripción legible del rango, para la portada de cada hoja del libro.
     *
     * @param  array{start: Carbon, end: Carbon}  $range
     */
    private function periodLabel(string $period, array $range): string
    {
        $meses = [1 => 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
            'Julio', 'Agosto', 'Setiembre', 'Octubre', 'Noviembre', 'Diciembre'];

        $inicio = $range['start'];
        $fin = $range['end'];

        return match ($period) {
            'day' => 'Día '.$inicio->format('d/m/Y'),
            'week' => 'Semana del '.$inicio->format('d/m/Y').' al '.$fin->format('d/m/Y'),
            'month' => 'Mes de '.$meses[(int) $inicio->month].' de '.$inicio->year,
            'quarter' => 'Trimestre '.$meses[(int) $inicio->month].' – '.$meses[(int) $fin->month].' de '.$inicio->year,
            'year' => 'Año fiscal '.$inicio->year,
            default => $inicio->format('d/m/Y').' – '.$fin->format('d/m/Y'),
        };
    }

    private function getDateRange(string $period, Carbon $date): array
    {
        switch ($period) {
            case 'day':
                return ['start' => $date->copy()->startOfDay(), 'end' => $date->copy()->endOfDay()];
            case 'week':
                return ['start' => $date->copy()->startOfWeek(), 'end' => $date->copy()->endOfWeek()];
            case 'month':
                return ['start' => $date->copy()->startOfMonth(), 'end' => $date->copy()->endOfMonth()];
            case 'quarter':
                $quarter = ceil($date->month / 3);
                $startMonth = ($quarter - 1) * 3 + 1;

                return [
                    'start' => Carbon::create($date->year, $startMonth, 1)->startOfDay(),
                    'end' => Carbon::create($date->year, $startMonth + 2, 1)->endOfMonth()->endOfDay(),
                ];
            case 'year':
                return [
                    'start' => Carbon::create($date->year, 1, 1)->startOfDay(),
                    'end' => Carbon::create($date->year, 12, 31)->endOfDay(),
                ];
            default:
                return ['start' => $date->copy()->startOfDay(), 'end' => $date->copy()->endOfDay()];
        }
    }
}
