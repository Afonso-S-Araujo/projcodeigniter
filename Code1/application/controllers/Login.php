<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	private $data;// informação
	protected $phpass;// ligação ao sistema de crypt
	
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->library(array('form_validation','session'));
		//A leitura da classe não importa maiúsculas ou minúsculas
		$this->load->library('passwordhash');
		$this->passwordhash->init(8,false);
		
		$this->load->model('login_model');
		$this->login_model->init($this->passwordhash);
	}
	
public function login(){
	if($this->login_model->isLoggedIn())
		redirect('admin');
	$this->form_validation->set_rules('username','user','required');
	$this->form_validation->set_rules('password','senha','required');
	 if($this->form_validation->run()){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		if($user = $this->login_model->getByUsername($username)){
			if($this->login_model->checkPassword($password, $user['password'])){
			  $this->login_model->createSession($user);
			  redirect(base_url().'admin');
			}else
				 $this->data['login_error'] = 'Palavra-passe incorreta';
		}else
			$this->data['login_error'] = 'User não existe';		
	 }
	$this->load->view('login',$this->data);
}

public function logout(){
	session_destroy();
	$this->data['login_success'] = 'logout com sucesso!!!';
	$this->load->view('login',$this->data);
}
	
}
