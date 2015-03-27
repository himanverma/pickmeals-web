<?php //print_r($vendor ); exit; ?>
<div class="chef_profile">
    <div class="col-xs-12 col-sm-3 col-md-3">
        <div class="chef_profile_left">
            <div class="chef_profile_img"><img src="<?php echo $vendor['Vendor']['photo'] != null ? $vendor['Vendor']['photo'] : "/img/chef_profile.jpg"; ?>"></div>
            <div class="chef_profile_about">
                <h1 style="text-align:left;"><?php echo $vendor['Vendor']['name']; ?></h1>
                <ul>
                    <li>
                        <span class="rateit" id="vendor-ratings-bl" data-rateit-value="0" data-rateit-ispreset="true" data-rateit-readonly="true"></span>&nbsp;&nbsp;&nbsp;&nbsp;(<span id="vendor-ratings"></span>)<br>
                    </li>
                    <li><span class="chef_profile_home"><img src="/img/home.png"></span>
                        <p><?php echo $vendor['Vendor']['address']; ?></p>
                    </li>
                    
                    <li>
                        <b class="chef_profile_phone"></b><br />
                        <p><b><?php echo $vendor['Vendor']['company_name']; ?></b></p>
                    </li>
                    
                </ul>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-6" id="combination-sec">
        <div class="chef_list_inn">
            <div class="chef_list_title">
                <h2>Meal Combinations</h2>
            </div>
            <div class="chef_list_main">


                <?php
                $gRate = 0;
                foreach ($vendor['Combination'] as $combo) {
                    $tRate = 0;
                    ?>
                    <div style="display: none">
                        <h3>Reviews</h3>
                        <?php foreach ($combo['Review'] as $rev) { ?>
                            <div>
                                <span class="rateit" data-rateit-value="<?php echo $rev['ratings']; ?>" data-rateit-ispreset="true" data-rateit-readonly="true"></span>(<?php echo $rev['ratings']; ?>)<br>
                                <p>
                                    <?php echo $rev['review']; ?>
                                </p>
                            </div>
                            <?php
                            $tRate += $rev['ratings'];
                            $gRate += $rev['ratings'];
                        }
                        $tRate = $tRate / count($combo['Review']);
                        ?>
                    </div>
                    <div class="list_box">
                        <div class="list_box_title">
                            <h3><?php echo $combo['display_name']; ?></h3>
                        </div>
                        <div class="col-xs-4 col-sm-4 padding-none">
                            <div class="padding-none">
                                <div class="list_box_left"> 
                                <img data-bind="attr: {'src': ko.computed(function(){return $root.dynamicSrc('<?php echo $combo['image'] != NULL ? $combo['image'] : "/img/product.png"; ?>')})}" onerror="this.src = 'img/product.png';" /> </div>
                            </div>
                        </div>
                        <div class="col-xs-8 col-sm-6 ">
                            <div class="row">
                                <div class="list_box_right">
                                    <ul>
                                        <li>
                                            <p><?php echo $vendor['Vendor']['name']; ?></p>
                                        </li>
                                        <li>
                                            <a href="/reviews/<?php echo $combo['id']; ?>" ><span class="rateit" data-rateit-value="<?php echo $tRate; ?>" data-rateit-ispreset="true" data-rateit-readonly="true"></span>&nbsp;&nbsp;&nbsp;&nbsp;
                                            (<?php echo count($combo['Review']); ?>)</a>
                                            <div class="food_qty_button">
<!--                                               <button data-combo='<?php echo json_encode($combo); ?>' data-bind="click:addToCart">Order</button>-->
                                            </div>
                                        </li>
                                        <li>
                                            <h4><span>Delivery:</span>Free/10 mins</h4>
                                        </li>
                                        <li>
                                            <h3><span>Price:</span>Rs <?php echo $combo['price']; ?></h3>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-2 col-sm-2 hidden-xs">
                            <div class="row">
                            <div class="food_qty_button">
<!--                                <button data-combo='<?php echo json_encode($combo); ?>' data-bind="click:addToCart">Order</button>-->
                            </div> </div>
                        </div>
                        <?php /*
                        <div style="height: 10px" class="clr-div"></div>
                        <div class="col-xs-12 padding-none-1">
                            <div class="box_price">
                                <div class="padding-none">
                                    <div class="col-xs-4 col-sm-4 padding-none-2">
                                        <div class="row">
                                            <div class="food_qty"> 
                                                <span><input data-bind="checked: essentials " type="radio" value="4 Roti + Half Rice"></span>
                                                <label>4 Roti + Half Rice</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-4 col-sm-4 padding-none-2"><div class="row">
                                        <div class="food_qty">
                                            <input data-bind="checked: essentials " type="radio" value="6 Roti">
                                            <label>6 Roti</label>
                                        </div>
                                    </div> </div>
                                    <div class="col-xs-4 col-sm-4 padding-none-2">
                                        <div class="row">
                                            <div class="food_qty">
                                                <input data-bind="checked: essentials" type="radio" value="Full Rice">
                                                <label>Full Rice</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         * 
                         */
                        ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="col-sm-3 col-md-3" id="cart-sec">
       
            <div class="home_content_right">

                <div id="sidebar">
                    <div class="sidebar_main chef-sidebar-main">

                        <div class="home_content_right_title chef-cart-title">
                            <h2>Cart</h2>
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
                                        <?php /*
                                        <span class="pull-right">
                                            <select data-bind="value:data.essentials,event:{'change':$root.updateEss}, ">
                                                <option value="4 Roti + Half Rice">4 Roti + Half Rice</option>
                                                <option value="6 Roti">6 Roti</option>
                                                <option value="Full Rice">Full Rice</option>
                                            </select>
                                        </span>
                                         * 
                                         */
                                        ?>
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
                                <button type="button" data-bind="click: moveToCheckOut " class="">Proceed to checkout</button>
                                <button type="button" data-bind="click: viewItemsClick, text: ko.computed(function(){return viewItems() ? 'Hide Cart' : 'View Cart';})" class="view_cart" style="padding-right: 0 !important;">View Cart</button>
                            </div>
                        </div>


                    </div>
                </div>
           
        </div>
    </div>


</div>
<script type="text/javascript">
    var ComboVM = function(){
        var me = this;
        me.dynamicSrc = function(s){
            if(me.essentials() == "4 Roti + Half Rice"){
                s = s.replace("-0-","-2-");
            }
            if(me.essentials() == "Full Rice"){
                s = s.replace("-0-","-1-");
            }
            if(me.essentials() == "6 Roti"){
                //s = s.replace("-0-","-1-");
            }
            return s;
        };
        me.essentials = ko.observable('');
        me.addToCart = function(d,e){
            var data = $(e.currentTarget).data('combo');
            delete data.Review;
            var d = {
                Combination : data,
                essentials : ko.observable(me.essentials())
            };
            CartObj.pushToCart(d, 1, d.Combination.price);
        };
    };
    
    var CartVM = function() {
        var me = this;
        me.items = ko.observableArray([]);
        me.viewItems = ko.observable(false);
        me.viewItemsClick = function(){
            if(me.viewItems() == false){
                me.viewItems(true);
                $('.sidebar_order_list_main').slideDown();
            }else{
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
        me.updateEss = function(d,e){
            localStorage.pickmealsCart = ko.mapping.toJSON(me.items);
        };
        me.pushToCart = function(item, qty, price) {
            if($(window).width() < 720){
                $('.sidebar_order_list_main').slideUp();
                me.viewItems(false);
            }
            me.items.push({
                data: item,
                qty: ko.observable(qty),
                price: ko.observable(price)
            });
            localStorage.pickmealsCart = ko.mapping.toJSON(me.items);
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
        
        
        me.moveToCheckOut = function(){
          window.location  = "/checkout";  
        };
        
        me.init = function(){
            if(typeof localStorage.pickmealsCart != 'undefined' ){
                $items = JSON.parse(localStorage.pickmealsCart);
                //var d = [];
                for(i in $items){
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
    ComboObj = new ComboVM();
    
    $(document).ready(function() {
        ko.applyBindings(ComboObj, $('#combination-sec')[0]);
        ko.applyBindings(CartObj, $('#cart-sec')[0]);
        
        $('.rateit').rateit();
        $('#vendor-ratings-bl').rateit('value', <?php echo $gRate == "" ? 0 : $gRate; ?>);
        $('#vendor-ratings').html(<?php echo $rvCount; //echo $gRate == "" ? 0 : $gRate; ?>);
        
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