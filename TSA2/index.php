<?php
declare(strict_types=1);

use App\Controllers\AboutController;
use App\Controllers\AuthController;
use App\Controllers\ProfileController;
use App\Controllers\TaskController;
use App\Core\View;

$secureCookie = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off';
$cookiePath = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '/'));
if ($cookiePath === '.' || $cookiePath === '') {
    $cookiePath = '/';
}
session_name('daymark_tsa2_session');
session_set_cookie_params([
    'lifetime' => 0,
    'path' => rtrim($cookiePath, '/') . '/',
    'secure' => $secureCookie,
    'httponly' => true,
    'samesite' => 'Lax',
]);
session_start();

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
$method = strtoupper($_SERVER['REQUEST_METHOD'] ?? 'GET');

try {
    $tasks = new TaskController();
    $auth = new AuthController();

    if (preg_match('~^/tasks/([1-9][0-9]*)/edit$~', $path, $match)) {
        if ($method !== 'GET') {
            http_response_code(405);
            header('Allow: GET');
            exit('Method not allowed.');
        }
        $tasks->edit((int) $match[1]);
    } elseif (preg_match('~^/tasks/([1-9][0-9]*)/update$~', $path, $match)) {
        if ($method !== 'POST') {
            http_response_code(405);
            header('Allow: POST');
            exit('Method not allowed.');
        }
        $tasks->update((int) $match[1]);
    } elseif (preg_match('~^/tasks/([1-9][0-9]*)/archive$~', $path, $match)) {
        if ($method !== 'POST') {
            http_response_code(405);
            header('Allow: POST');
            exit('Method not allowed.');
        }
        $tasks->archive((int) $match[1]);
    } else {
        switch ($path) {
            case '/':
                if ($method !== 'GET') { http_response_code(405); exit('Method not allowed.'); }
                $tasks->today();
                break;
            case '/tasks':
                if ($method === 'GET') { $tasks->index(); }
                elseif ($method === 'POST') { $tasks->create(); }
                else { http_response_code(405); exit('Method not allowed.'); }
                break;
            case '/tasks/new':
                if ($method !== 'GET') { http_response_code(405); exit('Method not allowed.'); }
                $tasks->new();
                break;
            case '/login':
                if ($method === 'GET') { $auth->login(); }
                elseif ($method === 'POST') { $auth->attempt(); }
                else { http_response_code(405); exit('Method not allowed.'); }
                break;
            case '/logout':
                if ($method !== 'POST') { http_response_code(405); header('Allow: POST'); exit('Method not allowed.'); }
                $auth->logout();
                break;
            case '/profile':
                if ($method !== 'GET') { http_response_code(405); exit('Method not allowed.'); }
                (new ProfileController())->show();
                break;
            case '/about':
                if ($method !== 'GET') { http_response_code(405); exit('Method not allowed.'); }
                (new AboutController())->show();
                break;
            default:
                http_response_code(404);
                View::render('not-found', ['pageTitle' => 'Page not found', 'activePage' => '']);
        }
    }
} catch (Throwable $exception) {
    http_response_code(500);
    View::render('error', ['pageTitle' => 'Unable to load page', 'activePage' => '']);
}
