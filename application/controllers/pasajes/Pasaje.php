<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pasaje extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('Pasaje_model');
	}
	public function index(){
		$data['estado_solicitud'] = $this->input->post('estado');
		$this->load->view('templates/header');
		$this->load->view('pasajes/Solicitud_pasajes', $data);
		$this->load->view('templates/footer');
	}
	public function tabla_pasajes(){
		$this->load->view('pasajes/tabla_pasajes');
	}
	
	public function tabla_pasaje_unidad(){
		$this->load->view('pasajes/viaticos_ajax/tabla_pasajes');
	}
	public function tabla_pasajes_detallado(){	
		$this->load->view('pasajes/viaticos_ajax/tabla_pasajes_detallado');
	}
	public function bitacora(){
		$this->load->view('pasajes/viaticos_ajax/bitacora');
	}
	
	public function gestionar_pasaje(){		
		if($this->input->post('band') == "save"){
			$nr_empleado = $this->input->post('nr_empleado');
			///////////////////////////////////////////////

			$info_empleado = $this->db->query("SELECT ie.*, ecb.id_empleado_banco FROM vyp_informacion_empleado ie JOIN vyp_empleado_cuenta_banco ecb ON ecb.nr = ie.nr WHERE ecb.estado = 1 AND ie.nr = '".$nr_empleado."'");
		    $id_empleado_banco = $info_empleado->row()->id_empleado_banco;

			$info_empleado = $this->db->query("SELECT * FROM vyp_informacion_empleado WHERE nr = '".$nr_empleado."'");
		    if($info_empleado->num_rows() > 0){ 
		        foreach ($info_empleado->result() as $filas) {}
		        $oficina_origen = $this->db->query("SELECT * FROM vyp_oficinas WHERE id_oficina = '".$filas->id_oficina_departamental."'");
		      if($oficina_origen->num_rows() > 0){ 
		          foreach ($oficina_origen->result() as $filaofi) {}
		      }
		      $director_jefe_regional = $this->db->query("SELECT nr FROM sir_empleado WHERE id_empleado = '".$filaofi->jefe_oficina."'");
		      if($director_jefe_regional->num_rows() > 0){ 
		          foreach ($director_jefe_regional->result() as $filadir) {}
		      }
		      $nr_jefe_inmediato = $filas->nr_jefe_inmediato;
		      $nr_jefe_regional = $filas->nr_jefe_departamento;
		  	}
			///////////////////////////////////////////////
			$data = array(
			'fecha_solicitud_pasaje' => date("Y-m-d",strtotime($this->input->post('fecha_solicitud'))),
			'nr' => $nr_empleado,
			'nombre_empleado' => $this->input->post('nombre_completo'),
			'nr_jefe_inmediato' => $nr_jefe_inmediato,
			'nr_jefe_regional' => $nr_jefe_regional,
			'estado' => '0',
			'mes_pasaje' =>$this->input->post('mes_pasaje'),
			'anio_pasaje'=>$this->input->post('anio_pasaje'),
			'id_banco'=>$id_empleado_banco
			);
		echo $this->Pasaje_model->insertar_pasaje($data);
		
		} else if($this->input->post('band') == "edit"){
			$nr_empleado = $this->input->post('nr_empleado');

			$info_empleado = $this->db->query("SELECT ie.*, ecb.id_empleado_banco FROM vyp_informacion_empleado ie JOIN vyp_empleado_cuenta_banco ecb ON ecb.nr = ie.nr WHERE ecb.estado = 1 AND ie.nr = '".$nr_empleado."'");
		    $id_empleado_banco = $info_empleado->row()->id_empleado_banco;
			///////////////////////////////////////////////
			$info_empleado = $this->db->query("SELECT * FROM vyp_informacion_empleado WHERE nr = '".$nr_empleado."'");
		    if($info_empleado->num_rows() > 0){ 
		        foreach ($info_empleado->result() as $filas) {}
		        $oficina_origen = $this->db->query("SELECT * FROM vyp_oficinas WHERE id_oficina = '".$filas->id_oficina_departamental."'");
		      if($oficina_origen->num_rows() > 0){ 
		          foreach ($oficina_origen->result() as $filaofi) {}
		      }
		      $director_jefe_regional = $this->db->query("SELECT nr FROM sir_empleado WHERE id_empleado = '".$filaofi->jefe_oficina."'");
		      if($director_jefe_regional->num_rows() > 0){ 
		          foreach ($director_jefe_regional->result() as $filadir) {}
		      }
		      $nr_jefe_inmediato = $filas->nr_jefe_inmediato;
		      $nr_jefe_regional = $filas->nr_jefe_departamento;
		  }
			///////////////////////////////////////////////
			$data = array(
			'id_mision_pasajes'  => $this->input->post('id_mision_pasajes'),
			'fecha_solicitud_pasaje' => date("Y-m-d",strtotime($this->input->post('fecha_solicitud'))),
			'nr' => $nr_empleado,
			'nombre_empleado' => $this->input->post('nombre_completo'),
			'nr_jefe_inmediato' => $nr_jefe_inmediato,
			'nr_jefe_regional' => $nr_jefe_regional,
			'mes_pasaje' =>$this->input->post('mes_pasaje'),
			'anio_pasaje'=>$this->input->post('anio_pasaje'),
			'id_banco'=>$id_empleado_banco
			);
			echo $this->Pasaje_model->editar_pasaje($data);
		}else if($this->input->post('band') == "delete"){
			$data = array(
			'id_mision_pasajes' => $this->input->post('id_mision_pasajes')
			);
			echo $this->Pasaje_model->eliminar_pasaje($data);
		}
	}
	public function gestionar_detalle_pasaje(){
		if($this->input->post('band_detalle_solicitud') == "save"){
			$data = array(
			'fecha_detalle' => date("Y-m-d",strtotime($this->input->post('fecha_detalle'))),
			'departamento' => $this->input->post('departamento'),
			'municipio' => $this->input->post('municipio'),
			'empresa' => $this->input->post('empresa'),
			'direccion' => $this->input->post('direccion'),
			'expediente' =>$this->input->post('expediente'),
			'id_actividad'=>$this->input->post('id_actividad'),
			'nr_empleado'=>$this->input->post('nr_empleado'),
			'monto'=>$this->input->post('monto'),
			'id_mision'=>$this->input->post('id_mision'),
			);
			echo $this->Pasaje_model->ingresar_detalle_solicitud($data);
		}else if($this->input->post('band_detalle_solicitud') == "edit"){
			$data = array(
			'id_solicitud_pasaje' => $this->input->post('id_detalle_solicitud'),
			'fecha_detalle' => date("Y-m-d",strtotime($this->input->post('fecha_detalle'))),
			'departamento' => $this->input->post('departamento'),
			'municipio' => $this->input->post('municipio'),
			'empresa' => $this->input->post('empresa'),
			'direccion' => $this->input->post('direccion'),
			'expediente' =>$this->input->post('expediente'),
			'id_actividad'=>$this->input->post('id_actividad'),
			'nr_empleado'=>$this->input->post('nr_empleado'),
			'monto'=>$this->input->post('monto'),
			'id_mision'=>$this->input->post('id_mision'),
			);
			echo $this->Pasaje_model->editar_detalle_solicitud($data);
		}else if($this->input->post('band_detalle_solicitud') == "delete"){
			$data = array(
			'id_solicitud_pasaje' => $this->input->post('id_detalle_solicitud'),
			'id_mision'=>$this->input->post('id_mision')
			);
			echo $this->Pasaje_model->eliminar_detalle_solicitud($data);
		}
	}

	function gestionar_revision1(){

			$data = array(
			'id_mision_pasajes' => $this->input->post('id_mision_pasajes')
			);
		$res = $this->Pasaje_model->consultar_detalle_solicitud($data);
		if($res=="exito"){
			echo $this->Pasaje_model->enviar_a_revision($data);
		}else{
			echo "fracaso";
		}
	}
	function corregir_observaciones(){
		$data = array(
			'ides' => $this->input->post('ides'),
			'idsol' => $this->input->post('idsol')
			);
		echo $this->Pasaje_model->corregir_observaciones($data);
	}

	function generar_solicitud(){
		echo $this->Pasaje_model->cambiar_estado_revision($_POST['id_mision']);
	}
	public function info_pasajes(){
		$this->load->view('pasajes/viaticos_ajax/info_pasajes');
	}
 
	public function observaciones(){
		$this->load->view('pasajes/viaticos_ajax/observaciones');
	}

	public function obtener_ultima_mision(){
		echo $this->pasaje_model->obtener_ultima_mision("vyp_mision_pasajes","id_mision_pasajes",$_POST['nr']);
	}

		
}
?>