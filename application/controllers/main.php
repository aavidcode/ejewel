<?php

include_once( APPPATH . 'controllers/main/mainUser' . EXT );

class main extends MainUser {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $data['web_title'] = $this->config->item('website_title');
        $this->load->view('index', $data);
    }

    public function home($site_user_name) {
        $site_user_id = $this->User_model->getUserID($site_user_name);
        if ($site_user_id) {
            ses_data('site_user_id', $site_user_id);
            $data = getSiteCommonData($site_user_name);
            $data['title'] = "Home Page";
            loadMainView('user/home', $data);
        } else {
            $data['title'] = "Page Not Found";
            $data['site_user_name'] = '';
            loadMainView('user/page_error', $data);
        }
    }

    public function activate($key) {
        $userArr = explode('_', $key);
        $user_name = strrev($userArr[0]);
        $user_id = $userArr[1];
        $success = false;
        $first_name = 'User';
        if (md5($user_name) != $userArr[2]) {
            $message = 'Invalid token key';
        } else {
            $userArr = $this->User_model->getUserById($user_id);
            $first_name = $userArr->FIRST_NAME;
            if ($userArr) {
                if ($userArr->IS_VERIFIED) {
                    $message = 'Your email is already activated.';
                } else {
                    $this->User_model->updateUser(array(
                        'IS_VERIFIED' => 1
                            ), $user_id);
                    $message = 'Your email is actived. Admin approval is pending';
                }
                $success = true;
            } else {
                $message = 'User is not exists';
            }
        }
        $data['title'] = 'User Activation';
        $data['first_name'] = $first_name;
        $data['act_user_name'] = $user_name;
        $data['message'] = $message;
        $data['success'] = $success;
        $data['site_user_name'] = '';
        $data['hide_menu'] = true;
        loadMainView('activate', $data);
    }

    public function thankyou() {
        $data['web_title'] = $this->config->item('website_title');
        $data['title'] = 'Thank you';
        $data['top_menu'] = false;
        $data['footer_menu'] = false;
        loadMainView('user/thankyou', $data);
    }

}
