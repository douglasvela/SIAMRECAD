<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bancos_model extends CI_Model {
	
	function __construct(){
		parent::__construct();
	}

	function insertar_banco($data){
		$idb = $this->obtener_ultimo_id("vyp_bancos","id_banco");
		if($this->db->insert('vyp_bancos', array('id_banco' => $idb, 'nombre' => $data['nombre'], 'caracteristicas' => $data['caracteristicas'], 'codigo_a' => $data['codigo_a'], 'codigo_b' => $data['codigo_b'], 'delimitador' => $data['delimitador']))){
			return "exito";
		}else{
			return "fracaso";
		}
	}

	function insertar_columna($data){

		$orden = $this->obtener_ultima_ruta('vyp_estructura_planilla','orden',$data['id_banco']);

		if($this->db->insert('vyp_estructura_planilla', array('id_banco' => $data['id_banco'], 'nombre_campo' => $data['nombre_campo'], 'valor_campo' => $data['valor_campo'], 'orden' => $orden))){
			return "exito";
		}else{
			return "fracaso";
		}
	}

	function mostrar_banco(){
		$query = $this->db->get("vyp_bancos");
		if($query->num_rows() > 0) return $query;
		else return false;
	}

	function editar_banco($data){
		$this->db->where("id_banco",$data["idb"]);
		if($this->db->update('vyp_bancos', array('nombre' => $data['nombre'], 'caracteristicas' => $data['caracteristicas'], 'codigo_a' => $data['codigo_a'], 'codigo_b' => $data['codigo_b'], 'delimitador' => $data['delimitador']))){
			return "exito";
		}else{
			return "fracaso";
		}
	}

	function cambiar_orden($data){
		if($this->db->query("UPDATE vyp_estructura_planilla SET orden = '".$data['orden']."' WHERE id_banco = '".$data['id_banco']."' AND orden = '".$data['orden_nuevo']."'") && $this->db->query("UPDATE vyp_estructura_planilla SET orden = '".$data['orden_nuevo']."' WHERE id_estructura = '".$data['id_columna']."'")){
			return "exito";
		}else{
			return "fracaso";
		}
	}

	function eliminar_banco($data){
		if($this->db->delete("vyp_bancos",array('id_banco' => $data['idb']))){
			return "exito";
		}else{
			return "fracaso";
		}
	}

	function eliminar_columna($data){
		if($this->db->delete("vyp_estructura_planilla" ,array('id_estructura' => $data['id_estructura']))){
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

	function obtener_ultima_ruta($tabla,$nombreid,$id_banco){
		$query = $this->db->query("SELECT ".$nombreid." FROM ".$tabla." WHERE id_banco = '".$id_banco."' ORDER BY ".$nombreid." ASC");
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