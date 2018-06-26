<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Question Comment'), ['action' => 'edit', $questionComment->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Question Comment'), ['action' => 'delete', $questionComment->id], ['confirm' => __('Are you sure you want to delete # {0}?', $questionComment->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Question Comments'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Question Comment'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Questions'), ['controller' => 'Questions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Question'), ['controller' => 'Questions', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="questionComments view large-9 medium-8 columns content">
    <h3><?= h($questionComment->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Question') ?></th>
            <td><?= $questionComment->has('question') ? $this->Html->link($questionComment->question->id, ['controller' => 'Questions', 'action' => 'view', $questionComment->question->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $questionComment->has('user') ? $this->Html->link($questionComment->user->full_name, ['controller' => 'Users', 'action' => 'view', $questionComment->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Language') ?></th>
            <td><?= h($questionComment->language) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($questionComment->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($questionComment->created) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Comment') ?></h4>
        <?= $this->Text->autoParagraph(h($questionComment->comment)); ?>
    </div>
</div>
