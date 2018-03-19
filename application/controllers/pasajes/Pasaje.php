<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pasaje extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('Pasaje_model');
	}
	public function index(){
		$this->load->view('templates/header');
		$this->load->view('pasajes/Pasaje');
		$this->load->view('templates/footer');
	}
	public function tabla_pasajes(){
		$this->load->view('pasajes/tabla_pasajes');
	}
	
	public function tabla_pasaje_unidad(){
		$this->load->view('pasajes/viaticos_ajax/tabla_pasajes');
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


public function gestionar_pasaje_fecha(){		
		
			$data = array(
			'nr' => $this->input->post('nr'),
			'nombre_empleado' => $this->input->post('nombre_emple'),
			'jefe_inmediato' => $this->input->post('jefe_inmediato'),
			'jefe_regional' => $this->input->post('jefe_regional'),
			'estado' => '1',
			'mes' =>$this->input->post('mes'),
			'anio' => $this->input->post('anio')
			);
		echo $this->Pasaje_model->insertar_mision_pasaje($data);
			
		 
	}





	public function info_pasajes(){
		$this->load->view('pasajes/viaticos_ajax/info_pasajes');
	}
	/*public function gestionar_mision_pasajes(){
		if($this->input->post('band') == "save"){
			$data = array(
			'nr' => $this->input->post('nr'),
			'nr_jefe_inmediato' => $this->input->post('nr_jefe_inmediato'),
			'nr_jefe_regional' => $this->input->post('nr_jefe_regional'),
			'nombre_empleado' => $this->input->post('nombre_completo'),
			'mes_pasaje' => date("Y-m-d",strtotime($this->input->post('mes_pasaje'))),
			'anio_pasaje' => date("Y-m-d",strtotime($this->input->post('anio_pasaje'))),
			
			);
			
			$resultado = $this->pasaje_model->insertar_mision_pasajes($data);
		
	}*/
		
}
?>