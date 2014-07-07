<link rel="stylesheet" href="css/jquery.tagsinput.css" />   

<link rel="stylesheet" href="css/dropzone.css" />
<script src="js/dropzone.min.js"></script>

<div class="pageheader">
    <h2><i class="fa fa-pencil"></i> Products <span>Edit Product</span></h2>
    <div class="breadcrumb-wrapper">
        <span class="label">You are here:</span>
        <ol class="breadcrumb">
            <li><a href="index.html">Home</a></li>  
            <li><a href="general-forms.html">Products</a></li>
            <li class="active">Edit Product</li>
        </ol>
    </div>
</div>

<div class="contentpanel">

    <div class="row" id="prod_data_det">

        <?php echo form_open('', array('id' => 'addProdForm', 'role' => 'form', 'autocomplete' => 'off')); ?>

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

                    <div class="row mb15">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-sm-8" style="margin-right:6px;">Category <em>*</em></label>
                                <div class="col-sm-3">
                                    <select class="form-control required" name="category">
                                        <?php echo $category_opt; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-sm-4">Product Type <em>*</em></label>
                                <div class="col-sm-3">
                                    <select class="form-control required" name="prod_type">
                                        <?php echo $prod_type_opt; ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="form-group">
                        <label class="col-sm-4">Product Name <em>*</em></label>
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
                        <label class="col-sm-4">Product Long Description <em>*</em></label>
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

                    <p class="bg-info header">Other Details</p>

                    <div class="form-group">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-sm-8">Certificate</label>
                                <div class="col-sm-2">
                                    <select class="form-control" name="prod_cert">
                                        <option value=""></option>
                                        <option value="igi">IGI</option>
                                    </select>
                                </div>
                            </div>  
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-sm-6">Stock</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="prod_stock">
                                        <option value=""></option>
                                        <option value="Ready">Ready</option>
                                        <option value="On Request">On Request</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-sm-8">Hallmark</label>
                                <div class="col-sm-2">
                                    <div class="toggle toggle-success" id="hallmark_t"></div>
                                    <input type="checkbox" id="hallmark" name="hallmark" style="visibility: hidden" />
                                </div>

                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-sm-6">30 days refund</label>
                                <div class="col-sm-2">
                                    <div class="toggle toggle-success" id="days_ret_30_t"></div>
                                    <input type="checkbox" id="days_ret_30" name="days_ret_30" style="visibility: hidden" />
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="form-group">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-sm-8">100% Return</label>
                                <div class="col-sm-2">
                                    <div class="toggle toggle-success" id="ret_100_t"></div>
                                    <input type="checkbox" id="ret_100" name="ret_100" style="visibility: hidden" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-sm-6">Free Shipping</label>
                                <div class="col-sm-2">
                                    <div class="toggle toggle-success" id="free_ship_t"></div>
                                    <input type="checkbox" id="free_ship" name="free_ship" style="visibility: hidden" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-sm-8">Life Time Return</label>
                                <div class="col-sm-2">
                                    <div class="toggle toggle-success" id="life_time_ret_t"></div>
                                    <input type="checkbox" id="life_time_ret" name="life_time_ret" style="visibility: hidden" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-sm-6">Free Return</label>
                                <div class="col-sm-2">
                                    <div class="toggle toggle-success" id="free_ret_t"></div>
                                    <input type="checkbox" id="free_ret" name="free_ret" style="visibility: hidden" />
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="form-group">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-sm-8">Payment</label>
                                <div class="col-sm-2">
                                    <div class="toggle toggle-success" id="payment_t"></div>
                                    <input type="checkbox" id="payment" name="payment" style="visibility: hidden" />
                                </div>
                            </div>
                        </div>
                    </div>

                </div><!-- panel-body -->
                <div class="panel-footer" style="display: block;">
                    <ul class="pager wizard">
                        <li class="next"><a href="javascript:void(0)" data-next="prod_comp_det">Next</a></li>
                    </ul>
                </div><!-- panel-footer -->
            </div><!-- panel-default -->


        </div>

        <div class="form-group" id="prod_comp_det" style="display: none;">
            <div class="col-md-4">


                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-btns">
                            <a href="" class="minimize">−</a>
                        </div>
                        <h4 class="panel-title">Define Component</h4>
                        <p>adding component details</p>
                    </div>
                    <div class="panel-body" style="display: block;">

                        <div class="form-group">
                            <label class="col-sm-4">Component</label>
                            <div class="col-sm-8">
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
                                <label class="col-sm-4">Primary?</label>
                                <div class="col-sm-8">
                                    <select class="form-control required" name="metal_prim">
                                        <option value=""></option>
                                        <option value="1">Primary</option>
                                        <option value="0">Secondary</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4">Type</label>
                                <div class="col-sm-8">
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
                                <label class="col-sm-4">Gross Wt</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control numbers-only" data-decimal="true" name="metal_gross_weight" placeholder="Gross Weight">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4">Caret / Purity</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control numbers-only" data-decimal="true" name="meta_caret" placeholder="Caret">
                                </div>
                            </div>
                        </div>

                        <div id="diamond_fields" class="form_fields" style="display: none;">

                            <div class="form-group">
                                <label class="col-sm-4">Type</label>
                                <div class="col-sm-8">
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

                            <div class="form-group">
                                <label class="col-sm-4">Shape</label>
                                <div class="col-sm-8">
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

                            <div class="form-group" id="stone_size_type" style="display: none;">
                                <label class="col-sm-4">Size Type</label>
                                <div class="col-sm-8">
                                    <select class="form-control required" name="stone_size_type">
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

                            <div class="form-group" style="display: none;" id="stone_1_size">
                                <label class="col-sm-4">SEIV Size</label>
                                <div class="col-sm-4">
                                    <select class="form-control required" name="stone_seiv_size_from">
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
                                    <select class="form-control required" name="stone_seiv_size_to">
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

                            <div class="form-group" id="stone_2_size" style="display:none;">
                                <label class="col-sm-4">MM Size</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control numbers-only" data-decimal="true" name="stone_mm_size_from" placeholder="From"/>
                                </div>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="stone_mm_size_to" placeholder="To"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4">No. of Stones</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control numbers-only" name="stone_total_stones" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4">Gross Wt</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control numbers-only" data-decimal="true" name="stone_gross_weight" placeholder="Gross Weight" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4">Color</label>
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

                            <div class="form-group">
                                <label class="col-sm-4">Clarity</label>
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

                            <div class="form-group">
                                <label class="col-sm-4">Cut</label>
                                <div class="col-sm-8">
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
                                <label class="col-sm-4">Fluorescence</label>
                                <div class="col-sm-8">
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

                            <div class="form-group">
                                <label class="col-sm-4">Placement</label>
                                <div class="col-sm-8">
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

                        <div id="colored_stone_fields" class="form_fields" style="display: none;">
                            <div class="form-group">
                                <label class="col-sm-4">Type</label>
                                <div class="col-sm-8">
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
                            <div class="form-group" id="colored_stone_cat_par" style="display:none;">
                                <label class="col-sm-4">Category</label>
                                <div class="col-sm-8">
                                    <select class="form-control required" name="colored_stone_cat" id="colored_stone_cat">
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4">Color</label>
                                <div class="col-sm-8">
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
                                <label class="col-sm-4">Shape</label>
                                <div class="col-sm-8">
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

                            <div class="form-group">
                                <label class="col-sm-4">Cut</label>
                                <div class="col-sm-8">
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

                            <div class="form-group">
                                <label class="col-sm-4">No. of Stones</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control numbers-only" name="colored_stone_total_stones" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4">Gross Weight</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control numbers-only" data-decimal="true" name="colored_stone_gross_weight" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4">MM Size</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control numbers-only" data-decimal="true" name="colored_stone_mm_size_from" placeholder="From"/>
                                </div>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control numbers-only" data-decimal="true" name="colored_stone_mm_size_to" placeholder="To"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4">Placement</label>
                                <div class="col-sm-8">
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

                        <div id="ajax_loader" class="t_c" style="display: none">
                            <div style="font-size: 20px;"><i class="fa fa-spinner fa-spin"></i></div>
                        </div>

                    </div><!-- panel-body -->
                    <div class="panel-footer" style="display: block;">
                        <ul class="pager">
                            <button class="btn btn-success disabled" type="button" id="add_btn">Add</button>
                        </ul>
                    </div><!-- panel-footer -->
                </div><!-- panel-default -->


            </div>


            <div class="col-md-8" id="prod_summary">


                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-btns">
                            <a href="" class="minimize">−</a>
                        </div>
                        <h4 class="panel-title">Component Details</h4>
                        <p>Basic product details</p>
                    </div>
                    <div class="panel-body" style="display: block;">
                        <div class="table-responsive hide" id="component_grid" style="max-height:200px; overflow-y:auto;">
                            <table class="table table-success mb30">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Component</th>
                                        <th>Sub Component</th>
                                        <th>Component Details</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                            <input type="hidden" name="comp_count" id="comp_count" value="0" />
                        </div>
                    </div>
                    <div class="panel-footer" style="display: block;">
                        <ul class="pager">
                            <li class="previous"><a href="javascript:void(0)" data-prev='prod_summary'>Previous</a></li>
                            <li class="next"><a href="javascript:void(0)" data-next='prod_comp_price'>Next</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group" id="prod_comp_price" style="display: none;">
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-btns">
                            <a href="" class="minimize">−</a>
                        </div>
                        <h4 class="panel-title">Define Pricing</h4>
                        <p>Component pricing details</p>
                    </div>
                    <div class="panel-body" style="display: block;">
                        <div class="form-group">
                            <label class="col-sm-4">Price Type <span>*</span></label>
                            <div class="col-sm-7">
                                <select class="form-control required" name="price_type">
                                    <?php echo $price_type_opt; ?>
                                </select>
                            </div>
                        </div>



                    </div><!-- panel-body -->

                </div><!-- panel-default -->


            </div>

            <div class="col-md-8">


                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-btns">
                            <a href="" class="minimize">−</a>
                        </div>
                        <h4 class="panel-title">Pricing Details</h4>
                        <p>Component pricing details</p>
                    </div>
                    <div class="panel-body" style="display: block;">

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
                                        <th width="15%">Sub Comp</th>
                                        <th width="25%">Component Details</th>
                                        <th>Cost in gms / Caret</th>
                                        <th>Cost</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                            <input type="hidden" name="stone_total_weight" id="stone_total_weight" value="0" />
                            <input type="hidden" name="prim_metal_weight" id="prim_metal_weight" value="0" />
                            <input type="hidden" name="metal_total_weight" id="metal_total_weight" value="0" />
                        </div>

                    </div><!-- panel-body -->
                    <div class="panel-footer" style="display: block;">
                        <ul class="pager wizard">
                            <li class="previous"><a href="javascript:void(0)" data-prev='prod_comp_det'>Previous</a></li>
                            <li class="next"><button type="submit" class="btn btn-danger ladda-button right" id="add_prod_submit" data-style="expand-left"><span class="ladda-label">Save</span></button></li>
                        </ul>
                    </div><!-- panel-footer -->
                </div><!-- panel-default -->


            </div>

        </div>



        <?php echo form_close(); ?>


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

                    <div class="section-summary" style="margin-top:20px;">
                        <div id="image_view"></div> 
                    </div>

                </div>
            </div>
            <div class="col-sm-7">
                <form action="admin/upload_prod_images/" class="dropzone"></form>
            </div>
        </div><!-- panel-body -->
        <div class="panel-footer">
            <button class="btn btn-primary" style="float:right;" onclick="window.location.href = 'admin/product/viewAll'">Finish</button>
        </div><!-- panel-footer -->
    </div><!-- panel -->



</div><!-- contentpanel -->

</div><!-- mainpanel -->



</section>


<script src="js/jquery.tagsinput.min.js"></script>

<script>
                jQuery(document).ready(function() {

                    jQuery('#tags').tagsInput({width: 'auto'});

                    $('.previous a').on('click', function() {
                        $('html,body').animate({scrollTop: $('#' + $(this).data('prev')).offset().top}, 800);
                    });

                    $('.next a').on('click', function() {
                        var id = $(this).data('next');
                        $('#' + id).delay(350).fadeIn(function() {
                            $('html,body').animate({scrollTop: $(document).height()}, 1500);
                        });
                    });

                    $('[name="price_type"]').on('change', function() {
                        show_price();
                    });

                    $('[name="stone_size_type"]').on('change', function() {
                        hideSizeBlocks();
                        $('#stone_' + $(this).val() + '_size').fadeIn('slow');
                    });

                    $('[name="stone_shape"]').on('change', function() {
                        $('#stone_size_type').hide();
                        hideSizeBlocks();
                        if ($(this).val() == 1) {
                            $('#stone_size_type').fadeIn('slow');
                        } else {
                            $('#stone_2_size').fadeIn('slow');
                        }
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

                    $('[name="colored_stone_type"]').on('change', function() {
                        if ($(this).val() != '') {
                            ajaxCallUpdateCombo('', 'admin/ajax/c_stone_category', 'colored_stone_type', 'colored_stone_cat', 'c_stone_category', '');
                        }
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

                    //jQuery('.menutoggle').trigger('click');
                });

                function hideSizeBlocks() {
                    $('[name="stone_size_type"] option').each(function() {
                        $('#stone_' + $(this).val() + '_size').hide();
                    });
                }

</script>

</body>
</html>
