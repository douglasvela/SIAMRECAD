<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('inicio_model');
	}

	public function index()
	{
		$data['solicitudes_en_revision'] = $this->inicio_model->obtener_solicitudes_en_revision();
		$data['solicitudes_observadas'] = $this->inicio_model->obtener_solicitudes_observadas();
		$data['solicitudes_pagadas'] = $this->inicio_model->obtener_solicitudes_pagadas();

		$data['pasajes_en_revision'] = $this->inicio_model->obtener_pasajes_en_revision();
		$data['pasajes_observados'] = $this->inicio_model->obtener_pasajes_observados();
		$data['pasajes_pagados'] = $this->inicio_model->obtener_pasajes_pagados();

		$data['tiene_permiso_autorizar'] = $this->inicio_model->tiene_permiso_autorizar();
		if($data['tiene_permiso_autorizar']){
			$data['solicitudes_para_autorizar'] = $this->inicio_model->obtener_solicitudes_para_autorizar();
			$data['pasajes_para_autorizar'] = $this->inicio_model->obtener_pasajes_para_autorizar();
		}
		$this->load->view('templates/header');
		$this->load->view('inicio', $data);
		$this->load->view('templates/footer');
	}
}
?>