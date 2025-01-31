<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Emp_leave extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('emp_leave_model');
        $this->load->helper("services");
        $this->load->library('session');
        $this->load->helper("message_sender");
    }

 

     public function leave_request() {
        //create_log_file(array("url" => "User/login_authentication", "request" => $_POST, "api" => "login_authentication"));
       $this->validate_full_day_leave();
      $leave_type = $this->input->post('leave_type');
        if($leave_type){
            $EmpCode = $this->input->post('EmpCode');

            $leave_res = $this->input->post('leave_res');
            $from_date = $this->input->post('from_date');
            $to_date = $this->input->post('to_date');
            if($leave_type =='half'){
               $data = $this->emp_leave_model->fetch_all_data($EmpCode,'HF','HalfDayLeave'); 
              $day_type = $this->input->post('day_type');
              $result = $this->emp_leave_model->half_day_leave($leave_res,$from_date,$to_date,$day_type,$EmpCode);

              if($result){
                 $this->send_email($data,$from_date,$leave_res,$EmpCode,$day_type,$leave_type);
              }  
            }else{
            $data = $this->emp_leave_model->fetch_all_data($EmpCode,'SANS','ITDLeaveRequest');
            $to_date = $this->input->post('to_date');
            $day_type = $this->input->post('day_type');
            $result = $this->emp_leave_model->full_day_leave($leave_res,$from_date,$to_date,$day_type,$EmpCode);
               if($result){
                 $this->send_email($data,$from_date,$leave_res,$EmpCode,$to_date,$leave_type);
                }  
           }  
              
        }
        else {
            return_data(false, 'Something Went Wrong.', array());
        }
    }



    private function validate_full_day_leave() {
          post_check();
        $this->form_validation->set_rules('leave_type', 'leave_type', 'trim|required');
        
       if ($this->input->post('leave_type') == 'half'  ) {
           $this->form_validation->set_rules('day_type', 'day_type', 'trim|required');
           $this->form_validation->set_rules('to_date', 'to_date', 'trim|required'); 
           $this->form_validation->set_rules('from_date', 'from_date', 'trim|required');

        } else {
          $this->form_validation->set_rules('from_date', 'from_date', 'trim|required');
         $this->form_validation->set_rules('to_date', 'to_date', 'trim|required'); 
         $this->form_validation->set_rules('day_type', 'day_type', 'trim|required');
        }
        $this->form_validation->run();
        $error = $this->form_validation->get_all_errors();
        if ($error) {
            return_data(false, array_values($error)[0], array(), $error);
        }
    }
//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<-- OffDay START HERE  -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
  public function offday_Request(){
          $this->validate_offday_Request();
        $Date1 = $this->input->post('Date1');
       // pre($Date1);die;
        $Requirement = $this->input->post('Requirement');
        $EmpCode = $this->input->post('EmpCode');
      
        $result = $this->emp_leave_model->off_day_request($Date1,$Requirement,$EmpCode); 
        if($result)
        {
            // send_email12("hello","mail","pankajjaisawal95@gmail.com","rahulks7739@gmail.com","","");
            echo"Request Submitted";
        }
        else{
            echo"Request Not Submitted";
        }
    }
        private function validate_offday_Request() {
            $this->form_validation->set_rules('Date1', 'Date1', 'trim|required');
            $this->form_validation->set_rules('Requirement', 'Requirement', 'trim|required');
             $this->form_validation->set_rules('EmpCode','EmpCode', 'trim|required');
            $this->form_validation->run();
            $error = $this->form_validation->get_all_errors();
            if ($error) {
                return_data(false, array_values($error)[0], array(), $error);
            }
        }

 public function send_email($data,$Date1,$leave_res,$EmpCode,$day_type,$leave_type) {

                $PImg = $data['PImg'];
                $Dept = $data['Dept'];
                $Name = $data['Name'];
                $EmailID =$data['EmailID'];
                $year=date("Y");
                $AppDate = date("Y/m/d");
                $complete_id = $data['complete_id'];
                require_once getcwd().'/phpmailerclass/phpmailerclass/class.phpmailer.php';
                       $subject = "Leave Request";
        $to_email='rahulks7739@gmail.com';
        if($leave_type=='half'){
             $message = "<html><body><table cellpadding='20' style='width:30%;border-width:5px;border-style:double;'><tbody  bgcolor='#a40402'><tr><td><table><tr><td style='min-width:300px'><img src='https://employee.sanskargroup.in/images/newlogo.png'></td><td><img src='https://employee.sanskargroup.in/EmpImage/".$PImg."' width=100px height=100px></td></tr></table><table><tbody><tr><td style='padding-bottom:20px;'><font color = #ffffff size=5>Halfday Leave Request </font></td></tr></tbody></table><table><tbody><tr><td style='color:#fff;padding-bottom:10px;'><b><font color=#f6a037> Leave Request Of -  </font></b><font color=#fff>" .$Name." </font></td></tr></tbody></table><table><tbody><tr><td style='color:#fff;padding-bottom:10px;'><b><font color=#f6a037> Employee Code - </font></b><font color=#fff>" .$EmpCode. "</font></td></tr></tbody></table><table><tbody><tr><td style='color:#fff;padding-bottom:10px;'><b><font color=#f6a037> Request ID - </font></b><font color=#fff>" .$complete_id."</font></td></tr></tbody></table><table><tbody><tr><td style='color:#fff;padding-bottom:10px;'><b><font color=#f6a037>Leave Date : </font></b>" .$Date1."</td></tr></tbody></table><table><tbody><tr><td style='color:#fff;padding-bottom:10px;'><b><font color=#f6a037> Ression - </font></b><font color=#fff>" .$leave_res. "</font></td></tr> </tbody></table>
            <table><tbody><tr><td style='color:#fff;padding-bottom:10px;'><b><font color=#f6a037> Sift - </font></b><font color=#fff>" .$day_type. "</font></td></tr>
            </tbody></table>
            <table><tbody><tr><td style='color:#fff;padding-bottom:20px;padding-top:20px;'><font color=#fff><a style='background:#f6a037;padding:5px 10px; border-radius:5px; margin-top:10px;color:#fff;font-weight:bold;text-decoration:none;position: relative;top:15px;' href='http://employee.sanskargroup.in'>Action </a></font></td></tr></tbody></table></td></tr></tbody></table></body></html>";

        }else{
             $message = "<html><body><table cellpadding='20' style='width:30%;border-width:5px;border-style:double;'><tbody  bgcolor='#a40402'><tr><td><table><tr><td style='min-width:300px'><img src='https://employee.sanskargroup.in/images/newlogo.png'></td><td><img src='https://employee.sanskargroup.in/EmpImage/".$PImg."' width=100px height=100px></td></tr></table><table><tbody><tr><td style='padding-bottom:20px;'><font color = #ffffff size=5>Halfday Leave Request </font></td></tr></tbody></table><table><tbody><tr><td style='color:#fff;padding-bottom:10px;'><b><font color=#f6a037> Leave Request Of -  </font></b><font color=#fff>" .$Name." </font></td></tr></tbody></table><table><tbody><tr><td style='color:#fff;padding-bottom:10px;'><b><font color=#f6a037> Employee Code - </font></b><font color=#fff>" .$EmpCode. "</font></td></tr></tbody></table><table><tbody><tr><td style='color:#fff;padding-bottom:10px;'><b><font color=#f6a037> Request ID - </font></b><font color=#fff>" .$complete_id."</font></td></tr></tbody></table><table><tbody><tr><td style='color:#fff;padding-bottom:10px;'><b><font color=#f6a037>Leave Date : </font></b>" .$Date1." <b><font color=#f6a037>To </font></b>" .$day_type."</td></tr></tbody></table><table><tbody><tr><td style='color:#fff;padding-bottom:10px;'><b><font color=#f6a037> Ression - </font></b><font color=#fff>" .$leave_res. "</font></td></tr> </tbody></table>
            <table><tbody><tr><td style='color:#fff;padding-bottom:10px;'></font></td></tr>
            </tbody></table>
            <table><tbody><tr><td style='color:#fff;padding-bottom:20px;padding-top:20px;'><font color=#fff><a style='background:#f6a037;padding:5px 10px; border-radius:5px; margin-top:10px;color:#fff;font-weight:bold;text-decoration:none;position: relative;top:15px;' href='http://employee.sanskargroup.in'>Action </a></font></td></tr></tbody></table></td></tr></tbody></table></body></html>";

        }
       
        $mail_config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'mail.sanskargroup.in',
            'smtp_port' => 465,
            'smtp_user' => 'music@sanskargroup.in',
            'smtp_pass' => 'P@ssw0rd',
            'mailtype'  => 'html', 
            'charset' => 'utf-8',
            'validate' => true
        );
        //pre($config); die;
         $this->load->library('email',$mail_config);
        $this->email->set_mailtype("html");
        $this->email->from($EmailID, 'Sanskar Music');
        $this->email->to($to_email);
        $this->email->cc('pankajjaisawal95@gmail.com');
        //$this->email->bcc('them@their-example.com');
        $this->email->subject($subject);
        $this->email->message($message);
        $success = $this->email->send();
        if($success){
             return_data(true, 'Request Sent.', array()); 
        }
           
    }


//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<-- NF/FH Request -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
  public function nf_nh_Request(){
          $this->validate_nf_nh_Request();
        $Requirement = $this->input->post('Requirement');
        $EmpCode = $this->input->post('EmpCode');
        $fs_day = $this->input->post('fs_day');
        $Date1 = $this->input->post('Date1');
        $data = $this->emp_leave_model->fetch_all_data($EmpCode,'NFNH','NHFHDetail');
        $result = $this->emp_leave_model->nf_nh_Request($Date1,$Requirement,$EmpCode,$fs_day,$data); 
        if($result)
        {
            echo"Request Submitted";
        }
        else{
            echo"Request Not Submitted";
        }
    }
        private function validate_nf_nh_Request() {
            $this->form_validation->set_rules('Requirement', 'Requirement', 'trim|required');
             $this->form_validation->set_rules('EmpCode','EmpCode', 'trim|required');
            $this->form_validation->run();
            $error = $this->form_validation->get_all_errors();
            if ($error) {
                return_data(false, array_values($error)[0], array(), $error);
            }
        }

//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<-- leave cancellation  -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX

     public function leave_cancellation() {
        //create_log_file(array("url" => "User/login_authentication", "request" => $_POST, "api" => "login_authentication"));
        $this->validate_leave_cancellation();
        $leave_type = $this->input->post('leave_type');
        if($leave_type){
              $EmpCode = $this->input->post('EmpCode');
              $RequestId = $this->input->post('RequestId');
              $result = $this->emp_leave_model->leave_cancellation($EmpCode,$RequestId,$leave_type);
              if($result){
                 echo"Request Submitted";
              }     
        }
        else {
            return_data(false, 'Something Went Wrong.', array());
        }
    }
    private function validate_leave_cancellation() {
        post_check();
        $this->form_validation->set_rules('leave_type', 'leave_type', 'trim|required');
        //$this->form_validation->set_rules('RequestId', 'RequestId', 'trim|required');
        $this->form_validation->set_rules('EmpCode', 'EmpCode', 'trim|required');
        $this->form_validation->run();
        $error = $this->form_validation->get_all_errors();
        if ($error) {
            return_data(false, array_values($error)[0], array(), $error);
        }
    }
//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<--fetch  leave cancellation  -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX

     public function fetch_leave_cancellation() {
        //create_log_file(array("url" => "User/login_authentication", "request" => $_POST, "api" => "login_authentication"));
        $this->validate_fetch_leave_cancellation();
        $leave_type = $this->input->post('leave_type');
        if($leave_type){
              $EmpCode = $this->input->post('EmpCode');
              
              //$RequestId = $this->input->post('RequestId');
              $result = $this->emp_leave_model->fetch_leave_cancellation($EmpCode,$leave_type);
              if($result){
                 echo"Request Submitted";
              }     
        }
        else {
            return_data(false, 'Something Went Wrong.', array());
        }
    }
    private function validate_fetch_leave_cancellation() {
        post_check();
        $this->form_validation->set_rules('leave_type', 'leave_type', 'trim|required');
        //$this->form_validation->set_rules('RequestId', 'RequestId', 'trim|required');
        $this->form_validation->set_rules('EmpCode', 'EmpCode', 'trim|required');
        $this->form_validation->run();
        $error = $this->form_validation->get_all_errors();
        if ($error) {
            return_data(false, array_values($error)[0], array(), $error);
        }
    }

//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<--get  leave list for Hr -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX

       public function get_leave_requestList() {
        //create_log_file(array("url" => "User/login_authentication", "request" => $_POST, "api" => "login_authentication"));
             $this->validate_get_leave_cancellation();
             $EmpCode = $this->input->post('EmpCode');
             $leave_type = $this->input->post('leave_type');
               if($leave_type =='half'){
                   $result= $this->emp_leave_model->get_half_day_leave_request_list($EmpCode);
               } else {
                  $result= $this->emp_leave_model->get_full_day_leave_request_list($EmpCode);
               }
       }
    
    private function validate_get_leave_cancellation() {
        post_check();
        $this->form_validation->set_rules('EmpCode', 'EmpCode', 'trim|required');
        $this->form_validation->set_rules('leave_type', 'leave_type', 'trim|required');
        $this->form_validation->run();
        $error = $this->form_validation->get_all_errors();
        if ($error) {
            return_data(false, array_values($error)[0], array(), $error);
        }
    }

}
