<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rutas extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper(array('url','form','funciones_rapidas'));
		$this->load->model('rutas_model');
		//$this->load->library('form_validation');
	}

	public function index()
	{
		$this->load->view('templates/header');
		$this->load->view('configuraciones/rutas');
		$this->load->view('templates/footer');
	}

	public function gestionar_rutas(){
	
		if($this->input->post('band') == "save"){
			$data = array(
			'nombre_vyp_rutas' => $this->input->post('nombre_vyp_rutas'), 
			'descr_origen_vyp_rutas' => $this->input->post('descr_origen_vyp_rutas'),
			'latitud_origen_vyp_rutas' => $this->input->post('latitud_origen_vyp_rutas'),
			'longitud_origen_vyp_rutas' => $this->input->post('longitud_origen_vyp_rutas'),
			'descr_destino_vyp_rutas' => $this->input->post('descr_destino_vyp_rutas'),
			'latitud_destino_vyp_rutas' => $this->input->post('latitud_destino_vyp_rutas'),
			'longitud_destino_vyp_rutas' => $this->input->post('longitud_destino_vyp_rutas'),
			'distancia_km_vyp_rutas' => $this->input->post('distancia_km_vyp_rutas'),
			'tiempo_vyp_rutas' => $this->input->post('tiempo_vyp_rutas')
			);
			
                echo $this->rutas_model->insertar_ruta($data);
            
		}else if($this->input->post('band') == "edit"){
			
			$data = array(
			'id_oficina' => $this->input->post('id_oficina'), 
			'nombre_oficina' => $this->input->post('nombre_oficina'), 
			'direccion_oficina' => $this->input->post('direccion_oficina'),
			'jefe_oficina' => $this->input->post('jefe_oficina'),
			'email_oficina' => $this->input->post('email_oficina'),
			'latitud_oficina' => $this->input->post('latitud_oficina'),
			'longitud_oficina' => $this->input->post('longitud_oficina')
			);
			
				echo $this->oficina_model->editar_oficina($data);
			

		}else if($this->input->post('band') == "delete"){

			$data = array(
			'id_oficina' => $this->input->post('id_oficina')
			);
			echo $this->oficina_model->eliminar_oficina($data);

		}
	}
	public function gestionar_oficinas_telefonos(){
		if($this->input->post('band_phone') == "save"){
			$data = array(
			'telefono_vyp_oficnas_telefono' => $this->input->post('telefono_vyp_oficnas_telefono'), 
			'id_oficina_vyp_oficnas_telefono' => $this->input->post('id_oficina_vyp_oficnas_telefono')
			);
            echo $this->oficina_phone_model->insertar_oficina_phone($data);
		}else if($this->input->post('band_phone')=="edit"){
			$data = array(
				'id_vyp_oficinas_telefono' => $this->input->post('id_vyp_oficinas_telefono'),
				'telefono_vyp_oficnas_telefono' => $this->input->post('telefono_vyp_oficnas_telefono')
			);
			echo $this->oficina_phone_model->editar_oficina_phone($data);
		}else if($this->input->post('band_phone') == "delete"){
			$data = array(
			'id_vyp_oficinas_telefono' => $this->input->post('id_vyp_oficinas_telefono')
			);
			echo $this->oficina_phone_model->eliminar_oficina_phone($data);
		}
	}
}
?>