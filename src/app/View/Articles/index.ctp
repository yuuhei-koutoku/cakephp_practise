<?php echo $this->HTML->link('新規投稿', '/Articles/add'); ?><br><br>

<?php foreach ($articles as $article): ?>
	タイトル：<?php echo h($article['Article']['title']); ?><br>
	投稿者：<?php echo h($article['User']['name']); ?><br>
	作成日時：<?php echo h($article['Article']['created']); ?><br>
	<?php echo $this->HTML->link('詳細', '/Articles/view/' . $article['Article']['id']) ?>&nbsp;
	<?php echo $this->HTML->link('編集', '/Articles/edit/' . $article['Article']['id']) ?>&nbsp;
	<?php
    echo $this->Form->postLink(
        '削除',
        array('controller' => 'articles', 'action' => 'delete', $article['Article']['id']),
        array('confirm' => '本当に削除しますか？')
    );
    ?><br><br>
<?php endforeach; ?>
