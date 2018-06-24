<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rutas extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('rutas_model');
	}

	public function index(){
		$this->load->view('templates/header');
		$this->load->view('configuraciones/rutas');
		$this->load->view('templates/footer');
	}

	public function tabla_rutas($destino){
		$ruta['rutas']=$this->rutas_model->mostrar_ruta($destino);
		$ruta['tipo_destino']=$destino;
		$this->load->view('configuraciones/rutas_ajax/tabla_rutas',$ruta);
	}
	public function obtener_origen(){
		$data = array(
			'id_oficina_origen_vyp_rutas' => $this->input->post('id_oficina_origen_vyp_rutas')
			);
		echo $this->rutas_model->obtenerlatitudylongitud($data);
	}
	public function gestionar_rutas(){

		if($this->input->post('band') == "save"){
			$data = array(
			'opcionruta_vyp_rutas' => $this->input->post('opcionruta_vyp_rutas'),
			'id_oficina_destino_vyp_rutas' => $this->input->post('id_oficina_destino_vyp_rutas'),
			'id_oficina_origen_vyp_rutas' => $this->input->post('id_oficina_origen_vyp_rutas'),
			'descripcion_destino_vyp_rutas' => $this->input->post('descripcion_destino_vyp_rutas'),
			'km_vyp_rutas' => $this->input->post('km_vyp_rutas'),
			'id_departamento' => $this->input->post('id_departamento'),
			'id_municipio' => $this->input->post('id_municipio'),
			'latitud_destino_vyp_rutas' => $this->input->post('latitud_destino_vyp_rutas'),
			'longitud_destino_vyp_rutas' => $this->input->post('longitud_destino_vyp_rutas'),
			'nombre_empresa_vyp_rutas' => $this->input->post('nombre_empresa_vyp_rutas'),
			'direccion_empresa_vyp_rutas' => $this->input->post('direccion_empresa_vyp_rutas')
			);
			if($this->input->post('id_oficina_destino_vyp_rutas') == $this->input->post('id_oficina_origen_vyp_rutas') ){
				echo "fracaso";
			}else{
				if($this->rutas_model->buscarduplicados($data)=="duplicado"){
					echo "duplicado";
				}else{
                	echo $this->rutas_model->insertar_ruta($data);
            	}
            }
		}else if($this->input->post('band') == "edit"){

			$data = array(
				'id_vyp_rutas'  => $this->input->post('id_vyp_rutas'),
			'opcionruta_vyp_rutas' => $this->input->post('opcionruta_vyp_rutas'),
			'id_oficina_destino_vyp_rutas' => $this->input->post('id_oficina_destino_vyp_rutas'),
			'id_oficina_origen_vyp_rutas' => $this->input->post('id_oficina_origen_vyp_rutas'),
			'descripcion_destino_vyp_rutas' => $this->input->post('descripcion_destino_vyp_rutas'),
			'km_vyp_rutas' => $this->input->post('km_vyp_rutas'),
			'id_departamento' => $this->input->post('id_departamento'),
			'id_municipio' => $this->input->post('id_municipio'),
			'latitud_destino_vyp_rutas' => $this->input->post('latitud_destino_vyp_rutas'),
			'longitud_destino_vyp_rutas' => $this->input->post('longitud_destino_vyp_rutas'),
			'nombre_empresa_vyp_rutas' => $this->input->post('nombre_empresa_vyp_rutas'),
			'direccion_empresa_vyp_rutas' => $this->input->post('direccion_empresa_vyp_rutas')
			);
			if($this->input->post('id_oficina_destino_vyp_rutas') == $this->input->post('id_oficina_origen_vyp_rutas') ){
				echo "fracaso";
			}else{
				echo $this->rutas_model->editar_ruta($data);
			}

		}else if($this->input->post('band') == "delete"){
			$data = array(
			'id_vyp_rutas' => $this->input->post('id_vyp_rutas')
			);
			echo $this->rutas_model->eliminar_ruta($data);
		}
	}

}
?>
