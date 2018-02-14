<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class pasaje extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('Pasaje_model');
	}

	public function index(){
		$this->load->view('templates/header');
		$this->load->view('viaticos/Pasaje');
		$this->load->view('templates/footer');
	}

	public function tabla_pasajes(){
		$this->load->view('viaticos/tabla_pasajes');
	}



	
	public function tabla_pasaje_unidad(){
		$this->load->view('viaticos/viaticos_ajax/tabla_pasajes');
	}

	public function gestionar_pasaje(){		

		if($this->input->post('band') == "save"){

			$data = array(

			'fecha_mision' => date("Y-m-d",strtotime($this->input->post('fecha'))),
			'fecha_mision' => $this->input->post('fecha'), 
			'expediente' => $this->input->post('expediente'),
			'empresa' => $this->input->post('empresa'),
			'direccion' => $this->input->post('direccion'),
			'nr' => $this->input->post('nr'),
			
			'monto' => $this->input->post('monto')
			);
		echo $this->Pasaje_model->insertar_pasaje($data);
			
		} else if($this->input->post('band') == "edit"){
			$data = array(
			'idb' => $this->input->post('idb'), 
			'fecha_mision' => date("Y-m-d",strtotime($this->input->post('fecha'))),
			//'fecha_mision' => $this->input->post('fecha'), 
			'expediente' => $this->input->post('expediente'),
			'empresa' => $this->input->post('empresa'),
			'direccion' => $this->input->post('direccion'),
			'nr' => $this->input->post('nr'),
			
			'monto' => $this->input->post('monto')

			);
			echo $this->Pasaje_model->editar_pasaje($data);

		}else if($this->input->post('band') == "delete"){

			$data = array(
			'idb' => $this->input->post('idb')
			);
			echo $this->Pasaje_model->eliminar_pasaje($data);

		}
	}
		
}
?>