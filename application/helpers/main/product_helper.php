<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

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