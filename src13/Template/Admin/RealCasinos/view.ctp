<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Real Casino'), ['action' => 'edit', $realCasino->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Real Casino'), ['action' => 'delete', $realCasino->id], ['confirm' => __('Are you sure you want to delete # {0}?', $realCasino->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Real Casinos'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Real Casino'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="realCasinos view large-9 medium-8 columns content">
    <h3><?= h($realCasino->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Title') ?></th>
            <td><?= h($realCasino->title) ?></td>
        </tr>
        <tr>
            <th><?= __('Address') ?></th>
            <td><?= h($realCasino->address) ?></td>
        </tr>
        <tr>
            <th><?= __('Phone') ?></th>
            <td><?= h($realCasino->phone) ?></td>
        </tr>
        <tr>
            <th><?= __('Email') ?></th>
            <td><?= h($realCasino->email) ?></td>
        </tr>
        <tr>
            <th><?= __('Website') ?></th>
            <td><?= h($realCasino->website) ?></td>
        </tr>
        <tr>
            <th><?= __('Url') ?></th>
            <td><?= h($realCasino->url) ?></td>
        </tr>
        <tr>
            <th><?= __('Country Name') ?></th>
            <td><?= h($realCasino->country_name) ?></td>
        </tr>
        <tr>
            <th><?= __('State Name') ?></th>
            <td><?= h($realCasino->state_name) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($realCasino->id) ?></td>
        </tr>
    </table>
</div>
