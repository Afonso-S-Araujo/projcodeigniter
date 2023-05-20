<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BaseO extends CI_Controller {
	private $configMain = array();
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('contatos_model'); 
	}
	
	public function setConfig($fUpdate){
		$this->configMain = [
		"thumb" => [
		'image_library' => 'gd2',
			'source_image'=>$fUpdate['info_upload']['full_path'],
			'maintain_ratio' => TRUE,
			'width' => 75,
			'height' => 50,
			'create_thumb' => TRUE,
			'new_image' => "./uploads/thumbs/"
		],
		"rotate" => [
			'image_library' => 'gd2',
			'source_image'=>$fUpdate['info_upload']['full_path'],
			'rotation_angle' => $this->input->post('rotation'),
			'new_image' => "./uploads/rotated/"
		],
		"crop" => [
			'image_library' => 'gd2',
			'source_image'=>$fUpdate['info_upload']['full_path'],
			'new_image' => "./uploads/cropped/",
			'width' => $fUpdate['info_upload']['image_width']/2,
			'height' => $fUpdate['info_upload']['image_height']/2,
			'x_axis' => $fUpdate['info_upload']['image_width']/4,
			'y_axis' => $fUpdate['info_upload']['image_height']/4
		]
	];
	}// setconfig
	public function index()	{
	$this->load->view('upload'); }
	public function Upload(){
		$messageType = "";
		if (!$this->upload->do_upload('image')){
			$data['info'] = $this->upload->display_errors();
		}else{
			$data['info'] = "Imagem processada com sucesso!";
			$data['info_upload'] = $this->upload->data();
			$this->setConfig($data);
			
			// por em 1 linha
if($this->input->post('thumbnail')){
	$messageType .= " gerar o thumbnail ";
	$this->optImage("thumb");
}
if($this->input->post('rotation')){
	$messageType .= " rodar a imagem ";
	$this->optImage('rotate');
}
if($this->input->post('crop')){
	$messageType .= " recortar a imagem ";
	$this->optImage('crop');
}
// mostrar a msg
		}// end else
		$this->load->view('home', $data);
	}
	
	private function optImage($opt){
		$this->image_lib->initialize($this->configMain[$opt]);
		if(!$this->image_lib->{($opt == 'thumb')?'resize':$opt}()){
			$data['message'] = $this->image_lib->display_errors();
			$data['status'] = false;
		}else{
			$data['message'] = null;
			$data['status'] = true;
		}
		$this->image_lib->clear();
		return $data;
	}
}
