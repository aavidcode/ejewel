<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Destinations_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function get_destinations($limit = false) {
        $query = $this->db->get('destinations');
        return $query->result_array();
    }

    public function get_rss_destinations() {
        $this->load->helper('url');
        $this->db->select("*");
        $this->db->from('destinations');
        $query = $this->db->get();
        return $query->result_array();
    }
}

?>