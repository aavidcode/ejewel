<?php

include_once( APPPATH . 'controllers/component' . EXT );

class AdminProduct extends Component {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('admin/user', 'admin/product'));
    }

    public function product($req, $prod_id = '') {
        if ($req == 'add') {
            addProd();
        } else if ($req == 'update') {
            updateProd($prod_id);
        } else if ($req == 'viewAll') {
            viewAllProducts();
        }
    }

    function json() {
        $site_user_id = ses_data('site_user_id');
        $page = $this->input->post('page');
        $limit = 9;
        $offset = $page * $limit;
        $data = $this->Product_model->get_products(array(
            'MF_USER_ID' => $site_user_id
                ), $limit, $offset);
        echo json_encode($data);
    }

    public function ajax($req) {
        if ($req == 'c_stone_category') {
            getSubColorStonedTypes();
        }
    }

    public function upload_prod_images($prod_id = '') {
        if ($prod_id == '') {
            $prod_id = ses_data('prod_id');
        }
        $targetFolder = 'uploads/' . ses_data('user_id') . '/' . $prod_id . '/';
        if (!file_exists($targetFolder)) {
            mkdir($targetFolder, 0755, true);
        }

        $str = '';
        $thumb_img_str = '';
        $def_thumb_img = '';
        $img_str = '';
        $prodArr = $this->Product_model->product_details($prod_id);
        for ($i = 0; $i < count($_FILES['upload']['name']); $i++) {
            $tmpFilePath = $_FILES['upload']['tmp_name'][$i];
            $temp = explode(".", $_FILES['upload']['name'][$i]);
            $extension = end($temp);
            if ($tmpFilePath != "") {
                $newFileName = date('YmdHis') . '.' . $extension;
                $newFilePath = $targetFolder . $newFileName;
                if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                    $thumb_img = create_thumb($targetFolder, $newFileName, $targetFolder, 'thumb_' . $newFileName, 300);

                    if ($def_thumb_img == '') {
                        $def_thumb_img = $thumb_img;
                    }

                    $thumb_img_str .= $thumb_img . ';';
                    $img_str .= $newFileName . ';';
                    $str .= $targetFolder . $newFileName . '#' . $targetFolder . $thumb_img . ';';
                }
            }
        }
        $thumb_img_str = substr($thumb_img_str, 0, strlen($thumb_img_str) - 1);
        $img_str = substr($img_str, 0, strlen($img_str) - 1);
        $this->Product_model->update_images($prod_id, $def_thumb_img, $thumb_img_str, $img_str, ($prodArr->PROD_DEF_THUMB == ''));
        echo substr($str, 0, strlen($str) - 1);
    }

    public function prod_activate() {
        $prod_id = $this->input->post('prod_id');
        $status = $this->input->post('status');
        $flag = $this->Product_model->update_prod(array('PROD_STATUS' => !$status), $prod_id);
        json_output(array('error' => !$flag));
    }

    public function del_prod_img() {
        $prod_id = $this->input->post('prod_id');
        $img = $this->input->post('img');
        $prodArr = $this->Product_model->product_details($prod_id);
        $path = 'uploads/' . ses_data('user_id') . '/' . $prod_id;
        $thumb_img = del_prod_image($prodArr->PROD_THUMBS, 'thumb_' . $img, $path);
        $prod_img = del_prod_image($prodArr->PROD_IMAGES, $img, $path);
        $thumbArr = explode(';', $thumb_img);
        $this->Product_model->update_images($prod_id, $thumbArr[0], $thumb_img, $prod_img, true);
        json_output(array('error' => false));
    }

    public function def_img() {
        $prod_id = $this->input->post('prod_id');
        $img = $this->input->post('img');
        $res['error'] = false;
        $this->output->set_content_type('application/json')->set_output(json_encode($res));
    }

}
