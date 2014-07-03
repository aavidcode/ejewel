<?php

include_once( APPPATH . 'controllers/admin/adminUser' . EXT );

class Admin extends AdminUser {

    public function __construct() {
        parent::__construct();
    }
    
    public function dashboard() {
        $data = getAdminCommonData();
        $data['title'] = 'Title ';
        loadAdminView('dashboard', $data);
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
            loadAdminView('user/settings', $data);
        }
    }

    public function search() {
        $val = $this->input->get('search');
        $res = $this->User_model->search_results($val);
        $this->output->set_content_type('application/json')->set_output(json_encode($res));
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
