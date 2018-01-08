<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Solicitud_model extends CI_Model {
	
	function __construct(){
		parent::__construct();
	}

	function insertar_mision($data){
		$id = $this->obtener_ultimo_id("vyp_mision_oficial","id_mision_oficial");
		if($this->db->insert('vyp_mision_oficial', array('id_mision_oficial' => $id, 'nr_empleado' => $data['nr'], 'nombre_completo' => $data['nombre_completo'], 'fecha_mision' => $data['fecha_mision'], 'actividad_realizada' => $data['actividad_realizada'], 'estado' => "incompleta"))){
			return "exito";
		}else{
			return "fracaso";
		}
	}

	function insertar_destino($data){
		$id = $this->obtener_ultimo_id("vyp_empresas_visitadas","id_empresas_visitadas");

		if($this->db->insert('vyp_empresas_visitadas', array('id_empresas_visitadas' => $id, 'id_mision_oficial' => $data['id_mision'], 'id_departamento' => $data['departamento'], 'id_municipio' => $data['municipio'], 'nombre_empresa' => $data['nombre_empresa'], 'direccion_empresa' => $data['direccion_empresa'], 'kilometraje' => $data['distancia'], 'tipo_destino' => $data['tipo']))){
			return "exito";
		}else{
			return "fracaso";
		}
	}

	function editar_mision($data){
		$this->db->where("id_mision_oficial",$data["id_mision"]);
		if($this->db->update('vyp_mision_oficial', array('fecha_mision' => $data['fecha_mision'], 'actividad_realizada' => $data['actividad_realizada']))){
			return "exito";
		}else{
			return "fracaso";
		}
	}

	function estado_revision($data){
		$this->db->where("id_mision_oficial",$data);
		$fecha = date("Y-m-d H:i:s");
		if($this->db->update('vyp_mision_oficial', array('fecha_solicitud' => $fecha, 'estado' => 'revision'))){
			return "exito";
		}else{
			return "fracaso";
		}
	}

	function eliminar_mision($data){
		if($this->db->delete("vyp_mision_oficial",array('id_mision_oficial' => $data['id_mision']))){
			return "exito";
		}else{
			return "fracaso";
		}
	}

	function eliminar_empresas_visitadas($data){
		if($this->db->query($data)){
			return "exito";
		}else{
			return "fracaso";
		}
	}

	function eliminar_registros_viaticos($data){
		if($this->db->delete("vyp_viatico_empresa_horario",array('id_mision' => $data))){
			return true;
		}else{
			return false;
		}
	}

	function ordenar_empresas_visitadas($data){
		if($this->db->query($data)){
			return "exito";
		}else{
			return "fracaso";
		}
	}

	function guardar_registros_viaticos($data){
		if($this->db->query($data)){
			return "exito";
		}else{
			return "fracaso";
		}
	}

	function completar_tabla_viatico($data){
		if($this->db->query($data)){
			return "exito";
		}else{
			return "fracaso";
		}
	}

	function verficar_oficina_destino($data){
		$query = $this->db->query("SELECT * FROM vyp_empresas_visitadas WHERE id_mision_oficial = '".$data['id_mision']."' AND tipo_destino = 'destino_oficina' AND id_municipio = '".$data['municipio']."' AND id_departamento = '".$data['departamento']."'");
		if($query->num_rows() > 0){
			return "exito"; 
		}else{
			return $this->insertar_destino($data);
		}
	}

	function verficar_cumpla_kilometros($data){
		$query = $this->db->query("SELECT * FROM vyp_empresas_visitadas WHERE id_mision_oficial = '".$data['id_mision']."' AND kilometraje > 15");
		if($query->num_rows() > 0){
			return true; 
		}else{
			return false;
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
}