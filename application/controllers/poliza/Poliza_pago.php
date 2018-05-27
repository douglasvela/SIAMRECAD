<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Poliza_pago extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('poliza_model');
		$this->load->library('mpdf');
		$this->load->library('fpdf');
	}

	public function index(){
		$this->load->view('templates/header');
		$this->load->view('poliza/poliza_pago');
		$this->load->view('templates/footer');
	}

	public function tabla_polizas_pendientes(){
		$this->load->view('poliza/ajax_poliza_pago/tabla_polizas_pendientes');
	}

	public function tabla_planillas(){
		$this->load->view('poliza/ajax_poliza_pago/tabla_planillas');
	}

	public function tabla_registros_planillas(){
		$this->load->view('poliza/ajax_poliza_pago/tabla_registros_planillas');
	}
	
	public function tabla_poliza_pago(){
		$this->load->view('poliza/ajax_poliza_pago/tabla_poliza_pago');
	}

	public function imprimir_poliza(){
		$this->load->view('poliza/ajax_poliza_pago/imprimir_poliza');
	}

	public function imprimir_resumen_solicitudes(){
		$this->load->view('poliza/ajax_poliza_pago/imprimir_resumen_solicitudes');
	}

	function generar_pago(){
		$data = array(
			'sql' => $this->input->post('sql'), 
			'polizas' => $this->input->post('polis'), 
			'anio' => $this->input->post('anio'),
			'monto' => $this->input->post('monto'),
			'fecha_pago' => date("Y-m-d")
		); 

		$query = "UPDATE vyp_poliza SET estado = '2', fecha_cancelado = '".$data["fecha_pago"]."' WHERE id_poliza IN (SELECT p.id_poliza FROM (".$data['sql'].") AS p)";

		$query2 = "UPDATE vyp_mision_oficial SET estado = '8', fecha_pago = '".date("Y-m-d h:i:s")."' WHERE id_mision_oficial IN (SELECT p.id_poliza FROM (".$data['sql'].") AS p WHERE p.tipo_solicitud = 'viatico')";

		$query3 = "UPDATE vyp_mision_pasajes SET estado = '8', fecha_pago = '".date("Y-m-d h:i:s")."' WHERE id_mision_pasajes IN (SELECT p.id_poliza FROM (".$data['sql'].") AS p WHERE p.tipo_solicitud = 'pasaje')";

		if($this->poliza_model->pagar_solicitudes($query2, $query3)){
			echo $this->poliza_model->insertar_pago_poliza($data, $query);	
		}else{
			echo "fracaso";
		}
		
	}

	function eliminar_poliza(){
		echo $this->poliza_pago_model->eliminar_poliza($this->input->post('no_poliza'));
	}

	function editar_poliza(){
		$data = array(
			'sql' => $this->input->post('sql'), 
			'no_poliza' => $this->input->post('no_poliza'),
			'anio' => $this->input->post('anio')
		);

		echo $this->poliza_pago_model->editar_poliza($data);
	}


	/*public function calcular_viaticos(){
		$data = array(
			'hora_inicio' => $this->input->post('hora_inicio'), 
			'hora_fin' => $this->input->post('hora_fin')
		);
		$res = $this->solicitud_model->calcular_viaticos($data);
		$suma = 0;
		if($res->num_rows() > 0){
			foreach ($res->result() as $fila) {
				$suma += $fila->monto; 
			}
		}

		echo number_format($suma, 2, '.', '');
	}

	/*public function gestionar_bancos(){		

		if($this->input->post('band') == "save"){

			$data = array(
			'nombre' => $this->input->post('nombre'), 
			'caracteristicas' => $this->input->post('caracteristicas')
			);
			echo $this->bancos_model->insertar_banco($data);
			
		}else if($this->input->post('band') == "edit"){
			$data = array(
			'idb' => $this->input->post('idb'), 
			'nombre' => $this->input->post('nombre'), 
			'caracteristicas' => $this->input->post('caracteristicas')

			);
			echo $this->bancos_model->editar_banco($data);

		}else if($this->input->post('band') == "delete"){

			$data = array(
			'idb' => $this->input->post('idb')
			);
			echo $this->bancos_model->eliminar_banco($data);

		}
	}*/
}
?>