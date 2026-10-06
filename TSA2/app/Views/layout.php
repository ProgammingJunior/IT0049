<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#f5f6f2">
    <title><?= e($pageTitle) ?> | Daymark</title>
    <link rel="stylesheet" href="<?= e(app_url('assets/styles.css')) ?>">
</head>
<body>
    <div class="site-shell">
        <header class="site-header">
            <a class="wordmark" href="<?= e(app_url()) ?>" aria-label="Daymark home">daymark<span>.</span></a>
            <nav class="main-nav" aria-label="Main navigation">
                <a class="<?= $activePage === 'home' ? 'is-active' : '' ?>" href="<?= e(app_url()) ?>">Today</a>
                <a class="<?= $activePage === 'tasks' ? 'is-active' : '' ?>" href="<?= e(app_url('tasks')) ?>">All tasks</a>
                <a class="<?= $activePage === 'profile' ? 'is-active' : '' ?>" href="<?= e(app_url('profile')) ?>">Profile</a>
                <a class="<?= $activePage === 'about' ? 'is-active' : '' ?>" href="<?= e(app_url('about')) ?>">About</a>
            </nav>
            <div class="account-nav">
                <?php if (($user = current_user()) !== null): ?>
                    <span class="account-name">Hi, <?= e($user['full_name']) ?></span>
                    <form method="post" action="<?= e(app_url('logout')) ?>"><?= csrf_field() ?><button class="nav-button" type="submit">Log out</button></form>
                <?php else: ?>
                    <a class="nav-button" href="<?= e(app_url('login')) ?>">Log in</a>
                <?php endif; ?>
            </div>
        </header>
        <main class="main-content">
            <?php if (($message = flash_take('success')) !== null): ?><p class="notice success-notice" role="status"><?= e($message) ?></p><?php endif; ?>
            <?php if (($message = flash_take('error')) !== null): ?><p class="notice error-notice" role="alert"><?= e($message) ?></p><?php endif; ?>
            <?= $content ?>
        </main>
        <footer class="site-footer"><span>Daymark</span><span>Make room for what matters.</span></footer>
    </div>
</body>
</html>