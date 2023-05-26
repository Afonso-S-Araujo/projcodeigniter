<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Pessoas_model extends MY_Model {
	// atrb. que rep. a tabela
    
	function __construct(){
		parent::__construct();
	}

	public function get_count() {
		$this->db->from($this->table);
        return $this->db->count_all_results();
	}

	/* 	
		jointableCols -> colunas da tabela ligada por inner join
		jointable	-> tabela do inner join
		collumns -> colunas que quero selecionar da tabela principal
	*/
	public function getByType($collumns,$jointableCols = "",$jointable = false,$limit =null , $start = null){
		
		if(is_array($collumns)){
			$this->db->select(implode(',',$collumns));
			// prepara as colunas para o select 
			if($jointableCols != ""){
				for($i = 0;$i < count($jointableCols);$i++)
				$jointableCols[$i] = $jointable.'.'.$jointableCols[$i];
				$this->db->select($this->table.'.*,'.implode(',',$jointableCols));
			}
			
		}
		$this->db->from($this->table);
		if($jointable)
			$this->db->join($jointable,$this->table.'.id'.$jointable.' = '.$jointable.'.id','inner');		
		$this->db->limit($limit, $start);
		$query = $this->db->get();
		
		return $query->result();
	}
	
	
}
