<div class="sendNotifications form">
<?php echo $this->Form->create('SendNotification'); ?>
	<fieldset>
		<legend><?php echo __('Edit Send Notification'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('message');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('SendNotification.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('SendNotification.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Send Notifications'), array('action' => 'index')); ?></li>
	</ul>
</div>
