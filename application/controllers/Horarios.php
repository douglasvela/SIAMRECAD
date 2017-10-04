<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Horarios extends CI_Controller {

	function __construct(){
		parent::__construct();
		/************ Librerias para llamar funciones predefenidas **********/
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('funciones_rapidas');
		$this->load->model('horarios_model');
	}

	public function index(){
		$var["horarios"] = $this->horarios_model->mostrar_horario();
		$var["notificacion"] = "nada";
		$this->vista_horario($var);
	}

	public function vista_horario($var){
		$this->load->view('templates/header');
		$this->load->view('configuraciones/horarios',$var);
		$this->load->view('templates/footer');
	}

	public function gestionar_horarios(){
		/************ Notificación a mostrar *****************/
		$var["notificacion"] = "nada";

		if($this->input->post('band') == "save"){
			$data = array(
			'descripcion' => $this->input->post('descripcion'), 
			'hora_inicio' => date("Y-m-d ").$this->input->post('hora_inicio'),
			'hora_fin' => date("Y-m-d ").$this->input->post('hora_fin')
			);
			$this->horarios_model->insertar_horario($data);
			$var["notificacion"] = "<strong>Éxito!</strong> Viático: '".$this->input->post('descripcion')."' registrado exitosamente.";
		}else if($this->input->post('band') == "edit"){
			$data = array(
			'idhorario' => $this->input->post('idhorario'), 
			'descripcion' => $this->input->post('descripcion'), 
			'hora_inicio' => date("Y-m-d ").$this->input->post('hora_inicio'),
			'hora_fin' => date("Y-m-d ").$this->input->post('hora_fin')
			);
			$this->horarios_model->editar_horario($data);
			$var["notificacion"] = "<strong>Éxito!</strong> Viático: '".$this->input->post('descripcion')."' modificado exitosamente.";

		}else if($this->input->post('band') == "delete"){

			$data = array(
			'idhorario' => $this->input->post('idhorario')
			);
			$this->horarios_model->eliminar_horario($data);
			$var["notificacion"] = "<strong>Éxito!</strong> Viático: '".$this->input->post('descripcion')."' eliminado exitosamente.";

		}
		$var["horarios"] = $this->horarios_model->mostrar_horario();
		$this->vista_horario($var);
	}
}
?>