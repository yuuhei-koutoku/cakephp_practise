<?php echo $this->Form->create('Task', array('type' => 'post')); ?>
<!-- ここで表示を行う部分 -->
<?php
echo $this->Form->input('Task.name', array('label' => 'タイトル'));
echo $this->Form->input('Task.body', array('label' => '詳細説明'));
echo $this->Form->end('保存');
?>
