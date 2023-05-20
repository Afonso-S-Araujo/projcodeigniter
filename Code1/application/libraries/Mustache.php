<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mustache {    
	private $m;

	function __construct(){
		// mus
		$loader = new Mustache_Loader_FilesystemLoader("./templates");
		$this->m = new Mustache_Engine(['loader'=>$loader]);
	}
	public function render($temp,$data){
		echo $this->m->render('header',$data);
		echo $this->m->render('menu',$data);
		echo $this->m->render($temp,$data);
		echo $this->m->render('footer',$data);
	}
	
}
