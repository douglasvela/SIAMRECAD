<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Lista_pasaje extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('Lista_pasaje_model');
		$this->load->library('FPDF/fpdf');
	}
	public function index(){
		$this->load->view('templates/header');
		$this->load->view('pasajes/Lista_pasaje');
		$this->load->view('templates/footer');
	}
	
	public function tabla_pasaje_lista(){
		$this->load->view('pasajes/viaticos_ajax/Lista_pasaje_ajax');
	}
	public function imprimir_solicitud(){
		$this->load->view('pasajes/viaticos_ajax/imprimir_solicitud_pasaje');
	}

	public function gestionar_pasaje2(){		
		if($this->input->post('band2') == "save"){
			$data = array(
				'municipio' => $this->input->post('municipio'),
			'departamento' => $this->input->post('departamento'),
			
			'fecha_mision' => date("Y-m-d",strtotime($this->input->post('fecha'))),
			'expediente' => $this->input->post('expediente'),
			'empresa' => $this->input->post('empresa'),
			'direccion' => $this->input->post('direccion'),
			
			'nr1' => $this->input->post('nr1'),
			
			
			'monto' => $this->input->post('monto')
			);
		echo $this->Lista_pasaje_model->insertar_pasaje($data);
			
		} 
	}



public function combo_oficinas_departamentos(){
		$this->load->view('pasajes/viaticos_ajax/combo_oficinas_departamentos');
	}

	public function combo_municipios(){
		$this->load->view('pasajes/viaticos_ajax/combo_municipio');
	}

	

	public function obtener_id_municipio(){
		echo $this->Lista_pasaje_model->obtener_id_municipio($_POST['id_municipio']);
	}

	public function obtener_id_departamento(){
		echo $this->Lista_pasaje_model->obtener_id_departamento($_POST['id_municipio']);
	}
	
		
}
?>