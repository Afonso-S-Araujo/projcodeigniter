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
		//print_r($this->data);
		$this->data['imgNav'] = base_url("resources/img/crossbig.png");
		$this->data['isLoggedIn'] = $this->login_lib->islogged;
		$this->mustache->render('home',$this->data);
		
	}
	
	
	
	
}
