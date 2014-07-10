<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once( APPPATH . 'models/component_model' . EXT );

class Product_model extends Component_model {

    public function add_prod($data) {
        $this->db->insert(self::MF_PROD_SUMMARY, $data);
        return $this->db->insert_id();
    }

    public function add_prod_comp($data) {
        $this->db->insert(self::MF_PROD_COMPONENT, $data);
        return $this->db->insert_id();
    }

    public function update_prod($data, $prod_id) {
        return $this->db->update(self::MF_PROD_SUMMARY, $data, "PROD_ID = " . $prod_id);
    }

    public function update_images($prod_id, $thumb_def, $thumb, $large, $flag = false) {
        if ($flag) {
            $sql = "update " . self::MF_PROD_SUMMARY . " set PROD_DEF_THUMB= ?, PROD_THUMBS= ?, PROD_IMAGES=? where PROD_ID=?";
            return $this->db->query($sql, array($thumb_def, $thumb, $large, $prod_id));
        } else {
            $sql = "update " . self::MF_PROD_SUMMARY . " set PROD_THUMBS=concat(PROD_THUMBS, ?), PROD_IMAGES=concat(PROD_IMAGES, ?) where PROD_ID=?";
            return $this->db->query($sql, array(';' . $thumb, ';' . $large, $prod_id));
        }
    }

    public function clear_comp_dets($prod_id) {
        $comp_arr = $this->prod_comp_dets($prod_id);
        foreach ($comp_arr as $arr) {
            $this->db->delete('mf_prod_' . $arr->COMP_TABLE, array('PROD_ID' => $prod_id));
        }
        $this->db->delete(self::MF_PROD_COMPONENT, array('PROD_ID' => $prod_id));
        $this->db->delete(self::MF_PROD_OTHER_CHARGES, array('PROD_ID' => $prod_id));
    }

    public function get_products($where) {
        $sql = "SELECT a.*, b.CAT_NAME, c.PRICE_TYPE_NAME, d.PROD_TYPE_NAME FROM " . self::MF_PROD_SUMMARY . " a 
                left join " . self::CATEGORY . " b on a.CAT_ID = b.CAT_ID 
                left join " . self::PRICE_TYPE . " c on a.PRICE_TYPE_ID = c.PRICE_TYPE_ID
                left join " . self::PROD_TYPE . " d on a.PROD_TYPE_ID = d.PROD_TYPE_ID where " . $where;
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function product_details($prod_id) {
        $query = $this->db->get_where(self::MF_PROD_SUMMARY, array('PROD_ID' => $prod_id));
        return $query->row();
    }
    
    public function getUserApprovedProds($user_id) {
        $query = $this->db->get_where(self::MF_PROD_SUMMARY, array('MF_USER_ID' => $user_id, 'PROD_STATUS' => 1));
        return $query->result();
    }

    public function search_results($val) {
        $sql = "select PROD_ID, PROD_NAME from " . self::MF_PROD_SUMMARY . " where PROD_NAME like '%" . $val . "%'";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function prod_comp_dets($prod_id) {
        $query = $this->db->get_where(self::MF_PROD_COMPONENT, array('PROD_ID' => $prod_id));
        return $query->result();
    }

    public function prod_metal_dets($prod_id) {
        $query = $this->db->get_where(self::MF_PROD_METAL, array('PROD_ID' => $prod_id));
        return $query->result();
    }

    public function prod_stone_dets($prod_id) {
        $query = $this->db->get_where(self::MF_PROD_STONE, array('PROD_ID' => $prod_id));
        return $query->result();
    }

    public function prod_colored_stone_dets($prod_id) {
        $query = $this->db->get_where(self::MF_PROD_COLORED_STONE, array('PROD_ID' => $prod_id));
        return $query->result();
    }

    public function prod_labour_dets($prod_id) {
        $query = $this->db->get_where(self::MF_PROD_LABOR, array('PROD_ID' => $prod_id));
        return $query->result();
    }
    
    public function mf_prod_other_charges($prod_id) {
        $query = $this->db->get_where(self::MF_PROD_OTHER_CHARGES, array('PROD_ID' => $prod_id));
        return $query->result();
    }

    public function mf_prod_component($prod_id) {
        $sql = "select a.P_COMP_ID, a.COMP_ID, a.COMP_TABLE, b.COMP_NAME, b.COMP_CODE, c.COMP_TYPE_ID, c.COMP_TYPE_NAME from " . self::MF_PROD_COMPONENT . " a inner join " . self::COMPONENT . " b on a.COMP_ID = b.COMP_ID left join " . self::COMPONENT_TYPE . " c on a.COMP_TYPE_ID = c.COMP_TYPE_ID where a.PROD_ID = " . $prod_id;
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function get_comp_data($prod_id, $p_comp_id, $type) {
        $query = $this->db->get_where('mf_prod_' . $type, array('PROD_ID' => $prod_id, 'P_COMP_ID' => $p_comp_id));
        return $query->row();
    }

    public function add_prod_history($data) {
        return $this->db->insert(self::PROD_HISTORY, $data);
    }
    
    public function getUnApproveProdHistory($prod_id) {
        $query = $this->db->get_where(self::PROD_HISTORY, array('PROD_ID' => $prod_id, 'PH_STATUS' => 0));
        return $query->result();
    }
}
