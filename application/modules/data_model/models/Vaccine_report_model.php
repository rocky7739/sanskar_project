<?php

class Vaccine_report_model extends CI_Model {

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
   //XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<--  first_dose vaccination report -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
   public function first_dose_report($EmpCode) {
        $file_directory = 'https://employee.sanskargroup.in/EmpVaccieneCert/';
        if($EmpCode){
              $query = "select EmpCode,cert1_path,cert2_path from EmpVaccination where EmpCode = '$EmpCode'";
            $result =sqlsrv_query($this->conn_1, $query);
            if($result){

                $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);

                 $path2= trim($row['cert2_path']);
               
                if(!empty($row['cert1_path'])){
                $data['cert1_path1'] = $file_directory . $row['cert1_path'];
                 $data['cert1_path'] =  $row['cert1_path'];
                }
                if(!empty($path2)){
                
                 $data['cert2_path1'] = $file_directory . $row['cert2_path'];
                 $data['cert2_path'] =  $row['cert2_path'];                
                }else{
                 $data['cert2_path1'] = "";
                 $data['cert2_path'] =  "";
            }
                return_data(true, 'vaccine_dose pdf Successfully.',$data);
              }  
        }
            else{
    
          return_data(false, 'Please Enter Empcode.', array()); 
          }

   }
   //XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<-- second_dose vaccination report -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
   public function second_dose_report($EmpCode) {
        $file_directory = 'https://employee.sanskargroup.in/EmpVaccieneCert/';
        if($EmpCode){
              $query = "select EmpCode,cert2_path from EmpVaccination where EmpCode = '$EmpCode'";
            $result =sqlsrv_query($this->conn_1, $query);
            if($result){

                $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
                $row['cert2_path1'] = $file_directory . $row['cert2_path'];
                 $row['cert2_path'] =  $row['cert2_path'];
                return_data(true, 'vaccine_dose pdf Successfully.',$row);
              }  
        }
            else{
    
          return_data(false, 'Please Enter Empcode.', array()); 
          }

        }

}

?>  