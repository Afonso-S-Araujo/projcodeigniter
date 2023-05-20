<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ParserSergio extends CI_Controller {
	private $m;
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		//$this->load->model('contatos_model');
		//bib parser-> ativar a bib de gestão pseudo var
		// mus
		$loader = new Mustache_Loader_FilesystemLoader("./templates");
		$this->m = new Mustache_Engine(['loader'=>$loader]);
		// end mus
		// para o exemplo 3 e 4
		//$this->m = new Mustache_Engine;
		$this->load->library(array('pagination','parser'));	
	}
	public function index()	{
		 $data = array( 'h3_string' => 'Paginação',
		  'p_string' => 'Olá parser em codeigniter',
		   'list_clients' => array(
			array('id' => '1','nome' => 'sergio', 'email' => 'sergio@sergio.pt'),
			array('id' => '2','nome' => 'ana', 'email' => 'ana@sergio.pt'),
	array('id' => '3','nome' => 'maria', 'email' => 'maria@sergio.pt')
	)
		   );
	$this->parser->parse("parsersergio", $data);
	}
	public function exemplo1(){
		// Pratica errada, apenas para não criar model
		$query = $this->db->query("SELECT * FROM users");
		
		 $data = array( 'h3_string' => 'Paginação exemplo3',
	      'p_string' => 'Olá parser em codeigniter',
	      'list_users' => $query->result_array()
	               );
		
		$this->parser->parse("parsersergio", $data);
	}
	
	public function exemplo2(){
		/*
		Usar o método parse_string()-> html
		parse_string(o template a renderizar, o info a ser subs, boolean, isto é se querem controlar a renderização ou não)
		*/
		$li_listaUsers = "<li>{id} - {nome} - {morada}</li>";
		$query = $this->db->query("SELECT * FROM users");
	    $listaUsers = $query->result_array();
		$listaContatos = "<ul>";
		foreach ($listaUsers as $user)
			$listaContatos .= $this->parser->parse_string($li_listaUsers,$user, FALSE );	
		$listaContatos .= "</ul>";
		$data['list_users_h'] = 'Titulo da minha lista';
		 $data['list_users'] = $listaContatos;
		$this->parser->parse('parsersergio',$data); 
	}
	
	public function exemplo3(){
		$m = new Mustache_Engine;
		//echo $m->render('template', pse_ var);
		echo $m->render('Hello, {{planet}}',array('planet' => 'World'));
	}
	
	public function exemplo4(){
		 $modelo = '<div><p>{{nome}}-{{morada}}</p></div>';
		 $info = array(
	                   'nome'=>'sergio',
	                   'morada'=>'funchal'
	                );
		echo $this->m->render($modelo,$info);	
	}
	public function exemplo5(){
		$listaUsers = array(
array('id'=>'1', 'nome'=>'se','morada'=>'funch'),
array('id'=>'2', 'nome'=>'a','morada'=>'mach'),
array('id'=>'3', 'nome'=>'so','morada'=>'pt'),
	          );
	 $data = [
	      'header_h3' => 'Cab. h3',
	       'lista_users_h3'=>'Titulo da lista de Users',
	       'listaUsers' => $listaUsers
	        ];
		echo $this->m->render('index',$data);
	}
	public function exemplo6(){
		$query = $this->db->query("SELECT * FROM users");
	    $listaUsers = $query->result_array();
		$data = [
	      'header_h3' => 'Cab. h3',
	       'lista_users_h3'=>'Titulo da lista de Users',
	       'listaUsers' => $listaUsers
	        ];
		echo $this->m->render('index',$data);
	}
	
	public function exemplo7(){
		$this->load->model('users_model');
		$config = array();
		$config['base_url'] = base_url()."parsersergio/exemplo7";
		$config['total_rows'] = $this->users_model->get_count();
		$config['per_page'] = 2;
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$listaUsers = $this->users_model->get_users($config['per_page'],$page);
		$data = [
	        'header_h3' => 'Cab. h3',
	        'lista_users_h3'=>'Titulo da lista de Users',
	        'listaUsers' => $listaUsers,
	        'links' => $this->pagination->create_links()
	    ];
	    echo $this->m->render('index',$data);
		
	}
	
}
