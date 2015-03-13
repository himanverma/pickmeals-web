<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
?>
<html>
    <head>
        <?php echo $this->Html->charset(); ?>
        <title>PickMeal | <?php echo @$title_for_layout; ?></title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <?php echo $this->Html->meta("icon", "favicon.ico"); ?>
        <!-- bootstrap 3.0.2 -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/knockout/3.2.0/knockout-min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/knockout.mapping/2.4.1/knockout.mapping.js"></script>

        <?php 
            echo $this->Html->css(array(
                'cake.generic',
                'admin/bootstrap.min',
                'admin/font-awesome.min',
                'admin/ionicons.min',
                'admin/AdminLTE',
                'admin/bootstrap-wysihtml5/bootstrap3-wysihtml5.min'
            ));
            echo $this->Html->script(array(
                    '//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js',
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
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="error-template">
                        <h1>
                            <?php echo $this->Session->flash(); ?></h1>
                        <h2>
                            404 Not Found</h2>
                        <div class="error-details">
                            <?php echo $this->fetch('content'); ?>
                        </div>
                        <div class="error-actions">
                            <a href="/" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-home"></span>
                                Take Me Home </a><a href="/contact-us" class="btn btn-default btn-lg"><span class="glyphicon glyphicon-envelope"></span> Contact Support </a>
                        </div>

                    </div>
                    <div>
                        <?php echo $this->element('sql_dump'); ?>
                    </div>
                </div>
            </div>
        </div>
        <style type="text/css">
            body { background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABoAAAAaCAYAAACpSkzOAAAABHNCSVQICAgIfAhkiAAAAAlwSFlzAAALEgAACxIB0t1+/AAAABZ0RVh0Q3JlYXRpb24gVGltZQAxMC8yOS8xMiKqq3kAAAAcdEVYdFNvZnR3YXJlAEFkb2JlIEZpcmV3b3JrcyBDUzVxteM2AAABHklEQVRIib2Vyw6EIAxFW5idr///Qx9sfG3pLEyJ3tAwi5EmBqRo7vHawiEEERHS6x7MTMxMVv6+z3tPMUYSkfTM/R0fEaG2bbMv+Gc4nZzn+dN4HAcREa3r+hi3bcuu68jLskhVIlW073tWaYlQ9+F9IpqmSfq+fwskhdO/AwmUTJXrOuaRQNeRkOd5lq7rXmS5InmERKoER/QMvUAPlZDHcZRhGN4CSeGY+aHMqgcks5RrHv/eeh455x5KrMq2yHQdibDO6ncG/KZWL7M8xDyS1/MIO0NJqdULLS81X6/X6aR0nqBSJcPeZnlZrzN477NKURn2Nus8sjzmEII0TfMiyxUuxphVWjpJkbx0btUnshRihVv70Bv8ItXq6Asoi/ZiCbU6YgAAAABJRU5ErkJggg==);}
            .error-template {padding: 40px 15px;text-align: center;}
            .error-actions {margin-top:15px;margin-bottom:15px;}
            .error-actions .btn { margin-right:10px; }
        </style>
    </body>
</html>
