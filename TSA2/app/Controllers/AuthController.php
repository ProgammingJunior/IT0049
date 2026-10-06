<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Database;
use App\Core\View;
use App\Models\UserModel;

final class AuthController
{
    public function login(): void
    {
        if (current_user() !== null) {
            redirect_to('tasks');
        }
        View::render('login', [
            'pageTitle' => 'Sign in',
            'activePage' => '',
            'oldUsername' => flash_take('old_username') ?? '',
        ]);
    }

    public function attempt(): void
    {
        require_csrf();
        $username = trim(is_string($_POST['username'] ?? null) ? $_POST['username'] : '');
        $password = is_string($_POST['password'] ?? null) ? $_POST['password'] : '';
        $user = (new UserModel(Database::connection()))->findByUsername($username);

        if ($user === null || !password_verify($password, $user['password'])) {
            flash_set('error', 'The username or password is incorrect.');
            flash_set('old_username', $username);
            redirect_to('login');
        }

        session_regenerate_id(true);
        $_SESSION['_csrf_token'] = bin2hex(random_bytes(32));
        $_SESSION['auth_user'] = [
            'id' => (int) $user['id'],
            'username' => $user['username'],
            'full_name' => $user['full_name'],
        ];
        flash_set('success', 'You are signed in.');
        redirect_to('tasks');
    }

    public function logout(): void
    {
        require_login();
        require_csrf();
        unset($_SESSION['auth_user']);
        session_regenerate_id(true);
        $_SESSION['_csrf_token'] = bin2hex(random_bytes(32));
        flash_set('success', 'You have signed out.');
        redirect_to('');
    }
}
