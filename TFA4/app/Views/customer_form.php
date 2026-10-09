<?php
$isEdit = $mode === 'edit';
$customer = $customer ?? [];
$action = $isEdit ? 'customers/update/' . $customer['id'] : 'customers/create';
?>
<?= $this->include('layouts/header') ?>
<section class="page-heading">
    <p class="eyebrow">CUSTOMER DIRECTORY</p><h1><?= $isEdit ? 'Edit customer' : 'New customer' ?></h1>
    <p><?= $isEdit ? 'Update this customer account.' : 'Add a customer to the POS account directory.' ?></p>
</section>
<section class="form-card">
    <?php if ($errors !== []): ?><div class="form-errors" role="alert"><strong>Please check the highlighted fields.</strong></div><?php endif ?>
    <form method="post" action="<?= esc(site_url($action)) ?>" class="account-form">
        <div class="field">
            <label for="full_name">Full name <span aria-hidden="true">*</span></label>
            <input id="full_name" name="full_name" type="text" maxlength="100" required value="<?= esc($formData['full_name'] ?? $customer['full_name'] ?? '') ?>">
            <?php if (isset($errors['full_name'])): ?><p class="field-error"><?= esc($errors['full_name']) ?></p><?php endif ?>
        </div>
        <div class="field">
            <label for="email">Email address <span aria-hidden="true">*</span></label>
            <input id="email" name="email" type="email" maxlength="100" required value="<?= esc($formData['email'] ?? $customer['email'] ?? '') ?>">
            <?php if (isset($errors['email'])): ?><p class="field-error"><?= esc($errors['email']) ?></p><?php endif ?>
        </div>
        <div class="field">
            <label for="phone">Phone</label>
            <input id="phone" name="phone" type="tel" maxlength="20" value="<?= esc($formData['phone'] ?? $customer['phone'] ?? '') ?>">
            <?php if (isset($errors['phone'])): ?><p class="field-error"><?= esc($errors['phone']) ?></p><?php endif ?>
        </div>
        <div class="form-actions">
            <a class="button button-secondary" href="<?= site_url('customers') ?>">Cancel</a>
            <button class="button button-primary" type="submit"><?= $isEdit ? 'Save changes' : 'Create customer' ?></button>
        </div>
    </form>
</section>
<?= $this->include('layouts/footer') ?>