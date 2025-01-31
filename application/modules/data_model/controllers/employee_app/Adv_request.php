<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Adv_request extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('adv_request_model');
        $this->load->helper("services");
        $this->load->library('session');
        $this->load->library('email');
        $this->load->helper("jwt_validater");
    }
//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<-- Advance request  -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
   public function advance_req_form(){
        $this->validate_adv_Request();
        $RepaymentDuration = $this->input->post('RepaymentDuration');
        $RequestedAmount = $this->input->post('RequestedAmount');
        $EmpCode = $this->input->post('EmpCode');
        $Reason = $this->input->post('Reason');
        $result = $this->adv_request_model->adv_request($RepaymentDuration,$RequestedAmount,$Reason,$EmpCode); 
       
        if($result)
        {   
            $data = $this->adv_request_model->fetch_all_data($EmpCode,'TR','AdvanceRequest');
            $this->send_email($data,$RepaymentDuration,$RequestedAmount,$Reason,$EmpCode,'advance');

        }
        else{
            echo"Request Not Submitted";
        }
    }
        private function validate_adv_Request() {
             $this->form_validation->set_rules('RepaymentDuration', 'RepaymentDuration', 'trim|required');
             $this->form_validation->set_rules('RequestedAmount', 'RequestedAmount', 'trim|required');
             $this->form_validation->set_rules('Reason','Reason', 'trim|required');
             $this->form_validation->set_rules('EmpCode','EmpCode', 'trim|required');
             $this->form_validation->run();
            $error = $this->form_validation->get_all_errors();
            if ($error) {
                return_data(false, array_values($error)[0], array(), $error);
            }
        }

//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<-- pay slip  -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
    public function pay_slip_request(){
        //create_log_file(array("url" => "api_panel/pay_slip_request", "request b" => $_POST, "api" => "pay_slip_request"));
        $this->validate_pay_slip_request();
        $EmpRemarks = $this->input->post('EmpRemarks');
        $MonthFrom = $this->input->post('MonthFrom');
        $MonthTo = $this->input->post('MonthTo');
        $EmpCode = $this->input->post('EmpCode');
        $frm_year = $this->input->post('frm_year');
        $to_year = $this->input->post('to_year');
        $from = $MonthFrom."-".$frm_year;
        $to = $MonthTo."-".$to_year;
        $result = $this->adv_request_model->pay_slip_request($EmpRemarks,$MonthFrom,$MonthTo,$EmpCode,$frm_year,$to_year); 
        if($result)
        {
             $data = $this->adv_request_model->fetch_all_data($EmpCode,'TR','PaySlipRequest');
             $this->send_email($data,$EmpRemarks,$from,$to,$EmpCode,'slip');
            echo"Request Submitted";
        }
        else{
            echo"Request Not Submitted";
        }
    }
        private function validate_pay_slip_request() {
             $this->form_validation->set_rules('EmpRemarks', 'EmpRemarks', 'trim|required');
             $this->form_validation->set_rules('MonthFrom', 'MonthFrom', 'trim|required');
             $this->form_validation->set_rules('MonthTo','MonthTo', 'trim|required');
             $this->form_validation->set_rules('EmpCode','EmpCode', 'trim|required');
             $this->form_validation->set_rules('frm_year','frm_year', 'trim|required');
             $this->form_validation->set_rules('to_year','to year', 'trim|required');
             $this->form_validation->run();
            $error = $this->form_validation->get_all_errors();
            if ($error) {
                return_data(false, array_values($error)[0], array(), $error);
            }
        }

        //XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<--  request type-->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
    public function other_request(){
        $this->validate_other_request();
        $RequestType = $this->input->post('RequestType');
        if($RequestType){   
            $EmpCode = $this->input->post('EmpCode');
            $reason = $this->input->post('reason');
              if($RequestType =='Others'){             
                  $others = $this->input->post('others');
                  $result = $this->adv_request_model->request_type_other($EmpCode,$RequestType,$reason,$others);      
              }else{
                $result = $this->adv_request_model->other_request($EmpCode,$RequestType,$reason); 
              }
         }     
        else{
            echo"Request Not Submitted";
        }
    }
        private function validate_other_request() {
               post_check();
               if ($this->input->post('RequestType') == 'Others') {
                     $this->form_validation->set_rules('others', 'others', 'trim|required');      
                     $this->form_validation->set_rules('RequestType','RequestType', 'trim|required');
                     $this->form_validation->set_rules('EmpCode','EmpCode', 'trim|required');
                     $this->form_validation->set_rules('reason','reason', 'trim|required');
                } else {
                     $this->form_validation->set_rules('RequestType','RequestType', 'trim|required');
                     $this->form_validation->set_rules('EmpCode','EmpCode', 'trim|required');
                     $this->form_validation->set_rules('reason','reason', 'trim|required'); 
                }
                 $this->form_validation->run();
                $error = $this->form_validation->get_all_errors();
                if ($error) {
                    return_data(false, array_values($error)[0], array(), $error);
                }
        }
     //XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<-- work from home -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
    public function work_from_home_request(){
        $this->validate_work_from_home_request();
        $from_date = $this->input->post('from_date');
        $to_date = $this->input->post('to_date');
        $EmpCode = $this->input->post('EmpCode');
        $reason = $this->input->post('reason');
        $data = $this->adv_request_model->fetch_all_data($EmpCode,'WFH','WorkFromHome');
        $result = $this->adv_request_model->work_from_home_request($data,$from_date,$to_date,$EmpCode,$reason); 
        if($result)
        {
             $this->send_email_work_from_home($data,$from_date,$to_date,$reason,$EmpCode);
        }
        else{
            echo"work_from_home_request not successfully";
        }
    }
        private function validate_work_from_home_request() {
             post_check();            
             $this->form_validation->set_rules('from_date','from_date', 'trim|required');
             $this->form_validation->set_rules('EmpCode','EmpCode', 'trim|required');
             $this->form_validation->set_rules('to_date','to_date', 'trim|required');
             $this->form_validation->set_rules('reason','reason', 'trim|required'); 
             $this->form_validation->run();
            $error = $this->form_validation->get_all_errors();
            if ($error) {
                return_data(false, array_values($error)[0], array(), $error);
            }
        }

  //XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<-- work from home Attendence -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
 public function update_in_out_time() {
        $this->validate_update_in_out_time();
        $EmpCode = $this->input->post('EmpCode');
        $data = $this->adv_request_model->fetch_all_data($EmpCode,'WFHA','WorkFromHomeAttendence');
        if (isset($_POST['In_time']) && !empty($_POST['In_time'])) {
            $in_time = $this->adv_request_model->update_in_time($EmpCode,$data);
        } else {
            $out_time = $this->adv_request_model->update_out_time($EmpCode,$data);
        }
    }

    private function validate_update_in_out_time() {
        $this->form_validation->set_rules('EmpCode', 'Employee Code', 'trim|required');
          
             if (!array_key_exists('In_time', $_POST)) {
            $this->form_validation->set_rules('In_time', 'In_time', 'trim|required');
            }
        if (array_key_exists('In_time', $_POST) && array_key_exists('Out_time', $_POST)) {
            return_data(false, 'Can not update in and out at same t
                ime.', array());
        }
        $this->form_validation->run();
        $error = $this->form_validation->get_all_errors();
        if ($error) {
            return_data(false, array_values($error)[0], array(), $error);
        }
    }

 //XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<--send_email-->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
          public function send_email($data,$RepaymentDuration,$RequestedAmount,$Reason,$EmpCode,$where) {
               //pre($where);die;
           // return_data(true, 'Tour inserted....', array()); 
                $PImg = $data['PImg'];
                $Dept = $data['Dept'];
                $Name = $data['Name'];
                $EmailID =$data['EmailID'];
                $year=date("Y");
                $AppDate = date("Y/m/d");
                $complete_id = $data['complete_id'];
                require_once getcwd().'/phpmailerclass/phpmailerclass/class.phpmailer.php';
                      
        $to_email='rahulks7739@gmail.com';
        if($where=='slip'){      
                                 $subject = " Request Pay Slip";
                                 $message = "<html><body><table cellpadding='20' style='width:30%;border-width:5px;border-style:double;'><tbody  bgcolor='#a40402'><tr><td><table><tr><td style='min-width:300px'><img src='https://employee.sanskargroup.in/images/newlogo.png'></td><td><img src='https://employee.sanskargroup.in/EmpImage/".$PImg."' width=100px height=100px></td></tr></table><table><tbody><tr><td style='padding-bottom:20px;'><font color = #ffffff size=5>Request for Pay Slip  </font></td></tr></tbody></table><table><tbody><tr><td style='color:#fff;padding-bottom:10px;'><b><font color=#f6a037> Employee Name  -  </font></b><font color=#fff>" .$Name." </font></td></tr></tbody></table><table><tbody><tr><td style='color:#fff;padding-bottom:10px;'><b><font color=#f6a037> Employee Code - </font></b><font color=#fff>" .$EmpCode. "</font></td></tr></tbody></table><table><tbody><tr><td style='color:#fff;padding-bottom:10px;'><b><font color=#f6a037> From : </font></b><font color=#fff>" .$RequestedAmount."</font></td></tr></tbody></table><table><tbody><tr><td style='color:#fff;padding-bottom:10px;'><b><font color=#f6a037> To  : </font></b>" .$Reason."</td></tr></tbody></table><table><tbody><tr><td style='color:#fff;padding-bottom:10px;'><b><font color=#f6a037> EmpRemarks - </font></b><font color=#fff>" .$RepaymentDuration. "</font></td></tr></tbody></table><table><tbody><tr><td style='color:#fff;padding-bottom:20px;padding-top:20px;'><font color=#fff><a style='background:#f6a037;padding:5px 10px; border-radius:5px; margin-top:10px;color:#fff;font-weight:bold;text-decoration:none;position: relative;top:15px;' href='http://employee.sanskargroup.in'>Action </a></font></td></tr></tbody></table></td></tr></tbody></table></body></html>";

        }else{
                $subject = " For Advance Request";
                    $message = "<html><body><table cellpadding='20' style='width:30%;border-width:5px;border-style:double;'><tbody  bgcolor='#a40402'><tr><td><table><tr><td style='min-width:300px'><img src='https://employee.sanskargroup.in/images/newlogo.png'></td><td><img src='https://employee.sanskargroup.in/EmpImage/".$PImg."' width=100px height=100px></td></tr></table><table><tbody><tr><td style='padding-bottom:20px;'><font color = #ffffff size=5>Request for Advance  </font></td></tr></tbody></table><table><tbody><tr><td style='color:#fff;padding-bottom:10px;'><b><font color=#f6a037> Employee Name  -  </font></b><font color=#fff>" .$Name." </font></td></tr></tbody></table><table><tbody><tr><td style='color:#fff;padding-bottom:10px;'><b><font color=#f6a037> Employee Code - </font></b><font color=#fff>" .$EmpCode. "</font></td></tr></tbody></table><table><tbody><tr><td style='color:#fff;padding-bottom:10px;'><b><font color=#f6a037> Request Amount - </font></b><font color=#fff>" .$RequestedAmount."</font></td></tr></tbody></table><table><tbody><tr><td style='color:#fff;padding-bottom:10px;'><b><font color=#f6a037> Duration  : </font></b>" .$RepaymentDuration."</td></tr></tbody></table><table><tbody><tr><td style='color:#fff;padding-bottom:10px;'><b><font color=#f6a037> Reason - </font></b><font color=#fff>" .$Reason. "</font></td></tr></tbody></table><table><tbody><tr><td style='color:#fff;padding-bottom:20px;padding-top:20px;'><font color=#fff><a style='background:#f6a037;padding:5px 10px; border-radius:5px; margin-top:10px;color:#fff;font-weight:bold;text-decoration:none;position: relative;top:15px;' href='http://employee.sanskargroup.in'>Action </a></font></td></tr></tbody></table></td></tr></tbody></table></body></html>";
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
        $this->email->cc('rockytufan7740@gmail.com');
        //$this->email->bcc('them@their-example.com');
        $this->email->subject($subject);
        $this->email->message($message);
        $success = $this->email->send();
        if($success){
             return_data(true, 'Request Sent', array()); 
        }
           
    }

//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<--send_email for Work from home -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
          public function send_email_work_from_home($data,$from_date,$to_date,$reason,$EmpCode) {
               //pre($data);die;

                $PImg = $data['PImg'];
                $Dept = $data['Dept'];
                $Name = $data['Name'];
                $EmailID =$data['EmailID'];
                $year=date("Y");
                $AppDate = date("Y/m/d");
                $complete_id = $data['complete_id'];
                require_once getcwd().'/phpmailerclass/phpmailerclass/class.phpmailer.php';
                      
                $to_email='rockytufan7740@gmail.com';
                    $subject = " For Advance Request";
                    $message = "<html><body><table cellpadding='20' style='width:30%;border-width:5px;border-style:double;'><tbody  bgcolor='#a40402'><tr><td><table><tr><td style='min-width:300px'><img src='https://employee.sanskargroup.in/images/newlogo.png'></td><td><img src='https://employee.sanskargroup.in/EmpImage/".$PImg."' width=100px height=100px></td></tr></table><table><tbody><tr><td style='padding-bottom:20px;'><font color = #ffffff size=5>Request for Advance  </font></td></tr></tbody></table><table><tbody><tr><td style='color:#fff;padding-bottom:10px;'><b><font color=#f6a037> Employee Name  -  </font></b><font color=#fff>" .$Name." </font></td></tr></tbody></table><table><tbody><tr><td style='color:#fff;padding-bottom:10px;'><b><font color=#f6a037> Employee Code - </font></b><font color=#fff>" .$EmpCode. "</font></td></tr></tbody></table><table><tbody><tr><td style='color:#fff;padding-bottom:10px;'><b><font color=#f6a037>From Date- </font></b><font color=#fff>" .$from_date."</font></td></tr></tbody></table><table><tbody><tr><td style='color:#fff;padding-bottom:10px;'><b><font color=#f6a037> To Date  : </font></b>" .$to_date."</td></tr></tbody></table><table><tbody><tr><td style='color:#fff;padding-bottom:10px;'><b><font color=#f6a037> Reason - </font></b><font color=#fff>" .$reason. "</font></td></tr></tbody></table><table><tbody><tr><td style='color:#fff;padding-bottom:20px;padding-top:20px;'><font color=#fff><a style='background:#f6a037;padding:5px 10px; border-radius:5px; margin-top:10px;color:#fff;font-weight:bold;text-decoration:none;position: relative;top:15px;' href='http://employee.sanskargroup.in'>Action </a></font></td></tr></tbody></table></td></tr></tbody></table></body></html>";
                

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
       // pre($mail_config); die;
        $this->load->library('email',$mail_config);
        $this->email->set_mailtype("html");
        $this->email->from($EmailID, 'Sanskar Music');
        $this->email->to($to_email);
        $this->email->cc('rahulks7739@gmail.com');
        //$this->email->bcc('them@their-example.com');
        $this->email->subject($subject);
        $this->email->message($message);
        $success = $this->email->send();
        if($success){
             return_data(true, 'Request Send....', array()); 
        }
           
    }


}