<?php
$title = $title ?? 'Point-of-Sale';
$activePage = $activePage ?? '';
$successMessage = session()->getFlashdata('success');
$loggedIn = session()->get('user_id') !== null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= esc($title) ?> | Cornerstone POS</title>
    <link rel="stylesheet" href="<?= esc(base_url('css/style.css')) ?>">
</head>
<body>
<header class="site-header">
    <div class="header-inner">
        <a class="brand" href="<?= base_url('/') ?>"><span class="brand-mark">C</span> Cornerstone <span class="brand-light">POS</span></a>
        <nav class="main-nav" aria-label="Main navigation">
            <a class="<?= $activePage === 'home' ? 'active' : '' ?>" href="<?= base_url('/') ?>">Home</a>
            <a class="<?= $activePage === 'about' ? 'active' : '' ?>" href="<?= base_url('about') ?>">About</a>
            <?php if ($loggedIn): ?>
                <a class="<?= $activePage === 'customers' ? 'active' : '' ?>" href="<?= site_url('customers') ?>">Customers</a>
                <a class="<?= $activePage === 'users' ? 'active' : '' ?>" href="<?= site_url('users') ?>">Users</a>
                <span class="nav-user"><?= esc(session()->get('full_name')) ?></span>
                <form class="nav-logout" method="post" action="<?= esc(site_url('logout')) ?>">
                    <?= csrf_field() ?>
                    <button type="submit">Log out</button>
                </form>
            <?php else: ?>
                <a class="<?= $activePage === 'login' ? 'active' : '' ?>" href="<?= site_url('login') ?>">Log in</a>
            <?php endif ?>
        </nav>
    </div>
</header>
<main class="page-shell">
    <?php if ($successMessage): ?><div class="flash-success" role="status"><?= esc($successMessage) ?></div><?php endif ?>