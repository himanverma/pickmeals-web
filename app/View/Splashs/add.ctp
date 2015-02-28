<div class="categories form">
<?php echo $this->Form->create('Splash',array('type'=>'file')); ?>
	<fieldset>
		<legend><?php echo __('Add Splash'); ?></legend>
	<?php
		echo $this->Form->input('file',array('type'=>'file'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>