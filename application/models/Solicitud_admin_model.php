<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Solicitud_admin_model extends CI_Model {
	
	function __construct(){
		parent::__construct();
	}
	
	function crear_solicitud($data){
		if($this->db->insert('vyp_mision_oficial', $data)){
			return "exito,".$this->db->insert_id();
		}else{
			return "fracaso";
		}
	}

}