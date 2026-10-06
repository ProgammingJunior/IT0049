<?php
declare(strict_types=1);

use App\Controllers\AboutController;
use App\Controllers\ProfileController;
use App\Controllers\TaskController;
use App\Core\View;

require __DIR__ . '/app/helpers.php';
require __DIR__ . '/app/autoload.php';

$basePath = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '/'));
$basePath = rtrim($basePath, '/');
$requestPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
if ($basePath !== '' && $basePath !== '/' && str_starts_with($requestPath, $basePath)) {
    $requestPath = substr($requestPath, strlen($basePath));
}
$path = '/' . trim($requestPath, '/');
$path = $path === '/' ? '/' : rtrim($path, '/');

try {
    switch ($path) {
        case '/':
            (new TaskController())->today();
            break;
        case '/tasks':
            (new TaskController())->index();
            break;
        case '/profile':
            (new ProfileController())->show();
            break;
        case '/about':
            (new AboutController())->show();
            break;
        default:
            http_response_code(404);
            View::render('not-found', ['pageTitle' => 'Page not found', 'activePage' => '']);
    }
} catch (Throwable $exception) {
    http_response_code(500);
    View::render('error', ['pageTitle' => 'Unable to load page', 'activePage' => '']);
}