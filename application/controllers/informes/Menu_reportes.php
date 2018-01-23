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
		$this->pdf->SetTituloPagina('VIÁTICOS PENDIENTES DE PAGO');
		$this->pdf->SetTituloTabla1("FECHA");
		$this->pdf->SetTituloTabla2("DESCRIPCIÓN");
		$this->pdf->SetTituloTabla3("ESTADO");
		$this->pdf->SetTitle(utf8_decode('VIÁTICOS PENDIENTES DE PAGO'));
		$this->pdf->SetAutoPageBreak(true, 15);
	 $this->pdf->SetMargins(9,3,6);
	 $this->pdf->SetCuadros("viatico_pendiente_empleado");
		$this->pdf->AddPage();

		 $data = array('nr'=>$id);
		$empleado_NR_viatico = $this->Reportes_viaticos_model->obtenerNREmpleadoViatico($data);
		foreach ($empleado_NR_viatico->result() as $key) {
			$this->pdf->Text(9,21,"NR: 			 ".$id ,0,'C', 0);
			$this->pdf->Text(9,25,"EMPLEADO: ".utf8_decode($key->nombre_completo) ,0,'C', 0);
		}

		 $this->pdf->SetAligns(array('L','J','L'));
		$this->pdf->SetWidths(array(25,142,28));
		$ids = array('nr' =>  $id);
		$viatico = $this->Reportes_viaticos_model->obtenerListaviatico($ids);

		if($viatico->num_rows()>0){
				foreach ($viatico->result() as $viaticos) {
						$this->pdf->Row(
						array(date('d-m-Y',strtotime($viaticos->fecha_mision)),utf8_decode($viaticos->actividad_realizada),ucfirst($viaticos->estado)),
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
						$this->pdf->SetWidths(array(21,50,50,21,25,14,13));
						 $this->pdf->SetAligns(array('L','L','L','L','L','L'));
						$this->pdf->Row(
						array("","Origen","Destino",trim("Hora Salida"),trim("Hora Llegada"),"Viatico","Pasaje"),
						array('0','1','1','1','1','1','1'),
						array(array('Arial','','08'),array('Arial','B','08'),array('','B',''),array('','B',''),array('','B',''),array('','B',''),array('','B','')),
						array(false,false,false,false,false,false,false),
						array(array('0','0','0'),array('0','0','0'),array('0','0','0'),array('0','0','0'),array('0','0','0'),array('0','0','0'),array('0','0','0')),
						array(array('255','255','255'),array('255','255','255'),array('255','255','255'),array('255','255','255'),array('255','255','255'),array('255','255','255'),array('255','255','255')));
						if($detalle->num_rows()>0){
						foreach ($detalle->result() as $keyDetalle) {
								$this->pdf->Row(
								array("",utf8_decode($keyDetalle->origen),utf8_decode($keyDetalle->nombre_empresa),$keyDetalle->hora_salida,$keyDetalle->hora_llegada,number_format($keyDetalle->viaticos,2,".",","),number_format($keyDetalle->pasajes,2,".",",")),
								array('0','0','0','0','0','0','0'),
								array(array('Arial','','08'),array('','',''),array('','',''),array('','',''),array('','',''),array('','',''),array('','','')),
								array(false,false,false,false,false,false,false),
								array(array('0','0','0'),array('0','0','0'),array('0','0','0'),array('0','0','0'),array('0','0','0'),array('0','0','0'),array('0','0','0')),
								array(array('255','211','0'),array('33','92','19'),array('192','10','2'),array('192','10','2'),array('255','255','255'),array('255','255','255'),array('255','255','255')));
								$this->pdf->Text(30,$this->pdf->GetY(),"______________________________________________________________________________________________________________",0,'C', 0);
						}
					}else{
						$this->pdf->SetWidths(array(21,80,20,21,25,14,13));
						$this->pdf->Row(
						array("","No se han registrado empresas visitadas","","","","",""),
						array('0','0','0','0','0','0','0'),
						array(array('Arial','','08'),array('','',''),array('','',''),array('','',''),array('','',''),array('','',''),array('','','')),
						array(false,false,false,false,false,false,false),
						array(array('0','0','0'),array('0','0','0'),array('0','0','0'),array('0','0','0'),array('0','0','0'),array('0','0','0'),array('0','0','0')),
						array(array('255','211','0'),array('33','92','19'),array('192','10','2'),array('192','10','2'),array('255','255','255'),array('255','255','255'),array('255','255','255')));
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
		$this->pdf->SetTituloPagina('VIÁTICOS PAGADOS EN UN PERIODO');
		$this->pdf->SetTituloTabla1("FECHA");
		$this->pdf->SetTituloTabla2("DESCRIPCIÓN");
		$this->pdf->SetTituloTabla3("ESTADO");
		$this->pdf->SetTitle(utf8_decode('VIÁTICOS PAGADOS EN UN PERIODO'));
		$this->pdf->SetAutoPageBreak(true, 15);
	 $this->pdf->SetMargins(9,3,6);
		 $this->pdf->SetCuadros("viatico_pagado_empleado");
		$this->pdf->AddPage();
		// $this->pdf->Cuadros(); //MUESTRA LOS CUADROS


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

	public function reporte_monto_viatico_mayor_a_menor($anio,$dir){
		$this->load->library('pdf');

		$this->load->model('Reportes_viaticos_model');
		$this->pdf = new Pdf('P','mm','Letter');
		$this->pdf->SetTituloPagina('MONTO DE VIÁTICOS DE MAYOR A MENOR');
		$this->pdf->SetTituloTabla1("NR");
		$this->pdf->SetTituloTabla2("NOMBRE EMPLEADO");
		$this->pdf->SetTituloTabla3("PASAJES");
		$this->pdf->SetTituloTabla4("VIÁTICOS");
		$this->pdf->SetTituloTabla5("TOTAL");
		$this->pdf->SetTitle(utf8_decode('VIÁTICOS DE MAYOR A MENOR'));
		$this->pdf->SetAutoPageBreak(true, 15);
	 $this->pdf->SetMargins(9,3,6);
	 $this->pdf->SetCuadros("monto_viatico_mayor_a_menor");
		$this->pdf->AddPage();

		 $this->pdf->SetAligns(array('L','J','R','R','R'));
		$this->pdf->SetWidths(array(20,89,24,24,24));

		$data  =array(
			'anio'=> $anio,
			'dir' => $dir
		);
		$viatico = $this->Reportes_viaticos_model->obtenerViaticoMayoraMenor($data);

		if($viatico->num_rows()>0){
				foreach ($viatico->result() as $viaticos) {
						$this->pdf->Row(
						array($viaticos->nr_empleado,utf8_decode(ucfirst($viaticos->nombre_completo)),"$ ".number_format($viaticos->pasajes,2,".",","),"$ ".number_format($viaticos->viaticos,2,".",","),"$ ".number_format($viaticos->total,2,".",",")),
						array('0','0','0','0','0'),
						array(array('Arial','','9'),array('','',''),array('','',''),array('','',''),array('','','')),
						array(false,false,false,false,false,false),
						array(array('0','0','0'),array('0','0','0'),array('0','0','0'),array('0','0','0'),array('0','0','0')),
						array(array('255','211','0'),array('33','92','19'),array('192','10','2'),array('192','10','2'),array('192','10','2')));

						$this->pdf->Ln(1);

				}
			}else{
				$this->pdf->Text($this->pdf->GetX()+25,$this->pdf->GetY()+10,"Sin Registros",0,'C', 0);
			}

	 $this->pdf->Output(); //Salida al navegador
	}

	public function mostrarCombo($id){
		$nuevo['id_seccion']=$id;
		$this->load->view('informes/comboSecciones',$nuevo);
	}
	public function mostrarCombo2($id){
		$nuevo['id_seccion']=$id;
		$this->load->view('informes/comboSecciones2',$nuevo);
	}
	public function mostrarCombo3($id){
		$nuevo['id_seccion']=$id;
		$this->load->view('informes/comboSecciones3',$nuevo);
	}
	public function mostrarCombo4($id){
		$nuevo['id_seccion']=$id;
		$this->load->view('informes/comboSecciones4',$nuevo);
	}

}
?>
