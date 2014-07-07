<?php

include_once( APPPATH . 'controllers/master/masterUser' . EXT );

class Master extends MasterUser {

    public function __construct() {
        parent::__construct();
    }
    
    public function index() {
        $data['title'] = 'Master Admin';
        $data['site_user_name'] = '';
        $data['web_title'] = $this->config->item('website_title');
        $data['hide_left_menu'] = true;
        if ($this->input->post()) {
            validateLogin('master/dashboard');
        } else {
            loadMasterWithContent('login', $data);
        }
    }
    
    //Common edit and add component method
    public function compAjaxUpdate() {
        $req = $this->input->post('req');
        updateComponentDetails($req);
    }
    
    public function compAjaxAdd() {
        $req = $this->input->post('req');
        addComponentDetails($req);
    }
    
    //For Metal Component
        public function compAjaxAddMetal() {
        $req = $this->input->post('req');
        addMetalComponentDetails($req);
    }
    
    //For Colored Stone
    public function compAjaxAddCStone() {
        $req = $this->input->post('req');
        addCStoneComponentDetails($req);
    }
}
