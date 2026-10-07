<?php
$isEdit = $mode === 'edit';
$user = $user ?? [];
$action = $isEdit ? 'users/update/' . $user['id'] : 'users/create';
$avatarName = $user['avatar'] ?? '';
$hasAvatar = $avatarName !== '' && basename($avatarName) === $avatarName && is_file(FCPATH . 'uploads/avatars/' . $avatarName);
$avatarUrl = $hasAvatar ? base_url('uploads/avatars/' . rawurlencode($avatarName)) : base_url('images/avatar-placeholder.svg');
?>
<?= $this->include('layouts/header') ?>
<section class="page-heading">
    <p class="eyebrow">TEAM DIRECTORY</p><h1><?= $isEdit ? 'Edit user' : 'New user' ?></h1>
    <p><?= $isEdit ? 'Update the account details or profile picture.' : 'Create a staff account for the POS system.' ?></p>
</section>
<section class="form-card">
    <?php if ($errors !== []): ?><div class="form-errors" role="alert"><strong>Please check the form errors.</strong><ul>
        <?php foreach ($errors as $message): ?><li><?= esc($message) ?></li><?php endforeach ?>
    </ul></div><?php endif ?>
    <form id="user-form" method="post" enctype="multipart/form-data" action="<?= esc(site_url($action)) ?>" class="account-form">
        <div class="field">
            <label for="username">Username <span aria-hidden="true">*</span></label>
            <input id="username" name="username" type="text" maxlength="50" required value="<?= esc($formData['username'] ?? $user['username'] ?? '') ?>">
            <?php if (isset($errors['username'])): ?><p class="field-error"><?= esc($errors['username']) ?></p><?php endif ?>
        </div>
        <div class="field">
            <label for="full_name">Full name <span aria-hidden="true">*</span></label>
            <input id="full_name" name="full_name" type="text" maxlength="100" required value="<?= esc($formData['full_name'] ?? $user['full_name'] ?? '') ?>">
            <?php if (isset($errors['full_name'])): ?><p class="field-error"><?= esc($errors['full_name']) ?></p><?php endif ?>
        </div>
        <?php if ($isEdit): ?>
        <div class="field avatar-field">
            <label for="avatar">Profile picture</label>
            <div class="avatar-upload-row">
                <img id="avatar-preview" class="avatar avatar-large" src="<?= esc($avatarUrl) ?>" alt="Current profile picture" width="80" height="80">
                <div>
                    <input id="avatar" name="avatar" type="file" accept=".jpg,.jpeg,.png,image/jpeg,image/png">
                    <p class="field-hint" id="avatar-help">Choose a JPG or PNG up to 2 MB. A square display thumbnail will be prepared.</p>
                </div>
            </div>
            <input id="avatar_thumbnail" name="avatar_thumbnail" type="file" accept="image/png" hidden>
            <?php if (isset($errors['avatar'])): ?><p class="field-error"><?= esc($errors['avatar']) ?></p><?php endif ?>
            <?php if (isset($errors['avatar_thumbnail'])): ?><p class="field-error"><?= esc($errors['avatar_thumbnail']) ?></p><?php endif ?>
        </div>
        <?php endif ?>
        <div class="form-actions">
            <a class="button button-secondary" href="<?= site_url('users') ?>">Cancel</a>
            <button class="button button-primary" type="submit"><?= $isEdit ? 'Save changes' : 'Create user' ?></button>
        </div>
    </form>
</section>
<?php if ($isEdit): ?>
<script>
(() => {
    const form = document.getElementById('user-form');
    const sourceInput = document.getElementById('avatar');
    const thumbnailInput = document.getElementById('avatar_thumbnail');
    const preview = document.getElementById('avatar-preview');
    const help = document.getElementById('avatar-help');

    sourceInput.addEventListener('change', () => {
        const file = sourceInput.files[0];
        if (file) preview.src = URL.createObjectURL(file);
    });

    form.addEventListener('submit', (event) => {
        const file = sourceInput.files[0];
        if (!file) return;

        event.preventDefault();
        help.textContent = 'Preparing the display thumbnail...';
        const reader = new FileReader();
        reader.onerror = () => form.submit();
        reader.onload = () => {
            const image = new Image();
            image.onerror = () => form.submit();
            image.onload = () => {
                const canvas = document.createElement('canvas');
                canvas.width = 256;
                canvas.height = 256;
                const side = Math.min(image.naturalWidth, image.naturalHeight);
                const left = (image.naturalWidth - side) / 2;
                const top = (image.naturalHeight - side) / 2;
                canvas.getContext('2d').drawImage(image, left, top, side, side, 0, 0, 256, 256);
                canvas.toBlob((blob) => {
                    if (!blob) return form.submit();
                    const transfer = new DataTransfer();
                    transfer.items.add(new File([blob], 'avatar-thumbnail.png', { type: 'image/png' }));
                    thumbnailInput.files = transfer.files;
                    form.submit();
                }, 'image/png');
            };
            image.src = reader.result;
        };
        reader.readAsDataURL(file);
    });
})();
</script>
<?php endif ?>
<?= $this->include('layouts/footer') ?>