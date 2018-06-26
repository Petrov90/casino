<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Casino Activity Data'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Casinos'), ['controller' => 'Casinos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Casino'), ['controller' => 'Casinos', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Casino Activities'), ['controller' => 'CasinoActivities', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Casino Activity'), ['controller' => 'CasinoActivities', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="casinoActivityDatas index large-9 medium-8 columns content">
    <h3><?= __('Casino Activity Datas') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('casino_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('casino_activity_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($casinoActivityDatas as $casinoActivityData): ?>
            <tr>
                <td><?= $this->Number->format($casinoActivityData->id) ?></td>
                <td><?= $casinoActivityData->has('casino') ? $this->Html->link($casinoActivityData->casino->title, ['controller' => 'Casinos', 'action' => 'view', $casinoActivityData->casino->id]) : '' ?></td>
                <td><?= $casinoActivityData->has('casino_activity') ? $this->Html->link($casinoActivityData->casino_activity->title, ['controller' => 'CasinoActivities', 'action' => 'view', $casinoActivityData->casino_activity->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $casinoActivityData->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $casinoActivityData->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $casinoActivityData->id], ['confirm' => __('Are you sure you want to delete # {0}?', $casinoActivityData->id)]) ?>
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
