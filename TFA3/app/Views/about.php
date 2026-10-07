<?= $this->include('layouts/header') ?>
<section class="page-heading">
    <p class="eyebrow">ABOUT THIS PROJECT</p><h1>A simple POS account directory.</h1>
    <p>Manage customer and user records with validated forms and display-ready profile avatars.</p>
</section>
<section class="info-grid">
    <article class="info-card"><span class="info-number">01</span><h2>Customer accounts</h2><p>Create and edit customer contact details stored in MySQL.</p></article>
    <article class="info-card"><span class="info-number">02</span><h2>User accounts</h2><p>Keep staff usernames unique and update account names.</p></article>
    <article class="info-card"><span class="info-number">03</span><h2>Profile pictures</h2><p>Prepare a square thumbnail for each user and show a placeholder when none is saved.</p></article>
</section>
<?= $this->include('layouts/footer') ?>