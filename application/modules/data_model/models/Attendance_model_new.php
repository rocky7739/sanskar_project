<?php

class Attendance_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        //data base connectivity with SanskarPortal start here .....
        $db_credential_1 = array('host' => '10.10.10.7', 'uid' => 'sansdb', 'pwd' => '^d@67ibc#!@', 'db' => 'SanskarPortal');
        // $db_credential_1 = array('host' => '10.10.10.7', 'uid' => 'sansdb', 'pwd' => '^d@67ibc#!@', 'db' => 'SanskarPortal_Dev');
        $connectionInfo_1 = array("UID" => $db_credential_1['uid'], "PWD" => $db_credential_1['pwd'], "Database" => $db_credential_1['db']);
        $this->conn_1 = sqlsrv_connect($db_credential_1['host'], $connectionInfo_1);
        if (!$this->conn_1) {
            echo $db_credential_1['db'] . " => Connection could not be established.\n";
            die(print_r(sqlsrv_errors(), true));
        }
        //data base connectivity with SanskarPortal end here .....
    }

    //XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<--  SEARCH EMPLOYEE BY KEYWORD BLOCK START HERE  -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX    

    public function get_employee_by_keyword($keyword)
    {
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
            $emp_code = $row['EmpCode'];
            $query = "SELECT InTime,OutTime FROM GuardAttendance where AttDate='$current_date' and EmpCode ='$emp_code'";
            $in_time_query = sqlsrv_query($this->conn_1, $query);
            $row['in_time'] = '';
            $row['out_time'] = '';
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

    public function check_vaccination_status($emp_code)
    {
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
    // public function update_in_time($emp_code)
    // {
    //     $attendance_date_time = date('Y-m-d H:i:s');
    //     $attendance_date = date('Y-m-d');
    //     $in_time = date('H:i');
    //     $query = "SELECT InTime FROM GuardAttendance where AttDate='$attendance_date' and EmpCode ='$emp_code'";
    //     $result = sqlsrv_query($this->conn_1, $query);
    //     if ($result === false) {
    //         die(print_r(sqlsrv_errors(), true));
    //     } else {
    //         if (!empty(sqlsrv_has_rows($result))) {
    //             return_data(false, 'Already in time inserted.', array());
    //         } else {
    //             $insert_query = "INSERT INTO GuardAttendance (EmpCode,AttDate,InTime,CreateOn) VALUES('$emp_code','$attendance_date','$in_time','$attendance_date_time')";
    //             $res = sqlsrv_query($this->conn_1, $insert_query);
    //             return_data(true, 'In time inserted Successfully.', array());
    //         }
    //     }
    // }

    // public function update_out_time($emp_code)
    // {
    //     $attendance_date_time = date('Y-m-d H:i:s');
    //     $attendance_date = date('Y-m-d');
    //     $out_time = date('H:i');
    //     $remarks = '';
    //     if (isset($_POST['remarks']) && !empty($_POST['remarks'])) {
    //         $string = $_POST['remarks'];
    //         $remarks = ",Remarks='$string'";
    //     }
    //     $update_query = "update GuardAttendance set OutTime='$out_time'$remarks where EmpCode='$emp_code' and AttDate='$attendance_date'";
    //     $res = sqlsrv_query($this->conn_1, $update_query);
    //     $update_query1 = "update GuardAttendance set MinsWorked = DATEDIFF(minute,InTime,OutTime)-30 where EmpCode='$emp_code' and AttDate='$attendance_date'";
    //     $res = sqlsrv_query($this->conn_1, $update_query1);
    //     return_data(true, 'Out time updated Successfully.', array());
    // }

    public function update_in_time($emp_code)
    {
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
                /******************************PL MANAGEMENT START******************************************/
                $shift_start_time = strtotime('10:00'); //Shift start time is 10:00 minutes...
                $max_in_time = date("H:i", strtotime('+25 minutes', $shift_start_time)); //Grace time is 25 minutes...
                $str_in_time = strtotime($in_time);
                $str_max_in_time = strtotime($max_in_time);
                $gap_duration = round(abs($str_in_time - $str_max_in_time) / 60, 2);
                $reference = ' PL Deduct due to late by ';
                $this->update_pl($emp_code, $attendance_date, $gap_duration, $reference);
                /******************************PL MANAGEMENT END******************************************/
                $insert_query = "INSERT INTO GuardAttendance (EmpCode,AttDate,InTime,CreateOn) VALUES('$emp_code','$attendance_date','$in_time','$attendance_date_time')";
                $res = sqlsrv_query($this->conn_1, $insert_query);
                return_data(true, 'In time inserted Successfully.', array());
            }
        }
    }

    public function update_out_time($emp_code)
    {
        $attendance_date_time = date('Y-m-d H:i:s');
        $attendance_date = date('Y-m-d');
        $out_time = date('H:i');
        $remarks = '';
        /******************************PL MANAGEMENT START******************************************/
        $shift_end_time = strtotime('19:30'); //Shift start time is 07:30 pm ...
        $str_out_time = strtotime($out_time);
        $gap_duration = round(($shift_end_time - $str_out_time) / 60, 2);
        $reference = ' PL Deduct due to early leave by ';
        $this->update_pl($emp_code, $attendance_date, $gap_duration, $reference);
        /******************************PL MANAGEMENT END******************************************/
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

    public function update_pl($emp_code, $attendance_date, $gap_duration, $reference)
    {
        $mins_10_counter = 0;
        $mins_30_counter = 0;
        $halfday = 0;
        $query = "SELECT count_10_min_late,count_30_min_late FROM Login where EmpCode ='$emp_code'";
        $result = sqlsrv_query($this->conn_1, $query);
        if ($result === false) {
            die(print_r(sqlsrv_errors(), true));
        } else {
            $response1 = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
            $mins_10_counter = $response1['count_10_min_late'];
            $mins_30_counter = $response1['count_30_min_late'];
        }
        $query = "SELECT EmpCode FROM HalfDayLeave where EmpCode ='$emp_code' and RDate='$attendance_date'";
        $result = sqlsrv_query($this->conn_1, $query);
        $response2 = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
        if ($response2) {
            $halfday = 1;
        }
        if ($gap_duration > 25 && $gap_duration < 45 && $halfday == 0) {
            if ($mins_10_counter >= 3) {
                $debit = 0;
                $balance = 0;
                $query = "SELECT Balance FROM PLManagement where EmpCode ='$emp_code' order by Sno desc OFFSET 0 ROWS FETCH NEXT 1 ROWS ONLY";
                $result = sqlsrv_query($this->conn_1, $query);
                if ($result === false) {
                    die(print_r(sqlsrv_errors(), true));
                } else {
                    $response3 = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
                    $debit = 0.25;
                    $balance = $response3['Balance'] - $debit;
                    $reference = ' 0.25 ' . $reference . '10 minutes after three times';
                    $insert_query = "INSERT INTO PLManagement (EmpCode,Debit,Balance,Reference,Date) VALUES('$emp_code','$debit','$balance','$reference','" . date('Y-m-d H:i:s') . "')";
                    $res = sqlsrv_query($this->conn_1, $insert_query);
                    $update_query = "update Login set count_10_min_late = 0 where EmpCode='$emp_code'";
                    $res = sqlsrv_query($this->conn_1, $update_query);
                }
            } else {
                $mins_10_counter = $mins_10_counter + 1;
                $update_query = "update Login set count_10_min_late = '$mins_10_counter' where EmpCode='$emp_code'";
                $res = sqlsrv_query($this->conn_1, $update_query);
            }
        }
        if ($gap_duration > 45 && $halfday == 0) {
            if ($mins_30_counter >= 3) {
                $debit = 0;
                $balance = 0;
                $query = "SELECT Balance FROM PLManagement where EmpCode ='$emp_code' order by Sno desc OFFSET 0 ROWS FETCH NEXT 1 ROWS ONLY";
                $result = sqlsrv_query($this->conn_1, $query);
                if ($result === false) {
                    die(print_r(sqlsrv_errors(), true));
                } else {
                    $response3 = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
                    $debit = 0.50;
                    $balance = $response3['Balance'] - $debit;
                    $reference = ' 0.50 ' . $reference . '30 minutes after three times';
                    $insert_query = "INSERT INTO PLManagement (EmpCode,Debit,Balance,Reference,Date) VALUES('$emp_code','$debit','$balance','$reference','" . date('Y-m-d H:i:s') . "')";
                    $res = sqlsrv_query($this->conn_1, $insert_query);
                    $update_query = "update Login set count_30_min_late = 0 where EmpCode='$emp_code'";
                    $res = sqlsrv_query($this->conn_1, $update_query);
                }
            } else {
                $mins_30_counter = $mins_30_counter + 1;
                $update_query = "update Login set count_30_min_late = '$mins_30_counter' where EmpCode='$emp_code'";
                $res = sqlsrv_query($this->conn_1, $update_query);
            }
        }
    }

    //XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<--  UPDATE ATTENDANCE BLOCK END HERE  -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
    //XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<--  GET LATEST ATTENDANCE COUNT BLOCK START HERE  -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
    public function get_latest_attendance_count()
    {
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
    //XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<--  GET EMPLOYEE ATTENDANCE REPORT BLOCK START HERE  -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX    
    public function get_employee_attendance_report($data)
    {
        $emp_code = $data['emp_code'];
        $from_date = $data['from_date'];
        $to_date = $data['to_date'];
        $query = "Select AttDate,InTime,OutTime,Remarks from GuardAttendance where EmpCode = '$emp_code' and AttDate between '$from_date' and '$to_date' order by SNo asc";
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
    }

    //XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<--  GET EMPLOYEE ATTENDANCE REPORT BLOCK END HERE  -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX    
}
