<?php /** @var array<int, array<string, mixed>> $users */ ?>
<?= $this->include('layouts/header') ?>
<section class="page-heading">
    <p class="eyebrow">TEAM DIRECTORY</p><h1>User Accounts</h1>
    <p>People with accounts in the POS system.</p>
</section>
<section class="data-card">
    <div class="data-card-heading"><div><h2>Users</h2><p>Account names and creation dates</p></div>
        <span class="record-count"><?= count($users) ?> <?= count($users) === 1 ? 'record' : 'records' ?></span>
    </div>
    <div class="table-wrap"><table>
        <thead><tr><th>Username</th><th>Full name</th><th>Created</th></tr></thead>
        <tbody>
        <?php if ($users === []): ?>
            <tr><td class="empty-state" colspan="3">No user records found.</td></tr>
        <?php else: foreach ($users as $user): ?>
            <tr>
                <td><span class="username">@<?= esc($user['username']) ?></span></td>
                <td class="primary-cell"><?= esc($user['full_name']) ?></td>
                <td><?= esc($user['created_at']) ?></td>
            </tr>
        <?php endforeach; endif ?>
        </tbody>
    </table></div>
</section>
<?= $this->include('layouts/footer') ?>