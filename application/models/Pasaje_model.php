<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pasaje_model extends CI_Model {
	
	function __construct(){
		parent::__construct();
		
	}

	function insertar_pasaje($data){
		$query01 = $this->db->query("select * from vyp_mision_pasajes where nr = '".$data['nr']."' and  mes_pasaje='".$data['mes_pasaje']."' and anio_pasaje='".$data['anio_pasaje']."'");
		if($query01->num_rows() == 0){
			if($this->db->insert('vyp_mision_pasajes', array('fecha_solicitud_pasaje'=>$data['fecha_solicitud_pasaje'],'nr'=>$data['nr'],'nombre_empleado'=>$data['nombre_empleado'],'nr_jefe_inmediato'=>$data['nr_jefe_inmediato'],'nr_jefe_regional'=>$data['nr_jefe_regional'],'estado'=>$data['estado'],'mes_pasaje'=>$data['mes_pasaje'],'anio_pasaje'=>$data['anio_pasaje'],'id_banco'=>$data['id_banco'])))
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
			if($this->db->update('vyp_mision_pasajes',array('fecha_solicitud_pasaje'=>$data['fecha_solicitud_pasaje'],'nr'=>$data['nr'],'nombre_empleado'=>$data['nombre_empleado'],'nr_jefe_inmediato'=>$data['nr_jefe_inmediato'],'nr_jefe_regional'=>$data['nr_jefe_regional'],'mes_pasaje'=>$data['mes_pasaje'],'anio_pasaje'=>$data['anio_pasaje'],'id_banco'=>$data['id_banco']))){
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
		/*$query01 = $this->db->query("select * from vyp_pasajes where id_mision = '".$data['id_mision']."' and nr = '".$data['nr_empleado']."' and  fecha_mision='".$data['fecha_detalle']."'");
		if($query01->num_rows() == 0){*/
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
		/*}else{
			return "pasaje_duplicado";
		}*/
	}
	function editar_detalle_solicitud($data){
		/*$query01 = $this->db->query("select * from vyp_pasajes where id_mision = '".$data['id_mision']."' and nr = '".$data['nr_empleado']."' and fecha_mision='".$data['fecha_detalle']."' and id_solicitud_pasaje!='".$data["id_solicitud_pasaje"]."'");
		if($query01->num_rows() == 0){*/
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
		/*}else{
			return "pasaje_duplicado";
		}*/
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
		$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
		$query = $this->db->query("SELECT * FROM vyp_mision_pasajes WHERE id_mision_pasajes = '".$data["id_mision_pasajes"]."'");
		if($query->num_rows() > 0){
			foreach ($query->result() as $fila) {
				$estado = $fila->estado; 
				$fecha_mision_fin = date("Y-m-d", strtotime($fila->fecha_solicitud_pasaje));
				$fecha_ultima_observacion = $fila->ultima_observacion;
			}
		}
		$titulo = $this->session->userdata('nombre_usuario_viatico');
		if($estado=="0"){
			$para='jefeinmediato';
			$titulo .= ' envió  a revisión solicitud #'.$data["id_mision_pasajes"].' de pasajes';
		}else if($estado=="2"){
			$para='jefeinmediato';
			$titulo .= ' envió  a revisión solicitud #'.$data["id_mision_pasajes"].' de pasajes';
		}else if($estado=="4"){
			$para='jefeinmediato';
			$titulo .= ' envió  a revisión solicitud #'.$data["id_mision_pasajes"].' de pasajes';
		}else if($estado=="6"){
			$para='jefeinmediato';
			$titulo .= ' envió  a revisión solicitud #'.$data["id_mision_pasajes"].' de pasajes';
		} 
		//envia correo cuando usuario se envia a revision en estado 2,4,6 y 0
	 	$url = base_url()."index.php/pasajes/observaciones";
		$cuerpo = "  
    		<div style='padding: 5px'>
	  			<span style='font-size:16px;font-weight: bold;'> 
	  				 Sistema de Viáticos y Pasajes
	  			</span><br><br><br>
	  			<span style='font-size:14px'> 
	  				 Tiene una nueva solicitud de revisión de pasajes de ".ucwords(strtolower($this->session->userdata('nombre_usuario_viatico'))).".
	  			</span><br><br>
	  			<span style='font-size:14px'> 
	  				 Solicitud de Pasajes del mes de ".$meses[($fila->mes_pasaje)-1]."
	  			</span><br><br><br>
	  			<a href='".$url."' target='_blank'>Click aqui para ver solicitud</a>
    		</div>
 		";
 		
		enviar_correo($titulo,$cuerpo,$para,'0',$fila->nr);
		
		$newestado = 1;
		$mensaje = "";
		if($estado == 0){ //si esta incompleta
			$newestado = 1;	//cambiar a revision 1
			$fecha_actualizacion = date("Y-m-d H:m:i");
			$fecha_antigua = $fecha_mision_fin.date(" H:m:i");
			$mensaje = "CREÓ LA SOLICITUD Y LA ENVIÓ A JEFATURA INMEDIATA";
			$persona_actualiza = 1; //Actualiza el solicitante
			
		}

		/*$tiempo_dias = get_days_count(substr($fecha_antigua,0,10), substr($fecha_actualizacion,0,10));
		$data_insert = array(
			'fecha_antigua' => $fecha_antigua,
			'fecha_actualizacion' => $fecha_actualizacion,
			'tiempo_dias' => $tiempo_dias,
			'descripcion' => $mensaje, 
			'persona_actualiza' => $persona_actualiza,
			'id_mision' => $data["id_mision_pasajes"],
			'nr_persona_actualiza' => $this->session->userdata('nr_usuario_viatico')
		);*/

		$fecha = date("Y-m-d H:i:s");
		$this->db->where("id_mision_pasajes",$data["id_mision_pasajes"]);
			if($this->db->update('vyp_mision_pasajes', array('estado'=>'1', 'ultima_observacion' => $fecha)) /*&& $this->db->insert('vyp_bitacora_solicitud_pasaje', $data_insert)*/){
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

		$query_estado = $this->db->query("select * from vyp_mision_pasajes where id_mision_pasajes='".$data['idsol']."'");
		foreach ($query_estado->result() as  $value) {
			$estado_solcitud =  $value->estado;
		}
		
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
				$fecha_mision_fin = date("Y-m-d", strtotime($fila->fecha_solicitud_pasaje));
				$fecha_ultima_observacion = $fila->ultima_observacion;
			}
		}

		$newestado = 1;
		$mensaje = "";
		if($estado == 0){ //si esta incompleta
			$newestado = 1;	//cambiar a revision 1
			$fecha_actualizacion = date("Y-m-d H:m:i");
			$fecha_antigua = $fecha_mision_fin.date(" H:m:i");
			$mensaje = "CREÓ LA SOLICITUD Y LA ENVIÓ A JEFATURA INMEDIATA";
			$persona_actualiza = 1; //Actualiza el solicitante


			 

		}else if($estado == 1){ //si esta en revisión 1
			$newestado = 1;	//permanecer en revisión 1
		}else if($estado == 2){ //si está en observación 1
			$fecha_actualizacion = date("Y-m-d H:m:i");
			$fecha_antigua = $fecha_ultima_observacion;
			$persona_actualiza = 1; //Actualiza el solicitante
			$mensaje = "CORRIGIÓ OBSERVACIONES DE JEFATURA INMEDIATA";
			$newestado = 1;	//cambiar a revisión 1
		}else if($estado == 3){	//si está en revisión 2
			$newestado = 3; //permanecer en revisión 2
		}else if($estado == 4){ //si está en observación 2
			$fecha_actualizacion = date("Y-m-d H:m:i");
			$fecha_antigua = $fecha_ultima_observacion;
			$persona_actualiza = 1; //Actualiza el solicitante
			$mensaje = "CORRIGIÓ OBSERVACIONES DE DIRECCIÓN O JEFATURA REGIONAL";
			$newestado = 1;	//cambiar a revision 1
		}else if($estado == 5){//si está en revisión 3
			$newestado = 5;
		}else if($estado == 6){ //si está en observacion 3
			$fecha_actualizacion = date("Y-m-d H:m:i");
			$fecha_antigua = $fecha_ultima_observacion;
			$persona_actualiza = 1; //Actualiza el solicitante
			$mensaje = "CORRIGIÓ OBSERVACIONES DE FONDO CIRCULANTE";
			$newestado = 1;
		}

		$tiempo_dias = get_days_count(substr($fecha_antigua,0,10), substr($fecha_actualizacion,0,10));
		$data_insert = array(
			'fecha_antigua' => $fecha_antigua,
			'fecha_actualizacion' => $fecha_actualizacion,
			'tiempo_dias' => $tiempo_dias,
			'descripcion' => $mensaje, 
			'persona_actualiza' => $persona_actualiza,
			'id_mision' => $data,
			'nr_persona_actualiza' => $this->session->userdata('nr_usuario_viatico')
		);

		if($estado == 0){
			$this->db->where("id_mision_pasajes",$data);
			$fecha = date("Y-m-d H:i:s");
			if($this->db->update('vyp_mision_pasajes', array('fecha_solicitud_pasajes' => $fecha, 'estado' => $newestado, 'ultima_observacion' => $fecha))  && $this->db->insert('vyp_bitacora_solicitud_pasaje', $data_insert)){
				return "exito";
			}else{
				return "fracaso";
			}
		}else{
			$this->db->where("id_mision_pasajes",$data);
			$fecha = date("Y-m-d H:i:s");
			if($this->db->update('vyp_mision_pasajes', array('estado' => $newestado, 'ultima_observacion' => $fecha)) && $this->db->query("UPDATE vyp_observaciones_pasajes SET corregido = 1 WHERE id_mision_pasajes = '".$data."'")  && $this->db->insert('vyp_bitacora_solicitud_pasaje', $data_insert) ){
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