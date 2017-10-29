<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Oficina_phone_model extends CI_Model {
	
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function insertar_oficina_phone($data){
		
		if($this->db->insert('vyp_oficinas_telefono', array('telefono_vyp_oficnas_telefono' => $data['telefono_vyp_oficnas_telefono'], 'id_oficina_vyp_oficnas_telefono' => $data['id_oficina_vyp_oficnas_telefono']))){
			return "exito";
		}else{
			return "fracaso";
		}
	}

	function mostrar_oficina_phone(){
		$query = $this->db->get("vyp_oficinas_telefono");
		if($query->num_rows() > 0) return $query;
		else return false;
	}

	function editar_oficina_phone($data){
		$this->db->where("id_vyp_oficinas_telefono",$data["id_vyp_oficinas_telefono"]);
		if($this->db->update('vyp_oficinas_telefono', array('telefono_vyp_oficnas_telefono' => $data['telefono_vyp_oficnas_telefono']))){
			return "exito";
		}else{
			return "fracaso";
		}
	}

	function eliminar_oficina_phone($data){
		if($this->db->delete("vyp_oficinas_telefono",array('id_vyp_oficinas_telefono' => $data['id_vyp_oficinas_telefono']))){
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