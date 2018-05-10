<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Lista_pasaje_model extends CI_Model {
	
	function __construct(){
		parent::__construct();
	}


	function insertar_pasaje($data){
		$idb = $this->obtener_ultimo_id("vyp_pasajes","id_solicitud_pasaje");
		$estado = false;
		if($this->db->insert('vyp_pasajes', array('id_solicitud_pasaje'=> $idb, 'id_municipio' => $data['municipio'],'id_departamento' => $data['departamento'],  'fecha_mision' => $data['fecha_mision'], 'no_expediente' => $data['expediente'], 'empresa_visitada' => $data['empresa'], 'direccion_empresa' => $data['direccion'], 'nr' => $data['nr1'], 'monto_pasaje' => $data['monto'],' id_actividad_realizada' => $data['id_actividad_realizada'], 'estado' => $estado )))
		{
			return "exito";
		}else{
			return "fracaso";
		}
	}



/*function insertar_pasaje1($data){
		//$fecha_actual = date("Y-m-d H:i:s");
		$idb = $this->obtener_ultimo_id("vyp_mision_pasajes","id_mision_pasajes");
		$estado = true;
		
	if($this->db->insert('vyp_mision_pasajes', array('id_mision_pasajes'=> $idb, 'nr1' => $data['nr'], 'nombre_empleado' => $data['nombre_empleado'], 'nr_jefe_inmediato' => $data['jefe_inmediato'], 'nr_jefe_regional' => $data['jefe_regional'], 'estado' => $data['estado'], 'mes_pasaje' => $data['mes'], 'anio_pasaje' => $data['anio'])))
		{
			return "exito";
		}else{
			return "fracaso";
		}
	}
*/
	function insertar_pasaje2($data){
		$idb = $this->obtener_ultimo_id("vyp_pasajes","id_solicitud_pasaje");
		$estado = true;
		if($this->db->insert('vyp_pasajes', array('id_solicitud_pasaje'=> $idb, 'id_municipio' => $data['municipio'],'id_departamento' => $data['departamento'],  'fecha_mision' => $data['fecha_mision'], 'no_expediente' => $data['expediente'], 'empresa_visitada' => $data['empresa'], 'direccion_empresa' => $data['direccion'], 'nr' => $data['nr'], 'monto_pasaje' => $data['monto'], 'id_actividad_realizada' => $data['id_actividad_realizada'],'estado' => $estado )))
		{
			return "exito";
		}else{
			return "fracaso";
		}
	}

function editar_pasaje($data){
		$this->db->where("id_solicitud_pasaje",$data["id_pasaje"]);
		if($this->db->update('vyp_pasajes', array('id_municipio' => $data['municipio'],'id_departamento' => $data['departamento'],'fecha_mision' => $data['fecha_mision'], 'no_expediente' => $data['expediente'], 'empresa_visitada' => $data['empresa'], 'direccion_empresa' => $data['direccion'],  'monto_pasaje' => $data['monto'], 'id_actividad_realizada' => $data['id_actividad_realizada'] ))) {
			return "exito";
		}else{
			return "fracaso";
		}
	}
function eliminar_pasaje($data){
		if($this->db->delete("vyp_pasajes",array('id_solicitud_pasaje' => $data['id_pasaje']))){
			return "exito";
		}else{
			return "fracaso";
		}
	}
	function obtener_id_municipio($municipio){
		$query = $this->db->query("SELECT * FROM org_municipio WHERE municipio = '".$municipio."'");
		if($query->num_rows() > 0){
			foreach ($query->result() as $fila) {
				$ultimoid = $fila->id_municipio; 
			}
		}else{
			$ultimoid = "fracaso";
		}
		return $ultimoid;
	}

	function obtener_id_departamento($municipio){
		$query = $this->db->query("SELECT * FROM org_municipio WHERE id_municipio = '".$municipio."'");
		if($query->num_rows() > 0){
			foreach ($query->result() as $fila) {
				$ultimoid = $fila->id_departamento_pais; 
			}
		}else{
			$ultimoid = "fracaso";
		}
		return $ultimoid;
	}

	function obtener_id_municipio1($municipio){
		$query = $this->db->query("SELECT * FROM org_municipio WHERE municipio = '".$municipio."'");
		if($query->num_rows() > 0){
			foreach ($query->result() as $fila) {
				$ultimoid = $fila->id_municipio; 
			}
		}else{
			$ultimoid = "fracaso";
		}
		return $ultimoid;
	}

	function obtener_id_departamento1($municipio){
		$query = $this->db->query("SELECT * FROM org_municipio WHERE id_municipio = '".$municipio."'");
		if($query->num_rows() > 0){
			foreach ($query->result() as $fila) {
				$ultimoid = $fila->id_departamento_pais; 
			}
		}else{
			$ultimoid = "fracaso";
		}
		return $ultimoid;
	}


function obtener_id_municipio2($municipio){
		$query = $this->db->query("SELECT * FROM org_municipio WHERE municipio = '".$municipio."'");
		if($query->num_rows() > 0){
			foreach ($query->result() as $fila) {
				$ultimoid = $fila->id_municipio; 
			}
		}else{
			$ultimoid = "fracaso";
		}
		return $ultimoid;
	}

	function obtener_id_departamento2($municipio){
		$query = $this->db->query("SELECT * FROM org_municipio WHERE id_municipio = '".$municipio."'");
		if($query->num_rows() > 0){
			foreach ($query->result() as $fila) {
				$ultimoid = $fila->id_departamento_pais; 
			}
		}else{
			$ultimoid = "fracaso";
		}
		return $ultimoid;
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