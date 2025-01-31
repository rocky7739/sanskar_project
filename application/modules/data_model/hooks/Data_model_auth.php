<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Data_model_auth {

    function __construct() {
        $this->CI = & get_instance();
    }

    public function index() {
        $perm = $this->CI->router->fetch_class() . '/' . $this->CI->router->fetch_method();
        if ($this->CI->router->fetch_module() == 'data_model' && $this->CI->router->fetch_class()=='Login') {
            $this->CI->load->helper("services");
            $header = getallheaders();
            if (isset($header['Device-Model']) && !empty($header['Device-Model']) && isset($header['Device-Id']) && !empty($header['Device-Id']) && isset($header['User-Type']) && !empty($header['User-Type'])) {
                $device_model = $header['Device-Model'];
                $device_id = $header['Device-Id'];
                $user_type = $header['User-Type']; //1- Gaurd, 2- Employee
                if ($user_type == 1) {
                    $result = verify_device($device_model, $device_id);
                    if (!$result) {
                        return_data(false, 'Please Registered Your Device.', array());
                    }
                }
            } else {
                return_data(false, 'Please provide device details.', array());
            }
        }
    }

}
