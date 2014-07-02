<?php

include_once( APPPATH . 'controllers/product' . EXT );

class Admin extends Product {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('Product_model', 'User_model'));
        $this->load->helper(array('util', 'user', 'product'));
    }

    public function index() {
        $data['title'] = 'Master Admin';
        $data['site_user_name'] = '';
        $data['hide_menu'] = true;
        $data['user_data'] = $this->session->all_userdata();

        if ($this->input->post()) {
            $user_name = $this->input->post('user_name');
            $pass_word = $this->input->post('pass_word');
            if ($user_name == 'admin' && $pass_word == 'admin') {
                $res['error'] = false;
                $res['redirect'] = 'admin/approval';
            } else {
                $res['error'] = true;
                $res['message'] = 'Invalid Login';
            }
            $this->output->set_content_type('application/json')->set_output(json_encode($res));
        } else {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/nav', $data);
            $this->load->view('admin/master_login', $data);
            $this->load->view('templates/footer');
        }
    }

    public function approval() {
        if ($this->input->post()) {
            foreach ($this->input->post('users') as $user_id) {
                $flag = $this->User_model->updateUser(array('IS_ACTIVE' => 1), $user_id);
                if ($flag) {
                    $user = $this->User_model->getUserById($user_id);
                    $this->email->send_activated_email($user);
                }
            }
        }

        $data['title'] = 'Master Admin';
        $data['site_user_name'] = '';
        $data['hide_menu'] = true;
        $data['hide_search'] = true;
        $data['user_data'] = $this->session->all_userdata();
        $data['userArr'] = $this->User_model->un_approval_users();
        admin_load_view('admin/master/approval', $data, false);
    }

    public function products($prod_id = '') {
        if ($prod_id != '') {
            if ($prod_id == 'add') {
                add_prod();
            } else {
                update_or_view($prod_id);
            }
        } else {
            show_all();
        }
    }

    public function demo() {
        echo 'prod_name: ' . $this->input->post('prod_name') . '<br>';
        echo 'prod_price: ' . $this->input->post('price_type');
    }

    public function dashboard() {
        $data = getCommonData();
        $data['title'] = 'Title ';
        admin_load_view('admin/dashboard', $data);
    }

    public function upload_banner() {
        $folder_name = 'banner';
        $targetFolder = $this->input->post('path') . $folder_name . '/';

        $verifyToken = md5('unique_salt' . $this->input->post('timestamp'));

        if (!empty($_FILES) && $this->input->post('token') == $verifyToken) {
            $file_name = upload_file('Filedata', $targetFolder, date('YmdHis') . '.jpg');
            if ($file_name != '') {
                $user_id = ses_data('user_id');
                $userSetArr = $this->User_model->user_settings($user_id);
                if (!isset($userSetArr->BANNERS)) {
                    $banner = $file_name;
                } else {
                    $banner = $userSetArr->BANNERS . ';' . $file_name;
                }
                $this->User_model->saveSettings(array(
                    'BANNERS' => $banner,
                    'USER_ID' => $user_id
                        ), $user_id);
                echo $file_name;
            } else {
                echo '';
            }
        }
    }

    public function upload($prod_id) {
        if ($prod_id == 'img') {
            $prod_id = ses_data('prod_id');
        }
        $targetFolder = $this->input->post('path') . $prod_id . '/';

        $verifyToken = md5('unique_salt' . $this->input->post('timestamp'));

        if (!empty($_FILES) && $this->input->post('token') == $verifyToken) {
            $file_name = upload_file('Filedata', $targetFolder, date('YmdHis') . '.jpg');
            if ($file_name != '') {
                $thumb_img = '';
                if ($this->input->post('thumb') == '1') {
                    $thumb_img = create_thumb($targetFolder, $file_name, $targetFolder, 'thumb_' . $file_name, 300);
                }

                $prodArr = $this->Product_model->product_details($prod_id);
                $flag = ($prodArr->PROD_THUMBS == '');
                $this->Product_model->update_images($prod_id, $thumb_img, $thumb_img, $file_name, $flag);
                echo $targetFolder . $thumb_img;
            } else {
                echo '';
            }
        }
    }

}
