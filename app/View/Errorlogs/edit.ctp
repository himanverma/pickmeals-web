<div class="errorlogs form">
<?php echo $this->Form->create('Errorlog'); ?>
	<fieldset>
		<legend><?php echo __('Edit Errorlog'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('log');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Errorlog.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Errorlog.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Errorlogs'), array('action' => 'index')); ?></li>
	</ul>
</div>
