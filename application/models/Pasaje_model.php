<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pasaje_model extends CI_Model {
	
	function __construct(){
		parent::__construct();
	}

	/*


	
	}*/

	function insertar_pasaje($data){
		$idb = $this->obtener_ultimo_id("vyp_pasajes","id_solicitud_pasaje");
		$estado = true;
		if($this->db->insert('vyp_pasajes', array('id_solicitud_pasaje'=> $idb, 'fecha_mision' => $data['fecha_mision'], 'no_expediente' => $data['expediente'], 'empresa_visitada' => $data['empresa'], 'direccion_empresa' => $data['direccion'], 'nr' => $data['nr'], 'monto_pasaje' => $data['monto'], 'estado' => $estado )))
		{
			//return "exito";
		}else{
			return "fracaso";
		}
	}


function editar_pasaje($data){
		$this->db->where("id_solicitud_pasaje",$data["id_pasaje"]);
		if($this->db->update('vyp_pasajes', array('fecha_mision' => $data['fecha_mision'], 'no_expediente' => $data['expediente'], 'empresa_visitada' => $data['empresa'], 'direccion_empresa' => $data['direccion'],  'monto_pasaje' => $data['monto'] ))){
			return "exito";
		}else{
			return "fracaso";
		}
	}

	function eliminar_pasaje($data){
		if($this->db->delete("vyp_pasajes",array('id_solicitud_pasaje' => $data['id_pasaje']))){
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