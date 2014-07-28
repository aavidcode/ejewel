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
        $this->db->delete(self::MF_PROD_LABOR, array('PROD_ID' => $prod_id));
        $this->db->delete(self::MF_PROD_COMPONENT, array('PROD_ID' => $prod_id));
        $this->db->delete(self::MF_PROD_OTHER_CHARGES, array('PROD_ID' => $prod_id));
    }

    public function get_products($comp_join_queries, $where) {
        $sql = "SELECT a.*, b.CAT_NAME, c.PRICE_TYPE_NAME, d.PROD_TYPE_NAME FROM " . self::MF_PROD_SUMMARY . " a 
                left join " . self::CATEGORY . " b on a.CAT_ID = b.CAT_ID 
                left join " . self::PRICE_TYPE . " c on a.PRICE_TYPE_ID = c.PRICE_TYPE_ID
                left join " . self::PROD_TYPE . " d on a.PROD_TYPE_ID = d.PROD_TYPE_ID " . $comp_join_queries . " where " . $where;
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
        //$query = $this->db->get_where(self::MF_PROD_METAL, array('PROD_ID' => $prod_id));
        //return $query->result();
        $sql = "SELECT a.*, b.COMP_TYPE_NAME FROM " . self::MF_PROD_METAL . " a 
                left join " . self::COMPONENT_TYPE . " b on a.COMP_TYPE_ID = b.COMP_TYPE_ID where a.PROD_ID = $prod_id";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function prod_stone_dets($prod_id) {
        //$query = $this->db->get_where(self::MF_PROD_STONE, array('PROD_ID' => $prod_id));
        //return $query->result();
        $sql = "SELECT a.*, b.COLOR_NAME as color_from_name, c.COLOR_NAME as color_to_name, d.CUT_NAME, e.CLARITY_NAME as clarity_from_name, f.CLARITY_NAME as clarity_to_name, g.SHAPE_NAME, h.PLAC_NAME, i.COMP_TYPE_NAME FROM " . self::MF_PROD_STONE . " a 
                left join " . self::STONE_COLOR . " b on a.COLOR_FROM_ID = b.COLOR_ID 
                left join " . self::STONE_COLOR . " c on a.COLOR_TO_ID = c.COLOR_ID 
                left join " . self::STONE_CUT . " d on a.CUT_ID = d.CUT_ID 
                left join " . self::STONE_CLARITY . " e on a.CLARITY_FROM_ID = e.CLARITY_ID 
                left join " . self::STONE_CLARITY . " f on a.CLARITY_TO_ID = f.CLARITY_ID 
                left join " . self::STONE_SHAPE . " g on a.SHAPE_ID = g.SHAPE_ID
                left join " . self::STONE_PLACEMENT . " h on a.PLAC_ID = h.PLAC_ID
                left join " . self::COMPONENT_TYPE . " i on a.COMP_TYPE_ID = i.COMP_TYPE_ID
                where a.PROD_ID = $prod_id";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function prod_colored_stone_dets($prod_id) {
        //$query = $this->db->get_where(self::MF_PROD_COLORED_STONE, array('PROD_ID' => $prod_id));
        //return $query->result();
        $sql = "SELECT a.*, b.C_STONE_COL_NAME, c.CUT_NAME, d.C_STONE_CAT_NAME, e.SHAPE_NAME, f.COMP_TYPE_NAME, g.PLAC_NAME FROM " . self::MF_PROD_COLORED_STONE . " a 
                left join " . self::C_STONE_COLOR . " b on a.C_STONE_COL_ID = b.C_STONE_COL_ID 
                left join " . self::C_STONE_CUT . " c on a.CUT_ID = c.CUT_ID 
                left join " . self::C_STONE_CATEGORY . " d on a.C_STONE_CAT_ID = d.C_STONE_CAT_ID
                left join " . self::STONE_SHAPE . " e on a.SHAPE_ID = e.SHAPE_ID
                left join " . self::COMPONENT_TYPE . " f on a.COMP_TYPE_ID = f.COMP_TYPE_ID
                left join " . self::STONE_PLACEMENT . " g on a.PLAC_ID = g.PLAC_ID
                where a.PROD_ID = $prod_id";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function prod_labour_dets($prod_id) {
        $query = $this->db->get_where(self::MF_PROD_LABOR, array('PROD_ID' => $prod_id));
        return $query->row();
    }

    public function mf_prod_other_charges($prod_id) {
        $query = $this->db->get_where(self::MF_PROD_OTHER_CHARGES, array('PROD_ID' => $prod_id));
        return $query->result();
    }
    
    public function prod_other_dets($prod_id) {
        $sql = "SELECT a.*, b.C_NAME, c.B_NAME, d.CN_NAME, e.H_NAME FROM " . self::MF_PROD_SUMMARY . " a 
                left join " . self::CERTIFICATION . " b on a.CERTIFICATE = b.C_ID 
                left join " . self::BRAND . " c on a.BRAND = c.B_ID 
                left join " . self::COLLECTION_NAMES . " d on a.COLLECTION_NAME = d.CN_ID
                left join " . self::HALLMARK . " e on a.HALLMARK = e.H_ID
                where a.PROD_ID = $prod_id";
        $query = $this->db->query($sql);
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

    public function getMetalBaseDetails($user_id) {
        $sql = "SELECT a.*, b.MQ_KARAT, b.MQ_PURITY FROM " . self::MF_BASE_RATE . " a left join " . self::METAL_QUALITY . " b on a.BR_TYPE = b.MQ_ID where MF_USER_ID = " . $user_id;
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function getCollectionNames($user_id) {
        $query = $this->db->get_where(self::COLLECTION_NAMES, array('MF_USER_ID' => $user_id));
        return $query->result();
    }

    public function getBrands($user_id) {
        $query = $this->db->get_where(self::BRAND, array('MF_USER_ID' => $user_id));
        return $query->result();
    }

    public function getDesigners($user_id) {
        $query = $this->db->get_where(self::DESIGNER, array('MF_USER_ID' => $user_id));
        return $query->result();
    }

    public function isOtherDataExists($table, $col, $val, $user_id) {
        $sql = "select * from " . $table . " where " . $col . "='" . $val . "' and MF_USER_ID=" . $user_id;
        $query = $this->db->query($sql);
        return ($query->num_rows() > 0);
    }

    public function getMetalQuality() {
        $query = $this->db->get(self::METAL_QUALITY);
        return $query->result();
    }

    public function prod_count($comp_join_queries, $where) {
        $sql = "SELECT count(a.PROD_ID) as totalcount FROM " . self::MF_PROD_SUMMARY . " a " . $comp_join_queries . " where " . $where;
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $query = $query->row();
            return $query->totalcount;
        }
        return 0;
    }

}
