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

    public function register() {
        if ($this->input->post()) {
            $user_id = create_user();
            $user = $this->User_model->getUserById($user_id);
            if ($user) {
                $this->email->send_reg_email($user);
                $res['error'] = false;
                $res['redirect'] = 'main/thankyou';
            } else {
                $res['error'] = true;
                $res['message'] = 'Failed to create account';
            }
            json_output($res);
        } else {
            $data['title'] = "User Registration Page";
            $data['site_user_name'] = '';
            $data['top_menu'] = false;
            $data['footer_menu'] = false;
            loadMainView('user/register', $data);
        }
    }

    public function login($user_name, $user_id) {
        if ($this->input->post()) {
            $user = $this->User_model->validateLogin($this->input->post('user_name'), $this->encrypt->my_encode($this->input->post('pass_word')));
            $message = validate_user($user, $role);
            if ($message == "") {
                setUserSession($user);
                $res['error'] = false;
                $res['redirect'] = 'admin/dashboard';
            } else {
                $res['error'] = true;
                $res['message'] = $message;
            }
            json_output($res);
        } else {
            $data = getSiteCommonData();
            $data['title'] = "Login Page";
            $data['top_menu'] = false;
            $data['footer_menu'] = false;
            $data['user_id'] = $user_id;
            loadMainView('user/login', $data);
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
