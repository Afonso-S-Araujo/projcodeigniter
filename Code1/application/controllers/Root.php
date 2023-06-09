<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Root extends MY_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		
		$this->data['title'] = "Home page";
		$this->data['css'] = base_url("resources/css/home.css");
	}
	
	
	public function index(){
		if($username = $this->session->userdata('user')['username']){
			$this->data['greet'] = $username;
		}
		
		$this->data['imgHome'] = base_url("resources/img/hospital.jpg");
		$this->data['isLoggedIn'] = $this->login_lib->islogged;
		$this->mustache->render('home',$this->data);
		
	}
	
	
	
	
}
