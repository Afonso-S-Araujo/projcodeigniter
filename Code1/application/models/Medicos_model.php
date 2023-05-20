<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Medicos_model extends MY_Model {
	
	
	function __construct(){
		parent::__construct();
		$this->table = 'users';
		$this->type = 'medico';
	}

	
}
