<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Oficina_model extends CI_Model {
	
	function __construct(){
		parent::__construct();
	}

	function insertar_oficina($data){
		//$id = $this->obtener_ultimo_id("vyp_oficinas","id_oficina");
		$this->db->where("nombre_oficina",$data['nombre_oficina']);
		$this->db->where("direccion_oficina",$data['direccion_oficina']);
		$this->db->where("jefe_oficina",$data['jefe_oficina']);
		$this->db->where("email_oficina",$data['email_oficina']);
		$this->db->where("latitud_oficina",$data['latitud_oficina']);
		$this->db->where("longitud_oficina",$data['longitud_oficina']);
		$this->db->where("id_departamento",$data['id_departamento']);
		$this->db->where("id_municipio",$data['id_municipio']);
		$this->db->where("id_zona",$data['id_zona']);
      	$query = $this->db->get('vyp_oficinas');
		if($query->num_rows() <= 0){
			if($this->db->insert('vyp_oficinas', array('nombre_oficina' => $data['nombre_oficina'], 'direccion_oficina' => $data['direccion_oficina'], 'jefe_oficina' => $data['jefe_oficina'], 'email_oficina' => $data['email_oficina'],'latitud_oficina' => $data['latitud_oficina'], 'longitud_oficina' => $data['longitud_oficina'],'id_departamento' => $data['id_departamento'],'id_municipio' => $data['id_municipio'],'id_zona' => $data['id_zona']))){
				return "exito";
			}else{
				return "fracaso";
			}
		}else{
			return "duplicado";
		}
	}

	function mostrar_oficina(){
		$query = $this->db->get("vyp_oficinas");
		if($query->num_rows() > 0) return $query;
		else return false;
	}

	function editar_oficina($data){
		$this->db->where("id_oficina",$data["id_oficina"]);
		if($this->db->update('vyp_oficinas', array('nombre_oficina' => $data['nombre_oficina'], 'direccion_oficina' => $data['direccion_oficina'],'jefe_oficina' => $data['jefe_oficina'], 'email_oficina' => $data['email_oficina'], 'latitud_oficina' => $data['latitud_oficina'], 'longitud_oficina' => $data['longitud_oficina'],'id_departamento' => $data['id_departamento'],'id_municipio' => $data['id_municipio'],'id_zona' => $data['id_zona']))){
			return "exito";
		}else{
			return "fracaso";
		}
	}

	function eliminar_oficina($data){
		if($this->db->delete("vyp_oficinas",array('id_oficina' => $data['id_oficina']))){
			return "exito";
		}else{
			return "fracaso";
		}
	}

	function insertar_oficina_phone($data){
		
		if($this->db->insert('vyp_oficinas_telefono', array('telefono_vyp_oficnas_telefono' => $data['telefono_vyp_oficnas_telefono'], 'id_oficina_vyp_oficnas_telefono' => $data['id_oficina_vyp_oficnas_telefono']))){
			return "exito";
		}else{
			return "fracaso";
		}
	}

	function mostrar_oficina_phone(){
		$query = $this->db->get("vyp_oficinas_telefono");
		if($query->num_rows() > 0) return $query;
		else return false;
	}

	function editar_oficina_phone($data){
		$this->db->where("id_vyp_oficinas_telefono",$data["id_vyp_oficinas_telefono"]);
		if($this->db->update('vyp_oficinas_telefono', array('telefono_vyp_oficnas_telefono' => $data['telefono_vyp_oficnas_telefono']))){
			return "exito";
		}else{
			return "fracaso";
		}
	}

	function eliminar_oficina_phone($data){
		if($this->db->delete("vyp_oficinas_telefono",array('id_vyp_oficinas_telefono' => $data['id_vyp_oficinas_telefono']))){
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

	function obtenerDepartamento($data){
 		$mun = $data['id_municipio'];
		$query = $this->db->query("SELECT id_departamento_pais FROM org_municipio WHERE id_municipio =  $mun LIMIT 1");
		foreach ($query->result() as $fila) {
			$id = $fila->id_departamento_pais; 
		}
		return $id;
	}
	function obtenerCorreoJefe($data){
 		$jefe_oficina = $data['jefe_oficina'];
		$query = $this->db->query("SELECT correo FROM sir_empleado WHERE id_empleado =  $jefe_oficina LIMIT 1");
		foreach ($query->result() as $fila) {
			$id = $fila->correo; 
		}
		return $id;
	}

	function verificar_informacion_empleado($data){
		$query = $this->db->query("SELECT ie.*, UPPER(CONCAT_WS(' ', e.primer_nombre, e.segundo_nombre, e.tercer_nombre, e.primer_apellido, e.segundo_apellido, e.apellido_casada)) AS nombre_completo FROM vyp_informacion_empleado AS ie JOIN sir_empleado AS e ON ie.id_oficina_departamental = '".$data['id_oficina']."' AND e.nr = ie.nr ORDER BY e.primer_nombre, e.segundo_nombre, e.tercer_nombre, e.primer_apellido, e.segundo_apellido, e.apellido_casada ASC");
		if($query->num_rows() > 0) return $query;
		else return false;
	}

}