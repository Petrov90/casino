<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Custom Field'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Custom Pages'), ['controller' => 'CustomPages', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Custom Page'), ['controller' => 'CustomPages', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="customFields index large-9 medium-8 columns content">
    <h3><?= __('Custom Fields') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('field_name') ?></th>
                <th><?= $this->Paginator->sort('field_value') ?></th>
                <th><?= $this->Paginator->sort('custom_page_id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($customFields as $customField): ?>
            <tr>
                <td><?= $this->Number->format($customField->id) ?></td>
                <td><?= h($customField->field_name) ?></td>
                <td><?= h($customField->field_value) ?></td>
                <td><?= $customField->has('custom_page') ? $this->Html->link($customField->custom_page->id, ['controller' => 'CustomPages', 'action' => 'view', $customField->custom_page->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $customField->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $customField->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $customField->id], ['confirm' => __('Are you sure you want to delete # {0}?', $customField->id)]) ?>
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
