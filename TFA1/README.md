# TFA1 POS Demonstration

A simple four-page Point-of-Sale website built with CodeIgniter 4. Customer and user records are temporary PHP arrays; this project does not use a database.

## Requirements

- XAMPP with Apache and PHP 8.2 or newer
- PHP extensions `intl`, `mbstring`, and `zip` enabled
- The included composer.phar

## XAMPP Setup

1. Install XAMPP and keep the default installation folder:

   ```text
   C:\xampp
   ```

2. Keep the TFA1 project folder under XAMPP's web root. In this workspace it is:

   ```text
   C:\xampp\htdocs\IT0049\TFA1
   ```

3. Open the XAMPP Control Panel and start **Apache**.

4. Open a terminal in `C:\xampp\htdocs\IT0049\TFA1` and check the XAMPP PHP version:

   ```bash
   C:\xampp\php\php.exe --version
   ```

   The version must be PHP 8.2 or newer.

5. Install the dependencies:

   ```bash
   C:\xampp\php\php.exe -d extension=zip composer.phar install --working-dir=setup --no-dev
   ```

   If Composer is installed globally and ZIP is enabled for its PHP CLI, this shorter command also works:

   ```bash
   composer install --working-dir=setup --no-dev
   ```

   The dependencies are installed into `setup/vendor`. The -d extension=zip option temporarily enables XAMPP PHP's ZIP extension for this command.

6. Create the environment file if it does not exist:

   ```bash
   copy setup\env setup\.env
   ```

7. Open `setup/.env` and confirm it contains:

   ```ini
   CI_ENVIRONMENT = development
   app.baseURL = 'http://localhost/IT0049/TFA1/public/'
   ```

8. Open the project in a browser:

   [http://localhost/IT0049/TFA1/public/](http://localhost/IT0049/TFA1/public/)

The included `public/.htaccess` file handles the CodeIgniter routes. XAMPP normally includes Apache `mod_rewrite`. If a route returns a 404 error, check that `LoadModule rewrite_module modules/mod_rewrite.so` is enabled in `C:\xampp\apache\conf\httpd.conf`, then restart Apache.

If PHP reports a missing extension, open `C:\xampp\php\php.ini`, remove the semicolon from the matching lines, and restart Apache:

```ini
extension=intl
extension=mbstring
extension=zip
```

The browser should display the POS landing page. The PHP source should be served through the `public/` folder; do not use the project root as the Apache document root.

## Development Server

You can also run the project without Apache from the TFA1 folder:

```bash
php spark serve --port 8081
```

Open [http://127.0.0.1:8081](http://127.0.0.1:8081). When switching between this server and XAMPP, update `app.baseURL` in `setup/.env` to match the URL you are using.

Stop the development server with `Ctrl+C`.

## Pages

- `/` - landing page
- `/about` - about page
- `/customers` - customer accounts with full name, email, and phone
- `/users` - user accounts with username, full name, and role

For XAMPP, the full URLs are:

- `http://localhost/IT0049/TFA1/public/`
- `http://localhost/IT0049/TFA1/public/about`
- `http://localhost/IT0049/TFA1/public/customers`
- `http://localhost/IT0049/TFA1/public/users`

## Project Structure

- `app/` contains the application controllers, views, and routes.
- `public/` is the web-accessible CodeIgniter entry point.
- `writable/` stores runtime files.
- `setup/` contains Composer files, `.env`, and CodeIgniter dependencies.
- `docs/` contains a static HTML version for GitHub Pages.

## MVC Files

- `app/Config/Routes.php` registers the routes.
- `app/Controllers/Pages.php` handles the landing and about pages.
- `app/Controllers/Customers.php` contains the temporary customer array.
- `app/Controllers/Users.php` contains the temporary user array.
- `app/Views/` contains the four PHP views.

The customer and user views use `foreach` to display the records passed from their controllers.

## GitHub Pages

GitHub Pages cannot execute PHP or CodeIgniter. The `docs/` folder contains a static HTML version of the four pages and can be selected as the GitHub Pages source.
