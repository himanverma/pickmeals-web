<!DOCTYPE html>
<html class="bg-black">
    <head>
        <?php echo $this->Html->charset(); ?>
        <title>PickMeals | <?php echo @$title_for_layout; ?></title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <?php echo $this->Html->meta("icon", "favicon.ico"); ?>
        <?php 
            echo $this->Html->css(array(
                'admin/bootstrap.min',
                'admin/font-awesome.min',
                'admin/ionicons.min',
                'admin/AdminLTE'
            ));
            echo $this->Html->script(array(
                '/cordova',
                'admin/openfb'
            ));
        ?>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="bg-black">

        

        
        
        <div style="padding-bottom: 24px;" class="bs-example">
            <!--<button class="payment_checkout1_button" data-whatever="@mdo" data-target="#login-mdl" data-toggle="modal" class="btn btn-primary" type="button">Place order</button>-->

            <div aria-hidden="true" aria-labelledby="exampleModalLabel" role="dialog" tabindex="-1" id="login-mdl" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content" style="margin-top: 30%">
                        <!--<div class="modal-header">
                          <button data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
              
                        </div>-->
                        <div class="modal-body">
                            <div class="modal-body_in center-block">
                                <form role="form">
                                    <div class="lgn-fb form-group">
                                        <span onclick="fb_login();" class="login_img">
                                            <img src="/img/login.png" width="100%" />
                                        </span>
                                    </div>
                                    <p class="login_or lgn-fb">-OR-</p>
                                    <div class="form-group">
                                        <div class="login_phone">
                                            <div style="color:red;" id="pk-fw-messa"></div>
                                            <div class="login_phone_in center-block form-group">
<!--                                                <input type="text" placeholder="Enter Mobile No." class="" id="pk-fw-uname">-->
                                                <input type="number" placeholder="Enter Mobile No." class="form-control" id="pk-fw-uname">
                                                <input type="password" placeholder="Enter Password" class="form-control" id="pk-fw-passw" style="display:none">
                                            </div>
                                        </div>
                                    </div>
                                    <span class="submit_img">
                                        <img src="/img/submit.png" id="pk-fw-submi" width="100%" />
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
        
        
        
        

        <!-- jQuery 2.0.2 -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- Bootstrap -->
        <?php echo $this->Html->script(array('admin/bootstrap.min')); ?>
        <script type="text/javascript">
            
            var app = {
                // Application Constructor
                initialize: function() {
                    this.bindEvents();
                },
                // Bind Event Listeners
                //
                // Bind any events that are required on startup. Common events are:
                // 'load', 'deviceready', 'offline', and 'online'.
                bindEvents: function() {
                    document.addEventListener('deviceready', this.onDeviceReady, false);
                },
                // deviceready Event Handler
                //
                // The scope of 'this' is the event. In order to call the 'receivedEvent'
                // function, we must explicitly call 'app.receivedEvent(...);'
                onDeviceReady: function() {
                    app.receivedEvent('deviceready');
                },
                // Update DOM on a Received Event
                receivedEvent: function(id) {
                    console.log('Received Event: ' + id);
                }
            };

            app.initialize();
            
            
            
            
            
            
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
//                                        alert(d.msg);
                                    }
                                    window.location = "https://www.pickmeals.com/Dashboard";
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
                            //alert(d.msg);
                        }
                        pk_fw_login = 2;
                        $('#login-mdl').modal('hide');
                        window.location = "https://www.pickmeals.com/Dashboard";
                    }
                });

                return false;
            }

        };


        $(document).ready(function() {
            
            //=- device_check app download link
//            if(typeof sessionStorage.device_check == "undefined"){
//                sessionStorage.device_check = '<?php echo $_device; ?>';
//                $('#device_check').show();
//            }
            
            
            $('#pk-fw-submi').off("click").on("click", login_mthd);
            $('#pk-fw-uname, #pk-fw-passw').off("keyup").on("keyup", function(e) {
                if(e.keyCode == 13){
                    login_mthd();
                }
                return true;
            });
            $('#login-mdl').modal('show');
            $('#login-mdl').on('hidden.bs.modal',function(){$('#login-mdl').modal('show');});
        });
        
        
        </script>

    </body>
</html>