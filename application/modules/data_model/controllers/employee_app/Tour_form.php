<?php

 defined('BASEPATH') OR exit('No direct script access allowed');
 class  Tour_form extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('tour_form_model');
        $this->load->helper("services");
         $this->load->library('session');
         $this->load->library('email');
         $this->load->helper("jwt_validater");
     }
    

 //XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX<<-- Tour_Request form -->>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX

       public function tour_Request(){
        $this->validate_Tour_Request();
        $Date1 = $this->input->post('Date1');
        $Date2 = $this->input->post('Date2');
        $Requirement = $this->input->post('Requirement');
        $Remarks = $this->input->post('Remarks');
        $Location = $this->input->post('Location');
        $EmpCode = $this->input->post('EmpCode');
      
        //$MailTo = "sadhna.pal@sanskargroup.in"
        //$MailCC = "Txt Mail";
        //$message = "hello";
       // $InsertQuery = "INSERT INTO TourFormTbl (Date1,Date2,Requirement,Remarks,Location,EmpCode)VALUES('$Date1','$Date1','$Requirement','$Remarks','$Location','$EmpCode')";
       // $result =sqlsrv_query($this->conn_1, $InsertQuery);
         $data = $this->tour_form_model->fetch_all_data($EmpCode,'TR');
         $result = $this->tour_form_model->tour_request($Date1,$Date2,$Requirement,$Remarks,$Location,$EmpCode);
        if($result)
        {
            $this->send_email($data,$Date1,$Date2,$Location,$EmpCode);
            echo"register successfully";
        }
        else{
            echo"Tour_Request not register";
        }
    }
        private function validate_Tour_Request() {
            $this->form_validation->set_rules('Date1', 'Date1', 'trim|required');
            $this->form_validation->set_rules('Date2', 'Date2', 'trim|required');
            $this->form_validation->set_rules('Requirement', 'Requirement', 'trim|required');
             $this->form_validation->set_rules('Remarks','Remarks', 'trim|required');
            $this->form_validation->set_rules('Location','Location', 'trim|required');
             $this->form_validation->set_rules('EmpCode','EmpCode', 'trim|required');
            $this->form_validation->run();
            $error = $this->form_validation->get_all_errors();
            if ($error) {
                return_data(false, array_values($error)[0], array(), $error);
            }
        }

          public function send_email($data,$Date1,$Date2,$Location,$EmpCode) {
           // return_data(true, 'Tour inserted....', array()); 
                $PImg = $data['PImg'];
                $Dept = $data['Dept'];
                $Name = $data['Name'];
                $EmailID =$data['EmailID'];
                $year=date("Y");
                $AppDate = date("Y/m/d");
                $complete_id = $data['complete_id'];
                require_once getcwd().'/phpmailerclass/phpmailerclass/class.phpmailer.php';
                       $subject = "Tour Request";
        $to_email='rahulks7739@gmail.com';
        $message = "<html><body><table cellpadding='20' style='width:30%;border-width:5px;border-style:double;'><tbody  bgcolor='#a40402'><tr><td><table><tr><td style='min-width:300px'><img src='https://employee.sanskargroup.in/images/newlogo.png'></td><td><img src='https://employee.sanskargroup.in/EmpImage/".$PImg."' width=100px height=100px></td></tr></table><table><tbody><tr><td style='padding-bottom:20px;'><font color = #ffffff size=5>Today Tour Request </font></td></tr></tbody></table><table><tbody><tr><td style='color:#fff;padding-bottom:10px;'><b><font color=#f6a037> Tour Request Of -  </font></b><font color=#fff>" .$Name." </font></td></tr></tbody></table><table><tbody><tr><td style='color:#fff;padding-bottom:10px;'><b><font color=#f6a037> Employee Code - </font></b><font color=#fff>" .$EmpCode. "</font></td></tr></tbody></table><table><tbody><tr><td style='color:#fff;padding-bottom:10px;'><b><font color=#f6a037> Request ID - </font></b><font color=#fff>" .$complete_id."</font></td></tr></tbody></table><table><tbody><tr><td style='color:#fff;padding-bottom:10px;'><b><font color=#f6a037>Tour Duration From : </font></b>" .$Date1." <b><font color=#f6a037>To </font></b>" .$Date2."</td></tr></tbody></table><table><tbody><tr><td style='color:#fff;padding-bottom:10px;'><b><font color=#f6a037> Location - </font></b><font color=#fff>" .$Location. "</font></td></tr></tbody></table><table><tbody><tr><td style='color:#fff;padding-bottom:20px;padding-top:20px;'><font color=#fff><a style='background:#f6a037;padding:5px 10px; border-radius:5px; margin-top:10px;color:#fff;font-weight:bold;text-decoration:none;position: relative;top:15px;' href='http://employee.sanskargroup.in'>Action </a></font></td></tr></tbody></table></td></tr></tbody></table></body></html>";
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
             return_data(true, 'Request Send.', array()); 
        }
    
   

           
        }


} 
?>