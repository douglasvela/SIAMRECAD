<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Emergencias extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('pagos_model');		
	}

	public function index(){
		$this->load->view('templates/header');
		$this->load->view('pagos/emergencias');
		$this->load->view('templates/footer');
	}

	public function tabla_emergencias(){
		$this->load->view('pagos/ajax_pagos/tabla_emergencias');
	}


	public function gestionar_pago_emergencia(){	

		if($this->input->post('band') == "save"){

			$data = array(
				'nr' => $this->input->post('nr'), 
				'fecha_mision_inicio' => date("Y-m-d",strtotime($this->input->post('fecha_mision_inicio'))),
				'fecha_mision_fin' => date("Y-m-d",strtotime($this->input->post('fecha_mision_fin'))),
				'id_actividad' => $this->input->post('id_actividad'),
				'tipo_pago' => $this->input->post('tipo_pago'),
				'monto' => $this->input->post('monto'),
				'num_cheque' => $this->input->post('num_cheque'),
				'fecha_pago' => date("Y-m-d",strtotime($this->input->post('fecha_pago'))),
				'estado' => 0
			);
			echo $this->pagos_model->insertar_pago_emergencia($data);
			
		}else if($this->input->post('band') == "edit"){
			$data = array(
				'id_pago_emergencia' => $this->input->post('id_pago_emergencia'),
				'nr' => $this->input->post('nr'), 
				'fecha_mision_inicio' => date("Y-m-d",strtotime($this->input->post('fecha_mision_inicio'))),
				'fecha_mision_fin' => date("Y-m-d",strtotime($this->input->post('fecha_mision_fin'))),
				'id_actividad' => $this->input->post('id_actividad'),
				'tipo_pago' => $this->input->post('tipo_pago'),
				'monto' => $this->input->post('monto'),
				'num_cheque' => $this->input->post('num_cheque'),
				'fecha_pago' => date("Y-m-d",strtotime($this->input->post('fecha_pago')))
			);
			echo $this->pagos_model->editar_pago_emergencia($data);

		}else if($this->input->post('band') == "delete"){

			$data = array(
			'id_pago_emergencia' => $this->input->post('id_pago_emergencia')
			);
			echo $this->pagos_model->eliminar_pago_emergencia($data);

		}
	}
}
?>