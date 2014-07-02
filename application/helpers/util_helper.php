<?php

function upload_file($file, $path, $target_name = '') {
    $allowedExts = array("gif", "jpeg", "jpg", "png");
    $temp = explode(".", $_FILES[$file]["name"]);
    $extension = end($temp);

    if (!file_exists($path)) {
        mkdir($path, 0755, true);
    }

    if (in_array($extension, $allowedExts)) {
        if ($_FILES[$file]["error"] > 0) {
            echo "0";
        } else {
            $file_name = $_FILES[$file]["name"];
            $target_name = ($target_name != '' ? $target_name : $file_name);
            move_uploaded_file($_FILES[$file]["tmp_name"], $path . $target_name);
            sleep(1);
            return $target_name;
        }
    } else {
        return '';
    }
}

function create_thumb($path_to_image_directory, $filename, $path_to_thumbs_directory, $thumb_filename, $final_width_of_image) {

    if (preg_match('/[.](jpg)$/', $filename)) {
        $im = imagecreatefromjpeg($path_to_image_directory . $filename);
    } else if (preg_match('/[.](gif)$/', $filename)) {
        $im = imagecreatefromgif($path_to_image_directory . $filename);
    } else if (preg_match('/[.](png)$/', $filename)) {
        $im = imagecreatefrompng($path_to_image_directory . $filename);
    }

    $ox = imagesx($im);
    $oy = imagesy($im);

    $nx = $final_width_of_image;
    $ny = floor($oy * ($final_width_of_image / $ox));

    $nm = imagecreatetruecolor($nx, $ny);

    imagecopyresized($nm, $im, 0, 0, 0, 0, $nx, $ny, $ox, $oy);

    if (!file_exists($path_to_thumbs_directory)) {
        if (!mkdir($path_to_thumbs_directory)) {
            die("There was a problem. Please try again!");
        }
    }

    imagejpeg($nm, $path_to_thumbs_directory . $thumb_filename);
    sleep(2);
    return $thumb_filename;
}

function load_view($view_name, $data) {
    $CI = & get_instance();
    $data['web_title'] = $CI->config->item('website_title');
    $CI->load->view('templates/header', $data);
    $CI->load->view('templates/nav', $data);
    $CI->load->view($view_name, $data);
    $CI->load->view('templates/footer');
}

//function admin_load_view($view_name, $data, $side_bar = true) {
//    $CI = & get_instance();
//    $data['web_title'] = $CI->config->item('website_title');
//    $CI->load->view('templates/header', $data);
//    $CI->load->view('templates/nav', $data);
//    if ($side_bar) {
//        $CI->load->view('admin/products/sidebar');
//    }
//    $CI->load->view($view_name, $data);
//    $CI->load->view('templates/footer');
//}

function admin_load_view($view_name, $data) {
    $CI = & get_instance();
    $data['web_title'] = $CI->config->item('website_title');
    $CI->load->view('admin/templates/header', $data);
    $CI->load->view('admin/templates/left_nav', $data);
    $CI->load->view('admin/templates/top_nav', $data);
    $CI->load->view($view_name, $data);
    $CI->load->view('admin/templates/footer');
}

function json_output($res) {
    $CI = & get_instance();
    $CI->output->set_content_type('application/json')->set_output(json_encode($res));
}

function ses_data($key) {
    $CI = & get_instance();
    return $CI->session->userdata($key);
}

function ses_set($key, $val) {
    $CI = & get_instance();
    $CI->session->set_userdata($key, $val);
}

function unses_set($key) {
    $CI = & get_instance();
    $CI->session->unset_userdata($key);
}

function del_prod_image($prod_img, $del_img, $path = '') {
    $imgArr = explode(';', $prod_img);
    $img_str = '';
    foreach ($imgArr as $img) {
        if ($del_img != $img) {
            $img_str .= $img . ';';
        } else {
            unlink($path . '/' . $img);
        }
    }
    return substr($img_str, 0, strlen($img_str) - 1);
}
