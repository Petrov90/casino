<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Upload Image'), ['action' => 'edit', $uploadImage->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Upload Image'), ['action' => 'delete', $uploadImage->id], ['confirm' => __('Are you sure you want to delete # {0}?', $uploadImage->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Upload Images'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Upload Image'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="uploadImages view large-9 medium-8 columns content">
    <h3><?= h($uploadImage->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $uploadImage->has('user') ? $this->Html->link($uploadImage->user->id, ['controller' => 'Users', 'action' => 'view', $uploadImage->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Image') ?></th>
            <td><?= h($uploadImage->image) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Caption') ?></th>
            <td><?= h($uploadImage->caption) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($uploadImage->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Foreign Key') ?></th>
            <td><?= $this->Number->format($uploadImage->foreign_key) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($uploadImage->created) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Type') ?></h4>
        <?= $this->Text->autoParagraph(h($uploadImage->type)); ?>
    </div>
</div>
