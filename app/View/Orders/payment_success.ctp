<pre><?php// print_r($orders); exit; ?>
</pre>
<div class="order_success_in">
    <div class="col-xs-12 col-sm-12 col-md-2"></div>



    <div class="col-xs-12 col-sm-12 col-md-8">
        <div class="success-order_main"> 
            <?php foreach($orders as $ord){ ?>
            <div class="col-sm-12">

                <div class="order_success_title">
                    <h1>Your order has been received Successfully</h1>
                </div>
                <div class="order_success_review">
                    <div class="order_success_review_in">
                        <h3>Order ID:<b><?php echo $oid; ?></b></h3>
                        <p>Thank you <b><?php echo $ord['Customer']['name'];?></b> for ordering</p>
                    </div>

                    <div class="sucess-order">
                        <div class="row">
                            <div class="success-order-height">
                                <div class="success_user_list">
                                    <div class="success_user_list_title">
                                        <h3><?php echo $ord['Order']['recipe_names'];?></h3>
                                        <h6><?php echo $ord['Order']['essentials'];?></h6>
                                    </div>
                                    <div class="col-xs-3 col-sm-2">
                                        <div class="row">
                                            <div class="success_user_list_left"><img src="<?php echo $ord['Combination']['image'];?>"> </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-9 col-sm-10">
                                        <div class="row">
                                            <div class="success_user_list_right">
                                                <ul>
                                           
                                                    
                                                    <li>
                                                        <p>By <a href="<?php echo $this->Html->url('/').$ord['Combination']['image'];?>"><?php echo $ord['Combination']['Vendor']['name'];?></a></p>
                                                    </li>
                                                   
                                                    <li>
                                                        <h2><span>Order date:</span><?php echo $ord['Order']['created'];?></h2>
                                                    </li>
                                                    
                                                   
                                                    <li>
                                                        <h6><span>Quantity:</span><?php echo $ord['Order']['qty'];?></h6>
                                                    </li>
                                                    <li>
                                                        <h3><span>Price:</span><?php echo $ord['Order']['price'];?></h3>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="col-sm-12">
                                <div id="address-sec-2" class="sucess-order">
                                    <h5><b>Shipping Address</b></h5>
                                    <div class="row">
                                        <div class="col-lg-10">
                                            <p style="font-weight: bold;"> 
                                             <?php echo $ord['Address']['f_name'];?>&nbsp;<?php echo $ord['Address']['l_name'];?>
                                            </p>
                                            <?php echo $ord['Address']['address'];?> <?php echo $ord['Address']['area'];?>,<?php echo $ord['Address']['city'];?> <?php echo $ord['Address']['zipcode'];?>
                                            <p style="font-weight: bold;"> 
                                                Mobile No:<?php echo $ord['Address']['phone_number'];?>
                                            </p>
                                            <p></p>
                                            <p style="font-weight: bold;"> 
                                                Payment Mode: <?php echo $ord['Order']['paid_via'];?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>

                        </div>
                    </div>

<!--<pre>
                    <?php
                    // print_r($orders);
                    ?>
</pre>
                    -->
                </div>
            </div>
            <?php } ?>
        </div>
    </div>

</div>

<div class="col-xs-12 col-sm-12 col-md-2"></div>

<script type="text/javascript">
    setTimeout(function() {
        try {
            Android.welcome("test");
        } catch (e) {
//            alert(e.message);
        }
    }, 10000);
</script>