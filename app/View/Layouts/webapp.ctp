<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="google-site-verification" content="wm7CKUQMwx0HC4eh2Xe5wmNSezdpAG0gw8wjAgW-36g" />
        <?php echo $this->Html->meta("icon", "favicon.ico"); ?>
        <title> Online food delivery in IT park Chandigarh,  Food delivery in It park Chandigarh, Tiffin services in IT park Chandigarh</title>
        <meta name=”keywords” content=” Online food delivery in IT park Chandigarh, Order Food online in IT park Chandigarh, food delivery in It park Chandigarh, Tiffin services in IT park Chandigarh, Free Food Delivery in It Park Chandigarh, food option in IT park Chandigarh, Lunch or dinner option in IT park Chandigarh ”>
        <meta name="description" content=" We are an online food ordering/delivering service in IT Park Chandigarh. Order your food online for fast and easy delivery to your home or office. With our meal delivery services, fresh meals/foods are delivered right to your door.">


        <?php
        echo $this->Html->css(array(
            'bootstrap.min',
            'style',
            '/fonts/roboto',
            '/fonts/circular',
            '/rate/rateit',
            'responsive'
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
        <script src="/js/knockout.validation.min.js"></script>
        <!--        <script src="js/jquery.js"></script>-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
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
        <script>
            (function(i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function() {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
                a = s.createElement(o),
                        m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');
            ga('create', 'UA-58087415-1', 'auto');
            ga('send', 'pageview');
        </script>


    </head>

    <body>
        <div class="main_container">
            <?php 
                echo $this->element("header");
                echo $this->fetch('content'); 
                echo $this->element("footer");
            ?>
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
                                    <div class="lgn-fb form-group">
                                        <span onclick="fb_login();" class="login_img">
                                            <img src="/img/login.png" width="80%" />
                                        </span>
                                    </div>
                                    <p class="login_or lgn-fb">-OR-</p>
                                    <div class="form-group">
                                        <div class="login_phone">
                                            <div id="pk-fw-messa"></div>
                                            <div class="login_phone_in center-block">
                                                <input type="text" placeholder="Enter Mobile No." id="pk-fw-uname">
                                                <input type="password" placeholder="Enter Password" id="pk-fw-passw" style="display:none">
                                            </div>
                                        </div>
                                    </div>
                                    <span class="submit_img">
                                        <img src="/img/submit.png" id="pk-fw-submi" width="80%" />
                                    </span>
                                    <p class="forgot_pass"><a href="/forgot-password">Forgot password</a></p>
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
        <div id="device_check" style="display:none">
        <?php
            if($_device != "desktop" && $_device != "iphone"){ // For Android
        ?>
        <div style="position: fixed; bottom: 0; left: 0; width: 100%; z-index: 99999; color: #fff;">
            <a href="https://play.google.com/store/apps/details?id=com.pickmeals">
                <img align="left" width="100%;" src="/img/../img/download_app.png" />
            </a>
            <img align="right" style="position: absolute; top: 0; right: 0; width: 45px; height: 45px;" onclick="javascript: $(this).parent().remove();" height="100" src="/img/1422693125_circle_close_delete-128.png" />
        </div>
        <?php
            }
            if($_device == "iphone" && false == true){ // For iphone
        ?>
        <div style="position: fixed; bottom: 0; left: 0; width: 100%; z-index: 99999; background: #595959; color: #fff;">
            <a href="#"><img width="100%" src="http://mimento.es/assets/web/images/appstore.png" /></a>
        </div>
        <?php
            }
        ?>
        </div>
        
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
                    access_token = response.authResponse.accessToken; //get access token
                    user_id = response.authResponse.userID; //get FB UID

                    FB.api('/me', function(response) {
                        FB.api("/me/picture?width=180&height=180", function(r)
                        {
                            response.profile_pic = r.data.url;
                            $.post("/webapp/fblogin", {"data": response}, function(d) {
                                if (d.error == 0) {
                                    $('#login-mdl').modal('hide');
                                    try{
                                        var options = {
                                            iconUrl: '//pickmeals.com/img/pickmeals_icon.png',
                                            title: 'pickmeals.com',
                                            body: d.msg,
                                            timeout: 7000,
                                            onclick: function() {
                                                notification.close();
                                            }
                                        };
                                        $.notification(options);
                                    } catch (e) {
                                        alert(d.msg);
                                    }
                                    window.location = "/";
                                }
                                console.log(d);
                            });

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


        var pk_fw_login = 0;
        
        $('#login-mdl').on('shown.bs.modal', function () {
            $('#pk-fw-uname').slideDown();
            $('#pk-fw-passw').slideUp();
            $('.lgn-fb').show();
            pk_fw_login = 0;
        });

        var login_mthd = function() {
            $('#pk-fw-messa').html("");
            if($('#pk-fw-uname').val().length < 10){
                $('#pk-fw-messa').html("<center>Please enter your mobile number...</center>");
            }else{
                $('#pk-fw-messa').html("");
            }
            if (pk_fw_login == 0 && $('#pk-fw-uname').val().length >= 10 ) {
                $('#pk-fw-messa').html("");
                $.post("/webapp/checklogin", {'data[Customer][mobile_number]': $('#pk-fw-uname').val()}, function(d) {
                    if (d.count == 0) {
                        $('#pk-fw-messa').html("Your Password has been sent to your mobile number...");
                    }
                    $('#pk-fw-uname').slideUp();
                    $('#pk-fw-passw').slideDown();
                    $('.lgn-fb').hide();
                    pk_fw_login = 1;
                });
                return false;
            }
            if (pk_fw_login == 1) {
                $('#pk-fw-passw').val();
                $.post("/webapp/login", {'data[Customer][mobile_number]': $('#pk-fw-uname').val(), 'data[Customer][password]': $('#pk-fw-passw').val()}, function(d) {
                    console.log(d);
                    if (d.error == 1) {
                        pk_fw_login = 1;
                        $('#pk-fw-messa').html("Please try again...");
                    } else {
                        try{
                            var options = {
                                iconUrl: '//pickmeals.com/img/pickmeals_icon.png',
                                title: 'pickmeals.com',
                                body: d.msg,
                                timeout: 7000,
                                onclick: function() {
                                    notification.close();
                                }
                            };
                            $.notification(options);
                        } catch (e) {
                            alert(d.msg);
                        }
                        pk_fw_login = 2;
                        $('#login-mdl').modal('hide');
                        window.location = "/";
                    }
                });

                return false;
            }

        };


        $(document).ready(function() {
            
            //=- device_check app download link
            if(typeof sessionStorage.device_check == "undefined"){
                sessionStorage.device_check = '<?php echo $_device; ?>';
                $('#device_check').show();
            }
            
            
            $('#pk-fw-submi').off("click").on("click", login_mthd);
            $('#pk-fw-uname, #pk-fw-passw').off("keyup").on("keyup", function(e) {
                if(e.keyCode == 13){
                    login_mthd();
                }
            });

        });


<?php if ($this->request->query('_act') == "login") { ?>
            $('#login-mdl').modal('show');
<?php } ?>
    </script>
    <style type="text/css">
        .top-txt a{
            color: #fff;
        }
        .top-txt{
            padding: 27px;
        }
        .trans-btns {
            background: rgba(230,230,230,0.9);
            color: #000;
            padding: 5px 16px;
            /*            border: # 1px solid;*/
            margin-left: 6px;
            border-radius: 3px; 
            box-shadow: 0 0 5px rgba(200,200,200,0.6);

        }
        .trans-btns:hover {
            background: rgba(230,230,230,0.4);
            //font-weight: bold;
            text-decoration: none;
        }

        @media (max-width:767px){
            .home_content{z-index: 9999;}
        }

    </style>
</html>