<?php

include_once( APPPATH . 'controllers/master/masterProduct' . EXT );

class MasterUser extends MasterProduct {

    public function __construct() {
        parent::__construct();
    }
    
    public function logout() {
        $this->session->sess_destroy();
        redirect('index');
    }

    public function approval() {
        if ($this->input->post()) {
            foreach ($this->input->post('users') as $user_id) {
                $flag = $this->User_model->updateUser(array('IS_ACTIVE' => 1), $user_id);
                if ($flag) {
                    $user = $this->User_model->getUserById($user_id);
                    $this->email->send_activated_email($user);
                }
            }
        }

        $data['title'] = 'Master Admin';
        $data['site_user_name'] = '';
        $data['ses_det'] = $this->session->all_userdata();
        $data['userArr'] = $this->User_model->un_approval_users();
        loadMasterView('user/approval', $data, false);
    }

}
