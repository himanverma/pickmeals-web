<div class="appVersions form">
<?php echo $this->Form->create('AppVersion'); ?>
	<fieldset>
		<legend><?php echo __('Edit App Version'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('version');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('AppVersion.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('AppVersion.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List App Versions'), array('action' => 'index')); ?></li>
	</ul>
</div>
