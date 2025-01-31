<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


if (!function_exists('pre')) {

    function pre($array) {
        echo "<pre>";
        print_r($array);
        echo "</pre>";
    }

}


// if (!function_exists('return_data')) {
// 	function return_data($status=false,$message="",$data = array(),$error=array()){
// 		if(!$data){
// 			$data = array("status"=>0);
// 		}
// 		echo json_encode(array('status'=>$status,'message'=>$message,'data' => $data ,'error'=>$error)); 
// 		die;	
// 	}
// }

if (!function_exists('return_data')) {

    function return_data($status = false, $message = "", $data = array(), $error = array()) {
        echo json_encode(array('status' => $status, 'message' => $message, 'data' => $data, 'error' => $error));
        die;
    }

}

if (!function_exists('return_data2')) {

    function return_data2($status = false, $message = "", $data = array(), $data2 = array(), $error = array()) {
        echo json_encode(array('status' => $status, 'message' => $message, 'channel' => $data, 'data' => $data2, 'error' => $error));
        die;
    }

}


if (!function_exists('post_check')) {

    function post_check() {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            echo json_encode(array('status' => false, 'message' => "Invalid input parameter.Please use post method.", 'data' => array(), 'error' => array()));
            die;
        }
    }

}

if (!function_exists('milliseconds')) {

    function milliseconds() {
        $mt = explode(' ', microtime());
        return ((int) $mt[1]) * 1000 + ((int) round($mt[0] * 1000));
    }

}

if (!function_exists('is_comma_seprated')) {

    function is_comma_seprated($string = "", $return = "") {

        if ($string != "" && count(explode(",", $string)) > 0) {
            if ($return === True) {
                return explode(',', $string);
            }
            return true;
        } else {
            if ($return === false) {
                return array();
            }
            return false;
        }
    }

}

//get_user_basic_data
if (!function_exists('services_helper_user_basic')) {

    function services_helper_user_basic($user_id) {
        $CI = & get_instance();
        $CI->db->where('id', $user_id);
        return $CI->db->get('users')->row_array();
    }

}

if (!function_exists('create_log_file')) {

    function create_log_file($data) {
        date_default_timezone_set("Asia/Kolkata");

        $log = PHP_EOL . "////////////" . date('d-M-Y, h:i:s A') . "/////////////" . PHP_EOL;
        $log = $log . "Time: " . date('Y-m-d, H:i:s') . PHP_EOL;
        $log = $log . "url: " . base_url("api_panel/") . $data['url'] . PHP_EOL;
        $log = $log . "Request " . json_encode($data['request']) . PHP_EOL;

        file_put_contents('logs/' . $data['api'] . '.txt', $log, FILE_APPEND);
    }

}

function verify_device($device_model, $device_id) {
    $CI = & get_instance();
    $query = "SELECT status FROM device_record where device_model='$device_model' and device_id ='$device_id' and status='1'";
    $result = $CI->db->query($query)->row_array();
    if ($result) {
        return true;
    } else {
        return false;
    }
}

 // function send_email1($message,$to_email,$EmailID,$subject,$cc,$bcc) {  
 // // pre($message); die("lll");
 //    $CI = & get_instance()
 //       // require_once getcwd().'/phpmailerclass/phpmailerclass/class.phpmailer.php';
 //        $mail_config = Array(
 //            'protocol' => 'smtp',
 //            'smtp_host' => 'mail.sanskargroup.in',
 //            'smtp_port' => 465,
 //            'smtp_user' => 'music@sanskargroup.in',
 //            'smtp_pass' => 'P@ssw0rd',
 //            'mailtype'  => 'html', 
 //            'charset' => 'utf-8',
 //            'validate' => true
 //        );
 //        //pre($config); die;
 //        if($EmailID !="" && $to_email !=""){
 //        $this->load->library('email',$mail_config);
 //        $this->email->set_mailtype("html");
 //        $this->email->from($EmailID, 'Sanskar Music');
 //        $this->email->to($to_email);
 //        if($cc!=''){
 //             $this->email->cc($cc); 
 //        }
 //         if($cc!=''){
 //             $this->email->bcc($bcc); 
 //        }
       
 //        //$this->email->bcc('them@their-example.com');
 //        $this->email->subject($subject);
 //        $this->email->message($message);
 //        $success = $this->email->send();
 //        if($success){
 //             return_data(true, 'Email Send.', array()); 
 //        }
 //    }else{
 //          return_data(false, 'Not Email Send.', array());
 //    }
 //    }
