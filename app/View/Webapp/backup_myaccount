<?php //debug($me); exit;   ?>
<div class="user_profile">
    <div class="col-sm-3">

        <div class="user_profile_left" id="cstr-profile">
            <form method="post" id='cstr-profile-frm' data-bind="css:{greyMe: isUpdating}">
                <div class="user_profile_img">

                    <img onerror="this.src = '/img/chef_profile.jpg'" data-bind="attr: {'src':image} ">
                    <input class="il-edit" name="data[Customer][image]" type="file" data-bind="event: { 'blur': stopEditing , 'change': imageUpdate }" /> 
                    
                </div>
                <div class="user_profile_about">
                    <h1>
                        <div class="editor editor2"> 
                            <div class="il-view" data-bind="click: editItem , text: name() || 'Edit Full Name...'"> 
                            </div>
                            <input class="il-edit" type="text" name="data[Customer][name]" data-bind="value: name, event: { 'blur': stopEditing }" /> 
                        </div>
                    </h1>
                    <ul>
                        <li>
                            <span class="user_profile_phone"><img src="/img/home.png"></span>
                            <div class="editor editor2"> 
                                <div class="il-view" data-bind="click: editItem , text: address() || 'Edit Address...'"> 
                                </div>
                                <input class="il-edit" type="text" name="data[Customer][address]" data-bind="value: address, event: { 'blur': stopEditing }" /> 
                            </div> 
                        </li>
                        <li><span class="user_profile_phone"><img src="/img/phone.png"></span>
                            <div class="editor"> 
                                <div class="il-view" data-bind=" text: mobile_number() || 'Add mobile number...'"> 
                                </div>
                                <input class="il-edit" type="text" name="data[Customer][mobile_number]" data-bind="value: mobile_number, event: { 'blur': stopEditing }" /> 
                            </div> 
                        </li>
<!--                        <li><span class="user_profile_phone"><img src="/img/phone.png"></span>
                            <div class="editor"> 
                                <div class="il-view" data-bind=" text: email() || 'Add Email Address...'"> 
                                </div>
                                <input class="il-edit" type="text" name="data[Customer][email]" data-bind="value: email, event: { 'blur': stopEditing }" /> 
                            </div> 
                        </li>-->
                        <li>
                            <a href="/change-password">Change Password</a>
                        </li>
                        <input type="hidden" name="data[Customer][id]" value="" data-bind="value:uid " />
<!--                        <input type="hidden" name="data[Customer][fbid]" value="" data-bind="value:fbid " />-->
<!--                        <li><span class="user_profile_phone">Verified:</span>
                            <p> <?php echo $me['verified']; ?></p>
                        </li>-->
                        
                    </ul>
                    
                </div>
            </form>
            
            <div id="" data-bind="visible:isUpdating ">Updating...</div>
        </div>
    </div>
    <div class="col-sm-9">
        <div class="user_list_inn">
            <div class="user_list_title">
                <h2>Order history</h2>
            </div>
            <div id="i-cont-load">

            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.form/3.51/jquery.form.min.js"></script>
<script type="text/javascript">
    
    
    
    
    
    
    var CustomerVM = function() {
        var me = this;
        me.isUpdating = ko.observable(false);
        me.name = ko.observable('<?php echo $me['name']; ?>');
        me.uid = ko.observable(<?php echo $me['id']; ?>);
        me.fbid = ko.observable(<?php echo $me['fbid']; ?>);
        me.address = ko.observable('<?php echo $me['address']; ?>');
        me.mobile_number = ko.observable('<?php echo $me['mobile_number']; ?>');
        me.email = ko.observable('<?php echo $me['email']; ?>');
        me.image = ko.observable('<?php echo $me['image'] == "" ? "http://placehold.it/100x120&text=NA" : $me['image']; ?>');
        me.savedata = ko.computed(function(){
            var m = this; 
            me.name();
            me.address();
            me.mobile_number();
            me.isUpdating(true);
            $('#cstr-profile-frm').ajaxSubmit({
                success: function(d){
                    if(d.Customer.image != ""){
                        m.image(d.Customer.image);
                    }
                    m.isUpdating(false);
                }
            });
        },this);
        me.imageUpdate = function(d,e){
            var m = me;
            m.isUpdating(true);
            $('#cstr-profile-frm').ajaxSubmit({
                success: function(d){
                    if(d.Customer.image != ""){
                        m.image(d.Customer.image);
                    }
                    m.isUpdating(false);
                }
            });
        };
        me.editItem = function(d,e) {
            $(e.currentTarget).parent().addClass('il-editing');
            $(e.currentTarget).parent().find('il-edit').focus();
        };
        me.stopEditing = function(d,e) {
            $(e.currentTarget).parent().removeClass('il-editing');
        };
        me.saveData = function(){
            $('#cstr-profile-frm')[0].submit();
        }
        me.init = function(){
            $('#cstr-profile-frm').ajaxForm({
                success: function(d){
                    console.log(d);
                }
            });
        }
        me.init();
        
    };
    var CustomerObj = new CustomerVM();
    
    var paginate = function(event) {
        event.preventDefault();
        var href;
        href = $(this).attr('href');
        getOrderView($(this).attr('href'));
        return false;
    };
    var getOrderView = function(urle) {
        if (urle.match(/\/myorders*/i)) {
            $('#i-cont-load').html("<br><br><br><center>loading...</center><br><br><br>");
        }

        $.ajax({
            url: urle,
            cache: false,
            success: function(html) {
                if (urle.match(/\/myorders*/i)) {
                    $('#i-cont-load').html(html);
                }
                $('.pagination a').off("click").on("click", paginate);

            }
        });
    }
    $(document).ready(function() {
        getOrderView('/webapp/myorders/');
        ko.applyBindings(CustomerObj, $('#cstr-profile')[0]);
        
    });
</script>
<style type="text/css">
    .il-edit {
        display: none;    
    }

    .il-editing .il-edit {
        display: block;    
    }

    .il-editing .il-view {
        display: none;
    }
    .editor .il-view{
        height: 30px
    }
    .editor2 .il-view:hover{
        background: url('/img/edit_pen.png') right no-repeat rgba(160,160,160,0.2);
        background-size: 18px 18px;
        cursor: pointer;
    }
    .ipas {
        width: 100%;
    }
    .greyMe {
        opacity: 0.5;
    }
</style>