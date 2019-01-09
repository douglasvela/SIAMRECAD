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

	public function informacion_empleado(){
		$this->load->view('viaticos/solicitud_admin_ajax/informacion_empleado');
	}
	
	public function tabla_empresas_visitadas(){
		$this->load->view('viaticos/solicitud_admin_ajax/tabla_empresas_visitadas');
	}

	public function crear_solicitud(){		
		$data = array(
			'estado' => 0,
			'recibida_fisico' => 1
		);
		echo $this->solicitud_admin_model->crear_solicitud($data);
	}

}
?>