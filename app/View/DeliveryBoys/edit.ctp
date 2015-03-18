<div class="deliveryBoys form">
<?php echo $this->Form->create('DeliveryBoy'); ?>
	<fieldset>
		<legend><?php echo __('Edit Delivery Boy'); ?></legend>
	<?php
		echo $this->Form->input('id');
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

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('DeliveryBoy.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('DeliveryBoy.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Delivery Boys'), array('action' => 'index')); ?></li>
	</ul>
</div>
