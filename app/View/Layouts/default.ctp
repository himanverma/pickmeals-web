<!DOCTYPE html>
<html>
    <head>
        <?php echo $this->Html->charset(); ?>
        <title>PickMeal | <?php echo @$title_for_layout; ?></title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <?php echo $this->Html->meta("icon", "favicon.ico"); ?>
        <!-- bootstrap 3.0.2 -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/knockout/3.2.0/knockout-min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/knockout.mapping/2.4.1/knockout.mapping.js"></script>
        <script type="text/javascript">
            if (navigator.userAgent.match(/Android/i)) {

            } else {
                window._cordovaNative = true;
            }
//            window._cordovaNative = true; 
        </script>
        <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0-rc.2/css/select2.min.css" rel="stylesheet" />
        <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0-rc.2/js/select2.min.js"></script>
        <?php
        echo $this->Html->css(array(
            'cake.generic',
            'admin/bootstrap.min',
            'admin/font-awesome.min',
            'admin/ionicons.min',
            'admin/AdminLTE',
            'admin/bootstrap-wysihtml5/bootstrap3-wysihtml5.min',
            '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0-rc.2/css/select2.min.css'
//            '//cdnjs.cloudflare.com/ajax/libs/chosen/1.4.1/chosen.min.css'
        ));
        echo $this->Html->script(array(
            '/cordova',
            '//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js',
            '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0-rc.2/js/select2.min.js'
//            '//cdnjs.cloudflare.com/ajax/libs/chosen/1.1.0/chosen.jquery.min.js'
                //'app/swt'
        ));
        ?>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

    </head>
    <body class="skin-blue">
        <div class="gv-pnl">
            <?php echo $this->element('admin/header'); ?>
            <div class="wrapper row-offcanvas row-offcanvas-left">
                <?php echo $this->element('admin/leftsidebar'); ?>
                <!-- Right side column. Contains the navbar and content of the page -->
                <aside class="right-side">
                    <!-- Content Header (Page header) -->
                    <?php echo $this->fetch('cheader'); ?>


                    <!-- Main content -->
                    <section class="content">

                        <?php echo $this->fetch('content'); ?>

                    </section><!-- /.content -->
                </aside><!-- /.right-side -->
            </div><!-- ./wrapper -->

            <?php
            $this->Combinator->add_libs('js', array(
                'admin/bootstrap.min',
                'admin/AdminLTE/app',
                'admin/AdminLTE/demo'
            ));
            echo $this->Combinator->scripts('js'); // Output Javascript files

            echo $this->fetch('endjs');
            ?>
            <style type="text/css">
                .pagination span{
                    background: #0075b0;
                    color: #fff;
                    padding:4px; 
                }
            </style>
        </div>
        <div id="map-canvas" style="display: none"></div>
        <div id="gvm-panel" style="display: none">
            <div id="gvm-msg"></div>
            <button id="map-your-loc" class="btn btn-danger">You</button>
            <button id="map-dest-loc" class="btn btn-danger">Destination</button>
            <button id="map-hide" class="btn btn-danger">Close</button>
        </div>

        <script type="text/javascript">
            var myCords = {
                lat: 0,
                lng: 0
            };
            var greq_fw = null;
            var pos = false;
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

                    $('.direction-mp').on("click", function() {
                        myCords.lat = parseFloat($(this).data('lat'));
                        myCords.lng = parseFloat($(this).data('lng'));
                        launchnavigator.navigate(
                                [myCords.lat, myCords.lng],
                                null,
                                function() {
                                    //                    alert("Plugin success");
                                },
                                function(error) {
                                    //                    alert("Plugin error: "+ error);
                                });
                    });




                    // Android customization
                    cordova.plugins.backgroundMode.setDefaults({text: 'PMAdmin is Running in Background...'});
                    // Enable background mode
                    cordova.plugins.backgroundMode.enable();

                    // Called when background mode has been activated
                    cordova.plugins.backgroundMode.onactivate = function() {
                        setTimeout(function() {
                            // Modify the currently displayed notification
                            cordova.plugins.backgroundMode.configure({
                                text: 'PMAdmin running in background for more than 5s now.'
                            });

                        }, 5000);
                    };


                    setInterval(function() {
                        try {
                            greq_fw.abort();
                        } catch (e) {
                        }
                        greq_fw = $.post('<?php echo $this->Html->url('/Dashboard/getNotRespondedOrders'); ?>', function(d) {
                            d = JSON.parse(d);
                            if (d.length == 0) {
                                return false;
                            }
                            var noti = [];
                            for (i in d) {
                                noti.push({
                                    id: d[i].Order.id,
                                    title: "New Order Arrived ID: " + d[i].Order.sku,
                                    text: "",
                                    //            at: today_at_8_45_am,
                                    //                        every: 1,
//                                    icon: 'https://www.pickmeals.com/favicon.ico',
                                    sound: "https://www.pickmeals.com/newOrder.mp3",
                                    data: {Order: d[i]}
                                });
                                
                                setTimeout(function(){
                                    navigator.notification.vibrateWithPattern([0, 800, 300, 900, 2000, 4000, 100]);
                                },3000);
                                
                            }
                            cordova.plugins.notification.local.schedule(noti);
                        });


                    }, 10000);

                    cordova.plugins.notification.local.on("click", function(notification) {
                        //notification.data.OrderId
                        window.location = "<?php echo $this->Html->url('/orders'); ?>";
                    });
                    console.log('Received Event: ' + id);
                }
            };

            app.initialize();
        </script> 


    </body>
</html>
