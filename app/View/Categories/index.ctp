
<div class="categories index">
	<h2><?php echo __('Categories'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('parent_id'); ?></th>
                        <th><?php echo $this->Paginator->sort('name'); ?></th>
                        <th><?php echo $this->Paginator->sort('status'); ?></th>
                        <th class="actions"  style="text-align: center"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($categories as $category): ?>
            <tr class="data-row">
		<td>
                                    <?php echo $this->Html->link($category['ParentCategory']['name'], array('controller' => 'categories', 'action' => 'view', $category['ParentCategory']['id'])); ?>
                                </td>
                                <td><?php echo h($category['Category']['name']); ?>&nbsp;</td>
                                <td><?php
                                    if ($category['Category']['status'] == 1) {
                                        echo "Active";
                                    } else {
                                        echo "Deactive";
                                    }
                                    ?>&nbsp;</td>
                                <td class="actions">
                                    <?php echo $this->Html->link(__('Add File'), array('controller'=>'catFiles','action' => 'add', $category['Category']['id'])); ?>
                                    <?php echo $this->Html->link(__('View'), array('action' => 'view', $category['Category']['id'])); ?>
                                    <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $category['Category']['id'])); ?>
                            <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $category['Category']['id']), array(), __('Are you sure you want to delete # %s?', $category['Category']['id'])); ?>
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