# TFA5 · From Zero to Four Pages

A Laravel 12 POS foundation with four routes, separate controllers and Blade views, and static PHP arrays for the customer and user listings.

## Requirements

- PHP 8.2+ and Composer

## Run locally

~~~powershell
composer install
Copy-Item .env.example .env
php artisan key:generate
php artisan serve --port=8005
~~~

Open http://127.0.0.1:8005. No database is needed for the four pages. The copied migration, seeder, and database/pos_tfa5.sql are included as submission artifacts; the listing controllers intentionally use static arrays.

## Pages

- / — POS landing page
- /about — project information and developer
- /customers — five customers from a PHP array
- /users — five team accounts from a PHP array

TFA6 replaces the sample arrays with Eloquent models and seeded database records.
