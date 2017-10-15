<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {

	function __construct(){
		parent::__construct();
		/************ Librerias para llamar funciones predefenidas **********/
		$this->load->helper(array('url','form','funciones_rapidas'));
		$this->load->model('usuarios_model');
	}

	public function index(){
		$this->load->view('templates/header');
		$this->load->view('usuarios/usuarios');
		$this->load->view('templates/footer');
	}

	public function gestionar_usuarios(){
		if($this->input->post('estado') == 'on'){
			$estado = 1;
		}else{ $estado = 0; }

		if($this->input->post('band') == "save"){

			$data = array(
			'nr' => $this->input->post('nr'), 
			'nombre' => strtoupper($this->input->post('nombre')." ".$this->input->post('apellido')),
			'id_seccion' => $this->input->post('seccion'),
			'genero' => $this->input->post('genero'),
			'usuario' => $this->input->post('usuario'),
			'password' => md5($this->input->post('password')),
			'estado' => $estado
			);
			echo $this->usuarios_model->insertar_usuario($data);

		}else if($this->input->post('band') == "edit"){

			$data = array(
			'idusuario' => $this->input->post('idusuario'), 
			'nr' => $this->input->post('nr'), 
			'nombre' => strtoupper($this->input->post('nombre')." ".$this->input->post('apellido')),
			'id_seccion' => $this->input->post('seccion'),
			'genero' => $this->input->post('genero'),
			'usuario' => $this->input->post('usuario'),
			'password' => md5($this->input->post('password')),
			'estado' => $estado
			);
			echo $this->usuarios_model->editar_usuario($data);

		}else if($this->input->post('band') == "delete"){

			$data = array(
			'idusuario' => $this->input->post('idusuario')
			);
			echo $this->usuarios_model->eliminar_usuario($data);

		}
	}
}
?>