<?php

$decs = (($monto-intval($monto))*100);

if($decs == 0){
  $decs = "00";
}

//echo$formato_dinero = NumeroALetras::convertir($monto)." ".$decs."/100";
  
class NumeroALetras{
    private static $UNIDADES = [
        '',
        'UN ',
        'DOS ',
        'TRES ',
        'CUATRO ',
        'CINCO ',
        'SEIS ',
        'SIETE ',
        'OCHO ',
        'NUEVE ',
        'DIEZ ',
        'ONCE ',
        'DOCE ',
        'TRECE ',
        'CATORCE ',
        'QUINCE ',
        'DIECISEIS ',
        'DIECISIETE ',
        'DIECIOCHO ',
        'DIECINUEVE ',
        'VEINTE '
    ];
    private static $DECENAS = [
        'VENTI',
        'TREINTA ',
        'CUARENTA ',
        'CINCUENTA ',
        'SESENTA ',
        'SETENTA ',
        'OCHENTA ',
        'NOVENTA ',
        'CIEN '
    ];
    private static $CENTENAS = [
        'CIENTO ',
        'DOSCIENTOS ',
        'TRESCIENTOS ',
        'CUATROCIENTOS ',
        'QUINIENTOS ',
        'SEISCIENTOS ',
        'SETECIENTOS ',
        'OCHOCIENTOS ',
        'NOVECIENTOS '
    ];
    public static function convertir($number, $moneda = '', $centimos = '', $forzarCentimos = false)
    {
        $converted = '';
        $decimales = '';
        if (($number < 0) || ($number > 999999999)) {
            return 'No es posible convertir el numero a letras';
        }
        $div_decimales = explode('.',$number);
        if(count($div_decimales) > 1){
            $number = $div_decimales[0];
            $decNumberStr = (string) $div_decimales[1];
            if(strlen($decNumberStr) == 2){
                $decNumberStrFill = str_pad($decNumberStr, 9, '0', STR_PAD_LEFT);
                $decCientos = substr($decNumberStrFill, 6);
                $decimales = self::convertGroup($decCientos);
            }
        }
        else if (count($div_decimales) == 1 && $forzarCentimos){
            $decimales = 'CERO ';
        }
        $numberStr = (string) $number;
        $numberStrFill = str_pad($numberStr, 9, '0', STR_PAD_LEFT);
        $millones = substr($numberStrFill, 0, 3);
        $miles = substr($numberStrFill, 3, 3);
        $cientos = substr($numberStrFill, 6);
        if (intval($millones) > 0) {
            if ($millones == '001') {
                $converted .= 'UN MILLON ';
            } else if (intval($millones) > 0) {
                $converted .= sprintf('%sMILLONES ', self::convertGroup($millones));
            }
        }
        if (intval($miles) > 0) {
            if ($miles == '001') {
                $converted .= 'MIL ';
            } else if (intval($miles) > 0) {
                $converted .= sprintf('%sMIL ', self::convertGroup($miles));
            }
        }
        if (intval($cientos) > 0) {
            if ($cientos == '001') {
                $converted .= 'UN ';
            } else if (intval($cientos) > 0) {
                $converted .= sprintf('%s ', self::convertGroup($cientos));
            }
        }
        if(empty($decimales)){
            $valor_convertido = $converted . strtoupper($moneda);
        } else {
            $valor_convertido = $converted . strtoupper($moneda);//' CON ' . $decimales . ' ' . strtoupper($centimos);
        }
        return $valor_convertido;
    }
    private static function convertGroup($n)
    {
        $output = '';
        if ($n == '100') {
            $output = "CIEN ";
        } else if ($n[0] !== '0') {
            $output = self::$CENTENAS[$n[0] - 1];
        }
        $k = intval(substr($n,1));
        if ($k <= 20) {
            $output .= self::$UNIDADES[$k];
        } else {
            if(($k > 30) && ($n[2] !== '0')) {
                $output .= sprintf('%sY %s', self::$DECENAS[intval($n[1]) - 2], self::$UNIDADES[intval($n[2])]);
            } else {
                $output .= sprintf('%s%s', self::$DECENAS[intval($n[1]) - 2], self::$UNIDADES[intval($n[2])]);
            }
        }
        return $output;
    }
}

function mes($mes){
 setlocale(LC_TIME, 'spanish');  
 $nombre=strftime("%B",mktime(0, 0, 0, $mes, 1, 2000)); 
 return strtoupper($nombre);
}


$generalidades = $this->db->query("SELECT * FROM vyp_generalidades");

$id_generalidad = ""; $pasaje = "0.00"; $alojamiento = "0.00"; $num_cuenta = ""; $id_banco = ""; $banco = ""; $num_cuenta = "";
if($generalidades->num_rows() > 0){
    foreach ($generalidades->result() as $filag) {
      $banco = mb_strtoupper($filag->banco);
      $num_cuenta = $filag->num_cuenta;
      $limite_poliza = floatval($filag->limite_poliza);
    }
}

$no_poliza="-"; $mes_poliza="-"; $anio="-"; $total=0;
$poliza = $this->db->query("SELECT no_poliza, mes_poliza, anio, SUM(total) AS total, estado, cod_presupuestario FROM vyp_poliza GROUP BY no_poliza");
if($poliza->num_rows() > 0){
    foreach ($poliza->result() as $fila) {
    	$no_poliza = $fila->no_poliza;
    	$mes_poliza = $fila->mes_poliza;
    	$anio = $fila->anio;
    	$total = $fila->total;
    	$cod_presupuestario = $fila->cod_presupuestario;
    }
}

$monto = $total;

$decs = str_pad((number_format(($monto-intval($monto)), 2, '.', '')*100), 2, "0", STR_PAD_LEFT);

if($decs == 0){
    $decs = "00";
}

$formato_dinero = NumeroALetras::convertir($monto)." ".$decs."/100";

?>
<?php

$this->mpdf=new mPDF('L','A4','10','Arial',10,10,45,17,3,9);

$cabecera = '
	<table width="100%"><tr>
		<td width="100px;" align="left">
	    	<img src="application/controllers/informes/logomtps.jpeg"  width="100px" height="50px">
	   	</td>
		<td>
			<h6><center>
				MINISTERIO DE TRABAJO Y PREVISION SOCIAL <br> 
				POLIZA DE REINTEGRO DEL FONDO CIRCULANTE </center><h6>
		</td>
	   	<td width="100px;" align="right">
		    <img src="application/controllers/informes/escudo.jpg" width="65px" height="50px">
		</td>
	</tr></table>';

$cabecera .= '
	<table width="100%" style="font-size: 9px;">
	
	<tr>
		<td width="150px;">
		    INSTITUCIÓN:
		</td>
		<td>
			MINISTERIO DE TRABAJO Y PREVISION SOCIAL
		</td>
		<td width="170px;">
		    No. POLIZA:
		</td>
		<td align="center" style="font-size: 14px; font-weight: bold;">
			'.$no_poliza.'
		</td>
	</tr>

	<tr>
		<td width="150px;">
		    CÓDIGO PRESUPUESTARIO:
		</td>
		<td>
			'.$cod_presupuestario.'
		</td>
		<td width="170px;">
		    MES:
		</td>
		<td>
			'.$mes_poliza.'
		</td>
	</tr>

	<tr>
		<td width="150px;">
		    DENOMINACIÓN DEL FONDO DE MONTO FIJO:
		</td>
		<td>
			FONDO CIRCULANTE DEL MTPS
		</td>
		<td width="170px;">
		    EJERCICIO FINANCIERO FISCAL:<BR>
		    NOMBRE DEL BANCO:
		</td>
		<td>
			'.$anio.' <BR>
			'.$banco.' 			
		</td>
	</tr>
	<tr>
		<td width="150px;">
		    MONTO TOTAL DE REINTEGRO:
		</td>
		<td  style="font-size: 12px; font-weight: bold;">
			$ '.$monto.'
		</td>
		<td width="170px;">
			No. CUENTA BANCARIA:<BR>
		    No. COMPROMISO PRESUPUESTARIO:
		</td>
		<td>
			'.$num_cuenta.' <BR>
			______________________________
		</td>
	</tr>

	<tr>
		<td width="150px;">
		    CANTIDAD EN LETRAS:
		</td>
		<td>
			'.$formato_dinero.'
		</td>
		<td width="170px;">
		    FECHA DE CANCELADO
		</td>
		<td>
			______________________________
		</td>
	</tr>

	</table>';


$this->mpdf->SetHTMLHeader($cabecera);

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

		$poliza = $this->db->query("SELECT * FROM vyp_poliza WHERE no_poliza = '".$no_poliza."'");
        if($poliza->num_rows() > 0){
            foreach ($poliza->result() as $fila) {            
			$cuerpo .= '
				<tr>
                	<td align="center" style="border-bottom: 0px; border-top: 0px; padding: 3px;">'.$fila->no_doc.'</td>
                	<td align="center" style="border-bottom: 0px; border-top: 0px; padding: 3px;">'.$fila->no_poliza.'</td>
                	<td align="center" style="border-bottom: 0px; border-top: 0px; padding: 3px;">'.$fila->mes_poliza.'</td>
                	<td align="center" style="border-bottom: 0px; border-top: 0px; padding: 3px;">'.$fila->fecha_elaboracion.'</td>
                	<td align="center" style="border-bottom: 0px; border-top: 0px; padding: 3px;">'.$fila->no_cuenta_cheque.'</td>
                	<td align="center" style="border-bottom: 0px; border-top: 0px; padding: 3px;">'.$fila->nr.'</td>
                	<td align="center" style="border-bottom: 0px; border-top: 0px; padding: 3px;">'.$fila->fecha_mision.'</td>
                	<td align="center" style="border-bottom: 0px; border-top: 0px; padding: 3px;">'.$fila->nombre_empleado.'</td>
                	<td align="center" style="border-bottom: 0px; border-top: 0px; padding: 3px;">'.$fila->detalle_mision.'</td>
                	<td align="center" style="border-bottom: 0px; border-top: 0px; padding: 3px;">'.$fila->sede.'</td>
                	<td align="center" style="border-bottom: 0px; border-top: 0px; padding: 3px;">'.$fila->cargo_funcional.'</td>
                	<td align="center" style="border-bottom: 0px; border-top: 0px; padding: 3px;">'.$fila->linea_presup1.'</td>
                	<td align="right" style="border-bottom: 0px; border-top: 0px; padding: 3px;">$'.$fila->pasaje.'</td>
                	<td align="right" style="border-bottom: 0px; border-top: 0px; padding: 3px;">$'.$fila->viatico.'</td>
                	<td align="right" style="border-bottom: 0px; border-top: 0px; padding: 3px;">$'.$fila->total.'</td>
               	</tr>';

               	$total_viatico += $fila->viatico;
               	$total_pasaje += $fila->pasaje;
			}

			$cuerpo .= '
				<tr>
					<th align="center" colspan="12">Total</th>
					<th align="right">$'.number_format($total_pasaje,2,".","").'</th>
					<th align="right">$'.number_format($total_viatico,2,".","").'</th>
					<th align="right">$'.($total_pasaje+$total_viatico).'</th>
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
$this->mpdf->AddPage('L','','','','',10,10,45,17,3,9);
$this->mpdf->SetTitle('Poliza de reintegro');
$this->mpdf->WriteHTML($stylesheet,1);  // The parameter 1 tells that this iscss/style only and no body/html/
$this->mpdf->WriteHTML($cuerpo);
$this->mpdf->Output();


?>