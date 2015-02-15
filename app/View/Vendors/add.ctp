<?php echo $this->Form->create('Vendor', array('type' => 'file')); ?>
<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title">Add New Vendor</h3>
    </div>
    <div class="box-body">
        <div class="row">
        <div class="col-md-6">
            <div class="col-md-12">
                <div class="form-group">
                    <?php
                    echo $this->Form->input("name", array(
                        'div' => false,
                        'class' => 'form-control',
                        'placeholder' => ''
                    ));
                    ?>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <?php
                    echo $this->Form->input("photo", array(
                        'div' => false,
                        'class' => 'form-control',
                        'placeholder' => '',
                        'type' => 'file'
                    ));
                    ?>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <?php
                    echo $this->Form->input("company_logo", array(
                        'div' => false,
                        'class' => 'form-control',
                        'placeholder' => '',
                        'type'=>'file'
                    ));
                    ?>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <?php
                    echo $this->Form->input("company_name", array(
                        'div' => false,
                        'class' => 'form-control',
                        'placeholder' => ''
                    ));
                    ?>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <?php
                    echo $this->Form->input("address", array(
                        'div' => false,
                        'class' => 'form-control',
                        'placeholder' => ''
                    ));
                    ?>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <?php
                    echo $this->Form->input("city", array(
                        'div' => false,
                        'class' => 'form-control',
                        'placeholder' => ''
                    ));
                    ?>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <?php
                    echo $this->Form->input("state", array(
                        'div' => false,
                        'class' => 'form-control',
                        'placeholder' => ''
                    ));
                    ?>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <?php
                    echo $this->Form->input("country", array(
                        'div' => false,
                        'class' => 'form-control',
                        'placeholder' => ''
                    ));
                    ?>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <?php
                    echo $this->Form->input("email", array(
                        'div' => false,
                        'class' => 'form-control',
                        'placeholder' => ''
                    ));
                    ?>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <?php
                    echo $this->Form->input("mobile_number", array(
                        'div' => false,
                        'class' => 'form-control',
                        'placeholder' => ''
                    )); 
                    ?>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <?php
                    echo $this->Form->input("phone_number", array(
                        'div' => false,
                        'class' => 'form-control',
                        'placeholder' => ''
                    ));
                    ?>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <?php
                    echo $this->Form->input("lat", array(
                        'div' => false,
                        'class' => 'form-control',
                        'placeholder' => ''
                    ));
                    ?>
                </div>
            </div>


            <div class="col-md-12">
                <div class="form-group">
                    <?php
                    echo $this->Form->input("long", array(
                        'div' => false,
                        'class' => 'form-control',
                        'placeholder' => ''
                    ));
                    ?>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <?php
                    echo $this->Form->input("status", array(
                        'div' => false,
                        'class' => 'form-control',
                        'placeholder' => '',
                        'options' => array(
                            "ACTIVE" => 'ACTIVE',
                            "INACTIVE" => 'INACTIVE',
                        )
                    ));
                    ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <button class="btn btn-primary" data-bind="click:send">Submit</button>
        </div>
    </div>
    </div>
</div>
<?php echo $this->Form->end(); ?>









































<!--<div class="vendors form">
    <?php echo $this->Form->create('Vendor'); ?>
    <fieldset>
        <legend><?php echo __('Add Vendor'); ?></legend>
        <?php
//        echo $this->Form->input('name');
//        echo $this->Form->input('photo');
//        echo $this->Form->input('company_logo');
//        echo $this->Form->input('company_name');
//        echo $this->Form->input('address');
//        echo $this->Form->input('city');
//        echo $this->Form->input('state');
//        echo $this->Form->input('country');
//        echo $this->Form->input('email');
//        echo $this->Form->input('password');
//        echo $this->Form->input('mobile_number');
//        echo $this->Form->input('phone_number');
//        echo $this->Form->input('lat');
//        echo $this->Form->input('long');
//        echo $this->Form->input('status');
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>

        <li><?php // echo $this->Html->link(__('List Vendors'), array('action' => 'index')); ?></li>
        <li><?php //echo $this->Html->link(__('List Combinations'), array('controller' => 'combinations', 'action' => 'index')); ?> </li>
        <li><?php //echo $this->Html->link(__('New Combination'), array('controller' => 'combinations', 'action' => 'add')); ?> </li>
        <li><?php //echo $this->Html->link(__('List Vendor Days'), array('controller' => 'vendor_days', 'action' => 'index')); ?> </li>
        <li><?php //echo $this->Html->link(__('New Vendor Day'), array('controller' => 'vendor_days', 'action' => 'add')); ?> </li>
        <li><?php //echo $this->Html->link(__('List Vendor Documents'), array('controller' => 'vendor_documents', 'action' => 'index')); ?> </li>
        <li><?php //echo $this->Html->link(__('New Vendor Document'), array('controller' => 'vendor_documents', 'action' => 'add')); ?> </li>
        <li><?php //echo $this->Html->link(__('List Vendor Reviews'), array('controller' => 'vendor_reviews', 'action' => 'index')); ?> </li>
        <li><?php //echo $this->Html->link(__('New Vendor Review'), array('controller' => 'vendor_reviews', 'action' => 'add')); ?> </li>
    </ul>
</div>-->
