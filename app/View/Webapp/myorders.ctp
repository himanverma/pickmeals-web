<div class="user_list_main">
    <?php foreach ($orders as $order): ?>    
        <div class="user_list">
            <div class="user_list_title">
                <h3><?php echo $order['Combination']['display_name']; ?></h3>
                <h6>with <?php echo $order['Order']['essentials']; ?></h6>
            </div>
            <div class="col-sm-2 my_accountt_p">
                <div class="row">
                    <div class="user_list_left"><img src="<?php echo $order['Combination']['image'] == "" ? '/img/product.png' : $order['Combination']['image']; ?>" /> </div>
                </div>
            </div>
            <div class="col-sm-7 col-md-5 my_account_detaill">
                <div class="row">
                    <div class="user_list_right">
                        <ul>
                            <li>
                                <p>By <a href="/chef/<?php echo strtolower(str_replace(" ", "-",$order['Combination']['Vendor']['name'])); ?>"><?php echo $order['Combination']['Vendor']['name']; ?></a></p>
                            </li>
                            <li>
                                <h2><span>Order date:</span><?php echo date("d-m-Y h:i A", $order['Order']['timestamp']); ?></h2>
                            </li>
                            <li>
                                <h4><span>Location:</span><?php echo $order['Address']['address'] . ", " . $order['Address']['city']; ?></h4>
                            </li>
                            <li>
                                <h1><span>Mobile No.:</span><?php echo $order['Address']['phone_number']; ?></h1>
                            </li>
                            <li>
                                <h5><span>Quantity:</span><?php echo $order['Order']['qty']; ?></h5>
                            </li>
                            <li>
                                <h3><span>Price:</span>Rs <?php echo $order['Order']['price']; ?></h3>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 web_boxx my_account_detaill_rating">
                <div class="chef_food_rating">
                    <?php 
                        $rvew = null;
                        $flag = true;
                        foreach ($order['Combination']['Review'] as $rv){
                            if($rv['customer_id'] == AuthComponent::user('id')){
                                $flag = false;
                                $rvew = $rv;
                            }
                        }
                        if($flag){
                    ?>
                    <div class="btn-group">
                        <button id="feedback_btn" type="button" data-id="<?php echo $order['Order']['id']; ?>" class="feedback_btn-c">
                            Leave Feedback
                        </button>
                             
                        <div id="feedback_block" class="feedback_block-c fblk-ii-<?php echo $order['Order']['id']; ?>">
                            <span class="feedback_block_comment">
                                <textarea name="data[Review][review]" placeholder="Comment..."></textarea>
                            </span>
                            <span class="feedback_block_rating">
<!--                                <img src="img/rating.png">-->
                                <input type="hidden" name="data[Review][ratings]" value="0" id="backing<?php echo $order['Order']['id']; ?>">
                                <input type="hidden" name="data[Review][order_id]" value="<?php echo $order['Order']['id']; ?>" >
                            </span>
                            <span class="feedback_block_submit">
                                <button type="button" class="send-review">Submit</button>
                                <input type="hidden" name="data[Review][combination_reviewkey]" value="<?php echo $order['Combination']['reviewkey']; ?>" />
                                <input type="hidden" name="data[Review][vendor_id]" value="<?php echo $order['Combination']['Vendor']['id']; ?>" />
                            </span>
                        </div>
                    </div>
                    <?php }else{ ?>
                    <div>
                        <span class="rateit" data-rateit-value="<?php echo $rvew['ratings']; ?>" data-rateit-ispreset="true" data-rateit-readonly="true"></span>&nbsp;&nbsp;&nbsp;&nbsp;(<?php echo $rvew['ratings']; ?>)<br>
                        <p><?php echo $rvew['review']; ?></p>
                    </div>
                    <?php } ?>
                </div>  
            </div>
        </div>
    <?php endforeach; ?>    
</div>

<?php
if (count($orders) == 0) {
    echo "<br><br><br><center><b>You had no orders yet...</b></center>";
} else {
    ?>
    <div>
        <p>
            <?php
            echo $this->Paginator->counter(array(
                'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
            ));
            ?>	
        </p>
        <ul class="pagination" >
            <?php
            //echo $this->Paginator->sort('Rug.price', "Price", array('class' => "glyphicon glyphicon-sort btn btn-primary"));

            echo $this->Paginator->first(__('<< First', true), array('tag' => 'li'), array('tag' => 'li', 'class' => 'number-first'));
            echo $this->Paginator->prev('< ', array('tag' => 'li', 'disabledTag' => 'a'), null, array('disabledTag' => 'a', 'tag' => 'li', 'class' => 'prev disabled'));
            echo $this->Paginator->numbers(array('separator' => '', 'tag' => 'li', 'currentTag' => 'a', "modulus" => 5));
            echo $this->Paginator->next(' >', array('tag' => 'li', 'disabledTag' => 'a'), null, array('disabledTag' => 'a', 'tag' => 'li', 'class' => 'next disabled'));
            echo $this->Paginator->last(__('>> Last', true), array('tag' => 'li'), array('tag' => 'li', 'class' => 'number-first'));
            ?>
        </ul>
    </div>
<?php } ?>

<!-- Modal -->
<div class="modal fade" id="leave-f-back" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Leave Feedback</h4>
      </div>
      <div class="modal-body">
          <div class="rateit" style="width:100px; margin: 5px auto;" id="r-rate" data-rateit-backingfld=""></div>
          <textarea id="r-text" style="width:100%" rows="4"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" id="r-send-r"  class="btn btn-primary order_feedback_submit">Submit</button>
      </div>
    </div>
  </div>
</div>



<script type="text/javascript">
    $(document).ready(function() {
        $(".feedback_btn-c").click(function() {            
            //$(".feedback_block-c",$(this).parent()).slideToggle();
            var data = $(this).data();
            $('#r-rate').data({rateitBackingfld:"#backing"+ data.id});
            $(this).parent().find('textarea').val($('#r-text').val());
            $('#leave-f-back').modal('show');
            $('#r-send-r').data({id:data.id});
        });
        $('.rateit').rateit();
        $('#r-send-r').on("click",function(){
            var rid = $(this).data('id');
            var cntr = $('.fblk-ii-'+rid);
            var data = {};
            
            $('.fblk-ii-'+rid).find('textarea').val($('#r-text').val());
            
            $("input, textarea",cntr).each(function(){
                data[$(this).attr('name')] = $(this).val();
            });
            $.post('/webapp/myorders',data,function(d){
               if(d.error == 0){
                   try{
                    var options = {
                         iconUrl: 'https://www.pickmeals.com/img/pickmeals_icon.png',
                         title: 'pickmeals.com',
                         body: d.msg,
                         timeout: 7000,
                         onclick: function() {
                             notification.close();
                         }
                     };
                     $.notification(options);
                    } catch (e) {
                        alert(d.msg);
                    }
                    cntr.parent().remove();
                    window.location = "/myaccount";
               } 
            });
        });
    });
</script>