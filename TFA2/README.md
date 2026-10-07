# TFA2 POS Accounts

A CodeIgniter 4 POS account directory based on TA1. Customer and user pages retrieve records from MySQL through dedicated models and CodeIgniter Query Builder.

## Requirements

- XAMPP with Apache, MySQL, and PHP 8.2+
- PHP extensions intl, mbstring, mysqli, and zip
- Composer

## Setup with XAMPP

1. Start Apache and MySQL in the XAMPP Control Panel.
2. From TFA2, install CodeIgniter dependencies:

   ~~~powershell
   composer install --working-dir=setup --no-dev
   ~~~

3. setup/.env contains default XAMPP MySQL settings. Update it if your MySQL connection differs.
4. Import database/pos_tfa2.sql in phpMyAdmin, or from PowerShell:

   ~~~powershell
   Get-Content -Raw ./database/pos_tfa2.sql | & 'C:/xampp/mysql/bin/mysql.exe' -u root
   ~~~

   This creates tfa2_pos with the customers and users tables and five sample records in each.
5. Open http://localhost/IT0049/TFA2/public/. The customer and user lists are at /customers and /users.

## Development server

From TFA2, run:

~~~powershell
php spark serve --port 8081
~~~

Change app.baseURL in setup/.env to http://localhost:8081/ before opening the development server.

## Database and MVC

- database/pos_tfa2.sql defines the requested schema and sample data.
- app/Models/CustomerModel.php and UserModel.php retrieve records with Query Builder.
- app/Controllers/Customers.php and Users.php pass records to the views.
- Customer Accounts shows name, email, phone, and creation time.
- User Accounts shows username, full name, and creation time. The supplied users schema has no role column.
- public/css/style.css provides shared responsive styles.

CodeIgniter loads setup/.env because app/Config/Paths.php points its environment directory there.