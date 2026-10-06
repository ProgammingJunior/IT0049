<section class="page-heading">
    <p class="eyebrow"><?= e(date('l, F j, Y')) ?></p>
    <h1>Good day.<br><span>Here's your focus.</span></h1>
    <p class="page-intro">A clear view of what's on your plate today.</p>
</section>
<section class="task-section" aria-labelledby="today-heading">
    <div class="section-heading">
        <h2 id="today-heading">Today's tasks</h2>
        <span class="count-label"><?= count($tasks) ?> <?= count($tasks) === 1 ? 'task' : 'tasks' ?></span>
    </div>
    <?php if ($tasks === []): ?>
        <p class="empty-state">Nothing scheduled for today. Enjoy the breathing room.</p>
    <?php else: ?>
        <ul class="task-list">
            <?php foreach ($tasks as $task): ?>
                <?php $statusClass = strtolower(str_replace(' ', '-', $task['status'])); ?>
                <li class="task-row">
                    <span class="task-marker" aria-hidden="true"></span>
                    <span class="task-title"><?= e($task['title']) ?></span>
                    <span class="status status-<?= e($statusClass) ?>"><?= e(ucfirst($task['status'])) ?></span>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</section>