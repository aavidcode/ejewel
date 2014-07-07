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

    public function upload_prod_images($prod_id='') {
        if ($prod_id == '') {
            $prod_id = ses_data('prod_id');
        }
        $targetFolder = 'uploads/' . ses_data('user_id') . '/' . $prod_id . '/';

        $file_name = upload_file('file', $targetFolder, date('YmdHis') . '.jpg');
        if ($file_name != '') {
            $thumb_img = create_thumb($targetFolder, $file_name, $targetFolder, 'thumb_' . $file_name, 300);
            $prodArr = $this->Product_model->product_details($prod_id);
            $flag = ($prodArr->PROD_THUMBS == '');
            $this->Product_model->update_images($prod_id, $thumb_img, $thumb_img, $file_name, $flag);
            echo $targetFolder . $thumb_img;
        } else {
            echo '';
        }
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
