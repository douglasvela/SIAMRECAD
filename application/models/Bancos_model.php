<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bancos_model extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function insertar_banco($data){
		$idb = $this->obtener_ultimo_id("cvr_bancos","id_banco");
		$this->db->insert('cvr_bancos', array('id_banco' => $idb, 'nombre' => $data['nombre'], 'caracteristicas' => $data['caracteristicas']));
	}

	function mostrar_banco(){
		$query = $this->db->get("cvr_bancos");
		if($query->num_rows() > 0) return $query;
		else return false;
	}

	function editar_banco($data){
		$this->db->where("id_banco",$data["idb"]);
		$this->db->update('cvr_bancos', array('nombre' => $data['nombre'], 'caracteristicas' => $data['caracteristicas']));
	}

	function eliminar_banco($data){
		$this->db->delete("cvr_bancos",array('id_banco' => $data['idb']));
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

/*	function mostrar_personal(){
		$query = $this->db->get("tpersonal");
		if($query->num_rows() > 0) return $query;
		else return false;
	}

	function mostrar_personal2(){
        $query = $this->db->query("SELECT p.idpersonal, p.nombre, p.direccion, p.telefono, c.idcargo, c.nombre AS cnombre, z.idzona, z.nombre AS znombre FROM tpersonal p JOIN tcargos c ON p.idcargo = c.idcargo JOIN tzonas z ON z.idzona = p.idzona");
		if($query->num_rows() > 0) return $query;
		else return false;
	}

	function mostrar_cargos(){
		$query = $this->db->get("tcargos");
		if($query->num_rows() > 0) return $query;
		else return false;
	}

	function mostrar_zonas(){
		$query = $this->db->get("tzonas");
		if($query->num_rows() > 0) return $query;
		else return false;
	}*/
}