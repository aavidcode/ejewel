<?php

include_once( APPPATH . 'controllers/admin/adminProduct' . EXT );

class AdminUser extends AdminProduct {

    public function __construct() {
        parent::__construct();
    }

    public function logout() {
        $user_name = ses_data('user_name');
        $this->session->sess_destroy();
        redirect('main/login/');
    }

    /* public function per_det() {
      if ($this->input->post()) {
      if (update_user()) {
      updateCache(ses_data('user_id'));
      }
      $res['error'] = false;
      $res['message'] = 'Updated details successfully';
      $res['redirect'] = 'user/home/' . ses_data('user_name');
      $this->output->set_content_type('application/json')->set_output(json_encode($res));
      } else {
      $data = getAdminCommonData();
      updateCache(ses_data('user_id'));
      $data['title'] = "Personal Details";
      loadAdminView('user/myaccount/personal_det', $data);
      }
      } */

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

    //Apeksha Lad Dated : 10th July 2014::15.00PM 
    public function per_det() {
        if ($this->input->post()) {
            editAdminUserPost(ses_data('user_id'));
            $res['error'] = false;
            $res['message'] = 'Updated details successfully';
            $res['redirect'] = 'admin/pre_det';
            json_output($res);
        } else {
            editAdminUserUI(ses_data('user_id'));
        }
    }

    public function change_pwd() {
        if ($this->input->post()) {
            change_pwd();
            $res['error'] = false;
            $res['message'] = 'Password changed successfully';
            $res['redirect'] = 'admin/dashboard/';
            json_output($res);
        } else {
            $data = getAdminCommonData();
            $data['title'] = "Change Password";
            loadAdminView('user/myaccount/change_pwd', $data);
        }
    }

    public function forget_pwd() {
        if ($this->input->post()) {
            $email_id = $this->input->post('email_id');
            $user = $this->User_model->getUserByEmail($email_id);
            if ($user) {
                $this->email->send_forgetpassword_email($user);
                echo 'ok';
            } else {
                echo "Invalid email-id provided";
            }
        }
    }

}
