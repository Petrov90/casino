<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Casino Activity'), ['action' => 'edit', $casinoActivity->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Casino Activity'), ['action' => 'delete', $casinoActivity->id], ['confirm' => __('Are you sure you want to delete # {0}?', $casinoActivity->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Casino Activities'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Casino Activity'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Casino Activitity Datas'), ['controller' => 'CasinoActivitityDatas', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Casino Activitity Data'), ['controller' => 'CasinoActivitityDatas', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="casinoActivities view large-9 medium-8 columns content">
    <h3><?= h($casinoActivity->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Title') ?></th>
            <td><?= h($casinoActivity->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Phone') ?></th>
            <td><?= h($casinoActivity->phone) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Schedule') ?></th>
            <td><?= h($casinoActivity->schedule) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($casinoActivity->id) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($casinoActivity->description)); ?>
    </div>
    <div class="row">
        <h4><?= __('Coach') ?></h4>
        <?= $this->Text->autoParagraph(h($casinoActivity->coach)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Casino Activitity Datas') ?></h4>
        <?php if (!empty($casinoActivity->casino_activitity_datas)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Casino Id') ?></th>
                <th scope="col"><?= __('Casino Activity Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($casinoActivity->casino_activitity_datas as $casinoActivitityDatas): ?>
            <tr>
                <td><?= h($casinoActivitityDatas->id) ?></td>
                <td><?= h($casinoActivitityDatas->casino_id) ?></td>
                <td><?= h($casinoActivitityDatas->casino_activity_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'CasinoActivitityDatas', 'action' => 'view', $casinoActivitityDatas->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'CasinoActivitityDatas', 'action' => 'edit', $casinoActivitityDatas->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'CasinoActivitityDatas', 'action' => 'delete', $casinoActivitityDatas->id], ['confirm' => __('Are you sure you want to delete # {0}?', $casinoActivitityDatas->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
