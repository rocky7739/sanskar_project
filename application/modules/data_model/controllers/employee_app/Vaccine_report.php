<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Vaccine_report extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('vaccine_report_model');
        $this->load->helper("services");
        $this->load->library('session');
        $this->load->helper("jwt_validater");
    }
   
    //XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<-- 1st vaccination report -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX


   public function first_dose_vaccination() {
    create_log_file(array("url" => "User/first_dose_vaccination", "request" => $_POST, "api" => "first_dose_vaccination"));
         $this->validate_first_dose_vaccination();

           $EmpCode = $this->input->post('EmpCode');
        // if($_SESSION['EmpCode']){
        //     $EmpCode = $_SESSION['EmpName'];
        //     //pre($EmpCode);
        // }
        unset($_SESSION['EmpCode']);
        if($EmpCode){
            $result = $this->vaccine_report_model->first_dose_report($EmpCode);
            if ($result) {
            return_data(true, 'Success.');
            } else {
                return_data(false, 'Something Went Wrong1.', array());
            } 
        }
        else {
            return_data(false, 'Something Went Wrong.', array());
        }
       
    } 

    private function validate_first_dose_vaccination() {
        $this->form_validation->set_rules('EmpCode', 'EmpCode', 'trim|required');
        $this->form_validation->run();
        $error = $this->form_validation->get_all_errors();
        if ($error) {
            return_data(false, array_values($error)[0], array(), $error);
        }
    }

      //XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<-- second_dose vaccination report -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX


   public function second_dose_vaccination() {
         $this->validate_second_dose_vaccination();

           $EmpCode = $this->input->post('EmpCode');
        // if($_SESSION['EmpCode']){
        //     $EmpCode = $_SESSION['EmpName'];
        //     //pre($EmpCode);
        // }
        unset($_SESSION['EmpCode']);
        if($EmpCode){
            $result = $this->vaccine_report_model->second_dose_report($EmpCode);
            if ($result) {
            return_data(true, 'Success.');
            } else {
                return_data(false, 'Something Went Wrong1.', array());
            } 
        }
        else {
            return_data(false, 'Something Went Wrong.', array());
        }
       
    } 

    private function validate_second_dose_vaccination() {
        $this->form_validation->set_rules('EmpCode', 'EmpCode', 'trim|required');
        $this->form_validation->run();
        $error = $this->form_validation->get_all_errors();
        if ($error) {
            return_data(false, array_values($error)[0], array(), $error);
        }
    }


}