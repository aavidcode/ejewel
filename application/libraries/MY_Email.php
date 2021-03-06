<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MY_Email extends CI_Email {

    private $CI;

    public function __construct($param) {
        parent::__construct($param);
        $this->CI = & get_instance();
    }

    public function send_user_reg_mail($user) {
        $user_name = $user->USER_NAME;
        $act_key = strrev($user_name) . '_' . $user->USER_ID . '_' . md5($user_name);

        $user->ACT_URL = base_url() . 'main/activate/' . $act_key;
        $user->URL = base_url();
        $user->PASS_WORD = $this->CI->encrypt->my_decode($user->PASS_WORD);
        $user->TITLE = $this->CI->config->item('website_title');
        $dataArr['user'] = $user;
        
        $this->from($this->CI->config->item('info_email'));
        $this->to($user->EMAIL_ID, $user->FIRST_NAME);
        $this->subject('Welcome to ' . $user->TITLE.' Please verify your email address');
        $mailbody = $this->CI->load->view('templates/email/user_reg', $dataArr, true);
        $this->message($mailbody);
        return $this->send();
    }

    public function send_admin_reg_mail($user) {
        $user->URL = base_url();
        $user->TITLE = $this->CI->config->item('website_title');
        $dataArr['user'] = $user;

        $this->from($this->CI->config->item('info_email'));
        $this->to($this->CI->config->item('admin_email'));
        $this->subject($user->TITLE . ' :: New User Created');
        
        $mailbody = $this->CI->load->view('templates/email/admin_reg', $dataArr, true);
        $this->message($mailbody);
        return $this->send();
    }

    public function send_activated_email($user) {
        $user->URL = base_url();
        $user->PASS_WORD = $this->CI->encrypt->my_decode($user->PASS_WORD);
        $user->TITLE = $this->CI->config->item('website_title');
        $dataArr['user'] = $user;
        
        $this->from($this->CI->config->item('info_email'));
        $this->to($user->EMAIL_ID, $user->FIRST_NAME);
        $this->subject($user->TITLE.'- Your Account has been approved');

        $mailbody = $this->CI->load->view('templates/email/activate_email', $dataArr, true);
        $this->message($mailbody);
        return $this->send();
    }
    
    //Apeksha Lad Dated : 2nd July 2014::17.00PM
    
     public function send_deactivated_email($user) {
        $user->URL = base_url();
        $user->PASS_WORD = $this->CI->encrypt->my_decode($user->PASS_WORD);
        $user->TITLE = $this->CI->config->item('website_title');
        $dataArr['user'] = $user;
        
        $this->from($this->CI->config->item('info_email'));
        $this->to($user->EMAIL_ID, $user->FIRST_NAME);
        $this->subject('Deactivated Email :: ' . $user->TITLE);

        $mailbody = $this->CI->load->view('templates/email/deactivate_email', $dataArr, true);
        $this->message($mailbody);
        return $this->send();
    }
    
    //Apeksha Lad Dated : 10nd July 2014::14.00PM
    public function send_forgetpassword_email($user) {
        $user->URL = base_url();
        $user->PASS_WORD = $this->CI->encrypt->my_decode($user->PASS_WORD);
        $user->TITLE = $this->CI->config->item('website_title');
        $dataArr['user'] = $user;
        
        $this->from($this->CI->config->item('info_email'));
        $this->to($user->EMAIL_ID, $user->FIRST_NAME);
        $this->subject('Forget Password Email :: ' . $user->TITLE);

        $mailbody = $this->CI->load->view('templates/email/forget_pwd_email', $dataArr, true);
        $this->message($mailbody);
        return $this->send();
    }
}
