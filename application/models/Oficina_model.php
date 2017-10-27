<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Oficina_model extends CI_Model {
	
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function insertar_oficina($data){
		//$id = $this->obtener_ultimo_id("vyp_oficinas","id_oficina");
		if($this->db->insert('vyp_oficinas', array('nombre_oficina' => $data['nombre_oficina'], 'direccion_oficina' => $data['direccion_oficina'], 'latitud_oficina' => $data['latitud_oficina'], 'longitud_oficina' => $data['longitud_oficina']))){
			return "exito";
		}else{
			return "fracaso";
		}
	}

	function mostrar_oficina(){
		$query = $this->db->get("vyp_oficinas");
		if($query->num_rows() > 0) return $query;
		else return false;
	}

	function editar_oficina($data){
		$this->db->where("id_oficina",$data["id_oficina"]);
		if($this->db->update('vyp_oficinas', array('nombre_oficina' => $data['nombre_oficina'], 'direccion_oficina' => $data['direccion_oficina'], 'latitud_oficina' => $data['latitud_oficina'], 'longitud_oficina' => $data['longitud_oficina']))){
			return "exito";
		}else{
			return "fracaso";
		}
	}

	function eliminar_oficina($data){
		if($this->db->delete("vyp_oficinas",array('id_oficina' => $data['id_oficina']))){
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