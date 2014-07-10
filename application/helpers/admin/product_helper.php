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

function getSubColorStonedTypes() {
    $CI = & get_instance();
    $val = $CI->input->post('selVal');
    $c_stone_type_arr = $CI->c_stone_category();
    $str = '';
    foreach ($c_stone_type_arr as $c_stone_type) {
        if ($val == $c_stone_type->COMP_TYPE_ID) {
            $str .= $c_stone_type->C_STONE_CAT_ID . '#' . $c_stone_type->C_STONE_CAT_NAME . '@';
        }
    }
    json_output(array(
        'error' => false,
        'msg' => substr($str, 0, strlen($str) - 1)
    ));
}

function addProdUI() {
    $CI = & get_instance();
    $data = getAdminCommonData();
    $data['component'] = $CI->component();
    $data['category_opt'] = cat_opt($CI->category());
    $data['prod_type_opt'] = prod_type_opt($CI->prod_type());
    $data['price_type_opt'] = price_type_opt($CI->price_type());
    $data['sub_com_data'] = getDBComponentData();
    $data['title'] = 'Add Product';
    loadAdminView('product/add_prod', $data);
}

function createProduct() {
    $CI = & get_instance();
    $arr = array(
        'MF_USER_ID' => ses_data('user_id'),
        'DATE_CREATED' => date('Y-m-d H:i:s')
    );
    $prodArr = getProdFormArray();
    $prod_id = $CI->Product_model->add_prod(array_merge($arr, $prodArr));
    addProdHistory(\models\DBConstants::MF_PROD_SUMMARY, $prod_id, $prodArr, 0, true);
    defineComponents($prod_id);
    return $prod_id;
}

function defineComponents($prod_id) {
    $CI = & get_instance();
    if ($prod_id) {
        $total_price = 0;
        for ($i = 1; $i <= $CI->input->post('comp_count'); $i++) {
            $comp_id = $CI->input->post('sel_comp_id_' . $i);
            $p_comp_id = insertComponent($prod_id, $comp_id, $i);
            if ($p_comp_id) {
                $price = addComponent($prod_id, $comp_id, $p_comp_id, $i);
                $total_price += ($price != '' ? $price : 0);
            }
        }
        updateTotalPrice($prod_id, $total_price);
    }
}

function insertComponent($prod_id, $comp_id, $i) {
    $CI = & get_instance();
    return $CI->Product_model->add_prod_comp(array(
                'COMP_ID' => $comp_id,
                'PROD_ID' => $prod_id,
                'COMP_TYPE_ID' => $CI->input->post('sel_comp_id_' . $comp_id . '_' . $i),
                'COMP_TABLE' => $CI->input->post('sel_comp_type_' . $i),
    ));
}

function updateTotalPrice($prod_id, $total_price) {
    $CI = & get_instance();
    if ($CI->input->post('price_type') == 3 && $total_price > 0) {
        $total_price += addOtherPricingDetails($prod_id);
        $CI->Product_model->update_prod(array('MF_TOTAL_PRICE' => $total_price), $prod_id);
    }
}

function addOtherPricingDetails($prod_id) {
    $CI = & get_instance();
    $count = $CI->input->post('comp_count');
    $vat = $CI->input->post('price_' . ($count + 1));
    $ship_charges = $CI->input->post('price_' . ($count + 2));

    $CI->Product_model->insert_record(models\DBConstants::MF_PROD_OTHER_CHARGES, array(
        'PROD_ID' => $prod_id,
        'VAT_PRICE' => $vat,
        'SHIP_CHARGES' => $ship_charges
    ));
    $total = ($vat + $ship_charges);
    return $total;
}

function addComponent($prod_id, $comp_id, $p_comp_id, $cur_row) {
    $price = 0;
    switch ($comp_id) {
        case 1:
            $price = createComponent($prod_id, $p_comp_id, $cur_row, models\DBConstants::MF_PROD_METAL);
            break;
        case 2:
            $price = createComponent($prod_id, $p_comp_id, $cur_row, models\DBConstants::MF_PROD_STONE);
            break;
        case 3:
            $price = createComponent($prod_id, $p_comp_id, $cur_row, models\DBConstants::MF_PROD_COLORED_STONE);
            break;
        case 4:
            $price = createComponent($prod_id, $p_comp_id, $cur_row, models\DBConstants::MF_PROD_LABOR);
            break;
    }
    return $price;
}

function createComponent($prod_id, $p_comp_id, $cur_row, $table) {
    $CI = & get_instance();
    $price = $CI->input->post('price_' . $cur_row);
    $arr = array(
        'PROD_ID' => $prod_id,
        'P_COMP_ID' => $p_comp_id,
        'MF_PRICE' => $price,
        'BASE_RATE' => $CI->input->post('base_cost_' . $cur_row)
    );

    if ($table === models\DBConstants::MF_PROD_LABOR) {
        $arr = array_merge(array('PRICE_TYPE' => $CI->input->post('labour_price_type_' . $cur_row)), $arr);
    }

    insertCompIntoDB($arr, $cur_row, $table);
    return $price;
}

function insertCompIntoDB($arr, $cur_row, $table) {
    $CI = & get_instance();
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
    if ($CI->input->post()) {
        updateProdPost($prod_id);
    } else {
        updateProdUI($prod_id);
    }
}

function updateProdUI($prod_id) {
    $CI = & get_instance();
    $data = getAdminCommonData();
    $prod_sum_det = $CI->Product_model->product_details($prod_id);
    $mf_prod_component = $CI->Product_model->mf_prod_component($prod_id);

    $data['component'] = $CI->component();
    $data['category_opt'] = cat_opt($CI->category(), $prod_sum_det->CAT_ID);
    $data['prod_type_opt'] = prod_type_opt($CI->prod_type(), $prod_sum_det->PROD_TYPE_ID);
    $data['price_type_opt'] = price_type_opt($CI->price_type(), $prod_sum_det->PRICE_TYPE_ID);
    $data['sub_com_data'] = getDBComponentData();
    $data['prod_data'] = array(
        'prod_sum_det' => $prod_sum_det,
        'prod_comp_data' => get_prod_comp_data($mf_prod_component, $prod_id),
        'prod_component' => $mf_prod_component,
        'prod_other_charges' => $CI->Product_model->mf_prod_other_charges($prod_id),
        'prod_history' => $CI->Product_model->getUnApproveProdHistory($prod_id)
    );
    $data['title'] = $prod_sum_det->PROD_NAME;
    loadAdminView('product/edit_prod', $data);
}

function get_prod_comp_data($mf_prod_component, $prod_id) {
    $CI = & get_instance();
    $comp_arr = array();
    foreach ($mf_prod_component as $arr) {
        $comp_data = $CI->Product_model->get_comp_data($prod_id, $arr->P_COMP_ID, $arr->COMP_CODE);
        $comp_arr['comp_data_' . $arr->P_COMP_ID] = build_prod_comp_data($comp_data, $arr->COMP_CODE);
        $comp_arr['comp_details_' . $arr->P_COMP_ID] = build_prod_comp_details($comp_data, $arr->COMP_CODE);
        $comp_arr['comp_price_' . $arr->P_COMP_ID] = $comp_data->MF_PRICE;
        $comp_arr['comp_base_rate_' . $arr->P_COMP_ID] = $comp_data->BASE_RATE;
        if ($arr->COMP_CODE == 'labor') {
            $comp_arr['comp_price_type_' . $arr->P_COMP_ID] = $comp_data->PRICE_TYPE;
        }
    }
    return $comp_arr;
}

function build_prod_comp_data($comp_data, $type) {
    $str = '';
    if ($type === 'metal') {
        $str = 'COMP_TYPE_ID:' . $comp_data->COMP_TYPE_ID . ';' .
                'GROSS_WEIGHT:' . $comp_data->GROSS_WEIGHT . ';' .
                'IS_PRIM:' . $comp_data->IS_PRIM . ';' .
                'CARET:' . $comp_data->CARET;
    } else if ($type === 'diamond') {
        $str = 'CUT_ID:' . $comp_data->CUT_ID . ';' .
                'COMP_TYPE_ID:' . $comp_data->COMP_TYPE_ID . ';' .
                'TOTAL_STONES:' . $comp_data->TOTAL_STONES . ';' .
                'COLOR_FROM_ID:' . $comp_data->COLOR_FROM_ID . ';' .
                'COLOR_TO_ID:' . $comp_data->COLOR_TO_ID . ';' .
                'CLARITY_FROM_ID:' . $comp_data->CLARITY_FROM_ID . ';' .
                'CLARITY_TO_ID:' . $comp_data->CLARITY_TO_ID . ';' .
                'SHAPE_ID:' . $comp_data->SHAPE_ID . ';' .
                'GROSS_WEIGHT:' . $comp_data->GROSS_WEIGHT . ';' .
                'FLU_ID:' . $comp_data->FLU_ID . ';' .
                'PLAC_ID:' . $comp_data->PLAC_ID . ';';

        $str .= otherDiamondData($comp_data);
    } else if ($type === 'colored_stone') {
        $str = 'COMP_TYPE_ID:' . $comp_data->COMP_TYPE_ID . ';' .
                'C_STONE_CAT_ID:' . $comp_data->C_STONE_CAT_ID . ';' .
                'C_STONE_COL_ID:' . $comp_data->C_STONE_COL_ID . ';' .
                'TOTAL_STONES:' . $comp_data->TOTAL_STONES . ';' .
                'GROSS_WEIGHT:' . $comp_data->GROSS_WEIGHT . ';' .
                'SHAPE_ID:' . $comp_data->SHAPE_ID . ';' .
                'CUT_ID:' . $comp_data->CUT_ID . ';' .
                'SIZE_FROM:' . $comp_data->SIZE_FROM . ';' .
                'SIZE_TO:' . $comp_data->SIZE_TO . ';' .
                'PLAC_ID:' . $comp_data->PLAC_ID;
    }
    return $str;
}

function otherDiamondData($comp_data) {
    $str = 'SIZE_ID:' . $comp_data->SIZE_ID . ';' .
            'SIZE_FROM:' . $comp_data->SIZE_FROM . ';' .
            'SIZE_TO:' . $comp_data->SIZE_TO;
    return $str;
}

function build_prod_comp_details($comp_data, $type) {
    $str = '';
    if ($type === 'metal') {
        $str = 'Gross Weight : ' . $comp_data->GROSS_WEIGHT . '<br>' .
                'Prim : ' . ($comp_data->IS_PRIM ? 'Primary' : 'Secondary') . '<br>' .
                'Caret/Purity : ' . $comp_data->CARET;
    } else if ($type === 'diamond') {
        $str = 'Cut : ' . $comp_data->CUT_ID . '<br>' .
                'Type : ' . $comp_data->COMP_TYPE_ID . '<br>' .
                'No. of Stones : ' . $comp_data->TOTAL_STONES . '<br>' .
                'Color From : ' . $comp_data->COLOR_FROM_ID . '<br>' .
                'Color To : ' . $comp_data->COLOR_TO_ID . '<br>' .
                'Clarity From : ' . $comp_data->CLARITY_FROM_ID . '<br>' .
                'Clarity To : ' . $comp_data->CLARITY_TO_ID . '<br>' .
                'Shape : ' . $comp_data->SHAPE_ID . '<br>' .
                'Gross Weight:' . $comp_data->GROSS_WEIGHT . '<br>' .
                'Fluorescence:' . $comp_data->FLU_ID . '<br>' .
                'Placement:' . $comp_data->PLAC_ID . '<br>';

        $str .= otherDiamondDetails($comp_data);
    } else if ($type === 'colored_stone') {
        $str = 'Type : ' . $comp_data->COMP_TYPE_ID . '<br>' .
                'Category : ' . $comp_data->C_STONE_CAT_ID . '<br>' .
                'Color : ' . $comp_data->C_STONE_COL_ID . '<br>' .
                'Shape : ' . $comp_data->SHAPE_ID . '<br>' .
                'Cut : ' . $comp_data->CUT_ID . '<br>' .
                'No. of Stones : ' . $comp_data->TOTAL_STONES . '<br>' .
                'Gross Weight : ' . $comp_data->GROSS_WEIGHT . '<br>' .
                'MM size from : ' . $comp_data->SIZE_FROM . '<br>' .
                'MM Size to : ' . $comp_data->SIZE_TO . '<br>' .
                'Placement : ' . $comp_data->PLAC_ID;
    }
    return $str;
}

function otherDiamondDetails($comp_data) {
    $str = '';
    if ($comp_data->SHAPE_ID === '1') {
        $str .= 'Size : ' . $comp_data->SHAPE_ID . '<br>';
    }

    if ($comp_data->SIZE_ID === '1') {
        $str .= 'SEIVE size from : ' . $comp_data->SIZE_FROM . '<br>' .
                'SEIVE Size to : ' . $comp_data->SIZE_TO;
    } else {
        $str .= 'MM size from : ' . $comp_data->SIZE_FROM .
                'MM Size to : ' . $comp_data->SIZE_TO;
    }
    return $str;
}

function updateProdPost($prod_id) {
    $CI = & get_instance();
    $arr = getProdFormArray();
    $ver_id = getRandomDigit(6);
    $diffArr = getProdDiffData(\models\DBConstants::MF_PROD_SUMMARY, $prod_id, $arr);
    addProdHistory(\models\DBConstants::MF_PROD_SUMMARY, $prod_id, $diffArr, $ver_id);
    $CI->Product_model->clear_comp_dets($prod_id);
    defineComponents($prod_id);
    $res['error'] = false;
    $res['message'] = 'Product details saved.';
    json_output($res);
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
        'HALLMARK' => ($CI->input->post('prod_hallmark') == 'on' ? 1 : 0),
        'STOCK' => $CI->input->post('prod_stock'),
        'PROD_SIZE' => $CI->input->post('prod_size'),
        'DAYS_30_RET' => ($CI->input->post('days_ret_30') == 'on' ? 1 : 0),
        'REF_100_PER' => ($CI->input->post('ret_100') == 'on' ? 1 : 0),
        'FREE_SHIP' => ($CI->input->post('free_ship') == 'on' ? 1 : 0),
        'LIFE_TIME_RET' => ($CI->input->post('life_time_ret') == 'on' ? 1 : 0),
        'FREE_RET' => ($CI->input->post('free_ret') == 'on' ? 1 : 0),
        'PAYMENT' => ($CI->input->post('payment') == 'on' ? 1 : 0)
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
    loadAdminView('product/view_all', $data);
}

function buildProdDetails() {
    $CI = & get_instance();
    $where = 'a.MF_USER_ID=' . ses_data('user_id');
    $prod_res_arr = $CI->Product_model->get_products($where);
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

function getProdSummDiff($type, $newArr, $prod_id) {
    $CI = & get_instance();
    $arr = $CI->Product_model->product_details($prod_id);
    $diffArr = array_diff_assoc($newArr, stdToArray($arr));
    return unsetArrByKeys($diffArr, getSkipProdKeys($type));
}

function addProdHistory($table, $prod_id, $arr, $ver_id, $status = 0) {
    $CI = & get_instance();
    $str = http_build_query($arr, '', ',');

    return $CI->Product_model->add_prod_history(array(
                'PROD_ID' => $prod_id,
                'USER_ID' => ses_data('user_id'),
                'TABLE' => $table,
                'TYPE' => getSourceType($table),
                'DATA' => $str,
                'SUMMARY' => getProdHistorySummary($arr, $table),
                'VERSION_ID' => $ver_id,
                'PH_STATUS' => $status
    ));
}

function getProdDiffData($type, $prod_id, $newArr) {
    if ($type == \models\DBConstants::MF_PROD_SUMMARY) {
        $diffArr = getProdSummDiff($type, $newArr, $prod_id);
    }
    return $diffArr;
}

function getProdHistorySummary($diffArr, $type) {
    $str = '';
    if ($type == \models\DBConstants::MF_PROD_SUMMARY) {
        $prodColDesp = getProdColDesp();
        foreach ($diffArr as $key => $val) {
            $str .= $prodColDesp[$key] . ' = ' . $val . ';';
        }
    }
    return substr($str, 0, strlen($str) - 1);
}

function getSkipProdKeys($type) {
    if ($type == \models\DBConstants::MF_PROD_SUMMARY) {
        return array('PROD_ID', 'MF_USER_ID', 'PROD_DEF_THUMB', 'PROD_THUMBS', 'MF_TOTAL_PRICE', 'PROD_IMAGES', 'DATE_CREATED', 'PROD_STATUS');
    }
}

function getProdColDesp() {
    return array(
        'CAT_ID' => 'Category',
        'PROD_NAME' => 'Product Name',
        'PROD_SHORT_DESC' => 'Short Desp',
        'PROD_DESC' => 'Description',
        'MF_TOTAL_PRICE' => 'Total Price',
        'DISCOUNT' => 'Discount',
        'PROD_TYPE_ID' => 'Product Type',
        'PRICE_TYPE_ID' => 'Price Type',
        'PROD_DEF_THUMB' => 'Default Product Image',
        'PROD_THUMBS' => 'Added Image',
        'PROD_TAGS' => 'Tag',
        'CERTIFICATE' => 'Certificate',
        'HALLMARK' => 'Hallmark',
        'STOCK' => 'Stock',
        'PROD_SIZE' => 'Product Size',
        'DAYS_30_RET' => '30 Days return',
        'REF_100_PER' => '100% return',
        'FREE_SHIP' => 'Free Shipping',
        'LIFE_TIME_RET' => 'Life time returns',
        'FREE_RET' => 'Free returns',
        'PAYMENT' => 'Payment',
        'PROD_STATUS' => 'Status',
    );
}

function getSourceType($table) {
    $arr = sourecTypeTableArr();
    return $arr[$table];
}

function sourecTypeTableArr() {
    return array(
        \models\DBConstants::MF_PROD_SUMMARY => 'Product Summary',
        \models\DBConstants::MF_PROD_COMPONENT => 'Component Details',
        \models\DBConstants::MF_PROD_METAL => 'Metal Details',
        \models\DBConstants::MF_PROD_STONE => 'Diamond Details',
        \models\DBConstants::MF_PROD_COLORED_STONE => 'Colored Stone Details',
        \models\DBConstants::MF_PROD_LABOR => 'Labor Details',
        \models\DBConstants::MF_PROD_OTHER_CHARGES => 'Other Price Details',
    );
}
