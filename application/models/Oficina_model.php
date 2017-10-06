<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Oficina_model extends CI_Model {
	
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function insertar_oficina($data){
		//$id = $this->obtener_ultimo_id("cvr_oficinas","id_oficina");
		$this->db->insert('cvr_oficinas', array('nombre_oficina' => $data['nombre_oficina'], 'direccion_oficina' => $data['direccion_oficina'], 'coordenada_oficina' => $data['coordenada_oficina']));
	}

	function mostrar_oficina(){
		$query = $this->db->get("cvr_oficinas");
		if($query->num_rows() > 0) return $query;
		else return false;
	}

	function editar_horario($data){
		$this->db->where("id_oficina",$data["id_oficina"]);
		$this->db->update('cvr_oficinas', array('nombre_oficina' => $data['nombre_oficina'], 'direccion_oficina' => $data['direccion_oficina'], 'coordenada_oficina' => $data['coordenada_oficina']));
	}

	function eliminar_horario($data){
		$this->db->delete("cvr_oficinas",array('id_oficina' => $data['id_oficina']));
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