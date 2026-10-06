<section class="page-heading compact-heading">
    <p class="eyebrow">TASK MANAGEMENT</p>
    <h1><?= e($pageTitle) ?><span class="heading-period">.</span></h1>
    <p class="page-intro">Keep the details clear and the next step manageable.</p>
</section>
<section class="task-form-section">
    <?php if ($errors !== []): ?>
        <div class="notice error-notice" role="alert"><ul><?php foreach ($errors as $error): ?><li><?= e($error) ?></li><?php endforeach; ?></ul></div>
    <?php endif; ?>
    <form class="task-form" method="post" action="<?= e($formAction) ?>">
        <?= csrf_field() ?>
        <label for="title">Task title <span aria-hidden="true">*</span></label>
        <input id="title" name="title" type="text" maxlength="150" value="<?= e($values['title'] ?? '') ?>" required>
        <label for="task_date">Task date <span aria-hidden="true">*</span></label>
        <input id="task_date" name="task_date" type="date" value="<?= e($values['task_date'] ?? '') ?>" required>
        <label for="status">Status</label>
        <select id="status" name="status" required>
            <?php foreach (['pending' => 'Pending', 'in progress' => 'In progress', 'completed' => 'Completed'] as $value => $label): ?>
                <option value="<?= e($value) ?>" <?= ($values['status'] ?? 'pending') === $value ? 'selected' : '' ?>><?= e($label) ?></option>
            <?php endforeach; ?>
        </select>
        <div class="form-actions">
            <button class="button-link" type="submit"><?= e($submitLabel) ?></button>
            <a class="text-link" href="<?= e(app_url('tasks')) ?>">Cancel</a>
        </div>
    </form>
</section>