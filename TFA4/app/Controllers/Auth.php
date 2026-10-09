<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\HTTP\RedirectResponse;

class Auth extends BaseController
{
    public function login(): string|RedirectResponse
    {
        if (session()->get('user_id') !== null) {
            return redirect()->to(site_url('customers'));
        }

        return view('auth/login', [
            'title' => 'Log in',
            'activePage' => 'login',
            'username' => '',
            'errors' => [],
            'error' => null,
        ]);
    }

    public function attempt(): string|RedirectResponse
    {
        $username = trim((string) $this->request->getPost('username'));
        $rules = [
            'username' => 'required|max_length[50]',
            'password' => 'required|max_length[255]',
        ];

        if (! $this->validate($rules)) {
            return view('auth/login', [
                'title' => 'Log in',
                'activePage' => 'login',
                'username' => $username,
                'errors' => $this->validator->getErrors(),
                'error' => null,
            ]);
        }

        $password = (string) $this->request->getPost('password');
        $user = (new UserModel())->findByUsername($username);

        if ($user === null || ! isset($user['password']) || ! password_verify($password, $user['password'])) {
            return view('auth/login', [
                'title' => 'Log in',
                'activePage' => 'login',
                'username' => $username,
                'errors' => [],
                'error' => 'The username or password is incorrect.',
            ]);
        }

        session()->regenerate(true);
        session()->set([
            'user_id' => (int) $user['id'],
            'username' => $user['username'],
            'full_name' => $user['full_name'],
        ]);

        return redirect()->to(site_url('customers'));
    }

    public function logout(): RedirectResponse
    {
        session()->destroy();

        return redirect()->to(site_url('login'))->with('success', 'You have been logged out.');
    }
}