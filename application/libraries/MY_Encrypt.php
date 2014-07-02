<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MY_Encrypt extends CI_Encrypt {

    function my_encode($string, $key = '') {
        $encrypt_method = "AES-256-CBC";
        $secret_key = $this->get_key();
        $secret_iv = 'eH6tWZIZb386iM33GD93Kf7y9oCpQi8I';
        $key = hash('sha256', $secret_key);
        $iv = substr(hash('sha256', $secret_iv), 0, 16);

        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        return base64_encode($output);
    }

    function my_decode($string, $key = '') {
        $encrypt_method = "AES-256-CBC";
        $secret_key = $this->get_key();
        $secret_iv = 'eH6tWZIZb386iM33GD93Kf7y9oCpQi8I';
        $key = hash('sha256', $secret_key);
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        return openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }

}