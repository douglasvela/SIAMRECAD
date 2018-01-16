<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perfil_model extends CI_Model {
	
	function __construct(){
		parent::__construct();
	}

	function insertar_info_personal($data){
		$info_empleado = $this->db->query("SELECT * FROM vyp_informacion_empleado WHERE nr = '".$data['nr']."'");

		if($info_empleado->num_rows() > 0){
			$this->db->where("nr",$data["nr"]);
			if($this->db->update('vyp_informacion_empleado', array('nr_jefe_inmediato' => $data['id_empleado'], 'id_oficina_departamental' => $data['id_oficina'], 'id_region' => $data['id_region']))){
				return "exito";
			}else{
				return "fracaso";
			}
		}else{
			if($this->db->insert('vyp_informacion_empleado', array('nr' => $data['nr'], 'nr_jefe_inmediato' => $data['id_empleado'], 'id_oficina_departamental' => $data['id_oficina'], 'id_region' => $data['id_region']))){
				return "exito";
			}else{
				return "fracaso";
			}
		}
		
	}

	function insertar_cuenta_banco($data){
		$info_empleado = $this->db->query("SELECT * FROM vyp_empleado_cuenta_banco WHERE nr = '".$data['nr']."'");

		if($info_empleado->num_rows() > 0){
			$estado = false;
		}else{
			$estado = true;
		}

		if($this->db->insert('vyp_empleado_cuenta_banco', array('nr' => $data['nr'], 'id_banco' => $data['id_banco'], 'numero_cuenta' => $data['cuenta'], 'estado' => $estado))){
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
		if($this->db->update('vyp_bancos', array('nombre' => $data['nombre'], 'caracteristicas' => $data['caracteristicas']))){
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