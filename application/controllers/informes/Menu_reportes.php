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
	public function viaticos_por_departamento(){
		$this->load->view('templates/header');
		$this->load->view('informes/viaticos_por_departamento');
		$this->load->view('templates/footer');
	}
	public function viaticos_por_zona_depto(){
		$this->load->view('templates/header');
		$this->load->view('informes/viaticos_por_zona_depto');
		$this->load->view('templates/footer');
	}
	public function viaticos_por_cargo(){
		$this->load->view('templates/header');
		$this->load->view('informes/viaticos_por_cargo');
		$this->load->view('templates/footer');
	}
	public function viaticos_por_seccion(){
		$this->load->view('templates/header');
		$this->load->view('informes/viaticos_por_seccion');
		$this->load->view('templates/footer');
	}
	public function viaticos_por_genero(){
		$this->load->view('templates/header');
		$this->load->view('informes/viaticos_por_genero');
		$this->load->view('templates/footer');
	}
	public function viaticos_por_mes(){
		$this->load->view('templates/header');
		$this->load->view('informes/viaticos_por_mes');
		$this->load->view('templates/footer');
	}
	public function viaticos_por_actividad(){
		$this->load->view('templates/header');
		$this->load->view('informes/viaticos_por_actividad');
		$this->load->view('templates/footer');
	}
	public function viaticos_por_actividad_detalle(){
		$this->load->view('templates/header');
		$this->load->view('informes/detalle_viaticos_por_actividad');
		$this->load->view('templates/footer');
	}
	public function misiones(){
		$this->load->view('templates/header');
		$this->load->view('informes/misiones');
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
			//$data4y[$i]=$viatico_anual_detalle->total_anio;
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
		$gbplot = new GroupBarPlot(array($b1plot,$b2plot,$b3plot));

		// ...and add it to the graPH
		$graph->Add($gbplot);

		$b3plot->value->SetFormat('$%01.2f');
		$b3plot->value->SetFont(FF_ARIAL,FS_NORMAL,7);
		$b2plot->value->SetFormat('$%01.2f');
		$b2plot->value->SetFont(FF_ARIAL,FS_NORMAL,7);
		$b1plot->value->SetFormat('$%01.2f');
		$b1plot->value->SetFont(FF_ARIAL,FS_NORMAL,7);

		$b1plot->value->Show();
		//$b1plot->SetColor("#0000CD");
		$b2plot->SetFillColor('#B0C4DE');
		$b1plot->SetLegend("Viáticos");

		$b2plot->value->Show();
		$b2plot->SetLegend("Pasaje");
		$b3plot->value->Show();
		$b3plot->SetLegend("Alojamiento");
		//$b4plot->value->Show();
		//$b4plot->SetLegend("Total");

		$graph->title->Set(utf8_decode("Viáticos por año"));
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
		$fileName = "assets/graficas/grafica_va_".$x.".png";
		$graph->img->Stream($fileName);

		// mostrarlo en el navegador
		//$graph->img->Headers();
		//$graph->img->Stream();
		
	}
	public function crear_grafico_viaticos_x_anio_totales($anios){
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
			/*$data1y[$i]=$viatico_anual_detalle->viatico;
			$data2y[$i]=$viatico_anual_detalle->pasaje;
			$data3y[$i]=$viatico_anual_detalle->alojamiento;*/
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
		$gbplot = new GroupBarPlot(array($b4plot));

		// ...and add it to the graPH
		$graph->Add($gbplot);
		$b4plot->value->SetFormat('$%01.2f');
		$b4plot->value->SetFont(FF_ARIAL,FS_NORMAL,7);

		//$b1plot->value->Show();
		//$b1plot->SetColor("#0000CD");
		//$b2plot->SetFillColor('#B0C4DE');
		//$b1plot->SetLegend("Viaticos");

		/*$b2plot->value->Show();
		$b2plot->SetLegend("Pasaje");
		$b3plot->value->Show();
		$b3plot->SetLegend("Alojamiento");*/
		$b4plot->value->Show();
		$b4plot->SetLegend("Total");

		$graph->title->Set(utf8_decode("Viáticos por año"));
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
		$fileName = "assets/graficas/grafica_vat_".$x.".png";
		$graph->img->Stream($fileName);

		// mostrarlo en el navegador
		//$graph->img->Headers();
		//$graph->img->Stream();
		
	}
	
	public function reporte_viaticos_x_anio($tipo,$anios){
		$this->load->library('mpdf');
		$this->load->model('Reportes_viaticos_model');
		$this->mpdf = new \Mpdf\Mpdf();
		$this->crear_grafico_viaticos_x_anio($anios);
		$this->crear_grafico_viaticos_x_anio_totales($anios);
		$cabecera = '<table width="100%"><tr>
 		<td>
		    <img src="application/controllers/informes/logomtps.jpeg"  width="125px" height="85px">
		</td>
		<td width="550px"><h5><center>MINISTERIO DE TRABAJO Y PREVISIÓN SOCIAL <br> UNIDAD FINANCIERA INSTITUCIONAL <br> FONDO CIRCULANTE DEL MONTO FIJO <br> <span style="font-size: 22px;">REPORTE VIÁTICOS POR AÑO</span></center><h5></td>
		<td align="right">
		   	<img src="application/controllers/informes/escudo.jpg" width="150px" height="55px">
		</td>
	 	</tr></table>';

	 	$cabecera_vista = '<table><tr>
 		<td>
		 	<img src="'.base_url().'assets/logos_vista/logomtps.jpg"  width="125px" height="85px">   
		</td>
		<td width="950px"><h5><center>MINISTERIO DE TRABAJO Y PREVISIÓN SOCIAL <br> UNIDAD FINANCIERA INSTITUCIONAL <br> FONDO CIRCULANTE DEL MONTO FIJO <br> <span style="font-size: 17px;">REPORTE VIÁTICOS POR AÑO</span></center><h5></td>
		<td>
		   	<img src="'.base_url().'assets/logos_vista/escudo.jpg" width="150px" height="55px">
		</td>
	 	</tr></table>';
	 	$fecha=strftime( "%d-%m-%Y - %H:%M:%S", time() );
	 	$pie = 'Usuario: '.$this->session->userdata('usuario_viatico').'    Fecha y Hora Creación: '.$fecha.'||{PAGENO} de {nbpg} páginas';
		
		$this->mpdf->SetHTMLHeader($cabecera);

		//$this->mpdf->SetHTMLFooter('{PAGENO} of {nbpg} pages');
		$this->mpdf->setFooter($pie);
		
		$cuerpo = '
			<table  class="" border="1" style="width:100%">
				<thead >
					<tr>
						<td align="center" rowspan="2" >AÑO</td>
						<td align="center" colspan="3" >TIPO</td>
						<td align="center" rowspan="2" >TOTAL</td>
					</tr>
					<tr>
						<td align="center"  >VIÁTICO</td>
						<td align="center"  >PASAJE</td>
						<td align="center"  >ALOJAMIENTO</td>

					</tr>
				</thead>
				<tbody>
					';
				$data = str_split($anios,4);
				$total_viatico = 0;
				$total_pasaje = 0;
				$total_alojamiento = 0;
				$total_total = 0;
				$viatico = $this->Reportes_viaticos_model->obtenerViaticoAnual($data);
				if($viatico->num_rows()>0){
				foreach ($viatico->result() as $viaticos) {
					$total_viatico+=$viaticos->viatico;
					$total_pasaje+=$viaticos->pasaje;
					$total_alojamiento+=$viaticos->alojamiento;
					$total_total+=$viaticos->total_anio;
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
						<tr><td colspan="5"><center>No hay registros</center></td></tr>
					';
				}
				$cuerpo .= '
						<tr>
							<td align="center" style="width:180px">Total</td>
							<td align="center" style="width:180px">$'.number_format($total_viatico,2,".",",").'</td>
							<td align="center" style="width:180px">$'.number_format($total_pasaje,2,".",",").'</td>
							<td align="center" style="width:180px">$'.number_format($total_alojamiento,2,".",",").'</td>
							<td align="center" style="width:180px">$'.number_format($total_total,2,".",",").'</td>
						</tr>
				</tbody>
			</table><br>

			<img  src="'.base_url().'assets/graficas/grafica_va_'.$this->session->userdata('usuario_viatico').'.png" alt="">
			<img  src="'.base_url().'assets/graficas/grafica_vat_'.$this->session->userdata('usuario_viatico').'.png" alt="">
        '; 
        if($tipo=="pdf"){
			$stylesheet = file_get_contents(base_url().'assets/plugins/bootstrap/css/bootstrap.min.css');
			$this->mpdf->AddPage('P','','','','',15,15,35,17,7,9);
			$this->mpdf->SetTitle('Viaticos por Año');
			$this->mpdf->WriteHTML($stylesheet,1);  // The parameter 1 tells that this iscss/style only and no body/html/
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

			$titulosColumnas = array('AÑO','VIÁTICOS','PASAJES','ALOJAMIENTOS','TOTAL');
			$this->objPHPExcel->setActiveSheetIndex(0)
			    ->setCellValue('A7',  $titulosColumnas[0])  //Titulo de las columnas
			    ->setCellValue('B7',  $titulosColumnas[1])
			    ->setCellValue('C7',  $titulosColumnas[2])
			    ->setCellValue('D7',  $titulosColumnas[3])
			    ->setCellValue('E7',  $titulosColumnas[4])
			    ;

			 
			$this->objPHPExcel->setActiveSheetIndex(0)
			            ->setCellValue('A1', "MINISTERIO DE TRABAJO Y PREVISIÓN SOCIAL")
			            ->setCellValue('A2', "UNIDAD FINANCIERA INSTITUCIONAL")
			            ->setCellValue('A3', "FONDO CIRCULANTE DEL MONTO FIJO")
			            ->setCellValue('A4', "REPORTE VIÁTICOS POR AÑO")
			            ;
			 $this->objPHPExcel->setActiveSheetIndex(0)->getStyle('A7:E7')->getFont()->setBold(true); 
					$total_viatico=0;
					$total_pasaje=0;
					$total_alojamiento=0;
					$total_total=0;
					$f=8;
				$data = str_split($anios,4);

				$viatico = $this->Reportes_viaticos_model->obtenerViaticoAnual($data);
				if($viatico->num_rows()>0){
				foreach ($viatico->result() as $viaticos) {
					$total_viatico+=$viaticos->viatico;
					$total_pasaje+=$viaticos->pasaje;
					$total_alojamiento+=$viaticos->alojamiento;
					$total_total+=$viaticos->total_anio;

					$this->objPHPExcel->getActiveSheet()->getStyle('B'.$f.':F'.$f)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
					$this->objPHPExcel->getActiveSheet()->getStyle('A'.$f)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
					// Miscellaneous glyphs, UTF-8
					$this->objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A'.$f, $viaticos->anio)
				            ->setCellValue('B'.$f, number_format($viaticos->viatico,2,".",","))
				            ->setCellValue('C'.$f, number_format($viaticos->pasaje,2,".",","))
				            ->setCellValue('D'.$f, number_format($viaticos->alojamiento,2,".",","))
				            ->setCellValue('E'.$f, number_format($viaticos->total_anio,2,".",","));
						$f++;
					}

					$this->objPHPExcel->getActiveSheet()->getStyle('B'.$f.':F'.$f)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
					 
					$this->objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A'.$f, "Total")
				            ->setCellValue('B'.$f, number_format($total_viatico,2,".",","))
				            ->setCellValue('C'.$f, number_format($total_pasaje,2,".",","))
				            ->setCellValue('D'.$f, number_format($total_alojamiento,2,".",","))
				            ->setCellValue('E'.$f, number_format($total_total,2,".",","));
				    $this->objPHPExcel->setActiveSheetIndex(0)->getStyle('A'.$f.':F'.$f)->getFont()->setBold(true); 
			}else{
				$this->objPHPExcel->setActiveSheetIndex(0)
				            ->setCellValue('A'.$f, "NO HAY REGISTROS")
				            ->mergeCells('A'.$f.':D'.$f);
			}

			$fecha=strftime( "%d-%m-%Y - %H:%M:%S", time() );
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

			for($i = 'A'; $i <= 'E'; $i++){
				for($ii = '7'; $ii <= '50'; $ii++){
			    $this->objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($i,$ii)->setAutoSize(TRUE);
				}
			}
			$this->objPHPExcel->setActiveSheetIndex(0)->getStyle('A1:A7')->getFont()->setBold(true); 
			
			// Rename worksheet
			$this->objPHPExcel->getActiveSheet()->setTitle('Viaticos Por Año');
			// Redirect output to a client’s web browser (Excel5)
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="Viaticos_por_anio.xls"');
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
				//$data4y[$i]=$viatico_anual_detalle->total;
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
		//$b4plot = new BarPlot($data4y);
	
		// Create the grouped bar plot
		$gbplot = new GroupBarPlot(array($b1plot,$b2plot,$b3plot));
		//$gbplot->value->SetFormat('%01.2f');

		// ...and add it to the graPH
		$graph->Add($gbplot);

		$b1plot->value->Show();
		//$b2plot->SetFillColor('#B0C4DE');
		$b1plot->SetLegend("Viaticos");


		/******************************************************************
			Inicio cambiando formato de etiquetas a $0.00 dinero
		******************************************************************/

		$b1plot->value->SetFormat('$%01.2f');
		$b2plot->value->SetFormat('$%01.2f');
		$b3plot->value->SetFormat('$%01.2f');
		//$b4plot->value->SetFormat('$%01.2f');

		$b1plot->value->SetFont(FF_ARIAL,FS_NORMAL,7);  // FS_BOLD para negrita
		$b2plot->value->SetFont(FF_ARIAL,FS_NORMAL,7);  // FS_BOLD para negrita
		$b3plot->value->SetFont(FF_ARIAL,FS_NORMAL,7);  // FS_BOLD para negrita
		//$b4plot->value->SetFont(FF_ARIAL,FS_NORMAL,7);  // FS_BOLD para negrita

		/******************************************************************
			Fin cambiando formato de etiquetas a $0.00 dinero
		******************************************************************/

		$b2plot->value->Show();
		$b2plot->SetLegend("Pasaje");
		$b3plot->value->Show();
		$b3plot->SetLegend("Alojamiento");
		//$b4plot->value->Show();
		//$b4plot->SetLegend("Total");

		$graph->title->Set(utf8_decode("Viáticos por Departamento"));
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
		$fileName = "assets/graficas/grafica_depto_".$x.".png";
		$graph->img->Stream($fileName);

		// mostrarlo en el navegador
		//$graph->img->Headers();
		//$graph->img->Stream();
		
	}
	public function crear_grafico_viaticos_x_depto_totales($anios){
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
				//$data1y[$i]=$viatico_anual_detalle->viatico;
				//$data2y[$i]=$viatico_anual_detalle->pasaje;
				//$data3y[$i]=$viatico_anual_detalle->alojamiento;
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
		/*$b1plot = new BarPlot($data1y);
		$b2plot = new BarPlot($data2y);
		$b3plot = new BarPlot($data3y);*/
		$b4plot = new BarPlot($data4y);
	
		// Create the grouped bar plot
		$gbplot = new GroupBarPlot(array($b4plot));
		//$gbplot->value->SetFormat('%01.2f');

		// ...and add it to the graPH
		$graph->Add($gbplot);

		


		/******************************************************************
			Inicio cambiando formato de etiquetas a $0.00 dinero
		******************************************************************/

		//$b1plot->value->SetFormat('$%01.2f');
		/*$b2plot->value->SetFormat('$%01.2f');
		$b3plot->value->SetFormat('$%01.2f');*/
		$b4plot->value->SetFormat('$%01.2f');

		//$b1plot->value->SetFont(FF_ARIAL,FS_NORMAL,7);  // FS_BOLD para negrita
		//$b2plot->value->SetFont(FF_ARIAL,FS_NORMAL,7);  // FS_BOLD para negrita
		//$b3plot->value->SetFont(FF_ARIAL,FS_NORMAL,7);  // FS_BOLD para negrita
		$b4plot->value->SetFont(FF_ARIAL,FS_NORMAL,7);  // FS_BOLD para negrita

		/******************************************************************
			Fin cambiando formato de etiquetas a $0.00 dinero
		******************************************************************/

		/*$b2plot->value->Show();
		$b2plot->SetLegend("Pasaje");
		$b3plot->value->Show();
		$b3plot->SetLegend("Alojamiento");*/
		$b4plot->value->Show();
		$b4plot->SetLegend("Total");

		$graph->title->Set(utf8_decode("Viáticos por Departamento"));
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
		$fileName = "assets/graficas/grafica_depto_t_".$x.".png";
		$graph->img->Stream($fileName);

		// mostrarlo en el navegador
		//$graph->img->Headers();
		//$graph->img->Stream();
		
	}

	public function reporte_viaticos_x_depto($tipo,$anios){
		$this->load->library('mpdf');
		$this->load->model('Reportes_viaticos_model');
		$this->mpdf = new \Mpdf\Mpdf();
		$this->crear_grafico_viaticos_x_depto($anios);
		$this->crear_grafico_viaticos_x_depto_totales($anios);
		$cabecera = '<table width="100%"><tr>
 		<td>
		    <img src="application/controllers/informes/logomtps.jpeg"  width="125px" height="85px">
		</td>
		<td width="550px"><h5><center>MINISTERIO DE TRABAJO Y PREVISIÓN SOCIAL <br> UNIDAD FINANCIERA INSTITUCIONAL <br> FONDO CIRCULANTE DEL MONTO FIJO <br> <span style="font-size: 22px;">REPORTE VIÁTICOS POR DEPARTAMENTO</span></center><h5></td>
		<td align="right">
		   	<img src="application/controllers/informes/escudo.jpg" width="150px" height="55px">
		</td>
	 	</tr></table>';

	 	$cabecera_vista = '<table><tr>
 		<td>
		    <img src="'.base_url().'assets/logos_vista/logomtps.jpg"  width="125px" height="85px">
		</td>
		<td width="950px"><h5><center>MINISTERIO DE TRABAJO Y PREVISIÓN SOCIAL <br> UNIDAD FINANCIERA INSTITUCIONAL <br> FONDO CIRCULANTE DEL MONTO FIJO <br> <span style="font-size: 17px;">REPORTE VIÁTICOS POR DEPARTAMENTO</span></center><h5></td>
		<td>
		    <img src="'.base_url().'assets/logos_vista/escudo.jpg" width="150px" height="55px">
		</td>
	 	</tr></table>';
	 	$fecha=strftime( "%d-%m-%Y - %H:%M:%S", time() );
	 	$pie = 'Usuario: '.$this->session->userdata('usuario_viatico').'    Fecha y Hora Creación: '.$fecha.'||{PAGENO} de {nbpg} páginas';

		$this->mpdf->SetHTMLHeader($cabecera);
		//$this->mpdf->SetHTMLFooter('{PAGENO} of {nbpg} pages');
		$this->mpdf->setFooter($pie);
		
		$cuerpo = '
			<table  border="1" width="100%">
				<thead >
					<tr>
						<td align="center" rowspan="1" >AÑO: '.($anios).'</td>
						<td align="center" colspan="3" >TIPO</td>
						<td align="center" rowspan="2" >TOTAL</td>
					</tr>
					<tr>
						<td align="center" rowspan="1" >DEPARTAMENTO</td>
						<td align="center"  >VIÁTICO</td>
						<td align="center"  >PASAJE</td>
						<td align="center"  >ALOJAMIENTO</td>
						
					</tr>
				</thead>
				<tbody>
					';
					$data=$anios;
				//$data = str_split($anios,4);
				//$data=array(2018,2017,2016,2015);

				$total_pasaje=0;
				$total_viatico=0;
				$total_alojamiento=0;
				$total_total=0;

				$viatico = $this->Reportes_viaticos_model->obtenerViaticoAnualxDepto($data);
				if($viatico->num_rows()>0){
				foreach ($viatico->result() as $viaticos) {
					$total_pasaje+=$viaticos->pasaje;
					$total_viatico+=$viaticos->viatico;
					$total_alojamiento+=$viaticos->alojamiento;
					$total_total+=$viaticos->total;
					$cuerpo .= '
						<tr>
							<td align="center" style="width:180px">'.($viaticos->departamento).'</td>
							<td align="center" style="width:180px">$'.number_format($viaticos->viatico,2,".",",").'</td>
							<td align="center" style="width:180px">$'.number_format($viaticos->pasaje,2,".",",").'</td>
							<td align="center" style="width:180px">$'.number_format($viaticos->alojamiento,2,".",",").'</td>
							<td align="center" style="width:180px">$'.number_format($viaticos->total,2,".",",").'</td>
						</tr>
						';
					}
				}else{
				$cuerpo .= '
						<tr><td colspan="5"><center>No hay registros</center></td></tr>
					';
				}
				$cuerpo .= '
						<tr>
							<td align="center" style="width:180px">Total</td>
							<td align="center" style="width:180px">$'.number_format($total_viatico,2,".",",").'</td>
							<td align="center" style="width:180px">$'.number_format($total_pasaje,2,".",",").'</td>
							<td align="center" style="width:180px">$'.number_format($total_alojamiento,2,".",",").'</td>
							<td align="center" style="width:180px">$'.number_format($total_total,2,".",",").'</td>
						</tr>
				</tbody>
			</table><br>
			<img src="'.base_url().'assets/graficas/grafica_depto_'.$this->session->userdata('usuario_viatico').'.png" alt=""  >
			<img src="'.base_url().'assets/graficas/grafica_depto_t_'.$this->session->userdata('usuario_viatico').'.png" alt="">
			      '; 
		if($tipo=="pdf"){
			$stylesheet = file_get_contents(base_url().'assets/plugins/bootstrap/css/bootstrap.min.css');
			$this->mpdf->AddPage('L','','','','',15,15,35,17,7,9);
			$this->mpdf->SetTitle('Viaticos por Año');
			$this->mpdf->WriteHTML($stylesheet,1);  // The parameter 1 tells that this iscss/style only and no body/html/
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

			$titulosColumnas = array('DEPARTAMENTO','VIÁTICOS','PASAJES','ALOJAMIENTOS','TOTAL');
			$this->objPHPExcel->setActiveSheetIndex(0)
			    ->setCellValue('A7',  $titulosColumnas[0])  //Titulo de las columnas
			    ->setCellValue('B7',  $titulosColumnas[1])
			    ->setCellValue('C7',  $titulosColumnas[2])
			    ->setCellValue('D7',  $titulosColumnas[3])
			    ->setCellValue('E7',  $titulosColumnas[4])
			    ;

			 
			$this->objPHPExcel->setActiveSheetIndex(0)
			            ->setCellValue('A1', "MINISTERIO DE TRABAJO Y PREVISIÓN SOCIAL")
			            ->setCellValue('A2', "UNIDAD FINANCIERA INSTITUCIONAL")
			            ->setCellValue('A3', "FONDO CIRCULANTE DEL MONTO FIJO")
			            ->setCellValue('A4', "REPORTE VIÁTICOS POR DEPARTAMENTO")
			            ;
			 $this->objPHPExcel->setActiveSheetIndex(0)->getStyle('A7:E7')->getFont()->setBold(true); 
				$total_pasaje=0;
				$total_viatico=0;
				$total_alojamiento=0;
				$total_total=0;
				$f=8;$data=$anios;

				$this->objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A'.($f-2),"Año: ")
							->setCellValue('B'.($f-2), $anios);

				$viatico = $this->Reportes_viaticos_model->obtenerViaticoAnualxDepto($data);
				if($viatico->num_rows()>0){
				foreach ($viatico->result() as $viaticos) {
					$total_pasaje+=$viaticos->pasaje;
					$total_viatico+=$viaticos->viatico;
					$total_alojamiento+=$viaticos->alojamiento;
					$total_total+=$viaticos->total;

					$this->objPHPExcel->getActiveSheet()->getStyle('B'.$f.':F'.$f)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
					$this->objPHPExcel->getActiveSheet()->getStyle('A'.$f)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
					// Miscellaneous glyphs, UTF-8
					$this->objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A'.$f, $viaticos->departamento)
				            ->setCellValue('B'.$f, number_format($viaticos->viatico,2,".",","))
				            ->setCellValue('C'.$f, number_format($viaticos->pasaje,2,".",","))
				            ->setCellValue('D'.$f, number_format($viaticos->alojamiento,2,".",","))
				            ->setCellValue('E'.$f, number_format($viaticos->total,2,".",","));
						$f++;
					}

					$this->objPHPExcel->getActiveSheet()->getStyle('B'.$f.':F'.$f)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
					 
					$this->objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A'.$f, "Total")
				            ->setCellValue('B'.$f, number_format($total_viatico,2,".",","))
				            ->setCellValue('C'.$f, number_format($total_pasaje,2,".",","))
				            ->setCellValue('D'.$f, number_format($total_alojamiento,2,".",","))
				            ->setCellValue('E'.$f, number_format($total_total,2,".",","));
				    $this->objPHPExcel->setActiveSheetIndex(0)->getStyle('A'.$f.':F'.$f)->getFont()->setBold(true); 
			}else{
				$this->objPHPExcel->setActiveSheetIndex(0)
				            ->setCellValue('A'.$f, "NO HAY REGISTROS")
				            ->mergeCells('A'.$f.':E'.$f);
			}

			$fecha=strftime( "%d-%m-%Y - %H:%M:%S", time() );
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

			for($i = 'A'; $i <= 'E'; $i++){
				for($ii = '7'; $ii <= '50'; $ii++){
			    $this->objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($i,$ii)->setAutoSize(TRUE);
				}
			}
			$this->objPHPExcel->setActiveSheetIndex(0)->getStyle('A1:A7')->getFont()->setBold(true); 
			
			// Rename worksheet
			$this->objPHPExcel->getActiveSheet()->setTitle('Viaticos Por Departamento');
			// Redirect output to a client’s web browser (Excel5)
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="Viaticos_por_departamento.xls"');
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

	public function crear_grafico_viaticos_x_zona_depto($anios){
		$this->load->library('j_pgraph');
		$this->load->model('Reportes_viaticos_model');
		setlocale (LC_ALL, 'et_EE.ISO-8859-1');
		
				$zona_total_viaticos_occidental=0;
				$zona_total_pasajes_occidental=0;
				$zona_total_alojamientos_occidental=0;
				$zona_total_occidente=0;

				$total_viaticos_central=0;
				$zona_total_pasajes_central=0;
				$zona_total_alojamientos_central=0;
				$zona_total_central=0;

				$zona_total_viaticos_oriental=0;
				$zona_total_pasajes_oriental=0;
				$zona_total_alojamientos_oriental=0;
				$zona_total_oriental=0;
		
		$data1y = array();
		$data2y = array();
		$data3y = array();
		$data4y = array();

		$labels = array();
		$i=0;
		$viatico_anual = $this->Reportes_viaticos_model->obtenerViaticoAnualxDepto($anios);
		foreach ($viatico_anual->result() as $viaticos) {	
			if($viaticos->id_depto>="00001" && $viaticos->id_depto<='00003'){
						$zona_total_viaticos_occidental+= $viaticos->viatico;
						$zona_total_pasajes_occidental+= $viaticos->pasaje;
						$zona_total_alojamientos_occidental+= $viaticos->alojamiento;
					}

					if($viaticos->id_depto>="00004" && $viaticos->id_depto<='00010'){
						$total_viaticos_central+= $viaticos->viatico;
						$zona_total_pasajes_central+= $viaticos->pasaje;
						$zona_total_alojamientos_central+= $viaticos->alojamiento;
					}

					if($viaticos->id_depto>="00011" && $viaticos->id_depto<='00014'){
						$zona_total_viaticos_oriental+=$viaticos->viatico;
						$zona_total_pasajes_oriental+=$viaticos->pasaje;
						$zona_total_alojamientos_oriental+=$viaticos->alojamiento;
					}
		}
		$zona_total_occidente = $zona_total_viaticos_occidental + $zona_total_pasajes_occidental + $zona_total_alojamientos_occidental;
		$zona_total_central = $total_viaticos_central+$zona_total_pasajes_central+$zona_total_alojamientos_central;
		$zona_total_oriental = $zona_total_viaticos_oriental+$zona_total_pasajes_oriental+$zona_total_alojamientos_oriental;
			
			
		$data1y[$i]=$zona_total_viaticos_occidental;
		$data2y[$i]=$zona_total_pasajes_occidental;
		$data3y[$i]=$zona_total_alojamientos_occidental;
		//$data4y[$i]=$zona_total_occidente;
		$labels[$i]="Occidental";
		$i++;
		$data1y[$i]=$total_viaticos_central;
		$data2y[$i]=$zona_total_pasajes_central;
		$data3y[$i]=$zona_total_alojamientos_central;
		//$data4y[$i]=$zona_total_central;
		$labels[$i]="Central";
		$i++;
		$data1y[$i]=$zona_total_viaticos_oriental;
		$data2y[$i]=$zona_total_pasajes_oriental;
		$data3y[$i]=$zona_total_alojamientos_oriental;
		//$data4y[$i]=$zona_total_oriental;
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
		//$b4plot = new BarPlot($data4y);
		
		
		// Create the grouped bar plot
		$gbplot = new GroupBarPlot(array($b1plot,$b2plot,$b3plot));

		// ...and add it to the graPH
		$graph->Add($gbplot);
		$b1plot->value->SetFormat('$%01.2f');
		$b1plot->value->SetFont(FF_ARIAL,FS_NORMAL,7);
		$b2plot->value->SetFormat('$%01.2f');
		$b2plot->value->SetFont(FF_ARIAL,FS_NORMAL,7);
		$b3plot->value->SetFormat('$%01.2f');
		$b3plot->value->SetFont(FF_ARIAL,FS_NORMAL,7);

		$b1plot->value->Show();
		//$b1plot->SetColor("#0000CD");
		//$b2plot->SetFillColor('#B0C4DE');
		$b1plot->SetLegend("Viáticos");

		$b2plot->value->Show();
		$b2plot->SetLegend("Pasaje");
		$b3plot->value->Show();
		$b3plot->SetLegend("Alojamiento");
		//$b4plot->value->Show();
		//$b4plot->SetLegend("Total");
		

		$graph->title->Set(utf8_decode("Viáticos por Zona"));
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
		$fileName = "assets/graficas/grafica_zona_depto_".$x.".png";
		$graph->img->Stream($fileName);

		// mostrarlo en el navegador
		//$graph->img->Headers();
		//$graph->img->Stream();
		
	}
	public function crear_grafico_viaticos_x_zona_depto_total($anios){
		$this->load->library('j_pgraph');
		$this->load->model('Reportes_viaticos_model');
		setlocale (LC_ALL, 'et_EE.ISO-8859-1');
		
				$zona_total_viaticos_occidental=0;
				$zona_total_pasajes_occidental=0;
				$zona_total_alojamientos_occidental=0;
				$zona_total_occidente=0;

				$total_viaticos_central=0;
				$zona_total_pasajes_central=0;
				$zona_total_alojamientos_central=0;
				$zona_total_central=0;

				$zona_total_viaticos_oriental=0;
				$zona_total_pasajes_oriental=0;
				$zona_total_alojamientos_oriental=0;
				$zona_total_oriental=0;
		
		$data1y = array();
		$data2y = array();
		$data3y = array();
		$data4y = array();

		$labels = array();
		$i=0;
		$viatico_anual = $this->Reportes_viaticos_model->obtenerViaticoAnualxDepto($anios);
		foreach ($viatico_anual->result() as $viaticos) {	
			if($viaticos->id_depto>="00001" && $viaticos->id_depto<='00003'){
						$zona_total_viaticos_occidental+= $viaticos->viatico;
						$zona_total_pasajes_occidental+= $viaticos->pasaje;
						$zona_total_alojamientos_occidental+= $viaticos->alojamiento;
					}

					if($viaticos->id_depto>="00004" && $viaticos->id_depto<='00010'){
						$total_viaticos_central+= $viaticos->viatico;
						$zona_total_pasajes_central+= $viaticos->pasaje;
						$zona_total_alojamientos_central+= $viaticos->alojamiento;
					}

					if($viaticos->id_depto>="00011" && $viaticos->id_depto<='00014'){
						$zona_total_viaticos_oriental+=$viaticos->viatico;
						$zona_total_pasajes_oriental+=$viaticos->pasaje;
						$zona_total_alojamientos_oriental+=$viaticos->alojamiento;
					}
		}
		$zona_total_occidente = $zona_total_viaticos_occidental + $zona_total_pasajes_occidental + $zona_total_alojamientos_occidental;
		$zona_total_central = $total_viaticos_central+$zona_total_pasajes_central+$zona_total_alojamientos_central;
		$zona_total_oriental = $zona_total_viaticos_oriental+$zona_total_pasajes_oriental+$zona_total_alojamientos_oriental;
			
			
		/*$data1y[$i]=$zona_total_viaticos_occidental;
		$data2y[$i]=$zona_total_pasajes_occidental;
		$data3y[$i]=$zona_total_alojamientos_occidental;*/
		$data4y[$i]=$zona_total_occidente;
		$labels[$i]="Occidental";
		$i++;
		/*$data1y[$i]=$total_viaticos_central;
		$data2y[$i]=$zona_total_pasajes_central;
		$data3y[$i]=$zona_total_alojamientos_central;*/
		$data4y[$i]=$zona_total_central;
		$labels[$i]="Central";
		$i++;
		/*$data1y[$i]=$zona_total_viaticos_oriental;
		$data2y[$i]=$zona_total_pasajes_oriental;
		$data3y[$i]=$zona_total_alojamientos_oriental;*/
		$data4y[$i]=$zona_total_oriental;
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
		/*$b1plot = new BarPlot($data1y);
		$b2plot = new BarPlot($data2y);
		$b3plot = new BarPlot($data3y);*/
		$b4plot = new BarPlot($data4y);
		
		
		// Create the grouped bar plot
		$gbplot = new GroupBarPlot(array($b4plot));

		// ...and add it to the graPH
		$graph->Add($gbplot);
		$b4plot->value->SetFormat('$%01.2f');
		$b4plot->value->SetFont(FF_ARIAL,FS_NORMAL,7);

		/*$b1plot->value->Show();
		//$b1plot->SetColor("#0000CD");
		$b2plot->SetFillColor('#B0C4DE');
		$b1plot->SetLegend("Viaticos");

		$b2plot->value->Show();
		$b2plot->SetLegend("Pasaje");
		$b3plot->value->Show();
		$b3plot->SetLegend("Alojamiento");*/
		$b4plot->value->Show();
		$b4plot->SetLegend("Total");
		

		$graph->title->Set(utf8_decode("Viáticos por Zona"));
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
		$fileName = "assets/graficas/grafica_zona_depto_t_".$x.".png";
		$graph->img->Stream($fileName);

		// mostrarlo en el navegador
		//$graph->img->Headers();
		//$graph->img->Stream();
		
	}

	public function reporte_viaticos_x_zona_depto($tipo,$anios){
		$this->load->library('mpdf');
		$this->load->model('Reportes_viaticos_model');
		$this->mpdf = new \Mpdf\Mpdf();
		$this->crear_grafico_viaticos_x_zona_depto($anios);
		$this->crear_grafico_viaticos_x_zona_depto_total($anios);
		$cabecera = '<table width="100%"><tr>
 		<td>
		    <img src="application/controllers/informes/logomtps.jpeg"  width="125px" height="85px">
		</td>
		<td width="550px"><h5><center>MINISTERIO DE TRABAJO Y PREVISIÓN SOCIAL <br> UNIDAD FINANCIERA INSTITUCIONAL <br> FONDO CIRCULANTE DEL MONTO FIJO <br> <span style="font-size: 22px;">REPORTE VIÁTICOS POR ZONA DEPARTAMENTAL</span></center><h5></td>
		<td align="right">
		   	<img src="application/controllers/informes/escudo.jpg" width="150px" height="55px">
		</td>
	 	</tr></table>';

	 	$cabecera_vista = '<table><tr>
 		<td>
		    <img src="'.base_url().'assets/logos_vista/logomtps.jpg"  width="125px" height="85px">
		</td>
		<td width="950px"><h5><center>MINISTERIO DE TRABAJO Y PREVISIÓN SOCIAL <br> UNIDAD FINANCIERA INSTITUCIONAL <br> FONDO CIRCULANTE DEL MONTO FIJO <br> <span style="font-size: 17px;">REPORTE VIÁTICOS POR ZONA DEPARTAMENTAL</span></center><h5></td>
		<td>
		   	<img src="'.base_url().'assets/logos_vista/escudo.jpg" width="150px" height="55px">
		</td>
	 	</tr></table>';
	 	$fecha=strftime( "%d-%m-%Y - %H:%M:%S", time() );
	 	$pie = 'Usuario: '.$this->session->userdata('usuario_viatico').'    Fecha y Hora Creación: '.$fecha.'||{PAGENO} de {nbpg} páginas';
		$this->mpdf->SetHTMLHeader($cabecera);
		//$this->mpdf->SetHTMLFooter('{PAGENO} of {nbpg} pages');
		$this->mpdf->setFooter($pie);
		
		$cuerpo = '
			<table  border="1" >
				<thead >
					<tr>
						<td align="center" rowspan="1" >AÑO: '.($anios).'</td>

						<td align="center" colspan="3" >TIPO</td>
						<td align="center" rowspan="2"  >TOTAL</td>
					</tr>
					<tr>
						<td align="center" rowspan="1" >ZONA</td>
						<td align="center"  >VIÁTICO</td>
						<td align="center"  >PASAJE</td>
						<td align="center"  >ALOJAMIENTO</td>
						
					</tr>
				</thead>
				<tbody>
					';
					$data=$anios;
				//$data = str_split($anios,4);
				//$data=array(2018,2017,2016,2015);
				$zona_total_viaticos_occidental=0;
				$zona_total_pasajes_occidental=0;
				$zona_total_alojamientos_occidental=0;
				$zona_total_occidente=0;

				$total_viaticos_central=0;
				$zona_total_pasajes_central=0;
				$zona_total_alojamientos_central=0;
				$zona_total_central=0;

				$zona_total_viaticos_oriental=0;
				$zona_total_pasajes_oriental=0;
				$zona_total_alojamientos_oriental=0;
				$zona_total_oriental=0;

				$total_total_viatico=0;
				$total_total_pasaje=0;
				$total_total_alojamiento=0;
				$total_total=0;

				$viatico = $this->Reportes_viaticos_model->obtenerViaticoAnualxDepto($data);
				if($viatico->num_rows()>0){
				foreach ($viatico->result() as $viaticos) {
					if($viaticos->id_depto>="00001" && $viaticos->id_depto<='00003'){
						$zona_total_viaticos_occidental+= $viaticos->viatico;
						$zona_total_pasajes_occidental+= $viaticos->pasaje;
						$zona_total_alojamientos_occidental+= $viaticos->alojamiento;

						$total_total_viatico+=$viaticos->viatico;
						$total_total_pasaje+=$viaticos->pasaje;
						$total_total_alojamiento+=$viaticos->alojamiento;
						 
					}

					if($viaticos->id_depto>="00004" && $viaticos->id_depto<='00010'){
						$total_viaticos_central+= $viaticos->viatico;
						$zona_total_pasajes_central+= $viaticos->pasaje;
						$zona_total_alojamientos_central+= $viaticos->alojamiento;

						$total_total_viatico+=$viaticos->viatico;
						$total_total_pasaje+=$viaticos->pasaje;
						$total_total_alojamiento+=$viaticos->alojamiento;
					}

					if($viaticos->id_depto>="00011" && $viaticos->id_depto<='00014'){
						$zona_total_viaticos_oriental+=$viaticos->viatico;
						$zona_total_pasajes_oriental+=$viaticos->pasaje;
						$zona_total_alojamientos_oriental+=$viaticos->alojamiento;

						$total_total_viatico+=$viaticos->viatico;
						$total_total_pasaje+=$viaticos->pasaje;
						$total_total_alojamiento+=$viaticos->alojamiento;
					}
				}
				$zona_total_occidente = $zona_total_viaticos_occidental + $zona_total_pasajes_occidental + $zona_total_alojamientos_occidental;
				$zona_total_central = $total_viaticos_central+$zona_total_pasajes_central+$zona_total_alojamientos_central;
				$zona_total_oriental = $zona_total_viaticos_oriental+$zona_total_pasajes_oriental+$zona_total_alojamientos_oriental;

					$cuerpo .= '
						<tr>
							<td align="center" style="width:180px">Occidental</td>
							<td align="center" style="width:180px">$'.number_format($zona_total_viaticos_occidental,2,".",",").'</td>
							<td align="center" style="width:180px">$'.number_format($zona_total_pasajes_occidental,2,".",",").'</td>
							<td align="center" style="width:180px">$'.number_format($zona_total_alojamientos_occidental,2,".",",").'</td>
							<td align="center" style="width:180px">$'.number_format($zona_total_occidente,2,".",",").'</td>
						</tr>
						<tr>
							<td align="center" style="width:180px">Central</td>
							<td align="center" style="width:180px">$'.number_format($total_viaticos_central,2,".",",").'</td>
							<td align="center" style="width:180px">$'.number_format($zona_total_pasajes_central,2,".",",").'</td>
							<td align="center" style="width:180px">$'.number_format($zona_total_alojamientos_central,2,".",",").'</td>
							<td align="center" style="width:180px">$'.number_format($zona_total_central,2,".",",").'</td>
						</tr>
						<tr>
							<td align="center" style="width:180px">Oriental</td>
							<td align="center" style="width:180px">$'.number_format($zona_total_viaticos_oriental,2,".",",").'</td>
							<td align="center" style="width:180px">$'.number_format($zona_total_pasajes_oriental,2,".",",").'</td>
							<td align="center" style="width:180px">$'.number_format($zona_total_alojamientos_oriental,2,".",",").'</td>
							<td align="center" style="width:180px">$'.number_format($zona_total_oriental,2,".",",").'</td>
						</tr>
						';
					
				}else{
				$cuerpo .= '
						<tr><td colspan="9"><center>No hay registros</center></td></tr>
					';
				}
				$cuerpo .= '
					<tr>
							<td align="center" style="width:180px">Total</td>
							<td align="center" style="width:180px">$'.number_format($total_total_viatico,2,".",",").'</td>
							<td align="center" style="width:180px">$'.number_format($total_total_pasaje,2,".",",").'</td>
							<td align="center" style="width:180px">$'.number_format($total_total_alojamiento,2,".",",").'</td>
							<td align="center" style="width:180px">$'.number_format($zona_total_occidente+$zona_total_oriental+$zona_total_central,2,".",",").'</td>
						</tr>
				</tbody>
			</table><br>
			<img src="'.base_url().'assets/graficas/grafica_zona_depto_'.$this->session->userdata('usuario_viatico').'.png" alt="">
			<img src="'.base_url().'assets/graficas/grafica_zona_depto_t_'.$this->session->userdata('usuario_viatico').'.png" alt="">
			      '; 
		if($tipo=="pdf"){
			$stylesheet = file_get_contents(base_url().'assets/plugins/bootstrap/css/bootstrap.min.css');
			$this->mpdf->AddPage('P','','','','',15,15,35,17,7,9);
			$this->mpdf->SetTitle('Viaticos por Año');
			$this->mpdf->WriteHTML($stylesheet,1);  // The parameter 1 tells that this iscss/style only and no body/html/
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

			$titulosColumnas = array('ZONA','VIÁTICOS','PASAJES','ALOJAMIENTOS','TOTAL');
			$this->objPHPExcel->setActiveSheetIndex(0)
			    ->setCellValue('A7',  $titulosColumnas[0])  //Titulo de las columnas
			    ->setCellValue('B7',  $titulosColumnas[1])
			    ->setCellValue('C7',  $titulosColumnas[2])
			    ->setCellValue('D7',  $titulosColumnas[3])
			    ->setCellValue('E7',  $titulosColumnas[4])
			    ;

			 
			$this->objPHPExcel->setActiveSheetIndex(0)
			            ->setCellValue('A1', "MINISTERIO DE TRABAJO Y PREVISIÓN SOCIAL")
			            ->setCellValue('A2', "UNIDAD FINANCIERA INSTITUCIONAL")
			            ->setCellValue('A3', "FONDO CIRCULANTE DEL MONTO FIJO")
			            ->setCellValue('A4', "REPORTE VIÁTICOS POR ZONA DEPARTAMENTAL")
			            ;
			 $this->objPHPExcel->setActiveSheetIndex(0)->getStyle('A7:E7')->getFont()->setBold(true); 
			 $this->objPHPExcel->setActiveSheetIndex(0)
			    ->setCellValue('A5',  "Año:")
			    ->setCellValue('B5',  $anios);
			
			 //////////////////////////////////////////////////
			 $data=$anios;
				//$data = str_split($anios,4);
				//$data=array(2018,2017,2016,2015);
				$zona_total_viaticos_occidental=0;
				$zona_total_pasajes_occidental=0;
				$zona_total_alojamientos_occidental=0;
				$zona_total_occidente=0;

				$zona_total_viaticos_central=0;
				$zona_total_pasajes_central=0;
				$zona_total_alojamientos_central=0;
				$zona_total_central=0;

				$zona_total_viaticos_oriental=0;
				$zona_total_pasajes_oriental=0;
				$zona_total_alojamientos_oriental=0;
				$zona_total_oriental=0;

				$zona_total_total_viatico=0;
				$zona_total_total_pasaje=0;
				$zona_total_total_alojamiento=0;
				$zona_total_total=0;
				$f=8;
				$viatico_zona = $this->Reportes_viaticos_model->obtenerViaticoAnualxDepto($data);
				if($viatico_zona->num_rows()>0){
				foreach ($viatico_zona->result() as $viaticos) {
					if($viaticos->id_depto>="00001" && $viaticos->id_depto<='00003'){
						$zona_total_viaticos_occidental+= $viaticos->viatico;
						$zona_total_pasajes_occidental+= $viaticos->pasaje;
						$zona_total_alojamientos_occidental+= $viaticos->alojamiento;

						$zona_total_total_viatico+=$viaticos->viatico;
						$zona_total_total_pasaje+=$viaticos->pasaje;
						$zona_total_total_alojamiento+=$viaticos->alojamiento;
						 
					}

					if($viaticos->id_depto>="00004" && $viaticos->id_depto<='00010'){
						$zona_total_viaticos_central+= $viaticos->viatico;
						$zona_total_pasajes_central+= $viaticos->pasaje;
						$zona_total_alojamientos_central+= $viaticos->alojamiento;

						$zona_total_total_viatico+=$viaticos->viatico;
						$zona_total_total_pasaje+=$viaticos->pasaje;
						$zona_total_total_alojamiento+=$viaticos->alojamiento;
					}

					if($viaticos->id_depto>="00011" && $viaticos->id_depto<='00014'){
						$zona_total_viaticos_oriental+=$viaticos->viatico;
						$zona_total_pasajes_oriental+=$viaticos->pasaje;
						$zona_total_alojamientos_oriental+=$viaticos->alojamiento;

						$zona_total_total_viatico+=$viaticos->viatico;
						$zona_total_total_pasaje+=$viaticos->pasaje;
						$zona_total_total_alojamiento+=$viaticos->alojamiento;
					}
				}
				
				$zona_total_occidente = $zona_total_viaticos_occidental + $zona_total_pasajes_occidental + $zona_total_alojamientos_occidental;
				$zona_total_central = $total_viaticos_central+$zona_total_pasajes_central+$zona_total_alojamientos_central;
				$zona_total_oriental = $zona_total_viaticos_oriental+$zona_total_pasajes_oriental+$zona_total_alojamientos_oriental;
				$this->objPHPExcel->getActiveSheet()->getStyle('B'.$f.':E'.$f)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
					$this->objPHPExcel->getActiveSheet()->getStyle('A'.$f)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
					// Miscellaneous glyphs, UTF-8
					$this->objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A'.$f,"OCCIDENTAL")
							->setCellValue('B'.$f,number_format($zona_total_viaticos_occidental,2,".",","))
							->setCellValue('C'.$f, number_format($zona_total_pasajes_occidental,2,".",","))
							->setCellValue('D'.$f,number_format($zona_total_alojamientos_occidental,2,".",","))
							->setCellValue('E'.$f, number_format($zona_total_occidente,2,".",","));
							$f++;
					$this->objPHPExcel->getActiveSheet()->getStyle('B'.$f.':E'.$f)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
					$this->objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A'.$f,"CENTRAL")
							->setCellValue('B'.$f,number_format($zona_total_viaticos_central,2,".",","))
							->setCellValue('C'.$f, number_format($zona_total_pasajes_central,2,".",","))
							->setCellValue('D'.$f,number_format($zona_total_alojamientos_central,2,".",","))
							->setCellValue('E'.$f, number_format($zona_total_central,2,".",","));
							$f++;
					$this->objPHPExcel->getActiveSheet()->getStyle('B'.$f.':E'.$f)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
					$this->objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A'.$f,"ORIENTAL")
							->setCellValue('B'.$f,number_format($zona_total_viaticos_oriental,2,".",","))
							->setCellValue('C'.$f, number_format($zona_total_pasajes_oriental,2,".",","))
							->setCellValue('D'.$f,number_format($zona_total_alojamientos_oriental,2,".",","))
							->setCellValue('E'.$f, number_format($zona_total_oriental,2,".",","));
									
				}else{
					$this->objPHPExcel->setActiveSheetIndex(0)
				            ->setCellValue('A'.$f, "NO HAY REGISTROS")
				            ->mergeCells('A'.$f.':E'.$f);
				}
				$f++;
				$this->objPHPExcel->getActiveSheet()->getStyle('B'.$f.':E'.$f)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
					$this->objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A'.$f,"TOTAL")
							->setCellValue('B'.$f,number_format($zona_total_total_viatico,2,".",","))
							->setCellValue('C'.$f, number_format($zona_total_total_pasaje,2,".",","))
							->setCellValue('D'.$f,number_format($zona_total_total_alojamiento,2,".",","))
							->setCellValue('E'.$f, number_format($zona_total_occidente+$zona_total_oriental+$zona_total_central,2,".",","));
			$this->objPHPExcel->setActiveSheetIndex(0)->getStyle('A'.$f.':E'.$f)->getFont()->setBold(true); 
			 //////////////////////////////////////////////////
			 ///
			$fecha=strftime( "%d-%m-%Y - %H:%M:%S", time() );
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

			for($i = 'A'; $i <= 'E'; $i++){
				for($ii = '7'; $ii <= '50'; $ii++){
			    $this->objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($i,$ii)->setAutoSize(TRUE);
				}
			}
			$this->objPHPExcel->setActiveSheetIndex(0)->getStyle('A1:A7')->getFont()->setBold(true); 
			
			// Rename worksheet
			$this->objPHPExcel->getActiveSheet()->setTitle('Viaticos Por Zona Departamental');
			// Redirect output to a client’s web browser (Excel5)
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="Viaticos_por_zona_departamental.xls"');
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
		$this->mpdf = new \Mpdf\Mpdf();

		$cabecera = '<table><tr>
 		<td>
		   <img src="application/controllers/informes/logomtps.jpeg"  width="125px" height="85px"> 
		</td>
		<td width="950px"><h5><center>MINISTERIO DE TRABAJO Y PREVISIÓN SOCIAL <br> UNIDAD FINANCIERA INSTITUCIONAL <br> FONDO CIRCULANTE DEL MONTO FIJO <br> <span style="font-size: 22px;">REPORTE VIÁTICOS PENDIENTE POR EMPLEADO</span></center><h5></td>
		<td>
		    <img src="application/controllers/informes/escudo.jpg" width="150px" height="55px">
		</td>
	 	</tr></table>';
	 	$cabecera_vista = '<table><tr>
 		<td>
 			<img src="'.base_url().'assets/logos_vista/logomtps.jpg"  width="125px" height="85px">
		</td>
		<td width="950px"><h5><center>MINISTERIO DE TRABAJO Y PREVISIÓN SOCIAL <br> UNIDAD FINANCIERA INSTITUCIONAL <br> FONDO CIRCULANTE DEL MONTO FIJO <br> <span style="font-size: 17px;">REPORTE VIÁTICOS PENDIENTE POR EMPLEADO</span></center><h5></td>
		<td>
		    <img src="'.base_url().'assets/logos_vista/escudo.jpg" width="150px" height="55px">
		</td>
	 	</tr></table>';
	 	$fecha=strftime( "%d-%m-%Y - %H:%M:%S", time() );
	 	$pie = 'Usuario: '.$this->session->userdata('usuario_viatico').'    Fecha y Hora Creación: '.$fecha.'||{PAGENO} de {nbpg} páginas';
	 	


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
						<td align="center" rowspan="2">Fecha Solicitud</td>
						<td align="center" rowspan="2">Fecha Inicio Misión</td>
						<td align="center" rowspan="2">Fecha Fin Misión</td>
						<td align="center" rowspan="2">Actividad</td>
						<td align="center" rowspan="2">Detalle Actividad</td>
						<td align="center" colspan="3">Tipo</td>
						<td align="center" rowspan="2">Total</td>
						<td align="center" rowspan="2">Estado</td>
						 
					</tr>
					<tr>
						<td align="center">Viáticos</td>
						<td align="center">Pasajes</td>
						<td align="center">Alojamiento</td>
					</tr>
				</thead>
				<tbody>
					
					';
					$suma_total=0;
					$suma_viaticos=0;
					$suma_pasajes=0;
					$suma_alojamientos=0;
				if($viatico->num_rows()>0){
					
				foreach ($viatico->result() as $viaticos) {
					
					$estado = $this->Reportes_viaticos_model->obtenerDetalleEstado($viaticos->estado);
					foreach ($estado->result() as $estado_detalle) {}
					$actividad = $this->Reportes_viaticos_model->obtenerDetalleActividad($viaticos->id_actividad_realizada);
					foreach ($actividad->result() as $actividad_detalle) {}
					$totales = $this->Reportes_viaticos_model->obtenerTotalMontos($viaticos->id_mision_oficial);
					foreach ($totales->result() as $totales_detalle) {}
					 	
						$suma_viaticos+=$totales_detalle->viatico;
						$suma_pasajes+=$totales_detalle->pasaje;
						$suma_alojamientos+=$totales_detalle->alojamiento;
						$suma_total=$suma_viaticos+$suma_pasajes+$suma_alojamientos;
					$cuerpo .= '
						<tr>
							<td>'.date('d-m-Y',strtotime($viaticos->fecha_solicitud)).'</td>
							<td>'.date('d-m-Y',strtotime($viaticos->fecha_mision_inicio)).'</td>
							<td>'.date('d-m-Y',strtotime($viaticos->fecha_mision_fin)).'</td>
							<td>'.($actividad_detalle->nombre_vyp_actividades).'</td>
							<td>'.($viaticos->detalle_actividad).'</td>
							<td>$'.number_format($totales_detalle->viatico,2,".",",").'</td>
							<td>$'.number_format($totales_detalle->pasaje,2,".",",").'</td>
							<td>$'.number_format($totales_detalle->alojamiento,2,".",",").'</td>
							<td>$'.number_format($totales_detalle->total,2,".",",").'</td>
							<td>'.ucwords($estado_detalle->nombre_estado).'</td>
							
						</tr>
						';
					
					}
				}else{
				$cuerpo .= '
						<tr><td colspan="10"><center>No hay registros</center></td></tr>
					';
				}
				$cuerpo .= '
					<tr>
							<td colspan="5" align="right">Total</td>
							<td>$'.number_format($suma_viaticos,2,".",",").'</td>
							<td>$'.number_format($suma_pasajes,2,".",",").'</td>
							<td>$'.number_format($suma_alojamientos,2,".",",").'</td>
							<td>$'.number_format($suma_total,2,".",",").'</td>
							<td></td>
							
						</tr>
				</tbody>
			</table>

        ';         // LOAD a stylesheet         
        if($tipo=="pdf"){
			$this->mpdf->AddPage('L','','','','',15,15,35,17,7,9);
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

			$titulosColumnas = array('FECHA SOLICITUD', 'FECHA INICIO MISIÓN', 'FECHA FIN MISIÓN', 'ACTIVIDAD','DETALLE ACTIVIDAD','VIÁTICOS','PASAJES','ALOJAMIENTOS','TOTAL','ESTADO','FECHA PAGO');
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
			            ->setCellValue('A1', "MINISTERIO DE TRABAJO Y PREVISIÓN SOCIAL")
			            ->setCellValue('A2', "UNIDAD FINANCIERA INSTITUCIONAL")
			            ->setCellValue('A3', "FONDO CIRCULANTE DEL MONTO FIJO")
			            ->setCellValue('A4', "REPORTE VIÁTICOS PENDIENTE POR EMPLEADO")
			            ->setCellValue('A7', "NR")
			            ->setCellValue('B7', $id)
			            ->setCellValue('A8', "NOMBRE")
			            ->setCellValue('B8', $key->nombre_completo);
			    $f=11;
			if($viatico->num_rows()>0){
					$suma_total=0;
					$suma_viaticos=0;
					$suma_pasajes=0;
					$suma_alojamientos=0;
				foreach ($viatico->result() as $viaticos) {
					$estado = $this->Reportes_viaticos_model->obtenerDetalleEstado($viaticos->estado);
					foreach ($estado->result() as $estado_detalle) {}
					$actividad = $this->Reportes_viaticos_model->obtenerDetalleActividad($viaticos->id_actividad_realizada);
					foreach ($actividad->result() as $actividad_detalle) {}
					$totales = $this->Reportes_viaticos_model->obtenerTotalMontos($viaticos->id_mision_oficial);
					foreach ($totales->result() as $totales_detalle) {}

						$suma_viaticos+=$totales_detalle->viatico;
						$suma_pasajes+=$totales_detalle->pasaje;
						$suma_alojamientos+=$totales_detalle->alojamiento;
						$suma_total=$suma_viaticos+$suma_pasajes+$suma_alojamientos;

				$this->objPHPExcel->getActiveSheet()->getStyle('F'.$f.':J'.$f)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);

				// Miscellaneous glyphs, UTF-8
				$this->objPHPExcel->setActiveSheetIndex(0)
				            ->setCellValue('A'.$f, date('d-m-Y',strtotime($viaticos->fecha_solicitud)))
				            ->setCellValue('B'.$f, date('d-m-Y',strtotime($viaticos->fecha_mision_inicio)))
				            ->setCellValue('C'.$f, date('d-m-Y',strtotime($viaticos->fecha_mision_fin)))
				            ->setCellValue('D'.$f, ($actividad_detalle->nombre_vyp_actividades))
				            ->setCellValue('E'.$f,($viaticos->detalle_actividad))
				            ->setCellValue('F'.$f,number_format($totales_detalle->viatico,2,".",","))
				            ->setCellValue('G'.$f,number_format($totales_detalle->pasaje,2,".",","))
				            ->setCellValue('H'.$f,number_format($totales_detalle->alojamiento,2,".",","))
				            ->setCellValue('I'.$f,number_format($totales_detalle->total,2,".",","))
				            ->setCellValue('J'.$f,ucwords($estado_detalle->nombre_estado));
				         $f++;
				}
				$this->objPHPExcel->getActiveSheet()->getStyle('F'.$f.':J'.$f)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
				$this->objPHPExcel->setActiveSheetIndex(0)->getStyle('E'.$f.':J'.$f)->getFont()->setBold(true);
				$this->objPHPExcel->setActiveSheetIndex(0)
				            ->setCellValue('A'.$f,"")
				            ->setCellValue('B'.$f,"")
				            ->setCellValue('C'.$f,"")
				            ->setCellValue('D'.$f,"")
				            ->setCellValue('E'.$f,"Total")
				            ->setCellValue('F'.$f,number_format($suma_viaticos,2,".",","))
				            ->setCellValue('G'.$f,number_format($suma_pasajes,2,".",","))
				            ->setCellValue('H'.$f,number_format($suma_alojamientos,2,".",","))
				            ->setCellValue('I'.$f,number_format($suma_total,2,".",","))
				            ->setCellValue('J'.$f,"");
			}else{
				$this->objPHPExcel->setActiveSheetIndex(0)
				            ->setCellValue('A'.$f, "NO HAY REGISTROS")
				            ->mergeCells('A'.$f.':J'.$f);

			}
			
			$fecha=strftime( "%d-%m-%Y - %H:%M:%S", time() );
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
		$this->mpdf = new \Mpdf\Mpdf();

		$cabecera = '<table><tr>
 		<td>
		    <img src="application/controllers/informes/logomtps.jpeg"  width="125px" height="85px">
		</td>
		<td width="950px"><h5><center>MINISTERIO DE TRABAJO Y PREVISIÓN SOCIAL <br> UNIDAD FINANCIERA INSTITUCIONAL <br> FONDO CIRCULANTE DEL MONTO FIJO <br> <span style="font-size: 22px;">REPORTE VIÁTICOS PAGADOS POR EMPLEADO</span></center><h5></td>
		<td>
		    <img src="application/controllers/informes/escudo.jpg" width="150px" height="55px">
		</td>
	 	</tr></table>';

	 	$cabecera_vista = '<table><tr>
 		<td>
		    <img src="'.base_url().'assets/logos_vista/logomtps.jpg"  width="125px" height="85px">
		</td>
		<td width="950px"><h5><center>MINISTERIO DE TRABAJO Y PREVISIÓN SOCIAL <br> UNIDAD FINANCIERA INSTITUCIONAL <br> FONDO CIRCULANTE DEL MONTO FIJO <br> <span style="font-size: 17px;">REPORTE VIÁTICOS PAGADOS POR EMPLEADO</span></center><h5></td>
		<td>
			<img src="'.base_url().'assets/logos_vista/escudo.jpg" width="150px" height="55px">
		</td>
	 	</tr></table>';
	 	$fecha=strftime( "%d-%m-%Y - %H:%M:%S", time() );
	 	$pie = 'Usuario: '.$this->session->userdata('usuario_viatico').'    Fecha y Hora Creación: '.$fecha.'||{PAGENO} de {nbpg} páginas';


		$this->mpdf->SetHTMLHeader($cabecera);
		//$this->mpdf->SetHTMLFooter('{PAGENO} of {nbpg} pages');
		$this->mpdf->setFooter($pie);
		 $data = array('nr'=>$id);
		$empleado_NR_viatico = $this->Reportes_viaticos_model->obtenerNREmpleadoViatico($data);
		foreach ($empleado_NR_viatico->result() as $key) {	
		}
		$ids = array(
			'nr' =>  $id,
			'fmin' => $min,
			'fmax' => $max
		);
		$viatico = $this->Reportes_viaticos_model->obtenerListaviaticoPagado($ids);

		
		$cuerpo = '
		<h6>NR: '.$id.'	Empleado: '.($key->nombre_completo).'</h6>
			<table  class="" border="1" style="width:100%">
				
				<thead >

					<tr>
						<td align="center" rowspan="2">Fecha Solicitud</td>
						<td align="center" rowspan="2">Fecha Inicio Misión</td>
						<td align="center" rowspan="2">Fecha Fin Misión</td>
						<td align="center" rowspan="2">Actividad</td>
						<td align="center" rowspan="2">Detalle Actividad</td>
						<td align="center" colspan="3">Tipo</td>
						<td align="center" rowspan="2">Total</td>
						<td align="center" rowspan="2">Estado</td>
						 <td align="center" rowspan="2">Fecha Pago</td>
					</tr>
					<tr>
						<td align="center">Viáticos</td>
						<td align="center">Pasajes</td>
						<td align="center">Alojamiento</td>
					</tr>
				</thead>
				<tbody>
					
					';
					$suma_total=0;
					$suma_viaticos=0;
					$suma_pasajes=0;
					$suma_alojamientos=0;
				if($viatico->num_rows()>0){
					
				foreach ($viatico->result() as $viaticos) {
				
					$estado = $this->Reportes_viaticos_model->obtenerDetalleEstado($viaticos->estado);
					foreach ($estado->result() as $estado_detalle) {}
					$actividad = $this->Reportes_viaticos_model->obtenerDetalleActividad($viaticos->id_actividad_realizada);
					foreach ($actividad->result() as $actividad_detalle) {}
					$totales = $this->Reportes_viaticos_model->obtenerTotalMontos($viaticos->id_mision_oficial);
					foreach ($totales->result() as $totales_detalle) {}
						$suma_viaticos+=$totales_detalle->viatico;
						$suma_pasajes+=$totales_detalle->pasaje;
						$suma_alojamientos+=$totales_detalle->alojamiento;
						$suma_total=$suma_viaticos+$suma_pasajes+$suma_alojamientos;	
					$cuerpo .= '
						<tr>
							<td>'.date('d-m-Y',strtotime($viaticos->fecha_solicitud)).'</td>
							<td>'.date('d-m-Y',strtotime($viaticos->fecha_mision_inicio)).'</td>
							<td>'.date('d-m-Y',strtotime($viaticos->fecha_mision_fin)).'</td>
							<td>'.($actividad_detalle->nombre_vyp_actividades).'</td>
							<td >'.($viaticos->detalle_actividad).'</td>
							<td>$'.number_format($totales_detalle->viatico,2,".",",").'</td>
							<td>$'.number_format($totales_detalle->pasaje,2,".",",").'</td>
							<td>$'.number_format($totales_detalle->alojamiento,2,".",",").'</td>
							<td>$'.number_format($totales_detalle->total,2,".",",").'</td>
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
					<tr>
							<td colspan="5" align="right">Total</td>
							<td>$'.number_format($suma_viaticos,2,".",",").'</td>
							<td>$'.number_format($suma_pasajes,2,".",",").'</td>
							<td>$'.number_format($suma_alojamientos,2,".",",").'</td>
							<td>$'.number_format($suma_total,2,".",",").'</td>
							<td colspan="2"></td>
						</tr>
				</tbody>
			</table>

        ';         // LOAD a stylesheet
        if($tipo=="pdf"){         
	        $stylesheet = file_get_contents(base_url().'assets/plugins/bootstrap/css/bootstrap.min.css');
			$this->mpdf->AddPage('L','','','','',15,15,35,17,3,9);
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

			$titulosColumnas = array('FECHA SOLICITUD', 'FECHA INICIO MISIÓN', 'FECHA FIN MISIÓN', 'ACTIVIDAD','DETALLE ACTIVIDAD','VIÁTICOS','PASAJES','ALOJAMIENTOS','TOTAL','ESTADO','FECHA PAGO');
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
			    ->setCellValue('J10',  $titulosColumnas[9])
			    ->setCellValue('K10',  $titulosColumnas[10]);							 
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
			            ->setCellValue('A1', "MINISTERIO DE TRABAJO Y PREVISIÓN SOCIAL")
			            ->setCellValue('A2', "UNIDAD FINANCIERA INSTITUCIONAL")
			            ->setCellValue('A3', "FONDO CIRCULANTE DEL MONTO FIJO")
			            ->setCellValue('A4', "REPORTE VIÁTICOS PAGADOS POR EMPLEADO")
			            ->setCellValue('A7', "NR")
			            ->setCellValue('B7', $id)
			            ->setCellValue('A8', "NOMBRE")
			            ->setCellValue('B8', $key->nombre_completo);
			    $f=11;
			if($viatico->num_rows()>0){
					$suma_total=0;
					$suma_viaticos=0;
					$suma_pasajes=0;
					$suma_alojamientos=0;
				foreach ($viatico->result() as $viaticos) {
					$estado = $this->Reportes_viaticos_model->obtenerDetalleEstado($viaticos->estado);
					foreach ($estado->result() as $estado_detalle) {}
					$actividad = $this->Reportes_viaticos_model->obtenerDetalleActividad($viaticos->id_actividad_realizada);
					foreach ($actividad->result() as $actividad_detalle) {}
					$totales = $this->Reportes_viaticos_model->obtenerTotalMontos($viaticos->id_mision_oficial);
					foreach ($totales->result() as $totales_detalle) {}
						$suma_viaticos+=$totales_detalle->viatico;
						$suma_pasajes+=$totales_detalle->pasaje;
						$suma_alojamientos+=$totales_detalle->alojamiento;
						$suma_total=$suma_viaticos+$suma_pasajes+$suma_alojamientos;
				$this->objPHPExcel->getActiveSheet()->getStyle('F'.$f.':I'.$f)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);

				// Miscellaneous glyphs, UTF-8
				$this->objPHPExcel->setActiveSheetIndex(0)
				            ->setCellValue('A'.$f, date('d-m-Y',strtotime($viaticos->fecha_solicitud)))
				            ->setCellValue('B'.$f, date('d-m-Y',strtotime($viaticos->fecha_mision_inicio)))
				            ->setCellValue('C'.$f, date('d-m-Y',strtotime($viaticos->fecha_mision_fin)))
				            ->setCellValue('D'.$f, ($actividad_detalle->nombre_vyp_actividades))
				            ->setCellValue('E'.$f,($viaticos->detalle_actividad))
				            ->setCellValue('F'.$f,number_format($totales_detalle->viatico,2,".",","))
				            ->setCellValue('G'.$f,number_format($totales_detalle->pasaje,2,".",","))
				            ->setCellValue('H'.$f,number_format($totales_detalle->alojamiento,2,".",","))
				            ->setCellValue('I'.$f,number_format($totales_detalle->total,2,".",","))
				            ->setCellValue('J'.$f,ucwords($estado_detalle->nombre_estado))
				            ->setCellValue('K'.$f,date('d-m-Y',strtotime($viaticos->fecha_pago)));
				         $f++;
				}
				$this->objPHPExcel->getActiveSheet()->getStyle('F'.$f.':I'.$f)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
				$this->objPHPExcel->setActiveSheetIndex(0)->getStyle('E'.$f.':I'.$f)->getFont()->setBold(true); 
				$this->objPHPExcel->setActiveSheetIndex(0)
				            ->setCellValue('A'.$f, "")
				            ->setCellValue('B'.$f, "")
				            ->setCellValue('C'.$f, "")
				            ->setCellValue('D'.$f, "")
				            ->setCellValue('E'.$f,"")
				            ->setCellValue('F'.$f,number_format($suma_viaticos,2,".",","))
				            ->setCellValue('G'.$f,number_format($suma_pasajes,2,".",","))
				            ->setCellValue('H'.$f,number_format($suma_alojamientos,2,".",","))
				            ->setCellValue('I'.$f,number_format($suma_total,2,".",","))
				            ->setCellValue('J'.$f,"")
				            ->setCellValue('K'.$f,"");
			}else{
				$this->objPHPExcel->setActiveSheetIndex(0)
				            ->setCellValue('A'.$f, "NO HAY REGISTROS")
				            ->mergeCells('A'.$f.':K'.$f);

			}
			
			$fecha=strftime( "%d-%m-%Y - %H:%M:%S", time() );
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

			for($i = 'A'; $i <= 'K'; $i++){
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
		$this->mpdf = new \Mpdf\Mpdf();

		$cabecera = '<table width="100%"><tr>
 		<td>
 			<img src="application/controllers/informes/logomtps.jpeg"  width="125px" height="85px">
		</td>
		<td width="580px"><h5><center>MINISTERIO DE TRABAJO Y PREVISIÓN SOCIAL <br> UNIDAD FINANCIERA INSTITUCIONAL <br> FONDO CIRCULANTE DEL MONTO FIJO <br> <span style="font-size: 22px;">REPORTE VIÁTICOS DE MAYOR A MENOR</span></center><h5></td>
		<td align="right">
		   <img src="application/controllers/informes/escudo.jpg" width="150px" height="55px">
		</td>
	 	</tr></table>';

	 	$cabecera_vista = '<table><tr>
 		<td>
 			<img src="'.base_url().'assets/logos_vista/logomtps.jpg"  width="125px" height="85px">
		</td>
		<td width="950px"><h5><center>MINISTERIO DE TRABAJO Y PREVISIÓN SOCIAL <br> UNIDAD FINANCIERA INSTITUCIONAL <br> FONDO CIRCULANTE DEL MONTO FIJO <br> <span style="font-size: 17px;">REPORTE VIÁTICOS DE MAYOR A MENOR</span></center><h5></td>
		<td>
		   	<img src="'.base_url().'assets/logos_vista/escudo.jpg" width="150px" height="55px">
		</td>
	 	</tr></table>';
	 	$fecha=strftime( "%d-%m-%Y - %H:%M:%S", time() );
	 	$pie = 'Usuario: '.$this->session->userdata('usuario_viatico').'    Fecha y Hora Creación: '.$fecha.'||{PAGENO} de {nbpg} páginas';


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
						<td align="center" rowspan="2">NR</td>
						<td align="center" rowspan="2">Nombre Completo</td>
						<td align="center" colspan="4">Tipo</td>
					</tr>
					<tr>
						<td align="center">Viáticos</td>
						<td align="center">Pasajes</td>
						<td align="center">Alojamiento</td>
						<td align="center">Total</td>
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
						<td colspan="2">Total</td>
						<td style="text-align:right">$'.number_format($total_viaticos,2,".",",").'</td>
						<td style="text-align:right">$'.number_format($total_pasajes,2,".",",").'</td>
						<td style="text-align:right">$'.number_format($total_alojamientos,2,".",",").'</td>
						<td style="text-align:right">$'.number_format($total_total,2,".",",").'</td>
					</tr>
				</tbody>
			</table>
        ';         // LOAD a stylesheet         
        

		if($tipo=="pdf"){
			$stylesheet = file_get_contents(base_url().'assets/plugins/bootstrap/css/bootstrap.min.css');
			$this->mpdf->AddPage('L','','','','',15,15,35,17,7,9);
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

			$titulosColumnas = array('NR', 'NOMBRE COMPLETO','VIÁTICOS','PASAJES','ALOJAMIENTOS','TOTAL');
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
			            ->setCellValue('A1', "MINISTERIO DE TRABAJO Y PREVISIÓN SOCIAL")
			            ->setCellValue('A2', "UNIDAD FINANCIERA INSTITUCIONAL")
			            ->setCellValue('A3', "FONDO CIRCULANTE DEL MONTO FIJO")
			            ->setCellValue('A4', "REPORTE VIÁTICOS DE MAYOR A MENOR POR EMPLEADO")
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

			$fecha=strftime( "%d-%m-%Y - %H:%M:%S", time() );
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
		$b1plot->SetLegend("Viáticos");

		$b2plot->value->Show();
		$b2plot->SetLegend("Pasaje");
		$b3plot->value->Show();
		$b3plot->SetLegend("Alojamiento");
		//$b4plot->value->Show();
		//$b4plot->SetLegend("Total");

		$graph->title->Set(utf8_decode("Viáticos por Mes"));
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
		 

		$graph->title->Set(utf8_decode("Viáticos por Mes"));
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
		$this->mpdf = new \Mpdf\Mpdf();

		$cabecera = '<table width="100%"><tr>
 		<td>
		    <img src="application/controllers/informes/logomtps.jpeg"  width="125px" height="85px">
		</td>
		<td width="580px"><h5><center>MINISTERIO DE TRABAJO Y PREVISIÓN SOCIAL <br> UNIDAD FINANCIERA INSTITUCIONAL <br> FONDO CIRCULANTE DEL MONTO FIJO <br> <span style="font-size: 22px;">REPORTE VIÁTICOS POR PERIODO</span></center><h5></td>
		<td align="right">
		   <img src="application/controllers/informes/escudo.jpg" width="150px" height="55px">
		</td>
	 	</tr></table>';

	 	$cabecera_vista = '<table width="100%"><tr>
 		<td>
		    <img src="'.base_url().'assets/logos_vista/logomtps.jpg"  width="125px" height="85px">
		</td>
		<td width="950px"><h5><center>MINISTERIO DE TRABAJO Y PREVISIÓN SOCIAL <br> UNIDAD FINANCIERA INSTITUCIONAL <br> FONDO CIRCULANTE DEL MONTO FIJO <br> <span style="font-size: 17px;">REPORTE VIÁTICOS POR PERIODO</span></center><h5></td>
		<td>
			<img src="'.base_url().'assets/logos_vista/escudo.jpg" width="150px" height="55px">
		</td>
	 	</tr></table>';
	 	$fecha=strftime( "%d-%m-%Y - %H:%M:%S", time() );
	 	$pie = 'Usuario: '.$this->session->userdata('usuario_viatico').'    Fecha y Hora Creación: '.$fecha.'||{PAGENO} de {nbpg} páginas';


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
		Año: '.$anio.'
			<table  class="" border="1" style="width:100%">
				<thead >
					<tr>
						<td align="center" rowspan="2">Mes</td>
						<td align="center" rowspan="2">Concepto de Gasto</td>
						<td align="center" colspan="3">Tipo</td>
						<td align="center" rowspan="2">Total</td>
					</tr>
					<tr>
						<td align="center">Viáticos</td>
						<td align="center">Pasajes</td>
						<td align="center">Alojamiento</td>
						
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
					<td colspan="2"><center>Totales</center></td>
					<td ><center>$'.number_format($total_viatico,2,".",",").'</center></td>
					<td ><center>$'.number_format($total_pasaje,2,".",",").'</center></td>
					<td ><center>$'.number_format($total_alojamiento,2,".",",").'</center></td>
					<td ><center>$'.number_format($total_total,2,".",",").'</center></td>
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
			$this->mpdf->AddPage('L','','','','',15,15,35,17,7,9);
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

			$titulosColumnas = array('MES', 'CONCEPTO','VIÁTICOS','PASAJES','ALOJAMIENTOS','TOTAL');
			$this->objPHPExcel->setActiveSheetIndex(0)
			    ->setCellValue('A7',  $titulosColumnas[0])  //Titulo de las columnas
			    ->setCellValue('B7',  $titulosColumnas[1])
			    ->setCellValue('C7',  $titulosColumnas[2])
			    ->setCellValue('D7',  $titulosColumnas[3])
			    ->setCellValue('E7',  $titulosColumnas[4])
			    ->setCellValue('F7',  $titulosColumnas[5]);

			

			$this->objPHPExcel->setActiveSheetIndex(0)
			            ->setCellValue('A1', "MINISTERIO DE TRABAJO Y PREVISIÓN SOCIAL")
			            ->setCellValue('A2', "UNIDAD FINANCIERA INSTITUCIONAL")
			            ->setCellValue('A3', "FONDO CIRCULANTE DEL MONTO FIJO")
			            ->setCellValue('A4', "REPORTE VIÁTICOS POR PERIODO");

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
			
			$fecha=strftime( "%d-%m-%Y - %H:%M:%S", time() );
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
	public function reporte_viaticos_por_cargo($tipo,$anio){
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
		$this->mpdf = new \Mpdf\Mpdf();

		$cabecera = '<table width="100%"><tr>
 		<td>
		    <img src="application/controllers/informes/logomtps.jpeg"  width="125px" height="85px">
		</td>
		<td width="580px"><h5><center>MINISTERIO DE TRABAJO Y PREVISIÓN SOCIAL <br> UNIDAD FINANCIERA INSTITUCIONAL <br> FONDO CIRCULANTE DEL MONTO FIJO <br> <span style="font-size: 22px;">REPORTE DE VIÁTICOS DE UNIDADES SOLICITANTES DE MOTORISTA</span> </center><h5></td>
		<td align="right">
			<img src="application/controllers/informes/escudo.jpg" width="150px" height="55px">
		</td>
	 	</tr></table>';

	 	$cabecera_vista = '<table><tr>
 		<td>
		    <img src="'.base_url().'assets/logos_vista/logomtps.jpg"  width="125px" height="85px">
		</td>
		<td width="950px"><h5><center>MINISTERIO DE TRABAJO Y PREVISIÓN SOCIAL <br> UNIDAD FINANCIERA INSTITUCIONAL <br> FONDO CIRCULANTE DEL MONTO FIJO <br> <span style="font-size: 17px;">REPORTE DE VIÁTICOS DE UNIDADES SOLICITANTES DE MOTORISTA</span></center><h5></td>
		<td>
		   	<img src="'.base_url().'assets/logos_vista/escudo.jpg" width="150px" height="55px">
		</td>
	 	</tr></table>';
	 	$fecha=strftime( "%d-%m-%Y - %H:%M:%S", time() );
	 	$pie = 'Usuario: '.$this->session->userdata('usuario_viatico').'    Fecha y Hora Creación: '.$fecha.'||{PAGENO} de {nbpg} páginas';


		$this->mpdf->SetHTMLHeader($cabecera);
		//$this->mpdf->SetHTMLFooter('{PAGENO} of {nbpg} pages');
		$this->mpdf->setFooter($pie);
		
		$data  =array(
			'anio' =>$anio
		);
		//$this->crear_grafico_viaticos_x_mes($anio,$primer_mes,$segundo_mes,$tercer_mes,$cuarto_mes,$quinto_mes,$sexto_mes);
		$viatico = $this->Reportes_viaticos_model->obtenerViaticosMotoristaSolicitado($data);
 
			$cuerpo = '

				<table  class="" border="1" style="width:100%">
					<thead >
						<tr>
							
							<td align="center" rowspan="2" >OFICINAS/UNIDAD</td>
							<td align="center" colspan="3">Tipo</td>
							<td align="center" rowspan="2">Total</td>
						</tr>
						<tr>
							 
							<td align="center">Viáticos</td>
							<td align="center">Pasajes</td>
							<td align="center">Alojamiento</td>
							
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
								<td>'.($viaticos->oficina_solicitante).'</td>
								<td style="text-align:right">$'.number_format($viaticos->viatico,2,".",",").'</td>
								<td style="text-align:right">$'.number_format($viaticos->pasaje,2,".",",").'</td>
								<td style="text-align:right">$'.number_format($viaticos->alojamiento,2,".",",").'</td>
								<td style="text-align:right">$'.number_format($viaticos->viatico,2,".",",").'</td>
								
							</tr>
							';
							
						}
					}else{
						$cuerpo .= '
							<tr><td colspan="5"><center>No hay registros</center></td></tr>

						';
					}
					$cuerpo .= '
					<tr>
					<td style="text-align:center">Totales</td>
					<td style="text-align:right">$'.number_format($total_viatico1,2,".",",").'</td>
					<td style="text-align:right">$'.number_format($total_pasaje1,2,".",",").'</td>
					<td style="text-align:right">$'.number_format($total_alojamiento1,2,".",",").'</td>
					<td style="text-align:right">$'.number_format($total_total_,2,".",",").'</td>
					</tr>
					</tbody>
				</table><br>
				
	        ';         // LOAD a stylesheet   
	     
	    if($tipo=="pdf"){
	        $stylesheet = file_get_contents(base_url().'assets/plugins/bootstrap/css/bootstrap.min.css');
			$this->mpdf->AddPage('L','','','','',15,15,35,17,7,9);
			$this->mpdf->SetTitle('Viaticos por Cargo');
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

			$titulosColumnas = array('UNIDAD/OFICINA','VIÁTICOS','PASAJES','ALOJAMIENTOS','TOTAL');
			$this->objPHPExcel->setActiveSheetIndex(0)
			    ->setCellValue('A7',  $titulosColumnas[0])  //Titulo de las columnas
			    ->setCellValue('B7',  $titulosColumnas[1])
			    ->setCellValue('C7',  $titulosColumnas[2])
			    ->setCellValue('D7',  $titulosColumnas[3])
			    ->setCellValue('E7',  $titulosColumnas[4])
			    ;

			 
			$this->objPHPExcel->setActiveSheetIndex(0)
			            ->setCellValue('A1', "MINISTERIO DE TRABAJO Y PREVISIÓN SOCIAL")
			            ->setCellValue('A2', "UNIDAD FINANCIERA INSTITUCIONAL")
			            ->setCellValue('A3', "FONDO CIRCULANTE DEL MONTO FIJO")
			            ->setCellValue('A4', "REPORTE DE VIÁTICOS POR UNIDADES SOLICITANTES DE MOTORISTA")
			            ;
			 $this->objPHPExcel->setActiveSheetIndex(0)->getStyle('A7:E7')->getFont()->setBold(true); 
			 $this->objPHPExcel->setActiveSheetIndex(0)
			    ->setCellValue('A5',  "Año:")
			    ->setCellValue('B5',  $anio);
			
			 //////////////////////////////////////////////////
			$data  =array(
				'anio' =>$anio
			);
		
		$viatico = $this->Reportes_viaticos_model->obtenerViaticosMotoristaSolicitado($data);
		$total_viatico=0;
		$total_pasaje=0;
		$total_alojamiento=0;
		$total_total=0;
				$f=8;	
				if($viatico->num_rows()>0){
					foreach ($viatico->result() as $viaticos) {
						$total_viatico+=$viaticos->viatico;
						$total_pasaje+=$viaticos->pasaje;
						$total_alojamiento+=$viaticos->alojamiento;
						$total_total+=$viaticos->viatico;
						$this->objPHPExcel->getActiveSheet()->getStyle('B'.$f.':E'.$f)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
						$this->objPHPExcel->getActiveSheet()->getStyle('A'.$f)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
						// Miscellaneous glyphs, UTF-8
						$this->objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A'.$f,$viaticos->oficina_solicitante)
							->setCellValue('B'.$f,number_format($viaticos->viatico,2,".",","))
							->setCellValue('C'.$f, number_format($viaticos->pasaje,2,".",","))
							->setCellValue('D'.$f,number_format($viaticos->alojamiento,2,".",","))
							->setCellValue('E'.$f, number_format($viaticos->viatico,2,".",","));
							$f++;
					}
				}else{
					$this->objPHPExcel->setActiveSheetIndex(0)
				            ->setCellValue('A'.$f, "NO HAY REGISTROS")
				            ->mergeCells('A'.$f.':E'.$f);
				}
				 
				
					$this->objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A'.$f,"TOTAL")
							->setCellValue('B'.$f,number_format($total_viatico,2,".",","))
							->setCellValue('C'.$f, number_format($total_pasaje,2,".",","))
							->setCellValue('D'.$f,number_format($total_alojamiento,2,".",","))
							->setCellValue('E'.$f, number_format($total_total,2,".",","));
			$this->objPHPExcel->setActiveSheetIndex(0)->getStyle('A'.$f.':E'.$f)->getFont()->setBold(true);
			$this->objPHPExcel->getActiveSheet()->getStyle('B'.$f.':E'.$f)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00); 
			 //////////////////////////////////////////////////
			 ///
			$fecha=strftime( "%d-%m-%Y - %H:%M:%S", time() );
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

			for($i = 'A'; $i <= 'E'; $i++){
				for($ii = '7'; $ii <= '50'; $ii++){
			    $this->objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($i,$ii)->setAutoSize(TRUE);
				}
			}
			$this->objPHPExcel->setActiveSheetIndex(0)->getStyle('A1:A7')->getFont()->setBold(true); 
			
			// Rename worksheet
			$this->objPHPExcel->getActiveSheet()->setTitle('Viaticos Unidad Sol. Motorista');
			// Redirect output to a client’s web browser (Excel5)
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="Viaticos_por_unidad_solicitante_motorista.xls"');
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
	public function reporte_viaticos_por_oficina($tipo,$anio){
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
		$this->mpdf = new \Mpdf\Mpdf();

		$cabecera = '<table width="100%"><tr>
 		<td>
		    <img src="application/controllers/informes/logomtps.jpeg"  width="125px" height="85px">
		</td>
		<td width="580px"><h5><center>MINISTERIO DE TRABAJO Y PREVISIÓN SOCIAL <br> UNIDAD FINANCIERA INSTITUCIONAL <br> FONDO CIRCULANTE DEL MONTO FIJO <br> <span style="font-size: 22px;">REPORTE VIÁTICOS POR SECCIÓN</span></center><h5></td>
		<td align="right">
		   	<img src="application/controllers/informes/escudo.jpg" width="150px" height="55px">
		</td>
	 	</tr></table>';

	 	$cabecera_vista = '<table><tr>
 		<td>
		    <img src="'.base_url().'assets/logos_vista/logomtps.jpg"  width="125px" height="85px">
		</td>
		<td width="950px"><h5><center>MINISTERIO DE TRABAJO Y PREVISIÓN SOCIAL <br> UNIDAD FINANCIERA INSTITUCIONAL <br> FONDO CIRCULANTE DEL MONTO FIJO <br> <span style="font-size: 17px;">REPORTE VIÁTICOS POR SECCIÓN</span></center><h5></td>
		<td>
		   	<img src="'.base_url().'assets/logos_vista/escudo.jpg" width="150px" height="55px">
		</td>
	 	</tr></table>';
	 	$fecha=strftime( "%d-%m-%Y - %H:%M:%S", time() );
	 	$pie = 'Usuario: '.$this->session->userdata('usuario_viatico').'    Fecha y Hora Creación: '.$fecha.'||{PAGENO} de {nbpg} páginas';


		$this->mpdf->SetHTMLHeader($cabecera);
		//$this->mpdf->SetHTMLFooter('{PAGENO} of {nbpg} pages');
		$this->mpdf->setFooter($pie);
		
		$data  =array(
			'anio' =>$anio
		);
		//$this->crear_grafico_viaticos_x_mes($anio,$primer_mes,$segundo_mes,$tercer_mes,$cuarto_mes,$quinto_mes,$sexto_mes);
		$viatico = $this->Reportes_viaticos_model->obtenerViaticosPorOficina($data);
		$total_viatico=0;
		$total_pasaje=0;
		$total_alojamiento=0;
		$total_total=0;
		
		$cuerpo = '
			Año: '.$anio.'
			<table  class="" border="1" style="width:100%">

				<thead >
					<tr>
						<td align="center" rowspan="2">Sección</td>
						<td align="center" colspan="3">Tipo</td>
						<td align="center" rowspan="2">total</td>						
					</tr>
					<tr>
						
						<td align="center">Viáticos</td>
						<td align="center">Pasajes</td>
						<td align="center">Alojamiento</td>
						
					</tr>
				</thead>
				<tbody>
					
					';
					
				if($viatico->num_rows()>0){
				foreach ($viatico->result() as $viaticos) {
					$total_viatico+=$viaticos->viatico;
					$total_pasaje+=$viaticos->pasaje;
					$total_alojamiento+=$viaticos->alojamiento;
					$total_total+=$viaticos->total;
					$cuerpo .= '
						<tr>
							<td>'.($viaticos->nombre_seccion).'</td>
							<td style="text-align:right">$'.number_format($viaticos->viatico,2,".",",").'</td>
							<td style="text-align:right">$'.number_format($viaticos->pasaje,2,".",",").'</td>
							<td style="text-align:right">$'.number_format($viaticos->alojamiento,2,".",",").'</td>
							<td style="text-align:right">$'.number_format($viaticos->total,2,".",",").'</td>
							
						</tr>
						';
						
					}
				}else{
					$cuerpo .= '
						<tr><td colspan="5"><center>No hay registros</center></td></tr>

					';
				}
				$cuerpo .= '
					<tr>
							<td>Total</td>
							<td style="text-align:right">$'.number_format($total_viatico,2,".",",").'</td>
							<td style="text-align:right">$'.number_format($total_pasaje,2,".",",").'</td>
							<td style="text-align:right">$'.number_format($total_alojamiento,2,".",",").'</td>
							<td style="text-align:right">$'.number_format($total_total,2,".",",").'</td>
							
						</tr>
				</tbody>
			</table><br>
			
        ';         // LOAD a stylesheet         
	     if($tipo=="pdf"){
	        $stylesheet = file_get_contents(base_url().'assets/plugins/bootstrap/css/bootstrap.min.css');
			$this->mpdf->AddPage('L','','','','',15,15,35,17,7,9);
			$this->mpdf->SetTitle('Viaticos por Cargo');
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

			$titulosColumnas = array('DEPARTAMENTO/OFICINA/SECCIÓN','VIÁTICOS','PASAJES','ALOJAMIENTOS','TOTAL');
			$this->objPHPExcel->setActiveSheetIndex(0)
			    ->setCellValue('A7',  $titulosColumnas[0])  //Titulo de las columnas
			    ->setCellValue('B7',  $titulosColumnas[1])
			    ->setCellValue('C7',  $titulosColumnas[2])
			    ->setCellValue('D7',  $titulosColumnas[3])
			    ->setCellValue('E7',  $titulosColumnas[4])
			    ;

			 
			$this->objPHPExcel->setActiveSheetIndex(0)
			            ->setCellValue('A1', "MINISTERIO DE TRABAJO Y PREVISIÓN SOCIAL")
			            ->setCellValue('A2', "UNIDAD FINANCIERA INSTITUCIONAL")
			            ->setCellValue('A3', "FONDO CIRCULANTE DEL MONTO FIJO")
			            ->setCellValue('A4', "REPORTE VIÁTICOS POR DEPARTAMENTO,OFICINA,SECCION")
			            ;
			 $this->objPHPExcel->setActiveSheetIndex(0)->getStyle('A7:E7')->getFont()->setBold(true); 
			 $this->objPHPExcel->setActiveSheetIndex(0)
			    ->setCellValue('A5',  "Año:")
			    ->setCellValue('B5',  $anio);
			
			 //////////////////////////////////////////////////
			$data  =array(
				'anio' =>$anio
			);
		
		$viatico = $this->Reportes_viaticos_model->obtenerViaticosPorOficina($data);
		$total_viatico=0;
		$total_pasaje=0;
		$total_alojamiento=0;
		$total_total=0;
				$f=8;	
				if($viatico->num_rows()>0){
					foreach ($viatico->result() as $viaticos) {
						$total_viatico+=$viaticos->viatico;
						$total_pasaje+=$viaticos->pasaje;
						$total_alojamiento+=$viaticos->alojamiento;
						$total_total+=$viaticos->total;
						$this->objPHPExcel->getActiveSheet()->getStyle('B'.$f.':E'.$f)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
						$this->objPHPExcel->getActiveSheet()->getStyle('A'.$f)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
						// Miscellaneous glyphs, UTF-8
						$this->objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A'.$f,$viaticos->nombre_seccion)
							->setCellValue('B'.$f,number_format($viaticos->viatico,2,".",","))
							->setCellValue('C'.$f, number_format($viaticos->pasaje,2,".",","))
							->setCellValue('D'.$f,number_format($viaticos->alojamiento,2,".",","))
							->setCellValue('E'.$f, number_format($viaticos->total,2,".",","));
							$f++;
					}
				}else{
					$this->objPHPExcel->setActiveSheetIndex(0)
				            ->setCellValue('A'.$f, "NO HAY REGISTROS")
				            ->mergeCells('A'.$f.':E'.$f);
				}
				 
				$this->objPHPExcel->getActiveSheet()->getStyle('B'.$f.':E'.$f)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
					$this->objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A'.$f,"TOTAL")
							->setCellValue('B'.$f,number_format($total_viatico,2,".",","))
							->setCellValue('C'.$f, number_format($total_pasaje,2,".",","))
							->setCellValue('D'.$f,number_format($total_alojamiento,2,".",","))
							->setCellValue('E'.$f, number_format($total_total,2,".",","));
			$this->objPHPExcel->setActiveSheetIndex(0)->getStyle('A'.$f.':E'.$f)->getFont()->setBold(true); 
			 //////////////////////////////////////////////////
			 ///
			$fecha=strftime( "%d-%m-%Y - %H:%M:%S", time() );
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

			for($i = 'A'; $i <= 'E'; $i++){
				for($ii = '7'; $ii <= '50'; $ii++){
			    $this->objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($i,$ii)->setAutoSize(TRUE);
				}
			}
			$this->objPHPExcel->setActiveSheetIndex(0)->getStyle('A1:A7')->getFont()->setBold(true); 
			
			// Rename worksheet
			$this->objPHPExcel->getActiveSheet()->setTitle('Viaticos Por Seccion');
			// Redirect output to a client’s web browser (Excel5)
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="Viaticos_por_seccion.xls"');
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
	public function crear_grafico_viaticos_x_genero($tipo,$seccion,$anio){
		$this->load->library('j_pgraph');
		$this->load->model('Reportes_viaticos_model');
		setlocale (LC_ALL, 'et_EE.ISO-8859-1');
		
		$data1y = array(0);
		$data2y = array(0);
		$data3y = array(0);
		$data4y = array(0);
		$labels = array(0);
		$i=0;
		$data  =array(
			'anio' =>$anio
		);
		
		$viatico = $this->Reportes_viaticos_model->viaticos_por_genero($data);
		$total_viatico=0;
		$total_pasaje=0;
		$total_alojamiento=0;
		$total_total=0;
		foreach ($viatico->result() as $viatico_mes_detalle) {	

			//$data1y[$i]=$viatico_mes_detalle->viaticos;
			//$data2y[$i]=$viatico_mes_detalle->pasajes;
			//$data3y[$i]=$viatico_mes_detalle->alojamientos;
			$data4y[$i]=$viatico_mes_detalle->total;
			$labels[$i]=$viatico_mes_detalle->genero;

			$i++;
		}
		
		// Create the graph. These two calls are always required
		$graph = new Graph(850,800);
		
		$graph->SetScale("textlin");
		//$graph->Set90AndMargin(0,0,0,0);
		$graph->SetShadow();

		//$graph->img->SetMargin(40,30,30,70);

		// Create the bar plots
		$b1plot = new BarPlot($data1y);
		$b2plot = new BarPlot($data2y);
		$b3plot = new BarPlot($data3y);
		$b4plot = new BarPlot($data4y);
		

		
		
		// Create the grouped bar plot
		$gbplot = new GroupBarPlot(array($b4plot));

		// ...and add it to the graPH
		$graph->Add($gbplot);

		 
		$b4plot->value->SetFormat('$%01.2f');
		$b4plot->value->SetFont(FF_ARIAL,FS_NORMAL,7);  // FS_BOLD para negrita

		$b1plot->value->Show();
		$b1plot->SetColor("#0000CD");
		$b2plot->SetFillColor('#B0C4DE');
		$b1plot->SetLegend("Viáticos");

		$b2plot->value->Show();
		$b2plot->SetLegend("Pasaje");
		$b3plot->value->Show();
		$b3plot->SetLegend("Alojamiento");
		$b4plot->value->Show();
		$b4plot->SetLegend("Total");

		$graph->title->Set(utf8_decode("Viáticos por Género"));
		//$graph->yaxis->title->Set("Cantidad en dólares");
		$graph->xaxis->title->Set(utf8_decode("Género"));

		$graph->title->SetFont(FF_ARIAL,FS_BOLD);
		$graph->yaxis->title->SetFont(FF_ARIAL,FS_BOLD);
		$graph->xaxis->SetTickLabels($labels);
		$graph->xaxis->title->SetFont(FF_ARIAL,FS_BOLD);
		$graph->yaxis->scale->SetGrace(10);

		
		
		// Display the graph
		$graph->Stroke(_IMG_HANDLER);
		$x = $this->session->userdata('usuario_viatico');
		$fileName = "assets/graficas/grafica_vg_".$x.".png";
		$graph->img->Stream($fileName);

		// mostrarlo en el navegador
		//$graph->img->Headers();
		//$graph->img->Stream();
		
	}
	public function reporte_viaticos_por_genero($tipo,$seccion,$anio){
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
		$this->mpdf = new \Mpdf\Mpdf();
		$this->crear_grafico_viaticos_x_genero($tipo,$seccion,$anio);
		$cabecera = '<table width="100%"><tr>
 		<td>
		 	<img src="application/controllers/informes/logomtps.jpeg"  width="125px" height="85px">   
		</td>
		<td width="580px"><h5><center>MINISTERIO DE TRABAJO Y PREVISIÓN SOCIAL <br> UNIDAD FINANCIERA INSTITUCIONAL <br> FONDO CIRCULANTE DEL MONTO FIJO <br> <span style="font-size: 22px;">REPORTE VIÁTICOS POR GÉNERO</span></center><h5></td>
		<td align="right">
		   	<img src="application/controllers/informes/escudo.jpg" width="150px" height="55px">
		</td>
	 	</tr></table>';

	 	$cabecera_vista = '<table><tr>
 		<td>
		    <img src="'.base_url().'assets/logos_vista/logomtps.jpg"  width="125px" height="85px">
		</td>
		<td width="950px"><h5><center>MINISTERIO DE TRABAJO Y PREVISIÓN SOCIAL <br> UNIDAD FINANCIERA INSTITUCIONAL <br> FONDO CIRCULANTE DEL MONTO FIJO <br> <span style="font-size: 17px;">REPORTE VIÁTICOS POR GÉNERO</span></center><h5></td>
		<td>
		   	<img src="'.base_url().'assets/logos_vista/escudo.jpg" width="150px" height="55px">
		</td>
	 	</tr></table>';
	 	$fecha=strftime( "%d-%m-%Y - %H:%M:%S", time() );
	 	$pie = 'Usuario: '.$this->session->userdata('usuario_viatico').'    Fecha y Hora Creación: '.$fecha.'||{PAGENO} de {nbpg} páginas';


		$this->mpdf->SetHTMLHeader($cabecera);
		//$this->mpdf->SetHTMLFooter('{PAGENO} of {nbpg} pages');
		$this->mpdf->setFooter($pie);
		
		$data  =array(
			'anio' =>$anio
		);
		
		$viatico = $this->Reportes_viaticos_model->viaticos_por_genero($data);
		$total_viatico=0;
		$total_pasaje=0;
		$total_alojamiento=0;
		$total_total=0;
		
		$cuerpo = '
			Año: '.$anio.'
			<table  class="" border="1" style="width:100%">

				<thead >
					<tr>
						<td align="center" rowspan="2">Género</td>
						<td align="center" colspan="3">Tipo</td>
						<td align="center" rowspan="2">total</td>						
					</tr>
					<tr>
						
						<td align="center">Viáticos</td>
						<td align="center">Pasajes</td>
						<td align="center">Alojamiento</td>
						
					</tr>
				</thead>
				<tbody>
					
					';
					
				if($viatico->num_rows()>0){
				foreach ($viatico->result() as $viaticos) {
					$total_viatico+=$viaticos->viatico;
					$total_pasaje+=$viaticos->pasaje;
					$total_alojamiento+=$viaticos->alojamiento;
					$total_total+=$viaticos->total;
					$cuerpo .= '
						<tr>
							<td>'.($viaticos->genero).'</td>
							<td style="text-align:right">$'.number_format($viaticos->viatico,2,".",",").'</td>
							<td style="text-align:right">$'.number_format($viaticos->pasaje,2,".",",").'</td>
							<td style="text-align:right">$'.number_format($viaticos->alojamiento,2,".",",").'</td>
							<td style="text-align:right">$'.number_format($viaticos->total,2,".",",").'</td>
							
						</tr>
						';
						
					}
				}else{
					$cuerpo .= '
						<tr><td colspan="5"><center>No hay registros</center></td></tr>

					';
				}
				$cuerpo .= '
					<tr>
							<td>Total</td>
							<td style="text-align:right">$'.number_format($total_viatico,2,".",",").'</td>
							<td style="text-align:right">$'.number_format($total_pasaje,2,".",",").'</td>
							<td style="text-align:right">$'.number_format($total_alojamiento,2,".",",").'</td>
							<td style="text-align:right">$'.number_format($total_total,2,".",",").'</td>
							
						</tr>
				</tbody>
			</table><br>
			<img  src="'.base_url().'assets/graficas/grafica_vg_'.$this->session->userdata('usuario_viatico').'.png" alt="">
        ';         // LOAD a stylesheet         
	     if($tipo=="pdf"){
	        $stylesheet = file_get_contents(base_url().'assets/plugins/bootstrap/css/bootstrap.min.css');
			$this->mpdf->AddPage('L','','','','',15,15,35,17,7,9);
			$this->mpdf->SetTitle('Viaticos por Genero');
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

			$titulosColumnas = array('GÉNERO','VIÁTICOS','PASAJES','ALOJAMIENTOS','TOTAL');
			$this->objPHPExcel->setActiveSheetIndex(0)
			    ->setCellValue('A7',  $titulosColumnas[0])  //Titulo de las columnas
			    ->setCellValue('B7',  $titulosColumnas[1])
			    ->setCellValue('C7',  $titulosColumnas[2])
			    ->setCellValue('D7',  $titulosColumnas[3])
			    ->setCellValue('E7',  $titulosColumnas[4])
			    ;

			 
			$this->objPHPExcel->setActiveSheetIndex(0)
			            ->setCellValue('A1', "MINISTERIO DE TRABAJO Y PREVISIÓN SOCIAL")
			            ->setCellValue('A2', "UNIDAD FINANCIERA INSTITUCIONAL")
			            ->setCellValue('A3', "FONDO CIRCULANTE DEL MONTO FIJO")
			            ->setCellValue('A4', "REPORTE VIÁTICOS POR GÉNERO")
			            ;
			 $this->objPHPExcel->setActiveSheetIndex(0)->getStyle('A7:E7')->getFont()->setBold(true); 
			 $this->objPHPExcel->setActiveSheetIndex(0)
			    ->setCellValue('A5',  "Año:")
			    ->setCellValue('B5',  $anio);
			
			 //////////////////////////////////////////////////
			$data  =array(
				'anio' =>$anio
			);
			//$this->crear_grafico_viaticos_x_mes($anio,$primer_mes,$segundo_mes,$tercer_mes,$cuarto_mes,$quinto_mes,$sexto_mes);
			$viatico = $this->Reportes_viaticos_model->viaticos_por_genero($data);
			$total_viatico=0;
			$total_pasaje=0;
			$total_alojamiento=0;
			$total_total=0;
				$f=8;	
				if($viatico->num_rows()>0){
					foreach ($viatico->result() as $viaticos) {
						$total_viatico+=$viaticos->viatico;
						$total_pasaje+=$viaticos->pasaje;
						$total_alojamiento+=$viaticos->alojamiento;
						$total_total+=$viaticos->total;
						$this->objPHPExcel->getActiveSheet()->getStyle('B'.$f.':E'.$f)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
						$this->objPHPExcel->getActiveSheet()->getStyle('A'.$f)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
						// Miscellaneous glyphs, UTF-8
						$this->objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A'.$f,$viaticos->genero)
							->setCellValue('B'.$f,number_format($viaticos->viatico,2,".",","))
							->setCellValue('C'.$f, number_format($viaticos->pasaje,2,".",","))
							->setCellValue('D'.$f,number_format($viaticos->alojamiento,2,".",","))
							->setCellValue('E'.$f, number_format($viaticos->total,2,".",","));
							$f++;
					}
				}else{
					$this->objPHPExcel->setActiveSheetIndex(0)
				            ->setCellValue('A'.$f, "NO HAY REGISTROS")
				            ->mergeCells('A'.$f.':E'.$f);
				}
				 
				$this->objPHPExcel->getActiveSheet()->getStyle('B'.$f.':E'.$f)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
					$this->objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A'.$f,"TOTAL")
							->setCellValue('B'.$f,number_format($total_viatico,2,".",","))
							->setCellValue('C'.$f, number_format($total_pasaje,2,".",","))
							->setCellValue('D'.$f,number_format($total_alojamiento,2,".",","))
							->setCellValue('E'.$f, number_format($total_total,2,".",","));
			$this->objPHPExcel->setActiveSheetIndex(0)->getStyle('A'.$f.':E'.$f)->getFont()->setBold(true); 
			 //////////////////////////////////////////////////
			 ///
			$fecha=strftime( "%d-%m-%Y - %H:%M:%S", time() );
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

			for($i = 'A'; $i <= 'E'; $i++){
				for($ii = '7'; $ii <= '50'; $ii++){
			    $this->objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($i,$ii)->setAutoSize(TRUE);
				}
			}
			$this->objPHPExcel->setActiveSheetIndex(0)->getStyle('A1:A7')->getFont()->setBold(true); 
			
			// Rename worksheet
			$this->objPHPExcel->getActiveSheet()->setTitle('Viaticos Por Genero');
			// Redirect output to a client’s web browser (Excel5)
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="Viaticos_por_genero.xls"');
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
	public function reporte_viaticos_por_mes($tipo,$anios,$primer_mes,$segundo_mes,$tercer_mes,$cuarto_mes,$quinto_mes,$sexto_mes){
		$this->load->library('mpdf');
		$this->load->model('Reportes_viaticos_model');
		$this->mpdf = new \Mpdf\Mpdf();
		//$this->crear_grafico_viaticos_x_anio($anios);
		//$this->crear_grafico_viaticos_x_anio_totales($anios);
		$cabecera = '<table width="100%"><tr>
 		<td>
		    <img src="application/controllers/informes/logomtps.jpeg"  width="125px" height="85px">
		</td>
		<td width="550px"><h5><center>MINISTERIO DE TRABAJO Y PREVISIÓN SOCIAL <br> UNIDAD FINANCIERA INSTITUCIONAL <br> FONDO CIRCULANTE DEL MONTO FIJO <br> <span style="font-size: 22px;">REPORTE VIÁTICOS POR MES</span></center><h5></td>
		<td align="right">
		   	<img src="application/controllers/informes/escudo.jpg" width="150px" height="55px">
		</td>
	 	</tr></table>';

	 	$cabecera_vista = '<table><tr>
 		<td>
		    <img src="'.base_url().'assets/logos_vista/logomtps.jpg"  width="125px" height="85px">
		</td>
		<td width="950px"><h5><center>MINISTERIO DE TRABAJO Y PREVISIÓN SOCIAL <br> UNIDAD FINANCIERA INSTITUCIONAL <br> FONDO CIRCULANTE DEL MONTO FIJO <br> <span style="font-size: 17px;">REPORTE VIÁTICOS POR MES</span></center><h5></td>
		<td>
		   	<img src="'.base_url().'assets/logos_vista/escudo.jpg" width="150px" height="55px">
		</td>
	 	</tr></table>';
	 	$fecha=strftime( "%d-%m-%Y - %H:%M:%S", time() );
	 	$pie = 'Usuario: '.$this->session->userdata('usuario_viatico').'    Fecha y Hora Creación: '.$fecha.'||{PAGENO} de {nbpg} páginas';
		
		$this->mpdf->SetHTMLHeader($cabecera);

		//$this->mpdf->SetHTMLFooter('{PAGENO} of {nbpg} pages');
		$this->mpdf->setFooter($pie);
		
		$cuerpo = '
			<table  class="" border="1" style="width:100%">
				<thead >
					<tr>
						<td align="center" rowspan="2" >AÑO</td>
						<td align="center" rowspan="2" >MES</td>
						<td align="center" colspan="3" >TIPO</td>
						<td align="center" rowspan="2" >TOTAL</td>
					</tr>
					<tr>
						<td align="center"  >VIÁTICO</td>
						<td align="center"  >PASAJE</td>
						<td align="center"  >ALOJAMIENTO</td>

					</tr>
				</thead>
				<tbody>
					';
				$total_viatico=0;
					$total_pasaje=0;
					$total_alojamiento=0;
					$total_total=0;
				$data = str_split($anios,4);

				$viatico = $this->Reportes_viaticos_model->viaticos_por_mes($data,$primer_mes,$segundo_mes,$tercer_mes,$cuarto_mes,$quinto_mes,$sexto_mes);
				if($viatico->num_rows()>0){
				foreach ($viatico->result() as $viaticos) {
					$total_viatico+=$viaticos->viatico;
					$total_pasaje+=$viaticos->pasaje;
					$total_alojamiento+=$viaticos->alojamiento;
					$total_total+=$viaticos->total_anio;

					if($viaticos->mes=="1"){
						$mimes="Enero";
					}else if($viaticos->mes=="2"){
						$mimes="Febrero";
					}else if($viaticos->mes=="3"){
						$mimes="Marzo";
					}else if($viaticos->mes=="4"){
						$mimes="Abril";
					}else if($viaticos->mes=="5"){
						$mimes="Mayo";
					}else if($viaticos->mes=="6"){
						$mimes="Junio";
					}else if($viaticos->mes=="7"){
						$mimes="Julio";
					}else if($viaticos->mes=="8"){
						$mimes="Agosto";
					}else if($viaticos->mes=="9"){
						$mimes="Septiembre";
					}else if($viaticos->mes=="10"){
						$mimes="Octubre";
					}else if($viaticos->mes=="11"){
						$mimes="Noviembre";
					}else if($viaticos->mes=="12"){
						$mimes="Diciembre";
					}

					$cuerpo .= '
						<tr>
							<td align="center" style="width:180px">'.($viaticos->anio).'</td>
							<td align="center" style="width:180px">'.($mimes).'</td>
							<td align="center" style="width:180px">$'.number_format($viaticos->viatico,2,".",",").'</td>
							<td align="center" style="width:180px">$'.number_format($viaticos->pasaje,2,".",",").'</td>
							<td align="center" style="width:180px">$'.number_format($viaticos->alojamiento,2,".",",").'</td>
							<td align="center" style="width:180px">$'.number_format($viaticos->total_anio,2,".",",").'</td>
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
							<td align="center" style="width:180px" colspan="2">Total</td>
							<td align="center" style="width:180px">$'.number_format($total_viatico,2,".",",").'</td>
							<td align="center" style="width:180px">$'.number_format($total_pasaje,2,".",",").'</td>
							<td align="center" style="width:180px">$'.number_format($total_alojamiento,2,".",",").'</td>
							<td align="center" style="width:180px">$'.number_format($total_total,2,".",",").'</td>
						</tr>
				</tbody>
			</table><br>

        '; 
        if($tipo=="pdf"){
			$stylesheet = file_get_contents(base_url().'assets/plugins/bootstrap/css/bootstrap.min.css');
			$this->mpdf->AddPage('P','','','','',15,15,35,17,7,9);
			$this->mpdf->SetTitle('Viaticos por Mes');
			$this->mpdf->WriteHTML($stylesheet,1);  // The parameter 1 tells that this iscss/style only and no body/html/
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
										 ->setTitle("REPORTE VIATICOS POR MES")
										 ->setSubject("REPORTE VIATICOS POR MES")
										 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
										 ->setKeywords("office 2007 openxml php");

			$titulosColumnas = array('AÑO','MES','VIATICOS','PASAJES','ALOJAMIENTOS','TOTAL');
			$this->objPHPExcel->setActiveSheetIndex(0)
			    ->setCellValue('A7',  $titulosColumnas[0])  //Titulo de las columnas
			    ->setCellValue('B7',  $titulosColumnas[1])
			    ->setCellValue('C7',  $titulosColumnas[2])
			    ->setCellValue('D7',  $titulosColumnas[3])
			    ->setCellValue('E7',  $titulosColumnas[4])
				->setCellValue('F7',  $titulosColumnas[5])
			    ;

			 
			$this->objPHPExcel->setActiveSheetIndex(0)
			            ->setCellValue('A1', "MINISTERIO DE TRABAJO Y PREVISIÓN SOCIAL")
			            ->setCellValue('A2', "UNIDAD FINANCIERA INSTITUCIONAL")
			            ->setCellValue('A3', "FONDO CIRCULANTE DEL MONTO FIJO")
			            ->setCellValue('A4', "REPORTE VIÁTICOS POR MES")
			            ;
			 $this->objPHPExcel->setActiveSheetIndex(0)->getStyle('A7:F7')->getFont()->setBold(true); 
			 
			
			 //////////////////////////////////////////////////
				$total_viatico=0;
				$total_pasaje=0;
				$total_alojamiento=0;
				$total_total=0;
				$data = str_split($anios,4);
				$f=8;
				$viatico = $this->Reportes_viaticos_model->viaticos_por_mes($data,$primer_mes,$segundo_mes,$tercer_mes,$cuarto_mes,$quinto_mes,$sexto_mes);
				if($viatico->num_rows()>0){
				foreach ($viatico->result() as $viaticos) {
					$total_viatico+=$viaticos->viatico;
					$total_pasaje+=$viaticos->pasaje;
					$total_alojamiento+=$viaticos->alojamiento;
					$total_total+=$viaticos->total_anio;

					if($viaticos->mes=="1"){
						$mimes="Enero";
					}else if($viaticos->mes=="2"){
						$mimes="Febrero";
					}else if($viaticos->mes=="3"){
						$mimes="Marzo";
					}else if($viaticos->mes=="4"){
						$mimes="Abril";
					}else if($viaticos->mes=="5"){
						$mimes="Mayo";
					}else if($viaticos->mes=="6"){
						$mimes="Junio";
					}else if($viaticos->mes=="7"){
						$mimes="Julio";
					}else if($viaticos->mes=="8"){
						$mimes="Agosto";
					}else if($viaticos->mes=="9"){
						$mimes="Septiembre";
					}else if($viaticos->mes=="10"){
						$mimes="Octubre";
					}else if($viaticos->mes=="11"){
						$mimes="Noviembre";
					}else if($viaticos->mes=="12"){
						$mimes="Diciembre";
					}
						$this->objPHPExcel->getActiveSheet()->getStyle('B'.$f.':F'.$f)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
						$this->objPHPExcel->getActiveSheet()->getStyle('A'.$f)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
						// Miscellaneous glyphs, UTF-8
						$this->objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A'.$f,$viaticos->anio)
							->setCellValue('B'.$f,$mimes)
							->setCellValue('C'.$f,number_format($viaticos->viatico,2,".",","))
							->setCellValue('D'.$f, number_format($viaticos->pasaje,2,".",","))
							->setCellValue('E'.$f,number_format($viaticos->alojamiento,2,".",","))
							->setCellValue('F'.$f, number_format($viaticos->total_anio,2,".",","));
							$f++;
					}
				}else{
					$this->objPHPExcel->setActiveSheetIndex(0)
				            ->setCellValue('A'.$f, "NO HAY REGISTROS")
				            ->mergeCells('A'.$f.':F'.$f);
				}
				 
				$this->objPHPExcel->getActiveSheet()->getStyle('B'.$f.':F'.$f)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
					$this->objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A'.$f,"TOTAL")
							->mergeCells('A'.$f.':B'.$f)
							->setCellValue('C'.$f,number_format($total_viatico,2,".",","))
							->setCellValue('D'.$f, number_format($total_pasaje,2,".",","))
							->setCellValue('E'.$f,number_format($total_alojamiento,2,".",","))
							->setCellValue('F'.$f, number_format($total_total,2,".",","));
			$this->objPHPExcel->setActiveSheetIndex(0)->getStyle('A'.$f.':F'.$f)->getFont()->setBold(true); 
			 //////////////////////////////////////////////////
			 ///
			$fecha=strftime( "%d-%m-%Y - %H:%M:%S", time() );
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
			$this->objPHPExcel->setActiveSheetIndex(0)->getStyle('A1:A7')->getFont()->setBold(true); 
			
			// Rename worksheet
			$this->objPHPExcel->getActiveSheet()->setTitle('Viaticos Por Mes');
			// Redirect output to a client’s web browser (Excel5)
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="Viaticos_por_mes.xls"');
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
	public function reporte_viaticos_por_actividad($tipo,$anios,$primer_mes,$segundo_mes,$tercer_mes,$cuarto_mes,$quinto_mes,$sexto_mes,$id_vyp_actividades){
		$this->load->library('mpdf');
		$this->load->model('Reportes_viaticos_model');
		$this->mpdf = new \Mpdf\Mpdf();
		//$this->crear_grafico_viaticos_x_anio($anios);
		//$this->crear_grafico_viaticos_x_anio_totales($anios);
		$cabecera = '<table width="100%"><tr>
 		<td>
		    <img src="application/controllers/informes/logomtps.jpeg"  width="125px" height="85px">
		</td>
		<td width="550px"><h5><center>MINISTERIO DE TRABAJO Y PREVISIÓN SOCIAL <br> UNIDAD FINANCIERA INSTITUCIONAL <br> FONDO CIRCULANTE DEL MONTO FIJO <br> <span style="font-size: 22px;">REPORTE VIÁTICOS POR ACTIVIDAD</span></center><h5></td>
		<td align="right">
		   	<img src="application/controllers/informes/escudo.jpg" width="150px" height="55px">
		</td>
	 	</tr></table>';

	 	$cabecera_vista = '<table><tr>
 		<td>
		    <img src="'.base_url().'assets/logos_vista/logomtps.jpg"  width="125px" height="85px">
		</td>
		<td width="950px"><h5><center>MINISTERIO DE TRABAJO Y PREVISIÓN SOCIAL <br> UNIDAD FINANCIERA INSTITUCIONAL <br> FONDO CIRCULANTE DEL MONTO FIJO <br> <span style="font-size: 17px;">REPORTE VIÁTICOS POR ACTIVIDAD</span></center><h5></td>
		<td>
		   	<img src="'.base_url().'assets/logos_vista/escudo.jpg" width="150px" height="55px">
		</td>
	 	</tr></table>';
	 	$fecha=strftime( "%d-%m-%Y - %H:%M:%S", time() );
	 	$pie = 'Usuario: '.$this->session->userdata('usuario_viatico').'    Fecha y Hora Creación: '.$fecha.'||{PAGENO} de {nbpg} páginas';
		
		$this->mpdf->SetHTMLHeader($cabecera);

		//$this->mpdf->SetHTMLFooter('{PAGENO} of {nbpg} pages');
		$this->mpdf->setFooter($pie);
		
		$cuerpo = '
			<table  class="" border="1" style="width:100%">
				<thead >
					<tr>
						<td align="center" rowspan="2"  >ACTIVIDAD</td>
						<td align="center" rowspan="2" >AÑO</td>
						<td align="center" rowspan="2" >MES</td>
						<td align="center" colspan="3" >TIPO</td>
						<td align="center" rowspan="2" >TOTAL</td>
					</tr>
					<tr>
						<td align="center"  >VIÁTICO</td>
						<td align="center"  >PASAJE</td>
						<td align="center"  >ALOJAMIENTO</td>

					</tr>
				</thead>
				<tbody>
					';
				$total_viatico=0;
					$total_pasaje=0;
					$total_alojamiento=0;
					$total_total=0;
				$data = str_split($anios,4);

				$viatico = $this->Reportes_viaticos_model->viaticos_por_actividad($data,$primer_mes,$segundo_mes,$tercer_mes,$cuarto_mes,$quinto_mes,$sexto_mes,$id_vyp_actividades);
				if($viatico->num_rows()>0){
				foreach ($viatico->result() as $viaticos) {
					$total_viatico+=$viaticos->viatico;
					$total_pasaje+=$viaticos->pasaje;
					$total_alojamiento+=$viaticos->alojamiento;
					$total_total+=$viaticos->total;

					if($viaticos->mes=="1"){
						$mimes="Enero";
					}else if($viaticos->mes=="2"){
						$mimes="Febrero";
					}else if($viaticos->mes=="3"){
						$mimes="Marzo";
					}else if($viaticos->mes=="4"){
						$mimes="Abril";
					}else if($viaticos->mes=="5"){
						$mimes="Mayo";
					}else if($viaticos->mes=="6"){
						$mimes="Junio";
					}else if($viaticos->mes=="7"){
						$mimes="Julio";
					}else if($viaticos->mes=="8"){
						$mimes="Agosto";
					}else if($viaticos->mes=="9"){
						$mimes="Septiembre";
					}else if($viaticos->mes=="10"){
						$mimes="Octubre";
					}else if($viaticos->mes=="11"){
						$mimes="Noviembre";
					}else if($viaticos->mes=="12"){
						$mimes="Diciembre";
					}

					$cuerpo .= '
						<tr>
							<td align="left" style="width:380px">'.($viaticos->actividad).'</td>
							<td align="center" style="width:80px">'.($viaticos->anio).'</td>
							<td align="center" style="width:80px">'.($mimes).'</td>
							<td align="center" style="width:80px">$'.number_format($viaticos->viatico,2,".",",").'</td>
							<td align="center" style="width:80px">$'.number_format($viaticos->pasaje,2,".",",").'</td>
							<td align="center" style="width:80px">$'.number_format($viaticos->alojamiento,2,".",",").'</td>
							<td align="center" style="width:80px">$'.number_format($viaticos->total,2,".",",").'</td>
						</tr>
						';
					}
				}else{
				$cuerpo .= '
						<tr><td colspan="7"><center>No hay registros</center></td></tr>
					';
				}
				$cuerpo .= '
						<tr>
							<td align="center" style="width:180px" colspan="3">Total</td>
							<td align="center" style="width:180px">$'.number_format($total_viatico,2,".",",").'</td>
							<td align="center" style="width:180px">$'.number_format($total_pasaje,2,".",",").'</td>
							<td align="center" style="width:180px">$'.number_format($total_alojamiento,2,".",",").'</td>
							<td align="center" style="width:180px">$'.number_format($total_total,2,".",",").'</td>
						</tr>
				</tbody>
			</table><br>

        '; 
        if($tipo=="pdf"){
			$stylesheet = file_get_contents(base_url().'assets/plugins/bootstrap/css/bootstrap.min.css');
			$this->mpdf->AddPage('L','','','','',15,15,35,17,7,9);
			$this->mpdf->SetTitle('Viaticos por Mes');
			$this->mpdf->WriteHTML($stylesheet,1);  // The parameter 1 tells that this iscss/style only and no body/html/
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
										 ->setTitle("REPORTE VIATICOS POR ACTIVIDAD")
										 ->setSubject("REPORTE VIATICOS POR ACTIVIDAD")
										 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
										 ->setKeywords("office 2007 openxml php");

			$titulosColumnas = array('ACTIVIDAD','AÑO','MES','VIÁTICOS','PASAJES','ALOJAMIENTOS','TOTAL');
			$this->objPHPExcel->setActiveSheetIndex(0)
			    ->setCellValue('A7',  $titulosColumnas[0])  //Titulo de las columnas
			    ->setCellValue('B7',  $titulosColumnas[1])
			    ->setCellValue('C7',  $titulosColumnas[2])
			    ->setCellValue('D7',  $titulosColumnas[3])
			    ->setCellValue('E7',  $titulosColumnas[4])
				->setCellValue('F7',  $titulosColumnas[5])
				->setCellValue('G7',  $titulosColumnas[6])
			    ;

			 
			$this->objPHPExcel->setActiveSheetIndex(0)
			            ->setCellValue('A1', "MINISTERIO DE TRABAJO Y PREVISIÓN SOCIAL")
			            ->setCellValue('A2', "UNIDAD FINANCIERA INSTITUCIONAL")
			            ->setCellValue('A3', "FONDO CIRCULANTE DEL MONTO FIJO")
			            ->setCellValue('A4', "REPORTE VIÁTICOS POR ACTIVIDAD")
			            ;
			 $this->objPHPExcel->setActiveSheetIndex(0)->getStyle('A7:G7')->getFont()->setBold(true); 
			 
			
			 //////////////////////////////////////////////////
				$total_viatico=0;
					$total_pasaje=0;
					$total_alojamiento=0;
					$total_total=0;
				$data = str_split($anios,4);
				$f=8;
				$viatico = $this->Reportes_viaticos_model->viaticos_por_actividad($data,$primer_mes,$segundo_mes,$tercer_mes,$cuarto_mes,$quinto_mes,$sexto_mes,$id_vyp_actividades);
				if($viatico->num_rows()>0){
				foreach ($viatico->result() as $viaticos) {
					$total_viatico+=$viaticos->viatico;
					$total_pasaje+=$viaticos->pasaje;
					$total_alojamiento+=$viaticos->alojamiento;
					$total_total+=$viaticos->total;

					if($viaticos->mes=="1"){
						$mimes="Enero";
					}else if($viaticos->mes=="2"){
						$mimes="Febrero";
					}else if($viaticos->mes=="3"){
						$mimes="Marzo";
					}else if($viaticos->mes=="4"){
						$mimes="Abril";
					}else if($viaticos->mes=="5"){
						$mimes="Mayo";
					}else if($viaticos->mes=="6"){
						$mimes="Junio";
					}else if($viaticos->mes=="7"){
						$mimes="Julio";
					}else if($viaticos->mes=="8"){
						$mimes="Agosto";
					}else if($viaticos->mes=="9"){
						$mimes="Septiembre";
					}else if($viaticos->mes=="10"){
						$mimes="Octubre";
					}else if($viaticos->mes=="11"){
						$mimes="Noviembre";
					}else if($viaticos->mes=="12"){
						$mimes="Diciembre";
					}
						$this->objPHPExcel->getActiveSheet()->getStyle('D'.$f.':G'.$f)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
						$this->objPHPExcel->getActiveSheet()->getStyle('A'.$f)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
						// Miscellaneous glyphs, UTF-8
						$this->objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A'.$f,$viaticos->actividad)
							->setCellValue('B'.$f,$viaticos->anio)
							->setCellValue('C'.$f,$mimes)
							->setCellValue('D'.$f,number_format($viaticos->viatico,2,".",","))
							->setCellValue('E'.$f, number_format($viaticos->pasaje,2,".",","))
							->setCellValue('F'.$f,number_format($viaticos->alojamiento,2,".",","))
							->setCellValue('G'.$f, number_format($viaticos->total,2,".",","));
							$f++;
					}
				}else{
					$this->objPHPExcel->setActiveSheetIndex(0)
				            ->setCellValue('A'.$f, "NO HAY REGISTROS")
				            ->mergeCells('A'.$f.':G'.$f);
				}
				 
				$this->objPHPExcel->getActiveSheet()->getStyle('B'.$f.':G'.$f)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
					$this->objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A'.$f,"TOTAL")
							->mergeCells('A'.$f.':C'.$f)
							->setCellValue('D'.$f,number_format($total_viatico,2,".",","))
							->setCellValue('E'.$f, number_format($total_pasaje,2,".",","))
							->setCellValue('F'.$f,number_format($total_alojamiento,2,".",","))
							->setCellValue('G'.$f, number_format($total_total,2,".",","));
			$this->objPHPExcel->setActiveSheetIndex(0)->getStyle('A'.$f.':G'.$f)->getFont()->setBold(true); 
			 //////////////////////////////////////////////////
			 ///
			$fecha=strftime( "%d-%m-%Y - %H:%M:%S", time() );
			$this->objPHPExcel->setActiveSheetIndex(0)
				->setCellValue("A".$f+=4,"Fecha y Hora de Creación: ".$fecha)
				//->setCellValue("B".$f,$fecha)
				->setCellValue("A".$f+=1,"Usuario: ".$this->session->userdata('usuario_viatico'));
				//->setCellValue("B".$f,$this->session->userdata('usuario_viatico'))

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
			$this->objPHPExcel->setActiveSheetIndex(0)->getStyle('A1:A7')->getFont()->setBold(true); 
			
			// Rename worksheet
			$this->objPHPExcel->getActiveSheet()->setTitle('Viaticos Por Actividad');
			// Redirect output to a client’s web browser (Excel5)
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="Viaticos_por_actividad.xls"');
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
	public function reporte_misiones($tipo,$nr){
		$this->load->library('mpdf');
		$this->load->model('Reportes_viaticos_model');
		$this->mpdf = new \Mpdf\Mpdf();
		//$this->crear_grafico_viaticos_x_anio($anios);
		//$this->crear_grafico_viaticos_x_anio_totales($anios);
		$cabecera = '<table width="100%"><tr>
 		<td>
		    <img src="application/controllers/informes/logomtps.jpeg"  width="125px" height="85px">
		</td>
		<td width="950px"><h5><center>MINISTERIO DE TRABAJO Y PREVISIÓN SOCIAL <br> UNIDAD FINANCIERA INSTITUCIONAL <br> FONDO CIRCULANTE DEL MONTO FIJO <br> <span style="font-size: 22px;">REPORTE POR MISIONES</span></center><h5></td>
		<td align="right">
		   	<img src="application/controllers/informes/escudo.jpg" width="150px" height="55px">
		</td>
	 	</tr></table>';

	 	$cabecera_vista = '<table><tr>
 		<td>
		    <img src="'.base_url().'assets/logos_vista/logomtps.jpg"  width="125px" height="85px">
		</td>
		<td width="950px"><h5><center>MINISTERIO DE TRABAJO Y PREVISIÓN SOCIAL <br> UNIDAD FINANCIERA INSTITUCIONAL <br> FONDO CIRCULANTE DEL MONTO FIJO <br> <span style="font-size: 17px;">REPORTE POR MISIONES</span></center><h5></td>
		<td>
		   	<img src="'.base_url().'assets/logos_vista/escudo.jpg" width="150px" height="55px">
		</td>
	 	</tr></table>';
	 	$fecha=strftime( "%d-%m-%Y - %H:%M:%S", time() );
	 	$pie = 'Usuario: '.$this->session->userdata('usuario_viatico').'    Fecha y Hora Creación: '.$fecha.'||{PAGENO} de {nbpg} páginas';
		
		$this->mpdf->SetHTMLHeader($cabecera);

		//$this->mpdf->SetHTMLFooter('{PAGENO} of {nbpg} pages');
		$this->mpdf->setFooter($pie);
		
		$cuerpo = '
			<table  class="" border="1" style="width:100%">
				<thead >
					<tr>
						<td align="center" rowspan="2" >ID MISIÓN</td>
						<td align="center" rowspan="2" >NR</td>
						<td align="center" rowspan="2" >NOMBRE</td>
						<td align="center" rowspan="2" >SECCIÓN</td>
						<td align="center" rowspan="2" >CARGO</td>
						<td align="center" rowspan="2" >FECHA INICIO</td>
						<td align="center" rowspan="2" >FECHA FIN</td>
						<td align="center" rowspan="2" >FECHA SOLICITUD</td>
						<td align="center" rowspan="2" >ACTIVIDAD</td>
						<td align="center" colspan="3" >TIPO</td>
						<td align="center" rowspan="2" >TOTAL</td>
						<td align="center" rowspan="2" >ESTADO</td>
						<td align="center" rowspan="2" >FECHA PAGO</td>
					</tr>
					<tr>
						<td align="center"  >VIÁTICO</td>
						<td align="center"  >PASAJE</td>
						<td align="center"  >ALOJAMIENTO</td>

					</tr>
				</thead>
				<tbody>
					';
				$total_viatico=0;
					$total_pasaje=0;
					$total_alojamiento=0;
					$total_total=0;
				$data  = array('nr' => $nr );

				$viatico = $this->Reportes_viaticos_model->misiones_empleados($data);
				if($viatico->num_rows()>0){
				foreach ($viatico->result() as $viaticos) {
					$total_viatico+=$viaticos->viaticos;
					$total_pasaje+=$viaticos->pasajes;
					$total_alojamiento+=$viaticos->alojamientos;
					$total_total+=$viaticos->total;

					 
					$cuerpo .= '
						<tr>
							<td>'.($viaticos->id_mision_oficial).'</td>
							<td>'.($viaticos->nr_empleado).'</td>
							<td style="width:180px">'.($viaticos->nombre_completo).'</td>
							<td>'.($viaticos->seccion).'</td>
							<td>'.($viaticos->cargo).'</td>
							<td>'.($viaticos->fecha_mision_inicio).'</td>
							<td>'.($viaticos->fecha_mision_fin).'</td>
							<td>'.($viaticos->fecha_solicitud).'</td>
							<td>'.($viaticos->nombre_actividad).'</td>
							<td align="center" >$'.number_format($viaticos->viaticos,2,".",",").'</td>
							<td align="center" >$'.number_format($viaticos->pasajes,2,".",",").'</td>
							<td align="center"  >$'.number_format($viaticos->alojamientos,2,".",",").'</td>
							<td align="center" >$'.number_format($viaticos->total,2,".",",").'</td>
							<td>'.($viaticos->nombre_estado).'</td>
							<td>'.($viaticos->fecha_pago).'</td>
						</tr>
						';
					}
				}else{
				$cuerpo .= '
						<tr><td colspan="7"><center>No hay registros</center></td></tr>
					';
				}
				$cuerpo .= '
						<tr>
							<td align="center"  colspan="9">Total</td>
							<td align="center">$'.number_format($total_viatico,2,".",",").'</td>
							<td align="center">$'.number_format($total_pasaje,2,".",",").'</td>
							<td align="center" >$'.number_format($total_alojamiento,2,".",",").'</td>
							<td align="center">$'.number_format($total_total,2,".",",").'</td>
							<td align="center"  colspan="2"></td>
						</tr>
				</tbody>
			</table><br>

        '; 
        if($tipo=="pdf"){
        	$this->mpdf->AddPage('L','','','','',15,15,35,17,7,9);
			$stylesheet = file_get_contents(base_url().'assets/plugins/bootstrap/css/bootstrap.min.css');
			$this->mpdf->SetTitle('Misiones');
			$this->mpdf->WriteHTML($stylesheet,1);  // The parameter 1 tells that this iscss/style only and no body/html/
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
										 ->setTitle("REPORTE MISIONES")	
										 ->setSubject("REPORTE MISIONES")
										 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
										 ->setKeywords("office 2007 openxml php");

			$titulosColumnas = array('ID MISIÓN','NR','NOMBRE','SECCIÓN','CARGO','FECHA INICIO','FECHA FIN','FECHA SOLICITUD','ACIVIDAD','VIÁTICOS','PASAJES','ALOJAMIENTOS','TOTAL','ESTADO','FECHA PAGO');
			$this->objPHPExcel->setActiveSheetIndex(0)
			    ->setCellValue('A7',  $titulosColumnas[0])  //Titulo de las columnas
			    ->setCellValue('B7',  $titulosColumnas[1])
			    ->setCellValue('C7',  $titulosColumnas[2])
			    ->setCellValue('D7',  $titulosColumnas[3])
			    ->setCellValue('E7',  $titulosColumnas[4])
			    ->setCellValue('F7',  $titulosColumnas[5])
			    ->setCellValue('G7',  $titulosColumnas[6])
				->setCellValue('H7',  $titulosColumnas[7])
				->setCellValue('I7',  $titulosColumnas[8])
				->setCellValue('J7',  $titulosColumnas[9])
				->setCellValue('K7',  $titulosColumnas[10])
				->setCellValue('L7',  $titulosColumnas[11])
				->setCellValue('M7',  $titulosColumnas[12])
				->setCellValue('N7',  $titulosColumnas[13])
				->setCellValue('O7',  $titulosColumnas[14])
			    ;

			 
			$this->objPHPExcel->setActiveSheetIndex(0)
			            ->setCellValue('A1', "MINISTERIO DE TRABAJO Y PREVISIÓN SOCIAL")
			            ->setCellValue('A2', "UNIDAD FINANCIERA INSTITUCIONAL")
			            ->setCellValue('A3', "FONDO CIRCULANTE DEL MONTO FIJO")
			            ->setCellValue('A4', "REPORTE MISIONES")
			            ;
			 $this->objPHPExcel->setActiveSheetIndex(0)->getStyle('A7:O7')->getFont()->setBold(true); 
			 
			
			 //////////////////////////////////////////////////
				$total_viatico=0;
					$total_pasaje=0;
					$total_alojamiento=0;
					$total_total=0;
	 
				$f=8;
				$data  = array('nr' => $nr );

				$viatico = $this->Reportes_viaticos_model->misiones_empleados($data);
				if($viatico->num_rows()>0){
				foreach ($viatico->result() as $viaticos) {
					$total_viatico+=$viaticos->viaticos;
					$total_pasaje+=$viaticos->pasajes;
					$total_alojamiento+=$viaticos->alojamientos;
					$total_total+=$viaticos->total;

					
						$this->objPHPExcel->getActiveSheet()->getStyle('J'.$f.':M'.$f)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
						$this->objPHPExcel->getActiveSheet()->getStyle('A'.$f)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
						// Miscellaneous glyphs, UTF-8
						
						$this->objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A'.$f,$viaticos->id_mision_oficial)
							->setCellValue('B'.$f,$viaticos->nr_empleado)
							->setCellValue('C'.$f,$viaticos->nombre_completo)
							->setCellValue('D'.$f,$viaticos->seccion)
							->setCellValue('E'.$f,$viaticos->cargo)
							->setCellValue('F'.$f,$viaticos->fecha_mision_inicio)
							->setCellValue('G'.$f,$viaticos->fecha_mision_fin)
							->setCellValue('H'.$f,$viaticos->fecha_solicitud)
							->setCellValue('I'.$f,$viaticos->nombre_actividad)
							->setCellValue('J'.$f,number_format($viaticos->viaticos,2,".",","))
							->setCellValue('K'.$f, number_format($viaticos->pasajes,2,".",","))
							->setCellValue('L'.$f,number_format($viaticos->alojamientos,2,".",","))
							->setCellValue('M'.$f, number_format($viaticos->total,2,".",","))
							->setCellValue('N'.$f,$viaticos->nombre_estado)
							->setCellValue('O'.$f,$viaticos->fecha_pago);
							$f++;
					}
				}else{
					$this->objPHPExcel->setActiveSheetIndex(0)
				            ->setCellValue('A'.$f, "NO HAY REGISTROS")
				            ->mergeCells('A'.$f.':O'.$f);
				}
				 
				$this->objPHPExcel->getActiveSheet()->getStyle('B'.$f.':O'.$f)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
					$this->objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A'.$f,"TOTAL")
							->mergeCells('A'.$f.':I'.$f)
							->setCellValue('J'.$f,number_format($total_viatico,2,".",","))
							->setCellValue('K'.$f, number_format($total_pasaje,2,".",","))
							->setCellValue('L'.$f,number_format($total_alojamiento,2,".",","))
							->setCellValue('M'.$f, number_format($total_total,2,".",","));
			$this->objPHPExcel->setActiveSheetIndex(0)->getStyle('A'.$f.':O'.$f)->getFont()->setBold(true); 
			 //////////////////////////////////////////////////
			 ///
			$fecha=strftime( "%d-%m-%Y - %H:%M:%S", time() );
			$this->objPHPExcel->setActiveSheetIndex(0)
				->setCellValue("A".$f+=4,"Fecha y Hora de Creación: ".$fecha)
				//->setCellValue("B".$f,$fecha)
				->setCellValue("A".$f+=1,"Usuario: ".$this->session->userdata('usuario_viatico'));
				//->setCellValue("B".$f,$this->session->userdata('usuario_viatico'))

			$this->objPHPExcel->setActiveSheetIndex(0)
    			->mergeCells('A1:C1')
    			->mergeCells('A2:C2')
    			->mergeCells('A3:C3')
    			->mergeCells('A4:C4');

			for($i = 'B'; $i <= 'O'; $i++){
				for($ii = '7'; $ii <= '50'; $ii++){
			    $this->objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($i,$ii)->setAutoSize(TRUE);
				}
			}
			$this->objPHPExcel->setActiveSheetIndex(0)->getStyle('A1:A7')->getFont()->setBold(true); 
			
			// Rename worksheet
			$this->objPHPExcel->getActiveSheet()->setTitle('Misiones');
			// Redirect output to a client’s web browser (Excel5)
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="Misiones.xls"');
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
	public function poliza_anual(){
		$this->load->view('templates/header');
		$this->load->view('informes/poliza_anual');
		$this->load->view('templates/footer');
	}
	public function reporte_poliza_anual($tipo,$anio){
		$this->load->library('mpdf');
		$this->load->model('Reportes_viaticos_model');
		$this->mpdf = new \Mpdf\Mpdf();
		//$this->crear_grafico_viaticos_x_anio($anios);
		//$this->crear_grafico_viaticos_x_anio_totales($anios);
		$cabecera = '<table width="100%"><tr>
 		<td>
		    <img src="application/controllers/informes/logomtps.jpeg"  width="125px" height="85px">
		</td>
		<td width="950px"><h5><center>MINISTERIO DE TRABAJO Y PREVISIÓN SOCIAL <br> UNIDAD FINANCIERA INSTITUCIONAL <br> FONDO CIRCULANTE DEL MONTO FIJO <br> <span style="font-size: 22px;">PÓLIZA DE VIÁTICOS Y PASAJES AL INTERIOR CANCELADOS DURANTE EL AÑO '.$anio.'</span></center><h5></td>
		<td align="right">
		   	<img src="application/controllers/informes/escudo.jpg" width="150px" height="55px">
		</td>
	 	</tr></table>';

	 	$cabecera_vista = '<table><tr>
 		<td>
		    <img src="'.base_url().'assets/logos_vista/logomtps.jpg"  width="125px" height="85px">
		</td>
		<td width="950px"><h5><center>MINISTERIO DE TRABAJO Y PREVISIÓN SOCIAL <br> UNIDAD FINANCIERA INSTITUCIONAL <br> FONDO CIRCULANTE DEL MONTO FIJO <br> <span style="font-size: 17px;">PÓLIZA DE VIÁTICOS Y PASAJES AL INTERIOR CANCELADOS DURANTE EL AÑO '.$anio.'</span></center><h5></td>
		<td>
			<img src="'.base_url().'assets/logos_vista/escudo.jpg" width="150px" height="55px">		   
		</td>
	 	</tr></table>';
	 	$fecha=strftime( "%d-%m-%Y - %H:%M:%S", time() );
	 	$pie = 'Usuario: '.$this->session->userdata('usuario_viatico').'    Fecha y Hora Creación: '.$fecha.'||{PAGENO} de {nbpg} páginas';
		
		$this->mpdf->SetHTMLHeader($cabecera);

		//$this->mpdf->SetHTMLFooter('{PAGENO} of {nbpg} pages');
		$this->mpdf->setFooter($pie);
		
		$cuerpo = '
		Año: '.$anio.'
			<table  class="" border="1" style="width:100%">
				<thead >
					<tr>
						
						<td align="center">N°</td>
						<td align="center">MES</td>
						<td align="center">PÓLIZA</td>
						<td align="center">CONCEPTO</td>
						<td align="center">PASAJE</td>
						<td align="center">VIÁTICO</td>
						<td align="center">TOTAL</td>
						<td align="center">FECHA ELABORACIÓN DE LA PÓLIZA</td>
						<td align="center">N° COMPROMISO PRESUPUESTARIO</td>
						<td align="center">FECHA CANCELADO</td>
					</tr>
				</thead>
				<tbody>
					';
					$total_viatico=0;
					$total_pasaje=0;
					$total_total=0;$mes_anterior="";
				$data  = array('anio' => $anio );
				$correlativo=1;
				$viatico = $this->Reportes_viaticos_model->poliza_anual($data);
				if($viatico->num_rows()>0){
				foreach ($viatico->result() as $viaticos) {
					

					
					if($viaticos->no_poliza){
						$total_viatico+=$viaticos->viatico;
						$total_pasaje+=$viaticos->pasaje;
						$total_total+=$viaticos->total;
						$fecha_elaboracion = date_create($viaticos->fecha_elaboracion_poliza);
						$fecha_cancelado = date_create($viaticos->fecha_cancelado);
					$cuerpo .= '
						<tr>
							
							<td align="center">'.($correlativo).'</td>
							<td align="center">'.($viaticos->mes_poliza).'</td>
							<td align="center">'.($viaticos->no_poliza).'</td>
							<td align="center">VIÁTICOS Y PASAJES AL INTERIOR</td>
							<td align="center">$'.number_format($viaticos->pasaje,2,".",",").'</td>
							<td align="center">$'.number_format($viaticos->viatico,2,".",",").'</td>
							<td align="center">$'.number_format($viaticos->total,2,".",",").'</td>
							<td align="center">'.date_format($fecha_elaboracion, 'd/m/Y').'</td>
							<td align="center">'.$viaticos->compromiso_presupuestario.'</td>
							<td align="center">'.date_format($fecha_cancelado, 'd/m/Y').'</td>
						</tr>
						';$correlativo++;
						}else if($viaticos->no_poliza=="0"){
							$total_viatico+=$viaticos->viatico;
						$total_pasaje+=$viaticos->pasaje;
						$total_total+=$viaticos->total;
						$fecha_elaboracion = date_create($viaticos->fecha_elaboracion_poliza);
						$fecha_cancelado = date_create($viaticos->fecha_cancelado);
							$cuerpo .= '
							<tr>
								
								<td align="center">'.($correlativo).'</td>
								<td align="center">'.($viaticos->mes_poliza).'</td>
								<td align="center">'."DETALLE 1".'</td>
								<td align="center">VIÁTICOS Y PASAJES AL INTERIOR</td>
								<td align="center">$'.number_format($viaticos->pasaje,2,".",",").'</td>
								<td align="center">$'.number_format($viaticos->viatico,2,".",",").'</td>
								<td align="center">$'.number_format($viaticos->total,2,".",",").'</td>
								<td align="center">'.date_format($fecha_elaboracion, 'd/m/Y').'</td>
								<td align="center">'.$viaticos->compromiso_presupuestario.'</td>
								<td align="center">'.date_format($fecha_cancelado, 'd/m/Y').'</td>
							</tr>
							';	$correlativo++;
						}else{
							$cuerpo .= '
							<tr>
							
								<td align="center"></td>
								<td align="center">'.($viaticos->mes_poliza).'</td>
								<td align="center"></td>
								<td align="center">TOTAL</td>
								<td align="center">$'.number_format($viaticos->pasaje,2,".",",").'</td>
								<td align="center">$'.number_format($viaticos->viatico,2,".",",").'</td>
								<td align="center">$'.number_format($viaticos->total,2,".",",").'</td>
								<td align="center"></td>
								<td align="center"></td>
								<td align="center"></td>
							</tr>
							';
						} 
						
						
					}
				}else{
				$cuerpo .= '
						<tr><td colspan="10"><center>No hay registros</center></td></tr>
					';
				}
				$cuerpo .= '
						 <tr>
								<td align="center"></td>
								<td align="center"></td>
								<td align="center"></td>
								<td align="center">MONTO TOTAL DEL AÑO '.$anio.'</td>
								<td align="center">$'.number_format($total_pasaje,2,".",",").'</td>
								<td align="center">$'.number_format($total_viatico,2,".",",").'</td>
								<td align="center">$'.number_format($total_total,2,".",",").'</td>
								<td align="center"></td>
								<td align="center"></td>
								<td align="center"></td>
							</tr>
				</tbody>
			</table><br>

        '; 
        if($tipo=="pdf"){
			$stylesheet = file_get_contents(base_url().'assets/plugins/bootstrap/css/bootstrap.min.css');
			$this->mpdf->AddPage('L','','','','',15,15,35,17,7,9);
			$this->mpdf->SetTitle('Poliza Anual');
			$this->mpdf->WriteHTML($stylesheet,1);  // The parameter 1 tells that this iscss/style only and no body/html/
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
										 ->setTitle("REPORTE POLIZA")	
										 ->setSubject("REPORTE POLIZA")
										 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
										 ->setKeywords("office 2007 openxml php");

			$titulosColumnas = array('No','MES','PÓLIZA','CONCEPTO','PASAJE','VIÁTICO','TOTAL','FECHA ELABORACIÓN DE LA PÓLIZA','No COMPROMISO PRESUPUESTARIO','FECHA CANCELADO');
			$this->objPHPExcel->setActiveSheetIndex(0)
			    ->setCellValue('A7',  $titulosColumnas[0])  //Titulo de las columnas
			    ->setCellValue('B7',  $titulosColumnas[1])
			    ->setCellValue('C7',  $titulosColumnas[2])
			    ->setCellValue('D7',  $titulosColumnas[3])
			    ->setCellValue('E7',  $titulosColumnas[4])
			    ->setCellValue('F7',  $titulosColumnas[5])
			    ->setCellValue('G7',  $titulosColumnas[6])
				->setCellValue('H7',  $titulosColumnas[7])
				->setCellValue('I7',  $titulosColumnas[8])
				->setCellValue('J7',  $titulosColumnas[9]) 
			    ;

			 
			$this->objPHPExcel->setActiveSheetIndex(0)
			            ->setCellValue('A1', "MINISTERIO DE TRABAJO Y PREVISIÓN SOCIAL")
			            ->setCellValue('A2', "UNIDAD FINANCIERA INSTITUCIONAL")
			            ->setCellValue('A3', "FONDO CIRCULANTE DEL MONTO FIJO")
			            ->setCellValue('A4', "PÓLIZA DE VIÁTICOS Y PASAJES AL INTERIOR CANCELADOS DURANTE EL AÑO ".$anio)
			            ;
			 $this->objPHPExcel->setActiveSheetIndex(0)->getStyle('A7:J7')->getFont()->setBold(true); 
			 
			
			 //////////////////////////////////////////////////
				$total_viatico=0;
					$total_pasaje=0;
					$total_alojamiento=0;
					$total_total=0;
	 
				$f=8;
				$data  = array('anio' => $anio );
				$correlativo=1;
				$viatico = $this->Reportes_viaticos_model->poliza_anual($data);
				if($viatico->num_rows()>0){
				foreach ($viatico->result() as $viaticos) {
					 
					
						$this->objPHPExcel->getActiveSheet()->getStyle('E'.$f.':G'.$f)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
						$this->objPHPExcel->getActiveSheet()->getStyle('A'.$f)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
						// Miscellaneous glyphs, UTF-8
						if($viaticos->no_poliza){
							$total_viatico+=$viaticos->viatico;
							$total_pasaje+=$viaticos->pasaje;
							$total_total+=$viaticos->total;
							$fecha_elaboracion = date_create($viaticos->fecha_elaboracion_poliza);
							$fecha_cancelado = date_create($viaticos->fecha_cancelado);
							$this->objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A'.$f,$correlativo)
							->setCellValue('B'.$f,$viaticos->mes_poliza)
							->setCellValue('C'.$f,$viaticos->no_poliza)
							->setCellValue('D'.$f,"VIÁTICOS Y PASAJES AL INTERIOR")
							->setCellValue('E'.$f,number_format($viaticos->pasaje,2,".",","))
							->setCellValue('F'.$f,number_format($viaticos->viatico,2,".",","))
							->setCellValue('G'.$f,number_format($viaticos->total,2,".",","))
							->setCellValue('H'.$f,date_format($fecha_elaboracion, 'd/m/Y'))
							->setCellValue('I'.$f,$viaticos->compromiso_presupuestario)
							->setCellValue('J'.$f,date_format($fecha_cancelado, 'd/m/Y'));
						 $correlativo++;
							}else if($viaticos->no_poliza=="0"){
								$total_viatico+=$viaticos->viatico;
							$total_pasaje+=$viaticos->pasaje;
							$total_total+=$viaticos->total;
							$fecha_elaboracion = date_create($viaticos->fecha_elaboracion_poliza);
							$fecha_cancelado = date_create($viaticos->fecha_cancelado);
							$this->objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A'.$f,$correlativo)
							->setCellValue('B'.$f,$viaticos->mes_poliza)
							->setCellValue('C'.$f,"DETALLE 1")
							->setCellValue('D'.$f,"VIÁTICOS Y PASAJES AL INTERIOR")
							->setCellValue('E'.$f,number_format($viaticos->pasaje,2,".",","))
							->setCellValue('F'.$f,number_format($viaticos->viatico,2,".",","))
							->setCellValue('G'.$f,number_format($viaticos->total,2,".",","))
							->setCellValue('H'.$f,date_format($fecha_elaboracion, 'd/m/Y'))
							->setCellValue('I'.$f,$viaticos->compromiso_presupuestario)
							->setCellValue('J'.$f,date_format($fecha_cancelado, 'd/m/Y'));	$correlativo++;
						}else{
								 $this->objPHPExcel->setActiveSheetIndex(0)->getStyle('A'.$f.':J'.$f)->getFont()->setBold(true); 
								$this->objPHPExcel->setActiveSheetIndex(0)
								->setCellValue('A'.$f,$correlativo)
								->setCellValue('B'.$f,$viaticos->mes_poliza)
								->setCellValue('C'.$f,"")
								->setCellValue('D'.$f,"TOTAL")
								->setCellValue('E'.$f,number_format($viaticos->pasaje,2,".",","))
								->setCellValue('F'.$f,number_format($viaticos->viatico,2,".",","))
								->setCellValue('G'.$f,number_format($viaticos->total,2,".",","))
								->setCellValue('H'.$f,"")
								->setCellValue('I'.$f,"")
								->setCellValue('J'.$f,"");
							} 
							
							$f++;
						}
						
							
					
				}else{
					$this->objPHPExcel->setActiveSheetIndex(0)
				            ->setCellValue('A'.$f, "NO HAY REGISTROS")
				            ->mergeCells('A'.$f.':J'.$f);
				}
				 
				$this->objPHPExcel->getActiveSheet()->getStyle('B'.$f.':O'.$f)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
					$this->objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('D'.$f,"TOTAL")
							->setCellValue('E'.$f,number_format($total_pasaje,2,".",","))
							->setCellValue('F'.$f, number_format($total_viatico,2,".",","))
							->setCellValue('G'.$f, number_format($total_total,2,".",","));
			$this->objPHPExcel->setActiveSheetIndex(0)->getStyle('A'.$f.':J'.$f)->getFont()->setBold(true); 
			 //////////////////////////////////////////////////
			 ///
			$fecha=strftime( "%d-%m-%Y - %H:%M:%S", time() );
			$this->objPHPExcel->setActiveSheetIndex(0)
				->setCellValue("A".$f+=4,"Fecha y Hora de Creación: ".$fecha)
				//->setCellValue("B".$f,$fecha)
				->setCellValue("A".$f+=1,"Usuario: ".$this->session->userdata('usuario_viatico'));
				//->setCellValue("B".$f,$this->session->userdata('usuario_viatico'))

			$this->objPHPExcel->setActiveSheetIndex(0)
    			->mergeCells('A1:E1')
    			->mergeCells('A2:E2')
    			->mergeCells('A3:E3')
    			->mergeCells('A4:E4');

			for($i = 'B'; $i <= 'J'; $i++){
				for($ii = '7'; $ii <= '50'; $ii++){
			    $this->objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($i,$ii)->setAutoSize(TRUE);
				}
			}
			$this->objPHPExcel->setActiveSheetIndex(0)->getStyle('A1:A7')->getFont()->setBold(true); 
			
			// Rename worksheet
			$this->objPHPExcel->getActiveSheet()->setTitle('Poliza');
			// Redirect output to a client’s web browser (Excel5)
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="Poliza_anual.xls"');
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
	public function reporte_detalle_viaticos_por_actividad($tipo,$anios,$id_vyp_actividades){
		$this->load->library('mpdf');
		$this->load->model('Reportes_viaticos_model');
		$this->mpdf = new \Mpdf\Mpdf();
		//$this->crear_grafico_viaticos_x_anio($anios);
		//$this->crear_grafico_viaticos_x_anio_totales($anios);
		$cabecera = '<table width="100%"><tr>
 		<td>
		    <img src="application/controllers/informes/logomtps.jpeg"  width="125px" height="85px">
		</td>
		<td width="550px"><h5><center>MINISTERIO DE TRABAJO Y PREVISIÓN SOCIAL <br> UNIDAD FINANCIERA INSTITUCIONAL <br> FONDO CIRCULANTE DEL MONTO FIJO <br> <span style="font-size: 22px;">REPORTE DETALLE VIÁTICOS POR ACTIVIDAD</span></center><h5></td>
		<td align="right">
		   	<img src="application/controllers/informes/escudo.jpg" width="150px" height="55px">
		</td>
	 	</tr></table>';

	 	$cabecera_vista = '<table><tr>
 		<td>
		    <img src="'.base_url().'assets/logos_vista/logomtps.jpg"  width="125px" height="85px">
		</td>
		<td width="950px"><h5><center>MINISTERIO DE TRABAJO Y PREVISIÓN SOCIAL <br> UNIDAD FINANCIERA INSTITUCIONAL <br> FONDO CIRCULANTE DEL MONTO FIJO <br> <span style="font-size: 17px;">REPORTE DETALLE VIÁTICOS POR ACTIVIDAD</span></center><h5></td>
		<td>
		   	<img src="'.base_url().'assets/logos_vista/escudo.jpg" width="150px" height="55px">
		</td>
	 	</tr></table>';
	 	$fecha=strftime( "%d-%m-%Y - %H:%M:%S", time() );
	 	$pie = 'Usuario: '.$this->session->userdata('usuario_viatico').'    Fecha y Hora Creación: '.$fecha.'||{PAGENO} de {nbpg} páginas';
		
		$this->mpdf->SetHTMLHeader($cabecera);

		//$this->mpdf->SetHTMLFooter('{PAGENO} of {nbpg} pages');
		
		$actividad = $this->Reportes_viaticos_model->obtenerDetalleActividad($id_vyp_actividades);
		foreach ($actividad->result() as $nombre_actividad) {}
		$this->mpdf->setFooter($pie);
		$data = str_split($anios,4);
		$cuerpo = '
		Periodo: '.implode(" - ", $data).'
		<br>Actividad: '.$nombre_actividad->nombre_vyp_actividades.' 
			<table  class="" border="1" style="width:100%">
				<thead >
					<tr>
						<td align="center" rowspan="2"  >NR</td>
						<td align="center" rowspan="2" >NOMBRE COMPLETO</td>
						<td align="center" colspan="3" >TIPO</td>
						<td align="center" rowspan="2" >TOTAL</td>
					</tr>
					<tr>
						<td align="center"  >VIÁTICO</td>
						<td align="center"  >PASAJE</td>
						<td align="center"  >ALOJAMIENTO</td>

					</tr>
				</thead>
				<tbody>
					';
				$total_viatico=0;
					$total_pasaje=0;
					$total_alojamiento=0;
					$total_total=0;
				

				$viatico = $this->Reportes_viaticos_model->detalle_viaticos_actividad($data,$id_vyp_actividades);
				if($viatico->num_rows()>0){
				foreach ($viatico->result() as $viaticos) {
					$total_viatico+=$viaticos->viatico;
					$total_pasaje+=$viaticos->pasaje;
					$total_alojamiento+=$viaticos->alojamiento;
					$total_total+=$viaticos->total;


					$cuerpo .= '

						<tr>
							<td align="left" style="width:40px">'.($viaticos->nr_empleado).'</td>
							<td align="left" style="width:350px">'.($viaticos->nombre_completo).'</td>
							
							<td align="center" style="width:80px">$'.number_format($viaticos->viatico,2,".",",").'</td>
							<td align="center" style="width:80px">$'.number_format($viaticos->pasaje,2,".",",").'</td>
							<td align="center" style="width:80px">$'.number_format($viaticos->alojamiento,2,".",",").'</td>
							<td align="center" style="width:80px">$'.number_format($viaticos->total,2,".",",").'</td>
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
							<td align="center" style="width:180px" colspan="2">Total</td>
							<td align="center" style="width:180px">$'.number_format($total_viatico,2,".",",").'</td>
							<td align="center" style="width:180px">$'.number_format($total_pasaje,2,".",",").'</td>
							<td align="center" style="width:180px">$'.number_format($total_alojamiento,2,".",",").'</td>
							<td align="center" style="width:180px">$'.number_format($total_total,2,".",",").'</td>
						</tr>
				</tbody>
			</table><br>

        '; 
        if($tipo=="pdf"){
			$stylesheet = file_get_contents(base_url().'assets/plugins/bootstrap/css/bootstrap.min.css');
			$this->mpdf->AddPage('L','','','','',15,15,35,17,7,9);
			$this->mpdf->SetTitle('Detalle Viaticos por Actividad');
			$this->mpdf->WriteHTML($stylesheet,1);  // The parameter 1 tells that this iscss/style only and no body/html/
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
										 ->setTitle("REPORTE DETALLE VIATICOS POR ACTIVIDAD")
										 ->setSubject("REPORTE DETALLE VIATICOS POR ACTIVIDAD")
										 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
										 ->setKeywords("office 2007 openxml php");

			$titulosColumnas = array('NR','NOMBRE COMPLETO','VIÁTICOS','PASAJES','ALOJAMIENTOS','TOTAL');
			$this->objPHPExcel->setActiveSheetIndex(0)
			    ->setCellValue('A7',  $titulosColumnas[0])  //Titulo de las columnas
			    ->setCellValue('B7',  $titulosColumnas[1])
			    ->setCellValue('C7',  $titulosColumnas[2])
			    ->setCellValue('D7',  $titulosColumnas[3])
			    ->setCellValue('E7',  $titulosColumnas[4])
				->setCellValue('F7',  $titulosColumnas[5])
			    ;

			 
			$this->objPHPExcel->setActiveSheetIndex(0)
			            ->setCellValue('A1', "MINISTERIO DE TRABAJO Y PREVISIÓN SOCIAL")
			            ->setCellValue('A2', "UNIDAD FINANCIERA INSTITUCIONAL")
			            ->setCellValue('A3', "FONDO CIRCULANTE DEL MONTO FIJO")
			            ->setCellValue('A4', "REPORTE DETALLE VIÁTICOS POR ACTIVIDAD")
			            ;
			 $this->objPHPExcel->setActiveSheetIndex(0)->getStyle('A7:G7')->getFont()->setBold(true); 
			 
			
			 //////////////////////////////////////////////////
				$total_viatico=0;
					$total_pasaje=0;
					$total_alojamiento=0;
					$total_total=0;
				$data = str_split($anios,4);
				$f=8;
				$viatico = $this->Reportes_viaticos_model->detalle_viaticos_actividad($data,$id_vyp_actividades);
				if($viatico->num_rows()>0){
				foreach ($viatico->result() as $viaticos) {
					$total_viatico+=$viaticos->viatico;
					$total_pasaje+=$viaticos->pasaje;
					$total_alojamiento+=$viaticos->alojamiento;
					$total_total+=$viaticos->total;

						$this->objPHPExcel->getActiveSheet()->getStyle('C'.$f.':F'.$f)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
						$this->objPHPExcel->getActiveSheet()->getStyle('A'.$f)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
						// Miscellaneous glyphs, UTF-8
						$this->objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A'.$f,$viaticos->nr_empleado)
							->setCellValue('B'.$f,$viaticos->nombre_completo)
							->setCellValue('C'.$f,number_format($viaticos->viatico,2,".",","))
							->setCellValue('D'.$f, number_format($viaticos->pasaje,2,".",","))
							->setCellValue('E'.$f,number_format($viaticos->alojamiento,2,".",","))
							->setCellValue('F'.$f, number_format($viaticos->total,2,".",","));
							$f++;
					}
				}else{
					$this->objPHPExcel->setActiveSheetIndex(0)
				            ->setCellValue('A'.$f, "NO HAY REGISTROS")
				            ->mergeCells('A'.$f.':F'.$f);
				}
				 
				$this->objPHPExcel->getActiveSheet()->getStyle('C'.$f.':F'.$f)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
					$this->objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A'.$f,"TOTAL")
							->mergeCells('A'.$f.':B'.$f)
							->setCellValue('C'.$f,number_format($total_viatico,2,".",","))
							->setCellValue('D'.$f, number_format($total_pasaje,2,".",","))
							->setCellValue('E'.$f,number_format($total_alojamiento,2,".",","))
							->setCellValue('F'.$f, number_format($total_total,2,".",","));
			$this->objPHPExcel->setActiveSheetIndex(0)->getStyle('A'.$f.':F'.$f)->getFont()->setBold(true); 
			 //////////////////////////////////////////////////
			 ///
			$fecha=strftime( "%d-%m-%Y - %H:%M:%S", time() );
			$this->objPHPExcel->setActiveSheetIndex(0)
				->setCellValue("A".$f+=4,"Fecha y Hora de Creación: ".$fecha)
				//->setCellValue("B".$f,$fecha)
				->setCellValue("A".$f+=1,"Usuario: ".$this->session->userdata('usuario_viatico'));
				//->setCellValue("B".$f,$this->session->userdata('usuario_viatico'))

			$this->objPHPExcel->setActiveSheetIndex(0)
    			->mergeCells('A1:C1')
    			->mergeCells('A2:C2')
    			->mergeCells('A3:C3')
    			->mergeCells('A4:C4');

			for($i = 'B'; $i <= 'F'; $i++){
				for($ii = '7'; $ii <= '50'; $ii++){
			    $this->objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($i,$ii)->setAutoSize(TRUE);
				}
			}
			$this->objPHPExcel->setActiveSheetIndex(0)->getStyle('A1:A7')->getFont()->setBold(true); 
			
			// Rename worksheet
			$this->objPHPExcel->getActiveSheet()->setTitle('Detalle Viaticos Por Actividad');
			// Redirect output to a client’s web browser (Excel5)
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="Detalle_viaticos_por_actividad.xls"');
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
}
?>
