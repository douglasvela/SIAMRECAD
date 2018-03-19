<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Lista_pasaje extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('Lista_pasaje_model');
		$this->load->library('FPDF/fpdf');
	}
	public function index(){
		$this->load->view('templates/header');
		$this->load->view('pasajes/Lista_pasaje');
		$this->load->view('templates/footer');
	}
	
	public function tabla_pasaje_lista(){
		$this->load->view('pasajes/viaticos_ajax/Lista_pasaje_ajax');
	}
	public function imprimir_solicitud(){
		$this->load->view('pasajes/viaticos_ajax/imprimir_solicitud_pasaje');
	}
		
}
?>