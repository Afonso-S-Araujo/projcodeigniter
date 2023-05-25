<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Base extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('contatos_model'); 
    }
    
    
}