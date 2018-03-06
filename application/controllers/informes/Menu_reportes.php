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
	
	public function reporte_viaticos_x_anio($anios){
		$this->load->library('mpdf');
		$this->load->model('Reportes_viaticos_model');
		$this->mpdf=new mPDF('c','A4','10','Arial',10,10,35,17,3,9);
		$this->crear_grafico_viaticos_x_anio($anios);
		$cabecera = '<table><tr>
 		<td>
		    <img src="application/controllers/informes/escudo.jpg" width="85px" height="80px">
		</td>
		<td width="550px"><h6><center>MINISTERIO DE TRABAJO Y PREVISION SOCIAL <br> UNIDAD FINANCIERA INSTITUCIONAL <br> FONDO CIRCULANTE DEL MONTO FIJO <br> REPORTE VIATICOS POR AÑO</center><h6></td>
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
		$stylesheet = file_get_contents(base_url().'assets/plugins/bootstrap/css/bootstrap.min.css');
		$this->mpdf->SetTitle('Viaticos por Año');
		$this->mpdf->WriteHTML($stylesheet,1);  // The parameter 1 tells that this iscss/style only and no body/html/
		$this->mpdf->WriteHTML($cuerpo);
		$this->mpdf->Output();
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

		$graph->title->Set(utf8_decode("Viaticos por Departamento"));
		//$graph->yaxis->title->Set("Cantidad en dólares");
		$graph->xaxis->title->Set(utf8_decode("Departamentos"));

		$graph->title->SetFont(FF_ARIAL,FS_BOLD);
		$graph->yaxis->title->SetFont(FF_ARIAL,FS_BOLD);
		$graph->xaxis->SetTickLabels($labels);
		$graph->xaxis->title->SetFont(FF_ARIAL,FS_BOLD);
		$graph->yaxis->scale->SetGrace(10);

		
		
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
		<td width="550px"><h6><center>MINISTERIO DE TRABAJO Y PREVISION SOCIAL <br> UNIDAD FINANCIERA INSTITUCIONAL <br> FONDO CIRCULANTE DEL MONTO FIJO <br> REPORTE VIATICOS POR DEPARTAMENTO</center><h6></td>
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
		<td width="550px"><h6><center>MINISTERIO DE TRABAJO Y PREVISION SOCIAL <br> UNIDAD FINANCIERA INSTITUCIONAL <br> FONDO CIRCULANTE DEL MONTO FIJO <br> REPORTE VIATICOS POR ZONA DEPARTAMENTAL</center><h6></td>
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
						<th align="center" colspan="3">Tipo</th>
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
        
		$this->mpdf->AddPage('L','','','','',10,10,35,17,3,9);
		$this->mpdf->SetTitle('Viaticos por Pendiente por Empleado');
		$stylesheet = file_get_contents(base_url().'assets/plugins/bootstrap/css/bootstrap.min.css');
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
						<th align="center" colspan="3">Tipo</th>
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
			$data4y[$i]=$viatico_mes_detalle->total;
			$labels[$i]=$mes;

			$i++;
		}
		
		// Create the graph. These two calls are always required
		$graph = new Graph(850,650);
		
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
		$fileName = "application/controllers/informes/graficas/grafica_vm_".$x.".png";
		$graph->img->Stream($fileName);

		// mostrarlo en el navegador
		//$graph->img->Headers();
		//$graph->img->Stream();
		
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
			</table><br>
			<img src="application/controllers/informes/graficas/grafica_vm_'.$this->session->userdata('usuario_viatico').'.png" alt="">
        ';         // LOAD a stylesheet         
        $stylesheet = file_get_contents(base_url().'assets/plugins/bootstrap/css/bootstrap.min.css');
		//$this->mpdf->AddPage('L','','','','',10,10,35,17,3,9);
		$this->mpdf->SetTitle('Viaticos por Periodo');
		$this->mpdf->WriteHTML($stylesheet,1);  // The parameter 1 tells that this iscss/style only and no body/html/text         
		$this->mpdf->WriteHTML($cuerpo);

		$this->mpdf->Output();
		
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
		<td width="580px"><h6><center>MINISTERIO DE TRABAJO Y PREVISION SOCIAL <br> UNIDAD FINANCIERA INSTITUCIONAL <br> FONDO CIRCULANTE DEL MONTO FIJO <br> REPORTE VIÁTICOS POR CARGO</center><h6></td>
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
							<th align="center" colspan="3">Tipo</th>
							
						</tr>
						<tr>
							<th align="center">Sección</th>
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
	    }else{
	    	$cuerpo = '

				<table  class="" border="1" style="width:100%">
					<thead >
						<tr>
							<th align="center" rowspan="2">Sección</th>
							<th align="center" rowspan="2">Cargo Funcional:</th>
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
								<td>'.($viaticos->funcional).'</td>
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
		<td width="580px"><h6><center>MINISTERIO DE TRABAJO Y PREVISION SOCIAL <br> UNIDAD FINANCIERA INSTITUCIONAL <br> FONDO CIRCULANTE DEL MONTO FIJO <br> REPORTE VIÁTICOS POR SECCIÓN</center><h6></td>
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
