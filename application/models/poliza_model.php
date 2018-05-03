<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class poliza_model extends CI_Model {
	
	function __construct(){
		parent::__construct();
	}

	function insertar_poliza($data){
		if($this->db->query($data)){
			return "exito";
		}else{
			return "fracaso";
		}
	}

	function eliminar_poliza($data){
		if($this->db->delete("vyp_poliza",array('no_poliza' => $data))){
			return "exito";
		}else{
			return "fracaso";
		}
	}

	function insertar_pago_poliza($data, $query){
		if($this->db->insert('vyp_pago_poliza', array('sql' => $data['sql'], 'anio' => $data['anio'], 'fecha_pago' => $data['fecha_pago'], 'polizas' => $data['polizas'], 'monto' => $data['monto'])) && $this->db->query($query)){
			return "exito";
		}else{
			return "fracaso";
		}
	}

	function generar_pago($data){
		if($this->db->query($data)){
			return "exito";
		}else{
			return "fracaso";
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