<?
defined('BASEPATH') OR exit('No direct script access allowed');

class Login {

	private $CI;

    function __construct(){
		echo "bomba";
		$this->CI =& get_instance();
		
		$this->CI->load->library('session');
    }

    public function isLoggedIn(){
		
		//logged_in
		// $logged_in = $_SESSION['logged_in'];
		// $logged_in = $this->session->logged_in;
		$logged_in = $this->CI->session->userdata('logged_in');
		$user = $this->CI->session->userdata('user');
		if($logged_in){
			$this->createSession($user);
			return true;
		}
		return false;
	}
	public function createSession($user_data){
		
		$this->CI->session->set_userdata(array('logged_in' =>TRUE, 'user'=>$user_data));
	}
}
?>