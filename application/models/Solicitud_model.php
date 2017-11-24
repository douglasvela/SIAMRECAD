<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Solicitud_model extends CI_Model {
	
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function insertar_horario($data){
		$id = $this->obtener_ultimo_id("vyp_horario_viatico","id_horario_viatico");
		if($this->db->insert('vyp_horario_viatico', array('id_horario_viatico' => $id, 'descripcion' => $data['descripcion'], 'hora_inicio' => $data['hora_inicio'], 'hora_fin' => $data['hora_fin'], 'monto' => $data['monto']))){
			return "exito";
		}else{
			return "fracaso";
		}
	}

	function calcular_viaticos($data){
		$query = $this->db->query("SELECT * FROM vyp_horario_viatico WHERE (hora_inicio <= '".$data['hora_inicio']."' AND hora_fin >= '".$data['hora_inicio']."') OR (hora_inicio >= '".$data['hora_inicio']."' AND hora_fin <= '".$data['hora_fin']."') OR (hora_inicio <= '".$data['hora_fin']."' AND hora_fin >= '".$data['hora_fin']."')");
		if($query->num_rows() > 0) return $query;
		else return false;
	}

	function mostrar_horario(){
		$query = $this->db->get("vyp_horario_viatico");
		if($query->num_rows() > 0) return $query;
		else return false;
	}

	function editar_horario($data){
		$this->db->where("id_horario_viatico",$data["idhorario"]);
		if($this->db->update('vyp_horario_viatico', array('descripcion' => $data['descripcion'], 'hora_inicio' => $data['hora_inicio'], 'hora_fin' => $data['hora_fin'], 'monto' => $data['monto']))){
			return "exito";
		}else{
			return "fracaso";
		}
	}

	function eliminar_horario($data){
		if($this->db->delete("vyp_horario_viatico",array('id_horario_viatico' => $data['idhorario']))){
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