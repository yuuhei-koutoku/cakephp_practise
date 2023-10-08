<?php echo $this->Html->css('task'); // CSSを読み込む ?>
<div class="roundBox">
<h3><?php echo h($task['Task']['id']); ?>
:
<?php echo h($task['Task']['name']); ?></h3>
作成日 <?php echo h($task['Task']['created']); ?>
<p class="comment">
<ul>
<?php foreach ($task['Note'] as $note): ?>
<li><?php echo h($note['body']); ?></li>
<?php endforeach; ?>
<li><?php echo $this->Html->link(
    'コメントを追加',
    '/Notes/create'
); ?></li>
</ul></p>

<?php echo $this->Html->link(
    '編集',
    '/Tasks/edit/' . $task['Task']['id'],
    array('class' => 'button left')
); ?>

<?php echo $this->Html->link(
    'このタスクを完了する',
    '/Tasks/done/' . $task['Task']['id'],
    array('class' => 'button right')
); ?>
</div>
