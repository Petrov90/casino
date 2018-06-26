<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Casino'), ['action' => 'edit', $casino->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Casino'), ['action' => 'delete', $casino->id], ['confirm' => __('Are you sure you want to delete # {0}?', $casino->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Casinos'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Casino'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="casinos view large-9 medium-8 columns content">
    <h3><?= h($casino->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Title') ?></th>
            <td><?= h($casino->title) ?></td>
        </tr>
        <tr>
            <th><?= __('Aaddres') ?></th>
            <td><?= h($casino->aaddres) ?></td>
        </tr>
        <tr>
            <th><?= __('Url') ?></th>
            <td><?= h($casino->url) ?></td>
        </tr>
        <tr>
            <th><?= __('Email') ?></th>
            <td><?= h($casino->email) ?></td>
        </tr>
        <tr>
            <th><?= __('Image') ?></th>
            <td><?= h($casino->image) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($casino->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= $this->Number->format($casino->created) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($casino->description)); ?>
    </div>
</div>
