<?php /** @var array<int, array<string, mixed>> $customers */ ?>
<?= $this->include('layouts/header') ?>
<section class="page-heading page-heading-row">
    <div><p class="eyebrow">ACCOUNT DIRECTORY</p><h1>Customer Accounts</h1><p>Customer contact details from the POS database.</p></div>
    <a class="button button-primary" href="<?= site_url('customers/new') ?>">+ New customer</a>
</section>
<section class="data-card">
    <div class="data-card-heading"><div><h2>Customers</h2><p>Contact details and account history</p></div>
        <span class="record-count"><?= count($customers) ?> <?= count($customers) === 1 ? 'record' : 'records' ?></span>
    </div>
    <div class="table-wrap"><table>
        <thead><tr><th>Full name</th><th>Email</th><th>Phone</th><th>Created</th><th>Action</th></tr></thead>
        <tbody>
        <?php if ($customers === []): ?>
            <tr><td class="empty-state" colspan="5">No customer records found.</td></tr>
        <?php else: foreach ($customers as $customer): ?>
            <tr>
                <td class="primary-cell"><?= esc($customer['full_name']) ?></td>
                <td><a class="table-link" href="mailto:<?= esc($customer['email']) ?>"><?= esc($customer['email']) ?></a></td>
                <td><?= esc($customer['phone'] ?? '—') ?></td>
                <td><?= esc($customer['created_at']) ?></td>
                <td><a class="button button-small" href="<?= site_url('customers/edit/' . $customer['id']) ?>">Edit</a></td>
            </tr>
        <?php endforeach; endif ?>
        </tbody>
    </table></div>
</section>
<?= $this->include('layouts/footer') ?>