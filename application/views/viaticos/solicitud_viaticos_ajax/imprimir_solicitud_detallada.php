<?php

$user = $this->session->userdata('usuario_viatico');
$nr_sql = $this->db->query("SELECT * FROM org_usuario WHERE usuario = '".$user."' LIMIT 1");
$nr_user = ""; $name_user = "";
if($nr_sql->num_rows() > 0){
    foreach ($nr_sql->result() as $filauser) {  $nr_user = $filauser->nr; $name_user = $filauser->nombre_completo;  }
}
$id_mision = $_GET["id_mision"];
$empresa_viatico = $this->db->query("SELECT * FROM vyp_empresa_viatico WHERE id_mision = '".$id_mision."' ORDER BY fecha, hora_salida");
$viaticos = 0.00; $pasajes = 0.00; $alojamiento = 0.00; $registros = count($empresa_viatico->result());
if($empresa_viatico->num_rows() > 0){
    foreach ($empresa_viatico->result() as $fila) { $viaticos += $fila->viatico; $pasajes += $fila->pasaje; $alojamiento += $fila->alojamiento; }
}
$monto = number_format(($pasajes+$viaticos+$alojamiento), 2, '.', '');
$decs = str_pad((number_format(($monto-intval($monto)), 2, '.', '')*100), 2, "0", STR_PAD_LEFT);
if($decs == 0){ $decs = "00"; }
$formato_dinero = NumeroALetras::convertir($monto)." ".$decs."/100";

function mes($mes){$mesesarray = array('ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE');return strtolower($mesesarray[($mes-1)]); }
  
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

/*********************************************************************************************************
                INICIO DEL REPORTE - SOLICITUD DE VIÁTICOS
*********************************************************************************************************/

$pdf=new FPDF();
$pdf->cambiarTitulo('San Salvador, El Salvador, C.A.','POR $   '.$monto);

$fecha_actual = date("d-m-Y H:i:s");
$pdf->cambiarPie($name_user, $fecha_actual);

$pdf->SetFont('Arial','',9);

$pdf->AddPage();
$pdf->MultiCell(195,5,'Recibí del Fondo Circunte del Monto Fijo del Ministerio de Trabajo y Previsión Social, la candidad de '.$formato_dinero.' Dólares en concepto de viáticos y pasaje la interior, el nombre y dirección de las empresas visitadas son las siguientes:',0,'J',false);

$pdf->Ln(3);

$empresas_visitadas = $this->db->query("SELECT * FROM vyp_empresas_visitadas WHERE id_mision_oficial = '".$id_mision."'");

if($empresas_visitadas->num_rows() > 0){
    foreach ($empresas_visitadas->result() as $filae) {
        $registros--;
        if($registros > 0){
            $pdf->Cell(195,5,"        * ".$filae->nombre_empresa.". Dirección: ".$filae->direccion_empresa,0,'J',false);
            $pdf->Ln(5);
        }
    }
}

$pdf->Ln(3);

$pdf->SetWidths(array(22,89,20,20,13,13,13));
$pdf->SetAligns(array('C','C','C','C','C','C','C'));
$pdf->Row(array("Fecha misión","Lugar de salida y llegada","Hora salida","Hora llegada","Viático","Pasaje","Alojam."),
array('1','1','1','1','1','1','1','1'),
array('Arial','','08'),
array(false),
array('0','0','0'),
array('255','255','255'),
$altura = 5);  


            $pdf->SetAligns(array('L','L','C','C','R','R','R'));


            $mision = $this->db->query("SELECT m.*, a.nombre_vyp_actividades AS actividad FROM vyp_mision_oficial AS m JOIN vyp_actividades AS a ON m.id_actividad_realizada = a.id_vyp_actividades AND m.id_mision_oficial = '".$id_mision."'");
	        if($mision->num_rows() > 0){
	            foreach ($mision->result() as $filam) { 
	            	$nr_usuario = $filam->nr_empleado;
	            	$fec_inicio = $filam->fecha_mision_inicio;
	            	$fec_fin = $filam->fecha_mision_fin;
	            }
	        }


	        $datetime1 = date_create($fec_inicio);
			$datetime2 = date_create($fec_fin);
			$interval = date_diff($datetime1, $datetime2);
			$diferencia = $interval->format('%a');
			$nuevafecha = strtotime($fec_inicio);
			$tviaticos = 0;
			$contador = 0; $nombre_anterior = "";

			if($diferencia > 0){

	            for($h=0; $h <= $diferencia; $h++){
					$nuevafecha = date ( 'Y-m-j' , $nuevafecha );

	                $mviatico = $this->db->query("SELECT SUM(h.monto) AS monto, hv.id_ruta_visitada FROM vyp_horario_viatico_solicitud AS hv JOIN vyp_horario_viatico AS h ON h.id_horario_viatico = hv.id_horario_viatico AND hv.id_mision = '".$id_mision."' AND hv.fecha_ruta = '".date("Y-m-d",strtotime($nuevafecha))."' GROUP BY hv.id_ruta_visitada");
			        if($mviatico->num_rows() > 0){
			        	$fecha_mision = date("d/m/Y",strtotime($nuevafecha));
			            foreach ($mviatico->result() as $filav) {
			            	$contador++;
			            	$tviaticos = $filav->monto;

			            	if($contador == 1){
			            		$empresa_viatico = $this->db->query("SELECT * FROM vyp_empresa_viatico WHERE id_mision = '".$id_mision."' AND fecha = '".date("Y-m-d",strtotime($nuevafecha))."' ORDER BY fecha, hora_salida LIMIT 1");
			            	}else{
			            		$empresa_viatico = $this->db->query("SELECT * FROM vyp_empresa_viatico WHERE id_mision = '".$id_mision."' AND id_empresa_viatico = '".$filav->id_ruta_visitada."' AND fecha = '".date("Y-m-d",strtotime($nuevafecha))."' ORDER BY fecha, hora_salida");
			            	}

				            if($empresa_viatico->num_rows() > 0){
				                foreach ($empresa_viatico->result() as $fila) {
				                	$ruta = $fila->nombre_origen." - ".$fila->nombre_destino;
				                	$hsalida = date("h:i A",strtotime(date("Y-m-d")." ".$fila->hora_salida));
		                            $hllegada = date("h:i A",strtotime(date("Y-m-d")." ".$fila->hora_llegada));
		                            $tpasaje = intval($fila->pasaje);
		                            $nombre_anterior = $fila->nombre_destino;
				                }
				            }else{
				            	$ruta = "PERMANENCIA: ".$nombre_anterior;
				                $hsalida = " - ";
		                        $hllegada = " - ";
		                        $tpasaje = 0;
				            }

				            $alojamientosql = $this->db->query("SELECT * FROM vyp_alojamientos WHERE id_mision = '".$id_mision."' AND id_ruta_visitada = '".$filav->id_ruta_visitada."' AND fecha_alojamiento = '".date("Y-m-d",strtotime($nuevafecha))."'");

				            if($alojamientosql->num_rows() > 0){
				                foreach ($alojamientosql->result() as $filaa) {
				                	$talojamiento = $filaa->monto;
				                }
				            }else{
				            	$talojamiento = 0;
				            }

				            if($tviaticos == 0){ $ver_viatico = ""; }else{ $ver_viatico = "$ ".number_format($tviaticos, 2, '.', ''); }
	                        if($tpasaje == 0){ $ver_pasaje = ""; }else{ $ver_pasaje = "$ ".number_format($fila->pasaje, 2, '.', ''); }
	                        if($talojamiento == 0){ $ver_alojamiento = ""; }else{ $ver_alojamiento = "$ ".number_format($talojamiento, 2, '.', ''); }

		                        $array = array(
		                            $fecha_mision,
		                            $ruta."        ",
		                            $hsalida,
		                            $hllegada,
		                            $ver_viatico,
		                            $ver_pasaje,
		                            $ver_alojamiento,
		                        );
		                    $pdf->Row($array,
		                        array('0','0','0','0','0','0','0'),
		                        array('Arial','B','08'),
		                        array(false),
		                        array('0','0','0'),
		                        array('255','255','255'),
		                        $altura = 3);

		                    /*$pdf->Row($array,
		                        array('0','0','0','0','0','0','0'),
		                        array('Arial','B','08'),
		                        array(false),
		                        array('0','0','0'),
		                        array('255','255','255'),
		                        $altura = 3, site_url()."/configuraciones/rutas/index/316",1);*/
			            }
			            $contador++;
			        }else{
		            	$tviaticos = 0;
		            	$fecha_mision = date("d/m/Y",strtotime($nuevafecha));

			            	$empresa_viatico = $this->db->query("SELECT * FROM vyp_empresa_viatico WHERE id_mision = '".$id_mision."' AND fecha = '".date("Y-m-d",strtotime($nuevafecha))."' ORDER BY fecha, hora_salida");

				            if($empresa_viatico->num_rows() > 0){
				                foreach ($empresa_viatico->result() as $fila) {
				                	$ruta = $fila->nombre_origen." - ".$fila->nombre_destino;
				                	$hsalida = date("h:i A",strtotime(date("Y-m-d")." ".$fila->hora_salida));
		                            $hllegada = date("h:i A",strtotime(date("Y-m-d")." ".$fila->hora_llegada));
		                            $tpasaje = intval($fila->pasaje);
		                            $nombre_anterior = $fila->nombre_destino;
				                }
				            }else{
				            	$ruta = "PERMANENCIA: ".$nombre_anterior;
				                $hsalida = " - ";
		                        $hllegada = " - ";
		                        $tpasaje = 0;
				            }

				            $alojamientosql = $this->db->query("SELECT monto FROM vyp_alojamientos WHERE id_mision = '".$id_mision."' AND fecha_alojamiento = '".date("Y-m-d",strtotime($nuevafecha))."'");

				            if($alojamientosql->num_rows() > 0){
				                foreach ($alojamientosql->result() as $filaa) {
				                	$talojamiento = $filaa->monto;
				                }
				            }else{
				            	$talojamiento = 0;
				            }

				            if($tviaticos == 0){ $ver_viatico = ""; }else{ $ver_viatico = "$ ".number_format($tviaticos, 2, '.', ''); }
	                        if($tpasaje == 0){ $ver_pasaje = ""; }else{ $ver_pasaje = "$ ".number_format($fila->tpasaje, 2, '.', ''); }
	                        if($talojamiento == 0){ $ver_alojamiento = ""; }else{ $ver_alojamiento = "$ ".number_format($talojamiento, 2, '.', ''); }

		                        $array = array(
		                            $fecha_mision,
		                            $ruta."        ",
		                            $hsalida,
		                            $hllegada,
		                            $ver_viatico,
		                            $ver_pasaje,
		                            $ver_alojamiento,
		                        );
		                    $pdf->Row($array,
		                        array('0','0','0','0','0','0','0'),
		                        array('Arial','B','08'),
		                        array(false),
		                        array('0','0','0'),
		                        array('255','255','255'),
		                        $altura = 3);
		                    $contador++;
		            }


	            	/*$empresa_viatico = $this->db->query("SELECT * FROM vyp_empresa_viatico WHERE id_mision = '".$id_mision."' AND fecha = '".date("Y-m-d",strtotime($nuevafecha))."' ORDER BY fecha, hora_salida");

		            if($empresa_viatico->num_rows() > 0){
		                foreach ($empresa_viatico->result() as $fila) {
		                    $fecha_mision = date("d/m/Y",strtotime($nuevafecha));

		                    	if($fila->viatico == 0){ $ver_viatico = ""; }else{ $ver_viatico = "$ ".number_format($fila->viatico-$tviaticos, 2, '.', ''); }
		                        if($fila->pasaje == 0){ $ver_pasaje = ""; }else{ $ver_pasaje = "$ ".number_format($fila->pasaje, 2, '.', ''); }
		                        if($fila->alojamiento == 0){ $ver_alojamiento = ""; }else{ $ver_alojamiento = "$ ".number_format($fila->alojamiento, 2, '.', ''); }

		                        $array = array(
		                            $fecha_mision,
		                            $fila->nombre_origen." - ".$fila->nombre_destino,
		                            date("h:i A",strtotime(date("Y-m-d")." ".$fila->hora_salida)),
		                            date("h:i A",strtotime(date("Y-m-d")." ".$fila->hora_llegada)),
		                            $ver_viatico,
		                            "$ 0.00",
		                            $ver_alojamiento,
		                        );
		                    $pdf->Row($array,
		                        array('0','0','0','0','0','0','0'),
		                        array('Arial','B','08'),
		                        array(false),
		                        array('0','0','0'),
		                        array('255','255','255'),
		                        $altura = 3, site_url()."/configuraciones/rutas/index/316",1);

		                    $tviaticos = 0;
		                }
		            }else{
		            	$fecha_mision = date("d/m/Y",strtotime($nuevafecha));


	                    if($tviaticos == 0){ $ver_viatico = ""; }else{ $ver_viatico = "$ ".number_format($tviaticos, 2, '.', ''); }
	                    if($fila->pasaje == 0){ $ver_pasaje = ""; }else{ $ver_pasaje = "$ ".number_format($fila->pasaje, 2, '.', ''); }
	                    if($fila->alojamiento == 0){ $ver_alojamiento = ""; }else{ $ver_alojamiento = "$ ".number_format($fila->alojamiento, 2, '.', ''); }

	                    $array = array(
	                        $fecha_mision,
	                        "PERMANENCIA EN: ".$fila->nombre_destino,
	                        "-",
	                        "-",
	                        $ver_viatico,
	                        $ver_pasaje,
	                        $ver_alojamiento,
	                    );

	                    $pdf->Row($array,
	                        array('0','0','0','0','0','0','0'),
	                        array('Arial','B','08'),
	                        array(false),
	                        array('0','0','0'),
	                        array('255','255','255'),
	                        $altura = 3, site_url()."/configuraciones/rutas/index/316",1);
		            }*/

		            $nuevafecha = strtotime ( '+1 day' , strtotime ( $nuevafecha ) ) ;
	            }

	        }else{
	        	if($empresa_viatico->num_rows() > 0){
	                foreach ($empresa_viatico->result() as $fila) {
	                    $fecha_mision = date("d/m/Y",strtotime($fila->fecha));

	                        if($fila->viatico == 0){ $ver_viatico = ""; }else{ $ver_viatico = "$ ".number_format($fila->viatico, 2, '.', ''); }
	                        if($fila->pasaje == 0){ $ver_pasaje = ""; }else{ $ver_pasaje = "$ ".number_format($fila->pasaje, 2, '.', ''); }
	                        if($fila->alojamiento == 0){ $ver_alojamiento = ""; }else{ $ver_alojamiento = "$ ".number_format($fila->alojamiento, 2, '.', ''); }

	                        $array = array(
	                            $fecha_mision,
	                            $fila->nombre_origen." - ".$fila->nombre_destino."        ",
	                            date("h:i A",strtotime(date("Y-m-d")." ".$fila->hora_salida)),
	                            date("h:i A",strtotime(date("Y-m-d")." ".$fila->hora_llegada)),
	                            $ver_viatico,
	                            $ver_pasaje,
	                            $ver_alojamiento,
	                        );
	                    $pdf->Row($array,
	                        array('0','0','0','0','0','0','0'),
	                        array('Arial','B','08'),
	                        array(false),
	                        array('0','0','0'),
	                        array('255','255','255'),
	                        $altura = 3); 
	                }
	            }
	        }

        //$pdf->Text($pdf->GetX(),$pdf->GetY(),"_________________________________________________________________________________________________________________________",0,'C', 0);

        //$pdf->Rect($pdf->GetX(), $pdf->GetY(), $pdf->GetX()+180, 5, 'D');

        $pdf->Ln(0);
        $pdf->SetWidths(array(151,13,13,13));
        $pdf->SetAligns(array('C','R','R','R'));

        $pdf->Row(
            array("TOTAL", "$ ".number_format($viaticos, 2, '.', ''),
            "$ ".number_format($pasajes, 2, '.', ''),
            "$ ".number_format($alojamiento, 2, '.', '')),
            array('1','1','1','1'),
            array('Arial','B','08'),
            array(false),
            array('0','0','0'),
            array('255','255','255'),
            $altura = 5);

        //$pdf->Text($pdf->GetX(),$pdf->GetY(),"_________________________________________________________________________________________________________________________",0,'C', 0);


        

        $oficina_empleado = $this->db->query("SELECT m.municipio FROM vyp_oficinas AS o JOIN vyp_informacion_empleado AS i ON o.id_oficina = i.id_oficina_departamental JOIN org_municipio As m ON m.id_municipio = o.id_municipio AND i.nr = '".$nr_usuario."'");
        if($oficina_empleado->num_rows() > 0){
            foreach ($oficina_empleado->result() as $fila3) { $oficina_origen = nombres($fila3->municipio); }
        }

        $pdf->Ln(5);
        $pdf->SetFont('Arial','',8);
        $pdf->Text($pdf->GetX(),$pdf->GetY(),"Lugar y Fecha: ".$oficina_origen.", ".date("d", strtotime($filam->fecha_solicitud))." de ".mes(date("m", strtotime($filam->fecha_solicitud)))." de ".date("Y", strtotime($filam->fecha_solicitud)),0,'C', 0);


    $empleado = $this->db->query("SELECT eil.*, e.id_empleado, e.telefono_contacto, UPPER(CONCAT_WS(' ', e.primer_nombre, e.segundo_nombre, e.tercer_nombre, e.primer_apellido, e.segundo_apellido, e.apellido_casada)) AS nombre_completo FROM sir_empleado AS e INNER JOIN sir_empleado_informacion_laboral AS eil ON e.id_empleado = eil.id_empleado AND e.nr = '".$nr_usuario."' ORDER BY eil.fecha_inicio DESC LIMIT 1");

    if($empleado->num_rows() > 0){
        foreach ($empleado->result() as $filae) {              
        }
    }

    $linea_trabajo = $this->db->query("SELECT * FROM org_linea_trabajo WHERE id_linea_trabajo = '".$filae->id_linea_trabajo."'");
    $cargo_nominal = $this->db->query("SELECT * FROM sir_cargo_nominal WHERE id_cargo_nominal = '".$filae->id_cargo_nominal."'");
    $cargo_funcional = $this->db->query("SELECT * FROM sir_cargo_funcional WHERE id_cargo_funcional = '".$filae->id_cargo_funcional."'");

    if($linea_trabajo->num_rows() > 0){
        foreach ($linea_trabajo->result() as $filalt) {              
        }
    }
    if($cargo_nominal->num_rows() > 0){
        foreach ($cargo_nominal->result() as $filacn) {              
        }
    }
    if($cargo_funcional->num_rows() > 0){
        foreach ($cargo_funcional->result() as $filacf) {              
        }
    }

    $cuenta = $this->db->query("SELECT c.*, b.nombre FROM vyp_empleado_cuenta_banco AS c JOIN vyp_bancos AS b ON b.id_banco = c.id_banco WHERE estado = 1");

    if($cuenta->num_rows() > 0){
        foreach ($cuenta->result() as $filac) {}
    }

        $pdf->Image(base_url()."assets/firmas/".$nr_usuario.".png" , 130,$pdf->GetY()-3, 40 , 15,'PNG');

        $pdf->Ln(7);
        $pdf->SetWidths(array(100,90));
        $pdf->SetAligns(array('L','L'));

        $pdf->Row(array("Nombre: ".nombres($filae->nombre_completo), "Firma: _____________________________________"),
            array('0','0','0'),
            array('Arial','','08'),
            array(false),
            array('0','0','0'),
            array('255','255','255'),
            $altura = 5);

        $pdf->Row(array("Cargo nominal: ".parrafo($filacn->cargo_nominal), "                              Recibido conforme"),
            array('0','0','0'),
            array('Arial','','08'),
            array(false),
            array('0','0','0'),
            array('255','255','255'),
            $altura = 5);

        $pdf->Row(array("Cargo funcional: ".parrafo($filacf->funcional), "Código: ".$nr_usuario."            Sueldo:   $".number_format($filae->salario, 2, '.', '')),
            array('0','0','0'),
            array('Arial','','08'),
            array(false),
            array('0','0','0'),
            array('255','255','255'),
            $altura = 5);

        $pdf->Row(array("Nombre del banco: ".parrafo($filac->nombre), "Unidad Pres. / Línea de Trabajo: ".$filalt->linea_trabajo),
            array('0','0','0'),
            array('Arial','','08'),
            array(false),
            array('0','0','0'),
            array('255','255','255'),
            $altura = 5);

        $pdf->Row(array("Cuenta del banco No: ".$filac->numero_cuenta, "Teléfono oficial: ".$filae->telefono_contacto),
            array('0','0','0'),
            array('Arial','','08'),
            array(false),
            array('0','0','0'),
            array('255','255','255'),
            $altura = 5);

        $pdf->Ln(5);

        $pdf->SetFont('Arial','B',8);
        $pdf->MultiCell(190,5,'USO DEL FONDO CIRCULANTE',0,'C',false);


        $pdf->Ln(1);
        if($filam->pagado_en == "cheque"){
        	$no_cheque = $filam->no_cheque;
        }else{
        	$no_cheque = "______________________________";
        }

        if($filam->fecha_pago != "0000-00-00 00:00:00"){
        	$fecha_pago = date("d/m/Y", strtotime($filam->fecha_pago));
        }else{
        	$fecha_pago = "______________________________";
        }

        $pdf->Row(array("CANCELADO C/CHEQUE N°: ".$no_cheque, "FECHA DE PAGO: ".$fecha_pago),
            array('0','0','0'),
            array('Arial','','08'),
            array(false),
            array('0','0','0'),
            array('255','255','255'),
            $altura = 5);


        $pdf->Ln(3);
        $pdf->SetWidths(array(142,13,13,13));
        $pdf->SetAligns(array('C','R','R','R'));

        $pdf->Rect($pdf->GetX(), $pdf->GetY(), $pdf->GetX()+180, 52, 'D');

        $pdf->SetFont('Arial','B',8);
        $pdf->MultiCell(190,5,'USO EXCLUSIVO DE AUTORIZACIÓN DE PAGO',0,'C',false);
        $pdf->SetFont('Arial','',8);
        $pdf->Ln(2);
        $pdf->MultiCell(190,5,'HAGO CONSTAR: '.nombres($filae->nombre_completo),0,'L',false);
        $pdf->MultiCell(190,5,'ACTIVIDAD REALIZADA: '.$filam->actividad,0,'L',false);
        $pdf->MultiCell(190,5,'DETALLE DE LA ACTIVIDAD: '.$filam->detalle_actividad,0,'L',false);
        $pdf->Ln(5);

        $jfinmediato = $this->db->query("SELECT e.nr, UPPER(CONCAT_WS(' ', e.primer_nombre, e.segundo_nombre, e.tercer_nombre, e.primer_apellido, e.segundo_apellido, e.apellido_casada)) AS nombre_completo FROM sir_empleado AS e JOIN vyp_mision_oficial AS m ON e.nr = m.nr_jefe_inmediato AND m.id_mision_oficial = '".$id_mision."'");

        if($jfinmediato->num_rows() > 0){
            foreach ($jfinmediato->result() as $filajf) {              
            }
        }

        $jfregional = $this->db->query("SELECT e.nr, UPPER(CONCAT_WS(' ', e.primer_nombre, e.segundo_nombre, e.tercer_nombre, e.primer_apellido, e.segundo_apellido, e.apellido_casada)) AS nombre_completo FROM sir_empleado AS e JOIN vyp_mision_oficial AS m ON e.nr = m.nr_jefe_regional AND m.id_mision_oficial = '".$id_mision."'");

        if($jfregional->num_rows() > 0){
            foreach ($jfregional->result() as $filajr) {              
            }
        }


        if(intval($filam->estado) > 2){
            $pdf->Image(base_url()."assets/firmas/".$filajf->nr.".png" , 45,$pdf->GetY()-3, 40 , 15,'PNG', base_url()."assets/firmas/".$filajf->nr.".png");
        }
        if(intval($filam->estado) > 4){
            $pdf->Image(base_url()."assets/firmas/".$filajr->nr.".png" , 140,$pdf->GetY()-3, 40 , 15,'PNG', base_url()."assets/firmas/".$filajr->nr.".png");
        }

        $pdf->Ln(7);
        $pdf->SetWidths(array(95,95));
        $pdf->SetAligns(array('C','C'));

        $pdf->Row(array("Firma y sello: ______________________________________", "Firma y sello: ______________________________________"),
            array('0','0','0'),
            array('Arial','','09'),
            array(false),
            array('0','0','0'),
            array('255','255','255'),
            $altura = 5);

        $pdf->Row(array("Nombre: ".nombres($filajf->nombre_completo), "Nombre: ".nombres($filajr->nombre_completo)),
            array('0','0','0'),
            array('Arial','','09'),
            array(false),
            array('0','0','0'),
            array('255','255','255'),
            $altura = 5);

        $pdf->Row(array("Vo.Bo. Jefe Inmediato", "Autorizado Director de Área o Jefe de Regional"),
            array('0','0','0'),
            array('Arial','','09'),
            array(false),
            array('0','0','0'),
            array('255','255','255'),
            $altura = 5);


$pdf->Output($id_mision.'_solicitudViatico_'.$nr_usuario.".pdf",'I');
?>