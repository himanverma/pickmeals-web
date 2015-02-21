<div class="categories form">
<?php echo $this->Form->create('Category'); ?>
	<fieldset>
		<legend><?php echo __('Edit Category'); ?></legend>
	<?php
                echo $this->Form->input('parent_id', array(
                        'options' => $parentCategories
                    ));
                echo $this->Form->input('name');
	        echo $this->Form->input('status');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>