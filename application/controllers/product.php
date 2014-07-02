<?php

include_once( APPPATH . 'controllers/common' . EXT );

class Product extends Common {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('User_model'));
        $this->load->helper(array('util', 'user', 'product', 'ajax'));
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
        if ($req == 'prod_comp_view') {
            prod_comp_view();
        }
    }

    public function portfolio($prod_id) {
        $prod_sum_det = $this->Product_model->product_details($prod_id);
        $data = getCommonData();
        $data['title'] = $prod_sum_det->PROD_NAME;
        $data['prod_sum_det'] = $prod_sum_det;
        load_view('product/portfolio', $data);
    }

    public function collections() {
        $data = getCommonData();
        $data['title'] = 'Collections';
        $data['category'] = $this->category;
        $data['prod_type'] = $this->prod_type;
        load_view('product/collections', $data);
    }

    public function add() {
        if ($this->input->post()) {
            $prod_id = create_product();
            redirect('product/images/' . $prod_id);
        } else {
            $data = getCommonData();
            $data['title'] = "Add Product";
            $data['component'] = $this->component;
            $data['category_opt'] = cat_opt($this->category);
            $data['prod_type_opt'] = prod_type_opt($this->prod_type);
            $data['price_type_opt'] = price_type_opt($this->price_type);
            admin_load_view('product/add_product', $data);
        }
    }

    public function sub_comp_types() {
        $c_type_id = $this->input->post('selVal');
        $str = '';
        
        foreach ($this->component as $comp) {
            if ($c_type_id == $comp->COMP_ID) {
                $str .= $comp->COMP_ID . '#' . $comp->COMP_NAME . '@';
            }
        }
        
        json_output(array(
            'error' => false,
            'msg' => substr($str, 0, strlen($str) - 1)
        ));
    }

    public function images($prod_id) {
        if ($this->input->post()) {
            create_images($prod_id);
            echo 'user/' . ses_data('user_name');
        } else {
            $data = getCommonData();
            $data['title'] = "Add Product";
            load_view('product/add_images', $data);
        }
    }

    public function del_img() {
        $prod_id = $this->input->post('prod_id');
        $img = $this->input->post('img');
        $prodArr = $this->Product_model->product_details($prod_id);
        $path = 'uploads/' . ses_data('user_id') . '/' . $prod_id;
        $thumb_img = del_prod_image($prodArr->PROD_THUMBS, 'thumb_' . $img, $path);
        $prod_img = del_prod_image($prodArr->PROD_IMAGES, $img, $path);
        $thumbArr = explode(';', $thumb_img);
        $this->Product_model->update_images($prod_id, $thumbArr[0], $thumb_img, $prod_img, true);
        $res['error'] = false;
        $this->output->set_content_type('application/json')->set_output(json_encode($res));
    }

    public function def_img() {
        $prod_id = $this->input->post('prod_id');
        $img = $this->input->post('img');
        $res['error'] = false;
        $this->output->set_content_type('application/json')->set_output(json_encode($res));
    }

    public function search() {
        $val = $this->input->get('search');
        $res = $this->Product_model->search_results($val);
        $this->output->set_content_type('application/json')->set_output(json_encode($res));
    }

}
