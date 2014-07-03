<?php

include_once( APPPATH . 'controllers/admin/AdminProduct' . EXT );

class AdminUser extends AdminProduct {

    public function __construct() {
        parent::__construct();
    }

    public function logout() {
        $user_name = ses_data('user_name');
        $this->session->sess_destroy();
        redirect('user/home/' . $user_name);
    }
    
    public function per_det() {
        if ($this->input->post()) {
            if (update_user()) {
                updateCache(ses_data('user_id'));
            }
            $res['error'] = false;
            $res['message'] = 'Updated details successfully';
            $res['redirect'] = 'user/home/' . ses_data('user_name');
            $this->output->set_content_type('application/json')->set_output(json_encode($res));
        } else {
            $data = getCommonData();
            $data['title'] = "Personal Details";
            load_view('user/myaccount/personal_det', $data);
        }
    }

    public function change_pwd() {
        if ($this->input->post()) {
            change_pwd();
            $res['error'] = false;
            $res['message'] = 'Password changed successfully';
            $res['redirect'] = 'user/home/' . ses_data('user_name');
            $this->output->set_content_type('application/json')->set_output(json_encode($res));
        } else {
            $data = getCommonData();
            $data['title'] = "Change Password";
            load_view('user/myaccount/change_pwd', $data);
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
        $data['user_data'] = $this->session->all_userdata();

        load_view('user/activate', $data);
    }


}
