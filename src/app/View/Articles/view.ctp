<h3>詳細</h3>
タイトル：<?php echo h($article['Article']['title']); ?><br>
本文：<?php echo h($article['Article']['content']); ?><br>
投稿者名：<?php echo h($article['User']['name']); ?><br>
作成日時：<?php echo h($article['Article']['created']); ?><br>
更新日時：<?php echo h($article['Article']['modified']); ?><br><br>

<h3>コメント</h3>
<?php if ($memos === array()): ?>
	まだコメントはありません。<br>
<?php else: ?>
	<?php foreach ($memos as $memo): ?>
		コメント：<?php echo h($memo['Memo']['content']); ?><br>
		投稿者名：<?php echo h($memo['User']['name']); ?><br><br>
	<?php endforeach; ?>
<?php endif; ?>

<?php
echo $this->Form->create('Memo');
echo $this->Form->input('content', array('rows' => 3, 'required' => false));
echo $this->Form->end('Save');
?>

<?php echo $this->HTML->link('一覧へ戻る', '/Articles'); ?>
