<div class="sendNotifications view">
<h2><?php echo __('Send Notification'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($sendNotification['SendNotification']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Message'); ?></dt>
		<dd>
			<?php echo h($sendNotification['SendNotification']['message']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($sendNotification['SendNotification']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Send Notification'), array('action' => 'edit', $sendNotification['SendNotification']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Send Notification'), array('action' => 'delete', $sendNotification['SendNotification']['id']), array(), __('Are you sure you want to delete # %s?', $sendNotification['SendNotification']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Send Notifications'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Send Notification'), array('action' => 'add')); ?> </li>
	</ul>
</div>
