<form action="<?php
	echo $this->Html->url('/Tasks/create');
?>" method="POST">
タスク名<input type="text" name="name" size="40">
本文<textarea name="body"></textarea>
<input type="submit" value="タスクを作成">
</form>
