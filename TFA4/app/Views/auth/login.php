<?= $this->include('layouts/header') ?>
<section class="page-heading">
    <p class="eyebrow">CORNERSTONE POS</p>
    <h1>Log in</h1>
    <p>Sign in to manage customer and user accounts.</p>
</section>
<section class="form-card auth-card">
    <?php if (! empty($error)): ?><div class="form-errors" role="alert"><?= esc($error) ?></div><?php endif ?>
    <?php if ($errors !== []): ?><div class="form-errors" role="alert"><strong>Please check the form.</strong><ul>
        <?php foreach ($errors as $message): ?><li><?= esc($message) ?></li><?php endforeach ?>
    </ul></div><?php endif ?>
    <form method="post" action="<?= esc(site_url('login')) ?>" class="account-form">
        <?= csrf_field() ?>
        <div class="field">
            <label for="username">Username</label>
            <input id="username" name="username" type="text" maxlength="50" autocomplete="username" required value="<?= esc($username ?? '') ?>">
        </div>
        <div class="field">
            <label for="password">Password</label>
            <input id="password" name="password" type="password" maxlength="255" autocomplete="current-password" required>
        </div>
        <div class="form-actions">
            <button class="button button-primary" type="submit">Log in</button>
        </div>
    </form>
</section>
<?= $this->include('layouts/footer') ?>