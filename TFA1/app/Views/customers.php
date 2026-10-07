<?php /** @var array<int, array<string, string>> $customers */ ?>
<!DOCTYPE html>
<html lang="en">
<head><meta charset="UTF-8"><title>Customer Accounts - POS</title></head>
<body>
    <nav>
        <a href="<?= base_url('/') ?>">Home</a> |
        <a href="<?= base_url('about') ?>">About</a> |
        <a href="<?= base_url('customers') ?>">Customer Accounts</a> |
        <a href="<?= base_url('users') ?>">User Accounts</a>
    </nav>
    <h1>Customer Accounts</h1>
    <table border="1" cellpadding="8">
        <thead><tr><th>Full Name</th><th>Email</th><th>Phone</th></tr></thead>
        <tbody>
            <?php foreach ($customers as $customer): ?>
                <tr>
                    <td><?= esc($customer['full_name']) ?></td>
                    <td><?= esc($customer['email']) ?></td>
                    <td><?= esc($customer['phone']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
