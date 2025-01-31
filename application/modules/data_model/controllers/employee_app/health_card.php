<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Health_card extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('health_card_model');
        $this->load->helper("services");
        $this->load->library('session');
        $this->load->helper("jwt_validater");
    }
     public function health_pdf_download() {
         $this->validate_health_pdf_download();

           $EmpName = $this->input->post('EmpName');
        // if($_SESSION['EmpCode']){
        //     $EmpCode = $_SESSION['EmpName'];
        //     //pre($EmpCode);
        // }

        if($EmpName){
            $result = $this->health_card_model->health_card_report($EmpName);
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

    private function validate_health_pdf_download() {
        $this->form_validation->set_rules('EmpName', 'EmpName', 'trim|required');
        $this->form_validation->run();
        $error = $this->form_validation->get_all_errors();
        if ($error) {
            return_data(false, array_values($error)[0], array(), $error);
        }
    }

    //XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<--  vaccination report -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX


   public function first_dose_vaccination() {
         $this->validate_first_dose_vaccination();

           $EmpName = $this->input->post('EmpName');
        // if($_SESSION['EmpCode']){
        //     $EmpCode = $_SESSION['EmpName'];
        //     //pre($EmpCode);
        // }

        if($EmpName){
            $result = $this->health_card_model->first_dose_report($EmpName);
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
        $this->form_validation->set_rules('EmpName', 'EmpName', 'trim|required');
        $this->form_validation->run();
        $error = $this->form_validation->get_all_errors();
        if ($error) {
            return_data(false, array_values($error)[0], array(), $error);
        }
    }

}