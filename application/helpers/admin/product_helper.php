<?php

function addProd() {
    $CI = & get_instance();
    unses_set('prod_id');
    if ($CI->input->post()) {
        $prod_id = createProduct();
        ses_data('prod_id', $prod_id);
        if ($prod_id) {
            $res['error'] = false;
            $res['prod_id'] = $prod_id;
        } else {
            $res['error'] = true;
            $res['message'] = $CI->db->_error_message();
        }
        json_output($res);
    } else {
        addProdUI();
    }
}

function addProdUI() {
    $CI = & get_instance();
    $data = getAdminCommonData();
    $data['component'] = $CI->component();
    $data['category_opt'] = cat_opt($CI->category());
    $data['prod_type_opt'] = prod_type_opt($CI->prod_type());
    $data['price_type_opt'] = price_type_opt($CI->price_type());
    $data['sub_com_data'] = array(
        'component_type' => $CI->component_type(),
        'stone_clarity' => $CI->stone_clarity(),
        'stone_color' => $CI->stone_color(),
        'stone_cut' => $CI->stone_cut(),
        'stone_shape' => $CI->stone_shape(),
        'c_stone_type' => $CI->c_stone_type(),
        'c_stone_category' => $CI->c_stone_category(),
        'c_stone_color' => $CI->c_stone_color(),
    );
    $data['title'] = 'Add Product';
    adminLoadView('product/add_prod', $data);
}

function createProduct() {
    $CI = & get_instance();
    $arr = array(
        'MF_USER_ID' => ses_data('user_id'),
        'DATE_CREATED' => date('Y-m-d H:i:s')
    );
    $prod_id = $CI->Product_model->add_prod(array_merge($arr, getProdFormArray()));
    defineComponents($prod_id);
    return $prod_id;
}

function defineComponents($prod_id) {
    $CI = & get_instance();
    if ($prod_id) {
        $total_price = 0;
        for ($i = 1; $i <= $CI->input->post('comp_count'); $i++) {
            $comp_id = $CI->input->post('sel_comp_id_' . $i);
            $p_comp_id = $CI->Product_model->add_prod_comp(array(
                'COMP_ID' => $comp_id,
                'PROD_ID' => $prod_id,
                'COMP_TYPE_ID' => $CI->input->post('sel_comp_id_' . $comp_id . '_' . $i),
                'COMP_TABLE' => $CI->input->post('sel_comp_type_' . $i),
            ));

            if ($p_comp_id) {
                addComponent($prod_id, $comp_id, $p_comp_id, $i);
                if ($CI->input->post('price_type') == 3) {
                    $price = $CI->input->post('price_' . $i);
                    $total_price += ($price != '' ? $price : 0);
                    if ($total_price > 0) {
                        $CI->Product_model->update_prod(array('MF_TOTAL_PRICE' => $total_price), $prod_id);
                    }
                }
            }
        }
    }
}

function addComponent($prod_id, $comp_id, $p_comp_id, $cur_row) {
    switch ($comp_id) {
        case 1:
            createComponent($prod_id, $p_comp_id, $cur_row, models\DBConstants::MF_PROD_METAL);
            break;
        case 2:
            createComponent($prod_id, $p_comp_id, $cur_row, models\DBConstants::MF_PROD_STONE);
            break;
        case 3:
            createComponent($prod_id, $p_comp_id, $cur_row, models\DBConstants::MF_PROD_COLORED_STONE);
            break;
        case 4:
            createComponent($prod_id, $p_comp_id, $cur_row, models\DBConstants::MF_PROD_LABOR);
            break;
    }
}

function createComponent($prod_id, $p_comp_id, $cur_row, $table) {
    $CI = & get_instance();
    $arr = array(
        'PROD_ID' => $prod_id,
        'P_COMP_ID' => $p_comp_id,
        'MF_PRICE' => $CI->input->post('price_' . $cur_row),
        'BASE_RATE' => $CI->input->post('base_cost_' . $cur_row)
    );

    $data = $CI->input->post('data_' . $cur_row);
    if ($data != '') {
        $dataArr = explode(';', $data);
        foreach ($dataArr as $data) {
            $subDataArr = explode(':', $data);
            $arr[$subDataArr[0]] = $subDataArr[1];
        }
    }
    $CI->Product_model->insert_record($table, $arr);
}

function updateProd($prod_id) {
    $CI = & get_instance();
    $flag = $CI->Product_model->update_prod(getProdFormArray(), $prod_id);

    if ($flag) {
        $CI->Product_model->clear_comp_dets($prod_id);
        defineComponents($prod_id);
        $res['error'] = false;
        $res['message'] = 'Product details saved.';
        json_output($res);
    }
}

function getProdFormArray() {
    $CI = & get_instance();
    return array(
        'CAT_ID' => $CI->input->post('category'),
        'PROD_NAME' => $CI->input->post('prod_name'),
        'PROD_SHORT_DESC' => $CI->input->post('prod_short_desc'),
        'PROD_DESC' => $CI->input->post('prod_desc'),
        'PROD_TAGS' => $CI->input->post('prod_tags'),
        'MF_TOTAL_PRICE' => $CI->input->post('prod_price'),
        'DISCOUNT' => $CI->input->post('prod_dis'),
        'PROD_TYPE_ID' => $CI->input->post('prod_type'),
        'PRICE_TYPE_ID' => $CI->input->post('price_type'),
        'CERTIFICATE' => $CI->input->post('prod_cert'),
        'HALLMARK' => $CI->input->post('prod_hallmark'),
        'STOCK' => $CI->input->post('prod_stock'),
        'PROD_SIZE' => $CI->input->post('prod_size'),
        'DAYS_30_RET' => ($CI->input->post('days_ret_30') == 'on'),
        'REF_100_PER' => ($CI->input->post('ret_100') == 'on'),
        'FREE_SHIP' => ($CI->input->post('free_ship') == 'on'),
        'LIFE_TIME_RET' => ($CI->input->post('life_time_ret') == 'on'),
        'FREE_RET' => ($CI->input->post('free_ret') == 'on'),
        'PAYMENT' => ($CI->input->post('payment') == 'on')
    );
}

function viewAllProducts() {
    $CI = & get_instance();
    $data = getAdminCommonData();
    $data['title'] = 'Show All Products';
    $data['component_type'] = $CI->comp_types(1);
    $data['prod_dets'] = buildProdDetails();
    $data['category_opt'] = cat_opt($CI->category());
    $data['prod_type_opt'] = prod_type_opt($CI->prod_type());
    adminLoadView('product/view_all', $data);
}

function buildProdDetails() {
    $CI = & get_instance();
    $prod_res_arr = $CI->Product_model->get_products(ses_data('user_id'));
    $main_arr = array();
    foreach ($prod_res_arr as $prod_res) {
        $prod_id = $prod_res->PROD_ID;
        $arr = array();
        $arr['prod_summ'] = $prod_res;
        $arr['prod_comp'] = $CI->Product_model->prod_comp_dets($prod_id);
        $arr['metal_det'] = $CI->Product_model->prod_metal_dets($prod_id);
        $arr['stone_det'] = $CI->Product_model->prod_stone_dets($prod_id);
        $arr['colored_stone_det'] = $CI->Product_model->prod_colored_stone_dets($prod_id);
        $arr['labour_det'] = $CI->Product_model->prod_labour_dets($prod_id);
        $main_arr[$prod_id] = $arr;
    }
    return $main_arr;
}