<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pagos_model extends CI_Model {
	
	function __construct(){
		parent::__construct();
	}

	function insertar_pago_emergencia($data){
		$id = $this->obtener_ultimo_id("vyp_pago_emergencia","id_pago_emergencia");

		if($this->db->insert('vyp_pago_emergencia', array('id_pago_emergencia' => $id, 'nr' => $data['nr'], 'fecha_mision_inicio' => $data['fecha_mision_inicio'], 'fecha_mision_fin' => $data['fecha_mision_fin'], 'id_actividad' => $data['id_actividad'], 'monto' => $data['monto'], 'num_cheque' => $data['num_cheque'], 'fecha_pago' => $data['fecha_pago'], 'tipo_pago' => $data['tipo_pago'], 'estado' => $data['estado']))){
			return "exito";
		}else{
			return "fracaso";
		}
	}

	function editar_pago_emergencia($data){
		$this->db->where("id_pago_emergencia",$data["id_pago_emergencia"]);

		if($this->db->update('vyp_pago_emergencia',  array('nr' => $data['nr'], 'fecha_mision_inicio' => $data['fecha_mision_inicio'], 'fecha_mision_fin' => $data['fecha_mision_fin'], 'id_actividad' => $data['id_actividad'], 'monto' => $data['monto'], 'num_cheque' => $data['num_cheque'], 'fecha_pago' => $data['fecha_pago'], 'tipo_pago' => $data['tipo_pago']))){
			return "exito";
		}else{
			return "fracaso";
		}
	}

	function eliminar_pago_emergencia($data){
		if($this->db->delete("vyp_pago_emergencia",array('id_pago_emergencia' => $data["id_pago_emergencia"]))){
			return "exito";
		}else{
			return "fracaso";
		}
	}

	function cambiar_estado_pago_emergencia($data){
		$this->db->where("id_pago_emergencia",$data["id_pago_emergencia"]);

		if($this->db->update('vyp_pago_emergencia',  array('estado' => 0))){
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