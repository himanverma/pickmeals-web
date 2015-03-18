<div class="deliveryBoys view">
<h2><?php echo __('Delivery Boy'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($deliveryBoy['DeliveryBoy']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($deliveryBoy['DeliveryBoy']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Mobile Number'); ?></dt>
		<dd>
			<?php echo h($deliveryBoy['DeliveryBoy']['mobile_number']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Locations'); ?></dt>
		<dd>
			<?php echo h($deliveryBoy['DeliveryBoy']['locations']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Salary'); ?></dt>
		<dd>
			<?php echo h($deliveryBoy['DeliveryBoy']['salary']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Joining Date'); ?></dt>
		<dd>
			<?php echo h($deliveryBoy['DeliveryBoy']['joining_date']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Delivery Boy'), array('action' => 'edit', $deliveryBoy['DeliveryBoy']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Delivery Boy'), array('action' => 'delete', $deliveryBoy['DeliveryBoy']['id']), array(), __('Are you sure you want to delete # %s?', $deliveryBoy['DeliveryBoy']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Delivery Boys'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Delivery Boy'), array('action' => 'add')); ?> </li>
	</ul>
</div>
