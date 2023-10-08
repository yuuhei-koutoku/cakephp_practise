<?php
echo $this->Form->create('User');
echo $this->Form->input('User.email', array('required' => false));
echo $this->Form->input('User.password', array('required' => false));
echo $this->Form->end('Login');
?>
