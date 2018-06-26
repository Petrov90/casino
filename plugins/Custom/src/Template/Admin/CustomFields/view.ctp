<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Custom Field'), ['action' => 'edit', $customField->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Custom Field'), ['action' => 'delete', $customField->id], ['confirm' => __('Are you sure you want to delete # {0}?', $customField->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Custom Fields'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Custom Field'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Custom Pages'), ['controller' => 'CustomPages', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Custom Page'), ['controller' => 'CustomPages', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="customFields view large-9 medium-8 columns content">
    <h3><?= h($customField->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Field Name') ?></th>
            <td><?= h($customField->field_name) ?></td>
        </tr>
        <tr>
            <th><?= __('Field Value') ?></th>
            <td><?= h($customField->field_value) ?></td>
        </tr>
        <tr>
            <th><?= __('Custom Page') ?></th>
            <td><?= $customField->has('custom_page') ? $this->Html->link($customField->custom_page->id, ['controller' => 'CustomPages', 'action' => 'view', $customField->custom_page->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($customField->id) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Type') ?></h4>
        <?= $this->Text->autoParagraph(h($customField->type)); ?>
    </div>
</div>
