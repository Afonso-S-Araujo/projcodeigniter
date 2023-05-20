<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
    protected $data = [
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
            "consultas" =>"#"
        ];
        $this->data = array_merge($this->data,$data);
        
	}
	
}
