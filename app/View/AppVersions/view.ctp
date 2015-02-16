<div class="appVersions view">
<h2><?php echo __('App Version'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($appVersion['AppVersion']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Version'); ?></dt>
		<dd>
			<?php echo h($appVersion['AppVersion']['version']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit App Version'), array('action' => 'edit', $appVersion['AppVersion']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete App Version'), array('action' => 'delete', $appVersion['AppVersion']['id']), array(), __('Are you sure you want to delete # %s?', $appVersion['AppVersion']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List App Versions'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New App Version'), array('action' => 'add')); ?> </li>
	</ul>
</div>
