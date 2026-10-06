<section class="page-heading compact-heading">
    <p class="eyebrow">TASK MANAGEMENT</p>
    <h1>Sign in<span class="heading-period">.</span></h1>
    <p class="page-intro">Sign in to create, update, and archive tasks.</p>
</section>
<section class="task-form-section">
    <form class="task-form" method="post" action="<?= e(app_url('login')) ?>">
        <?= csrf_field() ?>
        <label for="username">Username</label>
        <input id="username" name="username" type="text" maxlength="50" autocomplete="username" value="<?= e($oldUsername) ?>" required>
        <label for="password">Password</label>
        <input id="password" name="password" type="password" autocomplete="current-password" required>
        <button class="button-link" type="submit">Sign in</button>
        <p class="form-note">Demo account: alexmorgan / Daymark123!</p>
    </form>
</section>