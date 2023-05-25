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
        $this->data['css'] = base_url("resources/css/home.css");
		$this->data['imgNav'] = base_url("resources/img/crossbig.png");
        $this->data = array_merge($this->data,$data);
        
	}
	
    
    public function Save(){
        $contatos = $this->contatos_model->GetAll('nome');
        $dados['contatos'] =$this->contatos_model->Modelar($contatos);
        
        $validacao = self::Validation();
        if($validacao){
            $contato = $this->input->post();
            $status = $this->contatos_model->Insert($contato);
            if(!$status)
                $this->session->set_flashdata('error', 'Não foi possível inserir o contato.');
             else{
                $this->session->set_flashdata('success', 'Contato inserido com sucesso.');
    
                redirect('base', 'refresh');
            }
        }else
            $this->session->set_flashdata('error',validation_errors('<p>','</p>'));
        $this->load->view('home_editar',$dados);
    }
    
    public function Edit(){
        $id = $this->uri->segment(2);
        if(is_null($id))
            redirect('base', 'refresh');
        $dados['contato'] = $this->contatos_model->GetById($id);
        $this->load->view('editar', $dados);
    }

    public function Update(){
        $validacao = self::Validation('update');
        if($validacao){
            $form = $this->input->post();
            $status = $this->contatos_model->Update($form['id'], $form);
            if(!$status){
                $this->session->set_flashdata('error', 'Não atualizado com sucesso.');
                redirect('base', 'refresh');
            }else{
                $this->session->set_flashdata('sucess', 'Contato atualizado com sucesso.');
                redirect('base', 'refresh');
            }
        }
    }
    public function Delete(){
        $id = $this->uri->segment(2);
        if(is_null($id))
            redirect('base', 'refresh');
        $status = $this->contatos_model->Delete($id);
        if(!$status){
            $this->session->set_flashdata('error', 'Não apagado');
            redirect('base', 'refresh');
        }else{
            $this->session->set_flashdata('sucess', 'Contato apagado com sucesso.');
            redirect('base', 'refresh');
        }
    }
    
}
