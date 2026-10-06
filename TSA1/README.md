# Daymark: Tasks for Today

A small PHP MVC task management app with a MySQL database. The home page shows only today's tasks; `/tasks` lists all tasks by date, `/profile` shows the demo user, and `/about` credits the developer.

## Requirements

- XAMPP with Apache and MySQL enabled
- PHP 8.1 or newer with PDO MySQL enabled

## Setup with XAMPP

1. Place this project in `C:\xampp\htdocs\IT0049\TSA1`.
2. Start Apache and MySQL in the XAMPP Control Panel.
3. Open phpMyAdmin at `http://localhost/phpmyadmin` and import `database/schema.sql`, then import `database/seed.sql`.
4. Visit `http://localhost/IT0049/TSA1/`.

The default connection uses host `127.0.0.1`, database `tasks_today`, user `root`, and an empty password, as in a standard local XAMPP setup. Override these values with `DB_HOST`, `DB_NAME`, `DB_USER`, and `DB_PASS` environment variables if needed.

Run `database/seed.sql` once on a fresh database. It inserts eight realistic tasks over three dates relative to the day it is run, including four tasks dated today, and exactly one demo user. To refresh a local sample database, remove its existing sample rows before importing the seed again.

## Routes

- `/` — today's tasks only
- `/tasks` — all tasks in ascending date order
- `/profile` — the single demo user's profile
- `/about` — project information and developer credit

The root `index.php` dispatches routes to controllers. Controllers use the task and user models for PDO queries, then render templates from `app/Views`.

## Hosted deployment

This repository is ready to deploy to a PHP 8.1+ host with MySQL. Import the two SQL files on that host, configure the four database environment variables, and ensure Apache URL rewriting is enabled. The hosted URL must be supplied by the deployment provider; this local workspace does not include hosting credentials or an existing hosted site.