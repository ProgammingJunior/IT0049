<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Database;
use App\Core\View;
use App\Models\UserModel;

final class ProfileController
{
    public function show(): void
    {
        $user = (new UserModel(Database::connection()))->first();
        View::render('profile', [
            'pageTitle' => 'Profile',
            'activePage' => 'profile',
            'user' => $user,
        ]);
    }
}