<?php

class Login_model_test extends CI_Model {

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

   
    public function register_device($device_model, $device_id) {
        $query = "SELECT * FROM device_details where device_model='$device_model' and device_id ='$device_id'";
        $result = $this->db->query($query)->row_array();
        if ($result) {
            return true;
        } else {
            $insert_array = array(
                'device_model' => $device_model,
                'device_id' => $device_id,
                'status' => 0,
                'creation_time' => milliseconds()
            );
            $this->db->insert('device_details', $insert_array);
            return_data(true, 'Device Registered Successfully.', array());
        }
    }


    public function send_otp_on_mo($CntNo,$device_model,$device_id,$device_type) {
        // $date = date('Y/m/d');
         $file_directory = 'https://employee.sanskargroup.in/EmpImage/';

        // $pswd = base64_encode($password);
         if($CntNo){

                $query = "select EmpCode,Name,BDay,pin,EmailID,JDate,Code,Dept,device_type,device_model,device_id,address,CntNo,Designation,ReportTo,PImg,AadharNo,PanNo,BloodGroup from Login where CntNo='$CntNo'";

                //$result = $this->db->query($query)->row_array();
                $result =sqlsrv_query($this->conn_1, $query);
               // pre($result);die("test");
              if ($result) {
                    $otp=rand(1000,9999);
                     $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
                    $row['otp'] =  $otp;
                    $row['PImg'] = $file_directory . $row['PImg'];
                    $EmpCode= $row['EmpCode'];
                    $pl_bal="  SELECT Balance from PLManagement  where EmpCode='$EmpCode' order by Sno desc OFFSET 0 ROWS FETCH NEXT 1 ROWS ONLY";
                    $pl_balance =sqlsrv_query($this->conn_1, $pl_bal);
                    $pl_balance_total = sqlsrv_fetch_array($pl_balance, SQLSRV_FETCH_ASSOC);
                      if(!empty($pl_balance_total)){
                                            
                                            $row['pl_balance'] =  $pl_balance_total['Balance'];
                    }else{
                        $row['pl_balance'] =  0;
                         
                    }
                    $this->session->set_userdata('EmpCode_login', $EmpCode);
                    return_data(true, 'Send otp Successfully.',$row);
                } else {
                    return_data(false, 'Please Register Mobile No.', array());
                }

         }else{
    
          return_data(false, 'Please Register Mobile No.', array()); 
          }

     } 
            public function login_with_pin($CntNo,$device_model,$device_id,$device_type,$pin) {
                $file_directory = 'https://employee.sanskargroup.in/EmpImage/';
                if($pin){

                $query = "select EmpCode,Name,BDay,EmailID,JDate,Dept,device_type,device_model,device_id,address,CntNo,Code,Designation,ReportTo,PImg,AadharNo,PanNo,BloodGroup,pin from Login where CntNo='$CntNo' and pin='$pin'";
                $result =sqlsrv_query($this->conn_1, $query);
              if ($result) {
                    $otp=rand(1000,9999);
                     $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
                     if(!empty($row)){
                            $row['otp'] =  $otp;
                            $row['PImg'] = $file_directory . $row['PImg'];
                            $EmpCode= $row['EmpCode'];
                            $pl_bal="  SELECT Balance from PLManagement  where EmpCode='$EmpCode' order by Sno desc OFFSET 0 ROWS FETCH NEXT 1 ROWS ONLY";
                            $pl_balance =sqlsrv_query($this->conn_1, $pl_bal);
                            $pl_balance_total = sqlsrv_fetch_array($pl_balance, SQLSRV_FETCH_ASSOC);
                    if(!empty($pl_balance_total)){
                                            
                                            $row['pl_balance'] =  $pl_balance_total['Balance'];
                    }else{
                        $row['pl_balance'] =  0;
                         
                    }
                    $this->session->set_userdata('EmpCode_login', $EmpCode);
                    return_data(true, 'login Successfully.',$row);
                }else{
                    return_data(false, 'Worng in mobile or pin', array());
                }
                } else {
                    return_data(false, 'Please Register Mobile No.', array());
                }

           }else{
              return_data(false, 'Please Register Mobile No.', array()); 
          }                               
         }
     public function is_check_pin($CntNo) {
              $query = "select pin,CntNo,EmpCode from Login where CntNo='$CntNo'";
                $result =sqlsrv_query($this->conn_1, $query);
                 
              if ($result) {            
                     $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
                     if(!empty($row['pin'])){
                    return_data(false, 'Already have pin', $row);
                    }else{
                        $data['pin']='';
                        $data['CntNo']=$CntNo;
                        return_data(true, 'Set pin', $data );
                }

            }
        }
             public function update_pin($CntNo,$pin) {
              $update_id = "UPDATE Login SET pin=$pin WHERE CntNo = '$CntNo'  ";
              $update_id =sqlsrv_query($this->conn_1, $update_id);
              if ($update_id) {            
                               return_data(true, 'Update pin Successfully', array() );
                }else{
                        return_data(false, ' Not Update pin Successfully', array() );
                }
             }

       public function nh_holiday_list() {
        $query = "Select HDate,Description from NHFHList";
                $result =sqlsrv_query($this->conn_1, $query);         
                      
            if($result){
                $data = array();
                $i = 0;
                while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                    $data[$i] = $row;
                    $i++;
                }
                return_data(true, 'Holi Days List',$data);
            }else {
           
            return_data(false, 'No holidays', array());
        }
    }


}

?>  