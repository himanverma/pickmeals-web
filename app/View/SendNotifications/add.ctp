<div class="sendNotifications form">
<?php echo $this->Form->create('SendNotification'); ?>
	<fieldset>
		<legend><?php echo __('Add Send Notification'); ?></legend>
	<?php
		echo $this->Form->input('message');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
