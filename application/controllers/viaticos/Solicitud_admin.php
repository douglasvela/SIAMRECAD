<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Solicitud_admin extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('solicitud_admin_model');
	}

	public function index(){
		$this->load->view('templates/header');
		$this->load->view('viaticos/solicitud_admin');
		$this->load->view('templates/footer');
	}

	public function tabla_solicitudes(){
		$this->load->view('viaticos/solicitud_admin_ajax/tabla_solicitudes');
	}

}
?>