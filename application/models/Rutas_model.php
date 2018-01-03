<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rutas_model extends CI_Model {
	
	function __construct(){
		parent::__construct();
	}

	function insertar_ruta($data){
		
		if($this->db->insert('vyp_rutas', array('id_oficina_origen_vyp_rutas' => $data['id_oficina_origen_vyp_rutas'], 'id_oficina_destino_vyp_rutas' => $data['id_oficina_destino_vyp_rutas'], 'opcionruta_vyp_rutas' => $data['opcionruta_vyp_rutas'], 'descripcion_destino_vyp_rutas' => $data['descripcion_destino_vyp_rutas'], 'km_vyp_rutas' => $data['km_vyp_rutas'], ' 	id_departamento_vyp_rutas' => $data['id_departamento'], 'id_municipio_vyp_rutas' => $data['id_municipio'], 'latitud_destino_vyp_rutas' => $data['latitud_destino_vyp_rutas'], 'longitud_destino_vyp_rutas' => $data['longitud_destino_vyp_rutas']))){
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
		if($this->db->update('vyp_rutas', array('id_oficina_origen_vyp_rutas' => $data['id_oficina_origen_vyp_rutas'], 'id_oficina_destino_vyp_rutas' => $data['id_oficina_destino_vyp_rutas'], 'opcionruta_vyp_rutas' => $data['opcionruta_vyp_rutas'], 'descripcion_destino_vyp_rutas' => $data['descripcion_destino_vyp_rutas'], 'km_vyp_rutas' => $data['km_vyp_rutas'], ' 	id_departamento_vyp_rutas' => $data['id_departamento'], 'id_municipio_vyp_rutas' => $data['id_municipio'], 'latitud_destino_vyp_rutas' => $data['latitud_destino_vyp_rutas'], 'longitud_destino_vyp_rutas' => $data['longitud_destino_vyp_rutas']))){
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
	function buscarduplicados($data){
		$band  = "exito";
		$query = $this->db->query("SELECT * FROM vyp_rutas");
		foreach ($query->result() as $fila) {
			if($data['opcionruta_vyp_rutas']=="destino_oficina"){
				if($fila->id_oficina_origen_vyp_rutas == $data['id_oficina_origen_vyp_rutas'] &&
					$fila->id_oficina_destino_vyp_rutas == $data['id_oficina_destino_vyp_rutas'] &&
					$fila->opcionruta_vyp_rutas == $data['opcionruta_vyp_rutas'] && 
					$fila->descripcion_destino_vyp_rutas == $data['descripcion_destino_vyp_rutas'] && 
					$fila->km_vyp_rutas == $data['km_vyp_rutas'] /*&&
					$fila->id_departamento_vyp_rutas == $data['id_departamento'] &&
					$fila->id_municipio_vyp_rutas  == $data['id_municipio'] &&
					$fila->latitud_destino_vyp_rutas == $data['latitud_destino_vyp_rutas'] &&
					$fila->longitud_destino_vyp_rutas == $data['longitud_destino_vyp_rutas']*/
					){
					$band="duplicado";
					return $band;
				}
			}else if($data['opcionruta_vyp_rutas']=="destino_municipio"){
				if($fila->id_oficina_origen_vyp_rutas == $data['id_oficina_origen_vyp_rutas'] &&
					/*$fila->id_oficina_destino_vyp_rutas == $data['id_oficina_destino_vyp_rutas'] &&*/
					$fila->opcionruta_vyp_rutas == $data['opcionruta_vyp_rutas'] && 
					$fila->descripcion_destino_vyp_rutas == $data['descripcion_destino_vyp_rutas'] && 
					$fila->km_vyp_rutas == $data['km_vyp_rutas'] &&
					$fila->id_departamento_vyp_rutas == $data['id_departamento'] &&
					$fila->id_municipio_vyp_rutas  == $data['id_municipio'] /*&&
					$fila->latitud_destino_vyp_rutas == $data['latitud_destino_vyp_rutas'] &&
					$fila->longitud_destino_vyp_rutas == $data['longitud_destino_vyp_rutas']*/
					){
					$band="duplicado";
					return $band;
				}
			}
		}
		return $band;
	}

}