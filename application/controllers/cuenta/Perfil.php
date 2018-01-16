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

	public function tabla_cuentas(){
		$this->load->view('cuenta/tabla_cuentas');
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

	public function gestionar_cuentas_bancos(){

		if($this->input->post('band') == "save"){

			$data = array(
			'nr' => $this->input->post('nr2'),
			'id_banco' => $this->input->post('id_banco'), 
			'cuenta' => $this->input->post('cuenta')
			);
			echo $this->perfil_model->insertar_cuenta_banco($data);

		}else if($this->input->post('band') == "edit"){

			$data = array(
			'nr' => $this->input->post('nr2'),
			'id_cuenta_banco' => $this->input->post('id_banco'), 
			'id_banco' => $this->input->post('id_banco'), 
			'cuenta' => $this->input->post('cuenta')
			);
			echo $this->perfil_model->editar_cuenta_banco($data);

		}else if($this->input->post('band') == "delete"){

			$data = array(
			'nr' => $this->input->post('nr2'),
			'id_cuenta_banco' => $this->input->post('id_banco')
			);
			echo $this->perfil_model->eliminar_cuenta_banco($data);

		}
	}
}
?>