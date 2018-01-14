<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_reportes extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('bancos_model');
	}

	public function index(){
		$this->load->view('templates/header');
		$this->load->view('informes/menu_reportes');
		$this->load->view('templates/footer');

	}

	public function reporte_viatico_pendiente_empleado($id){
		$this->load->library('pdf');

		$this->load->model('Reportes_viaticos_model');
		$this->pdf = new Pdf('P','mm','Letter');
		$this->pdf->Setform('VIÁTICOS PENDIENTES DE PAGO');
		$this->pdf->SetAutoPageBreak(true, 15);
	 $this->pdf->SetMargins(9,3,6);
		$this->pdf->AddPage();
		 $this->pdf->Cuadros(); //MUESTRA LOS CUADROS


		 $data = array('nr'=>$id);
		$empleado_NR_viatico = $this->Reportes_viaticos_model->obtenerNREmpleadoViatico($data);
		foreach ($empleado_NR_viatico->result() as $key) {
			$this->pdf->Text(9,21,"NR: 			 ".$key->nr ,0,'C', 0);
			$this->pdf->Text(9,25,"EMPLEADO: ".utf8_decode($key->nombre_completo) ,0,'C', 0);
		}

		 $this->pdf->SetAligns(array('L','J','L'));
		$this->pdf->SetWidths(array(25,142,28));
		$ids = array('nr' =>  $key->nr);
		$viatico = $this->Reportes_viaticos_model->obtenerListaviatico($ids);

		if($viatico->num_rows()>0){
				foreach ($viatico->result() as $viaticos) {
						$this->pdf->Row(
						array(date('d-m-Y',strtotime($viaticos->fecha_mision)),utf8_decode($viaticos->actividad_realizada),$viaticos->estado),
						array('0','0','0'),
						array(array('Arial','','9'),array('','',''),array('','','')),
						array(false,false,false,false),
						array(array('0','0','0'),array('0','0','0'),array('0','0','0')),
						array(array('255','211','0'),array('33','92','19'),array('192','10','2')));
						$data  =array(
							'id_mision_oficial'=>$viaticos->id_mision_oficial
						);
						$this->pdf->Ln(4);
						$detalle = $this->Reportes_viaticos_model->obtenerDetalle($data);
						$this->pdf->SetWidths(array(21,50,50,21,25));
						 $this->pdf->SetAligns(array('L','L','L','L'));
						$this->pdf->Row(
						array("","Origen","Destino",trim("Hora Salida"),trim("Hora Llegada")),
						array('0','1','1','1','1'),
						array(array('Arial','','08'),array('Arial','B','08'),array('','B',''),array('','B',''),array('','B','')),
						array(false,false,false,false,false),
						array(array('0','0','0'),array('0','0','0'),array('0','0','0'),array('0','0','0'),array('0','0','0')),
						array(array('255','255','255'),array('255','255','255'),array('255','255','255'),array('255','255','255'),array('255','255','255')));
						foreach ($detalle->result() as $keyDetalle) {

							//$this->pdf->Cell($this->pdf->GetX(),$this->pdf->GetY(),$keyDetalle->origen,'0');

						//  $this->pdf->cuadrogrande_salto(21,$this->pdf->GetY(),146,5,0,'FD');
							//$this->pdf->SetXY(9,$this->pdf->GetY());
								$this->pdf->Row(
								array("",utf8_decode($keyDetalle->origen),utf8_decode($keyDetalle->nombre_empresa),$keyDetalle->hora_salida,$keyDetalle->hora_llegada),
								array('0','0','0','0','0'),
								array(array('Arial','','08'),array('','',''),array('','',''),array('','',''),array('','','')),
								array(false,false,false,false,false),
								array(array('0','0','0'),array('0','0','0'),array('0','0','0'),array('0','0','0'),array('0','0','0')),
								array(array('255','211','0'),array('33','92','19'),array('192','10','2'),array('192','10','2'),array('255','255','255')));
								$this->pdf->Text(30,$this->pdf->GetY(),"_____________________________________________________________________________________________",0,'C', 0);
						}
					 $this->pdf->Text($this->pdf->GetX(),$this->pdf->GetY(),"___________________________________________________________________________________________________________________________",0,'C', 0);

						$this->pdf->SetWidths(array(25,142,28));
						$this->pdf->SetAligns(array('L','J','L'));
						$this->pdf->Ln(2);

				}
			}else{
				$this->pdf->Text($this->pdf->GetX()+25,$this->pdf->GetY()+10,"No posee viaticos pendientes de pago!",0,'C', 0);
			}

	 $this->pdf->Output(); //Salida al navegador
	}

	public function reporte_viatico_pagado_empleado($id,$min,$max){

		$this->load->library('pdf');
		$this->load->model('Reportes_viaticos_model');
		$this->pdf = new Pdf('P','mm','Letter');
		$this->pdf->Setform('VIÁTICOS PAGADOS EN UN PERIODO');
		$this->pdf->SetAutoPageBreak(true, 15);
	 $this->pdf->SetMargins(9,3,6);
		$this->pdf->AddPage();
		 $this->pdf->Cuadros(); //MUESTRA LOS CUADROS


		 $data = array('nr'=>$id);
		$empleado_NR_viatico = $this->Reportes_viaticos_model->obtenerNREmpleadoViatico($data);
		foreach ($empleado_NR_viatico->result() as $key) {
			$this->pdf->Text(9,21,"NR: 			 ".$key->nr ,0,'C', 0);
			$this->pdf->Text(9,25,"EMPLEADO: ".utf8_decode($key->nombre_completo) ,0,'C', 0);
			$this->pdf->Text(100,25,"INTERVALO DE: ".$min."  A  ".$max ,0,'C', 0);
		}

		 $this->pdf->SetAligns(array('L','J','L'));
		$this->pdf->SetWidths(array(25,142,28));
		$ids = array(
			'nr' =>  $key->nr,
			'fmin' => $min,
			'fmax' => $max
		);
		$viatico = $this->Reportes_viaticos_model->obtenerListaviaticoPagado($ids);

		if($viatico->num_rows()>0){
				foreach ($viatico->result() as $viaticos) {
						$this->pdf->Row(
						array(date('d-m-Y',strtotime($viaticos->fecha_mision)),utf8_decode($viaticos->actividad_realizada),$viaticos->estado),
						array('0','0','0'),
						array(array('Arial','','9'),array('','',''),array('','','')),
						array(false,false,false,false),
						array(array('0','0','0'),array('0','0','0'),array('0','0','0')),
						array(array('255','211','0'),array('33','92','19'),array('192','10','2')));
						$data  =array(
							'id_mision_oficial'=>$viaticos->id_mision_oficial
						);
						$this->pdf->Ln(4);
						$detalle = $this->Reportes_viaticos_model->obtenerDetalle($data);
						$this->pdf->SetWidths(array(21,50,50,21,25));
						 $this->pdf->SetAligns(array('L','L','L','L'));
						$this->pdf->Row(
						array("","Origen","Destino",trim("Hora Salida"),trim("Hora Llegada")),
						array('0','1','1','1','1'),
						array(array('Arial','','08'),array('Arial','B','08'),array('','B',''),array('','B',''),array('','B','')),
						array(false,false,false,false,false),
						array(array('0','0','0'),array('0','0','0'),array('0','0','0'),array('0','0','0'),array('0','0','0')),
						array(array('255','255','255'),array('255','255','255'),array('255','255','255'),array('255','255','255'),array('255','255','255')));
						foreach ($detalle->result() as $keyDetalle) {

							//$this->pdf->Cell($this->pdf->GetX(),$this->pdf->GetY(),$keyDetalle->origen,'0');

						//  $this->pdf->cuadrogrande_salto(21,$this->pdf->GetY(),146,5,0,'FD');
							//$this->pdf->SetXY(9,$this->pdf->GetY());
								$this->pdf->Row(
								array("",utf8_decode($keyDetalle->origen),utf8_decode($keyDetalle->nombre_empresa),$keyDetalle->hora_salida,$keyDetalle->hora_llegada),
								array('0','0','0','0','0'),
								array(array('Arial','','08'),array('','',''),array('','',''),array('','',''),array('','','')),
								array(false,false,false,false,false),
								array(array('0','0','0'),array('0','0','0'),array('0','0','0'),array('0','0','0'),array('0','0','0')),
								array(array('255','211','0'),array('33','92','19'),array('192','10','2'),array('192','10','2'),array('255','255','255')));
								$this->pdf->Text(30,$this->pdf->GetY(),"_____________________________________________________________________________________________",0,'C', 0);
						}
					 $this->pdf->Text($this->pdf->GetX(),$this->pdf->GetY(),"___________________________________________________________________________________________________________________________",0,'C', 0);

						$this->pdf->SetWidths(array(25,142,28));
						$this->pdf->SetAligns(array('L','J','L'));
						$this->pdf->Ln(2);

				}
			}else{
				$this->pdf->Text($this->pdf->GetX()+25,$this->pdf->GetY()+10,"No posee viaticos pagados!",0,'C', 0);
			}

	 $this->pdf->Output(); //Salida al navegador
	}
}
?>
