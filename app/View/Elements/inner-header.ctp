<header>
    <!--                <div class="header_top">
                        <div class="container">
                            <div class="home_sign_in">	
                                <span>
                                    <a href="">SIGN IN</a>
                                    <a href="">SIGN UP</a>
                                </span>
                            </div>
                        </div>
                    </div>-->
    <div class="header_nav">
        <nav role="navigation" class="navbar navbar-inverse">
            <div class="container">
                <div class="logo">
                    <img src="/img/logo.png" onclick="window.location = '/'" >
                </div>
                <div class="navbar-header">
                    <div aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </div>
                    <a href="#" class="navbar-brand"></a>
                </div>
                <div class="navbar-collapse collapse" id="navbar">
                    <!--                                <ul class="nav navbar-nav navbar-">
                                                        <li><a href="#">HOME</a></li>
                                                        <li><a href="#">ABOUT US</a></li>
                                                        <li><a href="#">ITEMS</a></li>
                                                        <li><a href="#">CONTACT US</a></li>
                                                    </ul>
                                                    <form class="navbar-form navbar-right">
                                                        <input type="text" placeholder="Search..." class="form-control">
                                                    </form>-->
                    <div class="pull-right top-txt">
                        <?php if ($c_user) { ?>
                            <a href="/myaccount">My Account</a>
                            <a href="/logout" class="my_account_a">Logout</a>
                        <?php } else { ?>
                            <a href="#" onclick="javascript: $('#login-mdl').modal('show');">Login</a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</header>