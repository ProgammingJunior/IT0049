# TFA4 POS Authentication

A CodeIgniter 4 POS account directory based on TFA3. Customer and user account pages require a signed-in user. Passwords are stored as hashes, and user avatars are handled as square PNG thumbnails.

## Requirements

- XAMPP with Apache, MySQL, and PHP 8.2+
- PHP extensions intl, mbstring, mysqli, and zip
- Composer if the bundled setup/vendor dependencies are unavailable

## Setup with XAMPP

1. Start Apache and MySQL in the XAMPP Control Panel.
2. If setup/vendor is missing, install the dependencies from TFA4:

   ~~~powershell
   composer install --working-dir=setup --no-dev
   ~~~

3. setup/.env is configured for local XAMPP MySQL and the separate tfa4_pos database. Adjust it if your MySQL credentials differ.
4. Import database/pos_tfa4.sql in phpMyAdmin, or from PowerShell:

   ~~~powershell
   Get-Content -Raw ./database/pos_tfa4.sql | & 'C:/xampp/mysql/bin/mysql.exe' -u root
   ~~~

5. From TFA4, run the migration. It adds the password column and assigns each existing user a password hash using PHP password_hash():

   ~~~powershell
   & 'C:/xampp/php/php.exe' spark migrate
   ~~~

6. Open http://localhost/IT0049/TFA4/public/.

The five sample users can sign in with their listed username and the initial password password123. Change an account password from its Edit user form after signing in.

## Authentication

- The login page accepts a username and password and checks the stored hash with password_verify().
- A successful login regenerates the session ID and stores the user's ID and display name in the session.
- The auth filter protects customer and user account lists, create/edit forms, and their POST actions.
- Use the Log out button in the header to destroy the session.

## Account pages

- Customer forms require a full name and valid email; phone is optional.
- User forms require a full name, unique username, and an initial password of at least 8 characters. On edit, leave the password blank to keep it unchanged.
- On a user edit page, choose a JPG or PNG no larger than 2 MB. Browser Canvas prepares a centered 256 by 256 PNG thumbnail. The server validates both files, stores the thumbnail in public/uploads/avatars, and saves only its filename to users.avatar.

## MVC structure

- app/Controllers contains account and authentication actions.
- app/Filters/AuthFilter.php checks the session before protected routes.
- app/Models contains the database access for customers and users.
- app/Views contains account forms, lists, and the login page.
- app/Database/Migrations adds password hashes to existing user rows.
- database/pos_tfa4.sql creates and seeds the TFA4 database.
- setup/.env configures the database; app/Config/Paths.php points CodeIgniter there.