<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Question Comment'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Questions'), ['controller' => 'Questions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Question'), ['controller' => 'Questions', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="questionComments index large-9 medium-8 columns content">
    <h3><?= __('Question Comments') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('question_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('language') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($questionComments as $questionComment): ?>
            <tr>
                <td><?= $this->Number->format($questionComment->id) ?></td>
                <td><?= $questionComment->has('question') ? $this->Html->link($questionComment->question->id, ['controller' => 'Questions', 'action' => 'view', $questionComment->question->id]) : '' ?></td>
                <td><?= $questionComment->has('user') ? $this->Html->link($questionComment->user->full_name, ['controller' => 'Users', 'action' => 'view', $questionComment->user->id]) : '' ?></td>
                <td><?= h($questionComment->language) ?></td>
                <td><?= h($questionComment->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $questionComment->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $questionComment->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $questionComment->id], ['confirm' => __('Are you sure you want to delete # {0}?', $questionComment->id)]) ?>
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
