<?php

include_once( APPPATH . 'controllers/component' . EXT );

class MasterComponent extends Component {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('master/user', 'master/product'));
    }
    
    //Apeksha Lad Dated : 4nd July 2014::10.45AM  
    public function generalComponent() {
        $data = getMasterCommonData();
        $data['title'] = 'Master Admin'; 
        $data['priceArr'] = $this->Product_model->price_type();
        $data['productArr'] = $this->Product_model->prod_type();
        loadMasterView("procomponent/category", $data);
    }
    
    public function metalComponent() {
        $data = getMasterCommonData();
        $data['title'] = 'Master Admin'; 
        $data['metalArr'] = $this->Product_model->comp_types(1);
        loadMasterView("procomponent/metal", $data);
    }
    public function diamondComponent() {
        $data = getMasterCommonData();
        $data['title'] = 'Master Admin'; 
        $data['stoneTypeArr'] = $this->Product_model->stone_type();
        $data['stoneClarityArr'] = $this->Product_model->stone_clarity();
        $data['stoneColorArr'] = $this->Product_model->stone_color();
        $data['stoneCutArr'] = $this->Product_model->stone_cut();
        $data['stoneShapeArr'] = $this->Product_model->stone_shape();
        $data['stoneSizeArr'] = $this->Product_model->stone_size();
        $data['stoneFluorescenceArr'] = $this->Product_model->stone_fluorescence();
        $data['stonePlacementArr'] = $this->Product_model->stone_placement();
        $data['stoneSizeToArr'] = $this->Product_model->stone_seiv_size_to();
        $data['stoneSizeFromArr'] = $this->Product_model->stone_seiv_size_from();
        loadMasterView("procomponent/stone", $data);
    }
    public function coloredStoneComponent() {
        $data = getMasterCommonData();
        $data['title'] = 'Master Admin'; 
        $data['cStoneColorArr'] = $this->Product_model->c_stone_color();
        $data['cStoneCatArr'] = $this->Product_model->c_stone_category();
        $data['cStoneTypeArr'] = $this->Product_model->cstone_type();
        $data['cStoneCutArr'] = $this->Product_model->c_stone_cut();
        loadMasterView("procomponent/coloredStone", $data);
    }
}