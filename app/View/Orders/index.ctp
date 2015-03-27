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

                foreach ($orders as $orderO) {
                    $cnt++;
                    $cls = ($cnt % 2) ? "box-primary" : "box-info";
                    ?>
                    <div class="box <?php echo $cls; ?> collapsed-box">
                        <div class="box-header">
                            <h3 class="box-title">
                                Order ID : <?php echo $orderO['Order']['sku']; ?> (<?php echo $orderO['Order']['payment_status']; ?>)

                            </h3>
                            <div class="box-tools pull-right">
                                <?php echo $orderO['Order']['created']; ?>

                                <?php
                                echo $this->Form->postLink(
                                        $orderO['Order']['payment_status'] == "PENDING" ? "Mark as Paid" : "Mark as Pending"
                                        , array('action' => 'changepaymentstatus', $orderO['Order']['id'] . "," . $orderO['Order']['customer_id']), array('class' => "btn btn-" . ($orderO['Order']['payment_status'] == "PENDING" ? "warning" : "success")), __('Are you sure?', $orderO['Order']['customer_id']));
                                ?>
<!--                                <a href="<?php echo $this->Html->url('/order/edit/' . $orderO['Order']['sku']); ?>" class="btn btn-default btn-sm">Edit</a>-->
                                <?php if($orderO['Order']['responded'] == 0){ ?>
                                <button data-sku="<?php echo $orderO['Order']['sku']; ?>" data-widget="collapse" class="btn btn-warning btn-sm respond-odr">RESPOND</button>
                                <?php } ?>
                                <button data-widget="collapse" class="btn btn-default btn-sm"><i class="fa fa-plus"></i> Expand</button>
                                <?php if($orderO['Order']['long'] != "0.0" && $orderO['Order']['long'] != ""){ ?>
                                <button class="btn btn-default btn-sm direction-mp" data-lng="<?php echo $orderO['Order']['long']; ?>" data-lat="<?php echo $orderO['Order']['lat']; ?>"><i class="fa fa-map-marker"></i> Navigate</button>
                                <?php } ?>
                                <button data-widget="remove-me" data-url="<?php echo $this->Html->url('/orders/delete/' . $orderO['Order']['sku']); ?>" data-id="<?php echo $orderO['Order']['id']; ?>" class="btn btn-default btn-sm"><i class="fa fa-times"></i> Delete</button>
                            </div>
                        </div>
                        <div class="box-body" style="display: none;">
                            <?php
                            $smsString = array();
                            $totalCost = 0;

                            App::uses("Order", "Model");
                            $odrMdl = new Order();
                            $rO = $odrMdl->find("all", array(
                                "conditions" => array(
                                    "Order.sku" => $orderO['Order']['sku'],
                                ),
                                "contain" => array(
                                    "Combination.Vendor",
                                    "Address",
                                    "Customer"
                                ),
                                "order" => "Order.timestamp DESC"
                            ));
                            foreach ($rO as $order) {
                                $smsString[] = array(
                                    'R' => $order['Combination']['Vendor']['name'],
                                    'P' => $order['Order']['price'] . " x " . $order['Order']['qty'] . "Pcs",
                                    'D' => $order['Combination']['display_name'],
                                    'E' => $order['Order']['essentials']
                                );
                                $totalCost += $order['Order']['price'] * $order['Order']['qty'];
                                ?>

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
                                    <!-- Right Col -->
                                    <div class="col-md-6">
                                        <div class="box box-solid">
                                            <div class="box-header">
                                                <h3 class="box-title">Order Details</h3>
                                            </div><!-- /.box-header -->
                                            <div class="box-body">
                                                <table class="table table-bordered">
                                                    <tbody>
                                                        <tr>
                                                            <th>
                                                                <img src="<?php echo $order['Combination']['image']; ?>" />
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
                                                            <th>Unit Price</th>
                                                            <td><?php echo $order['Combination']['price']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Quantity</th>
                                                            <td><?php echo $order['Order']['qty']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th><b>Total Payable Amount</b></th>
                                                            <td><?php echo $order['Combination']['price'] * $order['Order']['qty']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Paid Via.</th>
                                                            <td><?php echo $order['Order']['paid_via']; ?></td>
                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <?php } ?>

                            <div class="row">
                                <form method="post" class="smsDelivery" action="/orders/smsdeliver">
                                    <div class="box box-solid">
                                        <div class="box-header">
                                            <h3 class="box-title">Send SMS To Delivery Boy</h3>
                                        </div><!-- /.box-header -->
                                        <div class="box-body">
                                            <table class="table table-bordered">
                                                <tbody>
                                                    <tr>
                                                        <th>Mobile No.</th>
                                                        <td>
                                                            <input type="text" id="datanum" value="" placeholder="Eg. 8699445905" name="data[num]" />
                                                            <select onchange="javascript: $(this).prev().val($(this).val())">
                                                                <option value="">--Select Delivery Boy--</option>
                                                                <?php foreach ($dboys as $dboy) { ?>
                                                                    <option value="<?php echo $dboy['DeliveryBoy']['mobile_number']; ?>"><?php echo $dboy['DeliveryBoy']['name']; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2">
                                                            <textarea rows="7" name="data[msg]" style="width: 100%">M: <?php echo $order['Address']['phone_number']; ?> 
        N: <?php echo $order['Address']['f_name'] . " " . $order['Address']['l_name']; ?> 
        A: <?php echo $order['Address']['address']; ?> 
        O: <?php echo $order['Order']['sku']; ?> 
                                                                <?php echo "Rs. " . ($totalCost - $order['Order']['discount_amount'] <= 0 ? 0 : $totalCost - $order['Order']['discount_amount']) . "/- " . $order['Order']['paid_via']; ?> 
                                                                <?php foreach ($smsString as $sm) { ?>

                R: <?php echo $sm['R']; ?> 
                P: <?php echo $sm['P']; ?> 
                D: <?php echo $sm['D']; ?> / <?php echo $sm['E']; ?> 
                                                                <?php } ?></textarea>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="box-footer">
                                            <div class="pull-right"><button class="btn btn-default sbmt-btn" type="submit">Send SMS</button></div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php } ?>



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
        </div>
    </div>
</div>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.form/3.51/jquery.form.min.js"></script>
<script type="text/javascript">
//    alert('web');
//    var myCords = {
//      lat: 0,
//      lng: 0
//    };
//    var pos = false;
    
    //--- Cordova init
//    function onDeviceReady() {
//        $('.direction-mp').on("click", function() {
//            myCords.lat = parseFloat($(this).data('lat'));
//            myCords.lng = parseFloat($(this).data('lng'));
//            launchnavigator.navigate(
//                [myCords.lat,myCords.lng],
//                null,
//                function(){
////                    alert("Plugin success");
//                },
//                function(error){
////                    alert("Plugin error: "+ error);
//            });
//        });
//    }
//    
//    document.addEventListener("deviceready", onDeviceReady, false);
    //-- Cordova Over
    
    $(document).ready(function() {
        $('.smsDelivery').ajaxForm({
            beforeSubmit: function(arr, $form, options) {
                $($form).find('.sbmt-btn').addClass("disabled");
            },
            success: function(d) {
                if (d.error == 0) {
                    alert(d.msg.api_response);
                } else {
                    alert(d.msg);
                }
                $('.sbmt-btn').removeClass('disabled');
            }
        });
        
        $('#map-your-loc').on("click", function() {
            if(myCords.lat != 0){
                map.setCenter(new google.maps.LatLng(myCords.lat, myCords.long));
            }else{
                alert('Location not found...');
            }
        });
        $('#map-dest-loc').on("click", function() {
            if(pos){
                map.setCenter(new google.maps.LatLng(pos.coords.latitude, pos.coords.longitude));
            }else{
                alert('Location not found...');
            }
        });
        $('#map-hide').on("click", function() {
            $('#map-canvas, #gvm-panel').hide();
            $('.gv-pnl').show();
            $('html, body').removeClass('mp-visible');
        });
        
        $('.respond-odr').on("click",function(){
            var sku = $(this).data('sku');
            $.post("<?php echo $this->Html->url('/orders/respond'); ?>",{'data[sku]':sku}, function(d){
                
            });
            $(this).remove();
        });
        

    });
    
    
    

</script>
<style type="text/css">
    .mp-visible{
        height: 100% !important;
    }
    #map-canvas {
        height: 100%;
        margin: 0px;
        padding: 0px
    }
    #gvm-panel {
        position: absolute;
        top: 5px;
        left: 0;
        width: 100%
        /*margin-left: -180px;*/
        z-index: 5;
        background-color: #fff;
        padding: 5px;
        border: 1px solid #999;
      }
</style>