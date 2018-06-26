<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Custom Page'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Custom Fields'), ['controller' => 'CustomFields', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Custom Field'), ['controller' => 'CustomFields', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="customPages index large-9 medium-8 columns content">
    <h3><?= __('Custom Pages') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('slug') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($customPages as $customPage): ?>
            <tr>
                <td><?= $this->Number->format($customPage->id) ?></td>
                <td><?= h($customPage->slug) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $customPage->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $customPage->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $customPage->id], ['confirm' => __('Are you sure you want to delete # {0}?', $customPage->id)]) ?>
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
