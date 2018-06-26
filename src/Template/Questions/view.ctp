<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Question'), ['action' => 'edit', $question->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Question'), ['action' => 'delete', $question->id], ['confirm' => __('Are you sure you want to delete # {0}?', $question->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Questions'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Question'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Question Comments'), ['controller' => 'QuestionComments', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Question Comment'), ['controller' => 'QuestionComments', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="questions view large-9 medium-8 columns content">
    <h3><?= h($question->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $question->has('user') ? $this->Html->link($question->user->full_name, ['controller' => 'Users', 'action' => 'view', $question->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Language') ?></th>
            <td><?= h($question->language) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($question->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Foreign Key') ?></th>
            <td><?= $this->Number->format($question->foreign_key) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Like Count') ?></th>
            <td><?= $this->Number->format($question->like_count) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Comment Count') ?></th>
            <td><?= $this->Number->format($question->comment_count) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User Points') ?></th>
            <td><?= $this->Number->format($question->user_points) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($question->created) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Type') ?></h4>
        <?= $this->Text->autoParagraph(h($question->type)); ?>
    </div>
    <div class="row">
        <h4><?= __('Comment') ?></h4>
        <?= $this->Text->autoParagraph(h($question->comment)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Question Comments') ?></h4>
        <?php if (!empty($question->question_comments)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Question Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Comment') ?></th>
                <th scope="col"><?= __('Language') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($question->question_comments as $questionComments): ?>
            <tr>
                <td><?= h($questionComments->id) ?></td>
                <td><?= h($questionComments->question_id) ?></td>
                <td><?= h($questionComments->user_id) ?></td>
                <td><?= h($questionComments->comment) ?></td>
                <td><?= h($questionComments->language) ?></td>
                <td><?= h($questionComments->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'QuestionComments', 'action' => 'view', $questionComments->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'QuestionComments', 'action' => 'edit', $questionComments->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'QuestionComments', 'action' => 'delete', $questionComments->id], ['confirm' => __('Are you sure you want to delete # {0}?', $questionComments->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
