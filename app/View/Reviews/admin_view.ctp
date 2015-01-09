<div class="reviews view">
<h2><?php echo __('Review'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($review['Review']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Customer'); ?></dt>
		<dd>
			<?php echo $this->Html->link($review['Customer']['name'], array('controller' => 'customers', 'action' => 'view', $review['Customer']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Vendor'); ?></dt>
		<dd>
			<?php echo $this->Html->link($review['Vendor']['name'], array('controller' => 'vendors', 'action' => 'view', $review['Vendor']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Combination Reviewkey'); ?></dt>
		<dd>
			<?php echo h($review['Review']['combination_reviewkey']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Review'); ?></dt>
		<dd>
			<?php echo h($review['Review']['review']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ratings'); ?></dt>
		<dd>
			<?php echo h($review['Review']['ratings']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($review['Review']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Review'), array('action' => 'edit', $review['Review']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Review'), array('action' => 'delete', $review['Review']['id']), array(), __('Are you sure you want to delete # %s?', $review['Review']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Reviews'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Review'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Customers'), array('controller' => 'customers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Customer'), array('controller' => 'customers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Vendors'), array('controller' => 'vendors', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Vendor'), array('controller' => 'vendors', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Combinations'), array('controller' => 'combinations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Combination'), array('controller' => 'combinations', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Combinations'); ?></h3>
	<?php if (!empty($review['Combination'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Vendor Id'); ?></th>
		<th><?php echo __('Display Name'); ?></th>
		<th><?php echo __('Image'); ?></th>
		<th><?php echo __('Day'); ?></th>
		<th><?php echo __('Date'); ?></th>
		<th><?php echo __('Price'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Reviewkey'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($review['Combination'] as $combination): ?>
		<tr>
			<td><?php echo $combination['id']; ?></td>
			<td><?php echo $combination['vendor_id']; ?></td>
			<td><?php echo $combination['display_name']; ?></td>
			<td><?php echo $combination['image']; ?></td>
			<td><?php echo $combination['day']; ?></td>
			<td><?php echo $combination['date']; ?></td>
			<td><?php echo $combination['price']; ?></td>
			<td><?php echo $combination['status']; ?></td>
			<td><?php echo $combination['reviewkey']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'combinations', 'action' => 'view', $combination['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'combinations', 'action' => 'edit', $combination['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'combinations', 'action' => 'delete', $combination['id']), array(), __('Are you sure you want to delete # %s?', $combination['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Combination'), array('controller' => 'combinations', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
