<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes extends CI_Controller {
	
	public function __construct() {
        parent:: __construct();
		$this->load->helper('url');
		$this->load->library("pagination");
		$this->load->model('clientes_model');
	}
	
	public function index(){
		$config = array();
		$config["base_url"] = base_url() . "clientes"; 
		$config["total_rows"] = $this->clientes_model->get_count();
		$config["per_page"] = 3;
		//$config["uri_segment"] = 2;// na pos 0(page 0)  , uma vez que, não temos referencia numerica para pagina dará erro no cast do null para valor int. (string)
		
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
		
		$data["links"] = $this->pagination->create_links();
		
		$data['clientes'] = $this->clientes_model->get_clientes($config["per_page"], $page);
		
		$this->load->view('clientes',$data);
	}
}
