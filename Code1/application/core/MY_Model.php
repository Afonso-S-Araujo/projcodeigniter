<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Model extends CI_Model {
	// atrb. que rep. a tabela
	protected $table = "";
	protected $type = "";
	function __construct(){
		parent::__construct();
	}

	public function get_count() {
		return $this->db->count_all($this->table);
	}
	/* 	
		jointableCols -> colunas da tabela ligada por inner join
		jointable	-> tabela do inner join
		collumns -> colunas que quero selecionar da tabela principal
	*/
	public function getByType($jointableCols,$jointable,$collumns,$limit, $start){
		
		if(is_array($collumns))
			$this->db->select(implode(',',$collumns));
		else{
			print_r($jointableCols);
			// prepara as colunas para o select 
			for($i = 0;$i < count($jointableCols);$i++)
				$jointableCols[$i] = $jointable.'.'.$jointableCols[$i];
			$this->db->select($this->table.'.*,'.implode(',',$jointableCols));
		}
		$this->db->from($this->table);

		if($jointable)
			$this->db->join($jointable,$this->table.'.id'.$jointable.' = '.$jointable.'.id','inner');
		$this->db->limit($limit, $start);
		$this->db->where('tipo',$this->type);
		$query = $this->db->get();
		return $query->result();
	}
	// return boolean rec. array
	public function Insert($data){
		if(!isset($data))
			return false;
			// insert(table, data)
		return $this->db->insert($this->table, $data);
	}
	// return array
	function GetById($id) {
		if(is_null($id))
			return false;
		//where(nomecampotabela, valor)
		$this->db->where('id', $id);
		$query= $this->db->get($this->table);
		if ($query->num_rows() > 0)
			return $query->row_array();
		else
			return null;
	}
	/* Lista todos os registos da tabela
		$sort Campo para ordenação dos registos
		$order Tipo de ordenação: ASC ou DESC
		returna array
  */
	function GetAll($sort = 'id', $order = 'asc') {
		 $this->db->order_by($sort, $order);
		 $query = $this->db->get($this->table);
		 if ($query->num_rows() > 0)
			return $query->result_array();
		else
			return null;
	}
	/* Atualiza um registo na tabela
	$int ID do registo a ser atualizado
	$data Dados a serem inseridos
	returna boolean
  */
	 function Update($id, $data) {
		if(is_null($id) || !isset($data))
			return false;
		$this->db->where('id', $id);
		return $this->db->update($this->table, $data);
	 }
	/* Remove um registo na tabela
	$int ID do registo a ser eliminado
	returna boolean
  */
   function Delete($id) {
    if(is_null($id))
      return false;
	$this->db->where('id', $id);
	return $this->db->delete($this->table);
   }
}
