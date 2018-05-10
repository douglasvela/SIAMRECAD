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
      $id_generalidad = $filag->id_generalidad;
      $pasaje = $filag->pasaje;
      $alojamiento = $filag->alojamiento;
      $id_banco = $filag->id_banco;
      $banco = mb_strtoupper($filag->banco);
      $num_cuenta = $filag->num_cuenta;
      $limite_poliza = floatval($filag->limite_poliza);
    }
}

$mes_poliza = $_GET["mes"];
$num_poliza = $_GET["num_poliza"];
$anio_poliza = $_GET["anio"];
$mes_texto = mes($mes_poliza);

$date_poliza = $anio_poliza."-".$mes_poliza;

if($_GET["orden_poliza"] == "automatico"){
    $poliza = $this->db->query("SELECT no_poliz FROM vyp_poliza WHERE anio = '$anio_poliza' ORDER BY no_poliz DESC LIMIT 1");

    $ult_poliza = 1;
    if($poliza->num_rows() > 0){
        foreach ($poliza->result() as $fila2) {
            $ult_poliza = intval($fila2->no_poliz)+1;
        }
    }
}else{
    $ult_poliza = $num_poliza;
}

$num_poliza = $ult_poliza;

?>
<div class="table-responsive">
  	<table id="tabla_poliza" class="table table-hover product-overview bg-white">
        <thead class="bg-info text-white" style="font-size: 11px;">
         
            <tr>
            	<th style="padding: 7px" width="25px" rowspan="2">No. Doc.</th>
              	<th style="padding: 7px" width="40px" rowspan="2">Mes poliza</th>
              	<th style="padding: 7px" width="40px" rowspan="2">Fecha elaboración formulario</th>
              	<th style="padding: 7px" width="50px" rowspan="2">No. cheque/ cuenta</th>
              	<th style="padding: 7px" width="40px" rowspan="2">Código empleado</th>
              	<th style="padding: 7px" width="70px" rowspan="2">Fecha misión</th>
              	<th style="padding: 7px" width="100px" rowspan="2">Nombre empleado</th>
              	<th style="padding: 7px" width="200px" rowspan="2">Detalle misión</th>
              	<th style="padding: 7px" width="120px" rowspan="2">Sede</th>
              	<th style="padding: 7px" width="25px"  rowspan="2">UP/LT</th>
              	<th style="padding: 7px" width="25px"  rowspan="2">UP/LT (presup.)</th>
             	<th style="padding: 7px" colspan="2" ><div align="center">Detalle de objetos especificos </div></th>
             	<th style="padding: 7px" width="60px"  rowspan="2" >Total</th>
            </tr>
            <tr>
                <!-- <th width="48"  >54401</th> -->
                <th style="padding: 7px" width="60px" >54401</th>
                <!-- <th width="48" >54403</th> -->
                <th style="padding: 7px" width="60px" >54403</th>
            </tr>
        </thead>
        <tbody style="font-size: 11px;" align="center">
         	<?php

                $poliza = $this->db->query("SELECT * FROM vyp_poliza WHERE no_poliza = '".$num_poliza."' AND anio = '".$anio_poliza."' ORDER BY linea_presup1");

                $correlativo = 0;
                $total_pasaje = 0;
                $total_viatico = 0;
                if($poliza->num_rows() > 0){
                    foreach ($poliza->result() as $fila) {
                    	$correlativo++;


                    	$total_pasaje += floatval($fila->pasaje);
                    	$total_viatico += floatval($fila->viatico);

                      	echo "<tr style='cursor: pointer;' onclick='nuevo_clic(this);'>";
                        ?>
            			<td style="padding: 7px;"><?php echo $correlativo; ?>
                            <input type="hidden" width="20px" value="<?php echo $fila->id_poliza; ?>">
                        </td>
		            	<td style="padding: 7px;"><?php echo $fila->mes_poliza; ?></td>
                        <td style="padding: 7px;"><?php echo date("Y-m-d",strtotime($fila->fecha_elaboracion)); ?></td>
                        <td style="padding: 7px;"><?php echo $fila->no_cuenta_cheque; ?></td>
                        <td style="padding: 7px;"><?php echo $fila->nr; ?></td>
                        <td style="padding: 7px;"><?php echo date("Y-m-d",strtotime($fila->fecha_mision)); ?></td>
                        <td style="padding: 7px;"><?php echo $fila->nombre_empleado; ?></td>
                        <td style="padding: 7px;"><?php echo $fila->detalle_mision; ?></td>
                        <td style="padding: 7px;"><?php echo $fila->sede; ?></td>
                        <td style="padding: 7px;"><?php echo $fila->linea_presup1; ?></td>
                        <td style="padding: 7px;"><?php echo $fila->linea_presup2; ?></td>
                        <!-- <td style="padding: 7px;"><?php echo "54401"; ?></td> -->
                        <td align="right" style="padding: 7px;">
                            <?php echo "$ ".number_format(floatval($fila->pasaje),2); ?>
                            <input type="hidden" value="<?php echo number_format(floatval($fila->pasaje),2); ?>">
                        </td>
                        <!-- <td style="padding: 7px;"><?php echo "54402"; ?></td> -->

                        <td style="padding: 7px;" align="right" style="padding: 7px;">
                            <?php echo "$ ".number_format(floatval($fila->viatico)+floatval($fila->alojamiento),2); ?>
                            <input type="hidden" value="<?php echo number_format(floatval($fila->viatico),2); ?>">
                        </td>

                        <td style="padding: 7px;" align="right" style="padding: 7px;"><?php echo "$ ".number_format(floatval($fila->viatico)+floatval($fila->alojamiento)+floatval($fila->pasaje),2); ?>
                            <input type="hidden" value="<?php echo number_format(floatval($fila->viatico)+floatval($fila->pasaje),2); ?>">
                        </td>
                        <?php
                        /*echo "<td>";
                        	$array = array($fila->latitud_destino_vyp_rutas, $fila->longitud_destino_vyp_rutas, $fila->nombre_empresa_vyp_rutas, $fila->direccion_empresa_vyp_rutas, $fila->id_vyp_rutas);
                            echo generar_boton($array,"abrir_mapa","btn-info","mdi mdi-send","Abrir en mapa");
                        echo "</td>";*/

                      	echo "</tr>";
                    }
?>
					<tr style="font-weight: 500; font-size: 11px;">
						<td style="padding: 7px;" colspan="11" align="center"> TOTAL </td>
						<td style="padding: 7px;" align="right"><?php echo "$ ".number_format($total_pasaje,2); ?></td>
						<td style="padding: 7px;" align="right"><?php echo "$ ".number_format($total_viatico,2); ?></td>
						<td style="padding: 7px;" align="right"><?php echo "$ ".number_format(($total_viatico+$total_pasaje),2); ?></td>
					</tr>						
<?php

                }else{
                	echo "<tr><td colspan='15'>Registros no disponibles...</td></tr>";
                }
            ?>
        </tbody>
  	</table>

<?php

$monto = $total_viatico+$total_pasaje;

$decs = str_pad((number_format(($monto-intval($monto)), 2, '.', '')*100), 2, "0", STR_PAD_LEFT);

if($decs == 0){
    $decs = "00";
}

$formato_dinero = NumeroALetras::convertir($monto)." ".$decs."/100";
?>

  	<input type="hidden" id="total" value="<?php echo number_format(($monto), 2, '.', ''); ?>">
  	<input type="hidden" id="total_texto" value="<?php echo $formato_dinero." DOLARES"; ?>">
</div>