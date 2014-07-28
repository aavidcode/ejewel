<!--<script type="text/javascript" src="js/jquery.liquidcarousel.js"></script>-->
<script type="text/javascript">
    $(document).ready(function() {
        
        var comment_offset_top = $('#table_fixed_header').offset().top;
        var compliq = function() {
            
            var scroll_top = $(window).scrollTop();
            if (scroll_top > comment_offset_top) {
                $('#table_fixed_header').css({'position': 'fixed', 'top': "0"});
            } else {
                $('#table_fixed_header').css({'position': 'relative', 'top': '110px'});
            }
        };

        $(window).scroll(function() {
            compliq();
        });

    });

    $(document).ready(function() {
        $('.sorting').on('click', function(e) {
            if ($(this).find('i').hasClass('fa-sort')) {
                $('#table_fixed_header > td').find('i').removeClass('fa-sort-desc').removeClass('fa-sort-asc').addClass('fa-sort');
            }

            $('#col_name').val($(this).data('col'));
            $('#col_type').val($(this).data('type'));
            var order_by = '';
            if ($(this).find('i').hasClass('fa-sort')) {
                $(this).find('i').removeClass('fa-sort');
                $(this).find('i').addClass('fa-sort-desc');
                order_by = 'desc';
            } else if ($(this).find('i').hasClass('fa-sort-desc')) {
                $(this).find('i').removeClass('fa-sort-desc');
                $(this).find('i').addClass('fa-sort-asc');
                order_by = 'asc';
            } else {
                $(this).find('i').addClass('fa-sort-desc');
                $(this).find('i').removeClass('fa-sort-asc');
                order_by = 'desc';
            }
            $('#order_by').val(order_by);
            resetFields();
            loadProducts();
        });
    });

</script>
<style type="text/css">
    .my_table {
        width:1260px;
        border-collapse: collapse;
        background-color: #ffffff;
    }

    .my_table thead tr td {
        padding:6px;
        align:center;
        color:#000000;
        font-size:10px;
    }
    .my_table td {
        padding:3px;
        vertical-align: top;
        align:center;
        font-size:10px;
        border:0px solid #000;
    }
    .my_table thead tr td{
        font-size:10px;
    }
    .titleProImg{
        background-color: #428bca;
        color:#ffffff;
        width:73px;
    }
    .titleProDel{
        text-align: center;
        background-color: #1CAF9A; 
        color:#ffffff;
        width:94px;
    }
    .titleProMel{
        text-align: center;
        background-color: #f0ad4e; 
        color:#ffffff;
        width:312px;
    }
    .titleProDia{
        text-align: center;
        background-color: #d9534f; 
        color:#ffffff;
        width:346px;
    }
    .titleProCStone{
        text-align: center;
        background-color: #5bc0de; 
        color:#ffffff;
        width:342px;
    }
    .titleOthers{
        text-align: center;
        background-color: #33CCFF; 
        color:#ffffff;
        width:91px;
    }
    .headerProDel{
        color:#ffffff !important;
        background-color: #1CAF9A;
        text-align:center;
        vertical-align: top;  
    }
    .headerMetal{
        color:#ffffff !important;
        background-color: #f0ad4e;
        text-align:center;
        vertical-align: top; 
    }
    .headerStone{
        color:#ffffff !important;
        background-color: #d9534f;
        text-align:center;
        vertical-align: top; 
    }
    .headerDia{
        color:#ffffff !important;
        background-color: #5bc0de;
        text-align:center;
        vertical-align: top; 
    }
    .headerLabour{
        color:#ffffff !important;
        background-color: #33CCFF;
        text-align:center;
        vertical-align: top; 
    }
    .txt1{
        color:#383838;
        text-weight:bold;
    }
    .block{
        display:inline-block; 
        padding:3px; 
        margin-right:2px;
        color:#ffffff;
        background-color:#269abc;
    }

    #progressLoader {
        z-index: 5000;
        position: fixed;
        left: 44%;
        bottom: 40px;
        width: 200px;
        height: 80px;
        padding: 10px;
        background: #fff;
        opacity: 0.8;
        color: #FFF;
        -moz-border-radius: 10px;
        -webkit-border-radius: 10px;
        border-radius: 10px;
        border:1px solid #e5e5e5;
    }

    #breadcrumb-trail {
        display: inline-block;
        margin-bottom: 10px;
        margin-left: 5px;
    }

    #breadcrumb_det {
        display: inline-block;
    }
    #breadcrumb-trail .tagl-item {
        margin-bottom: 5;
    }

    .tagl-item {
        position: relative;
        display: inline-block;
        vertical-align: top;
        white-space: nowrap;
        max-width: 100%;
        margin: 0 4px 4px 0;
        background-color: #4d4d4d;
        color: #eee;
    }

    .tagl-select {
        cursor: pointer;
    }

    .tagl-x, .tagl-text {
        font-size: 12px;
        text-shadow: 0 0 1px black;
        line-height: 140%;
        vertical-align: top;
        display: inline-block;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 150px;
    }

    .tagl-x {
        padding-left: 10px;
        padding-right: 10px;
        width: 20px;
        vertical-align: top;
        cursor: pointer;
        position: absolute;
        font-weight: bold;
        text-align: center;
        line-height: 26px;
        top: 0;
        right: 0;
    }

    .tagl-text {
        padding: 5px 20px 5px 7px;
    }

    #crumb-reset {
        display: inline-block;
        margin-left: 2px;
        margin-top: 5px;
    }
    #crumb-reset a {
        vertical-align: middle;
    }

    .sorting {
        cursor: pointer;
    }
</style>
<div class="pageheader">
    <h2><i class="fa fa-table"></i> Products</h2>
    <div class="breadcrumb-wrapper">
        <span class="label">You are here:</span>
        <ol class="breadcrumb">
            <li><a href="index.html">Home</a></li>
            <li class="active">Products</li>
        </ol>
    </div>
</div>
<div class="contentpanel">
    <?php
    if ($totalcount == 0) {
        echo '<span>No Products Found</span><h2 style="text-align:center"><a href="admin/product/add">Add New Product</a></h2>';
    } else {
        ?>
        <div class="panel panel-default" id="prod_search_det">
            <?php echo form_open('', array('id' => 'searchoFrm')) ?>
            <div class="panel-heading">
                <div class="panel-btns">
                    <a class="minimize maximize" href="">+</a>
                </div>
                <h5 class="panel-title">Product Search</h5>
            </div>
            <div class="panel-body" style="display: none;">   
                <div class="col-sm-12">
                    <div>
                        <div id="collapseOne2">
                            <p class="header alert alert-info">Product Details</p>
                            <div class="row">
                                <div class="col-sm-4">
                                    <label class="col-sm-6">Jewellery Type</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" name="jeweltype">
                                            <option value="">--</option>
                                            <option value="precious">Precious</option>
                                            <option value="studded">Studded</option>
                                            <option value="semimount">Semi Mount</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label class="col-sm-6">Category</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" name="category">
                                            <?php echo $fields_opt['category_opt']; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label class="col-sm-6">Product Type</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" name="producttype">
                                            <?php echo $fields_opt['prod_type_opt']; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label class="col-sm-6">Product Name</label>
                                    <div class="col-sm-4">
                                        <input class="form-control" type="text" name="productname"/>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label class="col-sm-6">Collection</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" name="collection">
                                            <option value="">--</option>
                                            <?php
                                            foreach ($fields_data['collection_names'] as $collections) {
                                                echo '<option  value="' . $collections->CN_ID . '">' . $collections->CN_NAME . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label class="col-sm-6">Brand</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" name="brand">
                                            <option value="">--</option>
                                            <?php
                                            foreach ($fields_data['brands'] as $brands) {
                                                echo '<option  value="' . $brands->B_ID . '">' . $brands->B_NAME . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label class="col-sm-6">Designer</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" name="designer">
                                            <option value="">--</option>
                                            <?php
                                            foreach ($fields_data['designer'] as $designers) {
                                                echo '<option  value="' . $designers->D_ID . '">' . $designers->D_NAME . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label class="col-sm-6">Price Range</label>
                                    <div class="col-sm-3">
                                        <input class="form-control" type="text" name="pricefrom" placeholder="Price From"/>
                                    </div>
                                    <div class="col-sm-3">
                                        <input class="form-control" type="text" name="priceto" placeholder="Price To"/>
                                    </div>
                                </div>
                            </div>
                            <p class="header alert alert-success">Other Features</p>
                            <div class="row">
                                <div class="col-sm-4">
                                    <label class="col-sm-6">Certificate</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" name="certificate">
                                            <option value="">--</option>
                                            <option value="igi">Yes</option>
                                            <option value="">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label class="col-sm-6">Hallmark</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" name="hallmark">
                                            <option value="">--</option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label class="col-sm-6">30 Days Refund</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" name="30daysrefund">
                                            <option value="">--</option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label class="col-sm-6">100%Refund</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" name="100_refund">
                                            <option value="">--</option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label class="col-sm-6">Free Insured Shippping</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" name="freeship">
                                            <option value="">--</option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label class="col-sm-6">Lifetime Exchange</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" name="lifetimeexch">
                                            <option value="">--</option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label class="col-sm-6">Free Returns</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" name="freereturn">
                                            <option value="">--</option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label class="col-sm-6">Try @ Home</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" name="tryhome">
                                            <option value="">--</option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label class="col-sm-6">Ready Stock</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" name="readystock">
                                            <option value="">--</option>
                                            <option value="Ready">Yes</option>
                                            <option value="">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label class="col-sm-6">Cash On Delivery</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" name="cod">
                                            <option value="">--</option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <p class="header alert alert-danger">Metal Details</p>
                            <div class="row">
                                <div class="col-sm-4">
                                    <label class="col-sm-6">Metal Type</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" name="metaltype">
                                            <option value=''>--</option>
                                            <?php
                                            foreach ($sub_com_data['component_type'] as $comp_type) {
                                                if ($comp_type->COMP_ID == 1) {
                                                    echo '<option  value="' . $comp_type->COMP_TYPE_ID . '">' . $comp_type->COMP_TYPE_NAME . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>                                
                            </div>
                            <p class="header alert alert-danger">Diamond Details</p>
                            <div class="row">
                                <div class="col-sm-4">
                                    <label class="col-sm-6">Diamond Type</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" name="diamondtype">
                                            <option value="">--</option>
                                            <?php
                                            foreach ($sub_com_data['component_type'] as $comp_type) {
                                                if ($comp_type->COMP_ID == 2) {
                                                    echo '<option value="' . $comp_type->COMP_TYPE_ID . '">' . $comp_type->COMP_TYPE_NAME . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label class="col-sm-6">Stone Clarity To</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" name="stoneclarityto">
                                            <option value="">--</option>
                                            <?php
                                            foreach ($sub_com_data['stone_clarity'] as $stoneclarity) {
                                                echo '<option value="' . $stoneclarity->CLARITY_ID . '">' . $stoneclarity->CLARITY_NAME . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label class="col-sm-6">Stone Clarity From</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" name="stoneclarityfrom">
                                            <option value="">--</option>
                                            <?php
                                            foreach ($sub_com_data['stone_clarity'] as $stoneclarity) {
                                                echo '<option value="' . $stoneclarity->CLARITY_ID . '">' . $stoneclarity->CLARITY_NAME . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label class="col-sm-6">Stone Color To</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" name="stonecolorto">
                                            <option value="">--</option>
                                            <?php
                                            foreach ($sub_com_data['stone_color'] as $stonecolor) {
                                                echo '<option value="' . $stonecolor->COLOR_ID . '">' . $stonecolor->COLOR_NAME . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label class="col-sm-6">Stone Color From</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" name="stonecolorfrom">
                                            <option value="">--</option>
                                            <?php
                                            foreach ($sub_com_data['stone_color'] as $stonecolor) {
                                                echo '<option value="' . $stonecolor->COLOR_ID . '">' . $stonecolor->COLOR_NAME . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label class="col-sm-6">Stone Cut</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" name="stonecut">
                                            <option value="">--</option>
                                            <?php
                                            foreach ($sub_com_data['stone_cut'] as $stonecut) {
                                                echo '<option value="' . $stonecut->CUT_ID . '">' . $stonecut->CUT_NAME . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label class="col-sm-6">Stone Shape</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" name="stoneshape">
                                            <option value="">--</option>
                                            <?php
                                            foreach ($sub_com_data['stone_shape'] as $stoneshape) {
                                                echo '<option value="' . $stoneshape->SHAPE_ID . '">' . $stoneshape->SHAPE_NAME . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label class="col-sm-6">Stone Fluorescence</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" name="stonefluor">
                                            <option value="">--</option>
                                            <?php
                                            foreach ($sub_com_data['stone_fluorescence'] as $stonefluor) {
                                                echo '<option value="' . $stonefluor->FLU_ID . '">' . $stonefluor->FLU_NAME . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label class="col-sm-6">Stone Placement</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" name="stoneplace">
                                            <option value="">--</option>
                                            <?php
                                            foreach ($sub_com_data['stone_placement'] as $stoneplace) {
                                                echo '<option value="' . $stoneplace->PLAC_ID . '">' . $stoneplace->PLAC_NAME . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label class="col-sm-6">Stone Seiv Size To</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" name="stoneseivsizeto">
                                            <option value="">--</option>
                                            <?php
                                            foreach ($sub_com_data['stone_seiv_size_to'] as $stoneseivsizeto) {
                                                echo '<option value="' . $stoneseivsizeto->SEIV_SIZE_TO_ID . '">' . $stoneseivsizeto->SEIV_SIZE_TO_NAME . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>                                   
                                </div>
                                <div class="col-sm-4">
                                    <label class="col-sm-6">Stone Seiv Size From</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" name="stoneseivsizefrom">
                                            <option value="">--</option>
                                            <?php
                                            foreach ($sub_com_data['stone_seiv_size_from'] as $stoneseivsizefrom) {
                                                echo '<option value="' . $stoneseivsizefrom->SEIV_SIZE_FROM_ID . '">' . $stoneseivsizefrom->SEIV_SIZE_FROM_NAME . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>                                   
                                </div>
                                <div class="col-sm-4">
                                    <label class="col-sm-6">Stone Size</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" name="stonesize">
                                            <option value="">--</option>
                                            <?php
                                            foreach ($sub_com_data['stone_size'] as $stonesize) {
                                                echo '<option value="' . $stonesize->SIZE_ID . '">' . $stonesize->SIZE_NAME . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label class="col-sm-6">Stone Setting</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" name="stoneset">
                                            <option value="">--</option>
                                            <?php
                                            foreach ($sub_com_data['stone_setting'] as $stoneset) {
                                                echo '<option value="' . $stoneset->SET_ID . '">' . $stoneset->SET_NAME . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <p class="header alert alert-danger">Colored Stone Details</p>
                            <div class="row">
                                <div class="col-sm-4">
                                    <label class="col-sm-6">Colored Stone Type</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" name="cstonetype">
                                            <option value="">--</option>
                                            <?php
                                            foreach ($sub_com_data['component_type'] as $comp_type) {
                                                if ($comp_type->COMP_ID == 3) {
                                                    echo '<option  value="' . $comp_type->COMP_TYPE_ID . '">' . $comp_type->COMP_TYPE_NAME . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label class="col-sm-6">Colored Stone Category</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" name="cstonecat">
                                            <option value="">--</option>
                                            <?php
                                            foreach ($sub_com_data['c_stone_category'] as $cstonecat) {
                                                echo '<option value="' . $cstonecat->C_STONE_CAT_ID . '">' . $cstonecat->C_STONE_CAT_NAME . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label class="col-sm-6">Colored Stone Color</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" name="cstonecolor">
                                            <option value="">--</option>
                                            <?php
                                            foreach ($sub_com_data['c_stone_color'] as $cstonecol) {
                                                echo '<option value="' . $cstonecol->C_STONE_COL_ID . '">' . $cstonecol->C_STONE_COL_NAME . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label class="col-sm-6">Colored Stone Cut</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" name="cstonecut">
                                            <option value="">--</option>
                                            <?php
                                            foreach ($sub_com_data['c_stone_cut'] as $cstonecut) {
                                                echo '<option value="' . $cstonecut->CUT_ID . '">' . $cstonecut->CUT_NAME . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>  
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-footer" style="text-align:center;">
                    <input type="submit" class="btn btn-primary" value="Search" id="submit" style="margin-right: 20px;"/>
                </div>
            </div><!-- panel-body -->
            <!-- hidden values for sorting-->
            <input type="hidden" name="colname" id="col_name" value="" />
            <input type="hidden" name="coltype" id="col_type" value="" />
            <input type="hidden" name="orderby" id="order_by" value="" />
            <?php echo form_close() ?>
        </div><!-- panel -->
        <div class="row">
            <div class="col-sm-12">
                <div class="row mb10">
                    <div class="col-sm-8">
                        <div id="breadcrumb-trail" class="tagl-container" style="display: none;">
                            <div id="breadcrumb_det">
                            </div>
                            <div id="crumb-reset" class="link"><a href="admin/product/viewAll">Clear All</a></div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div style="text-align:right; padding-top: 10px;" class="mb20">Total <span style="font-weight: bold;" id="search_count"></span> Records Found</div>
                    </div>
                </div>
                <div class="table-responsive" id="table_prod_grid">
                    <table class="my_table" cellspacing="0" cellpadding="0">
                        <thead>
                            <tr id="table_fixed_header">
                                <td colspan="2" class="titleProImg">Product Image</td>
                                <td class="titleProDel">
                                    <table>
                                        <tr>
                                            <td colspan="2">Product Details</td>
                                        </tr>
                                        <tr height="20">
                                            <td class="headerProDel">Style No</td>
                                        </tr>
                                    </table>                   
                                </td>
                                <td colspan="2" class="titleProMel">
                                    <table width="100%">
                                        <tr>
                                            <td colspan="6">I - Metal Details</td>
                                        </tr>
                                        <tr>
                                            <td width="60px" class="headerMetal"><span class="sorting" data-type="metal" data-col="COMP_TYPE_ID">Typ<i class="fa fa-sort"></i></span></td>
                                            <td width="48px" class="headerMetal"><span class="sorting" data-type="metal" data-col="GROSS_WEIGHT">Wt(gms)<i class="fa fa-sort"></i></span></td>
                                            <td width="42px" class="headerMetal"><span class="sorting" data-type="metal" data-col="TYPE">Kt <i class="fa fa-sort"></i></span></td>
                                            <td width="42px" class="headerMetal">Col </td>
                                            <td width="54px" class="headerMetal"><span class="sorting" data-type="metal" data-col="BASE_RATE">Rate(Rs/gm)<i class="fa fa-sort"></i></span></td>
                                            <td width="56px" class="headerMetal"><span class="sorting" data-type="metal" data-col="MF_PRICE">Cost(Rs)<i class="fa fa-sort"></i></span></td>
                                        </tr>
                                    </table>
                                </td>
                                <td colspan="2" class="titleProDia">
                                    <table width="100%">
                                        <tr>
                                            <td colspan="7" align="center">II - Diamond Details</td>
                                        </tr>
                                        <tr>
                                            <td class="headerStone" width="36px"><span class="sorting" data-type="stone" data-col="PLAC_ID">Loc<i class="fa fa-sort"></i></span></td>
                                            <td class="headerStone" width="46px"><span class="sorting" data-type="stone" data-col="COMP_TYPE_ID">Typ<i class="fa fa-sort"></i></span></td>
                                            <td class="headerStone" width="41px"><span class="sorting" data-type="stone" data-col="SHAPE_ID">Shp<i class="fa fa-sort"></i></span></td>
                                            <td class="headerStone" width="42px"><span class="sorting" data-type="stone" data-col="GROSS_WEIGHT">Wt(cts)<i class="fa fa-sort"></i></span></td>
                                            <td class="headerStone" width="50px">Col/Cla</td>
                                            <td class="headerStone" width="38px"><span class="sorting" data-type="stone" data-col="CUT_ID">Cut<i class="fa fa-sort"></i></span></td>
                                            <td class="headerStone" width="43px"><span class="sorting" data-type="stone" data-col="BASE_RATE">Rate(Rs/ct)<i class="fa fa-sort"></i></span></td>
                                            <td class="headerStone" width="38px"><span class="sorting" data-type="stone" data-col="MF_PRICE">Cost(Rs)<i class="fa fa-sort"></i></span></td>
                                        </tr>
                                    </table>
                                </td>
                                <td colspan="2" class="titleProCStone">
                                    <table width="100%">
                                        <tr>
                                            <td colspan="7" align="center">III - Colored Stone Details</td>
                                        </tr>
                                        <tr>
                                            <td class="headerDia" width="30px"><span class="sorting" data-type="cstone" data-col="COMP_TYPE_ID">Typ<i class="fa fa-sort"></i></span></td>
                                            <td class="headerDia" width="30px"><span class="sorting" data-type="cstone" data-col="SHAPE_ID">Shp<i class="fa fa-sort"></i></span></td>
                                            <td class="headerDia" width="58px"><span class="sorting" data-type="cstone" data-col="GROSS_WEIGHT">Wt(cts)<i class="fa fa-sort"></i></span></td>
                                            <td class="headerDia" width="29px"><span class="sorting" data-type="cstone" data-col="C_STONE_COL_ID">Col<i class="fa fa-sort"></i></span></td>
                                            <td class="headerDia" width="53px"><span class="sorting" data-type="cstone" data-col="C_STONE_CAT_ID">Stn Typ<i class="fa fa-sort"></i></span></td>
                                            <td class="headerDia" width="76px"><span class="sorting" data-type="cstone" data-col="BASE_RATE">Rate(Rs/ct)<i class="fa fa-sort"></i></span></td>
                                            <td class="headerDia" width="66px"><span class="sorting" data-type="cstone" data-col="MF_PRICE">Cost(Rs)<i class="fa fa-sort"></i></span></td>
                                        </tr>
                                    </table></td>
                                <td class="titleOthers">
                                    <table width="100%">
                                        <tr>
                                            <td colspan="2">IV - Other Cost(Rs)</td>
                                        </tr>
                                        <tr>
                                            <td class="headerLabour" width="40px">Labor</td>
                                            <td class="headerLabour" width="35">Misc</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                    <div id="topPlaceHolder_progress" align="center" style="display: none;margin-top:50px; margin-bottom:20px;">
                        <i class="fa fa-spinner fa-spin" style="font-size:25px;"></i>
                        <span style="padding-left:5px; padding-top:5px;">Loading Products...</span>
                    </div>
                    <div id="no_more" align="center" style="display: none;margin-top:50px; margin-bottom:20px;">
                        <span style="padding-left:5px; padding-top:5px;color:red">No Products To Load...</span>
                    </div>
                </div><!-- table-responsive -->
            </div>
        </div>
        <?php
    }
    ?>
</div><!-- contentpanel -->

<input type="hidden" id="prod_count" value="<?php echo $totalcount; ?>" />

<script type="text/javascript">
    $(document).ready(function() {
        //$('.liquid').liquidcarousel({height: 90, duration: 300, hidearrows: false});
        $('body').on('click', '.prod_active', function(e) {
            e.preventDefault();
            var reqData = {
                prod_id: $(this).data('id'),
                status: $(this).attr('data-status')
            };
            ajaxCallCommonReqWithRef('admin/prod_activate', reqData, 'prod_activate', $(this));
        });
        // Basic Slider
        jQuery('#slider').slider({
            range: "min",
            max: 100,
            value: 50
        });

        // Chosen Select
        jQuery(".chosen-select").chosen({'width': '100%', 'white-space': 'nowrap'});

        jQuery('.menutoggle').trigger('click');
        

    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
<?php
$search_results = isset($search_results) ? $search_results : '';

if ($search_results != '') {
    $searchArr = explode(';', $search_results);
    foreach ($searchArr as $search) {
        $fieldArr = explode('=', $search);
        echo '$("[name=\'' . $fieldArr[0] . '\']").val("' . $fieldArr[1] . '");';
    }
}
?>
    });
</script>

<script type='text/javascript'>//<![CDATA[ 
    var isScrolling = false;
    var pageIndex = 0;
    var no_more = false;
    $(function() {
        $('#submit').on('click', function(e) {
            e.preventDefault();
            resetFields();
            loadProducts();
            showBreadCrumb();
        });
    });//]]>  

    function showBreadCrumb() {
        var str = '';
        jQuery("#collapseOne2, #collapseTwo2").find(':input').each(function() {
            switch (this.type) {
                case 'text':
                    if (jQuery(this).val() != '') {
                        var val = jQuery(this).val();
                        var name = jQuery(this).attr('name');
                        str += '<div class="tagl-item bbx nosel tagl-select" id="bread_' + name + '"><div class="tagl-text bbx">' + val + '</div><div class="tagl-x bbx" onclick="removeBreadCrumbItem(\'' + name + '\')">x</div></div>';
                    }
                    break;
                case 'select-one':
                    if (jQuery(this).val() != '') {
                        var label = jQuery(this).parent().parent().find('label').text();
                        var text = $("option:selected", $(this)).text();
                        var name = jQuery(this).attr('name');
                        str += '<div class="tagl-item bbx nosel tagl-select" id="bread_' + name + '"><div class="tagl-text bbx">' + label + " : " + text + '</div><div class="tagl-x bbx" onclick="removeBreadCrumbItem(\'' + name + '\')">x</div></div>';
                    }
                    break;
            }
        });

        if (str != '') {
            $('#breadcrumb_det').html(str);
            $('#breadcrumb-trail').show();
        } else {
            $('#breadcrumb-trail').hide();
        }
    }

    function removeBreadCrumbItem(name) {
        $('[name="' + name + '"]').val('');
        $('#bread_' + name).hide();
        resetFields();
        loadProducts();
        if ($('#breadcrumb_det').innerWidth() == 0) {
            $('#breadcrumb-trail').hide();
        }
    }

    function resetFields() {
        pageIndex = 0;
        no_more = false;
        $('.my_table > tbody').empty();
    }


    function loadProducts() {
        isScrolling = true;
        var reqData = $('form').serialize();
        reqData += "&page=" + pageIndex;
        $('#topPlaceHolder_progress').show();
        $.ajax({
            type: 'POST',
            url: 'admin/ajax/load_products',
            dataType: 'html',
            data: reqData,
            success: function(data) {
                if (data !== '') {
                    $('.my_table > tbody').append(data);
                    $('#topPlaceHolder_progress').hide();
                    var prod_count = parseInt($('#prod_count').val()); //12
                    var limit = 10;
                    var cur_count = (pageIndex * limit);
                    if (prod_count - 1 > cur_count) {
                        pageIndex++;
                    } else {
                        $('#no_more').show();
                        setTimeout(function() {
                            $('#no_more').fadeOut('slow');
                        }, 3000);
                        no_more = true;
                    }
                    $('#search_count').text(prod_count);
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                alert(errorThrown);
            }
        });
    }
    loadProducts('');
</script>

<script type='text/javascript'>//<![CDATA[ 
    $(window).load(function() {
//$( "body" ).on('click', '.a', addElement);
        $('body').on('click', '.accordion', function(e) {
            e.preventDefault();
            var prod_id = $(this).data('id');
            if (!$('#inner_dets_' + prod_id).is(':visible')) {
                $(this).find('i').addClass('fa-minus-square-o');
                $(this).find('i').removeClass('fa-plus-square-o');
                $('#inner_dets_' + prod_id).removeClass('hide');
            } else {
                $(this).find('i').addClass('fa-plus-square-o');
                $(this).find('i').removeClass('fa-minus-square-o');
                $('#inner_dets_' + prod_id).addClass('hide');
            }

        });

    });//]]>  

</script>

<script type="text/javascript">
    $(document).ajaxSuccess(function() {
        isScrolling = false;
        $("#topPlaceHolder_progress").hide();
    });

    $(window).scroll(function() {
        //alert(isScrolling);
        if ($(document).height() <= $(window).scrollTop() + $(window).height()) {
            if (!isScrolling && !no_more) {
                loadProducts();
            }
        }
    });
</script>
