<?php

use PHPMailer\PHPMailer\PHPMailer;
//require 'vendor/autoload.php';
defined('BASEPATH') OR exit('No direct script access allowed');
define('ADMIN','afonsoa2004@gmail.com'); 
define('ADMIN_NAME','afonso');
define('PASS','coaglkfssxpwygxo');

class Email extends MY_Controller {
	
	private $mail;
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$mail = new PHPMailer(true);
		$this->data['emailsend']= base_url('emailsend');
		$this->data['isLoggedIn'] = $this->login_lib->islogged;
	}
	
	public function index(){
		$this->mustache->render('email',$this->data);
	}
	public function send(){
		// $this->input->post
		$this->Instance($this->input->post('para'),$this->input->post('assunto'),$this->input->post('msg'));
	}
	
	private  function Instance($to,$subj,$msg){
		$mail = new PHPMailer(true);
		try {
			$mail->SMTPDebug = 0;
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
		$mail->addAddress($to, $this->session->userdata('user')['username']);
		$mail->isHTML(true);
		$mail->Subject = $subj;
		$mail->Body    = '<b>'.$msg.'</b>';
		$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
		$mail->send();
		$this->data['email_report'] = "Message has been sent";
		$this->data['email_state'] = "success";
			
		} catch (Exception $e) {
			$this->data['email_report'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
			$this->data['email_state'] = "error";
		}
		$this->mustache->render('email_report',$this->data);
	}
}
