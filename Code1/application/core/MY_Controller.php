<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
    public $data = [
        "title" => "",
        "css" => "",
    ];
    
    
	function __construct(){
		parent::__construct();
        $data =[
            "home" => base_url("home"),
            "medicos" => base_url("medicos"),
            "utentes" => "#",
            "enfermeiros" =>"#",
            "consultas" =>"#",
            "login" => base_url("login")
        ];
        $this->data['css'] = base_url("resources/css/home.css");
		$this->data['imgNav'] = base_url("resources/img/crossbig.png");
        $this->data = array_merge($this->data,$data);
        
	}
	
}
