<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Employee extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('employee_model');
        $this->load->helper("services");
        $this->load->helper("message_sender");
        $this->load->library('session');
        $this->load->library('aws_s3_file_upload');
        $this->load->helper("jwt_validater");
    }

    //XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<--  SIGNUP/LOGIN BLOCK START HERE  -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX

    public function login_authentication()
    {
        //create_log_file(array("url" => "User/login_authentication", "request" => $_POST, "api" => "login_authentication"));
        $this->validate_login_authentication();
        $mobile = $this->input->post("mobile");
        $otp = (string) rand(1001, 9999);
        $msg = "Dear User, Your OTP for Sanskar mobile verification is $otp.Sanskar Tv";  //TEMPLATEID_TWO
        $exist = $this->employee_model->verify_employee($mobile);
        if ($exist) {
            $sent_sms = $this->send_otp($mobile, $otp, $msg);
            /* return with auth tokken from here */
            /* please handle carefully */
            $payload = array();
            $payload["id"] = $exist['EmpCode'];
            $jwt = create_jwt($payload);
            if ($jwt != "") {
                return_data(true, 'Employee authentication successful.', array('jwt' => $jwt));
            } else {
                return_data(false, 'Something Went Wrong.', array());
            }
        } else {
            return_data(false, 'Employee Authentication Failed.', array());
        }
    }

    private function validate_login_authentication()
    {
        post_check();
        $this->form_validation->set_rules('mobile', 'Mobile', 'trim|required');
        $this->form_validation->run();
        $error = $this->form_validation->get_all_errors();
        if ($error) {
            return_data(false, array_values($error)[0], array(), $error);
        }
    }

    public function logout()
    {
        $this->validate_logout();
        $data = $this->input->post();
        reset_session($data['user_id']);
        $logout = $this->users_model->delete_device_id($data);
        return_data(true, 'Successfully logged out from device.', array());
        //        if ($logout) {
        //            return_data(true, 'Successfully logged out from device.', array());
        //        } else {
        //            return_data(false, 'Something Went Wrong.', array());
        //        }
    }

    private function validate_logout()
    {
        post_check();
        $this->form_validation->set_rules('user_id', 'User ID', 'trim|required');
        $this->form_validation->set_rules('device_id', 'Device ID', 'trim|required');
        $this->form_validation->run();
        $error = $this->form_validation->get_all_errors();

        if ($error) {
            return_data(false, array_values($error)[0], array(), $error);
        }
    }

    //XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<--  SIGNUP/LOGIN BLOCK START HERE  -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX 
    //XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<--  RESEND/VERIFY OTP BLOCK START HERE  -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX 

    public function send_otp($mobile, $otp, $message)
    {
        $peid = PEID;
        $templateid = TEMPLATEID_TWO;
        if (filter_var($mobile, FILTER_VALIDATE_EMAIL)) {
            modules::run(
                'data_model/emailer/send_otp_on_email_sign_up/otp_for_sign_up',
                array("otp" => $otp, "email" => $mobile)
            );
        } else {
            $url = "smsidea.co.in/smsstatuswithid.aspx";
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, "mobile=9818524882&pass=soloidc123&senderid=SANSAT&to=$mobile&otp=$otp&msg=$message&peid=$peid&templateid=$templateid");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
            $response = curl_exec($ch);
            if ($response != '') {
                otp_verification($mobile, $otp, false, false);
                return true;
            } else {
                return false;
            }
        }
        otp_verification($mobile, $otp, false, false);
    }

    public function send_verification_otp()
    {
        $this->validate_send_verification_otp();
        $to = $this->input->post('mobile');
        $device_id = $this->input->post('device_id');
        if (!$this->input->post("otp")) {
            $otp = rand(1000, 9999);
            $msg = "Dear User, Your OTP for Sanskar mobile verification is $otp.Sanskar Tv";  //TEMPLATEID_TWO
            $text = "Email";
            if (filter_var($to, FILTER_VALIDATE_EMAIL)) {
                modules::run(
                    'data_model/emailer/send_otp_on_email_sign_up/otp_for_sign_up',
                    array("otp" => $otp, "email" => $to)
                );
            } else {
                $text = "Mobile Number";
                $this->send_otp($to, $otp, $msg);
            }
            otp_verification($to, $otp, false, false);
            return_data(true, 'We have sent an OTP on your ' . $text . '.');
        } else {
            $res_code = otp_verification($to, $this->input->post("otp"), true, false);
            if ($res_code != 1) {
                $message = "";
                switch ($res_code) {
                    case 2:
                        $message = "OTP expired";
                        break;
                    case 3:
                        $message = "You Have Entered Invalid OTP";
                        break;
                }
                return_data(false, $message, array());
            }
            $this->users_model->update_user_otp_verification(array('id' => $to, 'device_id' => $device_id));
            return_data(true, "OTP Verified", array());
        }
    }

    public function resend_verification_otp()
    {
        $this->validate_send_verification_otp();
        $to = $this->input->post('mobile');
        $otp = rand(1000, 9999);
        $msg = "Dear User, Your OTP for Sanskar mobile verification is $otp.Sanskar Tv";  //TEMPLATEID_TWO
        $text = "Email";
        if (filter_var($to, FILTER_VALIDATE_EMAIL)) {
            modules::run(
                'data_model/emailer/send_otp_on_email_sign_up/otp_for_sign_up',
                array("otp" => $otp, "email" => $to)
            );
        } else {
            $text = "Mobile Number";
            $this->send_otp($to, $otp, $msg);
        }
        otp_verification($to, $otp, false, false);
        return_data(true, 'We have sent an OTP on your ' . $text . '.');
    }

    private function validate_send_verification_otp()
    {
        post_check();
        $this->form_validation->set_rules('mobile', 'Mobile Number', 'trim|required');
        $this->form_validation->set_rules('device_id', 'Device ID', 'trim|required');
        /* check country code */
        if (!array_key_exists('country_code', $_POST)) {
            $_POST['country_code'] = "+91";
        } else {
            $this->form_validation->set_rules('country_code', 'Country code', 'trim|required');
        }
        $this->form_validation->run();
        $error = $this->form_validation->get_all_errors();
        if ($error) {
            return_data(false, array_values($error)[0], array(), $error);
        }
    }

    //XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<--  RESEND/VERIFY OTP BLOCK END HERE  -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX    
    //XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<--  GET USER DETAILS BLOCK START HERE  -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX

    public function get_user_profile_with_token()
    {
        $this->validate_get_user_profile_with_token();
        $device_id = $this->input->post('device_id');
        $login_type = $this->input->post('login_type');
        $header = getallheaders();

        $jwt = $header['Jwt'] ?? $header['jwt'] ?? "";
        $user_info = validate_jwt($jwt);
        if ($user_info) {
            if ($login_type == 0) {
                $user = $this->users_model->get_user_with_token(array('user_id' => $user_info['id'], 'device_id' => $device_id));
            }
            $user_detail = $this->users_model->get_user($user_info['id']);
            if ($user_detail['wtsp_sms_send'] == 0) {
                $send_whatsapp_msg = send_whatsapp_msg($user_detail['mobile']); //send welcome message on whatsapp on registartion...28/12/2020 by Ariph Husain
                if ($send_whatsapp_msg) {
                    $updateData = array(
                        'wtsp_sms_send' => 1
                    );
                    $this->db->where('id', $this->input->post('id'));
                    $this->db->update('users', $updateData);
                }
            }
            return_data(true, 'User profile.', $user_detail);
        }
        return_data(false, "User Session Expired", array(), array(), "100100");
    }

    private function validate_get_user_profile_with_token()
    {
        post_check();
        $this->form_validation->set_rules('device_id', 'Device ID', 'trim|required');
        $this->form_validation->set_rules('login_type', 'Login Type', 'trim|required');
        $this->form_validation->run();
        $error = $this->form_validation->get_all_errors();
        if ($error) {
            return_data(false, array_values($error)[0], array(), $error);
        }
    }

    //XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<--  GET USER DETAILS BLOCK END HERE  -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX 
    //XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<--  UPDATE USER DETAILS BLOCK START HERE  -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX 

    public function update_profile()
    {
        $this->validate_update_profile();
        $data = $this->input->post();
        if (isset($_POST['country_code']) && !empty($_POST['country_code'])) {
            $data['country_code'] = $_POST['country_code'];
        }

        // $log = "Time: " . date('Y-m-d, H') . PHP_EOL;
        //       //$log = $log . "Request " . json_encode($data) . PHP_EOL;
        //       $log = $log . "file_Request_as_file " . json_encode($_FILES) . PHP_EOL;
        //       $log = $log . "file_Request_as_post " . json_encode($this->input->post('profile_picture')) . PHP_EOL;
        //       file_put_contents('logs/update_profile.txt', $log, FILE_APPEND);

        if (isset($_FILES['profile_picture'])) {
            $data['profile_picture'] = $this->aws_s3_file_upload->aws_s3_file_upload($_FILES['profile_picture'], 'app_user/profile_image');
        }
        $data['otp'] = (string) rand(1001, 9999);
        $msg = "Dear User, Your OTP for Sanskar mobile verification is " . $data['otp'];

        //check mobile and email registered with other user
        $check_email_exist = $this->users_model->check_email_exist(array('id' => $data['id'], 'email' => $data['email']));
        if ($check_email_exist != '') {
            return_data(false, 'This email is already registerd with other user please use different email.', array());
        }
        $check_mobile_exist = $this->users_model->check_mobile_exist(array('id' => $data['id'], 'mobile' => $data['mobile']));
        if ($check_mobile_exist != '') {
            return_data(false, 'This mobile number is already registerd with other user please use different mobile number.', array());
        }
        $user_detail = $this->users_model->get_user($data['id']);
        if ($user_detail['mobile'] == $data['mobile']) {
            unset($data['otp']);
            $result = $this->users_model->update_user($data);
            if ($result) {
                $update_user_details = $this->users_model->get_user($data['id']);
                return_data(true, 'Profile updated successfully.', $update_user_details);
            }
        } else {
            $send_otp = send_message_global($data['country_code'], $data['mobile'], $msg);
            $this->users_model->update_user(array('id' => $data['id'], 'otp_verification' => 0));
            return_data(true, 'OTP has been sent for mobile number verification', $data);
        }
    }

    private function validate_update_profile()
    {

        post_check();
        //$this->form_validation->set_message('is_unique', '%s already exist.');
        //$this->form_validation->set_rules('username','username', 'trim|required');
        //$this->form_validation->set_rules('email','Email', 'trim|required|valid_email');
        //$this->form_validation->set_rules('mobile','Mobile', 'trim|required');
        //$this->form_validation->set_rules('gender','Gender', 'trim|required');
        $this->form_validation->run();
        $error = $this->form_validation->get_all_errors();

        if ($error) {
            return_data(false, array_values($error)[0], array(), $error);
        }
    }

    //XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<--  UPDATE USER DETAILS BLOCK END HERE  -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX     
    //XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<--  GET EMPLOYEE LIST BLOCK START HERE  -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
    public function get_employee_list()
    {
        $this->validate_get_employee_list();
        $page_no = $this->input->post('page_no');
        $limit = $this->input->post('limit');
        $result = $this->users_model->get_employee_list(array('page_no' => $page_no, 'limit' => $limit));
        if ($result) {
            return_data(true, 'Employee List', $result);
        } else {
            return_data(false, 'Something Went Wrong.', array());
        }
    }

    private function validate_get_employee_list()
    {
        $this->form_validation->set_rules('page_no', 'page_no', 'trim|required');
        $this->form_validation->set_rules('limit', 'limit', 'trim|required');
        if (isset($_POST['page_no']) && $_POST['page_no'] == '0') {
            return_data(false, 'Page no should be start from 1.', array());
        }
        $this->form_validation->run();
        $error = $this->form_validation->get_all_errors();

        if ($error) {
            return_data(false, array_values($error)[0], array(), $error);
        }
    }

    //XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<--  GET EMPLOYEE LIST BLOCK END HERE  -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX 


}
