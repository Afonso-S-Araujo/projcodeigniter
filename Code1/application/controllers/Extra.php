<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Extra extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper(array('url','text','string'));
	}
	
	public function index(){
		$this->load->view('extra');
	}
	
	
}
