
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class My_Captcha extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
	}
	
	public function index()	{
	    $this->load->view('captcha');
	}
	/*
	 * https://www.google.com/recaptcha/
	 */
	 
	 public function verificar(){
		 //g-recaptcha-response'
		 $recaptchaReponse = $this->input->post('g-recaptcha-response');
		 print_r($recaptchaReponse);
		 // api da google recaptcha
	    $url = 'https://www.google.com/recaptcha/api/siteverify';
		$secret =  '6LcAhPMlAAAAAM_HW4rjSGZxXRCWiINldYiSj5xH';
		 $data = array('secret' => $secret, 'response' => $recaptchaReponse);
		 /* Bib. interna do PHP curl-> estalece uma ligação direta a um servidor
	     * php.ini extension:curl
	     */
		  $curl = curl_init();
		  curl_setopt($curl, CURLOPT_URL, $url);
		  curl_setopt($curl, CURLOPT_POST, true);
		  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		  curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
		$response = curl_exec($curl);
		 curl_close($curl);
		 $responseStatus = json_decode($response,true);
		 if($responseStatus['success'])
	        echo "<br />"."perfeito";
	    else
	        echo "<br />"."erro";
	 }
}
