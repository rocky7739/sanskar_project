<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Visitor extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('visitor_model');
        $this->load->helper("services");
    }

//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<--  VISITOR REGISTRATION BLOCK START HERE  -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
    public function visitor_registration() {
        $this->validate_visitor_registration();
        $mobile = $this->input->post('mobile');
        $data = $this->input->post();
        $result = $this->visitor_model->is_already_register($mobile);
        if ($result) {
            return_data(true, 'Visitor Already Registered', array());//Be carefull don't remove this message (Visitor Already Registered) from return json....
        } else {
            $result = $this->visitor_model->visitor_registration($data);
        }
    }

    private function validate_visitor_registration() {
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('mobile', 'Mobile', 'trim|required');
        $this->form_validation->set_rules('to_whome', 'To Whome', 'trim|required');
        $this->form_validation->set_rules('address', 'Address', 'trim');
        $this->form_validation->set_rules('in_time', 'In Time', 'trim');
        $this->form_validation->set_rules('emp_code', 'Employee Code', 'trim');
        $this->form_validation->set_rules('arogya_setu_status', 'Arogya Setu Status', 'trim|required');
        $this->form_validation->run();
        $error = $this->form_validation->get_all_errors();
        if ($error) {
            return_data(false, array_values($error)[0], array(), $error);
        }
    }

//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<--  VISITOR REGISTRATION BLOCK END HERE  -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX 
//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<--  VISITOR LIST BLOCK START HERE  -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
    public function get_visitor_list() { 
        // create_log_file(array("url" => "Visitor/get_visitor_list", "request" => $_POST, "api" => "get_visitor_list")); 
       $this->validate_get_visitor_list();
       $page_no = $this->input->post('page_no');
       $limit = $this->input->post('limit');
       $result = $this->visitor_model->get_visitor_list(array('page_no' => $page_no, 'limit' => $limit));
        // $result = $this->visitor_model->get_visitor_list();
        if ($result) {
            return_data(true, 'Visitor List', $result);
        } else {
            return_data(false, 'Something Went Wrong.', array());
        }
    }
    
    private function validate_get_visitor_list() {
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

//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<-- VISITOR LIST BLOCK END HERE  -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX 
//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<--  SEARCH VISITOR BY KEYWORD BLOCK START HERE  -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX    

    public function get_visitor_by_keyword() {
        $this->validate_get_visitor_by_keyword();
        $keyword = $this->input->post('keyword');
        $result = $this->visitor_model->get_visitor_by_keyword($keyword);
        if ($result) {
            return_data(true, 'Visitor List.', $result);
        } else {
            return_data(false, 'No Data Found.', array());
        }
    }

    private function validate_get_visitor_by_keyword() {
        $this->form_validation->set_rules('keyword', 'Keyword', 'trim|required');
        $this->form_validation->run();
        $error = $this->form_validation->get_all_errors();
        if ($error) {
            return_data(false, array_values($error)[0], array(), $error);
        }
    }

//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<--  SEARCH VISITOR BY KEYWORD BLOCK START HERE  -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<--  UPDATE VISITOR IN/OUT TIME BLOCK START HERE  -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
    public function update_visitor_in_out_time() {
        $this->validate_update_visitor_in_out_time();
        $visitor_id = $this->input->post('visitor_id');
        $to_whome = $this->input->post('to_whome');
        $data = $this->input->post();
        $is_visitor_exist = $this->visitor_model->is_visitor_exist($visitor_id);
        if ($is_visitor_exist) {
            if (isset($_POST['in_time'])) {
                $in_time = $this->visitor_model->update_in_time($data);
            } else {
                $out_time = $this->visitor_model->update_out_time($visitor_id);
            }
        } else {
            return_data(false, 'Invalid visitor id.', array());
        }
    }

    private function validate_update_visitor_in_out_time() {
        $this->form_validation->set_rules('visitor_id', 'Visitor ID', 'trim|required');
        $this->form_validation->set_rules('to_whome', 'To Whome', 'trim|required');
        $this->form_validation->set_rules('emp_code', 'Employee Code', 'trim');
        if (array_key_exists('in_time', $_POST) && array_key_exists('out_time', $_POST)) {
            return_data(false, 'Can not update in and out at same time.', array());
        }
        $this->form_validation->run();
        $error = $this->form_validation->get_all_errors();
        if ($error) {
            return_data(false, array_values($error)[0], array(), $error);
        }
    }

//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<--  UPDATE VISITOR IN/OUT TIME BLOCK END HERE  -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<--  GET LATEST VISITOR COUNT BLOCK START HERE  -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
    public function get_updated_visitor_count() {
        $result = $this->visitor_model->get_updated_visitor_count();
        if ($result) {
            return_data(true, 'Success.', $result);
        } else {
            return_data(false, 'Something Went Wrong.', array());
        }
    }

//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<--  GET LATEST VISITOR COUNT BLOCK END HERE  -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX  
    
//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<--  GET TO WHOME LIST BLOCK START HERE  -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
    public function get_to_whome_list() {
        $this->validate_get_to_whome_list();
        $page_no = $this->input->post('page_no');
        $limit = $this->input->post('limit');
        $result = $this->visitor_model->get_to_whome_list(array('page_no' => $page_no, 'limit' => $limit));
        if ($result) {
            return_data(true, 'List', $result);
        } else {
            return_data(false, 'Something Went Wrong.', array());
        }
    }

    private function validate_get_to_whome_list() {
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

//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<--  GET TO WHOME LIST BLOCK END HERE  -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX   
    
//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<--  SEARCH TO WHOME BY KEYWORD BLOCK START HERE  -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
    public function get_to_whome_by_keyword() {
        $this->validate_get_to_whome_by_keyword();
        $keyword = $this->input->post('keyword'); //keyword will be either [EmpCode] or [EmpName].
        $result = $this->visitor_model->get_to_whome_by_keyword($keyword);
        if ($result) {
            return_data(true, 'List.', $result);
        } else {
            return_data(false, 'Something Went Wrong.', array());
        }
    }

    private function validate_get_to_whome_by_keyword() {
        $this->form_validation->set_rules('keyword', 'Search Keyword', 'trim|required');
        $this->form_validation->run();
        $error = $this->form_validation->get_all_errors();
        if ($error) {
            return_data(false, array_values($error)[0], array(), $error);
        }
    }

//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<--  SEARCH TO WHOME BY KEYWORD BLOCK END HERE  -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX    
}
