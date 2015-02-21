<?php echo $this->element('admin_header'); ?>
<div class="wrapper row-offcanvas row-offcanvas-left">
    <?php echo $this->element('admin_side'); ?>
    <aside class="right-side">
        <section class="content-header">
            <h1>
                Categories
                <small>it all starts here</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo $this->Html->url('/admin/categories'); ?>"><i class="fa fa-dashboard"></i> Categories</a></li>
            </ol>
            <div class="categories form">
                <?php echo $this->Form->create('Category', array('type' => 'file')); ?>
                <fieldset>
                    <?php
                    echo $this->Form->input('parent_id', array(
                        'options' => $parentCategories
                    ));
                    echo $this->Form->input('Category.name.eng',array(
                                'label'=>"Name(English)"
                            ));
                    echo $this->Form->input('Category.name.spa',array(
                                'label'=>"Name(Spanish)"
                            ));
                    echo $this->Form->input('Category.name.por',array(
                                'label'=>"Name(Portugues)"
                            ));
                    echo $this->Form->input('img', array('type' => 'file'));
                    echo $this->Form->input('link', array('type' => 'url'));
                    ?>
                    <button type="button" id="grabMeta">Grab Meta</button>
                    <?php
                    echo $this->Form->input('Category.meta_title.eng',array(
                                'label'=>"Meta Title(English)"
                            ));
                    echo $this->Form->input('Category.meta_title.spa',array(
                                'label'=>"Meta Title(Spanish)"
                            ));
                    echo $this->Form->input('Category.meta_title.por',array(
                                'label'=>"Meta Title(Portugues)"
                            ));
                    
                    echo $this->Form->input('Category.meta_keyword.eng',array(
                                'label'=>"Meta Keyword(English)"
                            ));
                    echo $this->Form->input('Category.meta_keyword.spa',array(
                                'label'=>"Meta Keyword(Spanish)"
                            ));
                    echo $this->Form->input('Category.meta_keyword.por',array(
                                'label'=>"Meta Keyword(Portugues)"
                            ));
                    
                    echo $this->Form->input('Category.meta_description.eng',array(
                                'label'=>"Description(English)"
                            ));
                    echo $this->Form->input('Category.meta_description.spa',array(
                                'label'=>"Description(Spanish)"
                            ));
                    echo $this->Form->input('Category.meta_description.por',array(
                                'label'=>"Description(Portugues)"
                            ));
                    
                    echo $this->Form->input('Category.address.eng',array(
                                'label'=>"Address(English)"
                            ));
                    echo $this->Form->input('Category.address.spa',array(
                                'label'=>"Address(Spanish)"
                            ));
                    echo $this->Form->input('Category.address.por',array(
                                'label'=>"Address(Portugues)"
                            ));
                    
                    echo $this->Form->input('google_map');
                    echo '<div class="select role required"><lable for="UserViewWebsite">View Website &nbsp</lable>';
                    echo $this->Form->select('view_website', array('1' => 'Active', '0' => 'Deactive'));
                    echo "</div>";
                    echo '<div class="select role required"><lable for="UserStatus">Status &nbsp</lable>';
                    echo $this->Form->select('status', array('1' => 'Active', '0' => 'Deactive'));
                    echo "</div>";
                    ?>
                </fieldset>
                <?php echo $this->Form->end(__('Submit')); ?>
            </div>
            <script type="text/javascript">
                $('#grabMeta').on("click", function() {
                    var meta = {keywords: "", desc: ""};
                    $.post("http://uneekarts.com/mobile/andrea/Categories/grabUrl", {'data[url]': $('#CategoryLink').val()}, function(d) {
                        var x = $(d).filter('meta');
                        var ti = $(d).filter('title');
                        x.each(function() {
                            if ($(this).attr('name') == "keywords")
                                meta.keywords = $(this).attr('content');
                            if ($(this).attr('name') == "description")
                                meta.desc = $(this).attr('content');
                            if ($(this).attr('name') == "title")
                                meta.title = $(this).attr('content');
                        });
                        console.log(meta);
                        $('#CategoryMetaKeyword').val(meta.keywords);
                        $('#CategoryMetaDescription').val(meta.desc);
                        $('#CategoryMetaTitle').val(ti.html());
                    });

                });
            </script>
    </aside>
</div>