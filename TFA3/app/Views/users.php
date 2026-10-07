<?php /** @var array<int, array<string, mixed>> $users */ ?>
<?= $this->include('layouts/header') ?>
<section class="page-heading page-heading-row">
    <div><p class="eyebrow">TEAM DIRECTORY</p><h1>User Accounts</h1><p>People with accounts in the POS system.</p></div>
    <a class="button button-primary" href="<?= site_url('users/new') ?>">+ New user</a>
</section>
<section class="data-card">
    <div class="data-card-heading"><div><h2>Users</h2><p>Account details and profile photos</p></div>
        <span class="record-count"><?= count($users) ?> <?= count($users) === 1 ? 'record' : 'records' ?></span>
    </div>
    <div class="table-wrap"><table>
        <thead><tr><th>Avatar</th><th>Username</th><th>Full name</th><th>Created</th><th>Action</th></tr></thead>
        <tbody>
        <?php if ($users === []): ?>
            <tr><td class="empty-state" colspan="5">No user records found.</td></tr>
        <?php else: foreach ($users as $user): ?>
            <?php
                $avatarName = $user['avatar'] ?? '';
                $hasAvatar = $avatarName !== '' && basename($avatarName) === $avatarName && is_file(FCPATH . 'uploads/avatars/' . $avatarName);
                $avatarUrl = $hasAvatar ? base_url('uploads/avatars/' . rawurlencode($avatarName)) : base_url('images/avatar-placeholder.svg');
            ?>
            <tr>
                <td><img class="avatar" src="<?= esc($avatarUrl) ?>" alt="Avatar for <?= esc($user['full_name']) ?>" width="48" height="48"></td>
                <td><span class="username">@<?= esc($user['username']) ?></span></td>
                <td class="primary-cell"><?= esc($user['full_name']) ?></td>
                <td><?= esc($user['created_at']) ?></td>
                <td><a class="button button-small" href="<?= site_url('users/edit/' . $user['id']) ?>">Edit</a></td>
            </tr>
        <?php endforeach; endif ?>
        </tbody>
    </table></div>
</section>
<?= $this->include('layouts/footer') ?>