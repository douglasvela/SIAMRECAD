<?php

$this->mpdf=new mPDF('L','A4','10','Arial',10,10,35,17,3,9);

$cabecera = '
	<table width="100%"><tr>
		<td width="100px;">
		    <img src="application/controllers/informes/escudo.jpg" width="65px" height="60px">
		</td>
		<td>
			<h6><center>
				MINISTERIO DE TRABAJO Y PREVISION SOCIAL <br> 
				POLIZA DE REINTEGRO DEL FONDO CIRCULANTE </center><h6></td>
		<td width="100px;" align="right">
	    	<img src="application/controllers/informes/logomtps.jpeg"  width="100px" height="60px">
	   	</td>
	</tr></table>';


$this->mpdf->SetHTMLHeader($cabecera);
$this->mpdf->shrink_tables_to_fit = 1;

$cuerpo = '
	<table  class="" border="1" style="width:100%; font-size: 10px;">
		<thead >
			<tr>
				<th align="center" rowspan="2" width="1px">No.<br>Doc</th>
				<th align="center" rowspan="2" width="10px">No.<br>Poliza</th>
				<th align="center" rowspan="2" width="20px">Mes<br>poliza</th>
				<th align="center" rowspan="2" width="25px">Fecha elaboración formulario</th>
				<th align="center" rowspan="2" width="10px">Cheque ó Cuenta</th>
				<th align="center" rowspan="2" width="10px">Código empleado</th>
				<th align="center" rowspan="2" width="13px">Fecha misión</th>
				<th align="center" rowspan="2" width="60px">Nombre empleado</th>
				<th align="center" rowspan="2" width="100px">Detalle misión</th>
				<th align="center" rowspan="2" width="60px">Sede</th>
				<th align="center" rowspan="2" width="60px">Cargo funcional</th>
				<th align="center" rowspan="2" width="20px">UP/LT</th>
				<th align="center" colspan="2" width="60px">Detalle de objetos físicos</th>
				<th align="center" rowspan="2" width="20px">Total</th>
			</tr>
			<tr>
				<th align="center" width="20px">54401</th>
				<th align="center" width="20px">54403</th>
			</tr>
		</thead>
		<tbody>
			';
		$data = str_split($anios,4);

		$no_poliza = $_GET["no_poliza"];

		$total_viatico = 0;
		$total_pasaje = 0;

		$poliza = $this->db->query("SELECT * FROM vyp_poliza WHERE no_poliz = '".$no_poliza."'");
        if($poliza->num_rows() > 0){
            foreach ($poliza->result() as $fila) {            
			$cuerpo .= '
				<tr>
                	<td align="center">'.$fila->no_doc.'</td>
                	<td align="center">'.$fila->no_poliz.'</td>
                	<td align="center">'.$fila->mes_poliza.'</td>
                	<td align="center">'.$fila->fecha_elaboracion.'</td>
                	<td align="center">'.$fila->no_cuenta_cheque.'</td>
                	<td align="center">'.$fila->nr.'</td>
                	<td align="center">'.$fila->fecha_mision.'</td>
                	<td align="center">'.$fila->nombre_empleado.'</td>
                	<td align="center">'.$fila->detalle_mision.'</td>
                	<td align="center">'.$fila->sede.'</td>
                	<td align="center">'.$fila->cargo_funcional.'</td>
                	<td align="center">'.$fila->linea_presup1.'</td>
                	<td align="right">$'.$fila->viatico.'</td>
                	<td align="right">$'.$fila->pasaje.'</td>
                	<td align="right">$'.$fila->total.'</td>
               	</tr>';

               	$total_viatico += $fila->viatico;
               	$total_pasaje += $fila->pasaje;
			}

			$cuerpo .= '
				<tr>
					<th align="center" colspan="12">Total</th>
					<th align="center">$'.$total_viatico.'</th>
					<th align="center">$'.number_format($total_pasaje,2,".","").'</th>
					<th align="center">$'.($total_pasaje+$total_viatico).'</th>
				</tr>';

		}else{
		$cuerpo .= '
				<tr><td colspan="15"><center>No hay registros</center></td></tr>
			';
		}

		$cuerpo .= '
		</tbody>
	</table>'; 


$fecha=strftime( "%d-%m-%Y - %H:%M:%S", time() );
	$pie = 'Generada por: '.$this->session->userdata('usuario_viatico').'    Fecha y Hora Creacion: '.$fecha.'||{PAGENO} de {nbpg} páginas';
//$this->mpdf->SetHTMLFooter('{PAGENO} of {nbpg} pages');
$this->mpdf->setFooter($pie);

$stylesheet = file_get_contents(base_url().'assets/plugins/bootstrap/css/bootstrap.min.css');
$this->mpdf->AddPage('L','','','','',10,10,35,17,3,9);
$this->mpdf->SetTitle('Poliza de reintegro');
$this->mpdf->WriteHTML($stylesheet,1);  // The parameter 1 tells that this iscss/style only and no body/html/
$this->mpdf->WriteHTML($cuerpo);
$this->mpdf->Output();


?>