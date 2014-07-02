<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Pages extends CI_Controller {
    
    function view($page = 'home') {
        
        $this->load->helper('url'); 
        /*if (file_exists('application/views/pages/'.$page.'.php')) {
            show_404();
        }*/
        
        $data['title'] = $page;
        $this->load->view('templates/header', $data);
        $this->load->view('templates/nav');
        $this->load->view('pages/'.$page, $data);
        $this->load->view('templates/footer');
    }
}
?>