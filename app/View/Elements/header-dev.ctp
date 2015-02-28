
<div class="header-top"></div>
<header>

    <div class="header_nav">
        <div role="navigation" class="">
            <div class="video_wrap">

                <div class="container">
                    <div class="col-sm-2 col-md-3 col-lg-2">    
                        <div class="logo">
                            <img src="/img/logo-home.png" onclick="window.location = '/'" >
                            <img class="logo-2" src="/img/pickmeals_icon.png" onclick="window.location = '/'" >


                        </div>
                    </div>    

                    <div class="col-sm-5 col-md-6 col-lg-7">        
                        <div class="search_bar_main top-searchbar" id="srch-block">

                            <div id="srch-pd">
                                <div class="input-group">

                                    <input type="text" data-bind="value:SearchMeal" placeholder="Search..." class="form-control search_input">
                                    <div class="input-group-btn">
                                        <input type="button" class="btn btn-default btn-lg seacrh_btn" data-bind="click:Search" value="Search">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>     

                       

                    <div class="col-sm-5 col-md-3 col-lg-3">        
                        <div class="top-txt"> 
                            <div class="btn-group cart-btn">
                                
                                <a href="#" data-toggle="dropdown">	<img src="img/cart1.png" alt="">
                                    View Cart
                                </a>
                            </div>
                            <?php if ($c_user) { ?>
                                 <div class="btn-group">
                                    <a href="/myaccount"class="btn btn-danger">My Account</a>
                                    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                      <span class="caret"></span>
                                      <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                      <li><a href="/logout">Logout</a></li>
                                    </ul>
                                  </div>
                                
                            <?php } else { ?>
                                <a class="trans-btns" href="#" onclick="javascript: $('#login-mdl').modal('show');">Login</a>
                            <?php } ?>
                        </div>
                    </div>       


                </div>

            </div>
        </div>


        <div class="navigat">
            <div class="navbar navbar-inverse new-nav " role="navigation">



                <div class="navbar navbar-default">
                    <div class="container">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle dish-list-icon" data-toggle="collapse" data-target=".navbar-collapse-dish">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>

                        </div>
                        <div class="navbar-collapse-dish collapse">
                            <ul class="nav navbar-nav navbar-nav-dish">
                                
                                <?php 
                                    foreach($top_menu as $tm){
                                ?>
                                <li class="dropdown menu-large">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $tm['Category']['name']; ?></a>				
                                </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>


        </div>



        <nav class="navbar navbar-default visible-xs" role="navigation" style="position: absolute; right: 0; z-index: 2;">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="col-sm-12 padding-none">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span> 
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#">Menu</a>
                    </div>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav" data-bind="foreach:list " style="background: #fff;">
                        <li class="active" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" data-bind="click: $root.filter">
                            <span>
                                <img data-bind="attr:{'src':Dishfilter.image}" onerror="this.src='img/panner.jpg'" />
                            </span>
                            <a href="#" data-bind="text:Dishfilter.recipe_name">Panner <span>(5)</span></a>
                        </li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
    </div>

</header>