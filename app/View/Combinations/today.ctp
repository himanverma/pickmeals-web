<div class="combinations index">
	<h2><?php echo __('Combinations'); ?></h2>
        <div class="well">
            <form method="post">
                <div class="form-group">
                    <input type="text" name="data[keyword]" class="form-control" placeholder="keyword..." />
                </div>
                <div class="form-group">
                    <select name="data[field]" class="form-control">
                        <option value="Combination.display_name">Display Name</option>
                        <option value="Vendor.name">Vendor Name</option>
                        <option value="Combination.stock_count">Stock Count</option>
                        <option value="Combination.Price">Price</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </div>
        <div class="well">
            <div class="btn-group">
                <button class="btn btn-warning" id="hideSelected">Hide Selected</button>
                <button class="btn btn-success" id="showSelected">Show Selected</button>
                <button class="btn btn-danger" id="deleteSelected">Delete Selected</button>
            </div>
        </div>
        
        <table cellpadding="0" class="table table-bordered" cellspacing="0">
	<thead>
	<tr>
             <th>
                <input type="checkbox" id="allChk" />
            </th>
            
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('vendor_id'); ?></th>
			<th><?php echo $this->Paginator->sort('display_name'); ?></th>
			<th><?php echo $this->Paginator->sort('day'); ?></th>
			<th><?php echo $this->Paginator->sort('date'); ?></th>
                        <th><?php echo $this->Paginator->sort('stock_count'); ?></th>
			<th><?php echo $this->Paginator->sort('price'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($combinations as $combination): ?>
	<tr class="<?php echo $combination['Combination']['visible'] == 0 ? "bg-orange" : ""; ?>">
                 <td>
                    <input type="checkbox" class="deleteSel" name="ids[]" value="<?php echo h($combination['Combination']['id']); ?>" />
                </td>
		<td><?php echo h($combination['Combination']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($combination['Vendor']['name'], array('controller' => 'vendors', 'action' => 'view', $combination['Vendor']['id'])); ?>
		</td>
		<td><?php echo h($combination['Combination']['display_name']); ?>&nbsp;</td>
		<td><?php echo h($combination['Combination']['day']); ?>&nbsp;</td>
                <td title="<?php echo h($combination['Combination']['date']); ?>"><?php echo $this->Time->timeAgoInWords($combination['Combination']['date']); ?>&nbsp;</td>
                <td class="stk-upd">
                    <div style="height:12px" align="center">
                        <img style="display:none;" src="/img/1.gif" />
                    </div>
                    <input type="number" style="width:69px;" min="0" c data-id="<?php echo h($combination['Combination']['id']); ?>" value="<?php echo $combination['Combination']['stock_count']; ?>" />
                </td>
		<td><?php echo h($combination['Combination']['price']); ?>&nbsp;</td>
		<td><?php echo h($combination['Combination']['status']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $combination['Combination']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $combination['Combination']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $combination['Combination']['id']), array(), __('Are you sure you want to delete # %s?', $combination['Combination']['id'])); ?>
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


<script type="text/javascript">
    var stk = null;
    $(document).ready(function(){
        $("#deleteSelected").on("click",function(){
            var ids = [];
            $('.deleteSel:checked').each(function(){
               ids.push($(this).val()); 
            });
            $.post("/combinations/deleteSelected",{"data[ids]":ids},function(d){
               window.location.reload();
            });
        });
        $("#hideSelected").on("click",function(){
            var ids = [];
            $('.deleteSel:checked').each(function(){
               ids.push($(this).val()); 
            });
            $.post("/combinations/hideSelected",{"data[ids]":ids},function(d){
               window.location.reload();
            });
        });
        $("#showSelected").on("click",function(){
            var ids = [];
            $('.deleteSel:checked').each(function(){
               ids.push($(this).val()); 
            });
            $.post("/combinations/showSelected",{"data[ids]":ids},function(d){
               window.location.reload();
            });
        });
        
        $('#allChk').on("ifChanged",function(){
           if($(this).is(":checked")){
               $('.deleteSel').prop('checked',true);
           }else{
               $('.deleteSel').prop('checked',false);
           }
           $(".deleteSel").iCheck({
                checkboxClass: 'icheckbox_minimal',
                radioClass: 'iradio_minimal'
            });
        });
        
        $('.stk-upd input').on("change",function(){
            var me = $(this);
            me.parent().find('img').show();
            try{
                stk.abort();
            }catch(e){}
            stk = $.post("<?php echo $this->Html->url('/combinations/upd');?>",{id:$(this).data('id'),val:$(this).val()},function(){
                me.parent().find('img').hide();
            });
        });
    });
</script>    