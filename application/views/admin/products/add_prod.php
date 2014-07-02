
<!--<link rel="stylesheet" href="http://themepixels.com/demo/webpage/bracket/js/toggles.min.js" />   -->
<link rel="stylesheet" href="css/uploadify.css" />   
<link rel="stylesheet" href="css/jquery.tagsinput.css" />   
<div class="pageheader">
    <h2><i class="fa fa-pencil"></i> Products <span>Add Product</span></h2>
    <div class="breadcrumb-wrapper">
        <span class="label">You are here:</span>
        <ol class="breadcrumb">
            <li><a href="index.html">Home</a></li>  
            <li><a href="general-forms.html">Products</a></li>
            <li class="active">Add Product</li>
        </ol>
    </div>
</div>

<div class="contentpanel">

    <div class="row" id="prod_data_det">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">Adding New product</h4>
                    <p>Write a name and description, and provide a type and vendor to categorize this product.</p>
                </div>
                <div class="panel-body panel-body-nopadding">

                    <div id="progressWizard" class="basic-wizard">

                        <?php echo form_open('admin/products/add', array('id' => 'addProdForm', 'role' => 'form', 'autocomplete' => 'off')); ?>
                        <ul class="nav nav-pills nav-justified">
                            <li><a href="#ptab1" data-toggle="tab"><span>Step 1:</span> Product Details</a></li>
                            <li><a href="#ptab2" data-toggle="tab"><span>Step 2:</span> Components</a></li>
                            <li><a href="#ptab3" data-toggle="tab"><span>Step 3:</span> Pricing</a></li>

                        </ul>

                        <div class="tab-content">



                            <div class="progress progress-striped active">
                                <div class="progress-bar" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>

                            <div class="tab-pane" id="ptab1">
                                <div class="form-group">
                                    <label class="col-sm-4">Category <em>*</em></label>
                                    <div class="col-sm-3">
                                        <select class="form-control required" name="category">
                                            <?php echo $category_opt; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4">Product Type <span>*</span></label>
                                    <div class="col-sm-3">
                                        <select class="form-control required" name="prod_type">
                                            <?php echo $prod_type_opt; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-4">Product Name <span>*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control required" name="prod_name" placeholder="Product Name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4">Product Short Description</label>
                                    <div class="col-sm-8">
                                        <textarea class="form-control" name="prod_short_desc"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4">Product Long Description <span>*</span></label>
                                    <div class="col-sm-8">
                                        <textarea class="form-control required" name="prod_desc"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4">Product Tags <br><span class="sub_desc">Add tag name and press enter</span></label>
                                    <div class="col-sm-8">
                                        <input name="prod_tags" id="tags" class="form-control" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4">Product Size</label>
                                    <div class="col-sm-2">
                                        <input name="prod_size" class="form-control" placeholder="Ex: 22 x 12"/>
                                    </div>
                                </div>

                                <h4 class="panel-title m_10 mb20" style="border-bottom: 1px dashed #e5e5e5;">Other Details</h4>
                                <div class="form-group">
                                    <label class="col-sm-4">Certificate</label>
                                    <div class="col-sm-2">
                                        <select class="form-control" name="prod_cert">
                                            <option value=""></option>
                                            <option value="igi">IGI</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-4">Hallmark</label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" name="prod_hallmark" placeholder="Ex: 0.75"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-4">Stock</label>
                                    <div class="col-sm-2">
                                        <select class="form-control" name="prod_stock">
                                            <option value=""></option>
                                            <option value="Ready">Ready</option>
                                            <option value="On Request">On Request</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-4">30 days refund</label>
                                    <div class="col-sm-2">
                                        <div class="toggle toggle-success" id="days_ret_30_t"></div>
                                        <input type="checkbox" id="days_ret_30" name="days_ret_30" style="visibility: hidden" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4">100% Return</label>
                                    <div class="col-sm-2">
                                        <div class="toggle toggle-success" id="ret_100_t"></div>
                                        <input type="checkbox" id="ret_100" name="ret_100" style="visibility: hidden" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4">Free Shipping</label>
                                    <div class="col-sm-2">
                                        <div class="toggle toggle-success" id="free_ship_t"></div>
                                        <input type="checkbox" id="free_ship" name="free_ship" style="visibility: hidden" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4">Life Time Return</label>
                                    <div class="col-sm-2">
                                        <div class="toggle toggle-success" id="life_time_ret_t"></div>
                                        <input type="checkbox" id="life_time_ret" name="life_time_ret" style="visibility: hidden" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4">Free Return</label>
                                    <div class="col-sm-2">
                                        <div class="toggle toggle-success" id="free_ret_t"></div>
                                        <input type="checkbox" id="free_ret" name="free_ret" style="visibility: hidden" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4">Payment</label>
                                    <div class="col-sm-2">
                                        <div class="toggle toggle-success" id="payment_t"></div>
                                        <input type="checkbox" id="payment" name="payment" style="visibility: hidden" />
                                    </div>
                                </div>

                            </div>
                            <div class="tab-pane" id="ptab2">



                                <div class="form-group">
                                    <label class="col-sm-4">Component</label>
                                    <div class="col-sm-3">
                                        <select class="form-control required" id="comp_type" name="comp_type">
                                            <option value=""></option>
                                            <?php
                                            foreach ($component as $comp_type) {
                                                echo '<option data-type="' . $comp_type->COMP_CODE . '" value="' . $comp_type->COMP_ID . '">' . $comp_type->COMP_NAME . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>



                                <div id="metal_fields" class="mb10 form_fields" style="display: none;">

                                    <div class="form-group">
                                        <label class="col-sm-4">Metal Type</label>
                                        <div class="col-sm-3">
                                            <select class="form-control required" name="metal_type">
                                                <option value=""></option>
                                                <?php
                                                $sub_comp_arr = $sub_com_data['component_type'];
                                                foreach ($sub_comp_arr as $sub_comp) {
                                                    if ($sub_comp->COMP_ID == 1) {
                                                        echo '<option value="' . $sub_comp->COMP_TYPE_ID . '">' . $sub_comp->COMP_TYPE_NAME . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-4">Gross Weight</label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" name="metal_gross_weight" placeholder="Gross Weight">
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4">Caret</label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" name="meta_caret" placeholder="Caret">
                                        </div>
                                    </div>
                                </div>

                                <div id="stone_fields" class="form_fields" style="display: none;">
                                    <div class="form-group">
                                        <label class="col-sm-4">Cut</label>
                                        <div class="col-sm-3">
                                            <select class="form-control required" name="stone_cut">
                                                <option value=""></option>
                                                <?php
                                                $stone_cut_arr = $sub_com_data['stone_cut'];
                                                foreach ($stone_cut_arr as $stone_cut) {
                                                    echo '<option value="' . $stone_cut->CUT_ID . '">' . $stone_cut->CUT_NAME . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4">Number of Stones</label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" name="stone_total_stones" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-4">Color</label>
                                        <div class="col-sm-2">
                                            <select class="form-control required" name="stone_color_from">
                                                <option value=""></option>
                                                <?php
                                                $stone_color_arr = $sub_com_data['stone_color'];
                                                foreach ($stone_color_arr as $stone_color) {
                                                    echo '<option value="' . $stone_color->COLOR_ID . '">' . $stone_color->COLOR_NAME . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-2">
                                            <select class="form-control required" name="stone_color_to">
                                                <option value=""></option>
                                                <?php
                                                foreach ($stone_color_arr as $stone_color) {
                                                    echo '<option value="' . $stone_color->COLOR_ID . '">' . $stone_color->COLOR_NAME . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-4">Clarity</label>
                                        <div class="col-sm-2">
                                            <select class="form-control required" name="stone_clarity_from">
                                                <option value=""></option>
                                                <?php
                                                $stone_clarity_arr = $sub_com_data['stone_clarity'];
                                                foreach ($stone_clarity_arr as $stone_clarity) {
                                                    echo '<option value="' . $stone_clarity->CLARITY_ID . '">' . $stone_clarity->CLARITY_NAME . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-2">
                                            <select class="form-control required" name="stone_clarity_to">
                                                <option value=""></option>
                                                <?php
                                                foreach ($stone_clarity_arr as $stone_clarity) {
                                                    echo '<option value="' . $stone_clarity->CLARITY_ID . '">' . $stone_clarity->CLARITY_NAME . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-4">Shape</label>
                                        <div class="col-sm-3">
                                            <select class="form-control required" name="stone_shape">
                                                <option value=""></option>
                                                <?php
                                                $stone_shape_arr = $sub_com_data['stone_shape'];
                                                foreach ($stone_shape_arr as $stone_shape) {
                                                    echo '<option value="' . $stone_shape->SHAPE_ID . '">' . $stone_shape->SHAPE_NAME . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-4">Gross Weight</label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" name="stone_gross_weight" placeholder="Gross Weight" />
                                        </div>
                                    </div>
                                </div>

                                <div id="colored_stone_fields" class="form_fields" style="display: none;">
                                    <div class="form-group">
                                        <label class="col-sm-4">Stone Color Type</label>
                                        <div class="col-sm-3">
                                            <select class="form-control required" name="colored_stone_type">
                                                <option value=""></option>
                                                <?php
                                                foreach ($sub_comp_arr as $sub_comp) {
                                                    if ($sub_comp->COMP_ID == 3) {
                                                        echo '<option value="' . $sub_comp->COMP_TYPE_ID . '">' . $sub_comp->COMP_TYPE_NAME . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4">Stone Color Category</label>
                                        <div class="col-sm-3">
                                            <select class="form-control required" name="colored_stone_cat">
                                                <option value=""></option>
                                                <?php
                                                $c_stone_cat_arr = $sub_com_data['c_stone_category'];
                                                foreach ($c_stone_cat_arr as $c_stone_cat) {
                                                    echo '<option value="' . $c_stone_cat->C_STONE_CAT_ID . '">' . $c_stone_cat->C_STONE_CAT_NAME . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-4">Stone Color</label>
                                        <div class="col-sm-3">
                                            <select class="form-control required" name="colored_stone_color">
                                                <option value=""></option>
                                                <?php
                                                $c_stone_color_arr = $sub_com_data['c_stone_color'];
                                                foreach ($c_stone_color_arr as $c_stone_color) {
                                                    echo '<option value="' . $c_stone_color->C_STONE_COL_ID . '">' . $c_stone_color->C_STONE_COL_NAME . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-4">Number of Stones</label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" name="colored_stone_total_stones" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-4">Gross Weight</label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" name="colored_stone_gross_weight" />
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group mt10">
                                    <div class="t_c">
                                        <button class="btn btn-danger hide" type="button" id="add_btn">Add</button>
                                    </div>
                                </div>

                                <div id="ajax_loader" class="t_c" style="display: none">
                                    <div style="font-size: 20px;"><i class="fa fa-spinner fa-spin"></i></div>
                                </div>

                                <div class="table-responsive hide" id="component_grid">
                                    <table class="table table-success mb30">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Component</th>
                                                <th>Sub Component</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                    <input type="hidden" name="comp_count" id="comp_count" value="0" />
                                </div>

                            </div>

                            <div class="tab-pane" id="ptab3">

                                <div class="form-group">
                                    <label class="col-sm-4">Price Type <span>*</span></label>
                                    <div class="col-sm-5">
                                        <select class="form-control required" name="price_type">
                                            <?php echo $price_type_opt; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group" id="basic_price_div" style="display: none;">
                                    <label class="col-sm-4">Price</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control numbers-only" data-decimal='true' name="prod_price" placeholder="Product Price" onkeypress="return numbersonly(this, true);"/>
                                    </div>

                                    <div class="col-sm-4">
                                        <input type="text" class="form-control numbers-only" data-decimal='true' style="display: none;" name="prod_dis" placeholder="Discount" onkeypress="return numbersonly(this, true);"/>
                                    </div>

                                </div>

                                <div class="table-responsive hide" id="component_price_grid">
                                    <table class="table table-success mb30">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Component</th>
                                                <th>Sub Component</th>
                                                <th>Cost in gms / Caret</th>
                                                <th>Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>


                            </div>




                        </div><!-- tab-content -->

                        <ul class="pager wizard">
                            <li class="previous"><a href="javascript:void(0)">Previous</a></li>
                            <li class="next"><a href="javascript:void(0)">Next</a></li>
                            <li class="finish" style="display:none; float:right;"><button type="submit" class="btn btn-danger ladda-button" id="add_prod_submit" data-style="expand-left"><span class="ladda-label">Next</span></button></li>
                        </ul>
                        </form>

                    </div><!-- #basicWizard -->

                </div><!-- panel-body -->
            </div><!-- panel -->
        </div><!-- col-md-6 -->

    </div><!-- row -->


    <div class="panel panel-default" id="image_upload_det" style="display: none;">
        <div class="panel-heading">

            <h4 class="panel-title">Images Upload</h4>
            <p>Upload and edit images of this product. <span data-hideif="imageUploadInProgress">You can also <a class="plain st" data-modal="products/fetch_product_images_modal" data-modal-view="FetchProductImagesModalView" href="#">add images from the web</a>.</span> Drag to reorder images.</p>
        </div>
        <div class="panel-body">
            <div class="col-sm-5">
                <div class="span6 section-summary">
                    <div>
                        <h1>Images</h1>
                        <p>Upload and edit images of this product. <span data-hideif="imageUploadInProgress">You can also <a class="plain st" data-modal="products/fetch_product_images_modal" data-modal-view="FetchProductImagesModalView" href="#">add images from the web</a>.</span> Drag to reorder images.</p>
                    </div>
                    <div id="queue"></div>
                    <input id="file_upload" name="file_upload" type="file" multiple="true">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="span6 section-summary" style="margin-top:20px;">
                    <div class="row" id="image_view"></div> 
                </div>
            </div>
        </div><!-- panel-body -->
        <div class="panel-footer">
            <button class="btn btn-primary" style="float:right;" onclick="window.location.href = 'admin/products/'">Finish</button>
        </div><!-- panel-footer -->
    </div><!-- panel -->



</div><!-- contentpanel -->

</div><!-- mainpanel -->



</section>


<script src="js/jquery.tagsinput.min.js"></script>
<script src="js/jquery.uploadify.js"></script>

<script>
                jQuery(document).ready(function() {

                    jQuery('#tags').tagsInput({width: 'auto'});
                    $('#progressWizard').bootstrapWizard({
                        tabClass: 'nav nav-pills nav-justified nav-disabled-click',
                        'nextSelector': '.next',
                        'previousSelector': '.previous',
                        onNext: function(tab, navigation, index) {
                            var $total = navigation.find('li').length;
                            var $current = index + 1;
                            var $percent = ($current / $total) * 100;
                            if ($current >= $total) {
                                $('#progressWizard').find('.pager .next').hide();
                                $('#progressWizard').find('.pager .finish').show();
                            } else {
                                $('#progressWizard').find('.pager .next').show();
                                $('#progressWizard').find('.pager .finish').hide();
                            }

//                var $validator = jQuery("#form-" + index).validate({
//                    highlight: function(element) {
//                        jQuery(element).closest('.form-group').removeClass('has-success').addClass('has-error');
//                    },
//                    success: function(element) {
//                        jQuery(element).closest('.form-group').removeClass('has-error');
//                    }
//                });
//                var $valid = jQuery('#form-' + index).valid();
//                if (!$valid) {
//                    $validator.focusInvalid();
//                    return false;
//                }
                            $('html,body').animate({scrollTop: $('#prod_data_det').offset().top}, 800);
                            jQuery('#progressWizard').find('.progress-bar').css('width', $percent + '%');
                        },
                        onPrevious: function(tab, navigation, index) {
                            var $total = navigation.find('li').length;
                            var $current = index + 1;
                            var $percent = ($current / $total) * 100;
                            if ($current < $total) {
                                $('#progressWizard').find('.pager .next').show();
                                $('#progressWizard').find('.pager .finish').hide();
                            } else {
                                $('#progressWizard').find('.pager .next').hide();
                                $('#progressWizard').find('.pager .finish').show();
                            }
                            $('html,body').animate({scrollTop: $('#prod_data_det').offset().top}, 800);
                            jQuery('#progressWizard').find('.progress-bar').css('width', $percent + '%');
                        },
                        onTabShow: function(tab, navigation, index) {
                            var $total = navigation.find('li').length;
                            var $current = index + 1;
                            var $percent = ($current / $total) * 100;
                            jQuery('#progressWizard').find('.progress-bar').css('width', $percent + '%');
                        },
                        onTabClick: function(tab, navigation, index) {
                            //return false;
                        }
                    });

                    $('[name="price_type"]').on('change', function() {
                        show_price();
                    });

                    $('#add_prod_submit').on('click', function(e) {
                        e.preventDefault();
                        ajaxSubmitForm('#addProdForm', 'add_prod', false);
                    });

                    $('[name="comp_type"]').on('change', function() {
                        comp_type_change(this);
                    });

                    $('#add_btn').on('click', function() {
                        add_component();
                    });

                    // Delete row in a table
                    jQuery('.delete-row').click(function() {
                        var c = confirm("Continue delete?");
                        if (c)
                            jQuery(this).closest('tr').fadeOut(function() {
                                jQuery(this).remove();
                            });
                        return false;
                    });

                    toggle_add();
                });

                



</script>


<script type="text/javascript">
<?php
$timestamp = time();
$path = 'uploads/' . $ses_det['user_id'] . '/';
?>
    $(function() {
        $('#file_upload').uploadify({
            formData: {
                'timestamp': '<?php echo $timestamp; ?>',
                'token': '<?php echo md5('unique_salt' . $timestamp); ?>',
                'path': '<?php echo $path; ?>',
                'change_name': '1',
                'thumb': '1'
            },
            'fileTypeDesc': 'Image Files',
            'fileTypeExts': '*.jpg',
            swf: 'images/uploadify.swf',
            uploader: '<?php echo base_url(); ?>admin/upload/img',
            onUploadSuccess: function(file, data, response) {
                if (response) {
                    var str = '<div class="col-xs-6 col-md-3">\n\
                                <a href="#" class="thumbnail">\n\
                                    <img src="' + data + '" style="width:160px;">\n\
                                </a>\n\
                            </div>';
                    $("#image_view").append(str);
                }
            }
        });
    });
</script>
</body>
</html>
