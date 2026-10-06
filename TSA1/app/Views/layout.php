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
        </header>
        <main class="main-content">
            <?= $content ?>
        </main>
        <footer class="site-footer"><span>Daymark</span><span>Make room for what matters.</span></footer>
    </div>
</body>
</html>