<?php

class Visitor_model extends CI_Model {

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

//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<--  UPLOAD FILE BLOCK START HERE  -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX    
    public function upload_image($file_name, $directory) {
        $path = getcwd() . "/uploads/" . $directory . $file_name;
        if (move_uploaded_file($_FILES['image']['tmp_name'], $path)) {
            return true;
        } else {
            return false;
        }
    }

//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<--  UPLOAD FILE BLOCK END HERE  -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX     
//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<--  VISITOR REGISTRATION BLOCK START HERE  -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX    
    public function is_already_register($mobile) {
        $query = "SELECT * FROM visitor where mobile='$mobile'";
        $result = $this->db->query($query)->row_array();
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function visitor_registration($data) {
        $image = '';
        $file_name='';
        if (isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])) {
            $log = "Time: " . date('Y-m-d, H:i:s') . PHP_EOL;
            $log = $log . "url: " . base_url("masters") . PHP_EOL;
            $log = $log . "Request " . json_encode($this->input->post()) . PHP_EOL;
            if (isset($_FILES)) {
                $log = $log . "Request " . json_encode($_FILES) . PHP_EOL;
            }
            file_put_contents('logs/masters.txt', $log, FILE_APPEND);
            if ($_FILES['image']['size'] > 100000 * 25) {
                return_data(false, 'Sorry, your file is too large. size should below 25 MB', array());
            }
            $file_name = milliseconds() . '_' . $_FILES['image']['name'];
            $directory = 'visitor/';
            $result = $this->upload_image($file_name, $directory);
            if ($result) {
                $image = $file_name;
            }
        }
        $creation_date = date('Y-m-d');
        $in_time = date('H:i');
        $insert_array = array(
            'name' => $data['name'],
            'mobile' => $data['mobile'],
            'image' => $file_name,
            'address' => (isset($data['address']) && !empty($data['address'])) ? $data['address'] : '',
            'arogya_setu_status' => $data['arogya_setu_status'],
            'creation_time' => milliseconds()
        );
        //pre($insert_array);die;
        $this->db->insert('visitor', $insert_array);
        $visitor_id = $this->db->insert_id();
        $visitor_record = array(
            'visitor_id' => $visitor_id,
            'to_whome' => $data['to_whome'],
            'in_time' => $in_time,
            'emp_code' => (isset($data['emp_code']) && !empty($data['emp_code'])) ? $data['emp_code'] : '',
            'creation_date' => $creation_date,
        );
        $this->db->insert('visitor_record', $visitor_record);
        return_data(true, 'Registered Successfully,In time updated.', array());
    }

//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<--  VISITOR REGISTRATION BLOCK END HERE  -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX 
//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<--  VISITOR LIST BLOCK START HERE  -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX    

    public function get_visitor_list($data) {
        $current_date = date('Y-m-d');
        $result_array = array();
        $file_directory = CONFIG_PROJECT_DOMAIN . '/uploads/visitor/';
       $set = $data['page_no'] * $data['limit'];
       $offset = $set - $data['limit'];
       $limit = $data['limit'];
       $query = "SELECT * FROM visitor order by id desc limit $offset,$limit";
        // $query = "SELECT * FROM visitor order by id desc";
        $result = $this->db->query($query)->result_array();
        if ($result) {
            foreach ($result as $value) {
                $value['in_time'] = "";
                $value['out_time'] = "";
                $value['to_whome'] = "";
                if (!empty($value['image'])) {
                    $value['image'] = $file_directory . $value['image'];
                }
                $visitor_id = $value['id'];
                $query1 = "SELECT in_time,out_time FROM visitor_record where creation_date='$current_date' and visitor_id ='$visitor_id'";
                $result1 = $this->db->query($query1)->row_array();
                if ($result1) {
                    if (empty($result1['out_time'])) {
                        $value['in_time'] = trim($result1['in_time']);
                        $value['out_time'] = trim($result1['out_time']);
                    }
                }
                $query2 = "SELECT to_whome FROM visitor_record where visitor_id ='$visitor_id' order by id desc";
                $result2 = $this->db->query($query2)->row_array();
                if ($result2) {
                    $value['to_whome'] = $result2['to_whome'];
                }
                $result_array[] = $value;
            }
            return $result_array;
        } else {
            return false;
        }
    }

//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<--  VISITOR LIST BLOCK END HERE  -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<--  SEARCH VISITOR BY KEYWORD BLOCK START HERE  -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX    

    public function get_visitor_by_keyword($keyword) {
        $current_date = date('Y-m-d');
        $result_array = array();
        $file_directory = CONFIG_PROJECT_DOMAIN . '/uploads/visitor/';
        $query = "SELECT * FROM visitor where name like '%$keyword%' or mobile like '%$keyword%'";
        $result = $this->db->query($query)->result_array();
        if ($result) {
            foreach ($result as $value) {
                $value['in_time'] = "";
                $value['to_whome'] = "";
                $value['out_time'] = "";
                if (!empty($value['image'])) {
                    $value['image'] = $file_directory . $value['image'];
                }
                $visitor_id = $value['id'];
                $query1 = "SELECT in_time,to_whome,out_time FROM visitor_record where creation_date='$current_date' and visitor_id ='$visitor_id'";
                $result1 = $this->db->query($query1)->row_array();
                if ($result1) {
                    $value['in_time'] = trim($result1['in_time']);
                    $value['to_whome'] = $result1['to_whome'];
                    $value['out_time'] = trim($result1['out_time']);
                }
                $result_array[] = $value;
            }
            return $result_array;
        } else {
            return false;
        }
    }

//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<--  SEARCH VISITOR BY KEYWORD BLOCK END HERE  -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX    
//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<--  UPDATE VISITOR IN TIME BLOCK START HERE  -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
    public function is_visitor_exist($visitor_id) {
        $query = "SELECT * FROM visitor where id='$visitor_id'";
        return $this->db->query($query)->row_array();
    }

    public function update_in_time($data) {
        $creation_date = date('Y-m-d');
        $in_time = date('H:i');
        $visitor_id = $data['visitor_id'];
        $to_whome = $data['to_whome'];
        $query = "SELECT in_time FROM visitor_record where creation_date='$creation_date' and visitor_id ='$visitor_id'";
        $result = $this->db->query($query)->row_array();
        if ($result) {
            return_data(false, 'Already in time inserted.', array());
        } else {
            $visitor_record = array(
                'visitor_id' => $visitor_id,
                'to_whome' => $to_whome,
                'in_time' => $in_time,
                'emp_code' => (isset($data['emp_code']) && !empty($data['emp_code'])) ? $data['emp_code'] : '',
                'creation_date' => $creation_date,
            );
        }
        $this->db->insert('visitor_record', $visitor_record);
        return_data(true, 'In time updated successfully.', array());
    }

//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<--  UPDATE VISITOR IN TIME BLOCK END HERE  -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<--  UPDATE VISITOR OUT TIME BLOCK START HERE  -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX    

    public function update_out_time($visitor_id) {
        $creation_date = date('Y-m-d');
        $out_time = date('H:i');
        $query = "SELECT in_time FROM visitor_record where creation_date='$creation_date' and visitor_id ='$visitor_id'";
        $result = $this->db->query($query)->row_array();
        if ($result) {
            $query1 = "update visitor_record SET out_time='$out_time' where creation_date='$creation_date' and visitor_id ='$visitor_id'";
            $this->db->query($query1);
            return_data(true, 'Out time updated successfully.', array());
        } else {
            return_data(false, 'Please insert In Time.', array());
        }
    }

//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<--  UPDATE VISITOR OUT TIME BLOCK END HERE  -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<--  GET LATEST VISITOR COUNT BLOCK START HERE  -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
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

//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<--  GET LATEST VISITOR COUNT BLOCK END HERE  -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX  
//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<--  GET TO WHOME  LIST BLOCK START HERE  -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX         

    public function get_to_whome_list($data) {
        $set = $data['page_no'] * $data['limit'];
        $offset = $set - $data['limit'];
        $limit = $data['limit'];
        $query = "SELECT Name,EmpCode FROM dbo.Login where Code!='NA' and Location like'%Noida%' order by Name asc OFFSET $offset ROWS FETCH NEXT $limit ROWS ONLY";
        $result = sqlsrv_query($this->conn_1, $query);
        if ($result === false) {
            die(print_r(sqlsrv_errors(), true));
        }
        #Fetching Data by array
        $data = array();
        $i = 0;
        while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
            $data[$i] = $row;
            $i++;
        }
        return $data;
    }

//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<--  GET TO WHOME  LIST BLOCK END HERE  -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX    
//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<--  GET TO WHOME  BY KEYWORD BLOCK START HERE  -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX    

    public function get_to_whome_by_keyword($keyword) {
        $file_directory = 'https://sep.sanskargroup.in/EmpImage/';
        $query = "SELECT Name,EmpCode FROM dbo.Login where Code!='NA' and Location like'%Noida%' and ([Name] like '%$keyword%' or [EmpCode] like '%$keyword%' ) order by EmpCode asc";
        $result = sqlsrv_query($this->conn_1, $query);
        if ($result === false) {
            die(print_r(sqlsrv_errors(), true));
        }
        $data = array();
        $i = 0;
        while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
            $data[$i] = $row;
            $i++;
        }
        return $data;
    }

//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<--  GET TO WHOME BY KEYWORD BLOCK END HERE  -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX    
}

?>  