<?php

function validate_user($user) {
    if ($user) {
        if (!$user->IS_VERIFIED) {
            return 'You email is not verified';
        } else if (!$user->IS_ACTIVE) {
            return "You account is not approved by admin";
        }
        return '';
    }
    return 'Invalid Login';
}

function validateLogin($red_url) {
    $CI = & get_instance();
    $email_id = $CI->input->post('email_id');
    $password = $CI->input->post('pass_word');
    $user_id = $CI->input->post('user_id');
    $user = $CI->User_model->validateLogin($email_id, $CI->encrypt->my_encode($password), $user_id);
    $message = validate_user($user);
    if ($message == "") {
        setUserSession($user);
        $res['error'] = false;
        $res['redirect'] = $red_url;
    } else {
        $res['error'] = true;
        $res['message'] = $message;
    }
    json_output($res);
}

function getDBComponentData() {
    $CI = & get_instance();
    return array(
        'component_type' => $CI->component_type(),
        'stone_clarity' => $CI->stone_clarity(),
        'stone_color' => $CI->stone_color(),
        'stone_cut' => $CI->stone_cut(),
        'stone_shape' => $CI->stone_shape(),
        'stone_size' => $CI->stone_size(),
        'stone_seiv_size_from' => $CI->stone_seiv_size_from(),
        'stone_seiv_size_to' => $CI->stone_seiv_size_to(),
        'stone_fluorescence' => $CI->stone_fluorescence(),
        'stone_placement' => $CI->stone_placement(),
        'c_stone_category' => $CI->c_stone_category(),
        'c_stone_color' => $CI->c_stone_color(),
        'c_stone_cut' => $CI->c_stone_cut(),
    );
}

function setUserSession($user) {
    $CI = & get_instance();
    $CI->session->set_userdata('user_data', array(
        'first_name' => $user->FIRST_NAME,
        'email_id' => $user->EMAIL_ID,
        'user_role' => $user->USER_ROLE
    ));
    $CI->session->set_userdata('user_id', $user->USER_ID);
    $CI->session->set_userdata('user_name', $user->USER_NAME);
}

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

    $temp = explode(".", $filename);
    $extension = end($temp);
    if ($extension == 'jpg' || $extension == 'jpeg') {
        $im = imagecreatefromjpeg($path_to_image_directory . $filename);
    } else if ($extension == 'png') {
        $im = imagecreatefrompng($path_to_image_directory . $filename);
    } else if ($extension == 'gif') {
        $im = imagecreatefromgif($path_to_image_directory . $filename);
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

    if ($extension == 'jpg' || $extension == 'jpeg') {
        imagejpeg($nm, $path_to_thumbs_directory . $thumb_filename);
    } else if ($extension == 'png') {
        imagepng($nm, $path_to_thumbs_directory . $thumb_filename);
    } else if ($extension == 'gif') {
        imagegif($nm, $path_to_thumbs_directory . $thumb_filename);
    }
    sleep(2);
    return $thumb_filename;
}

function loadMainView($view_name, $data) {
    $CI = & get_instance();
    $data['web_title'] = $CI->config->item('website_title');
    $CI->load->view('main/templates/header', $data);
    $CI->load->view('main/templates/nav', $data);
    $CI->load->view('main/' . $view_name, $data);
    $CI->load->view('main/templates/footer');
}

function loadMainViewWithContent($view_name, $data) {
    $CI = & get_instance();
    $data['web_title'] = $CI->config->item('website_title');
    $CI->load->view('main/templates/header', $data);
    $CI->load->view('main/' . $view_name, $data);
    $CI->load->view('main/templates/footer');
}

function loadAdminView($view_name, $data) {
    $CI = & get_instance();
    $data['web_title'] = $CI->config->item('website_title');
    $CI->load->view('admin/templates/header', $data);
    $CI->load->view('admin/templates/left_nav', $data);
    $CI->load->view('admin/templates/top_nav', $data);
    $CI->load->view('admin/' . $view_name, $data);
    $CI->load->view('admin/templates/footer');
}

function loadAdminWithContent($view_name, $data) {
    $CI = & get_instance();
    $data['web_title'] = $CI->config->item('website_title');
    $CI->load->view('master/templates/header', $data);
    $CI->load->view('master/' . $view_name, $data);
    $CI->load->view('master/templates/footer');
}

function loadMasterView($view_name, $data) {
    $CI = & get_instance();
    $data['web_title'] = $CI->config->item('website_title');
    $CI->load->view('master/templates/header', $data);
    $CI->load->view('master/templates/left_nav', $data);
    $CI->load->view('master/templates/top_nav', $data);
    $CI->load->view('master/' . $view_name, $data);
    $CI->load->view('master/templates/footer');
}

function loadMasterWithContent($view_name, $data) {
    $CI = & get_instance();
    $data['web_title'] = $CI->config->item('website_title');
    $CI->load->view('master/templates/header', $data);
    $CI->load->view('master/' . $view_name, $data);
    $CI->load->view('master/templates/footer');
}

function json_output($res) {
    $CI = & get_instance();
    $CI->output->set_content_type('application/json')->set_output(json_encode($res));
}

function ses_data($key, $val = '') {
    $CI = & get_instance();
    return ($val != '') ? $CI->session->set_userdata($key, $val) : $CI->session->userdata($key);
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

function stdToArray($arr) {
    return json_decode(json_encode($arr), true);
}

function unsetArrByKeys($arr, $keys) {
    foreach ($keys as $key) {
        if (isset($arr[$key])) {
            unset($arr[$key]);
        }
    }
    return $arr;
}

function getRandomDigit($digits) {
    static $startseed = 0;
    if (!$startseed) {
        $startseed = (double) microtime() * getrandmax();
        srand($startseed);
    }
    $range = 8;
    $start = 1;
    $i = 1;
    while ($i < $digits) {
        $range = $range . 9;
        $start = $start . 0;
        $i++;
    }
    return (rand() % $range + $start);
}

function getRandomAlphaNumericID($length) {
    $alphabets = range('A', 'Z');
    $numbers = range('0', '9');
    $final_array = array_merge($alphabets, $numbers);

    $random_text = '';

    while ($length--) {
        $key = array_rand($final_array);
        $random_text .= $final_array[$key];
    }
    return $random_text;
}
