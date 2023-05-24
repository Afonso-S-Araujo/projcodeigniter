<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Consultas_model extends MY_Model {
	
	
	function __construct(){
		parent::__construct();
		$this->table = 'consultas';
		
	}

	public function get_count() {
		return $this->db->count_all($this->table);
	}

	public function get_consultas($islogged,$userdata){
		if($islogged && $userdata['tipo'] != 'admin'){
			$this->db->select($userdata['tipo'].'.id');
			$this->db->from($userdata['tipo']);
			$this->db->where('idUser',$userdata['id']);
			$result = $this->db->get()->result();
			echo $result;
		}
		
		if($islogged && $userdata['tipo'] != 'admin'){
			if($userdata['tipo'] == 'enfermeiro'){
				$this->db->select('idconsulta');
				$this->db->where('idenfermeiro',$result['id']);
				$consultas = $this->db->get($this->table)->result();
			}
		}
		
		$this->db->select('consultas.data,medico.nome as nomeMedico,medico.especialidade,utente.nome as nomeUtente,enfermeiro.nome as nome enfermeiro,receitas.id as idReceitas From consultas inner join enfermeiro ON enfermeiro.id in (SELECT idenfermeiro from consultas_enfermeiros where )',FALSE);
		$this->db->from($this->table);
		if($islogged && $userdata['tipo'] != 'admin'){
			if($userdata['tipo'] == 'enfermeiro'){
				//SELECT consultas.data,medico.nome as nomeMedico,medico.especialidade,utente.nome as nomeUtente,enfermeiro.nome as nomeEnfermeiro From consultas inner join enfermeiro ON enfermeiro.id in (SELECT idenfermeiro from consultas_enfermeiros where idconsulta in (1,2)) INNER JOIN medico ON medico.id = consultas.idmedico INNER JOIN utente ON utente.id = consultas.idutente;	
			}
			$pessoas=array('medico','utente','enfermeiro');
			$this->db->join($userdata['tipo'],'consultas.id'.$userdata['tipo'].' = '.$userdata['id']);
			$this->db->join($userdata['tipo'],'consultas.id'.$userdata['tipo'].' = '.$userdata['id']);
			$this->db->where('estado',1);
			$this->db->order_by('data','DESC');
		}else{

		}
			


		return $this->db->get()->result();

	}

}
