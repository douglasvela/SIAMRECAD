<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tablarutas extends CI_Controller {

	function __construct(){
		parent::__construct();
		/************ Librerias para llamar funciones predefenidas **********/
		$this->load->helper(array('url','form','funciones_rapidas'));		
		$this->load->model('rutas_model');
	}

	public function index(){
		$ruta['rutas']=$this->rutas_model->mostrar_ruta();
		$this->load->view('configuraciones/tabla_rutas',$ruta);
	}
}
?>