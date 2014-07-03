<?php

include_once( APPPATH . 'controllers/component' . EXT );

class MainProduct extends Component {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('main/user', 'main/product'));
    }
    
    public function search() {
        $val = $this->input->get('search');
        $res = $this->Product_model->search_results($val);
        $this->output->set_content_type('application/json')->set_output(json_encode($res));
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
    
}