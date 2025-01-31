<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('form_validation', 'uploads');
        $this->load->helper("template");
    }

    private function random_strings($length_of_string) {
        // String of all alphanumeric character 
//        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $str_result = '0123456789';
        return substr(str_shuffle($str_result), 0, $length_of_string);
    }

    public function index() {
        $error['error'] = "";
        if ($this->session->userdata('active_backend_user_flag') && $this->session->userdata('active_backend_user_flag')) {         
            redirect(base_url(INDEX_PHP.'admin-panel/dashboard'));
            die;
        }
        $captcha = $_SESSION['captcha'] ?? "";
        $_SESSION['captcha'] = $this->random_strings(6);
        if ($this->input->post()) {
            $this->form_validation->set_error_delimiters(' ', ' ');
            $this->form_validation->set_rules('password', 'Password', 'required|trim');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');

            if ($this->form_validation->run() == FALSE) {
                
            }
            if ($captcha != $this->input->post("captcha")) {
                $error['error'] = "Invalid Captcha !!";
            } else {
                $this->db->Where("email", $this->input->post('email'));
                $this->db->Where("password", md5($this->input->post('password')));
//                $this->db->Where("status", '0');
                $result = $this->db->get('backend_user')->row();
                //print_r($result);die;
                if (!empty($result) && $result->status == 0) {
                    /*
                     * setting session according to auth_panle_ini file in controller master file of panel
                     */
                    $is_verfied = 0; //for enable otp verification on admin panel please change $is_verified=0; ....
                    $remote_ip = $_SERVER['REMOTE_ADDR'] ?? "";
                    $user_agent = $_SERVER['HTTP_USER_AGENT'] ?? "";
                    if ($result->ip_address == $remote_ip && $result->user_agent == $user_agent)
                        $is_verfied = 1;

                    unset($result->user_agent, $result->ip_address);
                    $newdata = array(
                        'active_backend_user_flag' => True,
                        'active_backend_user_id' => $result->id,
                        'active_user_data' => $result,
                        'active_user_verified' => $is_verfied
                    );
                    /*                     * ***** Check For Instructor User ****** */
                    backend_log_genration($result->id, 'Logged In', 'LOGIN');
                    if ($result->status == 0) {
                        $this->session->set_userdata($newdata);
                        unset($_SESSION['captcha']);
//                        redirect(site_url('auth_panel/admin/index'));
//                        redirect(site_url('auth_panel/admin/otp_authentication'));
                        redirect(base_url(INDEX_PHP.'admin-panel/otp-authentication'));
                        die;
                    }
                    /*                     * *****  Check For Instructor User Ends ****** */
                } elseif (!empty($result) && $result->status == 1) {
                    $error['error'] = "Blocked Account !! Please contact the admin.";
                } elseif (empty($result) && $this->input->post('email') != '' && $this->input->post('password') != '') {
                    $error['error'] = "Invalid Credentials !!";
                }
            }
        }
        $this->load->view('login/login', $error);
    }

    public function logout() {
        $this->session->sess_destroy();
//        redirect(site_url('auth_panel/login/index'));
        redirect(base_url(INDEX_PHP.'admin-panel'));
    }

    public function forget_password_old() {
        //echo "<pre>";print_r($_POST);die;

        if (!isset($_POST['post_type'])) {

            if ($_POST['email'] == '') {
                echo json_encode(array('status' => false, 'message' => 'Please enter email address.'));
                die;
            }
            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                echo json_encode(array('status' => false, 'message' => 'Please enter valide email address.'));
                die;
            }
            $this->db->Where("email", $_POST['email']);
            $result = $this->db->get('backend_user')->row();
            if (empty($result)) {
                echo json_encode(array('status' => false, 'message' => 'Email address does not exist.'));
                die;
            } else {
                $tokken = rand(1000, 999999);
                /* ####### Update tokken of backend user ########### */
                $this->db->where('email', $_POST['email'])
                        ->update('backend_user', array('tokken' => $tokken));
                $input = array(
                    "SENDER" => "donotreply@emedicoz.com",
                    "RECIPIENT" => $_POST['email'],
                    "SUBJECT" => "Drishti! Otp for change password!",
                    "HTMLBODY" => "Hello! </br> We have received a request to recover the password to your dashboard .</br>
												So we generated a OTP for your request .</br>
												Your OTP for change password is  $tokken </br></br>
												If you did not request to recover your password, please disregard this message, and no changes will be made to your current sign-in details.</br></br>
Sincerely,</br>
<bold>Your drishti Team</bold>",
                    "TEXTBODY" => "Your tokken for change password is  $tokken"
                );
                $this->aws_emailer->send_aws_email($input);

                echo json_encode(array('status' => true, 'post_type' => '', 'message' => 'OTP Has been sent on your email and mobile number'));
                die;
            }
        } else {
            if ($_POST['tokken'] == '') {
                echo json_encode(array('status' => false, 'message' => 'Please enter tokken.'));
                die;
            }
            if ($_POST['new_pwd'] == '') {
                echo json_encode(array('status' => false, 'message' => 'Please enter new password.'));
                die;
            }
            if ($_POST['cnf_pwd'] == '') {
                echo json_encode(array('status' => false, 'message' => 'Please enter confirm password.'));
                die;
            }
            if ($_POST['new_pwd'] != $_POST['cnf_pwd']) {
                echo json_encode(array('status' => false, 'message' => 'Password does not match.'));
                die;
            }

            $result = $this->db->where('email', $_POST['email'])
                    ->where('tokken', $_POST['tokken'])
                    ->update('backend_user', array('password' => md5($_POST['new_pwd']), 'tokken' => ''));
            if ($this->db->affected_rows()) {
                echo json_encode(array('status' => true, 'post_type' => $_POST['post_type'], 'message' => 'Password change successfully please <a href="">Click here to login</a>.'));
                die;
            } else {
                echo json_encode(array('status' => false, 'message' => 'Tokken does not correct'));
                die;
            }
        }
    }

    public function forget_password() {
        //echo "<pre>";print_r($_POST);die;

        if (!isset($_POST['post_type'])) {

            if ($_POST['email'] == '') {
                echo json_encode(array('status' => false, 'message' => 'Please enter email address.'));
                die;
            }
            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                echo json_encode(array('status' => false, 'message' => 'Please enter valide email address.'));
                die;
            }
            $this->db->Where("email", $_POST['email']);
            $result = $this->db->get('backend_user')->row();
            if (empty($result)) {
                echo json_encode(array('status' => false, 'message' => 'Email address does not exist.'));
                die;
            } else {
                $tokken = rand(1000, 999999);
                $to = $this->input->post('email');
                $subject = "Sanskar! Otp for change password!";
//                $message = "Your tokken for change password is  $tokken";

                $message = "Hello! 
                We have received a request to recover the password to your dashboard .
                So we generated a OTP for your request .
                Your OTP for change password is  $tokken 
                If you did not request to recover your password, please disregard this message, and no changes will be made to your current sign-in details.
                Sincerely,
                Your Sanskar Team
                Your tokken for change password is  $tokken";
                /* ####### Update tokken of backend user ########### */
                $this->db->where('email', $_POST['email'])
                        ->update('backend_user', array('tokken' => $tokken));
                $this->email->from('info@totalbhakti.com', 'TOTAL BHAKTI');
                $this->email->to($to);
                $this->email->subject($subject);
                $this->email->message($message);
                $this->email->set_mailtype("text");
                $this->email->send();
                echo json_encode(array('status' => true, 'post_type' => '', 'message' => 'OTP Has been sent on your email number'));
                die;
            }
        } else {
            if ($_POST['tokken'] == '') {
                echo json_encode(array('status' => false, 'message' => 'Please enter tokken.'));
                die;
            }
            if ($_POST['new_pwd'] == '') {
                echo json_encode(array('status' => false, 'message' => 'Please enter new password.'));
                die;
            }
            if ($_POST['cnf_pwd'] == '') {
                echo json_encode(array('status' => false, 'message' => 'Please enter confirm password.'));
                die;
            }
            if ($_POST['new_pwd'] != $_POST['cnf_pwd']) {
                echo json_encode(array('status' => false, 'message' => 'Password does not match.'));
                die;
            }

            $result = $this->db->where('email', $_POST['email'])
                    ->where('tokken', $_POST['tokken'])
                    ->update('backend_user', array('password' => md5($_POST['new_pwd']), 'tokken' => ''));
            if ($this->db->affected_rows()) {
                echo json_encode(array('status' => true, 'post_type' => $_POST['post_type'], 'message' => 'Password change successfully please <a href="">Click here to login</a>.'));
                die;
            } else {
                echo json_encode(array('status' => false, 'message' => 'Tokken does not correct'));
                die;
            }
        }
    }

}
