<?php

function updateComponentDetails($table) {
    $CI = & get_instance();
    $id = $CI->input->post('id');
    $colId = $CI->input->post('col_id');
    $colName = $CI->input->post('col_name');
    $val = $CI->input->post('val');
    $flag = $CI->Product_model->update_record($table, array($colName => $val), $colId . ' = ' . $id);
    json_output(array(
        'error' => !$flag,
        'message' => ($flag ? 'Success' : "Failed")
    ));
}

function addComponentDetails($table) {
    $CI = & get_instance();
    $colName = $CI->input->post('col_name');
    $val = $CI->input->post('val');
    $flag = $CI->Product_model->insert_record($table, array($colName => $val));
    json_output(array(
        'error' => !$flag,
        'message' => ($flag ? 'Success' : "Failed")
    ));
}
function addMetalComponentDetails($table) {
    $CI = & get_instance();
    $colName = $CI->input->post('col_name');
    $compId = $CI->input->post('comp_id');
    $compIdVal = $CI->input->post('comp_id_val');
    $val = $CI->input->post('val');
    $flag = $CI->Product_model->insert_comp_record($table, array($colName => $val, $compId => $compIdVal));
    json_output(array(
        'error' => !$flag,
        'message' => ($flag ? 'Success' : "Failed")
    ));
}


function addCStoneComponentDetails($table) {
    $CI = & get_instance();
    $colName = $CI->input->post('col_name');
    $compId = $CI->input->post('comp_id');
    $compTypeId = $CI->input->post('comp_id_val');
    $val = $CI->input->post('val');
    $flag = $CI->Product_model->insert_comp_record($table, array($colName => $val, $compId => $compTypeId));
    json_output(array(
        'error' => !$flag,
        'message' => ($flag ? 'Success' : "Failed")
    ));
}

