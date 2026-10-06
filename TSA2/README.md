# Daymark Tasks for Today - TSA2

TSA2 extends the Daymark PHP MVC task manager with login-protected task management. It follows TSA1's page design and keeps its data in a separate tasks_today_tsa2 database, so it does not change TSA1's tasks_today database.

## Requirements

- XAMPP with Apache and MySQL running
- PHP 8.1 or newer with PDO MySQL and mbstring enabled
- No Composer install is needed; this is a standalone PHP MVC project

## Set up with XAMPP

1. Place this folder at C:\xampp\htdocs\IT0049\TSA2.
2. Start Apache and MySQL in the XAMPP Control Panel.
3. Open http://localhost/phpmyadmin and import database/schema.sql. It creates the separate tasks_today_tsa2 database and its tasks and users tables.
4. Select tasks_today_tsa2 in phpMyAdmin and import database/seed.sql once. It adds eight sample tasks and the demo user.
5. Visit http://localhost/IT0049/TSA2/.

The default database connection is host 127.0.0.1, database tasks_today_tsa2, user root, and a blank password. If your MySQL credentials differ, set DB_HOST, DB_NAME, DB_USER, and DB_PASS in the Apache/PHP environment before starting Apache. The connection defaults in app/Core/Database.php point to the TSA2 database.

## Demo login

- Username: alexmorgan
- Password: Daymark123!

The demo password is stored as a password_hash value and checked with password_verify. Change the demo password hash before using this project outside a local assignment environment.

## Routes and access

- / - today's unarchived tasks; public
- /tasks - all unarchived tasks by date; public
- /profile - demo user profile; public
- /about - project information; public
- /login - sign-in page
- /logout - POST sign-out action
- /tasks/new - create a task; signed-in users only
- /tasks/{id}/edit - edit a task; signed-in users only
- /tasks/{id}/update - POST task changes; signed-in users only
- /tasks/{id}/archive - POST archive action; signed-in users only

Task title and date are required. Status must be Pending, In progress, or Completed. Archiving sets is_archived to 1; the task remains in the database and is excluded from the Welcome and Task List pages.

## Verify access control and task workflow

1. While signed out, open /tasks/new and /tasks/1/edit. Both should redirect to /login. The public pages /, /tasks, /profile, and /about should still open.
2. Sign in with the demo account. The navigation should show the signed-in name and a Log out action.
3. Open All tasks and create a task. Submitting an empty title or date should show a validation error.
4. Edit the task and save a changed title, date, or status.
5. Archive it. It should disappear from Today and All tasks while its database row remains with is_archived = 1.
6. Sign out and confirm task management routes redirect to login again.

Create, update, archive, and logout forms use CSRF tokens. Task SQL uses prepared statements.

## Project layout

- app/Controllers contains task, authentication, profile, and about controllers.
- app/Models contains the PDO task and user models.
- app/Core contains the database connection and view renderer.
- app/Views contains the Daymark pages and task forms.
- assets/styles.css contains the shared design and task-management controls.
- database/schema.sql and database/seed.sql create and populate the TSA2 database.

The root .htaccess routes requests through index.php. If routes return 404, enable Apache mod_rewrite and AllowOverride All for htdocs.
