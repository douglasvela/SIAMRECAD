<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Observaciones extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('observaciones_model');
	}

	public function index(){
		$this->load->view('templates/header');
		$this->load->view('viaticos/observaciones');
		$this->load->view('templates/footer');
	}

	public function tabla_observaciones(){
		$this->load->view('viaticos/tabla_observaciones');
	}

	public function tabla_empresas_visitadas(){
		$this->load->view('viaticos/tabla_empresas_visitadas');
	}

	public function listado_observaciones(){
		$this->load->view('viaticos/listado_observaciones');
	}

	public function observar_empresa(){		
		$data = array(
		'id_empresa' => $this->input->post('id_empresa_visitada'), 
		'observacion' => $this->input->post('observacion_evisitada')
		);
		echo $this->observaciones_model->observar_empresa($data);
	}

	public function otra_observacion(){		
		$data = array(
		'id_mision' => $this->input->post('id_mision'), 
		'observacion' => $this->input->post('observacion')
		);
		echo $this->observaciones_model->otra_observacion($data);
	}
}
?>