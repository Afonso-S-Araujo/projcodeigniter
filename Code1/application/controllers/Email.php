<?php

use PHPMailer\PHPMailer\PHPMailer;
//require 'vendor/autoload.php';
defined('BASEPATH') OR exit('No direct script access allowed');
define('ADMIN','sergio@gmail.com'); 
define('ADMIN_NAME','Sergio Ad');
define('PASS','');
/* Const em class
const ADMIN = 'sergiofmaraujo@gmail.com';*/
class Email extends CI_Controller {
	private $mail;
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$mail = new PHPMailer(true);
	}
	
	public function index(){
		$this->load->view('email');
	}
	public function send(){
		// $this->input->post
		$this->Instance($this->input->post('para'),$this->input->post('assunto'),$this->input->post('msg'));
	}
	
	private  function Instance($to,$subj,$msg){
		$mail = new PHPMailer(true);
		try {
			 $mail->SMTPDebug = 3;
			 $mail->isSMTP(); 
			 $mail->Host       = 'smtp.gmail.com';
			 $mail->SMTPAuth   = true;
			 $mail->Username   = ADMIN;
			 $mail->Password   = PASS;
			 $mail->SMTPAutoTLS = false;
			 $mail->SMTPSecure = 'tls';
			 $mail->Port       = 587;
			 // server não controla certificado
			 $mail->smtpConnect(
	            array(
	                "ssl" => array(
	                    "verify_peer" => false,
	                    "verify_peer_name" => false,
	                    "allow_self_signed" => true
	                )
	            )
	            );
				//recipients
		 $mail->setFrom(ADMIN, ADMIN_NAME);
		 $mail->addAddress($to, 'Sérgio Ad');
		 $mail->isHTML(true);
		 $mail->Subject = $subj;
		 $mail->Body    = '<b>'.$msg.'</b>';
		 $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
		 $mail->send();
		 echo 'Message has been sent';
			  
		} catch (Exception $e) {
	        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
	    }
	}
}
