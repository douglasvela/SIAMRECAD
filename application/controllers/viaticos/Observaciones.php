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

	public function tabla_observaciones1(){
		$this->load->view('viaticos/observaciones/tabla_observaciones1');
	}

	public function tabla_observaciones2(){
		$this->load->view('viaticos/observaciones/tabla_observaciones2');
	}

	public function tabla_observaciones3(){
		$this->load->view('viaticos/observaciones/tabla_observaciones3');
	}


	public function listado_observaciones(){
		$this->load->view('viaticos/observaciones/listado_observaciones');
	}

	public function cnt_notificaciones(){
		$this->load->view('viaticos/observaciones/cnt_notificaciones');
	}

	public function cambiar_estado_solicitud(){		
		$data = array(
		'id_mision' => $this->input->post('id_mision'), 
		'estado' => $this->input->post('estado')
		);
		echo $this->observaciones_model->cambiar_estado_solicitud($data);
	}

	public function pagar_solicitud(){	
		
		$data = array(
			'id_mision' => $this->input->post('id_mision'), 
			'id_pago' => $this->input->post('id_pago'),
			'fecha_pago' => $this->input->post('fecha_pago'),
			'tipo_pago' => $this->input->post('tipo_pago'),
			'num_cheque' => $this->input->post('num_cheque')
		);
		echo $this->observaciones_model->pagar_solicitud($data);
	}

	public function eliminar_observacion(){
		$data = array(
		'id_observacion' => $this->input->post('id_observacion')
		);
		echo $this->observaciones_model->eliminar_observacion($data);
	}

	public function otra_observacion(){		
		$data = array(
		'id_mision' => $this->input->post('id_mision'), 
		'observacion' => $this->input->post('observacion'),
		'nr_observador' => $this->input->post('nr_observador'),
		'id_tipo_observador' => $this->input->post('id_tipo_observador'),
		'tipo_observador' => $this->input->post('tipo_observador')
		);
		echo $this->observaciones_model->otra_observacion($data);
	}

	function verificar_observaciones(){
		$id_mision = $this->input->post('id_mision');
		if($this->observaciones_model->verificar_observaciones($id_mision)){
			echo "observaciones";
		}else{
			echo "aprobar";
		}
	}
}
?>