<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Real Casinos'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="realCasinos form large-9 medium-8 columns content">
    <?= $this->Form->create($realCasino) ?>
    <fieldset>
        <legend><?= __('Add Real Casino') ?></legend>
        <?php
            echo $this->Form->input('title');
            echo $this->Form->input('address');
            echo $this->Form->input('phone');
            echo $this->Form->input('email');
            echo $this->Form->input('website');
            echo $this->Form->input('url');
            echo $this->Form->input('country_name');
            echo $this->Form->input('state_name');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
