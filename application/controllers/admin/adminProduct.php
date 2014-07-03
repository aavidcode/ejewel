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
        } else if ($req == 'view') {
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
        if ($req == 'prod_comp_view') {
            prod_comp_view();
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

}
