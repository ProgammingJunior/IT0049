<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\View;

final class AboutController
{
    public function show(): void
    {
        View::render('about', [
            'pageTitle' => 'About',
            'activePage' => 'about',
        ]);
    }
}