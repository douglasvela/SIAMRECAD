<?php session_start();
            include_once ("../modelo/Conexion.php");
            include_once ("../modelo/DAO.php");
            $conexions=new Conexion();
            $conexion=$conexions->conectar();
            $DAO=new DAO();


	include_once('PDF.php');
 $buscar = $_GET["id"];
 $cli_correlativo = $_GET["cli_correlativo"];

$datos = $DAO->mostrarAll($conexion,"select * from clientes inner join creditos on clientes.cli_correlativo=creditos.cli_correlativo where ((creditos.cre_solic_id LIKE '%$buscar%')) AND cre_tipo_garantia='PERSONAL' ");
                    	if(empty($datos))echo "";
                        foreach ($datos as $value) {
                        }



$pdf = new PDF('P','mm',array(216,331));

//$pdf = new PDF('P','mm','a4');
 
$pdf->AddPage();
 

setlocale(LC_MONETARY, 'en_US');
//ancho de borde izq
//ancho de borde arriba
//ancho del cuadro hacia la derecha
//amcho del cuadro hacia abajo
//ancho de las esquinas
//relleno
$pdf->leyendas(22,5,'Arial','',16,135,8,'CAJA DE CRÉDITO DE SAN VICENTE');
$pdf->leyendas(26,9,'Arial','B',10,95,8,'5ta Calle Oriente Barrio El Santuario, San Vicente, El Salvador');
$pdf->leyendas(44,13,'Arial','B',8,95,8,'Créditos: 2347-3309, FAX: 2393-4555');

$pdf->leyendas(146,9,'Arial','',7,95,8,'TIPO DE CREDITO ________________________');
$pdf->leyendas(170,8,'Arial','B',8,95,8,$value['cre_tip_credit']);
$pdf->leyendas(146,14,'Arial','',7,95,8,"SOLICITUD PERSONAL");

$pdf->leyendas(15,21,'Arial','B',8,95,8,'SOLICITUD DE CRÉDITO N° ____________________________________');
$pdf->leyendas(65,20,'Arial','',8,95,8,$buscar);

/**********************************A************************************************************/
$pdf->leyendas(12,27,'Arial','',7,95,8,'A.- IDENTIFICACIÓN DEL SOLICITANTE');

$pdf->leyendas(140,27,'Arial','',7,95,8,'TIPO DE CLIENTE ____________________________');
$pdf->leyendas(172,27,'Arial','B',8,95,8,$value['cli_tipo_cliente']);

$pdf->leyendas(12,32,'Arial','',7,195,8,'1 SEGUN D.U.I.: ___________________________________________________________________________________________________________________________');
$pdf->leyendas(42,31,'Arial','B',8,95,8,$value['cli_nombre_dui']);

$pdf->leyendas(12,38,'Arial','',7,195,8,'2 CONOCIDO POR: ________________________________________________________________________________________________________________________');
$pdf->leyendas(46,37,'Arial','B',8,95,8,$value['cli_conocido_por']);

$pdf->leyendas(12,44,'Arial','',7,95,8,'3 SEXO: ____________________________');
$pdf->leyendas(32,43,'Arial','B',8,95,8,$value['cli_sexo']);

$pdf->leyendas(62,44,'Arial','',7,95,8,'4 ESTADO CIVIL: ______________________________');
$pdf->leyendas(92,43,'Arial','B',8,95,8,$value['cli_estado_civil']);

if($value['cli_fecha_nacimiento']!='0000-00-00'){
 $date = date_create($value['cli_fecha_nacimiento']);
 $fecha=date_format($date,'d/m/Y');
}
$pdf->leyendas(125,44,'Arial','',7,95,8,'5 FECHA DE NACIMIENTO: _______________________________');
$pdf->leyendas(170,43,'Arial','B',8,95,8,$fecha);

$pdf->leyendas(12,50,'Arial','',7,195,8,'6 N° D.U.I.: ________________________________________________________________________');
$dui1 = substr($value['cli_dui'],0,8);
$dui2 = substr($value['cli_dui'],8);
$newdui = $dui1."-".$dui2;
$pdf->leyendas(42,49,'Arial','B',8,95,8,$newdui);

if($value['cli_fecha_extesion_dui']!='0000-00-00'){
$date1 = date_create($value['cli_fecha_extesion_dui']);
 $fecha1=date_format($date1,'d/m/Y');
}else{
	$fecha1="-";
}
$pdf->leyendas(125,50,'Arial','',7,95,8,'7 FECHA DE EXTENSION: ________________________________');
$pdf->leyendas(170,49,'Arial','B',8,95,8,$fecha1);

$pdf->leyendas(12,56,'Arial','',7,195,8,'8 DIRECCION PARTICULAR:  ________________________________________________________________________________________________________________');
$pdf->leyendas(48,55,'Arial','B',8,95,8,$value['cli_direccion']);


$datosCalle=$DAO->mostrarAll($conexion,"select  geo_nombre_calle from  cat_geo_calles where geo_codigo_pais='$value[19]' and geo_codigo_departamento='$value[20]' and geo_codigo_municipio='$value[21]' and geo_codigo_canton='$value[22]' and geo_codigo_barrio='$value[23]' and geo_codigo_calle='$value[24]'");
foreach($datosCalle as $filacalle){}
$pdf->leyendas(12,62,'Arial','',7,130,8,'CALLE: ________________________________________________________________________');
if($value['cli_colonia']!="" && $value['cli_colonia']!="0"){
$pdf->leyendas(26,61,'Arial','B',8,95,8,$filacalle[0]);
}else{
	$pdf->leyendas(36,61,'Arial','',8,95,8,"-");
}
$datosbarrio=$DAO->mostrarAll($conexion,"select  geo_nombre_barrio from  cat_geo_barrios where geo_codigo_pais='$value[19]' and geo_codigo_departamento='$value[20]' and geo_codigo_municipio='$value[21]' and geo_codigo_canton='$value[22]' and geo_codigo_barrio='$value[23]'");
foreach($datosbarrio as $filaBarrio){}
$pdf->leyendas(125,62,'Arial','',7,95,8,'BARRIO: _______________________________________________');
if($value['geo_codigo_barrio']!="" && $value['geo_codigo_barrio']!="0"){
$pdf->leyendas(140,61,'Arial','B',8,95,8,$filaBarrio[0]);
}else{
	$pdf->leyendas(145,61,'Arial','B',8,95,8,"-");
}

$datosDepto=$DAO->mostrarAll($conexion,"select  geo_nombre_departamento from  cat_geo_departamentos where geo_codigo_pais='$value[19]' and geo_codigo_departamento='$value[20]'");
foreach($datosDepto as $filaDepto){}
$pdf->leyendas(12,68,'Arial','',7,95,8,'9 DEPARTAMENTO: ______________________________');
$pdf->leyendas(40,67,'Arial','B',8,95,8,$filaDepto[0]);

$datosMun=$DAO->mostrarAll($conexion,"select geo_nombre_municipio from cat_geo_municipios where geo_codigo_pais='$value[19]' and geo_codigo_departamento='$value[20]' and geo_codigo_municipio='$value[21]'");
foreach($datosMun as $filaMun){}
$pdf->leyendas(78,68,'Arial','',7,95,8,'10 MUNICIPIO: ______________________________');
$pdf->leyendas(98,67,'Arial','B',8,95,8,$filaMun[0]);

 $datosCan=$DAO->mostrarAll($conexion,"select geo_nombre_canton from cat_geo_cantones where geo_codigo_pais='$value[19]' and geo_codigo_departamento='$value[20]' and geo_codigo_municipio='$value[21]' and geo_codigo_canton='$value[22]'");
     foreach($datosCan as $filaCan){}

$pdf->leyendas(140,68,'Arial','',7,95,8,'11 CANTON: _________________________________');
$pdf->leyendas(160,67,'Arial','B',8,95,8,$filaCan[0]);


if($value['cli_fecha_ingreso_socio']!='0000-00-00'){
$date2 = date_create($value['cli_fecha_ingreso_socio']);
 $fecha2=date_format($date2,'d/m/Y');
}
$pdf->leyendas(12,74,'Arial','',7,95,8,'FECHA DE INGRESO DE SOCIO: ___________________________________________');
$pdf->leyendas(58,73,'Arial','B',8,95,8,$fecha2);

$pdf->leyendas(108,74,'Arial','',7,95,8,'CONDICION DE VIVIENDA: ____________________________________________');
$pdf->leyendas(160,73,'Arial','B',8,95,8,$value['cli_condicion_vivienda']);

$pdf->leyendas(12,80,'Arial','',7,95,8,'12 TELEFONO: _____________________________');
if($value['cli_telefono']!=""){
$pdf->leyendas(40,79,'Arial','B',8,95,8,$value['cli_telefono']);
}else{
	$pdf->leyendas(45,79,'Arial','',8,95,8,"-");
}
$pdf->leyendas(70,80,'Arial','',7,95,8,'CELULAR: ___________________________');
if($value['cli_celular']!=""){
$pdf->leyendas(92,79,'Arial','B',8,95,8,$value['cli_celular']);
}else{
	$pdf->leyendas(98,79,'Arial','B',8,95,8,"-");
}
$datosProf=$DAO->mostrarAll($conexion,"select * from cat_profesiones_oficios where po_codigo_profesion='$value[31]'");
     foreach($datosProf as $filaProf){}
$pdf->leyendas(122,80,'Arial','',7,95,8,'13 PROFESION U OFICIO: ___________________________________');
$pdf->leyendas(160,79,'Arial','B',8,95,8,$filaProf[1]);

$pdf->leyendas(12,86,'Arial','',7,95,8,'14 N.I.T. N°: _________________________________________________________');
$parte1  = substr($value['cli_nit'], 0,4);
$parte2 = substr($value['cli_nit'],4,6);
$parte3 = substr($value['cli_nit'],10,3);
$parte4 = substr($value['cli_nit'],13);
$newnit = $parte1."-".$parte2."-".$parte3."-".$parte4; 

$pdf->leyendas(45,85,'Arial','B',8,95,8,$newnit);

$pdf->leyendas(108,86,'Arial','',7,95,8,'15 I.S.S.S. N°: _______________________________________________________');
if($value['cli_isss']!=""){
$pdf->leyendas(135,85,'Arial','B',8,95,8,$value['cli_isss']);
}else{
	$pdf->leyendas(140,85,'Arial','',8,95,8,"-");
}
$pdf->leyendas(12,92,'Arial','',7,95,8,'16 N.I.P. N°: ___________________________');
if($value['cli_nip']!=""){
$pdf->leyendas(28,91,'Arial','B',8,95,8,$value['cli_nip']);
}else{
	$pdf->leyendas(34,91,'Arial','',8,95,8,"-");
}
$pdf->leyendas(64,92,'Arial','',7,95,8,'VEHICULO AÑO: __________');
if($value['cli_vehiculo_anio_']!="" && $value['cli_vehiculo_anio_']!="0000"){
$pdf->leyendas(87,91,'Arial','B',8,95,8,$value['cli_vehiculo_anio_']);
}else{
	$pdf->leyendas(91,91,'Arial','',8,95,8,"-");
}
$pdf->leyendas(99,92,'Arial','',7,110,8,'N° PLACA: _______________');
if($value['cli_vehiculo_n_placa']!=""){
$pdf->leyendas(115,91,'Arial','B',8,95,8,$value['cli_vehiculo_n_placa']);
}else{
	$pdf->leyendas(118,91,'Arial','B',8,95,8,"-");
}

$datosMar=$DAO->mostrarAll($conexion,"select * from cat_vehiculos_marca where cat_corr_marca_vehiculo='$value[42]'");
if(!empty($datosMar))foreach($datosMar as $filaMar){}
if($filaMar[1]=='Sin Vehiculo')$filaMar[1]="-";
$pdf->leyendas(134,92,'Arial','',7,110,8,'MARCA: _______________');
$pdf->leyendas(145,91,'Arial','B',7,95,8,$filaMar[1]);

$pdf->leyendas(165,92,'Arial','',7,110,8,'ESTADO: _________________');
if($value['cli_vehiculo_estado']!=""){
$pdf->leyendas(180,91,'Arial','B',8,95,8,$value['cli_vehiculo_estado']);
}else{
	$pdf->leyendas(182,91,'Arial','B',8,95,8,"-");
}
if($value['PEPS']==1){
	$equis="X";
}else{
	$noequis="X";
}

$pdf->leyendas(12,104,'Arial','',7,110,8,'¿Es usted una Persona Expuesta Políticamente (PEPs)?');
$pdf->cuadropequeño(90,104,10,5,0,D);
$pdf->leyendas(100,104,'Arial','',7,110,8,'SI');
$pdf->leyendas(93,103,'Arial','B',8,100,8,$equis);
$pdf->cuadropequeño(110,104,10,5,0,D);
$pdf->leyendas(120,104,'Arial','',7,110,8,'NO');
$pdf->leyendas(111,103,'Arial','B',8,95,8,$noequis);

//cuadro de parentesco
$pdf->cuadropequeño(130,99,35,4,0,D);
$pdf->leyendas(133,97,'Arial','B',6,95,8,"Grado de Parentesco");
$pdf->cuadropequeño(165,99,37,4,0,D);
$pdf->leyendas(174,97,'Arial','B',6,100,8,"Parentesco");
$pdf->cuadropequeño(130,103,35,3,0,D);
$pdf->leyendas(130,101,'Arial','',5,95,7,"1° Grado de Consanguinidad");
$pdf->cuadropequeño(165,103,37,3,0,D);
$pdf->leyendas(165,101,'Arial','',5,100,7,"Padres, Hijos");
$pdf->cuadropequeño(130,106,35,3,0,D);
$pdf->leyendas(130,104,'Arial','',5,95,7,"1° Grado de Afinidad");
$pdf->cuadropequeño(130,109,35,3,0,D);
$pdf->leyendas(130,107,'Arial','',5,95,7,"2° Grado de Consanguinidad");
$pdf->cuadropequeño(130,112,35,3,0,D);
$pdf->leyendas(130,110,'Arial','',5,95,7,"2° Grado de Afinidad");

$pdf->cuadropequeño(165,106,37,3,0,D);
$pdf->leyendas(165,104,'Arial','',5,100,7,"Suegros, Yernos, Nueras");
$pdf->cuadropequeño(165,109,37,3,0,D);
$pdf->leyendas(165,107,'Arial','',5,100,7,"Abuelos, Hermanos, Nietos");
$pdf->cuadropequeño(165,112,37,3,0,D);
$pdf->leyendas(165,110,'Arial','',5,100,7,"Cuñados, Concuñados, Abuelos de Conyuge");

if($value['nombre_PEPS']!=""){
	$si ="X";
}
else{
	$no="X";
}
$pdf->leyendas(12,110,'Arial','',7,110,8,'¿Tiene relación con alguna Persona Expuesta Políticamente (PEPs)?');
$pdf->cuadropequeño(90,110,10,5,0,D);
$pdf->leyendas(100,110,'Arial','',7,110,8,'SI');
$pdf->leyendas(93,109,'Arial','B',8,100,8,$si);
$pdf->cuadropequeño(110,110,10,5,0,D);
$pdf->leyendas(120,110,'Arial','',7,110,8,'NO');
$pdf->leyendas(111,109,'Arial','B',8,100,8,$no);

$pdf->leyendas(12,116,'Arial','',7,175,8,'Si su respuesta es afirmativa, indique nombre y/o parentesco de la Persona Expuesta Políticamente (PEPs) Con la que tiene relación y el puesto que desempeña:');

$pdf->leyendas(12,122,'Arial','',7,110,8,'Nombre: ____________________________________________________________________');
$pdf->leyendas(25,121,'Arial','B',8,95,8,$value['nombre_PEPS']);
if($value['parentesco_PEPS']=='1_consanguinidad'){
	$paren = "1° Grado de Consanguinidad";
}else if($value['parentesco_PEPS']=='1_afinidad'){
	$paren = "1° Grado de Afinidad";
}else if($value['parentesco_PEPS']=='2_consanguinidad'){
	$paren = "2° Grado de Consanguinidad";
}else if($value['parentesco_PEPS']=='2_afinidad'){
	$paren = "2° Grado de Afinidad";
}else{
	$paren="";

}
$pdf->leyendas(118,122,'Arial','',7,110,8,'Parentesco: _________________________________________________');
$pdf->leyendas(145,121,'Arial','B',8,95,8,$paren);

$pdf->leyendas(12,128,'Arial','',7,110,8,'Puesto que desempeña: ____________________________________________________________________');
$pdf->leyendas(45,127,'Arial','B',8,95,8,$value['puesto_PEPS']);

$pdf->leyendas(122,128,'Arial','',7,110,8,'Período: _________________________________________________');
$pdf->leyendas(140,127,'Arial','B',8,95,8,$value['periodo_PEPS']);



$pdf->cuadrogrande(11,28,193,107,3,D);
/**********************A**************************************/

$ref_laborales = $DAO->mostrarAll($conexion,"SELECT * FROM ref_lugar_trabajo WHERE cli_correlativo='$value[0]'");
foreach ($ref_laborales as $keyRefLab) {
	# code...
}

/************************************B*********************************************/
$pdf->leyendas(12,135,'Arial','',7,95,8,'B.- REFERENCIAS LABORALES DEL SOLICITANTE');

$pdf->leyendas(12,141,'Arial','',7.5,180,8,'1 LUGAR DE TRABAJO _________________________________________________________________________');
if($keyRefLab['ref_lugar_trabajo']!=""){
$pdf->leyendas(41,140,'Arial','B',7,110,8,$keyRefLab['ref_lugar_trabajo']);
}else{
	$pdf->leyendas(45,140,'Arial','B',8,95,8,"-");
}
$pdf->leyendas(150,141,'Arial','',7,120,8,'2 SUELDO MENSUAL __________________');
if($keyRefLab['ref_sueldo_mensual']!=""){
$pdf->leyendas(180,140,'Arial','B',8,95,8,"$ ".number_format($keyRefLab['ref_sueldo_mensual'],2,'.',','));
}else{
$pdf->leyendas(180,140,'Arial','B',8,95,8,"$ -");
}

$pdf->leyendas(12,148,'Arial','',7,138,8,'3 DIRECCION _________________________________________________________________________________________');
if($keyRefLab['ref_direccion_lugar_trabajo']!=""){
$pdf->leyendas(30,147,'Arial','B',8,120,8,$keyRefLab['ref_direccion_lugar_trabajo']);
}else{
	$pdf->leyendas(35,147,'Arial','B',8,95,8,"-");
}
$pdf->leyendas(150,148,'Arial','',7,120,8,'4 TELEFONO _________________________');
if($keyRefLab['ref_telefono_trabajo']!=""){
$pdf->leyendas(177,147,'Arial','B',8,95,8,$keyRefLab['ref_telefono_trabajo']);
}else{
	$pdf->leyendas(180,147,'Arial','B',8,95,8,"-");
}


$pdf->leyendas(12,155,'Arial','',7,120,8,'5 PUESTO QUE DESEMPEÑA _____________________________________________________');
if($keyRefLab['ref_puesto_que_desempenia']!=""){
$pdf->leyendas(50,154,'Arial','B',8,95,8,$keyRefLab['ref_puesto_que_desempenia']);
}else{
	$pdf->leyendas(55,154,'Arial','B',8,95,8,"-");
}

if($keyRefLab['ref_fecha_inicio_labores']!='' and $keyRefLab['ref_fecha_inicio_labores']!='0000-00-00'){
$date4 = date_create($keyRefLab['ref_fecha_inicio_labores']);
 $fecha4=date_format($date4,'d/m/Y');
}else{
	$fecha4="-";
}

$pdf->leyendas(120,155,'Arial','',7,120,8,'6 INICIO DE LABORES _______________________________________');
$pdf->leyendas(164,154,'Arial','B',8,95,8,$fecha4);



$pdf->leyendas(12,162,'Arial','',7,120,8,'7 NOMBRE DEL JEFE __________________________________________________________');
if($keyRefLab['ref_nombre_jefe']!=""){
$pdf->leyendas(40,161,'Arial','B',8,95,8,$keyRefLab['ref_nombre_jefe']);
}else{
	$pdf->leyendas(45,161,'Arial','B',8,95,8,"-");
}
$pdf->leyendas(120,162,'Arial','',7,120,8,'8 CARGO __________________________________________________');
if($keyRefLab['ref_cargo_jefe']!=""){
$pdf->leyendas(152,161,'Arial','B',8,95,8,$keyRefLab['ref_cargo_jefe']);
}else{
	$pdf->leyendas(155,161,'Arial','',8,95,8,"-");
}

$pdf->leyendas(12,169,'Arial','',7,120,8,'9  ____________________________________________________');
if($keyRefLab['pag_nombre_pagador']!=""){
$pdf->leyendas(18,168,'Arial','B',8,95,8,$keyRefLab['pag_nombre_pagador']);
}else{
	$pdf->leyendas(22,168,'Arial','',8,95,8,"-");
}
$pdf->leyendas(90,169,'Arial','',7,120,8,'10 DIR. DE PAGADURIA ____________________________________________________________');
if($keyRefLab['pag_direccion_pagaduria']!=""){
$pdf->leyendas(120,168,'Arial','B',6,95,8,$keyRefLab['pag_direccion_pagaduria']);
}else{
	$pdf->leyendas(126,168,'Arial','B',6,95,8,"-");
}
$pdf->leyendas(32,172,'Arial','',7,120,8,'NOMBRE DEL PAGADOR');

$pdf->leyendas(12,176,'Arial','',7,145,8,'11 NOMBRE DE PAGADURIA _________________________________________________________________________');
if($keyRefLab['pag_nombre_pagaduria']!=""){
$pdf->leyendas(48,175,'Arial','B',8,95,8,$keyRefLab['pag_nombre_pagaduria']);
}else{
	$pdf->leyendas(52,175,'Arial','',8,95,8,"-");
}
$pdf->leyendas(149,176,'Arial','',7,120,8,'12 TELEFONO _________________________');
if($keyRefLab['pag_telefono_pagaduria']!=""){
$pdf->leyendas(174,175,'Arial','B',8,95,8,$keyRefLab['pag_telefono_pagaduria']);
}else{
	$pdf->leyendas(176,175,'Arial','B',8,95,8,"-");
}



$pdf->cuadrogrande(11,136,193,48,3,D);
/***************************************B**********************************************/

/*************************INGRESOS***********************************/

$pdf->leyendas(80,184,'Arial','',7,95,8,'INGRESOS Y EGRESOS MENSUALES');
$pdf->leyendas(11,185,'Arial','',7,195,8,'__________________________________________________________________________________________________________________________________________');
$pdf->leyendas(50,189,'Arial','',7,95,8,'INGRESOS');
$pdf->leyendas(145,189,'Arial','',7,95,8,'EGRESOS');
$pdf->leyendas(11,189,'Arial','',7,195,8,'__________________________________________________________________________________________________________________________________________');


$datosIEM = $DAO->mostrarAll($conexion,"SELECT * FROM ingresos_egresos_mensuales_cre_personal WHERE cre_solic_id='$buscar'");
foreach($datosIEM as $filaIEM){}

$pdf->leyendas(12,194,'Arial','',7,95,8,'SUELDO');
$pdf->leyendas(53,194,'Arial','',7,95,8,'USD$');
$pdf->leyendas(68,194,'Arial','',7,95,8,'_____________________');
//number_format($filaIEM['iem_sueldo_mensual'],2,'.',',')
if($filaIEM['iem_sueldo_mensual']!="0.00" && $filaIEM['iem_sueldo_mensual']!=""){
$pdf->multicelda(69,196,29,2,'Arial','B',8,95,8,number_format($filaIEM['iem_sueldo_mensual'],2,'.',','),'R');
}else{
$pdf->multicelda(69,196,29,2,'Arial','B',8,95,8,'-','R');
}
$pdf->leyendas(110,194,'Arial','',7,95,8,'GASTOS DEL HOGAR');
$pdf->leyendas(148,194,'Arial','',7,95,8,'USD$');
$pdf->leyendas(164,194,'Arial','',7,95,8,'______________________');
if($filaIEM['iem_gastos_hogar_mensual']!="0.00" && $filaIEM['iem_gastos_hogar_mensual']!=""){
$pdf->multicelda(166,196,29,2,'Arial','B',8,95,8,number_format($filaIEM['iem_gastos_hogar_mensual'],2,'.',','),'R');
}else{
$pdf->multicelda(166,196,29,2,'Arial','B',8,95,8,'-','R');
}

$pdf->leyendas(12,200,'Arial','',7,95,8,'COMISIONES');
$pdf->leyendas(53,200,'Arial','',7,95,8,'USD$');
$pdf->leyendas(68,200,'Arial','',7,95,8,'_____________________');
if($filaIEM['iem_comisiones_mensual']!="0.00" && $filaIEM['iem_comisiones_mensual']!=""){
$pdf->multicelda(69,202,29,2,'Arial','B',8,95,8,number_format($filaIEM['iem_comisiones_mensual'],2,'.',','),'R');
}else{
$pdf->multicelda(69,202,29,2,'Arial','B',8,95,8,'-','R');
}

$pdf->leyendas(110,200,'Arial','',7,95,8,'DEUDAS CORTO PLAZO');
$pdf->leyendas(148,200,'Arial','',7,95,8,'USD$');
$pdf->leyendas(164,200,'Arial','',7,95,8,'______________________');
if($filaIEM['iem_deudas_corto_plazo_mensual']!="0.00" && $filaIEM['iem_deudas_corto_plazo_mensual']!=""){
$pdf->multicelda(166,202,29,2,'Arial','B',8,95,8,number_format($filaIEM['iem_deudas_corto_plazo_mensual'],2,'.',','),'R');
}else{
$pdf->multicelda(166,202,29,2,'Arial','B',8,95,8,'-','R');
}
$pdf->leyendas(12,206,'Arial','',7,95,8,'OTROS INGRESOS');
$pdf->leyendas(53,206,'Arial','',7,95,8,'USD$');
$pdf->leyendas(68,206,'Arial','',7,95,8,'_____________________');
if($filaIEM['iem_otros_ingresos_mensual']!="0.00" && $filaIEM['iem_otros_ingresos_mensual']!=""){
$pdf->multicelda(69,208,29,2,'Arial','B',8,95,8,number_format($filaIEM['iem_otros_ingresos_mensual'],2,'.',','),'R');
}else{
$pdf->multicelda(69,208,29,2,'Arial','B',8,95,8,'-','R');
}

$pdf->leyendas(110,206,'Arial','',7,95,8,'DEUDAS LARGO PLAZO');
$pdf->leyendas(148,206,'Arial','',7,95,8,'USD$');
$pdf->leyendas(164,206,'Arial','',7,95,8,'______________________');
if($filaIEM['iem_deudas_largo_plazo_mensual']!="0.00" && $filaIEM['iem_deudas_largo_plazo_mensual']!=""){
$pdf->multicelda(166,208,29,2,'Arial','B',8,95,8,number_format($filaIEM['iem_deudas_largo_plazo_mensual'],2,'.',','),'R');
}else{
$pdf->multicelda(166,208,29,2,'Arial','B',8,95,8,'-','R');
}
$pdf->leyendas(12,213,'Arial','',7,95,8,'______________________');

$pdf->leyendas(12,212,'Arial','',8,95,8,$filaIEM['iem_otros_ingresos_descripcion']);

$pdf->leyendas(53,213,'Arial','',7,95,8,'USD$');
$pdf->leyendas(68,213,'Arial','',7,95,8,'_____________________');
if($filaIEM['iem_otros_ingresos_mensual1']!="0.00" && $filaIEM['iem_otros_ingresos_mensual1']!=""){
$pdf->multicelda(69,215,29,2,'Arial','B',8,95,8,number_format($filaIEM['iem_otros_ingresos_mensual1'],2,'.',','),'R');
}else{
$pdf->multicelda(69,215,29,2,'Arial','B',8,95,8,'-','R');
}

$pdf->leyendas(110,213,'Arial','',7,95,8,'DESCUENTOS DE LEY');
$pdf->leyendas(148,213,'Arial','',7,95,8,'USD$');
$pdf->leyendas(164,213,'Arial','',7,95,8,'______________________');
if($filaIEM['iem_descuentos_ley_mensual']!="0.00" && $filaIEM['iem_descuentos_ley_mensual']!=""){
$pdf->multicelda(166,215,29,2,'Arial','B',8,95,8,number_format($filaIEM['iem_descuentos_ley_mensual'],2,'.',','),'R');
}else{
$pdf->multicelda(166,215,29,2,'Arial','B',8,95,8,'-','R');
}

$pdf->leyendas(12,220,'Arial','',7,95,8,'TOTAL');
$pdf->leyendas(53,220,'Arial','',7,95,8,'USD$');
$pdf->leyendas(68,220,'Arial','',7,95,8,'_____________________');
if($filaIEM['iem_total_ingresos']!="0.00" && $filaIEM['iem_total_ingresos']!=""){
$pdf->multicelda(69,222,29,2,'Arial','B',8,95,8,number_format($filaIEM['iem_total_ingresos'],2,'.',','),'R');
}else{
$pdf->multicelda(69,222,29,2,'Arial','B',8,95,8,'-','R');
}

$pdf->leyendas(110,220,'Arial','',7,95,8,'TOTAL');
$pdf->leyendas(148,220,'Arial','',7,95,8,'USD$');
$pdf->leyendas(164,220,'Arial','',7,95,8,'______________________');
if($filaIEM['iem_total_egresos']!="0.00" && $filaIEM['iem_total_egresos']!=""){
$pdf->multicelda(166,222,29,2,'Arial','B',8,95,8,number_format($filaIEM['iem_total_egresos'],2,'.',','),'R');
}else{
$pdf->multicelda(166,222,29,2,'Arial','B',8,95,8,'-','R');
}
$pdf->leyendas(12,226,'Arial','',7,95,8,'*EXPLIQUE');
$pdf->leyendas(28,226,'Arial','',7,95,8,'_________________________________________________________');
$pdf->leyendas(30,225,'Arial','B',8,95,8,$filaIEM['iem_explicacion_ingresos']);

$pdf->leyendas(110,226,'Arial','',7,95,8,'*EXPLIQUE');
$pdf->leyendas(125,226,'Arial','',7,95,8,'_____________________________________________________');
$pdf->leyendas(126,225,'Arial','B',8,95,8,$filaIEM['iem_explicacion_egresos']);



$pdf->cuadrogrande(11,185,193,48,3,D);
/*************************INGRESOS***********************************/
$datosPrestamo = $DAO->mostrarAll($conexion,"SELECT * FROM creditos WHERE cre_solic_id='$buscar'");
foreach($datosPrestamo as $filaPrestamo){}
/********************************C**********************************/

$pdf->leyendas(12,232,'Arial','',7,95,8,'C.- CARACTERISTICAS DEL PRESTAMO SOLICITADO');
$pdf->leyendas(12,237,'Arial','',7,95,8,'1 MONTO SOLICITADO  ____________________________________');
$pdf->leyendas(55,236,'Arial','B',8,95,8,"$ ".number_format($filaPrestamo['cre_monto'], 2, '.', ','));

$pdf->leyendas(90,237,'Arial','',7,95,8,'2 PLAZO SOLICITADO(AÑOS)  ______________');
$pdf->leyendas(132,236,'Arial','B',8,95,8,$filaPrestamo['cre_plazo_anio']);

$pdf->leyendas(145,237,'Arial','',7,95,8,'PLAZO SOLICITADO(DIAS)  ________________');
$pdf->leyendas(185,236,'Arial','B',8,95,8,$filaPrestamo['cre_plazo_dias']);

$pdf->leyendas(12,244,'Arial','',7,200,8,'4 DESTINO  ______________________________________________________________________________________________________________________________');
$pdf->leyendas(27,243,'Arial','B',6.5,230,8,$filaPrestamo['cre_destino_credito']);

$pdf->leyendas(12,251,'Arial','',7,100,8,'5 FORMA DE PAGO  ___________________________');
$pdf->leyendas(37,250,'Arial','B',8,95,8,$filaPrestamo['cre_num_cuotas']." CUOTA(S) ".$filaPrestamo['cre_forma_pago']);

$pdf->leyendas(75,251,'Arial','',7,100,8,'CUOTA US$  _______________________');
$pdf->leyendas(100,250,'Arial','B',8,230,8,"$ ".$filaPrestamo['cre_cuota']);

$pdf->leyendas(124,251,'Arial','',7,100,8,'6 FORMA DE DESEMBOLSO ______________________________');
$pdf->leyendas(162,250,'Arial','B',8,95,8,$filaPrestamo['cre_forma_desembolso']);

$pdf->cuadrogrande(11,234,193,25,3,D);


$pdf->leyendas(11,262,'Arial','',7,100,8,'3 GARANTIA');
$pdf->multicelda(28,262,174,6,'Arial','B',7,100,8,$filaPrestamo['cre_garantia']);
$pdf->leyendas(27,262,'Arial','',7,180,8,'______________________________________________________________________________________________________________________________');
$pdf->leyendas(27,268,'Arial','',7,180,8,'______________________________________________________________________________________________________________________________');
$pdf->leyendas(27,274,'Arial','',7,180,8,'______________________________________________________________________________________________________________________________');
$pdf->leyendas(27,280,'Arial','',7,180,8,'______________________________________________________________________________________________________________________________');
$pdf->cuadrogrande(11,260,193,26,3,D);



$pdf->leyendas(11,285,'Arial','',7,100,8,'OBSERVACIONES');
$pdf->multicelda(12,290,190,6,'Arial','B',6,100,8,$filaPrestamo['cre_observaciones']);
$pdf->leyendas(11,290,'Arial','',7,200,8,'__________________________________________________________________________________________________________________________________________');
$pdf->leyendas(11,297,'Arial','',7,200,8,'__________________________________________________________________________________________________________________________________________');


$pdf->cuadrogrande(11,287,193,17,3,D);


/********************************C************************************/

$datosPromo = $DAO->mostrarAll($conexion,"SELECT cli_nombre,cli_apellido FROM usuarios WHERE usuario_nombre='$filaPrestamo[20]'");
foreach($datosPromo as $filaPromo){}

$pdf->leyendas(20,302,'Arial','',7,100,8,'PROMOTOR: '.$filaPromo[0]." ".$filaPromo[1]);

$pdf->AddPage();


$pdf->multicelda(80,10,190,6,'Arial','',7,100,8,'CAJA DE CREDITO DE SAN VICENTE');
$pdf->multicelda(12,20,190,6,'Arial','',7,100,8,utf8_decode('¿HA TENIDO CREDITO EN ESTA CAJA?'));
$pdf->multicelda(85,20,190,6,'Arial','',7,100,8,'SI');
$pdf->multicelda(110,20,190,6,'Arial','',7,100,8,'NO');

$pdf->cuadropequeño(90,18,10,7,0,D);
$pdf->cuadropequeño(118,18,10,7,0,D);

if($filaPrestamo['cre_operaciones_caja_credito']==1){
	$pdf->multicelda(90,19,190,6,'Arial','B',8,100,8,"X");
}else{
	$pdf->multicelda(118,19,190,6,'Arial','B',8,100,8,"X");
}



/***********************************************E************************************************/
$datosUsu = $DAO->mostrarAll($conexion,"select * from ref_obligaciones_por_pagar where cli_correlativo='$cli_correlativo'  order by obli_id desc limit 3 ");
//foreach ($datosUsu as $keyObli) {}

$pdf->cuadrogrande(11,28,193,35,3,D);
$pdf->multicelda(12,28,190,6,'Arial','',7,100,8,"E.- OBLIGACIONES POR PAGAR (SIRVASE ADJUNTAR CONSTANCIA DE SUS DEUDAS)");
$pdf->leyendas(11,28,'Arial','',7,200,8,'__________________________________________________________________________________________________________________________________________');


$pdf->multicelda(46,34,190,6,'Arial','',7,100,8,"NOMBRE DEL ACREEDOR");
$pdf->multicelda(150,34,190,6,'Arial','',7,100,8,"VALOR");
$pdf->leyendas(11,34,'Arial','',7,200,8,'__________________________________________________________________________________________________________________________________________');

$pdf->leyendas(11,40,'Arial','',7,200,8,'__________________________________________________________________________________________________________________________________________');
$pdf->multicelda(12,39,190,6,'Arial','B',7,100,8,$datosUsu[0][1]);
if($datosUsu[0][2]!=""){
$pdf->multicelda(148,39,190,6,'Arial','B',7,100,8,"$ ".number_format($datosUsu[0][2],2,'.',','));
}
$pdf->leyendas(11,47,'Arial','',7,200,8,'__________________________________________________________________________________________________________________________________________');
$pdf->multicelda(12,46,190,6,'Arial','B',7,100,8,$datosUsu[1][1]);
if($datosUsu[1][2]!=""){
$pdf->multicelda(148,46,190,6,'Arial','B',7,100,8,"$ ".number_format($datosUsu[1][2],2,'.',','));
}
$pdf->leyendas(11,53,'Arial','',7,200,8,'__________________________________________________________________________________________________________________________________________');
$pdf->multicelda(12,52,190,6,'Arial','B',7,100,8,$datosUsu[2][1]);
if($datosUsu[2][2]!=""){
$pdf->multicelda(148,52,190,6,'Arial','B',7,100,8,"$ ".number_format($datosUsu[2][2],2,'.',','));
}
$pdf->multicelda(128,31,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(128,32,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(128,33,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(128,34,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(128,35,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(128,37,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(128,39,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(128,41,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(128,43,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(128,45,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(128,47,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(128,49,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(128,51,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(128,53,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(128,55,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(128,57,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(128,59,190,6,'Arial','',6,100,8,"|");


$total = $DAO->mostrarAll($conexion,"select SUM(obli_valor) from ref_obligaciones_por_pagar where  cre_solic_id='$buscar'");
			 	foreach ($total as $oblig) {
			 		# code...
			 	}

$pdf->multicelda(105,57,190,6,'Arial','',8,100,8,"TOTAL DEUDAS");
$pdf->multicelda(148,57,190,6,'Arial','B',7,100,8,"$ ".number_format($oblig[0],2,'.',','));


/*********************************************E*************************************************/

/************************************F****************************************************/
  $datosBnk = $DAO->mostrarAll($conexion,"select * from ref_comerciales_bancarias where (cli_correlativo LIKE '$cli_correlativo') order by cli_correlativo_referencia desc LIMIT 2");

$pdf->cuadrogrande(11,64,193,23,3,D);
$pdf->leyendas(12,62,'Arial','',7,100,8,"F.- REFERENCIAS BANCARIAS O COMERCIALES DEL SOLICITANTE");
$pdf->leyendas(11,63,'Arial','',7,200,8,'__________________________________________________________________________________________________________________________________________');
$pdf->leyendas(12,68,'Arial','',8,200,8,'NOMBRE Y DIRECCION');
$pdf->leyendas(75,68,'Arial','',8,200,8,'TELEFONO');
$pdf->leyendas(102,68,'Arial','',8,200,8,'CLASE DE OPERACION');
$pdf->leyendas(145,68,'Arial','',8,200,8,'SALDO ACTUAL');
$pdf->multicelda(175,69,28,3,'Arial','',8,200,8,'FECHA DE CANCELACION');
$pdf->leyendas(11,70,'Arial','',7,200,8,'__________________________________________________________________________________________________________________________________________');
$pdf->leyendas(12,74,'Arial','B',8,200,8,$datosBnk[0][2]);
$pdf->leyendas(74,74,'Arial','B',8,200,8,$datosBnk[0][4]);
$pdf->leyendas(96,74,'Arial','B',8,200,8,$datosBnk[0][5]);
if($datosBnk[0][6]!=""){
$pdf->leyendas(140,74,'Arial','B',8,200,8,"$ ".number_format($datosBnk[0][6],2,'.',','));
}
if($datosBnk[0][7]!='0000-00-00' && $datosBnk[0][7]!=''){
	$date = date_create($datosBnk[0][7]);
	$fecBn=date_format($date,'d/m/Y');
}else{
	$fecBn="";
}
$pdf->leyendas(174,74,'Arial','B',8,200,8,$fecBn);
$pdf->leyendas(11,76,'Arial','',7,200,8,'__________________________________________________________________________________________________________________________________________');
$pdf->leyendas(12,80,'Arial','B',8,200,8,$datosBnk[1][2]);
$pdf->leyendas(74,80,'Arial','B',8,200,8,$datosBnk[1][4]);
$pdf->leyendas(96,80,'Arial','B',8,200,8,$datosBnk[1][5]);
if($datosBnk[1][6]!=""){
$pdf->leyendas(140,80,'Arial','',8,200,8,"$ ".number_format($datosBnk[1][6],2,'.',','));
}
if($datosBnk[1][7]!='0000-00-00' && $datosBnk[1][7]!=''){
	$date1 = date_create($datosBnk[1][7]);
	$fec1=date_format($date1,'d/m/Y');
}
$pdf->leyendas(174,80,'Arial','B',8,200,8,$fec1);
/*$pdf->leyendas(11,95,'Arial','',7,200,8,'__________________________________________________________________________________________________________________________________________');*/
$pdf->multicelda(68,66,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(68,68,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(68,70,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(68,72,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(68,74,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(68,76,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(68,78,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(68,80,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(68,82,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(68,83,190,6,'Arial','',6,100,8,"|");


///////////////////////////////////////////////////////////////////////

$pdf->multicelda(94,66,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(94,68,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(94,70,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(94,72,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(94,74,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(94,76,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(94,78,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(94,80,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(94,82,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(94,83,190,6,'Arial','',6,100,8,"|");

////////////////////////////////////////////////////////////////////////////////

$pdf->multicelda(138,66,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(138,68,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(138,70,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(138,72,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(138,74,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(138,76,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(138,78,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(138,80,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(138,82,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(138,83,190,6,'Arial','',6,100,8,"|");

////////////////////////////////////////////////////////////////////////////////////
$pdf->multicelda(170,66,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(170,68,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(170,70,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(170,72,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(170,74,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(170,76,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(170,78,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(170,80,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(170,82,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(170,83,190,6,'Arial','',6,100,8,"|");

////////////////////////////////////////////////////////////////////////////////////


/********************************************F******************************************/

/**************************************************G*************************************/

  $datosPer = $DAO->mostrarAll($conexion,"select * from ref_personales_familiares where (cli_correlativo LIKE '$cli_correlativo') and ref_tipo_referencia_p_f='PERSONAL' order by ref_correlativo_referencia desc limit 3");


$pdf->cuadrogrande(11,88,193,24,3,D);
$pdf->leyendas(12,86,'Arial','',7,100,8,"G.- REFERENCIAS PERSONALES DEL SOLICITANTE");
$pdf->leyendas(11,87,'Arial','',7,200,8,'__________________________________________________________________________________________________________________________________________');

$pdf->leyendas(11,90,'Arial','',7,200,8,'NOMBRE');
$pdf->leyendas(95,90,'Arial','',7,200,8,'DIRECCION');
$pdf->leyendas(180,90,'Arial','',7,200,8,'TELEFONO');
$pdf->leyendas(11,91,'Arial','',7,200,8,'__________________________________________________________________________________________________________________________________________');
$pdf->leyendas(12,95,'Arial','B',8,200,8,$datosPer[0][3]);
$pdf->leyendas(82,95,'Arial','B',8,200,8,$datosPer[0][4]);
$pdf->leyendas(180,95,'Arial','B',8,200,8,$datosPer[0][5]);
$pdf->leyendas(11,96,'Arial','',7,200,8,'__________________________________________________________________________________________________________________________________________');
$pdf->leyendas(12,101,'Arial','B',8,200,8,$datosPer[1][3]);
$pdf->leyendas(82,101,'Arial','B',8,200,8,$datosPer[1][4]);
$pdf->leyendas(180,101,'Arial','B',8,200,8,$datosPer[1][5]);
$pdf->leyendas(11,102,'Arial','',7,200,8,'__________________________________________________________________________________________________________________________________________');
$pdf->leyendas(12,106,'Arial','B',8,200,8,$datosPer[2][3]);
$pdf->leyendas(82,106,'Arial','B',8,200,8,$datosPer[2][4]);
$pdf->leyendas(180,106,'Arial','B',8,200,8,$datosPer[2][5]);
/**************************************G*******************************************/

/**************************************************H*************************************/
  $datosFam = $DAO->mostrarAll($conexion,"select * from ref_personales_familiares where (cli_correlativo LIKE '$cli_correlativo') and ref_tipo_referencia_p_f='FAMILIAR' order by ref_correlativo_referencia desc limit 3");

$pdf->cuadrogrande(11,113,193,26,3,D);
$pdf->leyendas(12,111,'Arial','',7,100,8,"H.- REFERENCIAS DE FAMILIARES QUE NO VIVAN CON USTED");
$pdf->leyendas(11,112,'Arial','',7,200,8,'__________________________________________________________________________________________________________________________________________');
$pdf->leyendas(11,116,'Arial','',7,200,8,'__________________________________________________________________________________________________________________________________________');
$pdf->leyendas(11,115,'Arial','',7,200,8,'NOMBRE');
$pdf->leyendas(95,115,'Arial','',7,200,8,'DIRECCION');
$pdf->leyendas(180,115,'Arial','',7,200,8,'TELEFONO');
$pdf->leyendas(12,121,'Arial','B',8,200,8,$datosFam[0][3]);
$pdf->leyendas(82,121,'Arial','B',8,200,8,$datosFam[0][4]);
$pdf->leyendas(180,121,'Arial','B',8,200,8,$datosFam[0][5]);
$pdf->leyendas(11,122,'Arial','',7,200,8,'__________________________________________________________________________________________________________________________________________');
$pdf->leyendas(12,127,'Arial','B',8,200,8,$datosFam[1][3]);
$pdf->leyendas(82,127,'Arial','B',8,200,8,$datosFam[1][4]);
$pdf->leyendas(180,127,'Arial','B',8,200,8,$datosFam[1][5]);
$pdf->leyendas(11,128,'Arial','',7,200,8,'__________________________________________________________________________________________________________________________________________');
$pdf->leyendas(12,133,'Arial','B',8,200,8,$datosFam[2][3]);
$pdf->leyendas(82,133,'Arial','B',8,200,8,$datosFam[2][4]);
$pdf->leyendas(180,133,'Arial','B',8,200,8,$datosFam[2][5]);

/**************************************H*******************************************/

/******************************I**************************************************/

  $datosGFam = $DAO->mostrarAll($conexion,"select * from ref_grupo_familiar where (cli_correlativo LIKE '$cli_correlativo')  order by gf_correlativo desc limit 3");

$pdf->cuadrogrande(11,140,193,26,3,D);
$pdf->leyendas(12,138,'Arial','',7,100,8,"I.- GRUPO FAMILIAR:  N° DE PERSONAS DEPENDIENTES DEL SOLICITANTE");
$pdf->leyendas(11,139,'Arial','',7,200,8,'__________________________________________________________________________________________________________________________________________');
$pdf->leyendas(12,142,'Arial','',7,200,8,'NOMBRE');
$pdf->leyendas(80,142,'Arial','',7,200,8,'SEXO');
$pdf->leyendas(92,142,'Arial','',7,200,8,'EDAD');
$pdf->leyendas(105,142,'Arial','',7,200,8,'PARENTESCO');
$pdf->leyendas(140,142,'Arial','',7,200,8,'OCUPACION');
$pdf->leyendas(172,142,'Arial','',7,200,8,'INGRESO MENSUAL');
$pdf->leyendas(11,143,'Arial','',7,200,8,'__________________________________________________________________________________________________________________________________________');
$pdf->leyendas(12,148,'Arial','B',8,200,8,$datosGFam[0][2]);
if($datosGFam[0][3]!="NO ESPECIFICADO"){
$pdf->leyendas(83,148,'Arial','B',8,200,8,$datosGFam[0][3][0]);
}else{
	$pdf->leyendas(83,148,'Arial','B',8,200,8,"-");
}
if($datosGFam[0][4]!="0"){
$pdf->leyendas(94,148,'Arial','B',8,200,8,$datosGFam[0][4]);
}else{
	$pdf->leyendas(94,148,'Arial','B',8,200,8,"-");
}
if($datosGFam[0][6]!="NO ESPECIFICADO"){
$pdf->leyendas(105,148,'Arial','B',8,200,8,$datosGFam[0][6]);
}else{
	$pdf->leyendas(105,148,'Arial','B',8,200,8,"-");
}
$pdf->leyendas(139,148,'Arial','B',8,200,8,$datosGFam[0][7]);
if($datosGFam[0][8]!=""){
$pdf->leyendas(176,148,'Arial','B',8,200,8,"$ ".number_format($datosGFam[0][8],2,'.',','));
}
$pdf->leyendas(11,149,'Arial','',7,200,8,'__________________________________________________________________________________________________________________________________________');
$pdf->leyendas(12,154,'Arial','B',8,200,8,$datosGFam[1][2]);
if($datosGFam[1][3]!="NO ESPECIFICADO"){
$pdf->leyendas(83,154,'Arial','B',8,200,8,$datosGFam[1][3][0]);
}else{
	$pdf->leyendas(83,154,'Arial','B',8,200,8,"-");
}
if($datosGFam[1][4]!="0"){
$pdf->leyendas(94,154,'Arial','B',8,200,8,$datosGFam[1][4]);
}else{
	$pdf->leyendas(94,154,'Arial','B',8,200,8,"-");
}
if($datosGFam[1][6]!="NO ESPECIFICADO"){
$pdf->leyendas(105,154,'Arial','B',8,200,8,$datosGFam[1][6]);
}else{
	$pdf->leyendas(105,154,'Arial','B',8,200,8,"-");
}
$pdf->leyendas(139,154,'Arial','B',8,200,8,$datosGFam[1][7]);
if($datosGFam[1][8]!=""){
$pdf->leyendas(176,154,'Arial','B',8,200,8,"$ ".number_format($datosGFam[1][8],2,'.',','));
}
$pdf->leyendas(11,155,'Arial','',7,200,8,'__________________________________________________________________________________________________________________________________________');
$pdf->leyendas(12,160,'Arial','B',8,200,8,$datosGFam[2][2]);
if($datosGFam[2][3]!="NO ESPECIFICADO"){
$pdf->leyendas(83,160,'Arial','B',8,200,8,$datosGFam[2][3][0]);
}else{
	$pdf->leyendas(83,160,'Arial','B',8,200,8,"-");
}
if($datosGFam[2][4]!="0"){
$pdf->leyendas(94,160,'Arial','B',8,200,8,$datosGFam[2][4]);
}else{
	$pdf->leyendas(94,160,'Arial','B',8,200,8,"-");
}
if($datosGFam[2][6]!="NO ESPECIFICADO"){
$pdf->leyendas(105,160,'Arial','B',8,200,8,$datosGFam[2][6]);
}else{
	$pdf->leyendas(105,160,'Arial','B',8,200,8,"-");
}
$pdf->leyendas(139,160,'Arial','B',8,200,8,$datosGFam[2][7]);
if($datosGFam[2][8]!=""){
$pdf->leyendas(176,160,'Arial','B',8,200,8,"$".number_format($datosGFam[2][8],2,'.',','));
}
////////////////////////////////////////////////////////////////////////////////////
$pdf->multicelda(78,142,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(78,144,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(78,146,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(78,148,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(78,150,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(78,152,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(78,154,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(78,156,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(78,158,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(78,160,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(78,162,190,6,'Arial','',6,100,8,"|");

////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////
$pdf->multicelda(90,142,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(90,144,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(90,146,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(90,148,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(90,150,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(90,152,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(90,154,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(90,156,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(90,158,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(90,160,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(90,162,190,6,'Arial','',6,100,8,"|");

////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////
$pdf->multicelda(102,142,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(102,144,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(102,146,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(102,148,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(102,150,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(102,152,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(102,154,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(102,156,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(102,158,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(102,160,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(102,162,190,6,'Arial','',6,100,8,"|");

////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////
$pdf->multicelda(127,142,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(127,144,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(127,146,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(127,148,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(127,150,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(127,152,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(127,154,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(127,156,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(127,158,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(127,160,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(127,162,190,6,'Arial','',6,100,8,"|");

////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////
$pdf->multicelda(170,142,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(170,144,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(170,146,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(170,148,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(170,150,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(170,152,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(170,154,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(170,156,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(170,158,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(170,160,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(170,162,190,6,'Arial','',6,100,8,"|");

////////////////////////////////////////////////////////////////////////////////////

/*******************************I*******************************************/
/*******************************J******************************************/

$conyuge = $DAO->mostrarAll($conexion,"select * from ref_conyuge where cli_correlativo='$cli_correlativo'");

$profesionUoficio = $DAO->mostrarAll($conexion,"select po_profesion from cat_profesiones_oficios where po_codigo_profesion='$conyuge[0][5]'");

$pdf->leyendas(12,165,'Arial','',7,100,8,"J.- DATOS DEL CONYUGE");
$pdf->leyendas(12,170,'Arial','',7,200,8,'NOMBRES Y APELLIDOS ________________________________________________________________________');
$pdf->leyendas(45,169,'Arial','B',8,100,8,$conyuge[0][3]." ".$conyuge[0][1]." ".$conyuge[0][2]);
$pdf->leyendas(142,170,'Arial','',7,200,8,'FECHA DE NAC. ___________________________');
if($conyuge[0][4]!='0000-00-00'  && $conyuge[0][4]!=''){
	$dateCony = date_create($conyuge[0][4]);
	$feccony=date_format($dateCony,'d/m/Y');
}else{
	$feccony="-";
}
$pdf->leyendas(172,169,'Arial','B',8,100,8,$feccony);
$pdf->leyendas(12,176,'Arial','',7,200,8,'PROFESION U OFICIO ________________________________________');
$pdf->leyendas(45,175,'Arial','B',8,100,8,utf8_decode($profesionUoficio[0][0]));
$pdf->leyendas(95,176,'Arial','',7,200,8,'N° DUI ___________________________');
if($conyuge[0][6]!=""){
$pdf->leyendas(110,175,'Arial','B',8,100,8,$conyuge[0][6]);
}else{
	$pdf->leyendas(115,175,'Arial','B',8,100,8,"-");
}
if($conyuge[0][7]!='0000-00-00' && $conyuge[0][7]!=''){
	$dateexten = date_create($conyuge[0][7]);
	$fecExten=date_format($dateexten,'d/m/Y');
}else{
	$fecExten="-";
}
$pdf->leyendas(142,176,'Arial','',7,200,7,'FECHA DE EXTENSION _____________________');

$pdf->leyendas(174,175,'Arial','B',8,100,8,$fecExten);
$pdf->leyendas(12,182,'Arial','',7,200,8,'N° NIT ____________________________________________________________');
if($conyuge[0][8]!=""){
$pdf->leyendas(45,181,'Arial','B',8,100,8,$conyuge[0][8]);
}else{
	$pdf->leyendas(48,181,'Arial','B',8,100,8,"-");
}
$pdf->leyendas(107,182,'Arial','',7,200,8,'N° ISSS ____________________________________________________________');
if($conyuge[0][9]!=""){
$pdf->leyendas(115,181,'Arial','B',8,100,8,$conyuge[0][9]);
}else{
	$pdf->leyendas(130,181,'Arial','B',8,100,8,"-");
}
$pdf->leyendas(12,188,'Arial','',7,200,8,'LUGAR DE TRABAJO ___________________________________________');
if($conyuge[0][13]!=""){
$pdf->leyendas(40,187,'Arial','B',8,100,8,$conyuge[0][13]);
}else{
	$pdf->leyendas(43,187,'Arial','B',8,100,8,"-");
}
$pdf->leyendas(98,188,'Arial','',7,200,8,'DIR. LUGAR DE TRABAJO ___________________________________________________');
if($conyuge[0][14]!=""){
$pdf->leyendas(130,187,'Arial','B',8,100,8,$conyuge[0][14]);
}else{
	$pdf->leyendas(135,187,'Arial','B',8,100,8,"-");
}
$pdf->leyendas(12,194,'Arial','',7,200,8,'TELEFONO ___________________');
if($conyuge[0][15]!=""){
$pdf->leyendas(33,193,'Arial','B',8,100,8,$conyuge[0][15]);
}else{
	$pdf->leyendas(36,193,'Arial','B',8,100,8,"-");
}
$pdf->leyendas(54,194,'Arial','',7,200,8,'PUESTO QUE DESEMPEÑA _______________________________');
if($conyuge[0][16]!=""){
$pdf->leyendas(90,193,'Arial','B',8,100,8,$conyuge[0][16]);
}else{
	$pdf->leyendas(95,193,'Arial','B',8,100,8,"-");
}
$pdf->leyendas(131,194,'Arial','',7,200,8,'TIEMPO DE DESEMPEÑARLO ________________________');
if($conyuge[0][17]!=""){
$pdf->leyendas(175,193,'Arial','B',8,100,8,$conyuge[0][17]." AÑOS");
}else{
	$pdf->leyendas(178,193,'Arial','B',8,100,8,"-");
}
$pdf->cuadrogrande(11,167,193,35,3,D);
/*******************************J******************************************/
$juramento = $DAO->mostrarAll($conexion,"select * from configuracion_informes where  id_conf='1'");
$pdf->multicelda(12,203,190,4,'Arial','',6,100,8,(utf8_decode($juramento[0][1])),'J');
/*
$pdf->multicelda(12,203,190,4,'Arial','',6,190,8,utf8_decode('L. DECLARO: bajo la fe de juramento que los datos que he proporcionado en la presente solicitud son verdaderos y que mis ingresos vienen de actividades enteramente legítimas, Estoy consiente que dichos fondos no se encuentran relacionados bajo ninguna circunstancias con hechos o actividades criminales relacionadas con el narcotráfico y delitos conexos con el lavado de dinero y activos, tampoco con situaciones en contra de la Ley Contra el Lavado de dinero y Activos de la República de el Salvador. Además declaro que me someto a cualquier tipo de investigación necesaria para establecer la procedencia, el destino y el origen de los fondos de mi operación, por último declaro que este formulario ha sido completado por mi persona y que la información es verdadera;  por lo que eximo a  la CAJA DE CREDITO DE SAN VICENTE,  SOCIEDAD COOPERATIVA DE R.L. DE C.V. y a todo el personal de empleados,  de cualquier responsabilidad por  información falsa que hubiere proporcionado. En caso de que se me resuelva favorablemente, me someto a todas las condiciones establecidas en los reglamentos, normas y politicas de crédito de esta caja.'),'J');*/

$lugaryfecha = $DAO->mostrarAll($conexion,"select * from ingresos_egresos_mensuales_cre_personal where cre_solic_id='$buscar'");

$pdf->leyendas(12,230,'Arial','',7,200,8,'LUGAR Y FECHA ____________________________________________________________________________');
$pdf->leyendas(45,229,'Arial','',8,100,8,$lugaryfecha[0][16]." ".$lugaryfecha[0][17]." DE ".$lugaryfecha[0][18]." DE ".$lugaryfecha[0][19]);
$pdf->leyendas(148,230,'Arial','',7,200,8,' _____________________________________');

$cliente = $DAO->mostrarAll($conexion,"select cli_nombre_dui from clientes where cli_correlativo='$cli_correlativo'");

$pdf->leyendas(154,234,'Arial','',7,200,8,$cliente[0][0]);
$pdf->leyendas(160,238,'Arial','',7,200,8,' FIRMA DEL SOLICITANTE');


if($value['id_comite']==1 || $value['id_comite']==2){

$pdf->leyendas(12,244,'Arial','',6,200,7,' El comité de credito _______ ');
$pdf->leyendas(35,243,'Arial','',8,200,7,$value['id_comite']);

$pdf->leyendas(40,244,'Arial','',6,220,7,' de la Caja de Crédito de San Vicente, conoció la presente solicitud en sesión N° _______________________________ del dia _________________________________');
$pdf->leyendas(12,250,'Arial','',6,220,7,'y acordó: _______________________________________________________________________________________________________________________________________________________');
$pdf->leyendas(12,256,'Arial','',6,220,7,'_______________________________________________________________________________________________________________________________________________________________');
$pdf->leyendas(12,262,'Arial','',6,220,7,'_______________________________________________________________________________________________________________________________________________________________');
$pdf->leyendas(12,268,'Arial','',6,220,7,'_______________________________________________________________________________________________________________________________________________________________');
}else if($value['id_comite']==3){
	$pdf->leyendas(12,244,'Arial','',6,200,7,'La Junta Directiva');

$pdf->leyendas(30,244,'Arial','',6,220,7,'de la Caja de Crédito de San Vicente, conoció la presente solicitud en sesión N° _______________________________ del dia __________________________________________');
$pdf->leyendas(12,250,'Arial','',6,220,7,'y acordó: _______________________________________________________________________________________________________________________________________________________');
$pdf->leyendas(12,256,'Arial','',6,220,7,'_______________________________________________________________________________________________________________________________________________________________');
$pdf->leyendas(12,262,'Arial','',6,220,7,'_______________________________________________________________________________________________________________________________________________________________');
$pdf->leyendas(12,268,'Arial','',6,220,7,'_______________________________________________________________________________________________________________________________________________________________');
}

$comite = $DAO->mostrarAll($conexion,"select * from comites where id_comite='$value[78]'");
foreach ($comite as $keyComite) {
	# code...
}

$pdf->leyendas(12,285,'Arial','',7,200,8,'________________________________________');
$pdf->leyendas(24,290,'Arial','',7,200,8,$keyComite[4]);

$pdf->leyendas(80,285,'Arial','',7,200,8,'________________________________________');
$pdf->leyendas(94,290,'Arial','',7,200,8,$keyComite[5]);

$pdf->leyendas(144,285,'Arial','',7,200,8,'________________________________________');
$pdf->leyendas(158,290,'Arial','',7,200,8,$keyComite[6]);

$pdf->leyendas(12,302,'Arial','',7,100,8,'PROMOTOR: '.$filaPromo[0]." ".$filaPromo[1]);



$pdf->Output(); //Salida al navegador
?>