<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $casinoActivityData->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $casinoActivityData->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Casino Activity Datas'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Casinos'), ['controller' => 'Casinos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Casino'), ['controller' => 'Casinos', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Casino Activities'), ['controller' => 'CasinoActivities', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Casino Activity'), ['controller' => 'CasinoActivities', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="casinoActivityDatas form large-9 medium-8 columns content">
    <?= $this->Form->create($casinoActivityData) ?>
    <fieldset>
        <legend><?= __('Edit Casino Activity Data') ?></legend>
        <?php
            echo $this->Form->input('casino_id', ['options' => $casinos]);
            echo $this->Form->input('casino_activity_id', ['options' => $casinoActivities]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
