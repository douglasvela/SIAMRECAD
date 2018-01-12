<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Info_personal extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('url');
	}

	public function index()
	{
		$this->load->view('templates/header');
		$this->load->view('info_personal');
		$this->load->view('templates/footer');
	}
}
?>