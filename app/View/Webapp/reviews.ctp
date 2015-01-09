<div class="chef_profile">
    <div class="col-sm-3">
        <div class="chef_profile_left">
            <div class="chef_profile_img"><img src="<?php echo $combination['Vendor']['photo'] != null ? $combination['Vendor']['photo'] : "/img/chef_profile.jpg"; ?>"></div>
            <div class="chef_profile_about">
                <h1><?php echo $vendor['Vendor']['name']; ?></h1>
                <ul>
                    <!--                    <li>
                                            <span class="rateit" id="vendor-ratings-bl" data-rateit-value="0" data-rateit-ispreset="true" data-rateit-readonly="true"></span>(<span id="vendor-ratings"></span>)<br>
                                        </li>-->
                    <li><span class="chef_profile_home"><img src="/img/home.png"></span>
                        <p><?php echo $combination['Vendor']['address']; ?></p>
                    </li>
                    <li><span class="chef_profile_phone"><img src="/img/phone.png"></span>
                        <p><?php echo $combination['Vendor']['email']; ?></p>
                    </li>
                    <li><span class="chef_profile_phone"><img src="/img/phone.png"></span>
                        <p><?php echo $combination['Vendor']['company_name']; ?></p>
                    </li>
                    <li><span class="chef_profile_phone"><img src="/img/phone.png"></span>
                        <p><?php echo $combination['Vendor']['mobile_number']; ?></p>
                    </li>
                    <li><span class="chef_profile_phone"><img src="/img/phone.png"></span>
                        <p><?php echo $combination['Vendor']['phone_number']; ?></p>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-sm-9" id="combination-sec">
        <div class="chef_list_inn">
            <div class="chef_list_title">
                <h2>Combinations Detail</h2>
            </div>
            <div class="chef_list_main">

                <div class="chef_list">
                    <div class="chef_list_title">
                        <h3><?php echo $combination['Combination']['display_name']; ?></h3>
                    </div>
                    <div class="col-sm-2">
                        <div class="row">
                            <div class="chef_list_left"> <img src="<?php echo $combination['Combination']['image'] != NULL ? $combination['Combination']['image'] : "/img/product.png"; ?>"> </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="row">
                            <div class="chef_list_right">
                                <ul>
                                    <li>
                                        <p><?php echo $combination['Vendor']['name']; ?></p>
                                    </li>
                                    <li>
<!--                                        <span class="rateit" data-rateit-value="<?php echo $tRate; ?>" data-rateit-ispreset="true" data-rateit-readonly="true"></span>-->
                                        (<?php echo $this->Paginator->counter(array('format' => __('{:count}'))); ?>)
                                    </li>
                                    <li>
                                        <h4><span>Delivery:</span>Free/45 mins</h4>
                                    </li>
                                    <li>
                                        <h3><span>Price:</span>Rs <?php echo $combination['Combination']['price']; ?></h3>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">

                    </div>
                    <div style="height: 150px" class="clr-div"></div>
                </div>
                <div class="row">
                    <?php foreach ($reviews as $rv) { ?>
                        <div class="well" >
                            <div class="row">
                                <div class="col-sm-3">
                                    <img src="<?php echo $rv['Customer']['image']; ?>" />
                                </div>
                                <div class="col-sm-9">
                                    <span class="rateit" id="vendor-ratings-bl" data-rateit-value="<?php echo $rv['Review']['ratings']; ?>" data-rateit-ispreset="true" data-rateit-readonly="true"></span><br>
                                    <b>by <?php echo $rv['Customer']['name']; ?></b><br>
                                    <p>
                                        <?php echo $rv['Review']['review']; ?>
                                    </p>
                                    <sub class="pull-right"><?php echo $rv['Review']['created']; ?></sub>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>



</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('.rateit').rateit();
    });
</script>