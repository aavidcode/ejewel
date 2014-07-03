<?php

require_once('DBConstants.php');

use models\DBConstants;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class User_model extends CI_Model implements DBConstants {

    public function validateLogin($email_id, $password, $user_id) {
        $sql = "SELECT * FROM " . self::USER_TABLE . " WHERE EMAIL_ID = ? AND PASS_WORD = ? AND USER_ID = ?";
        $query = $this->db->query($sql, array($email_id, $password, $user_id));
        return $query->row();
    }

    public function saveUser($data) {
        $this->db->insert(self::USER_TABLE, $data);
        return $this->db->insert_id();
    }

    public function un_approval_users() {
        $query = $this->db->get_where(self::USER_TABLE, array(
            'IS_VERIFIED' => 1,
            'IS_ACTIVE' => 0
        ));
        return $query->result();
    }

    public function updateUser($data, $user_id) {
        return $this->db->update(self::USER_TABLE, $data, "USER_ID = " . $user_id);
    }

    public function getUserById($user_id) {
        $query = $this->db->get_where(self::USER_TABLE, array('USER_ID' => $user_id));
        return $query->row();
    }

    public function isUserExist($user_name) {
        return ($this->getUserID($user_name) != '');
    }

    public function getUserID($user_name) {
        $sql = "select USER_ID from " . self::USER_TABLE . " where USER_NAME='" . $user_name . "'";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $query = $query->row();
            return $query->USER_ID;
        }
        return '';
    }

    public function isEmailExist($email_id) {
        $sql = "select USER_ID from " . self::USER_TABLE . " where EMAIL_ID='" . $email_id . "'";
        $query = $this->db->query($sql);
        return ($query->num_rows() > 0);
    }

    public function getUserDetails($user_name) {
        $sql = "SELECT a.*, b.* FROM " . self::USER_TABLE . " a left join " . self::USER_STORE_SETTINGS . " b on a.USER_ID = b.USER_ID where a.USER_NAME='" . $user_name . "'";
        $query = $this->db->query($sql);
        return $query->row();
    }

    public function user_settings($user_id) {
        $query = $this->db->get_where(self::USER_STORE_SETTINGS, array('USER_ID' => $user_id));
        return $query->row();
    }

    public function saveSettings($data, $user_id) {
        $this->db->where('USER_ID', $user_id);
        $this->db->from(self::USER_STORE_SETTINGS);

        if ($this->db->count_all_results() > 0) {
            return $this->db->update(self::USER_STORE_SETTINGS, $data, "USER_ID = " . $user_id);
        } else {
            return $this->db->insert(self::USER_STORE_SETTINGS, $data);
        }
    }

    public function search_results($val) {
        $sql = "select USER_NAME, concat(FIRST_NAME, ' ', LAST_NAME) AS NAME from " . self::USER_TABLE . " where FIRST_NAME like '%" . $val . "%' OR LAST_NAME like '%" . $val . "%'";
        $query = $this->db->query($sql);
        return $query->result();
    }

}
