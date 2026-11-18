# TFA8 · Resource Controllers and Authentication

TFA8 continues the TFA7 POS app. Customer and user management uses Laravel resource controllers protected by Breeze. The landing and About pages remain public.

## Requirements

- PHP 8.2+ with PDO SQLite and GD enabled
- Composer
- Node.js 20+ and npm

## Run locally

~~~powershell
composer install
Copy-Item .env.example .env
php artisan key:generate
New-Item -ItemType File -Path database/database.sqlite -Force
php artisan migrate --seed
php artisan storage:link
npm.cmd install
npm.cmd run build
php artisan serve --port=8008
~~~

Open http://127.0.0.1:8008. SQLite is the default database. Avatar upload validation, resizing, and storage continue from TFA7.

## Demo account

- Email: admin@example.com
- Password: Daymark123!

Five team accounts and five customers are seeded. You can also register a new account. Customer and user resource routes require authentication; /, /about, /login, and /register are public.

Signed out, /customers and /users redirect to /login. A logged-in user can use all account CRUD pages. The account currently signed in cannot be deleted.
