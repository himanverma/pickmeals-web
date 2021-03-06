<?php echo $this->Form->create('Recipe', array('type' => 'file')); ?>
<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title">Add New Recipe</h3>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <?php
                    echo $this->Form->input("recipe_name", array(
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
                    echo $this->Form->input("image", array(
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
                    echo $this->Form->input("is_thali", array(
                        'div' => false,
                        'class' => 'form-control',
                        'placeholder' => ''
                    ));
                    ?>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label>Select Category</label>
                    <span><select name="data[Recipe][category_id]">
                            <option value=""><?php echo __("Select"); ?></option>
                            <?php foreach ($recipes as $recipe) { ?>
                                <option value="<?php echo $recipe['Category']['id']; ?>">
                                    <?php echo $recipe['Category']['name']; ?></option>
                            <?php } ?>
                        </select>
                    </span>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <?php
                    echo $this->Form->input("description", array(
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
                    echo $this->Form->input("also_known_as", array(
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
<?php echo $this->Form->end(); ?>