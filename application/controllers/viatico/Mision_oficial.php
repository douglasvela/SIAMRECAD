<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mision_oficial extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('misiones_model');
	}

	public function index(){
		$this->load->view('templates/header');
		$this->load->view('viaticos/mision_oficial');
		$this->load->view('templates/footer');
	}

	public function tabla_misiones(){
		$this->load->view('viaticos/tabla_mision_oficial');
	}

	public function combo_municipios(){
		$this->load->view('viaticos/combo_municipio');
	}

	public function gestionar_empresas_visitadas(){
		$departamento = json_decode(stripslashes($_POST['departamentos']));
		$municipio = json_decode(stripslashes($_POST['municipios']));
		$empresa = json_decode(stripslashes($_POST['empresas']));
		$direccion = json_decode(stripslashes($_POST['direcciones']));
		$tipo = json_decode(stripslashes($_POST['tipos']));
		$nr = json_decode(stripslashes($_POST['nr']));

		$id_mision = $this->misiones_model->obtener_ultima_mision("vyp_mision_oficial","id_mision_oficial",$nr[0]);

		$sql = "INSERT INTO vyp_empresas_visitadas (id_mision_oficial, id_departamento, id_municipio, nombre_empresa, direccion_empresa, tipo_destino) VALUES \n";

		for($i=0; $i<count($municipio); $i++){
		  	$sql .= "('".$id_mision."', '".$departamento[$i]."', '".$municipio[$i]."', '".$empresa[$i]."', '".$direccion[$i]."', '".$tipo[$i]."'),\n";
	    }

	    $sql = substr($sql, 0, -2).";";

		echo $this->misiones_model->insertar_empresas_visitadas($sql);
	}

	public function gestionar_mision(){
		if($this->input->post('band') == "save"){
			$data = array(
			'nr' => $this->input->post('nr'),
			'nombre_completo' => $this->input->post('nombre_empleado'),
			'fecha_mision' => date("Y-m-d",strtotime($this->input->post('fecha_mision'))),
			'actividad_realizada' => saltos_sql($this->input->post('actividad'))
			);
			echo $this->misiones_model->insertar_mision($data);			
		}else if($this->input->post('band') == "edit"){
			$data = array(
			'id_mision' => $this->input->post('id_mision'), 
			'nr' => $this->input->post('nr'),
			'nombre_completo' => $this->input->post('nombre_empleado'),
			'fecha_mision' => date("Y-m-d",strtotime($this->input->post('fecha_mision'))),			
			'actividad_realizada' => saltos_sql($this->input->post('actividad'))
			);
			echo $this->misiones_model->editar_mision($data);
		}else if($this->input->post('band') == "delete"){
			$data = array(
			'id_mision' => $this->input->post('id_mision')
			);
			echo $this->misiones_model->eliminar_mision($data);
		}
	}

	
}
?>