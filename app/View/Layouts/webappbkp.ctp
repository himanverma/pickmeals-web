<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Pick Meals</title>

        <?php
        echo $this->Html->css(array(
            'bootstrap.min',
            'style',
            '/fonts/roboto'
        ));
        ?>
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script src="//cdnjs.cloudflare.com/ajax/libs/knockout/3.2.0/knockout-min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/knockout.mapping/2.4.1/knockout.mapping.js"></script>
        <!--        <script src="js/jquery.js"></script>-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.notification/1.0.2/jquery.notification.min.js"></script>

             

        <?php
        echo $this->fetch('startcss');
        echo $this->Html->script(array('bootstrap.min'));
//            $this->Combinator->add_libs('js', array(
//                'js/bootstrap.min',
//            )); 
//            echo $this->Combinator->scripts('js'); // Output Javascript files
//            
        echo $this->fetch('startjs');
        ?>
        
        
        
    </head>

    <body>
        <div class="main_container">
            <!--*********************************header***********************************-->
            <header>

                <div class="header_nav">
                    <div role="navigation" class="">
                        <div class="video_wrap">
                             <div class="container">
                            <div class="logo">
                                <img src="/img/logo.png" onclick="window.location = '/'" >
                            </div>
                            <div class="pull-right top-txt">
                                <a href="#" onclick="javascript: $('#login-mdl').modal('show');">Login</a>
                                <a href="#" class="my_account_a">My Account</a>
                            </div>
                             </div>
                        </div>
                    </div>




                    <nav class="navbar navbar-default visible-xs" role="navigation" style="position: absolute; right: 0; z-index: 2;">
                        <div class="container-fluid">
                            <!-- Brand and toggle get grouped for better mobile display -->
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span> 
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                                <a class="navbar-brand" href="#">Menu</a>
                            </div>

                            <!-- Collect the nav links, forms, and other content for toggling -->
                            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                <ul class="nav navbar-nav">
                                    <li class="active"><span><img src="/img/panner.jpg" width="40%" /></span><a href="">Panner <span>(5)</span></a></li>
                                    <li><span><img src="/img/panner.jpg" width="40%" /></span><a href="">Chicken <span>(3)</span></a></li>
                                    <li><span><img src="/img/daal_yellow.jpg" width="40%" /></span><a href="">Rajma <span>(4)</span></a></li>
                                    <li><span><img src="/img/bhindi.jpg" width="40%" /></span><a href="">Bhindi <span>(3)</span></a></li>
                                    <li><span><img src="/img/khadi_rice.jpg" width="40%" /></span><a href="">Kadhi Chawal <span>(7)</span></a></li>
                                    <li><span><img src="/img/aloo.jpg" width="40%" /></span><a href="">Aloo <span>(2)</span></a></li>
                                </ul>
                            </div><!-- /.navbar-collapse -->
                        </div><!-- /.container-fluid -->
                    </nav>
                </div>
                       
            </header>

            <?php echo $this->fetch('content'); ?>

            <footer>
                <div class="container">
                    <div class="footer_in">
                        <p>Copyright © 2013 by Company Name</p>
                    </div>
                </div>
            </footer>

            <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        </div>

        <div style="padding-bottom: 24px;" class="bs-example">
            <!--<button class="payment_checkout1_button" data-whatever="@mdo" data-target="#login-mdl" data-toggle="modal" class="btn btn-primary" type="button">Place order</button>-->

            <div aria-hidden="true" aria-labelledby="exampleModalLabel" role="dialog" tabindex="-1" id="login-mdl" class="modal fade" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <!--<div class="modal-header">
                          <button data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
              
                        </div>-->
                        <div class="modal-body">
                            <div class="modal-body_in center-block">
                                <form role="form">
                                    <div class="form-group">
                                        <span onclick="fb_login();" class="login_img">
                                            <img src="/img/login.png" width="80%" />
                                        </span>
                                    </div>
                                    <p class="login_or">-OR-</p>
                                    <div class="form-group">
                                        <div class="login_phone">
                                            <div class="login_phone_in center-block">
                                                <input type="text" placeholder="Enter Mobile No.">
                                            </div>
                                        </div>
                                    </div>
                                    <span class="submit_img">
                                        <img src="/img/submit.png" width="80%" />
                                    </span>
                                    <p class="forgot_pass"><a href="">Forgot password</a></p>
                                </form>
                            </div>
                        </div>
                        <div class="modal-footer">
                        </div>
                    </div>
                </div>
            </div><!-- /.modal -->
        </div>
        <div id="fb-root"></div>
    </body>


    <script type="text/javascript">
        window.fbAsyncInit = function() {
            FB.init({
                appId: '741582422594237',
                oauth: true,
                status: true, // check login status
                cookie: true, // enable cookies to allow the server to access the session
                xfbml: true // parse XFBML
            });

        };
        function fb_login() {
            FB.login(function(response) {

                if (response.authResponse) {
                    console.log('Welcome!  Fetching your information.... ');
                    //console.log(response); // dump complete info
                    access_token = response.authResponse.accessToken; //get access token
                    user_id = response.authResponse.userID; //get FB UID

                    FB.api('/me', function(response) {
                        //user_email = response.email; 
                        $.post("/webapp/fblogin", {"data": response}, function(d) {
                            if (d.error == 0) {
                                $('#login-mdl').modal('hide');
                                var options = {
                                    iconUrl: 'https://www.pickmeals.com/img/pickmeals_icon.png',
                                    title: 'pickmeals.com',
                                    body: d.msg,
                                    onclick: function() {
                                        notification.close();
                                    }
                                };
                                $.notification(options);
                                window.location.r
                            }
                        });
                    });

                } else {
                    //user hit cancel button
                    console.log('User cancelled login or did not fully authorize.');

                }
            }, {
                scope: 'publish_stream,email,user_location'
            });
        }
        (function() {
            var e = document.createElement('script');
            e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
            e.async = true;
            document.getElementById('fb-root').appendChild(e);
        }());

    </script>
    <style type="text/css">
        .top-txt a{
            color: #fff;
        }
        .top-txt{
            padding: 27px;
        }
    </style>
</html>