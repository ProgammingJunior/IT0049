<?= $this->include('layouts/header') ?>
<section class="hero">
    <div>
        <p class="eyebrow">POINT OF SALE | ACCOUNT DIRECTORY</p>
        <h1>A clearer view of your customer relationships.</h1>
        <p class="hero-description">Keep customer contact details and staff accounts organized in one simple place.</p>
        <div class="hero-actions">
            <a class="button button-primary" href="<?= base_url('customers') ?>">View customers <span aria-hidden="true">-&gt;</span></a>
            <a class="button button-secondary" href="<?= base_url('users') ?>">View user accounts</a>
        </div>
    </div>
    <aside class="hero-card">
        <div class="database-icon" aria-hidden="true"><span></span><span></span><span></span></div>
        <p class="card-label">ACCOUNT DIRECTORY</p>
        <h2>Ready for business.</h2>
        <p>Customer and user records are loaded from your MySQL database.</p>
        <div class="status-line"><span class="status-dot"></span> Database-backed records</div>
    </aside>
</section>
<section class="welcome-note">
    <p class="eyebrow">YOUR POS WORKSPACE</p>
    <h2>People first, details in reach.</h2>
    <p>Browse customer contact information or review the people who use your point-of-sale system.</p>
</section>
<?= $this->include('layouts/footer') ?>