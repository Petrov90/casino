<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $customField->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $customField->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Custom Fields'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Custom Pages'), ['controller' => 'CustomPages', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Custom Page'), ['controller' => 'CustomPages', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="customFields form large-9 medium-8 columns content">
    <?= $this->Form->create($customField) ?>
    <fieldset>
        <legend><?= __('Edit Custom Field') ?></legend>
        <?php
            echo $this->Form->input('field_name');
            echo $this->Form->input('field_value');
            echo $this->Form->input('type');
            echo $this->Form->input('custom_page_id', ['options' => $customPages]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
