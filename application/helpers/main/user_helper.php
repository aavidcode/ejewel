<?php

function getSiteCommonData($site_user_name = '') {
    $CI = & get_instance();
    if ($site_user_name != "") {
        $CI->session->set_userdata('site_user_name', $site_user_name);
    } else {
        $site_user_name = $CI->session->userdata('site_user_name');
    }

    $data['site_user_name'] = $site_user_name;
    $data['site_user_id'] = ses_data('site_user_id');
    $data['site_det'] = $CI->User_model->getUserDetails($site_user_name);
    $data['ses_det'] = $CI->session->all_userdata();
    return $data;
}

function create_user() {
    $CI = & get_instance();
    $website = $CI->input->post('website');
    $domainName = explode('/',$website);
    if($domainName[0] == 'http:'){
        $websiteName = $website;
    }else{
        $websiteName = "http://".$website;
    }  
    $companyName = $CI->input->post('comp_name');
    $userName = remove_spec_chars($companyName);
    $stdCode = $CI->input->post('stdcode');
    $telephone = $stdCode.'-'.$CI->input->post('telephone');
    
    return $CI->User_model->saveUser(array(
                'FIRST_NAME' => $CI->input->post('first_name'),
                'LAST_NAME' => $CI->input->post('last_name'),
                'USER_NAME' => $userName,
                'EMAIL_ID' => $CI->input->post('email_id'),
                'PASS_WORD' => $CI->encrypt->my_encode($CI->input->post('pass_word')),
                'USER_ROLE' => $CI->input->post('user_role'),
                'MOBILE' => $CI->input->post('mobile'),
                'ADDRESS' => $CI->input->post('address'),
                'CITY' => $CI->input->post('city'),
                'STATE' => $CI->input->post('state'),
                'TELEPHONE' => $telephone,
                'USER_CREATED' => date('Y-m-d H:i:s'),
                'COMP_NAME' => $CI->input->post('comp_name'),
                'WEBSITE' => $websiteName,
                'MEM_GJEPC_NO' => $CI->input->post('gjepc_mem_no'),
                'MEM_GJF_NO' => $CI->input->post('gjf_mem_no'),
                'MEM_LOC_ASS_NAME' => $CI->input->post('mem_loc_ass_name'),
                'MEM_LOC_ASS_CITY' => $CI->input->post('mem_loc_ass_city'),
                'PINCODE' => $CI->input->post('pincode')
    ));
}


function updateCache($user_id) {
    $CI = & get_instance();
    $user = $CI->User_model->getUserById($user_id);
    setUserSession($user);
}

function change_pwd() {
    $CI = & get_instance();
    return $CI->User_model->updateUser(array(
                'PASS_WORD' => md5($CI->input->post('pass_word'))
                    ), ses_data('user_id'));
}

function is_user_logged() {
    return ses_data('user_id');
}

function save_settings() {
    $CI = & get_instance();
    $user_id = ses_data('user_id');
    $path = 'uploads/' . $user_id . '/';
    $logo = '';
    if (isset($_FILES['logo']["name"])) {
        $logo = upload_file('logo', $path, 'logo.png');
        $logo = $path . $logo;
    }
    return $CI->User_model->saveSettings(array(
                'USER_ID' => $user_id,
                'LOGO' => $logo,
                'HEADER_NAME' => $CI->input->post('store_title')), $user_id);
}

