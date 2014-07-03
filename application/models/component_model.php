<?php

require_once('DBConstants.php');

use models\DBConstants;

class Component_model extends CI_Model implements DBConstants {

    public function insert_record($table, $data) {
        return $this->db->insert($table, $data);
    }

    public function components() {
        $query = $this->db->get(self::COMPONENT);
        return $query->result();
    }

    public function component_type() {
        $query = $this->db->get(self::COMPONENT_TYPE);
        return $query->result();
    }
    
    public function comp_types($comp_id) {
        $query = $this->db->get_where(self::COMPONENT_TYPE, array('COMP_ID' => $comp_id));
        return $query->result();
    }

    public function category() {
        $query = $this->db->get(self::CATEGORY);
        return $query->result();
    }

    public function price_type() {
        $query = $this->db->get(self::PRICE_TYPE);
        return $query->result();
    }

    public function prod_type() {
        $query = $this->db->get(self::PROD_TYPE);
        return $query->result();
    }

    public function stone_clarity() {
        $query = $this->db->get(self::STONE_CLARITY);
        return $query->result();
    }

    public function stone_color() {
        $query = $this->db->get(self::STONE_COLOR);
        return $query->result();
    }

    public function stone_cut() {
        $query = $this->db->get(self::STONE_CUT);
        return $query->result();
    }

    public function stone_shape() {
        $query = $this->db->get(self::STONE_SHAPE);
        return $query->result();
    }

    public function c_stone_type() {
        $query = $this->db->get(self::C_STONE_TYPE);
        return $query->result();
    }

    public function c_stone_color() {
        $query = $this->db->get(self::C_STONE_COLOR);
        return $query->result();
    }

    public function c_stone_category() {
        $query = $this->db->get(self::C_STONE_CATEGORY);
        return $query->result();
    }

}
