<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lista_pasaje extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('Lista_pasaje_model');
	}

	public function index(){
		$this->load->view('templates/header');
		$this->load->view('viaticos/Lista_pasaje');
		$this->load->view('templates/footer');
	}
	
	public function tabla_pasaje_lista(){
		$this->load->view('viaticos/viaticos_ajax/Lista_pasaje_ajax');
	}

		
}
?>