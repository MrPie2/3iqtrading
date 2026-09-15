# 3IQTrading — Modern Laravel Admin Migration

This package is a Laravel 12 administration rewrite of the supplied `Manager` PHP application.

## What was migrated

- All **116 PHP files** from `Manager/` are catalogued in `config/admin_pages.php`.
- Every legacy PHP page/handler has a Laravel route under `/admin/modules/...` and a corresponding Blade entry in `resources/views/admin/modules/legacy/`.
- The original project files and assets are preserved under `storage/legacy-source/` so no source file is silently discarded.
- The old session-based login has been replaced by a Laravel controller with CSRF protection and session regeneration.
- Legacy plaintext admin passwords can be upgraded to Laravel `Hash` after a successful login.
- The dashboard has been redesigned in a modern Figma-style admin layout: fixed navigation, responsive cards, clean tables, badges, spacing, typography and mobile behavior.
- Database reads use Laravel's Query Builder/Schema APIs rather than `mysqli_*`.
- POST operations have a centralized Laravel endpoint with CSRF protection and logging.
- The legacy `pages` SQL definition is represented as a Laravel migration.
- Existing images, JavaScript, CSS and Mobirise/CKEditor assets are preserved.

## Important database note

The supplied archive did **not** contain `Connect.php`, the complete application database dump, or the schema for the many tables referenced by the old code. Because of that, an exact one-to-one business-logic rewrite of every SQL operation cannot be safely inferred without inventing columns, relationships and rules.

This migration therefore does two things safely:
1. converts the application structure and administration UI to Laravel;
2. keeps the original implementation in `storage/legacy-source/` and creates a database-aware module layer that works with tables that actually exist.

To complete a production-grade 1:1 feature migration, import the real database/schema and then map each module's legacy query to Eloquent/Query Builder models and Form Requests.

## Installation

Requirements: PHP 8.2+, Composer, MySQL/MariaDB.

```bash
composer install
cp .env.example .env
php artisan key:generate
```

Configure `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_user
DB_PASSWORD=your_password
```

Then:

```bash
php artisan migrate
php artisan serve
```

Open `/login`.

## cPanel

Point the domain/subdomain document root to:

`public/`

If your hosting cannot point the document root to `public`, use the hosting provider's Laravel deployment method rather than exposing the whole project directory.

## Legacy reconciliation

Use `storage/legacy-source/` as the authoritative copy of the supplied application. The migration manifest is `config/admin_pages.php`.

The intended next pass after the real DB schema is available is:

- create typed Eloquent models and relationships;
- move each legacy action into a dedicated service/controller method;
- add Form Requests and authorization policies;
- add transactions for balance/deposit/profit operations;
- add automated feature tests;
- replace old AJAX handlers with named Laravel routes;
- replace CKEditor/TextAngular legacy setup where appropriate;
- remove legacy source only after production parity is verified.

## Security improvements included

- Laravel CSRF protection on POST forms.
- Session regeneration after login.
- Session invalidation on logout.
- No password field is displayed by the modern data table.
- Query Builder/Schema instead of interpolated `mysqli` SQL in the new admin layer.
- Sensitive password values are excluded from operation logging.

Do not deploy until the actual production database schema and business rules have been tested against this migration.
