<!--******************************************banner********************************************-->
<div style="left: 0; top:0px;
     position: absolute;
     width: 100%; z-index: 1; height: 611px; overflow: hidden;">
    <video id="pretzel-video" class="video-playing"  autoplay="true" style="width: 100%; background: url('http://loadinggif.com/images/image-selection/22.gif') no-repeat scroll center center rgb(0, 0, 0);">
        <source type="video/mp4" src="/story/NA.mp4"></source>
    </video>   
    <script type="text/javascript">
        var VideoNext = function(){
            vidCnt++;
            if(vidCnt == 28){
                vidCnt = 0;
            }
            $('#pretzel-video')[0].src = "/story/"+vidArr[vidCnt]+".mp4";
            console.log("/story/"+vidArr[vidCnt]+".mp4");
        };
        var VideoPrev = function(){
            vidCnt--;
            if(vidCnt == 28){
                vidCnt = 0;
            }
            $('#pretzel-video')[0].src = "/story/"+vidArr[vidCnt]+".mp4";
            console.log("/story/"+vidArr[vidCnt]+".mp4");
        };
        
        
        var vidArr = <?php 
            $a = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28];
            //shuffle($a);
            echo json_encode($a);
        ?>;
        var vidCnt = 0;
        $(document).ready(function() {
            $('#pretzel-video')[0].src = "/story/"+vidArr[0]+".mp4";
            $('#pretzel-video')[0].addEventListener("ended", function() {
                vidCnt++;
                if(vidCnt == 28){
                    vidCnt = 0;
                }
                this.src = "/story/"+vidArr[vidCnt]+".mp4";
                console.log("/story/"+vidArr[vidCnt]+".mp4");
            });
            
            
            
        });
        $(document).on("keyup",function(e){
            console.log(e.keyCode);
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

            <nav class="navbar navbar-default" id="nav1" role="navigation" style="z-index: 2;">

                <div class="collapse navbar-collapse" id="navbar-collapse-main">
                    <div class="search_bar_main" id="srch-block">
                        <div class="row">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-6">
                                <div class="input-group">

                                    <input type="text" data-bind="value:SearchMeal" placeholder="Search..." class="form-control search_input">
                                    <div class="input-group-btn">
                                        <input type="button" class="btn btn-default btn-lg seacrh_btn"  data-bind="click:Search" value="Search">
                                    </div>
                                </div>

                            </div>
                            <div class="col-sm-3"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3 hidden-xs">
                            <div class="row">
                                <div class="home_content_left">
                                    <div class="home_content_left_title">
                                        <h2>MENU</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 hidden-xs">
                            <div class="home_content_left">
                                <div class="home_content_left_title">
                                    <h2>LIST</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3 hidden-xs">
                            <div class="row">
                                <div class="home_content_left">
                                    <div class="home_content_left_title">
                                        <h2>MENU</h2>
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
                        <div class="home_content_mid_title">
                        </div>
                        <div class="list_box_main" data-bind="foreach:Combolist">
                            <div class="list_box">
                                <div class="list_box_title">
                                    <h3 data-bind="text: Combination.display_name">Rajma+Paneer+Salad</h3>
                                </div>
                                <div class="col-xs-4">
                                    <div class="row">
                                        <div class="list_box_left">
                                            <img src="img/product.png">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="row">                                                            
                                        <div class="list_box_right">
                                            <ul>
                                                <li><p data-bind="text: Vendor.name">By Jackson</p></li>
                                                <li><img src="img/rating.png"></li>
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
                                <div class="col-xs-12">
                                    <div class="box_price">
                                        <div class="row">
                                            <div class="col-xs-4">
                                                <div class="row">
                                                    <div class="food_qty">
                                                        <span><input type="radio" name="additional" value="female"></span>

                                                        <label>4 Roti + Half Rice</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-3">
                                                <div class="food_qty">
                                                    <input type="radio" name="additional" value="female">
                                                    <label>6 Roti</label>
                                                </div>
                                            </div>
                                            <div class="col-xs-4">
                                                <div class="row">
                                                    <div class="food_qty">
                                                        <input type="radio" name="additional" value="female">
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
                    <div class="row">
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
                                                <p class="order_list_price">Rs.
                                                    <!-- ko text: data.Combination.price * qty() --><!-- /ko -->
                                                </p>
                                            </div>
                                            <div class="col-sm-12 sidebar_order_4">
                                                <div class="order_list_add">
                                                    <button class="badge1" data-bind="click: $root.increase">+</button>
                                                    <button class="badge1" data-bind="click: $root.decrease">-</button>
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
                                            <button type="button" class="">Proceed to checkout</button>
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
        me.isLoading = ko.observable(false);
        me.getData = function() {
            var m = me;
            me.isLoading(true);
            $.post('/api/combinations.json', {
                "data[User][latitude]": m.lat,
                "data[User][longitude]": m.lng,
                "data[User][count]": m.page
            }, function(d) {
                m.Combolist(d.data.items);
                me.isLoading(false);
            });
        };
        me.getData();
        me.Search = function() {
            var m = me;
            $.post('/api/combinations/search.json', {
                "data[Combination][search]": m.SearchMeal(),
            }, function(d) {
                console.log(d);
                me.Combolist(d.data);
            });
        };
        me.addToCart = function(d, e) {
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
                        } else {
                            m.Combolist.push(d.data.items);
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

        me.pushToCart = function(item, qty, price) {
            me.items.push({
                data: item,
                qty: ko.observable(qty),
                price: ko.observable(price)
            });
            //var x = me.
            //();
            //me.subt((qty*price) + x );
        }
        me.increase = function(d, e) {
            d.qty(d.qty() + 1);
        };
        me.decrease = function(d, e) {
            if (d.qty() == "1") {
                me.items.remove(d);
            } else {
                d.qty(d.qty() - 1);
            }
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
        
    });
</script>
<script type="text/javascript">
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

            //---- For top Header and video banner
            if (500 < $(window).scrollTop()) {
                $('#nav1').css({position: 'fixed', 'top': '5px', width: '86%', 'z-index': 2, height: '30px'});
                $('#pretzel-video').parent().css({position: 'fixed', 'top': '-500px', 'z-index': 1});
            } else {
                $('#nav1').removeAttr('style').attr({style: 'z-index:2'});
                $('#pretzel-video').parent().css({position: 'absolute', 'top': '0px', 'z-index': 1});
            }
            console.log($('#pretzel-video').parent().position().top);

        });
    });
</script>