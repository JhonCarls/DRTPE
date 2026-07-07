# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project

A Laravel 13 / PHP 8.3 dashboard and public portal for a Peruvian regional labor & employment agency (GRTPE Puno). Domain language, comments, UI text, and validation messages are in **Spanish** — match that when editing views, flash messages, and validation.

Two distinct audiences share one app:
- **Public portal** (no auth) — the `/` landing page (`welcome.blade.php` via `PublicViewerController@index`), static institutional pages under `resources/views/portal/*` wired as `Route::view(...)`, and dynamic per-branch pages at `/zonas-desconcentradas/{slug}`.
- **Internal intranet** (`auth` middleware) — CRUD for events, categories, reports, bulletins, announcements, workshops, and branch activities.

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

Users have two custom columns beyond Breeze defaults: `role` (`admin` | `user`) and `sede` (e.g. `juliaca`, `taraco`). This drives tenant-style isolation that is enforced **in application code, not middleware/policies**:

- Login is by **`username`**, not email (`LoginRequest`, Breeze-based scaffolding).
- `/dashboard` intercepts sede operators (`role === 'user'` with a sede) and redirects them to `branch-activities.index` — they never see global analytics.
- `BranchActivityController` scopes every action by sede: admins see all rows; sede users see only `where('sede', $user->sede)`. `edit`/`update`/`destroy` re-check ownership and `abort(403)` on cross-sede access. On `store`, `sede` is always taken from `auth()->user()->sede`, never from request input.
- New branch activities inherit `user_id` and `sede` from the session — do not accept these from the form.

When adding features touched by sede users, replicate this per-action ownership check; there is no central gate.

## Domain model & conventions

- **Event → SubEvent**: `Event` is a planned activity with a target (`goal_people`); `SubEvent` records actual progress (`attendees_count`, `event_date`). Global progress = `SUM(subEvents.attendees_count) / SUM(events.goal_people)`. `Event` has `getActualProgressAttribute`/`getProgressPercentageAttribute` accessors.
- **Photos as JSON**: `SubEvent.photos`/`photo_priority` and `BranchActivity.photos` are stored as JSON arrays (BranchActivity uses a `'photos' => 'array'` cast; SubEvent decodes manually in `PublicViewerController`). Files are uploaded to `storage/app/public/...` via `$photo->store(..., 'public')` — requires `php artisan storage:link`. On update/delete, old files are removed with `Storage::disk('public')->delete()`.
- **Soft deletes + custom trash**: Models use `SoftDeletes`. There's a hand-rolled "papelera" (`TrashController`, `/papelera`) plus per-resource `trashed`/`restore`/`force-delete` routes layered on top of the standard `Route::resource`.
- **Model attributes**: newer models (`User`, `BranchActivity`) use PHP-attribute syntax `#[Fillable([...])]` / `#[Hidden([...])]`; older ones (`Event`) use `protected $fillable`. Follow the style of the file you're editing.
- **Excel reports**: `ReportController` + `app/Exports/*` use `maatwebsite/excel` and raw `PhpSpreadsheet` (including native charts) to stream `.xlsx` day/period/specific reports.

## Frontend

Blade + Alpine.js + Tailwind CSS v3, bundled by Vite (`resources/js/app.js`, `resources/css/app.css`). Chart.js powers the `/dashboard` analytics (data pre-shaped server-side into `chartBar`, `catData`, `monthly` collections). No SPA framework.
