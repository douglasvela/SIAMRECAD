<?php session_start();
$idusu = trim($_SESSION['id']);
	include_once ("../modelo/Conexion.php");
	include_once ("../modelo/DAO.php");
	//require("../../../numerosALetras.php");
	include_once('PDF_Valuos.php');
	$conexions=new Conexion();
	$conexion=$conexions->conectar();
	$DAO=new DAO();
$idvaluos = $_GET['id'];

header("Content-Type: text/html;charset=utf-8");


$datosperi = $DAO->mostrarAll($conexion,"select id_usuario_nombre from val_valuos where id_val_valuos='$idvaluos'");
foreach ($datosperi as $keydatosperi) {
	# code...
}
$datosPerito = $DAO->mostrarAll($conexion,"select agencia,usuario_nombre from usuarios where usuario_id='$keydatosperi[0]'");
            foreach ($datosPerito as $valuePerito) {}
$pdf = new PDF('P','mm','Letter');
$pdf->SetAutoPageBreak(true, 15);
$pdf->SetMargins(9,3,6);
$pdf->Setentidad(array($valuePerito[0]));
$pdf->SetUsuario(array($valuePerito[1]));
$pdf->Set_id_val_valuos(array($idvaluos));
$pdf->AddPage();


$pdf->SetFillColor(161,161,161);
//$pdf->SetTextColor(255, 255, 255);

$posiciony="16";
$datosValuo = $DAO->mostrarAll($conexion,"select * from val_valuos where id_val_valuos='$idvaluos'");
if(empty($datosValuo)){
			$pdf->cuadrogrande(7,$posiciony,200,4,1,FD);
			$pdf->SetAligns(array('C'));
			$pdf->SetWidths(array(200));
			$pdf->Row(array(utf8_decode(" ¬_¬   : ) ' : ' ( :    ¡¡¡ VALUO NO ENCONTRADO !!!   xD :p ;) :D :o :3 :s ")),array('0'),array(array('Arial','','8')),false);
			$pdf->Output(); //Salida al navegador
			return;
}
            foreach ($datosValuo as $valueValuo) {}

$datosCliente = $DAO->mostrarAll($conexion,"select * from clientes where cli_correlativo='$valueValuo[1]'");
            foreach ($datosCliente as $valueCliente) {}
$datosDetalle_parcial = $DAO->mostrarAll($conexion,"select sum(det_val_total) from val_detalle_de_valuos_urbanos where id_val_valuos='$idvaluos' and det_terreno!='Area Excedente'");
            foreach ($datosDetalle_parcial as $valueDetalleParcial) {}
            	$valorinscrito = $valueDetalleParcial[0] + $valueValuo['val_depresiado'];
$pdf->SetFillColor(192,192,192);
$pdf->cuadrogrande(9,$posiciony,103,3.5,1,FD);
$pdf->SetAligns(array('L','L'));
$pdf->SetWidths(array(70,33));$pdf->SetTextColor(3, 3, 3);
$pdf->Row(array("SOLICITANTE","TELEFONO"),array('0','0','0'),array(array('Arial','','6'),array('Arial','','6')),false);
$pdf->SetTextColor(3, 3,3);
$posiciony+=3.5;
$pdf->cuadrogrande(9,$posiciony,103,3,0,D);
$pdf->Row(array($valueCliente['cli_nombre_dui'],$valueCliente['cli_celular']),array('0','0','0'),array(array('Arial','','6'),array('Arial','','6')),false);
$posiciony+=3;$pdf->SetFillColor(192,192,192);
$pdf->SetAligns(array('L','L'));
$pdf->SetWidths(array(70,33));
$pdf->cuadrogrande(9,$posiciony,103,3,1,FD);
$pdf->Row(array("PROPIETARIO","NATURALEZA DEL INMUEBLE"),array('0','0','0'),array(array('Arial','','6'),array('Arial','','6'),array('Arial','','6')),false,'',array(array('192','192','192'),array('192','192','192')));
$posiciony+=3;
$pdf->cuadrogrande(9,$posiciony,103,3,0,D);
$pdf->Row(array(utf8_decode($valueValuo['val_propietario']),$valueValuo['val_naturaleza_inmueble']),array('0','0','0'),array(array('Arial','','6'),array('Arial','','6'),array('Arial','','6')),false);

$posiciony+=3;
$pdf->SetAligns(array('L','L','L'));
$pdf->SetWidths(array(25,89,88));$pdf->SetFillColor(192,192,192);
$pdf->cuadrogrande(9,$posiciony,200,3,1,FD);
$pdf->Row(array("VOCACION","TERRENO GARANTIA, AREA SEGUN DOCUMENTO",utf8_decode("TOPOGRAFÍA, FORMA Y NIVEL A LA CALLE")),array('0','0','0'),array(array('Arial','','6'),array('Arial','','6'),array('Arial','','6')),false);
$posiciony+=3;
$pdf->cuadrogrande(9,$posiciony,200,4,0,D);
$pdf->Row(array(utf8_decode($valueValuo['val_vocacion']),utf8_decode($valueValuo['val_aspecto_legal']),utf8_decode(ucfirst(strtolower(strtoupper($valueValuo['val_topografia']))))),array('0','0','0'),array(array('Arial','','6'),array('Arial','','6'),array('Arial','','6')),false);


/*
$pdf->SetFillColor(160,160,160);
$pdf->SetTextColor(3, 3, 3);
$pdf->cuadrogrande(7,$posiciony,103,4,1,FD);
$pdf->SetAligns(array('C'));
$pdf->SetWidths(array(103));
$pdf->Row(array("DATOS DEL CLIENTE"),array('0'),array(array('Arial','','8')),false);*/
$posiciony-=15.5;$pdf->SetFillColor(192,192,192);
$pdf->cuadrogrande(112,$posiciony,97,3.5,1,DF);
$pdf->SetAligns(array('L','L'));
$pdf->SetWidths(array(48,49));
$pdf->Row(array("UBICACION DEL INMUEBLE","VIAS DE ACCESO"),array('0'),array(array('Arial','','6')),false,'',array(array('192','192','192'),array('192','192','192')));
$posiciony+=3.5;
$pdf->cuadrogrande(112,$posiciony,97,9,0,D);
$pdf->SetTextColor(3, 3,3);
$pdf->RowPeque(array(utf8_decode($valueValuo['val_ubicacion']),utf8_decode($valueValuo['val_vias_acceso'])),array('0'),array(array('Arial','','6')),false);



$posiciony+=18.5;
$pdf->SetFillColor(192,192,192);
//$pdf->SetTextColor(255, 255, 255);
$pdf->cuadrogrande(9,$posiciony,200,3.5,1,FD);
$pdf->SetAligns(array('C'));
$pdf->SetWidths(array(193));
$pdf->Row(array("CARACTERISTICAS INMUEBLE-ENTORNO"),array('0'),array(array('Arial','','7')),false);

$pdf->SetFillColor(192,192,192);
$posiciony+=3.6;
$pdf->cuadrogrande(9,$posiciony,200,3.5,1,FD);
$pdf->SetAligns(array('J','C','C','J','J','C','J','J','J','J','J','J','J','J','J','J'));
$pdf->SetWidths(array(20,13,14,18,13,15,22,15,19,6,6,12,17,12));
$pdf->Row(array("SERVICIOS","INMUEBLE","ENTORNO","SERVICIOS","INMUEBLE","ENTORNO","ACCESOS-CALLES","EXISTENCIA","SANITARIOS","SI","NO","COMENT.","ACCESORIO","EXIST."),array('0','0','0','0','0','0','0','0','0','0','0','0','0'),array(array('Arial','','6'),array('Arial','','6')),false);

$pdf->SetTextColor(3, 3,3);
$posiciony+=3.4;



 ($valueValuo['serv_agua_pot_inmueble']==1) ? $serv_agua_pot_inmueble="SI" : $serv_agua_pot_inmueble="NO";
 ($valueValuo['serv_agua_pot_entorno']==1) ? $serv_agua_pot_entorno="SI" : $serv_agua_pot_entorno="NO";
 ($valueValuo['serv_agua_neg_inmueble']==1) ? $serv_agua_neg_inmueble="SI" : $serv_agua_neg_inmueble="NO";
 ($valueValuo['serv_agua_neg_entorno']==1) ? $serv_agua_neg_entorno="SI" : $serv_agua_neg_entorno="NO";
 ($valueValuo['serv_energ_inmueble']==1) ? $serv_energ_inmueble="SI" : $serv_energ_inmueble="NO";
 ($valueValuo['serv_energ_entorno']==1) ? $serv_energ_entorno="SI" : $serv_energ_entorno="NO";
 ($valueValuo['serv_aguas_lluvias_inmueble']==1) ? $serv_aguas_lluvias_inmueble="SI" : $serv_aguas_lluvias_inmueble="NO";
 ($valueValuo['serv_aguas_lluvias_entorno']==1) ? $serv_aguas_lluvias_entorno="SI" : $serv_aguas_lluvias_entorno="NO";
 ($valueValuo['serv_fosa_sept_inmueble']==1) ? $serv_fosa_sept_inmueble="SI" : $serv_fosa_sept_inmueble="NO";
 ($valueValuo['serv_fosa_sept_entorno']==1) ? $serv_fosa_sept_entorno="SI" : $serv_fosa_sept_entorno="NO";

 ($valueValuo['serv_resumidero_inmueble']==1) ? $serv_resumidero_inmueble = "SI" : $serv_resumidero_inmueble ="NO";
 ($valueValuo['serv_resumidero_entorno']==1) ? $serv_resumidero_entorno = "SI" : $serv_resumidero_entorno ="NO";
 ($valueValuo['serv_punta_perdida_inmueble']==1) ? $serv_punta_perdida_inmueble="SI" : $serv_punta_perdida_inmueble="NO";
 ($valueValuo['serv_punta_perdida_entorno']==1) ? $serv_punta_perdida_entorno="SI" : $serv_punta_perdida_entorno="NO";
 ($valueValuo['serv_pozo_broquel_inmueble']==1) ? $serv_pozo_broquel_inmueble="si" : $serv_pozo_broquel_inmueble="NO";
 ($valueValuo['serv_pozo_borquel_entorno']==1) ? $serv_pozo_borquel_entorno="SI" : $serv_pozo_borquel_entorno="NO";
 ($valueValuo['serv_linea_telef_inmueble']==1) ? $serv_linea_telef_inmueble="SI" : $serv_linea_telef_inmueble="NO";
 ($valueValuo['serv_linea_telef_entorno']==1) ? $serv_linea_telef_entorno="SI" : $serv_linea_telef_entorno="NO";
 ($valueValuo['serv_tren_aseo_inmueble']==1) ? $serv_tren_aseo_inmueble="SI" : $serv_tren_aseo_inmueble="NO";
 ($valueValuo['serv_tren_aseo_entorno']==1) ? $serv_tren_aseo_entorno="SI" : $serv_tren_aseo_entorno="NO";
 ($valueValuo['serv_alm_publico_inmueble']==1) ? $serv_alm_publico_inmueble="SI" : $serv_alm_publico_inmueble="NO";
 ($valueValuo['serv_alm_publico_entorno']==1) ? $serv_alm_publico_entorno="SI" : $serv_alm_publico_entorno="NO";
 ($valueValuo['serv_cable_tv_inmueble']==1) ? $serv_cable_tv_inmueble="SI" : $serv_cable_tv_inmueble="NO";
 ($valueValuo['serv_cable_tv_entorno']==1) ? $serv_cable_tv_entorno="SI" : $serv_cable_tv_entorno="NO";
 ($valueValuo['serv_cobr_cel_inmueble']==1) ? $serv_cobr_cel_inmueble="SI" : $serv_cobr_cel_inmueble="NO";
 ($valueValuo['serv_cobr_cel_entorno']==1) ? $serv_cobr_cel_entorno="SI" : $serv_cobr_cel_entorno="NO";

 ($valueValuo['acc_asfaltado']==1) ? $acc_asfaltado="X" : $acc_asfaltado="";
 ($valueValuo['acc_concret_hidr']==1) ? $acc_concret_hidr="X" : $acc_concret_hidr="";
 ($valueValuo['acc_encementado']==1) ? $acc_encementado="X" : $acc_encementado="";
 ($valueValuo['acc_adoquinado']==1) ? $acc_adoquinado="X" : $acc_adoquinado="";
 ($valueValuo['acc_adquin_piedra']==1) ? $acc_adquin_piedra="X" : $acc_adquin_piedra="";
 ($valueValuo['acc_basaltado']==1) ? $acc_basaltado="X" : $acc_basaltado="";
 ($valueValuo['acc_tierra']==1) ? $acc_tierra="X" : $acc_tierra="";
 ($valueValuo['acc_empedrado']==1) ? $acc_empedrado="X" : $acc_empedrado="";

 ($valueValuo['san_inod_china']==1) ? $san_inod_china1="X" : $san_inod_china2="X";
 ($valueValuo['san_letrina_fosa']==1) ? $san_letrina_fosa1="X" : $san_letrina_fosa2="X";
 ($valueValuo['san_letrina_abonera']==1) ? $san_letrina_abonera1="X" : $san_letrina_abonera2="X";
 ($valueValuo['san_pila_lav']==1) ? $san_pila_lav1="X" : $san_pila_lav2="X";
 ($valueValuo['san_banio']==1) ? $san_banio1="X" : $san_banio2="X";

 ($valueValuo['accesorio_cordones']==1) ? $accesorio_cordones="X" : $accesorio_cordones="";
 ($valueValuo['accesorio_cuneta']==1) ? $accesorio_cuneta="X" : $accesorio_cuneta="";
 ($valueValuo['accesorio_acera']==1) ? $accesorio_acera="X" : $accesorio_acera="";
 ($valueValuo['accesorio_marquezina']==1) ? $accesorio_marquezina="X" : $accesorio_marquezina="";
 ($valueValuo['accesorio_zocales']==1) ? $accesorio_zocales="X" : $accesorio_zocales="";
 ($valueValuo['accesorios_canales_baja_agua']==1) ? $accesorios_canales_baja_agua="X" : $accesorios_canales_baja_agua="";



$pdf->SetTextColor(49, 164, 255);
$colorazul =array("61","116","255");
$pdf->cuadrogrande(9,$posiciony,46,3,0,D);$pdf->SetWidths(array(20,13,14));$pdf->SetAligns(array('J','C','C'));
$pdf->Row(array("Agua Potable",$serv_agua_pot_inmueble,$serv_agua_pot_entorno),array('0'),array(array('Arial','','6'),array('Arial','','5'),array('Arial','','5')),false,array(array(),''));
$pdf->cuadrogrande(55,$posiciony,46,3,0,D);
$pdf->SetTextColor(3, 3, 3);
$pdf->Row(array("Resumidero",$serv_resumidero_inmueble,$serv_resumidero_entorno),array('0'),array(array('Arial','','6'),array('Arial','','5'),array('Arial','','5')),false);$pdf->SetWidths(array(22,15));$pdf->SetAligns(array('l','C'));
$pdf->cuadrogrande(101,$posiciony,38,3,0,D);
$pdf->Row(array("Asfaltado",$acc_asfaltado),array('0'),array(array('Arial','','6'),array('Arial','','5')),false);
$pdf->cuadrogrande(139,$posiciony,43,3,0,D);
$pdf->SetWidths(array(19,6,6));
$pdf->Row(array("Inodoro de China",$san_inod_china1,$san_inod_china2,$valueValuo['san_inod_china_coment']),array('0'),array(array('Arial','','6'),array('Arial','','5'),array('Arial','','5')),false);
$pdf->SetWidths(array(17,12));$pdf->SetAligns(array('J','L'));
$pdf->cuadrogrande(182,$posiciony,27,3,0,D);
$pdf->Row(array("Cordones",$accesorio_cordones),array('0'),array(array('Arial','','6'),array('Arial','','5')),false);
$posiciony+=3;


$pdf->cuadrogrande(9,$posiciony,46,3,0,D);$pdf->SetWidths(array(20,13,14));$pdf->SetAligns(array('J','C','C'));
$pdf->Row(array("Aguas Negras",$serv_agua_neg_inmueble,$serv_agua_neg_entorno),array('0'),array(array('Arial','','6'),array('Arial','','5'),array('Arial','','5')),false);
$pdf->cuadrogrande(55,$posiciony,46,3,0,D);
$pdf->Row(array("Punta Perdida",$serv_punta_perdida_inmueble,$serv_punta_perdida_entorno),array('0'),array(array('Arial','','6'),array('Arial','','5'),array('Arial','','5')),false);$pdf->SetWidths(array(22,15));$pdf->SetAligns(array('l','C'));
$pdf->cuadrogrande(101,$posiciony,38,3,0,D);
$pdf->Row(array("Concreto Hidr.",$acc_concret_hidr),array('0'),array(array('Arial','','6'),array('Arial','','5')),false);
$pdf->cuadrogrande(139,$posiciony,43,3,0,D);
$pdf->SetWidths(array(19,6,6));
$pdf->Row(array("Letrina de Fosa",$san_letrina_fosa1,$san_letrina_fosa2,$valueValuo['san_letrina_fosa_coment']),array('0'),array(array('Arial','','6'),array('Arial','','5'),array('Arial','','5')),false);
$pdf->SetWidths(array(17,12));$pdf->SetAligns(array('J','L'));
$pdf->cuadrogrande(182,$posiciony,27,3,0,D);
$pdf->Row(array("Cuentas",$accesorio_cuneta),array('0'),array(array('Arial','','6'),array('Arial','','5')),false);
$posiciony+=3;

$pdf->cuadrogrande(9,$posiciony,46,3,0,D);$pdf->SetWidths(array(20,13,14));$pdf->SetAligns(array('J','C','C'));
$pdf->Row(array("Energ. Electr.",$serv_energ_inmueble,$serv_energ_entorno),array('0'),array(array('Arial','','6'),array('Arial','','5'),array('Arial','','5')),false);
$pdf->cuadrogrande(55,$posiciony,46,3,0,D);
$pdf->Row(array("Pozo Broquel",$serv_pozo_broquel_inmueble,$serv_pozo_borquel_entorno),array('0'),array(array('Arial','','6'),array('Arial','','5'),array('Arial','','5')),false);$pdf->SetWidths(array(22,15));$pdf->SetAligns(array('l','C'));
$pdf->cuadrogrande(101,$posiciony,38,3,0,D);
$pdf->Row(array("Encementado",$acc_encementado),array('0'),array(array('Arial','','6'),array('Arial','','5')),false);
$pdf->cuadrogrande(139,$posiciony,43,3,0,D);
$pdf->SetWidths(array(19,6,6));
$pdf->Row(array("Letrina Abonera",$san_letrina_abonera1,$san_letrina_abonera2,$valueValuo['san_letrina_abonera_coment']),array('0'),array(array('Arial','','6'),array('Arial','','5'),array('Arial','','5')),false);
$pdf->SetWidths(array(17,12));$pdf->SetAligns(array('J','L'));
$pdf->cuadrogrande(182,$posiciony,27,3,0,D);
$pdf->Row(array("Acera",$accesorio_acera),array('0'),array(array('Arial','','6'),array('Arial','','5')),false);
$posiciony+=3;

$pdf->cuadrogrande(9,$posiciony,46,3,0,D);$pdf->SetWidths(array(20,13,14));$pdf->SetAligns(array('J','C','C'));
$pdf->Row(array("Aguas Lluvias",$serv_aguas_lluvias_inmueble,$serv_aguas_lluvias_entorno),array('0'),array(array('Arial','','6'),array('Arial','','5'),array('Arial','','5')),false);
$pdf->cuadrogrande(55,$posiciony,46,3,0,D);
$pdf->Row(array(utf8_decode("Linea Telefónica"),$serv_linea_telef_inmueble,$serv_linea_telef_entorno),array('0'),array(array('Arial','','6'),array('Arial','','5'),array('Arial','','5')),false);$pdf->SetWidths(array(22,15));$pdf->SetAligns(array('l','C'));
$pdf->cuadrogrande(101,$posiciony,38,3,0,D);
$pdf->Row(array("Adoquinado",$acc_adoquinado),array('0'),array(array('Arial','','6'),array('Arial','','5')),false);
$pdf->cuadrogrande(139,$posiciony,43,3,0,D);
$pdf->SetWidths(array(19,6,6));
$pdf->Row(array("Pila, Lavadero",$san_pila_lav1,$san_pila_lav2,$valueValuo['san_pila_lav_coment']),array('0'),array(array('Arial','','6'),array('Arial','','5'),array('Arial','','5')),false);
$pdf->SetWidths(array(17,12));$pdf->SetAligns(array('J','L'));
$pdf->cuadrogrande(182,$posiciony,27,3,0,D);
$pdf->Row(array("Marquezina",$accesorio_marquezina),array('0'),array(array('Arial','','6'),array('Arial','','5')),false);
$posiciony+=3;

$pdf->cuadrogrande(9,$posiciony,46,3,0,D);$pdf->SetWidths(array(20,13,14));$pdf->SetAligns(array('J','C','C'));
$pdf->Row(array("Fosa Septica",$serv_fosa_sept_inmueble,$serv_fosa_sept_entorno),array('0'),array(array('Arial','','6'),array('Arial','','5'),array('Arial','','5')),false);
$pdf->cuadrogrande(55,$posiciony,46,3,0,D);
$pdf->Row(array("Tren de Aseo",$serv_tren_aseo_inmueble,$serv_tren_aseo_entorno),array('0'),array(array('Arial','','6'),array('Arial','','5'),array('Arial','','5')),false);$pdf->SetWidths(array(22,15));$pdf->SetAligns(array('l','C'));
$pdf->cuadrogrande(101,$posiciony,38,3,0,D);
$pdf->Row(array("Adoquin-piedra",$acc_adquin_piedra),array('0'),array(array('Arial','','6'),array('Arial','','5')),false);
$pdf->cuadrogrande(139,$posiciony,43,3,0,D);
$pdf->SetWidths(array(19,6,6));
$pdf->Row(array(utf8_decode("Baño"),$san_banio1,$san_banio2,$valueValuo['san_banio_coment']),array('0'),array(array('Arial','','6'),array('Arial','','5'),array('Arial','','5')),false);
$pdf->SetWidths(array(17,12));$pdf->SetAligns(array('J','L'));
$pdf->cuadrogrande(182,$posiciony,27,3,0,D);
$pdf->Row(array("Zocales",$accesorio_zocales),array('0'),array(array('Arial','','6'),array('Arial','','5')),false);
$posiciony+=3;

$pdf->cuadrogrande(9,$posiciony,46,3,0,D);$pdf->SetWidths(array(20,13,14));$pdf->SetAligns(array('J','C','C'));
$pdf->Row(array(utf8_decode("Alumbrado Público"),$serv_alm_publico_inmueble,$serv_alm_publico_entorno),array('0'),array(array('Arial','','6'),array('Arial','','5'),array('Arial','','5')),false);
$pdf->cuadrogrande(55,$posiciony,46,3,0,D);
$pdf->Row(array("","",""),array('0'),array(array('Arial','','6'),array('Arial','','5'),array('Arial','','5')),false);$pdf->SetWidths(array(22,15));$pdf->SetAligns(array('l','C'));
$pdf->cuadrogrande(101,$posiciony,38,3,0,D);
$pdf->Row(array("Balastado",$acc_basaltado),array('0'),array(array('Arial','','6'),array('Arial','','5')),false);
$pdf->cuadrogrande(139,$posiciony,43,3,0,D);
$pdf->SetWidths(array(19,6,6));
$pdf->Row(array("","","",""),array('0'),array(array('Arial','','6'),array('Arial','','5'),array('Arial','','5')),false);
$pdf->SetWidths(array(17,12));$pdf->SetAligns(array('l','L'));
$pdf->cuadrogrande(182,$posiciony,27,3,0,D);
$pdf->Row(array("Canal Baja Agua",$accesorios_canales_baja_agua),array('0'),array(array('Arial','','5'),array('Arial','','5')),false);
$posiciony+=3;

$pdf->cuadrogrande(9,$posiciony,46,3,0,D);$pdf->SetWidths(array(20,13,14));$pdf->SetAligns(array('J','C','C'));
$pdf->Row(array(utf8_decode("Cobertura Celular"),$serv_cobr_cel_inmueble,$serv_cobr_cel_entorno),array('0'),array(array('Arial','','6'),array('Arial','','5'),array('Arial','','5')),false);
$pdf->cuadrogrande(55,$posiciony,46,3,0,D);
$pdf->Row(array("","",""),array('0'),array(array('Arial','','6'),array('Arial','','5'),array('Arial','','5')),false);$pdf->SetWidths(array(22,15));$pdf->SetAligns(array('l','C'));
$pdf->cuadrogrande(101,$posiciony,38,3,0,D);
$pdf->Row(array("Tierra",$acc_tierra),array('0'),array(array('Arial','','6'),array('Arial','','5')),false);
$pdf->cuadrogrande(139,$posiciony,43,3,0,D);
$pdf->SetWidths(array(19,6,6));
$pdf->Row(array("",""),array('0'),array(array('Arial','','6'),array('Arial','','5'),array('Arial','','5')),false);
$pdf->SetWidths(array(17,12));$pdf->SetAligns(array('l','L'));
$pdf->cuadrogrande(182,$posiciony,27,3,0,D);
$pdf->Row(array("",""),array('0'),array(array('Arial','','5'),array('Arial','','5')),false);
$posiciony+=3;

$pdf->cuadrogrande(9,$posiciony,46,3,0,D);$pdf->SetWidths(array(20,13,14));$pdf->SetAligns(array('J','C','C'));
$pdf->Row(array("Cable T.V.",$serv_cable_tv_inmueble,$serv_cable_tv_entorno),array('0'),array(array('Arial','','6'),array('Arial','','5'),array('Arial','','5')),false);
$pdf->cuadrogrande(55,$posiciony,46,3,0,D);
$pdf->Row(array("","",""),array('0'),array(array('Arial','','6'),array('Arial','','5'),array('Arial','','5')),false);$pdf->SetWidths(array(22,15));$pdf->SetAligns(array('l','C'));
$pdf->cuadrogrande(101,$posiciony,38,3,0,D);
$pdf->Row(array("Empedrado",$acc_empedrado),array('0'),array(array('Arial','','6'),array('Arial','','5')),false);
$pdf->cuadrogrande(139,$posiciony,43,3,0,D);
$pdf->SetWidths(array(19,6,6));
$pdf->Row(array("",""),array('0'),array(array('Arial','','6'),array('Arial','','5'),array('Arial','','5')),false);
$pdf->SetWidths(array(17,12));$pdf->SetAligns(array('l','L'));
$pdf->cuadrogrande(182,$posiciony,27,3,0,D);
$pdf->Row(array("",""),array('0'),array(array('Arial','','5'),array('Arial','','5')),false);
$posiciony+=3;



$pdf->SetFillColor(192,192,192);
$pdf->cuadrogrande(9,$posiciony,17,3,1,DF);
$pdf->Row(array("Observaciones"),array('0'),array(array('Arial','','6')),false);
$pdf->cuadrogrande(26,$posiciony,183,3,0,D);
$pdf->SetAligns(array('l'));
$pdf->SetWidths(array(183));
$pdf->Row(array($valueValuo['val_observaciones_servicios']),array('0'),array(array('Arial','','6')),false);

$posiciony+=6.3;
$pdf->SetFillColor(160,160,160);
//$pdf->SetTextColor(255, 255, 255);
$pdf->cuadrogrande(9,$posiciony,62,3.5,1,FD);
$pdf->SetAligns(array('C'));
$pdf->SetWidths(array(62));
$pdf->Row(array("RUMBOS Y DISTANCIAS"),array('0'),array(array('Arial','','7')),false);

$pdf->SetFillColor(160,160,160);
$pdf->cuadrogrande(71,$posiciony,138,7,1,FD);
$pdf->SetAligns(array('C'));
$pdf->SetWidths(array(138));
$pdf->Row1(array("LINDEROS Y COLINDANTES"),array('0'),array(array('Arial','','7')),false);

$pdf->SetAligns(array('L'));
$posiciony+=7;$pdf->SetTextColor(3, 3,3);
$pdf->cuadrogrande(71,$posiciony,138,17,0,D);
$pdf->Row(array(utf8_decode(ucfirst(mb_strtolower($valueValuo['val_colindante_norte'])))."\n".utf8_decode(ucfirst(mb_strtolower($valueValuo['val_colindante_sur'])))."\n".utf8_decode(ucfirst(mb_strtolower($valueValuo['val_colindante_oriente'])))."\n".utf8_decode(ucfirst(mb_strtolower($valueValuo['val_colindante_poniente'])))),array('0'),array(array('Arial','','6')),false);
$posiciony+=17.5;
/*$pdf->cuadrogrande(71,$posiciony,138,3.5,1,D);
$pdf->Row(array(),array('0'),array(array('Arial','','6')),false);
$posiciony+=3.5;
$pdf->cuadrogrande(71,$posiciony,138,3.5,1,D);
$pdf->Row(array(),array('0'),array(array('Arial','','6')),false);
$posiciony+=3.5;
$pdf->cuadrogrande(71,$posiciony,138,3.5,1,D);
$pdf->Row(array(),array('0'),array(array('Arial','','6')),false);*/

$posiciony-=21;
$pdf->SetFillColor(192,192,192);
$pdf->cuadrogrande(9,$posiciony,62,3.5,1,FD);
$pdf->SetAligns(array('C','C'));
$pdf->SetWidths(array(30,30));//$pdf->SetTextColor(255, 255, 255);
$pdf->Row(array("MEDIDAS ESCRITURA","DATOS DE CAMPO"),array('0','0','0'),array(array('Arial','','6'),array('Arial','','6')),false,'',array(array('192','192','192')));
$pdf->SetTextColor(3, 3,3);

$posiciony+=3.5;
$pdf->cuadrogrande(9,$posiciony,62,3.5,0,D);
$pdf->SetAligns(array('L','C','L','C'));
$pdf->SetWidths(array(15,20,15,15));
$pdf->Row(array("NORTE",$valueValuo['val_medidas_escritura_norte']." M","NORTE",$valueValuo['val_medidas_campo_norte']." M"),array('0','0','0'),array(array('Arial','','5'),array('Arial','','5')),false);

$posiciony+=3.5;
$pdf->cuadrogrande(9,$posiciony,62,3.5,0,D);
$pdf->Row(array("SUR",$valueValuo['val_medidas_escritura_sur']." M","SUR",$valueValuo['val_medidas_campo_sur']." M"),array('0','0','0'),array(array('Arial','','5'),array('Arial','','5')),false);

$posiciony+=3.5;
$pdf->cuadrogrande(9,$posiciony,62,3.5,0,D);
$pdf->Row(array("ORIENTE",$valueValuo['val_medidas_escritura_oriente']." M","ORIENTE",$valueValuo['val_medidas_campo_oriente']." M"),array('0','0','0'),array(array('Arial','','5'),array('Arial','','5')),false);

$posiciony+=3.5;
$pdf->cuadrogrande(9,$posiciony,62,3.5,0,D);
$pdf->Row(array("PONIENTE",$valueValuo['val_medidas_escritura_poniente']." M","PONIENTE",$valueValuo['val_medidas_campo_poniente']." M"),array('0','0','0'),array(array('Arial','','5'),array('Arial','','5')),false);

$posiciony+=3.5;
$pdf->SetFillColor(192,192,192);
$pdf->cuadrogrande(9,$posiciony,62,3,1,FD);
//$pdf->SetTextColor(255, 255, 255);
$pdf->SetAligns(array('C','C','C','R'));
$pdf->SetWidths(array(25,11,14,10));
$pdf->Row(array("EXTENSION SUPERFICIAL","METROS","MANZANAS","VARAS"),array('0'),array(array('Arial','','5'),array('Arial','','5'),array('Arial','','5'),array('Arial','','5')),false);


$posiciony+=3;
$pdf->SetAligns(array('L','R','R','R'));
$pdf->SetWidths(array(22,12,14,13));
$pdf->cuadrogrande(9,$posiciony,62,3,0,D);
$pdf->SetTextColor(3, 3, 3);
$pdf->Row(array("Area Registral",number_format($valueValuo['val_medidas_area_total_escritura_m2'],2,".",","),number_format($valueValuo['val_medias_area_total_escritura_mzn2'],7,".",","),number_format($valueValuo['val_medidas_area_total_escritura_v2'],2,".",",")),array('0'),array(array('Arial','','5'),array('Arial','','6')),false);


$posiciony+=3;
$pdf->cuadrogrande(9,$posiciony,62,3,0,D);
$pdf->SetTextColor(3, 3, 3);
$pdf->Row(array("Area De Campo",number_format($valueValuo['val_medidas_area_total_campo_m2'],2,".",","),number_format($valueValuo['val_medidas_area_total_campo_mzn2'],7,".",","),number_format($valueValuo['val_medidas_area_total_campo_v2'],2,".",",")),array('0'),array(array('Arial','','5'),array('Arial','','6')),false);
$posiciony-=3;

$pdf->SetFillColor(192,192,192);
//$pdf->SetTextColor(255, 255, 255);
$pdf->cuadrogrande(71,$posiciony,70,3,1,FD);
$pdf->SetAligns(array('C'));
$pdf->SetWidths(array(70));
$pdf->Row(array("FUENTE DE INFORMACION"),array('0'),array(array('Arial','','6')),false);
$posiciony+=3;
$pdf->SetAligns(array('C'));
$pdf->SetWidths(array(70));
$pdf->cuadrogrande(71,$posiciony,70,3,0,D);
$pdf->SetTextColor(3, 3, 3);
$pdf->Row(array(utf8_decode($valueValuo['val_fuente_informacion'])),array('0'),array(array('Arial','','6')),false);

$posiciony-=3;$pdf->SetFillColor(192,192,192);
$pdf->cuadrogrande(141,$posiciony,68,3,1,FD);
//$pdf->SetTextColor(255, 255, 255);
$pdf->SetAligns(array('C'));
$pdf->SetWidths(array(68));
$pdf->Row(array(utf8_decode($valueValuo['val_incripcion_registro'])),array('0'),array(array('Arial','','6')),false);
$posiciony+=3;
$pdf->cuadrogrande(141,$posiciony,68,3,0,D);
$pdf->SetAligns(array('C','C'));
$pdf->SetWidths(array(30,30));
$pdf->SetTextColor(3, 3, 3);
$pdf->Row(array("Matricula No",$valueValuo['val_inscripcion_registro_matricula']),array('0'),array(array('Arial','','6.5'),array('Arial','','6.5')),false);




$posiciony+=6;$pdf->SetFillColor(160,160,160);
$pdf->cuadrogrande(9,$posiciony,80,3,1,FD);
$pdf->SetAligns(array('L','L','C'));
$pdf->SetWidths(array(26,40,14));
$pdf->Row(array("CONST. ESTRUCTURA","ESTRUCTURA ACTUAL","ESTADO %"),array('0'),array(array('Arial','','6'),array('Arial','','6'),array('Arial','','6')),false);
$posiciony+=3;
$pdf->cuadrogrande(9,$posiciony,80,3,0,D);
$pdf->Row(array("TECHOS",$valueValuo['estruc_techos'],($valueValuo['rango_techo']>0) ? round($valueValuo['rango_techo'])."%" : "-"),array('0'),array(array('Arial','','5'),array('Arial','','6'),array('Arial','','6')),false);
$posiciony+=3;
$pdf->cuadrogrande(9,$posiciony,80,3,0,D);
$pdf->Row(array("ARTESON",$valueValuo['estruc_arteson'],($valueValuo['rango_arteson']>0) ? round($valueValuo['rango_arteson'])."%" : "-"),array('0'),array(array('Arial','','5'),array('Arial','','6'),array('Arial','','6')),false);
$posiciony+=3;
$pdf->cuadrogrande(9,$posiciony,80,3,0,D);
$pdf->Row(array("PAREDES",$valueValuo['estruc_paredes'],($valueValuo['rango_paredes']>0) ? round($valueValuo['rango_paredes'])."%" : "-"),array('0'),array(array('Arial','','5'),array('Arial','','6'),array('Arial','','6')),false);
$posiciony+=3;
$pdf->cuadrogrande(9,$posiciony,80,3,0,D);
$pdf->Row(array("PUERTAS",$valueValuo['estruc_puertas'],($valueValuo['rango_puertas']>0) ? round($valueValuo['rango_puertas'])."%" : "-"),array('0'),array(array('Arial','','5'),array('Arial','','6'),array('Arial','','6')),false);
$posiciony+=3;
$pdf->cuadrogrande(9,$posiciony,80,3,0,D);
$pdf->Row(array("PORTONES",$valueValuo['estruc_portones'],($valueValuo['rango_portones']>0) ? round($valueValuo['rango_portones'])."%" : "-"),array('0'),array(array('Arial','','5'),array('Arial','','6'),array('Arial','','6')),false);
$posiciony+=3;
$pdf->cuadrogrande(9,$posiciony,80,3,0,D);
$pdf->Row(array("VENTANAS",$valueValuo['estruc_ventanas'],($valueValuo['rango_ventanas']>0) ? round($valueValuo['rango_ventanas'])."%" : "-"),array('0'),array(array('Arial','','5'),array('Arial','','6'),array('Arial','','6')),false);
$posiciony+=3;
$pdf->cuadrogrande(9,$posiciony,80,3,0,D);
$pdf->Row(array("CIELO FALSO",$valueValuo['estruc_cielo_falso'],($valueValuo['rango_cielofalso']>0) ? round($valueValuo['rango_cielofalso'])."%" : "-"),array('0'),array(array('Arial','','5'),array('Arial','','6'),array('Arial','','6')),false);
$posiciony+=3;
$pdf->cuadrogrande(9,$posiciony,80,3,0,D);
$pdf->Row(array("PISOS",$valueValuo['estruc_pisos'],($valueValuo['rango_pisos']>0) ? round($valueValuo['rango_pisos'])."%" : "-"),array('0'),array(array('Arial','','5'),array('Arial','','6'),array('Arial','','6')),false);
$posiciony+=3;
$pdf->cuadrogrande(9,$posiciony,80,3,0,D);
$pdf->Row(array("PLAFOM-ENTREPISOS",$valueValuo['estruc_plafom'],($valueValuo['rango_plafom']>0) ? round($valueValuo['rango_plafom'])."%" : "-"),array('0'),array(array('Arial','','5'),array('Arial','','6'),array('Arial','','6')),false);
$posiciony+=3;
$pdf->cuadrogrande(9,$posiciony,80,3,0,D);
$pdf->Row(array("INSTALACION ELECTRICA",$valueValuo['estruc_inst_electr'],($valueValuo['rango_inst_electr']>0) ? round($valueValuo['rango_inst_electr'])."%" : "-"),array('0'),array(array('Arial','','5'),array('Arial','','6'),array('Arial','','6')),false);
$posiciony+=3;
$pdf->cuadrogrande(9,$posiciony,80,3,0,D);
$pdf->Row(array("TUBERIA AGUA POTABLE",$valueValuo['estruc_tub_agua'],($valueValuo['rango_tub_agua']>0) ? round($valueValuo['rango_tub_agua'])."%" : "-"),array('0'),array(array('Arial','','5'),array('Arial','','6'),array('Arial','','6')),false);
$posiciony+=3;
$pdf->cuadrogrande(9,$posiciony,80,3,0,D);
$pdf->Row(array("BALCONES",$valueValuo['estruc_balcones'],($valueValuo['rango_balcones']>0) ? round($valueValuo['rango_balcones'])."%" : "-"),array('0'),array(array('Arial','','5'),array('Arial','','5'),array('Arial','','6')),false);
$posiciony+=3;
$pdf->cuadrogrande(9,$posiciony,80,3,0,D);
$pdf->Row(array("ACABADOS",$valueValuo['estruc_acabados'],($valueValuo['rango_acabados']>0) ? round($valueValuo['rango_acabados'])."%" : "-"),array('0'),array(array('Arial','','5'),array('Arial','','6'),array('Arial','','6')),false);
$posiciony+=3;
$pdf->SetAligns(array('L','C'));
$pdf->SetWidths(array(65,15));
$pdf->cuadrogrande(9,$posiciony,80,3,0,D);
$pdf->Row(array("ESTADO PORCENTUAL DE LAS EDIFICACIONES",($valueValuo['valor_rango_media']>0) ? round($valueValuo['valor_rango_media'])."%" : "-"),array('0'),array(array('Arial','B','6'),array('Arial','B','6')),false);

$posiciony-=42;
$pdf->SetAligns(array('L'));
$pdf->SetWidths(array(120));$pdf->SetFillColor(160,160,160);
$pdf->cuadrogrande(89,$posiciony,120,3,1,FD);
$pdf->Row(array("DESEMBRACIONES"),array('0'),array(array('Arial','','6')),false);
$posiciony+=3;
$pdf->cuadrogrande(89,$posiciony,120,8.2,0,D);
$pdf->Row(array(utf8_decode($valueValuo['val_desmenbraciones'])),array('0'),array(array('Arial','','6')),false);
$posiciony+=8.2;
$pdf->SetAligns(array('L'));
$pdf->SetWidths(array(120));$pdf->SetFillColor(160,160,160);
$pdf->cuadrogrande(89,$posiciony,120,3,1,FD);
$pdf->Row(array("SERVIDUMBRE"),array('0'),array(array('Arial','','6')),false);
$posiciony+=3;
$pdf->cuadrogrande(89,$posiciony,120,8.2,0,D);
$pdf->Row(array(utf8_decode($valueValuo['val_servidumbres'])),array('0'),array(array('Arial','','6')),false);
$posiciony+=8.2;
$pdf->SetAligns(array('L'));
$pdf->SetWidths(array(120));$pdf->SetFillColor(160,160,160);
$pdf->cuadrogrande(89,$posiciony,120,3,1,FD);
$pdf->Row(array("EQUIPAMIENTO SOCIAL"),array('0'),array(array('Arial','','6')),false);
$posiciony+=3;
$pdf->cuadrogrande(89,$posiciony,120,8.2,0,D);
$pdf->Row(array(utf8_decode($valueValuo['val_equipamiento'])),array('0'),array(array('Arial','','6')),false);
$posiciony+=8.2;
$pdf->SetAligns(array('L'));
$pdf->SetWidths(array(120));$pdf->SetFillColor(160,160,160);
$pdf->cuadrogrande(89,$posiciony,120,3,1,FD);
$pdf->Row(array("RIESGO DELINCUENCIAL"),array('0'),array(array('Arial','','6')),false);
$posiciony+=3;
$pdf->cuadrogrande(89,$posiciony,120,8.2,0,D);
$pdf->Row(array(utf8_decode($valueValuo['val_riesgo_delincuencial'])),array('0'),array(array('Arial','','6')),false);


$posiciony+=12;
$pdf->SetFillColor(160,160,160);
//$pdf->SetTextColor(255, 255, 255);
$pdf->cuadrogrande(9,$posiciony,200,4,1,FD);
$pdf->SetAligns(array('C','C'));
$pdf->SetWidths(array(28,172));
$pdf->Row(array("MODULO","DETALLE DE LAS EDIFICACIONES, DENTRO DEL TERRENO GARANTIA"),array('0'),array(array('Arial','','7')),false);


$datosRoss = $DAO->mostrarAll($conexion,"select * from val_valuos_descripcion_construccion_ross where id_val_valuos='$idvaluos'");


$posiciony+=3.1;
if(!empty($datosRoss)){
	foreach ($datosRoss as $valueRoss) {
		$pdf->SetAligns(array('C'));
	    $pdf->SetWidths(array(28,172));
		//$pdf->SetTextColor(255, 255, 255);
		$pdf->SetFillColor(192,192,192);
	   // $pdf->cuadrogrande(9,$posiciony,28,7,0,FD);
		if(strlen(utf8_decode($valueRoss['descripcion_valuos_descripcion']))>310){
	    	$pdf->RowPeque(array("\n\n".$valueRoss['nombre_valuos_descripcion'],ucwords(utf8_decode(trim(strtolower($valueRoss['descripcion_valuos_descripcion']))))),array('1',1),array(array('Arial','','6'),array('Arial','','7')),false);
	    }else if(strlen(utf8_decode($valueRoss['descripcion_valuos_descripcion']))>162){
	    	$pdf->RowPeque(array("\n".$valueRoss['nombre_valuos_descripcion'],ucwords(utf8_decode(trim(strtolower($valueRoss['descripcion_valuos_descripcion']))))),array('1',1),array(array('Arial','','6'),array('Arial','','7')),false);
	    }else{
	    	
	    			$pdf->RowPeque(array($valueRoss['nombre_valuos_descripcion'],ucwords(utf8_decode(trim(strtolower($valueRoss['descripcion_valuos_descripcion']))))),array('1',1),array(array('Arial','','6'),array('Arial','','7')),false);
	    		
	    	
	    }
	    $pdf->SetAligns(array('L'));
	    $pdf->SetWidths(array(172));
		$pdf->SetTextColor(2, 2, 2);
	    //$pdf->cuadrogrande(37,$posiciony,172,7,0,D);
		//$pdf->RowPeque(array(),array('0'),array(array('Arial','','6')),false);
		$posiciony+=7;
	}
}else{
	 $pdf->SetAligns(array('C'));
	    $pdf->SetWidths(array(200));
		$pdf->SetTextColor(2, 2, 2);
	   // $pdf->cuadrogrande(9,$posiciony,200,7,0,D);
		$pdf->RowPeque(array("\nNO HAY REGISTROS ACTUALMENTE"),array('1'),array(array('Arial','','6')),false);
		$posiciony+=7;
}
$posiciony+=0;
    $pdf->SetAligns(array('C'));
    $pdf->SetWidths(array(200));
	//$pdf->SetTextColor(255, 255, 255);
	$pdf->SetFillColor(160,160,160);
   // $pdf->cuadrogrande(9,$posiciony,200,3.5,1,FD);
	$pdf->Row(array("APLICANDO EL METODO ROSS HEIDECKE"),array('1'),array(array('Arial','','7')),array(true),'',array(array('160','160','160')));
$posiciony+=3.5;
    $pdf->SetAligns(array('C','C','C','C','C','C','C','C','C','C','C'));
    $pdf->SetWidths(array(20,18,18,17,18,18,16,17,13,25,20));
    $pdf->SetFillColor(192,192,192);
	//$pdf->cuadrogrande(9,$posiciony,200,3.5,1,FD);
	$pdf->RowPeque(array("MODULO","VRN","AREA M2","EDAD","VUT","FC","VNR","FE=Q","VUR","TVRN=VRN*C","Valor Actual"),array('1','1','1','1','1','1','1','1','1','1','1'),array(array('Arial','','6')),array('true','true','true','true','true','true','true','true','true','true','true'),'',array(array('192','192','192'),array('192','192','192'),array('192','192','192'),array('192','192','192'),array('192','192','192'),array('192','192','192'),array('192','192','192'),array('192','192','192'),array('192','192','192'),array('192','192','192'),array('192','192','192')));
	$posiciony+=3.5;
	 $pdf->SetAligns(array('L','L','L','L','L','L','L','L','L','L','L'));
	 $pdf->SetWidths(array(20,18,18,17,18,18,16,17,13,25,20));
if(!empty($datosRoss)){
foreach($datosRoss as $valueRoss1){
	
	$pdf->SetTextColor(2, 2, 2);
    //$pdf->cuadrogrande(9,$posiciony,200,2.5,0,D);
	$pdf->RowPeque(array($valueRoss1['nombre_valuos_descripcion'],"$ ".number_format($valueRoss1['valor_unitario_valuos_descripcion'],2,".",","),$valueRoss1['dimension_m2_valuos_descripcion'],$valueRoss1['edad_valuos_descripcion'],$valueRoss1['VUT_valuos_descripcion'],$valueRoss1['FC_valuos_descripcion'],"$ ".$valueRoss1['VNR_valuos_descripcion'],$valueRoss1['FE_valuos_descripcion'],$valueRoss1['VUR_valuos_descripcion'],"$ ".number_format($valueRoss1['TVRN_parcial_valuos_descripcion'],2,".",","),"$ ".number_format($valueRoss1['VA_parcial_valuos_descripcion'],2,".",",")),array('1','1','1','1','1','1','1','1','1','1','1'),array(array('Arial','','6')),false);
	$posiciony+=2.5;
}
}else{
	 $pdf->SetAligns(array('C'));
	    $pdf->SetWidths(array(200));
		$pdf->SetTextColor(2, 2, 2);
	    //$pdf->cuadrogrande(9,$posiciony,200,3,0,D);
		$pdf->RowPeque(array("NO HAY REGISTROS ACTUALMENTE"),array('1'),array(array('Arial','','6')),false);
		$posiciony+=3;
}
$datossumametros = $DAO->mostrarAll($conexion,"select sum(dimension_m2_valuos_descripcion) from val_valuos_descripcion_construccion_ross where id_val_valuos='$idvaluos'");
            foreach ($datossumametros as $valuedatossumametros) {}
$datoConstruccion = $DAO->mostrarAll($conexion,"select sum(TVRN_parcial_valuos_descripcion) from val_valuos_descripcion_construccion_ross where id_val_valuos='$idvaluos'");
            foreach ($datoConstruccion as $valuedatoConstruccion) {}

$datoDepresiado = $DAO->mostrarAll($conexion,"select sum(VA_parcial_valuos_descripcion) from val_valuos_descripcion_construccion_ross where id_val_valuos='$idvaluos'");
            foreach ($datoDepresiado as $valuedatoDepresiado) {}

//$pdf->SetTextColor(255, 255, 255);
$pdf->SetAligns(array('C','C','C','C','C','C'));
   $pdf->SetWidths(array(38,18,48,25,51,20));
    //$pdf->cuadrogrande(9,$posiciony,42,3,0,FD);
	$pdf->Row(array("TOTAL CONST. M2",$valuedatossumametros[0],"VALOR DE CONSTRUCCION","$ ".number_format($valuedatoConstruccion[0],2,".",","),"VALOR DEPRECIADO","$ ".number_format($valuedatoDepresiado[0],2,".",",")),array('1','1','1','1','1','1'),array(array('Arial','','5'),array('Arial','B','5'),array('Arial','','5'),array('Arial','B','5'),array('Arial','','5'),array('Arial','B','5')),array(false,true,false,true,false,true),array(''),array('',array('255','221','0'),'',array('192','192','192'),'',array('192','192','192')));
$pdf->SetFillColor(192,192,192);
/*
$pdf->SetFillColor(255, 249, 0);
$pdf->SetTextColor(3, 3, 3);
$pdf->SetAligns(array('C'));
    $pdf->SetWidths(array(25));
    $pdf->cuadrogrande(51,$posiciony,25,3,0,FD);
	$pdf->Row(array(),array('0'),array(array('Arial','','6')),false);

$pdf->SetFillColor(192,192,192);
$pdf->SetAligns(array('C'));
    $pdf->SetWidths(array(44));
    $pdf->cuadrogrande(76,$posiciony,44,3,0,FD);
	$pdf->Row(array(),array('0'),array(array('Arial','','6.5')),false);



$pdf->SetTextColor(3, 3, 3);
$pdf->SetAligns(array('C'));
    $pdf->SetWidths(array(25));
    $pdf->cuadrogrande(120,$posiciony,25,3,0,D);
	$pdf->Row(array(),array('0'),array(array('Arial','B','6')),false);

//$pdf->SetTextColor(255, 255, 255);
$pdf->SetAligns(array('C'));
    $pdf->SetWidths(array(44));
    $pdf->cuadrogrande(145,$posiciony,44,3,0,FD);
	$pdf->Row(array(),array('0'),array(array('Arial','','7')),false);

$pdf->SetTextColor(3, 3, 3);
$pdf->SetAligns(array('R'));
    $pdf->SetWidths(array(18));
    $pdf->cuadrogrande(189,$posiciony,20,3,0,D);
	$pdf->Row(array(),array('0'),array(array('Arial','B','6')),false);*/

$pdf->RowPeque(array(""),array(),array(),array());
$posiciony+=4;
$pdf->SetFillColor(160,160,160);
//$pdf->SetTextColor(255, 255, 255);
//$pdf->cuadrogrande(9,$posiciony,120,3.7,1,FD);
$pdf->SetAligns(array('C','L'));
$pdf->SetWidths(array(120,85));
$pdf->Row(array("DETALLE DEL VALUO","VUT=Vida Util Total, FC=Facto de Conversion, TVRN=Total Valor Repos. Nuevo"),array('1',0),array(array('Arial','','7'),array('Arial','','5.5')),array(true,false),'',array(array('160','160','160')));


//$pdf->cuadrogrande_salto(122,$posiciony,80,3,1,D,true);
//$pdf->SetAligns(array('C'));
//$pdf->SetWidths(array(80));
//$pdf->RowPeque(array("VUskfdsfksdjfsdjf"),array('0'),array(array('Arial','','5')),false);
/*
$posiciony+=8;
$pdf->cuadrogrande(129,$posiciony,25,8,1,FD);
$pdf->SetAligns(array('C'));
$pdf->SetWidths(array(25));
$pdf->Row(array("\nASEGURANZA"),array('0'),array(array('Arial','','8')),false);

$pdf->SetFillColor(192,192,192);
$pdf->cuadrogrande(154,$posiciony,30,4,1,FD);
$pdf->SetAligns(array('C'));
$pdf->SetWidths(array(30));
$pdf->Row(array("Construccion Nueva"),array('0'),array(array('Arial','','8')),false);

$pdf->cuadrogrande(184,$posiciony,25,4,1,D);
$pdf->SetAligns(array('C'));
$pdf->SetWidths(array(25));
$pdf->Row(array("$ ".number_format($valuedatoConstruccion[0],2,".",",")),array('0'),array(array('Arial','','8')),false);

$posiciony+=4;
$pdf->SetFillColor(192,192,192);
$pdf->cuadrogrande(154,$posiciony,30,4,1,FD);
$pdf->SetAligns(array('C'));
$pdf->SetWidths(array(30));
$pdf->Row(array("Const. Depresiada"),array('0'),array(array('Arial','','8')),false);

$pdf->cuadrogrande(184,$posiciony,25,4,1,D);
$pdf->SetAligns(array('C'));
$pdf->SetWidths(array(25));
$pdf->Row(array("$ ".number_format($valuedatoDepresiado[0],2,".",",")),array('0'),array(array('Arial','','8')),false);
*/
$posiciony-=8;
$pdf->SetFillColor(192,192,192);
//$pdf->SetTextColor(255, 255, 255);
//$pdf->cuadrogrande_salto(0,$posiciony,120,2,1,FD,true);
$pdf->SetAligns(array('C',"C","C","C","C","L"));
$pdf->SetWidths(array(30,20,15,25,30,78));
$pdf->RowPeque(array("TERRENO","AREA M2","AREA V2","VALOR POR VARA","VALOR TOTAL","VRN=Valor de reposicion nuevo, FE=Factor de estado, VUR=Vida Util Remanente"),array('1','1','1','1','1','0'),array(array('Arial','','5.5')),array(true,true,true,true,true,false),'',array(array('192','192','192'),array('192','192','192'),array('192','192','192'),array('192','192','192'),array('192','192','192')));

/*
$pdf->cuadrogrande_salto(122,$posiciony,80,7,1,D,false);
$pdf->SetAligns(array('C'));
$pdf->SetWidths(array(80));
$pdf->RowPeque(array("VNR=Valor Neto de Reposicion  TVRN=Total Valor de Reposicion Nuevo"),array('0'),array(array('Arial','','5')),false);
*/
$datosDValuo = $DAO->mostrarAll($conexion,"select * from val_detalle_de_valuos_urbanos where id_val_valuos='$idvaluos'");

$posiciony+=4;$num=1;
if(!empty($datosDValuo)){
	foreach($datosDValuo as $valuedatosDValuo){
		
		$pdf->SetTextColor(2, 2, 2);
	    //$pdf->cuadrogrande_salto(0,$posiciony,120,2.2,0,D,true);
	    if($num==1){
		$pdf->RowPeque(array($valuedatosDValuo['det_terreno'],$valuedatosDValuo['det_val_metros'],$valuedatosDValuo['det_val_varas'],$valuedatosDValuo['det_val_valor_varas'],"$ ".number_format($valuedatosDValuo['det_val_total'],2,".",",")),array('1','1','1','1','1'),array(array('Arial','','6')),array(false,false,false,false,true),'',array('','','','',array('255','211','0')));
		}else{
			$pdf->RowPeque(array($valuedatosDValuo['det_terreno'],$valuedatosDValuo['det_val_metros'],$valuedatosDValuo['det_val_varas'],$valuedatosDValuo['det_val_valor_varas'],"$ ".number_format($valuedatosDValuo['det_val_total'],2,".",",")),array('1','1','1','1','1'),array(array('Arial','','6')),array(false,false,false,false,true),'',array('','','','',array('255','211','0')));
		}
		$num++;
		$posiciony+=2.5;
	}
}else{
	$pdf->SetAligns(array('C'));
$pdf->SetWidths(array(120));
	$pdf->SetTextColor(2, 2, 2);
	    //$pdf->cuadrogrande_salto(0,$posiciony,120,2.2,0,D,true);
	$pdf->RowPeque(array("NO HAY REGISTROS ACTUALMENTE"),array('1'),array(array('Arial','','6')),false);
}
$pdf->SetAligns(array('C','C','L'));
$pdf->SetWidths(array(90,30,40,15));
$pdf->RowPeque(array("","","",""),array('0','0','0','0'),array(array('Arial','','5'),array('Arial','B','5'),array('Arial','B','6')),false);
$pdf->RowPeque(array("TERRENO INSCRITO + EDIFICACIONES DEPRECIADAS","$ ".number_format($valorinscrito,2,".",","),"ASEGURANZA",""),array('1','1','0','0'),array(array('Arial','','5'),array('Arial','B','5'),array('Arial','B','6')),array(false,true,false,false),'',array('',array('255','211','0')));
$posiciony+=0;
$pdf->SetFillColor(192,192,192);
//$pdf->SetTextColor(5, 100, 255);
//$pdf->cuadrogrande_salto(0,$posiciony,90,3.5,0,D);
$pdf->SetAligns(array('C','C'));
$pdf->SetWidths(array(90,30,40,15));
$pdf->RowPeque(array("EDIFICACIONES CON VALOR DEPRECIADO","$ ".number_format($valuedatoDepresiado[0],2,".",","),"Construccion Nueva","$ ".number_format($valuedatoConstruccion[0],2,".",",")),array('1','1','LT','RLT'),array(array('Arial','','5'),array('Arial','B','5'),array('Arial','','6'),array('Arial','B','6')),array(false,true,false,false),array('','','',array('0','102','204')),array('',array('255','211','0')));


$pdf->SetTextColor(2, 2, 2);
    //$pdf->cuadrogrande_salto(90,$posiciony,30,3.5,0,FD,false);
    $pdf->SetAligns(array('C'));
$pdf->SetWidths(array(30,40));
	//$pdf->Row(array(),array('0'),array(array('Arial','B','7'),array('Arial','','7'),array('Arial','B','7')),false);



$posiciony+=3.5;
$pdf->SetFillColor(192,192,192);
//$pdf->SetTextColor(255, 255, 255);
//$pdf->cuadrogrande_salto(0,$posiciony,90,3.5,0,D,true);
$pdf->SetAligns(array('C','C'));
$pdf->SetWidths(array(90,30,40,15));
$pdf->RowPeque(array("VALOR (TERRENO INSCRITO + TERRENO EXCEDENTE) MAS EDIFICACIONES DEPRECIADAS","$ ".number_format($valueValuo['val_valuo_inmueble'],2,".",","),"Contruccion Depreciada","$ ".number_format($valuedatoDepresiado[0],2,".",",")),array('1','1','LTB','RLBT'),array(array('Arial','','5'),array('Arial','B','5'),array('Arial','','6'),array('Arial','B','6')),array(false,true,false,false),array('','','',array('0','102','204')),array('',array('255','211','0')));

$pdf->SetTextColor(2, 2, 2);
   // $pdf->cuadrogrande_salto(90,$posiciony,30,3.5,0,FD,false);
    $pdf->SetAligns(array('C'));
$pdf->SetWidths(array(30,40));
	//$pdf->Row(array(),array('0'),array(array('Arial','B','7'),array('Arial','','7'),array('Arial','B','7')),false);
	

$pdf->RowPeque(array(""),array('0','0'),array(array('Arial','B','6'),array('Arial','','6')),FALSE);

$posiciony+=3;
$pdf->SetFillColor(160,160,160);
//$pdf->SetTextColor(255, 255, 255);
//$pdf->cuadrogrande_salto(2,$posiciony,200,4.5,1,D);
$pdf->SetAligns(array('L'));
$pdf->SetWidths(array(200));
$pdf->RowPeque(array("RENTA Y USO : ".utf8_decode($valueValuo['val_renta_uso'])),array('B'),array(array('Arial','','6'),array('Arial','','6')),FALSE);
$posiciony+=3;
$pdf->SetFillColor(160,160,160);
$pdf->RowPeque(array(""),array('0','0'),array(array('Arial','B','6'),array('Arial','','6')),FALSE);
//$pdf->SetTextColor(255, 255, 255);
//$pdf->cuadrogrande_salto(2,$posiciony,200,4.5,1,D);
$pdf->SetAligns(array('J','J'));
$pdf->SetWidths(array(30,170));
$pdf->RowPeque(array("VALOR COMERCIAL : ",utf8_decode($valueValuo['val_compra_venta'])),array('B','B'),array(array('Arial','','6'),array('Arial','B','6')),array(false),array('',array('0','102','204')));
$pdf->RowPeque(array(""),array(''),array(array('Arial','','6'),array('Arial','','6')),false);
$posiciony+=0;
$pdf->SetFillColor(160,160,160);
//$pdf->SetTextColor(255, 255, 255);
//$pdf->cuadrogrande_salto(2,$posiciony,200,4.5,1,D);
$pdf->SetAligns(array('J'));
$pdf->SetWidths(array(200));
$pdf->RowPeque(array("CARACTERISTICAS DE LA ZONA : ".utf8_decode($valueValuo['val_descripcion_ubicacion'])),array('B'),array(array('Arial','','6'),array('Arial','','6')),FALSE);





$pdf->RowPeque(array(""),array(''),array(array('Arial','','6'),array('Arial','','6')),false);

$posiciony+=3;
$pdf->SetFillColor(160,160,160);
//$pdf->SetTextColor(255, 255, 255);
//$pdf->cuadrogrande_salto(2,$posiciony,200,4.5,1,D);
$pdf->SetAligns(array('J'));
$pdf->SetWidths(array(200));
$pdf->RowPeque(array("RIESGO POR DESASTRE NATURAL : ".utf8_decode($valueValuo['val_desastre'])),array('B'),array(array('Arial','','6'),array('Arial','','6')),false);

$pdf->RowPeque(array(""),array(''),array(array('Arial','','6'),array('Arial','','6')),false);

$posiciony+=3;
$pdf->SetFillColor(160,160,160);
//$pdf->SetTextColor(255, 255, 255);
//$pdf->cuadrogrande_salto(2,$posiciony,200,4.5,1,D);
$pdf->SetAligns(array('J'));
$pdf->SetWidths(array(200));
$pdf->RowPeque(array("AMBIENTE, CONTAMINACION, INDUSTRIAS : ".utf8_decode($valueValuo['val_ambiente'])),array('B'),array(array('Arial','','6'),array('Arial','','6')),false);

$pdf->RowPeque(array(""),array(''),array(array('Arial','','6'),array('Arial','','6')),false);
$posiciony+=3;
$pdf->SetFillColor(160,160,160);
//$pdf->SetTextColor(255, 255, 255);
//$pdf->cuadrogrande_salto(2,$posiciony,200,4.5,1,D);
$pdf->SetAligns(array('J'));
$pdf->SetWidths(array(200));
$pdf->RowPeque(array("COMENTARIOS Y CONCLUSIONES : ".utf8_decode($valueValuo['val_conclusiones'])),array('B'),array(array('Arial','','6'),array('Arial','','6')),false);


$pdf->Output(); //Salida al navegador
?>