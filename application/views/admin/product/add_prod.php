<style type="text/css">
    .table {
        font-size: 11px;
        box-shadow:none;
        margin-bottom: 0;
    }

    .header_btn {
        padding: 0 10px;
        line-height: 19px;
    }

</style>

<link rel="stylesheet" href="css/jquery.tagsinput.css" />   

<script src="js/jquery.form.js"></script>

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

        <div class="col-md-12" id="prod_summary">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-btns">
                        <a href="" class="minimize">−</a>
                    </div>
                    <h4 class="panel-title">Product Details</h4>
                    <p>Basic product details</p>
                </div>
                <div class="panel-body" style="display: block;">

                    <form id="prod_summary_form" onsubmit="return false;" autocomplete="off">
                        <div class="row mb5">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-sm-6">Jewellery Type <em>*</em></label>
                                    <div class="col-sm-5">
                                        <select class="form-control required" name="jewel_type" id="jewel_type">
                                            <?php echo $field_opt['jewel_type_opt']; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-sm-5">Category <em>*</em></label>
                                    <div class="col-sm-5">
                                        <select class="form-control required" name="category">
                                            <?php echo $field_opt['category_opt']; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-sm-4">Product Type <em>*</em></label>
                                    <div class="col-sm-6">
                                        <select class="form-control required" name="prod_type">
                                            <?php echo $field_opt['prod_type_opt']; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <p class="alert header alert-success">Product Information
                            <a class="slide_form" data-type="prod_info" style="display: inline-block; float: right;padding-right:5px; padding-top: 3px;"><i class="fa fa-minus-square-o"></i></a>
                        </p>
                        <div id="prod_info_fields">
                            <div class="row mb5">
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label class="col-sm-6">Design No</label>
                                        <div class="col-sm-5">
                                            <input type="text" name="design_no" class="form-control required" maxlength="20"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-sm-5">Product Name</label>
                                        <div class="col-sm-5">
                                            <input type="text" name="prod_name" class="form-control required" maxlength="50"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-sm-4">Style No</label>
                                        <div class="col-sm-6">
                                            <input type="text" name="style_no" class="form-control" maxlength="20"/>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb5">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-sm-6">Collection Name</label>
                                        <div class="col-sm-5">
                                            <?php
                                            $coll_names = $fields_data['collection_names'];
                                            showDropDown($coll_names, 'CN_ID', 'CN_NAME', 'col_name');
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-sm-5">Bar Code</label>
                                        <div class="col-sm-5">
                                            <input type="text" name="bar_code" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-sm-4">Brand</label>
                                        <div class="col-sm-6">
                                            <?php
                                            $brands = $fields_data['brands'];
                                            showDropDown($brands, 'B_ID', 'B_NAME', 'brand');
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb5">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-sm-6">SKU No</label>
                                        <div class="col-sm-5">
                                            <input type="text" name="sku_no" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-sm-5">Designer</label>
                                        <div class="col-sm-5">
                                            <?php
                                            $designer = $fields_data['designer'];
                                            showDropDown($designer, 'D_ID', 'D_NAME', 'designer');
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-sm-4">Dimensions</label>
                                        <div class="col-sm-2 r_pad_0">
                                            <select name="dim_type" class="form-control" style="padding:4px 5px;">
                                                <option value=""></option>
                                                <option value="cm">cm</option>
                                                <option value="mm">mm</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-2 r_pad_0" style="width: 56px;">
                                            <input type="text" name="dim_from" class="form-control numbers-only" data-decimal="true"/>
                                        </div>
                                        <div class="col-sm-1" style="width: 18px; padding: 3px 5px;">x</div>        
                                        <div class="col-sm-2 l_pad_0" style="padding-left: 4px;width: 56px;">
                                            <input type="text" name="dim_to" class="form-control numbers-only" data-decimal="true"/>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb5">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-sm-6">Size</label>
                                        <div class="col-sm-5">
                                            <input type="text" name="size" class="form-control" />
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label class="col-sm-2">Short Description</label>
                                        <div class="col-sm-10" style="padding-left:40px;">
                                            <input type="text" name="prod_short_desc" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2">Long Description</label>
                                <div class="col-sm-10 p_l_4">
                                    <textarea class="form-control" name="prod_long_desc"></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2">Product Tags <br><span class="sub_desc">Add Multiple tags</span></label>
                                <div class="col-sm-10 p_l_4">
                                    <input name="prod_tags" id="tags" class="form-control" />
                                </div>
                            </div>
                        </div>

                        <p class="header alert alert-info">Other Features
                            <a class="slide_form" data-type="other_feat" style="display: inline-block; float: right;padding-right:5px; padding-top: 3px;"><i class="fa fa-minus-square-o"></i></a>
                        </p>
                        <div id="other_feat_fields">
                            <div class="row mb5">
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label class="col-sm-6">Certification</label>
                                        <div class="col-sm-5">
                                            <select class="form-control" name="prod_cert">
                                                <?php echo $field_opt['cert_opt']; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-sm-5">Delivery Location</label>
                                        <div class="col-sm-5">
                                            <input type="text" name="del_loc" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-sm-4">Hall Mark</label>
                                        <div class="col-sm-5">
                                            <select class="form-control" name="hallmark">
                                                <?php echo $field_opt['hallmark_opt']; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb5">
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label class="col-sm-6">Silver CZ Sample</label>
                                        <div class="col-sm-5">
                                            <select name="silver_cs" class="form-control">
                                                <option value=""></option>
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-sm-5">Stock</label>
                                        <div class="col-sm-5">
                                            <select class="form-control" name="prod_stock">
                                                <option value=""></option>
                                                <option value="Ready">Ready</option>
                                                <option value="On Request">On Request</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-sm-4">Try @ Home</label>
                                        <div class="col-sm-5">
                                            <select name="try_home" class="form-control">
                                                <option value=""></option>
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb5">
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label class="col-sm-6">Assaying and Hallmarking Center</label>
                                        <div class="col-sm-5">
                                            <select name="hall_center" class="form-control">
                                                <?php echo $field_opt['hallmark_center_opt']; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-sm-5">Jewellers ID Mark</label>
                                        <div class="col-sm-5">
                                            <input type="text" name="jewel_idmark" class="form-control"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-sm-4">30 Day Refund</label>
                                        <div class="col-sm-5">
                                            <select name="30_day_ref" class="form-control">
                                                <option value=""></option>
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb5">
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label class="col-sm-6">Life Time Exchange</label>
                                        <div class="col-sm-5">
                                            <select name="life_time_exchan" class="form-control">
                                                <option value=""></option>
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-sm-5">100% Refund</label>
                                        <div class="col-sm-5">
                                            <select name="100_refund" class="form-control">
                                                <option value=""></option>
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-sm-4">Free Returns</label>
                                        <div class="col-sm-5">
                                            <select name="free_ret" class="form-control">
                                                <option value=""></option>
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb5">
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label class="col-sm-6">Free shipping</label>
                                        <div class="col-sm-5">
                                            <select name="free_ship" class="form-control">
                                                <option value=""></option>
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-sm-5">Payment Options</label>
                                        <div class="col-sm-5">
                                            <select name="" class="form-control">
                                                <option value=""></option>
                                                <option value="">COD</option>
                                                <option value="">All Credit and Debit Cards</option>
                                                <option value="">Net Banking ( All Major Banks)</option>
                                                <option value="">Cheque Demand Draft, NEFT</option>
                                            </select>  
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-sm-4">Delivery</label>
                                        <div class="col-sm-5">
                                            <select name="del_days" class="form-control">
                                                <option value=""></option>
                                                <option value="Ready">Ready</option>
                                                <option value="7 days">7 days</option>
                                                <option value="10 days">10 days</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <p class="header alert alert-warning">Price</p>
                            <div class="row mb5">
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label class="col-sm-6">Price Type</label>
                                        <div class="col-sm-5">
                                            <select class="form-control required" name="price_type">
                                                <?php echo $field_opt['price_type_opt']; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 hide" id="price_field">
                                    <div class="form-group">
                                        <label class="col-sm-5">Price</label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control numbers-only" data-decimal='true' name="prod_price" placeholder="Product Price"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 hide" id="discount_field">
                                    <div class="form-group">
                                        <label class="col-sm-4">Discount</label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control numbers-only" data-decimal='true' name="prod_dis" placeholder="Discount"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>



                    <div id="metal_grid">
                        <p class="header alert alert-danger">Metal Details
                            <a class="slide_form" data-type="metal" style="display: inline-block; float: right;padding-right:5px; padding-top: 3px;"><i class="fa fa-minus-square-o"></i></a>
                        </p>
                        <div id="metal_fields" class="metal_fields">
                            <form id="metal_form_fields">
                                <div class="row mb5">
                                    <div class="col-xs-2">
                                        <div class="form-group">
                                            <label class="col-sm-4">Primary?</label>
                                            <div class="col-sm-8">
                                                <select class="form-control required" name="metal_prim">
                                                    <option value=""></option>
                                                    <option value="1">Primary</option>
                                                    <option value="0">Secondary</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label class="col-sm-4">Type</label>
                                            <div class="col-sm-6">
                                                <select class="form-control required" name="metal_type" id="metal_type">
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label class="col-sm-5">Gross Wgt</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control numbers-only required" data-decimal="true" name="metal_gross_weight">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label class="col-sm-3">Quality</label>
                                            <div class="col-sm-4">
                                                <select name="metal_quality_type" class="form-control required">
                                                    <option value=""></option>
                                                    <option value="1">Karat</option>
                                                    <option value="2">Purity</option>
                                                </select>
                                            </div>

                                            <div class="col-sm-4">
                                                <select name="metal_quality_type_1" class="form-control" style="display: none;">
                                                    <?php
                                                    echo '<option value=""></option>';
                                                    foreach ($sub_com_data['metal_quality'] as $metal_qual) {
                                                        echo '<option value="' . $metal_qual->MQ_ID . '">' . $metal_qual->MQ_KARAT . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                                <select name="metal_quality_type_2" class="form-control" style="display: none;">
                                                    <?php
                                                    echo '<option value=""></option>';
                                                    foreach ($sub_com_data['metal_quality'] as $metal_qual) {
                                                        echo '<option value="' . $metal_qual->MQ_ID . '">' . $metal_qual->MQ_PURITY . '</option>';
                                                    }
                                                    ?>
                                                </select>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label class="col-sm-5">Color</label>
                                            <div class="col-sm-6">
                                                <select name="metal_color" class="form-control">
                                                    <option value=""></option>
                                                    <option value="Yellow">Yellow</option>
                                                    <option value="White">White</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-2 comp_price hide">
                                        <div class="form-group">
                                            <label class="col-sm-4">Price</label>
                                            <div class="col-sm-8">
                                                <select name="metal_price_type" class="form-control">
                                                    <option value=""></option>
                                                    <option value="1">Base Rate</option>
                                                    <option value="2">Component</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div style="padding-left:10px;">
                                    <div class="form-group">
                                        <button class="btn btn-success btn-xs header_btn" type="button" id="metal_add_btn">Add</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <form id="metal_grid_fields">
                            <table class="table table-bordered hide mt10" id="metal_grid_table">
                                <thead>
                                    <tr>
                                        <th>Primary?</th>
                                        <th>Type</th>
                                        <th>Wt<br>gms</th>
                                        <th>Kt</th>
                                        <th>Color</th>
                                        <th style="width:8%" class="comp_price hide" id="metal_factory">F</th>
                                        <th style="width:8%" class="comp_price hide">Metal Rate<br>Rs/gm</th>
                                        <th style="width:10%" class="comp_price hide">Metal Cost<br>Rs</th>
                                        <th style="width:4%"></th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                                <tfoot class="comp_price hide" style="background: #F0F0F0">
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td id="metal_total_wt">0</td>
                                        <td></td>
                                        <td colspan="2" class="comp_price hide t_right t_red">Total (1): </td>
                                        <td class="t_right comp_price hide" id="metal_total_rate">0</td>
                                        <td class="t_right comp_price hide prod_td_price" id="metal_total_cost">0</td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </form>
                    </div>


                    <div id="stone_grid">
                        <p class="header alert alert-success">Stone Details
                            <a class="slide_form" data-type="stone" style="display: inline-block; float: right;padding-right:5px; padding-top: 3px;"><i class="fa fa-minus-square-o"></i></a>
                        </p>
                        <div id="stone_fields" class="stone_fields">
                            <form id="stone_form_fields">
                                <div class="row mb5">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label class="col-sm-3">Location</label>
                                            <div class="col-sm-4">
                                                <select class="form-control required" name="stone_placement">
                                                    <option value=""></option>
                                                    <?php
                                                    $stone_placement_arr = $sub_com_data['stone_placement'];
                                                    foreach ($stone_placement_arr as $stone_placement) {
                                                        echo '<option value="' . $stone_placement->PLAC_ID . '">' . $stone_placement->PLAC_NAME . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label class="col-sm-3">Type</label>
                                            <div class="col-sm-4">
                                                <select class="form-control required" name="stone_type">
                                                    <option value=""></option>
                                                    <?php
                                                    foreach ($sub_comp_arr as $sub_comp) {
                                                        if ($sub_comp->COMP_ID == 2) {
                                                            echo '<option value="' . $sub_comp->COMP_TYPE_ID . '">' . $sub_comp->COMP_TYPE_NAME . '</option>';
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label class="col-sm-3">Shape</label>
                                            <div class="col-sm-4">
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
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label class="col-sm-3">Color</label>
                                            <div class="col-sm-4">
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

                                            <div class="col-sm-4">
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
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label class="col-sm-3">Clarity</label>
                                            <div class="col-sm-4">
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

                                            <div class="col-sm-4">
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
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label class="col-sm-3">Cut</label>
                                            <div class="col-sm-4">
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
                                    </div>

                                    <div class="col-sm-3" id="stone_size_type" style="display: none;">
                                        <div class="form-group">
                                            <label class="col-sm-3">Size Type</label>
                                            <div class="col-sm-4">
                                                <select class="form-control" name="stone_size_type">
                                                    <option value=""></option>
                                                    <?php
                                                    $stone_size_arr = $sub_com_data['stone_size'];
                                                    foreach ($stone_size_arr as $stone_size) {
                                                        echo '<option value="' . $stone_size->SIZE_ID . '">' . $stone_size->SIZE_NAME . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-3" style="display: none;" id="stone_1_size">
                                        <div class="form-group">
                                            <label class="col-sm-3">SEIV Size</label>
                                            <div class="col-sm-4">
                                                <select class="form-control" name="stone_seiv_size_from">
                                                    <option value=""></option>
                                                    <?php
                                                    $stone_seiv_size_from_arr = $sub_com_data['stone_seiv_size_from'];
                                                    foreach ($stone_seiv_size_from_arr as $stone_seiv_size_from) {
                                                        echo '<option value="' . $stone_seiv_size_from->SEIV_SIZE_FROM_ID . '">' . $stone_seiv_size_from->SEIV_SIZE_FROM_NAME . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="col-sm-4">
                                                <select class="form-control" name="stone_seiv_size_to">
                                                    <option value=""></option>
                                                    <?php
                                                    $stone_seiv_size_to_arr = $sub_com_data['stone_seiv_size_to'];
                                                    foreach ($stone_seiv_size_to_arr as $stone_seiv_size_to) {
                                                        echo '<option value="' . $stone_seiv_size_to->SEIV_SIZE_TO_ID . '">' . $stone_seiv_size_to->SEIV_SIZE_TO_NAME . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-3" id="stone_2_size" style="display:none;">
                                        <div class="form-group">
                                            <label class="col-sm-3">MM Size</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control numbers-only" data-decimal="true" name="stone_mm_size_from" placeholder="From"/>
                                            </div>

                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" name="stone_mm_size_to" placeholder="To"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label class="col-sm-3">Fluorescence</label>
                                            <div class="col-sm-4">
                                                <select class="form-control required" name="stone_fluorescence">
                                                    <option value=""></option>
                                                    <?php
                                                    $stone_fluorescence_arr = $sub_com_data['stone_fluorescence'];
                                                    foreach ($stone_fluorescence_arr as $stone_fluorescence) {
                                                        echo '<option value="' . $stone_fluorescence->FLU_ID . '">' . $stone_fluorescence->FLU_NAME . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label class="col-sm-3">Gross Wt</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control numbers-only required" data-decimal="true" name="stone_gross_weight" placeholder="Gross Weight" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label class="col-sm-3">Qty/PCS</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control numbers-only required" name="stone_total_stones" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label class="col-sm-3">TOS</label>
                                            <div class="col-sm-4">
                                                <select class="form-control" name="stone_setting">
                                                    <option value=""></option>
                                                    <?php
                                                    $stone_setting_arr = $sub_com_data['stone_setting'];
                                                    foreach ($stone_setting_arr as $stone_setting) {
                                                        echo '<option value="' . $stone_setting->SET_ID . '">' . $stone_setting->SET_NAME . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                                <div style="padding-left: 10px;">
                                    <div class="form-group">
                                        <button class="btn btn-success btn-xs header_btn" type="button" id="stone_add_btn">Add</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <form id="stone_grid_fields">
                            <table class="table table-bordered hide mt10" id="stone_grid_table">
                                <thead>
                                    <tr>
                                        <th>Loc</th>
                                        <th>Type</th>
                                        <th>Shp</th>
                                        <th>Col<br>Fm</th>
                                        <th>Col<br>To</th>
                                        <th>Cla<br>Fm</th>
                                        <th>Cla<br>To</th>
                                        <th>Cut</th>
                                        <th>Size<br>Fm</th>
                                        <th>Size<br>To</th>
                                        <th>Size<br>mm</th>
                                        <th style="width:2%;"><br>x</th>
                                        <th>Size<br>mm</th>
                                        <th>QTY<br>PCS</th>
                                        <th>Wt<br>cts</th>
                                        <th>TOS</th>
                                        <th>Fl</th>
                                        <th style="width:8%" class="comp_price hide">Rate/ct<br>Rs/ct</th>
                                        <th style="width:10%" class="comp_price hide">Diam Cost<br>Rs</th>
                                        <th style="width:4%"></th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                                <tfoot class="comp_price hide" style="background: #F0F0F0">
                                    <tr>
                                        <td></td><td></td><td></td><td></td><td></td>
                                        <td></td><td></td><td></td><td></td><td></td>
                                        <td></td><td></td><td></td>
                                        <td id="stone_total_qty">0</td>
                                        <td id="stone_total_wt">0</td>
                                        <td colspan="2" class="t_right t_red">Total (2): </td>
                                        <td class="t_right comp_price hide" id="stone_total_rate">0</td>
                                        <td class="t_right comp_price hide prod_td_price" id="stone_total_cost">0</td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </form>
                    </div>


                    <div id="colored_stone_grid">
                        <p class="header alert alert-info">Colored Stone
                            <a class="slide_form" data-type="colored_stone" style="display: inline-block; float: right;padding-right:5px; padding-top: 3px;"><i class="fa fa-minus-square-o"></i></a>
                        </p>
                        <div id="colored_stone_fields" class="colored_stone_fields">
                            <form id="colored_stone_form_fields">
                                <div class="row mb5">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label class="col-sm-3">Location</label>
                                            <div class="col-sm-4">
                                                <select class="form-control required" name="colored_stone_placement">
                                                    <option value=""></option>
                                                    <?php
                                                    $stone_placement_arr = $sub_com_data['stone_placement'];
                                                    foreach ($stone_placement_arr as $stone_placement) {
                                                        echo '<option value="' . $stone_placement->PLAC_ID . '">' . $stone_placement->PLAC_NAME . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label class="col-sm-3">Type</label>
                                            <div class="col-sm-4">
                                                <select class="form-control required" name="colored_stone_type" id="colored_stone_type">
                                                    <option value=""></option>
                                                    <?php
                                                    foreach ($sub_comp_arr as $sub_comp) {
                                                        if ($sub_comp->COMP_ID == 3) {
                                                            echo '<option value="' . $sub_comp->COMP_TYPE_ID . '">' . $sub_comp->COMP_TYPE_NAME . '</option>';
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                                <div id="c_stone_category_loader" style="display: none; font-size: 18px;" class="t_center mt10"><i class="fa fa-spinner fa-spin"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3" id="colored_stone_cat_par" style="display:none;">
                                        <div class="form-group">
                                            <label class="col-sm-3">Category</label>
                                            <div class="col-sm-4">
                                                <select class="form-control required" name="colored_stone_cat" id="colored_stone_cat">
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label class="col-sm-3">Shape</label>
                                            <div class="col-sm-4">
                                                <select class="form-control required" name="colored_stone_shape">
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
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label class="col-sm-3">Color</label>
                                            <div class="col-sm-4">
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
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label class="col-sm-3">Clarity</label>
                                            <div class="col-sm-4">
                                                <select class="form-control required" name="colored_stone_clarity_from">
                                                    <option value=""></option>
                                                    <?php
                                                    $stone_clarity_arr = $sub_com_data['stone_clarity'];
                                                    foreach ($stone_clarity_arr as $stone_clarity) {
                                                        echo '<option value="' . $stone_clarity->CLARITY_ID . '">' . $stone_clarity->CLARITY_NAME . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="col-sm-4">
                                                <select class="form-control required" name="colored_stone_clarity_to">
                                                    <option value=""></option>
                                                    <?php
                                                    foreach ($stone_clarity_arr as $stone_clarity) {
                                                        echo '<option value="' . $stone_clarity->CLARITY_ID . '">' . $stone_clarity->CLARITY_NAME . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label class="col-sm-3">Cut</label>
                                            <div class="col-sm-4">
                                                <select class="form-control required" name="colored_stone_cut">
                                                    <option value=""></option>
                                                    <?php
                                                    $cs_cut_arr = $sub_com_data['c_stone_cut'];
                                                    foreach ($cs_cut_arr as $cs_cut) {
                                                        echo '<option value="' . $cs_cut->CUT_ID . '">' . $cs_cut->CUT_NAME . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-3" id="colored_stone_2_size">
                                        <div class="form-group">
                                            <label class="col-sm-3">MM Size</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control numbers-only" data-decimal="true" name="colored_stone_mm_size_from" placeholder="From"/>
                                            </div>

                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" name="colored_stone_mm_size_to" placeholder="To"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label class="col-sm-3">Gross Wt</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control numbers-only required" data-decimal="true" name="colored_stone_gross_weight" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label class="col-sm-3">Qty/PCS</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control numbers-only" name="colored_stone_total_stones" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label class="col-sm-3">TOS</label>
                                            <div class="col-sm-4">
                                                <select class="form-control" name="colored_stone_setting">
                                                    <option value=""></option>
                                                    <?php
                                                    $stone_setting_arr = $sub_com_data['stone_setting'];
                                                    foreach ($stone_setting_arr as $stone_setting) {
                                                        echo '<option value="' . $stone_setting->SET_ID . '">' . $stone_setting->SET_NAME . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                                <div style="padding-left: 10px;">
                                    <div class="form-group">
                                        <button class="btn btn-success btn-xs header_btn" type="button" id="colored_stone_add_btn">Add</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <form id="colored_stone_grid_fields">
                            <table class="table table-bordered hide mt10" id="colored_stone_grid_table">
                                <thead>
                                    <tr>
                                        <th>Loc</th>
                                        <th>Type</th>
                                        <th>Shp</th>
                                        <th>Col</th>
                                        <th>Stn</th>
                                        <th>Cut</th>
                                        <th>Size<br>Fm</th>
                                        <th>Size<br>To</th>
                                        <th>Size<br>mm</th>
                                        <th style="width:2%;"><br>x</th>
                                        <th>Size<br>mm</th>
                                        <th>QTY<br>PCS</th>
                                        <th>Wt<br>cts</th>
                                        <th>TOS</th>
                                        <th style="width:8%" class="comp_price hide">Rate/ct<br>Rs/ct</th>
                                        <th style="width:10%" class="comp_price hide">CS Cost<br>Rs</th>
                                        <th style="width:4%"></th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                                <tfoot class="comp_price hide" style="background: #F0F0F0">
                                    <tr>
                                        <td></td><td></td><td></td><td></td><td></td>
                                        <td></td><td></td><td></td><td></td><td></td>
                                        <td></td>
                                        <td id="colored_stone_total_qty">0</td>
                                        <td id="colored_stone_total_wt">0</td>
                                        <td class="t_right t_red">Total (3): </td>
                                        <td class="t_right comp_price hide" id="colored_stone_total_rate">0</td>
                                        <td class="t_right comp_price hide prod_td_price" id="colored_stone_total_cost">0</td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </form>
                    </div>

                    <form id="other_grid_fields">
                        <table class="table table-bordered comp_price hide mt20">
                            <thead></thead>
                            <tbody>
                                <tr>
                                    <td class="t_right t_red">
                                        <span style="color:#333">Select Labour Price Type: </span><select name="labour_price_type" style="padding:3px 5px; margin-right: 10px;" onchange="calLabourCost();">
                                            <option value=""></option>
                                            <option value="1">Gross Wgt</option>
                                            <option value="2">Nt Wgt</option>
                                            <option value="3">Fixed</option>
                                        </select>

                                        Labour Charge (4)</td>
                                    <td style="width:8%;"><input type="text" class="form-control t_right" name="labour_base_cost" onblur="calLabourCost();" value="" /></td>
                                    <td style="width:10%;"><input type="text" class="form-control ready-only t_right" readonly="" value="0" name="labour_price" id="labour_price"/></td>
                                    <td style="width:4%"></td>
                                </tr>
                                <tr>
                                    <td class="t_right t_red">Final Cost (1+2+3+4)</td>
                                    <td style="width:8%;"></td>
                                    <td class="t_right prod_td_price" style="width:10%;" id="final_cost">0</td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>

                        <table class="table table-bordered comp_price hide">
                            <thead></thead>
                            <tbody>
                                <tr>
                                    <td class="t_right t_red">VAT 1% (5)</td>
                                    <td style="width:8%;"></td>
                                    <td class="t_right" style="width:10%;" ><input type="text" id="vat_cost" name="vat_cost" class="form-control ready-only t_right" readonly="" value="0" /></td>
                                    <td style="width:4%"></td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="comp_price hide">
                            <p class="alert header alert-warning">Other Misc. Cost</p>
                            <table class="table table-bordered mb20" id="misc_grid_table">
                                <thead>
                                    <tr>
                                        <th style="width:10%;">Misc.</th>
                                        <th>Description</th>
                                        <td style="width:8%;"></td>
                                        <th style="width:10%;">Cost (Rs)</th>
                                        <th style="width:4%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Misc1</td>
                                        <td><div class="col-sm-3"><input type="text" name="misc_desc_1" class="form-control numbers-only" data-decimal="true" value="Shipping" /></div></td>
                                        <td></td>
                                        <td class="t_right"><input style="width:100%;" type="text" name="misc_price_1" class="form-control t_right required numbers-only" value="0" data-decimal="true" onBlur="calMiscTotal(this);"/></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                                <tfoot class="comp_price hide" style="background: #F0F0F0">
                                    <tr>
                                        <td class="t_center"><button class="btn btn-success btn-xs header_btn" type="button" id="misc_add_btn">Add</button></td>
                                        <td class="t_red t_right">Total Misc. Cost (6)</td>
                                        <td></td>
                                        <td class="t_right prod_td_price" id="misc_cost">0</td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>

                            <table class="table table-bordered" style="border-top: none;">
                                <thead></thead>
                                <tbody>
                                    <tr>
                                        <td class="t_right t_red">Total Product Cost  (1+2+3+4+5+6)</td>
                                        <td style="width:8%;"></td>
                                        <td class="t_right f_14" style="width:10%; padding-right: 14px;" id="total_prod_cost">0</td>
                                        <td style="width:4%"></td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>

                        <div class="mt20" style="border-top:1px dashed #ebccd1; padding-top:10px;">
                            <div class="form-group">
                                <label class="col-sm-2">Website Product Remark</label>
                                <div class="col-sm-10 p_l_4">
                                    <input type="text" name="web_prod_remark" class="form-control" maxlength="200"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2">Store Product Remark</label>
                                <div class="col-sm-10 p_l_4">
                                    <input type="text" name="store_prod_remark" class="form-control" maxlength="200" />
                                </div>
                            </div>
                        </div>

                        <input type='hidden' id="primary_wt" value="0"/>
                        <input type='hidden' id="primary_index" value="0" />
                        <input type='hidden' id="primary_gross_wt" value="0" />
                        <input type='hidden' id="metal_count" name="metal_count" value="0"/>
                        <input type='hidden' id="stone_count" name="stone_count" value="0"/>
                        <input type='hidden' id="colored_stone_count" name="colored_stone_count" value="0" />
                        <input type='hidden' id="misc_count" name="misc_count" value="1" />
                    </form>


                </div><!-- panel-body -->
                <div class="panel-footer" style="display: block;">
                    <ul class="pager wizard">
                        <li class="next right"><button type="submit" class="btn btn-danger ladda-button right" id="add_prod_submit" data-style="expand-left"><span class="ladda-label">Save</span></button></li>
                    </ul>
                </div><!-- panel-footer -->
            </div><!-- panel-default -->

            </form>    
        </div>

    </div><!-- row -->


    <div class="panel panel-default" id="image_upload_det" style="display: none;">
        <div class="panel-heading">

            <h4 class="panel-title">Images Upload</h4>
            <p>Upload and edit images of this product.</p>
        </div>
        <div class="panel-body">
            <div class="col-sm-5">
                <div class="span6 section-summary">
                    <div>
                        <h1>Images</h1>
                        <p>Upload and edit images of this product.</p>
                    </div>

                    <div class="section-summary" style="margin-top:20px;">
                        <div id="image_view"></div> 
                    </div>

                </div>
            </div>
            <div class="col-sm-7">
                <form action="admin/upload_prod_images/" id="productImgForm" method="post" enctype="multipart/form-data">
                    <input type="file" name="upload[]" multiple="" id="file_upload" accept="image/x-png, image/gif, image/jpeg"/>
                    <div class="mb20"></div>
                    <button type="submit" class="btn btn-success" name="submit" id="upload_btn" style="display: none;">Upload</button>
                </form>
                <div class="mb20"></div>
                <div class="progress progress-striped active mt10" style="display: none;">
                    <div class="progress-bar" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div><!-- panel-body -->
        <div class="panel-footer">
            <button class="btn btn-primary" style="float:right; display: none;" onclick="validateUpload();" id="finish_btn">Finish</button>
        </div><!-- panel-footer -->
    </div><!-- panel -->



</div><!-- contentpanel -->

</div><!-- mainpanel -->



</section>

<script src="js/product.js"></script>
<script src="js/jquery.tagsinput.min.js"></script>
<script type="text/javascript">
                $(document).ready(function() {
                    jQuery('#tags').tagsInput({width: 'auto', height: '50'});
                    jQuery('.menutoggle').trigger('click');
                });
</script>

<?php

function showDropDown($arr, $col1, $col2, $field_name) {
    if (sizeof($arr) > 0) {
        echo '<select name="' . $field_name . '" class="form-control" onchange="showTextField(this)">';
        echo '<option value=""></option>';
        foreach ($arr as $row) {
            echo '<option value="' . $row->$col1 . '">' . $row->$col2 . '</option>';
        }
        echo '<option value="others" style="color:red;">Others</option>';
        echo '</select>';
    }
    echo '<input type="text" name="' . $field_name . '_txt" placeholder="Enter ' . ucfirst($field_name) . '" class="form-control mt5 ' . (sizeof($arr) > 0 ? 'hide' : '') . '" maxlength="20" />';
}
?>
</body>
</html>