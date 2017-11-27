<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rutas extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('rutas_model');
	}

	public function index()
	{
		$this->load->view('templates/header');
		$this->load->view('configuraciones/rutas');
		$this->load->view('templates/footer');
	}

	public function tabla_rutas(){
		$ruta['rutas']=$this->rutas_model->mostrar_ruta();
		$this->load->view('configuraciones/tabla_rutas',$ruta);
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
			'id_vyp_rutas' => $this->input->post('id_vyp_rutas'), 
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
			
				echo $this->rutas_model->editar_ruta($data);
			

		}else if($this->input->post('band') == "delete"){

			$data = array(
			'id_vyp_rutas' => $this->input->post('id_vyp_rutas')
			);
			echo $this->rutas_model->eliminar_ruta($data);

		}
	}
	
}
?>