<?php echo $this->Form->create('Combination'); ?>
<div class="box box-primary" id="page-s">
    <div class="box-header">
        <!--<h3 class="box-title">Quick Example</h3>-->
    </div><!-- /.box-header -->
    <!-- form start -->
    <div class="box-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <?php
                    echo $this->Form->input("vendor_id", array(
                        'div' => false,
                        'options' => array(),
                        'class' => 'form-control',
                        'placeholder' => 'Enter Username',
                        'data-bind' => "value:vendor, options: dataV, optionsText: 'name', optionsValue: 'id'"
                    ));
                    ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <?php
                    echo $this->Form->input("recipe_id", array(
                        'div' => false,
                        'options' => array(),
                        'class' => 'form-control',
                        'style' => 'height: 490px;',
                        'placeholder' => 'Enter Username',
                        'multiple' => 'multiple',
                        'data-bind' => "selectedOptions:recipes, options: dataR, optionsText: 'recipe_name', optionsValue: 'id'"
                    ));
                    ?>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" data-bind="click:generate">Generate Combinations</button>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <table class="table-bordered table">
                        <tbody data-bind="foreach: generatedD">
                            <tr>
                                <td><input type="checkbox" data-bind="attr: { 'value': $index, 'id': 'checkBox-' + $index }, checked: $parent.setData" /></td>
                                <td>
                                    <input type="text" data-bind="value:Combination.display_name" />
                                </td>
                                <td>Stock Count: <input class="pull-right" type="text" value="10" data-bind="value:Combination.stock_count" /></td>
                                <td>Vendor Price: <input class="pull-right" type="text" value="0.00" data-bind="value:Combination.vendor_cost" /></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="form-group">
            <button class="btn btn-primary" data-bind="click:send">Add</button>
        </div>
    </div>
</div>
<?php echo $this->Form->end(__('Submit')); ?>
<script type="text/javascript">
    var CombinationsVM = function() {
        var me = this;
        me.dataR = <?php echo json_encode($recipes); ?>;
        me.dataV = <?php echo json_encode($vendors); ?>;
        me.recipes = ko.observableArray([]);
        me.vendor = ko.observable();
        me.generatedD = ko.observableArray([]);
        me.generatedData = ko.observableArray([]);
        me.setData = ko.observableArray([]);
        me.is_sending=ko.observable(false);
        me.setData.subscribe(function(newVal){
            var d = [];
            for(i in me.setData()){
                d.push(me.generatedD()[cbObj.setData()[i]]);
            }
            me.generatedData(d);
        });
        me.key = function(a, b) {
            if (a > b)
                return b + '-' + a;
            return a + '-' + b;
        }
        me.keyAr = [];
        me.generate = function() {
            me.keyAr = [];
            var r = me.recipes();
            var r2 = me.recipes();
//            if (r.length < 2) {
//                alert("Please select at least two recipes...");
//                return false;
//            }

            me.generatedD([]);
            for (i in r) {
                var name = $.grep(cbObj.dataR, function(e) {
                    return e.id == r[i];
                });
                name = name[0].recipe_name;
                var p1 = $.grep(cbObj.dataR, function(e) {return e.id == r[i];})[0];
                me.generatedD.push({
                    Combination: {
                        key: r[i],
                        vendor_id: me.vendor(),
                        //display_name: "FULL " + name,
                        display_name: name,
                        vendor_cost: ko.observable(0.00),
                        type: p1.type,
                        stock_count: ko.observable(10),
                        CombinationItem: [
                            {
                                recipe_id : p1.id,
                                name_to_display:p1.recipe_name,
                                image: p1.image,
                                is_thali:p1.is_thali
                            }
                            
                        ]
                    }
                });
                for (j in r2) {
                    if (r2[j] == r[i])
                        continue;
                    var name2 = $.grep(cbObj.dataR, function(e) {
                        return e.id == r2[j];
                    });
                    name2 = name2[0].recipe_name;
                    if ($.inArray(me.key(r[i], r2[j]), me.keyAr) == false) {
                        var p2 = $.grep(cbObj.dataR, function(e) {return e.id == r[i];})[0];
                        var p3 = $.grep(cbObj.dataR, function(e) {return e.id == r2[j];})[0];
                        me.generatedD.push({
                            Combination: {
                                key: me.key(r[i].id, r2[j]),
                                vendor_id: me.vendor(),
                                //display_name: "HALF " + name + " + HALF " + name2,
                                display_name: name + " + " + name2,
                                vendor_cost: ko.observable(0.00),
                                type: p2.type,
                                stock_count: ko.observable(10),
                                CombinationItem: [
                                    {
                                        recipe_id : p2.id,
                                        name_to_display:p2.recipe_name,
                                        image: p2.image,
                                        is_thali:p2.is_thali
                                    },
                                    {
                                        recipe_id : p3.id,
                                        name_to_display:p3.recipe_name,
                                        image: p3.image,
                                        is_thali:p3.is_thali
                                    }
                                    
                                ]

                            }
                        });
                    }
                    me.keyAr.push(me.key(r[i], r2[j]));

                }
            }

        }
         
        me.send = function() {
            if(me.is_sending() == false){
                me.is_sending(true);
                $.post('?q=data', {data: ko.mapping.toJS(me.generatedData)}, function(data) {
                    window.location.reload();
                });
            }
            //console.dir(d);
        }
    }
    var cbObj = new CombinationsVM();
    $(document).ready(function() {
        ko.applyBindings(cbObj,$('#page-s')[0]);
    });
</script>    