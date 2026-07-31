# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project

A Laravel 13 / PHP 8.3 dashboard and public portal for a Peruvian regional labor & employment agency (GRTPE Puno). Domain language, comments, UI text, and validation messages are in **Spanish** — match that when editing views, flash messages, and validation.

Two distinct audiences share one app:
- **Public portal** (no auth) — the `/` landing page (`welcome.blade.php` via `PublicViewerController@index`), static institutional pages under `resources/views/portal/*` wired as `Route::view(...)`, dedicated `talleres-capacitaciones`/`coordinaciones-institucionales` pages, and dynamic per-branch pages at `/zonas-desconcentradas/{slug}`.
- **Internal intranet** (`auth` middleware) — CRUD for events/sub-events, categories, Excel reports, bulletins, announcements, workshops, coordinations, photo reports, per-branch activities, and (admin-only) sede-operator management.

## Commands

```bash
composer dev          # Run everything: php serve + queue listener + pail logs + vite (concurrently)
npm run dev           # Vite dev server only
npm run build         # Production asset build
php artisan test      # Run test suite (or: composer test — clears config first)
php artisan test --filter=ProfileTest          # Single test class
php artisan test tests/Feature/Auth/LoginTest.php   # Single file
./vendor/bin/pint     # Format PHP (Laravel Pint) — run before committing PHP changes
php artisan migrate   # Apply migrations
```

Tests run on in-memory SQLite (see `phpunit.xml`) regardless of the dev DB.

## Database caveat (important)

`.env.example` ships `DB_CONNECTION=sqlite`, but the working dev DB is **MySQL** (`DB_CONNECTION=mysql`, `DB_DATABASE=test`). Some queries use MySQL-only SQL — e.g. the `/dashboard` route and monthly report grouping use `DATE_FORMAT(event_date, '%Y-%m')`. Code that must run under both the SQLite test suite and MySQL dev DB needs portable SQL or it will break in one of them.

## Multi-sede authorization model (core architecture)

Users have custom columns beyond Breeze defaults: `role` (`admin` | `director` | `user`), `sede`, plus `username`, `dni`, and `is_active`. This drives tenant-style isolation that is enforced **in application code, not middleware/policies**:

- Login is by **`username`**, not email (`LoginRequest`, Breeze-based scaffolding).
- **`Announcement::SEDES_DESCONCENTRADAS`** (`['juliaca', 'taraco']`) is the single source of truth for which sedes are branch offices. Any other sede — `puno` or `null` — counts as **Sede Central / global**. Use this constant; don't hard-code sede lists.
- `/dashboard` intercepts branch users — the actual gate is `role !== 'admin' && in_array($sede, SEDES_DESCONCENTRADAS)` (so a `director` of a branch is redirected too) — and sends them to `branch-activities.index`; they never see global analytics.
- `BranchActivityController` scopes every action by sede: admins see all rows; sede users see only `where('sede', $user->sede)`. `edit`/`update`/`destroy` re-check ownership and `abort(403)` on cross-sede access. On `store`, `sede` is always taken from `auth()->user()->sede`, never from request input.
- New branch activities inherit `user_id` and `sede` from the session — do not accept these from the form.
- `UserController` (routes `users.index`/`users.create`/`users.store`/`users.toggle`) is **admin-only**, guarded by a private `authorizeAdmin()` `abort(403)` — the same in-code gating pattern. It creates operators, assigns a sede, and toggles `is_active`.

When adding features touched by sede users, replicate this per-action ownership check; there is no central gate.

## Domain model & conventions

- **Event → SubEvent**: `Event` is a planned activity with a target (`goal_people`); `SubEvent` records actual progress (`attendees_count`, `event_date`). Global progress = `SUM(subEvents.attendees_count) / SUM(events.goal_people)`. `Event` has `getActualProgressAttribute`/`getProgressPercentageAttribute` accessors.
- **Photos as JSON**: `SubEvent.photos`/`photo_priority` and `BranchActivity.photos` are stored as JSON arrays (BranchActivity uses a `'photos' => 'array'` cast; SubEvent decodes manually in `PublicViewerController`). Files are uploaded to `storage/app/public/...` via `$photo->store(..., 'public')` — requires `php artisan storage:link`. On update/delete, old files are removed with `Storage::disk('public')->delete()`.
- **Soft deletes + custom trash**: Models use `SoftDeletes`. There's a hand-rolled "papelera" (`TrashController`, `/papelera`) plus per-resource `trashed`/`restore`/`force-delete` routes layered on top of the standard `Route::resource`.
- **Model attributes**: newer models (`User`, `BranchActivity`) use PHP-attribute syntax `#[Fillable([...])]` / `#[Hidden([...])]`; older ones (`Event`) use `protected $fillable`. Follow the style of the file you're editing.
- **Excel reports**: `ReportController` + `app/Exports/*` use `maatwebsite/excel` and raw `PhpSpreadsheet` (including native charts) to stream `.xlsx` day/period/specific reports.
- **Workshops (two-phase lifecycle)**: `Workshop` has `status` `programado` ⇄ `ejecutado` with `programados()`/`ejecutados()` scopes. There are two entry points — schedule-then-execute (`create`/`edit`, transition via `mark_executed`) and direct executed record (`create-executed`/`storeExecuted`). `WorkshopController::syncAnnouncement()` auto-creates/updates/deletes a linked **institutional** `Announcement` (`sede = null`) when `publish_as_announcement` is set, tracked via `Workshop.announcement_id`.
- **Announcements (sede scoping)**: `Announcement` carries its own `sede` column (target audience, distinct from the author). Scopes `bySede`/`globalPrincipal`/`visibleForSede` enforce that a branch portal sees **its own + institutional (`sede = null`)** announcements but never another branch's. `sede`/`LOWER(sede)` comparisons are case-insensitive on purpose (binary collation). `sede = null` renders as "Sede Central".
- **Coordinations & photo reports**: `Coordination` and `PhotoReport` are simple photo-gallery modules (`'photos' => 'array'` JSON). Note the photo-update convention differs across modules: `BranchActivity` **replaces** all photos when new ones are uploaded, while `Coordination` and `Workshop` **accumulate** onto the existing array — match the module you're editing.

## Route conventions

`routes/web.php` is split into a public block and an `auth`-middleware block. Custom verb routes (`trashed`, `restore`, `force-delete`, `workshops/create-executed`, `users/toggle`) must be declared **before** the matching `Route::resource(...)` so the resource's wildcard (`{id}`) doesn't swallow them — the file has explicit comments where this matters.

## Frontend

Blade + Alpine.js + Tailwind CSS v3, bundled by Vite (`resources/js/app.js`, `resources/css/app.css`). Chart.js powers the `/dashboard` analytics (data pre-shaped server-side into `chartBar`, `catData`, `monthly` collections). No SPA framework.
