<?php 
echo $this->Form->create('Customer');
echo $this->Form->input('username');
echo $this->Form->input('password');
echo $this->Form->end('login');
?>