<?php

$id_mision = $_GET["id_mision"];

$empresas = $this->db->query("SELECT * FROM vyp_empresas_visitadas WHERE id_mision_oficial = '".$id_mision."' ORDER BY orden");

$viaticos = 0.00;
$pasajes = 0.00;

$registros = count($empresas->result());

if($empresas->num_rows() > 0){
    foreach ($empresas->result() as $fila) {
        $viaticos += $fila->viaticos;
        $pasajes += $fila->pasajes;
    }
}

$monto = number_format(($pasajes+$viaticos), 2, '.', '');

$decs = (($monto-intval($monto))*100);

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
$pdf->cambiarTitulo('San Salvador, El Salvador, C.A.','POR $   '.$monto);
$pdf->AddPage();
$pdf->MultiCell(190,5,'Recibí del Fondo Circunte del Monto Fijo del Ministerio de Trabajo y Previsión Social, la candidad de '.$formato_dinero.' Dólares en concepto de viáticos y pasaje la interior, el nombre y dirección de las empresas visitadas son las siguientes:',0,'J',false);

$pdf->Ln(3);

if($empresas->num_rows() > 0){
    foreach ($empresas->result() as $fila) {
        $registros--;
        if($registros > 0){
            $pdf->Cell(190,5,"           - ".$fila->nombre_empresa.". Dirección: ".$fila->direccion_empresa,0,'J',false);
            $pdf->Ln(5);
        }
    }
}

$pdf->Ln(3);

$pdf->SetWidths(array(22,90,20,20,15,15));
$pdf->SetAligns(array('C','C','C','C','C','C'));
$pdf->Row(array("Fecha Misión","Luegar de salida y llegada","Hora Salida","Hora Llegada","Viatico","Pasaje"),
array('1','1','1','1','1','1','1'),
array('Arial','B','08'),
array(false),
array('0','0','0'),
array('255','255','255'),
$altura = 5);      

$mision = $this->db->query("SELECT * FROM vyp_mision_oficial WHERE id_mision_oficial = '".$id_mision."'");
        if($mision->num_rows() > 0){
            foreach ($mision->result() as $fila2) { $fecha_mision = $fila2->fecha_mision; }
        }

        $nr_usuario = $fila2->nr_empleado;

        $fecha_mision = date("d/m/Y",strtotime($fecha_mision));

            $pdf->SetAligns(array('L','L','C','C','R','R'));
            $contador=0;
            if($empresas->num_rows() > 0){
                foreach ($empresas->result() as $fila) {
                    if($contador==0){ $fecha_mision; }else{ $fecha_mision = '';}
                        $array = array(
                            $fecha_mision,
                            $fila->origen." - ".$fila->direccion_empresa,
                            date("h:i A",strtotime(date("Y-m-d")." ".$fila->hora_salida)),
                            date("h:i A",strtotime(date("Y-m-d")." ".$fila->hora_llegada)),
                            "$ ".number_format($fila->viaticos, 2, '.', ''),
                            "$ ".number_format($fila->pasajes, 2, '.', '')
                        );
                    $pdf->Row($array,
                        array('0','0','0','0','0','0','0'),
                        array('Arial','B','08'),
                        array(false),
                        array('0','0','0'),
                        array('255','255','255'),
                        $altura = 3); 
                  $origen = $fila->direccion_empresa;
                  $contador++;
                }
            }

        $pdf->Text($pdf->GetX(),$pdf->GetY(),"____________________________________________________________________________________________________________________",0,'C', 0);
        $pdf->Ln(2);
        $pdf->SetWidths(array(152,15,15));
        $pdf->SetAligns(array('C','R','R'));

        $pdf->Row(array("TOTAL", "$ ".number_format($viaticos, 2, '.', ''), "$ ".number_format($pasajes, 2, '.', '')),
            array('0','0','0'),
            array('Arial','B','08'),
            array(false),
            array('0','0','0'),
            array('255','255','255'),
            $altura = 3);

        $pdf->Text($pdf->GetX(),$pdf->GetY(),"____________________________________________________________________________________________________________________",0,'C', 0);

        $pdf->Ln(5);
        $pdf->Text($pdf->GetX(),$pdf->GetY(),"Lugar y Fecha: San Salvador, ".date("d")." de ".mes(date("m"))." de ".date("Y"),0,'C', 0);


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

        $pdf->Image(base_url()."assets/firmas/".$nr_usuario.".png" , 130,$pdf->GetY()-3, 40 , 15,'PNG', base_url()."assets/firmas/".$nr_usuario.".png");

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

        $pdf->Row(array("Cargo funcional: ".parrafo($filacf->funcional), "Código: ".$nr_usuario."            Sueldo:   $".number_format($filae->salario, 2, '.', '')),
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


$pdf->Output($id_mision.'_solicitudViatico_'.$nr_usuario.".pdf",'I');
?>