<?php 
//debug($orders);
//exit;
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <!--<h3 class="box-title">Hover Data Table</h3>                                    -->
            </div><!-- /.box-header -->
            <div class="box-body table-responsive">
                
                 <?php
                $cnt = 0;
			
                foreach ($orders as $order) {
                    $cnt++;
                    $cls = ($cnt % 2) ? "box-primary" : "box-info";
                    ?>
                <div class="box <?php echo $cls; ?> collapsed-box">
                        <div class="box-header">
                            <h3 class="box-title">
                                Order ID : <?php echo $order['Order']['sku']; ?> (<?php echo $order['Order']['payment_status']; ?>)
                            </h3>
                            <div class="box-tools pull-right">

                                <a href="<?php echo $this->Html->url('/order/edit/' . $order['Order']['sku']); ?>" class="btn btn-default btn-sm">Edit</a>
                                <button data-widget="collapse" class="btn btn-default btn-sm"><i class="fa fa-plus"></i></button>
                                <button data-widget="remove" class="btn btn-default btn-sm"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <div class="box-body" style="display: none;">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="box box-solid">
                                        <div class="box-header">
                                            <h3 class="box-title">Shipping Details</h3>
                                        </div><!-- /.box-header -->
                                        <div class="box-body">
                                            <table class="table table-bordered">
                                                <tbody>
                                                    <tr>
                                                        <th>First Name</th>
                                                        <td><?php echo $order['Address']['f_name']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Last Name</th>
                                                        <td><?php echo $order['Address']['l_name']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Address</th>
                                                        <td><?php echo $order['Address']['address']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Zipcode</th>
                                                        <td><?php echo $order['Address']['zipcode']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Phone No.</th>
                                                        <td><?php echo $order['Address']['phone_number']; ?></td>
                                                    </tr>
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    
                                    
                                    
                                </div>
                                <div class="col-md-6">
                                    <div class="box box-solid">
                                        <div class="box-header">
                                            <h3 class="box-title">Combination Details</h3>
                                        </div><!-- /.box-header -->
                                        <div class="box-body">
                                            <table class="table table-bordered">
                                                <tbody>
                                                    <tr>
                                                        <th>
                                                            <img src="<?php echo $order['Combination']['f_name']; ?>" />
                                                        </th>
                                                        <td>
                                                            <h2><?php echo $order['Combination']['display_name']; ?></h2>
                                                            <b>By- <a href="#"><?php echo $order['Combination']['Vendor']['name']; ?></a></b>
                                                            <p>
                                                                <?php echo $this->Time->timeAgoInWords($order['Combination']['date']); ?>
                                                            </p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Last Name</th>
                                                        <td><?php echo $order['Combination']['l_name']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Address</th>
                                                        <td><?php echo $order['Combination']['address']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Zipcode</th>
                                                        <td><?php echo $order['Combination']['zipcode']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Phone No.</th>
                                                        <td><?php echo $order['Combination']['phone_number']; ?></td>
                                                    </tr>
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <?php } ?>
                
            </div>
        </div>
    </div>
</div>


<div class="orders index">
	<h2><?php echo __('Orders'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			
			<th><?php echo $this->Paginator->sort('customer_id'); ?></th>
			<th><?php echo $this->Paginator->sort('recipe_names'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th><?php echo $this->Paginator->sort('ordered_at'); ?></th>
			<th><?php echo $this->Paginator->sort('ready_at'); ?></th>
			<th><?php echo $this->Paginator->sort('delivered_at'); ?></th>
			<th><?php echo $this->Paginator->sort('lat'); ?></th>
			<th><?php echo $this->Paginator->sort('long'); ?></th>
			<th><?php echo $this->Paginator->sort('status_reason'); ?></th>
			<th><?php echo $this->Paginator->sort('paid_via'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($orders as $order): ?>
	<tr>
		<td><?php echo h($order['Order']['id']); ?>&nbsp;</td>
		
		<td>
			<?php echo $this->Html->link($order['Customer']['name'], array('controller' => 'customers', 'action' => 'view', $order['Customer']['id'])); ?>
		</td>
		<td><?php echo h($order['Order']['recipe_names']); ?>&nbsp;</td>
		<td><?php echo h($order['Order']['status']); ?>&nbsp;</td>
		<td><?php echo h($order['Order']['ordered_at']); ?>&nbsp;</td>
		<td><?php echo h($order['Order']['ready_at']); ?>&nbsp;</td>
		<td><?php echo h($order['Order']['delivered_at']); ?>&nbsp;</td>
		<td><?php echo h($order['Order']['lat']); ?>&nbsp;</td>
		<td><?php echo h($order['Order']['long']); ?>&nbsp;</td>
		<td><?php echo h($order['Order']['status_reason']); ?>&nbsp;</td>
		<td><?php echo h($order['Order']['paid_via']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $order['Order']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $order['Order']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $order['Order']['id']), array(), __('Are you sure you want to delete # %s?', $order['Order']['id'])); ?>
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
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Order'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Vendor Days'), array('controller' => 'vendor_days', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Vendor Day'), array('controller' => 'vendor_days', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Customers'), array('controller' => 'customers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Customer'), array('controller' => 'customers', 'action' => 'add')); ?> </li>
	</ul>
</div>
