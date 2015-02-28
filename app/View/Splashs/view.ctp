<div class="splashs view">
<h2><?php echo __('Splash'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($splash['Splash']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Splash Image'); ?></dt>
		<dd>
                    <img src="<?php echo h($splash['Splash']['file']); ?>" width="50%" height="50%" />
			&nbsp;
		</dd>
	</dl>
</div>
