<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Masters'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Parent Masters'), ['controller' => 'Masters', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Parent Master'), ['controller' => 'Masters', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Casino Amenities'), ['controller' => 'CasinoAmenities', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Casino Amenity'), ['controller' => 'CasinoAmenities', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Casino Gambling Options'), ['controller' => 'CasinoGamblingOptions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Casino Gambling Option'), ['controller' => 'CasinoGamblingOptions', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="masters form large-9 medium-8 columns content">
    <?= $this->Form->create($master) ?>
    <fieldset>
        <legend><?= __('Add Master') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('slug');
            echo $this->Form->input('type');
            echo $this->Form->input('is_active');
            echo $this->Form->input('is_deleted');
            echo $this->Form->input('parent_id', ['options' => $parentMasters, 'empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
