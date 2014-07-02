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
    //Product
    const MF_PROD_SUMMARY = "mf_prod_summary";
    //Common
    const COMPONENT = "component";
    const COMPONENT_TYPE = "component_type";
    const CATEGORY = "category";
    const PROD_TYPE = "prod_type";
    const PRICE_TYPE = "price_type";
    //Colored Stone
    const C_STONE_TYPE = "c_stone_type";
    const C_STONE_CATEGORY = "c_stone_category";
    const C_STONE_COLOR = "c_stone_color";
    //Stone
    const STONE_CUT = "stone_cut";
    const STONE_COLOR = "stone_color";
    const STONE_SHAPE = "stone_shape";
    const STONE_CLARITY = "stone_clarity";
    //MF Tables
    const MF_PROD_COMPONENT = 'mf_prod_component';
    const MF_PROD_METAL = 'mf_prod_metal';
    const MF_PROD_STONE = 'mf_prod_stone';
    const MF_PROD_COLORED_STONE = 'mf_prod_colored_stone';
    const MF_PROD_LABOR = 'mf_prod_labor';

}
