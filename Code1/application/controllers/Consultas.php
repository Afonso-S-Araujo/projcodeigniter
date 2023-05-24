<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Consultas extends MY_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		//TODO: passar coisas que são carregadas sempre para o autoloader
		$this->load->library('pagination');
		$this->load->model('Consultas_model');

		$this->data['title'] = "Consultas";
	}
	
	
	public function index(){
		//config do paginador
		$config = array();
		$config['base_url'] = base_url()."Consultas/index";
		$config['total_rows'] = $this->Consultas_model->get_count();
		$config['per_page'] = 3;

		//criação do paginador e select à base de dados
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		//$collumns = array();

		//verificação de login muda o select
		$listaConsultas = $this->Consultas_model->get_consultas($this->login_lib->islogged);
		//para o template
		$data = [
	        'header_h1' => 'Consultas',
	        'lista' => $listaConsultas,
	        'links' => $this->pagination->create_links()
	    ];
		//print_r($listaConsultas);
		$this->data = array_merge($this->data,$data);
		$this->data['isLoggedIn'] = $this->login_lib->islogged;
		$this->mustache->render('consultas',$this->data);
		
	}
	
	
	
	
}
