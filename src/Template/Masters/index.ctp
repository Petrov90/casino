<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Master'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Casino Amenities'), ['controller' => 'CasinoAmenities', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Casino Amenity'), ['controller' => 'CasinoAmenities', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Casino Gambling Options'), ['controller' => 'CasinoGamblingOptions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Casino Gambling Option'), ['controller' => 'CasinoGamblingOptions', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="masters index large-9 medium-8 columns content">
    <h3><?= __('Masters') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('name') ?></th>
                <th><?= $this->Paginator->sort('slug') ?></th>
                <th><?= $this->Paginator->sort('type') ?></th>
                <th><?= $this->Paginator->sort('is_active') ?></th>
                <th><?= $this->Paginator->sort('is_deleted') ?></th>
                <th><?= $this->Paginator->sort('parent_id') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($masters as $master): ?>
            <tr>
                <td><?= $this->Number->format($master->id) ?></td>
                <td><?= h($master->name) ?></td>
                <td><?= h($master->slug) ?></td>
                <td><?= h($master->type) ?></td>
                <td><?= h($master->is_active) ?></td>
                <td><?= h($master->is_deleted) ?></td>
                <td><?= $master->has('parent_master') ? $this->Html->link($master->parent_master->name, ['controller' => 'Masters', 'action' => 'view', $master->parent_master->id]) : '' ?></td>
                <td><?= h($master->created) ?></td>
                <td><?= h($master->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $master->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $master->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $master->id], ['confirm' => __('Are you sure you want to delete # {0}?', $master->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
