<?php

include_once( APPPATH . 'controllers/main/mainProduct' . EXT );

class MainUser extends MainProduct {

    public function __construct() {
        parent::__construct();
    }

    public function demo() {
        echo $this->encrypt->my_encode('admin');
    }

    public function logout() {
        $user_name = ses_data('user_name');
        $user_id = ses_data('user_id');
        $this->session->sess_destroy();
        redirect('login/'.$user_name.'/'.$user_id);
    }
    
    public function login($user_name='', $user_id='') {
        if ($this->input->post()) {
            validateLogin('admin/dashboard');
        } else {
            $data = getSiteCommonData($user_name);
            $data['title'] = "Login Page";
            $data['top_menu'] = false;
            $data['hide_login'] = true;
            $data['footer_menu'] = false;
            $data['user_id'] = $user_id;
            loadMainView('user/login', $data);
        }
    }

    public function register() {
        if ($this->input->post()) {
            $user_id = create_user();
            $user = $this->User_model->getUserById($user_id);
            if ($user) {
                $this->email->send_user_reg_mail($user);
                $res['error'] = false;
                $res['redirect'] = 'main/thankyou';
            } else {
                $res['error'] = true;
                $res['message'] = 'Failed to create account';
            }
            json_output($res);
        } else {
            $data['title'] = "User Registration Page";
            //$data['state_opt'] = state_opt();
            $data['site_user_name'] = '';
            $data['site_user_id'] = '';
            $data['top_menu'] = false;
            $data['hide_login'] = true;
            $data['footer_menu'] = false;
            loadMainView('user/register', $data);
        }
    }

    public function checkRegisterdata() {
        $type = $this->input->post('type');
        $val = $this->input->post('val');
        $flag = false;
        if ($type == 'Email ID') {
            $flag = $this->User_model->isEmailExist($val);
        } else if ($type == 'Domain Name') {
            $flag = $this->User_model->isUserExist($val);
        }
        $res['error'] = $flag;
        $res['message'] = ($flag ? $type . ' is already exists' : '');
        $this->output->set_content_type('application/json')->set_output(json_encode($res));
    }

}
