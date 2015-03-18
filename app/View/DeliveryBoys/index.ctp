<div class="deliveryBoys index">
	<h2><?php echo __('Delivery Boys'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('mobile_number'); ?></th>
			<th><?php echo $this->Paginator->sort('locations'); ?></th>
			<th><?php echo $this->Paginator->sort('salary'); ?></th>
			<th><?php echo $this->Paginator->sort('joining_date'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($deliveryBoys as $deliveryBoy): ?>
	<tr>
		<td><?php echo h($deliveryBoy['DeliveryBoy']['id']); ?>&nbsp;</td>
		<td><?php echo h($deliveryBoy['DeliveryBoy']['name']); ?>&nbsp;</td>
		<td><?php echo h($deliveryBoy['DeliveryBoy']['mobile_number']); ?>&nbsp;</td>
		<td><?php echo h($deliveryBoy['DeliveryBoy']['locations']); ?>&nbsp;</td>
		<td><?php echo h($deliveryBoy['DeliveryBoy']['salary']); ?>&nbsp;</td>
		<td><?php echo h($deliveryBoy['DeliveryBoy']['joining_date']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $deliveryBoy['DeliveryBoy']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $deliveryBoy['DeliveryBoy']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $deliveryBoy['DeliveryBoy']['id']), array(), __('Are you sure you want to delete # %s?', $deliveryBoy['DeliveryBoy']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Delivery Boy'), array('action' => 'add')); ?></li>
	</ul>
</div>
