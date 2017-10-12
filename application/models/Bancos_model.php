<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bancos_model extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function insertar_banco($data){
		$idb = $this->obtener_ultimo_id("cvr_bancos","id_banco");
		if($this->db->insert('cvr_bancos', array('id_banco' => $idb, 'nombre' => $data['nombre'], 'caracteristicas' => $data['caracteristicas']))){
			return "exito";
		}else{
			return "fracaso";
		}
	}

	function mostrar_banco(){
		$query = $this->db->get("cvr_bancos");
		if($query->num_rows() > 0) return $query;
		else return false;
	}

	function editar_banco($data){
		$this->db->where("id_banco",$data["idb"]);
		if($this->db->update('cvr_bancos', array('nombre' => $data['nombre'], 'caracteristicas' => $data['caracteristicas']))){
			return "exito";
		}else{
			return "fracaso";
		}
	}

	function eliminar_banco($data){
		if($this->db->delete("cvr_bancos",array('id_banco' => $data['idb']))){
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
<<<<<<< HEAD


=======
>>>>>>> b43513c6d4c2c32f0aa46783060799e2b075e0cb
}