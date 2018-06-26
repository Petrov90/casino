<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Casino Activity Data'), ['action' => 'edit', $casinoActivityData->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Casino Activity Data'), ['action' => 'delete', $casinoActivityData->id], ['confirm' => __('Are you sure you want to delete # {0}?', $casinoActivityData->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Casino Activity Datas'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Casino Activity Data'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Casinos'), ['controller' => 'Casinos', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Casino'), ['controller' => 'Casinos', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Casino Activities'), ['controller' => 'CasinoActivities', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Casino Activity'), ['controller' => 'CasinoActivities', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="casinoActivityDatas view large-9 medium-8 columns content">
    <h3><?= h($casinoActivityData->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Casino') ?></th>
            <td><?= $casinoActivityData->has('casino') ? $this->Html->link($casinoActivityData->casino->title, ['controller' => 'Casinos', 'action' => 'view', $casinoActivityData->casino->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Casino Activity') ?></th>
            <td><?= $casinoActivityData->has('casino_activity') ? $this->Html->link($casinoActivityData->casino_activity->title, ['controller' => 'CasinoActivities', 'action' => 'view', $casinoActivityData->casino_activity->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($casinoActivityData->id) ?></td>
        </tr>
    </table>
</div>
