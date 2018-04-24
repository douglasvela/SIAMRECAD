
<?php 
$user = $this->session->userdata('usuario_viatico');

    $nr_sql = $this->db->query("SELECT * FROM org_usuario WHERE usuario = '".$user."' LIMIT 1");
    $nr_user = ""; $name_user = "";
    if($nr_sql->num_rows() > 0){
        foreach ($nr_sql->result() as $filauser) { 
            $nr_user = $filauser->nr;
            $name_user = $filauser->nombre_completo; 
        }
    }

    $nr_empleado = $_GET["nr"];
   $fecha_mes = $_GET["fecha2"];
  $id_mision_pasajes = $_GET["id"];
  
 list($otrafecha)= explode ("-",$fecha_mes); 
list($mes, $anio)= explode ("-",$fecha_mes); 

/*$fecha_imp = explode("-", $fecha_mes);
echo $fecha_imp[1];
echo $fecha_imp[0];
*/


$soli_pasaje = $this->db->query("SELECT sum(monto_pasaje) as monto_pasaje, fecha_mision  FROM vyp_pasajes WHERE nr = '".$nr_empleado."' AND fecha_mision LIKE '%".$otrafecha."%'  GROUP BY nr ORDER BY fecha_mision");
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
//$date=strtotime($fecha_mes);
//$arrayfecha=explode ("-",$fecha_mes);
//$mes_pasaje=$arrayfecha[0];
list($mes_pasaje, $anio_pasaje)= explode ("-",$fecha_mes,2);
$pdf=new FPDF();
$pdf->cambiarTitulo('RECIBO DE PASAJES URBANO Y AL INTERIOR','POR $   '.$monto);
$fecha_actual = date("d-m-Y H:i:s");
$pdf->cambiarPie($name_user, $fecha_actual);
//$this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
$pdf->AddPage();
$pdf->MultiCell(195,5,'Recibí del Fondo Circunte del Monto Fijo del Ministerio de Trabajo y Previsión Social, la cantidad de '.$formato_dinero.' Dólares en concepto de pago de pasajes en transporte urbano y al interior del territorio nacional originado por Misiones Oficiales encomendadas a diferentes empresas, durante el mes de ' .mes($mes_pasaje).', según detalle anexo:',0,'J',false);
$pdf->Ln(5);
$pdf->SetWidths(array(22,20,45,89,13));
$pdf->SetAligns(array('C','C','C','C','C'));
$pdf->Row(array("Fecha","No.Exped.","Empresa visitada","Dirección","Valor"),
array('1','1','1','1','1'),
array('Arial','B','08'),
array(false),
array('0','0','0'),
array('255','255','255'),
$altura = 3);  
$pdf->SetAligns(array('C','C','C','C','C'));
 $cuenta = $this->db->query("SELECT * FROM vyp_pasajes where nr = '".$nr_empleado."' AND fecha_mision LIKE '%".$otrafecha."%' ORDER by fecha_mision");
 
    if($cuenta->num_rows() > 0){
                foreach ($cuenta->result() as $fila1) {
                 
                    $fila1->fecha_mision=date("d-m-Y",strtotime($fila1->fecha_mision));
                           $array = array( 
                             $fila1->fecha_mision,
                             $fila1->no_expediente,
                             $fila1->empresa_visitada,
                             $fila1->direccion_empresa,
                             $fila1->monto_pasaje,
                                       );
                    $pdf->Row($array,
                        array('0','0','0','0','0'),
                        array('Arial','B','08'),
                        array(false),
                        array('0','0','0'),
                        array('255','255','255'),
                        $altura = 5); 
                }
            }
$pdf->Text($pdf->GetX(),$pdf->GetY(),"_________________________________________________________________________________________________________________________",0,'C', 0);
        
$pdf->Ln(2);
        $pdf->SetWidths(array(173,13,13,13));
        $pdf->SetAligns(array('C','R','R','R'));
        $pdf->Row(
            array("TOTAL", "$ ".number_format($monto, 2, '.', '')),
            array('0','0','0','0'),
            array('Arial','B','08'),
            array(false),
            array('0','0','0'),
            array('255','255','255'),
            $altura = 3);
        $pdf->Text($pdf->GetX(),$pdf->GetY(),"_________________________________________________________________________________________________________________________",0,'C', 0);
/*$lugar = $this->db->query("SELECT e.nombre_oficina, p.nr FROM vyp_oficinas AS e JOIN vyp_informacion_empleado AS p ON e.id_oficina = p.id_oficina_departamental GROUP BY p.nr");
if($lugar->num_rows() > 0){
    //echo($cuenta);
    foreach ($lugar->result() as $filal) {
       
       $oficina=$filal->nombre_oficina;
     
   }
}
$pdf->Ln(10);
 $pdf->Text($pdf->GetX(),$pdf->GetY(),"Lugar y Fecha de elaboracion: ".$oficina.", ".date("d")." de ".mes(date("m"))." de ".date("Y"),0,'C', 0);*/

 $mision = $this->db->query("SELECT * FROM vyp_mision_pasajes where nr='".$nr_empleado."' AND mes_pasaje='".$mes."' AND anio_pasaje= '".$anio."' AND id_mision_pasajes= '".$id_mision_pasajes."'");
        if($mision->num_rows() > 0){
            foreach ($mision->result() as $fila2) { $nr_usuario = $fila2->nr;
             }
        

}

 $oficina_empleado = $this->db->query("SELECT m.municipio FROM vyp_oficinas AS o JOIN vyp_informacion_empleado AS i ON o.id_oficina = i.id_oficina_departamental JOIN org_municipio As m ON m.id_municipio = o.id_municipio AND i.nr = '".$nr_empleado."'");
        if($oficina_empleado->num_rows() > 0){
            foreach ($oficina_empleado->result() as $fila3) { $oficina_origen = nombres($fila3->municipio); }
        }

/*if($lugar->num_rows() > 0){
    //echo($cuenta);
    foreach ($lugar->result() as $filal) {
       
       $oficina=$filal->nombre_oficina;
     
   }
}*/

$pdf->Ln(10);

 $pdf->Text($pdf->GetX(),$pdf->GetY(),"Lugar y Fecha: ".$oficina_origen.", ".date("d")." de ".mes(date("m"))." de ".date("Y"),0,'C', 0);
 
 $empleado = $this->db->query("SELECT eil.*, e.id_empleado, e.telefono_contacto, UPPER(CONCAT_WS(' ', e.primer_nombre, e.segundo_nombre, e.tercer_nombre, e.primer_apellido, e.segundo_apellido, e.apellido_casada)) AS nombre_completo FROM sir_empleado AS e INNER JOIN sir_empleado_informacion_laboral AS eil ON e.id_empleado = eil.id_empleado AND e.nr = '".$nr_empleado."' ORDER BY eil.fecha_inicio DESC LIMIT 1");
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
         $pdf->Image(base_url()."assets/firmas/".$nr_empleado.".png" , 130,$pdf->GetY()-3, 40 , 15,'PNG');

        $pdf->Ln(7);
        $pdf->SetWidths(array(100,90));
        $pdf->SetAligns(array('L','L'));

        $pdf->Row(array("Nombre: ".nombres($filae->nombre_completo), "Firma: _____________________________________"),
            array('0','0','0'),
            array('Arial','B','09'),
            array(false),
            array('0','0','0'),
            array('255','255','255'),
            $altura = 5);
        $pdf->Row(array("Cargo nominal: ".parrafo($filacn->cargo_nominal), "                              Recibido conforme"),
            array('0','0','0'),
            array('Arial','B','09'),
            array(false),
            array('0','0','0'),
            array('255','255','255'),
            $altura = 5);
        $pdf->Row(array("Cargo funcional: ".parrafo($filacf->funcional), "Código: ".$nr_empleado."            Sueldo:   $".number_format($filae->salario, 2, '.', '')),
            array('0','0','0'),
            array('Arial','B','09'),
            array(false),
            array('0','0','0'),
            array('255','255','255'),
            $altura = 5);
        $pdf->Row(array("Nombre del banco: ".parrafo($filac->nombre), "Unidad Pres. / Línea de Trabajo: ".$filalt->linea_trabajo),
            array('0','0','0'),
            array('Arial','B','09'),
            array(false),
            array('0','0','0'),
            array('255','255','255'),
            $altura = 5);
        $pdf->Row(array("Cuenta del banco No: ".$filac->numero_cuenta, "Teléfono oficial: ".$filae->telefono_contacto),
            array('0','0','0'),
            array('Arial','B','09'),
            array(false),
            array('0','0','0'),
            array('255','255','255'),
            $altura = 5);
        $pdf->Ln(10);
        $pdf->SetWidths(array(142,13,13,13));
        $pdf->SetAligns(array('C','R','R','R'));
        

 $pdf->Ln(10);
        $pdf->SetWidths(array(142,13,13,13));
        $pdf->SetAligns(array('C','R','R','R'));

        $pdf->Rect($pdf->GetX(), $pdf->GetY(), $pdf->GetX()+180, 50, 'D');

        $pdf->MultiCell(190,5,'USO EXCLUSIVO DE AUTORIZACIÓN DE PAGO',0,'C',false);
        $pdf->Ln(5);
        /*$pdf->MultiCell(190,5,'HAGO CONSTAR: '.nombres($filae->nombre_completo),0,'L',false);
        $pdf->MultiCell(190,5,'ACTIVIDAD REALIZADA: '.$fila2->actividad,0,'L',false);
        $pdf->MultiCell(190,5,'DETALLE DE LA ACTIVIDAD: '.$fila2->detalle_actividad,0,'L',false);
        $pdf->Ln(5);*/

        $jfinmediato = $this->db->query("SELECT e.nr, UPPER(CONCAT_WS(' ', e.primer_nombre, e.segundo_nombre, e.tercer_nombre, e.primer_apellido, e.segundo_apellido, e.apellido_casada)) AS nombre_completo, m.id_mision_pasajes FROM sir_empleado AS e JOIN vyp_mision_pasajes AS m ON e.nr = m.nr_jefe_inmediato AND m.id_mision_pasajes= '".$id_mision_pasajes."' ");

        if($jfinmediato->num_rows() > 0){
            foreach ($jfinmediato->result() as $filajf) {              
            }
        }

        $jfregional = $this->db->query("SELECT e.nr, UPPER(CONCAT_WS(' ', e.primer_nombre, e.segundo_nombre, e.tercer_nombre, e.primer_apellido, e.segundo_apellido, e.apellido_casada)) AS nombre_completo, m.id_mision_pasajes FROM sir_empleado AS e JOIN vyp_mision_pasajes AS m ON e.nr = m.nr_jefe_regional AND m.id_mision_pasajes= '".$id_mision_pasajes."' ");

        if($jfregional->num_rows() > 0){
            foreach ($jfregional->result() as $filajr) {              
            }
        }


        if(intval($fila2->estado) > 2){
            $pdf->Image(base_url()."assets/firmas/".$filajf->nr.".png" , 45,$pdf->GetY()-3, 40 , 15,'PNG', base_url()."assets/firmas/".$filajf->nr.".png");
        }
        if(intval($fila2->estado) > 4){
            $pdf->Image(base_url()."assets/firmas/".$filajr->nr.".png" , 140,$pdf->GetY()-3, 40 , 15,'PNG', base_url()."assets/firmas/".$filajr->nr.".png");
        }

       $pdf->Ln(7);
        $pdf->SetWidths(array(95,95));
        $pdf->SetAligns(array('C','C'));

        $pdf->Row(array("Firma y sello: ______________________________________", "Firma y sello: ______________________________________"),
            array('0','0','0'),
            array('Arial','B','09'),
            array(false),
            array('0','0','0'),
            array('255','255','255'),
            $altura = 5);

       $pdf->Row(array("Nombre: ".nombres($filajf->nombre_completo), "Nombre: ".nombres($filajr->nombre_completo)),
            array('0','0','0'),
            array('Arial','B','09'),
            array(false),
            array('0','0','0'),
            array('255','255','255'),
            $altura = 5);

        $pdf->Row(array("Vo.Bo. Jefe Inmediato", "Autorizado Director de Área o Jefe de Regional"),
            array('0','0','0'),
            array('Arial','B','09'),
            array(false),
            array('0','0','0'),
            array('255','255','255'),
            $altura = 5);

     
$pdf->Output($nr_empleado.'_solicitudPasaje_'.$fecha_mes.".pdf",'I');
?>
