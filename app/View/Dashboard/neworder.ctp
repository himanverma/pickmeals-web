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
                        Customer
                    </h3>
                </div>
                <div class="box-body no-padding">
                    <form action="#" method="post" id="cst-frm">
                        <div class="form-group">
                            <?php
                                echo $this->Form->input("customer_id",array(
                                    "class" => "form-control chosen-select-deselect",
                                    "options"=>array($customers),
                                    "data-placeholder" => "Choose a existing Customer...",
                                    "data-bind"=>"value:cst"
                                ));
                            ?>
                        </div>
                        <div class="form-group">
                            <label>Customer Type:</label>
                            <select id="cstType" class="form-control" data-bind="value:cstType ">
                                <option value="0">New Customer</option>
                                <option value="1">Existing Customer</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Customer ID:</label>
                            <input type="text" readonly class="form-control" name="data[Customer][id]" id="customer-id" placeholder="Customer ID">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="data[Customer][name]" placeholder="Enter Full Name">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="data[Customer][mobile_number]" placeholder="Enter Mobile Number">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="data[Customer][email]" placeholder="Enter Email-ID">
                        </div>
                        
                        <div>
                            <textarea name="data[Address][address]" class="textarea" placeholder="Address with nearest landmark..." style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="data[Address][area]" placeholder="Area" value="IT Park">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="data[Address][city]" placeholder="City" value="Chandigarh">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="data[Address][zipcode]" placeholder="Zip Code" value="160101">
                        </div>
                        <div class="form-group">
                            <button data-bind="click:submit" type="button">Place Order</button>
                            <!--<input type="text" class="form-control" name="subject" placeholder="Area" value="IT Park">-->
                        </div>
                    </form>
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
<script type="text/javascript">
    
var NewOrderVM = function(){
    var me = this;
    me.cst = ko.observable('');
    me.cstType = ko.observable(0);
    me.cst.subscribe(function(n){
        me.cstType(1);
//        if(n == 0){
//            $('#customer-id').val('');
//        }else{
//            $('#customer-id').val($('#customer_id').val());
//        }
    });
    me.cstType.subscribe(function(n){
        if(n == 0){
            $('#customer-id').val('');
        }else{
            $('#customer-id').val($('#customer_id').val());
        }
    });
    me.rawData = <?php echo json_encode($combinations); ?>;
    me.combinations = ko.observableArray([]);
    me.selectedCombinations = ko.observableArray([]);
    me.submit = function(){
        var d = {};
        d['orders'] = me.selectedCombinations();
      $('#cst-frm input, #cst-frm textarea').each(function(){
          d[$(this).attr('name')] = $(this).val();
      });  
      
      $.post("<?php echo $this->request->here(); ?>",d,function(d){
          window.location.reload();
//          console.log(d);
      });
      console.log(d);
    };
    me.init = function(){
        for(i in me.rawData){
            var r = me.rawData[i];
            r.qty = ko.observable(1);
            r.total = ko.computed(function(){
              return this.qty() * this.Combination.price;  
            },r);
            r.jsonval = ko.computed(function(){
//                var a = {Order: { customer_id: address_id: combination_id: essentials:
//                        lat:
//                        long:
//                        paid_via:
//                        price:
//                        qty:
//                        recipe_names:
//                        sku:
//                        status:
//                        timestamp:
//                    }
//                };
                var a = '{"Order":{"combination_id":'+ this.Combination.id +', "qty":' + this.qty() + ',"total":'+this.total()+'}}'; 
                return a; 
            },r); 
            me.combinations.push(r);
        }
    };
    me.init();
};
var newOrder = new NewOrderVM();
$(document).ready(function(){
    ko.applyBindings(newOrder,$('section.content')[0]);
    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    };
    for (var selector in config) {
//      $(selector).chosen(config[selector]);
        $(selector).select2({
            placeholder: "Select a Customer",
            allowClear: true
          });
    }
//    $('.chosen-select').chosen({
//        no_results_text: "Oops, nothing found!",
//        allow_single_deselect: true
//    });
    
});

</script>