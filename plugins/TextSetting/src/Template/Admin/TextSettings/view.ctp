<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Text Setting'), ['action' => 'edit', $textSetting->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Text Setting'), ['action' => 'delete', $textSetting->id], ['confirm' => __('Are you sure you want to delete # {0}?', $textSetting->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Text Settings'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Text Setting'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="textSettings view large-9 medium-8 columns content">
    <h3><?= h($textSetting->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Language') ?></th>
            <td><?= h($textSetting->language) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($textSetting->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($textSetting->created) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Msgid') ?></h4>
        <?= $this->Text->autoParagraph(h($textSetting->msgid)); ?>
    </div>
    <div class="row">
        <h4><?= __('Msgstr') ?></h4>
        <?= $this->Text->autoParagraph(h($textSetting->msgstr)); ?>
    </div>
</div>
