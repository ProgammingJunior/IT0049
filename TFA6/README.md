# TFA6 · From Arrays to Eloquent

Laravel 12 POS directory. Customer and user pages use Eloquent, migrations, and a repeatable seeder. Fields match the TFA2 POS schema.

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
php artisan serve --port=8006
~~~

Open http://127.0.0.1:8006. SQLite gives a zero-configuration run; database/pos_tfa6.sql is also included as a MySQL export.

## Pages

- / — POS landing page
- /customers — Eloquent customer directory
- /users — Eloquent user directory
- /about — project information

PosSeeder adds five customers and five users. TFA7 continues with validated forms and prepared avatar uploads.
