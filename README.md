# Readme.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project

A Laravel 13 / PHP 8.3 dashboard and public portal for a Peruvian regional labor & employment agency (GRTPE / DRTPE Puno), plus a **separate Python FastAPI RAG chatbot** service under `chatbot/`. Domain language, comments, UI text, and validation messages are in **Spanish** — match that when editing views, flash messages, and validation.

Two distinct audiences share the Laravel app:
- **Public portal** (no auth) — the `/` landing page (`welcome.blade.php` via `PublicViewerController@index`), static institutional pages under `resources/views/portal/*` wired as `Route::view(...)`, dedicated `talleres-capacitaciones`/`coordinaciones-institucionales` pages, and dynamic per-branch pages at `/zonas-desconcentradas/{slug}`.
- **Internal intranet** (`auth` middleware) — CRUD for events/sub-events, categories, Excel reports, bulletins, announcements, workshops, coordinations, photo reports, per-branch activities, and (admin-only) sede-operator management.

## Commands

```bash
composer dev          # Run everything: php serve + queue listener + pail logs + vite (concurrently)
npm run dev           # Vite dev server only
npm run build         # Production asset build (intranet only — see Frontend)
php artisan test      # Run test suite (or: composer test — clears config first)
php artisan test --filter=ProfileTest          # Single test class
php artisan test tests/Feature/Auth/LoginTest.php   # Single file
./vendor/bin/pint     # Format PHP (Laravel Pint) — run before committing PHP changes
php artisan migrate   # Apply migrations (⚠️ hits the shared remote DB — see below)
```

Tests run on in-memory SQLite (see `phpunit.xml`) regardless of the dev DB.

**Test coverage is stock Breeze only** — `tests/` contains just the scaffolded auth tests plus `ProfileTest` and two `ExampleTest`s. None of the domain modules (events, sub-events, announcements, workshops, branch activities, reports) have tests. Do not assume a passing suite validates a domain change.

## Database caveat (important)

`.env.example` ships `DB_CONNECTION=sqlite`, but the working dev DB is a **remote TiDB Cloud instance** (MySQL-compatible): `DB_CONNECTION=mysql`, `DB_HOST=gateway01.us-east-1.prod.aws.tidbcloud.com`, `DB_PORT=4000`, `DB_DATABASE=test`. Two consequences:

- **Migrations and destructive artisan commands hit shared remote data**, not a local throwaway DB. Treat `migrate:fresh`/`migrate:rollback` as destructive.
- TiDB's collation here is **binary (`utf8mb4_bin`)**, so string comparison is case-sensitive. This is why `Announcement` scopes use `whereRaw('LOWER(sede) = ?')` instead of a plain `where` — that lowercasing is deliberate, don't "simplify" it away.

Some queries are MySQL-only — e.g. the `/dashboard` route and monthly report grouping use `DATE_FORMAT(event_date, '%Y-%m')`. Code that must run under both the SQLite test suite and the MySQL/TiDB dev DB needs portable SQL or it will break in one of them.

## Multi-sede authorization model (core architecture)

Users have custom columns beyond Breeze defaults: `role` (`admin` | `director` | `user`), `sede`, plus `username`, `dni`, and `is_active`. This drives tenant-style isolation that is enforced **in application code, not middleware/policies**:

- Login is by **`username`**, not email (`LoginRequest`, Breeze-based scaffolding). `LoginRequest::authenticate()` also logs out and rejects any user with `is_active === false` *after* a successful `Auth::attempt` — deactivation is enforced at login only, not per-request.
- **`Announcement::SEDES_DESCONCENTRADAS`** (`['juliaca', 'taraco']`) is the single source of truth for which sedes are branch offices. Any other sede — `puno` or `null` — counts as **Sede Central / global**. Use this constant; don't hard-code sede lists. `PublicViewerController@showSede` also uses it to 404 unknown slugs.
- `/dashboard` intercepts branch users — the actual gate is `role !== 'admin' && in_array($sede, SEDES_DESCONCENTRADAS)` (so a `director` of a branch is redirected too) — and sends them to `branch-activities.index`; they never see global analytics.
- `BranchActivityController` scopes every action by sede: admins see all rows; sede users see only `where('sede', $user->sede)`. `edit`/`update`/`destroy` re-check ownership and `abort(403)` on cross-sede access. On `store`, `sede` is always taken from `auth()->user()->sede`, never from request input.
- New branch activities inherit `user_id` and `sede` from the session — do not accept these from the form.
- `UserController` (routes `users.index`/`users.create`/`users.store`/`users.toggle`) is **admin-only**, guarded by a private `authorizeAdmin()` `abort(403)` — the same in-code gating pattern. It creates operators, assigns a sede, and toggles `is_active`.

When adding features touched by sede users, replicate this per-action ownership check; there is no central gate.

## Domain model & conventions

- **Event → SubEvent**: `Event` is a planned activity with a target (`goal_people`); `SubEvent` records actual progress (`attendees_count`, `event_date`). Global progress = `SUM(subEvents.attendees_count) / SUM(events.goal_people)`. `Event` has `getActualProgressAttribute`/`getProgressPercentageAttribute` accessors.
- **Photos as JSON**: `SubEvent.photos`/`photo_priority` and `BranchActivity.photos` are stored as JSON arrays (BranchActivity uses a `'photos' => 'array'` cast; SubEvent decodes manually in `PublicViewerController`). Files are uploaded to `storage/app/public/...` via `$photo->store(..., 'public')` — requires `php artisan storage:link`. On update/delete, old files are removed with `Storage::disk('public')->delete()`.
- **Soft deletes + custom trash**: Models use `SoftDeletes`. There's a hand-rolled "papelera" (`TrashController`, `/papelera`) plus per-resource `trashed`/`restore`/`force-delete` routes layered on top of the standard `Route::resource`.
- **Model attributes**: newer models (`User`, `BranchActivity`) use PHP-attribute syntax `#[Fillable([...])]` / `#[Hidden([...])]`; older ones (`Event`, `Announcement`) use `protected $fillable`. Follow the style of the file you're editing.
- **Server-side view normalization**: `PublicViewerController` has private `mapActivities()`/`mapAnnouncements()`, and models expose `toPublicArray()`/`toRepositoryArray()` that flatten records (resolving `asset('storage/...')` URLs, PDF-vs-image flags, formatted dates) before they reach Blade. Alpine.js consumes those flat arrays — **shape data in PHP, not in the view**. Note `mapActivities` renames the DB column `type` to the front-end key `intervention_type`, and `mapAnnouncements` synthesizes `content`/`is_urgent`, which are not real columns.
- **Excel reports**: `ReportController` + `app/Exports/*` use `maatwebsite/excel` and raw `PhpSpreadsheet` (including native charts) to stream `.xlsx` day/period/specific reports.
- **Workshops (two-phase lifecycle)**: `Workshop` has `status` `programado` ⇄ `ejecutado` with `programados()`/`ejecutados()` scopes. There are two entry points — schedule-then-execute (`create`/`edit`, transition via `mark_executed`) and direct executed record (`create-executed`/`storeExecuted`). `WorkshopController::syncAnnouncement()` auto-creates/updates/deletes a linked **institutional** `Announcement` (`sede = null`) when `publish_as_announcement` is set, tracked via `Workshop.announcement_id`.
- **Announcements (sede scoping)**: `Announcement` carries its own `sede` column (target audience, distinct from the author). `sede = null` means institutional / Sede Central and renders as "Sede Central" via the appended `sede_label` accessor. **Which scope applies depends on the surface — they deliberately differ:**

  | Surface | Scope | Shows |
  |---|---|---|
  | Public sede page (`PublicViewerController@showSede`) | `bySede($slug)` | **only that sede's own** — institutional ones have their own slot on the portada |
  | Intranet branch panel (`BranchActivityController@index`) | `visibleForSede($sede)` | own **+** institutional, institutional first |
  | Intranet listing (`AnnouncementController`) | `bySede($user->sede)` | own only |

  No surface ever shows another branch's announcements. The scopes use `whereRaw('LOWER(sede) = ?')` because TiDB's collation is binary — don't "simplify" that away.

  On the portada the two announcement areas are fed by **different** collections: the welcome pop-up (`partials/popup`) gets `$comunicadosActivos` — every active announcement ordered Sede Central → Juliaca → Taraco — while the bottom board in `welcome.blade.php` gets `$comunicadosCentral`, which is Sede Central's own section. Changing one without the other silently merges the two audiences.
- **Coordinations & photo reports**: `Coordination` and `PhotoReport` are simple photo-gallery modules (`'photos' => 'array'` JSON). Note the photo-update convention differs across modules: `BranchActivity` **replaces** all photos when new ones are uploaded, while `Coordination` and `Workshop` **accumulate** onto the existing array — match the module you're editing.

## Video embeds (difusión audiovisual)

Public video links (YouTube / Facebook / TikTok) attached to the four publishable modules and rendered as **in-page iframes** on the portal — never as outbound links.

- **Only the raw URL is persisted.** A `videos` JSON column (same convention as `photos`) added by `2026_08_01_100000_add_videos_to_publishable_tables.php` to `sub_events`, `workshops`, `coordinations`, `branch_activities`. Everything derived — provider, embed URL, thumbnail, orientation — is resolved at **read time** by `App\Support\VideoEmbed`, so changing embed rules never requires a data migration.
- **`HasVideos`** (`app/Models/Concerns/HasVideos.php`) gives `videoLinks()` / `videoEmbeds()` plus `has_videos` / `videos_count` accessors to `SubEvent`, `Workshop`, `Coordination`, `BranchActivity`. `SubEvent` overrides `videoLinks()` to merge its legacy single-link `youtube_url` column.
- **Write path**: `App\Rules\SupportedVideoUrl` validates (empty values pass — the repeater always submits a blank row), then `VideoEmbed::sanitize()` trims, drops unsupported hosts, **expands short links over the network** (`vm./vt.tiktok.com`, `tiktok.com/t/`, `fb.watch`, `fb.me`, `youtu.be`), dedupes preserving order, and caps at `MAX_PER_RECORD` (6). Because the form is pre-filled with the current links, saving **replaces** the whole set.
- **TikTok embed URL must be `https://www.tiktok.com/embed/v2/{id}`** with the id in the *path*. The `?url=<encoded>` form returns **HTTP 400** — don't "fix" it that way. `lang`/`embedFrom` params mirror TikTok's official embed script.
- TikTok intermittently answers with a black `overload-protect triggered` screen — **transient per-IP throttling, not a code fault**. It cannot be detected from the parent page: the iframe *loads successfully*, and its content is cross-origin.
- `InstitutionalReportBook` counts `videoEmbeds()` per module, so the Excel report tallies difusión alongside attendance.

### The `@once`-inside-`<template>` trap

`x-video-player-assets` (the player CSS + `public/js/video-player.js` tag) is emitted from **`partials/head.blade.php`**, not from the galleries that need it. This is deliberate and load-bearing:

`x-video-gallery` / `x-video-gallery-live` are used at points that sit **inside Alpine `<template>` blocks** on the portal. A browser treats `<template>` content as inert — CSS never applies and scripts never run. Since the component is wrapped in `@once`, the first render *inside* a template consumed it and every later call became a no-op, so the player silently died portal-wide. Emitting from `<head>` guarantees it lands outside any template; the in-component calls still cover intranet layouts, which don't include `partials/head`. **Do not move it back into the components.**

Frames rendered server-side carry `data-embed`; Alpine-driven frames (`x-video-gallery-live`) don't, and `video-player.js` skips them so Alpine keeps ownership of nodes it created.

## Module reference

Every publishable module follows the same shape — controller validates, files land in `storage/app/public/<folder>`, JSON columns hold `photos`/`videos`, and the portal reads it back through a mapper. The differences are what bite:

| Module | Controller | Required on store | File rules | Photos on update | Publishes to |
|---|---|---|---|---|---|
| Sub-events | `SubEventController` | `event_id`, `report_title`, `event_date`, `attendees_count` (min 1) | photos optional | reorder via `photo_order`/`photo_priority` | Cronología, portada carousels |
| Workshops (programado) | `WorkshopController@store` | `title`, `type` (`taller\|capacitacion`), `description`, `scheduled_date`, **`flyer` required** | flyer + attachments: `pdf,jpeg,png,jpg,webp`, max 10 MB, ≤6 attachments | **accumulate** | Talleres |
| Workshops (ejecutado) | `WorkshopController@storeExecuted` | `title`, `type`, `description`, `executed_date` | same | **accumulate** | Talleres |
| Coordinations | `CoordinationController` | `title`, `coordination_date`, `description`, **`photos` min 1** | images | **accumulate** (`photos` nullable on update) | Coordinaciones |
| Branch activities | `BranchActivityController` | `title`, `intervention_type` (`feria\|capacitacion\|asesoria`), `description`, **`photos` min 1** | images | **replace** | `/zonas-desconcentradas/{slug}` |
| Announcements | `AnnouncementController` | `title`, **`file` required**, `published_at`, `expired_at` (`after_or_equal`) | `pdf,jpeg,png,jpg,webp`, max 10 MB, ≤6 attachments; `removed_attachments` on update | n/a | Tablón + noticias |

`videos` is uniformly `nullable|array|max:VideoEmbed::MAX_PER_RECORD` with `SupportedVideoUrl` on each element.

Two asymmetries worth repeating because they cause data loss:
- **Photos replace on `BranchActivity`, accumulate on `Workshop`/`Coordination`.** Match the module you're editing.
- **`photos` is required on create but optional on update** for `Coordination` — a create path that mirrors update will reject valid input.

## Deployment / first run

```bash
composer install && npm install
cp .env.example .env && php artisan key:generate   # then set the real DB creds — see the DB caveat
php artisan storage:link                            # REQUIRED: without it every uploaded photo 404s
npm run build                                       # intranet assets only
```

Then, separately, the chatbot (see its section) on port 8001.

Checklist when something looks broken after a fresh clone:
- Images 404 → `php artisan storage:link` was never run.
- Portal styling intact but intranet unstyled → `npm run build` missing (`public/build` is gitignored).
- Dashboard 500s on SQLite → `DATE_FORMAT` is MySQL-only; the dev DB must be the MySQL/TiDB one.
- Portal player dead → see the `@once` trap under *Video embeds*.

## Route conventions

`routes/web.php` is split into a public block and an `auth`-middleware block. Custom verb routes (`trashed`, `restore`, `force-delete`, `workshops/create-executed`, `users/toggle`) must be declared **before** the matching `Route::resource(...)` so the resource's wildcard (`{id}`) doesn't swallow them — the file has explicit comments where this matters.

## Frontend — two separate asset pipelines

Easy to get wrong: **the public portal and the intranet load their CSS/JS by completely different mechanisms.**

- **Intranet** (`layouts/app.blade.php` → `x-app-layout`, and `components/branch-layout.blade.php` → `x-branch-layout`) uses `@vite(['resources/css/app.css', 'resources/js/app.js'])` — bundled Tailwind v3 + Alpine. `npm run build` / `npm run dev` affects **only these pages**.
- **Public portal** (`welcome.blade.php` and `layouts/portal.blade.php`, both via `@include('partials.head')`) pulls **Tailwind and Alpine from CDN** (`cdn.tailwindcss.com`, jsdelivr Alpine) and never calls `@vite`. Editing `tailwind.config.js` or `resources/css/app.css` has **no effect** on the portal; the CDN build ignores the local config, so custom theme values and plugins aren't available there.

Three layout shells exist: `x-app-layout` (Sede Central intranet), `x-branch-layout` (branch-office intranet — a self-contained document with its own sidebar), and `layouts.portal` + `partials/*` (public). Pick the one matching the audience.

Two portal scripts bypass Vite entirely and are served straight from `public/`: `js/chatbot.js` and `js/video-player.js` (the latter cache-busted with `filemtime`). Edit those files directly — `npm run build` has no effect on them. If portal CSS or JS from a Blade component silently fails to apply, check whether it's being emitted inside an Alpine `<template>` — see the `@once` trap under *Video embeds*.

Tailwind is **v3** (classic `@tailwind` directives + `tailwind.config.js` + PostCSS). `@tailwindcss/vite` v4 sits in `devDependencies` but is *not* wired into `vite.config.js` — ignore it; the v3 config is authoritative.

Chart.js powers the `/dashboard` analytics (data pre-shaped server-side into `chartBar`, `catData`, `monthly` collections). No SPA framework.

`vite.config.js` pins `server.host`/`hmr.host` to `localhost` (IPv4) on purpose — without it Vite writes an IPv6 hot-file marker and the dashboard reloads in a loop.

## RAG chatbot (`chatbot/`) — separate Python service

An independent **FastAPI + ChromaDB + Gemini** service; it is *not* part of the Laravel app, shares no database, and must be run separately. `chatbot/README.md` is empty — this section is the documentation.

```bash
cd chatbot/backend
pip install -r requirements.txt
python -m scripts.index_docs              # (Re)build the ChromaDB index from data/
uvicorn app.main:app --reload --port 8001 # Must be port 8001 — the widget hard-codes it
```

Architecture:
- `app/main.py` — FastAPI app, permissive CORS (`allow_origins` ends with `"*"` — restrict before production), mounts `/chat`, `/contact`, `/health`.
- `app/rag/rag_chain.py` — the core. Per-request flow: greeting short-circuit → **Gemini-based question reformulation** (spelling, acronym uppercasing, abbreviation expansion) → **hybrid retrieval** (vector search filtered by distance `< 0.65`, unioned with a weighted keyword/synonym search over up to 500 docs) → top-3 chunks into a Spanish prompt → answer. Falls back to model general knowledge for employability questions (CV/interviews) and to a fixed "visit the Puno office" message otherwise. Conversation history is kept **in-process in a dict keyed by `session_id`** — it does not survive a restart and won't work across multiple workers.
- `app/llm/` — `get_llm_provider()` currently always returns `GeminiDirectProvider` (`google-genai`). `groq_provider.py` and `ollama_provider.py` exist but are unwired.
- `app/rag/embeddings.py` — embeddings are **local** via `sentence-transformers` (`distiluse-base-multilingual-cased-v2`); only generation calls out to Gemini.
- Config comes from a `chatbot/backend/.env` (gitignored) read by `app/config.py`: `GOOGLE_API_KEY`, `GEMINI_MODEL`, `CHROMA_PERSIST_DIR`, `MAX_CONTEXT_CHUNKS`, `SIMILARITY_THRESHOLD`, `MAX_HISTORY_LENGTH`. A missing `GOOGLE_API_KEY` degrades to a canned error string rather than failing loudly.

Indexing caveats (`scripts/index_docs.py`): it indexes **every** `.md`/`.pdf`/`.docx`/`.txt` in `data/`, and `data/` currently holds both curated `.md` files *and* the original `.docx`/`.pdf` of the same content — so that content gets indexed several times over. `VectorStore.add_documents` also regenerates ids as `doc_0…doc_n` on every run, so re-running collides with existing ids instead of appending cleanly; delete the `chroma_db/` directory for a clean rebuild.

### Widget integration — the copy that matters

The chatbot UI is loaded by `welcome.blade.php` as plain static assets, **not** through Vite:

```blade
<link rel="stylesheet" href="{{ asset('css/chatbot.css') }}">
<script src="{{ asset('js/chatbot.js') }}"></script>
```

`public/js/chatbot.js` + `public/css/chatbot.css` are the **live, served files and the ones to edit**. `chatbot/frontend/widget.js`/`widget.css` are an older, diverged standalone copy (282 vs 439 lines) — changes there have no effect on the site. Both hard-code `const API_BASE = 'http://localhost:8001'`, which must be changed for any non-local deployment.

## In-app user guides (`resources/manuals/`)

Two standalone HTML manuals are served to logged-in users from the bottom of each intranet sidebar:

| File | Route | Linked from |
|---|---|---|
| `manual-general.html` | `/guia` (`manual.general`) | `layouts/navigation.blade.php` (Sede Central) |
| `manual-sede.html` | `/guia/sede` (`manual.sede`) | `components/branch-layout.blade.php` (branch offices) |

- **`ManualController` returns the file with `file_get_contents`, not `view()`.** These are literal HTML documents whose CSS is full of `{`/`}` and `@media`; running them through Blade would corrupt them. They also stay out of `public/` on purpose — served through the `auth` group, they require a session.
- They are **self-contained** (no external fonts, scripts, or images) and carry `@media print` rules, so `Ctrl+P → Save as PDF` produces the deliverable. Keep them dependency-free.
- The Sede Central sidebar shows a second, admin-only text link to `/guia/sede` so admins can support branch operators.
- `docs/` holds PDF-export copies (`Manual_de_Uso_DRTPE_Puno.html`, `Guia_de_Sede_DRTPE_Puno.html`). **`resources/manuals/` is the canonical served copy** — edit there first, then copy across. Because `docs/` is gitignored, only the `resources/` copy is in the repo.
