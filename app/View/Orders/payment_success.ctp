
<div class="col-sm-2"></div>



<div class="col-sm-8">
    <div class="order_success_in">
        <div class="order_success_title">
            <h1>Your order has been received Successfully</h1>
        </div>
        <div class="order_success_review">
            <div class="order_success_review_in">
                <h3>Order ID:<b><?php echo $oid; ?></b></h3>
            </div>
            
            <div class="sucess-order">
                <div class="row">
                    <div>
                        <div id="cart-sec-2">
                            <div class="col-sm-12">
                                <div class="col-sm-1"><h4>Items</h4></div>
                                <div class="col-sm-offset-8 col-sm-3"><h4>Price</h4></div>
                            </div>
                                
                            <!-- ko foreach: items -->
                            <div style="margin: 2px 0; background: #eee;" class="col-sm-12">
                                <div class="col-sm-1">
                                    <h4><!-- ko text: $index() + 1 -->1<!-- /ko -->)</h4>
                                </div>
                                <div class="col-sm-2">
                                     <img width="65px" onerror="javascript: this.src = '/img/panner.jpg'" src="/img/product.png">
                                </div>
                                <div id="" class="col-sm-6">
                                    <div class="row">
                                        <div data-bind="text:data.Combination.display_name">FULL Dal Fried (Yellow)</div>
                                        <div data-bind="text:data.essentials">4 Roti + Half Rice</div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <h4><span style="font-weight:bold" class="">Rs.<span data-bind="text:price">2</span> X <span data-bind="text:qty">1</span> = Rs.<span data-bind="text:price() * qty()">2</span></span></h4><h4>
                                </h4></div>

                            </div>
                            <!-- /ko -->
                            <div style="margin: 2px 0; background: #eee;" class="col-lg-12">
                                <div class="col-sm-3">
                                </div>
                                <div id="" class="col-sm-6">
                                    <h6><div>TOTAL:</div></h6>
                                </div>
                                <div class="col-sm-3">
                                    <h4><span style="font-weight:bold" class="">Rs.<span data-bind="text: total()">2</span></span></h4>
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
                                    <!-- ko text: fname -->Rajan<!-- /ko --> <!-- ko text: lname -->Khokhar<!-- /ko -->
                                </p>
                                <!-- ko text: address -->Futurework Pvt. Ltd. 4th Floor Plot-10<!-- /ko -->, <!-- ko text: area -->IT Park (Rajiv Gandhi Technology Park)<!-- /ko -->, <!-- ko text: city -->Chandigarh<!-- /ko --> (<!-- ko text: zip -->1610101<!-- /ko -->)
                                <p style="font-weight: bold;"> 
                                    Mobile No: <!-- ko text: phone -->+91-8699445905<!-- /ko -->
                                </p>
                                <p></p>
                                <p style="font-weight: bold;"> 
                                    Payment Mode: <!-- ko text: payment_mode -->Online Payment<!-- /ko -->
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                <div>

                </div>
            </div>
            
            <pre>
                <?php 
                    print_r($orders);
                    
                ?>
            </pre>
            
        </div>
    </div>
</div>

<div class="col-sm-2"></div>
