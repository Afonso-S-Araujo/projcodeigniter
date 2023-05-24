<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Enfermeiros extends MY_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		//TODO: passar coisas que são carregadas sempre para o autoloader
		$this->load->library('pagination');
		$this->load->model('Enfermeiros_model');

		$this->data['title'] = "Enfermeiros";
	}
	
	
	public function index(){
		//config do paginador
		$config = array();
		$config['base_url'] = base_url()."Enfermeiros/index";
		$config['total_rows'] = $this->Enfermeiros_model->get_count();
		$config['per_page'] = 3;

		//criação do paginador e select à base de dados
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		//$collumns = array();

		//verificação de login muda o select
		
		if(!$this->login_lib->islogged){
			$jointable = false;
			$jointableCols = "";
			$collumns = array('nome','especialidade');
		}else{			
			$jointable = 'morada';
			$jointableCols = array('cidade');
			$collumns = '*';
		}
		$listaEnfermeiros = $this->Enfermeiros_model->getByType($jointableCols,$jointable,$collumns,$config['per_page'],$page);
		//para o template
		$data = [
	        'header_h1' => 'Enfermeiros',
	        'lista' => $listaEnfermeiros,
	        'links' => $this->pagination->create_links()
	    ];
		
		$this->data = array_merge($this->data,$data);
		$this->data['isLoggedIn'] = $this->login_lib->islogged;
		$this->mustache->render('funcionarios',$this->data);
		
	}
	
	
	
	
}
