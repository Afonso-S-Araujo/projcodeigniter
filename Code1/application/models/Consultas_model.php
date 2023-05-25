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
		$result = array();
		if($islogged){
			if($userdata['tipo'] != 'admin'){
				$this->db->select($userdata['tipo'].'.id');
				$this->db->from($userdata['tipo']);
				$this->db->where('idUser',$userdata['id']);
				$result = $this->db->get()->result()[0];
			}			
		}

		$this->db->select('consultas.id,consultas.data,consultas.hora, medicos.nome AS nomeMedico, medicos.especialidade, utentes.nome AS nomeUtente');//,receitas.id as idReceitas
		$this->db->from($this->table);
		
		$this->db->join('medicos','medicos.id = consultas.idmedico','inner');
		$this->db->join('utentes','utentes.id = consultas.idutente','inner');
		//$this->db->join('receitas','receitas.idConsulta = consultas.id','inner');

		if($islogged && $userdata['tipo'] != 'admin'){	
			if($userdata['tipo'] =='enfermeiro'){
				$this->db->join('consultas_enfermeiros','consultas.id = consultas_enfermeiros.idconsulta','inner');
				$this->db->join('enfermeiros','enfermeiros.id = consultas_enfermeiros.idenfermeiro','inner');		
			}			
			$this->db->where($userdata['tipo'].'.id',$result->id);
			$this->db->where('consultas.estado',1); //mudar 1 para filtro			
		}else{
			if(!$islogged){
				$this->db->where('consultas.data',date("Y/m/d")); 	
			}

		}
		$this->db->order_by('consultas.data','ASC');	

		$consultas=$this->db->get()->result();
		//var_dump($consultas);
		return $consultas;

	}

	function get_byConsulta($idConsulta){
		$subquery = $this->db->select('idenfermeiro')
                    ->from('consultas_enfermeiros')
                    ->where('idconsulta = '.$idConsulta)
                    ->get_compiled_select();

		$query = $this->db->select('nome')
                  ->from('enfermeiros')
                  ->where_in('id', $subquery, false)
                  ->get();
		return $query;
	}
	

}
/*SELECT consultas.id, consultas.data, consultas.hora, medico.nome AS nomeMedico, medico.especialidade, utente.nome AS nomeUtente 
FROM consultas 
INNER JOIN consultas_enfermeiros ON consultas.id = consultas_enfermeiros.idconsulta 
INNER JOIN enfermeiro ON enfermeiro.id = consultas_enfermeiros.idenfermeiro 
INNER JOIN medico ON medico.id = consultas.idmedico 
INNER JOIN utente ON utente.id = consultas.idutente ORDER BY consultas.data DESC;

SELECT consultas.data, medico.nome AS nomeMedico, medico.especialidade, utente.nome AS nomeUtente, enfermeiro.nome AS nomeEnfermeiro
FROM consultas
INNER JOIN consultas_enfermeiros ON consultas.id = consultas_enfermeiros.idconsulta
INNER JOIN enfermeiro ON enfermeiro.id = consultas_enfermeiros.idenfermeiro
INNER JOIN medico ON medico.id = consultas.idmedico
INNER JOIN utente ON utente.id = consultas.idutente;*/