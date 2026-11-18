# TFA7 · Making the POS Editable

Laravel 12 continues TFA6 with validated customer/user create and edit forms and prepared profile photos using Intervention Image.

## Requirements

- PHP 8.2+ with PDO SQLite and GD enabled
- Composer

## Run locally

~~~powershell
composer install
Copy-Item .env.example .env
php artisan key:generate
New-Item -ItemType File -Path database/database.sqlite -Force
php artisan migrate --seed
php artisan storage:link
php artisan serve --port=8007
~~~

Open http://127.0.0.1:8007. With XAMPP, enable extension=gd in C:\xampp\php\php.ini if it is not active. Uploads must be images up to 2 MB; they are scaled down to at most 512 × 512, converted to JPEG, and saved to the public disk. Only the generated path is stored in users.avatar.

## Pages

- /customers — list/create customers and edit existing records
- /users — list/create users and edit accounts with an optional photo
- / — POS landing page
- /about — project information

SQLite migrations are portable; database/pos_tfa7.sql is also included as a MySQL export.
