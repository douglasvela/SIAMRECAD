<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Estructura extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('url');
	}

	public function index()
	{
		$this->load->view('templates/header');
		$this->load->view('templates/estructura');
		$this->load->view('templates/footer');
	}
}
?>