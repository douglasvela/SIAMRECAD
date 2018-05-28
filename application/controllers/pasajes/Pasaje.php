<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pasaje extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('Pasaje_model');
	}
	public function index(){
		$this->load->view('templates/header');
		$this->load->view('pasajes/Solicitud_pasajes');
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
	public function buscar_jefes_superiores(){

	}

	
	public function gestionar_pasaje(){		
		if($this->input->post('band') == "save"){
			$nr_empleado = $this->input->post('nr_empleado');
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
		      $nr_jefe_regional = $filadir->nr;
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
			'anio_pasaje'=>$this->input->post('anio_pasaje')
			);
		echo $this->Pasaje_model->insertar_pasaje($data);
			
		} else if($this->input->post('band') == "edit"){
			$data = array(
			'id_pasaje' => $this->input->post('id_pasaje'), 
			'fecha_mision' => date("Y-m-d",strtotime($this->input->post('fecha'))),
			'expediente' => $this->input->post('expediente'),
			'empresa' => $this->input->post('empresa'),
			'direccion' => $this->input->post('direccion'),
			'monto' => $this->input->post('monto')
			);
			echo $this->Pasaje_model->editar_pasaje($data);
		}else if($this->input->post('band') == "delete"){
			$data = array(
			'id_pasaje' => $this->input->post('id_pasaje')
			);
			echo $this->Pasaje_model->eliminar_pasaje($data);
		}
	}

	public function gestionar_pasaje2(){		
		if($this->input->post('band2') == "save"){
			$data = array(
				
			'fecha_mision' => date("Y-m-d",strtotime($this->input->post('fecha'))),
			'expediente' => $this->input->post('expediente'),
			'empresa' => $this->input->post('empresa'),
			'direccion' => $this->input->post('direccion'),
			
			'nr' => $this->input->post('nr'),
			'monto' => $this->input->post('monto')
			);
		echo $this->Pasaje_model->insertar_pasaje($data);
			
		} else if($this->input->post('band') == "edit"){
			$data = array(
			'id_pasaje' => $this->input->post('id_pasaje'), 
			'fecha_mision' => date("Y-m-d",strtotime($this->input->post('fecha'))),
			'expediente' => $this->input->post('expediente'),
			'empresa' => $this->input->post('empresa'),
			'direccion' => $this->input->post('direccion'),
			'monto' => $this->input->post('monto')
			);
			echo $this->Pasaje_model->editar_pasaje($data);
		}else if($this->input->post('band') == "delete"){
			$data = array(
			'id_pasaje' => $this->input->post('id_pasaje')
			);
			echo $this->Pasaje_model->eliminar_pasaje($data);
		}
	}


public function gestionar_pasaje_fecha(){		
		if($this->input->post('band') == "save"){
			$data = array(
			//'id' => $this->input->post('id_mision'),
			'nr' => $this->input->post('nr'),
			'nombre_empleado' => $this->input->post('nombre_emple'),
			'jefe_inmediato' => $this->input->post('jefe_inmediato'),
			'jefe_regional' => $this->input->post('jefe_regional'),
			'estado' => '1',
			'mes' =>$this->input->post('mes'),
			'anio' => $this->input->post('anio'),
		   'fechas_pasaje' => $this->input->post('fechas_p')
				);
		echo $this->Pasaje_model->insertar_mision_pasaje($data);
			
		}  else if($this->input->post('band') == "edit"){

			$data = array(
			'id' => $this->input->post('id_mision'),
			'nr' => $this->input->post('nr'),
			'nombre_empleado' => $this->input->post('nombre_emple'),
			'jefe_inmediato' => $this->input->post('jefe_inmediato'),
			'jefe_regional' => $this->input->post('jefe_regional'),
			//'estado' => '1',
			'mes' =>$this->input->post('mes'),
			'anio' => $this->input->post('anio'),
		   'fechas_pasaje' => $this->input->post('fechas_p')
				);
		echo $this->Pasaje_model->editar_mision_pasajes($data);

	}
}
	function generar_solicitud(){
		echo $this->Pasaje_model->cambiar_estado_revision($_POST['id_mision']);
	}
	public function info_pasajes(){
		$this->load->view('pasajes/viaticos_ajax/info_pasajes');
	}
	/*public function gestionar_mision_pasajes(){
		if($this->input->post('band') == "save"){
			$data = array(
			'nr' => $this->input->post('nr'),
			'nr_jefe_inmediato' => $this->input->post('nr_jefe_inmediato'),
			'nr_jefe_regional' => $this->input->post('nr_jefe_regional'),
			'nombre_empleado' => $this->input->post('nombre_completo'),
			'mes_pasaje' => date("Y-m-d",strtotime($this->input->post('mes_pasaje'))),
			'anio_pasaje' => date("Y-m-d",strtotime($this->input->post('anio_pasaje'))),
			
			);
			
			$resultado = $this->pasaje_model->insertar_mision_pasajes($data);
		
	}*/

	public function observaciones(){
		$this->load->view('pasajes/viaticos_ajax/observaciones');
	}

	public function obtener_ultima_mision(){
		echo $this->pasaje_model->obtener_ultima_mision("vyp_mision_pasajes","id_mision_pasajes",$_POST['nr']);
	}

		
}
?>