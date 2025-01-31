<?php

class Attendance_model extends CI_Model {

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

//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<--  SEARCH EMPLOYEE BY KEYWORD BLOCK START HERE  -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX    

    public function get_employee_by_keyword($keyword) {
        $current_date = date('Y-m-d');
        $file_directory = 'https://employee.sanskargroup.in/EmpImage/';
        $query = "SELECT Name,EmpCode,EmailID,PImg as image FROM dbo.Login where Code!='NA' and Location like'%Noida%' and ([Name] like '%$keyword%' or [EmpCode] like '%$keyword%' ) order by EmpCode asc";
        $result = sqlsrv_query($this->conn_1, $query);
        if ($result === false) {
            die(print_r(sqlsrv_errors(), true));
        }
        $data = array();
        $i = 0;
        while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
            $row['image'] = $file_directory . $row['image'];
            $vaccin_status = $this->check_vaccination_status($row['EmpCode']);
            $row['dose1'] = (string) $vaccin_status['dose1'];
            $row['dose2'] = (string) $vaccin_status['dose2'];
            $row['in_time'] = "";
            $emp_code = $row['EmpCode'];
            $query = "SELECT InTime FROM GuardAttendance where AttDate='$current_date' and EmpCode ='$emp_code'";
            $in_time_query = sqlsrv_query($this->conn_1, $query);
            if (!empty(sqlsrv_has_rows($in_time_query))) {
                $in_time = sqlsrv_fetch_array($in_time_query, SQLSRV_FETCH_ASSOC);
                $row['in_time']=trim($in_time['InTime']);
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

//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<--  SEARCH EMPLOYEE BY KEYWORD BLOCK END HERE  -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<--  UPDATE ATTENDANCE BLOCK START HERE  -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
    public function update_in_time($emp_code) {
        $attendance_date_time = date('Y-m-d H:i:s');
        $attendance_date = date('Y-m-d');
        $in_time = date('H:i');
        $query = "SELECT InTime FROM GuardAttendance where AttDate='$attendance_date' and EmpCode ='$emp_code'";
        $result = sqlsrv_query($this->conn_1, $query);
        if ($result === false) {
            die(print_r(sqlsrv_errors(), true));
        } else {
            if (!empty(sqlsrv_has_rows($result))) {
                return_data(false, 'Already in time inserted.', array());
            } else {
                $insert_query = "INSERT INTO GuardAttendance (EmpCode,AttDate,InTime,CreateOn) VALUES('$emp_code','$attendance_date','$in_time','$attendance_date_time')";
                $res = sqlsrv_query($this->conn_1, $insert_query);
                return_data(true, 'In time inserted Successfully.', array());
            }
        }
    }

    public function update_out_time($emp_code) {
        $attendance_date_time = date('Y-m-d H:i:s');
        $attendance_date = date('Y-m-d');
        $out_time = date('H:i');
        $remarks = '';
        if (isset($_POST['remarks']) && !empty($_POST['remarks'])) {
            $string = $_POST['remarks'];
            $remarks = ",Remarks='$string'";
        }
        $update_query = "update GuardAttendance set OutTime='$out_time'$remarks where EmpCode='$emp_code' and AttDate='$attendance_date'";
        $res = sqlsrv_query($this->conn_1, $update_query);
        $update_query1 = "update GuardAttendance set MinsWorked = DATEDIFF(minute,InTime,OutTime)-30 where EmpCode='$emp_code' and AttDate='$attendance_date'";
        $res = sqlsrv_query($this->conn_1, $update_query1);
        return_data(true, 'Out time updated Successfully.', array());
    }

//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<--  UPDATE ATTENDANCE BLOCK END HERE  -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<--  GET LATEST ATTENDANCE COUNT BLOCK START HERE  -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
    public function get_latest_attendance_count() {
        $current_date = date('Y-m-d');
        $query = "select count(sno) as TotalIn from GuardAttendance where AttDate = '$current_date' and InTime !=''";
        $result = sqlsrv_query($this->conn_1, $query);
        if ($result === false) {
            die(print_r(sqlsrv_errors(), true));
        } else {
            $total_in = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
            $row['total_in'] = (string) $total_in['TotalIn'];
        }
        $query = "select count(sno) as TotalOut from GuardAttendance where AttDate = '$current_date' and OutTime !=''";
        $result = sqlsrv_query($this->conn_1, $query);
        if ($result === false) {
            die(print_r(sqlsrv_errors(), true));
        } else {
            $total_in = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
            $row['total_out'] = (string) $total_in['TotalOut'];
        }
        return $row;
    }

//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<--  GET LATEST ATTENDANCE COUNT BLOCK END HERE  -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX    
}

?>  