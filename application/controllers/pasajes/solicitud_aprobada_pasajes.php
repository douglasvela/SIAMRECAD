<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Solicitud_aprobada_pasajes extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('observaciones_pasajes_model');
	}

	public function index(){
		$this->load->view('templates/header');
		$this->load->view('pasajes/solicitud_aprobada_pasajes');
		$this->load->view('templates/footer');
	}

	public function tabla_observaciones(){
		$this->load->view('pasajes/aprobada_pasajes/tabla_aprobada_pasajes');
	}

}
?>