<section class="page-heading compact-heading">
    <p class="eyebrow">YOUR ACCOUNT</p>
    <h1>Profile<span class="heading-period">.</span></h1>
    <p class="page-intro">The person behind today's plans.</p>
</section>
<?php if ($user === null): ?>
    <p class="empty-state">No profile is available yet.</p>
<?php else: ?>
    <section class="profile-panel" aria-label="User profile">
        <div class="profile-avatar" aria-hidden="true"><?= e(strtoupper(substr($user['full_name'], 0, 1))) ?></div>
        <div class="profile-details">
            <p class="eyebrow">DEMO ACCOUNT</p>
            <h2><?= e($user['full_name']) ?></h2>
            <dl>
                <div><dt>Username</dt><dd><?= e($user['username']) ?></dd></div>
                <div><dt>Email</dt><dd><a href="mailto:<?= e($user['email']) ?>"><?= e($user['email']) ?></a></dd></div>
                <div><dt>Member since</dt><dd><?= e(date('F j, Y', strtotime($user['created_at']))) ?></dd></div>
            </dl>
        </div>
    </section>
<?php endif; ?>