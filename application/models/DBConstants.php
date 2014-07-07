<?php

namespace models;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

interface DBConstants {

    //User
    const USER_TABLE = "user_table";
    const USER_STORE_SETTINGS = "user_store_settings";
    //Common
    const COMPONENT = "component";
    const COMPONENT_TYPE = "component_type";
    const CATEGORY = "category";
    const PROD_TYPE = "prod_type";
    const PRICE_TYPE = "price_type";
    //Colored Stone
    const C_STONE_CATEGORY = "c_stone_category";
    const C_STONE_COLOR = "c_stone_color";
    const C_STONE_CUT = "c_stone_cut";
    //Stone
    const STONE_CUT = "stone_cut";
    const STONE_COLOR = "stone_color";
    const STONE_SHAPE = "stone_shape";
    const STONE_CLARITY = "stone_clarity";
    const STONE_SIZE = "stone_size";
    const STONE_SEIV_SIZE_FROM = "stone_seiv_size_from";
    const STONE_SEIV_SIZE_TO = "stone_seiv_size_to";
    const STONE_FLUORESCENCE = "stone_fluorescence";
    const STONE_PLACEMENT = "stone_placement";
    //MF Tables
    const MF_PROD_SUMMARY = "mf_prod_summary";
    const MF_PROD_COMPONENT = 'mf_prod_component';
    const MF_PROD_METAL = 'mf_prod_metal';
    const MF_PROD_STONE = 'mf_prod_diamond';
    const MF_PROD_COLORED_STONE = 'mf_prod_colored_stone';
    const MF_PROD_LABOR = 'mf_prod_labor';
    const MF_PROD_OTHER_CHARGES = 'mf_prod_other_charges';
    const PROD_HISTORY = 'prod_history';

}
