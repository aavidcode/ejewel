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
    protected $stone_size = null;
    protected $stone_seiv_size_from = null;
    protected $stone_seiv_size_to = null;
    protected $stone_fluorescence = null;
    protected $stone_placement = null;
    //Apeksha Lad Dated : 11nd July 2014::16.52PM 
    protected $stone_setting = null;
    //Colored Stone
    protected $c_stone_category = null;
    protected $c_stone_color = null;
    protected $c_stone_cut = null;
    protected $metal_quality = null;
    protected $jewel_type = null;
    protected $certification = null;
    protected $hallmark = null;
    protected $hallmark_center = null;

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

    public function stone_size() {
        return $this->stone_size;
    }

    public function stone_seiv_size_from() {
        return $this->stone_seiv_size_from;
    }

    public function stone_seiv_size_to() {
        return $this->stone_seiv_size_to;
    }

    public function stone_fluorescence() {
        return $this->stone_fluorescence;
    }

    public function stone_placement() {
        return $this->stone_placement;
    }

    //Apeksha Lad Dated : 11nd July 2014::16.52PM 

    public function stone_setting() {
        return $this->stone_setting;
    }

    public function c_stone_category() {
        return $this->c_stone_category;
    }

    public function c_stone_color() {
        return $this->c_stone_color;
    }

    public function c_stone_cut() {
        return $this->c_stone_cut;
    }

    public function metal_quality() {
        return $this->metal_quality;
    }

    public function jewel_type() {
        return $this->jewel_type;
    }

    public function certification() {
        return $this->certification;
    }

    public function hallmark() {
        return $this->hallmark;
    }

    public function hallmark_center() {
        return $this->hallmark_center;
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

    public function stone_placement_val($id) {
        return $this->stone_placement[$id]->PLAC_NAME;
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
        $this->stone_size = $this->Product_model->stone_size();
        $this->stone_seiv_size_from = $this->Product_model->stone_seiv_size_from();
        $this->stone_seiv_size_to = $this->Product_model->stone_seiv_size_to();
        $this->stone_fluorescence = $this->Product_model->stone_fluorescence();
        $this->stone_placement = $this->Product_model->stone_placement();

        //Apeksha Lad Dated : 11nd July 2014::16.52PM 
        $this->stone_setting = $this->Product_model->stone_setting();

        //Colored Stone
        $this->c_stone_category = $this->Product_model->c_stone_category();
        $this->c_stone_color = $this->Product_model->c_stone_color();
        $this->c_stone_cut = $this->Product_model->c_stone_cut();

        $this->metal_quality = $this->Product_model->metal_quality();
        $this->jewel_type = $this->Product_model->jewel_type();
        $this->certification = $this->Product_model->certification();
        $this->hallmark = $this->Product_model->hallmark();
        $this->hallmark_center = $this->Product_model->hallmark_center();
    }

    public function comp_types($id) {
        return $this->component_type[$id]->COMP_TYPE_NAME;
    }

    public function metal_quality_val($id, $type) {
        if ($type == '1') {
            return $this->metal_quality[$id]->MQ_KARAT;
        }
        return $this->metal_quality[$id]->MQ_PURITY;
    }

    public function data_table($table) {
        return $this->Product_model->getDataByTable($table);
    }

}
