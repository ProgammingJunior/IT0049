# TFA3 POS Accounts

A CodeIgniter 4 POS account directory based on TFA2, with customer and user create/edit forms and user avatar thumbnails.

## Requirements

- XAMPP with Apache, MySQL, and PHP 8.2+
- PHP extensions intl, mbstring, mysqli, and zip
- Composer and a modern browser with Canvas support

## Setup with XAMPP

1. Start Apache and MySQL in the XAMPP Control Panel.
2. From TFA3, install dependencies if needed:

   ~~~powershell
   composer install --working-dir=setup --no-dev
   ~~~

3. setup/.env is configured for the local XAMPP MySQL account and tfa3_pos. Adjust it if your MySQL credentials differ.
4. Import database/pos_tfa3.sql in phpMyAdmin, or from PowerShell:

   ~~~powershell
   Get-Content -Raw ./database/pos_tfa3.sql | & 'C:/xampp/mysql/bin/mysql.exe' -u root
   ~~~

   This creates tfa3_pos, the customers and users tables, and five sample records in each. The users table includes the nullable avatar filename.
5. Open http://localhost/IT0049/TFA3/public/. The Customers and Users pages link to account forms.

## Account forms and avatars

- Customer forms require a full name and valid email; phone is optional.
- User forms require a full name and a unique username.
- Edit forms are pre-filled from the database.
- On a user edit page, choose a JPG or PNG no larger than 2 MB. Browser Canvas prepares a centered 256 by 256 PNG thumbnail. The server validates both files, stores the thumbnail in public/uploads/avatars, and saves only its filename to users.avatar.
- The user list shows the prepared thumbnail or public/images/avatar-placeholder.svg when no avatar exists. The original uploaded image is not stored.

## MVC structure

- app/Controllers contains form actions and validation.
- app/Models contains Query Builder access to customers and users.
- app/Views contains account lists, forms, and shared layout files.
- database/pos_tfa3.sql creates and seeds the database.
- setup/.env configures the database because app/Config/Paths.php points CodeIgniter there.