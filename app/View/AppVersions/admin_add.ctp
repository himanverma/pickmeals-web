<div class="appVersions form">
<?php echo $this->Form->create('AppVersion'); ?>
	<fieldset>
		<legend><?php echo __('Admin Add App Version'); ?></legend>
	<?php
		echo $this->Form->input('version');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List App Versions'), array('action' => 'index')); ?></li>
	</ul>
</div>
