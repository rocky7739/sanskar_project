<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Employee_model extends CI_Model {

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

    /*     * *
     *       _____                      _    _                  
     *      / ____|                    | |  | |                 
     *     | (___    __ _ __   __ ___  | |  | | ___   ___  _ __ 
     *      \___ \  / _` |\ \ / // _ \ | |  | |/ __| / _ \| '__|
     *      ____) || (_| | \ V /|  __/ | |__| |\__ \|  __/| |   
     *     |_____/  \__,_|  \_/  \___|  \____/ |___/ \___||_|   
     *                                                          
     *                                                          
     */


    public function verify_employee($mobile) {
        $query = "SELECT EmpCode,CntNo from Login where CntNo='$mobile'";
        $result = sqlsrv_query($this->conn_1, $query);
        if ($result === false) {
            die(print_r(sqlsrv_errors(), true));
        } else {
            $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
        }
        return $row;
    }

    public function save_user($data) {
        if (isset($_POST['country_code']) && !empty($_POST['country_code'])) {
            $data['country_code'] = $_POST['country_code'];
        }
        if ($data['login_with'] == 1) {
            $data['mobile'] = $data['mobile'];
        }
        if ($data['login_with'] == 2) {
            $data['email'] = $data['mobile'];
            unset($data['mobile']);
        }
        unset($data['login_with'], $data['device_model']);
        $geolocation_details = get_iso();
        $data['iso'] = (isset($geolocation_details['iso']) && !empty($geolocation_details['iso']) ? $geolocation_details['iso'] : '');
        $data['country_name'] = (isset($geolocation_details['country_name']) && !empty($geolocation_details['iso']) ? $geolocation_details['country_name'] : '');
        $data['creation_time'] = milliseconds();
        $data['last_login'] = milliseconds();
        $this->db->insert('users', $data);
        $user_id = $this->db->insert_id();
        return $user_id;
    }

    public function update_user($data) {
        if (isset($data['country_code']) && !empty($data['country_code'])) {
            $data['country_code'] = $data['country_code'];
        }
        $geolocation_details = get_iso();
        $data['iso'] = (isset($geolocation_details['iso']) && !empty($geolocation_details['iso']) ? $geolocation_details['iso'] : '');
        $data['country_name'] = (isset($geolocation_details['country_name']) && !empty($geolocation_details['iso']) ? $geolocation_details['country_name'] : '');
        $data['last_login'] = milliseconds();
        $this->db->where('id', $data['id']);
        $result = $this->db->update('users', $data);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    /*     * *
     *       _____        _     _    _                  
     *      / ____|      | |   | |  | |                 
     *     | |  __   ___ | |_  | |  | | ___   ___  _ __ 
     *     | | |_ | / _ \| __| | |  | |/ __| / _ \| '__|
     *     | |__| ||  __/| |_  | |__| |\__ \|  __/| |   
     *      \_____| \___| \__|  \____/ |___/ \___||_|   
     *                                                  
     *                                                  
     */

    public function get_user($id) {
        $this->db->where("id", $id);
        $data = $this->db->get('users')->row_array();
        unset($data['last_login']);
        return $data;
    }

    public function check_email_exist($data) {
        $id = $data['id'];
        $email = $data['email'];
        if ($email != '') {
            $query = $this->db->query("SELECT `id`,`email` 
									   FROM `users` 
									   WHERE `id`!='$id' AND `email`='$email'");
            return $query->num_rows();
        } else {
            return 0;
        }
    }

    public function check_mobile_exist($data) {
        $id = $data['id'];
        $mobile = $data['mobile'];
        $query = $this->db->query("SELECT `id`,`mobile` 
								   FROM `users` 
								   WHERE `id`!='$id' AND `mobile`='$mobile'");
        return $query->num_rows();
    }

    /*     * *
     *       _____        _      _____             _                      _    _                  
     *      / ____|      | |    / ____|           | |                    | |  | |                 
     *     | |  __   ___ | |_  | |     _   _  ___ | |_  ___   _ __ ___   | |  | | ___   ___  _ __ 
     *     | | |_ | / _ \| __| | |    | | | |/ __|| __|/ _ \ | '_ ` _ \  | |  | |/ __| / _ \| '__|
     *     | |__| ||  __/| |_  | |____| |_| |\__ \| |_| (_) || | | | | | | |__| |\__ \|  __/| |   
     *      \_____| \___| \__|  \_____|\__,_||___/ \__|\___/ |_| |_| |_|  \____/ |___/ \___||_|   
     *                                                                                            
     *                                                                                            
     */

    public function get_custum_user($info) {
        $this->db->where("mobile", $info['mobile']);
        $this->db->or_where("email", $info['mobile']);
        $data = $this->db->get('users')->row_array();
        unset($data['last_login']);
        return $data;
    }

    public function get_user_from_email($info) {
        $this->db->where("email", $info['email']);
        $data = $this->db->get('users')->row_array();
        unset($data['last_login']);
        return $data;
    }

    public function update_device_tokken($info) {
        $geolocation_details = get_iso();
        $iso = (isset($geolocation_details['iso']) && !empty($geolocation_details['iso']) ? $geolocation_details['iso'] : '');
        $country_name = (isset($geolocation_details['country_name']) && !empty($geolocation_details['iso']) ? $geolocation_details['country_name'] : '');
        $array = array(
            "iso" => $iso,
            "country_name" => $country_name,
            "login_type" => $info['login_type'],
            "device_type" => $info['device_type'],
            "device_token" => $info['device_token'],
            "last_login" => milliseconds()
        );
        $this->db->where('id', $info['id']);
        $this->db->update('users', $array);
    }

    Public function get_user_with_mobile($mobile) {
        $this->db->group_start()
                ->where("mobile", $mobile)
                ->or_where('email', $mobile)
                ->group_end();
        return $this->db->get("users")->row_array();
    }

    public function insert_device_id($data) {
        $data['creation_time'] = milliseconds();
        $this->db->insert('user_device_login_record', $data);
        $udlr_id = $this->db->insert_id();
        return $udlr_id;
    }

    public function update_device_id($data) {
        $device_array = array();
        $this->db->select('device_id');
        $this->db->where('user_id', $data['user_id']);
        $device_id_array = $this->db->get('user_device_login_record')->result_array();
        $this->db->from('user_device_login_record');
        $this->db->where('user_id', $data['user_id']);
        $device_id_count = $this->db->count_all_results();
        if ($device_id_array) {
            foreach ($device_id_array as $device_id) {
                $device_array[] = $device_id['device_id'];
            }
            if (!in_array($data['device_id'], $device_array) && $device_id_count < DEVICE_LIMIT) {
                $data['creation_time'] = milliseconds();
                $this->db->insert('user_device_login_record', $data);
                $udlr_id = $this->db->insert_id();
                return $udlr_id;
            } else if (in_array($data['device_id'], $device_array) && $device_id_count <= DEVICE_LIMIT) {
                return true;
            } else {
                return_data(false, 'Your account has been exceeded maximum login limit', array());
            }
        } else {
            $data['creation_time'] = milliseconds();
            $this->db->insert('user_device_login_record', $data);
            $udlr_id = $this->db->insert_id();
            return $udlr_id;
        }
    }

    public function delete_device_id($data) {
        $update_data = array('otp_verification' => 0);
        $this->db->where('id', $data['user_id']);
        $this->db->update('users', $update_data);
        $this->db->where(array(
            'device_id' => $data['device_id'],
            'user_id' => $data['user_id']
        ));
        $result = $this->db->delete('user_device_login_record');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    public function update_user_otp_verification($data) {
        $this->db->where('mobile', $data['id']);
        $this->db->or_where('email', $data['id']);
        $user_id = $this->db->get("users")->row()->id;
        $update_data = array('otp_verified' => 1);
        if ($user_id) {
            $this->db->where('user_id', $user_id);
            $this->db->where('device_id', $data['device_id']);
            $result = $this->db->update('user_device_login_record', $update_data);
            if ($result) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function get_user_with_token($data) {
        $this->db->where("user_id", $data['user_id']);
        $this->db->where("device_id", $data['device_id']);
        $otp_verified = $this->db->get('user_device_login_record')->row()->otp_verified;
        if ($otp_verified == 0) {
            return_data(false, 'Please verify OTP first.', array());
        }
    }

    public function get_social_user($data) {
        if ($data['login_type'] == 1) {
            $data['fb_id'] = $data['social_token'];
            $this->db->where("fb_id", $data['social_token']);
        }
        if ($data['login_type'] == 2) {
            $data['gmail_id'] = $data['social_token'];
            $this->db->where("gmail_id", $data['social_token']);
        }
        if ($data['login_type'] == 3) {
            $data['apple_id'] = $data['social_token'];
            $this->db->where("apple_id", $data['social_token']);
        }
        $result = $this->db->get('users')->row_array();
        if ($result) {
            unset($result['last_login']);
            return $result;
        } else {
            if ($data['login_with'] == 1 && isset($data['mobile']) && !empty($data['mobile'])) {
                $data['mobile'] = $data['mobile'];
            }
            if ($data['login_with'] == 2 && isset($data['mobile']) && !empty($data['mobile'])) {
                $data['email'] = $data['mobile'];
                unset($data['mobile']);
            }
            unset($data['login_with'], $data['device_model'], $data['social_token']);
            $geolocation_details = get_iso();
            $data['iso'] = (isset($geolocation_details['iso']) && !empty($geolocation_details['iso']) ? $geolocation_details['iso'] : '');
            $data['country_name'] = (isset($geolocation_details['country_name']) && !empty($geolocation_details['iso']) ? $geolocation_details['country_name'] : '');
            $data['creation_time'] = milliseconds();
            $data['last_login'] = milliseconds();
            $this->db->insert('users', $data);
            $user_id = $this->db->insert_id();
            $this->db->where("id", $user_id);
            $result = $this->db->get('users')->row_array();
        }
        unset($result['last_login']);
        return $result;
    }

    public function get_user_plan($user_id) {
        $final_array = array();
        $result = $this->db->query("SELECT ptr.id,ptr.plan_id,pp.plan_name,ptr.validity,ptr.purchase_date,ptr.expire_date
                From premium_transaction_record as ptr
                join premium_plan as pp ON ptr.plan_id=pp.id
                where ptr.transaction_status =1 and user_id=$user_id order by ptr.purchase_date asc")->result_array();
        if ($result) {
            foreach ($result as $res) {
                $current_date = milliseconds();
                $expire_date = $res['expire_date'];
                $validity_exist = $expire_date - $current_date;
                if ($validity_exist > 0) {
                    $res['status'] = 'active';
                } else {
                    $res['status'] = 'expired';
                }
                $final_result[] = $res;
            }
            return $final_result;
        } else {
            return false;
        }
    }

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
            $emp_code = $row['EmpCode'];
            $query = "SELECT InTime FROM GuardAttendance where AttDate='$current_date' and EmpCode ='$emp_code'";
            $in_time_query = sqlsrv_query($this->conn_1, $query);
            if (!empty(sqlsrv_has_rows($in_time_query))) {
                $in_time = sqlsrv_fetch_array($in_time_query, SQLSRV_FETCH_ASSOC);
                $row['in_time'] = trim($in_time['InTime']);
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

}
