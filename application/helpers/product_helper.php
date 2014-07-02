<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function create_product() {
    $CI = & get_instance();
    $arr = array(
        'MF_USER_ID' => ses_data('user_id'),
        'DATE_CREATED' => date('Y-m-d H:i:s')
    );
    $prod_id = $CI->Product_model->add_prod(array_merge($arr, get_prod_form_array()));
    define_components($prod_id);
    return $prod_id;
}

function get_prod_form_array() {
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

function define_components($prod_id) {
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
            create_component($prod_id, $p_comp_id, $cur_row, models\DBConstants::MF_PROD_METAL);
            break;
        case 2:
            create_component($prod_id, $p_comp_id, $cur_row, models\DBConstants::MF_PROD_STONE);
            break;
        case 3:
            create_component($prod_id, $p_comp_id, $cur_row, models\DBConstants::MF_PROD_COLORED_STONE);
            break;
        case 4:
            create_component($prod_id, $p_comp_id, $cur_row, models\DBConstants::MF_PROD_LABOR);
            break;
    }
}

function create_component($prod_id, $p_comp_id, $cur_row, $table) {
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

function update_product($prod_id) {
    $CI = & get_instance();
    $flag = $CI->Product_model->update_prod(get_prod_form_array(), $prod_id);

    if ($flag) {
        $CI->Product_model->clear_comp_dets($prod_id);
        define_components($prod_id);
        $res['error'] = false;
        $res['message'] = 'Product details saved.';
        $CI->output->set_content_type('application/json')->set_output(json_encode($res));
    }
}

function show_all() {
    $CI = & get_instance();
    $data = getCommonData();
    $data['title'] = 'Show All Products';
    $data['component_type'] = $CI->comp_types(1);
    $data['prod_dets'] = build_prod_details();
    $data['category_opt'] = cat_opt($CI->category());
    $data['prod_type_opt'] = prod_type_opt($CI->prod_type());
    admin_load_view('admin/products/view_all', $data);
}

function build_prod_details() {
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

function add_prod() {
    $CI = & get_instance();
    unses_set('prod_id');
    if ($CI->input->post()) {
        $prod_id = create_product();
        ses_set('prod_id', $prod_id);
        if ($prod_id) {
            $res['error'] = false;
            $res['prod_id'] = $prod_id;
        } else {
            $res['error'] = true;
            $res['message'] = $CI->db->_error_message();
        }
        $CI->output->set_content_type('application/json')->set_output(json_encode($res));
    } else {
        add_prod_view();
    }
}

function add_prod_view() {
    $CI = & get_instance();
    $data = getCommonData();
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
    admin_load_view('admin/products/add_prod', $data);
}

function update_or_view($prod_id) {
    $CI = & get_instance();
    if ($CI->input->post()) {
        update_product($prod_id);
    } else {
        view_product($prod_id);
    }
}

function view_product($prod_id) {
    $CI = & get_instance();
    $data = getCommonData();
    $prod_sum_det = $CI->Product_model->product_details($prod_id);
    $data['component'] = $CI->component();
    $data['category_opt'] = cat_opt($CI->category(), $prod_sum_det->CAT_ID);
    $data['prod_type_opt'] = prod_type_opt($CI->prod_type(), $prod_sum_det->PROD_TYPE_ID);
    $data['price_type_opt'] = price_type_opt($CI->price_type(), $prod_sum_det->PRICE_TYPE_ID);
    $mf_prod_component = $CI->Product_model->mf_prod_component($prod_id);
    $data['sub_com_data'] = array(
        'component_type' => $CI->component_type(),
        'stone_clarity' => $CI->stone_clarity(),
        'stone_color' => $CI->stone_color(),
        'stone_cut' => $CI->stone_cut(),
        'stone_shape' => $CI->stone_shape(),
        'c_stone_type' => $CI->c_stone_type(),
        'c_stone_category' => $CI->c_stone_category(),
        'c_stone_color' => $CI->c_stone_color(),
        'prod_sum_det' => $prod_sum_det,
        'mf_prod_component' => $mf_prod_component,
        'comp_data' => get_comp_data($mf_prod_component, $prod_id)
    );
    $data['title'] = $prod_sum_det->PROD_NAME;
    admin_load_view('admin/products/edit_prod', $data);
}

function get_comp_data($mf_prod_component, $prod_id) {
    $CI = & get_instance();
    $comp_arr = array();
    foreach ($mf_prod_component as $arr) {
        $comp_data = $CI->Product_model->get_comp_data($prod_id, $arr->P_COMP_ID, $arr->COMP_CODE);
        $comp_arr['comp_data_' . $arr->P_COMP_ID] = build_comp_data($comp_data, $arr->COMP_CODE);
        $comp_arr['comp_price_' . $arr->P_COMP_ID] = $comp_data->MF_PRICE;
        $comp_arr['comp_base_rate_' . $arr->P_COMP_ID] = $comp_data->BASE_RATE;
    }
    return $comp_arr;
}

function build_comp_data($comp_data, $type) {
    $str = '';
    if ($type == 'metal') {
        $str .= 'COMP_TYPE_ID:' . $comp_data->COMP_TYPE_ID . ';' .
                'GROSS_WEIGHT:' . $comp_data->GROSS_WEIGHT . ';' .
                'CARET:' . $comp_data->CARET;
    } else if ($type == 'stone') {
        $str = 'CUT_ID:' . $comp_data->CUT_ID . ';' .
                'TOTAL_STONES:' . $comp_data->TOTAL_STONES . ';' .
                'COLOR_FROM_ID:' . $comp_data->COLOR_FROM_ID . ';' .
                'COLOR_TO_ID:' . $comp_data->COLOR_TO_ID . ';' .
                'CLARITY_FROM_ID:' . $comp_data->CLARITY_FROM_ID . ';' .
                'CLARITY_TO_ID:' . $comp_data->CLARITY_TO_ID . ';' .
                'GROSS_WEIGHT:' . $comp_data->GROSS_WEIGHT . ';' .
                'SHAPE_ID:' . $comp_data->SHAPE_ID;
    } else if ($type == 'colored_stone') {
        $str = 'COMP_TYPE_ID:' . $comp_data->COMP_TYPE_ID . ';' .
                'C_STONE_CAT_ID:' . $comp_data->C_STONE_CAT_ID . ';' .
                'C_STONE_COL_ID:' . $comp_data->C_STONE_COL_ID . ';' .
                'TOTAL_STONES:' . $comp_data->TOTAL_STONES . ';' .
                'GROSS_WEIGHT:' . $comp_data->GROSS_WEIGHT;
    }
    return $str;
}

function create_images($prod_id) {
    $CI = & get_instance();
    $user_id = ses_data('user_id');
    $count = $CI->input->post('img_count');
    $main_path = 'uploads/' . $user_id . '/' . $prod_id . '/';
    $thumb = '';
    $large = '';
    $def_img = '';
    for ($i = 1; $i <= $count; $i++) {
        $file_name = date('YmdHis') . '.jpg';
        $large_img = upload_file('large_' . $i, $main_path, $file_name);

        $thum_file = 'thumb_' . $file_name;
        if ($CI->input->post('auto_thumb')) {
            $thumb_img = create_thumb($main_path, $large_img, $main_path, $thum_file, 300);
        } else {
            $thumb_img = upload_file('thumb_' . $i, $main_path, $thum_file);
        }

        if ($CI->input->post('def_img') == $i) {
            $def_img = $thumb_img;
        }
        $thumb .= $thumb_img . ';';
        $large .= $large_img . ';';
        sleep(2);
    }

    $CI->Product_model->update_prod(array(
        'PROD_DEF_THUMB' => $def_img,
        'PROD_THUMBS' => substr($thumb, 0, strlen($thumb) - 1),
        'PROD_IMAGES' => substr($large, 0, strlen($large) - 1)
            ), $prod_id);
}

function comp_opt($arr, $sel = '') {
    $str = '<option value="">--</option>\n';
    foreach ($arr as $row) {
        $str .= opt($row->COMP_ID, $row->COMP_NAME, $sel);
    }
    return $str;
}

function cat_opt($arr, $sel = '') {
    $str = '<option value="">--</option>\n';
    foreach ($arr as $row) {
        $str .= opt($row->CAT_ID, $row->CAT_NAME, $sel);
    }
    return $str;
}

function prod_type_opt($arr, $sel = '') {
    $str = '<option value="">--</option>\n';
    foreach ($arr as $row) {
        $str .= opt($row->PROD_TYPE_ID, $row->PROD_TYPE_NAME, $sel);
    }
    return $str;
}

function price_type_opt($arr, $sel = '') {
    $str = '<option value="">--</option>\n';
    foreach ($arr as $row) {
        $str .= opt($row->PRICE_TYPE_ID, $row->PRICE_TYPE_NAME, $sel);
    }
    return $str;
}

function opt($key, $val, $sel) {
    return '<option value="' . $key . '" ' . ($key == $sel ? "selected" : "") . '>' . $val . '</option><br />';
}
