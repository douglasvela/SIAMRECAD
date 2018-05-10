<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Solicitud_aprobada extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('observaciones_model');
	}

	public function index(){
		$this->load->view('templates/header');
		$this->load->view('viaticos/solicitud_aprobada');
		$this->load->view('templates/footer');
	}

	public function tabla_observaciones(){
		$this->load->view('viaticos/solicitud_aprobada/tabla_solicitud_aprobada');
	}

}
?>