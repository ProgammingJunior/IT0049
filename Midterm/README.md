# QuickSale POS setup guide

QuickSale is a CodeIgniter 4 point-of-sale app. This guide covers copying the folder to XAMPP, creating its MySQL database, running the schema with Spark, and opening the site.

## Requirements

- XAMPP with PHP 8.2 through 8.x, Apache, and MySQL/MariaDB
- The complete `Midterm` folder, including `app`, `public`, `writable`, `vendor`, and the `spark` file
- If the uploaded copy does not include `vendor`, install dependencies from the project folder with `composer install`

## Install under XAMPP

1. Copy the whole `Midterm` folder into XAMPP's `htdocs`. For this workspace, the folder is at:

   `C:\xampp\htdocs\IT0049\Midterm`

2. Open the XAMPP Control Panel and start **Apache** and **MySQL**.
3. Open phpMyAdmin at [http://localhost/phpmyadmin](http://localhost/phpmyadmin). Create a database named `pos_db` with the `utf8mb4_general_ci` collation. Create the database only; the migration below creates the tables and relationships.
4. In the project root, make sure the environment file is named `.env`. Some upload tools omit hidden files. If `.env` is missing, copy the supplied `env` template to `.env`, then set these values:

   ```ini
   CI_ENVIRONMENT = development
   app.baseURL = 'http://localhost/IT0049/Midterm/public/'
   app.indexPage = ''

   database.default.hostname = localhost
   database.default.database = pos_db
   database.default.username = root
   database.default.password =
   database.default.DBDriver = MySQLi
   database.default.port = 3306
   ```

   The blank password is XAMPP's common local default. If your MySQL root account has a password, put it after `database.default.password =`. If you copied the folder to a different htdocs path, update `app.baseURL` to match that path.

5. Open PowerShell or Command Prompt in the project root and run:

   ```powershell
   cd C:\xampp\htdocs\IT0049\Midterm
   C:\xampp\php\php.exe spark
   C:\xampp\php\php.exe spark migrate
   C:\xampp\php\php.exe spark db:seed PosDemoSeeder
   ```

   The first command lists available Spark commands. `migrate` creates the products, customers, users, and sales tables and their foreign keys, and creates the initial administrator if one does not exist. The seeder adds example products that are not already in the database. You can safely rerun the seeder; it does not replace existing products or sales.

6. Open [http://localhost/IT0049/Midterm/public/](http://localhost/IT0049/Midterm/public/) and sign in with **admin** / **ChangeMe123!**. Change the initial password after signing in.

If the folder is directly at `C:\xampp\htdocs\Midterm`, use `http://localhost/Midterm/public/` for `app.baseURL` and in your browser instead.

## Run with Spark's development server

MySQL must still be running in XAMPP. In the project root, change `app.baseURL` in `.env` to `http://localhost:8080/`, then run:

```powershell
C:\xampp\php\php.exe spark serve --host 127.0.0.1 --port 8080
```

Open [http://localhost:8080/](http://localhost:8080/). Stop the server with **Ctrl+C**. When switching back to Apache, restore the XAMPP `app.baseURL` shown above.

## Upload to a hosting server

- Upload the complete project folder, including `vendor`, `app`, `writable`, `public`, and `spark`.
- Configure the web server's document root to the project's `public` directory. Do not expose the project root, `app`, `writable`, or `.env` directly to web requests.
- Create a MySQL database and database user on the host. Set the host, database, username, and password in `.env`, and set `app.baseURL` to the site's HTTPS URL.
- From the project root, run `php spark migrate` and `php spark db:seed PosDemoSeeder` using the host's PHP CLI. Make sure the server account can write to `writable` and to `public/uploads` for product and avatar images.
- Set `CI_ENVIRONMENT = production` for a live site, use HTTPS, and change the initial administrator password.

## Database structure

The migration creates:

- `products`: name, price, stock quantity, optional image, and creation date
- `customers`: name, email, optional phone, and creation date
- `users`: unique username, full name, hashed password, optional avatar, and creation date
- `sales`: product, optional customer, staff member, quantity, total price, and date

Each sale references a product and a staff member. Its customer reference is optional; deleting a customer keeps the sale and clears that reference. Products and staff with recorded sales are protected from deletion. Products can be archived from the Products page.

## Troubleshooting

- **Database connection refused:** Start MySQL in XAMPP. Check the hostname and port in `.env`.
- **Unknown database `pos_db`:** Create `pos_db` in phpMyAdmin, then run `php spark migrate` again.
- **Spark is not recognized:** Run it through XAMPP's PHP executable as shown above, from the project root.
- **404 or broken links:** Use the URL containing `/public/`, check `app.baseURL`, and make sure Apache's rewrite module and the supplied `public/.htaccess` are enabled.
- **Upload fails:** Product and avatar images must be JPEG, PNG, GIF, or WebP and no larger than 2 MB. If needed, adjust PHP's `upload_max_filesize` and `post_max_size` in `php.ini`, then restart Apache.
