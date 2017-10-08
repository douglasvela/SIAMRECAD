<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Oficinas extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('url');		
		$this->load->helper('form');
		$this->load->helper('funciones_rapidas');
		$this->load->model('oficina_model');
		$this->load->library('form_validation');
	}

	public function index()
	{


		$datos["oficinas"] = $this->oficina_model->mostrar_oficina();
		$datos["notificacion"] = "nada";
		$this->mivista($datos);
		
	}
	public function mivista($datos){
		$this->load->view('templates/header');
		$this->load->view('configuraciones/oficinas',$datos);
		$this->load->view('templates/footer');
	}
	public function gestionar_oficinas(){
		/************ Notificación a mostrar *****************/
		$datos["notificacion"] = "nada";
		
		$this->form_validation->set_rules('nombre_oficina', 'Nombre de Oficina', 'required');
		$this->form_validation->set_rules('direccion_oficina', 'Dirección de Oficina', 'required');
		$this->form_validation->set_rules('latitud_oficina', 'Coordenadas', 'required');
		$this->form_validation->set_rules('longitud_oficina', 'Latitud y Longitud', 'required');
		$this->form_validation->set_message('required', 'El campo %s es requerido');

		if($this->input->post('band') == "save"){
			$data = array(
			'nombre_oficina' => $this->input->post('nombre_oficina'), 
			'direccion_oficina' => $this->input->post('direccion_oficina'),
			'latitud_oficina' => $this->input->post('latitud_oficina'),
			'longitud_oficina' => $this->input->post('longitud_oficina')
			);
			

			if ($this->form_validation->run() == FALSE){
                $datos["notificacion"]="ERROR1";
            }else{
                $this->oficina_model->insertar_oficina($data);
				$datos["notificacion"] = "Oficina: '".$this->input->post('nombre_oficina')."' registrado exitosamente.";
            }
				
		}else if($this->input->post('band') == "edit"){
			$data = array(
			'id_oficina' => $this->input->post('id_oficina'), 
			'nombre_oficina' => $this->input->post('nombre_oficina'), 
			'direccion_oficina' => $this->input->post('direccion_oficina'),
			'latitud_oficina' => $this->input->post('latitud_oficina'),
			'longitud_oficina' => $this->input->post('longitud_oficina')
			);
			if ($this->form_validation->run() == FALSE){
                $datos["notificacion"]="ERROR2";
            }else{
				$this->oficina_model->editar_oficina($data);
				$datos["notificacion"] = "Oficina: '".$this->input->post('nombre_oficina')."' modificado exitosamente.";
			}

		}else if($this->input->post('band') == "delete"){

			$data = array(
			'id_oficina' => $this->input->post('id_oficina')
			);
			$this->oficina_model->eliminar_oficina($data);
			$datos["notificacion"] = "Eliminado exitosamente.";

		}
		$datos["oficinas"] = $this->oficina_model->mostrar_oficina();
		$this->mivista($datos);
	}
}
?>