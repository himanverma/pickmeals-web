<section class="content">
    <div class="row">
        <section class="col-lg-6 connectedSortable">
            <!-- Map box -->
            <div class="box box-primary">
                <div class="box-header">
                    <!-- tools box -->
                    <div class="pull-right box-tools">                                        
                        <button class="btn btn-primary btn-sm daterange pull-right" data-toggle="tooltip" title="Date range"><i class="fa fa-calendar"></i></button>
                        <button class="btn btn-primary btn-sm pull-right" data-widget='collapse' data-toggle="tooltip" title="Collapse" style="margin-right: 5px;"><i class="fa fa-minus"></i></button>
                    </div><!-- /. tools -->

                    <i class="fa fa-map-marker"></i>
                    <h3 class="box-title">
                        Message
                    </h3>
                </div>
                <div class="box-body no-padding">
                    <?php print_r($result); ?>
                </div>
            </div>
        </section>

        
        <section class="col-lg-6 connectedSortable">
            <!-- Map box -->
            <div class="box box-primary">
                <div class="box-header">
                    <!-- tools box -->
                    <div class="pull-right box-tools">                                        
                        <button class="btn btn-primary btn-sm daterange pull-right" data-toggle="tooltip" title="Date range"><i class="fa fa-calendar"></i></button>
                        <button class="btn btn-primary btn-sm pull-right" data-widget='collapse' data-toggle="tooltip" title="Collapse" style="margin-right: 5px;"><i class="fa fa-minus"></i></button>
                    </div><!-- /. tools -->

                    <i class="fa fa-map-marker"></i>
                    <h3 class="box-title">
                        Combinations
                    </h3>
                </div>
                <div class="box-body no-padding">
                    <table class="table table-responsive">
                        <thead>
                            <tr>
                                <th>
                                    <input class="simple" type="checkbox" />
                                </th>
                                <td></td>
                                <th>
                                    Combination Details
                                </th>
                                <th>
                                    Qty
                                </th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody data-bind="foreach: combinations ">
                            <tr>
                                <td style="vertical-align: middle;">
                                    <input class="simple" type="checkbox" data-bind="value: jsonval , checked:$root.selectedCombinations " value="" />
                                </td>
                                <td>
                                    <img data-bind="attr:{'src':Combination.image} " width="70px" />
                                </td>
                                <td>
                                    <b data-bind="text:Combination.display_name "></b>
                                    <p>Vendor: <span data-bind="text:Vendor.company_name"></span></p>
                                    <p>Price: Rs. <span data-bind="text:Combination.price"></span>/=</p>
                                </td>
                                <td>
                                    <input data-bind="value:qty" type="number" min="1" max="20" value="1"/>
                                </td>
                                <td>
                                    <b>Rs. <!-- ko text:total --><!-- /ko -->/=</b>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
</section>