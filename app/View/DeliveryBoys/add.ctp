<div class="deliveryBoys form">
<?php echo $this->Form->create('DeliveryBoy'); ?>
	<fieldset>
		<legend><?php echo __('Add Delivery Boy'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('mobile_number');
		echo $this->Form->input('locations');
		echo $this->Form->input('salary');
		echo $this->Form->input('joining_date');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Delivery Boys'), array('action' => 'index')); ?></li>
	</ul>
</div>
