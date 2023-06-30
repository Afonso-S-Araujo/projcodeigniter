<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
    public $data = [
        "title" => "",
        "css" => "",
    ];
    
    
	function __construct(){
		parent::__construct();
        
        if($this->login_lib->islogged){
			if($this->session->userdata('user')['tipo'] == 'admin'){
				$this->data['isAdmin'] = TRUE;
			}
		}
        $data =[
            "home" => base_url("home"),
            "medicos" => base_url("medicos"),
            "utentes" => base_url("utentes"),
            "enfermeiros" =>base_url("enfermeiros"),
            "consultas" =>base_url("consultas"),
            "login" => base_url("login"),
            "logout" => base_url("logout"),
            "email" => base_url("email"),
            "users" => base_url("users")
        ];
        $this->load->library('validation');
		$this->data['imgNav'] = base_url("resources/img/crossbig.png");
        $this->data = array_merge($this->data,$data);
        
	}
	
    
    
    
    
}
