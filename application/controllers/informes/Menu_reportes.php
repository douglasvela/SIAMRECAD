<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_reportes extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('bancos_model');
	}

	public function index(){
		$this->load->view('templates/header');
		$this->load->view('informes/menu_reportes');
		$this->load->view('templates/footer');
	}

	public function tabla_bancos(){
		$this->load->view('configuraciones/tabla_bancos');
	}
	function mostrarRerporte(){
		$this->load->view('informes/valuos_urbano');
	}

	public function gestionar_bancos(){		

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
	}
}
?>