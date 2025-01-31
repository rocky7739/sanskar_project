<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Attendance extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('attendance_model');
        $this->load->helper("services");
    }

//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<--  SEARCH EMPLOYEE BY KEYWORD BLOCK START HERE  -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
    public function get_employee_by_keyword() {
        $this->validate_get_employee_by_keyword();
        $keyword = $this->input->post('keyword'); //keyword will be either [EmpCode] or [EmpName].
        $result = $this->attendance_model->get_employee_by_keyword($keyword);
        if ($result) {
            return_data(true, 'Employee List.', $result);
        } else {
            return_data(false, 'Something Went Wrong.', array());
        }
    }

    private function validate_get_employee_by_keyword() {
        $this->form_validation->set_rules('keyword', 'Search Keyword', 'trim|required');
        $this->form_validation->run();
        $error = $this->form_validation->get_all_errors();
        if ($error) {
            return_data(false, array_values($error)[0], array(), $error);
        }
    }

//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<--  SEARCH EMPLOYEE BY KEYWORD BLOCK END HERE  -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<--  UPDATE ATTENDANCE BLOCK START HERE  -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
    public function update_in_out_time() {
        $this->validate_update_in_out_time();
        $emp_code = $this->input->post('emp_code');
        if (isset($_POST['in_time'])) {
            $in_time = $this->attendance_model->update_in_time($emp_code);
        } else {
            $out_time = $this->attendance_model->update_out_time($emp_code);
        }
    }

    private function validate_update_in_out_time() {
        $this->form_validation->set_rules('emp_code', 'Employee Code', 'trim|required');
        if (array_key_exists('in_time', $_POST) && array_key_exists('out_time', $_POST)) {
            return_data(false, 'Can not update in and out at same time.', array());
        }
        $this->form_validation->run();
        $error = $this->form_validation->get_all_errors();
        if ($error) {
            return_data(false, array_values($error)[0], array(), $error);
        }
    }

//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<--  UPDATE ATTENDANCE BLOCK END HERE  -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<--  GET LATEST ATTENDANCE COUNT BLOCK START HERE  -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
    public function get_latest_attendance_count() {
        $result = $this->attendance_model->get_latest_attendance_count();
        if ($result) {
            return_data(true, 'Success.', $result);
        } else {
            return_data(false, 'Something Went Wrong.', array());
        }
    }

//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<--  GET LATEST ATTENDANCE COUNT BLOCK END HERE  -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX     
}
