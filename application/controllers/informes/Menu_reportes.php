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
	public function reporte_ejemplo(){
		$this->load->library('mpdf');
		
		/*Constructor variables
			Modo: c
			Formato: A4 - default
			Tamaño de Fuente: 12
			Fuente: Arial
			Magen Izq: 32
			Margen Derecho: 25
			Margen arriba: 47
			Margen abajo: 47
			Margen cabecera: 10
			Margen Pie: 10
			Orientacion: P / L
		*/
		$this->mpdf=new mPDF('c','A4','10','Arial',10,10,35,17,3,9); 

	
		 
		
		$cuerpo = '
		<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Example</title>

<script src="jquery.min.js" type="text/javascript"></script>
<script src="highcharts.js" type="text/javascript"></script>

<script type="text/javascript">

</script>

<script type="text/javascript">

</script>
</head>
<body>
<div id="container1" style="width: 700px; height: 400px "></div>
</body>
</html>
					';
			       // LOAD a stylesheet         
      
		$this->mpdf->SetTitle('Viaticos por Pendiente por Empleado');
		//$this->mpdf->WriteHTML($stylesheet,1);  // The parameter 1 tells that this iscss/style only and no body/html/text         
		$script = '
var dat1 = [29.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4];
		var chart1;
$(document).ready(function(){
  chart1 = new Highcharts.Chart({
    chart: {renderTo: "container1"},
    series: [{data: dat1}]
  });
});';	
		$this->mpdf->WriteHTML($cuerpo);
		$this->mpdf->setJS($scrit);
		$this->mpdf->Output();
	}
	public function reporte_ejemplo1(){
		$this->load->library('j_pgraph');
		//$this->load->library('j_pgraph_bar');
		//$this->load->library('j_pgraph_barPlot');

		setlocale (LC_ALL, 'et_EE.ISO-8859-1');
		$data1y=array(12,8,19,3,10,5);
		$data2y=array(8,2,11,7,14,4);
		// Create the graph. These two calls are always required
		$this->graph = new Graph(310,200);
		$this->graph->clearTheme();
		$this->graph->SetScale("textlin");

		$this->graph->SetShadow();
		$this->graph->img->SetMargin(40,30,20,40);

		// Create the bar plots
		$this->b1plot = new BarPlot($data1y);
		$this->b1plot->SetFillColor("orange");


		// Create the grouped bar plot
		$this->gbplot = new AccBarPlot(array($this->b1plot));

		// ...and add it to the graPH
		$this->graph->Add($this->gbplot);

		$this->graph->title->Set("Accumulated bar plots");
		$this->graph->xaxis->title->Set("X-title");
		$this->graph->yaxis->title->Set("Y-title");

		$this->graph->title->SetFont(FF_FONT1,FS_BOLD);
		$this->graph->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
		$this->graph->xaxis->title->SetFont(FF_FONT1,FS_BOLD);

		
		$this->load->library('mpdf');
		
		/*Constructor variables
			Modo: c
			Formato: A4 - default
			Tamaño de Fuente: 12
			Fuente: Arial
			Magen Izq: 32
			Margen Derecho: 25
			Margen arriba: 47
			Margen abajo: 47
			Margen cabecera: 10
			Margen Pie: 10
			Orientacion: P / L
		*/
		$this->mpdf=new mPDF('c','A4','10','Arial',10,10,35,17,3,9); 

	
		 
		
		$cuerpo = '
		
					';
				// Display the graph
				$this->graph->Stroke();
				$cuerpo .= '
				
        ';         // LOAD a stylesheet         
      
		$this->mpdf->SetTitle('Viaticos por Pendiente por Empleado');
		$this->mpdf->WriteHTML($stylesheet,1);  // The parameter 1 tells that this iscss/style only and no body/html/text         

		$this->mpdf->WriteHTML($cuerpo);

		$this->mpdf->Output();
	}
	public function reporte_viatico_pendiente_empleado($id){
		$this->load->library('mpdf');
		$this->load->model('Reportes_viaticos_model');
		/*Constructor variables
			Modo: c
			Formato: A4 - default
			Tamaño de Fuente: 12
			Fuente: Arial
			Magen Izq: 32
			Margen Derecho: 25
			Margen arriba: 47
			Margen abajo: 47
			Margen cabecera: 10
			Margen Pie: 10
			Orientacion: P / L
		*/
		$this->mpdf=new mPDF('c','A4','10','Arial',10,10,35,17,3,9); 

		$cabecera = '<table><tr>
 		<td>
		    <img src="application/controllers/informes/escudo.jpg" width="85px" height="80px">
		</td>
		<td width="950px"><h6><center>MINISTERIO DE TRABAJO Y PREVISION SOCIAL <br> UNIDAD FINANCIERA INSTITUCIONAL <br> FONDO CIRCULANTE DEL MONTO FIJO <br> REPORTE VIATICOS PENDIENTE POR EMPLEADO</center><h6></td>
		<td>
		    <img src="application/controllers/informes/logomtps.jpeg"  width="125px" height="85px">
		   
		</td>
	 	</tr></table>';

	 	$pie = '{PAGENO} de {nbpg} páginas';


		$this->mpdf->SetHTMLHeader($cabecera);
		//$this->mpdf->SetHTMLFooter('{PAGENO} of {nbpg} pages');
		$this->mpdf->setFooter($pie);
		 $data = array('nr'=>$id);
		$empleado_NR_viatico = $this->Reportes_viaticos_model->obtenerNREmpleadoViatico($data);
		foreach ($empleado_NR_viatico->result() as $key) {	
		}
		$ids = array('nr' =>  $id);
		$viatico = $this->Reportes_viaticos_model->obtenerListaviatico_pendiente($ids);

		
		$cuerpo = '
		<h6>NR: '.$id.'	Empleado: '.($key->nombre_completo).'</h6>
			<table  class="" border="1" style="width:100%">
				
				<thead >

					<tr>
						<th align="center" rowspan="2">Fecha Solicitud</th>
						<th align="center" rowspan="2">Fecha Inicio Mision</th>
						<th align="center" rowspan="2">Fecha Fin Mision</th>
						<th align="center" rowspan="2">Actividad</th>
						<th align="center" rowspan="2">Detalle Actividad</th>
						<th align="center" colspan="3">Detalle Montos</th>
						<th align="center" rowspan="2">Estado</th>
						 
					</tr>
					<tr>
						<th align="center">Viaticos</th>
						<th align="center">Pasajes</th>
						<th align="center">Alojamiento</th>
					</tr>
				</thead>
				<tbody>
					
					';
				if($viatico->num_rows()>0){
				foreach ($viatico->result() as $viaticos) {
				
					$estado = $this->Reportes_viaticos_model->obtenerDetalleEstado($viaticos->estado);
					foreach ($estado->result() as $estado_detalle) {}
					$actividad = $this->Reportes_viaticos_model->obtenerDetalleActividad($viaticos->id_actividad_realizada);
					foreach ($actividad->result() as $actividad_detalle) {}
					$totales = $this->Reportes_viaticos_model->obtenerTotalMontos($viaticos->id_mision_oficial);
					foreach ($totales->result() as $totales_detalle) {}
						
					$cuerpo .= '
						<tr>
							<td>'.date('d-m-Y',strtotime($viaticos->fecha_solicitud)).'</td>
							<td>'.date('d-m-Y',strtotime($viaticos->fecha_mision_inicio)).'</td>
							<td>'.date('d-m-Y',strtotime($viaticos->fecha_mision_fin)).'</td>
							<td>'.($actividad_detalle->nombre_vyp_actividades).'</td>
							<td>'.utf8_decode($viaticos->detalle_actividad).'</td>
							<td>$'.number_format($totales_detalle->viatico,2,".",",").'</td>
							<td>$'.number_format($totales_detalle->pasaje,2,".",",").'</td>
							<td>$'.number_format($totales_detalle->alojamiento,2,".",",").'</td>
							<td>'.ucwords($estado_detalle->nombre_estado).'</td>
						</tr>
						';
					
					}
				}else{
				$cuerpo .= '
						<tr><td colspan="9"><center>No hay registros</center></td></tr>
					';
				}
				$cuerpo .= '
					
				</tbody>
			</table>

        ';         // LOAD a stylesheet         
        $stylesheet = file_get_contents(base_url().'assets/plugins/bootstrap/css/bootstrap.min.css');
		$this->mpdf->AddPage('L','','','','',10,10,35,17,3,9);
		$this->mpdf->SetTitle('Viaticos por Pendiente por Empleado');
		$this->mpdf->WriteHTML($stylesheet,1);  // The parameter 1 tells that this iscss/style only and no body/html/text         

		$this->mpdf->WriteHTML($cuerpo);

		$this->mpdf->Output();
	}

	public function reporte_viatico_pagado_empleado($id,$min,$max){
		$this->load->library('mpdf');
		$this->load->model('Reportes_viaticos_model');
		/*Constructor variables
			Modo: c
			Formato: A4 - default
			Tamaño de Fuente: 12
			Fuente: Arial
			Magen Izq: 32
			Margen Derecho: 25
			Margen arriba: 47
			Margen abajo: 47
			Margen cabecera: 10
			Margen Pie: 10
			Orientacion: P / L
		*/
		$this->mpdf=new mPDF('c','A4','10','Arial',10,10,35,17,3,9); 

		$cabecera = '<table><tr>
 		<td>
		    <img src="application/controllers/informes/escudo.jpg" width="85px" height="80px">
		</td>
		<td width="950px"><h6><center>MINISTERIO DE TRABAJO Y PREVISION SOCIAL <br> UNIDAD FINANCIERA INSTITUCIONAL <br> FONDO CIRCULANTE DEL MONTO FIJO <br> REPORTE VIATICOS PAGADOS POR EMPLEADO</center><h6></td>
		<td>
		    <img src="application/controllers/informes/logomtps.jpeg"  width="125px" height="85px">
		   
		</td>
	 	</tr></table>';

	 	$pie = '{PAGENO} de {nbpg} páginas';


		$this->mpdf->SetHTMLHeader($cabecera);
		//$this->mpdf->SetHTMLFooter('{PAGENO} of {nbpg} pages');
		$this->mpdf->setFooter($pie);
		 $data = array('nr'=>$id);
		$empleado_NR_viatico = $this->Reportes_viaticos_model->obtenerNREmpleadoViatico($data);
		foreach ($empleado_NR_viatico->result() as $key) {	
		}
		$ids = array(
			'nr' =>  $key->nr,
			'fmin' => $min,
			'fmax' => $max
		);
		$viatico = $this->Reportes_viaticos_model->obtenerListaviaticoPagado($ids);

		
		$cuerpo = '
		<h6>NR: '.$id.'	Empleado: '.($key->nombre_completo).'</h6>
			<table  class="" border="1" style="width:100%">
				
				<thead >

					<tr>
						<th align="center" rowspan="2">Fecha Solicitud</th>
						<th align="center" rowspan="2">Fecha Inicio Mision</th>
						<th align="center" rowspan="2">Fecha Fin Mision</th>
						<th align="center" rowspan="2">Actividad</th>
						<th align="center" rowspan="2">Detalle Actividad</th>
						<th align="center" colspan="3">Detalle Montos</th>
						<th align="center" rowspan="2">Estado</th>
						 
					</tr>
					<tr>
						<th align="center">Viaticos</th>
						<th align="center">Pasajes</th>
						<th align="center">Alojamiento</th>
					</tr>
				</thead>
				<tbody>
					
					';
				if($viatico->num_rows()>0){
				foreach ($viatico->result() as $viaticos) {
				
					$estado = $this->Reportes_viaticos_model->obtenerDetalleEstado($viaticos->estado);
					foreach ($estado->result() as $estado_detalle) {}
					$actividad = $this->Reportes_viaticos_model->obtenerDetalleActividad($viaticos->id_actividad_realizada);
					foreach ($actividad->result() as $actividad_detalle) {}
					$totales = $this->Reportes_viaticos_model->obtenerTotalMontos($viaticos->id_mision_oficial);
					foreach ($totales->result() as $totales_detalle) {}
						
					$cuerpo .= '
						<tr>
							<td>'.date('d-m-Y',strtotime($viaticos->fecha_solicitud)).'</td>
							<td>'.date('d-m-Y',strtotime($viaticos->fecha_mision_inicio)).'</td>
							<td>'.date('d-m-Y',strtotime($viaticos->fecha_mision_fin)).'</td>
							<td>'.($actividad_detalle->nombre_vyp_actividades).'</td>
							<td >'.utf8_decode($viaticos->detalle_actividad).'</td>
							<td>$'.number_format($totales_detalle->viatico,2,".",",").'</td>
							<td>$'.number_format($totales_detalle->pasaje,2,".",",").'</td>
							<td>$'.number_format($totales_detalle->alojamiento,2,".",",").'</td>
							<td>'.ucwords($estado_detalle->nombre_estado).'</td>
						</tr>
						';
					
					}
				}else{
					$cuerpo .= '
						<tr><td colspan="9"><center>No hay registros</center></td></tr>
					';
				}
				$cuerpo .= '
					
				</tbody>
			</table>

        ';         // LOAD a stylesheet         
        $stylesheet = file_get_contents(base_url().'assets/plugins/bootstrap/css/bootstrap.min.css');
		$this->mpdf->AddPage('L','','','','',10,10,35,17,3,9);
		$this->mpdf->SetTitle('Viaticos por Pagados por Empleado');
		$this->mpdf->WriteHTML($stylesheet,1);  // The parameter 1 tells that this iscss/style only and no body/html/text         
		$this->mpdf->WriteHTML($cuerpo);

		$this->mpdf->Output();
	}

	public function reporte_monto_viatico_mayor_a_menor($anio,$dir){
		$this->load->library('mpdf');
		$this->load->model('Reportes_viaticos_model');
		/*Constructor variables
			Modo: c
			Formato: A4 - default
			Tamaño de Fuente: 12
			Fuente: Arial
			Magen Izq: 32
			Margen Derecho: 25
			Margen arriba: 47
			Margen abajo: 47
			Margen cabecera: 10
			Margen Pie: 10
			Orientacion: P / L
		*/
		$this->mpdf=new mPDF('c','A4','10','Arial',10,10,35,17,3,9); 

		$cabecera = '<table><tr>
 		<td>
		    <img src="application/controllers/informes/escudo.jpg" width="85px" height="80px">
		</td>
		<td width="580px"><h6><center>MINISTERIO DE TRABAJO Y PREVISION SOCIAL <br> UNIDAD FINANCIERA INSTITUCIONAL <br> FONDO CIRCULANTE DEL MONTO FIJO <br> REPORTE VIÁTICOS DE MAYOR A MENOR</center><h6></td>
		<td>
		    <img src="application/controllers/informes/logomtps.jpeg"  width="125px" height="85px">
		   
		</td>
	 	</tr></table>';

	 	$pie = '{PAGENO} de {nbpg} páginas';


		$this->mpdf->SetHTMLHeader($cabecera);
		//$this->mpdf->SetHTMLFooter('{PAGENO} of {nbpg} pages');
		$this->mpdf->setFooter($pie);
		$data  =array(
			'anio'=> $anio,
			'dir' => $dir
		);
		$viatico = $this->Reportes_viaticos_model->obtenerViaticoMayoraMenor($data);

		$cuerpo = '
			<table  class="" border="1" style="width:100%">
				<thead >
					<tr>
						<th align="center" rowspan="2">NR</th>
						<th align="center" rowspan="2">Nombre Completo</th>
						<th align="center" colspan="4">Detalle Montos</th>
					</tr>
					<tr>
						<th align="center">Viaticos</th>
						<th align="center">Pasajes</th>
						<th align="center">Alojamiento</th>
						<th align="center">Total</th>
					</tr>
				</thead>
				<tbody>
					
					';
				if($viatico->num_rows()>0){
				foreach ($viatico->result() as $viaticos) {
					$cuerpo .= '
						<tr>
							<td>'.($viaticos->nr_empleado).'</td>
							<td>'.($viaticos->nombre_completo).'</td>
							<td style="text-align:right">$'.number_format($viaticos->viaticos,2,".",",").'</td>
							<td style="text-align:right">$'.number_format($viaticos->pasajes,2,".",",").'</td>
							<td style="text-align:right">$'.number_format($viaticos->alojamientos,2,".",",").'</td>
							<td style="text-align:right">$'.number_format($viaticos->total,2,".",",").'</td>
						</tr>
						';
					}
				}else{
					$cuerpo .= '
						<tr><td colspan="6"><center>No hay registros</center></td></tr>
					';
				}
				$cuerpo .= '
				</tbody>
			</table>
        ';         // LOAD a stylesheet         
        $stylesheet = file_get_contents(base_url().'assets/plugins/bootstrap/css/bootstrap.min.css');
		//$this->mpdf->AddPage('L','','','','',10,10,35,17,3,9);
		$this->mpdf->SetTitle('Viaticos de Mayor a Menor');
		$this->mpdf->WriteHTML($stylesheet,1);  // The parameter 1 tells that this iscss/style only and no body/html/text         
		$this->mpdf->WriteHTML($cuerpo);

		$this->mpdf->Output();
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

	public function reporte_viaticos_por_periodo($anio,$primer_mes,$segundo_mes,$tercer_mes,$cuarto_mes,$quinto_mes,$sexto_mes){
		$this->load->library('mpdf');
		$this->load->model('Reportes_viaticos_model');
		/*Constructor variables
			Modo: c
			Formato: A4 - default
			Tamaño de Fuente: 12
			Fuente: Arial
			Magen Izq: 32
			Margen Derecho: 25
			Margen arriba: 47
			Margen abajo: 47
			Margen cabecera: 10
			Margen Pie: 10
			Orientacion: P / L
		*/
		$this->mpdf=new mPDF('c','A4','10','Arial',10,10,35,17,3,9); 

		$cabecera = '<table><tr>
 		<td>
		    <img src="application/controllers/informes/escudo.jpg" width="85px" height="80px">
		</td>
		<td width="580px"><h6><center>MINISTERIO DE TRABAJO Y PREVISION SOCIAL <br> UNIDAD FINANCIERA INSTITUCIONAL <br> FONDO CIRCULANTE DEL MONTO FIJO <br> REPORTE VIÁTICOS POR PERIODO</center><h6></td>
		<td>
		    <img src="application/controllers/informes/logomtps.jpeg"  width="125px" height="85px">
		   
		</td>
	 	</tr></table>';

	 	$pie = '{PAGENO} de {nbpg} páginas';


		$this->mpdf->SetHTMLHeader($cabecera);
		//$this->mpdf->SetHTMLFooter('{PAGENO} of {nbpg} pages');
		$this->mpdf->setFooter($pie);
		$sumaPasajes=0;$sumaViaticos=0;$sumaTotal=0;
		$data  =array(
			'anio'=> $anio,
			'primer_mes'=>$primer_mes,
			'segundo_mes'=>$segundo_mes,
			'tercer_mes'=>$tercer_mes,
			'cuarto_mes'=>$cuarto_mes,
			'quinto_mes'=>$quinto_mes,
			'sexto_mes'=>$sexto_mes
		);
		$viatico = $this->Reportes_viaticos_model->obtenerViaticosPorPeriodo($data);
		$cuerpo = '
			<table  class="" border="1" style="width:100%">
				<thead >
					<tr>
						<th align="center" rowspan="2">Mes</th>
						<th align="center" rowspan="2">Concepto de Gasto</th>
						<th align="center" colspan="4">Detalle Montos</th>
					</tr>
					<tr>
						<th align="center">Viaticos</th>
						<th align="center">Pasajes</th>
						<th align="center">Alojamiento</th>
						<th align="center">Total</th>
					</tr>
				</thead>
				<tbody>
					
					';
				if($viatico->num_rows()>0){
				foreach ($viatico->result() as $viaticos) {
					if($viaticos->mes=="1")$mes="Enero";
					else if($viaticos->mes=="2")$mes="Febrero";
					else if($viaticos->mes=="3")$mes="Marzo";
					else if($viaticos->mes=="4")$mes="Abril";
					else if($viaticos->mes=="5")$mes="Mayo";
					else if($viaticos->mes=="6")$mes="Junio";
					else if($viaticos->mes=="7")$mes="Julio";
					else if($viaticos->mes=="8")$mes="Agosto";
					else if($viaticos->mes=="9")$mes="Septiembre";
					else if($viaticos->mes=="10")$mes="Octubre";
					else if($viaticos->mes=="11")$mes="Noviembre";
					else if($viaticos->mes=="12")$mes="Diciembre";
					$cuerpo .= '
						<tr>
							<td>'.($mes).'</td>
							<td>'.("Viáticos por Comisión Interna y Pasajes al Interior").'</td>
							<td style="text-align:right">$'.number_format($viaticos->viaticos,2,".",",").'</td>
							<td style="text-align:right">$'.number_format($viaticos->pasajes,2,".",",").'</td>
							<td style="text-align:right">$'.number_format($viaticos->alojamientos,2,".",",").'</td>
							<td style="text-align:right">$'.number_format($viaticos->total,2,".",",").'</td>
						</tr>
						';
					}
				}else{
					$cuerpo .= '
						<tr><td colspan="9"><center>No hay registros</center></td></tr>
					';
				}
				$cuerpo .= '
				</tbody>
			</table>
        ';         // LOAD a stylesheet         
        $stylesheet = file_get_contents(base_url().'assets/plugins/bootstrap/css/bootstrap.min.css');
		//$this->mpdf->AddPage('L','','','','',10,10,35,17,3,9);
		$this->mpdf->SetTitle('Viaticos por Periodo');
		$this->mpdf->WriteHTML($stylesheet,1);  // The parameter 1 tells that this iscss/style only and no body/html/text         
		$this->mpdf->WriteHTML($cuerpo);

		$this->mpdf->Output();
		
	}
}
?>
