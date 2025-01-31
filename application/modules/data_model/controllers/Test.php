<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Test extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        /* !!!!!! Warning !!!!!!!11
         *  admin panel initialization
         *  do not over-right or remove auth_panel/auth_panel_ini/auth_ini
         */
        modules::run('auth_panel/auth_panel_ini/auth_ini');
        $this->load->library('form_validation');
        $this->load->helper('services');
    }

    public function send_mail() {
        $subject = "Testing mail subject";
		$to_email='ariphhusain123@gmail.com';
		$message = "Testing mail message body";
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
		//pre($config);	die;
		 $this->load->library('email',$mail_config);
		$this->email->set_mailtype("html");
		$this->email->from('music@sanskargroup.in', 'Sanskar Music');
		$this->email->to($to_email);
		$this->email->cc('ariph.husain@sanskargroup.in');
		//$this->email->bcc('them@their-example.com');
		$this->email->subject($subject);
		$this->email->message($message);
		$success = $this->email->send();
        echo $success;
        
    }

}
