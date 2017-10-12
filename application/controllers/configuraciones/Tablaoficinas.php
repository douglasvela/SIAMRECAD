<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tablaoficinas extends CI_Controller {

	function __construct(){
		parent::__construct();
		/************ Librerias para llamar funciones predefenidas **********/
		$this->load->helper(array('url','form','funciones_rapidas'));
		$this->load->model('horarios_model');
	}

	public function index(){
		$this->load->view('configuraciones/tabla_oficinas');
	}
}
?>