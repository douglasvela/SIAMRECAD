<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Generalidades extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('generalidades_model');
	}

	public function index(){
		$this->load->view('templates/header');
		$this->load->view('configuraciones/generalidades');
		$this->load->view('templates/footer');
	}

	public function tabla_generalidades(){
		$this->load->view('configuraciones/tabla_generalidades');
	}

	public function gestionar_generalidades(){		

		if($this->input->post('band') == "save"){

			$data = array(
			'pasaje' => $this->input->post('pasaje'), 
			'alojamiento' => $this->input->post('alojamiento')
			);
			echo $this->generalidades_model->insertar_generalidad($data);
			
		}else if($this->input->post('band') == "edit"){
			$data = array(
			'id_generalidad' => $this->input->post('id_generalidad'), 
			'pasaje' => $this->input->post('pasaje'), 
			'alojamiento' => $this->input->post('alojamiento')

			);
			echo $this->generalidades_model->editar_generalidad($data);

		}else if($this->input->post('band') == "delete"){

			$data = array(
			'id_generalidad' => $this->input->post('id_generalidad')
			);
			echo $this->generalidades_model->eliminar_generalidad($data);

		}
	}
}
?>