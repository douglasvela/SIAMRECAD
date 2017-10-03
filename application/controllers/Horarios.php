<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Horarios extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('url');
	}

	public function index()
	{
		$this->load->view('templates/header');
		$this->load->view('configuraciones/horarios');
		$this->load->view('templates/footer');
	}
}
?>