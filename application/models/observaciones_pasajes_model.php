<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Observaciones_pasajes_model extends CI_Model {
	
	function __construct(){
		parent::__construct();
	}
function verificar_observaciones($data){
		$query = $this->db->query("SELECT * FROM vyp_observacion_pasajes WHERE id_solicitud_pasaje = '".$data."' AND corregido = 0");
		if($query->num_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
	
	function obtener_ultimo_id($tabla,$nombreid){
		$this->db->order_by($nombreid, "asc");
		$query = $this->db->get($tabla);
		$ultimoid = 0;
		if($query->num_rows() > 0){
			foreach ($query->result() as $fila) {
				$ultimoid = $fila->$nombreid; 
			}
			$ultimoid++;
		}else{
			$ultimoid = 1;
		}
		return $ultimoid;
	}

}