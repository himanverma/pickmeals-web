<?php echo $this->element('admin_header'); ?>
<div class="wrapper row-offcanvas row-offcanvas-left">
    <?php echo $this->element('admin_side'); ?>
    <aside class="right-side">
        <section class="content-header">
            <h1>
                Categories
                <small>it all starts here</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo $this->Html->url('/admin/categories/add'); ?>"><i class="fa fa-dashboard"></i> Add New</a></li>
            </ol>
            <div class="categories index">
                <script type="text/javascript">
                    jQuery.expr[':'].contains = function(a, i, m) {
                        return jQuery(a).text().toUpperCase().indexOf(m[3].toUpperCase()) >= 0;
                    };
                    $(document).ready(function() {
                        $('input[name="search"]').keyup(function() {
                            var searchterm = $(this).val();
                            if (searchterm.length > 2) {
                                var match = $('tr.data-row:contains("' + searchterm + '")');
                                var nomatch = $('tr.data-row:not(:contains("' + searchterm + '"))');
                                match.addClass('selected');
                                nomatch.css("display", "none");
                            } else {
                                $('tr.data-row').css("display", "");
                                $('tr.data-row').removeClass('selected');
                            }
                        });
                    });
                </script>
                <p>
                    <br/>
                    <input type="text" name="search" placeholder="Search Here!!!"/>
                </p>
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
                    ?>	
                </p>
                <div class="paging">
                    <?php
                    echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
                    echo $this->Paginator->numbers(array('separator' => ''));
                    echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
                    ?>
                </div>
            </div>
    </aside>
</div>
