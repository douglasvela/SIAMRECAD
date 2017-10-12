<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class bancos extends CI_Controller {

	function __construct(){
		parent::__construct();
		/************ Librerias para llamar funciones predefenidas **********/
		$this->load->helper(array('url','form','funciones_rapidas'));
		$this->load->model('bancos_model');
	}

	public function index(){
		$this->load->view('templates/header');
		$this->load->view('configuraciones/bancos');
		$this->load->view('templates/footer');
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