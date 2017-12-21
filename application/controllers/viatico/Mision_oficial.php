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

	public function imprimir_solicitud(){
		$this->load->view('viaticos/imprimir_solicitud');
	}

	public function tabla_empresas_visitadas(){
		$this->load->view('viaticos/tabla_empresas_visitadas');
	}

	public function tabla_empresas_viaticos(){
		$this->load->view('viaticos/tabla_empresa_viaticos');
	}

	public function combo_municipios(){
		$this->load->view('viaticos/combo_municipio');
	}

	public function calcular_viaticos(){
		$data = array(
			'hora_inicio' => $this->input->post('hora_inicio'), 
			'hora_fin' => $this->input->post('hora_fin')
		);
		$res = $this->misiones_model->calcular_viaticos($data);
		$suma = 0;
		if($res != false){
			foreach ($res->result() as $fila) {
				$suma += $fila->monto; 
			}
		}

		echo number_format($suma, 2, '.', '');
	}

	public function obtener_ultima_mision(){
		echo $this->misiones_model->obtener_ultima_mision("vyp_mision_oficial","id_mision_oficial",$_POST['nr']);
	}

	public function gestionar_empresas_visitadas(){
		$departamento = json_decode(stripslashes($_POST['departamentos']));
		$municipio = json_decode(stripslashes($_POST['municipios']));
		$empresa = json_decode(stripslashes($_POST['empresas']));
		$direccion = json_decode(stripslashes($_POST['direcciones']));
		$tipo = json_decode(stripslashes($_POST['tipos']));
		$nr = json_decode(stripslashes($_POST['nr']));

		if($_POST['id_mision'] == "vacio"){
			$id_mision = $this->misiones_model->obtener_ultima_mision("vyp_mision_oficial","id_mision_oficial",$nr[0]);	
		}else{
			$id_mision = $_POST['id_mision'];
		}

		$sql = "INSERT INTO vyp_empresas_visitadas (id_mision_oficial, id_departamento, id_municipio, nombre_empresa, direccion_empresa, tipo_destino) VALUES \n";

		for($i=0; $i<count($municipio); $i++){
		  	$sql .= "('".$id_mision."', '".$departamento[$i]."', '".$municipio[$i]."', '".$empresa[$i]."', '".$direccion[$i]."', '".$tipo[$i]."'),\n";
	    }

	    $origen = "OFICINA SAN SALVADOR";

	    $sql .= "('".$id_mision."', '00006', '00097', '".$origen."', 'OFICINA SAN SALVADOR', 'oficina');";

		echo $this->misiones_model->insertar_empresas_visitadas($sql);
	}

	public function eliminar_empresas_visitadas(){
		$sql = "DELETE FROM vyp_empresas_visitadas WHERE id_mision_oficial = '".$this->input->post('id_mision')."'";
		echo $this->misiones_model->eliminar_empresas_visitadas($sql);
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

			$sql = "DELETE FROM vyp_empresas_visitadas WHERE id_mision_oficial = '".$this->input->post('id_mision')."'";
			if($this->misiones_model->eliminar_empresas_visitadas($sql) == "exito"){
				echo $this->misiones_model->eliminar_mision($data);
			}else{
				echo "fracaso";
			}
		}
	}

	public function generar_solicitud(){
		$data = array(
			'query' => $this->input->post('query')
		);
		echo $this->misiones_model->generar_solicitud($data);
	}
	
}
?>