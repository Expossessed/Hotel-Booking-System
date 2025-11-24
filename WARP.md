# WARP.md

This file provides guidance to WARP (warp.dev) when working with code in this repository.

## Development commands

### PHP & Node dependencies
- Install PHP dependencies: `composer install`
- Install Node dependencies: `npm install`
- One-time project setup (installs deps, copies `.env`, generates app key, runs migrations, builds assets): `composer setup`

### Running the application in development
- Full dev stack (PHP HTTP server, queue listener, Vite dev server) via Composer script:
  - `composer dev`
  - This uses `npx concurrently` to run `php artisan serve`, `php artisan queue:listen --tries=1`, and `npm run dev` together.

### Database migrations & seeding
- Run pending migrations: `php artisan migrate`
- Roll back the last migration batch: `php artisan migrate:rollback`
- Seed the database (if you add/enable seeders under `database/seeders`): `php artisan db:seed`

### Building frontend assets
- Production build of assets: `npm run build`

### Testing
- Run the full test suite (preferred): `composer test`
  - This clears the config cache and runs `php artisan test` using the in-memory SQLite configuration from `phpunit.xml`.
- Run tests directly via Artisan: `php artisan test`
- Run a single test class or method, e.g. `ProfileTest` feature tests:
  - By class name: `php artisan test --filter=ProfileTest`
  - By file path: `php artisan test tests/Feature/ProfileTest.php`

### Linting & formatting
- PHP style linting with Laravel Pint (installed as a dev dependency):
  - `./vendor/bin/pint`
  - Or via PHP explicitly: `php ./vendor/bin/pint`

## Architecture overview

### Framework & stack
- This is a Laravel 12 application (PHP ^8.2) with Laravel Breeze for auth scaffolding and a Vite-based frontend build using Tailwind CSS, Alpine.js, and Axios.
- The backend is a conventional Laravel monolith: HTTP entrypoint at `public/index.php`, service container and configuration under `config/`, and environment configuration via `.env`.

### HTTP routing & middleware
- Primary web routes are defined in `routes/web.php`, with additional auth routes in `routes/auth.php`.
- Authenticated routes use the standard `auth` and `verified` middleware for the `/dashboard` and `/profile` flows.
- An `AdminMiddleware` exists under `app/Http/Middleware/AdminMiddleware.php` and is used via the `admin` middleware alias (registered in `bootstrap/app.php`) to guard admin-only areas such as `/admin/home`.

### Controllers and domain boundaries
- Core HTTP controllers live under `app/Http/Controllers/`:
  - `RoomsController` handles CRUD for rooms and user-facing room browsing.
  - `BookingController` handles booking creation and related views.
  - `ProfileController` and `App\Http\Controllers\Auth\*` are the standard Breeze/Laravel account and authentication controllers.

### Persistence & models
- Eloquent models live in `app/Models/`:
  - `User` is the standard auth model with an additional `role` column used for admin checks.
  - `Rooms` represents a hotel room type; the primary key is `room_id`. The corresponding migration `2025_11_19_120543_create_rooms_table.php` defines:
    - `room_id` (auto-increment integer primary key), `room_type`, `room_desc`, `room_price`, `available_rooms`, `is_available`.
  - `Booking` represents a reservation between a user (`booker_id`) and a room (`room_id`) and uses soft deletes. Its migration `2025_11_19_121619_create_bookings_table.php` sets up foreign keys to `users` and `rooms` and stores `book_date`, `end_date`, `room_price`, and `num_days`.
  - `Transactions` records payment-related data for a booking: `booker_id`, `room_id`, `price_paid`, `book_date`, `end_date`.
- The `Booking`, `Rooms`, and `User` models, as well as the `bookings` and `transactions` migrations, currently have active Git conflict markers and slightly divergent schemas/relationships between branches (e.g. price field naming and foreign-key targets). Any schema or model changes should start by reconciling these to a single, consistent data model.

### Views & frontend
- Blade templates live under `resources/views/` and follow a simple separation:
  - `resources/views/admin/*` for admin-facing room management screens (listing, detail, update, delete).
  - `resources/views/user/*` for customer-facing pages (home with room listings, room detail, booking-related views).
  - `resources/views/Booking/*` for booking forms, confirmation/preview, and post-booking pages.
  - `resources/views/layouts/*` and `resources/views/components/*` contain the shared layouts and UI components from Breeze/Tailwind.
- Frontend assets are organized as:
  - CSS entry: `resources/css/app.css` with Tailwind and DaisyUI configuration in `tailwind.config.js`.
  - JS entry: `resources/js/app.js` and `resources/js/bootstrap.js`, built by Vite (`vite.config.js`) with the `laravel-vite-plugin`.

### Testing layout
- PHPUnit is configured via `phpunit.xml` to:
  - Run tests under `tests/Unit` and `tests/Feature`.
  - Use an in-memory SQLite database for tests, with `DB_CONNECTION=sqlite` and `DB_DATABASE=:memory:`.
- Feature tests (e.g. `tests/Feature/ProfileTest.php`) rely on model factories under `database/factories` and `RefreshDatabase`. When adding new HTTP flows, prefer creating feature tests in `tests/Feature` that exercise full request/response cycles.

### README and external docs
- `README.md` is the stock Laravel skeleton README and does not contain project-specific instructions. For general framework behavior (routing, Eloquent, queues, etc.), refer to the official Laravel documentation linked from that file.
