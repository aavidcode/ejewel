<?php

class Component extends CI_Controller {

    protected $component = null;
    protected $category = null;
    protected $component_type = null;
    protected $prod_type = null;
    protected $price_type = null;
    //Stone
    protected $stone_clarity = null;
    protected $stone_color = null;
    protected $stone_cut = null;
    protected $stone_shape = null;
    //Colored Stone
    protected $c_stone_type = null;
    protected $c_stone_category = null;
    protected $c_stone_color = null;

    public function __construct() {
        parent::__construct();
        $this->load->model(array('Product_model', 'User_model'));
        $this->load->library('email', array(
            'charset' => 'utf-8',
            'wordwrap' => TRUE,
            'mailtype' => 'html'
        ));
        $this->load->library('encrypt');
        $this->buildCache();
    }

    public function component() {
        return $this->component;
    }

    public function component_type() {
        return $this->component_type;
    }

    public function category() {
        return $this->category;
    }

    public function prod_type() {
        return $this->prod_type;
    }

    public function price_type() {
        return $this->price_type;
    }

    public function stone_clarity() {
        return $this->stone_clarity;
    }

    public function stone_color() {
        return $this->stone_color;
    }

    public function stone_cut() {
        return $this->stone_cut;
    }

    public function stone_shape() {
        return $this->stone_shape;
    }

    public function c_stone_type() {
        return $this->c_stone_type;
    }

    public function c_stone_category() {
        return $this->c_stone_category;
    }

    public function c_stone_color() {
        return $this->c_stone_color;
    }

    public function component_val($id) {
        return $this->component[$id];
    }

    public function category_val($id) {
        return $this->category[$id];
    }

    public function prod_type_val($id) {
        return $this->prod_type[$id];
    }

    public function price_type_val($id) {
        return $this->price_type[$id];
    }

    private function buildCache() {
        $this->component = $this->Product_model->components();
        $this->component_type = $this->Product_model->component_type();
        $this->category = $this->Product_model->category();
        $this->prod_type = $this->Product_model->prod_type();
        $this->price_type = $this->Product_model->price_type();

        //Stone
        $this->stone_clarity = $this->Product_model->stone_clarity();
        $this->stone_color = $this->Product_model->stone_color();
        $this->stone_cut = $this->Product_model->stone_cut();
        $this->stone_shape = $this->Product_model->stone_shape();

        //Colored Stone
        $this->c_stone_type = $this->Product_model->c_stone_type();
        $this->c_stone_category = $this->Product_model->c_stone_category();
        $this->c_stone_color = $this->Product_model->c_stone_color();
    }

    public function comp_types($comp_id) {
        return $this->Product_model->comp_types($comp_id);
    }

}
