<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rutas_model extends CI_Model {
	
	function __construct(){
		parent::__construct();
	}

	function insertar_ruta($data){
		
		if($this->db->insert('vyp_rutas', array('id_oficina_origen_vyp_rutas' => $data['id_oficina_origen_vyp_rutas'], 'id_oficina_destino_vyp_rutas' => $data['id_oficina_destino_vyp_rutas'], 'opcionruta_vyp_rutas' => $data['opcionruta_vyp_rutas'], 'descripcion_destino_vyp_rutas' => $data['descripcion_destino_vyp_rutas'], 'km_vyp_rutas' => $data['km_vyp_rutas'], ' 	id_departamento_vyp_rutas' => $data['id_departamento'], 'id_municipio_vyp_rutas' => $data['id_municipio']))){
			return "exito";
		}else{
			return "fracaso";
		}
	}

	function mostrar_ruta($destino){
		$this->db->where("opcionruta_vyp_rutas",$destino);
		$query = $this->db->get("vyp_rutas");
		if($query->num_rows() > 0) return $query;
		else return false;
	}

	function editar_ruta($data){
		$this->db->where("id_vyp_rutas",$data["id_vyp_rutas"]);
		if($this->db->update('vyp_rutas', array('nombre_vyp_rutas' => $data['nombre_vyp_rutas'], 'descr_origen_vyp_rutas' => $data['descr_origen_vyp_rutas'], 'latitud_origen_vyp_rutas' => $data['latitud_origen_vyp_rutas'], 'longitud_origen_vyp_rutas' => $data['longitud_origen_vyp_rutas'], 'descr_destino_vyp_rutas' => $data['descr_destino_vyp_rutas'], 'latitud_destino_vyp_rutas' => $data['latitud_destino_vyp_rutas'], 'longitud_destino_vyp_rutas' => $data['longitud_destino_vyp_rutas'], 'distancia_km_vyp_rutas' => $data['distancia_km_vyp_rutas'], 'tiempo_vyp_rutas' => $data['tiempo_vyp_rutas']))){
			return "exito";
		}else{
			return "fracaso";
		}
	}

	function eliminar_ruta($data){
		if($this->db->delete("vyp_rutas",array('id_vyp_rutas' => $data['id_vyp_rutas']))){
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
	function obtenerlatitudylongitud($data){
		$datos;
		$origen = $data['id_oficina_origen_vyp_rutas'];
		$query = $this->db->query("SELECT latitud_oficina,longitud_oficina FROM vyp_oficinas WHERE id_oficina = $origen LIMIT 1");
		//$row = $query->row();
		foreach ($query->result() as $fila) {
				$datos = $fila->latitud_oficina.','.$fila->longitud_oficina; 
			}
		return $datos;
	}

}