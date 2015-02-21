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
                <li><a href="<?php echo $this->Html->url('/admin/catFiles/add/'.$category['Category']['id']); ?>"><i class="fa fa-dashboard"></i> Add Cat-Files</a></li>
            </ol>
            <div class="categories view">
                <dl>
                    <dt><?php echo __('Category-Name'); ?></dt>
                    <dd>
                        <?php echo $this->Html->link($category['ParentCategory']['name'], array('controller' => 'categories', 'action' => 'view', $category['ParentCategory']['id'])); ?>
                        &nbsp;
                    </dd>
                    <dt><?php echo __('Link'); ?></dt>
                    <dd>
                        <?php echo h($category['Category']['link']); ?>
                        &nbsp;
                    </dd>
                    <dt><?php echo __('Meta'); ?></dt>
                    <dd>
                        <?php echo h($category['Category']['meta_keyword']); ?>
                        &nbsp;
                    </dd>

                    <dt><?php echo __('Description'); ?></dt>
                    <dd>
                        <?php echo h($category['Category']['meta_description']); ?>
                        &nbsp;
                    </dd>

                    <dt><?php echo __('Name'); ?></dt>
                    <dd>
                        <?php echo h($category['Category']['name']); ?>
                        &nbsp;
                    </dd>
                    <dt><?php echo __('Status'); ?></dt>
                    <dd>
                        <?php if ($category['Category']['status'] == 1) {
                            echo "Active";
                        } else {
                            echo "Deactive";
                        } ?>
                        &nbsp;
                    </dd>
                </dl>
            </div>
            <div class="related">
                <h3><?php echo __('Related Categories'); ?></h3>
<?php if (!empty($category['ChildCategory'])): ?>
                    <table cellpadding = "0" cellspacing = "0">
                        <tr>
                            <th><?php echo __('Parent Id'); ?></th>
                            <th><?php echo __('Lft'); ?></th>
                            <th><?php echo __('Rght'); ?></th>
                            <th><?php echo __('Name'); ?></th>
                            <th><?php echo __('Status'); ?></th>
                            <th class="actions"><?php echo __('Actions'); ?></th>
                        </tr>
    <?php foreach ($category['ChildCategory'] as $childCategory): ?>
                            <tr>
                                <td><?php echo $childCategory['parent_id']; ?></td>
                                <td><?php echo $childCategory['lft']; ?></td>
                                <td><?php echo $childCategory['rght']; ?></td>
                                <td><?php echo $childCategory['name']; ?></td>
                                <td><?php echo $childCategory['status']; ?></td>
                                <td class="actions">
                            <?php echo $this->Html->link(__('View'), array('controller' => 'categories', 'action' => 'view', $childCategory['id'])); ?>
                            <?php echo $this->Html->link(__('Edit'), array('controller' => 'categories', 'action' => 'edit', $childCategory['id'])); ?>
                        <?php echo $this->Form->postLink(__('Delete'), array('controller' => 'categories', 'action' => 'delete', $childCategory['id']), array(), __('Are you sure you want to delete # %s?', $childCategory['id'])); ?>
                                </td>
                            </tr>
    <?php endforeach; ?>
                    </table>
<?php endif; ?>

            </div>
    </aside>
</div>