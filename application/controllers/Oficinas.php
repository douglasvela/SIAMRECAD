<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Oficinas extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('oficina_model');
	}

	public function index()
	{
		$datos["oficinas"] = $this->oficina_model->mostrar_oficina();
		$this->mivista($datos);
		
	}
	public function mivista($datos){
		$this->load->view('templates/header');
		$this->load->view('configuraciones/oficinas',$datos);
		$this->load->view('templates/footer');
	}
}
?>