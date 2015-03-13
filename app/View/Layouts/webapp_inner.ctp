<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <?php echo $this->Html->meta("icon", "favicon.ico"); ?>
        <title>Pick Meals</title>

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




        <?php
        echo $this->fetch('startcss');
        echo $this->Html->script(array('bootstrap.min', '/rate/jquery.rateit.min'));
//            $this->Combinator->add_libs('js', array(
//                'js/bootstrap.min',
//            )); 
//            echo $this->Combinator->scripts('js'); // Output Javascript files
//            
        echo $this->fetch('startjs');
        ?>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.notification/1.0.2/jquery.notification.min.js"></script>



    </head>
    <?php
    $sessionFlashMsg = $this->Session->flash();
    ?>
    <body>
        <div class="main_container">

            <?php echo $this->element("inner-header"); ?>
            <div class="container">
                <?php echo $this->fetch('content'); ?>
            </div>
            <?php echo $this->element("inner-footer"); ?>


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
                                    <div class="form-group lgn-fb">
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
        <div style="position: fixed; bottom: 0; left: 0; width: 100%; z-index: 99999; background: #000; color: #fff;">
            <a href="https://play.google.com/store/apps/details?id=com.pickmeals">
                <img align="left" height="100" src="http://www.elcaminohospital.org/portals/0/Images/news/google_play_icon.jpg" />
            </a>
            <img align="right" onclick="javascript: $(this).parent().remove();" height="100" src="/img/1422693125_circle_close_delete-128.png" />
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
                    //console.log(response); // dump complete info
                    access_token = response.authResponse.accessToken; //get access token
                    user_id = response.authResponse.userID; //get FB UID

                    FB.api('/me', function(response) {
                        console.log(response);
                        //user_email = response.email; 
                        $.post("/webapp/fblogin", {"data": response}, function(d) {
                            if (d.error == 0) {
                                $('#login-mdl').modal('hide');
                                try{
                                    var options = {
                                        iconUrl: 'https://www.pickmeals.com/img/pickmeals_icon.png',
                                        title: 'pickmeals.com',
                                        timeout: 7000,
                                        body: d.msg,
                                        onclick: function() {
                                            notification.close();
                                        }
                                    };
                                    $.notification(options);
                                } catch (e) {
                                    alert(d.msg);
                                }
                                var loc = window.location.pathname;
                                if (loc == "/checkout/" || loc == "/checkout") {
                                    //window.location = "/checkout/?_=confirm";
                                    AddressObj.makeOrder();
                                }

                            }
                            console.log(d);
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
                            iconUrl: 'https://www.pickmeals.com/img/pickmeals_icon.png',
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
                        var loc = window.location.pathname;
                        if (loc == "/checkout/" || loc == "/checkout") {
                            //window.location = "/checkout/?_=confirm";
                            AddressObj.makeOrder();
                        } else {
                            window.location.reload();
                        }


                    }
                });

                return false;
            }

        };

        var FilterVM = function() {
            var me = this;
            me.list = ko.observableArray([]);
            me.filter = function(d, e) {
                ComboObj.SearchMeal(d.Dishfilter.recipe_name);
                ComboObj.Search();
            }
            me.init = function() {
                $.post("/api/dishfilters.json", {
                }, function(d) {
                    me.list(d.data);
                });
            }
            me.init();
        };
        FilterObj = new FilterVM();
        $(document).ready(function() {
            
            //=- device_check app download link
            if(typeof sessionStorage.device_check == "undefined"){
                sessionStorage.device_check = '<?php echo $_device; ?>';
                $('#device_check').show();
            }

            
            
            ko.applyBindings(FilterObj, $('#bs-example-navbar-collapse-1')[0]);

            $('#pk-fw-submi').off("click").on("click", login_mthd);
            $('#pk-fw-uname, #pk-fw-passw').off("keyup").on("keyup", function(e) {
                if (e.keyCode == 13) {
                    login_mthd();
                }
            });

            if (window.location.search == "?_=confirm") {

            }

<?php
if ($sessionFlashMsg != "") {
    ?>
            try{
                var options = {
                    iconUrl: 'https://www.pickmeals.com/img/pickmeals_icon.png',
                    title: 'pickmeals.com',
                    timeout: 7000,
                    body: '<?php echo strip_tags($sessionFlashMsg); ?>',
                    onclick: function() {
                        notification.close();
                    }
                };
                $.notification(options);
                } catch (e) {
                    alert('<?php echo strip_tags($sessionFlashMsg); ?>);
                }
<?php } ?>
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
        @media (max-width:767px){
            .container{z-index: 9999;}
            #cart-sec {
                float: left;
            }

        }
    </style>
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
</html>