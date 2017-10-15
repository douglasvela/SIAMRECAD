<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios_model extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function insertar_usuario($data){
		$id = $this->obtener_ultimo_id("org_usuario","id_usuario");
		if($this->db->insert('org_usuario', array('id_usuario' => $id, 'nombre_completo' => $data['nombre'], 'nr' => $data['nr'], 'sexo' => $data['genero'], 'usuario' => $data['usuario'], 'password' => $data['password'], 'id_seccion' => $data['id_seccion'], 'estado' => $data['estado']))){
			return "exito";
		}else{
			return "fracaso";
		}
	}

	function mostrar_horario(){
		$query = $this->db->get("cvr_horario_viatico");
		if($query->num_rows() > 0) return $query;
		else return false;
	}

	function editar_horario($data){
		$this->db->where("id_usuario",$data["idusuario"]);
		if($this->db->update('org_usuario', array('nombre_completo' => $data['nombre'], 'nr' => $data['nr'], 'sexo' => $data['genero'], 'usuario' => $data['usuario'], 'id_seccion' => $data['id_seccion'], 'estado' => $data['estado']))){
			return "exito";
		}else{
			return "fracaso";
		}
	}

	function eliminar_horario($data){
		if($this->db->delete("org_usuario",array('id_usuario' => $data['idusuario']))){
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