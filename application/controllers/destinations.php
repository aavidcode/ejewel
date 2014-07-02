<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Destinations extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('destinations_model');
    }

    function index() {
        $this->load->helper('url');
        $data['title'] = "Destinations";

        $data['results'] = $this->destinations_model->get_destinations();
        $this->load->view('templates/header', $data);
        $this->load->view('destinations', $data);
        $this->load->view('templates/footer', $data);
    }

    function json() {
        $data['results'] = $this->destinations_model->get_destinations();
        $this->load->view('utils/JSON_Collection', $data);
    }

    function xml() {
        $data['results'] = $this->destinations_model->get_destinations();
        $this->load->view('utils/XML_Collection', $data);
    }

    function rss() {
       $this->load->library('parser');
        $this->load->helper('url');
        $data = array(
            'blog_title' => 'Hot Destinations',
            'blog_description' => 'Description',
            'blog_link' => base_url(),
            'link_self' => base_url() . 'destinations/rss',
            'last_build_date' => date(DATE_RSS),
            'blog_pub_date' => date(DATE_RSS),
            'ttl' => 1180,
            'items' => $this->destinations_model->get_rss_destinations()
        );
        $this->parser->parse('utils/RSS_Feed', $data);
    }

}

?>