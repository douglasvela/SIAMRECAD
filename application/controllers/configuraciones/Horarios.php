<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Horarios extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('horarios_model');
	}

	public function index(){
		$this->load->view('templates/header');
		$this->load->view('configuraciones/horarios');
		$this->load->view('templates/footer');
	}

	public function tabla_horarios(){
		$this->load->view('configuraciones/horarios_ajax/tabla_horarios');
	}

	public function combo_viatico_hora(){
		$this->load->view('configuraciones/horarios_ajax/combo_viatico_hora');
	}

	public function gestionar_horarios(){

		if($this->input->post('band') == "save"){

			$data = array(
			'descripcion' => $this->input->post('descripcion'), 
			'hora_inicio' => date("Y-m-d ").$this->input->post('hora_inicio'),
			'hora_fin' => date("Y-m-d ").$this->input->post('hora_fin'),
			'monto' => number_format($this->input->post('monto'),2),
			'id_tipo' => $this->input->post('id_tipo'),
			'id_categoria' => $this->input->post('id_categoria'),
			'estado' => $this->input->post('estado')
			);
			echo $this->horarios_model->insertar_horario($data);

		}else if($this->input->post('band') == "edit"){

			$data = array(
			'idhorario' => $this->input->post('idhorario'), 
			'descripcion' => $this->input->post('descripcion'), 
			'hora_inicio' => date("Y-m-d ").$this->input->post('hora_inicio'),
			'hora_fin' => date("Y-m-d ").$this->input->post('hora_fin'),
			'monto' => number_format($this->input->post('monto'),2),
			'id_tipo' => $this->input->post('id_tipo'),
			'id_categoria' => $this->input->post('id_categoria'),
			'estado' => $this->input->post('estado')
			);
			echo $this->horarios_model->editar_horario($data);

		}else if($this->input->post('band') == "delete"){
			$data = array(
			'idhorario' => $this->input->post('idhorario'),
			'id_categoria' => $this->input->post('id_categoria'),
			'estado' => $this->input->post('estado')
			);
			echo $this->horarios_model->eliminar_horario($data);

		}
	}
}
?>