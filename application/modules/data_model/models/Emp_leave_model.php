<?php

class Emp_leave_model extends CI_Model {

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
//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<-- half day start -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
    public function half_day_leave($leave_res,$from_date,$to_date,$day_type,$EmpCode) {

          if($EmpCode){
             
            $login_data = "Select Name,Dept,CntNo from login where EmpCode='$EmpCode'";
             $data =sqlsrv_query($this->conn_1, $login_data); 
              if($data){
                $user = sqlsrv_fetch_array($data, SQLSRV_FETCH_ASSOC);
                $CntNo = $user['CntNo'];
                $Dept = $user['Dept'];
                $Name = $user['Name'];

                $dept_data = "Select DeptCode from ITDDeptCodeTbl where DeptName='$Dept'";
                $dept_code =sqlsrv_query($this->conn_1, $dept_data);
                $dept_codes = sqlsrv_fetch_array($dept_code, SQLSRV_FETCH_ASSOC);
                $ID =  $dept_codes['DeptCode'];
                $year=date("Y");
                $UDate = date("Y/m/d");

                $Id_no = "Select MAX(Sno) from HalfDayLeave";
                $Id_no =sqlsrv_query($this->conn_1, $Id_no);
                $Id = sqlsrv_fetch_array($Id_no, SQLSRV_FETCH_ASSOC);
                $id_count = $Id[''] + 1;
                $complete_id = 'HF'.'/'.$year.'/'.$ID.'/'.$id_count;
                //pre($complete_id);die; 
                $pl = "  Select Balance from PLManagement where EmpCode ='$EmpCode' order by Sno desc OFFSET 0 ROWS FETCH NEXT 1 ROWS ONLY";
                $data_pl = sqlsrv_query($this->conn_1, $pl); 
                $balance_pl = sqlsrv_fetch_array($data_pl, SQLSRV_FETCH_ASSOC);
                $pl= $balance_pl['Balance'];
                $query =  "INSERT INTO HalfDayLeave (ID,Name,EmpCode,Dept,RDate,CntNo,Reason,UDate,Remarks,HalfDayType,PLRemain,Status,HRStatus) VALUES('$complete_id','$Name','$EmpCode','$Dept','$from_date','$CntNo','$leave_res','$UDate','','$day_type','$pl','R','P')";
                $result =sqlsrv_query($this->conn_1, $query);
                 //pre($result);die;

              }
             
              if($result){
                $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
                return true;
                return_data(true, 'Half day leave request  Successfully.',$row);
              }  
        }
        else{   
         return_data(false, 'Please Enter Empcode.', array()); 
        }

     }

     //XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<-- full day start -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
      public function full_day_leave($leave_res,$from_date,$to_date,$day_type,$EmpCode) {
        // $date = date('Y/m/d');
         if($EmpCode){
            $login_data = "Select Name,Dept,CntNo,Company,Designation,ReportTo from login where EmpCode='$EmpCode'";
             $data =sqlsrv_query($this->conn_1, $login_data); 
              if($data){
                $user = sqlsrv_fetch_array($data, SQLSRV_FETCH_ASSOC);
                $CntNo = $user['CntNo'];
                $Dept = $user['Dept'];
                $Name = $user['Name'];
                $Company = $user['Company'];
                $Designation = $user['Designation'];
                $ReportTo = $user['ReportTo'];

                $dept_data = "Select DeptCode from ITDDeptCodeTbl where DeptName='$Dept'";
                $dept_code =sqlsrv_query($this->conn_1, $dept_data);
                $dept_codes = sqlsrv_fetch_array($dept_code, SQLSRV_FETCH_ASSOC);
                $ID =  $dept_codes['DeptCode'];
                $year=date("Y");
                $AppDate = date("Y/m/d");

                $Id_n = "Select MAX(Application_No) from ITDLeaveRequest";
                $Id_no =sqlsrv_query($this->conn_1, $Id_n);
                $Id = sqlsrv_fetch_array($Id_no, SQLSRV_FETCH_ASSOC);
                $id_count = $Id[''] + 1;
                $complete_id = 'SANS'.'/'.$year.'/'.$ID.'/'.$id_count;
                $date1=       date_create($from_date);
                $date2=       date_create($to_date);
                $diff=date_diff($date1,$date2);           
                $diff= $diff->format("%a");

                $query =  "INSERT INTO ITDLeaveRequest (App_Date,Emp_Req_No,Emp_Name,Emp_Code,Emp_Grade,Company,Dept,Designation,Devision,Reporting_to,Leave_From,Leave_to,Address,LReason,Emp_CntNo,Lduration) VALUES('$AppDate','$complete_id','$Name','$EmpCode','','$Company','$Dept','$Designation','Sanskar TV','$ReportTo','$from_date','$to_date','','$leave_res','$CntNo','$diff')";
                $result =sqlsrv_query($this->conn_1, $query);
              }        
              if($result){
                $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
                return true;              
                //return_data(true, 'Full day leave request  Successfully.',$row);
              }  
            }else{    
             return_data(false, 'Please Enter EmpCode.', array()); 
           }
     }

//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<-- off_day start -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX

      public function off_day_request($Date1,$Requirement,$EmpCode) {
          if($EmpCode){

            $login_data = "Select Name,Dept,CntNo from login where EmpCode='$EmpCode'";
             $data =sqlsrv_query($this->conn_1, $login_data); 
              if($data){
                $user = sqlsrv_fetch_array($data, SQLSRV_FETCH_ASSOC);
                $CntNo = $user['CntNo'];
                $Dept = $user['Dept'];
                $Name = $user['Name'];

                $dept_data = "Select DeptCode from ITDDeptCodeTbl where DeptName='$Dept'";
                $dept_code =sqlsrv_query($this->conn_1, $dept_data);
                $dept_codes = sqlsrv_fetch_array($dept_code, SQLSRV_FETCH_ASSOC);
                $ID =  $dept_codes['DeptCode'];
                $year=date("Y");
                $AppDate = date("Y/m/d");
                $date_data = explode("-",$Date1);
                $Date1_y=$date_data[0];
                $Date1_m=$date_data[1];
                $Date1_d=$date_data[2];
             
                $day = date("l", mktime(0,0,0,$Date1_m,$Date1_d,$Date1_y));

                $Id_no = "Select MAX(Sno) from OffTbl";
                $Id_no =sqlsrv_query($this->conn_1, $Id_no);
                $Id = sqlsrv_fetch_array($Id_no, SQLSRV_FETCH_ASSOC);
                $id_count = $Id[''] + 1;
                $complete_id = 'CO'.'/'.$year.'/'.$ID.'/'.$id_count;
                //pre($complete_id);die; 

                $query =  "INSERT INTO OffTbl (ID,Name,EmpCode,Department,Workoffday,Requirement,Date1,AppDate) VALUES('$complete_id','$Name','$EmpCode','$Dept','$day','$Requirement','$Date1','$AppDate')";
                $result =sqlsrv_query($this->conn_1, $query);
              }            
            if($result){
                $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);              
                return_data(true, 'off_day_request Successfully.',$row);
              }  
        }
          else{
          return_data(false, 'Please Enter Empcode.', array()); 
          }

     }
     //XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<-- fetch_all_data start -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
     public function fetch_all_data($EmpCode,$code_type,$tablename) {
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
                if($tablename=='ITDLeaveRequest'){
                    $Id_no = "Select MAX(Application_No) from $tablename";
                    $Id_n =sqlsrv_query($this->conn_1, $Id_no);
                   
                    $Id = sqlsrv_fetch_array($Id_n, SQLSRV_FETCH_ASSOC);
                    $id_count = $Id[''] + 1;
                    $complete_id = $code_type.'/'.$year.'/'.$ID.'/'.$id_count; 
                }else{
                    $Id_no = "Select MAX(Sno) from $tablename";
                    $Id_n =sqlsrv_query($this->conn_1, $Id_no);
                 
                    $Id = sqlsrv_fetch_array($Id_n, SQLSRV_FETCH_ASSOC);
                    $id_count = $Id[''] + 1;
                    $complete_id = $code_type.'/'.$year.'/'.$ID.'/'.$id_count;
                }
                $data = array("PImg"=>$PImg, "Dept"=>$Dept, "Name"=>"$Name","EmailID"=>$EmailID, "DeptCode"=>$ID, "complete_id"=>"$complete_id");
                return $data;
        }
}

//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<-- NH Nh FH Day -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
    public function nf_nh_Request($Date1,$Requirement,$EmpCode,$fs_day,$data) {
          if($EmpCode){
               
                // pre($data);die;
                 $complete_id = $data['complete_id'];
                 $Name = $data['Name'];
                 $Dept = $data['Dept'];
                 $UDate = date("Y/m/d");


                $query =  "INSERT INTO NHFHDetail (ID,Name,EmpCode,Department,workoffday,Requirement,AppDate,Date1,Status) VALUES('$complete_id','$Name','$EmpCode','$Dept','','$Requirement','$UDate','$Date1','R')";
                $result =sqlsrv_query($this->conn_1, $query);
              }          
             if($result){
                $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
                return true;
                return_data(true, 'NF/NH leave request  Successfully.',$row);
              }  
        
          else{ 
          return_data(false, 'Something Went Wrong', array()); 
          }
     }

//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<-- Leave Cancellation -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX

     public function leave_cancellation($EmpCode,$RequestId,$leave_type) {
            if($EmpCode){ 
                //pre($EmpCode);die;
                $today = date("Y/m/d"); 
                if($leave_type =='half'){       
                    $query =  "UPDATE  HalfDayLeave SET Status = 'X' WHERE EmpCode='$EmpCode' AND ID='$RequestId'  AND (RDate > '$today' OR RDate = '$today')";
                    $result =sqlsrv_query($this->conn_1, $query);            
                    if($result){
                    $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
                    return_data(true, 'Half Day Cancellation  Successfully.',$row);
                    }  
                }
                else if($leave_type =='full'){       
                    $query =  "UPDATE  ITDLeaveRequest SET Final_Status = 'X' WHERE EmpCode='$EmpCode' AND (Leave_From > '$today' OR Leave_From = '$today')";
                    $result =sqlsrv_query($this->conn_1, $query);            
                    if($result){
                    $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
                    return_data(true, 'Full Day Cancellation  Successfully.',$row);
                    }  
                }
                 else if($leave_type =='off'){       
                    $query =  "UPDATE  offtbl SET Status = 'X' WHERE EmpCode='$EmpCode' AND (Date1 > '$today' OR Date1 = '$today')";
                    $result =sqlsrv_query($this->conn_1, $query);            
                    if($result){
                    $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
                    return_data(true, 'Off Day Cancellation  Successfully.',$row);
                    }  
                }
                 else if($leave_type =='nh_duty'){       
                    $query =  "UPDATE  NHFHDetail SET Status = 'X' WHERE EmpCode='$EmpCode' AND (Date1 > '$today' OR Date1 = '$today')";
                    $result =sqlsrv_query($this->conn_1, $query);            
                    if($result){
                    $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
                    return_data(true, 'NH/FH Detail  Cancellation  Successfully.',$row);
                    }  
                }
                 else if($leave_type =='nh_avail'){       
                    $query =  "UPDATE  NHFHAvail SET Status = 'X' WHERE EmpCode='$EmpCode' AND (Date1 > '$today' OR Date1 = '$today')";
                    $result =sqlsrv_query($this->conn_1, $query);            
                    if($result){
                    $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
                    return_data(true, 'NHFHAvail Cancellation  Successfully.',$row);
                    }  
                }
                 else if($leave_type =='tour'){       
                    $query =  "UPDATE  TourFormTbl SET Status = 'X' WHERE EmpCode='$EmpCode' AND (Date1 > '$today' OR Date1 = '$today')";
                    $result =sqlsrv_query($this->conn_1, $query);            
                    if($result){
                    $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
                    return_data(true, 'Tour Cancellation  Successfully.',$row);
                    }  
                }

                else{    
                    return_data(false, 'Something Went Wrong', array()); 
                }
            }
             else{    
                    return_data(false, 'Invalid Data', array()); 
           }
     }

//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<-- Fetch leave cancellation  -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX


     public function fetch_leave_cancellation($EmpCode,$leave_type) {
            if($EmpCode){ 
                //pre($EmpCode);die; 
                  $today = date("Y/m/d");
                 
                if($leave_type =='half'){       
                    $query =  "SELECT  ID,UDate from HalfDayLeave WHERE EmpCode='$EmpCode' AND (RDate > '$today' OR RDate = '$today') AND Status!='X'";
                    $result =sqlsrv_query($this->conn_1, $query);            
                    if($result){
                        $data = array();
                        $i = 0;
                        while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                        $data[$i] = $row['ID']." ".$row['UDate']->format('Y-m-d');;
                        $i++;
                        }
                        if($data){
                            return_data(true, 'Get Half Day Cancellation ID.',$data);
                        }
                        else{
                        return_data(false, 'No Found data', array());    
                    }
                    }  
                }
                else if($leave_type =='full'){       
                    $query =  "SELECT  Emp_Req_No,App_Date from  ITDLeaveRequest WHERE EmpCode='$EmpCode' AND (Leave_From > '$today' OR Leave_From = '$today') AND Status!='X'";
                    $result =sqlsrv_query($this->conn_1, $query);            
                    if($result){
                        $data = array();
                        $i = 0;
                        while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                         $data[$i] = $row['Emp_Req_No']." ".$row['App_Date']->format('Y-m-d');;
                        $i++;
                        }
                        if($data){
                            return_data(true, 'Get Full Day Cancellation ID.',$data);
                        }
                        else{
                        return_data(false, 'No Found data', array());    
                    }
                    } 
                    else{
                     return_data(false, 'No Found Data', array());    
                    } 
                }
                 else if($leave_type =='off'){       
                    $query =  "SELECT ID,AppDate from offtbl WHERE EmpCode='$EmpCode' AND (Date1 > '$today' OR Date1 = '$today') AND Status!='X'";
                    $result =sqlsrv_query($this->conn_1, $query);            
                     if($result){
                        $data = array();
                        $i = 0;
                        while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                        $data[$i] =$row['ID']." ".$row['AppDate']->format('Y-m-d');
                        $i++;
                        }
                        if($data){
                            return_data(true, 'Get Off Day Cancellation ID.',$data);
                        }
                        else{
                        return_data(false, 'No Found data', array());    
                    }
                    }  
                    else{
                     return_data(false, 'No Found data', array());    
                    } 
                }
                 else if($leave_type =='nh_duty'){       
                    $query =  "SELECT ID,AppDate from  NHFHDetail WHERE EmpCode='$EmpCode' AND (Date1 > '$today' OR Date1 = '$today') ";
                    $result =sqlsrv_query($this->conn_1, $query);            
                     if($result){
                        $data = array();
                        $i = 0;
                        while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                        $data[$i] =$row['ID']." ".$row['AppDate']->format('Y-m-d');;
                        $i++;
                        }
                        if($data){
                            return_data(true, 'Get NH/Fh Duty Cancellation ID.',$data);
                        }
                        else{ 
                        return_data(false, 'No Found data', array());    
                    }
                    } 
                    else{
                     return_data(false, 'No Found data', array());    
                    }   
                }
                 else if($leave_type =='nh_avail'){       
                    $query =  "SELECT ID,AppDate from  NHFHAvail  WHERE EmpCode='$EmpCode' AND (Date1 > '$today' OR Date1 = '$today') AND Status!='X'";
                    $result =sqlsrv_query($this->conn_1, $query);            
                    if($result){
                        $data = array();
                        $i = 0;
                        while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                        $data[$i] = $row['ID']." ".$row['AppDate']->format('Y-m-d');;
                        $i++;
                        }
                      if($data){
                            return_data(true, 'Get NH/Fh Avail Cancellation ID.',$data);
                        }
                        else{
                        return_data(false, 'No Found data', array());    
                    }
                    } 
                    else{
                     return_data(false, 'No Found data', array());    
                    }   
                }
                 else if($leave_type =='tour'){       
                    $query =  "SELECT ID,AppDate from  TourFormTbl  WHERE EmpCode='$EmpCode' AND (Date1 > '$today' OR Date1 = '$today') AND Status!='X'";
                    $result =sqlsrv_query($this->conn_1, $query);            
                    if($result){
                        $data = array();
                        $i = 0;
                        while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                        $data[$i] = $row['ID']." ".$row['AppDate']->format('Y-m-d');;
                        $i++;
                        }
                       if($data){
                            return_data(true, 'Get Tour Cancellation ID.',$data);
                        }
                        else{
                        return_data(false, 'No Found data', array());    
                    }
                    }  
                    else{
                     return_data(false, 'No Found data', array());    
                    }  
                }
                else{    
                    return_data(false, 'Something Went Wrong', array()); 
                }
            }
             else{    
                    return_data(false, 'Invalid Data', array()); 
           }
     }


//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<--Get leave request list-->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX


     public function get_half_day_leave_request_list($EmpCode) {
            if($EmpCode){ 
                //pre($EmpCode);die; 
                  $today = date("Y/m/d");
                  $all = array();
                $today_date=date('Y-m-d',strtotime("-30 days"));
                 $today_7=date('Y-m-d',strtotime("-0 days"));
                    $query =  "SELECT  ID,RDate,Status from HalfDayLeave WHERE UDate >'$today_date' AND EmpCode='$EmpCode' ORDER BY Sno desc" ;
                    $result =sqlsrv_query($this->conn_1, $query);            
                    if($result){
                        $data = array();
                        $i = 0;
                        while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                        $data[$i] = $row;
                        $i++;
                        }
                        if($data){
                                  $all['0']=$data;
                        }else{
                           return_data(false, 'No Data', array());  
                        }                       
                    }  
                    return_data(true, 'All Found Data', $all);
            }
            else{
             return_data(false, 'No Found Data', array());    
            }       
       }

        public function get_full_day_leave_request_list($EmpCode) {
            if($EmpCode){ 
                //pre($EmpCode);die; 
                  $today = date("Y/m/d");
                  $all = array();
                $today_date=date('Y-m-d',strtotime("-30 days"));
                 $today_7=date('Y-m-d',strtotime("-0 days")); 
     
                    $query1 =  "SELECT  Emp_Req_No,Lduration,Leave_From,Leave_to,HOD_Approval from  ITDLeaveRequest WHERE App_Date >'$today_date' AND Emp_Code='$EmpCode' ORDER BY Application_No desc";
                    $result1 =sqlsrv_query($this->conn_1, $query1);            
                    if($result1){
                        $data = array();
                        $i = 0;
                        while ($row = sqlsrv_fetch_array($result1, SQLSRV_FETCH_ASSOC)) {//pre($row);die;
                         $data[$i] = $row;
                        $i++;
                        }
                        if($data){
                            $all['0']=$data;
                        }else{
                            return_data(false, 'No Data', array()); 
                        }

                    } 
                    return_data(true, 'All Found Data', $all);
            }
            else{
             return_data(false, 'No Found Data', array());    
            } 
                
           
       }


}

?>  