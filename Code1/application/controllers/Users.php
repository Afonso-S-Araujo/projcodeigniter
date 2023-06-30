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
		$this->data['css'] = base_url("resources/css/listing.css");
	}
	
	
	public function index(){
		
		if($this->session->flashdata('success'))
			$this->data['success'] = $this->session->flashdata('success');
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

	public function insert(){
		//script para alterar dinamicamente o form
		$this->data['javascript'] = base_url('resources/javascript/userform.js');
        $validacao = $this->validation->validation('insert',$this->data['title']);
        if($validacao){
            $data = $this->input->post();
            if($this->data['title'] == 'Users'){
                $check = $this->{$this->data['title']."_model"}->check_user($data['username']);
                if($check){
                    $this->session->set_flashdata('error', 'Não foi possível inserir o contato.');
                    redirect(base_url('home'));
                }
                $data['password'] = $this->passwordhash->HashPassword($data['password']);
            }
                
            $status = $this->{$this->data['title']."_model"}->insert($data);
            if(!$status)
                $this->session->set_flashdata('error', 'Não foi possível inserir o Utilizador.');
            else{
                $this->session->set_flashdata('success', 'Utilizador inserido com sucesso.');
                redirect(base_url($this->data['title']), 'refresh');

            }
        }else
            $this->session->set_flashdata('error',validation_errors('<p>','</p>'));
        $this->mustache->render('users_form',$this->data);
    }
	
	

    public function update($id){
        //$id = $this->uri->segment(3);
        if(is_null($id))
            redirect(base_url($this->data['title']), 'refresh');
        $this->data['listaForm'] = $this->{$this->data['title']."_model"}->GetById($id);
        if($this->data['title'] == 'Users')
            $this->data[$this->data['listaForm']['tipo'].'select'] = 'selected';
        
        $validacao = $this->validation->validation('update',$this->data['title']);
        if($validacao){
            $form = $this->input->post();
            if($this->data['title'] == 'Users')
                $form['password'] = $this->passwordhash->HashPassword($form['password']);                
            $status = $this->{$this->data['title']."_model"}->update($id, $form);
            if(!$status){
                $this->session->set_flashdata('error', 'Não atualizado com sucesso.');
                redirect(base_url($this->data['title']), 'refresh');
            }else{
                $this->session->set_flashdata('sucess', 'Contato atualizado com sucesso.');
                redirect(base_url($this->data['title']), 'refresh');
            }
        }
        $this->mustache->render('usersedit_form',$this->data);
    }

    public function delete($id){
        //$id = $this->uri->segment(3);
        if(is_null($id))
            redirect(base_url($this->data['title']), 'refresh');            
        $status = $this->{$this->data['title']."_model"}->delete($id);
        if(!$status){
            $this->session->set_flashdata('error', 'Não apagado');
            redirect(base_url($this->data['title']), 'refresh');
        }else{
            if($this->data['title'] == 'Users'){
                $tipos = array('Medicos','Utentes','Enfermeiros');

                foreach($tipos as $tipo){
                    $check = $this->{$this->data['title']."_model"}->check_pessoa($tipo,$id);
                    if($check){
                        $iduser = array('idUser' => null);
                        echo $check->id;
                        $this->{$this->data['title']."_model"}->updateByType($tipo,$check->id, $iduser);
                        break;
                    }   
                }

                             
            }  
            $this->session->set_flashdata('sucess', 'Contato apagado com sucesso.');
            redirect(base_url($this->data['title']), 'refresh');
        }
    }
	
	
}
