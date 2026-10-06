<section class="page-heading compact-heading">
    <p class="eyebrow">THE COMPLETE VIEW</p>
    <h1>All tasks<span class="heading-period">.</span></h1>
    <p class="page-intro">Every active task, arranged by date.</p>
</section>
<section class="task-section" aria-label="All tasks">
    <?php if ($tasks === []): ?>
        <p class="empty-state">No active tasks yet.</p>
    <?php else: ?>
        <?php $currentDate = null; ?>
        <?php foreach ($tasks as $index => $task): ?>
            <?php if ($currentDate !== $task['task_date']): ?>
                <?php $currentDate = $task['task_date']; ?>
                <div class="date-group">
                    <h2><?= e(date('l, F j, Y', strtotime($currentDate))) ?></h2>
                    <ul class="task-list">
            <?php endif; ?>
                        <?php $statusClass = strtolower(str_replace(' ', '-', $task['status'])); ?>
                        <li class="task-row">
                            <span class="task-marker" aria-hidden="true"></span>
                            <div class="task-primary"><span class="task-title"><?= e($task['title']) ?></span><span class="status status-<?= e($statusClass) ?>"><?= e(ucfirst($task['status'])) ?></span></div>
                            <?php if (current_user() !== null): ?>
                                <div class="task-actions">
                                    <a class="task-edit-link" href="<?= e(app_url('tasks/' . $task['id'] . '/edit')) ?>">Edit</a>
                                    <form method="post" action="<?= e(app_url('tasks/' . $task['id'] . '/archive')) ?>" onsubmit="return confirm('Archive this task?')"><?= csrf_field() ?><button class="task-archive-link" type="submit">Archive</button></form>
                                </div>
                            <?php endif; ?>
                        </li>
            <?php $nextDate = $tasks[$index + 1]['task_date'] ?? null; ?>
            <?php if ($nextDate !== $currentDate): ?>
                    </ul>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>
    <?php if (current_user() !== null): ?><a class="button-link" href="<?= e(app_url('tasks/new')) ?>">Add a task</a><?php endif; ?>
</section>