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
            validateLogin('master/approval');
        } else {
            loadMasterWithContent('login', $data);
        }
    }
}
