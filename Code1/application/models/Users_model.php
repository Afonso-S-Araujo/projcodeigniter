<?php
require_once(APPPATH.'core/MY_Pessoas_model.php');

defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends MY_Pessoas_model {
	
	
	function __construct(){
		parent::__construct();
		$this->table = 'users';
	}
	public function check_user($username){
		$this->db->select('id');
		$this->db->where('username',$username);
		$query = $this->db->get($this->table);
		if ($query->num_rows() > 0)
			return $query->num_rows();
		else
			return false;
	}

	public function check_pessoa($tipo,$id){
		$this->db->select('id');
		$this->db->where('idUser',$id);
		$query = $this->db->get($tipo);
		if ($query->num_rows() > 0)
			return $query->result()[0];
		else
			return false;
	}
	
}
