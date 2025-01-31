<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!function_exists('pre')) {

    function pre($array) {
        echo "<pre>";
        print_r($array);
        echo "</pre>";
    }

}
if (!function_exists('is_json')) {

    function is_json($string, $return_data = false) {
        $data = json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE) ? ($return_data ? $data : TRUE) : FALSE;
    }

}


if (!function_exists('create_log_file')) {

    function create_log_file($data) {
        date_default_timezone_set("Asia/Kolkata");

        $log = PHP_EOL . "////////////" . date('d-M-Y, h:i:s A') . "/////////////" . PHP_EOL;
        $log = $log . "Time: " . date('Y-m-d, H:i:s') . PHP_EOL;
        $log = $log . "url: " . base_url("api_panel/") . $data['url'] . PHP_EOL;
        $log = $log . "Request " . json_encode($data['request']) . PHP_EOL;

        file_put_contents('logs/' . $data['api'] . '.txt', $log, FILE_APPEND);
    }

}

//if (!function_exists('return_data')) {
//
//    function return_data($status = false, $mesage = "", $result = array()) { //mobile and message. 
//        $return = array("status" => $status, "message" => $mesage, "Result" => $result);
//        echo json_encode($return);
//        die;
//    }
//
//}


if (!function_exists('file_curl_contents')) {

    function file_curl_contents($document) {
$CI = & get_instance();
        $header = array();
        $header[] = 'Jwtuniversal:ADMIN';
        $lang = 1;
        $header[] = 'Lang:' . $lang;
        $url = $document['file_url'];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $document['file_url']);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
        curl_setopt($ch, CURLOPT_POST, 1);
        unset($document['file_url']);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $document);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
//        pre($server_output); 
        curl_close($ch);
        $data = json_decode($server_output, true);
        if (!$data) {
            echo $url;
            print_r($document);
            die;
        }
        if (array_key_exists("auth_code", $data)) {
            if ($data['auth_code'] == '100100') {
                $CI->session->sess_destroy();
                redirect('/web/Home');
                die;
            }
        }
        return $data;

}
}
