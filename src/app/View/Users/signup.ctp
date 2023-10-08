<?php
echo $this->Form->create('User');
echo $this->Form->input('User.name', array('required' => false));
echo $this->Form->input('User.email', array('required' => false));
echo $this->Form->input('User.password', array('required' => false));
echo $this->Form->input('User.confirm_password', array('required' => false, 'type' => 'password'));
echo $this->Form->end('Sign Up');
?>
