<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Horarios_model extends CI_Model {
	
	function __construct(){
		parent::__construct();		
	}

	function insertar_horario($data){
		$id = $this->obtener_ultimo_id("vyp_horario_viatico","id_horario_viatico");
		if($this->db->insert('vyp_horario_viatico', array('id_horario_viatico' => $id, 'descripcion' => $data['descripcion'], 'hora_inicio' => $data['hora_inicio'], 'hora_fin' => $data['hora_fin'], 'monto' => $data['monto'], 'id_tipo' => $data['id_tipo'], 'id_restriccion' => $data['id_categoria'], 'estado' => $data['estado']))){
			return "exito";
		}else{
			return "fracaso";
		}
	}

	function mostrar_horario(){
		$query = $this->db->get("vyp_horario_viatico");
		if($query->num_rows() > 0) return $query;
		else return false;
	}

	function editar_horario($data){
		$this->db->where("id_horario_viatico",$data["idhorario"]);
		if($this->db->update('vyp_horario_viatico', array('descripcion' => $data['descripcion'], 'hora_inicio' => $data['hora_inicio'], 'hora_fin' => $data['hora_fin'], 'monto' => $data['monto'], 'id_tipo' => $data['id_tipo'], 'id_restriccion' => $data['id_categoria']))){
			return "exito";
		}else{
			return "fracaso";
		}
	}

	function eliminar_horario($data){
		$this->db->where("id_horario_viatico",$data["idhorario"]);
		if($this->db->update('vyp_horario_viatico', array('estado' => $data['estado']))){
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