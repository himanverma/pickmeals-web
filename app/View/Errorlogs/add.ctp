<div class="errorlogs form">
<?php echo $this->Form->create('Errorlog'); ?>
	<fieldset>
		<legend><?php echo __('Add Errorlog'); ?></legend>
	<?php
		echo $this->Form->input('log');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Errorlogs'), array('action' => 'index')); ?></li>
	</ul>
</div>
