<?
defined('BASEPATH') OR exit('No direct script access allowed');

class Validation {

	private $CI;

    function __construct(){
		$this->CI =& get_instance();
		
		$this->CI->load->library('form_validation');
    }

    public function validation($operacao,$table){
        switch($operacao){
            case 'insert':
                if($table == 'Users'){
                    $this->CI->form_validation->set_rules('username', 'Nome', array('trim', 'required', 'min_length[3]'));
                    $this->CI->form_validation->set_rules('password', 'senha', array('trim', 'required'));                
                }
                break;
            case 'update':
                if($table == 'Users'){
                    $this->CI->form_validation->set_rules('username', 'Nome', array('trim', 'required', 'min_length[3]'));
                    $this->CI->form_validation->set_rules('password', 'senha', array('trim', 'required'));                
                }
                break;
            default:
                $rules['nome'] = array('trim', 'required', 'min_length[3]');
        }
        
        return $this->CI->form_validation->run();
    }
}
?>