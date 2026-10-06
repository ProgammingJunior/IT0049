<?php
declare(strict_types=1);

function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function app_url(string $path = ''): string
{
    $basePath = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '/'));
    if ($basePath === '/' || $basePath === '.') {
        $basePath = '';
    }
    return rtrim($basePath, '/') . '/' . ltrim($path, '/');
}

function redirect_to(string $path = ''): never
{
    header('Location: ' . app_url($path), true, 303);
    exit;
}

function current_user(): ?array
{
    $user = $_SESSION['auth_user'] ?? null;
    return is_array($user) ? $user : null;
}

function require_login(): void
{
    if (current_user() === null) {
        flash_set('error', 'Sign in before managing tasks.');
        redirect_to('login');
    }
}

function csrf_token(): string
{
    if (!isset($_SESSION['_csrf_token']) || !is_string($_SESSION['_csrf_token'])) {
        $_SESSION['_csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['_csrf_token'];
}

function csrf_field(): string
{
    return '<input type="hidden" name="_csrf_token" value="' . e(csrf_token()) . '">';
}

function require_csrf(): void
{
    $submitted = $_POST['_csrf_token'] ?? null;
    if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST'
        || !is_string($submitted)
        || !hash_equals(csrf_token(), $submitted)) {
        http_response_code(419);
        echo 'This form expired. Reload the page and try again.';
        exit;
    }
}

function flash_set(string $key, string $message): void
{
    $_SESSION['_flash_' . $key] = $message;
}

function flash_take(string $key): ?string
{
    $slot = '_flash_' . $key;
    $message = $_SESSION[$slot] ?? null;
    unset($_SESSION[$slot]);
    return is_string($message) ? $message : null;
}
