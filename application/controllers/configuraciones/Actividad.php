<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Actividad extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('actividad_model');
	}

	public function index($id_modulo)
	{
		$data['id_modulo']=$id_modulo;
		$this->load->view('templates/header');
		$this->load->view('configuraciones/actividad',$data);
		$this->load->view('templates/footer');
	}
	public function mostrarComboMunicipi($id)
	{
		$objeto = explode("x", $id);
		$nuevo['id_departamento']=$objeto[0];
		$nuevo['id_municipio']=$objeto[1];

		$this->load->view('configuraciones/comboMunicipio',$nuevo);
	}


	public function mostrarActividad($id){
		$nuevo['depende_vyp_actividades']=$id;
		$this->load->view('configuraciones/combo_actividad',$nuevo);
	}

	public function tabla_actividad($id_modulo){
		$data['id_modulo']=$id_modulo;
		$this->load->view('configuraciones/tabla_actividad',$data);
	}

	public function gestionar_actividad(){

		if($this->input->post('band') == "save"){
			$data = array(
			'nombre_vyp_actividades' => $this->input->post('nombre_vyp_actividades'),
			'depende_vyp_actividades' => $this->input->post('depende_vyp_actividades'),
			);
      echo $this->actividad_model->insertar_actividad($data);

		}else if($this->input->post('band') == "edit"){
      $data = array(
      'id_vyp_actividades' => $this->input->post('id_vyp_actividades'),
      'nombre_vyp_actividades' => $this->input->post('nombre_vyp_actividades'),
			'depende_vyp_actividades' => $this->input->post('depende_vyp_actividades'),
			);
			echo $this->actividad_model->editar_actividad($data);
		}else if($this->input->post('band') == "delete"){

			$data = array(
			'id_vyp_actividades' => $this->input->post('id_vyp_actividades')
			);
			echo $this->actividad_model->eliminar_actividad($data);

		}
	}
	function buscar_permiso($data){
		
	}

}
?>
