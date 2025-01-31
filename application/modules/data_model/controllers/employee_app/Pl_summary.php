<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pl_summary extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('pl_summary_model');
        $this->load->helper("services");
        $this->load->library('session');
        $this->load->library('email');
        $this->load->helper("jwt_validater");
        
    }


//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<-- pl summary report  -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
    public function pl_summary_report(){
        $this->validate_pl_summary_report();
        $EmpCode = $this->input->post('EmpCode');
        $result = $this->pl_summary_model->pl_summary_report($EmpCode); 
       
    }
        private function validate_pl_summary_report() {
      
             $this->form_validation->set_rules('EmpCode','EmpCode', 'trim|required');
             $this->form_validation->run();
            $error = $this->form_validation->get_all_errors();
            if ($error) {
                return_data(false, array_values($error)[0], array(), $error);
            }
        }


        //XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<-- guest_request  -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
    public function guest_request(){
        $this->validate_guest_request();
        $G_name = $this->input->post('G_name');
        $Mobile = $this->input->post('Mobile');
        $Address = $this->input->post('Address');
        $Arogyasetu_status = $this->input->post('Arogyasetu_status');
        $EmpCode = $this->input->post('EmpCode');
        $To_whome = $this->input->post('To_whome');
        $Reason = $this->input->post('Reason');
        $Date1 = $this->input->post('Date1');
        $In_time = $this->input->post('In_time');
        $data = $this->pl_summary_model->fetch_all_data($EmpCode,'GSR','GuestRequest');
        $result = $this->pl_summary_model->guest_request($data,$G_name,$Mobile,$Address,$Arogyasetu_status,$EmpCode,$To_whome,$Reason,$Date1,$In_time); 
        if($result)
        {          
             return_data(true,'Guest Request successfully',$result);
        }    
        else{
            echo"Guest Request not successfully";
        }
    }
        private function validate_guest_request() {
      
             $this->form_validation->set_rules('Mobile','Mobile', 'trim|required');
            $this->form_validation->set_rules('Address','Address', 'trim|required');
            $this->form_validation->set_rules('EmpCode','EmpCode', 'trim|required');
            $this->form_validation->set_rules('Reason','Reason', 'trim|required');
            $this->form_validation->set_rules('To_whome','Name', 'trim|required');
            $this->form_validation->set_rules('G_name','G_name', 'trim|required');
            $this->form_validation->set_rules('Date1','Date1', 'trim|required');   
            $this->form_validation->run();
            $error = $this->form_validation->get_all_errors();
            if ($error) {
                return_data(false, array_values($error)[0], array(), $error);
            }
        }
      //XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX-->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX



}
