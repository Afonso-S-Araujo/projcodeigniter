<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BaseUpload extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->library(array('image_lib','upload'));
	}
	/*config/routes.php
	$route['upload'] = 'BaseUpload/Upload';
	*/
	public function index(){
		$data['title'] = 'Page - Upload';
		$this->load->view('upload',$data);
	}
	public function Upload(){
		$data['title'] = 'Page - Upload';
		//$this->image_lib -> chamda á bib.
		//método que faz o upload do_upload('input do post')
		//display_errors
		if (!$this->upload->do_upload('image')){
			$data['info'] = $this->upload->display_errors();
		}else{
			// upload->data()-> info do upload
			$data['info_upload'] = $this->upload->data();
			
			/* Criar thumbnail
			$_POST['thumbnail']
			$this->input->post('thumbnail');
			*/
			if($this->input->post('thumbnail')){
				// define o path da imagem original
	$configThumbnail['source_image']   = $data['info_upload']['full_path'];
	// define que a proporção da imagem original
	$configThumbnail['maintain_ratio'] = TRUE;
	// define a largura do thumbnail
	$configThumbnail['width'] = 75;
	// define a altura do thumbnail
	$configThumbnail['height'] = 50;
	/*Se $configThumbnail['maintain_ratio'] for definido como TRUE , se indicado o menor valor entre altura e largura */
	
	// return status, message
	$thumbnail = $this->GenerateThumbnail($configThumbnail);
	// generate true/false
	if(!$thumbnail['status']){
		$data['info'] .= "<br/>Não foi possível gerar o thumbnail devido ao(s) erro(s) abaixo:<br />";
		$data['info'] .= $thumbnail['message'];
	}else{
		$data['info_upload']['thumb_path'] = 
		$data['info_upload']['file_path']."/thumbs/".
		$data['info_upload']['raw_name']."_thumb".
		$data['info_upload']['file_ext'];
	}		
			}// end if thumbnail
			// redimensionamento
			if($this->input->post('width') || $this->input->post('height'))	{
$configResize['source_image'] = $data['info_upload']['full_path'];
$configResize['maintain_ratio'] = ($this->input->post('ratio')) ? TRUE : FALSE;
$configResize['width'] = ($this->input->post('width')) ? $this->input->post('width') : null;
$configResize['height'] = ($this->input->post('height')) ? $this->input->post('height') : null;
$resize = $this->ResizeImage($configResize);
	if(!$resize['status']){
		$data['info'] .= "<br/>Não foi possível gerar o resize devido ao(s) erro(s) abaixo:<br />";
		$data['info'] .= $resize['message'];
	}else{
		$data['info_upload']['thumb_path'] = 
		$data['info_upload']['file_path']."/resized/".
		$data['info_upload']['raw_name'].
		$data['info_upload']['file_ext'];
	}	
			}// end if redimentionamet
			if($this->input->post('rotation'))	{
$configRotate['source_image'] = $data['info_upload']['full_path'];
$configRotate['rotation_angle'] = $this->input->post('rotation');

$rotate = $this->RotateImage($configRotate);
	if(!$rotate['status']){
		$data['info'] .= "<br/>Não foi possível gerar o rotate devido ao(s) erro(s) abaixo:<br />";
		$data['info'] .= $rotate['message'];
	}else{
		$data['info_upload']['rotate_path'] = 
		$data['info_upload']['file_path']."/rotated/".
		$data['info_upload']['raw_name'].
		$data['info_upload']['file_ext'];
	}	
			}// end if redimentionamet
			
			if($this->input->post('crop'))	{
$configCrop['source_image'] = $data['info_upload']['full_path'];

$crop = $this->CropImage($configCrop,$data);
	if(!$crop['status']){
		$data['info'] .= "<br/>Não foi possível gerar o crop devido ao(s) erro(s) abaixo:<br />";
		$data['info'] .= $crop['message'];
	}else{
		$data['info_upload']['crop_path'] = 
		$data['info_upload']['file_path']."/rotated/".
		$data['info_upload']['raw_name'].
		$data['info_upload']['file_ext'];
	}	
			}// end if redimentionamet
			
			if($this->input->post('watermark'))	{
$configWM['source_image'] = $data['info_upload']['full_path'];

$wm = $this->ApplyWatermark($configWM);
	if(!$wm['status']){
		$data['info'] .= "<br/>Não foi possível gerar o watermark devido ao(s) erro(s) abaixo:<br />";
		$data['info'] .= $wm['message'];
	}else{
		$data['info_upload']['wm_path'] = 
		$data['info_upload']['file_path']."/rotated/".
		$data['info_upload']['raw_name'].
		$data['info_upload']['file_ext'];
	}	
			}// end if redimentionamet
		}
		
		$this->load->view('upload',$data);
	}
	
	private function GenerateThumbnail($config){
		$config['image_library'] = 'gd2';
		$config['create_thumb'] = TRUE;
		$config['new_image'] = "./uploads/thumbs/";
		
		$this->image_lib->initialize($config);
		
		if (!$this->image_lib->resize()){
			$data['status'] = false;
			$data['message'] = $this->image_lib->display_errors();
		}else{
			$data['status'] = true;
			$data['message'] = null;
		}
		$this->image_lib->clear();
		return $data;
	}
	
	private function ResizeImage($config){
		$config['image_library'] = 'gd2';
		$config['create_thumb'] = FALSE;
		$config['new_image'] = "./uploads/resized/";
		$this->image_lib->initialize($config);
		if (!$this->image_lib->resize()){
			$data['status'] = false;
			$data['message'] = $this->image_lib->display_errors();
		}else{
			$data['status'] = true;
			$data['message'] = null;
		}
		$this->image_lib->clear();
		return $data;
	}
	private function RotateImage($config){
		$config['image_library'] = 'gd2';
		$config['new_image'] = "./uploads/rotated/";
		$this->image_lib->initialize($config);
		if (!$this->image_lib->rotate()){
			$data['status'] = false;
			$data['message'] = $this->image_lib->display_errors();
		}else{
			$data['status'] = true;
			$data['message'] = null;
		}
		$this->image_lib->clear();
		return $data;
	}
	
	private function CropImage($config,$data){
		$config['image_library'] = 'gd2';
		$config['new_image'] = "./uploads/cropped/";
		$config['width'] = $data['info_upload']['image_width']/2;
		$config['height'] = $data['info_upload']['image_height']/2; 
		$config['x_axis'] = $config['width']/2;
		$config['y_axis'] = $config['height']/2;
		
		$this->image_lib->initialize($config);
		if (!$this->image_lib->crop()){
			$data['status'] = false;
			$data['message'] = $this->image_lib->display_errors();
		}else{
			$data['status'] = true;
			$data['message'] = null;
		}
		$this->image_lib->clear();
		return $data;
	}
	
	private function ApplyWatermark($config){
		$config['new_image'] = "./uploads/watermark/";
		$config['wm_type'] = 'overlay';
		$config['wm_opacity'] = '20';
		$config['wm_overlay_path'] = './assets/images/watermark.jpg';
		$this->image_lib->initialize($config);
		if (!$this->image_lib->watermark()){
			$data['status'] = false;
			$data['message'] = $this->image_lib->display_errors();
		}else{
			$data['status'] = true;
			$data['message'] = null;
		}
		$this->image_lib->clear();
		return $data;
	}
}
