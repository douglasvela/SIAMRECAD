<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Informacion_empleado extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('horarios_model');
	}

	public function index(){
		$this->load->view('templates/header');
		$this->load->view('configuraciones/informacion_empleado');
		$this->load->view('templates/footer');
	}

	public function tabla_informacion_empleado(){
		$this->load->view('configuraciones/combos_informacion_empleado');
	}

	public function gestionar_informacion_empleado(){

	}
}
?>