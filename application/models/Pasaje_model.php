<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pasaje_model extends CI_Model {
	
	function __construct(){
		parent::__construct();
	}

	function insertar_pasaje($data){
		$query01 = $this->db->query("select * from vyp_mision_pasajes where nr = '".$data['nr']."' and  mes_pasaje='".$data['mes_pasaje']."' and anio_pasaje='".$data['anio_pasaje']."'");
		if($query01->num_rows() == 0){
			if($this->db->insert('vyp_mision_pasajes', array('fecha_solicitud_pasaje'=>$data['fecha_solicitud_pasaje'],'nr'=>$data['nr'],'nombre_empleado'=>$data['nombre_empleado'],'nr_jefe_inmediato'=>$data['nr_jefe_inmediato'],'nr_jefe_regional'=>$data['nr_jefe_regional'],'estado'=>$data['estado'],'mes_pasaje'=>$data['mes_pasaje'],'anio_pasaje'=>$data['anio_pasaje'])))
			{
				$id = $this->db->insert_id();
				return "exito,".$id;
			}else{
				$id = $this->db->insert_id();
				return "fracaso,".$id;
			}
		}else{
			return "mision_duplicado";
		}
	}
	function editar_pasaje($data){
		$query01 = $this->db->query("select * from vyp_mision_pasajes where nr = '".$data['nr']."' and  fecha_solicitud_pasaje='".$data['fecha_solicitud_pasaje']."' and id_mision_pasajes!='".$data["id_mision_pasajes"]."'");
		if($query01->num_rows() == 0){
			$this->db->where("id_mision_pasajes",$data["id_mision_pasajes"]);
			if($this->db->update('vyp_mision_pasajes',array('fecha_solicitud_pasaje'=>$data['fecha_solicitud_pasaje'],'nr'=>$data['nr'],'nombre_empleado'=>$data['nombre_empleado'],'nr_jefe_inmediato'=>$data['nr_jefe_inmediato'],'nr_jefe_regional'=>$data['nr_jefe_regional'],'mes_pasaje'=>$data['mes_pasaje'],'anio_pasaje'=>$data['anio_pasaje']))){
				return "exito";
			}else{
				return "fracaso";
			}
		}else{
			return "mision_duplicado";
		}
	}
	
	function eliminar_pasaje($data){
		if($this->db->delete("vyp_mision_pasajes",array('id_mision_pasajes' => $data['id_mision_pasajes']))){
			$this->db->delete("vyp_pasajes",array('id_mision' => $data['id_mision_pasajes']));
			$this->db->delete("vyp_observaciones_pasajes",array('id_mision_pasajes' => $data['id_mision_pasajes']));
			return "exito";
		}else{
			return "fracaso";
		}
	}

	function agrupar_fechas_detalles($id){
		$fechas="";
		$i=1;
		$query = $this->db->query("select fecha_mision from vyp_pasajes where id_mision='".$id."'");
			$total=$query->num_rows();
			if($query->num_rows() > 0){
				foreach ($query->result() as $fila) {
						$fechas=$fechas.$fila->fecha_mision.","; 
				}
			
			$this->db->where("id_mision_pasajes",$id);
			$this->db->update('vyp_mision_pasajes',array('fechas_pasajes' => $fechas));
			}
	}

	function ingresar_detalle_solicitud($data){
		$query01 = $this->db->query("select * from vyp_pasajes where id_mision = '".$data['id_mision']."' and nr = '".$data['nr_empleado']."' and  fecha_mision='".$data['fecha_detalle']."'");
		if($query01->num_rows() == 0){
			$query = $this->db->query("select * from vyp_generalidades where pasaje>='".$data['monto']."'");
			if($query->num_rows() > 0){
				if($this->db->insert('vyp_pasajes', array('fecha_mision'=>$data['fecha_detalle'],'id_departamento'=>$data['departamento'],'id_municipio'=>$data['municipio'],'empresa_visitada'=>$data['empresa'],'direccion_empresa'=>$data['direccion'],'no_expediente'=>$data['expediente'],'id_actividad_realizada'=>$data['id_actividad'],'nr'=>$data['nr_empleado'],'monto_pasaje'=>$data['monto'],'id_mision'=>$data['id_mision']))){
					$this->agrupar_fechas_detalles($data['id_mision']);
					return "exito";
				}else{
					return "fracaso";
				}
			}else{
				return "monto_invalido";
			}
		}else{
			return "pasaje_duplicado";
		}
	}
	function editar_detalle_solicitud($data){
		$query01 = $this->db->query("select * from vyp_pasajes where id_mision = '".$data['id_mision']."' and nr = '".$data['nr_empleado']."' and fecha_mision='".$data['fecha_detalle']."' and id_solicitud_pasaje!='".$data["id_solicitud_pasaje"]."'");
		if($query01->num_rows() == 0){
			$query = $this->db->query("select * from vyp_generalidades where pasaje>='".$data['monto']."'");
			if($query->num_rows() > 0){
				$this->db->where("id_solicitud_pasaje",$data["id_solicitud_pasaje"]);
				if($this->db->update('vyp_pasajes', array('fecha_mision'=>$data['fecha_detalle'],'id_departamento'=>$data['departamento'],'id_municipio'=>$data['municipio'],'empresa_visitada'=>$data['empresa'],'direccion_empresa'=>$data['direccion'],'no_expediente'=>$data['expediente'],'id_actividad_realizada'=>$data['id_actividad'],'nr'=>$data['nr_empleado'],'monto_pasaje'=>$data['monto'],'id_mision'=>$data['id_mision']))){
					$this->agrupar_fechas_detalles($data['id_mision']);
					return "exito";
				}else{
					return "fracaso";
				}
			}else{
				return "monto_invalido";
			}
		}else{
			return "pasaje_duplicado";
		}
	}
	function eliminar_detalle_solicitud($data){
		if($this->db->delete("vyp_pasajes",array('id_solicitud_pasaje' => $data['id_solicitud_pasaje']))){
			$this->agrupar_fechas_detalles($data['id_mision']);
			return "exito";
		}else{
			return "fracaso";
		}
	}
	function enviar_a_revision($data){
		$this->db->where("id_mision_pasajes",$data["id_mision_pasajes"]);
			if($this->db->update('vyp_mision_pasajes', array('estado'=>'1'))){
				return "exito";
			}else{
				return "fracaso";
			}
	}
	function consultar_detalle_solicitud($data){
		$query = $this->db->query("select * from vyp_pasajes where id_mision='".$data['id_mision_pasajes']."'");
		if($query->num_rows() > 0){
			return "exito";
		}else{
			return "fracaso";
		}
	}
	function corregir_observaciones($data){
		$this->db->where("id_observacion_pasaje",$data["ides"]);
			if($this->db->update('vyp_observaciones_pasajes', array('corregido'=>'1'))){
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
			$newestado = 3;	//cambiar a revision 1
		}else if($estado == 5){
			$newestado = 5;
		}else if($estado == 6){
			$newestado = 5;
		}
		else if($estado == 7){
			$newestado = 7;
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