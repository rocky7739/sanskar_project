<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Attendance_report_model extends CI_Model {

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

//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX---> EMPLOYEE LIST BLOG START <---XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX        
    public function get_employee_list() {
        $query = "SELECT EmpCode,Name,Dept from Login where Code!='NA' and Location like'%Noida%'";
        $result = sqlsrv_query($this->conn_1, $query);
        $data = array();
        while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX---> EMPLOYEE LIST BLOG END <---XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX     
//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX---> EMPLOYEE LIST BLOG START <---XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX        
    public function get_employee_details($emp_code) {
        $query = "SELECT EmpCode,Name,Dept,EmailID,CntNo,address from Login where EmpCode='$emp_code'";
        $result = sqlsrv_query($this->conn_1, $query);
        $employee_details = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
        return $employee_details;
    }

//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX---> EMPLOYEE LIST BLOG END <---XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX            
}
