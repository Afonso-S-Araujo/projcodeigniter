<?
defined('BASEPATH') OR exit('No direct script access allowed');

class Login {

    function __construct(){

    }

    public function isLoggedIn(){
        /*
        $logged_in = $this->session->userdata('logged_in');
        $user = $this->session->userdata('user');
        if($logged_in== TRUE){
            $this->createSession($user);
            return true;
        }*/
        return false;
    }
}
?>