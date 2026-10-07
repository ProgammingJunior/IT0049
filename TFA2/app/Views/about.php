<?= $this->include('layouts/header') ?>
<section class="page-heading">
    <p class="eyebrow">ABOUT THIS PROJECT</p>
    <h1>A simple POS account directory.</h1>
    <p>This CodeIgniter 4 application demonstrates a database-backed way to display customer and user accounts.</p>
</section>
<section class="info-grid">
    <article class="info-card"><span class="info-number">01</span><h2>Customer accounts</h2><p>Names, email addresses, phone numbers, and account creation dates are stored in MySQL.</p></article>
    <article class="info-card"><span class="info-number">02</span><h2>User accounts</h2><p>Staff usernames, full names, and account creation dates come from the users table.</p></article>
    <article class="info-card"><span class="info-number">03</span><h2>CodeIgniter models</h2><p>Each account page gets records through a model and CodeIgniter Query Builder.</p></article>
</section>
<?= $this->include('layouts/footer') ?>