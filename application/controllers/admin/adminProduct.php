<?php

include_once( APPPATH . 'controllers/component' . EXT );

class AdminProduct extends Component {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('admin/user', 'admin/product'));
    }

    public function product($req, $prod_id = '') {
        if ($req == 'add') {
            addProd();
        } else if ($req == 'edit') {
            updateProd($prod_id);
        } else if ($req == 'viewAll') {
            viewAllProducts();
        }
    }

    function json() {
        $site_user_id = ses_data('site_user_id');
        $page = $this->input->post('page');
        $limit = 9;
        $offset = $page * $limit;
        $data = $this->Product_model->get_products(array(
            'MF_USER_ID' => $site_user_id
                ), $limit, $offset);
        echo json_encode($data);
    }

    public function ajax($req) {
        if ($req == 'c_stone_category') {
            getSubColorStonedTypes();
        } else if ($req == 'metal_base_rate') {
            getMetalBaseRate();
        } else if ($req == 'metal_types') {
            getMetalTypes();
        } else if ($req == 'load_products') {
            loadProducts();
        }
    }

    public function upload_prod_images($prod_id = '') {
        if ($prod_id == '') {
            $prod_id = ses_data('prod_id');
        }
        $targetFolder = 'uploads/' . ses_data('user_id') . '/' . $prod_id . '/';
        if (!file_exists($targetFolder)) {
            mkdir($targetFolder, 0755, true);
        }

        $thumb_img_str = '';
        $def_thumb_img = '';
        $img_str = '';
        $prodArr = $this->Product_model->product_details($prod_id);
        for ($i = 0; $i < count($_FILES['upload']['name']); $i++) {
            $tmpFilePath = $_FILES['upload']['tmp_name'][$i];
            $temp = explode(".", $_FILES['upload']['name'][$i]);
            $extension = end($temp);
            if ($tmpFilePath != "") {
                $newFileName = date('YmdHis') . '.' . $extension;
                $newFilePath = $targetFolder . $newFileName;
                if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                    $thumb_img = create_thumb($targetFolder, $newFileName, $targetFolder, 'thumb_' . $newFileName, 300);

                    if ($def_thumb_img == '') {
                        $def_thumb_img = $thumb_img;
                    }

                    $thumb_img_str .= $thumb_img . ';';
                    $img_str .= $newFileName . ';';
                }
            }
        }
        $thumb_img_str = substr($thumb_img_str, 0, strlen($thumb_img_str) - 1);
        $img_str = substr($img_str, 0, strlen($img_str) - 1);
        $this->Product_model->update_images($prod_id, $def_thumb_img, $thumb_img_str, $img_str, ($prodArr->PROD_DEF_THUMB == ''));
        json_output(array(
            'path' => $targetFolder,
            'prod_id' => $prod_id,
            'imgs' => $img_str
        ));
    }

    public function prod_activate() {
        $prod_id = $this->input->post('prod_id');
        $status = $this->input->post('status');
        $flag = $this->Product_model->update_prod(array('PROD_STATUS' => !$status), $prod_id);
        json_output(array('error' => !$flag));
    }

    public function del_prod_img() {
        $prod_id = $this->input->post('prod_id');
        $img = $this->input->post('img');
        $prodArr = $this->Product_model->product_details($prod_id);
        $path = 'uploads/' . ses_data('user_id') . '/' . $prod_id;
        $thumb_img = del_prod_image($prodArr->PROD_THUMBS, 'thumb_' . $img, $path);
        $prod_img = del_prod_image($prodArr->PROD_IMAGES, $img, $path);
        $thumbArr = explode(';', $thumb_img);
        $this->Product_model->update_images($prod_id, $thumbArr[0], $thumb_img, $prod_img, true);
        json_output(array('error' => false));
    }

    public function def_img() {
        $prod_id = $this->input->post('prod_id');
        $img = $this->input->post('img');
        $res['error'] = false;
        $this->output->set_content_type('application/json')->set_output(json_encode($res));
    }

    //Apeksha Lad Dated : 21th July 2014::14.26PM

    public function prod_settings($req = '') {
        $data = getAdminCommonData();
        $data['req'] = $req;
        if ($req == 'brands') {
            $data['title'] = "Brand Setting";
            $data['fields'] = "B_ID,B_NAME";
            $data['settingArr'] = $this->Product_model->getBrands(ses_data('user_id'));
        } else if ($req == 'collections') {
            $data['title'] = "Collection Setting";
            $data['fields'] = "CN_ID,CN_NAME";
            $data['settingArr'] = $this->Product_model->getCollectionNames(ses_data('user_id'));
        } else if ($req == 'designers') {
            $data['title'] = "Designer Setting";
            $data['fields'] = "D_ID,D_NAME";
            $data['settingArr'] = $this->Product_model->getDesigners(ses_data('user_id'));
        }
        loadAdminView('settings/prod_setting/common_setting', $data);
    }

    public function save_prod_settings($req = '') {
        if ($req == 'brands') {
            addProdSettings(\models\DBConstants::BRAND);
        } else if ($req == 'collections') {
            addProdSettings(\models\DBConstants::COLLECTION_NAMES);
        } else if ($req == 'designers') {
            addProdSettings(\models\DBConstants::DESIGNER);
        }
    }

    public function edit_prod_settings($req = '') {
        if ($req == 'brands') {
            editProdSettings(\models\DBConstants::BRAND);
        }
        if ($req == 'collections') {
            editProdSettings(\models\DBConstants::COLLECTION_NAMES);
        }
        if ($req == 'designers') {
            editProdSettings(\models\DBConstants::DESIGNER);
        }
    }

    //Apeksha Lad Dated : 22nd July 2014::11.14PM

    public function base_rate_settings() {
        $data = getAdminCommonData();
        $data['title'] = "Base Rate Setting";
        $data['metalQulAry'] = $this->Product_model->getMetalQuality();
        $data['baseDetArr'] = $this->Product_model->getMetalBaseDetails(ses_data('user_id'));
        loadAdminView('settings/prod_setting/base_rate_setting', $data);
    }

    public function add_base_rate() {
        addBaseRate();
    }

}
