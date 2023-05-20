<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model {
	protected $table = 'users';
	function __construct(){
		parent::__construct();
	}
	public function get_count() {
		return $this->db->count_all($this->table);
	}
	public function get_users($limit, $start){
		$this->db->limit($limit, $start);
		$query = $this->db->get($this->table);
		return $query->result();
	}
	
	public function get_usersAll() {
		$query = $this->db->get($this->table);
        return $query->result();
	}
}
