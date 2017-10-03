<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Viaticos extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('url');
	}

	public function index()
	{
		$this->load->view('templates/header');
		$this->load->view('solicitud_viaticos');
		$this->load->view('templates/footer');
	}
}
?>
