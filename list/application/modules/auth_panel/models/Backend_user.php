<?php



if (!defined('BASEPATH'))

    exit('No direct script access allowed');

/*

 * To change this license header, choose License Headers in Project Properties.

 * To change this template file, choose Tools | Templates

 * and open the template in the editor.

 */



class Backend_user extends CI_Model {



    function __construct() {

        parent::__construct();

//data base connectivity with SanskarPortal start here .....

        // $db_credential_1 = array('host' => '10.10.10.7', 'uid' => 'sansdb', 'pwd' => '^d@67ibc#!@', 'db' => 'SanskarPortal');

        // $connectionInfo_1 = array("UID" => $db_credential_1['uid'], "PWD" => $db_credential_1['pwd'], "Database" => $db_credential_1['db']);

        // $this->conn_1 = sqlsrv_connect($db_credential_1['host'], $connectionInfo_1);

        // if (!$this->conn_1) {

        //     echo $db_credential_1['db'] . " => Connection could not be established.\n";

        //     die(print_r(sqlsrv_errors(), true));

        // }

//data base connectivity with SanskarPortal end here .....

//        $this->conn_1 = $this->load->database('sql_default', TRUE);

    }



    public function create_backend_user($data) {

        $result = $this->db->insert("backend_user", $data);

        return $result;

    }



    public function get_user_data($id) {

        $result = $this->db->select('bu.*,burp.permission_group_id')

                        ->join('backend_user_role_permissions as burp', 'bu.id = burp.user_id', 'LEFT')

                        ->where('bu.id', $id)

                        ->get("backend_user as bu")->row_array();



        return $result;

    }



    public function email_exists($key) {

        $this->db->where('email', $key);

        $query = $this->db->get('backend_user');

        if ($query->num_rows() > 0) {

            return true;

        } else {

            return false;

        }

    }



    public function update_backend_user($data, $id) {

        $this->db->where('id', $id);

        $result = $this->db->update("backend_user", $data);

        return $result;

    }



    public function delete_backend_user($id) {

        $data = array('status' => 2);

        $this->db->where('id', $id);

        $result = $this->db->update("backend_user", $data);

    }



    public function block_backend_user($id, $status) {

        $data = array('status' => $status);

        $this->db->where('id', $id);

        $result = $this->db->update("backend_user", $data);

    }



    public function change_password_backend_user($data) {

        $data_array = array('password' => md5($data['new_password']));

        $result = $this->db->where('id', $data['id'])->update("backend_user", $data_array);

    }



    public function get_permission_list() {

        return $this->db->query("SELECT * FROM `backend_user_permission` GROUP BY permission_merge")->result_array();

    }



    public function get_permission_detail_by_id($id) {

        return $this->db->where('id', $id)

                        ->get('permission_group')->row_array();

    }

    

//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<--  GET UPDATED ATTENDANCE COUNT BLOCK START HERE  -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX

    public function get_updated_attendance_count() {

        // $current_date = date('Y-m-d');

        // $query = "select count(sno) as TotalIn from GuardAttendance where AttDate = '$current_date' and InTime !=''";

        // $result = sqlsrv_query($this->conn_1, $query);

        // if ($result === false) {

        //     die(print_r(sqlsrv_errors(), true));

        // } else {

        //     $total_in = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);

        //     $row['total_in'] = (string) $total_in['TotalIn'];
        $row['total_in'] = (string) 10;

        // }

        // $query = "select count(sno) as TotalOut from GuardAttendance where AttDate = '$current_date' and OutTime !=''";

        // $result = sqlsrv_query($this->conn_1, $query);

        // if ($result === false) {

        //     die(print_r(sqlsrv_errors(), true));

        // } else {

        //     $total_in = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);

        //     $row['total_out'] = (string) $total_in['TotalOut'];
        $row['total_out'] = (string) 5;

        // }

        return $row;

    }



//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<--  GET UPDATED ATTENDANCE COUNT BLOCK END HERE  -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX 

    

//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<--  GET UPDATED VISITOR COUNT BLOCK START HERE  -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX

    public function get_updated_visitor_count() {

        $result_array = array('total_in' => '', 'total_out' => '');

        $creation_date = date('Y-m-d');

        $query = "select count(id) as total_in from visitor_record where creation_date='$creation_date' and in_time !=''";

        $result = $this->db->query($query)->row_array();

        if ($result) {

            $result_array['total_in'] = (string) $result['total_in'];

        }

        $query1 = "select count(id) as total_out from visitor_record where creation_date='$creation_date' and out_time !=''";

        $result = $this->db->query($query1)->row_array();

        if ($result) {

            $result_array['total_out'] = (string) $result['total_out'];

        }

        return $result_array;

    }



//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<--  GET UPDATED VISITOR COUNT BLOCK END HERE  -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX      



}

