<?php

function comp_opt($arr, $sel = '') {
    $str = '<option value=""></option>\n';
    foreach ($arr as $row) {
        $str .= opt($row->COMP_ID, $row->COMP_NAME, $sel);
    }
    return $str;
}

function get_opt($table, $sel = '') {
    $CI = & get_instance();
    $fieldArr = $CI->Product_model->listFields($table);
    $arr = $CI->data_table($table);
    $str = '<option value=""></option>\n';
    foreach ($arr as $row) {
        $str .= opt($row->$fieldArr[0], $row->$fieldArr[1], $sel);
    }
    return $str;
}

function opt($key, $val, $sel) {
    return '<option value="' . $key . '" ' . ($key == $sel ? "selected" : "") . '>' . $val . '</option><br />';
}

function state_opt($sel = '') {
    $CI = & get_instance();
    $stateArr = $CI->Product_model->getStates();
    $str = '<option value=""></option>\n';
    foreach ($stateArr as $state) {
        $str .= opt($state->STATE, $state->STATE, $sel);
    }
    return $str;
}

function populateCities($state) {
    $CI = & get_instance();
    $citiesArr = $CI->Product_model->getCities($state);
    $str = '';
    foreach ($citiesArr as $citiesRes) {
        $str .= $citiesRes->CITY . '#' . $citiesRes->CITY . '@';
    }
    json_output(array(
        'error' => false,
        'msg' => substr($str, 0, strlen($str) - 1)
    ));
}
