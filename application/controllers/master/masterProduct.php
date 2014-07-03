<?php

include_once( APPPATH . 'controllers/component' . EXT );

class MasterProduct extends Component {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('master/user', 'master/product'));
    }
}