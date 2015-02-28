<div class="errorlogs view">
<h2><?php echo __('Errorlog'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($errorlog['Errorlog']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Log'); ?></dt>
		<dd>
			<?php echo h($errorlog['Errorlog']['log']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($errorlog['Errorlog']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>