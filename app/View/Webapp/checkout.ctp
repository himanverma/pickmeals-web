
<div class="col-sm-12">
    <div class="placeorder_title">
        <h1>Place Order</h1>
    </div>
</div>
<div class="col-sm-9">
    <div id="address-sec">

        <div class="placeorder">

            <div class="placeorder_right">
                <div class="placeorder_right_title">
                    <h1>Your delivery address </h1>
                </div>
                <div class="frmct">
                    <?php
                    echo $this->Form->create('Address', array('url' => '/api/addresses/add', 'id' => 'addr-fw-frm'));
                    ?>

                    <ul>
                        <li><label>First Name</label></li>
                        <li><?php echo $this->Form->input("f_name", array('div' => false, 'label' => false, 'data-bind' => "value:fname,validationElement: fname")); ?></li>
                        <li><label>Last Name</label></li>
                        <li><?php echo $this->Form->input("l_name", array('div' => false, 'label' => false, 'data-bind' => "value:lname")); ?></li>
                        <li><label>Address</label></li>
                        <li><?php echo $this->Form->input("address", array('div' => false, 'label' => false, 'data-bind' => "value:address, validationElement: address")); ?></li>
                        <li><label>Area</label></li>
                        <li><?php echo $this->Form->input("area", array('div' => false, 'label' => false, 'data-bind' => "value:area")); ?></li>
                        <li><label>City</label></li>
                        <li><?php echo $this->Form->input("city", array('div' => false, 'label' => false, 'data-bind' => "value:city")); ?></li>
                        <li><label>Zipcode</label></li>
                        <li><?php echo $this->Form->input("zipcode", array('div' => false, 'label' => false, 'data-bind' => "value:zip, validationElement: zip")); ?></li>
                        <li><label>Email ID.</label></li>
                        <li><?php echo $this->Form->input("email", array('div' => false, 'type'=>'text', 'label' => false, 'data-bind' => "value:email, validationElement: email")); ?></li>
                        <li><label>Phone No.</label></li>
                        <li><?php echo $this->Form->input("phone_number", array('div' => false, 'label' => false, 'data-bind' => "value:phone, validationElement: phone")); ?></li>
                        <?php
                        echo $this->Form->input("lat", array('div' => false, 'label' => false, 'data-bind' => "value:lat", 'type' => 'hidden'));
                        echo $this->Form->input("long", array('div' => false, 'label' => false, 'data-bind' => "value:lng", 'type' => 'hidden'));
                        echo $this->Form->input("customer_id", array('div' => false, 'label' => false, 'data-bind' => "value:customer_id", 'type' => 'hidden'));
                        ?>
                    </ul>
                </div>
            </div>

        </div>
        
        <div class="placeorder_right2">
                <div class="placeorder_right_title">
                    <h1>Choose how to pay</h1>
                </div>

                <div class="col-xs-6 col-sm-6 col-md-3">	
                    <div class="payment_option">
                        <input type="radio" name="payment_mode" data-bind="checked:payment_mode " value="Online Payment">
                        <label>Pay online (with PayU money)</label>
                        <span><img src="/img/filepath_7.png"></span>
                    </div>
                </div>

                <!--            <div class="col-sm-3">	
                                <div class="payment_option" name="payment_mode" data-bind="checked:payment_mode " value="Online Payment">
                                    <input type="radio">
                                    <label>Pay online</label>
                                    <span><img src="/img/4.jpg"></span>
                                </div>
                            </div>
                
                            <div class="col-sm-3">	
                                <div class="payment_option">
                                    <input type="radio" name="payment_mode" data-bind="checked:payment_mode " value="Online Payment">
                                    <label>Pay online (with Citibank card)</label>
                                    <span><img src="/img/5.jpg"></span>
                                </div>
                            </div>-->

                <div class="col-xs-6 col-sm-6 col-md-3">	
                    <div class="payment_option">
                        <input type="radio" name="payment_mode" data-bind="checked:payment_mode " value="COD">
                        <label>Cash On Delivery</label>
                        <span><img src="/img/1.png"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-offset-4 col-sm-4">
                        <div class="payment_checkout1">
                            <div style="padding-bottom: 24px;" class="bs-example">
                                <button class="payment_checkout1_button" class="btn btn-primary" data-bind="click: makeOrder" type="button">Place order</button>
                            </div>
                        </div>
                    </div>
                </div>                                        	
            </div>

    </div>
</div>
<div class="col-sm-3">
    <div id="cart-sec">
        <div class="row">
            <div class="home_content_right">

                <div id="sidebar">
                    <div class="sidebar_main">

                        <div class="home_content_right_title">
                            <h3>Cart</h3>
                        </div>
                        <div class="sidebar_order_list_main" data-bind="foreach:items">
                            <div class="sidebar_order_list" >
                                <div class="col-sm-2 sidebar_order_1"><p class="order_list_sr" data-bind="text:qty">1</p></div>
                                <div class="col-sm-6 sidebar_order_2">
                                    <div class="row">
                                        <p class="order_list_product" data-bind="text:data.Combination.display_name">Manchow Soup Veg.</p>
                                    </div>
                                </div>
                                <div class="col-sm-4 sidebar_order_3">
                                    <p class="order_list_price pull-right" style="font-weight: bold;">Rs.
                                        <!-- ko text: data.Combination.price * qty() --><!-- /ko -->
                                    </p>
                                </div>
                                <div class="col-sm-12 sidebar_order_4">
                                    <div class="order_list_add">
                                        <button class="badge1" data-bind="click: $root.increase">+</button>
                                        <button class="badge1" data-bind="click: $root.decrease">-</button>
                                        <span class="pull-right">
                                            <?php /*<select data-bind="value:data.essentials,event:{'change':$root.updateEss}, ">
                                                <option value="4 Roti + Half Rice">4 Roti + Half Rice</option>
                                                <option value="6 Roti">6 Roti</option>
                                                <option value="Full Rice">Full Rice</option>
                                            </select>
                                             * 
                                             */?>
                                        </span>
                                    </div>
                                </div>
                            </div>




                        </div>

                        <div class="order_total">
                            <ul>

                                <li><label>Delivery fee </label><p>FREE</p></li>
                                <li><label><b>Total (to be rounded off)</b></label><p><b >Rs. <!-- ko text: total --><!-- /ko --></b></p></li>
                            </ul>
                            <div class="order_checkout">
                                <!--                                                        <button type="button" class="">Proceed to checkout</button>-->
                                <button type="button" data-bind="click: viewItemsClick, text: ko.computed(function(){return viewItems() ? 'Hide Cart' : 'View Cart';})" class="view_cart" style="padding-right: 0 !important;">View Cart</button>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


<div aria-hidden="true" aria-labelledby="exampleModalLabel" role="dialog" tabindex="-1" id="order-cnfrm-mdl" class="modal fade" style="display: none;">
    <div class="checkout-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="checkout-head">
                    <p class="checkout-oder-confirm">Order Confirmation</p>
                    <p class="checkout-oder-id">Order ID: <span id="pk-fw-odr-id"></span></p>
<!--              <button data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>-->
                </div>
            </div>
            <div class="modal-body checkout-body">
                <div class="row">
                    <div>
                        <div id="cart-sec-2">
                            <div class="checkout-title">
                                <div class="col-xs-1 col-sm-2 col-md-1"><h4>Items</h4></div>
                                <div class="col-xs-offset-8 col-xs-2 col-sm-offset-7 col-sm-3 col-md-offset-8 col-md-3"><h4><span>Price</span></h4></div>
                            </div>

                            <!-- ko foreach: items -->
                            <div class="checkout-list-main">


                                <div class="col-xs-1 col-sm-1">
                                    <h4><!-- ko text: $index() + 1 --><!-- /ko -->)</h4>
                                </div>
                                <div class="col-xs-4 col-sm-2">
                                    <img data-bind="attr:{'src':ko.computed(function(){return $root.dynamicSrc(data.Combination.image, data.essentials())})}" onerror="this.src='img/panner.jpg'"width="65px" />
                                </div>
                                <div class="col-xs-6 col-sm-6 padding-none" id="">
                                    <div data-bind="text:data.Combination.display_name"></div>
                                    <div data-bind="text:data.essentials"></div>
                                </div>
                                <div class="col-sm-3">
                                    <h4><span class="" style="font-weight:bold">Rs.<span data-bind="text:price"></span> X <span data-bind="text:qty"></span> = Rs.<span data-bind="text:price() * qty()"></span></span><h4>
                                            </div>


                                            </div>
                                            <!-- /ko -->
                                            <div class="checkout-total">

                                                <div class="col-xs-2 col-sm-3 col-md-3">
                                                </div>
                                                <div class="col-xs-7 col-sm-7 col-md-6" id="">
                                                    <h6><div>TOTAL:</div></h6>
                                                </div>
                                                <div class="col-xs-3 col-sm-2 col-md-3">
                                                    <h4><span class="" style="font-weight:bold">Rs.<span data-bind="text: total()"></span></span></h4>
                                                </div>

                                            </div>

                                            </div>
                                            </div>

                                            <div class="col-sm-12 col-md-6">
                                                <div class="checkout-shiping" id="address-sec-2">
                                                    <h5><b>Shipping Address</b></h5>
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <p style="font-weight: bold; border-bottom: 1px solid #dcdcdc; padding: 2%;"> 
                                                                <!-- ko text: fname --><!-- /ko --> <!-- ko text: lname --><!-- /ko -->
                                                            </p>
                                                            <p style="border-bottom: 1px solid #dcdcdc;padding: 2%;"> 
                                                                <!-- ko text: address --><!-- /ko -->, <!-- ko text: area --><!-- /ko -->, <!-- ko text: city --><!-- /ko --> (<!-- ko text: zip --><!-- /ko -->)
                                                            </p>
                                                            <p style="font-weight: bold;border-bottom: 1px solid #dcdcdc; color: #999;padding: 2%;"> 
                                                                Mobile No: <!-- ko text: phone --><!-- /ko -->
                                                            </p>
                                                            <p></p>
                                                            <p style="font-weight: bold;border-bottom: 1px solid #dcdcdc;color: #999;padding: 2%;"> 
                                                                Payment Mode: <!-- ko text: payment_mode --><!-- /ko -->
                                                            </p>
                                                            <span class="checkout-terms"><input type="checkbox"><h2>I have read and agree to the <a href="/terms-and-conditions" target="_new">Terms & Conditions</a>.</h2></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6"></div>
                                            </div>
                                            <div>

                                            </div>
                                            </div>
                                            <div class="modal-footer checkout-footer">
                                                <button onclick="AddressObj.editAgain()" type="button" class="checkout-edit">Edit</button>
                                                &nbsp;
                                                <button onclick="AddressObj.saveAddress()" type="button" class="checkout-confirm">Confirm</button>
                                            </div>
                                            </div>
                                            </div>
                                            </div>



                                            <script type="text/javascript">

                                                var pk_fw_login = 0;
                                                var AddressVM = function() {
                                                    var me = this;
                                                    me.orderId = ko.observable(0);
                                                    me.orderId.subscribe(function(d) {
                                                        $('#pk-fw-odr-id').html(d);
                                                    });
                                                    me.fname = ko.observable('<?php $nm = explode(" ", $me['name']);
                        echo @$nm[0];
                        ?>').extend({
                                                        required: {message: 'Please fill your name.'},
                                                        minLength: {params: 4, message: "Name must be at least 4 characters long."}
                                                    });
                                                    me.lname = ko.observable('<?php echo @$nm[1]; ?>');
                                                    me.city = ko.observable('<?php echo $me['city'] ?>');
                                                    me.address = ko.observable('<?php echo $me['address'] ?>').extend({
                                                        required: {message: 'Please fill your address.'},
                                                        minLength: {params: 10, message: "Address field is too small to understand."}
                                                    });
                                                    me.area = ko.observable('IT Park (Rajiv Gandhi Technology Park)');
                                                    me.zip = ko.observable('<?php echo $me['pin_code'] ?>').extend({
                                                        required: {message: 'Please fill your zipcode.'},
                                                        digits: {message: 'Please fill only numbers.'}
                                                        //                     minLength: {params: 10, message: "Mobile Number must be at least 10 digit long"},
                                                        //                     maxLength: {params: 10, message: "Mobile Number should not more than 10 digits"}
                                                    });
                                                    me.email = ko.observable('<?php echo $me['email'] ?>').extend({
                                                        required: {message: 'Please fill your Email ID.'},
                                                        email: {message: 'Please enter a valid Email ID.'},
                                                    });
                                                    me.phone = ko.observable('<?php echo $me['mobile_number'] ?>').extend({
                                                        required: {message: 'Please fill your 10 digit mobile number.'},
                                                        digits: {message: 'Please fill only numbers.'},
                                                        minLength: {params: 10, message: "Mobile Number must be at least 10 digit long"},
                                                        maxLength: {params: 10, message: "Mobile Number should not more than 10 digits"}
                                                    });
                                                    me.tm = ko.observable(0);
                                                    me.lat = ko.observable('0.0');
                                                    me.lng = ko.observable('0.0');
                                                    me.customer_id = ko.observable(0);
                                                    me.payment_mode = ko.observable("Online Payment");
                                                    me.editAgain = function() {
                                                        $('#order-cnfrm-mdl').modal('hide');
                                                    };
                                                    me.saveAddress = function() {
                                                        var a = {};
                                                        var m = me;
                                                        $('#addr-fw-frm input,#addr-fw-frm textarea').each(function() {
                                                            a[$(this).attr('name')] = $(this).val();
                                                        });
                                                        $.post("/api/addresses/add.json", a, function(d) {
                                                            if (d.data.msg == "success") {
                                                                var it = JSON.parse(localStorage.pickmealsCart);
                                                                var items = [];

                                                                for (i in it) {
                                                                    items.push({
                                                                        'Order': {
                                                                            'combination_id': it[i].data.Combination.id,
                                                                            'recipe_names': it[i].data.Combination.display_name,
                                                                            'address_id': d.data.addressid,
                                                                            'customer_id': m.customer_id(),
                                                                            'lat': m.lat(),
                                                                            'long': m.lng(),
                                                                            'paid_via': m.payment_mode(),
                                                                            'status': 1,
                                                                            'qty': it[i].qty,
                                                                            'essentials': it[i].data.essentials,
                                                                            'price': it[i].price,
                                                                            'timestamp': m.tm(),
                                                                            'sku': m.orderId()

                                                                        }
                                                                    });
                                                                }
                                                                var data = {
                                                                    'data': items
                                                                };
                                                                $.post("/api/orders/makeorder.json", data, function(d) {
                                                                    console.log(d);
                                                                    if (d.data.error == 0) {
                                                                        delete localStorage.pickmealsCart;
                                                                        if (m.payment_mode() != "COD") {
                                                                            window.location = d.data.url;
                                                                        }
                                                                        else {
                                                                            try {
                                                                                var options = {
                                                                                    iconUrl: 'https://www.pickmeals.com/img/pickmeals_icon.png',
                                                                                    title: 'pickmeals.com',
                                                                                    timeout: 7000,
                                                                                    body: "Order has been completed successfully...",
                                                                                    onclick: function() {
                                                                                        notification.close();
                                                                                    }
                                                                                };
                                                                                $.notification(options);
                                                                            } catch (e) {
                                                                                alert("Order has been completed successfully...");
                                                                            }

                                                                            window.location.href = 'https://www.pickmeals.com/orders/payment_success/' + m.orderId();//"/";
                                                                        }
                                                                    } else {
                                                                        try {
                                                                            var options = {
                                                                                iconUrl: 'https://www.pickmeals.com/img/pickmeals_icon.png',
                                                                                title: 'pickmeals.com',
                                                                                timeout: 7000,
                                                                                body: d.data.msg,
                                                                                onclick: function() {
                                                                                    notification.close();
                                                                                }
                                                                            };
                                                                            $.notification(options);
                                                                        } catch (e) {
                                                                            alert(d.data.msg);
                                                                        }
                                                                    }
                                                                });
                                                            }
                                                        });
                                                    };
                                                    me.makeOrder = function(d, e) {
                                                        if(CartObj.items().length <= 0){
                                                                alert("Your Cart is empty, please add few items...");
                                                                return false;
                                                            }
                                                        if (ko.validation.group(me)().length > 0) {
                                                            var err1 = ko.validation.group(me);
                                                            err1.showAllMessages();
                                                            var err = err1();
                                                            for (i in err) {
                                                                try {
                                                                    var options = {
                                                                        iconUrl: 'https://www.pickmeals.com/img/pickmeals_icon.png',
                                                                        title: 'Shipping details Missing...',
                                                                        body: err[i],
                                                                        timeout: 7000,
                                                                        onclick: function() {
                                                                            notification.close();
                                                                        }
                                                                    };
                                                                    $.notification(options);
                                                                } catch (e) {
                                                                    alert(err[i]);
                                                                }
                                                            }

                                                            return false;
                                                        }
                                                        var num = new Date().getTime();
                                                        me.tm(num);
                                                        me.orderId(num.toString(36).toUpperCase());
                                                        $.post("/webapp/getuser", function(d) {
                                                            if (d != null) {
                                                                me.customer_id(d.id);
                                                                $('#order-cnfrm-mdl').modal('show');
                                                                return false;
                                                            }
                                                            $('#login-mdl').modal('show');
                                                        });
                                                    }
                                                    me.init = function() {
                                                        var m = me;
                                                        navigator.geolocation.getCurrentPosition(function(e) {
                                                            m.lat(e.coords.latitude);
                                                            m.lng(e.coords.longitude);
                                                        });
                                                    };
                                                    me.init();
                                                };
                                                var AddressObj = new AddressVM();


                                                var CartVM = function() {
                                                    var me = this;
                                                    me.items = ko.observableArray([]);
                                                    me.viewItems = ko.observable(false);
                                                    me.viewItemsClick = function() {
                                                        if (me.viewItems() == false) {
                                                            me.viewItems(true);
                                                            $('.sidebar_order_list_main').slideDown();
                                                        } else {
                                                            me.viewItems(false);
                                                            $('.sidebar_order_list_main').slideUp();

                                                        }
                                                    };
                                                    me.subt = ko.computed(function() {
                                                        var x = 0;
                                                        var d = this.items();
                                                        for (i in d) {
                                                            x += d[i].qty() * d[i].price();
                                                        }
                                                        return x;
                                                    }, this);
                                                    me.updateEss = function(d, e) {
                                                        localStorage.pickmealsCart = ko.mapping.toJSON(me.items);
                                                    };
                                                    me.dynamicSrc = function(s, e) {
                                                        if (e == "4 Roti + Half Rice") {
                                                            s = s.replace("-0-", "-2-");
                                                        }
                                                        if (e == "Full Rice") {
                                                            s = s.replace("-0-", "-1-");
                                                        }
                                                        if (e == "6 Roti") {
                                                            //s = s.replace("-0-","-1-");
                                                        }
                                                        return s;
                                                    };
                                                    me.pushToCart = function(item, qty, price) {
                                                        if($(window).width() < 720){
                                                            $('.sidebar_order_list_main').slideUp();
                                                            me.viewItems(false);
                                                        }
                                                        var flag = false;
                                                        console.log(item);
                                                        for (i in me.items()) {
                                                            console.log(me.items()[i].data.essentials());
                                                            console.log(item.essentials());
                                                            if (me.items()[i].data.essentials() == ComboObj.essentials() && me.items()[i].data.Combination.id == item.Combination.id) {
                                                                // flag = i;
                                                            }
                                                        }
                                                        if (flag) {
                                                            me.items()[flag].qty(me.items()[flag].qty() + 1);
                                                        } else {
                                                            me.items.push({
                                                                data: item,
                                                                qty: ko.observable(qty),
                                                                price: ko.observable(price)
                                                            });
                                                        }
                                                        localStorage.pickmealsCart = ko.mapping.toJSON(me.items);

                                                        //var x = me.
                                                        //();
                                                        //me.subt((qty*price) + x );
                                                    }
                                                    me.increase = function(d, e) {
                                                        d.qty(d.qty() + 1);
                                                        localStorage.pickmealsCart = ko.mapping.toJSON(me.items);
                                                    };
                                                    me.decrease = function(d, e) {
                                                        if (d.qty() == "1") {
                                                            me.items.remove(d);
                                                        } else {
                                                            d.qty(d.qty() - 1);
                                                        }
                                                        localStorage.pickmealsCart = ko.mapping.toJSON(me.items);
                                                    }
                                                    me.subTotal = ko.computed(function() {
                                                        return 0;
                                                    }, this);
                                                    me.serviceTax = ko.computed(function() {
                                                        return 0;
                                                    }, this);
                                                    me.vat = ko.computed(function() {
                                                        return 0;
                                                    }, this);
                                                    me.total = ko.computed(function() {
                                                        return this.subt();
                                                    }, this);


                                                    me.moveToCheckOut = function() {
                                                        window.location = "/checkout";
                                                    };

                                                    me.init = function() {
                                                        if (typeof localStorage.pickmealsCart != 'undefined') {
                                                            $items = JSON.parse(localStorage.pickmealsCart);
                                                            //var d = [];
                                                            for (i in $items) {
                                                                $items[i].price = ko.observable($items[i].price);
                                                                $items[i].qty = ko.observable($items[i].qty);
                                                                $items[i].data.essentials = ko.observable($items[i].data.essentials);
                                                            }
                                                            me.items($items);
                                                        }
                                                    };
                                                    me.init();
                                                };



                                                CartObj = new CartVM();

                                                $(document).ready(function() {
                                                    ko.applyBindings(CartObj, $('#cart-sec')[0]);
                                                    ko.applyBindings(AddressObj, $('#address-sec')[0]);

                                                    ko.applyBindings(CartObj, $('#cart-sec-2')[0]);
                                                    ko.applyBindings(AddressObj, $('#address-sec-2')[0]);


                                                });



                                                $(function() {
                                                    var offset = $("#sidebar").offset();
                                                    var topPadding = 15;
                                                    $(window).scroll(function() {
                                                        if ($(window).scrollTop() > offset.top) {
                                                            $("#sidebar").stop().animate({
                                                                marginTop: $(window).scrollTop() - offset.top + topPadding
                                                            });
                                                        } else {
                                                            $("#sidebar").stop().animate({
                                                                marginTop: 0
                                                            });
                                                        }
                                                        ;
                                                    });
                                                });
                                            </script>
                                            <style type="text/css">
                                                .validationElement{
                                                    background: pink;
                                                    border: red solid 1px;
                                                }
                                                .validationMessage{
                                                    color: red;
                                                }
                                            </style>
