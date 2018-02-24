


<?php

$nr_empleado = $_GET["nr"];
$fecha_mes = $_GET["fecha2"];

// $cuenta = $this->db->query("SELECT e.id_empleado, e.nr, UPPER(CONCAT_WS(' ', e.primer_nombre, e.segundo_nombre, e.tercer_nombre, e.primer_apellido, e.segundo_apellido, e.apellido_casada)) AS nombre_completo, p.fecha_mision, SUM(p.monto_pasaje) AS monto_pasaje FROM sir_empleado AS e JOIN vyp_pasajes AS p ON p.nr = e.nr AND p.fecha_mision LIKE '%".$fecha_mes."%' AND e.id_estado = '00001' GROUP BY e.nr ORDER BY e.primer_nombre, e.segundo_nombre, e.tercer_nombre, e.primer_apellido, e.segundo_apellido, e.apellido_casada");
$soli_pasaje = $this->db->query("SELECT sum(monto_pasaje) as monto_pasaje, fecha_mision  FROM vyp_pasajes WHERE nr = '".$nr_empleado."' OR fecha_mision LIKE '%".$fecha_mes."%'  GROUP BY nr ORDER BY fecha_mision");

//$viaticos = 0.00;
//$pasajes = 0.00;
//$alojamiento = 0.00;
$total_pa= 0.00;
$registros = count($soli_pasaje->result());
if($soli_pasaje->num_rows() > 0){
    //echo($cuenta);
    foreach ($soli_pasaje->result() as $fila) {
       
       $total_pa=$fila->monto_pasaje;
     //  $total_pa = $fila->SUM(monto_pasaje);
       // $viaticos += $fila->viatico;
        //$pasajes += $fila->pasaje;
        //$alojamiento += $fila->alojamiento;

   }
}

$monto = number_format(($total_pa), 2, '.', '');

$decs = str_pad((number_format(($monto-intval($monto)), 2, '.', '')*100), 2, "0", STR_PAD_LEFT);

if($decs == 0){
    $decs = "00";
}

$formato_dinero = NumeroALetras::convertir($monto)." ".$decs."/100";

function mes($mes){
 setlocale(LC_TIME, 'spanish');  
 $nombre=strftime("%B",mktime(0, 0, 0, $mes, 1, 2000)); 
 return $nombre;
}
  
class NumeroALetras
{
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
            $valor_convertido = $converted . strtoupper($moneda);// . ' CON ' . $decimales . ' ' . strtoupper($centimos);
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

/*********************************************************************************************************
                INICIO DEL REPORTE - SOLICITUD DE VIÁTICOS
*********************************************************************************************************/

$pdf=new FPDF();
$pdf->cambiarTitulo('RECIBO DE PASAJES URBANO Y AL INTERIOR','POR $   '.$monto);
$pdf->AddPage();
$pdf->MultiCell(195,5,'Recibí del Fondo Circunte del Monto Fijo del Ministerio de Trabajo y Previsión Social, la cantidad de '.$formato_dinero.' Dólares en concepto de pago de pasajes en transporte urbano y al interior del territorio nacional originado por Misiones Oficiales encomendadas a diferentes empresas, durante el mes de:   según detalle anexo:',0,'J',false);

$pdf->Ln(5);

 $pdf->Text($pdf->GetX(),$pdf->GetY(),"Lugar y Fecha de elaboracion: San Salvador, ".date("d")." de ".mes(date("m"))." de ".date("Y"),0,'C', 0);


/*$empresas_visitadas = $this->db->query("SELECT * FROM vyp_empresas_visitadas WHERE id_mision_oficial = '".$id_mision."'");

if($empresas_visitadas->num_rows() > 0){
    foreach ($empresas_visitadas->result() as $filae) {
        $registros--;
        if($registros > 0){
            $pdf->Cell(195,5,"        * ".$filae->nombre_empresa.". Dirección: ".$filae->direccion_empresa,0,'J',false);
            $pdf->Ln(5);
        }
    }
}*/




$pdf->Output($nr_empleado.'_solicitudPasaje_'.$fecha_mes.".pdf",'I');
?>