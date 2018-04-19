<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bancos_model extends CI_Model {
	
	function __construct(){
		parent::__construct();
	}

	function insertar_banco($data){
		$idb = $this->obtener_ultimo_id("vyp_bancos","id_banco");
		if($this->db->insert('vyp_bancos', array('id_banco' => $idb, 'nombre' => $data['nombre'], 'caracteristicas' => $data['caracteristicas'], 'codigo' => $data['codigo']))){
			return "exito";
		}else{
			return "fracaso";
		}
	}

	function insertar_columna($data){
		if($this->db->insert('vyp_estructura_planilla', array('id_banco' => $data['id_banco'], 'nombre_campo' => $data['nombre_campo'], 'valor_campo' => $data['valor_campo']))){
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
		if($this->db->update('vyp_bancos', array('nombre' => $data['nombre'], 'caracteristicas' => $data['caracteristicas'], 'codigo' => $data['codigo']))){
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

}