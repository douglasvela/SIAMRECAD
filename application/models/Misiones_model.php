<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Misiones_model extends CI_Model {
	
	function __construct(){
		parent::__construct();		
	}

	function insertar_mision($data){
		$id = $this->obtener_ultimo_id("vyp_mision_oficial","id_mision_oficial");
		if($this->db->insert('vyp_mision_oficial', array('id_mision_oficial' => $id, 'nr_empleado' => $data['nr'], 'nombre_completo' => $data['nombre_completo'], 'fecha_mision' => $data['fecha_mision'], 'nombre_empresa' => $data['nombre_empresa'], 'direccion_empresa' => $data['direccion_empresa'], 'actividad_realizada' => $data['actividad_realizada']))){
			return "exito";
		}else{
			return "fracaso";
		}
	}

	function mostrar_mision(){
		$query = $this->db->get("vyp_mision_oficial");
		if($query->num_rows() > 0) return $query;
		else return false;
	}

	function editar_mision($data){
		$this->db->where("id_mision_oficial",$data["id_mision"]);
		if($this->db->update('vyp_mision_oficial', array('fecha_mision' => $data['fecha_mision'], 'nombre_empresa' => $data['nombre_empresa'], 'direccion_empresa' => $data['direccion_empresa'], 'actividad_realizada' => $data['actividad_realizada']))){
			return "exito";
		}else{
			return "fracaso";
		}
	}

	function eliminar_mision($data){
		if($this->db->delete("vyp_mision_oficial",array('id_mision_oficial' => $data['id_mision']))){
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