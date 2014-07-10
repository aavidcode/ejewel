<?php

include_once( APPPATH . 'controllers/master/masterComponent' . EXT );

class MasterUser extends MasterComponent {

    public function __construct() {
        parent::__construct();
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('master/');
    }

    //Apeksha Lad Dated : 3nd July 2014::17.00PM

    public function dashboard() {
        if ($this->input->post()) {
            foreach ($this->input->post('users') as $user_id) {
                $flag = $this->User_model->updateUser(array('IS_ACTIVE' => 1), $user_id);
                if ($flag) {
                    $user = $this->User_model->getUserById($user_id);
                    $this->email->send_activated_email($user);
                }
            }
        }
        $data = getMasterCommonData();
        $data['title'] = 'Master Admin';
        $data['totalUserCount'] = $this->User_model->totalUserCount();
        $data['totalActiveUserCount'] = $this->User_model->totalUserCount(false, 0);
        loadMasterView("dashboard", $data);
    }

    public function approval($userRole, $status) {
        if ($this->input->post()) {
            if ($status == 0) {
                foreach ($this->input->post('users') as $user_id) {
                    $flag = $this->User_model->updateUser(array('IS_ACTIVE' => 1), $user_id);
                    if ($flag) {
                        $user = $this->User_model->getUserById($user_id);
                        $this->email->send_activated_email($user);
                    }
                }
            }
            if ($status == 1) {
                foreach ($this->input->post('users') as $user_id) {
                    $flag = $this->User_model->deactiveUser(array('IS_ACTIVE' => 0), $user_id);
                    if ($flag) {
                        $user = $this->User_model->getUserById($user_id);
                        $this->email->send_deactivated_email($user);
                    }
                }
            }
        }
        $data = getMasterCommonData();
        $data['title'] = 'Master Admin';
        $data['status'] = $status;
        $data['userRole'] = $userRole;
        $data['userArr'] = $this->User_model->app_disp_users($userRole, $status);
        loadMasterView("user/approval", $data);
    }

    public function listAll($userRole = 0) {
        $data = getMasterCommonData();
        $data['title'] = 'Master Admin';
        $data['userRole'] = $userRole;
        $data['userArr'] = $this->User_model->users_list($userRole);
        loadMasterView("user/userList", $data);
    }

        public function searchUserDetail($userRole = 0) {
        $data = getMasterCommonData();
        $data['title'] = 'Master Admin';
        $name = $this->input->post('name');
        $companyName = $this->input->post('company_name');
        $city = $this->input->post('city');
        $state = $this->input->post('state');
        $memGjepcNo = $this->input->post('mem_gjepc_no');
        $menGjfNo = $this->input->post('men_gjf_no');
        $memLocAssName = $this->input->post('mem_loc_ass_name');
        $data['userRole'] = $userRole;

        $where = '';

        if ($name != '') {
            $where .= "FIRST_NAME like '%" . $name . "%' or ";
        }

        if ($companyName != '') {
            $where .= "COMP_NAME like '%" . $companyName . "%' or ";
        }

        if ($city != '') {
            $where .= "CITY like '%" . $city . "%' or ";
        }
        
        if ($state != '') {
            $where .= "STATE like '%" . $state . "%' or ";
        }
       
        if ($memGjepcNo == 'Y') {
            $where .= "MEM_GJEPC_NO != '' or ";
        }
        
        if ($menGjfNo == 'Y') {
            $where .= "MEN_GJF_NO != '' or ";
        }
        
        if ($memLocAssName == 'Y') {
            $where .= "MEM_LOC_ASS_NAME != '' or ";
        }
        
        $where = substr($where, 0, strlen($where)-4);
        
        $data['userArr'] = $this->User_model->searchUser($where);
        loadMasterView("user/userList", $data);
    }
    
    //Apeksha Lad Dated : 8nd July 2014::10.53PM
    
    public function edit($userId) {
        if ($this->input->post()) {
            editUserPost($userId);
        }
        editUserUI($userId);
    }
    
}
