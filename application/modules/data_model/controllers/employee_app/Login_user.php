<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login_user extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('login_model_test');
        $this->load->helper("services");
        $this->load->library('session');
        $this->load->helper("jwt_validater");
    }

 

     public function login_authentication() {
        //create_log_file(array("url" => "api_panel/login_app", "request login" => $_POST, "api" => "login_app"));
        $this->validate_login_authentication();
        $CntNo = $this->input->post('CntNo');
            $device_type = $this->input->post('User-Type');
            $device_model = $this->input->post('Device-Model');
            $device_id = $this->input->post('Device-Id');
            if(!empty($this->input->post('pin'))){
                    $pin = $this->input->post('pin');
                    $result = $this->login_model_test->login_with_pin($CntNo,$device_model,$device_id,$device_type,$pin);
            }else{ 
             $result = $this->login_model_test->send_otp_on_mo($CntNo,$device_model,$device_id,$device_type);
                if ($result) {
                    $otp=rand(1000,9999);
                    return_data(true, 'Success.', $otp);
                } else {
                    return_data(false, 'Something Went Wrong.', array());
                }
            }   
     
    }

    private function validate_login_authentication() {
        $this->form_validation->set_rules('CntNo', 'CntNo', 'trim|required');
         $this->form_validation->set_rules('User-Type', 'User-Type', 'trim|required');
          $this->form_validation->set_rules('Device-Model', 'Device-Model', 'trim|required');
           $this->form_validation->set_rules('Device-Id', 'Device-Id', 'trim|required');
       // $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $this->form_validation->run();
        $error = $this->form_validation->get_all_errors();
        if ($error) {
            return_data(false, array_values($error)[0], array(), $error);
        }
    }
        public function get_mo_pin() {
         $this->validate_get_mo_pin();
         $CntNo = $this->input->post('CntNo');
         if(!empty($CntNo)){
         $result = $this->login_model_test->is_check_pin($CntNo);
        }else{
              $data['pin']='';
              $data['CntNo']=$CntNo;
              return_data(false, 'First give valid mobile', $data );
        }

      }
      private function validate_get_mo_pin() {
          $this->form_validation->set_rules('CntNo', 'CntNo', 'trim|required');
          $this->form_validation->run();
         $error = $this->form_validation->get_all_errors();
        if ($error) {
            return_data(false, array_values($error)[0], array(), $error);
        }
    }

       public function set_mo_pin() {
         $this->validate_set_mo_pin();
         $CntNo = $this->input->post('CntNo');
         $pin = $this->input->post('pin');
         if(!empty($CntNo) && !empty($pin)){
         $result = $this->login_model_test->update_pin($CntNo,$pin);
         }else{
              $data['pin']='';
              $data['CntNo']='';
              return_data(false, 'Wrong entry mobile no. Or pin', $data );
        }
        }

        private function validate_set_mo_pin() {
          $this->form_validation->set_rules('CntNo', 'CntNo', 'trim|required');
          $this->form_validation->set_rules('pin', 'pin', 'trim|required');
         // pre("test");die("tet");
          $this->form_validation->run();
         $error = $this->form_validation->get_all_errors();
        if ($error) {
            return_data(false, array_values($error)[0], array(), $error);
        }
    }
//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<--misslenious -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
  public function home_call(){
         
        $EmpCode = $this->input->post('EmpCode');
      
        $holiday_list = $this->login_model_test->nh_holiday_list(); 
        pre($holiday_list);die;
        
    }
        private function validate_nf_nh_Request() {
            $this->form_validation->set_rules('Requirement', 'Requirement', 'trim|required');
             $this->form_validation->set_rules('EmpCode','EmpCode', 'trim|required');
            $this->form_validation->run();
            $error = $this->form_validation->get_all_errors();
            if ($error) {
                return_data(false, array_values($error)[0], array(), $error);
            }
        }
    

}
