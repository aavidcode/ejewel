<?php

function create_user() {
    $CI = & get_instance();
    return $CI->User_model->saveUser(array(
                'FIRST_NAME' => $CI->input->post('first_name'),
                'LAST_NAME' => $CI->input->post('last_name'),
                'USER_NAME' => $CI->input->post('domain_f_name'),
                'EMAIL_ID' => $CI->input->post('email_id'),
                'PASS_WORD' => $CI->encrypt->my_encode($CI->input->post('pass_word')),
                'USER_ROLE' => $CI->input->post('user_role'),
                'MOBILE' => $CI->input->post('mobile'),
                'ADDRESS' => $CI->input->post('address'),
                'CITY' => $CI->input->post('city'),
                'STATE' => $CI->input->post('state'),
                'TELEPHONE' => $CI->input->post('telephone'),
                'USER_CREATED' => date('Y-m-d H:i:s'),
                'COMP_NAME' => $CI->input->post('comp_name'),
                'WEBSITE' => $CI->input->post('website'),
                'MEM_GJEPC_NO' => $CI->input->post('gjepc_mem_no'),
                'MEN_GJF_NO' => $CI->input->post('gjf_mem_no'),
                'MEM_LOC_ASS_NAME' => $CI->input->post('mem_loc_ass_name'),
                'MEM_LOC_ASS_CITY' => $CI->input->post('mem_loc_ass_city'),
                'PINCODE' => $CI->input->post('pincode'),
    ));
}

function update_user() {
    $CI = & get_instance();
    return $CI->User_model->updateUser(array(
                'FIRST_NAME' => $CI->input->post('first_name'),
                'LAST_NAME' => $CI->input->post('last_name'),
                'EMAIL_ID' => $CI->input->post('email_id'),
                'MOBILE' => $CI->input->post('mobile'),
                'ADDRESS' => $CI->input->post('address'),
                'TELEPHONE' => $CI->input->post('telephone'),
                'CITY' => $CI->input->post('city'),
                'STATE' => $CI->input->post('state')
                    ), ses_data('user_id'));
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

function setUserSession($user) {
    $CI = & get_instance();
    $CI->session->set_userdata('user_data', array(
        'first_name' => $user->FIRST_NAME,
        'email_id' => $user->EMAIL_ID,
        'user_role' => $user->USER_ROLE
    ));
    $CI->session->set_userdata('user_id', $user->USER_ID);
    $CI->session->set_userdata('user_name', $user->USER_NAME);
}

function getCommonData($site_user_name = '') {
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

function validate_user($user, $role) {
    if ($user) {
        if ($user->USER_ROLE === $role) {
            return "You don't have permissions to login";
        } else if (!$user->IS_VERIFIED) {
            return 'You email is not verified';
        } else if (!$user->IS_ACTIVE) {
            return "You account is not approved by admin";
        }
        return '';
    }
    return 'Invalid Login';
}
