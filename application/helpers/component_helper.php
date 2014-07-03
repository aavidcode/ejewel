<?php

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
