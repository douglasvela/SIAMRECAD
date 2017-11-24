<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Solicitud extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('solicitud_model');
	}

	public function index(){
		$this->load->view('templates/header');
		$this->load->view('viaticos/solicitud_viatico');
		$this->load->view('templates/footer');
	}

	public function calcular_viaticos(){
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
		echo number_format($suma, 2, '.', '');;
	}

	/*public function gestionar_bancos(){		

		if($this->input->post('band') == "save"){

			$data = array(
			'nombre' => $this->input->post('nombre'), 
			'caracteristicas' => $this->input->post('caracteristicas')
			);
			echo $this->bancos_model->insertar_banco($data);
			
		}else if($this->input->post('band') == "edit"){
			$data = array(
			'idb' => $this->input->post('idb'), 
			'nombre' => $this->input->post('nombre'), 
			'caracteristicas' => $this->input->post('caracteristicas')

			);
			echo $this->bancos_model->editar_banco($data);

		}else if($this->input->post('band') == "delete"){

			$data = array(
			'idb' => $this->input->post('idb')
			);
			echo $this->bancos_model->eliminar_banco($data);

		}
	}*/
}
?>