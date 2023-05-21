<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {

	protected $data_;// informação
	protected $phpass;// ligação ao sistema de crypt
	
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		//A leitura da classe não importa maiúsculas ou minúsculas
		$this->load->library(array('passwordhash'));
		$this->passwordhash->init(8,false);
		
		$this->load->model('login_model');
		$this->login_model->init($this->passwordhash);
	}
	
    public function login(){
        if($this->login_model->isLoggedIn())
            redirect('home');
        $this->form_validation->set_rules('username','user','required');
        $this->form_validation->set_rules('password','senha','required');
        if($this->form_validation->run()){
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            if($user = $this->login_model->getByUsername($username)){
                if($this->login_model->checkPassword($password, $user['password'])){
                    $this->login_model->createSession($user);
                    redirect('home');
                }else
                    $this->data_['login_error'] = 'Username ou senha incorretos';
            }else
                $this->data_['login_error'] = 'Username ou senha incorretos';		
        }
        $this->mustache->render('login',$this->data);
    }

    public function logout(){
        session_destroy();
        $this->data_['login_success'] = 'logout com sucesso!!!';
        $this->mustache->render('login',$this->data);
    }
	
}
