<?php
require_once(APPPATH.'core/MY_Pessoas_model.php');

defined('BASEPATH') OR exit('No direct script access allowed');

class Utentes_model extends MY_Pessoas_model {
	
	
	function __construct(){
		parent::__construct();
		$this->table = 'utente';
	}

	
}
