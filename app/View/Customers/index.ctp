<section class="content-header">
    <h1>
        Customers List
        <small>List of all registered customers </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="/customers">Customers</a></li>
    </ol>
</section>
<div class="box box-solid">
    <div class="box-header">

    </div>
    <div class="box-body">
        <table class="table table-bordered table-hover">
            <thead>
            <th><?php echo $this->Paginator->sort('id'); ?></th>
            <th><?php echo $this->Paginator->sort('deviceId'); ?></th>
            <th><?php echo $this->Paginator->sort('name'); ?></th>
            <th><?php echo $this->Paginator->sort('photo'); ?></th>
            <th><?php echo $this->Paginator->sort('email'); ?></th>
            <th><?php echo $this->Paginator->sort('mobile_number'); ?></th>

            <th><?php echo $this->Paginator->sort('pin_code'); ?></th>
            <th><?php echo $this->Paginator->sort('address'); ?></th>
            <th><?php echo $this->Paginator->sort('city'); ?></th>
            <th><?php echo $this->Paginator->sort('state'); ?></th>
            <th><?php echo $this->Paginator->sort('country'); ?></th>
            <th><?php echo $this->Paginator->sort('status'); ?></th>
            <th class="actions"><?php echo __('Actions'); ?></th>
            </thead>
            <tbody>
                <?php foreach ($customers as $customer): ?>
                    <tr>
                        <td><?php echo h($customer['Customer']['id']); ?>&nbsp;</td>
                        <td><?php echo h($customer['Customer']['deviceId']); ?>&nbsp;</td>
                        <td><?php echo h($customer['Customer']['name']); ?>&nbsp;</td>
                        <td><?php echo h($customer['Customer']['photo']); ?>&nbsp;</td>
                        <td><?php echo h($customer['Customer']['email']); ?>&nbsp;</td>
                        <td><?php echo h($customer['Customer']['mobile_number']); ?>&nbsp;</td>
                        <td><?php echo h($customer['Customer']['pin_code']); ?>&nbsp;</td>
                        <td><?php echo h($customer['Customer']['address']); ?>&nbsp;</td>
                        <td><?php echo h($customer['Customer']['city']); ?>&nbsp;</td>
                        <td><?php echo h($customer['Customer']['state']); ?>&nbsp;</td>
                        <td><?php echo h($customer['Customer']['country']); ?>&nbsp;</td>
                        <td><?php echo h($customer['Customer']['status']); ?>&nbsp;</td>
                        <td class="actions">
                            <?php echo $this->Html->link(__('View'), array('action' => 'view', $customer['Customer']['id'])); ?>
                            <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $customer['Customer']['id'])); ?>
                            <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $customer['Customer']['id']), array(), __('Are you sure you want to delete # %s?', $customer['Customer']['id'])); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="box-footer">
        <div class="customers index">
            <h2><?php echo __('Customers'); ?></h2>

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
            <?php echo $this->Html->link(__('New Customer'), array('action' => 'add')); ?>
                <?php echo $this->Html->link(__('List Orders'), array('controller' => 'orders', 'action' => 'index')); ?> 
                <?php echo $this->Html->link(__('New Order'), array('controller' => 'orders', 'action' => 'add')); ?>
                <?php echo $this->Html->link(__('List Vendor Reviews'), array('controller' => 'vendor_reviews', 'action' => 'index')); ?> 
                <?php echo $this->Html->link(__('New Vendor Review'), array('controller' => 'vendor_reviews', 'action' => 'add')); ?> 
        </div>
    </div>
</div>



