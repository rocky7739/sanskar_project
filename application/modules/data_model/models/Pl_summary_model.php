<?php

class Pl_summary_model extends CI_Model {

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

//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<-- pl summary -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
      public function pl_summary_report($EmpCode) {
          if($EmpCode){ 
            //pre($EmpCode);die;
                //$query =  "select * from PLDeduct where EmpCode = '$EmpCode' order by Sno desc OFFSET 0 ROWS FETCH NEXT 10 ROWS ONLY";
               $query =  "SELECT Credit,Debit,Balance,Date from PLManagement  where EmpCode='$EmpCode ' order by Sno desc";
                $result =sqlsrv_query($this->conn_1, $query);         
            }            
            if($result){
                #Fetching Data by array
                $data = array();
                $i = 0;
                while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                    $data[$i] = $row;
                    $i++;
                }
                return_data(true, 'pl_summary_report Successfully.',$data);
            }        
            else{  
            return_data(false, 'Not Found Data.', array()); 
            }
     }

//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<-- pl summary -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
      public function guest_request($data,$G_name,$Mobile,$Address,$Arogyasetu_status,$EmpCode,$To_whome,$Reason,$Date1,$In_time) {
             if($EmpCode){
                 $complete_id = $data['complete_id'];
                 $To_whome= $data['Name'];
                 $AppDate = date("Y/m/d");
                 //$In_time = date("H:i:s");
                
                $query =  "INSERT INTO GuestRequest (ID,G_name,Mobile,Address,Arogyasetu_status,EmpCode,To_whome,Reason,Date1,AppDate,Status,In_time) VALUES('$complete_id','$G_name','$Mobile','$Address','safe','$EmpCode','$To_whome','$Reason','$Date1','$AppDate','P','$In_time')";
                $result =sqlsrv_query($this->conn_1, $query);
              }           
            if($result){
                $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
                return_data(true, 'guest_request Successfully.',$row);
            }  
            else{   
             return_data(false, 'Not Found Data.', array()); 
            }
     }

//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<--fetch_all_data->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
               public function fetch_all_data($EmpCode,$code_type,$tablename) {
               $login_data = "Select Name,CntNo,Dept,EmailID,PImg from login where EmpCode='$EmpCode'";
               $data =sqlsrv_query($this->conn_1, $login_data); 
              if($data){
                $user = sqlsrv_fetch_array($data, SQLSRV_FETCH_ASSOC);
                $PImg = $user['PImg'];
                $Dept = $user['Dept'];
                $Name = $user['Name'];
                $CntNo = $user['CntNo'];
                $EmailID =$user['EmailID'];
                $dept_data = "Select DeptCode from ITDDeptCodeTbl where DeptName='$Dept'";
                $dept_code =sqlsrv_query($this->conn_1, $dept_data);
                $dept_codes = sqlsrv_fetch_array($dept_code, SQLSRV_FETCH_ASSOC);
                $ID =  $dept_codes['DeptCode'];
                $year=date("Y");
                $AppDate = date("Y/m/d");

                $Id_no = "Select MAX(Sno) from $tablename";
               // pre($Id_no);die;
                $Id_no =sqlsrv_query($this->conn_1, $Id_no);
                $Id = sqlsrv_fetch_array($Id_no, SQLSRV_FETCH_ASSOC);
                $id_count = $Id[''] + 1;
                $complete_id = $code_type.'/'.$year.'/'.$ID.'/'.$id_count;

                $data = array("PImg"=>$PImg, "Dept"=>$Dept, "Name"=>"$Name","CntNo"=>"$CntNo","EmailID"=>$EmailID, "DeptCode"=>$ID, "complete_id"=>"$complete_id");
                return $data;
        }
  
}


}

?>  