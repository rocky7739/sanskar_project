<?php

 defined('BASEPATH') OR exit('No direct script access allowed');
 class  Advance_request extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('advance_request_model');
        $this->load->helper("services");
         $this->load->library('session');
         $this->load->helper("jwt_validater");
     }

     //XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<-- Advance_Request form -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
      public function advance_req_form()
      {
         //pre('hello'); die;
          $this->validate_advance_request();
          $EmpCode = $this->input->post('EmpCode');
          $RequestedAmount = $this->input->post('RequestedAmount');
          $RepaymentDuration = $this->input->post('RepaymentDuration');
          $Reason = $this->input->post('Reason');

          $result = $this->advance_request_model->advance_request_form($EmpCode,$RequestedAmount,$RepaymentDuration,$Reason);
          if($result){
               echo"Request Submitted";
          }else{
              echo"Request Not Submitted";
          }

      }

      private function validate_advance_request(){
          $this->form_validation->set_rules('EmpCode','EmpCode', 'trim|required');
          $this->form_validation->set_rules('RequestedAmount','RequestedAmount','trim|required');
           $this->form_validation->set_rules('RepaymentDuration','RepaymentDuration','trim|required');
           $this->form_validation->set_rules('Reason','Reason','trim|required');
           $this->form_validation->run();
           $error = $this->form_validation->get_all_errors();
           if($error){
               return_data(false,array_values($error)[0], array(), $error);
           }
      }
    }
    ?>