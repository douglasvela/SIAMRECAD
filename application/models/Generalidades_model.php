<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Generalidades_model extends CI_Model {
	
	function __construct(){
		parent::__construct();
	}

	function insertar_generalidad($data){
		$id_generalidad = $this->obtener_ultimo_id("vyp_generalidades","id_generalidad");
		if($this->db->insert('vyp_generalidades', array('id_generalidad' => $id_generalidad, 'pasaje' => $data['pasaje'], 'alojamiento' => $data['alojamiento'], 'id_banco' => $data['id_banco'], 'banco' => $data['banco'], 'num_cuenta' => $data['num_cuenta'], 'limite_poliza' => $data['limite_poliza'], 'codigo_presupuestario' => $data['codigo_presupuestario']))){
			return "exito";
		}else{
			return "fracaso";
		}
	}

	function editar_generalidad($data){
		$this->db->where("id_generalidad",$data["id_generalidad"]);
		if($this->db->update('vyp_generalidades', array('pasaje' => $data['pasaje'], 'alojamiento' => $data['alojamiento'], 'id_banco' => $data['id_banco'], 'banco' => $data['banco'], 'num_cuenta' => $data['num_cuenta'], 'limite_poliza' => $data['limite_poliza'], 'codigo_presupuestario' => $data['codigo_presupuestario']))){
			return "exito";
		}else{
			return "fracaso";
		}
	}

	function eliminar_generalidad($data){
		if($this->db->delete("vyp_generalidades",array('id_generalidad' => $data['id_generalidad']))){
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