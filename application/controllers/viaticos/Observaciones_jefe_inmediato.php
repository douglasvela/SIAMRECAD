<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Observaciones_jefe_inmediato extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('observaciones_model');
	}

	public function index(){
		$this->load->view('templates/header');
		$this->load->view('viaticos/observaciones_1');
		$this->load->view('templates/footer');
	}

	public function tabla_observaciones(){
		$this->load->view('viaticos/observaciones_1/tabla_observaciones');
	}


	public function listado_observaciones(){
		$this->load->view('viaticos/observaciones_1/listado_observaciones');
	}

	public function observar_empresa(){		
		$data = array(
		'id_empresa' => $this->input->post('id_empresa_visitada'), 
		'observacion' => $this->input->post('observacion_evisitada')
		);
		echo $this->observaciones_model->observar_empresa($data);
	}

	public function cambiar_estado_solicitud(){		
		$data = array(
		'id_mision' => $this->input->post('id_mision'), 
		'estado' => $this->input->post('estado')
		);
		echo $this->observaciones_model->cambiar_estado_solicitud($data);
	}

	public function eliminar_observacion(){
		$data = array(
		'id_observacion' => $this->input->post('id_observacion')
		);
		echo $this->observaciones_model->eliminar_observacion($data);
	}

	public function eliminar_observacion_empresa(){
		$data = array(
		'id_empresa' => $this->input->post('id_empresa'), 
		'observacion' => ''
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

	function verificar_observaciones(){
		$id_mision = $this->input->post('id_mision');
		if($this->observaciones_model->verificar_observaciones_empresa($id_mision)){
			echo "observaciones";
		}else{
			if($this->observaciones_model->verificar_observaciones($id_mision)){
				echo "observaciones";
			}else{
				echo "aprobar";
			}
		}
	}
}
?>