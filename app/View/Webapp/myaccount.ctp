<?php //debug($me); exit;     ?>
<div class="user_profile">
    <div class="col-sm-3">

        <div class="user_profile_left" id="cstr-profile">
            <form method="post" id='cstr-profile-frm' data-bind="css:{greyMe: isUpdating}">
                <div class="user_profile_img">

                    <img onerror="this.src = '/img/chef_profile.jpg'" data-bind="attr: {'src':image} ">
                    <div class="btn btn-primary upload_pic_btn">
                        Select Picture
                    <input class="il-edit f-inp" name="data[Customer][image]" type="file" data-bind="event: { 'blur': stopEditing , 'change': imageUpdate }" /> 
                    </div>

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
                        <?php if ($me['mobile_number'] != ""): ?>  
                            <li><span class="user_profile_phone"><img src="/img/phone.png"></span>
                                <div class="editor"> 
                                    <div class="il-view" data-bind=" text: mobile_number() || 'Add mobile number...'"> 
                                    </div>
                                    <input class="il-edit" type="text" name="data[Customer][mobile_number]" data-bind="value: mobile_number, event: { 'blur': stopEditing }" /> 
                                </div> 
                            </li>
                        <?php endif; ?>
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

<div style="padding-bottom: 24px;" class="bs-example">
    <div aria-hidden="true" aria-labelledby="exampleModalLabel" role="dialog" tabindex="-1" id="image-crop-mdl" class="modal fade" style="display: none;">
        <div class="modal-dialog upload_pic_dialog" style="margin:5% auto;">
            <div class="modal-content">
                <!--<div class="modal-header">
                  <button data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
      
                </div>-->
                <div class="modal-body">
                    <div class="modal-body_in center-block">
                        <div id="cst-im-crop" style="width: 100%;">
                            <img src="" id="thepicture" width="100%" />
                        </div>

                    </div>

                </div>
                <div class="modal-footer upload_pic_crop">
                    <div class="pull-right" id="crp-ftr">
                        <button type="button" onclick="javascript: $('#image-crop-mdl').modal('hide');" class="btn btn-default">Cancel</button>
                        <button type="button" onclick="javascript: CustomerObj.cropNow();" class="btn btn-success crop_pic_save">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.modal -->
</div>
<?php
$this->start("startcss");
echo $this->Html->css(array("cropper.min"));
$this->end();
$this->start("startjs");
echo $this->Html->script(array(
    "//cdnjs.cloudflare.com/ajax/libs/jquery.form/3.51/jquery.form.min.js",
    "cropper.min"
));
$this->end();
?>
<script type="text/javascript">

    var CustomerVM = function() {
        var me = this;
        me.isSaved = true;
        me.isUpdating = ko.observable(false);
        me.name = ko.observable('<?php echo $me['name']; ?>').extend({
            required: {message: 'Please fill your full name.'},
            minLength: {params: 4, message: "Name must be at least 4 characters long."}
        });
        me.uid = ko.observable(<?php echo $me['id']; ?>);
        me.fbid = ko.observable(<?php echo $me['fbid']; ?>);
        me.address = ko.observable('<?php echo $me['address']; ?>').extend({
            required: {message: 'Please fill your address.'},
            minLength: {params: 10, message: "Address field is too small to understand."}
        });
<?php if ($me['mobile_number'] != ""): ?>
            me.mobile_number = ko.observable('<?php echo $me['mobile_number']; ?>').extend({
                required: {message: 'Please fill your 10 digit mobile number.'},
                minLength: {params: 10, message: "Mobile Number must be at least 10 digit long"},
                maxLength: {params: 10, message: "Mobile Number should not more than 10 digits"}
            });
<?php endif; ?>
        me.email = ko.observable('<?php echo $me['email']; ?>');
        me.image = ko.observable('<?php echo $me['image'] == "" ? "https://placehold.it/100x120&text=NA" : $me['image']; ?>');
        me.image.subscribe(function(newVal) {
            $('#thepicture').attr({src: newVal});
        });
        me.cropCordinates = null;
        me.savedata = ko.computed(function() {
            var m = this;
            me.name();
            me.address();
<?php if ($me['mobile_number'] != ""): ?>
                me.mobile_number();
<?php endif; ?>
            me.isUpdating(true);

            $('#cstr-profile-frm').ajaxSubmit({
                success: function(d) {
                    if (d.Customer.image != "") {
                        //m.image(d.Customer.image);
                    }
                    m.isUpdating(false);
                    $('#cstr-profile-frm')[0].reset();
                }
            });

            var err = ko.validation.group(me)();
            for (i in err) {
                try{
                    var options = {
                        iconUrl: 'https://www.pickmeals.com/img/pickmeals_icon.png',
                        title: 'Account details Missing...',
                        body: err[i],
                        timeout: 7000,
                        onclick: function() {
                            notification.close();
                        }
                    };
                    $.notification(options);
                } catch (e) {
                    alert(err[i]);
                }
            }
            m.isUpdating(false);

        }, this);
        me.imageUpdate = function(d, e) {
            var m = me;
            m.isUpdating(true);
            $('#cstr-profile-frm').ajaxSubmit({
                success: function(d) {
                    if (d.Customer.image != "") {
                        m.image(d.Customer.image);
                    }
                    m.showImageCrop(d.Customer);
                    console.log(d);
                    m.isUpdating(false);
                    $('#cstr-profile-frm')[0].reset();
                }
            });
        };
        me.cropNow = function() {
            var m = me;
            $('#crp-ftr').html('Cropping...');
            var data = {
                uri: $('#thepicture').attr('src'),
                h: me.cropCordinates.height,
                w: me.cropCordinates.width,
                x: me.cropCordinates.x,
                y: me.cropCordinates.y
            };
            $.post("/webapp/cropImg", data, function(d) {
                m.isSaved = true;
                if (d.error == 0) {
                    m.image(data.uri + "?_=" + (new Date()).getTime().toString());
                    $('#thepicture').attr({src: data.uri + "?_=" + (new Date()).getTime().toString()});
                    $('#image-crop-mdl').modal('hide');
                    $('#crp-ftr').html('complete...');
                    window.location.reload();
                } else {
                    $('#crp-ftr').html('error occoured...');
                }
            });
        };
        me.removeUncroped = function() {
            console.log(me.isSaved);
            if (!me.isSaved) {
                $.post("/webapp/removeImg", {'data[id]': me.uid()}, function(d) {
                    window.location.reload();
                });
            }
        };
        me.showImageCrop = function(d) {
            var m = me;
            m.isSaved = false;
            $('#thepicture').attr({src: d.image});
            $('#image-crop-mdl').modal('show');
            $('#image-crop-mdl').on('hide.bs.modal', m.removeUncroped);
//            try{
//                $("#cst-im-crop > img").cropper('destroy');
//            }catch(e){
//            }
            $("#cst-im-crop > img").cropper({
                aspectRatio: 1,
                done: function(data) {
                    m.cropCordinates = data;
                }
            });
        };
        me.editItem = function(d, e) {
            $(e.currentTarget).parent().addClass('il-editing');
            $(e.currentTarget).parent().find('il-edit').focus();
        };
        me.stopEditing = function(d, e) {
            $(e.currentTarget).parent().removeClass('il-editing');
        };
        me.saveData = function() {
            $('#cstr-profile-frm')[0].submit();
        }
        me.init = function() {
            $('#cstr-profile-frm').ajaxForm({
                success: function(d) {
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
        CustomerObj.name.extend({
            required: true,
            minLength: 3
        });
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
    
    .f-inp{
        cursor: pointer;
        height: 100%;
        position:absolute;
        top: 0;
        right: 0;
        z-index: 99;
        /*This makes the button huge. If you want a bigger button, increase the font size*/
        font-size:50px;
        /*Opacity settings for all browsers*/
        opacity: 0;
        -moz-opacity: 0;
        filter:progid:DXImageTransform.Microsoft.Alpha(opacity=0)
    }
</style>