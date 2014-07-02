<script type="text/javascript" src="js/jquery.liquidcarousel.js"></script>

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

    <div class="row">

        <div class="col-sm-3 col-md-2">
            <h4 class="subtitle mb5">Refine Results</h4>
            <input type="text" placeholder="Product Name" class="form-control">

            <div class="mb10"></div>

            <h4 class="subtitle mb5">Category</h4>
            <select name="category" class="form-control">
              <?php echo $category_opt; ?>      
            </select>

            <div class="mb10"></div>

            <h4 class="subtitle mb5">Type</h4>
            <select name="prod_type" class="form-control">
              <?php echo $prod_type_opt; ?>      
            </select>

            <div class="mb10"></div>

            <h4 class="subtitle mb5">File Type</h4>
            <ul class="nav nav-sr">
                <li><a href=""><i class="glyphicon glyphicon-file"></i> Documents</a></li>
                <li><a href="#"><i class="glyphicon glyphicon-picture"></i> Images</a></li>
                <li><a href="#"><i class="glyphicon glyphicon-facetime-video"></i> Videos</a></li>
                <li><a href="#"><i class="glyphicon glyphicon-music"></i> Audio</a></li>
            </ul>

            <div class="mb20"></div>

            <h4 class="subtitle mb5">Date Created</h4>
            <div class="input-group">
                <input type="text" class="form-control hasDatepicker" placeholder="mm/dd/yyyy" id="datepicker">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
            </div>

            <br>

        </div>

        <div class="col-sm-9 col-md-10">
            <div class="table-responsive" id="table_prod_grid">
                <table class="table table-success">
                    <thead>
                        <tr>
                            <th></th>
                            <th></th>
                            <th>Product Name<br>Product Type<br>Brand<br>Collection</th>
                            <th>
                                <?php
                                foreach ($component_type as $comp_type) {
                                    echo $comp_type->COMP_TYPE_NAME . ' Wt<br>';
                                }
                                ?>
                            </th>
                            <th>Diamond Wt<br>CS Wt</th>
                            <th>Certificate<br>Hallmark<br>Stock<br>Product Size</th>
                            <th>30 Day Rfnd<br>100 % Rfnd<br>Free Shippping<br>Lifetime Exchange</th>
                            <th>Free Returns<br>Payment options</th>
                            <th>
                                <?php
                                foreach ($component_type as $comp_type) {
                                    echo $comp_type->COMP_TYPE_NAME . ' Cost<br>';
                                }
                                
                                ?>
                            </th>
                            <th>Diam Cost<br>CS Cost<br>Labour Cost</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($prod_dets as $prod_arr) {
                            $prod_summ = $prod_arr['prod_summ'];
                            $prod_comp = $prod_arr['prod_comp'];
                            $metal_det = $prod_arr['metal_det'];
                            $stone_det = $prod_arr['stone_det'];
                            $colored_stone_det = $prod_arr['colored_stone_det'];
                            $labour_det = $prod_arr['labour_det'];
                            $is_stone = sizeof($stone_det) > 0;
                            $is_cs = sizeof($colored_stone_det) > 0;
                            $is_labour = sizeof($labour_det) > 0;
                            $prod_id = $prod_summ->PROD_ID;

                            $img_path = 'uploads/' . $ses_det['user_id'] . '/' . $prod_id . '/';
                            echo '<tr>';
                            echo '<td><a href="javascript:;" class="accordion" data-id="' . $prod_id . '"><i class="fa fa-plus-square-o" style="font-size:16px;"></i></a></td>';
                            echo '<td><img src="' . $img_path . $prod_summ->PROD_DEF_THUMB . '" style="width:60px;" /></td>';
                            echo '<td>' . $prod_summ->PROD_NAME . '<br>' . $prod_summ->PROD_TYPE_NAME . '<br>' . $prod_summ->CAT_NAME . '</td>';
                            echo '<td>';
                            $str = '';

                            $total_metal_weight = 0;
                            foreach ($component_type as $comp_type) {
                                foreach ($metal_det as $metal) {
                                    if ($metal->COMP_TYPE_ID == $comp_type->COMP_TYPE_ID) {
                                        $total_metal_weight += $metal->GROSS_WEIGHT;
                                        $str .= $metal->GROSS_WEIGHT;
                                    }
                                }
                                $str .= '<br>';
                            }
                            echo substr($str, 0, strlen($str) - 4);
                            echo '</td>';
                            $dia_wt = ($is_stone ? $stone_det[0]->GROSS_WEIGHT : 0);
                            $cs_wt = ($colored_stone_det ? $colored_stone_det[0]->GROSS_WEIGHT : 0);
                            $total_stone_weight = ($dia_wt + $cs_wt);
                            echo '<td>' . $dia_wt . '<br>' . $cs_wt . '</td>';
                            echo '<td>' . $prod_summ->CERTIFICATE . '<br>' . $prod_summ->HALLMARK . '<br>' . $prod_summ->STOCK . '<br>' . $prod_summ->PROD_SIZE . '</td>';
                            echo '<td>' .
                            ($prod_summ->DAYS_30_RET ? 'Yes' : 'No') . '<br>' .
                            ($prod_summ->REF_100_PER ? 'Yes' : 'No') . '<br>' .
                            ($prod_summ->FREE_SHIP ? 'Yes' : 'No') . '<br>' .
                            ($prod_summ->LIFE_TIME_RET ? 'Yes' : 'No') .
                            '</td>';
                            echo '<td>' .
                            ($prod_summ->FREE_RET ? 'Yes' : 'No') . '<br>' .
                            ($prod_summ->PAYMENT ? 'Yes' : 'No') .
                            '</td>';
                            echo '<td class="t_right">';
                            $str = '';
                            $total_cost = 0;
                            foreach ($component_type as $comp_type) {
                                foreach ($metal_det as $metal) {
                                    if ($metal->COMP_TYPE_ID == $comp_type->COMP_TYPE_ID) {
                                        $str .= number_format($metal->MF_PRICE, 2);
                                        $total_cost+=$metal->MF_PRICE;
                                    }
                                }
                                $str .= '<br>';
                            }
                            echo $str;
                            $dia_cost = ($is_stone ? $stone_det[0]->MF_PRICE : 0);
                            $cs_cost = ($is_cs ? $colored_stone_det[0]->MF_PRICE : 0);
                            $labour_cost = ($is_labour ? $labour_det[0]->MF_PRICE : 0);
                            $total_cost += ($dia_cost + $cs_cost + $labour_cost);
                            echo '</td>';
                            echo '<td class="t_right">'.number_format($dia_cost, 2) . '<br>' . number_format($cs_cost, 2) . '<br>' . number_format($labour_cost, 2).'</td>';
                            echo '</tr>';
                            echo '<tr class="table_price_footer">';
                            echo '<td></td>';
                            echo '<td></td>';
                            echo '<td></td>';
                            echo '<td>' . $total_metal_weight . '</td>';
                            echo '<td>' . $total_stone_weight . '</td>';
                            echo '<td></td>';
                            echo '<td></td>';
                            echo '<td></td>';
                            echo '<td colspan="2" class="t_right bold"><span style="font-weight:normal;">Total Price : </span> ' . number_format($total_cost>0 ? $total_cost : $prod_summ->MF_TOTAL_PRICE, 2) . '</td>';
                            echo '</tr>';
                            echo '<tr id="inner_dets_' . $prod_id . '" class="hide">';
                            ?>
                        <td colspan="3">
                            <div class="liquid" style="width:300px;">
                                <span class="previous"></span>
                                <div class="wrapper">
                                    <ul>
                                        <?php
                                        $imgArr = explode(';', $prod_summ->PROD_IMAGES);
                                        foreach ($imgArr as $img) {
                                            echo '<li><a href="' . ($img_path . $img) . '" class="example-image-link" data-lightbox="example-set-' . $prod_id . '"><img src="' . $img_path . 'thumb_' . $img . '" width="75"/></a></li>';
                                        }
                                        ?>	
                                    </ul>

                                </div>
                                <span class="next"></span>
                            </div>
                        </td>
                        <td colspan="7">
                            <table class="table table-no-border table-info">
                                <thead>
                                    <tr>
                                        <th>Dia pcs<br>Cs Pcs</th>
                                        <th>
                                            <?php
                                            foreach ($component_type as $comp_type) {
                                                echo $comp_type->COMP_TYPE_NAME . ' Base<br>';
                                            }
                                            ?>
                                        </th>
                                        <th>
                                            <?php
                                            foreach ($component_type as $comp_type) {
                                                echo $comp_type->COMP_TYPE_NAME . ' Rate<br>';
                                            }
                                            ?>
                                        </th>
                                        <th>Diam Rate<br>Diam Cost</th>
                                        <th>Cs Rate<br>CS Cost</th>
                                        <th>Labour Cost</th>
                                    </tr>
                                </thead>    

                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td>
                                            <?php
                                            $str = '';
                                            foreach ($component_type as $comp_type) {
                                                foreach ($metal_det as $metal) {
                                                    if ($metal->COMP_TYPE_ID == $comp_type->COMP_TYPE_ID) {
                                                        $str .= $metal->BASE_RATE;
                                                    }
                                                }
                                                $str .= '<br>';
                                            }
                                            echo $str;
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            $str = '';
                                            foreach ($component_type as $comp_type) {
                                                foreach ($metal_det as $metal) {
                                                    if ($metal->COMP_TYPE_ID == $comp_type->COMP_TYPE_ID) {
                                                        $str .= ($metal->MF_PRICE / $metal->GROSS_WEIGHT);
                                                    }
                                                }
                                                $str .= '<br>';
                                            }
                                            echo $str;
                                            ?>
                                        </td>
                                        <td>
                                            <?php echo ($is_stone ? $stone_det[0]->BASE_RATE : '') . '<br>'; ?>
                                            <?php echo ($is_stone ? ($dia_cost / $dia_wt) : ''); ?>
                                        </td>
                                        <td>
                                            <?php echo ($is_cs ? $colored_stone_det[0]->BASE_RATE : '') . '<br>'; ?>
                                            <?php echo ($is_cs ? ($cs_cost / $cs_wt) : ''); ?>
                                        </td>
                                        <td>
                                            <?php echo $labour_cost; ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        </td>

                        <?php
                        echo '</tr>';
                        echo '<tr><td colspan="10" style="background:#e4e7ea;"></td></tr>';
                    }
                    ?>
                    </tbody>
                </table>

                <div class="t_center hide" id="ajax_loading">
                    <img src="images/spinner.gif" /> Please wait...
                </div>
            </div><!-- table-responsive -->
        </div>


    </div>

</div><!-- contentpanel -->


<script type="text/javascript">

    $(document).ready(function() {
        $('.liquid').liquidcarousel({height: 90, duration: 300, hidearrows: false});

        $('.accordion').on('click', function(e) {
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

        // Basic Slider
        jQuery('#slider').slider({
            range: "min",
            max: 100,
            value: 50
        });

        // Chosen Select
        jQuery(".chosen-select").chosen({'width': '100%', 'white-space': 'nowrap'});

        // Date Picker
        jQuery('#datepicker').datepicker();

        hideLeftMenu();
    });

    function hideLeftMenu() {
        jQuery('body').addClass('leftpanel-collapsed');
        jQuery('.menutoggle').addClass('menu-collapsed');
    }

</script>
