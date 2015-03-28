<div class="devices index">
	<h2><?php echo __('Devices'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('device_token'); ?></th>
			<th><?php echo $this->Paginator->sort('customer_id'); ?></th>
			<th><?php echo $this->Paginator->sort('created_on'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($devices as $device): ?>
	<tr>
		<td><?php echo h($device['Device']['id']); ?>&nbsp;</td>
		<td><?php echo h($device['Device']['device_token']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($device['Customer']['name'], array('controller' => 'customers', 'action' => 'view', $device['Customer']['id'])); ?>
		</td>
		<td><?php echo h($device['Device']['created_on']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $device['Device']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $device['Device']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $device['Device']['id']), array(), __('Are you sure you want to delete # %s?', $device['Device']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Device'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Customers'), array('controller' => 'customers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Customer'), array('controller' => 'customers', 'action' => 'add')); ?> </li>
	</ul>
</div>
