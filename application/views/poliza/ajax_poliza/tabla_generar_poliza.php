<?php

$decs = (($monto-intval($monto))*100);

if($decs == 0){
  $decs = "00";
}

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
$tipo_poliza = $_GET["tipo_poliza"];
$mes_texto = mes($mes_poliza);

$addsql = "";
if($tipo_poliza == "banco"){
    $addsql = "AND m2.pagado_en <> 'efectivo'";
}else{
    $addsql = "AND m2.pagado_en = 'efectivo'";
}

$date_poliza = $anio_poliza."-".$mes_poliza;

if($_GET["orden_poliza"] == "automatico"){
    $poliza = $this->db->query("SELECT no_poliza FROM vyp_poliza WHERE anio = '$anio_poliza' ORDER BY no_poliza DESC LIMIT 1");

    $ult_poliza = 0;
    if($poliza->num_rows() > 0){
        foreach ($poliza->result() as $fila2) {
            $ult_poliza = intval($fila2->no_poliza)+1;
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
         
            <tr align="center">
            	<th style="padding: 7px" width="25px" rowspan="2">No. Doc.</th>
              	<th style="padding: 7px" width="30px" rowspan="2">No. poliza</th>
              	<th style="padding: 7px" width="40px" rowspan="2">Mes poliza</th>
              	<th style="padding: 7px" width="40px" rowspan="2">Fecha elaboración</th>
              	<th style="padding: 7px" width="50px" rowspan="2">No. cheque/ cuenta</th>
              	<th style="padding: 7px" width="40px" rowspan="2">Código empleado</th>
              	<th style="padding: 7px" width="70px" rowspan="2">Fecha misión</th>
              	<th style="padding: 7px" width="60px" rowspan="2">Nombre empleado</th>
              	<th style="padding: 7px" width="150px" rowspan="2">Detalle misión</th>
              	<th style="padding: 7px" width="30px" rowspan="2" align="center">Sede</th>
              	<th style="padding: 7px" width="20px" rowspan="2">Cargo funcional</th>
              	<th style="padding: 7px" width="25px"  rowspan="2">UP/LT</th>
             	<th style="padding: 7px" colspan="2" ><div align="center">Detalle de objetos especificos </div></th>
             	<th style="padding: 7px" width="65px"  rowspan="2" >Total</th>
            </tr>
            <tr>
                <!-- <th width="48"  >54401</th> -->
                <th style="padding: 7px" width="65px" >54401</th>
                <!-- <th width="48" >54403</th> -->
                <th style="padding: 7px" width="65px" >54403</th>
            </tr>
        </thead>
        <tbody style="font-size: 11px;" id="body_poliza">
         	<?php

                if($num_poliza == "0"){

                    /*SELECT m.id_mision_oficial, m.nr_empleado, UPPER(CONCAT_WS(' ', emp.primer_nombre, emp.segundo_nombre, emp.tercer_nombre)) AS nombre, UPPER(CONCAT_WS(' ', emp.primer_apellido, emp.segundo_apellido, emp.apellido_casada)) AS apellido, m.fecha_mision_inicio, m.fecha_mision_fin, m.fecha_solicitud, m.no_cheque, m.pagado_en, e.nombre_origen, sum(e.pasaje) AS pasaje, sum(e.viatico) AS viatico, sum(e.alojamiento) AS alojamiento, cf.funcional, o.id_oficina, o.nombre_oficina, lt.linea_trabajo, ei.id_seccion, 'viatico' AS tipo_solicitud FROM vyp_mision_oficial as m JOIN vyp_empresa_viatico AS e ON m.id_mision_oficial = e.id_mision AND (MONTH(m.fecha_solicitud) = '12' AND YEAR(m.fecha_solicitud) = '".($anio_poliza-1)."') AND m.id_mision_oficial NOT IN (SELECT id_mision FROM vyp_poliza) ".$addsql." JOIN sir_empleado AS emp ON emp.nr = m.nr_empleado JOIN (SELECT MAX(id_empleado_informacion_laboral) as id_empleado_informacion_laboral, id_empleado, id_linea_trabajo, id_cargo_funcional, id_seccion FROM sir_empleado_informacion_laboral GROUP BY id_empleado ORDER BY id_empleado_informacion_laboral) AS ei ON ei.id_empleado = emp.id_empleado JOIN vyp_informacion_empleado AS ie ON ie.nr = m.nr_empleado JOIN sir_cargo_funcional AS cf ON cf.id_cargo_funcional = ei.id_cargo_funcional JOIN vyp_oficinas AS o ON o.id_oficina = ie.id_oficina_departamental JOIN org_linea_trabajo AS lt ON lt.id_linea_trabajo = ei.id_linea_trabajo GROUP BY m.id_mision_oficial ORDER BY m.fecha_solicitud, lt.linea_trabajo*/

                    $misiones = $this->db->query("SELECT c.*, emp.nombre_empleado, emp.cargo_funcional, o.id_oficina, o.nombre_oficina, emp.linea_trabajo, emp.id_seccion FROM (SELECT m2.id_mision_oficial, m2.nr_empleado, CAST(m2.fecha_mision_inicio AS CHAR) AS fecha_mision_inicio, CAST(m2.fecha_mision_fin AS CHAR) AS fecha_mision_fin, m2.fecha_solicitud, m2.no_cheque, m2.pagado_en, sum(e2.pasaje) AS pasaje, sum(e2.viatico) AS viatico, sum(e2.alojamiento) AS alojamiento, 'viatico' AS tipo_solicitud FROM vyp_mision_oficial as m2 JOIN vyp_empresa_viatico AS e2 ON m2.id_mision_oficial = e2.id_mision AND m2.estado = '7' AND (MONTH(m2.fecha_solicitud) = '12' AND YEAR(m2.fecha_solicitud) = '".($anio_poliza-1)."') AND m2.id_mision_oficial NOT IN (SELECT id_mision FROM vyp_poliza WHERE tipo_solicitud = 'viatico') ".$addsql." GROUP BY m2.id_mision_oficial UNION SELECT mp.id_mision_pasajes AS id_mision_oficial, mp.nr AS nr_empleado, mp.fechas_pasajes AS fecha_mision_inicio, mp.fechas_pasajes AS fecha_mision_fin, mp.fecha_solicitud_pasaje AS fecha_solicitud, '' AS no_cheque, 'banco' AS pagado_en, SUM(ps.monto_pasaje) AS pasaje, '0.00' AS viatico, '0.00' AS alojamiento, 'pasaje' AS tipo_solicitud FROM vyp_mision_pasajes AS mp JOIN vyp_pasajes AS ps ON mp.mes_pasaje = MONTH(ps.fecha_mision) AND mp.anio_pasaje = YEAR(ps.fecha_mision) AND mp.estado = '7' AND ps.nr = mp.nr AND (MONTH(mp.fecha_solicitud_pasaje) = '12' AND YEAR(mp.fecha_solicitud_pasaje) = '".($anio_poliza-1)."') AND mp.id_mision_pasajes NOT IN (SELECT id_mision FROM vyp_poliza WHERE tipo_solicitud = 'pasaje')) AS c JOIN lista_empleados_estado emp ON emp.nr_empleado = c.nr_empleado JOIN vyp_informacion_empleado AS ie ON ie.nr = c.nr_empleado JOIN vyp_oficinas AS o ON o.id_oficina = ie.id_oficina_departamental ORDER BY c.fecha_solicitud, emp.linea_trabajo");


                    

                }else{

                    /*SELECT m.id_mision_oficial, m.nr_empleado, UPPER(CONCAT_WS(' ', emp.primer_nombre, emp.segundo_nombre, emp.tercer_nombre)) AS nombre, UPPER(CONCAT_WS(' ', emp.primer_apellido, emp.segundo_apellido, emp.apellido_casada)) AS apellido, m.fecha_mision_inicio, m.fecha_mision_fin, m.fecha_solicitud, m.no_cheque, m.pagado_en, e.nombre_origen, sum(e.pasaje) AS pasaje, sum(e.viatico) AS viatico, sum(e.alojamiento) AS alojamiento, cf.funcional, o.id_oficina, o.nombre_oficina, lt.linea_trabajo, ei.id_seccion, 'viatico' AS tipo_solicitud FROM vyp_mision_oficial as m JOIN vyp_empresa_viatico AS e ON m.id_mision_oficial = e.id_mision AND (MONTH(m.fecha_solicitud) <= '".$mes_poliza."' AND YEAR(m.fecha_solicitud) = '".$anio_poliza."') AND m.id_mision_oficial NOT IN (SELECT id_mision FROM vyp_poliza) ".$addsql." JOIN sir_empleado AS emp ON emp.nr = m.nr_empleado JOIN (SELECT MAX(id_empleado_informacion_laboral) as id_empleado_informacion_laboral, id_empleado, id_linea_trabajo, id_cargo_funcional, id_seccion FROM sir_empleado_informacion_laboral GROUP BY id_empleado ORDER BY id_empleado_informacion_laboral) AS ei ON ei.id_empleado = emp.id_empleado JOIN vyp_informacion_empleado AS ie ON ie.nr = m.nr_empleado JOIN sir_cargo_funcional AS cf ON cf.id_cargo_funcional = ei.id_cargo_funcional JOIN vyp_oficinas AS o ON o.id_oficina = ie.id_oficina_departamental JOIN org_linea_trabajo AS lt ON lt.id_linea_trabajo = ei.id_linea_trabajo GROUP BY m.id_mision_oficial ORDER BY m.fecha_solicitud, lt.linea_trabajo*/
                    $misiones = $this->db->query("
                        SELECT c.*, emp.nombre_empleado, emp.cargo_funcional, o.id_oficina, o.nombre_oficina, emp.linea_trabajo, emp.id_seccion FROM (SELECT m2.id_mision_oficial, m2.nr_empleado, CAST(m2.fecha_mision_inicio AS CHAR) AS fecha_mision_inicio, CAST(m2.fecha_mision_fin AS CHAR) AS fecha_mision_fin, m2.fecha_solicitud, m2.no_cheque, m2.pagado_en, sum(e2.pasaje) AS pasaje, sum(e2.viatico) AS viatico, sum(e2.alojamiento) AS alojamiento, 'viatico' AS tipo_solicitud FROM vyp_mision_oficial as m2 JOIN vyp_empresa_viatico AS e2 ON m2.id_mision_oficial = e2.id_mision AND m2.estado = '7' AND (MONTH(m2.fecha_solicitud) <= '".$mes_poliza."' AND YEAR(m2.fecha_solicitud) = '".$anio_poliza."') AND m2.id_mision_oficial NOT IN (SELECT id_mision FROM vyp_poliza WHERE tipo_solicitud = 'viatico') ".$addsql." GROUP BY m2.id_mision_oficial UNION SELECT mp.id_mision_pasajes AS id_mision_oficial, mp.nr AS nr_empleado, mp.fechas_pasajes AS fecha_mision_inicio, mp.fechas_pasajes AS fecha_mision_fin, mp.fecha_solicitud_pasaje AS fecha_solicitud, '' AS no_cheque, 'banco' AS pagado_en, SUM(ps.monto_pasaje) AS pasaje, '0.00' AS viatico, '0.00' AS alojamiento, 'pasaje' AS tipo_solicitud FROM vyp_mision_pasajes AS mp JOIN vyp_pasajes AS ps ON mp.mes_pasaje = MONTH(ps.fecha_mision) AND mp.anio_pasaje = YEAR(ps.fecha_mision) AND mp.estado = '7' AND ps.nr = mp.nr AND (MONTH(mp.fecha_solicitud_pasaje) <= '".$mes_poliza."' AND YEAR(mp.fecha_solicitud_pasaje) = '".$anio_poliza."') AND mp.id_mision_pasajes NOT IN (SELECT id_mision FROM vyp_poliza WHERE tipo_solicitud = 'pasaje')) AS c JOIN lista_empleados_estado emp ON emp.nr_empleado = c.nr_empleado JOIN vyp_informacion_empleado AS ie ON ie.nr = c.nr_empleado JOIN vyp_oficinas AS o ON o.id_oficina = ie.id_oficina_departamental ORDER BY c.fecha_solicitud, emp.linea_trabajo");

                }

                $correlativo = 0;
                $correlativo2 = 0;
                $total_pasaje = 0;
                $total_viatico = 0;
                $otra_tabla = "";

                $bandera = true;

                $contador_restante = 0;

                if($misiones->num_rows() > 0){
                    foreach ($misiones->result() as $fila) {

                        $seccion_empleado = $this->db->query("SELECT * FROM org_seccion WHERE id_seccion = '".$fila->id_seccion."'");

                        $seccion = "";
                        if($seccion_empleado->num_rows() > 0){
                            foreach ($seccion_empleado->result() as $filas) {
                                $seccion = $filas->nombre_seccion;
                            }
                        }

                         $oficinac = $this->db->query("SELECT * FROM vyp_oficinas WHERE nombre_oficina LIKE '%san salvador%'");

                        $oficina_central = "";
                        if($oficinac->num_rows() > 0){
                            foreach ($oficinac->result() as $filao) {
                                $oficina_central = $filao->id_oficina;
                            }
                        }

                        


                        $prelimite = floatval(($total_viatico+$total_pasaje)+floatval($fila->pasaje)+floatval($fila->viatico)+floatval($fila->alojamiento));

                        if($fila->tipo_solicitud == "pasaje"){
                            $panio = substr($fila->fecha_mision_inicio,-5,-1);
                            $pmes = mes(substr($fila->fecha_mision_inicio,-8,-6));
                            $visitados = "PASAJE AL INTERIOR DEL MES DE ".$pmes." ".$panio;
                        }else if($fila->tipo_solicitud == "viatico"){
                            $visitados = $fila->nombre_oficina." - ";

                            $visitas = $this->db->query("SELECT e.*, d.*, m.*FROM vyp_empresas_visitadas AS e JOIN org_departamento AS d ON d.id_departamento = e.id_departamento AND e.id_mision_oficial = '".$fila->id_mision_oficial."' JOIN org_municipio AS m ON m.id_municipio = e.id_municipio");
                            if($visitas->num_rows() > 0){
                                foreach ($visitas->result() as $filav) {
                                    if($filav->tipo_destino == "destino_oficina"){
                                        $visitados .= "Oficina ".$filav->municipio.", ".$filav->departamento.". <br>";
                                    }else{
                                        $visitados .= $filav->municipio.", ".$filav->departamento.". <br>"; 
                                    }
                                    
                                }
                            }

                            if(floatval($fila->pasaje) > 0){
                                $visitados .= "PASAJE AL INTERIOR <br>";
                            }

                            if($fila->fecha_mision_inicio != $fila->fecha_mision_fin && floatval($fila->alojamiento) == 0){
                                $visitados .= "PERMANENCIA <br>";
                            }

                            if(floatval($fila->alojamiento) > 0){
                                $visitados .= "ALOJAMIENTO <br>";
                            }
                        }

                        if($prelimite > $limite_poliza){
                            $bandera = false;
                        }

                        if($bandera){
                        $correlativo++;
                    	$total_pasaje += floatval($fila->pasaje);
                    	$total_viatico += floatval($fila->viatico)+floatval($fila->alojamiento);

                      	echo "<tr align='center'>";
                        ?>
            			<td style="padding: 7px;"><?php echo $correlativo; ?>
                        </td>
		            	<td style="padding: 7px;"><?php echo $num_poliza; ?>
                            <input type="hidden" value="<?php echo $fila->id_mision_oficial; ?>">
                            <input type="hidden" value="<?php echo $fila->tipo_solicitud; ?>">
                        </td>
		            	<td style="padding: 7px;"><?php echo $mes_texto; ?></td>
                        <td style="padding: 7px;"><?php echo date("Y-m-d",strtotime($fila->fecha_solicitud)); ?></td>

                        <?php if($fila->pagado_en == "efectivo"){ ?>
                        <td style="padding: 7px;">EFECTIVO</td>
                        <?php }else if($fila->pagado_en == "banco"){ ?>
                        <td style="padding: 7px;">N/C</td>
                        <?php }else{ ?>
                        <td style="padding: 7px;"><?php echo $fila->no_cheque; ?></td>
                        <?php } ?>

                        <td style="padding: 7px;"><?php echo $fila->nr_empleado; ?></td>
                        <td style="padding: 7px;">
                            <?php if($fila->fecha_mision_inicio == $fila->fecha_mision_fin){
                                    if($fila->tipo_solicitud == "pasaje"){
                                        echo substr($fila->fecha_mision_fin, 0, -1);
                                    }else{
                                        echo date("d-m-Y", strtotime($fila->fecha_mision_fin)); 
                                    }
                                }else{
                                    echo date("d-m-Y", strtotime($fila->fecha_mision_inicio))." - ".date("d-m-Y", strtotime($fila->fecha_mision_fin));
                                } 
                            ?>
                        </td>
                        <td style="padding: 7px;"><?php echo trim($fila->nombre_empleado); ?></td>
                        <td style="padding: 7px;"><?php echo $visitados; ?></td>
                        <?php if($oficina_central == $fila->id_oficina){ ?>
                        <td style="padding: 7px;"><?php echo $seccion; ?></td>
                        <?php }else{ ?>
                        <td style="padding: 7px;"><?php echo $fila->nombre_oficina; ?></td>
                        <?php } ?>
                        <td style="padding: 7px;"><?php echo $fila->cargo_funcional; ?></td>
                        <td style="padding: 7px;"><?php echo $fila->linea_trabajo; ?></td>
                        <!-- <td style="padding: 7px;"><?php echo "54401"; ?></td> -->
                        <td align="right" style="padding: 7px;">
                            <?php echo "$ ".number_format(floatval($fila->pasaje),2); ?>
                            <input type="hidden" value="<?php echo number_format(floatval($fila->pasaje),2); ?>">
                        </td>
                        <!-- <td style="padding: 7px;"><?php echo "54402"; ?></td> -->

                        <td style="padding: 7px;" align="right" style="padding: 7px;">
                            <?php echo "$ ".number_format(floatval($fila->viatico)+floatval($fila->alojamiento),2); ?>
                            <input type="hidden" value="<?php echo number_format(floatval($fila->viatico)+floatval($fila->alojamiento),2); ?>">
                        </td>

                        <td style="padding: 7px;" align="right" style="padding: 7px;"><?php echo "$ ".number_format(floatval($fila->viatico)+floatval($fila->alojamiento)+floatval($fila->pasaje),2); ?>
                            <input type="hidden" value="<?php echo number_format(floatval($fila->viatico)+floatval($fila->alojamiento)+floatval($fila->pasaje),2); ?>">
                        </td>
                        <?php

                      	echo "</tr>";

                        }else{
                            $correlativo2++;
                            $contador_restante++;

                            $otra_tabla .= "<tr>";
                            $otra_tabla .= '<td style="padding: 7px;">'.$correlativo2.'</td>';
                            $otra_tabla .= '<td style="padding: 7px;">'.date("Y-m-d",strtotime($fila->fecha_solicitud)).'</td>';
                            if($fila->pagado_en == "efectivo"){
                                $otra_tabla .= '<td style="padding: 7px;">EFECTIVO</td>'; //cheque o N/C
                            }else if($fila->pagado_en == "banco"){
                                $otra_tabla .= '<td style="padding: 7px;">N/C</td>'; //cheque o N/C
                            }else{
                                $otra_tabla .= '<td style="padding: 7px;">'.$fila->no_cheque.'</td>'; //cheque o N/C
                            }
                            $otra_tabla .= '<td style="padding: 7px;">'.$fila->nr_empleado.'</td>';

                            if($fila->fecha_mision_inicio == $fila->fecha_mision_fin){
                                if($fila->tipo_solicitud == "pasaje"){ 
                                    $otra_tabla .= '<td style="padding: 7px;">'.substr($fila->fecha_mision_fin, 0, -1).'</td>';
                                }else{
                                    $otra_tabla .= '<td style="padding: 7px;">'.date("d-m-Y", strtotime($fila->fecha_mision_fin)).'</td>';
                                }
                            }else{
                                $otra_tabla .= '<td style="padding: 7px;">'.date("d-m-Y", strtotime($fila->fecha_mision_inicio))." - ".date("d-m-Y", strtotime($fila->fecha_mision_fin)).'</td>';
                            }

                            $otra_tabla .= '<td style="padding: 7px;">'.trim($fila->nombre_empleado).'</td>';
                            $otra_tabla .= '<td style="padding: 7px;">'.$visitados.'</td>';
                            if($oficina_central == $fila->id_oficina){ 
                                $otra_tabla .= '<td style="padding: 7px;">'.$seccion.'</td>';
                            }else{
                                $otra_tabla .= '<td style="padding: 7px;">'.$fila->nombre_oficina.'</td>';
                            }
                            $otra_tabla .= '<td style="padding: 7px;">'.$fila->cargo_funcional.'</td>';
                            $otra_tabla .= '<td style="padding: 7px;">'.$fila->linea_trabajo.'</td>';
                            $otra_tabla .= '<td align="right" style="padding: 7px;">'."$ ".number_format(floatval($fila->pasaje),2).'</td>';
                            $otra_tabla .= '<td align="right" style="padding: 7px;">'."$ ".number_format(floatval($fila->viatico)+floatval($fila->alojamiento),2).'</td>';
                            $otra_tabla .= '<td align="right" style="padding: 7px;">'."$ ".number_format(floatval($fila->viatico)+floatval($fila->alojamiento)+floatval($fila->pasaje),2).'</td>';
                            $otra_tabla .= '</tr>';

                        }

                    }
?>
					<tr style="font-weight: 500; font-size: 11px;">
						<td style="padding: 7px;" colspan="12" align="center"> TOTAL </td>
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

<div align="right">
    <button type="button" onclick="recorrer_poliza();" class="btn btn-info">Generar póliza</button>
</div>

  	<input type="hidden" id="total" value="<?php echo number_format(($monto), 2, '.', ''); ?>">
  	<input type="hidden" id="total_texto" value="<?php echo $formato_dinero." DOLARES"; ?>">
    <input type="hidden" id="no_poliza" value="<?php echo $ult_poliza; ?>"/>
    <input type="hidden" id="restantes" value="<?php echo $contador_restante; ?>"/>
    <input type="hidden" id="filas_tabla" class="form-control" value="<?php echo base64_encode($otra_tabla); ?>">

</div>

