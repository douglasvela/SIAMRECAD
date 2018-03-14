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
	public function viaticos_pendientes(){
		$this->load->view('templates/header');
		$this->load->view('informes/viaticos_pendientes');
		$this->load->view('templates/footer');

	}
	public function viaticos_pagados(){
		$this->load->view('templates/header');
		$this->load->view('informes/viaticos_pagados');
		$this->load->view('templates/footer');

	}
	public function viaticos_mayoramenor(){
		$this->load->view('templates/header');
		$this->load->view('informes/viaticos_mayoramenor');
		$this->load->view('templates/footer');

	}
	public function viaticos_por_periodo(){
		$this->load->view('templates/header');
		$this->load->view('informes/viaticos_por_periodo');
		$this->load->view('templates/footer');

	}
	public function viaticos_por_anio(){
		$this->load->view('templates/header');
		$this->load->view('informes/viaticos_por_anio');
		$this->load->view('templates/footer');
	}

	public function crear_grafico_viaticos_x_anio($anios){
		$this->load->library('j_pgraph');
		$this->load->model('Reportes_viaticos_model');
		setlocale (LC_ALL, 'et_EE.ISO-8859-1');
		$data = str_split($anios,4);//De cadena a array
		
		$data1y = array(0);
		$data2y = array(0);
		$data3y = array(0);
		$data4y = array(0);
		$labels = array(0);
		$i=0;
		$viatico_anual = $this->Reportes_viaticos_model->obtenerViaticoAnual($data);
		foreach ($viatico_anual->result() as $viatico_anual_detalle) {	
			$data4y[$i]=$viatico_anual_detalle->total_anio;
			$data1y[$i]=$viatico_anual_detalle->viatico;
			$data2y[$i]=$viatico_anual_detalle->pasaje;
			$data3y[$i]=$viatico_anual_detalle->alojamiento;
			$labels[$i]=$viatico_anual_detalle->anio;
			$i++;
		}
		
		// Create the graph. These two calls are always required
		$graph = new Graph(560,320);
		
		$graph->SetScale("textlin");
		
		$graph->SetShadow();

		$graph->img->SetMargin(40,30,30,70);

		// Create the bar plots
		$b1plot = new BarPlot($data1y);
		$b2plot = new BarPlot($data2y);
		$b3plot = new BarPlot($data3y);
		$b4plot = new BarPlot($data4y);
		
		// Create the grouped bar plot
		$gbplot = new GroupBarPlot(array($b4plot,$b1plot,$b2plot,$b3plot));

		// ...and add it to the graPH
		$graph->Add($gbplot);

		$b1plot->value->Show();
		//$b1plot->SetColor("#0000CD");
		$b2plot->SetFillColor('#B0C4DE');
		$b1plot->SetLegend("Viaticos");

		$b2plot->value->Show();
		$b2plot->SetLegend("Pasaje");
		$b3plot->value->Show();
		$b3plot->SetLegend("Alojamiento");
		$b4plot->value->Show();
		$b4plot->SetLegend("Total");

		$graph->title->Set(utf8_decode("Viaticos por año"));
		$graph->yaxis->title->Set("Cantidad en dólares");
		$graph->xaxis->title->Set(utf8_decode("Años"));

		$graph->title->SetFont(FF_ARIAL,FS_BOLD);
		$graph->yaxis->title->SetFont(FF_ARIAL,FS_BOLD);
		$graph->xaxis->SetTickLabels($labels);
		$graph->xaxis->title->SetFont(FF_ARIAL,FS_BOLD);
		$graph->yaxis->scale->SetGrace(10);

		
		
		// Display the graph
		$graph->Stroke(_IMG_HANDLER);
		$x = $this->session->userdata('usuario_viatico');
		$fileName = "application/controllers/informes/graficas/grafica_va_".$x.".png";
		$graph->img->Stream($fileName);

		// mostrarlo en el navegador
		//$graph->img->Headers();
		//$graph->img->Stream();
		
	}
	
	public function reporte_viaticos_x_anio($tipo,$anios){
		$this->load->library('mpdf');
		$this->load->model('Reportes_viaticos_model');
		$this->mpdf=new mPDF('c','A4','10','Arial',10,10,35,17,3,9);
		$this->crear_grafico_viaticos_x_anio($anios);
		$cabecera = '<table><tr>
 		<td>
		    <img src="application/controllers/informes/escudo.jpg" width="85px" height="80px">
		</td>
		<td width="550px"><h6><center>MINISTERIO DE TRABAJO Y PREVISION SOCIAL <br> UNIDAD FINANCIERA INSTITUCIONAL <br> FONDO CIRCULANTE DE MONTO FIJO <br> REPORTE VIATICOS POR AÑO</center><h6></td>
		<td>
		    <img src="application/controllers/informes/logomtps.jpeg"  width="125px" height="85px">
		   
		</td>
	 	</tr></table>';

	 	$pie = '{PAGENO} de {nbpg} páginas';
		$this->mpdf->SetHTMLHeader($cabecera);
		//$this->mpdf->SetHTMLFooter('{PAGENO} of {nbpg} pages');
		$this->mpdf->setFooter($pie);
		
		$cuerpo = '
			<table  class="" border="1" >
				<thead >
					<tr>
						<th align="center" rowspan="2" >Año</th>
						<th align="center" colspan="3" >Tipo</th>
						<th align="center" rowspan="2" >Total</th>
					</tr>
					<tr>
						<th align="center"  >Viatico</th>
						<th align="center"  >Pasaje</th>
						<th align="center"  >Alojamiento</th>

					</tr>
				</thead>
				<tbody>
					';
				$data = str_split($anios,4);
				//$data=array(2018,2017,2016,2015);
				$viatico = $this->Reportes_viaticos_model->obtenerViaticoAnual($data);
				if($viatico->num_rows()>0){
				foreach ($viatico->result() as $viaticos) {
					$cuerpo .= '
						<tr>
							<td align="center" style="width:180px">'.($viaticos->anio).'</td>
							<td align="center" style="width:180px">$'.number_format($viaticos->viatico,2,".",",").'</td>
							<td align="center" style="width:180px">$'.number_format($viaticos->pasaje,2,".",",").'</td>
							<td align="center" style="width:180px">$'.number_format($viaticos->alojamiento,2,".",",").'</td>
							<td align="center" style="width:180px">$'.number_format($viaticos->total_anio,2,".",",").'</td>
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
			</table><br>

			<img  src="application/controllers/informes/graficas/grafica_va_'.$this->session->userdata('usuario_viatico').'.png" alt="">
        '; 
        if($tipo=="pdf"){
			$stylesheet = file_get_contents(base_url().'assets/plugins/bootstrap/css/bootstrap.min.css');
			$this->mpdf->SetTitle('Viaticos por Año');
			$this->mpdf->WriteHTML($stylesheet,1);  // The parameter 1 tells that this iscss/style only and no body/html/
			$this->mpdf->WriteHTML($cuerpo);
			$this->mpdf->Output();
		}else if($tipo=="vista"){

		}else{
			
		}
	}

	public function crear_grafico_viaticos_x_depto($anios){
		$this->load->library('j_pgraph');
		$this->load->model('Reportes_viaticos_model');
		setlocale (LC_ALL, 'et_EE.ISO-8859-1');
		
		
		$data1y = array(0);
		$data2y = array(0);
		$data3y = array(0);
		$data4y = array(0);
		$labels = array(0);
		$i=0;
		$viatico_anual = $this->Reportes_viaticos_model->obtenerViaticoAnualxDepto($anios);
		
			foreach ($viatico_anual->result() as $viatico_anual_detalle) {	
				$data1y[$i]=$viatico_anual_detalle->viatico;
				$data2y[$i]=$viatico_anual_detalle->pasaje;
				$data3y[$i]=$viatico_anual_detalle->alojamiento;
				$data4y[$i]=$viatico_anual_detalle->total;
				$labels[$i]=$viatico_anual_detalle->departamento;
				$i++;
			}
		
		
		// Create the graph. These two calls are always required
		$graph = new Graph(700,500);
		
		$graph->SetScale("textlin");
		$graph->Set90AndMargin(0,0,0,0);
		$graph->SetShadow();

		//$graph->img->SetMargin(40,30,30,70);

		// Create the bar plots
		$b1plot = new BarPlot($data1y);
		$b2plot = new BarPlot($data2y);
		$b3plot = new BarPlot($data3y);
		$b4plot = new BarPlot($data4y);
	
		// Create the grouped bar plot
		$gbplot = new GroupBarPlot(array($b4plot,$b1plot,$b2plot,$b3plot));
		//$gbplot->value->SetFormat('%01.2f');

		// ...and add it to the graPH
		$graph->Add($gbplot);

		$b1plot->value->Show();
		$b2plot->SetFillColor('#B0C4DE');
		$b1plot->SetLegend("Viaticos");


		/******************************************************************
			Inicio cambiando formato de etiquetas a $0.00 dinero
		******************************************************************/

		$b1plot->value->SetFormat('$%01.2f');
		$b2plot->value->SetFormat('$%01.2f');
		$b3plot->value->SetFormat('$%01.2f');
		$b4plot->value->SetFormat('$%01.2f');

		$b1plot->value->SetFont(FF_ARIAL,FS_NORMAL,7);  // FS_BOLD para negrita
		$b2plot->value->SetFont(FF_ARIAL,FS_NORMAL,7);  // FS_BOLD para negrita
		$b3plot->value->SetFont(FF_ARIAL,FS_NORMAL,7);  // FS_BOLD para negrita
		$b4plot->value->SetFont(FF_ARIAL,FS_NORMAL,7);  // FS_BOLD para negrita

		/******************************************************************
			Fin cambiando formato de etiquetas a $0.00 dinero
		******************************************************************/

		$b2plot->value->Show();
		$b2plot->SetLegend("Pasaje");
		$b3plot->value->Show();
		$b3plot->SetLegend("Alojamiento");
		$b4plot->value->Show();
		$b4plot->SetLegend("Total");

		$graph->title->Set(utf8_decode("Viaticos por Departamento"));
		//$graph->yaxis->title->Set("Cantidad en dólares");
		$graph->xaxis->title->Set(utf8_decode("Departamentos"));

		$graph->title->SetFont(FF_ARIAL,FS_BOLD);
		$graph->yaxis->title->SetFont(FF_ARIAL,FS_BOLD);
		$graph->xaxis->SetTickLabels($labels);
		$graph->xaxis->title->SetFont(FF_ARIAL,FS_BOLD);
		$graph->yaxis->scale->SetGrace(10);

		/******************************************************************
			Inicio cambiando formato del eje Y a $0.00 dinero
		******************************************************************/
		$graph->yaxis->SetLabelFormat('$%d');
		$graph->yaxis->SetFont(FF_ARIAL,FS_NORMAL,8);  // FS_BOLD para negrita
		/******************************************************************
			Inicio cambiando formato del eje Y a $0.00 dinero
		******************************************************************/

		
		
		// Display the graph
		$graph->Stroke(_IMG_HANDLER);
		$x = $this->session->userdata('usuario_viatico');
		$fileName = "application/controllers/informes/graficas/grafica_depto_".$x.".png";
		$graph->img->Stream($fileName);

		// mostrarlo en el navegador
		//$graph->img->Headers();
		//$graph->img->Stream();
		
	}

	public function reporte_viaticos_x_depto($anios){
		$this->load->library('mpdf');
		$this->load->model('Reportes_viaticos_model');
		$this->mpdf=new mPDF('c','A4','10','Arial',10,10,35,17,3,9);
		$this->crear_grafico_viaticos_x_depto($anios);
		$cabecera = '<table><tr>
 		<td>
		    <img src="application/controllers/informes/escudo.jpg" width="85px" height="80px">
		</td>
		<td width="550px"><h6><center>MINISTERIO DE TRABAJO Y PREVISION SOCIAL <br> UNIDAD FINANCIERA INSTITUCIONAL <br> FONDO CIRCULANTE DE MONTO FIJO <br> REPORTE VIATICOS POR DEPARTAMENTO</center><h6></td>
		<td>
		    <img src="application/controllers/informes/logomtps.jpeg"  width="125px" height="85px">
		   
		</td>
	 	</tr></table>';

	 	$pie = '{PAGENO} de {nbpg} páginas';
		$this->mpdf->SetHTMLHeader($cabecera);
		//$this->mpdf->SetHTMLFooter('{PAGENO} of {nbpg} pages');
		$this->mpdf->setFooter($pie);
		
		$cuerpo = '
			<table  border="1" >
				<thead >
					<tr>
						<th align="center" rowspan="1" >Año: '.($anios).'</th>

						<th align="center" colspan="4" >Tipo</th>
					</tr>
					<tr>
						<th align="center" rowspan="1" >Departamento</th>
						<th align="center"  >Pasaje</th>
						<th align="center"  >Viatico</th>
						<th align="center"  >Alojamiento</th>
						<th align="center"  >Total</th>
					</tr>
				</thead>
				<tbody>
					';
					$data=$anios;
				//$data = str_split($anios,4);
				//$data=array(2018,2017,2016,2015);
				$viatico = $this->Reportes_viaticos_model->obtenerViaticoAnualxDepto($data);
				if($viatico->num_rows()>0){
				foreach ($viatico->result() as $viaticos) {
					$cuerpo .= '
						<tr>
							<td align="center" style="width:180px">'.($viaticos->departamento).'</td>
							<td align="center" style="width:180px">$'.number_format($viaticos->pasaje,2,".",",").'</td>
							<td align="center" style="width:180px">$'.number_format($viaticos->viatico,2,".",",").'</td>
							<td align="center" style="width:180px">$'.number_format($viaticos->alojamiento,2,".",",").'</td>
							<td align="center" style="width:180px">$'.number_format($viaticos->total,2,".",",").'</td>
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
			</table><br>
			<img src="application/controllers/informes/graficas/grafica_depto_'.$this->session->userdata('usuario_viatico').'.png" alt="">
			      '; 
		$stylesheet = file_get_contents(base_url().'assets/plugins/bootstrap/css/bootstrap.min.css');
		$this->mpdf->SetTitle('Viaticos por Año');
		$this->mpdf->WriteHTML($stylesheet,1);  // The parameter 1 tells that this iscss/style only and no body/html/
		$this->mpdf->WriteHTML($cuerpo);
		$this->mpdf->Output();
	}

	public function crear_grafico_viaticos_x_zona_depto($anios){
		$this->load->library('j_pgraph');
		$this->load->model('Reportes_viaticos_model');
		setlocale (LC_ALL, 'et_EE.ISO-8859-1');
		
				$total_viaticos_occidental=0;
				$total_pasajes_occidental=0;
				$total_alojamientos_occidental=0;
				$total_occidente=0;

				$total_viaticos_central=0;
				$total_pasajes_central=0;
				$total_alojamientos_central=0;
				$total_central=0;

				$total_viaticos_oriental=0;
				$total_pasajes_oriental=0;
				$total_alojamientos_oriental=0;
				$total_oriental=0;
		
		$data1y = array();
		$data2y = array();
		$data3y = array();
		$data4y = array();

		$labels = array();
		$i=0;
		$viatico_anual = $this->Reportes_viaticos_model->obtenerViaticoAnualxDepto($anios);
		foreach ($viatico_anual->result() as $viaticos) {	
			if($viaticos->id_depto>="00001" && $viaticos->id_depto<='00003'){
						$total_viaticos_occidental+= $viaticos->viatico;
						$total_pasajes_occidental+= $viaticos->pasaje;
						$total_alojamientos_occidental+= $viaticos->alojamiento;
					}

					if($viaticos->id_depto>="00004" && $viaticos->id_depto<='00010'){
						$total_viaticos_central+= $viaticos->viatico;
						$total_pasajes_central+= $viaticos->pasaje;
						$total_alojamientos_central+= $viaticos->alojamiento;
					}

					if($viaticos->id_depto>="00011" && $viaticos->id_depto<='00014'){
						$total_viaticos_oriental+=$viaticos->viatico;
						$total_pasajes_oriental+=$viaticos->pasaje;
						$total_alojamientos_oriental+=$viaticos->alojamiento;
					}
		}
		$total_occidente = $total_viaticos_occidental + $total_pasajes_occidental + $total_alojamientos_occidental;
		$total_central = $total_viaticos_central+$total_pasajes_central+$total_alojamientos_central;
		$total_oriental = $total_viaticos_oriental+$total_pasajes_oriental+$total_alojamientos_oriental;
			
			
		$data1y[$i]=$total_viaticos_occidental;
		$data2y[$i]=$total_pasajes_occidental;
		$data3y[$i]=$total_alojamientos_occidental;
		$data4y[$i]=$total_occidente;
		$labels[$i]="Occidental";
		$i++;
		$data1y[$i]=$total_viaticos_central;
		$data2y[$i]=$total_pasajes_central;
		$data3y[$i]=$total_alojamientos_central;
		$data4y[$i]=$total_central;
		$labels[$i]="Central";
		$i++;
		$data1y[$i]=$total_viaticos_oriental;
		$data2y[$i]=$total_pasajes_oriental;
		$data3y[$i]=$total_alojamientos_oriental;
		$data4y[$i]=$total_oriental;
		$labels[$i]="Oriental";
			
			
		//	$labels[1]="Central";
		//	$labels[2]="Oriental";

			
		// Create the graph. These two calls are always required
		$graph = new Graph(700,450);
		
		$graph->SetScale("textlin");
		//$graph->Set90AndMargin(0,0,0,0);
		$graph->SetShadow();

		$graph->img->SetMargin(50,30,30,100);

		// Create the bar plots
		$b1plot = new BarPlot($data1y);
		$b2plot = new BarPlot($data2y);
		$b3plot = new BarPlot($data3y);
		$b4plot = new BarPlot($data4y);
		
		
		// Create the grouped bar plot
		$gbplot = new GroupBarPlot(array($b4plot,$b1plot,$b2plot,$b3plot));

		// ...and add it to the graPH
		$graph->Add($gbplot);

		$b1plot->value->Show();
		//$b1plot->SetColor("#0000CD");
		$b2plot->SetFillColor('#B0C4DE');
		$b1plot->SetLegend("Viaticos");

		$b2plot->value->Show();
		$b2plot->SetLegend("Pasaje");
		$b3plot->value->Show();
		$b3plot->SetLegend("Alojamiento");
		$b4plot->value->Show();
		$b4plot->SetLegend("Total");
		

		$graph->title->Set(utf8_decode("Viaticos por Zona"));
		$graph->yaxis->title->Set("Cantidad en dólares");
		$graph->xaxis->title->Set(utf8_decode("Zonas"));

		$graph->title->SetFont(FF_ARIAL,FS_BOLD);
		$graph->yaxis->title->SetFont(FF_ARIAL,FS_BOLD);
		$graph->xaxis->SetTickLabels($labels);
		$graph->xaxis->title->SetFont(FF_ARIAL,FS_BOLD);
		$graph->yaxis->scale->SetGrace(5);

		
		
		// Display the graph
		$graph->Stroke(_IMG_HANDLER);
		$x = $this->session->userdata('usuario_viatico');
		$fileName = "application/controllers/informes/graficas/grafica_zona_depto_".$x.".png";
		$graph->img->Stream($fileName);

		// mostrarlo en el navegador
		//$graph->img->Headers();
		//$graph->img->Stream();
		
	}

	public function reporte_viaticos_x_zona_depto($anios){
		$this->load->library('mpdf');
		$this->load->model('Reportes_viaticos_model');
		$this->mpdf=new mPDF('c','A4','10','Arial',10,10,35,17,3,9);
		$this->crear_grafico_viaticos_x_zona_depto($anios);
		$cabecera = '<table><tr>
 		<td>
		    <img src="application/controllers/informes/escudo.jpg" width="85px" height="80px">
		</td>
		<td width="550px"><h6><center>MINISTERIO DE TRABAJO Y PREVISION SOCIAL <br> UNIDAD FINANCIERA INSTITUCIONAL <br> FONDO CIRCULANTE DE MONTO FIJO <br> REPORTE VIATICOS POR ZONA DEPARTAMENTAL</center><h6></td>
		<td>
		    <img src="application/controllers/informes/logomtps.jpeg"  width="125px" height="85px">
		   
		</td>
	 	</tr></table>';

	 	$pie = '{PAGENO} de {nbpg} páginas';
		$this->mpdf->SetHTMLHeader($cabecera);
		//$this->mpdf->SetHTMLFooter('{PAGENO} of {nbpg} pages');
		$this->mpdf->setFooter($pie);
		
		$cuerpo = '
			<table  border="1" >
				<thead >
					<tr>
						<th align="center" rowspan="1" >Año: '.($anios).'</th>

						<th align="center" colspan="3" >Tipo</th>
						<th align="center" rowspan="2"  >Total</th>
					</tr>
					<tr>
						<th align="center" rowspan="1" >Zona</th>
						<th align="center"  >Viatico</th>
						<th align="center"  >Pasajes</th>
						<th align="center"  >Alojamiento</th>
						
					</tr>
				</thead>
				<tbody>
					';
					$data=$anios;
				//$data = str_split($anios,4);
				//$data=array(2018,2017,2016,2015);
				$total_viaticos_occidental=0;
				$total_pasajes_occidental=0;
				$total_alojamientos_occidental=0;
				$total_occidente=0;

				$total_viaticos_central=0;
				$total_viaticos_central=0;
				$total_viaticos_central=0;
				$total_central=0;

				$total_viaticos_oriental=0;
				$total_viaticos_oriental=0;
				$total_viaticos_oriental=0;
				$total_oriental=0;

				$viatico = $this->Reportes_viaticos_model->obtenerViaticoAnualxDepto($data);
				if($viatico->num_rows()>0){
				foreach ($viatico->result() as $viaticos) {
					if($viaticos->id_depto>="00001" && $viaticos->id_depto<='00003'){
						$total_viaticos_occidental+= $viaticos->viatico;
						$total_pasajes_occidental+= $viaticos->pasaje;
						$total_alojamientos_occidental+= $viaticos->alojamiento;
					}

					if($viaticos->id_depto>="00004" && $viaticos->id_depto<='00010'){
						$total_viaticos_central+= $viaticos->viatico;
						$total_pasajes_central+= $viaticos->pasaje;
						$total_alojamientos_central+= $viaticos->alojamiento;
					}

					if($viaticos->id_depto>="00011" && $viaticos->id_depto<='00014'){
						$total_viaticos_oriental+=$viaticos->viatico;
						$total_pasajes_oriental+=$viaticos->pasaje;
						$total_alojamientos_oriental+=$viaticos->alojamiento;
					}
				}
				$total_occidente = $total_viaticos_occidental + $total_pasajes_occidental + $total_alojamientos_occidental;
				$total_central = $total_viaticos_central+$total_pasajes_central+$total_alojamientos_central;
				$total_oriental = $total_viaticos_oriental+$total_pasajes_oriental+$total_alojamientos_oriental;
					$cuerpo .= '
						<tr>
							<td align="center" style="width:180px">Occidental</td>
							<td align="center" style="width:180px">$'.number_format($total_viaticos_occidental,2,".",",").'</td>
							<td align="center" style="width:180px">$'.number_format($total_pasajes_occidental,2,".",",").'</td>
							<td align="center" style="width:180px">$'.number_format($total_alojamientos_occidental,2,".",",").'</td>
							<td align="center" style="width:180px">$'.number_format($total_occidente,2,".",",").'</td>
						</tr>
						<tr>
							<td align="center" style="width:180px">Central</td>
							<td align="center" style="width:180px">$'.number_format($total_viaticos_central,2,".",",").'</td>
							<td align="center" style="width:180px">$'.number_format($total_pasajes_central,2,".",",").'</td>
							<td align="center" style="width:180px">$'.number_format($total_alojamientos_central,2,".",",").'</td>
							<td align="center" style="width:180px">$'.number_format($total_central,2,".",",").'</td>
						</tr>
						<tr>
							<td align="center" style="width:180px">Oriental</td>
							<td align="center" style="width:180px">$'.number_format($total_viaticos_oriental,2,".",",").'</td>
							<td align="center" style="width:180px">$'.number_format($total_pasajes_oriental,2,".",",").'</td>
							<td align="center" style="width:180px">$'.number_format($total_alojamientos_oriental,2,".",",").'</td>
							<td align="center" style="width:180px">$'.number_format($total_oriental,2,".",",").'</td>
						</tr>
						';
					
				}else{
				$cuerpo .= '
						<tr><td colspan="9"><center>No hay registros</center></td></tr>
					';
				}
				$cuerpo .= '
				</tbody>
			</table><br>
			<img src="application/controllers/informes/graficas/grafica_zona_depto_'.$this->session->userdata('usuario_viatico').'.png" alt="">
			      '; 
		$stylesheet = file_get_contents(base_url().'assets/plugins/bootstrap/css/bootstrap.min.css');
		$this->mpdf->SetTitle('Viaticos por Año');
		$this->mpdf->WriteHTML($stylesheet,1);  // The parameter 1 tells that this iscss/style only and no body/html/
		$this->mpdf->WriteHTML($cuerpo);
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
	public function reporte_viatico_pendiente_empleado($tipo,$id){
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
		<td width="950px"><h6><center>MINISTERIO DE TRABAJO Y PREVISION SOCIAL <br> UNIDAD FINANCIERA INSTITUCIONAL <br> FONDO CIRCULANTE DE MONTO FIJO <br> REPORTE VIATICOS PENDIENTE POR EMPLEADO</center><h6></td>
		<td>
		    <img src="application/controllers/informes/logomtps.jpeg"  width="125px" height="85px">
		   
		</td>
	 	</tr></table>';
	 	$cabecera_vista = '<table><tr>
 		<td>
		    <img src="'.base_url().'assets/logos_vista/escudo.jpg" width="85px" height="80px">
		</td>
		<td width="950px"><h6><center>MINISTERIO DE TRABAJO Y PREVISION SOCIAL <br> UNIDAD FINANCIERA INSTITUCIONAL <br> FONDO CIRCULANTE DE MONTO FIJO <br> REPORTE VIATICOS PENDIENTE POR EMPLEADO</center><h6></td>
		<td>
		    <img src="'.base_url().'assets/logos_vista/logomtps.jpeg"  width="125px" height="85px">
		   
		</td>
	 	</tr></table>';
	 	$fecha=strftime( "%d-%m-%Y - %H-%M-%S", time() );
	 	$pie = 'Usuario: '.$this->session->userdata('usuario_viatico').'    Fecha y Hora Creacion: '.$fecha.'||{PAGENO} de {nbpg} páginas';
	 	


		$this->mpdf->SetHTMLHeader($cabecera);
		//$this->mpdf->SetHTMLFooter('{PAGENO} of {nbpg} pages');
		$this->mpdf->setFooter($pie);
		;
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
						<th align="center" colspan="3">Tipo</th>
						<th align="center" rowspan="2">Estado</th>
						 <th align="center" rowspan="2">Fecha de Pago</th>
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
							<td>'.date('d-m-Y',strtotime($viaticos->fecha_pago)).'</td>
						</tr>
						';
					
					}
				}else{
				$cuerpo .= '
						<tr><td colspan="10"><center>No hay registros</center></td></tr>
					';
				}
				$cuerpo .= '
					
				</tbody>
			</table>

        ';         // LOAD a stylesheet         
        if($tipo=="pdf"){
			$this->mpdf->AddPage('L','','','','',10,10,35,17,3,9);
			$this->mpdf->SetTitle('Viaticos por Pendiente por Empleado');
			$stylesheet = file_get_contents(base_url().'assets/plugins/bootstrap/css/bootstrap.min.css');
			$this->mpdf->WriteHTML($stylesheet,1);  // The parameter 1 tells that this iscss/style only and no body/html/text         
			$this->mpdf->WriteHTML($cuerpo);
			$this->mpdf->Output();
		}else if($tipo=="vista"){
			echo $cabecera_vista.=$cuerpo;
		}else if($tipo=="excel"){
			/** Error reporting */
			error_reporting(E_ALL);
			ini_set('display_errors', TRUE);
			ini_set('display_startup_errors', TRUE);
			date_default_timezone_set('America/Mexico_City');

			if (PHP_SAPI == 'cli')
				die('Este reporte solo se ejecuta en un navegador web');

			/** Include PHPExcel */
			$this->load->library('phpe');


			// Create new PHPExcel object
			$this->objPHPExcel = new Phpe();

			// Set document properties
			$this->objPHPExcel->getProperties()->setCreator("TravelExp")
										 ->setLastModifiedBy("TravelExp")
										 ->setTitle("Office 2007 XLSX Test Document")
										 ->setSubject("Office 2007 XLSX Test Document")
										 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
										 ->setKeywords("office 2007 openxml php");

			$titulosColumnas = array('FECHA SOLICITUD', 'FECHA INICIO MISION', 'FECHA FIN MISION', 'ACTIVIDAD','DETALLE ACTIVIDAD','VIATICOS','PASAJES','ALOJAMIENTOS','ESTADO','FECHA PAGO');
			$this->objPHPExcel->setActiveSheetIndex(0)
			    ->setCellValue('A10',  $titulosColumnas[0])  //Titulo de las columnas
			    ->setCellValue('B10',  $titulosColumnas[1])
			    ->setCellValue('C10',  $titulosColumnas[2])
			    ->setCellValue('D10',  $titulosColumnas[3])
			    ->setCellValue('E10',  $titulosColumnas[4])
			    ->setCellValue('F10',  $titulosColumnas[5])
			    ->setCellValue('G10',  $titulosColumnas[6])
			    ->setCellValue('H10',  $titulosColumnas[7])
			    ->setCellValue('I10',  $titulosColumnas[8])
			    ->setCellValue('J10',  $titulosColumnas[9]);							 
			$data = array('nr'=>$id);
			$empleado_NR_viatico = $this->Reportes_viaticos_model->obtenerNREmpleadoViatico($data);
			foreach ($empleado_NR_viatico->result() as $key) {	
			}
			$ids = array('nr' =>  $id);
			$viatico = $this->Reportes_viaticos_model->obtenerListaviatico_pendiente($ids);

			// Add some data
			$this->objPHPExcel->setActiveSheetIndex(0)
			            ->setCellValue('A1', "MINISTERIO DE TRABAJO Y PREVISION SOCIAL")
			            ->setCellValue('A2', "UNIDAD FINANCIERA INSTITUCIONAL")
			            ->setCellValue('A3', "FONDO CIRCULANTE DE MONTO FIJO")
			            ->setCellValue('A4', "REPORTE VIATICOS PENDIENTE POR EMPLEADO")
			            ->setCellValue('A7', "NR")
			            ->setCellValue('B7', $id)
			            ->setCellValue('A8', "NOMBRE")
			            ->setCellValue('B8', $key->nombre_completo);
			    $f=11;
			if($viatico->num_rows()>0){
				foreach ($viatico->result() as $viaticos) {
					$estado = $this->Reportes_viaticos_model->obtenerDetalleEstado($viaticos->estado);
					foreach ($estado->result() as $estado_detalle) {}
					$actividad = $this->Reportes_viaticos_model->obtenerDetalleActividad($viaticos->id_actividad_realizada);
					foreach ($actividad->result() as $actividad_detalle) {}
					$totales = $this->Reportes_viaticos_model->obtenerTotalMontos($viaticos->id_mision_oficial);
					foreach ($totales->result() as $totales_detalle) {}

				$this->objPHPExcel->getActiveSheet()->getStyle('F'.$f.':H'.$f)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);

				// Miscellaneous glyphs, UTF-8
				$this->objPHPExcel->setActiveSheetIndex(0)
				            ->setCellValue('A'.$f, date('d-m-Y',strtotime($viaticos->fecha_solicitud)))
				            ->setCellValue('B'.$f, date('d-m-Y',strtotime($viaticos->fecha_mision_inicio)))
				            ->setCellValue('C'.$f, date('d-m-Y',strtotime($viaticos->fecha_mision_fin)))
				            ->setCellValue('D'.$f, ($actividad_detalle->nombre_vyp_actividades))
				            ->setCellValue('E'.$f,utf8_decode($viaticos->detalle_actividad))
				            ->setCellValue('F'.$f,number_format($totales_detalle->viatico,2,".",","))
				            ->setCellValue('G'.$f,number_format($totales_detalle->pasaje,2,".",","))
				            ->setCellValue('H'.$f,number_format($totales_detalle->alojamiento,2,".",","))
				            ->setCellValue('I'.$f,ucwords($estado_detalle->nombre_estado))
				            ->setCellValue('J'.$f,date('d-m-Y',strtotime($viaticos->fecha_pago)));
				         $f++;
				}
			}else{
				$this->objPHPExcel->setActiveSheetIndex(0)
				            ->setCellValue('A'.$f, "NO HAY REGISTROS")
				            ->mergeCells('A'.$f.':D'.$f);

			}
			
			$fecha=strftime( "%d-%m-%Y - %H-%M-%S", time() );
			$this->objPHPExcel->setActiveSheetIndex(0)
				->setCellValue("A".$f+=4,"Fecha y Hora de Creación ")
				->setCellValue("B".$f,$fecha)
				->setCellValue("A".$f+=1,"Usuario")
				->setCellValue("B".$f,$this->session->userdata('usuario_viatico'));

			$this->objPHPExcel->setActiveSheetIndex(0)
    			->mergeCells('A1:C1')
    			->mergeCells('A2:C2')
    			->mergeCells('A3:C3')
    			->mergeCells('A4:C4')
    			->mergeCells('B8:C8');

			for($i = 'A'; $i <= 'J'; $i++){
				for($ii = '7'; $ii <= '50'; $ii++){
			    $this->objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($i,$ii)->setAutoSize(TRUE);
				}
			}
			$this->objPHPExcel->setActiveSheetIndex(0)->getStyle('A1:A8')->getFont()->setBold(true); 
			$this->objPHPExcel->setActiveSheetIndex(0)->getStyle('A10:K10')->getFont()->setBold(true); 


			// Rename worksheet
			$this->objPHPExcel->getActiveSheet()->setTitle('Viaticos Pendientes');


			// Set active sheet index to the first sheet, so Excel opens this as the first sheet
			$this->objPHPExcel->setActiveSheetIndex(0);


			// Redirect output to a client’s web browser (Excel5)
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="Viaticos_pendientes.xls"');
			header('Cache-Control: max-age=0');
			// If you're serving to IE 9, then the following may be needed
			header('Cache-Control: max-age=1');

			// If you're serving to IE over SSL, then the following may be needed
			header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
			header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
			header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
			header ('Pragma: public'); // HTTP/1.0

			 

        	$writer = new PHPExcel_Writer_Excel5($this->objPHPExcel);
			header('Content-type: application/vnd.ms-excel');
			$writer->save('php://output');
			//exit;
		}
	}

	public function reporte_viatico_pagado_empleado($tipo,$id,$min,$max){
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
		<td width="950px"><h6><center>MINISTERIO DE TRABAJO Y PREVISION SOCIAL <br> UNIDAD FINANCIERA INSTITUCIONAL <br> FONDO CIRCULANTE DE MONTO FIJO <br> REPORTE VIATICOS PAGADOS POR EMPLEADO</center><h6></td>
		<td>
		    <img src="application/controllers/informes/logomtps.jpeg"  width="125px" height="85px">
		   
		</td>
	 	</tr></table>';

	 	$cabecera_vista = '<table><tr>
 		<td>
		    <img src="'.base_url().'assets/logos_vista/escudo.jpg" width="85px" height="80px">
		</td>
		<td width="950px"><h6><center>MINISTERIO DE TRABAJO Y PREVISION SOCIAL <br> UNIDAD FINANCIERA INSTITUCIONAL <br> FONDO CIRCULANTE DE MONTO FIJO <br> REPORTE VIATICOS PAGADOS POR EMPLEADO</center><h6></td>
		<td>
		    <img src="'.base_url().'assets/logos_vista/logomtps.jpeg"  width="125px" height="85px">
		   
		</td>
	 	</tr></table>';
	 	$fecha=strftime( "%d-%m-%Y - %H-%M-%S", time() );
	 	$pie = 'Usuario: '.$this->session->userdata('usuario_viatico').'    Fecha y Hora Creacion: '.$fecha.'||{PAGENO} de {nbpg} páginas';


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
						<th align="center" colspan="3">Tipo</th>
						<th align="center" rowspan="2">Estado</th>
						 <th align="center" rowspan="2">Fecha Pago</th>
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
							<td>'.date('d-m-Y',strtotime($viaticos->fecha_pago)).'</td>
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
        if($tipo=="pdf"){         
	        $stylesheet = file_get_contents(base_url().'assets/plugins/bootstrap/css/bootstrap.min.css');
			$this->mpdf->AddPage('L','','','','',10,10,35,17,3,9);
			$this->mpdf->SetTitle('Viaticos por Pagados por Empleado');
			$this->mpdf->WriteHTML($stylesheet,1);  // The parameter 1 tells that this iscss/style only and no body/html/text         
			$this->mpdf->WriteHTML($cuerpo);

			$this->mpdf->Output();
		}else if($tipo=="vista"){
			echo $cabecera_vista.=$cuerpo;
		}else{
			/** Error reporting */
			error_reporting(E_ALL);
			ini_set('display_errors', TRUE);
			ini_set('display_startup_errors', TRUE);
			date_default_timezone_set('America/Mexico_City');

			if (PHP_SAPI == 'cli')
				die('Este reporte solo se ejecuta en un navegador web');

			/** Include PHPExcel */
			$this->load->library('phpe');


			// Create new PHPExcel object
			$this->objPHPExcel = new Phpe();

			// Set document properties
			$this->objPHPExcel->getProperties()->setCreator("TravelExp")
										 ->setLastModifiedBy("TravelExp")
										 ->setTitle("Office 2007 XLSX Test Document")
										 ->setSubject("Office 2007 XLSX Test Document")
										 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
										 ->setKeywords("office 2007 openxml php");

			$titulosColumnas = array('FECHA SOLICITUD', 'FECHA INICIO MISION', 'FECHA FIN MISION', 'ACTIVIDAD','DETALLE ACTIVIDAD','VIATICOS','PASAJES','ALOJAMIENTOS','ESTADO','FECHA PAGO');
			$this->objPHPExcel->setActiveSheetIndex(0)
			    ->setCellValue('A10',  $titulosColumnas[0])  //Titulo de las columnas
			    ->setCellValue('B10',  $titulosColumnas[1])
			    ->setCellValue('C10',  $titulosColumnas[2])
			    ->setCellValue('D10',  $titulosColumnas[3])
			    ->setCellValue('E10',  $titulosColumnas[4])
			    ->setCellValue('F10',  $titulosColumnas[5])
			    ->setCellValue('G10',  $titulosColumnas[6])
			    ->setCellValue('H10',  $titulosColumnas[7])
			    ->setCellValue('I10',  $titulosColumnas[8])
			    ->setCellValue('J10',  $titulosColumnas[9]);							 
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

			// Add some data
			$this->objPHPExcel->setActiveSheetIndex(0)
			            ->setCellValue('A1', "MINISTERIO DE TRABAJO Y PREVISION SOCIAL")
			            ->setCellValue('A2', "UNIDAD FINANCIERA INSTITUCIONAL")
			            ->setCellValue('A3', "FONDO CIRCULANTE DE MONTO FIJO")
			            ->setCellValue('A4', "REPORTE VIATICOS PAGADOS POR EMPLEADO")
			            ->setCellValue('A7', "NR")
			            ->setCellValue('B7', $id)
			            ->setCellValue('A8', "NOMBRE")
			            ->setCellValue('B8', $key->nombre_completo);
			    $f=11;
			if($viatico->num_rows()>0){
				foreach ($viatico->result() as $viaticos) {
					$estado = $this->Reportes_viaticos_model->obtenerDetalleEstado($viaticos->estado);
					foreach ($estado->result() as $estado_detalle) {}
					$actividad = $this->Reportes_viaticos_model->obtenerDetalleActividad($viaticos->id_actividad_realizada);
					foreach ($actividad->result() as $actividad_detalle) {}
					$totales = $this->Reportes_viaticos_model->obtenerTotalMontos($viaticos->id_mision_oficial);
					foreach ($totales->result() as $totales_detalle) {}

				$this->objPHPExcel->getActiveSheet()->getStyle('F'.$f.':H'.$f)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);

				// Miscellaneous glyphs, UTF-8
				$this->objPHPExcel->setActiveSheetIndex(0)
				            ->setCellValue('A'.$f, date('d-m-Y',strtotime($viaticos->fecha_solicitud)))
				            ->setCellValue('B'.$f, date('d-m-Y',strtotime($viaticos->fecha_mision_inicio)))
				            ->setCellValue('C'.$f, date('d-m-Y',strtotime($viaticos->fecha_mision_fin)))
				            ->setCellValue('D'.$f, ($actividad_detalle->nombre_vyp_actividades))
				            ->setCellValue('E'.$f,utf8_decode($viaticos->detalle_actividad))
				            ->setCellValue('F'.$f,number_format($totales_detalle->viatico,2,".",","))
				            ->setCellValue('G'.$f,number_format($totales_detalle->pasaje,2,".",","))
				            ->setCellValue('H'.$f,number_format($totales_detalle->alojamiento,2,".",","))
				            ->setCellValue('I'.$f,ucwords($estado_detalle->nombre_estado))
				            ->setCellValue('J'.$f,date('d-m-Y',strtotime($viaticos->fecha_pago)));
				         $f++;
				}
			}else{
				$this->objPHPExcel->setActiveSheetIndex(0)
				            ->setCellValue('A'.$f, "NO HAY REGISTROS")
				            ->mergeCells('A'.$f.':D'.$f);

			}
			
			$fecha=strftime( "%d-%m-%Y - %H-%M-%S", time() );
			$this->objPHPExcel->setActiveSheetIndex(0)
				->setCellValue("A".$f+=4,"Fecha y Hora de Creación ")
				->setCellValue("B".$f,$fecha)
				->setCellValue("A".$f+=1,"Usuario")
				->setCellValue("B".$f,$this->session->userdata('usuario_viatico'));

			$this->objPHPExcel->setActiveSheetIndex(0)
    			->mergeCells('A1:C1')
    			->mergeCells('A2:C2')
    			->mergeCells('A3:C3')
    			->mergeCells('A4:C4')
    			->mergeCells('B8:C8');

			for($i = 'A'; $i <= 'J'; $i++){
				for($ii = '7'; $ii <= '50'; $ii++){
			    $this->objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($i,$ii)->setAutoSize(TRUE);
				}
			}
			$this->objPHPExcel->setActiveSheetIndex(0)->getStyle('A1:A8')->getFont()->setBold(true); 
			$this->objPHPExcel->setActiveSheetIndex(0)->getStyle('A10:K10')->getFont()->setBold(true); 


			// Rename worksheet
			$this->objPHPExcel->getActiveSheet()->setTitle('Viaticos Pagados');


			// Set active sheet index to the first sheet, so Excel opens this as the first sheet
			$this->objPHPExcel->setActiveSheetIndex(0);


			// Redirect output to a client’s web browser (Excel5)
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="Viaticos_pagados.xls"');
			header('Cache-Control: max-age=0');
			// If you're serving to IE 9, then the following may be needed
			header('Cache-Control: max-age=1');

			// If you're serving to IE over SSL, then the following may be needed
			header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
			header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
			header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
			header ('Pragma: public'); // HTTP/1.0

			 

        	$writer = new PHPExcel_Writer_Excel5($this->objPHPExcel);
			header('Content-type: application/vnd.ms-excel');
			$writer->save('php://output');
			//exit;
		}
	}

	public function reporte_monto_viatico_mayor_a_menor($tipo,$anio,$dir,$recursividad){
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
		<td width="580px"><h6><center>MINISTERIO DE TRABAJO Y PREVISION SOCIAL <br> UNIDAD FINANCIERA INSTITUCIONAL <br> FONDO CIRCULANTE DE MONTO FIJO <br> REPORTE VIÁTICOS DE MAYOR A MENOR</center><h6></td>
		<td>
		    <img src="application/controllers/informes/logomtps.jpeg"  width="125px" height="85px">
		   
		</td>
	 	</tr></table>';

	 	$cabecera_vista = '<table><tr>
 		<td>
		    <img src="'.base_url().'assets/logos_vista/escudo.jpg" width="85px" height="80px">
		</td>
		<td width="950px"><h6><center>MINISTERIO DE TRABAJO Y PREVISION SOCIAL <br> UNIDAD FINANCIERA INSTITUCIONAL <br> FONDO CIRCULANTE DE MONTO FIJO <br> REPORTE VIÁTICOS DE MAYOR A MENOR</center><h6></td>
		<td>
		    <img src="'.base_url().'assets/logos_vista/logomtps.jpeg"  width="125px" height="85px">
		   
		</td>
	 	</tr></table>';
	 	$fecha=strftime( "%d-%m-%Y - %H-%M-%S", time() );
	 	$pie = 'Usuario: '.$this->session->userdata('usuario_viatico').'    Fecha y Hora Creacion: '.$fecha.'||{PAGENO} de {nbpg} páginas';


		$this->mpdf->SetHTMLHeader($cabecera);
		//$this->mpdf->SetHTMLFooter('{PAGENO} of {nbpg} pages');
		$this->mpdf->setFooter($pie);
		$data  =array(
			'anio'=> $anio,
			'dir' => $dir,
			'recursividad' => $recursividad
		);
		$viatico = $this->Reportes_viaticos_model->obtenerViaticoMayoraMenor($data);
		$nombre_seccion = $this->Reportes_viaticos_model->obtenerNombreSeccion($data);
		foreach ($nombre_seccion->result() as $keynombre_seccion) {
			# code...
		}
		if($recursividad=="si"){
			$mensaje="*INCLUYE SECCIONES INTERNAS";
		}else{
			$mensaje="*NO INCLUYE SECCIONES INTERNAS";
		}
		$cuerpo = '
		<h6>Sección: '.($keynombre_seccion->nombre_seccion).'</h6>
		<h6>Año: '.$anio.'</h6>
		<p>'.$mensaje.'</p>
			<table  class="" border="1" style="width:100%">
				<thead >
					<tr>
						<th align="center" rowspan="2">NR</th>
						<th align="center" rowspan="2">Nombre Completo</th>
						<th align="center" colspan="4">Tipo</th>
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
					$total_viaticos=0;
					$total_pasajes=0;
					$total_alojamientos=0;
					$total_total=0;
				if($viatico->num_rows()>0){
				foreach ($viatico->result() as $viaticos) {
					$total_viaticos=$total_viaticos+$viaticos->viaticos;
					$total_pasajes=$total_pasajes+$viaticos->pasajes;
					$total_alojamientos=$total_alojamientos+$viaticos->alojamientos;
					$total_total=$total_viaticos+$total_pasajes+$total_alojamientos;
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
					<tr>
						<th colspan="2">Total</th>
						<th style="text-align:right">$'.number_format($total_viaticos,2,".",",").'</th>
						<th style="text-align:right">$'.number_format($total_pasajes,2,".",",").'</th>
						<th style="text-align:right">$'.number_format($total_alojamientos,2,".",",").'</th>
						<th style="text-align:right">$'.number_format($total_total,2,".",",").'</th>
					</tr>
				</tbody>
			</table>
        ';         // LOAD a stylesheet         
        

		if($tipo=="pdf"){
			$stylesheet = file_get_contents(base_url().'assets/plugins/bootstrap/css/bootstrap.min.css');
			//$this->mpdf->AddPage('L','','','','',10,10,35,17,3,9);
			$this->mpdf->SetTitle('Viaticos de Mayor a Menor');
			$this->mpdf->WriteHTML($stylesheet,1);  // The parameter 1 tells that this iscss/style only and no body/html/text         
			$this->mpdf->WriteHTML($cuerpo);

			$this->mpdf->Output();
		}else if($tipo=="vista"){
			echo $cabecera_vista.$cuerpo;
		}else{
			/** Error reporting */
			error_reporting(E_ALL);
			ini_set('display_errors', TRUE);
			ini_set('display_startup_errors', TRUE);
			date_default_timezone_set('America/Mexico_City');

			if (PHP_SAPI == 'cli')
				die('Este reporte solo se ejecuta en un navegador web');

			/** Include PHPExcel */
			$this->load->library('phpe');


			// Create new PHPExcel object
			$this->objPHPExcel = new Phpe();

			// Set document properties
			$this->objPHPExcel->getProperties()->setCreator("TravelExp")
										 ->setLastModifiedBy("TravelExp")
										 ->setTitle("Office 2007 XLSX Test Document")
										 ->setSubject("Office 2007 XLSX Test Document")
										 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
										 ->setKeywords("office 2007 openxml php");

			$titulosColumnas = array('NR', 'NOMBRE COMPLETO','VIATICOS','PASAJES','ALOJAMIENTOS','TOTAL');
			$this->objPHPExcel->setActiveSheetIndex(0)
			    ->setCellValue('A10',  $titulosColumnas[0])  //Titulo de las columnas
			    ->setCellValue('B10',  $titulosColumnas[1])
			    ->setCellValue('C10',  $titulosColumnas[2])
			    ->setCellValue('D10',  $titulosColumnas[3])
			    ->setCellValue('E10',  $titulosColumnas[4])
			    ->setCellValue('F10',  $titulosColumnas[5]);

			$data  =array(
				'anio'=> $anio,
				'dir' => $dir,
				'recursividad' => $recursividad
			);
			$viatico = $this->Reportes_viaticos_model->obtenerViaticoMayoraMenor($data);
			$nombre_seccion = $this->Reportes_viaticos_model->obtenerNombreSeccion($data);
			foreach ($nombre_seccion->result() as $keynombre_seccion) {
				# code...
			}
			$this->objPHPExcel->setActiveSheetIndex(0)
			            ->setCellValue('A1', "MINISTERIO DE TRABAJO Y PREVISION SOCIAL")
			            ->setCellValue('A2', "UNIDAD FINANCIERA INSTITUCIONAL")
			            ->setCellValue('A3', "FONDO CIRCULANTE DE MONTO FIJO")
			            ->setCellValue('A4', "REPORTE VIATICOS DE MAYOR A MENOR POR EMPLEADO")
			            ->setCellValue('A8', "Año")
			            ->setCellValue('B8', $anio)
			            ->setCellValue('A7', "Sección")
			            ->setCellValue('B7', $keynombre_seccion->nombre_seccion);
			if($recursividad=="si"){
				$this->objPHPExcel->setActiveSheetIndex(0)
			            ->setCellValue('B9', "*INCLUYE SECCIONES INTERNAS");
			}else{
				$this->objPHPExcel->setActiveSheetIndex(0)
			            ->setCellValue('B9', "*NO INCLUYE SECCIONES INTERNAS");
			}
					$total_viaticos=0;
					$total_pasajes=0;
					$total_alojamientos=0;
					$total_total=0;
					$f=11;
			if($viatico->num_rows()>0){
				foreach ($viatico->result() as $viaticos) {
					$total_viaticos=$total_viaticos+$viaticos->viaticos;
					$total_pasajes=$total_pasajes+$viaticos->pasajes;
					$total_alojamientos=$total_alojamientos+$viaticos->alojamientos;
					$total_total=$total_viaticos+$total_pasajes+$total_alojamientos;

					$this->objPHPExcel->getActiveSheet()->getStyle('C'.$f.':F'.$f)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
					$this->objPHPExcel->getActiveSheet()->getStyle('A'.$f)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
					// Miscellaneous glyphs, UTF-8
					$this->objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A'.$f, $viaticos->nr_empleado)
							->setCellValue('B'.$f, $viaticos->nombre_completo)
				            ->setCellValue('C'.$f, number_format($viaticos->viaticos,2,".",","))
				            ->setCellValue('D'.$f, number_format($viaticos->pasajes,2,".",","))
				            ->setCellValue('E'.$f, number_format($viaticos->alojamientos,2,".",","))
				            ->setCellValue('F'.$f, number_format($viaticos->total,2,".",","));
						$f++;
					}

					$this->objPHPExcel->getActiveSheet()->getStyle('C'.$f.':F'.$f)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
					$this->objPHPExcel->getActiveSheet()->getStyle('A'.$f.':F'.$f)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					$this->objPHPExcel->setActiveSheetIndex(0)
							->mergeCells('A'.$f.':B'.$f)
							->setCellValue('A'.$f, "Total")
				            ->setCellValue('C'.$f, number_format($total_viaticos,2,".",","))
				            ->setCellValue('D'.$f, number_format($total_pasajes,2,".",","))
				            ->setCellValue('E'.$f, number_format($total_alojamientos,2,".",","))
				            ->setCellValue('F'.$f, number_format($total_total,2,".",","));
				    $this->objPHPExcel->setActiveSheetIndex(0)->getStyle('A'.$f.':F'.$f)->getFont()->setBold(true); 
			}else{
				$this->objPHPExcel->setActiveSheetIndex(0)
				            ->setCellValue('A'.$f, "NO HAY REGISTROS")
				            ->mergeCells('A'.$f.':D'.$f);
			}

			$fecha=strftime( "%d-%m-%Y - %H-%M-%S", time() );
			$this->objPHPExcel->setActiveSheetIndex(0)
				->setCellValue("A".$f+=4,"Fecha y Hora de Creación ")
				->setCellValue("B".$f,$fecha)
				->setCellValue("A".$f+=1,"Usuario")
				->setCellValue("B".$f,$this->session->userdata('usuario_viatico'));

			$this->objPHPExcel->setActiveSheetIndex(0)
    			->mergeCells('A1:C1')
    			->mergeCells('A2:C2')
    			->mergeCells('A3:C3')
    			->mergeCells('A4:C4')
    			->mergeCells('B7:C7');

			for($i = 'A'; $i <= 'F'; $i++){
				for($ii = '7'; $ii <= '50'; $ii++){
			    $this->objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($i,$ii)->setAutoSize(TRUE);
				}
			}
			$this->objPHPExcel->setActiveSheetIndex(0)->getStyle('A1:A8')->getFont()->setBold(true); 
			$this->objPHPExcel->setActiveSheetIndex(0)->getStyle('A10:K10')->getFont()->setBold(true); 



			// Rename worksheet
			$this->objPHPExcel->getActiveSheet()->setTitle('Viaticos De Mayor a Menor');
			// Redirect output to a client’s web browser (Excel5)
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="Viaticos_mayoramenor.xls"');
			header('Cache-Control: max-age=0');
			// If you're serving to IE 9, then the following may be needed
			header('Cache-Control: max-age=1');

			// If you're serving to IE over SSL, then the following may be needed
			header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
			header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
			header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
			header ('Pragma: public'); // HTTP/1.0

			 

        	$writer = new PHPExcel_Writer_Excel5($this->objPHPExcel);
			header('Content-type: application/vnd.ms-excel');
			$writer->save('php://output');
			//exit;
		}//FIN ELSE EXCEL
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

	public function crear_grafico_viaticos_x_mes($anio,$primer_mes,$segundo_mes,$tercer_mes,$cuarto_mes,$quinto_mes,$sexto_mes){
		$this->load->library('j_pgraph');
		$this->load->model('Reportes_viaticos_model');
		setlocale (LC_ALL, 'et_EE.ISO-8859-1');
		
		$data1y = array(0);
		$data2y = array(0);
		$data3y = array(0);
		$data4y = array(0);
		$labels = array(0);
		$i=0;
		$mes;
		$data  =array(
			'anio'=> $anio,
			'primer_mes'=>$primer_mes,
			'segundo_mes'=>$segundo_mes,
			'tercer_mes'=>$tercer_mes,
			'cuarto_mes'=>$cuarto_mes,
			'quinto_mes'=>$quinto_mes,
			'sexto_mes'=>$sexto_mes
		);
		$viatico_mes = $this->Reportes_viaticos_model->obtenerViaticosPorPeriodo($data);
		foreach ($viatico_mes->result() as $viatico_mes_detalle) {	
			if($viatico_mes_detalle->mes=="1")$mes="Enero";
					else if($viatico_mes_detalle->mes=="2")$mes="Febrero";
					else if($viatico_mes_detalle->mes=="3")$mes="Marzo";
					else if($viatico_mes_detalle->mes=="4")$mes="Abril";
					else if($viatico_mes_detalle->mes=="5")$mes="Mayo";
					else if($viatico_mes_detalle->mes=="6")$mes="Junio";
					else if($viatico_mes_detalle->mes=="7")$mes="Julio";
					else if($viatico_mes_detalle->mes=="8")$mes="Agosto";
					else if($viatico_mes_detalle->mes=="9")$mes="Septiembre";
					else if($viatico_mes_detalle->mes=="10")$mes="Octubre";
					else if($viatico_mes_detalle->mes=="11")$mes="Noviembre";
					else if($viatico_mes_detalle->mes=="12")$mes="Diciembre";
			$data1y[$i]=$viatico_mes_detalle->viaticos;
			$data2y[$i]=$viatico_mes_detalle->pasajes;
			$data3y[$i]=$viatico_mes_detalle->alojamientos;
			//$data4y[$i]=$viatico_mes_detalle->total;
			$labels[$i]=$mes;

			$i++;
		}
		
		// Create the graph. These two calls are always required
		$graph = new Graph(850,800);
		
		$graph->SetScale("textlin");
		$graph->Set90AndMargin(0,0,0,0);
		$graph->SetShadow();

		//$graph->img->SetMargin(40,30,30,70);

		// Create the bar plots
		$b1plot = new BarPlot($data1y);
		$b2plot = new BarPlot($data2y);
		$b3plot = new BarPlot($data3y);
		//$b4plot = new BarPlot($data4y);
		

		
		
		// Create the grouped bar plot
		$gbplot = new GroupBarPlot(array($b1plot,$b2plot,$b3plot));

		// ...and add it to the graPH
		$graph->Add($gbplot);

		$b1plot->value->SetFormat('$%01.2f');
		$b1plot->value->SetFont(FF_ARIAL,FS_NORMAL,7);  // FS_BOLD para negrita
		$b2plot->value->SetFormat('$%01.2f');
		$b2plot->value->SetFont(FF_ARIAL,FS_NORMAL,7);  // FS_BOLD para negrita
		$b3plot->value->SetFormat('$%01.2f');
		$b3plot->value->SetFont(FF_ARIAL,FS_NORMAL,7);  // FS_BOLD para negrita

		$b1plot->value->Show();
		//$b1plot->SetColor("#0000CD");
		//$b2plot->SetFillColor('#B0C4DE');
		$b1plot->SetLegend("Viaticos");

		$b2plot->value->Show();
		$b2plot->SetLegend("Pasaje");
		$b3plot->value->Show();
		$b3plot->SetLegend("Alojamiento");
		//$b4plot->value->Show();
		//$b4plot->SetLegend("Total");

		$graph->title->Set(utf8_decode("Viaticos por Mes"));
		//$graph->yaxis->title->Set("Cantidad en dólares");
		$graph->xaxis->title->Set(utf8_decode("Mes"));

		$graph->title->SetFont(FF_ARIAL,FS_BOLD);
		$graph->yaxis->title->SetFont(FF_ARIAL,FS_BOLD);
		$graph->xaxis->SetTickLabels($labels);
		$graph->xaxis->title->SetFont(FF_ARIAL,FS_BOLD);
		$graph->yaxis->scale->SetGrace(10);

		
		
		// Display the graph
		$graph->Stroke(_IMG_HANDLER);
		$x = $this->session->userdata('usuario_viatico');
		$fileName = "assets/graficas/grafica_vm_".$x.".png";
		$graph->img->Stream($fileName);

		// mostrarlo en el navegador
		//$graph->img->Headers();
		//$graph->img->Stream();
		
	}
	public function crear_grafico_viaticos_x_mes_totales($anio,$primer_mes,$segundo_mes,$tercer_mes,$cuarto_mes,$quinto_mes,$sexto_mes){
		$this->load->library('j_pgraph');
		$this->load->model('Reportes_viaticos_model');
		setlocale (LC_ALL, 'et_EE.ISO-8859-1');
		
		$data1y = array(0);
		$data2y = array(0);
		$data3y = array(0);
		$data4y = array(0);
		$labels = array(0);
		$i=0;
		$mes;
		$data  =array(
			'anio'=> $anio,
			'primer_mes'=>$primer_mes,
			'segundo_mes'=>$segundo_mes,
			'tercer_mes'=>$tercer_mes,
			'cuarto_mes'=>$cuarto_mes,
			'quinto_mes'=>$quinto_mes,
			'sexto_mes'=>$sexto_mes
		);
		$viatico_mes = $this->Reportes_viaticos_model->obtenerViaticosPorPeriodo($data);
		foreach ($viatico_mes->result() as $viatico_mes_detalle) {	
			if($viatico_mes_detalle->mes=="1")$mes="Enero";
					else if($viatico_mes_detalle->mes=="2")$mes="Febrero";
					else if($viatico_mes_detalle->mes=="3")$mes="Marzo";
					else if($viatico_mes_detalle->mes=="4")$mes="Abril";
					else if($viatico_mes_detalle->mes=="5")$mes="Mayo";
					else if($viatico_mes_detalle->mes=="6")$mes="Junio";
					else if($viatico_mes_detalle->mes=="7")$mes="Julio";
					else if($viatico_mes_detalle->mes=="8")$mes="Agosto";
					else if($viatico_mes_detalle->mes=="9")$mes="Septiembre";
					else if($viatico_mes_detalle->mes=="10")$mes="Octubre";
					else if($viatico_mes_detalle->mes=="11")$mes="Noviembre";
					else if($viatico_mes_detalle->mes=="12")$mes="Diciembre";
			//$data1y[$i]=$viatico_mes_detalle->viaticos;
			//$data2y[$i]=$viatico_mes_detalle->pasajes;
			//$data3y[$i]=$viatico_mes_detalle->alojamientos;
			$data4y[$i]=$viatico_mes_detalle->total;
			$labels[$i]=$mes;

			$i++;
		}
		
		// Create the graph. These two calls are always required
		$graph = new Graph(850,800);
		
		$graph->SetScale("textlin");
		$graph->Set90AndMargin(0,0,0,0);
		$graph->SetShadow();

		//$graph->img->SetMargin(40,30,30,70);

		// Create the bar plots
		/*$b1plot = new BarPlot($data1y);
		$b2plot = new BarPlot($data2y);
		$b3plot = new BarPlot($data3y);*/
		$b4plot = new BarPlot($data4y);
		
		// Create the grouped bar plot
		$gbplot = new GroupBarPlot(array($b4plot));

		// ...and add it to the graPH
		$graph->Add($gbplot);

		//$b1plot->value->Show();
		//$b1plot->SetColor("#0000CD");
		//$b2plot->SetFillColor('#B0C4DE');
		//$b1plot->SetLegend("Viaticos");

		//$b2plot->value->Show();
		//$b2plot->SetLegend("Pasaje");
		$b4plot->value->Show();
		$b4plot->SetLegend("Total");
		
		$b4plot->value->SetFormat('$%01.2f');
		$b4plot->value->SetFont(FF_ARIAL,FS_NORMAL,7);  // FS_BOLD para negrita
		 

		$graph->title->Set(utf8_decode("Viaticos por Mes"));
		//$graph->yaxis->title->Set("Cantidad en dólares");
		$graph->xaxis->title->Set(utf8_decode("Mes"));

		$graph->title->SetFont(FF_ARIAL,FS_BOLD);
		$graph->yaxis->title->SetFont(FF_ARIAL,FS_BOLD);
		$graph->xaxis->SetTickLabels($labels);
		$graph->xaxis->title->SetFont(FF_ARIAL,FS_BOLD);
		$graph->yaxis->scale->SetGrace(10);

		
		
		// Display the graph
		$graph->Stroke(_IMG_HANDLER);
		$x = $this->session->userdata('usuario_viatico');
		$fileName = "assets/graficas/grafica_vmt_".$x.".png";
		$graph->img->Stream($fileName);

		// mostrarlo en el navegador
		//$graph->img->Headers();
		//$graph->img->Stream();
		
	}

	public function reporte_viaticos_por_periodo($tipo,$anio,$primer_mes,$segundo_mes,$tercer_mes,$cuarto_mes,$quinto_mes,$sexto_mes){
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
		<td width="580px"><h6><center>MINISTERIO DE TRABAJO Y PREVISION SOCIAL <br> UNIDAD FINANCIERA INSTITUCIONAL <br> FONDO CIRCULANTE DE MONTO FIJO <br> REPORTE VIÁTICOS POR PERIODO</center><h6></td>
		<td>
		    <img src="application/controllers/informes/logomtps.jpeg"  width="125px" height="85px">
		   
		</td>
	 	</tr></table>';

	 	$cabecera_vista = '<table><tr>
 		<td>
		    <img src="'.base_url().'assets/logos_vista/escudo.jpg" width="85px" height="80px">
		</td>
		<td width="950px"><h6><center>MINISTERIO DE TRABAJO Y PREVISION SOCIAL <br> UNIDAD FINANCIERA INSTITUCIONAL <br> FONDO CIRCULANTE DE MONTO FIJO <br> REPORTE VIÁTICOS POR PERIODO</center><h6></td>
		<td>
		    <img src="'.base_url().'assets/logos_vista/logomtps.jpeg"  width="125px" height="85px">
		   
		</td>
	 	</tr></table>';
	 	$fecha=strftime( "%d-%m-%Y - %H-%M-%S", time() );
	 	$pie = 'Usuario: '.$this->session->userdata('usuario_viatico').'    Fecha y Hora Creacion: '.$fecha.'||{PAGENO} de {nbpg} páginas';


		$this->mpdf->SetHTMLHeader($cabecera);
		//$this->mpdf->SetHTMLFooter('{PAGENO} of {nbpg} pages');
		$this->mpdf->setFooter($pie);
		
		$data  =array(
			'anio'=> $anio,
			'primer_mes'=>$primer_mes,
			'segundo_mes'=>$segundo_mes,
			'tercer_mes'=>$tercer_mes,
			'cuarto_mes'=>$cuarto_mes,
			'quinto_mes'=>$quinto_mes,
			'sexto_mes'=>$sexto_mes
		);
		$this->crear_grafico_viaticos_x_mes($anio,$primer_mes,$segundo_mes,$tercer_mes,$cuarto_mes,$quinto_mes,$sexto_mes);
		$this->crear_grafico_viaticos_x_mes_totales($anio,$primer_mes,$segundo_mes,$tercer_mes,$cuarto_mes,$quinto_mes,$sexto_mes);
		$viatico = $this->Reportes_viaticos_model->obtenerViaticosPorPeriodo($data);
		$cuerpo = '
			<table  class="" border="1" style="width:100%">
				<thead >
					<tr>
						<th align="center" rowspan="2">Mes</th>
						<th align="center" rowspan="2">Concepto de Gasto</th>
						<th align="center" colspan="3">Tipo</th>
						<th align="center" rowspan="2">Total</th>
					</tr>
					<tr>
						<th align="center">Viaticos</th>
						<th align="center">Pasajes</th>
						<th align="center">Alojamiento</th>
						
					</tr>
				</thead>
				<tbody>
					
					';
					$total_viatico=0;
					$total_pasaje=0;
					$total_alojamiento=0;
					$total_total=0;
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
						$total_viatico += $viaticos->viaticos;
						$total_pasaje += $viaticos->pasajes;
						$total_alojamiento += $viaticos->alojamientos;
						$total_total  += $viaticos->total;
					}
				}else{
					$cuerpo .= '
						<tr><td colspan="6"><center>No hay registros</center></td></tr>

					';
				}
				$cuerpo .= '
				<tr>
					<th colspan="2"><center>Totales</center></th>
					<th ><center>$'.number_format($total_viatico,2,".",",").'</center></th>
					<th ><center>$'.number_format($total_pasaje,2,".",",").'</center></th>
					<th ><center>$'.number_format($total_alojamiento,2,".",",").'</center></th>
					<th ><center>$'.number_format($total_total,2,".",",").'</center></th>
				</tr>
				</tbody>
			</table>';
			if($primer_mes=="0" && $segundo_mes=="0" && $tercer_mes=="0" && $cuarto_mes=="0" && $quinto_mes=="0" && $sexto_mes=="0"){
				$cuerpo .= '<pagebreak>';
			}
			$cuerpo .='
			<br>
			
			<img src="'.base_url().'assets/graficas/grafica_vm_'.$this->session->userdata('usuario_viatico').'.png" width="100%">
			<img src="'.base_url().'assets/graficas/grafica_vmt_'.$this->session->userdata('usuario_viatico').'.png" width="100%">
        ';         // LOAD a stylesheet         
        if($tipo=="pdf"){
	        $stylesheet = file_get_contents(base_url().'assets/plugins/bootstrap/css/bootstrap.min.css');
			//$this->mpdf->AddPage('L','','','','',10,10,35,17,3,9);
			$this->mpdf->SetTitle('Viaticos por Periodo');
			$this->mpdf->WriteHTML($stylesheet,1);  // The parameter 1 tells that this iscss/style only and no body/html/text         
			$this->mpdf->WriteHTML($cuerpo);

			$this->mpdf->Output();
		}else if($tipo=="vista"){
			echo $cabecera_vista.$cuerpo;
		}else{
			/** Error reporting */
			error_reporting(E_ALL);
			ini_set('display_errors', TRUE);
			ini_set('display_startup_errors', TRUE);
			date_default_timezone_set('America/Mexico_City');

			if (PHP_SAPI == 'cli')
				die('Este reporte solo se ejecuta en un navegador web');

			/** Include PHPExcel */
			$this->load->library('phpe');


			// Create new PHPExcel object
			$this->objPHPExcel = new Phpe();

			// Set document properties
			$this->objPHPExcel->getProperties()->setCreator("TravelExp")
										 ->setLastModifiedBy("TravelExp")
										 ->setTitle("Office 2007 XLSX Test Document")
										 ->setSubject("Office 2007 XLSX Test Document")
										 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
										 ->setKeywords("office 2007 openxml php");

			$titulosColumnas = array('MES', 'CONCEPTO','VIATICOS','PASAJES','ALOJAMIENTOS','TOTAL');
			$this->objPHPExcel->setActiveSheetIndex(0)
			    ->setCellValue('A7',  $titulosColumnas[0])  //Titulo de las columnas
			    ->setCellValue('B7',  $titulosColumnas[1])
			    ->setCellValue('C7',  $titulosColumnas[2])
			    ->setCellValue('D7',  $titulosColumnas[3])
			    ->setCellValue('E7',  $titulosColumnas[4])
			    ->setCellValue('F7',  $titulosColumnas[5]);

			

			$this->objPHPExcel->setActiveSheetIndex(0)
			            ->setCellValue('A1', "MINISTERIO DE TRABAJO Y PREVISION SOCIAL")
			            ->setCellValue('A2', "UNIDAD FINANCIERA INSTITUCIONAL")
			            ->setCellValue('A3', "FONDO CIRCULANTE DE MONTO FIJO")
			            ->setCellValue('A4', "REPORTE VIATICOS POR PERIODO");

			$viatico = $this->Reportes_viaticos_model->obtenerViaticosPorPeriodo($data);
					$total_viatico=0;
					$total_pasaje=0;
					$total_alojamiento=0;
					$total_total=0;$f=8;
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
						 
						$total_viatico += $viaticos->viaticos;
						$total_pasaje += $viaticos->pasajes;
						$total_alojamiento += $viaticos->alojamientos;
						$total_total  += $viaticos->total;
						$this->objPHPExcel->getActiveSheet()->getStyle('C'.$f.':F'.$f)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
						 
						$this->objPHPExcel->setActiveSheetIndex(0)
			           		->setCellValue('A'.$f, $mes)
			           		->setCellValue('B'.$f, "Viáticos por Comisión Interna y Pasajes al Interior")
			           		->setCellValue('C'.$f,number_format($viaticos->viaticos,2,".",","))
			           		->setCellValue('D'.$f,number_format($viaticos->pasajes,2,".",","))
			           		->setCellValue('E'.$f,number_format($viaticos->alojamientos,2,".",","))
			           		->setCellValue('F'.$f,number_format($viaticos->total,2,".",","));
			           	$f++;

					}
					$this->objPHPExcel->getActiveSheet()->getStyle('C'.$f.':F'.$f)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
					$this->objPHPExcel->getActiveSheet()->getStyle('A'.$f.':F'.$f)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					$this->objPHPExcel->setActiveSheetIndex(0)
							->mergeCells('A'.$f.':B'.$f)
							->setCellValue('A'.$f, "Total")
				            ->setCellValue('C'.$f, number_format($total_viatico,2,".",","))
				            ->setCellValue('D'.$f, number_format($total_pasaje,2,".",","))
				            ->setCellValue('E'.$f, number_format($total_alojamiento,2,".",","))
				            ->setCellValue('F'.$f, number_format($total_total,2,".",","));
				    $this->objPHPExcel->setActiveSheetIndex(0)->getStyle('A'.$f.':F'.$f)->getFont()->setBold(true); 
				}else{
					$this->objPHPExcel->setActiveSheetIndex(0)
			           		->setCellValue('A'.$f, "NO HAY REGISTROS")
				            ->mergeCells('A'.$f.':D'.$f);
				}
			
			$fecha=strftime( "%d-%m-%Y - %H-%M-%S", time() );
			$this->objPHPExcel->setActiveSheetIndex(0)
				->setCellValue("A".$f+=4,"Fecha y Hora de Creación ")
				->setCellValue("B".$f,$fecha)
				->setCellValue("A".$f+=1,"Usuario")
				->setCellValue("B".$f,$this->session->userdata('usuario_viatico'));

			$this->objPHPExcel->setActiveSheetIndex(0)
    			->mergeCells('A1:C1')
    			->mergeCells('A2:C2')
    			->mergeCells('A3:C3')
    			->mergeCells('A4:C4');

			for($i = 'A'; $i <= 'F'; $i++){
				for($ii = '7'; $ii <= '50'; $ii++){
			    $this->objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($i,$ii)->setAutoSize(TRUE);
				}
			}
			$this->objPHPExcel->setActiveSheetIndex(0)->getStyle('A1:A8')->getFont()->setBold(true); 
			$this->objPHPExcel->setActiveSheetIndex(0)->getStyle('A7:K7')->getFont()->setBold(true); 



			// Rename worksheet
			$this->objPHPExcel->getActiveSheet()->setTitle('Viaticos Por Periodo');
			// Redirect output to a client’s web browser (Excel5)
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="Viaticos_por_periodo.xls"');
			header('Cache-Control: max-age=0');
			// If you're serving to IE 9, then the following may be needed
			header('Cache-Control: max-age=1');

			// If you're serving to IE over SSL, then the following may be needed
			header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
			header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
			header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
			header ('Pragma: public'); // HTTP/1.0

			 

        	$writer = new PHPExcel_Writer_Excel5($this->objPHPExcel);
			header('Content-type: application/vnd.ms-excel');
			$writer->save('php://output');
			//exit;

			 
		}
	}
	public function reporte_viaticos_por_cargo($cargo,$anio){
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
		<td width="580px"><h6><center>MINISTERIO DE TRABAJO Y PREVISION SOCIAL <br> UNIDAD FINANCIERA INSTITUCIONAL <br> FONDO CIRCULANTE DE MONTO FIJO <br> REPORTE VIÁTICOS POR CARGO</center><h6></td>
		<td>
		    <img src="application/controllers/informes/logomtps.jpeg"  width="125px" height="85px">
		   
		</td>
	 	</tr></table>';

	 	$pie = '{PAGENO} de {nbpg} páginas';


		$this->mpdf->SetHTMLHeader($cabecera);
		//$this->mpdf->SetHTMLFooter('{PAGENO} of {nbpg} pages');
		$this->mpdf->setFooter($pie);
		
		$data  =array(
			'cargo'=> $cargo,
			'anio' =>$anio
		);
		//$this->crear_grafico_viaticos_x_mes($anio,$primer_mes,$segundo_mes,$tercer_mes,$cuarto_mes,$quinto_mes,$sexto_mes);
		$viatico = $this->Reportes_viaticos_model->obtenerViaticosPorCargo($data);

		
		if($cargo!="todo"){
			$cargos = $this->Reportes_viaticos_model->buscar_cargo_funcional($data);
			foreach ($cargos->result() as $keycargo) {
				# code...
			}
			$cuerpo = '

				<table  class="" border="1" style="width:100%">
					<thead >
						<tr>
							
							<th align="center" >Cargo Funcional: '.$keycargo->funcional.'</th>
							<th align="center" colspan="4">Tipo</th>
							
						</tr>
						<tr>
							<th align="center">Sección</th>
							<th align="center">Viaticos</th>
							<th align="center">Pasajes</th>
							<th align="center">Alojamiento</th>
							<th align="center">Total</th>
						</tr>
					</thead>
					<tbody>
						
						';
					$total_viatico1=0;
					$total_pasaje1=0;
					$total_alojamiento1=0;
					$total_total1=0;
					$total_total_=0;
					if($viatico->num_rows()>0){
					foreach ($viatico->result() as $viaticos) {
							$total_viatico1+=$viaticos->viatico;
							$total_pasaje1+=$viaticos->pasaje;
							$total_alojamiento1+=$viaticos->alojamiento;
							$total_total1=$viaticos->viatico+$viaticos->pasaje+$viaticos->alojamiento;
							$total_total_+=$total_total1;
						$cuerpo .= '
							<tr>
								<td>'.($viaticos->nombre_seccion).'</td>
								<td style="text-align:right">$'.number_format($viaticos->viatico,2,".",",").'</td>
								<td style="text-align:right">$'.number_format($viaticos->pasaje,2,".",",").'</td>
								<td style="text-align:right">$'.number_format($viaticos->alojamiento,2,".",",").'</td>
								<td style="text-align:right">$'.number_format($total_total1,2,".",",").'</td>
								
							</tr>
							';
							
						}
					}else{
						$cuerpo .= '
							<tr><td colspan="4"><center>No hay registros</center></td></tr>

						';
					}
					$cuerpo .= '
					<tr>
					<th style="text-align:center">Totales</th>
					<td style="text-align:right">$'.number_format($total_viatico1,2,".",",").'</td>
					<td style="text-align:right">$'.number_format($total_pasaje1,2,".",",").'</td>
					<td style="text-align:right">$'.number_format($total_alojamiento1,2,".",",").'</td>
					<td style="text-align:right">$'.number_format($total_total_,2,".",",").'</td>
					</tr>
					</tbody>
				</table><br>
				
	        ';         // LOAD a stylesheet   
	    }else{
	    	$cuerpo = '

				<table  class="" border="1" style="width:100%">
					<thead >
						<tr>
							<th align="center" rowspan="2">Sección</th>
							<th align="center" rowspan="2">Cargo Funcional:</th>
							<th align="center" colspan="4">Tipo</th>

							
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
					$total_viatico2=0;
					$total_pasaje2=0;
					$total_alojamiento2=0;
					$total_total2=0;
					$total_total__=0;
					if($viatico->num_rows()>0){
					foreach ($viatico->result() as $viaticos) {
							$total_viatico2+=$viaticos->viatico;
							$total_pasaje2+=$viaticos->pasaje;
							$total_alojamiento2+=$viaticos->alojamiento;
							$total_total2=$viaticos->viatico+$viaticos->pasaje+$viaticos->alojamiento;
							$total_total__+=$total_total2;
						$cuerpo .= '
							<tr>
								<td>'.($viaticos->nombre_seccion).'</td>
								<td>'.($viaticos->funcional).'</td>
								<td style="text-align:right">$'.number_format($viaticos->viatico,2,".",",").'</td>
								<td style="text-align:right">$'.number_format($viaticos->pasaje,2,".",",").'</td>
								<td style="text-align:right">$'.number_format($viaticos->alojamiento,2,".",",").'</td>
								<td style="text-align:right">$'.number_format($total_total2,2,".",",").'</td>
								
							</tr>
							';
							
						}
					}else{
						$cuerpo .= '
							<tr><td colspan="4"><center>No hay registros</center></td></tr>

						';
					}
					$cuerpo .= '
					<tr>
					<th colspan="2" style="text-align:center">Totales</th>
					<td style="text-align:right">$'.number_format($total_viatico2,2,".",",").'</td>
					<td style="text-align:right">$'.number_format($total_pasaje2,2,".",",").'</td>
					<td style="text-align:right">$'.number_format($total_alojamiento2,2,".",",").'</td>
					<td style="text-align:right">$'.number_format($total_total__,2,".",",").'</td>
					</tr>
					</tbody>
				</table><br>
				
	        ';         // LOAD a stylesheet   
	    }      
        $stylesheet = file_get_contents(base_url().'assets/plugins/bootstrap/css/bootstrap.min.css');
		//$this->mpdf->AddPage('L','','','','',10,10,35,17,3,9);
		$this->mpdf->SetTitle('Viaticos por Cargo');
		$this->mpdf->WriteHTML($stylesheet,1);  // The parameter 1 tells that this iscss/style only and no body/html/text         
		$this->mpdf->WriteHTML($cuerpo);

		$this->mpdf->Output();
		
	}
	public function reporte_viaticos_por_oficina($anio){
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
		<td width="580px"><h6><center>MINISTERIO DE TRABAJO Y PREVISION SOCIAL <br> UNIDAD FINANCIERA INSTITUCIONAL <br> FONDO CIRCULANTE DE MONTO FIJO <br> REPORTE VIÁTICOS POR SECCIÓN</center><h6></td>
		<td>
		    <img src="application/controllers/informes/logomtps.jpeg"  width="125px" height="85px">
		   
		</td>
	 	</tr></table>';

	 	$pie = '{PAGENO} de {nbpg} páginas';


		$this->mpdf->SetHTMLHeader($cabecera);
		//$this->mpdf->SetHTMLFooter('{PAGENO} of {nbpg} pages');
		$this->mpdf->setFooter($pie);
		
		$data  =array(
			'anio' =>$anio
		);
		//$this->crear_grafico_viaticos_x_mes($anio,$primer_mes,$segundo_mes,$tercer_mes,$cuarto_mes,$quinto_mes,$sexto_mes);
		$viatico = $this->Reportes_viaticos_model->obtenerViaticosPorOficina($data);

		
		$cuerpo = '

			<table  class="" border="1" style="width:100%">
				<thead >
					<tr>
						
						<th align="center" rowspan="2">Sección</th>
						<th align="center" colspan="3">Tipo</th>
						
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
					$cuerpo .= '
						<tr>
							<td>'.($viaticos->nombre_seccion).'</td>
							<td style="text-align:right">$'.number_format($viaticos->viatico,2,".",",").'</td>
							<td style="text-align:right">$'.number_format($viaticos->pasaje,2,".",",").'</td>
							<td style="text-align:right">$'.number_format($viaticos->alojamiento,2,".",",").'</td>
							
						</tr>
						';
						
					}
				}else{
					$cuerpo .= '
						<tr><td colspan="4"><center>No hay registros</center></td></tr>

					';
				}
				$cuerpo .= '
				</tbody>
			</table><br>
			
        ';         // LOAD a stylesheet         
        $stylesheet = file_get_contents(base_url().'assets/plugins/bootstrap/css/bootstrap.min.css');
		//$this->mpdf->AddPage('L','','','','',10,10,35,17,3,9);
		$this->mpdf->SetTitle('Viaticos por Cargo');
		$this->mpdf->WriteHTML($stylesheet,1);  // The parameter 1 tells that this iscss/style only and no body/html/text         
		$this->mpdf->WriteHTML($cuerpo);

		$this->mpdf->Output();
		
	}
}
?>
