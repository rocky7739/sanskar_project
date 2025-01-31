<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Employee_management extends MX_Controller {

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
        $this->load->model("Employee_management_model");
        $this->load->helper("services");
    }

    public function employee_list() {
        $data['page_title'] = "Employee List";
        $view_data['page'] = "employee_list";
        $data['page_data'] = $this->load->view('employee_management/employee_list', $view_data, TRUE);
        echo modules::run(AUTH_DEFAULT_TEMPLATE, $data);
    }

    public function ajax_all_employee_list() {
        // storing  request (ie, get/post) global array to a variable
        $requestData = $_REQUEST;
        $columns = array(
            // datatable column index  => database column name
            0 => 'EmpCode',
            1 => 'Name',
            2 => 'CntNo',
            3 => 'Dept'
        );

        $query = "select count(sno) as total from Login where Code!='NA' and Location like'%Noida%'";
        $result = sqlsrv_query($this->conn_1, $query);
        $query = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
        $totalData = (count($query) > 0) ? $query['total'] : 0;
        $totalFiltered = $totalData;
        $offset = $requestData['start'];
        $limit = $requestData['length'];
//        $sql = "SELECT EmpCode,Name,CntNo,Dept from Login where Code!='NA' and Location like'%Noida%' order by Name asc OFFSET $offset ROWS FETCH NEXT $limit ROWS ONLY";
        $sql = "SELECT EmpCode,Name,CntNo,Dept from Login where Code!='NA' and Location like'%Noida%'";
        // getting records as per search parameters
        if (!empty($requestData['columns'][0]['search']['value'])) {
            $sql .= " AND EmpCode LIKE '" . '%' . $requestData['columns'][0]['search']['value'] . "%' ";
        }
        if (!empty($requestData['columns'][1]['search']['value'])) {
            $sql .= " AND  Name LIKE '" . $requestData['columns'][1]['search']['value'] . "%' ";
        }
        if (!empty($requestData['columns'][2]['search']['value'])) {
            $sql .= " AND CntNo LIKE '" . $requestData['columns'][2]['search']['value'] . "%' ";
        }
        if (!empty($requestData['columns'][3]['search']['value'])) {
            $sql .= " AND Dept LIKE '" . $requestData['columns'][3]['search']['value'] . "%' ";
        }
        $sql .= "  order by Name asc OFFSET $offset ROWS FETCH NEXT $limit ROWS ONLY";
        
        $result = sqlsrv_query($this->conn_1, $sql);

        $data = array();
        while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
            $nestedData = array();
            $nestedData[] = ++$requestData['start'];
            $nestedData[] = (isset($row['EmpCode']) && !empty($row['EmpCode']) ? $row['EmpCode'] : '');
            $nestedData[] = (isset($row['Name']) && !empty($row['Name']) ? $row['Name'] : '');
            $nestedData[] = (isset($row['CntNo']) && !empty($row['CntNo']) ? $row['CntNo'] : '');
            $nestedData[] = (isset($row['Dept']) && !empty($row['Dept']) ? $row['Dept'] : '');
//            $nestedData[] = "<a class='btn-xs bold btn btn-warning' onclick=\"return confirm('Are you sure you want to edit?')\" href='" . AUTH_PANEL_URL . "visitor_management/Visitor_management/'> <i class='fa fa-pencil'></i></a>&nbsp;";
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

    public function enable_disable_visitor($id, $status) {
        if ($status == 1) {
            $header = 'Disable';
            $title = 'Visitor has been disabled successfully';
        }
        if ($status == 0) {
            $header = 'Enable';
            $title = 'Visitor has been enabled successfully';
        }
        $delete_visitor = $this->Visitor_management_model->enable_disable_visitor($id, $status);
        page_alert_box('success', $header, $title);
        redirect(base_url(INDEX_PHP . 'admin-panel/visitor-list'));
    }

}
