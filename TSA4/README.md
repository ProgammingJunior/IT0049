# TSA4 · Tasks for Today: CRUD, Auth, and Email

Laravel 12 continues TSA3 with task CRUD, Breeze authentication, soft archiving, and a one-time completion email written to Laravel's log mailer.

## Requirements

- PHP 8.2+ with PDO SQLite enabled
- Composer
- Node.js 20+ and npm

## Run locally

~~~powershell
composer install
Copy-Item .env.example .env
php artisan key:generate
New-Item -ItemType File -Path database/database.sqlite -Force
php artisan migrate --seed
npm.cmd install
npm.cmd run build
php artisan serve --port=8014
~~~

Open http://127.0.0.1:8014. SQLite is the default database. .env.example sets MAIL_MAILER=log and TASK_NOTIFICATION_EMAIL=alex.morgan@example.com; no real email is sent. Completion messages are recorded in storage/logs/laravel.log. Change TASK_NOTIFICATION_EMAIL there if you want a different log recipient.

## Demo account

- Email: alex.morgan@example.com
- Password: Daymark123!

## Pages and task workflow

- /, /tasks, /profile, and /about are public
- /tasks/create, /tasks/{task}/edit, update, show, and archive require login
- Creating and updating tasks validates the title, date, and status
- Archiving sets is_archived=1 and hides the task from public lists while preserving the database row
- A status transition to done sends one log email; saving an already-done task does not send another

After signing in, create a pending task, edit it to Done, and check storage/logs/laravel.log. Edit it again without changing the status; there should be no second notification. Eight tasks and one user are seeded.
