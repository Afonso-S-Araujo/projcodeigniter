<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {
	protected $table = 'users';
	protected $phpass;
	function __construct(){
		parent::__construct();
	}

	public function init( $phpass ){
		$this->phpass = $phpass;
	}

	public function getByUsername($username){
		$user = array('username' => $username);
		 $query = $this->db->get_where($this->table, $user,1);
		 if($query->num_rows()>0)
			return $query->row_array();
		return false;
	}
	
	
	public function checkPassword($password,$hashed_password) {
		return $this->phpass->CheckPassword($password, $hashed_password);
	}
}
