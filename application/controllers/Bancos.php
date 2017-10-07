<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class bancos extends CI_Controller {

	function __construct(){
		parent::__construct();
		/************ Librerias para llamar funciones predefenidas **********/
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('funciones_rapidas');
		$this->load->model('bancos_model');
	}

	public function index(){
		$var["bancos"] = $this->bancos_model->mostrar_banco();
		$var["notificacion"] = "nada";
		$this->vista_banco($var);
	}

	public function vista_banco($var){
		$this->load->view('templates/header');
		$this->load->view('configuraciones/bancos',$var);
		$this->load->view('templates/footer');
	}

	public function gestionar_bancos(){
		/************ Notificación a mostrar *****************/
		$var["notificacion"] = "nada";

		if($this->input->post('band') == "save"){
			$data = array(
			'nombre' => $this->input->post('nombre'), 
			'caracteristicas' => $this->input->post('caracteristicas')
			);
			$this->bancos_model->insertar_banco($data);
			$var["notificacion"] = "Banco: '".$this->input->post('nombre')."' registrado exitosamente.";
		}else if($this->input->post('band') == "edit"){
			$data = array(
			'idb' => $this->input->post('idb'), 
			'nombre' => $this->input->post('nombre'), 
			'caracteristicas' => $this->input->post('caracteristicas')

			);
			$this->bancos_model->editar_banco($data);
			$var["notificacion"] = "Banco: '".$this->input->post('nombre')."' modificado exitosamente.";

		}else if($this->input->post('band') == "delete"){

			$data = array(
			'idb' => $this->input->post('idb')
			);
			$this->bancos_model->eliminar_banco($data);
			$var["notificacion"] = "Banco: '".$this->input->post('nombre')."' eliminado exitosamente.";

		}
		$var["bancos"] = $this->bancos_model->mostrar_banco();
		$this->vista_banco($var);
	}
}
?>