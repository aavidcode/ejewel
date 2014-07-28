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
    $data['sub_comp_arr'] = $CI->component_type();
    $data['field_opt'] = getFieldDropDowns();
    $data['sub_com_data'] = getDBComponentData();
    $data['fields_data'] = getManfProductData();
    $data['title'] = 'Add Product';
    loadAdminView('product/add_prod', $data);
}

function getFieldDropDowns($arr = '') {
    return array(
        'category_opt' => get_opt(models\DBConstants::CATEGORY, ($arr != '' ? $arr['category_opt'] : '')),
        'prod_type_opt' => get_opt(models\DBConstants::PROD_TYPE, ($arr != '' ? $arr['prod_type_opt'] : '')),
        'price_type_opt' => get_opt(models\DBConstants::PRICE_TYPE, ($arr != '' ? $arr['price_type_opt'] : '')),
        'jewel_type_opt' => get_opt(models\DBConstants::JEWEL_TYPE, ($arr != '' ? $arr['jewel_type_opt'] : '')),
        'cert_opt' => get_opt(models\DBConstants::CERTIFICATION, ($arr != '' ? $arr['cert_opt'] : '')),
        'hallmark_opt' => get_opt(models\DBConstants::HALLMARK, ($arr != '' ? $arr['hallmark_opt'] : '')),
        'hallmark_center_opt' => get_opt(models\DBConstants::HALLMARK_CENTER, ($arr != '' ? $arr['hallmark_center_opt'] : '')),
    );
}

function createProduct() {
    $CI = & get_instance();
    $arr = array(
        'MF_USER_ID' => ses_data('user_id'),
        'DATE_CREATED' => date('Y-m-d H:i:s')
    );
    $prodArr = getProdFormArray();
    $prod_id = $CI->Product_model->add_prod(array_merge($arr, $prodArr));
    //addProdHistory(\models\DBConstants::MF_PROD_SUMMARY, $prod_id, $prodArr, 0, true);
    defineComponents($prod_id);
    return $prod_id;
}

function defineComponents($prod_id) {
    $CI = & get_instance();
    if ($prod_id) {
        $compArr = $CI->component();
        foreach ($compArr as $comp) {
            $type = $comp->COMP_CODE;
            $count = $CI->input->post($type . '_count');
            if ($count > 0) {
                for ($i = 1; $i <= $count; $i++) {
                    $p_comp_id = insertComponent($prod_id, $comp->COMP_ID, $i, $type);
                    if ($p_comp_id) {
                        addComponent($prod_id, $comp->COMP_ID, $p_comp_id, $i, $type);
                    }
                }
            }
        }
        addOtherPricingDetails($prod_id);
    }
}

function addOtherPricingDetails($prod_id) {
    addLabourDetails($prod_id);
    addVat($prod_id);
    addMiscPricingDetails($prod_id);
}

function addLabourDetails($prod_id) {
    $CI = & get_instance();
    $CI->Product_model->insert_record(models\DBConstants::MF_PROD_LABOR, array(
        'PROD_ID' => $prod_id,
        'PRICE_TYPE' => $CI->input->post('labour_price_type'),
        'BASE_RATE' => $CI->input->post('labour_base_cost'),
        'MF_PRICE' => $CI->input->post('labour_price'),
    ));
}

function addVat($prod_id) {
    $CI = & get_instance();
    $CI->Product_model->insert_record(models\DBConstants::MF_PROD_OTHER_CHARGES, array(
        'PROD_ID' => $prod_id,
        'TYPE' => 'VAT',
        'PRICE' => $CI->input->post('vat_cost')
    ));
}

function addMiscPricingDetails($prod_id) {
    $CI = & get_instance();
    $count = $CI->input->post('misc_count');
    for ($i = 1; $i <= $count; $i++) {
        $CI->Product_model->insert_record(models\DBConstants::MF_PROD_OTHER_CHARGES, array(
            'PROD_ID' => $prod_id,
            'TYPE' => $CI->input->post('misc_desc_' . $i),
            'PRICE' => $CI->input->post('misc_price_' . $i)
        ));
    }
}

function insertComponent($prod_id, $comp_id, $i, $type) {
    $CI = & get_instance();
    $data = $CI->input->post($type . '_data_' . $i);
    return $CI->Product_model->add_prod_comp(array(
                'COMP_ID' => $comp_id,
                'PROD_ID' => $prod_id,
                'COMP_TYPE_ID' => getCompTypeId($data),
                'COMP_TABLE' => $type,
    ));
}

function getCompTypeId($data) {
    $arr = array();
    $dataArr = explode(';', $data);
    foreach ($dataArr as $data) {
        $subDataArr = explode(':', $data);
        $arr[$subDataArr[0]] = $subDataArr[1];
    }
    return $arr['COMP_TYPE_ID'];
}

function addComponent($prod_id, $comp_id, $p_comp_id, $cur_row, $type) {
    switch ($comp_id) {
        case 1:
            createComponent($prod_id, $p_comp_id, $cur_row, models\DBConstants::MF_PROD_METAL, $type);
            break;
        case 2:
            createComponent($prod_id, $p_comp_id, $cur_row, models\DBConstants::MF_PROD_STONE, $type);
            break;
        case 3:
            createComponent($prod_id, $p_comp_id, $cur_row, models\DBConstants::MF_PROD_COLORED_STONE, $type);
            break;
    }
}

function createComponent($prod_id, $p_comp_id, $cur_row, $table, $type) {
    $CI = & get_instance();
    $arr = array(
        'PROD_ID' => $prod_id,
        'P_COMP_ID' => $p_comp_id,
        'MF_PRICE' => $CI->input->post($type . '_price_' . $cur_row),
        'BASE_RATE' => $CI->input->post($type . '_base_cost_' . $cur_row)
    );

    if ($type == 'metal') {
        $arr['FACTOR'] = $CI->input->post('metal_factor_' . $cur_row);
    }
    insertCompIntoDB($arr, $cur_row, $table, $type);
}

function insertCompIntoDB($arr, $cur_row, $table, $type) {
    $CI = & get_instance();
    $data = $CI->input->post($type . '_data_' . $cur_row);
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
    if (sizeof($prod_sum_det) > 0) {
        $data['component'] = $CI->component();
        $data['field_opt'] = getFieldDropDowns(array(
            'category_opt' => $prod_sum_det->CAT_ID,
            'prod_type_opt' => $prod_sum_det->PROD_TYPE_ID,
            'price_type_opt' => $prod_sum_det->PRICE_TYPE_ID,
            'jewel_type_opt' => $prod_sum_det->JEWEL_TYPE,
            'cert_opt' => $prod_sum_det->CERTIFICATE,
            'hallmark_opt' => $prod_sum_det->HALLMARK,
            'hallmark_center_opt' => $prod_sum_det->HALLMARK_CENTER,
        ));
        $data['sub_com_data'] = getDBComponentData();
        $data['fields_data'] = getManfProductData();
        $data['prod_data'] = array(
            'prod_sum_det' => $prod_sum_det,
            'metal' => get_prod_comp_data($prod_id, 'metal'),
            'stone' => get_prod_comp_data($prod_id, 'stone'),
            'colored_stone' => get_prod_comp_data($prod_id, 'colored_stone'),
            'labour' => $CI->Product_model->prod_labour_dets($prod_id),
            'other_charges' => $CI->Product_model->mf_prod_other_charges($prod_id),
            'prod_history' => $CI->Product_model->getUnApproveProdHistory($prod_id)
        );
        $data['title'] = $prod_sum_det->PROD_NAME;
    } else {
        $data['title'] = "No Product";
    }
    loadAdminView('product/edit_prod', $data);
}

function get_prod_comp_data($prod_id, $type) {
    $CI = & get_instance();
    $comp_data = null;
    if ($type == 'metal') {
        $comp_data = $CI->Product_model->prod_metal_dets($prod_id);
    } else if ($type == 'stone') {
        $comp_data = $CI->Product_model->prod_stone_dets($prod_id);
    } else if ($type == 'colored_stone') {
        $comp_data = $CI->Product_model->prod_colored_stone_dets($prod_id);
    }

    $count = 0;
    foreach ($comp_data as $comp) {
        $arr['col_data_' . $count] = build_prod_comp_data($comp, $type);
        $arr['det_data_' . $count] = build_prod_comp_details($comp, $type);
        $count++;
    }
    $arr['count'] = sizeof($comp_data);
    return $arr;
}

function build_prod_comp_data($comp_data, $type) {
    $str = '';
    if ($type === 'metal') {
        $str = 'COMP_TYPE_ID:' . $comp_data->COMP_TYPE_ID . ';' .
                'GROSS_WEIGHT:' . $comp_data->GROSS_WEIGHT . ';' .
                'IS_PRIM:' . $comp_data->IS_PRIM . ';' .
                'TYPE:' . $comp_data->TYPE . ';' .
                'METAL_COLOR:' . $comp_data->METAL_COLOR . ';' .
                'VALUE:' . $comp_data->VALUE;
    } else if ($type === 'stone') {
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
                'PLAC_ID:' . $comp_data->PLAC_ID . ';' .
                'SET_ID:' . $comp_data->SET_ID . ';' .
                'SIZE_ID:' . $comp_data->SHAPE_ID . ';' .
                'SEIV_SIZE_FROM:' . $comp_data->SEIV_SIZE_FROM . ';' .
                'SEIV_SIZE_TO:' . $comp_data->SEIV_SIZE_TO . ';' .
                'SIZE_FROM:' . $comp_data->SIZE_FROM . ';' .
                'SIZE_TO:' . $comp_data->SIZE_TO;
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
                'PLAC_ID:' . $comp_data->PLAC_ID . ';' .
                'SET_ID:' . $comp_data->SET_ID;
    }
    return $str;
}

function build_prod_comp_details($comp_data, $type) {
    $str = '';
    if ($type === 'metal') {
        $str = 'IS_PRIM:' . $comp_data->IS_PRIM . ';' .
                'COMP_TYPE_ID:' . $comp_data->COMP_TYPE_NAME . ';' .
                'METAL_COLOR:' . $comp_data->METAL_COLOR . ';' .
                'TYPE:' . ($comp_data->TYPE == 1 ? 'Karat' : 'Purity') . ';' .
                'VALUE:' . $comp_data->VALUE . ';' .
                'FACTOR:' . $comp_data->FACTOR . ';';
    } else if ($type === 'stone') {
        $str = 'CUT_ID:' . $comp_data->CUT_NAME . ';' .
                'COMP_TYPE_ID:' . $comp_data->COMP_TYPE_NAME . ';' .
                'TOTAL_STONES:' . $comp_data->TOTAL_STONES . ';' .
                'COLOR_FROM_ID:' . $comp_data->color_from_name . ';' .
                'COLOR_TO_ID:' . $comp_data->color_to_name . ';' .
                'CLARITY_FROM_ID:' . $comp_data->clarity_from_name . ';' .
                'CLARITY_TO_ID:' . $comp_data->clarity_to_name . ';' .
                'SHAPE_ID:' . $comp_data->SHAPE_NAME . ';' .
                'FLU_ID:' . $comp_data->FLU_ID . ';' .
                'PLAC_ID:' . $comp_data->PLAC_NAME . ';' .
                'SET_ID:' . $comp_data->SET_ID . ';' .
                'SIZE:' . $comp_data->SHAPE_ID . ';' .
                'SEIV_SIZE_FROM:' . $comp_data->SEIV_SIZE_FROM . ';' .
                'SEIV_SIZE_TO:' . $comp_data->SEIV_SIZE_TO . ';' .
                'SIZE_FROM:' . $comp_data->SIZE_FROM . ';' .
                'SIZE_TO:' . $comp_data->SIZE_TO . ';';
    } else if ($type === 'colored_stone') {
        $str = 'COMP_TYPE_ID:' . $comp_data->COMP_TYPE_NAME . ';' .
                'C_STONE_CAT_ID:' . $comp_data->C_STONE_CAT_NAME . ';' .
                'C_STONE_COL_ID:' . $comp_data->C_STONE_COL_NAME . ';' .
                'SHAPE_ID:' . $comp_data->SHAPE_NAME . ';' .
                'CUT_ID:' . $comp_data->CUT_NAME . ';' .
                'TOTAL_STONES:' . $comp_data->TOTAL_STONES . ';' .
                'SIZE_FROM:' . $comp_data->SIZE_FROM . ';' .
                'SIZE_TO:' . $comp_data->SIZE_TO . ';' .
                'PLAC_ID:' . $comp_data->PLAC_NAME . ';' .
                'SET_ID:' . $comp_data->SET_ID . ';';
    }
    $str .= 'GROSS_WEIGHT:' . $comp_data->GROSS_WEIGHT . ';' .
            'BASE_RATE:' . $comp_data->BASE_RATE . ';' .
            'MF_PRICE:' . $comp_data->MF_PRICE . ';';
    return $str;
}

function updateProdPost($prod_id) {
    $CI = & get_instance();
    $arr = getProdFormArray();
    $ver_id = getRandomDigit(6);
    $diffArr = getProdDiffData(\models\DBConstants::MF_PROD_SUMMARY, $prod_id, $arr);
    addProdHistory(\models\DBConstants::MF_PROD_SUMMARY, $prod_id, $diffArr, $ver_id);
    if (isset($diffArr['MF_TOTAL_PRICE'])) {
        $CI->Product_model->clear_comp_dets($prod_id);
        defineComponents($prod_id);
    }
    $res['error'] = false;
    $res['message'] = 'Product details saved.';
    json_output($res);
}

function addOtherDataIntoDB($table, $type, $col) {
    $CI = & get_instance();
    $val = $CI->input->post($type);
    if ($val == '' || $val === 'others') {
        $val = $CI->input->post($type . '_txt');
        $user_id = ses_data('user_id');
        if (!$CI->Product_model->isOtherDataExists($table, $col, $val, $user_id)) {
            return $CI->Product_model->insert_record_get_id($table, array($col => $val, 'MF_USER_ID' => $user_id));
        }
    }
    return $val;
}

function getProdFormArray() {
    $CI = & get_instance();

    $col_name = addOtherDataIntoDB(models\DBConstants::COLLECTION_NAMES, 'col_name', 'CN_NAME');
    $brand = addOtherDataIntoDB(models\DBConstants::BRAND, 'brand', 'B_NAME');
    $designer = addOtherDataIntoDB(models\DBConstants::DESIGNER, 'designer', 'D_NAME');

    return array(
        'JEWEL_TYPE' => $CI->input->post('jewel_type'),
        'CAT_ID' => $CI->input->post('category'),
        'PROD_NAME' => $CI->input->post('prod_name'),
        'PROD_SHORT_DESC' => $CI->input->post('prod_short_desc'),
        'PROD_DESC' => $CI->input->post('prod_long_desc'),
        'PROD_TAGS' => $CI->input->post('prod_tags'),
        'DESIGN_NO' => $CI->input->post('design_no'),
        'STYLE_NO' => $CI->input->post('style_no'),
        'COLLECTION_NAME' => $col_name,
        'BARCODE' => $CI->input->post('bar_code'),
        'BRAND' => $brand,
        'SKU_NO' => $CI->input->post('sku_no'),
        'DESIGNER' => $designer,
        'DIMENSIONS' => ($CI->input->post('dim_from') . ' ' . $CI->input->post('dim_type') . ' ' . $CI->input->post('dim_to')),
        'MF_TOTAL_PRICE' => $CI->input->post('prod_price'),
        'DISCOUNT' => $CI->input->post('prod_dis'),
        'PROD_TYPE_ID' => $CI->input->post('prod_type'),
        'PRICE_TYPE_ID' => $CI->input->post('price_type'),
        'CERTIFICATE' => $CI->input->post('prod_cert'),
        'HALLMARK' => $CI->input->post('hallmark'),
        'STOCK' => $CI->input->post('prod_stock'),
        'PROD_SIZE' => $CI->input->post('size'),
        'DAYS_30_RET' => $CI->input->post('days_ret_30'),
        'REF_100_PER' => $CI->input->post('ret_100'),
        'FREE_SHIP' => $CI->input->post('free_ship'),
        'LIFE_TIME_RET' => $CI->input->post('life_time_ret'),
        'FREE_RET' => $CI->input->post('free_ret'),
        'PAYMENT' => $CI->input->post('payment'),
        'SILVER_CS' => $CI->input->post('silver_cs'),
        'TRY_HOME' => $CI->input->post('try_home'),
        'HALLMARK_CENTER' => $CI->input->post('hall_center'),
        'JEWEL_IDMARK' => $CI->input->post('jewel_idmark'),
        'DELIVERY_DAYS' => $CI->input->post('del_days'),
        'WEB_PROD_REMARK' => $CI->input->post('web_prod_remark'),
        'STORE_PROD_REMARK' => $CI->input->post('store_prod_remark'),
    );
}

function viewAllProducts() {
    $CI = & get_instance();
    $data = getAdminCommonData();
    $data['title'] = 'Show All Products';
    $data['component_type'] = $CI->comp_types(1);
    $where = 'a.MF_USER_ID=' . ses_data('user_id');
    $data['prod_dets'] = buildProdDetails('', $where);
    $data['totalcount'] = $CI->Product_model->prod_count('', $where);
    $data['fields_opt'] = getFieldDropDowns();
    $data['sub_com_data'] = getDBComponentData();
    $data['fields_data'] = getManfProductData();
    loadAdminView('product/view_all', $data);
}

function buildProdDetails($comp_join_queries, $where) {
    $CI = & get_instance();
    $prod_res_arr = $CI->Product_model->get_products($comp_join_queries, $where);
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
        $arr['other_det'] = $CI->Product_model->prod_other_dets($prod_id);
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
            if (isset($prodColDesp[$key])) {
                $str .= $prodColDesp[$key] . ' = ' . $val . ';';
            }
        }
    }
    return substr($str, 0, strlen($str) - 1);
}

function getSkipProdKeys($type) {
    if ($type == \models\DBConstants::MF_PROD_SUMMARY) {
        return array('PROD_ID', 'MF_USER_ID', 'PROD_DEF_THUMB', 'PROD_THUMBS', 'PROD_IMAGES', 'DATE_CREATED', 'PROD_STATUS');
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
        'JEWEL_IDMARK' => 'Jewel ID Mark'
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

function getManfProductData() {
    $CI = & get_instance();
    $user_id = ses_data('user_id');
    return array(
        'collection_names' => $CI->Product_model->getCollectionNames($user_id),
        'brands' => $CI->Product_model->getBrands($user_id),
        'designer' => $CI->Product_model->getDesigners($user_id),
    );
}

function getMetalBaseRate() {
    $CI = & get_instance();
    $fac_val = $CI->input->post('fac_val');
    $baseDet = $CI->Product_model->getMetalBaseDetails(ses_data('user_id'));
    if (sizeof($baseDet) > 0) {
        $res['error'] = false;
        foreach ($baseDet as $base) {
            if ($base->BR_TYPE == 'metal_cost') {
                $res['metal_cost'] = $base->BR_VALUE;
            } else if ($base->BR_TYPE == $fac_val) {
                $res['factor'] = $base->BR_VALUE;
            }
        }
    } else {
        $res['error'] = true;
    }
    json_output($res);
}

function getMetalTypes() {
    $CI = & get_instance();
    $val = $CI->input->post('selVal');
    $cmp_type_arr = $CI->component_type();
    $str = '';
    foreach ($cmp_type_arr as $cmp_type) {
        if ($cmp_type->COMP_ID == 1) {
            if ($val == $cmp_type->JT_ID) {
                $str .= $cmp_type->COMP_TYPE_ID . '#' . $cmp_type->COMP_TYPE_NAME . '@';
            }
        }
    }

    if ($str == '') {
        foreach ($cmp_type_arr as $cmp_type) {
            if ($cmp_type->COMP_ID == 1) {
                if ($cmp_type->JT_ID == 0) {
                    $str .= $cmp_type->COMP_TYPE_ID . '#' . $cmp_type->COMP_TYPE_NAME . '@';
                }
            }
        }
    }
    json_output(array(
        'error' => false,
        'msg' => substr($str, 0, strlen($str) - 1)
    ));
}

//Apeksha Lad Dated : 18nd July 2014::14.00PM

function loadProducts() {
    $CI = & get_instance();
    $search_results = '';
    $where = '';
    $orderBy = '';
    $jeweltype = $CI->input->post('jeweltype');
    $categoryId = $CI->input->post('category');
    $productType = $CI->input->post('producttype');
    $productName = $CI->input->post('productname');
    $collection = $CI->input->post('collection');
    $brand = $CI->input->post('brand');
    $designer = $CI->input->post('designer');
    $priceto = $CI->input->post('priceto');
    $pricefrom = $CI->input->post('pricefrom');
    $certificate = $CI->input->post('certificate');
    $hallmark = $CI->input->post('hallmark');
    $thirtydaysrefund = $CI->input->post('30daysrefund');
    $hundprecntrefund = $CI->input->post('100_refund');
    $freeship = $CI->input->post('freeship');
    $lifetimeexch = $CI->input->post('lifetimeexch');
    $freereturn = $CI->input->post('freereturn');
    $tryhome = $CI->input->post('tryhome');
    $readystock = $CI->input->post('readystock');
    $cod = $CI->input->post('cod');

    // For metal
    $metalType = $CI->input->post('metaltype');

    // For Diamond
    $diamondType = $CI->input->post('diamondtype');
    $stoneClarityTo = $CI->input->post('stoneclarityto');
    $stoneClarityFrom = $CI->input->post('stoneclarityfrom');
    $stoneColorTo = $CI->input->post('stonecolorTo');
    $stoneColorFrom = $CI->input->post('stonecolorFrom');
    $stoneCut = $CI->input->post('stonecut');
    $stoneShape = $CI->input->post('stoneshape');
    $stoneFluor = $CI->input->post('stonefluor');
    $stonePlace = $CI->input->post('stoneplace');
    $stoneSeivSizeTo = $CI->input->post('stoneseivsizeto');
    $stoneSeivSizeFrom = $CI->input->post('stoneseivsizefrom');
    $stoneSize = $CI->input->post('stonesize');
    $stoneSet = $CI->input->post('stoneset');

    // For Colored Stone
    $cstoneType = $CI->input->post('cstonetype');
    $cstoneCat = $CI->input->post('cstonecat');
    $cstoneColor = $CI->input->post('cstonecolor');
    $cstoneCut = $CI->input->post('cstonecut');

    // For sorting
    $colName = $CI->input->post('colname');
    $colType = $CI->input->post('coltype');
    $order = $CI->input->post('orderby');

    if ($categoryId != '') {
        $where .= " a.CAT_ID = $categoryId or ";
        $search_results .= 'category=' . $categoryId . ';';
    }
    if ($productType != '') {
        $where .= "a.PROD_TYPE_ID = $productType or ";
        $search_results .= 'producttype=' . $productType . ';';
    }
    if ($productName != '') {
        $where .= "a.PROD_NAME like '%" . $productName . "%' or ";
        $search_results .= 'productname=' . $productName . ';';
    }
    if ($collection != '') {
        $where .= "a.COLLECTION_NAME != '' or ";
        $search_results .= 'collection=' . $collection . ';';
    }
    if ($brand != '') {
        $where .= "a.BRAND = '' or ";
        $search_results .= 'brand=' . $brand . ';';
    }
    if ($designer != '') {
        $where .= "a.DESIGNER != '' or ";
        $search_results .= 'designer=' . $designer . ';';
    }
    if (($priceto != '') && ($pricefrom != '')) {
        $where .= "a.MF_TOTAL_PRICE BETWEEN $pricefrom AND $priceto or ";
        $search_results .= 'priceto=' . $priceto . ';';
        $search_results .= 'pricefrom=' . $pricefrom . ';';
    }
    if ($certificate != '') {
        if ($certificate == 'igi') {
            $where .= "a.CERTIFICATE like '%" . $certificate . "%' or ";
            $search_results .= 'certificate=' . $certificate . ';';
        }
    }
    if ($hallmark != '') {
        if ($hallmark == 1) {
            $where .= "a.HALLMARK = 1 or ";
            $search_results .= 'hallmark=' . $hallmark . ';';
        }
        if ($hallmark == 0) {
            $where .= "a.HALLMARK = 0 or ";
            $search_results .= 'hallmark=' . $hallmark . ';';
        }
    }
    if ($thirtydaysrefund != '') {
        if ($thirtydaysrefund == 1) {
            $where .= "a.DAYS_30_RET = 1 or ";
            $search_results .= '30daysrefund=' . $thirtydaysrefund . ';';
        }
        if ($thirtydaysrefund == 0) {
            $where .= "a.DAYS_30_RET = 0 or ";
            $search_results .= '30daysrefund=' . $thirtydaysrefund . ';';
        }
    }
    if ($hundprecntrefund != '') {
        if ($hundprecntrefund == 1) {
            $where .= "a.REF_100_PER = 1 or ";
            $search_results .= '100_refund=' . $hundprecntrefund . ';';
        }
        if ($hundprecntrefund == 0) {
            $where .= "a.REF_100_PER = 0 or ";
            $search_results .= '100%refund=' . $hundprecntrefund . ';';
        }
    }
    if ($freeship != '') {
        if ($freeship == 1) {
            $where .= "a.FREE_SHIP = 1 or ";
            $search_results .= 'freeship=' . $freeship . ';';
        }
        if ($freeship == 0) {
            $where .= "a.FREE_SHIP = 0 or ";
            $search_results .= 'freeship=' . $freeship . ';';
        }
    }
    if ($lifetimeexch != '') {
        if ($lifetimeexch == 1) {
            $where .= "a.LIFE_TIME_RET = 1 or ";
            $search_results .= 'lifetimeexch=' . $lifetimeexch . ';';
        }
        if ($lifetimeexch == 0) {
            $where .= "a.LIFE_TIME_RET = 0 or ";
            $search_results .= 'lifetimeexch=' . $lifetimeexch . ';';
        }
    }
    if ($freereturn != '') {
        if ($freereturn == 1) {
            $where .= "a.FREE_RET = 1 or ";
            $search_results .= 'freereturn=' . $freereturn . ';';
        }
        if ($freereturn == 0) {
            $where .= "a.FREE_RET = 0 or ";
            $search_results .= 'freereturn=' . $freereturn . ';';
        }
    }
    /* if ($tryhome != '')
      {
      if ($tryhome == 1) {
      $where .= "a.TRY@HOME == 1 or ";
      $search_results .= 'try@home='.$tryhome.';';
      }
      if ($tryhome == 0) {
      $where .= "a.TRY@HOME == 0 or ";
      $search_results .= 'try@home='.$tryhome.';';
      }
      } */
    if ($readystock != '') {
        if ($readystock == 'Ready') {
            $where .= "a.STOCK != '' or ";
            $search_results .= 'readystock=' . $readystock . ';';
        }
    }
    /* if($cod != '')
      {
      if ($cod == 1) {
      $where .= "a.COD == 1 or ";
      $search_results .= 'cod='.$cod.';';
      }
      if ($cod == 0) {
      $where .= "COD == 0 or ";
      $search_results .= 'cod='.$cod.';';
      }
      } */

    // Metal Fields 
    $metal_flag = false;
    $comp_join_queries = '';
    if ($metalType != '') {
        $metal_flag = true;
        $where .= "e.COMP_TYPE_ID = " . $metalType . " or ";
    }


    // Diamond fields
    $diamond_flag = false;
    if ($diamondType != '') {
        $diamond_flag = true;
        $where .= "f.COMP_TYPE_ID = " . $diamondType . " or ";
    }
    if ($stoneClarityTo != '') {
        $diamond_flag = true;
        $where .= "f.CLARITY_TO_ID = " . $stoneClarityTo . " or ";
    }
    if ($stoneClarityFrom != '') {
        $diamond_flag = true;
        $where .= "f.CLARITY_FROM_ID = " . $stoneClarityFrom . " or ";
    }
    if ($stoneColorTo != '') {
        $diamond_flag = true;
        $where .= "f.COLOR_TO_ID = " . $stoneColorTo . " or ";
    }
    if ($stoneColorFrom != '') {
        $diamond_flag = true;
        $where .= "f.COLOR_FROM_ID = " . $stoneColorFrom . " or ";
    }
    if ($stoneCut != '') {
        $diamond_flag = true;
        $where .= "f.CUT_ID = " . $stoneCut . " or ";
    }
    if ($stoneShape != '') {
        $diamond_flag = true;
        $where .= "f.SHAPE_ID = " . $stoneShape . " or ";
    }
    if ($stoneFluor != '') {
        $diamond_flag = true;
        $where .= "f.FLU_ID = " . $stoneFluor . " or ";
    }
    if ($stonePlace != '') {
        $diamond_flag = true;
        $where .= "f.PLAC_ID = " . $stonePlace . " or ";
    }
    /* if ($stoneSeivSizeTo != '') {
      $diamond_flag = true;
      $where .= "f.SEIV_SIZE_TO_ID = ".$stoneSeivSizeTo." or ";
      }
      if ($stoneSeivSizeFrom != '') {
      $diamond_flag = true;
      $where .= "f.SEIV_SIZE_FROM_ID = ".$stoneSeivSizeFrom." or ";
      } */
    if ($stoneSize != '') {
        $diamond_flag = true;
        $where .= "f.SIZE_ID = " . $stoneSize . " or ";
    }
    if ($stoneSet != '') {
        $diamond_flag = true;
        $where .= "f.SET_ID = " . $stoneSet . " or ";
    }

    //Colored Stone Fields
    $cstone_flag = false;
    $comp_join_queries = '';
    if ($cstoneType != '') {
        $cstone_flag = true;
        $where .= "g.COMP_TYPE_ID = " . $cstoneType . " or ";
    }
    if ($cstoneCat != '') {
        $cstone_flag = true;
        $where .= "g.C_STONE_CAT_ID = " . $cstoneCat . " or ";
    }
    if ($cstoneColor != '') {
        $cstone_flag = true;
        $where .= "g.C_STONE_COL_ID = " . $cstoneColor . " or ";
    }
    if ($cstoneCut != '') {
        $cstone_flag = true;
        $where .= "g.CUT_ID = " . $cstoneCut . " or ";
    }

    if ($colType == 'metal') {
        $metal_flag = true;
        $orderBy = " Order By e.$colName $order";
    } else if ($colType == 'stone') {
        $diamond_flag = true;
        $orderBy = " Order By f.$colName $order";
    } else if ($colType == 'cstone') {
        $cstone_flag = true;
        $orderBy = " Order By g.$colName $order";
    } else {
        $orderBy = " ORDER BY a.PROD_ID desc";
    }

    if ($metal_flag) {
        $comp_join_queries .= ' left join ' . \models\DBConstants::MF_PROD_METAL . ' e on a.PROD_ID = e.PROD_ID';
    }

    if ($diamond_flag) {
        $comp_join_queries .= ' left join ' . \models\DBConstants::MF_PROD_STONE . ' f on a.PROD_ID = f.PROD_ID';
    }

    if ($cstone_flag) {
        $comp_join_queries .= ' left join ' . \models\DBConstants::MF_PROD_COLORED_STONE . ' g on a.PROD_ID = g.PROD_ID';
    }


    if ($CI->input->post()) {
        $where = 'a.MF_USER_ID=' . ses_data('user_id') . ' and ' . $where;
        $where = substr($where, 0, strlen($where) - 4);
    } else {
        $where = 'a.MF_USER_ID=' . ses_data('user_id');
    }

    $limit = 10;
    $page = $CI->input->post('page');
    $start = ($page * $limit);
    $prod_total_count = $CI->Product_model->prod_count($comp_join_queries, $where);

    $where .= "$orderBy" . ' limit ' . $start . ', ' . $limit;

    $ses_det = $CI->session->all_userdata();
    $prod_dets = buildProdDetails($comp_join_queries, $where);

    foreach ($prod_dets as $prod_arr) {
        $prod_summ = $prod_arr['prod_summ'];
        $prod_comp = $prod_arr['prod_comp'];
        $metal_det = $prod_arr['metal_det'];
        $stone_det = $prod_arr['stone_det'];
        $colored_stone_det = $prod_arr['colored_stone_det'];
        $labour_det = $prod_arr['labour_det'];
        $other_det = $prod_arr['other_det'];
        $is_stone = sizeof($stone_det) > 0;
        $is_cs = sizeof($colored_stone_det) > 0;
        $is_labour = sizeof($labour_det) > 0;
        $prod_id = $prod_summ->PROD_ID;
        $img_path = 'uploads/' . $ses_det['user_id'] . '/' . $prod_id . '/';

        $metal_total_wt = 0;
        $metal_total_cost = 0;
        $dia_total_wt = 0;
        $dia_total_cost = 0;
        $cs_total_wt = 0;
        $cs_total_cost = 0;
        $labour_total_cost = 0;
        ?>
        <tr>
            <td colspan="2" align="center" width="6%">
                <?php
                $imgArr = explode(';', $prod_summ->PROD_IMAGES);
                if ($imgArr != NULL) {
                echo '<a href="' . ($img_path . $imgArr[0]) . '" data-lightbox="example-set-' . $prod_id . '" class="example-image-link" id="gallery">';
                echo '<img src="' .$img_path . $prod_summ->PROD_DEF_THUMB.'" style="width:60px;" /></a>';
                }
                ?>
            </td>
            <td style="padding:0" width="8%">
                <table width="100%">
                    <tr>
                        <td align="center"><?php echo $prod_summ->PROD_NAME; ?></td>
                    </tr>
                    <tr>
                        <td align="center"><?php echo $prod_summ->STYLE_NO; ?></td>
                    </tr>
                </table>
            </td>
            <td colspan="2" width="26%">
                <table width="100%">
                    <?php
                    if (sizeof($metal_det) > 0) {
                        foreach ($metal_det as $metal) {
                            $metal_total_wt += $metal->GROSS_WEIGHT;
                            $metal_total_cost += $metal->MF_PRICE;
                            ?>
                            <tr>
                                <td align="center" width="60px"><?php
                                    if ($metal->COMP_TYPE_NAME != '') {
                                        echo $metal->COMP_TYPE_NAME;
                                    } else {
                                        echo '--';
                                    }
                                    ?></td>
                                <td align="center" width="48px"><?php
                                    if ($metal->GROSS_WEIGHT != '') {
                                        echo $metal->GROSS_WEIGHT;
                                    } else {
                                        echo '--';
                                    }
                                    ?></td>
                                <td align="center" width="42px"><?php
                                    if ($metal->VALUE != '') {
                                        echo $metal->VALUE;
                                    } else {
                                        echo '--';
                                    }
                                    ?></td>
                                <td align="center" width="42px">Ye</td>
                                <td align="center" width="54px"><?php
                                    if ($metal->BASE_RATE != '') {
                                        echo number_format($metal->BASE_RATE, 2);
                                    } else {
                                        echo '--';
                                    }
                                    ?></td>
                                <td align="right" width="56px"><?php
                                    if ($metal->MF_PRICE != '') {
                                        echo $metal->MF_PRICE;
                                    } else {
                                        echo '--';
                                    }
                                    ?></td>
                            </tr>
                            <?php
                        }
                    } else {
                        echo '<tr>';
                        echo '<td colspan="8" align="center">--</td>';
                        echo '</tr>';
                    }
                    ?>
                </table>
            </td>
            <td colspan="2" width="28%">
                <table width="100%">
                    <?php
                    if (sizeof($stone_det) > 0) {
                        foreach ($stone_det as $stone) {
                            $dia_total_wt+= $stone->GROSS_WEIGHT;
                            $dia_total_cost+= $stone->MF_PRICE;
                            ?>
                            <tr>
                                <td align="center" width="36px"><?php echo $stone->PLAC_NAME; ?></td>
                                <td align="center" width="46px"><?php echo $stone->COMP_TYPE_NAME; ?></td>
                                <td align="center" width="41px"><?php echo $stone->SHAPE_NAME; ?></td>
                                <td align="center" width="42px"><?php echo $stone->GROSS_WEIGHT; ?></td>
                                <td align="center" width="50px"><?php echo $stone->color_from_name; ?><?php echo $stone->color_to_name; ?>-<?php echo $stone->clarity_from_name; ?></td>
                                <td align="center" width="38px"><?php echo $stone->CUT_NAME; ?></td>
                                <td align="right" width="50px" align="left"><?php echo $stone->BASE_RATE; ?></td>
                                <td align="right" width="48px" align="left"><?php echo $stone->MF_PRICE; ?></td>
                            </tr>
                            <?php
                        }
                    } else {
                        echo '<tr>';
                        echo '<td colspan="8" align="center">--</td>';
                        echo '</tr>';
                    }
                    ?>
                </table>
            </td>
            <td colspan="2" width="28%">
                <table width="100%">
                    <?php
                    if (sizeof($colored_stone_det) > 0) {
                        foreach ($colored_stone_det as $cstone) {
                            $cs_total_wt += $cstone->GROSS_WEIGHT;
                            $cs_total_cost += $cstone->MF_PRICE;
                            ?>
                            <tr>
                                <td align="center" width="30px"><?php echo $cstone->COMP_TYPE_NAME; ?></td>
                                <td align="center" width="30px"><?php echo $cstone->SHAPE_NAME; ?></td>
                                <td align="center" width="58px"><?php echo $cstone->GROSS_WEIGHT; ?></td>
                                <td align="center" width="29px"><?php echo $cstone->C_STONE_COL_NAME; ?></td>
                                <td align="center" width="43px">EX</td>
                                <td align="center" width="76px"><?php echo $cstone->BASE_RATE; ?></td>
                                <td align="center" width="66px"><?php echo $cstone->MF_PRICE; ?></td>
                            </tr>
                            <?php
                        }
                    } else {
                        echo '<tr>';
                        echo '<td colspan="8" align="center">--</td>';
                        echo '</tr>';
                    }
                    ?>
                </table>
            </td>
            <td colspan="1" width="8%">
                <table width="100%">
                    <tr>
                        <td align="center" width="40px"><?php
                            $labour_cost = ($is_labour ? $labour_det->MF_PRICE : 0);
                            $labour_total_cost += $labour_cost;
                            echo number_format($labour_cost, 2);
                            ?></td>
                        <td align="center" width="35px">0</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="10">
                <table>
                    <?php
                    $metal_total_rate = number_format($metal_total_wt > 0 ? ($metal_total_cost / $metal_total_wt) : 0, 2);
                    $dia_total_rate = number_format($dia_total_wt > 0 ? ($dia_total_cost / $dia_total_wt) : 0, 2);
                    $cs_total_rate = number_format($cs_total_wt > 0 ? ($cs_total_cost / $cs_total_wt) : 0, 2);
                    //$total_cost = $metal_total_cost + $dia_total_cost + $cs_total_cost + $labour_total_cost;
                    ?>
                    <tr>
                        <td valign="top" width="82px">
                            <table>
                                <tr>
                                    <td align="center" style="padding:0px 8px;">
                                        <a href="admin/product/edit/<?php echo $prod_id; ?>" class="tooltips" data-toggle="tooltip" data-placement="top" title="" data-original-title="Email"><i class="fa fa-edit"></i></a>
                                    </td>
                                    <td align="center" style="padding:0px 8px;">
                                        <a href="javascript:;" data-id="<?php echo $prod_id; ?>" data-status="<?php echo ($prod_summ->PROD_STATUS ? '1' : '0'); ?>" class="tooltips prod_active" data-toggle="tooltip" data-placement="top" title="" data-original-title="Email"><i class="fa fa-<?php echo ($prod_summ->PROD_STATUS ? 'times' : 'check'); ?>"></i></a>
                                    </td>
                                    <td align="center" style="padding:0px 8px;">
                                        <?php
                                        $imgArr = explode(';', $prod_summ->PROD_IMAGES);
                                        if ($imgArr != NULL) {
                                            echo '<span><a href="' . ($img_path . $imgArr[0]) . '" data-lightbox="example-set-' . $prod_id . '" class="example-image-link" id="gallery"><i class="fa fa-picture-o"></i></a></span>';
                                        }
                                        $count = 0;
                                        foreach ($imgArr as $img) {
                                            if ($count > 0) {
                                                echo '<a href="' . ($img_path . $img) . '" class="example-image-link" data-lightbox="example-set-' . $prod_id . '"></a>';
                                            }
                                            $count++;
                                        }
                                        ?>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td align="center" width="88px">Net Weight</td>
                        <td width="60px;"></td>
                        <td align="center" width="48px"><?php echo $metal_total_wt; ?></td>
                        <td width="42px;"></td>
                        <td width="42px;"></td>
                        <td align="right" width="54px"><?php echo $metal_total_rate; ?></td>
                        <td align="right" width="65px"><?php echo number_format($metal_total_cost, 2); ?></td>
                        <td width="36px;"></td>
                        <td width="46px;"></td>
                        <td width="41px;"></td>
                        <td align="center" width="42px"><?php echo $dia_total_wt; ?></td>
                        <td width="50px"></td>
                        <td width="38px"></td>
                        <td align="right" width="43px"><?php echo $dia_total_rate; ?></td>
                        <td align="right" width="49px"><?php echo number_format($dia_total_cost, 2); ?></td>
                        <td width="30px"></td>
                        <td width="30px"></td>
                        <td align="right" width="58px;"><?php echo $cs_total_wt; ?></td>
                        <td width="29px"></td>
                        <td width="43px"></td>
                        <td align="center" width="76px"><?php echo $cs_total_rate; ?></td>
                        <td align="center" width="78px"><?php echo number_format($cs_total_cost, 2); ?></td>
                        <td align="right"><?php echo number_format($labour_total_cost, 2); ?></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td align="center" width="80px"><a href="javascript:;" class="accordion" data-id="<?php echo $prod_id; ?>"><i class="fa fa-plus-square-o" style="font-size:16px; margin-top: 0px;"></i></a></td>
            <td colspan="7"></td>
            <td align="right"><b>Total Cost &nbsp;&nbsp;&nbsp;(I+II+III+IV)&nbsp;=</b></td>
            <td align="center" style="font-size:12px; color: #006dcc"><b><?php echo number_format($prod_summ->MF_TOTAL_PRICE, 2); ?></b></td>
        </tr>
        <tr id="inner_dets_<?php echo $prod_id; ?>" class="hide">
            <td colspan="10">
                <table width="100%">
                    <?php
                    foreach ($other_det as $others) {
                        
                    }
                    ?>
                    <tr><td colspan="10"><p class="header alert alert-info">Other Details</p></td></tr>
                    <tr>
                        <td align="left" class="txt1" width="100px">Short Desc</td>
                        <td align="left" width="210px"><?php echo $prod_summ->PROD_SHORT_DESC; ?></td>
                        <td align="left" class="txt1" width="92px">Long Desc</td>
                        <td colspan="7" align="left" width="854px"><?php echo $prod_summ->PROD_DESC; ?></td>
                    </tr>
                    <tr>
                        <td align="left" class="txt1" width="100px">Bar Code</td>
                        <td align="left" width="210px"><?php echo $others->B_NAME ?></td>
                        <td align="left" class="txt1" width="92px">SKU No</td>
                        <td align="left" width="187px"><?php echo $prod_summ->SKU_NO; ?></td>
                        <td align="left" class="txt1" width="182px">Collection</td>
                        <td align="left" width="103"><?php echo $others->CN_NAME ?></td>
                        <td align="left" class="txt1" width="150px">Certificate</td>
                        <td align="left" width="57px"><?php echo $others->C_NAME; ?></td>
                        <td align="left" class="txt1" width="128px">Hallmark</td>
                        <td align="left" width="59px"><?php echo $others->H_NAME; ?></td>
                    </tr>
                    <tr>
                        <td align="left" class="txt1" width="100px">Dimensions</td>
                        <td align="left" width="210px"><?php echo $prod_summ->DIMENSIONS; ?></td>
                        <td align="left" class="txt1" width="92px">Brand</td>
                        <td align="left" width="182px"><?php echo $others->B_NAME; ?></td>
                        <td align="left" class="txt1" width="168px">Item Size</td>
                        <td colspan="5" align="left" width="497px"><?php echo $prod_summ->PROD_SIZE; ?></td>
                    </tr>
                    <tr>
                        <td align="left" class="txt1" width="100px">Other Features</td>
                        <td align="left" colspan="9" width="1094px">
                            <?php
                            if ($prod_summ->DAYS_30_RET == 1) {
                                echo "<div class='block'>30 Day Rfnd</div>";
                            }if ($prod_summ->REF_100_PER == 1) {
                                echo "<div class='block'>100% Rfund</div>";
                            }if ($prod_summ->FREE_SHIP == 1) {
                                echo "<div class='block'>Free Insured Shippping</div>";
                            }if ($prod_summ->LIFE_TIME_RET == 1) {
                                echo "<div class='block'>Lifetime Exchange</div>";
                            }if ($prod_summ->FREE_RET == 1) {
                                echo "<div class='block'>Free Returns</div>";
                            }if ($prod_summ->STOCK == 'Ready') {
                                echo "<div class='block'>Ready Stock</div>";
                            }
                            ?>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr bgcolor="#e4e7ea">
            <td colspan="10" height="20"></td>
        </tr>


        <?php
    }
    ?>
    <script type="text/javascript">
        $('#prod_count').val('<?php echo $prod_total_count; ?>');
    </script>
    <?php
}

//Apeksha Lad Dated : 21st July 2014::16.00PM

function addProdSettings($table) {
    $CI = & get_instance();
    $fields = $CI->input->post('fields');
    $fieldArr = explode(',', $fields);
    $val = $CI->input->post('comp_value');
    $error = $CI->Product_model->isOtherDataExists($table, $fieldArr[1], $val, ses_data('user_id'));
    if (!$error) {
        $arr = array(
            $fieldArr[1] => $val,
            'MF_USER_ID' => ses_data('user_id')
        );
        $col_id = $CI->Product_model->insert_record_get_id($table, $arr);
        $flag = ($col_id > 0);
        json_output(array(
            'error' => !$flag,
            'col_id' => $col_id,
            'col_name' => $val,
            'message' => ($flag ? 'Success' : "Failed")
        ));
    } else {
        json_output(array(
            'error' => true,
            'message' => 'Data is already exists'
        ));
    }
}

function editProdSettings($table) {
    $CI = & get_instance();
    $fields = $CI->input->post('fields');
    $fieldArr = explode(',', $fields);
    $val = $CI->input->post('comp_value');
    $error = $CI->Product_model->isOtherDataExists($table, $fieldArr[1], $val, ses_data('user_id'));
    if (!$error) {
        $arr = array(
            $fieldArr[1] => $val
        );
        $whereArr = array($fieldArr[0] => $CI->input->post('comp_id'), 'MF_USER_ID' => ses_data('user_id'));
        $flag = $CI->Product_model->update_record($table, $arr, $whereArr);
        json_output(array(
            'error' => !$flag,
            'message' => ($flag ? 'Success' : "Failed")
        ));
    } else {
        json_output(array(
            'error' => true,
            'message' => 'Data is already exists'
        ));
    }
}

function addBaseRate() {
    $CI = & get_instance();
    $user_id = ses_data('user_id');
    $CI->db->delete(models\DBConstants::MF_BASE_RATE, array('MF_USER_ID' => $user_id));

    $CI->Product_model->insert_record(models\DBConstants::MF_BASE_RATE, array(
        'MF_USER_ID' => $user_id,
        'BR_TYPE' => 'metal_cost',
        'BR_VALUE' => $CI->input->post('brval'),
    ));

    $metalArr = $CI->Product_model->getMetalQuality();
    foreach ($metalArr as $metal) {
        $CI->Product_model->insert_record(models\DBConstants::MF_BASE_RATE, array(
            'MF_USER_ID' => $user_id,
            'BR_TYPE' => $metal->MQ_ID,
            'BR_VALUE' => $CI->input->post('brtypeval_' . $metal->MQ_ID),
        ));
    }
    json_output(array(
        'error' => false,
        'message' => 'Updated details successfully'
    ));
}
