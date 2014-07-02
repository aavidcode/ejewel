<?php

include_once( APPPATH . 'controllers/common' . EXT );

class User extends Common {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->helper(array('user', 'util'));
    }

    public function home($site_user_name) {
        $site_user_id = $this->User_model->getUserID($site_user_name);
        if ($site_user_id) {
            ses_set('site_user_id', $site_user_id);
            $data = getCommonData($site_user_name);
            $data['title'] = "Home Page";
            load_view('user/home', $data);
        } else {
            $data['title'] = "Page Not Found";
            $data['site_user_name'] = '';
            load_view('user/page_error', $data);
        }
    }

    public function check_data() {
        $type = $this->input->post('type');
        $val = $this->input->post('val');
        $flag = false;
        if ($type == 'email') {
            $flag = $this->User_model->isEmailExist($val);
        } else if ($type == 'domain_name') {
            $flag = $this->User_model->isUserExist($val);
        }
        $res['error'] = $flag;
        $res['message'] = ($flag ? $type . ' is already exists' : '');
        $this->output->set_content_type('application/json')->set_output(json_encode($res));
    }

    public function register() {
        if ($this->input->post()) {
            $user_id = create_user();
            $user = $this->User_model->getUserById($user_id);
            if ($user) {
                $this->email->send_reg_email($user);
                $res['error'] = false;
                $res['redirect'] = 'user/thankyou';
            } else {
                $res['error'] = true;
                $res['message'] = 'Failed to create account';
            }
            $this->output->set_content_type('application/json')->set_output(json_encode($res));
        } else {
            $data['title'] = "User Registration Page";
            $data['site_user_name'] = '';
            $data['hide_menu'] = true;
            $data['hide_search'] = true;
            $data['user_data'] = $this->session->all_userdata();
            load_view('user/register', $data);
        }
    }

    public function login($role = 2) {
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
            $this->output->set_content_type('application/json')->set_output(json_encode($res));
        } else {
            $data = getCommonData();
            $data['title'] = "Login Page";
            load_view('user/login', $data);
        }
    }

    public function logout() {
        $user_name = ses_data('user_name');
        $this->session->sess_destroy();
        redirect('user/home/' . $user_name);
    }

    public function dashboard() {
        if (!is_user_logged()) {
            redirect('user/login');
        }
        $data = getCommonData();
        $data['title'] = "Dashboard";
        load_view('user/myaccount/dashboard', $data);
    }

    public function settings() {
        if (!is_user_logged()) {
            redirect('user/login');
        }

        if ($this->input->post('submit')) {
            if (save_settings()) {
                $user_name = ses_data('user_name');
                echo 'user/home/' . $user_name;
            }
        } else {
            $data = getCommonData();
            $data['title'] = "User Settings";
            load_view('user/settings', $data);
        }
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

    public function demo() {
        $data['title'] = 'fdasf';
        $this->load->view('user/demo');
    }

    public function search() {
        $val = $this->input->get('search');
        $res = $this->User_model->search_results($val);
        $this->output->set_content_type('application/json')->set_output(json_encode($res));
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

    public function thankyou() {
        $data['title'] = 'User Activation';
        $data['site_user_name'] = '';
        $data['hide_menu'] = true;
        $data['user_data'] = $this->session->all_userdata();

        load_view('user/thankyou', $data);
    }

    public function del_img() {
        $user_id = ses_data('user_id');
        $img = $this->input->post('img');
        $userSet = $this->User_model->user_settings($user_id);
        $path = 'uploads/' . $user_id . '/banner';
        $banner_imgs = del_prod_image($userSet->BANNERS, $img, $path);
        $this->User_model->saveSettings(array(
            'BANNERS' => $banner_imgs
                ), $user_id);
        $res['error'] = false;
        $this->output->set_content_type('application/json')->set_output(json_encode($res));
    }

    public function email($user_id) {
//        $this->email->from('info@shrinathjibombaywala.in', 'Shrinathji Bombaywala');
//        $this->email->to('laxman1224@gmail.com');
//        $this->email->subject('Test Mail');
//        $this->email->message('Test Body');
//        if ($this->email->send()) {
//            echo("Mail Sent");
//        } else {
//            echo($this->email->print_debugger()); //Display errors if any
//        }

        $user = $this->User_model->getUserById($user_id);
        send_user_reg_mail($user);
    }

}
