<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MY_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		//TODO: passar coisas que são carregadas sempre para o autoloader
		$this->load->library(array('pagination','passwordhash'));
		$this->load->model('Users_model');

		$this->data['title'] = "Users";
		$this->data['delete_url'] = base_url('deleteuser');
		$this->data['edit_url'] = base_url('edituser');
		if(!$this->login_lib->islogged){
			redirect(base_url('home'));
			return;
		}else{
			if($this->session->userdata('user')['tipo'] != 'admin'){
				redirect(base_url('home'));
				return;
			}
		}
	}
	
	
	public function index(){
		
		$this->data['usercreate'] = base_url('usercreate');
		//config do paginador
		$config = array();
		$config['base_url'] = base_url()."Users/index";
		$config['total_rows'] = $this->Users_model->get_count();
		$config['per_page'] = 3;

		//criação do paginador e select à base de dados
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		//$collumns = array();

		//verificação de login muda o select
		
		
		$jointable = false;
		$jointableCols = "";
		$collumns = array('id,username,tipo');
		
		$listaUsers = $this->Users_model->getByType($collumns,$jointableCols,$jointable,$config['per_page'],$page);
		//para o template
		$data = [
	        'header_h1' => 'Users',
	        'lista' => $listaUsers,
	        'links' => $this->pagination->create_links()
	    ];
		
		$this->data = array_merge($this->data,$data);
		$this->data['isLoggedIn'] = $this->login_lib->islogged;
		$this->mustache->render('users',$this->data);
		
	}
	
	
	
	
}
