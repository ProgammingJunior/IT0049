<?php
$title = $title ?? 'Point-of-Sale';
$activePage = $activePage ?? '';
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
            <a class="<?= $activePage === 'customers' ? 'active' : '' ?>" href="<?= base_url('customers') ?>">Customers</a>
            <a class="<?= $activePage === 'users' ? 'active' : '' ?>" href="<?= base_url('users') ?>">Users</a>
        </nav>
    </div>
</header>
<main class="page-shell">