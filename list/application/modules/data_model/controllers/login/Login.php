<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('login_model');
        $this->load->helper("services");
        $this->load->library('session');
        $this->load->helper("jwt_validater");
    }

//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<--  REGISTER DEVICE BLOCK START HERE  -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
    public function register_device() {
        //create_log_file(array("url" => "User/login_authentication", "request" => $_POST, "api" => "login_authentication"));
        $this->validate_register_device();
        $device_model = $this->input->post('device_model');
        $device_id = $this->input->post('device_id');
        $result = $this->login_model->register_device($device_model, $device_id);
        if ($result) {
            return_data(false, 'Device Already Registered .', array());
        } else {
            return_data(false, 'Something Went Wrong.', array());
        }
    }

    private function validate_register_device() {
        $this->form_validation->set_rules('device_model', 'Device Model', 'trim|required');
        $this->form_validation->set_rules('device_id', 'Device ID', 'trim|required');
        $this->form_validation->run();
        $error = $this->form_validation->get_all_errors();
        if ($error) {
            return_data(false, array_values($error)[0], array(), $error);
        }
    }

//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<--  REGISTER DEVICE BLOCK END HERE  -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX 
//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<--  LOGIN DEVICE BLOCK START HERE  -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX    

    public function login_authentication() {
        //create_log_file(array("url" => "User/login_authentication", "request" => $_POST, "api" => "login_authentication"));
        $this->validate_login_authentication();
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $result = $this->login_model->authenticate_gaurd_login($username, $password);
        if ($result) {
            return_data(true, 'Success.', $result);
        } else {
            return_data(false, 'Something Went Wrong.', array());
        }
    }

    private function validate_login_authentication() {
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $this->form_validation->run();
        $error = $this->form_validation->get_all_errors();
        if ($error) {
            return_data(false, array_values($error)[0], array(), $error);
        }
    }

//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<--  LOGIN DEVICE BLOCK END HERE  -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX 
//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<--  GET EMPLOYEE LIST BLOCK START HERE  -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
    public function get_employee_list() {
        $this->validate_get_employee_list();
        $page_no = $this->input->post('page_no');
        $limit = $this->input->post('limit');
        $result = $this->login_model->get_employee_list(array('page_no' => $page_no, 'limit' => $limit));
        if ($result) {
            return_data(true, 'Employee List', $result);
        } else {
            return_data(false, 'Something Went Wrong.', array());
        }
    }

    private function validate_get_employee_list() {
        $this->form_validation->set_rules('page_no', 'page_no', 'trim|required');
        $this->form_validation->set_rules('limit', 'limit', 'trim|required');
        if (isset($_POST['page_no']) && $_POST['page_no'] == '0') {
            return_data(false, 'Page no should be start from 1.', array());
        }
        $this->form_validation->run();
        $error = $this->form_validation->get_all_errors();

        if ($error) {
            return_data(false, array_values($error)[0], array(), $error);
        }
    }

//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<--  GET EMPLOYEE LIST BLOCK END HERE  -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX 
}
