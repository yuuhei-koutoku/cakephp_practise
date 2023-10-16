<?php
echo $this->Form->create('Article');
echo $this->Form->input('title', array('required' => false));
echo $this->Form->input('content', array('rows' => 3, 'required' => false));
echo $this->Form->end('Update');
?>
