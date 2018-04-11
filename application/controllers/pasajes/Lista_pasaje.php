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


	public function gestionar_pasaje(){		
		if($this->input->post('band') == "save"){
			$data = array(
			'fecha_mision' => date("Y-m-d",strtotime($this->input->post('fecha'))),
			'expediente' => $this->input->post('expediente'),
			'empresa' => $this->input->post('empresa'),
			'direccion' => $this->input->post('direccion'),
			'nr' => $this->input->post('nr'),
			
			'monto' => $this->input->post('monto')
			);
		echo $this->Pasaje_model->insertar_pasaje($data);
			
		} else if($this->input->post('band') == "edit"){
			$data = array(
			'id_pasaje' => $this->input->post('id_pasaje'), 
			'fecha_mision' => date("Y-m-d",strtotime($this->input->post('fecha'))),
			'expediente' => $this->input->post('expediente'),
			'empresa' => $this->input->post('empresa'),
			'direccion' => $this->input->post('direccion'),
			'monto' => $this->input->post('monto')
			);
			echo $this->Pasaje_model->editar_pasaje($data);
		}else if($this->input->post('band') == "delete"){
			$data = array(
			'id_pasaje' => $this->input->post('id_pasaje')
			);
			echo $this->Pasaje_model->eliminar_pasaje($data);
		}
	}
public function gestionar_pasaje3(){		
		if($this->input->post('band') == "save"){
			$data = array(
			'municipio' => $this->input->post('municipio'),
			'departamento' => $this->input->post('departamento'),
			
			'fecha_mision' => date("Y-m-d",strtotime($this->input->post('fecha'))),
			'expediente' => $this->input->post('expediente'),
			'empresa' => $this->input->post('empresa'),
			'direccion' => $this->input->post('direccion'),
			
			'nr' => $this->input->post('nr'),
			
			
			'monto' => $this->input->post('monto')
			);
		echo $this->Lista_pasaje_model->insertar_pasaje2($data);
			
		} else if($this->input->post('band') == "edit"){
			$data = array(
			'id_pasaje' => $this->input->post('id_pasaje'), 
			'departamento' => $this->input->post('departamento'),
			'municipio' => $this->input->post('municipio'),
			'fecha_mision' => date("Y-m-d",strtotime($this->input->post('fecha'))),
			
			
			'expediente' => $this->input->post('expediente'),
			
			'empresa' => $this->input->post('empresa'),
			'direccion' => $this->input->post('direccion'),
			'monto' => $this->input->post('monto')
			);
			echo $this->Lista_pasaje_model->editar_pasaje($data);

		}else if($this->input->post('band') == "delete"){
			$data = array(
			'id_pasaje' => $this->input->post('id_pasaje')
			);
			echo $this->Lista_pasaje_model->eliminar_pasaje($data);
		}
	}


public function combo_oficinas_departamentos(){
		$this->load->view('pasajes/viaticos_ajax/combo_oficinas_departamentos');
	}

	public function combo_municipios(){
		$this->load->view('pasajes/viaticos_ajax/combo_municipio');
	}
public function combo_oficinas_departamentos1(){
		$this->load->view('pasajes/viaticos_ajax/combo_oficinas_departamentos1');
	}

	public function combo_municipios1(){
		$this->load->view('pasajes/viaticos_ajax/combo_municipio1');
	}
	

	public function obtener_id_municipio(){
		echo $this->Lista_pasaje_model->obtener_id_municipio($_POST['id_municipio']);
	}

	public function obtener_id_departamento(){
		echo $this->Lista_pasaje_model->obtener_id_departamento($_POST['id_municipio']);
	}
	public function obtener_id_municipio1(){
		echo $this->Lista_pasaje_model->obtener_id_municipio1($_POST['id_municipio']);
	}

	public function obtener_id_departamento1(){
		echo $this->Lista_pasaje_model->obtener_id_departamento1($_POST['id_municipio']);
	}


	public function combo_oficinas_departamentos2(){
		$this->load->view('pasajes/viaticos_ajax/combo_oficinas_departamentos2');
	}

	public function combo_municipios2(){
		$this->load->view('pasajes/viaticos_ajax/combo_municipio2');
	}
	
		public function obtener_id_municipio2(){
		echo $this->Lista_pasaje_model->obtener_id_municipio2($_POST['id_municipio']);
	}

	public function obtener_id_departamento2(){
		echo $this->Lista_pasaje_model->obtener_id_departamento2($_POST['id_municipio']);
	}

	
	
		
}
?>