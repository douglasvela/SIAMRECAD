<?php

$monto = number_format(100.50, 2, '.', '');

$decs = (($monto-intval($monto))*100);

if($decs == 0){
  $decs = "00";
}

//echo$formato_dinero = NumeroALetras::convertir($monto)." ".$decs."/100";
  
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
      $limite_poliza = $filag->limite_poliza;
    }
}

$mes_poliza = $_GET["mes"];
$anio_poliza = $_GET["anio"];
$mes_texto = mes($mes_poliza);

$date_poliza = $anio_poliza."-".$mes_poliza;

?>
<div class="table-responsive">
  	<table id="" class="table table-hover product-overview">
        <thead class="bg-info text-white">
         
            <tr>
            	<th style="padding: 7px" width="25px" rowspan="2">No. Doc.</th>
              	<th style="padding: 7px" width="30px" rowspan="2">No. poliza</th>
              	<th style="padding: 7px" width="40px" rowspan="2">Mes poliza</th>
              	<th style="padding: 7px" width="40px" rowspan="2">Fecha elaboración</th>
              	<th style="padding: 7px" width="50px" rowspan="2">No. cheque/ cuenta</th>
              	<th style="padding: 7px" width="40px" rowspan="2">Código empleado</th>
              	<th style="padding: 7px" width="70px" rowspan="2">Fecha misión</th>
              	<th style="padding: 7px" width="100px" rowspan="2">Nombre empleado</th>
              	<th style="padding: 7px" width="150px" rowspan="2">Detalle misión</th>
              	<th style="padding: 7px" width="150px" rowspan="2">Sede</th>
              	<th style="padding: 7px" width="30px" rowspan="2">Cargo funcional</th>
              	<th style="padding: 7px" width="25px"  rowspan="2">UP/LT</th>
             	<th style="padding: 7px" colspan="2" ><div align="center">Detalle de objetos especificos </div></th>
             	<th style="padding: 7px" width="45px"  rowspan="2" >Total</th>
            </tr>
            <tr>
                <!-- <th width="48"  >54401</th> -->
                <th style="padding: 7px" width="20px" >54401</th>
                <!-- <th width="48" >54403</th> -->
                <th style="padding: 7px" width="20px" >54403</th>
            </tr>
        </thead>
        <tbody>
         	<?php 
                $misiones = $this->db->query("SELECT m.id_mision_oficial, m.nr_empleado, UPPER(CONCAT_WS(' ', emp.primer_nombre, emp.segundo_nombre, emp.tercer_nombre)) AS nombre, UPPER(CONCAT_WS(' ', emp.primer_apellido, emp.segundo_apellido, emp.apellido_casada)) AS apellido, m.fecha_mision_inicio, m.fecha_mision_fin, m.fecha_solicitud, e.nombre_origen, Sum(e.pasaje) AS pasaje, SUM(e.viatico) AS viatico, SUM(e.alojamiento) AS alojamiento, cf.funcional, o.nombre_oficina, lt.linea_trabajo FROM vyp_mision_oficial as m JOIN vyp_empresa_viatico AS e ON m.id_mision_oficial = e.id_mision AND m.estado > 0 AND MONTH(m.fecha_solicitud) < '".$mes_poliza."' AND YEAR(m.fecha_solicitud) = '".$anio_poliza."' JOIN sir_empleado AS emp ON emp.nr = m.nr_empleado JOIN sir_empleado_informacion_laboral AS ei ON ei.id_empleado = emp.id_empleado JOIN vyp_informacion_empleado AS ie ON ie.nr = m.nr_empleado JOIN sir_cargo_funcional AS cf ON cf.id_cargo_funcional = ei.id_cargo_funcional JOIN vyp_oficinas AS o ON o.id_oficina = ie.id_oficina_departamental JOIN org_linea_trabajo AS lt ON lt.id_linea_trabajo = ei.id_linea_trabajo GROUP BY m.nr_empleado, m.fecha_solicitud");

                $correlativo = 0;
                if($misiones->num_rows() > 0){
                    foreach ($misiones->result() as $fila) {
                    	$correlativo++;
                      	echo "<tr>";
                        ?>
            			<td style="padding: 7px;"><?php echo $correlativo; ?></td>
		            	<td style="padding: 7px;"><?php echo "191"; ?></td>
		            	<td style="padding: 7px;"><?php echo $mes_texto; ?></td>
                        <td style="padding: 7px;"><?php echo date("Y-m-d",strtotime($fila->fecha_solicitud)); ?></td>
                        <td style="padding: 7px;"><?php echo "0"; ?></td>
                        <td style="padding: 7px;"><?php echo $fila->nr_empleado; ?></td>
                        <td style="padding: 7px;"><?php echo $fila->fecha_mision_fin; ?></td>
                        <td style="padding: 7px;"><?php echo trim($fila->apellido).", ".trim($fila->nombre); ?></td>
                        <td style="padding: 7px;"><?php echo $fila->nombre_origen; ?></td>
                        <td style="padding: 7px;"><?php echo $fila->nombre_oficina; ?></td>
                        <td style="padding: 7px;"><?php echo $fila->funcional; ?></td>
                        <td style="padding: 7px;"><?php echo $fila->linea_trabajo; ?></td>
                        <!-- <td style="padding: 7px;"><?php echo "54401"; ?></td> -->
                        <td align="right" style="padding: 7px;"><?php echo "$ ".number_format(floatval($fila->viatico)+floatval($fila->alojamiento),2); ?></td>
                        <!-- <td style="padding: 7px;"><?php echo "54402"; ?></td> -->
                        <td align="right" style="padding: 7px;"><?php echo "$ ".number_format(floatval($fila->pasaje),2); ?></td>
                        <td align="right" style="padding: 7px;"><?php echo "$ ".number_format(floatval($fila->viatico)+floatval($fila->alojamiento)+floatval($fila->pasaje),2); ?></td>
                        <?php
                        /*echo "<td>";
                        	$array = array($fila->latitud_destino_vyp_rutas, $fila->longitud_destino_vyp_rutas, $fila->nombre_empresa_vyp_rutas, $fila->direccion_empresa_vyp_rutas, $fila->id_vyp_rutas);
                            echo generar_boton($array,"abrir_mapa","btn-info","mdi mdi-send","Abrir en mapa");
                        echo "</td>";*/

                      	echo "</tr>";
                    }
                }
            ?>
        </tbody>
  	</table>
</div>