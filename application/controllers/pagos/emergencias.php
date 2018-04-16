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

	public function tabla_planillas(){
		$this->load->view('pagos/ajax_pagos/tabla_planillas');
	}

	public function tabla_poliza_pago(){
		$this->load->view('pagos/ajax_pagos/tabla_poliza_pago');
	}

	public function imprimir_poliza(){
		$this->load->view('pagos/ajax_pagos/imprimir_poliza');
	}

	function editar_poliza(){
		$data = array(
			'sql' => $this->input->post('sql'), 
			'no_poliza' => $this->input->post('no_poliza'),
			'anio' => $this->input->post('anio')
		);

		echo $this->poliza_pago_model->editar_poliza($data);
	}

	function eliminar_poliza(){
		echo $this->poliza_pago_model->eliminar_poliza($this->input->post('no_poliza'));
	}

	/*public function calcular_viaticos(){
		$data = array(
			'hora_inicio' => $this->input->post('hora_inicio'), 
			'hora_fin' => $this->input->post('hora_fin')
		);
		$res = $this->solicitud_model->calcular_viaticos($data);
		$suma = 0;
		if($res->num_rows() > 0){
			foreach ($res->result() as $fila) {
				$suma += $fila->monto; 
			}
		}

		echo number_format($suma, 2, '.', '');
	}*/

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
				'estado' => 1
			);
			echo $this->pagos_model->insertar_pago_emergencia($data);
			
		}else if($this->input->post('band') == "edit"){
			$data = array(
				'nr' => $this->input->post('nr'), 
				'fecha_mision_inicio' => $this->input->post('fecha_mision_inicio'),
				'fecha_mision_fin' => $this->input->post('fecha_mision_fin'),
				'id_actividad' => $this->input->post('id_actividad'),
				'tipo_pago' => $this->input->post('tipo_pago'),
				'monto' => $this->input->post('monto'),
				'num_cheque' => $this->input->post('num_cheque'),
				'fecha_pago' => $this->input->post('fecha_pago')
			);
			echo $this->pagos_model->editar_pago_emergencia($data);

		}else if($this->input->post('band') == "delete"){

			$data = array(
			'idb' => $this->input->post('idb')
			);
			echo $this->pagos_model->eliminar_pago_emergencia($data);

		}
	}
}
?>