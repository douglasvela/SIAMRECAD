<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio_model extends CI_Model {

	function __construct(){
		parent::__construct();
	}

	public function obtener_solicitudes_en_revision(){
		$nr = $this->session->userdata('nr_usuario_viatico');
		$query=$this->db->query("SELECT count(*) AS cantidad FROM vyp_mision_oficial WHERE nr_empleado = '".$nr."' AND estado IN(1,3,5)");
		return $query->first_row()->cantidad;

	}

	public function obtener_solicitudes_observadas(){
		$nr = $this->session->userdata('nr_usuario_viatico');
		$query=$this->db->query("SELECT count(*) AS cantidad FROM vyp_mision_oficial WHERE nr_empleado = '".$nr."' AND estado IN(2,4,6)");
		return $query->first_row()->cantidad;

	}

	public function obtener_solicitudes_pagadas(){
		$nr = $this->session->userdata('nr_usuario_viatico');
		$query=$this->db->query("SELECT count(*) AS cantidad FROM vyp_mision_oficial WHERE nr_empleado = '".$nr."' AND estado = 8");
		return $query->first_row()->cantidad;
	}

	public function obtener_solicitudes_para_autorizar(){
		$nr = $this->session->userdata('nr_usuario_viatico');
		$query=$this->db->query("SELECT count(*) AS cantidad FROM vyp_mision_oficial WHERE (nr_jefe_inmediato = '".$nr."' AND estado = 1) OR (nr_jefe_regional = '".$nr."' AND estado = 3)");
		return $query->first_row()->cantidad;

	}

	public function obtener_pasajes_en_revision(){
		$nr = $this->session->userdata('nr_usuario_viatico');
		$query=$this->db->query("SELECT count(*) AS cantidad FROM vyp_mision_pasajes WHERE nr = '".$nr."' AND estado IN(1,3,5)");
		return $query->first_row()->cantidad;

	}

	public function obtener_pasajes_observados(){
		$nr = $this->session->userdata('nr_usuario_viatico');
		$query=$this->db->query("SELECT count(*) AS cantidad FROM vyp_mision_pasajes WHERE nr = '".$nr."' AND estado IN(2,4,6)");
		return $query->first_row()->cantidad;

	}

	public function obtener_pasajes_pagados(){
		$nr = $this->session->userdata('nr_usuario_viatico');
		$query=$this->db->query("SELECT count(*) AS cantidad FROM vyp_mision_pasajes WHERE nr = '".$nr."' AND estado = 8");
		return $query->first_row()->cantidad;

	}

	public function obtener_pasajes_para_autorizar(){
		$nr = $this->session->userdata('nr_usuario_viatico');
		$query=$this->db->query("SELECT count(*) AS cantidad FROM vyp_mision_pasajes WHERE (nr_jefe_inmediato = '".$nr."' AND estado = 1) OR (nr_jefe_regional = '".$nr."' AND estado = 3)");
		return $query->first_row()->cantidad;

	}

	public function tiene_permiso_autorizar(){
		$nr = $this->session->userdata('nr_usuario_viatico');
		$query=$this->db->query("SELECT count(*) AS cantidad FROM vyp_informacion_empleado WHERE nr_jefe_inmediato = '".$nr."' OR nr_jefe_departamento = '".$nr."'");
		if($query->first_row()->cantidad > 0){
			return true;
		}else{
			return false;
		}
	}


}
