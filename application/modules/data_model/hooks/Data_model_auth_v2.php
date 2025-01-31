<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Data_model_auth {

    function __construct() {
        $this->CI = & get_instance();
    }

    public function index() {
        if ($this->CI->router->fetch_module() == 'data_model') {
            $this->CI->load->helper("jwt_validater");
            $header = getallheaders();
            $agent= isset($_SERVER['HTTP_USER_AGENT'])?$_SERVER['HTTP_USER_AGENT']:'';
                if(ENVIRONMENT=='production'){
                    if(strpos($agent,'ostman')!='' || $agent==''){
                        echo json_encode(
                            array("status" => false,
                                "message" => "Request Unauthorized",
                                "data" => array(),
                                "error" => array(),
                                "auth_code" => "100100"
                            )
                        );
                        die;
                    }
                }
            
            /* do not repeat or over write */

            define('API_REQUEST_LANG', ($header['Lang'] ?? $header['lang'] ?? 1));
            define("VERSION_CODE", ($header['Version'] ?? $header['version'] ?? 0));

            $class = strtolower($this->CI->router->fetch_class());
            $fx = strtolower($this->CI->router->fetch_method());
            $perm = $class . '/' . $fx;
            $remote_addr = $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'] ?? "";
            
//            $log = "Time: " . date('Y-m-d, H:i A') . PHP_EOL;
//            $log = $log . "url: " . (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" . PHP_EOL;
//            $log = $log . "Header " . json_encode($header) . PHP_EOL;
//            if ($_FILES) {
//                $log = $log . "Files " . json_encode($_FILES) . PHP_EOL;
//            }
//            $log = $log . "Request " . json_encode($this->CI->input->post()) . PHP_EOL . PHP_EOL;
//            file_put_contents('logs/' . $this->CI->router->fetch_method() . '.txt', $log, FILE_APPEND);

                if ($class != "registration" && $class != "version" && $class != "welcome" && $class != "send_otp_on_email_sign_up" && $class != "mobile_auth" && $class != "test_web" && $class != "testimonial" && $class != "pendrive" && $fx != "get_landing_page_data_exam"
                ) {

                    // check if call is from internal admin 
                    if (array_key_exists('Jwtuniversal', $header)) {
                        if ($header['Jwtuniversal'] != "ADMIN") {
                            return_data(false, "User Session Expired", array(), "100100");
                        }
                    } elseif (isset($header['Userid']) && (!array_key_exists('Jwt', $header) || !validate_jwt($header['Jwt']))) {
                        if ($header['Userid'] != "0") {
                            return_data(false, "User Session Expired", array(), "100100");
                        }
                    } elseif (isset($header['userid']) && (!array_key_exists('jwt', $header) || !validate_jwt($header['jwt']))) {
                        if ($header['userid'] != "0") {
                            return_data(false, "User Session Expired", array(), "100100");
                        }
                    }
                }
                /* controll language */
                $this->CI->load->helper('language');
                $set_lang = "english";
                $set_lang = (API_REQUEST_LANG == 2) ? 'hindi' : $set_lang;
                $this->CI->lang->load('data_model_language', $set_lang);
            }
        }
    }

