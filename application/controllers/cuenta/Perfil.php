<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perfil extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('perfil_model');
	}

	public function index(){
		$this->load->view('templates/header');
		$this->load->view('cuenta/perfil');
		$this->load->view('templates/footer');
	}

	public function tabla_horarios(){
		$this->load->view('cuenta/formulario');
	}

	public function info_empleado(){
		$data = array(
			'nr' => $this->input->post('nr'), 
			'id_empleado' => $this->input->post('id_empleado'),
			'id_oficina' => $this->input->post('id_oficina'),
			'id_region' => $this->input->post('id_region')
		);
		echo $this->perfil_model->insertar_info_personal($data);
	}

	/*public function gestionar_horarios(){

		if($this->input->post('band') == "save"){

			$data = array(
			'descripcion' => $this->input->post('descripcion'), 
			'hora_inicio' => date("Y-m-d ").$this->input->post('hora_inicio'),
			'hora_fin' => date("Y-m-d ").$this->input->post('hora_fin'),
			'monto' => number_format($this->input->post('monto'),2)
			);
			echo $this->horarios_model->insertar_horario($data);

		}else if($this->input->post('band') == "edit"){

			$data = array(
			'idhorario' => $this->input->post('idhorario'), 
			'descripcion' => $this->input->post('descripcion'), 
			'hora_inicio' => date("Y-m-d ").$this->input->post('hora_inicio'),
			'hora_fin' => date("Y-m-d ").$this->input->post('hora_fin'),
			'monto' => number_format($this->input->post('monto'),2)
			);
			echo $this->horarios_model->editar_horario($data);

		}else if($this->input->post('band') == "delete"){

			$data = array(
			'idhorario' => $this->input->post('idhorario')
			);
			echo $this->horarios_model->eliminar_horario($data);

		}
	}*/
}
?>