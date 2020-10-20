<?php

defined("BASEPATH") or die("Do not allowed direct script");

if (! function_exists("p")) {
    function p($data) {
        echo "<pre>";
        print_r($data);
        echo "</pre>";
        exit;
    }
}



function multiUploadFile($path, $type, $file_name) {

    $CI = get_instance();
    $upload_data = array();
    $new_name = uniqid();

    foreach ($_FILES[$file_name]['name'] as $key => $img) {

        $_FILES['userfile']['name']     = $_FILES[$file_name]['name'][$key];
        $_FILES['userfile']['type']     = $_FILES[$file_name]['type'][$key];
        $_FILES['userfile']['tmp_name'] = $_FILES[$file_name]['tmp_name'][$key];
        $_FILES['userfile']['error']    = $_FILES[$file_name]['error'][$key];
        $_FILES['userfile']['size']     = $_FILES[$file_name]['size'][$key];

        $config['upload_path']      = $path; //'uploads/superadmin/';
        $config['allowed_types']    = $type; //'gif|jpg|png|jpeg';
        /*$config['max_width']        = 0;
        $config['max_height']       = 0;*/
        $config['max_size']         = 5000;
        $config['encrypt_name']     = false;
        $n_a = explode(".", $_FILES['userfile']['name']);
        $ext = end($n_a);
        $config['file_name']        = $new_name . '.' . $ext;
        $config['overwrite'] = false;
        $CI->load->library('upload', $config);
        $CI->upload->initialize($config);
        if (!$CI->upload->do_upload('userfile')) {
            $error = $CI->upload->display_errors();
            echo $error;
        } else {
            $upload_data[] = $CI->upload->data()['file_name'];
        }
    }

    if (!empty($upload_data)) {
//               chmod($upload_data['full_path'], 0755);
        return $upload_data;
    } else {
        return 0;
    }
}

function b2b($name, $id, $price) {
    return "https://api.whatsapp.com/send?phone=919321598572&text=".urlencode($name ." id : " . $id . " price : " . $price);
}