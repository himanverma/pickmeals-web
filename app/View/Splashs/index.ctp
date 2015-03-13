
<div class="splashs index">
	<h2><?php echo __('Splash'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
                <th><?php echo $this->Paginator->sort('name'); ?></th>
                <th><?php echo $this->Paginator->sort('status'); ?></th>
                <th class="actions"  style="text-align: center"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($splashs as $splash): ?>
            <tr class="data-row">
                        <td><img src="<?php echo h($splash['Splash']['file']); ?>" width="50" height="50" />&nbsp;</td>
                        <td><?php
                            echo $splash['Splash']['status'];
                            ?>&nbsp;</td>
                        <td class="actions">
                           <?php echo $this->Html->link(__('View'), array('action' => 'view', $splash['Splash']['id'])); ?>
                            <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $splash['Splash']['id'])); ?>
                            <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $splash['Splash']['id']), array(), __('Are you sure you want to delete # %s?', $splash['Splash']['id'])); ?>
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