<div class="devices form">
<?php echo $this->Form->create('Device'); ?>
	<fieldset>
		<legend><?php echo __('Add Device'); ?></legend>
	<?php
		echo $this->Form->input('device_token');
		echo $this->Form->input('customer_id');
		echo $this->Form->input('created_on');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Devices'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Customers'), array('controller' => 'customers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Customer'), array('controller' => 'customers', 'action' => 'add')); ?> </li>
	</ul>
</div>
