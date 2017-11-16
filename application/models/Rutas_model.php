<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rutas_model extends CI_Model {
	
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function insertar_ruta($data){
		
		if($this->db->insert('vyp_rutas', array('nombre_vyp_rutas' => $data['nombre_vyp_rutas'], 'descr_origen_vyp_rutas' => $data['descr_origen_vyp_rutas'], 'latitud_origen_vyp_rutas' => $data['latitud_origen_vyp_rutas'], 'longitud_origen_vyp_rutas' => $data['longitud_origen_vyp_rutas'], 'descr_destino_vyp_rutas' => $data['descr_destino_vyp_rutas'], 'latitud_destino_vyp_rutas' => $data['latitud_destino_vyp_rutas'], 'longitud_destino_vyp_rutas' => $data['longitud_destino_vyp_rutas'], 'distancia_km_vyp_rutas' => $data['distancia_km_vyp_rutas'], 'tiempo_vyp_rutas' => $data['tiempo_vyp_rutas']))){
			return "exito";
		}else{
			return "fracaso";
		}
	}

	function mostrar_ruta(){
		$query = $this->db->get("vyp_rutas");
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