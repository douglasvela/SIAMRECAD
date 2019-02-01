<?php

/*$decs = (($monto-intval($monto))*100);

if($decs == 0){
  $decs = "00";
}*/

//echo$formato_dinero = NumeroALetras::convertir($monto)." ".$decs."/100";
  
class NumeroALetras{
    private static $UNIDADES = array('', 'UN ', 'DOS ', 'TRES ', 'CUATRO ', 'CINCO ', 'SEIS ', 'SIETE ', 'OCHO ', 'NUEVE ', 'DIEZ ', 'ONCE ', 'DOCE ', 'TRECE ', 'CATORCE ', 'QUINCE ', 'DIECISEIS ', 'DIECISIETE ', 'DIECIOCHO ', 'DIECINUEVE ', 'VEINTE ' );

    private static $DECENAS = array( 'VENTI', 'TREINTA ', 'CUARENTA ', 'CINCUENTA ', 'SESENTA ', 'SETENTA ', 'OCHENTA ', 'NOVENTA ', 'CIEN ');

    private static $CENTENAS = array('CIENTO ', 'DOSCIENTOS ', 'TRESCIENTOS ', 'CUATROCIENTOS ', 'QUINIENTOS ', 'SEISCIENTOS ', 'SETECIENTOS ', 'OCHOCIENTOS ', 'NOVECIENTOS ' );

    public static function convertir($number, $moneda = '', $centimos = '', $forzarCentimos = false) {
        $converted = ''; $decimales = '';
        if (($number < 0) || ($number > 999999999)) { return 'No es posible convertir el numero a letras'; }
        $div_decimales = explode('.',$number);
        if(count($div_decimales) > 1){
            $number = $div_decimales[0]; $decNumberStr = (string) $div_decimales[1];
            if(strlen($decNumberStr) == 2){
                $decNumberStrFill = str_pad($decNumberStr, 9, '0', STR_PAD_LEFT); $decCientos = substr($decNumberStrFill, 6); $decimales = self::convertGroup($decCientos);
            }
        } else if (count($div_decimales) == 1 && $forzarCentimos){ $decimales = 'CERO '; }
        $numberStr = (string) $number; $numberStrFill = str_pad($numberStr, 9, '0', STR_PAD_LEFT); $millones = substr($numberStrFill, 0, 3); $miles = substr($numberStrFill, 3, 3); $cientos = substr($numberStrFill, 6);
        if (intval($millones) > 0) {
            if ($millones == '001') { $converted .= 'UN MILLON ';
            } else if (intval($millones) > 0) { $converted .= sprintf('%sMILLONES ', self::convertGroup($millones)); }
        }
        if (intval($miles) > 0) {
            if ($miles == '001') { $converted .= 'MIL '; } else if (intval($miles) > 0) { $converted .= sprintf('%sMIL ', self::convertGroup($miles)); }
        }
        if (intval($cientos) > 0) {
            if ($cientos == '001') { $converted .= 'UN '; } else if (intval($cientos) > 0) { $converted .= sprintf('%s ', self::convertGroup($cientos)); }
        }
        if(empty($decimales)){ $valor_convertido = $converted . strtoupper($moneda);
        } else { $valor_convertido = $converted . strtoupper($moneda);/* . ' CON ' . $decimales . ' ' . strtoupper($centimos);*/ }
        return $valor_convertido;
    }

    private static function convertGroup($n){
        $output = '';
        if ($n == '100') { $output = "CIEN "; } else if ($n[0] !== '0') { $output = self::$CENTENAS[$n[0] - 1]; }
        $k = intval(substr($n,1));
        if ($k <= 20) { $output .= self::$UNIDADES[$k];
        } else {
            if(($k > 30) && ($n[2] !== '0')) { $output .= sprintf('%sY %s', self::$DECENAS[intval($n[1]) - 2], self::$UNIDADES[intval($n[2])]);
            } else { $output .= sprintf('%s%s', self::$DECENAS[intval($n[1]) - 2], self::$UNIDADES[intval($n[2])]); }
        }
        return $output;
    }
}

$generalidades = $this->db->query("SELECT * FROM vyp_generalidades");

$id_generalidad = ""; $pasaje = "0.00"; $alojamiento = "0.00"; $num_cuenta = ""; $id_banco = ""; $banco = ""; $num_cuenta = "";
if($generalidades->num_rows() > 0){
    foreach ($generalidades->result() as $filag) {
      $nr_responsable = $filag->id_responsable;
      $limite_poliza = floatval($filag->limite_poliza);
    }
}

$no_poliza = $_GET["no_poliza"];
$mes_poliza = $_GET["mes"];
$anio = $_GET["anio"]; 
$total=0;

$poliza = $this->db->query("SELECT no_poliza, mes_poliza, anio, SUM(total) AS total, estado, cod_presupuestario, nombre_banco, cuenta_bancaria FROM vyp_poliza WHERE no_poliza = '".$no_poliza."' AND mes_poliza = '".$mes_poliza."' AND anio = '".$anio."' GROUP BY no_poliza");
if($poliza->num_rows() > 0){
    foreach ($poliza->result() as $fila) {
    	$total = $fila->total;
        $banco = mb_strtoupper($fila->nombre_banco);
        $num_cuenta = $fila->cuenta_bancaria;
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

$this->mpdf=new \Mpdf\Mpdf();

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
		    <img src="application/controllers/informes/escudo.jpg" width="130px" height="50px">
		</td>
	</tr></table>';

$cabecera .= '
	<table width="100%" style="font-size: 9px;">
	
	<tr>
		<td>
		    INSTITUCIÓN:
		</td>
		<td>
			MINISTERIO DE TRABAJO Y PREVISION SOCIAL
		</td>
		<td>
		    No. POLIZA:
		</td>
		<td align="center" style="font-size: 14px; font-weight: bold;">
			'.$no_poliza.'
		</td>
	</tr>

	<tr>
		<td>
		    CÓDIGO PRESUPUESTARIO:
		</td>
		<td>
			'.$cod_presupuestario.'
		</td>
		<td>
		    MES:
		</td>
		<td>
			'.$mes_poliza.'
		</td>
	</tr>

	<tr>
		<td>
		    DENOMINACIÓN DEL FONDO DE MONTO FIJO:
		</td>
		<td>
			FONDO CIRCULANTE DEL MTPS
		</td>
		<td>
		    EJERCICIO FINANCIERO FISCAL:<BR>
		    NOMBRE DEL BANCO:
		</td>
		<td>
			'.$anio.' <BR>
			'.$banco.' 			
		</td>
	</tr>
	<tr>
		<td>
		    MONTO TOTAL DE REINTEGRO:
		</td>
		<td  style="font-size: 12px; font-weight: bold;">
			$ '.$monto.'
		</td>
		<td>
			No. CUENTA BANCARIA:<BR>
		    No. COMPROMISO PRESUPUESTARIO:
		</td>
		<td>
			'.$num_cuenta.' <BR>
			______________________________
		</td>
	</tr>

	<tr>
		<td>
		    CANTIDAD EN LETRAS:
		</td>
		<td>
			'.$formato_dinero.'
		</td>
		<td>
		    FECHA DE CANCELADO
		</td>
		<td>
			______________________________
		</td>
	</tr>

	</table>';


$this->mpdf->SetHTMLHeader($cabecera);

$linea1 = $this->db->query("SELECT linea_presup1, SUM(total) AS total FROM vyp_poliza WHERE no_poliza = '".$no_poliza."' AND mes_poliza = '".$mes_poliza."' AND anio = '".$anio."' GROUP BY linea_presup1");
$array_linea1 = array();
$array_total1 = array();
if($linea1->num_rows() > 0){
    foreach ($linea1->result() as $filal1) {
        array_push($array_linea1, $filal1->linea_presup1);
        array_push($array_total1, $filal1->total);
    }
}

$cuerpo = '
    <table  class="" border="1" style="width:100%; font-size: 10px;">
        <thead >
            <tr>
                <th style="padding: 3px;" align="center" colspan="'.count($array_linea1).'" width="1px">Subtotales originales</th>
            </tr>
        </thead>
        <tbody>';

        $cuerpo .= '<tr>';
        for($i=0;$i<count($array_linea1);$i++){
            $cuerpo .= '<td width="200px" style="padding: 3px;" align="center">'.$array_linea1[$i].'</td>';
        }
        $cuerpo .= '</tr>';
        $cuerpo .= '<tr>';
        for($i=0;$i<count($array_total1);$i++){
            $cuerpo .= '<td style="padding: 3px;" align="center">$ '.$array_total1[$i].'</td>';
        }
        $cuerpo .= '</tr>';

$cuerpo .= '</tbody>
    </table><br>';

$cuerpo .= '
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

		$total_viatico = 0;
		$total_pasaje = 0;
        $contador = 0;

		$poliza = $this->db->query("SELECT * FROM vyp_poliza WHERE no_poliza = '".$no_poliza."' AND mes_poliza = '".$mes_poliza."' AND anio = '".$anio."' ORDER BY linea_presup1, no_doc");
        if($poliza->num_rows() > 0){
            foreach ($poliza->result() as $fila) {            

            $contador++;

			$cuerpo .= '
				<tr>
                	<td align="center" style="border-bottom: 0px; border-top: 0px; padding: 3px;">'.$contador.'</td>
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
					<th align="right">$'.number_format($total_pasaje+$total_viatico,2,".","").'</th>
				</tr>';

		}else{
		$cuerpo .= '
				<tr><td colspan="15"><center>No hay registros</center></td></tr>
			';
		}

		$cuerpo .= '
		</tbody>
	</table>';


    $responsable = $this->db->query("SELECT eil.*, e.id_empleado, e.telefono_contacto, UPPER(CONCAT_WS(' ', e.primer_nombre, e.segundo_nombre, e.tercer_nombre, e.primer_apellido, e.segundo_apellido, e.apellido_casada)) AS nombre_completo, e.nit FROM sir_empleado AS e INNER JOIN sir_empleado_informacion_laboral AS eil ON e.id_empleado = eil.id_empleado AND e.nr = '".$nr_responsable."' ORDER BY eil.fecha_inicio DESC LIMIT 1");

    if($responsable->num_rows() > 0){
        foreach ($responsable->result() as $filae) {              
        }
    }

    $cuerpo .= '<table style="width:100%;">
    <tbody>
        <tr>
            <td>Lugar y Fecha: SAN SALVADOR, '.date("d", strtotime($fila->fecha_elaboracion_poliza)).' DE '.mes(date("m"), strtotime($fila->fecha_elaboracion_poliza)).' DE '.date("Y", strtotime($fila->fecha_elaboracion_poliza)).'</td>
        </tr>
        
    </tbody>
    </table>';


    $cuerpo .= '<table style="width:100%;">
    <tbody>
        <tr>
            <td width="375" rowspan="3" align="center"></td>
            <td align="center" valign="bottom" width="5">
                F.
            </td>
            <td width="340" align="center" style="border-bottom: 1px solid black;">
                <img src="assets/firmas/'.$nr_responsable.'.png" style="max-width: 200px; max-height: 70px;">
            </td>
            <td width="100" rowspan="3" align="center"></td>
            <td align="center"></td>
            <td width="50" rowspan="3" align="center"></td>
        </tr>
        <tr>
            <td align="center" colspan="2">'.$filae->nombre_completo.'</td>
            <td align="center" style="border-bottom: 1px solid black;">'.$filae->nit.'</td>
        </tr>
        <tr>
            <td align="center" colspan="2">Encargado/a de fondo cirulante</td>
            <td align="center">NIT</td>
        </tr>
    </tbody>
    </table>';

$pie = piePagina($this->session->userdata('usuario_viatico'));
//$this->mpdf->SetHTMLFooter('{PAGENO} of {nbpg} pages');
$this->mpdf->setFooter($pie);

$stylesheet = file_get_contents(base_url().'assets/plugins/bootstrap/css/bootstrap.min.css');
$this->mpdf->AddPage('L','','','','',10,10,45,17,3,9);
$this->mpdf->SetTitle('Poliza de reintegro');
$this->mpdf->WriteHTML($stylesheet,1);  // The parameter 1 tells that this iscss/style only and no body/html/
$this->mpdf->WriteHTML($cuerpo);
$this->mpdf->Output("POLIZA-ORIGINAL_".$no_poliza."_".$mes_poliza."_".$anio.".pdf", "I");


?>