<?php session_start();

include_once ("../modelo/Conexion.php");
include_once ("../modelo/DAO.php");
$conexions=new Conexion();
$conexion=$conexions->conectar();
$DAO=new DAO();
include_once('PDF_gastos.php');
$idsol = $_GET["idsol"];
$montoaprobado = $_GET["ma"];
$montodesembolsado = $_GET["md"];
$cli_correlativo = $_GET["cli_correlativo"];
$num_des=$_GET['num_des'];
$i = 1; $j = 2;

header("Content-Type: text/html;charset=utf-8");
//array(216,331)
$pdf = new PDF('P','mm','Letter');

$pdf->AddPage();
 $pdf->SetMargins(15,15,15);

setlocale(LC_MONETARY, 'en_US');

$pdf->SetTextColor(3,3,3);
$datosCli = $DAO->mostrarAll($conexion,"select cli_nombre_dui from clientes where cli_correlativo='$cli_correlativo'");
            foreach ($datosCli as $valueCli) {}

$datosN = $DAO->mostrarAll($conexion,"SELECT id_notarios FROM detalle_desembolsos_clientes WHERE cre_solic_id='$idsol' and gc_num_desembolso='$num_des'");
        foreach ($datosN as $valueN) {}
$datosNotario = $DAO->mostrarAll($conexion,"SELECT nombre_notario FROM notarios_detalle_gastos WHERE id_notarios='$valueN[0]'");
  foreach ($datosNotario as $valueNotario) {}

$pdf->leyendas(95,18,'Arial','B',7,200,8,'GASTOS HIPOTECARIO');
$pdf->leyendas(12,34,'Arial','',7,200,8,'NOMBRE DEL CLIENTE: ');
$pdf->leyendas(47,34,'Arial','',7,200,8,'__________________________________________________________');
$pdf->leyendas(50,33,'Arial','B',7,200,8,$valueCli[0]);
$pdf->leyendas(132,34,'Arial','',7,200,8,'FECHA:');
$pdf->leyendas(160,34,'Arial','',7,200,8,'____________________________');
$pdf->leyendas(168,33,'Arial','B',7,200,8,date('d/m/Y h:ia'));
$pdf->leyendas(12,39,'Arial','',7,200,8,'NOTARIO: ');
$pdf->leyendas(30,39,'Arial','',7,200,8,'______________________________________________________________________');
$pdf->leyendas(40,38,'Arial','B',7,200,8,$valueNotario[0]);
$pdf->leyendas(132,39,'Arial','',7,200,8,'MONTO APROBADO:');
$pdf->leyendas(160,39,'Arial','',7,200,8,'____________________________');
$pdf->leyendas(170,38,'Arial','B',7,200,8,"$ ".$montoaprobado);
$pdf->leyendas(132,44,'Arial','',7,200,8,'MONTO DESEMBOLSADO:');
$pdf->leyendas(166,44,'Arial','',7,200,8,'________________________');
$pdf->leyendas(170,43,'Arial','B',7,200,8,"$ ".$montodesembolsado);

$pdf->leyendas(12,50,'Arial','B',9,200,8,'DETALLE DEL DESEMBOLSO DEL CREDITO HIPOTECARIO');

    $pdf->SetFont('Arial','',9);
    $pdf->SetTextColor(0);
    $pdf->SetFillColor(255,255,255);
    $pdf->SetDrawColor(0,0,0);
    $pdf->SetWidths(array(95,31,31,31));

$leyendas = array(array("OTORGAMIENTO","ACCIONES","TOTAL DE HONORARIOS DEL DOCUMENTOS","HIPOTECA","TOTAL DE CANCELACIONES HIPOTECAS",'VENTA','OTROS','SEGURO DE DEUDA','SEGURO DE VIDA','SEGURO DE RESIDENCIA','SALUD A TU ALCANCE','TOTAL DERECHOS DE REGISTRO','CERTIFICACION EXTRACTADA','ANOTACION PREVENTIVA','HIPOTECA','TOTAL DE CANCELACIONES DE DERECHO DE REGISTRO','VENTA','COMISION POR TRAMITE REGISTRAL','VALUO','PRIMERA CUOTA','SEGUNDA CUOTA','ANTIGUA CUOTA','ABONO A CUENTA DE AHORRO','CANCELACION SALDO A CAJA','TOTAL DE OTRAS DEUDAS','TOTAL DE DEUDAS EN CAJA DE CREDITO DE SAN VICENTE','TOTAL DE DEUDAS EN OTRAS FINANCIERAS','LIQUIDO QUE RECIBE','TOTAL DE DESCUENTOS','TOTAL DE CHEQUES A SU FAVOR'));
$leyendas2=array(array('VENTA'));

$datos = $DAO->mostrarAll($conexion,"SELECT * FROM detalle_desembolsos_clientes WHERE cre_solic_id='$idsol' and  gc_num_desembolso = '$num_des'");
$h=0;
$pdf->SetAligns(array('L','R','R','R'));
if(empty($datos)){ $pdf->SetTextColor(255,0,0);$pdf->leyendas(65,74,'Arial','BI',12,200,8,"¡Asegurese de Guardar Los Cambios!");$pdf->SetTextColor(0);
}
	/* DATOS DE EL GASTO HIPOTECARIOS */
    $pdf->SetDrawColor(112,173,7);
    foreach ($datos as $value) {
        $pdf->SetFillColor(226,239,217);
        $pdf->Row(array($leyendas[0][$h],"","","$ ".$value[11]),array('LTBR','T','T','1'));
        $pdf->SetFillColor(255,255,255);
        $pdf->Row(array($leyendas[0][$h+1],"","","$ ".$value[12]),array('LTB','T','T','1'));
        $pdf->SetFillColor(112,173,7);
        $pdf->Row(array($leyendas[0][$h+2],"","","$ ".$value['gc_total_honorario_documento']),array('LTB','T','T','1'));
        $pdf->SetFillColor(226,239,217);
        $pdf->Row(array($leyendas[0][$h+3],"","$ ".$value['gc_hipoteca'],""),array('LTB','T','TLR','1'));
        $pdf->SetFillColor(153,255,102);
        $pdf->Row(array($leyendas[0][$h+4],"","$ ".$value['gc_total_cancelacion_hipoteca'],""),array('LTB','TB','TBLR','1'));
        $pdf->SetFillColor(255,255,255);
            /* CANCELACIONES */
            $datosCan = $DAO->mostrarAll($conexion,"select * from cancelaciones_hipotecas_clientes where cre_solic_id='$idsol' and gc_num_desembolso='$num_des'");
			foreach ($datosCan as $valueCan) {
                if($i==1){
                    $pdf->SetFillColor(255,255,255);
                    $j = 2;$i = 0;
                }else if($j==2){
                    $pdf->SetFillColor(226,239,217);
                    $i = 1; $j = 0;
                }
				$pdf->Row(array($valueCan[1],"$ ".$valueCan[2],"",""),array('LTB','LTB','TLBR','1'));
			}
			/* CANCELACIONES */
        ($j > $i) ? $pdf->SetFillColor(226,239,217) : $pdf->SetFillColor(255,255,255);
	    $pdf->Row(array($leyendas[0][$h+5],"","$ ".$value['gc_venta'],""),array('LTB','TB','TBLR','1'));
        ($i > $j) ? $pdf->SetFillColor(226,239,217) : $pdf->SetFillColor(255,255,255);
        $pdf->Row(array($leyendas[0][$h+6]." - ".$value['gc_otros_concepto'],"","$ ".$value['gc_otros'],""),array('LTB','TB','TBLR','1'));
        ($j > $i) ? $pdf->SetFillColor(112,173,7) : $pdf->SetFillColor(112,173,7);
         $datosSeguro = $DAO->mostrarAll($conexion,"select sum(`gc_seguro_deuda`+`gc_seguro_vida`+`gc_seguro_residencia`+`gc_salud_a_tu_alcance`)  from detalle_desembolsos_clientes where cre_solic_id='$idsol' and gc_num_desembolso='$num_des'");
            foreach ($datosSeguro as $valueSeguro) {}
        $pdf->Row(array("TOTAL DE SEGUROS","","","$ ".$valueSeguro[0]),array('LTB','TB','TBLR','1'));

        ($j > $i) ? $pdf->SetFillColor(226,239,217) : $pdf->SetFillColor(255,255,255);
        $pdf->Row(array($leyendas[0][$h+7],"","$ ".$value['gc_seguro_deuda'],""),array('LTB','TB','TBLR','1'));
        ($i > $j) ? $pdf->SetFillColor(226,239,217) : $pdf->SetFillColor(255,255,255);
        $pdf->Row(array($leyendas[0][$h+8],"","$ ".$value['gc_seguro_vida'],""),array('LTB','TB','TBLR','1'));
        ($j > $i) ? $pdf->SetFillColor(226,239,217) : $pdf->SetFillColor(255,255,255);
        $pdf->Row(array($leyendas[0][$h+9],"","$ ".$value['gc_seguro_residencia'],""),array('LTB','TB','TBRL','1'));
        ($i > $j) ? $pdf->SetFillColor(226,239,217) : $pdf->SetFillColor(255,255,255);
        $pdf->Row(array($leyendas[0][$h+10],"","$ ".$value['gc_salud_a_tu_alcance'],""),array('LTB','TB','TBLR','1'));
        ($j > $i) ? $pdf->SetFillColor(112,173,7) : $pdf->SetFillColor(112,173,7);
        $pdf->Row(array($leyendas[0][$h+11],"","","$ ".$value['gc_total_derechos_registro']),array('LTB','TB','TBR','1'));
        ($i > $j) ? $pdf->SetFillColor(226,239,217) : $pdf->SetFillColor(255,255,255);
        $pdf->Row(array($leyendas[0][$h+12],"","$ ".$value['gc_certificacion_extractada'],""),array('LTB','TB','TBLR','1'));
        ($j > $i) ? $pdf->SetFillColor(226,239,217) : $pdf->SetFillColor(255,255,255);
        $pdf->Row(array($leyendas[0][$h+13],"","$ ".$value['gc_anotacion_preventiva'],""),array('LTB','TB','TBLR','1'));
        ($i > $j) ? $pdf->SetFillColor(226,239,217) : $pdf->SetFillColor(255,255,255);
        $pdf->Row(array($leyendas[0][$h+14],"","$ ".$value['gc_hipoteca_derechos_registro'],""),array('LTB','TB','TBLR','1'));
        ($j > $i) ? $pdf->SetFillColor(153,255,102) : $pdf->SetFillColor(153,255,102);
        $pdf->Row(array($leyendas[0][$h+15],"","$ ".$value['gc_cancelacion_derechos_registro'],""),array('LTB','TB','TBLR','1'));
        ($i > $j) ? $pdf->SetFillColor(226,239,217) : $pdf->SetFillColor(255,255,255);
            /* CANCELACIONES */
            $datosCan = $DAO->mostrarAll($conexion,"select * from cancelaciones_hipotecas_clientes where cre_solic_id='$idsol' and gc_num_desembolso='$num_des'");
            foreach ($datosCan as $valueCan) {
                if($i==1){
                    $pdf->SetFillColor(255,255,255);
                    $j = 2;$i = 0;
                }else if($j==2){
                    $pdf->SetFillColor(226,239,217);
                    $i = 1; $j = 0;
                }
                $pdf->Row(array($valueCan[1]."    $ ".$valueCan[2],"$ ".$valueCan[5],"",""),array('LTB','LTB','TLBR','1'));
                
            }
            /* CANCELACIONES */
        ($j > $i) ? $pdf->SetFillColor(226,239,217) : $pdf->SetFillColor(255,255,255);
        $pdf->Row(array($leyendas[0][$h+16],"","$ ".$value['gc_venta_derechos_registro'],""),array('LTB','TB','TBLR','1'));
        ($i > $j) ? $pdf->SetFillColor(226,239,217) : $pdf->SetFillColor(255,255,255);
        $pdf->Row(array("TRANFERENCIAS DE BIENES","","$ ".$value['gc_transferencia_vienes'],""),array('LTB','TB','TBLR','1'));
        ($j > $i) ? $pdf->SetFillColor(226,239,217) : $pdf->SetFillColor(255,255,255);
        $pdf->Row(array($leyendas[0][$h+17],"","$ ".$value['gc_comision_tramite_registral'],""),array('LTB','TB','TBLR','1'));
        ($i > $j) ? $pdf->SetFillColor(226,239,217) : $pdf->SetFillColor(255,255,255);
        $pdf->Row(array($leyendas[0][$h+18],"","","$ ".$value['gc_pago_valuo']),array('LTB','TB','TB','1'));
        ($j > $i) ? $pdf->SetFillColor(226,239,217) : $pdf->SetFillColor(255,255,255);

        if($value['gc_num_cuotas']=='Una Cuota completa'){
                $pdf->Row(array($leyendas[0][$h+19],"","","$ ".$value['gc_nueva_cuota']),array('LTB','TB','TB','1'));
                ($i > $j) ? $pdf->SetFillColor(226,239,217) : $pdf->SetFillColor(255,255,255);
               $j=1;$i=0;
        }else if($value['gc_num_cuotas']=='Dos Cuotas Completas'){
                $pdf->Row(array("PRIMERA CUOTA","","","$ ".$value['gc_nueva_cuota']),array('LTB','TB','TB','1'));
                ($i > $j) ? $pdf->SetFillColor(226,239,217) : $pdf->SetFillColor(255,255,255);
                $pdf->Row(array("SEGUNDA CUOTA","","","$ ".$value['gc_nueva_cuota']),array('LTB','TB','TB','1'));
                ($j > $i) ? $pdf->SetFillColor(226,239,217) : $pdf->SetFillColor(255,255,255);


        }else if($value['gc_num_cuotas']=='Un Complemento'){
                $pdf->Row(array("PRIMER COMPLEMENTO DE CUOTA","","","$ ".$value['gc_resultado_primera_cuota']),array('LTB','TB','TB','1'));
                ($i > $j) ? $pdf->SetFillColor(226,239,217) : $pdf->SetFillColor(255,255,255);
                $j=1;$i=0;

        }else if($value['gc_num_cuotas']=='Dos Complementos'){
            $nuev = (($value['gc_resultado_primera_cuota']) / 2);
                $pdf->Row(array("PRIMER COMPLEMENTO DE CUOTA","","","$ ".$nuev),array('LTB','TB','TB','1'));
                ($i > $j) ? $pdf->SetFillColor(226,239,217) : $pdf->SetFillColor(255,255,255);
                $pdf->Row(array("SEGUNDO COMPLEMENTO DE CUOTA","","","$ ".$nuev),array('LTB','TB','TB','1'));
                ($j > $i) ? $pdf->SetFillColor(226,239,217) : $pdf->SetFillColor(255,255,255);

        }else if($value['gc_num_cuotas']=='Aplicacion de cuota mayor a la nueva'){
                $pdf->Row(array("APLICACION DE CUOTA MAYOR A LA NUEVA","","",""),array('LTB','TB','TB','1'));
                ($i > $j) ? $pdf->SetFillColor(226,239,217) : $pdf->SetFillColor(255,255,255);
                $j=1;$i=0;
        }else{
             $pdf->Row(array("PRIMER CUOTA DEL CREDITO","","","$ ".$value['gc_resultado_primera_cuota']),array('LTB','TB','TB','1'),"",false);
                ($i > $j) ? $pdf->SetFillColor(226,239,217) : $pdf->SetFillColor(255,255,255);
                $j=1;$i=0;
        }

        $pdf->Row(array($leyendas[0][$h+22],"","","$ ".$value['gc_abono_cuenta_ahorro']),array('LTB','TB','TB','1'));
        ($i > $j) ? $pdf->SetFillColor(226,239,217) : $pdf->SetFillColor(255,255,255);
        $pdf->Row(array($leyendas[0][$h+23],"","","$ ".$value['gc_cancelacion_saldo_a_caja']),array('LTB','TB','TB','1'));
        ($j > $i) ? $pdf->SetFillColor(112,173,7) : $pdf->SetFillColor(112,173,7);
        $pdf->Row(array($leyendas[0][$h+24],"","","$ ".$value['gc_total_otras_deudas']),array('LTB','TB','TB','1'));
        ($i > $j) ? $pdf->SetFillColor(153,255,102) : $pdf->SetFillColor(153,255,102);

        $datosOtraAqui = $DAO->mostrarAll($conexion,"select sum(monto_otras_deudas) from cancelaciones_otros_deudas_clientes where cre_solic_id='$idsol' and tipo_de_pago_otras_deudas='EN CAJA DE CREDITO SAN VICENTE' and gc_num_desembolso='$num_des'");
            foreach ($datosOtraAqui as $valueOtraAqui) {}
$a=0;
        $pdf->Row(array($leyendas[0][$h+25],"","$ ".number_format($valueOtraAqui[0],2,".",","),""),array('LTB','TB','TB','1'));
        ($i > $j) ? $pdf->SetFillColor(226,239,217) : $pdf->SetFillColor(255,255,255);
        $datosOtras = $DAO->mostrarAll($conexion,"select * from cancelaciones_otros_deudas_clientes where cre_solic_id='$idsol' and tipo_de_pago_otras_deudas='EN CAJA DE CREDITO SAN VICENTE' and gc_num_desembolso='$num_des'");
            foreach ($datosOtras as $valueOtras) {
                $a++;
                if($i==1){
                    $pdf->SetFillColor(255,255,255);
                    $j = 1;$i = 0;
                }else if($j==1){
                    $pdf->SetFillColor(226,239,217);
                    $i = 1; $j = 0;
                }
                $pdf->Row(array($valueOtras[1],"$ ".$valueOtras[2],"",""),array('LTB','LTB','TLBR','1'));
                ($j > $i) ? $pdf->SetFillColor(226,239,217) : $pdf->SetFillColor(255,255,255);
                
            }
            ($i > $j) ? $pdf->SetFillColor(153,255,102) : $pdf->SetFillColor(153,255,102);
            $datosOtraAqui1 = $DAO->mostrarAll($conexion,"select sum(monto_otras_deudas) from cancelaciones_otros_deudas_clientes where cre_solic_id='$idsol' and tipo_de_pago_otras_deudas='PAGO A OTRAS FINANCIERAS' and gc_num_desembolso='$num_des'");
            foreach ($datosOtraAqui1 as $valueOtraAqui1) {}

            $pdf->Row(array($leyendas[0][$h+26],"","$ ".number_format($valueOtraAqui1[0],2,".",","),""),array('LTB','TB','TB','1'));
            ($j > $i) ? $pdf->SetFillColor(226,239,217) : $pdf->SetFillColor(255,255,255);
            $datosOtras1 = $DAO->mostrarAll($conexion,"select * from cancelaciones_otros_deudas_clientes where cre_solic_id='$idsol' and tipo_de_pago_otras_deudas='PAGO A OTRAS FINANCIERAS' and gc_num_desembolso='$num_des'");
            
            foreach ($datosOtras1 as $valueOtras1) {
                $a++;
                if($i==1){
                    $pdf->SetFillColor(255,255,255);
                    $j = 1;$i = 0;
                }else if($j==1){
                    $pdf->SetFillColor(226,239,217);
                    $i = 1; $j = 0;
                }
                $pdf->Row(array($valueOtras1[1],"$ ".number_format($valueOtras1[2],2,'.',','),"",""),array('LTB','LTB','TLBR','1'));
                ($i > $j) ? $pdf->SetFillColor(226,239,217) : $pdf->SetFillColor(255,255,255);
               
            }
             if($a%2==0){
                $i=1;$j=0;
             }else{
                $i=0; $j=1;
             }
        ($j > $i) ? $pdf->SetFillColor(226,239,217) : $pdf->SetFillColor(255,255,255);
        $pdf->Row(array($leyendas[0][$h+27],"","","$ ".$value['gc_liquido_recibe']),array('LTB','TB','TB','1'));
        ($i > $j) ? $pdf->SetFillColor(112,173,7) : $pdf->SetFillColor(112,173,7);
        $pdf->Row(array($leyendas[0][$h+28],"","","$ ".$value['gc_total_descuentos']),array('LTB','TB','TB','1'));
        ($j > $i) ? $pdf->SetFillColor(112,173,7) : $pdf->SetFillColor(112,173,7);
        $pdf->Row(array($leyendas[0][$h+29],"","","$ ".$value['gc_cheque_a_favor']),array('LTB','TB','TB','1'));
        ($i > $j) ? $pdf->SetFillColor(255,255,255) : $pdf->SetFillColor(255,255,255);

         $pdf->SetDrawColor(255,255,255);

        $pdf->SetWidths(array(188));
        $pdf->SetAligns(array('J'));
        $pdf->Row(array(""),array('0'));
        $pdf->Row(array(""),array('0'));
        $pdf->Row(array(utf8_decode($value['gc_observaciones'])),array('0'));
	}
	/* DATOS DE EL GASTO HIPOTECARIOS */

$pdf->Output(); //Salida al navegador
?>