<?php

function getMasterCommonData() {
    $CI = & get_instance();
    $data['web_title'] = $CI->config->item('website_title');
    $data['ses_det'] = $CI->session->all_userdata();
    return $data;
}

function editUserUI($userId) {
    $CI = & get_instance();
    $data = getMasterCommonData();
    $data['title'] = 'Master Admin';
    $data['userId'] = $userId;
    $data['userObj'] = $CI->User_model->getUserById($userId);
    loadMasterView("user/edit", $data);
}

function editUserPost($userId) {
    $CI = & get_instance();
    $data['USER_NAME'] = $CI->input->post('domain_name');
    $data['FIRST_NAME'] = $CI->input->post('first_name');
    $data['LAST_NAME'] = $CI->input->post('last_name');
    $data['EMAIL_ID'] = $CI->input->post('email_id');
    $data['COMP_NAME'] = $CI->input->post('comp_name');
    $data['MOBILE'] = $CI->input->post('mobile');
    $data['TELEPHONE'] = $CI->input->post('telephone');
    $data['ADDRESS'] = $CI->input->post('address');
    $data['CITY'] = $CI->input->post('city');
    $data['STATE'] = $CI->input->post('state');
    $data['PINCODE'] = $CI->input->post('pincode');
    $data['WEBSITE'] = $CI->input->post('website');
    $data['MEM_GJEPC_NO'] = $CI->input->post('gjepc_mem_no');
    $data['MEN_GJF_NO'] = $CI->input->post('gjf_mem_no');
    $data['MEM_LOC_ASS_NAME'] = $CI->input->post('mem_loc_ass_name');
    $data['MEM_LOC_ASS_CITY'] = $CI->input->post('mem_loc_ass_city');
    $CI->User_model->updateUser($data, $userId);
    redirect('master/listAll');
}
