<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Oficina_model extends CI_Model {
	
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function insertar_horario($data){
		$id = $this->obtener_ultimo_id("cvr_horario_viatico","id_horario_viatico");
		$this->db->insert('cvr_horario_viatico', array('id_horario_viatico' => $id, 'descripcion' => $data['descripcion'], 'hora_inicio' => $data['hora_inicio'], 'hora_fin' => $data['hora_fin']));
	}

	function mostrar_oficina(){
		$query = $this->db->get("cvr_oficinas");
		if($query->num_rows() > 0) return $query;
		else return false;
	}

	function editar_horario($data){
		$this->db->where("id_horario_viatico",$data["idhorario"]);
		$this->db->update('cvr_horario_viatico', array('descripcion' => $data['descripcion'], 'hora_inicio' => $data['hora_inicio'], 'hora_fin' => $data['hora_fin']));
	}

	function eliminar_horario($data){
		$this->db->delete("cvr_horario_viatico",array('id_horario_viatico' => $data['idhorario']));
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