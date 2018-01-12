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
$datosDetalle_parcial = $DAO->mostrarAll($conexion,"select sum(det_val_total) from val_detalle_de_valuos where id_val_valuos='$idvaluos' and det_terreno!='Area Excedente'");
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
$posiciony+=3;
$pdf->SetAligns(array('L','L'));
$pdf->SetWidths(array(70,33));$pdf->SetFillColor(192,192,192);
$pdf->cuadrogrande(9,$posiciony,103,3,1,FD);
$pdf->Row(array("PROPIETARIO","NATURALEZA DEL INMUEBLE"),array('0','0','0'),array(array('Arial','','6'),array('Arial','','6'),array('Arial','','6')),false);
$posiciony+=3;
$pdf->cuadrogrande(9,$posiciony,103,3.5,0,D);
$pdf->Row(array(utf8_decode($valueValuo['val_propietario']),$valueValuo['val_naturaleza_inmueble']),array('0','0','0'),array(array('Arial','','6'),array('Arial','','6'),array('Arial','','6')),false);

/*
$pdf->SetFillColor(160,160,160);
$pdf->SetTextColor(3, 3, 3);
$pdf->cuadrogrande(7,$posiciony,103,4,1,FD);
$pdf->SetAligns(array('C'));
$pdf->SetWidths(array(103));
$pdf->Row(array("DATOS DEL CLIENTE"),array('0'),array(array('Arial','','8')),false);*/
$posiciony-=9.5;$pdf->SetFillColor(192,192,192);
$pdf->cuadrogrande(112,$posiciony,97,4,1,FD);
$pdf->SetAligns(array('L','L'));
$pdf->SetWidths(array(48,49));
$pdf->Row(array("UBICACION DEL INMUEBLE","VIAS DE ACCESO"),array('0'),array(array('Arial','','6')),false);
$posiciony+=4;
$pdf->cuadrogrande(112,$posiciony,97,9,0,D);
$pdf->SetTextColor(3, 3,3);
$pdf->RowPeque(array(utf8_decode($valueValuo['val_ubicacion']),utf8_decode($valueValuo['val_vias_acceso'])),array('0'),array(array('Arial','','6')),false);



$posiciony+=12.5;
$pdf->SetFillColor(160,160,160);
//$pdf->SetTextColor(255, 255, 255);
$pdf->cuadrogrande(9,$posiciony,200,3.5,1,FD);
$pdf->SetAligns(array('C'));
$pdf->SetWidths(array(193));
$pdf->Row(array("ENTORNO DEL INMUEBLE"),array('0'),array(array('Arial','','7')),false);

$pdf->SetFillColor(192,192,192);
$posiciony+=3.6;
$pdf->cuadrogrande(9,$posiciony,200,3.5,1,FD);
$pdf->SetAligns(array('J','C','C','C','C','C','J','J','J','J','J','J','J','L'));
$pdf->SetWidths(array(22,6,10,18,15,20,26,6,7,15,19,6,7,23));
$pdf->Row(array("ENTORNO","SI","NO","SERVICIOS","INMUEBLE","ENTORNO","CONTAMINANTES","SI","NO","DIST. MTS","SANITARIOS","SI","NO","COMENTARIO"),array('0','0','0','0','0','0','0','0','0','0','0','0','0'),array(array('Arial','','6'),array('Arial','','6')),false);

$pdf->SetTextColor(3, 3,3);
$posiciony+=3.4;

 ($valueValuo['val_sector_industrial']==1) ? $val_sector_industrial1 = "X" : $val_sector_industrial2 ="X";
 ($valueValuo['val_sector_habitacional']==1) ? $val_sector_habitacional1="X" : $val_sector_habitacional2="X";
 ($valueValuo['val_sector_comercial']==1) ? $val_sector_comercial1="X" : $val_sector_comercial2="X";
 ($valueValuo['val_comunidad_marginal']==1) ? $val_comunidad_marginal1="X" : $val_comunidad_marginal2="X";
 ($valueValuo['val_zona_agricola']==1) ? $val_zona_agricola1="X" : $val_zona_agricola2="X";

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

 ($valueValuo['cont_desc_aguas_negras']==1) ? $cont_desc_aguas_negras1="X" : $cont_desc_aguas_negras2="X";
 ($valueValuo['cont_des_indus']==1) ? $cont_des_indus1="X" : $cont_des_indus2="X";
 ($valueValuo['cont_basurero']==1) ? $cont_basurero1="X" : $cont_basurero2="X";
 ($valueValuo['cont_ant_tel']==1) ? $cont_ant_tel1="X" : $cont_ant_tel2="X";

 ($valueValuo['san_inod_china']==1) ? $san_inod_china1="X" : $san_inod_china2="X";
 ($valueValuo['san_letrina_fosa']==1) ? $san_letrina_fosa1="X" : $san_letrina_fosa2="X";
 ($valueValuo['san_letrina_abonera']==1) ? $san_letrina_abonera1="X" : $san_letrina_abonera2="X";
 ($valueValuo['san_pila_lav']==1) ? $san_pila_lav1="X" : $san_pila_lav2="X";
 ($valueValuo['san_banio']==1) ? $san_banio1="X" : $san_banio2="X";



$pdf->SetAligns(array('J','C','C'));
$pdf->SetWidths(array(22,6,10));
$pdf->cuadrogrande(9,$posiciony,39,3,0,D);
$pdf->Row(array("Sector Industrial",$val_sector_industrial1,$val_sector_industrial2),array('0','0','0'),array(array('Arial','','6'),array('Arial','','5'),array('Arial','','5')),false);
$pdf->SetAligns(array('J','C','C'));
$pdf->SetWidths(array(18,15,20));
$pdf->cuadrogrande(48,$posiciony,53,3,0,D);
$pdf->Row(array("Agua Potable",$serv_agua_pot_inmueble,$serv_agua_pot_entorno),array('0','0','0'),array(array('Arial','','6'),array('Arial','','5'),array('Arial','','5')),false);
$pdf->SetAligns(array('L','J','J','J'));
$pdf->SetWidths(array(26,6,7,15));
$pdf->cuadrogrande(101,$posiciony,53,3,0,D);
$pdf->Row(array("Descarga Aguas Negras",$cont_desc_aguas_negras1,$cont_desc_aguas_negras2,$valueValuo['cont_desc_aguas_negras_dist']),array('0','0','0'),array(array('Arial','','6'),array('Arial','','5'),array('Arial','','5'),array('Arial','','6')),false);
$pdf->SetAligns(array('L','J','L'));
$pdf->SetWidths(array(19,6,7,23));
$pdf->cuadrogrande(154,$posiciony,55,3,0,D);
$pdf->Row(array("Inodoro de China",$san_inod_china1,$san_inod_china2,$valueValuo['san_inod_china_coment']),array('0','0','0'),array(array('Arial','','6'),array('Arial','','6'),array('Arial','','5')),false);

$posiciony+=3;

$pdf->SetAligns(array('J','C','C'));
$pdf->SetWidths(array(22,6,10));
$pdf->cuadrogrande(9,$posiciony,39,3,0,D);
$pdf->Row(array("Sector Habitacional",$val_sector_habitacional1,$val_sector_habitacional2),array('0','0','0'),array(array('Arial','','6'),array('Arial','','5'),array('Arial','','5')),false);
$pdf->SetAligns(array('J','C','C'));
$pdf->SetWidths(array(18,15,20));
$pdf->cuadrogrande(48,$posiciony,53,3,0,D);
$pdf->Row(array("Aguas Negras",$serv_agua_neg_inmueble,$serv_agua_neg_entorno),array('0','0','0'),array(array('Arial','','6'),array('Arial','','5'),array('Arial','','5')),false);
$pdf->SetAligns(array('L','J','J','J'));
$pdf->SetWidths(array(26,6,7,15));
$pdf->cuadrogrande(101,$posiciony,53,3,0,D);
$pdf->Row(array("Desechos Industriales",$cont_des_indus1,$cont_des_indus2,$valueValuo['cont_des_indus_dist']),array('0','0','0'),array(array('Arial','','6'),array('Arial','','5'),array('Arial','','5'),array('Arial','','6')),false);
$pdf->SetAligns(array('L','J','L'));
$pdf->SetWidths(array(19,6,7,23));
$pdf->cuadrogrande(154,$posiciony,55,3,0,D);
$pdf->Row(array("Letrina de Fosa",$san_letrina_fosa1,$san_letrina_fosa2,$valueValuo['san_letrina_fosa_coment']),array('0','0','0'),array(array('Arial','','6'),array('Arial','','6'),array('Arial','','5')),false);

$posiciony+=3;

$pdf->SetAligns(array('J','C','C'));
$pdf->SetWidths(array(22,6,10));
$pdf->cuadrogrande(9,$posiciony,39,3,0,D);
$pdf->Row(array("Sector Comercial",$val_sector_comercial1,$val_sector_comercial2),array('0','0','0'),array(array('Arial','','6'),array('Arial','','5'),array('Arial','','5')),false);
$pdf->SetAligns(array('J','C','C'));
$pdf->SetWidths(array(18,15,20));
$pdf->cuadrogrande(48,$posiciony,53,3,0,D);
$pdf->Row(array("Energ. Electr.",$serv_energ_inmueble,$serv_energ_entorno),array('0','0','0'),array(array('Arial','','6'),array('Arial','','5'),array('Arial','','5')),false);
$pdf->SetAligns(array('L','J','J','J'));
$pdf->SetWidths(array(26,6,7,15));
$pdf->cuadrogrande(101,$posiciony,53,3,0,D);
$pdf->Row(array("Basureros",$cont_basurero1,$cont_basurero2,$valueValuo['cont_basurero_dist']),array('0','0','0'),array(array('Arial','','6'),array('Arial','','5'),array('Arial','','5'),array('Arial','','6')),false);
$pdf->SetAligns(array('L','J','L'));
$pdf->SetWidths(array(19,6,7,23));
$pdf->cuadrogrande(154,$posiciony,55,3,0,D);
$pdf->Row(array("Letrina Abonera",$san_letrina_abonera1,$san_letrina_abonera2,$valueValuo['san_letrina_abonera_coment']),array('0','0','0'),array(array('Arial','','6'),array('Arial','','6'),array('Arial','','5')),false);

$posiciony+=3;

$pdf->SetAligns(array('J','C','C'));
$pdf->SetWidths(array(22,6,10));
$pdf->cuadrogrande(9,$posiciony,39,3,0,D);
$pdf->Row(array("Comunidad Marginal",$val_comunidad_marginal1,$val_comunidad_marginal2),array('0','0','0'),array(array('Arial','','6'),array('Arial','','5'),array('Arial','','5')),false);
$pdf->SetAligns(array('J','C','C'));
$pdf->SetWidths(array(18,15,20));
$pdf->cuadrogrande(48,$posiciony,53,3,0,D);
$pdf->Row(array("Aguas Lluvias",$serv_aguas_lluvias_inmueble,$serv_aguas_lluvias_entorno),array('0','0','0'),array(array('Arial','','6'),array('Arial','','5'),array('Arial','','5')),false);
$pdf->SetAligns(array('L','J','J','J'));
$pdf->SetWidths(array(26,6,7,15));
$pdf->cuadrogrande(101,$posiciony,53,3,0,D);
$pdf->Row(array("Antena Telefonica",$cont_ant_tel1,$cont_ant_tel2,$valueValuo['cont_ant_tel_dist']),array('0','0','0'),array(array('Arial','','6'),array('Arial','','5'),array('Arial','','5'),array('Arial','','6')),false);
$pdf->SetAligns(array('L','J','L','L'));
$pdf->SetWidths(array(19,6,7,23));
$pdf->cuadrogrande(154,$posiciony,55,3,0,D);
$pdf->Row(array("Pila, Lavadero",$san_pila_lav1,$san_pila_lav2,$valueValuo['san_pila_lav_coment']),array('0','0','0'),array(array('Arial','','6'),array('Arial','','6'),array('Arial','','5')),false);

$posiciony+=3;

$pdf->SetAligns(array('J','C','C'));
$pdf->SetWidths(array(22,6,10));
$pdf->cuadrogrande(9,$posiciony,39,3,0,D);
$pdf->Row(array("Zona Agricola",$val_zona_agricola1,$val_zona_agricola2),array('0','0','0'),array(array('Arial','','6'),array('Arial','','5'),array('Arial','','5')),false);
$pdf->SetAligns(array('J','C','C'));
$pdf->SetWidths(array(18,15,20));
$pdf->cuadrogrande(48,$posiciony,53,3,0,D);
$pdf->Row(array("Fosa Septica",$serv_fosa_sept_inmueble,$serv_fosa_sept_entorno),array('0','0','0'),array(array('Arial','','6'),array('Arial','','5'),array('Arial','','5')),false);
$pdf->SetAligns(array('L','J','J','J'));
$pdf->SetWidths(array(26,6,7,15));
$pdf->cuadrogrande(101,$posiciony,53,3,0,D);
$pdf->Row(array("","","",""),array('0','0','0'),array(array('Arial','','6'),array('Arial','','5'),array('Arial','','5'),array('Arial','','6')),false);
$pdf->SetAligns(array('L','J','L'));
$pdf->SetWidths(array(19,6,7,23));
$pdf->cuadrogrande(154,$posiciony,55,3,0,D);
$pdf->Row(array(utf8_decode("Baño"),$san_banio1,$san_banio2,$valueValuo['san_banio_coment']),array('0','0','0'),array(array('Arial','','6'),array('Arial','','6'),array('Arial','','5')),false);


$pdf->SetAligns(array('J','C','C','J','C','C','L','J','J','J','J','L','J','L'));
$pdf->SetWidths(array(22,6,10,18,15,20,26,6,7,15,19,6,7,23));




$posiciony+=6.3;
$pdf->SetFillColor(160,160,160);
//$pdf->SetTextColor(255, 255, 255);
$pdf->cuadrogrande(9,$posiciony,62,3.5,1,FD);
$pdf->SetAligns(array('C'));
$pdf->SetWidths(array(62));
$pdf->Row(array("RUMBOS Y DISTANCIAS"),array('0'),array(array('Arial','','7')),false);

$pdf->SetFillColor(160,160,160);
$pdf->cuadrogrande(71,$posiciony,138,6,1,FD);
$pdf->SetAligns(array('C'));
$pdf->SetWidths(array(138));
$pdf->Row1(array("LINDEROS Y COLINDANTES"),array('0'),array(array('Arial','','7')),false);

$pdf->SetAligns(array('L'));
$posiciony+=6;$pdf->SetTextColor(3, 3,3);
$pdf->cuadrogrande(71,$posiciony,138,15,0,D);
$pdf->Row(array(utf8_decode(ucfirst(mb_strtolower($valueValuo['val_colindante_norte'])))."\n".utf8_decode(ucfirst(mb_strtolower($valueValuo['val_colindante_sur'])))."\n".utf8_decode(ucfirst(mb_strtolower($valueValuo['val_colindante_oriente'])))."\n".utf8_decode(ucfirst(mb_strtolower($valueValuo['val_colindante_poniente'])))),array('0'),array(array('Arial','','6')),false);
/*$posiciony+=3.5;
$pdf->cuadrogrande(71,$posiciony,138,3.5,1,D);
$pdf->Row(array(),array('0'),array(array('Arial','','6')),false);
$posiciony+=3.5;
$pdf->cuadrogrande(71,$posiciony,138,3.5,1,D);
$pdf->Row(array(),array('0'),array(array('Arial','','6')),false);
$posiciony+=3.5;
$pdf->cuadrogrande(71,$posiciony,138,3.5,1,D);
$pdf->Row(array(),array('0'),array(array('Arial','','6')),false);*/

$posiciony-=6;
$pdf->SetFillColor(192,192,192);
$posiciony+=3.5;
$pdf->cuadrogrande(9,$posiciony,62,3.5,1,FD);
$pdf->SetAligns(array('C','C'));
$pdf->SetWidths(array(30,30));//$pdf->SetTextColor(255, 255, 255);
$pdf->Row(array("MEDIDAS ESCRITURA","DATOS DE CAMPO"),array('0','0','0'),array(array('Arial','','6'),array('Arial','','6')),false);
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


$pdf->SetFillColor(192,192,192);//$pdf->SetTextColor(255, 255, 255);
$posiciony+=6.5;
$pdf->cuadrogrande(9,$posiciony,200,4,1,FD);
$pdf->SetAligns(array('L','L'));
$pdf->SetWidths(array(100,100));
$pdf->Row(array("DESMEMBRACIONES","SERVIDUMBRE"),array('0'),array(array('Arial','','7')),false);
$pdf->SetTextColor(3, 3, 3);
$posiciony+=4;
$pdf->cuadrogrande(9,$posiciony,200,7,0,D);
$pdf->RowPeque(array(utf8_decode($valueValuo['val_desmenbraciones']),utf8_decode($valueValuo['val_servidumbres'])),array('0'),array(array('Arial','','6')),false);


$posiciony+=7;
$pdf->SetFillColor(160,160,160);
//$pdf->SetTextColor(255, 255, 255);
$pdf->cuadrogrande(9,$posiciony,62,3,1,FD);
$pdf->SetAligns(array('C'));
$pdf->SetWidths(array(62));
$pdf->Row(array("FUENTE DE INFORMACION"),array('0'),array(array('Arial','','7')),false);
$pdf->SetAligns(array('C'));
$pdf->SetWidths(array(141));$pdf->SetFillColor(160,160,160);
$pdf->cuadrogrande(71,$posiciony,138,6.2,1,FD);
$pdf->Row1(array("EXPLOTACION DEL TERRENO, CULTIVOS, POTREROS, OTROS"),array('0'),array(array('Arial','','7')),false);

$pdf->SetAligns(array('C'));
$pdf->SetWidths(array(62));
$posiciony+=3;
$pdf->cuadrogrande(9,$posiciony,62,3,0,D);
$pdf->SetTextColor(3, 3, 3);
$pdf->Row(array(utf8_decode($valueValuo['val_fuente_informacion'])),array('0'),array(array('Arial','','6')),false);

$posiciony+=3;$pdf->SetFillColor(192,192,192);
$pdf->cuadrogrande(9,$posiciony,62,3,1,FD);
//$pdf->SetTextColor(255, 255, 255);
$pdf->SetAligns(array('C','C','C','R'));
$pdf->SetWidths(array(25,11,14,10));
$pdf->Row(array("EXTENSION SUPERFICIAL","METROS","MANZANAS","VARAS"),array('0'),array(array('Arial','','5'),array('Arial','','5'),array('Arial','','5'),array('Arial','','5')),false);

$posiciony+=0.3;
$pdf->cuadrogrande(71,$posiciony,138,15,0,D);
$pdf->SetAligns(array('L'));
$pdf->SetWidths(array(138));
$pdf->SetTextColor(3, 3, 3);
$pdf->RowPeque(array(utf8_decode($valueValuo['val_explotacion_terreno_cultivs_potreros'])),array('0'),array(array('Arial','','6')),false);

$posiciony+=2.8;
$pdf->SetAligns(array('L','R','R','R'));
$pdf->SetWidths(array(22,12,14,13));
$pdf->cuadrogrande(9,$posiciony,62,3,0,D);
$pdf->SetTextColor(3, 3, 3);
$pdf->Row(array("AREA REGISTRAL",number_format($valueValuo['val_medidas_area_total_escritura_m2'],2,".",","),number_format($valueValuo['val_medias_area_total_escritura_mzn2'],7,".",","),number_format($valueValuo['val_medidas_area_total_escritura_v2'],2,".",",")),array('0'),array(array('Arial','','5'),array('Arial','','6')),false);
$posiciony+=3;
$pdf->cuadrogrande(9,$posiciony,62,3,0,D);
$pdf->SetTextColor(3, 3, 3);
$pdf->Row(array("AREA DE CAMPO",number_format($valueValuo['val_medidas_area_total_campo_m2'],2,".",","),number_format($valueValuo['val_medidas_area_total_campo_mzn2'],7,".",","),number_format($valueValuo['val_medidas_area_total_campo_v2'],2,".",",")),array('0'),array(array('Arial','','5'),array('Arial','','6')),false);
$posiciony+=3;$pdf->SetFillColor(192,192,192);
$pdf->cuadrogrande(9,$posiciony,62,3,1,FD);
//$pdf->SetTextColor(255, 255, 255);
$pdf->SetAligns(array('C'));
$pdf->SetWidths(array(61));
$pdf->Row(array(utf8_decode($valueValuo['val_incripcion_registro'])),array('0'),array(array('Arial','','6')),false);
$posiciony+=3;
$pdf->cuadrogrande(9,$posiciony,62,3,0,D);
$pdf->SetAligns(array('C','C'));
$pdf->SetWidths(array(30,30));
$pdf->SetTextColor(3, 3, 3);
$pdf->Row(array("Matricula No",$valueValuo['val_inscripcion_registro_matricula']),array('0'),array(array('Arial','','6.5'),array('Arial','','6.5')),false);

$pdf->SetAligns(array('J','C','C','L','C','C','J','J','J','J','J','J','J','L'));
$pdf->SetWidths(array(16,5,8,30,5,10,16,28,7,12,22,6,7,28));

$posiciony+=6.3;$pdf->SetFillColor(192,192,192);
//$pdf->SetTextColor(255,255,255);
$pdf->cuadrogrande(9,$posiciony,200,3.5,1,FD);
$pdf->Row(array("TOPOGRAFIA","SI","NO","RIESGO DESASTRE NATURAL","SI","NO","DIST MTS","CLASE DE SUELOS","SI","NO","FUENTES-AGUA","SI","NO","UBICACION"),array('0','0','0','0','0','0','0','0','0','0','0','0','0'),array(array('Arial','','6'),array('Arial','','6'),array('Arial','','6'),array('Arial','','5.2'),array('Arial','','6')),false);
$pdf->SetTextColor(3, 3,3);
$posiciony+=3.4;
$pdf->cuadrogrande(9,$posiciony,200,3,0,D);

 ($valueValuo['topo_plano']==1) ? $topo_plano1="X" : $topo_plano2="X";
 ($valueValuo['topo_semiplano']==1) ? $topo_semiplano1="X" : $topo_semiplano2="X";
 ($valueValuo['topo_ondulado']==1) ? $topo_ondulado1="X" : $topo_ondulado2="X";
 ($valueValuo['topo_inclinado']==1) ? $topo_inclinado1="X" : $topo_inclinado2="X";
 ($valueValuo['topo_mixto']==1) ? $topo_mixto1="X" : $topo_mixto2="X";

 ($valueValuo['riesgo_rio']==1) ? $riesgo_rio1="X" : $riesgo_rio2="X";
 ($valueValuo['riesgo_quebrada']==1) ? $riesgo_quebrada1="X" : $riesgo_quebrada2="X";
 ($valueValuo['riesgos_carcavas']==1) ? $riesgos_carcavas1="X" : $riesgos_carcavas2="X";
 ($valueValuo['riesgos_obras_pub']==1) ? $riesgos_obras_pub1="X" : $riesgos_obras_pub2="X";
 ($valueValuo['riesgos_deslizamiento']==1) ? $riesgos_deslizamiento1="X" : $riesgos_deslizamiento2="X";
 ($valueValuo['suelo_franco']==1) ? $suelo_franco1="X" : $suelo_franco2="X";
 ($valueValuo['suelo_arcilloso']==1) ? $suelo_arcilloso1="X" : $suelo_arcilloso2="X";
 ($valueValuo['suelo_franco_arcilloso']==1) ? $suelo_franco_arcilloso1="X" : $suelo_franco_arcilloso2="X";
 ($valueValuo['suelo_franco_arcilloso']==1) ? $suelo_franco_arcilloso1="X" : $suelo_franco_arcilloso2="X";
 ($valueValuo['suelo_cascajoso']==1) ? $suelo_cascajoso1="X" : $suelo_cascajoso2="X";
 ($valueValuo['suelo_talpetatoso']==1) ? $suelo_talpetatoso1="X" : $suelo_talpetatoso2="X";
 ($valueValuo['fuent_paja_agua']==1) ? $fuent_paja_agua1="X" : $fuent_paja_agua2="X";

 ($valueValuo['fuent_rio']==1) ? $fuent_rio1="X" : $fuent_rio2="X";
 ($valueValuo['fuent_pozo_artesanal']==1) ? $fuent_pozo_artesanal1="X" : $fuent_pozo_artesanal2="X";
 ($valueValuo['fuent_pozo_profundo']==1) ? $fuent_pozo_profundo1="X" : $fuent_pozo_profundo2="X";
 ($valueValuo['fuent_vertiente']==1) ? $fuent_vertiente1="X" : $fuent_vertiente2="X";


$pdf->SetAligns(array('J','C','C'));
$pdf->SetWidths(array(16,5,8));
$pdf->cuadrogrande(9,$posiciony,29,3,0,D);
$pdf->Row(array("Plano",$topo_plano1,$topo_plano2),array('0','0','0'),array(array('Arial','','6'),array('Arial','','5'),array('Arial','','5')),false);
$pdf->SetAligns(array('L','C','C'));
$pdf->SetWidths(array(30,5,10));
$pdf->cuadrogrande(38,$posiciony,62,3,0,D);
$pdf->Row(array("Rios",$riesgo_rio1,$riesgo_rio2,$valueValuo['riesgo_rio_dist']),array('0','0','0'),array(array('Arial','','6'),array('Arial','','5'),array('Arial','','5')),false);
$pdf->SetAligns(array('J','J','J'));
$pdf->SetWidths(array(28,7,12));
$pdf->cuadrogrande(100,$posiciony,46,3,0,D);
$pdf->Row(array("Talpetatoso",$suelo_talpetatoso1,$suelo_talpetatoso2),array('0','0','0'),array(array('Arial','','6'),array('Arial','','5'),array('Arial','','5')),false);
$pdf->SetAligns(array('J','J','J','L'));
$pdf->SetWidths(array(22,6,7,28));
$pdf->cuadrogrande(146,$posiciony,63,3,0,D);
$pdf->Row(array("Rio",$fuent_rio1,$fuent_rio2,utf8_decode($valueValuo['fuent_rio_ubi'])),array('0','0','0'),array(array('Arial','','6'),array('Arial','','5'),array('Arial','','5')),false);

$posiciony+=3;

$pdf->SetAligns(array('J','C','C'));
$pdf->SetWidths(array(16,5,8));
$pdf->cuadrogrande(9,$posiciony,29,3,0,D);
$pdf->Row(array("Semiplano",$topo_semiplano1,$topo_semiplano2),array('0','0','0'),array(array('Arial','','6'),array('Arial','','5'),array('Arial','','5')),false);
$pdf->SetAligns(array('L','C','C'));
$pdf->SetWidths(array(30,5,10));
$pdf->cuadrogrande(38,$posiciony,62,3,0,D);
$pdf->Row(array("Quebradas",$riesgo_quebrada1,$riesgo_quebrada2,$valueValuo['riesgo_quebrada_dist']),array('0','0','0'),array(array('Arial','','6'),array('Arial','','5'),array('Arial','','5')),false);
$pdf->SetAligns(array('J','J','J'));
$pdf->SetWidths(array(28,7,12));
$pdf->cuadrogrande(100,$posiciony,46,3,0,D);
$pdf->Row(array("Franco",$suelo_franco1,$suelo_franco2),array('0','0','0'),array(array('Arial','','6'),array('Arial','','5'),array('Arial','','5')),false);
$pdf->SetAligns(array('J','J','J','L'));
$pdf->SetWidths(array(22,6,7,28));
$pdf->cuadrogrande(146,$posiciony,63,3,0,D);
$pdf->Row(array("Poso Artesanal",$fuent_pozo_artesanal1,$fuent_pozo_artesanal2,utf8_decode($valueValuo['fuent_pozo_artesanal_ubi'])),array('0','0','0'),array(array('Arial','','6'),array('Arial','','5'),array('Arial','','5')),false);


$posiciony+=3;

$pdf->SetAligns(array('J','C','C'));
$pdf->SetWidths(array(16,5,8));
$pdf->cuadrogrande(9,$posiciony,29,3,0,D);
$pdf->Row(array("Ondulado",$topo_ondulado,$topo_ondulado),array('0','0','0'),array(array('Arial','','6'),array('Arial','','5'),array('Arial','','5')),false);
$pdf->SetAligns(array('L','C','C'));
$pdf->SetWidths(array(30,5,10));
$pdf->cuadrogrande(38,$posiciony,62,3,0,D);
$pdf->Row(array("Carcavas",$riesgos_carcavas1,$riesgos_carcavas2,$valueValuo['riesgos_carcavas_dist']),array('0','0','0'),array(array('Arial','','6'),array('Arial','','5'),array('Arial','','5')),false);
$pdf->SetAligns(array('J','J','J'));
$pdf->SetWidths(array(28,7,12));
$pdf->cuadrogrande(100,$posiciony,46,3,0,D);
$pdf->Row(array("Arcilloso",$suelo_arcilloso1,$suelo_arcilloso2),array('0','0','0'),array(array('Arial','','6'),array('Arial','','5'),array('Arial','','5')),false);
$pdf->SetAligns(array('J','J','J','L'));
$pdf->SetWidths(array(22,6,7,28));
$pdf->cuadrogrande(146,$posiciony,63,3,0,D);
$pdf->Row(array("Paja Agua",$fuent_paja_agua1,$fuent_paja_agua2,utf8_decode($valueValuo['fuent_paja_agua_ubi'])),array('0','0','0'),array(array('Arial','','6'),array('Arial','','5'),array('Arial','','5')),false);


$posiciony+=3;

$pdf->SetAligns(array('J','C','C'));
$pdf->SetWidths(array(16,5,8));
$pdf->cuadrogrande(9,$posiciony,29,3,0,D);
$pdf->Row(array("Inclindado",$topo_inclinado1,$topo_inclinado2),array('0','0','0'),array(array('Arial','','6'),array('Arial','','5'),array('Arial','','5')),false);
$pdf->SetAligns(array('L','C','C'));
$pdf->SetWidths(array(30,5,10));
$pdf->cuadrogrande(38,$posiciony,62,3,0,D);
$pdf->Row(array("Obras Civiles",$riesgos_obras_pub1,$riesgos_obras_pub2,$valueValuo['riesgos_obras_pub_dist']),array('0','0','0'),array(array('Arial','','6'),array('Arial','','5'),array('Arial','','5')),false);
$pdf->SetAligns(array('J','J','J'));
$pdf->SetWidths(array(28,7,12));
$pdf->cuadrogrande(100,$posiciony,46,3,0,D);
$pdf->Row(array("Franco-Arcilloso",$suelo_franco_arcilloso1,$suelo_franco_arcilloso2),array('0','0','0'),array(array('Arial','','6'),array('Arial','','5'),array('Arial','','5')),false);
$pdf->SetAligns(array('J','J','J','L'));
$pdf->SetWidths(array(22,6,7,28));
$pdf->cuadrogrande(146,$posiciony,63,3,0,D);
$pdf->Row(array("Pozo profundo",$fuent_pozo_profundo1,$fuent_pozo_profundo2,utf8_decode($valueValuo['fuent_pozo_profundo_ub'])),array('0','0','0'),array(array('Arial','','6'),array('Arial','','5'),array('Arial','','5')),false);

$posiciony+=3;

$pdf->SetAligns(array('J','C','C'));
$pdf->SetWidths(array(16,5,8));
$pdf->cuadrogrande(9,$posiciony,29,3,0,D);
$pdf->Row(array("Mixto",$topo_mixto1,$topo_mixto2),array('0','0','0'),array(array('Arial','','6'),array('Arial','','5'),array('Arial','','5')),false);
$pdf->SetAligns(array('L','C','C'));
$pdf->SetWidths(array(30,5,10));
$pdf->cuadrogrande(38,$posiciony,62,3,0,D);
$pdf->Row(array("Deslizamineto de tierra",$riesgos_deslizamiento1,$riesgos_deslizamiento2,$valueValuo['riesgos_dezlizamiento_dist']),array('0','0','0'),array(array('Arial','','6'),array('Arial','','5'),array('Arial','','5')),false);
$pdf->SetAligns(array('J','J','J'));
$pdf->SetWidths(array(28,7,12));
$pdf->cuadrogrande(100,$posiciony,46,3,0,D);
$pdf->Row(array("Cascajoso",$suelo_cascajoso1,$suelo_cascajoso2),array('0','0','0'),array(array('Arial','','6'),array('Arial','','5'),array('Arial','','5')),false);
$pdf->SetAligns(array('J','J','J','L'));
$pdf->SetWidths(array(22,6,7,28));
$pdf->cuadrogrande(146,$posiciony,63,3,0,D);
$pdf->Row(array(utf8_decode("Vertiente"),$fuent_vertiente1,$fuent_vertiente2,utf8_decode($valueValuo['fuent_vertiente_ubi'])),array('0','0','0'),array(array('Arial','','6'),array('Arial','','5'),array('Arial','','5')),false);


$posiciony+=3;
$pdf->SetFillColor(160,160,160);
//$pdf->SetTextColor(255, 255, 255);
$pdf->cuadrogrande(9,$posiciony,28,3,1,FD);
$pdf->SetAligns(array('C'));
$pdf->SetWidths(array(28));
$pdf->Row(array("OBSERVACIONES:"),array('0'),array(array('Arial','','6')),false);
$pdf->SetTextColor(3, 3, 3);
$pdf->SetAligns(array('R'));
$pdf->SetWidths(array(172));
$pdf->cuadrogrande(37,$posiciony,172,3,0,D);
$pdf->Row(array(utf8_decode($valueValuo['observaciones_terreno'])),array('0'),array(array('Arial','','6')),false);

$posiciony+=3;
$pdf->SetFillColor(160,160,160);
//$pdf->SetTextColor(255, 255, 255);
$pdf->cuadrogrande(9,$posiciony,62,3,1,FD);
$pdf->SetAligns(array('C','C','C'));
$pdf->SetWidths(array(40,10,10));
$pdf->Row(array("RECURSO PRODUCTIVO","SI","NO"),array('0'),array(array('Arial','','7')),false);

 ($valueValuo['r_p_secano']==1) ? $r_p_secano1="X" : $r_p_secano2="X";
 ($valueValuo['r_p_bajo_riego']==1) ? $r_p_bajo_riego1="X" : $r_p_bajo_riego2="X";

$posiciony+=3;
$pdf->SetTextColor(3, 3, 3);
$pdf->cuadrogrande(9,$posiciony,62,3,0,D);
$pdf->Row(array("Secano",$r_p_secano1,$r_p_secano2),array('0'),array(array('Arial','','6')),false);
$posiciony+=3;
$pdf->cuadrogrande(9,$posiciony,62,3,0,D);
$pdf->Row(array("Bajo Riego",$r_p_bajo_riego1,$r_p_bajo_riego2),array('0'),array(array('Arial','','6')),false);

$posiciony-=6;//$pdf->SetTextColor(255, 255, 255);
$pdf->SetAligns(array('C'));
$pdf->SetWidths(array(138));$pdf->SetFillColor(192,192,192);
$pdf->cuadrogrande(71,$posiciony,138,3,1,FD);
$pdf->Row(array("OTRAS CARACTERISTICAS"),array('0'),array(array('Arial','','7')),false);
$posiciony+=3;$pdf->SetTextColor(3, 3, 3);
$pdf->cuadrogrande(71,$posiciony,138,6,0,D);
$pdf->SetAligns(array('L'));
$pdf->RowPeque(array(utf8_decode($valueValuo['otras_caracteristicas'])),array('0'),array(array('Arial','','6')),false);
$posiciony+=9;
$pdf->SetFillColor(160,160,160);
//$pdf->SetTextColor(255, 255, 255);
$pdf->cuadrogrande(9,$posiciony,200,3.7,1,FD);
$pdf->SetAligns(array('C','C'));
$pdf->SetWidths(array(28,172));
$pdf->Row(array("MODULO","DETALLE DE LAS EDIFICACIONES, DENTRO DEL TERRENO GARANTIA"),array('0'),array(array('Arial','','7')),false);


$datosRoss = $DAO->mostrarAll($conexion,"select * from val_valuos_descripcion_construccion_ross where id_val_valuos='$idvaluos'");


$posiciony+=3;
if(!empty($datosRoss)){
	foreach ($datosRoss as $valueRoss) {
		$pdf->SetAligns(array('C','J'));
	    $pdf->SetWidths(array(25,175));
		//$pdf->SetTextColor(255, 255, 255);
		$pdf->SetFillColor(192,192,192);
	    //$pdf->cuadrogrande(9,$posiciony,28,7,1,FD);
	    if(strlen(utf8_decode($valueRoss['descripcion_valuos_descripcion']))>310){
	    	$pdf->RowPeque(array("\n\n".$valueRoss['nombre_valuos_descripcion'],ucwords(utf8_decode(strtolower(trim($valueRoss['descripcion_valuos_descripcion']))))),array('1',1),array(array('Arial','','6'),array('Arial','','7')),false);
	    }else if(strlen(utf8_decode($valueRoss['descripcion_valuos_descripcion']))>162){
	    	$pdf->RowPeque(array("\n".$valueRoss['nombre_valuos_descripcion'],ucwords(utf8_decode(strtolower(trim($valueRoss['descripcion_valuos_descripcion']))))),array('1',1),array(array('Arial','','6'),array('Arial','','7')),false);
	    }else{
	    	$pdf->RowPeque(array($valueRoss['nombre_valuos_descripcion'],ucwords(utf8_decode(strtolower(trim($valueRoss['descripcion_valuos_descripcion']))))),array('1',1),array(array('Arial','','6'),array('Arial','','7')),false);
	    }
		
	    
	    $pdf->SetAligns(array('L'));
	    $pdf->SetWidths(array(172));
		$pdf->SetTextColor(2, 2, 2);
	    //$pdf->cuadrogrande(37,$posiciony,172,7,1,D);
		//$pdf->RowPeque(array(),array('0'),array(array('Arial','','6')),false);
		$posiciony+=7;
	}
}else{
	 $pdf->SetAligns(array('C'));
	    $pdf->SetWidths(array(200));
		$pdf->SetTextColor(2, 2, 2);
	    //$pdf->cuadrogrande(9,$posiciony,200,7,1,D);
		$pdf->Row(array("NO HAY REGISTROS ACTUALMENTE"),array('1'),array(array('Arial','','6')),false);
		$posiciony+=7;
}
$posiciony+=0;
    $pdf->SetAligns(array('C'));
    $pdf->SetWidths(array(200));
	//$pdf->SetTextColor(255, 255, 255);
	$pdf->SetFillColor(160,160,160);
    //$pdf->cuadrogrande(9,$posiciony,200,3.5,1,FD);
	$pdf->Row(array("APLICANDO EL METODO ROSS HEIDECKE"),array('1'),array(array('Arial','','7')),array(true),'',array(array('160','160','160')));
$posiciony+=3.5;
    $pdf->SetAligns(array('C','C','C','C','C','C','C','C','C','C'));
    $pdf->SetWidths(array(20,18,21,16,18,18,18,16,16,19,20));
    $pdf->SetFillColor(192,192,192);
	//$pdf->cuadrogrande(9,$posiciony,200,3.5,1,FD);
	$pdf->Row(array("MODULO","VRN","AREA M2","EDAD","VUT","FC","VNR","FE=Q","VUR","TVRN=VRN*C","Valor Actual"),array(1,1,1,1,1,1,1,1,1,1,1),array(array('Arial','','6')),array(true,true,true,true,true,true,true,true,true,true,true),'',array(array('192','192','192'),array('192','192','192'),array('192','192','192'),array('192','192','192'),array('192','192','192'),array('192','192','192'),array('192','192','192'),array('192','192','192'),array('192','192','192'),array('192','192','192'),array('192','192','192')));
	$posiciony+=3.5;
	 $pdf->SetAligns(array('C','C','C','C','C','C','R','C','C','R','R'));
	 
if(!empty($datosRoss)){
foreach($datosRoss as $valueRoss1){
	
	$pdf->SetTextColor(2, 2, 2);
    //$pdf->cuadrogrande(9,$posiciony,200,2.5,1,D);
	$pdf->RowPeque(array($valueRoss1['nombre_valuos_descripcion'],"$ ".number_format($valueRoss1['valor_unitario_valuos_descripcion'],2,".",","),$valueRoss1['dimension_m2_valuos_descripcion'],$valueRoss1['edad_valuos_descripcion'],$valueRoss1['VUT_valuos_descripcion'],$valueRoss1['FC_valuos_descripcion'],"$ ".$valueRoss1['VNR_valuos_descripcion'],$valueRoss1['FE_valuos_descripcion'],$valueRoss1['VUR_valuos_descripcion'],"$ ".number_format($valueRoss1['TVRN_parcial_valuos_descripcion'],2,".",","),"$ ".number_format($valueRoss1['VA_parcial_valuos_descripcion'],2,".",",")),array(1,1,1,1,1,1,1,1,1,1,1),array(array('Arial','','6')),false);
	$posiciony+=2.5;
}
}else{
	 $pdf->SetAligns(array('C'));
	    $pdf->SetWidths(array(200));
		$pdf->SetTextColor(2, 2, 2);
	    //$pdf->cuadrogrande(9,$posiciony,200,3,1,D);
		$pdf->Row(array("NO HAY REGISTROS ACTUALMENTE"),array('1'),array(array('Arial','','6')),false);
		$posiciony+=3;
}
$datossumametros = $DAO->mostrarAll($conexion,"select sum(dimension_m2_valuos_descripcion) from val_valuos_descripcion_construccion_ross where id_val_valuos='$idvaluos'");
            foreach ($datossumametros as $valuedatossumametros) {}
$datoConstruccion = $DAO->mostrarAll($conexion,"select sum(TVRN_parcial_valuos_descripcion) from val_valuos_descripcion_construccion_ross where id_val_valuos='$idvaluos'");
            foreach ($datoConstruccion as $valuedatoConstruccion) {}

$datoDepresiado = $DAO->mostrarAll($conexion,"select sum(VA_parcial_valuos_descripcion) from val_valuos_descripcion_construccion_ross where id_val_valuos='$idvaluos'");
            foreach ($datoDepresiado as $valuedatoDepresiado) {}

//$pdf->SetTextColor(255, 255, 255);
$pdf->SetAligns(array('C'));
    $pdf->SetWidths(array(38,21,45,25,51,20));
    //$pdf->cuadrogrande(9,$posiciony,42,2.5,1,FD);
	$pdf->Row(array("TOTAL CONST. M2",$valuedatossumametros[0],"VALOR DE CONSTRUCCION","$ ".number_format($valuedatoConstruccion[0],2,".",","),"VALOR DEPRECIADO","$ ".number_format($valuedatoDepresiado[0],2,".",",")),array(1,1,1,1,1,1),array(array('Arial','','6')),array(false,true,false,true,false,true),'',array('',array('255','211','0'),'',array('192','192','192'),'',array('192','192','192')));


/*
$pdf->SetTextColor(3, 3, 3);
$pdf->SetAligns(array('C'));
    $pdf->SetWidths(array(25));
    $pdf->cuadrogrande(51,$posiciony,25,2.5,1,D);
	$pdf->RowPeque(array(),array('0'),array(array('Arial','','6')),false);

//$pdf->SetTextColor(255, 255, 255);
$pdf->SetAligns(array('C'));
    $pdf->SetWidths(array(44));
    $pdf->cuadrogrande(76,$posiciony,44,2.5,1,FD);
	$pdf->RowPeque(array(),array('0'),array(array('Arial','','6.5')),false);



$pdf->SetTextColor(3, 3, 3);
$pdf->SetAligns(array('C'));
    $pdf->SetWidths(array(25));
    $pdf->cuadrogrande(120,$posiciony,25,2.5,1,D);
	$pdf->RowPeque(array(),array('0'),array(array('Arial','B','6')),false);

//$pdf->SetTextColor(255, 255, 255);
$pdf->SetAligns(array('C'));
    $pdf->SetWidths(array(44));
    $pdf->cuadrogrande(145,$posiciony,44,2.5,1,FD);
	$pdf->RowPeque(array(),array('0'),array(array('Arial','','7')),false);

$pdf->SetTextColor(3, 3, 3);
$pdf->SetAligns(array('R'));
    $pdf->SetWidths(array(18));
    $pdf->cuadrogrande(189,$posiciony,20,2.5,1,D);
	$pdf->RowPeque(array(),array('0'),array(array('Arial','B','6')),false);*/


$posiciony+=2.5;
$pdf->SetFillColor(160,160,160);
//$pdf->SetTextColor(255, 255, 255);
//$pdf->cuadrogrande(9,$posiciony,120,3.7,1,FD);
$pdf->SetAligns(array('C','L'));
$pdf->SetWidths(array(120,78));
$pdf->Row(array("DETALLE DEL VALUO","VUT=Vida Util Total, FC=Facto de Conversion, TVRN=Total Valor Repos. Nuevo"),array('1',0),array(array('Arial','','6'),array('Arial','','5.5')),array(true,false),'',array(array('160','160','160')));


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
$pdf->SetAligns(array('C',"C","C","C","C","C"));
$pdf->SetWidths(array(20,20,15,15,30,20,78));
$pdf->RowPeque(array("TERRENO","LEGALIDAD","AREA M2","AREA MZN","VALOR POR MANZANA","VALOR TOTAL","VRN=Valor de reposicion nuevo, FE=Factor de estado, VUR=Vida Util Remanente"),array(1,1,1,1,1,1),array(array('Arial','','5.5')),array(true,true,true,true,true,true),'',array(array('192','192','192'),array('192','192','192'),array('192','192','192'),array('192','192','192'),array('192','192','192'),array('192','192','192')));

/*
$pdf->cuadrogrande_salto(122,$posiciony,80,7,1,D,false);
$pdf->SetAligns(array('C'));
$pdf->SetWidths(array(80));
$pdf->RowPeque(array("VNR=Valor Neto de Reposicion  TVRN=Total Valor de Reposicion Nuevo"),array('0'),array(array('Arial','','5')),false);
*/
$datosDValuo = $DAO->mostrarAll($conexion,"select * from val_detalle_de_valuos where id_val_valuos='$idvaluos'");

$posiciony+=4;$num=1;
if(!empty($datosDValuo)){
	foreach($datosDValuo as $valuedatosDValuo){
		
		$pdf->SetTextColor(2, 2, 2);
	    //$pdf->cuadrogrande_salto(0,$posiciony,120,2.2,1,D,true);
	    if($num==1){
		$pdf->RowPeque(array($valuedatosDValuo['det_terreno'],$valuedatosDValuo['det_legalidad'],$valuedatosDValuo['det_area_m2'],$valuedatosDValuo['det_equiv_mzn'],"$ ".number_format($valuedatosDValuo['det_val_mzn'],2,".",","),"$ ".number_format($valuedatosDValuo['det_val_total'],2,".",",")),array('1',"1",1,1,1,1),array(array('Arial','','6')),array(false,false,false,false,false,true),'',array('','','','','',array('255','211','0')));
		}else{
			$pdf->RowPeque(array($valuedatosDValuo['det_terreno'],$valuedatosDValuo['det_legalidad'],$valuedatosDValuo['det_area_m2'],$valuedatosDValuo['det_equiv_mzn'],"$ ".number_format($valuedatosDValuo['det_val_mzn'],2,".",","),"$ ".number_format($valuedatosDValuo['det_val_total'],2,".",",")),array(1,1,1,1,1,1),array(array('Arial','','6')),array(false,false,false,false,false,true),'',array('','','','','',array('255','211','0')));
		}
		$num++;
		$posiciony+=2.5;
	}
}else{
	$pdf->SetAligns(array('C'));
$pdf->SetWidths(array(120));
	$pdf->SetTextColor(2, 2, 2);
	    //$pdf->cuadrogrande_salto(0,$posiciony,120,2.2,1,D,true);
	$pdf->Row(array("NO HAY REGISTROS ACTUALMENTE"),array('1'),array(array('Arial','','6')),false);
}


$posiciony+=0;
$pdf->SetFillColor(192,192,192);
//$pdf->SetTextColor(255, 255, 255);
//$pdf->cuadrogrande_salto(0,$posiciony,90,3.5,1,D);
$pdf->SetAligns(array('C','C'));
$pdf->SetWidths(array(100,20,40,15));

$pdf->RowPeque(array("","","",""),array('0','0','0','0'),array(array('Arial','','5'),array('Arial','B','5'),array('Arial','B','6')),false);
$pdf->RowPeque(array("TERRENO INSCRITO + EDIFICACIONES DEPRECIADAS","$ ".number_format($valorinscrito,2,".",","),"ASEGURANZA",""),array('1','1','0','0'),array(array('Arial','','5'),array('Arial','B','5'),array('Arial','B','6')),array(false,true,false,false),'',array('',array('255','211','0')));




$pdf->RowPeque(array("VALOR ACTUAL DEPRECIADO DE LAS EDIFICACIONES","$ ".number_format($valuedatoDepresiado[0],2,".",","),"Construccion Nueva","$ ".number_format($valuedatoConstruccion[0],2,".",",")),array('1','1','LT','RLT'),array(array('Arial','','5'),array('Arial','B','5'),array('Arial','','6'),array('Arial','B','6')),array(false,true,false),array('','','',array('0','102','204')),array('',array('255','211','0')));


$pdf->SetTextColor(2, 2, 2);
    //$pdf->cuadrogrande_salto(90,$posiciony,30,3.5,1,FD,false);
    $pdf->SetAligns(array('C'));
$pdf->SetWidths(array(30,40));
	//$pdf->Row(array(),array('0'),array(array('Arial','B','7'),array('Arial','','7'),array('Arial','B','7')),false);



$posiciony+=3.5;
$pdf->SetFillColor(192,192,192);
//$pdf->SetTextColor(255, 255, 255);
//$pdf->cuadrogrande_salto(0,$posiciony,90,3.5,1,D,true);
$pdf->SetAligns(array('C','C'));
$pdf->SetWidths(array(100,20,40,15));
$pdf->RowPeque(array("VALOR (TERRENO INSCRITO + TERRENO EXCEDENTE) MAS EDIFICACIONES DEPRECIADAS","$ ".number_format($valueValuo['val_valuo_inmueble'],2,".",","),"Contruccion Depreciada","$ ".number_format($valuedatoDepresiado[0],2,".",",")),array('1','1','LTB','RLBT'),array(array('Arial','','5'),array('Arial','B','5'),array('Arial','','6'),array('Arial','B','6')),array(false,true,false),array('','','',array('0','102','204')),array('',array('255','211','0')));

$pdf->SetTextColor(2, 2, 2);
    //$pdf->cuadrogrande_salto(90,$posiciony,30,3.5,1,FD,false);
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
$pdf->RowPeque(array("VALOR COMERCIAL : ",utf8_decode($valueValuo['val_compra_venta'])),array('B','B'),array(array('Arial','','6'),array('Arial','B','6')),FALSE,array('',array('0','102','204')));
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