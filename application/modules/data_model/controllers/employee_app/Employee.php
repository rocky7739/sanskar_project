<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('login_model');
        $this->load->helper("services");
        $this->load->library('session');
        $this->load->helper("jwt_validater");


    }

 

    public function login_authentication() {
           $db_credential_1 = array('host' => '10.10.10.7', 'uid' => 'sansdb', 'pwd' => '^d@67ibc#!@', 'db' => 'SanskarPortal');
        $connectionInfo_1 = array("UID" => $db_credential_1['uid'], "PWD" => $db_credential_1['pwd'], "Database" => $db_credential_1['db']);
        $this->conn_1 = sqlsrv_connect($db_credential_1['host'], $connectionInfo_1);
        if (!$this->conn_1) {
            echo $db_credential_1['db'] . " => Connection could not be established.\n";
            die(print_r(sqlsrv_errors(), true));
        }
        //create_log_file(array("url" => "User/login_authentication", "request" => $_POST, "api" => "login_authentication"));
        $CntNo = $this->input->post('CntNo');
        //pre($CntNo);die("test");
        // $this->validate_login_authentication($mobile);
        // $username = $this->input->post('username');
        // $password = $this->input->post('password');
        // $result = $this->login_model->authenticate_gaurd_login($username, $password);
         if ($CntNo) {
            $sql = "select EmpCode,Name, Dept, address,CntNo,Designation,ReportTo,PImg,AadharNo,PanNo,BloodGroup from Login where CntNo = $CntNo";
                        $result= $this->db->query($sql)->row_array();
                        if($result){
                            $otp=rand(1000,9999);
                            $result['otp'] = $otp;
                         return_data(true, 'Success.', $result);
                        }else {
                               return_data(false, 'mobile not register.', array());

         }
         } else {
            return_data(false, 'mobile not registered.', array());

         }
       
    }

    private function validate_login_authentication($mobile) {
    }


//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<--  GET EMPLOYEE LIST BLOCK END HERE  -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX 
}
