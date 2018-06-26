<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Upload Images'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="uploadImages form large-9 medium-8 columns content">
    <?= $this->Form->create($uploadImage) ?>
    <fieldset>
        <legend><?= __('Add Upload Image') ?></legend>
        <?php
            echo $this->Form->input('type');
            echo $this->Form->input('foreign_key');
            echo $this->Form->input('user_id', ['options' => $users]);
            echo $this->Form->input('image');
            echo $this->Form->input('caption');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
