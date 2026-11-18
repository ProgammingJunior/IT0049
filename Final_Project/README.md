# QuickSale POS — Laravel Final Project

This Laravel application implements the midterm POS brief. The brief names CodeIgniter; this project uses Laravel as requested. It includes product, customer, and staff management; prepared image uploads; protected management pages; inventory-aware sales; and transaction history.

## Requirements

- PHP 8.2+ with PDO SQLite and GD enabled
- Composer
- Node.js 20+ and npm

On XAMPP, use the PHP executable inside the XAMPP installation. Run `php --ini` to locate the active `php.ini`; enable `extension=gd` and `extension=pdo_sqlite` there if needed, then restart the terminal.

## Install on Windows PowerShell

Run these commands from the folder containing `artisan`:

```powershell
Set-Location 'C:\path\to\Final_Project'
composer install
Copy-Item .env.example .env
& 'C:\path\to\php.exe' artisan key:generate
New-Item -ItemType File -Path database/database.sqlite -Force
& 'C:\path\to\php.exe' artisan migrate --seed
npm.cmd install
npm.cmd run build
& 'C:\path\to\php.exe' artisan storage:link
& 'C:\path\to\php.exe' artisan serve --host=127.0.0.1 --port=8090
```

For this computer, replace `C:\path\to\php.exe` with `C:\xampp\php\php.exe`. Composer and Node must be on PATH (or invoked by their full paths). Open [http://127.0.0.1:8090](http://127.0.0.1:8090).

## Install on macOS or Linux

From the project folder:

```sh
php -v
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate --seed
npm install
npm run build
php artisan storage:link
php artisan serve --host=127.0.0.1 --port=8090
```

Make sure PHP has `pdo_sqlite` and `gd` enabled. No absolute application path needs to be configured: the SQLite file is at `database/database.sqlite` inside this project.

## Optional MySQL setup

Create a database and user, then set these values in your local `.env`:

```ini
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=quicksale
DB_USERNAME=your_user
DB_PASSWORD=your_password
```

Run `php artisan migrate --seed` from this folder. Keep credentials in `.env`; do not commit it. SQLite is the default.

## Sign in

- Email: `admin@example.com`
- Password: `Daymark123!`

Change the seeded password after first sign-in. Staff accounts can be added from the Staff page.

## Included workflows

- Product create, edit, and archive/restore, with inventory quantity and image upload
- Customer and staff create, view, edit, and delete
- JPEG, PNG, or WebP uploads up to 2 MB, resized and converted to JPEG
- Authentication protects the dashboard and all management routes
- Sales save the current product price, reduce stock in a transaction, and reject quantities above available stock
- Sales history shows product, optional customer, staff member, quantity, total, and date
- Database schema is defined by Laravel migrations; repeatable sample records are in the seeder

The POS needs Laravel and a database, so it cannot run on GitHub Pages. The repository root `index.html` is the separate static showcase for the activities.
