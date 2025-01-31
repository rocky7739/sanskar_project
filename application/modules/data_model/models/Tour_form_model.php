<?php

class Tour_form_model extends CI_Model {

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
   public function tour_request($Date1,$Date2,$Requirement,$Remarks,$Location,$EmpCode) {


        if($EmpCode){

            $login_data = "Select Name,Dept,EmailID,PImg from login where EmpCode='$EmpCode'";
             $data =sqlsrv_query($this->conn_1, $login_data); 
              if($data){
                $user = sqlsrv_fetch_array($data, SQLSRV_FETCH_ASSOC);
                $PImg = $user['PImg'];
                $Dept = $user['Dept'];
                $Name = $user['Name'];
                $EmailID =$user['EmailID'];
                $dept_data = "Select DeptCode from ITDDeptCodeTbl where DeptName='$Dept'";
                $dept_code =sqlsrv_query($this->conn_1, $dept_data);
                $dept_codes = sqlsrv_fetch_array($dept_code, SQLSRV_FETCH_ASSOC);
                $ID =  $dept_codes['DeptCode'];
                $year=date("Y");
                $AppDate = date("Y/m/d");

                $Id_no = "Select MAX(Sno) from TourFormTbl";
                $Id_no =sqlsrv_query($this->conn_1, $Id_no);
                $Id = sqlsrv_fetch_array($Id_no, SQLSRV_FETCH_ASSOC);
                $id_count = $Id[''] + 1;
                $complete_id = 'TR'.'/'.$year.'/'.$ID.'/'.$id_count;
               // pre($complete_id);die; 

                $query =  "INSERT INTO TourFormTbl (Date1,Date2,Requirement,Remarks,Location,EmpCode,Code,Name,Dept,ID,Status,HODApp,HODRemarks,AppDate) VALUES('$Date1','$Date1','$Requirement','$Remarks','$Location','$EmpCode','$PImg','$Name','$Dept','$complete_id','R','','','$AppDate')";
                $result =sqlsrv_query($this->conn_1, $query);
              }

             
            if($result){

                $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
                return true;

              }  
           }
            else{
    
          return_data(false, 'Please Enter Empcode.', array()); 
          }

        }

          public function fetch_all_data($EmpCode,$code_type) {
           $login_data = "Select Name,Dept,EmailID,PImg from login where EmpCode='$EmpCode'";
             $data =sqlsrv_query($this->conn_1, $login_data); 
              if($data){
                $user = sqlsrv_fetch_array($data, SQLSRV_FETCH_ASSOC);
                $PImg = $user['PImg'];
                $Dept = $user['Dept'];
                $Name = $user['Name'];
                $EmailID =$user['EmailID'];
                $dept_data = "Select DeptCode from ITDDeptCodeTbl where DeptName='$Dept'";
                $dept_code =sqlsrv_query($this->conn_1, $dept_data);
                $dept_codes = sqlsrv_fetch_array($dept_code, SQLSRV_FETCH_ASSOC);
                $ID =  $dept_codes['DeptCode'];
                $year=date("Y");
                $AppDate = date("Y/m/d");

                $Id_no = "Select MAX(Sno) from TourFormTbl";
                $Id_no =sqlsrv_query($this->conn_1, $Id_no);
                $Id = sqlsrv_fetch_array($Id_no, SQLSRV_FETCH_ASSOC);
                $id_count = $Id[''] + 1;
                $complete_id = $code_type.'/'.$year.'/'.$ID.'/'.$id_count;

                $data = array("PImg"=>$PImg, "Dept"=>$Dept, "Name"=>"$Name","EmailID"=>$EmailID, "DeptCode"=>$ID, "complete_id"=>"$complete_id");
                return $data;
        }
  
}
}

?>  