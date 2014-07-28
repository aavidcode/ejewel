<?php

function getAdminCommonData($site_user_name = '') {
    $CI = & get_instance();
    if ($site_user_name != "") {
        $CI->session->set_userdata('site_user_name', $site_user_name);
    } else {
        $site_user_name = $CI->session->userdata('site_user_name');
    }

    $data['site_user_name'] = $site_user_name;
    $data['site_det'] = $CI->User_model->getUserDetails($site_user_name);
    $data['ses_det'] = $CI->session->all_userdata();
    return $data;
}

//Apeksha Lad Dated : 10th July 2014::15.00PM

function editAdminUserUI($userId) {
    $CI = & get_instance();
    $data = getAdminCommonData();
    $data['title'] = 'Personal Detail';
    $data['userId'] = $userId;
    $userObj = $CI->User_model->getUserById($userId);
    $data['state_opt'] = state_opt($userObj->STATE);
    $data['userObj'] = $userObj;
    loadAdminView("user/myaccount/personal_det", $data);
}

function editAdminUserPost($userId) {
    $CI = & get_instance();
    $stdCode = $CI->input->post('stdcode');
    $telephone = $stdCode . '-' . $CI->input->post('telephone');
    return $CI->User_model->updateUser(array(
                'FIRST_NAME' => $CI->input->post('first_name'),
                'LAST_NAME' => $CI->input->post('last_name'),
                'EMAIL_ID' => $CI->input->post('email_id'),
                'COMP_NAME' => $CI->input->post('comp_name'),
                'MOBILE' => $CI->input->post('mobile'),
                'TELEPHONE' => $telephone,
                'ADDRESS' => $CI->input->post('address'),
                'CITY' => $CI->input->post('city'),
                'STATE' => $CI->input->post('state'),
                'PINCODE' => $CI->input->post('pincode'),
                'WEBSITE' => $CI->input->post('website'),
                'MEM_GJEPC_NO' => $CI->input->post('gjepc_mem_no'),
                'MEM_GJF_NO' => $CI->input->post('gjf_mem_no'),
                'MEM_LOC_ASS_NAME' => $CI->input->post('mem_loc_ass_name'),
                'MEM_LOC_ASS_CITY' => $CI->input->post('mem_loc_ass_city')
                    ), ses_data('user_id'));
    redirect('admin/per_det');
}

function change_pwd() {
    $CI = & get_instance();
    return $CI->User_model->updateUser(array(
                'PASS_WORD' => $CI->encrypt->my_encode($CI->input->post('pass_word'))
                    ), ses_data('user_id'));
}
