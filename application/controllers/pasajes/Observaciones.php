<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Observaciones extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('observaciones_pasajes_model');
	}

	public function index(){
		$this->load->view('templates/header');
		$this->load->view('pasajes/Observacion');
		$this->load->view('templates/footer');
	}

	public function observacion1(){
		$this->load->view('pasajes/observaciones_pasajes/observacion1');
	}

	public function observacion2(){
		$this->load->view('pasajes/observaciones_pasajes/observacion2');
	}

	public function observacion3(){
		$this->load->view('pasajes/observaciones_pasajes/observacion3');
	}


	public function listado_observaciones_pasajes(){
		$this->load->view('pasajes/observaciones_pasajes/listado_observaciones_pasajes');
	}

	public function cambiar_estado_solicitud(){		
		$data = array(
		'id_mision' => $this->input->post('id_mision'), 
		'estado' => $this->input->post('estado')
		);
		echo $this->observaciones_pasajes_model->cambiar_estado_solicitud($data);
	}

	public function eliminar_observacion(){
		$data = array(
		'id_observacion' => $this->input->post('id_observacion')
		);
		echo $this->observaciones_pasajes_model->eliminar_observacion($data);
	}

	public function otra_observacion(){		
		$data = array(
		'id_mision' => $this->input->post('id_mision'), 
		'observacion' => $this->input->post('observacion'),
		'nr_observador' => $this->input->post('nr_observador'),
		'id_tipo_observador' => $this->input->post('id_tipo_observador'),
		'tipo_observador' => $this->input->post('tipo_observador')
		);
		echo $this->observaciones_pasajes_model->otra_observacion($data);
	}

	function verificar_observaciones(){
		$id_mision = $this->input->post('id_mision');
		if($this->observaciones_pasajes_model->verificar_observaciones($id_mision)){
			echo "observaciones";
		}else{
			echo "aprobar";
		}
	}
}
?>