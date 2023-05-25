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
        $this->data['css'] = base_url("resources/css/home.css");
		$this->data['imgNav'] = base_url("resources/img/crossbig.png");
        $this->data = array_merge($this->data,$data);
        
	}
	
    
    public function insert(){
        
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
                $this->session->set_flashdata('error', 'Não foi possível inserir o contato.');
            else{
                $this->session->set_flashdata('success', 'Contato inserido com sucesso.');
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
