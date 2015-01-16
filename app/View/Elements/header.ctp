<header>

    <div class="header_nav">
        <div role="navigation" class="">
            <div class="video_wrap">
                <div class="container">
               
                    <div class="logo">
                        <img src="/img/logo.png" onclick="window.location = '/'" >
                        <img class="logo-2" src="/img/pickmeals_icon.png" onclick="window.location = '/'" >
                        
                        
                    </div>
               
                    
                    <div class="top-txt">
                        <?php if ($c_user) { ?>
                            <a class="trans-btns" href="/myaccount">My Account</a>
                            <a class="trans-btns" href="/logout" class="my_account_a">Logout</a>
                        <?php } else { ?>
                            <a class="trans-btns" href="#" onclick="javascript: $('#login-mdl').modal('show');">Login</a>
                        <?php } ?>
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
                        <li class="active" data-bind="click: $root.filter">
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