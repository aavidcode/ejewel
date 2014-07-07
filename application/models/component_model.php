<?php

require_once('DBConstants.php');

use models\DBConstants;

class Component_model extends CI_Model implements DBConstants {

    public function insert_record($table, $data) {
        return $this->db->insert($table, $data);
    }

    public function components() {
        $this->db->cache_on();
        $query = $this->db->get(self::COMPONENT);
        return $query->result();
    }

    public function component_type() {
        $this->db->cache_on();
        $query = $this->db->get(self::COMPONENT_TYPE);
        return $query->result();
    }
    
    public function comp_types($comp_id) {
        $query = $this->db->get_where(self::COMPONENT_TYPE, array('COMP_ID' => $comp_id));
        return $query->result();
    }

    public function category() {
        $this->db->cache_on();
        $query = $this->db->get(self::CATEGORY);
        return $query->result();
    }

    public function price_type() {
        $this->db->cache_on();
        $query = $this->db->get(self::PRICE_TYPE);
        return $query->result();
    }

    public function prod_type() {
        $this->db->cache_on();
        $query = $this->db->get(self::PROD_TYPE);
        return $query->result();
    }

    public function stone_clarity() {
        $this->db->cache_on();
        $query = $this->db->get(self::STONE_CLARITY);
        return $query->result();
    }

    public function stone_color() {
        $this->db->cache_on();
        $query = $this->db->get(self::STONE_COLOR);
        return $query->result();
    }

    public function stone_cut() {
        $this->db->cache_on();
        $query = $this->db->get(self::STONE_CUT);
        return $query->result();
    }

    public function stone_shape() {
        $this->db->cache_on();
        $query = $this->db->get(self::STONE_SHAPE);
        return $query->result();
    }
    
    public function stone_size() {
        $this->db->cache_on();
        $query = $this->db->get(self::STONE_SIZE);
        return $query->result();
    }
    
    public function stone_seiv_size_from() {
        $this->db->cache_on();
        $query = $this->db->get(self::STONE_SEIV_SIZE_FROM);
        return $query->result();
    }
    
    public function stone_seiv_size_to() {
        $this->db->cache_on();
        $query = $this->db->get(self::STONE_SEIV_SIZE_TO);
        return $query->result();
    }
    
    public function stone_fluorescence() {
        $this->db->cache_on();
        $query = $this->db->get(self::STONE_FLUORESCENCE);
        return $query->result();
    }
    
    public function stone_placement() {
        $this->db->cache_on();
        $query = $this->db->get(self::STONE_PLACEMENT);
        return $query->result();
    }

    public function c_stone_color() {
        $this->db->cache_on();
        $query = $this->db->get(self::C_STONE_COLOR);
        return $query->result();
    }

    public function c_stone_category() {
        $this->db->cache_on();
        $query = $this->db->get(self::C_STONE_CATEGORY);
        return $query->result();
    }
    
    public function c_stone_cut() {
        $this->db->cache_on();
        $query = $this->db->get(self::C_STONE_CUT);
        return $query->result();
    }

}
