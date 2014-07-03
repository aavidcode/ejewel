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