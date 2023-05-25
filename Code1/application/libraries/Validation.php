<?
defined('BASEPATH') OR exit('No direct script access allowed');

class Validation {

	private $CI;

    function __construct(){
		$this->CI =& get_instance();
		
		$this->CI->load->library('form_validation');
    }

    private function Validation($operacao = 'insert'){
        switch($operacao){
            case 'insert':
                $rules['nome'] = array('trim', 'required', 'min_length[3]');
                $rules['email'] = array('trim', 'required', 'valid_email', 'is_unique[contatos.email]');
                break;
            case 'update':
                $rules['nome'] = array('trim', 'required', 'min_length[3]');
                $rules['email'] = array('trim', 'required', 'valid_email');
                break;
            default:
                $rules['nome'] = array('trim', 'required', 'min_length[3]');
        }
        $this->form_validation->set_rules('nome', 'Nome', $rules['nome']);
        $this->form_validation->set_rules('email', 'Email', $rules['email']);
        return $this->form_validation->run();
    }
}
?>