<?php

class Health_card_model extends CI_Model {

    function __construct() {
        parent::__construct();
        //data base connectivity with SanskarPortal start here .....
        $db_credential_1 = array('host' => '10.10.10.7', 'uid' => 'sansdb', 'pwd' => '^d@67ibc#!@', 'db' => 'SanskarPortal_Dev');
        $connectionInfo_1 = array("UID" => $db_credential_1['uid'], "PWD" => $db_credential_1['pwd'], "Database" => $db_credential_1['db']);
        $this->conn_1 = sqlsrv_connect($db_credential_1['host'], $connectionInfo_1);
        if (!$this->conn_1) {
            echo $db_credential_1['db'] . " => Connection could not be established.\n";
            die(print_r(sqlsrv_errors(), true));
        }
        //data base connectivity with SanskarPortal end here .....
    }

   
    public function health_card_report($EmpName) {
        $file_directory = 'https://employee.sanskargroup.in/EmpVaccieneCert/';
        if($EmpName){
              $query = "select report_path from HealthReport where EmpName = '$EmpName'";
            $result =sqlsrv_query($this->conn_1, $query);
            if($result){

                $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
                $row['report_path'] = $file_directory . $row['report_path'];
                return_data(true, 'health card pdf Successfully.',$row);
              }  
        }
            else{
    
          return_data(false, 'Please Enter Empcode.', array()); 
          }

        }
   //XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<--  vaccination report -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
   public function first_dose_report($EmpName) {
        $file_directory = 'https://employee.sanskargroup.in/EmpVaccieneCert/';
        if($EmpName){
              $query = "select cert1_path from EmpVaccination where EmpName = '$EmpName'";
            $result =sqlsrv_query($this->conn_1, $query);
            if($result){

                $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
                $row['cert1_path'] = $file_directory . $row['cert1_path'];
                return_data(true, 'vaccine_dose pdf Successfully.',$row);
              }  
        }
            else{
    
          return_data(false, 'Please Enter Empcode.', array()); 
          }

        }


}

?>  