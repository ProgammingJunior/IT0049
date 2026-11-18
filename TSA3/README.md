# TSA3 · Tasks for Today

Laravel 12 task manager with Eloquent, migrations, a seeder, and four distinct Blade pages.

## Requirements

- PHP 8.2+ with PDO SQLite enabled
- Composer

## Run locally

~~~powershell
composer install
Copy-Item .env.example .env
php artisan key:generate
New-Item -ItemType File -Path database/database.sqlite -Force
php artisan migrate --seed
php artisan serve --port=8013
~~~

Open http://127.0.0.1:8013. SQLite is the default database; database/tasks_tsa3.sql is also included as a MySQL export.

## Pages

- / — Welcome page with only today's tasks
- /tasks — all tasks ordered by date
- /profile — the single seeded user
- /about — static project information

TaskSeeder creates eight tasks on yesterday, today, and tomorrow and exactly one user.
