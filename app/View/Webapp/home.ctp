<!--******************************************banner********************************************-->
<div class="home-video">
    <video id="pretzel-video" class="video-playing" poster="/story/1.jpg" autoplay="true" style="width: 100%; ">
        <source type="video/mp4" src="/story/NA.mp4"></source>
        <source type="video/webm" src="/story/NA.webm"></source>
    </video>
    <style type="text/css">
        video {
            width: 100%;
            background-color: black !important;
            -webkit-background-size:cover; 
            -moz-background-size:cover; 
            -o-background-size:cover; 
            background-size:cover; 
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
    <script type="text/javascript">
        var vidType = '.mp4';
        if (Modernizr.video && Modernizr.video.h264){
            var vidType = '.mp4';
        }else if(Modernizr.video && Modernizr.video.webm){
            var vidType = '.webm';
        }
        var VideoNext = function(){
            vidCnt++;
            if(vidCnt == 30){
                vidCnt = 0;
            }
            $('#pretzel-video').attr({poster: '/story/'+vidArr[vidCnt]+'.jpg'});
            $('#pretzel-video').css({
                'background': "transparent url('/story/"+vidArr[vidCnt]+".jpg') no-repeat scroll center center"
            });
            $('#pretzel-video')[0].src = "/story/"+vidArr[vidCnt]+vidType;
            //console.log("/story/"+vidArr[vidCnt]+".mp4");
        };
        var VideoPrev = function(){
            if(vidCnt == 0){
                vidCnt = 30;
            }
            vidCnt--;
            $('#pretzel-video').attr({poster: '/story/'+vidArr[vidCnt]+'.jpg'});
            $('#pretzel-video').css({
                'background': "transparent url('/story/"+vidArr[vidCnt]+".jpg') no-repeat scroll center center"
            });
            $('#pretzel-video')[0].src = "/story/"+vidArr[vidCnt]+vidType;
            //console.log("/story/"+vidArr[vidCnt]+".mp4");
        };
        
        
        var vidArr = <?php 
            $a = [1,2,3];
            shuffle($a);
            echo json_encode($a);
        ?>;
        var vidCnt = 0;
        $(document).ready(function() {
            $('#pretzel-video').attr({poster: '/story/'+vidArr[0]+'.jpg'});
            $('#pretzel-video').css({
                'background': "transparent url('/story/"+vidArr[0]+".jpg') no-repeat scroll center center"
            });
            $('#pretzel-video')[0].src = "/story/"+vidArr[0]+vidType;
            $('#pretzel-video')[0].addEventListener("ended", function() {
                vidCnt++;
                if(vidCnt == 30){
                    vidCnt = 0;
                }
                this.src = "/story/"+vidArr[vidCnt]+".mp4";
                //console.log("/story/"+vidArr[vidCnt]+".mp4");
            });
            
            
            
        });
        $(document).on("keyup",function(e){
            //console.log(e.keyCode);
            if(e.keyCode == 188){
                VideoPrev();
            }
            if(e.keyCode == 190){
                VideoNext();
            }
        });
        
        
    </script>
</div>
<div class="banner hidden-xs" id="box1">
    <div class="container">
        <div class="banner_in">
            <div data-ride="carousel" class="carousel slide" id="carousel-example-captions" style="visibility: hidden;">
                <ol class="carousel-indicators">
                    <li class="" data-slide-to="0" data-target="#carousel-example-captions"></li>
                    <li data-slide-to="1" data-target="#carousel-example-captions" class=""></li>
                    <li data-slide-to="2" data-target="#carousel-example-captions" class="active"></li>
                </ol>
                <div role="listbox" class="carousel-inner" >
                    <div class="item">
                        <img alt="900x500" data-src="holder.js/900x500/auto/#777:#777" src="img/Food-Design.png" data-holder-rendered="true">
                        <div class="carousel-caption">
                        </div>
                    </div>
                    <div class="item">
                        <img alt="900x500" data-src="holder.js/900x500/auto/#777:#777" src="img/Food-Design.png" data-holder-rendered="true">
                        <div class="carousel-caption">
                        </div>
                    </div>
                    <div class="item active">
                        <img alt="900x500" data-src="holder.js/900x500/auto/#777:#777" src="img/Food-Design.png" data-holder-rendered="true">
                        <div class="carousel-caption">
                        </div>
                    </div>
                </div>
                <a data-slide="prev" role="button" href="#carousel-example-captions" class="left carousel-control">
                    <span aria-hidden="true" class="glyphicon glyphicon-chevron-left"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a data-slide="next" role="button" href="#carousel-example-captions" class="right carousel-control">
                    <span aria-hidden="true" class="glyphicon glyphicon-chevron-right"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
</div>
<!--******************************************content********************************************-->
<div class="home_content">
    <div class="container">
        <div class="home_content_in">

            <nav class="navbar navbar-default" id="nav1" role="navigation">

                <div class="collapse navbar-collapse" id="navbar-collapse-main">
                    <div class="row">
                    <div class="search_bar_main" id="srch-block">
                        <div class="col-sm-3"><div class="row">
                            </div>
                        </div>
                            <div class="col-sm-6" id="srch-pd">
                                <div class="input-group">

                                    <input type="text" data-bind="value:SearchMeal" placeholder="Search..." class="form-control search_input">
                                    <div class="input-group-btn">
                                        <input type="button" class="btn btn-default btn-lg seacrh_btn"  data-bind="click:Search" value="Search">
                                    </div>
                                </div>

                            </div>
                       <div class="col-sm-3"> <div class="row">
                            </div>
                        </div>
                    </div>
                        <div class="col-sm-3 hidden-xs">
                            <div class="row">
                                <div class="home_content_left">
                                    <div class="home_content_left_title">
                                        <h2>CATEGORIES</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 hidden-xs">
                            <div class="home_content_left">
                                <div class="home_content_left_title">
                                    <h2>MENU</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3 hidden-xs">
                            <div class="row">
                                <div class="home_content_left">
                                    <div class="home_content_left_title">
                                        <h2>CART</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                </div>
            </nav>
            <div class="dish_content">
                <div class="col-sm-3 hidden-xs" id='recipe-sec'>
                    <div class="row">
                        <div class="home_content_left">
                            <div class="home_content_left_title">
                                <ul data-bind="foreach: list ">
                                    <li data-bind="click: $root.filter">
                                        <span>
                                            <img data-bind="attr:{'src':Recipe.image}" onerror="this.src='img/panner.jpg'">
                                        </span>
                                        <a href="#" data-bind="text:Recipe.recipe_name">Panner <span>(5)</span></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>





                <div class="col-sm-6" id="combination-sec">
                    <div class="home_content_mid">
                        <div class="home_content_mid_title" style="display: none;">
                            <br /><br />
                            <center>
                                <h2 style="color:#000;">Loading...</h2>
                            </center>
                        </div>
                        <div class="list_box_main" data-bind="foreach:Combolist">
                            <div class="list_box">
                                <div class="list_box_title">
                                    <h3 data-bind="text: Combination.display_name">Rajma+Paneer+Salad</h3>
                                </div>
                                <div class="col-xs-4 col-sm-4 padding-none">
                                    <div class="padding-none">
                                        <div class="list_box_left">
                                            <img src="img/product.png">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6">
                                    <div class="row">                                                            
                                        <div class="list_box_right">
                                            <ul>
                                                <li><p>By <a href="#" data-bind="text: Vendor.name, attr:{'href':'/chef/'+Vendor.name.replace(' ','-').toLowerCase()} "></a></p></li>
                                                <li>
                                                    <span class="rateit" data-bind="attr:{'data-rateit-value':Review.ratings}" data-rateit-value="" data-rateit-ispreset="true" data-rateit-readonly="true"></span>(<!-- ko text: Review.length --><!-- /ko -->)
                                                </li>
                                                <li><h4><span>Delivery:</span>Free/45 mins</h4></li>
                                                <li><h3 ><span>Price:</span>Rs <!-- ko text: Combination.price --><!-- /ko --></h3></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xs-2">
                                    <div class="row">
                                        <div class="food_qty_button">
                                            <button class="" data-bind="attr:{'id':Vendor.id},click: $root.addToCart">Order</button>
                                        </div>
                                    </div>
                                </div>

                                <div style="height: 10px" class="clr-div"></div>
                                <div class="col-xs-12 padding-none-1">
                                    <div class="box_price">
                                        <div class="padding-none">
                                            <div class="col-xs-4 col-sm-4 padding-none-2">
                                                <div class="row">
                                                    <div class="food_qty">
                                                        <span><input data-bind="checked:$root.essentials, attr:{'name':'ess-fw-'+Combination.id} " type="radio" value="4 Roti + Half Rice"></span>
                                                        <label>4 Roti + Half Rice</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-4 col-sm-4 padding-none-2">
                                                <div class="food_qty">
                                                    <input data-bind="checked:$root.essentials, attr:{'name':'ess-fw-'+Combination.id} " type="radio" value="6 Roti">
                                                    <label>6 Roti</label>
                                                </div>
                                            </div>
                                            <div class="col-xs-4 col-sm-4 padding-none-2">
                                                <div class="row">
                                                    <div class="food_qty">
                                                        <input data-bind="checked:$root.essentials, attr:{'name':'ess-fw-'+Combination.id} " type="radio" value="2 Roti + Full Rice">
                                                        <label>2 Roti + Full Rice</label>
                                                    </div>
                                                </div>
                                            </div>

                                        </div> 
                                    </div> 
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-3" id="cart-sec">
                    <div class="padding-none">
                        <div class="home_content_right">

                            <div id="sidebar">
                                <div class="sidebar_main">

                                    <div class="home_content_right_title">
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
                                                        <select data-bind="value:data.essentials,event:{'change':$root.updateEss}, ">
                                                            <option value="4 Roti + Half Rice">4 Roti + Half Rice</option>
                                                            <option value="6 Roti">6 Roti</option>
                                                            <option value="2 Roti + Full Rice">2 Roti + Full Rice</option>
                                                        </select>
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
                                            <button type="button" data-bind="click: moveToCheckOut " class="">Proceed to checkout</button>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div style="opacity: 0; z-index: -1; height: 0.1px; width: 0.1px; overflow: hidden;">
<img src="<?php echo $this->Html->url('/img/ajax-loader.gif'); ?>">
</div>
<script type="text/javascript">


    var CombinationVM = function() {
        var me = this;
        me.display_name = ko.observable();
        me.url = ko.observable();
        me.name = ko.observable();
        me.price = ko.observable();
        me.SearchMeal = ko.observable();
        me.Combolist = ko.observableArray([]);
        me.cartItems = ko.observableArray([]);
        me.lat = 30.7238504;
        me.lng = 76.8465098;
        me.page = 1;
        me.essentials = ko.observable('4 Roti');
        
        me.isLoading = ko.observable(false);
        me.isLoading.subscribe(function(n){
            if(n == true){
               // me.Combolist([]);
                $('#combination-sec .home_content_mid_title h2').html("Loading...");
                $('#combination-sec .home_content_mid_title').show();
            }else{
                if(me.Combolist().length == 0){
                    //me.Combolist([]);
                    $('#combination-sec .home_content_mid_title h2').html("No Combinations Available...");
                    $('#combination-sec .home_content_mid_title').show();    
                }else{
                    $('#combination-sec .home_content_mid_title').hide();
                }
            }
        });
        me.getData = function() {
            var m = me;
            me.isLoading(true);
            $.post('/api/combinations.json', {
                "data[User][latitude]": m.lat,
                "data[User][longitude]": m.lng,
                "data[User][count]": m.page
            }, function(d) {
                for(i in d.data.items){
                    d.data.items[i].essentials = m.essentials();
                }
                m.Combolist(d.data.items);
                me.isLoading(false);
            });
        };
        me.getData();
        me.Search = function() {
            var m = me;
            me.isLoading(true);
            $.post('/api/combinations/search.json', {
                "data[Combination][search]": m.SearchMeal()
            }, function(d) {
                for(i in d.data){
                    d.data[i].essentials = m.essentials();
                }
                me.Combolist(d.data);
                m.isLoading(false);
            });
        };
        me.addToCart = function(d, e) {
            d.essentials = ko.observable(me.essentials());
            CartObj.pushToCart(d, 1, d.Combination.price);

        };
        me.init = function() {
            var m = me;
            navigator.geolocation.getCurrentPosition(function(e) {
                m.lat = e.coords.latitude;
                m.lng = e.coords.longitude;
            });

            window.scrollMaxY;
            window.scrollY;
            $(window).on("scroll", function() {
                if (m.isLoading() == true) {
                    return false;
                }
                if (window.scrollMaxY - window.scrollY < 100) {
                    m.page += 1;
                    m.isLoading(true);
                    $.post('/api/combinations.json', {
                        "data[User][latitude]": m.lat,
                        "data[User][longitude]": m.lng,
                        "data[User][count]": m.page
                    }, function(d) {
                        if (d.data.items.length == 0) {
                            m.page -= 1;
                            m.isLoading(false);
                            return false;
                        } else {
                            for(i in d.data.items){
                                d.data.items[i].essentials = m.essentials();
                                m.Combolist.push(d.data.items[i]);
                            }
                            
                        }
                        m.isLoading(false);
                    });
                }
            });
        };
        me.init();

    };

    var CartVM = function() {
        var me = this;
        me.items = ko.observableArray([]);
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
            var flag = false;
            for(i in me.items()){
                if(me.items()[i].data.essentials() == ComboObj.essentials() && me.items()[i].data.Combination.id == item.Combination.id){
                   // flag = i;
                }
            }
            if(flag){
                me.items()[flag].qty(me.items()[flag].qty()+1);
            }else{
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
    
    var RecipeVM = function(){
        var me = this;
        me.list = ko.observableArray([]);
        me.filter = function(d,e){
            ComboObj.SearchMeal(d.Recipe.recipe_name);
            ComboObj.Search();
        }
        me.init = function(){
            $.post("/api/recipes.json",{
                
            },function(d){
                me.list(d.data);
            });
        }
        me.init();
    }

    
    CartObj = new CartVM();
    ComboObj = new CombinationVM();
    RecipeObj = new RecipeVM();

    $(document).ready(function() {
        ko.applyBindings(ComboObj, $('#combination-sec')[0]);
        ko.applyBindings(ComboObj, $('#srch-block')[0]);

        ko.applyBindings(CartObj, $('#cart-sec')[0]);
        ko.applyBindings(RecipeObj, $('#recipe-sec')[0]);
        $('.rateit').rateit();
    });
</script>
<script type="text/javascript">
    $(function() {
        var offset = $("#sidebar").offset();
        var topPadding = 15;
        var xcsv = 0;
        $(window).scroll(function() {
            if($(window).width() > 768){
                if ($(window).scrollTop() + xcsv > offset.top ) {
                    $("#sidebar").stop().animate({
                        marginTop: $(window).scrollTop() + xcsv - offset.top + topPadding
                    });
                } else {
                    $("#sidebar").stop().animate({
                        marginTop: 0
                    });
                }
            }

            //---- For top Header and video banner
            if (500 < $(window).scrollTop()) {
                xcsv = 200;
                $('#nav1').css({position: 'fixed', 'top': '5px', width: '84.5%', 'z-index': 2, height: '30px'});
                $('#pretzel-video').parent().css({position: 'fixed', 'top': '-500px', 'z-index': 1});
            } else {
                xcsv = 0;
                $('#nav1').removeAttr('style').attr({style: 'z-index:2'});
                $('#pretzel-video').parent().css({position: 'absolute', 'top': '0px', 'z-index': 1});
            }

        });
    });
</script>
