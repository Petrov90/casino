<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Master'), ['action' => 'edit', $master->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Master'), ['action' => 'delete', $master->id], ['confirm' => __('Are you sure you want to delete # {0}?', $master->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Masters'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Master'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Parent Masters'), ['controller' => 'Masters', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Parent Master'), ['controller' => 'Masters', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="masters view large-9 medium-8 columns content">
    <h3><?= h($master->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($master->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Slug') ?></th>
            <td><?= h($master->slug) ?></td>
        </tr>
        <tr>
            <th><?= __('Type') ?></th>
            <td><?= h($master->type) ?></td>
        </tr>
        <tr>
            <th><?= __('Parent Master') ?></th>
            <td><?= $master->has('parent_master') ? $this->Html->link($master->parent_master->name, ['controller' => 'Masters', 'action' => 'view', $master->parent_master->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($master->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($master->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($master->modified) ?></td>
        </tr>
        <tr>
            <th><?= __('Is Active') ?></th>
            <td><?= $master->is_active ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th><?= __('Is Deleted') ?></th>
            <td><?= $master->is_deleted ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Masters') ?></h4>
        <?php if (!empty($master->child_masters)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Name') ?></th>
                <th><?= __('Slug') ?></th>
                <th><?= __('Type') ?></th>
                <th><?= __('Is Active') ?></th>
                <th><?= __('Is Deleted') ?></th>
                <th><?= __('Parent Id') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($master->child_masters as $childMasters): ?>
            <tr>
                <td><?= h($childMasters->id) ?></td>
                <td><?= h($childMasters->name) ?></td>
                <td><?= h($childMasters->slug) ?></td>
                <td><?= h($childMasters->type) ?></td>
                <td><?= h($childMasters->is_active) ?></td>
                <td><?= h($childMasters->is_deleted) ?></td>
                <td><?= h($childMasters->parent_id) ?></td>
                <td><?= h($childMasters->created) ?></td>
                <td><?= h($childMasters->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Masters', 'action' => 'view', $childMasters->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Masters', 'action' => 'edit', $childMasters->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Masters', 'action' => 'delete', $childMasters->id], ['confirm' => __('Are you sure you want to delete # {0}?', $childMasters->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
