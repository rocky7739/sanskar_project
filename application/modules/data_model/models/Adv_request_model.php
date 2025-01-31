<?php

class Adv_request_model extends CI_Model {

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

//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<-- off_day start -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX


      public function adv_request($RepaymentDuration,$RequestedAmount,$Reason,$EmpCode) {
          if($EmpCode){
            $UDate = date("Y/m/d");
                $query =  "INSERT INTO AdvanceRequest (EmpCode,RequestedAmount,RepaymentDuration,Reason,Status,RequestedOn) VALUES('$EmpCode','$RequestedAmount','$RepaymentDuration','$Reason','Pending','$UDate')";
                $result =sqlsrv_query($this->conn_1, $query);                
              }            
            if($result){
                $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC); 
                return true;            
               // return_data(true, 'Request Successfully Forword..',$row);
              }      
            else{   
          return_data(false, 'Not inserted data.', array()); 
          }
     }

//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<-- pay slip-->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX

      public function pay_slip_request($EmpRemarks,$MonthFrom,$MonthTo,$EmpCode,$frm_year,$to_year) {
        
          if($EmpCode){             
                $month_from= $MonthFrom.",".$frm_year;
                 $month_to= $MonthTo.",".$to_year;
                 $UDate = date("Y/m/d");
                $query =  "INSERT INTO PaySlipRequest (EmpCode,MonthFrom,MonthTo,EmpRemarks,RequestedOn) VALUES('$EmpCode','$month_from','$month_to','$EmpRemarks','$UDate')";
                $result =sqlsrv_query($this->conn_1, $query);          
              }            
            if($result){
                $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC); 
                return true;            
               // return_data(true, 'pay_slip_request Successfully.',$row);
              }        
            else{  
          return_data(false, 'Not inserted data.', array()); 
          }
     }

//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<-- other request-->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX


      public function other_request($EmpCode,$RequestType,$reason) {
        //create_log_file(array("url" => "api_panel/pay_slip_request", "request" => $_POST, "api" => "pay_slip_request"));
          if($EmpCode){                 
                $UDate = date("Y/m/d");
                $query =  "INSERT INTO OtherRequests (EmpCode,RequestType,others,reason,requestedOn) VALUES('$EmpCode','$RequestType','','$reason','$UDate')";
                $result =sqlsrv_query($this->conn_1, $query);          
              }            
            if($result){
                $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);             
                return_data(true, 'Request Submitted',$row);
              }        
            else{  
          return_data(false, 'Request Not Submitted', array()); 
          }
     }

//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<-- request_type_other-->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX

      public function request_type_other($EmpCode,$RequestType,$reason,$others) {
        //create_log_file(array("url" => "api_panel/pay_slip_request", "request" => $_POST, "api" => "pay_slip_request"));
          if($EmpCode){                
                $UDate = date("Y/m/d");
                $query =  "INSERT INTO OtherRequests (EmpCode,RequestType,others,reason,requestedOn) VALUES('$EmpCode','$RequestType','$others','$reason','$UDate')";
                $result =sqlsrv_query($this->conn_1, $query);          
              }            
            if($result){
                $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);             
                return_data(true, 'Request Submitted.',$row);
              }        
            else{  
          return_data(false, 'Not inserted data.', array()); 
          }
     }
//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<-- work from home-->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX

      public function work_from_home_request($data,$from_date,$to_date,$EmpCode,$reason) {      
          if($EmpCode){           
                 $complete_id = $data['complete_id'];
                 $Name = $data['Name'];
                 $Dept = $data['Dept'];
                 $CntNo = $data['CntNo'];
                 $UDate = date("Y/m/d");

                $query =  "INSERT INTO WorkFromHome (ID,Name,EmpCode,Dept,CntNo,FromDate,ToDate,Reason,Status,AppDate) VALUES('$complete_id','$Name','$EmpCode','$Dept','$CntNo','$from_date','$to_date','$reason','P','$UDate')";
                $result =sqlsrv_query($this->conn_1, $query);          
              }            
            if($result){
                $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC); 
               return true;            
                //return_data(true, 'Work From Home Request Successfully.',$row);
              }        
            else{  
          return_data(false, 'Not inserted data.', array()); 
          }
     }

//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<-- work from home Attendece in time-->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
    public function update_in_time($EmpCode,$data) {
        $attendance_date_time = date('Y-m-d H:i:s');
        $attendance_date = date('Y-m-d');
        $in_time = date('H:i');
       // pre($in_time);die("test");
         $complete_id = $data['complete_id'];
         $Name = $data['Name'];
         $Dept = $data['Dept'];
         $CntNo = $data['CntNo'];

        $query = "SELECT In_time FROM WorkFromHomeAttendence where AttDate='$attendance_date' and EmpCode ='$EmpCode'";
        $result = sqlsrv_query($this->conn_1, $query);
        if ($result === false) {
            die(print_r(sqlsrv_errors(), true));
        } else {
            if (!empty(sqlsrv_has_rows($result))) {
                return_data(false, 'Already in time inserted.', array());
            } else {
                $insert_query = "INSERT INTO WorkFromHomeAttendence (ID,Name,EmpCode,Dept,CntNo,AttDate,In_time,CreationOn,Status) VALUES('$complete_id','$Name','$EmpCode','$Dept','$CntNo','$attendance_date','$in_time','$attendance_date_time','P')";
                $res = sqlsrv_query($this->conn_1, $insert_query);
                $data = array();
                $data['In_time']=$in_time;
                $data['Out_time']='';
                return_data(true, 'Mark In  Done.', $data);
            }
        }
    }
   

    public function update_out_time($EmpCode,$data) {
        $attendance_date_time = date('Y-m-d H:i:s');
        $attendance_date = date('Y-m-d');
        $out_time = date('H:i');
        $complete_id = $data['complete_id'];

        $query = "SELECT In_time FROM WorkFromHomeAttendence where AttDate='$attendance_date' and EmpCode ='$EmpCode'";
        $result = sqlsrv_query($this->conn_1, $query);
        if ($result === false) {
            die(print_r(sqlsrv_errors(), true));
        } else {
            if (empty(sqlsrv_has_rows($result))) {
                return_data(false, 'Please mark in.', array());
            } else {
                     $query = "SELECT Out_time FROM WorkFromHomeAttendence where AttDate='$attendance_date' and EmpCode ='$EmpCode'";
                      $outtime = sqlsrv_query($this->conn_1, $query);

                       if (!$outtime) {
                         die(print_r(sqlsrv_errors(), true));
                       } else {
                            $row=sqlsrv_fetch_array($outtime, SQLSRV_FETCH_ASSOC);
                            if ($row['Out_time']) {
                             return_data(false, 'You are allready markout.', array());
                            }else{
                                $update_query = "update WorkFromHomeAttendence set Out_time='$out_time' where EmpCode='$EmpCode' and AttDate='$attendance_date' and In_time !='' and Out_time is null";
                                $res = (sqlsrv_query($this->conn_1, $update_query));                            
                                $data = array();
                                $data['Out_time']=$out_time;
                                $data['In_time']='';
                                return_data(true, 'Mark out Done.', $data);
                                                       
                            }                
                       }
           }
        }
   }
 

//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<--fetch_all_data->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
               public function fetch_all_data($EmpCode,$code_type,$tablename) {
                    // pre($tablename);die;
                   $login_data = "Select Name,CntNo,Dept,EmailID,PImg from login where EmpCode='$EmpCode'";
                   $data =sqlsrv_query($this->conn_1, $login_data); 
                    if($data){
                        $user = sqlsrv_fetch_array($data, SQLSRV_FETCH_ASSOC);
                        //pre($user);die;
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

                        $Id_n = "Select MAX(Sno) from $tablename";
                        $Id_no =sqlsrv_query($this->conn_1, $Id_n);
                     
                        $Id = sqlsrv_fetch_array($Id_no, SQLSRV_FETCH_ASSOC);
                        $id_count = $Id[''] + 1;
                        $complete_id = $code_type.'/'.$year.'/'.$ID.'/'.$id_count;

                        $data = array("PImg"=>$PImg, "Dept"=>$Dept, "Name"=>"$Name","CntNo"=>"$CntNo","EmailID"=>$EmailID, "DeptCode"=>$ID, "complete_id"=>"$complete_id");
                        return $data;
                    }
  
                }




}

?>  