<?php

function getMasterCommonData() {
    $CI = & get_instance();
    $data['web_title'] = $CI->config->item('website_title');
    $data['ses_det'] = $CI->session->all_userdata();
    return $data;
}