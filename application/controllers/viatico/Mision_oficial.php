<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mision_oficial extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('misiones_model');
	}

	public function index(){
		$this->load->view('templates/header');
		$this->load->view('viaticos/mision_oficial');
		$this->load->view('templates/footer');
	}

	public function tabla_misiones(){
		$this->load->view('viaticos/tabla_mision_oficial');
	}

	public function gestionar_mision(){		
		if($this->input->post('band') == "save"){

			$data = array(
			'nr' => $this->input->post('nr'),
			'nombre_completo' => $this->input->post('nombre_empleado'),
			'fecha_mision' => date("Y-m-d",strtotime($this->input->post('fecha_mision'))),
			'nombre_empresa' => $this->input->post('nombre_empresa'),
			'direccion_empresa' => $this->input->post('direccion_empresa'),
			'actividad_realizada' => saltos_sql($this->input->post('actividad'))
			);
			echo $this->misiones_model->insertar_mision($data);
			
		}else if($this->input->post('band') == "edit"){
			$data = array(
			'id_mision' => $this->input->post('id_mision'), 
			'nr' => $this->input->post('nr'),
			'nombre_completo' => $this->input->post('nombre_empleado'),
			'fecha_mision' => date("Y-m-d",strtotime($this->input->post('fecha_mision'))),
			'nombre_empresa' => $this->input->post('nombre_empresa'),
			'direccion_empresa' => $this->input->post('direccion_empresa'),
			'actividad_realizada' => saltos_sql($this->input->post('actividad'))
			);
			echo $this->misiones_model->editar_mision($data);

		}else if($this->input->post('band') == "delete"){

			$data = array(
			'id_mision' => $this->input->post('id_mision')
			);
			echo $this->misiones_model->eliminar_mision($data);
		}
	}

	
}
?>