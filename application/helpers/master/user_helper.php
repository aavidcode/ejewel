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
    $userObj = $CI->User_model->getUserById($userId);
    $data['state_opt'] = state_opt($userObj->STATE);
    $data['userObj'] = $userObj;
    loadMasterView("user/edit", $data);
}

function editUserPost($userId) {
    $CI = & get_instance();
    $stdCode = $CI->input->post('stdcode');
    $telephone = $stdCode.'-'.$CI->input->post('telephone');
    return $CI->User_model->updateUser(array(
        'FIRST_NAME' => $CI->input->post('first_name'),
        'LAST_NAME' => $CI->input->post('last_name'),
        'EMAIL_ID' => $CI->input->post('email_id'),
        'COMP_NAME' => $CI->input->post('comp_name'),
        'MOBILE' => $CI->input->post('mobile'),
        'ADDRESS' => $CI->input->post('address'),
        'CITY' => $CI->input->post('city'),
        'STATE' => $CI->input->post('state'),
        'TELEPHONE' => $telephone,
        'PINCODE' => $CI->input->post('pincode'),
        'WEBSITE' => $CI->input->post('website'),
        'MEM_GJEPC_NO' => $CI->input->post('gjepc_mem_no'),
        'MEM_GJF_NO' => $CI->input->post('gjf_mem_no'),
        'MEM_LOC_ASS_NAME' => $CI->input->post('mem_loc_ass_name'),
        'MEM_LOC_ASS_CITY' => $CI->input->post('mem_loc_ass_city')
            ), $userId);
}
