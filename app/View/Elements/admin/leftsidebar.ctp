<!-- Left side column. contains the logo and sidebar -->
<aside id="left-sidebar" class="left-side sidebar-offcanvas">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <!--<img src="../img/avatar3.png" class="img-circle" alt="User Image" />-->
                <!--<img src="<?php //echo $this->Html->url('img/avatar3.png',array('class'=>"img-circle"));?>" />-->
                <?php echo $this->Html->image('avatar3.png',array('class'=>"img-circle"));?>
            </div>
            <div class="pull-left info">
                <p>Hello, Administrator</p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
<!--        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
                <span class="input-group-btn">
                    <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form>-->
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
<!--            <li>
                <a href="<?php echo $this->Html->url('/Dashboard/cordova'); ?>" >Cordova</a>
            </li>-->
            <li>
                <a href="<?php echo $this->Html->url('/Devices/notify'); ?>">
                    <i class="fa fa-dashboard"></i>
                    <span>App Notifications</span>
                    <small class="badge pull-right bg-green">new</small>
                    <i class="fa fa-plus pull-right"></i>
                </a>
            </li>
            <li>
                <a href="<?php echo $this->Html->url('/Dashboard/neworder'); ?>">
                    <i class="fa fa-dashboard"></i>
                    <span>Place Order</span>
                    <small class="badge pull-right bg-green">new</small>
                    <i class="fa fa-plus pull-right"></i>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i>
                    <span>Orders</span>
                    <!--<small class="badge pull-right bg-green">new</small>-->
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo $this->Html->url('/orders/');?>"><i class="fa fa-angle-double-right"></i> List All</a></li>
                    <li><a href="<?php echo $this->Html->url('/orders/add');?>"><i class="fa fa-angle-double-right"></i> Add New</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i>
                    <span>Customers</span>
                    <!--<small class="badge pull-right bg-green">new</small>-->
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo $this->Html->url('/Customers/');?>"><i class="fa fa-angle-double-right"></i> List All</a></li>
                    <li><a href="<?php echo $this->Html->url('/Customers/add');?>"><i class="fa fa-angle-double-right"></i> Add New</a></li>
                </ul>
            </li>
            
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i>
                    <span>Delivery Boys</span>
                    <small class="badge pull-right bg-green">new</small>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo $this->Html->url('/deliveryBoys/');?>"><i class="fa fa-angle-double-right"></i> List All</a></li>
                    <li><a href="<?php echo $this->Html->url('/deliveryBoys/add');?>"><i class="fa fa-angle-double-right"></i> Add New</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-circle"></i>
                    <span>Chefs (Food Vendors)</span>
                    <!--<small class="badge pull-right bg-green">new</small>-->
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo $this->Html->url('/vendors/');?>"><i class="fa fa-angle-double-right"></i> List All</a></li>
                    <li><a href="<?php echo $this->Html->url('/vendors/add');?>"><i class="fa fa-angle-double-right"></i> Add New</a></li>
                </ul>
            </li>
            
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>Filter</span>
                    <!--<small class="badge pull-right bg-green">new</small>-->
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo $this->Html->url('/Dishfilters/');?>"><i class="fa fa-angle-double-right"></i> List All</a></li>
                    <li><a href="<?php echo $this->Html->url('/Dishfilters/add');?>"><i class="fa fa-angle-double-right"></i> Add New</a></li>
                </ul>
            </li>
            
            
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>Recipes (Food Items)</span>
                    <!--<small class="badge pull-right bg-green">new</small>-->
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo $this->Html->url('/recipes/');?>"><i class="fa fa-angle-double-right"></i> List All</a></li>
                    <li><a href="<?php echo $this->Html->url('/recipes/add');?>"><i class="fa fa-angle-double-right"></i> Add New</a></li>
                </ul>
            </li>
            
            
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-folder"></i>
                    <span>Combinations</span>
                    <!--<small class="badge pull-right bg-green">new</small>-->
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo $this->Html->url('/combinations/add');?>"><i class="fa fa-angle-double-right"></i> Add New</a></li>
                    <li>
                        <a href="<?php echo $this->Html->url('/combinations/generate');?>">
                            <i class="fa fa-angle-double-right"></i> Generate-Combination
                        </a>
                    </li>
                    <li><a href="<?php echo $this->Html->url('/combinations/today');?>"><i class="fa fa-angle-double-right"></i> List All(since 20th feb)</a></li>
                    <li><a href="<?php echo $this->Html->url('/combinations/');?>"><i class="fa fa-angle-double-right"></i> List All</a></li>
                </ul>
            </li>
            
            <li>
                <a href="/AppVersions/edit/1">
                    <i class="fa fa-dashboard"></i>
                    <span>AppVersion</span>
<!--                    <small class="badge pull-right bg-green">new</small>-->
                </a>
            </li>
            
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i>
                    <span>Category-List</span>
                    <!--<small class="badge pull-right bg-green">new</small>-->
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo $this->Html->url('/categories/');?>"><i class="fa fa-angle-double-right"></i> List All</a></li>
                    <li><a href="<?php echo $this->Html->url('/categories/add');?>"><i class="fa fa-angle-double-right"></i> Add New</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i>
                    <span>Send-Notification-List</span>
                    <!--<small class="badge pull-right bg-green">new</small>-->
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo $this->Html->url('/SendNotifications/');?>"><i class="fa fa-angle-double-right"></i> List All</a></li>
                    <li><a href="<?php echo $this->Html->url('/SendNotifications/add');?>"><i class="fa fa-angle-double-right"></i> Add New</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i>
                    <span>Splashes</span>
                    <!--<small class="badge pull-right bg-green">new</small>-->
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo $this->Html->url('/Splashs/');?>"><i class="fa fa-angle-double-right"></i> List All</a></li>
                    <li><a href="<?php echo $this->Html->url('/Splashs/add');?>"><i class="fa fa-angle-double-right"></i> Add New</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#" data-bind="click:updateShopOpenStatus">
                    <!-- ko if:shop_online()=='on' -->
                    <i class="fa fa-dashboard"></i>
                    <span>Shop Status</span>
                    <small class="badge pull-right bg-green">Open</small>
                    <!-- /ko -->
                    <!-- ko if:shop_online()=='off' -->
                    <i class="fa fa-dashboard"></i>
                    <span>Shop Status</span>
                    <small class="badge pull-right bg-orange">Closed</small>
                    <!-- /ko -->
                </a>
            </li>
            <li>
                <a href="/tests/getxorder" >
                    <i class="fa fa-download"></i>
                    <span>Download XLS</span>
<!--                    <small class="badge pull-right bg-orange">Closed</small>-->
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i>
                    <span>Error-List</span>
                    <!--<small class="badge pull-right bg-green">new</small>-->
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo $this->Html->url('/Errorlogs/');?>"><i class="fa fa-angle-double-right"></i> List All</a></li>
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
<script type="text/javascript">
    var LeftSidebarVM = function(){
        var me = this;
        me.shop_online = ko.observable('<?php echo Configure::read('Global.shop_online'); ?>');
        me.updateShopOpenStatus = function(){
            $.post('<?php echo $this->Html->url('/Globalsettings/shoponline'); ?>',function(d){
                me.shop_online(d.d);
            });
        };
    };
    var lvm = new LeftSidebarVM();
    ko.applyBindings(lvm,$('#left-sidebar')[0]);
</script>