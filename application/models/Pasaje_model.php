<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pasaje_model extends CI_Model {
	
	function __construct(){
		parent::__construct();
	}
	/*
	
	}*/
	function insertar_pasaje($data){
		$idb = $this->obtener_ultimo_id("vyp_pasajes","id_solicitud_pasaje");
		$estado = true;
		if($this->db->insert('vyp_pasajes', array('id_solicitud_pasaje'=> $idb, 'fecha_mision' => $data['fecha_mision'], 'no_expediente' => $data['expediente'], 'empresa_visitada' => $data['empresa'], 'direccion_empresa' => $data['direccion'], 'nr' => $data['nr'], 'monto_pasaje' => $data['monto'], 'estado' => $estado )))
		{
			return "exito";
		}else{
			return "fracaso";
		}
	}

	function insertar_mision_pasaje($data){
$fecha_actual = date("Y-m-d H:i:s");
//$id_pasaje;
		$idb = $this->obtener_ultimo_id("vyp_mision_pasajes","id_mision_pasajes");
		$query = $this->db->query("SELECT * FROM vyp_mision_pasajes");
		if($query->num_rows() > 0){
			foreach ($query->result() as $fila) {
				$id_pasaje = $fila->id_mision_pasajes; 
			}
		}

		//$estado = true;
		if($id_pasaje != $data['id'])
			{
	if($this->db->insert('vyp_mision_pasajes', array('id_mision_pasajes'=> $idb, 'nr' => $data['nr'], 'nombre_empleado' => $data['nombre_empleado'], 'nr_jefe_inmediato' => $data['jefe_inmediato'], 'nr_jefe_regional' => $data['jefe_regional'], 'estado' => $data['estado'], 'mes_pasaje' => $data['mes'], 'anio_pasaje' => $data['anio'], 'fecha_solicitud_pasaje' => $fecha_actual, 'fechas_pasajes' => $data['fechas_pasaje'])))
		{
			return "exito";
		}else{
			return "fracaso";
		}
		}
		else { 
			$this->db->where("id_mision_pasajes",$data['id']);
		if($this->db->update('vyp_mision_pasajes', array('nr' => $data['nr'], 'nombre_empleado' => $data['nombre_empleado'], 'nr_jefe_inmediato' => $data['jefe_inmediato'], 'nr_jefe_regional' => $data['jefe_regional'], 'mes_pasaje' => $data['mes'], 'anio_pasaje' => $data['anio'], 'fecha_solicitud_pasaje' => $fecha_actual, 'fechas_pasajes' => $data['fechas_pasaje'])))
		{
			return "exito";
		}else{
			return "fracaso";
		}

		}
	}
function editar_pasaje($data){
		$this->db->where("id_solicitud_pasaje",$data["id_pasaje"]);
		if($this->db->update('vyp_pasajes', array('fecha_mision' => $data['fecha_mision'], 'no_expediente' => $data['expediente'], 'empresa_visitada' => $data['empresa'], 'direccion_empresa' => $data['direccion'],  'monto_pasaje' => $data['monto'] ))){
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
	

function obtener_ultima_mision($tabla,$nombreid,$nr){
		$query = $this->db->query("SELECT ".$nombreid." FROM ".$tabla." WHERE nr_empleado = '".$nr."' ORDER BY ".$nombreid." ASC");
		$ultimoid = 0;
		if($query->num_rows() > 0){
			foreach ($query->result() as $fila) {
				$ultimoid = $fila->$nombreid; 
			}
		}else{
			$ultimoid = 1;
		}
		return $ultimoid;
	}


		function cambiar_estado_revision($data){
		$query = $this->db->query("SELECT * FROM vyp_mision_pasajes WHERE id_mision_pasajes = '".$data."'");
		if($query->num_rows() > 0){
			foreach ($query->result() as $fila) {
				$estado = $fila->estado; 
			}
		}

		$newestado = 1;
		if($estado == 0){ //si esta incompleta
			$newestado = 1;	//cambiar a revision 1
		}else if($estado == 1){ //si esta en revisión 1
			$newestado = 1;	//permanecer en revisión 1
		}else if($estado == 2){ //si está en observación 1
			$newestado = 1;	//cambiar a revisión 1
		}else if($estado == 3){	//si está en revisión 2
			$newestado = 3; //permanecer en revisión 2
		}else if($estado == 4){ //si está en observación 2
			$newestado = 1;	//cambiar a revision 1
		}else if($estado == 5){
			$newestado = 5;
		}else if($estado == 6){
			$newestado = 1;
		}

		if($estado == 0){
			$this->db->where("id_mision_pasajes",$data);
			$fecha = date("Y-m-d H:i:s");
if($this->db->update('vyp_mision_pasajes', array('fecha_solicitud_pasajes' => $fecha, 'estado' => $newestado)) && $this->db->query("UPDATE vyp_observaciones_pasajes SET corregido = 1 WHERE id_mision_pasajes = '".$data."'")){
				return "exito";
			}else{
				return "fracaso";
			}
		}else{
			$this->db->where("id_mision_pasajes",$data);
			$fecha = date("Y-m-d H:i:s");
			if($this->db->update('vyp_mision_pasajes', array('estado' => $newestado, 'ultima_observacion' => '0000-00-00 00:00:00')) && $this->db->query("UPDATE vyp_observaciones_pasajes SET corregido = 1 WHERE id_mision_pasajes = '".$data."'")){
				return "exito";
			}else{
				return "fracaso";
			}
		}
	}
	/*function fecha_repetida($sql){
		$query = $this->db->query($sql);
		if($query->num_rows() > 0){
			return true;
		}else{
			return false;
		}
	}*/

	
}