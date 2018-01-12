<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Observaciones_model extends CI_Model {
	
	function __construct(){
		parent::__construct();
	}

	function otra_observacion($data){
		$idb = $this->obtener_ultimo_id("vyp_observacion_solicitud","id_observacion_solicitud");
		$fecha = date("Y-m-d H:i:s");
		if($this->db->insert('vyp_observacion_solicitud', array('id_observacion_solicitud' => $idb, 'id_mision' => $data['id_mision'], 'observacion' => $data['observacion'], 'fecha_hora' => $fecha, 'corregido' => false))){
			return "exito";
		}else{
			return "fracaso";
		}
	}

	function observar_empresa($data){
		$this->db->where("id_empresas_visitadas",$data["id_empresa"]);
		if($this->db->update('vyp_empresas_visitadas', array('observacion' => $data['observacion']))){
			return "exito";
		}else{
			return "fracaso";
		}
	}

	function eliminar_banco($data){
		if($this->db->delete("vyp_bancos",array('id_banco' => $data['idb']))){
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