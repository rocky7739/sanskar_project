<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Attendance_report extends MX_Controller {

    function __construct() {
        parent::__construct();
        /* !!!!!! Warning !!!!!!!11
         *  admin panel initialization
         *  do not over-right or remove auth_panel/auth_panel_ini/auth_ini
         */

//data base connectivity with SanskarPortal start here .....
        $db_credential_1 = array('host' => '10.10.10.7', 'uid' => 'sansdb', 'pwd' => '^d@67ibc#!@', 'db' => 'SanskarPortal');
        $connectionInfo_1 = array("UID" => $db_credential_1['uid'], "PWD" => $db_credential_1['pwd'], "Database" => $db_credential_1['db']);
        $this->conn_1 = sqlsrv_connect($db_credential_1['host'], $connectionInfo_1);
        if (!$this->conn_1) {
            echo $db_credential_1['db'] . " => Connection could not be established.\n";
            die(print_r(sqlsrv_errors(), true));
        }
//data base connectivity with SanskarPortal end here .....
        modules::run('auth_panel/auth_panel_ini/auth_ini');
        $this->load->library('form_validation');
        $this->load->model("Attendance_report_model");
        $this->load->helper("services");
    }

    public function attendance_report() {
        $data['page_title'] = "Attendance Report";
        $view_data['page'] = "attendance_report";
        $view_data['employee_details'] = $this->Attendance_report_model->get_employee_list();
        $data['page_data'] = $this->load->view('employee_management/attendance_report_list', $view_data, TRUE);
        echo modules::run(AUTH_DEFAULT_TEMPLATE, $data);
    }

    public function ajax_all_attendance_record() {
        // storing  request (ie, get/post) global array to a variable
        $requestData = $_REQUEST;
        $columns = array(
            // datatable column index  => database column name
            0 => 'Name'
        );

        $query = "select count(sno) as total from Login where Code!='NA' and Location like'%Noida%'";
        $result = sqlsrv_query($this->conn_1, $query);
        $query = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
        $totalData = (count($query) > 0) ? $query['total'] : 0;
        $totalFiltered = $totalData;
        $offset = $requestData['start'];
        $limit = $requestData['length'];
        $sql = "SELECT EmpCode,Name,Dept from Login where Code!='NA' and Location like'%Noida%'";
        // getting records as per search parameters
        if (!empty($requestData['columns'][0]['search']['value'])) {
            $sql .= " AND  Name LIKE '" . $requestData['columns'][0]['search']['value'] . "%' ";
        }
        $sql .= "  order by Name asc OFFSET $offset ROWS FETCH NEXT $limit ROWS ONLY";

        $result = sqlsrv_query($this->conn_1, $sql);
        $month_last_day = date('t');
        $data = array();
        while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
            $nestedData = array();
            $nestedData[] = ++$requestData['start'];
            $nestedData[] = $row['Name'] . ' | ' . $row['EmpCode'] . ' | ' . $row['Dept'];
            $emp_code = $row['EmpCode'];
            for ($i = 1; $i <= $month_last_day; $i++) {
                $attendance_date = date('Y-m-' . $i);
                $attendance_query = "SELECT EmpCode,InTime,OutTime FROM GuardAttendance where AttDate='$attendance_date' and EmpCode ='$emp_code'";
                $attendance_result = sqlsrv_query($this->conn_1, $attendance_query);
                $attendance_record = sqlsrv_fetch_array($attendance_result, SQLSRV_FETCH_ASSOC);
                if (!empty($attendance_record)) {
                    $attendance_status = "<span class='btn-xs bold btn btn-success'> P </span>";
                } else {
                    $attendance_status = "<span class='btn-xs bold btn btn-danger'> A </span>";
                }
                $nestedData[] = $attendance_status;
            }
            $nestedData[] = "<a class='btn-xs bold btn btn-info pull-right' style='margin-top:15px;' href='" . base_url(INDEX_PHP . 'admin-panel/employee-attendance-record/' . $emp_code) . "'>View</a>&nbsp;";
            $data[] = $nestedData;
        }

        $json_data = array(
            "draw" => intval($requestData['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal" => intval($totalData), // total number of records
            "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data" => $data   // total data array
        );

        echo json_encode($json_data);  // send data as json format
    }

    public function employee_attendance_record($emp_code) {
        $view_data['employee_details'] = $this->Attendance_report_model->get_employee_details($emp_code);
        $data['page_title'] = "Employee Record";
        $view_data['page'] = "attendance_report";
        $data['page_data'] = $this->load->view('employee_management/employee_attendance_record', $view_data, TRUE);
        echo modules::run(AUTH_DEFAULT_TEMPLATE, $data);
    }

    public function ajax_employee_attendance_record() {
        // storing  request (ie, get/post) global array to a variable
        $requestData = $_REQUEST;
        $emp_code = $requestData['emp_code'];
        $columns = array(
                // datatable column index  => database column name
//            0 => 'Name'
        );

        $query = "select count(sno) as total from Login where Code!='NA' and Location like'%Noida%'";
        $result = sqlsrv_query($this->conn_1, $query);
        $query = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
        $totalData = (count($query) > 0) ? $query['total'] : 0;
        $totalFiltered = $totalData;
        $offset = $requestData['start'];
        $limit = $requestData['length'];
        $month_first_day = date('Y-m-1');
        $month_last_day = date('t');
        $sql = "SELECT InTime,OutTime,CONVERT(varchar, AttDate, 23) as AttDate,DATEDIFF(minute,InTime,OutTime)-30 as working_hrs FROM GuardAttendance where AttDate between '2021-08-01' and '2021-08-31' and EmpCode ='$emp_code'";
        // getting records as per search parameters85
//        $sql .= "  order by Name asc OFFSET $offset ROWS FETCH NEXT $limit ROWS ONLY";
//        pre($sql);die;
        $result = sqlsrv_query($this->conn_1, $sql);
        $data = array();
        while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
            $nestedData = array();
            $nestedData[] = ++$requestData['start'];
            $working_hrs = intdiv($row['working_hrs'], 60);
            $working_mins = ($row['working_hrs'] % 60);
            if ($working_hrs < 10) {
                $working_hrs = '0' . $working_hrs;
            }
            if ($working_mins < 10) {
                $working_mins = '0' . $working_mins;
            }
            $nestedData[] = $row['AttDate'];
            $nestedData[] = date('D', strtotime($row['AttDate']));
            $nestedData[] = ($row['InTime'] ? $row['InTime'] : '--N/A--');
            $nestedData[] = ($row['OutTime'] ? $row['OutTime'] : '--N/A--');
            $nestedData[] = $working_hrs . ':' . $working_mins;
            if ($row['InTime'] !== '') {
                $status = "Present";
            } else {
                $status = "Absent";
            }
            $nestedData[] = $status;
            $data[] = $nestedData;
        }

        $json_data = array(
            "draw" => intval($requestData['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal" => intval($totalData), // total number of records
            "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data" => $data   // total data array
        );

        echo json_encode($json_data);  // send data as json format
    }

}
