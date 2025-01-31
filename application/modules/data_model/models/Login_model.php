<?php

class Login_model extends CI_Model {

    function __construct() {
        parent::__construct();
        //data base connectivity with SanskarPortal start here .....
        $db_credential_1 = array('host' => '10.10.10.7', 'uid' => 'sansdb', 'pwd' => '^d@67ibc#!@', 'db' => 'SanskarPortal');
        $connectionInfo_1 = array("UID" => $db_credential_1['uid'], "PWD" => $db_credential_1['pwd'], "Database" => $db_credential_1['db']);
        $this->conn_1 = sqlsrv_connect($db_credential_1['host'], $connectionInfo_1);
        if (!$this->conn_1) {
            echo $db_credential_1['db'] . " => Connection could not be established.\n";
            die(print_r(sqlsrv_errors(), true));
        }
        //data base connectivity with SanskarPortal end here .....
    }

    public function register_device($device_model, $device_id) {
        $query = "SELECT * FROM device_record where device_model='$device_model' and device_id ='$device_id'";
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
            $this->db->insert('device_record', $insert_array);
            return_data(true, 'Device Registered Successfully.', array());
        }
    }

//# Registered device on MSSQL databse....
//    public function register_device($device_model, $device_id) {
//        $query = "SELECT * FROM device_record where device_model='$device_model' and device_id ='$device_id'";
//        $result = sqlsrv_query($this->conn_1, $query);
//        if ($result === false) {
//            die(print_r(sqlsrv_errors(), true));
//        } else {
//            if (!empty(sqlsrv_has_rows($result))) {
//                return true;
//            } else {
//                $query1 = "INSERT INTO device_record (device_model, device_id, status, created_at)VALUES ('$device_model', '$device_id', '1', '" . date('Y-m-d H:i:s') . "')";
//                $result = sqlsrv_query($this->conn_1, $query1);
//                return_data(true, 'Device Registered Successfully.', array());
//                //return false; 
//            }
//        }
//    }

    public function authenticate_gaurd_login($username, $password) {
        $date = date('Y/m/d');
        $file_directory = 'https://employee.sanskargroup.in/EmpImage/';
        $pswd = base64_encode($password);
        $query = "SELECT * from Login where EmpCode='$username' and Pwd ='$pswd'";
        $result = sqlsrv_query($this->conn_1, $query);
        if ($result === false) {
            die(print_r(sqlsrv_errors(), true));
        } else {
            if (!empty(sqlsrv_has_rows($result))) {
                $query = "SELECT EmpCode,Name,Dept,EmailID,CntNo,address,PImg as image from Login where EmpCode='$username' and Pwd ='$pswd'";
                $result = sqlsrv_query($this->conn_1, $query);
                if ($result === false) {
                    die(print_r(sqlsrv_errors(), true));
                } else {
                    $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
                    $row['image'] = $file_directory . $row['image'];
                    $query = "select count(sno) as TotalIn from GuardAttendance where AttDate = '$date' and InTime !=''";
                    $result = sqlsrv_query($this->conn_1, $query);
                    if ($result === false) {
                        die(print_r(sqlsrv_errors(), true));
                    } else {
                        $total_in = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
                        $row['total_in'] = (string) $total_in['TotalIn'];
                    }
                    $query = "select count(sno) as TotalOut from GuardAttendance where AttDate = '$date' and OutTime !=''";
                    $result = sqlsrv_query($this->conn_1, $query);
                    if ($result === false) {
                        die(print_r(sqlsrv_errors(), true));
                    } else {
                        $total_in = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
                        $row['total_out'] = (string) $total_in['TotalOut'];
                    }
                }
                $vaccin_status = $this->check_vaccination_status($row['EmpCode']);
                $row['dose1'] = (string) $vaccin_status['dose1'];
                $row['dose2'] = (string) $vaccin_status['dose2'];
                return $row;
            } else {
                return false;
            }
        }
    }

//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<--  VERIFY DEVICE BLOCK START HERE  -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX    
    public function verify_device($device_model, $device_id) {
        $query = "SELECT status FROM device_record where device_model='$device_model' and device_id ='$device_id' and status='1'";
        $result = $this->db->query($query)->row_array();
        if ($result) {
            return true;
        } else {
            return_data(false, 'Please Registered Your Device.', array());
        }
    }

//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<--  VERIFY DEVICE BLOCK END HERE  -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX   
// # Verify device through mssql databse...
//    public function verify_device($device_model, $device_id) {
//        $query = "SELECT * FROM device_record where device_model='$device_model' and device_id ='$device_id' and status='1'";
//        $result = sqlsrv_query($this->conn_1, $query);
//        if ($result === false) {
//            die(print_r(sqlsrv_errors(), true));
//        } else {
//            if (!empty(sqlsrv_has_rows($result))) {
//                return true;
//            } else {
//                return_data(false, 'Please Registered Your Device.', array());
//            }
//        }
//    }

    public function get_employee_list($data) {
        $current_date = date('Y-m-d');
        $set = $data['page_no'] * $data['limit'];
        $offset = $set - $data['limit'];
        $limit = $data['limit'];
        $file_directory = 'https://employee.sanskargroup.in/EmpImage/';
        $query = "SELECT Name,EmpCode,EmailID,PImg as image FROM dbo.Login where Code!='NA' and Location like'%Noida%' order by Name asc OFFSET $offset ROWS FETCH NEXT $limit ROWS ONLY";
//        print "SQL: $query\n";die;
        $result = sqlsrv_query($this->conn_1, $query);
        if ($result === false) {
            die(print_r(sqlsrv_errors(), true));
        }
        #Fetching Data by array
        $data = array();
        $i = 0;
        while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
            $row['image'] = $file_directory . $row['image'];
            $vaccin_status = $this->check_vaccination_status($row['EmpCode']);
            $row['dose1'] = (string) $vaccin_status['dose1'];
            $row['dose2'] = (string) $vaccin_status['dose2'];
            $row['in_time'] = "";
            $row['out_time'] = "";
            $emp_code = $row['EmpCode'];
            $query = "SELECT InTime,OutTime FROM GuardAttendance where AttDate='$current_date' and EmpCode ='$emp_code'";
            $in_time_query = sqlsrv_query($this->conn_1, $query);
            if (!empty(sqlsrv_has_rows($in_time_query))) {
                $in_time = sqlsrv_fetch_array($in_time_query, SQLSRV_FETCH_ASSOC);
                $row['in_time'] = trim($in_time['InTime']);
                $row['out_time'] = trim($in_time['OutTime']);
            }
            $data[$i] = $row;
            $i++;
        }
        return $data;
    }

    public function check_vaccination_status($emp_code) {
        $query = "SELECT status as dose1,dose2_status as dose2 FROM EmpVaccination where EmpCode='$emp_code'";
        $result = sqlsrv_query($this->conn_1, $query);
        if ($result === false) {
            die(print_r(sqlsrv_errors(), true));
        } else {
            if (!empty(sqlsrv_has_rows($result))) {
                $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
            } else {
                $row = array('dose1' => '0', 'dose2' => '0');
            }
        }
        return $row;
    }

    public function getGaurdDetails($EmpCode) {
        $query = "SELECT EmpCode,Name,Dept,EmailID,CntNo,address from Login where EmpCode='$EmpCode'";
        $result = sqlsrv_query($this->conn_1, $query);
        if ($result === false) {
            die(print_r(sqlsrv_errors(), true));
        } else {
            $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
        }
        return $row;
    }
     public function authenticate_gaurd_login1($mobile) {
        $query = "SELECT mobile from backend_user where mobile='$mobile'";
        $result = sqlsrv_query($this->conn_1, $query);
       
        if ($result === false) {
            die(print_r(sqlsrv_errors(), true));
        } else {
            $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
        }
        return $row;
    }

}

?>  