<?php session_start();
            include_once ("../modelo/Conexion.php");
            include_once ("../modelo/DAO.php");
            $conexions=new Conexion();
            $conexion=$conexions->conectar();
            $DAO=new DAO();


	include_once('PDF.php');
 $buscar = $_GET["id"];
 $cli_correlativo = $_GET["cli_correlativo"];
header("Content-Type: text/html;charset=utf-8");

$datos = $DAO->mostrarAll($conexion,"select * from clientes inner join creditos on clientes.cli_correlativo=creditos.cli_correlativo where ((creditos.cre_solic_id LIKE '%$buscar%')) AND cre_tipo_garantia='HIPOTECARIO' ");
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
$pdf->leyendas(146,14,'Arial','',7,95,8,"SOLICITUD HIPOTECARIA");

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
$pdf->leyendas(48,55,'Arial','B',8,115,8,$value['cli_direccion']);


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
if($value['geo_codigo_barrio']!=""  && $value['geo_codigo_barrio']!="0"){
$pdf->leyendas(140,61,'Arial','B',8,95,8,$filaBarrio[0]);
}else{
	$pdf->leyendas(145,61,'Arial','B',8,95,8,"-");
}

$datosDepto=$DAO->mostrarAll($conexion,"select  geo_nombre_departamento from  cat_geo_departamentos where geo_codigo_pais='$value[19]' and geo_codigo_departamento='$value[20]' ");
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
if($value['cli_vehiculo_anio_']!="" && $value['cli_vehiculo_anio_']!="0000" ){
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

$pdf->leyendas(12,141,'Arial','',7.5,180,7,'1 LUGAR DE TRABAJO _________________________________________________________________________');
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



$pdf->cuadrogrande(11,136,193,85,3,D);
/***************************************B**********************************************/

/*************************INGRESOS***********************************/
$keyRefEmpl = $DAO->mostrarAll($conexion,"SELECT * FROM cli_empleos_desempeniados WHERE cod_cliente='$value[0]' order by id_empleos_desempleniados desc limit 3");

$pdf->leyendas(70,180,'Arial','',7,95,8,'EMPLEOS DESEMPEÑADOS DURANTE LOS ULTIMOS 5 AÑOS');
$pdf->leyendas(11,181,'Arial','',7,195,8,'__________________________________________________________________________________________________________________________________________');
$pdf->leyendas(12,188,'Arial','',7,95,8,'NOMBRE DE LA OFICINA O EMPRESA');
$pdf->leyendas(60,188,'Arial','',7,95,8,'EMPLEO DESEMPEÑADO');
$pdf->leyendas(104,186,'Arial','',7,95,8,'DE');
$pdf->leyendas(95,190,'Arial','',7,95,8,'MES');
$pdf->leyendas(105,190,'Arial','',7,95,8,'AÑO');
$pdf->leyendas(120,186,'Arial','',7,95,8,'A');
$pdf->leyendas(114,190,'Arial','',7,95,8,'MES');
$pdf->leyendas(123,190,'Arial','',7,95,8,'AÑO');
$pdf->leyendas(138,186,'Arial','',7,95,8,'SUELDO');
$pdf->leyendas(134,190,'Arial','',7,95,8,'INICIAL');
$pdf->leyendas(148,190,'Arial','',7,95,8,'FINAL');
$pdf->leyendas(160,188,'Arial','',7,95,8,'MOTIVO DEL CAMBIO DE EMPLEO');
$pdf->leyendas(94,187,'Arial','',7,195,8,'_____________________________________________');
$pdf->leyendas(11,191,'Arial','',7,195,8,'__________________________________________________________________________________________________________________________________________');

$pdf->leyendas(12,197,'Arial','B',7,100,8,$keyRefEmpl[0]['empleos_desempeniados_nombre_empresa']);
$pdf->leyendas(59,197,'Arial','B',7,100,8,$keyRefEmpl[0]['empleos_desempeniados_cargo']);
$pdf->leyendas(97,197,'Arial','B',7,100,8,$keyRefEmpl[0]['empleos_desempeniados_desde_mes']);
$pdf->leyendas(105,197,'Arial','B',7,100,8,$keyRefEmpl[0]['empleos_desempeniados_desde_anio']);
$pdf->leyendas(116,197,'Arial','B',7,100,8,$keyRefEmpl[0]['empleos_desempeniados_hasta_mes']);
$pdf->leyendas(123,197,'Arial','B',7,100,8,$keyRefEmpl[0]['empleos_desempeniados_hasta_anio']);
$pdf->leyendas(133,197,'Arial','B',7,100,8,$keyRefEmpl[0]['empleos_desempeniados_sueldo_inicial']);
$pdf->leyendas(145,197,'Arial','B',7,100,8,$keyRefEmpl[0]['empleos_desempeniados_sueldo_final']);
$pdf->leyendas(157,197,'Arial','B',5,100,8,$keyRefEmpl[0]['empleos_desempeniados_motivo_cambio']);
$pdf->leyendas(11,199,'Arial','',7,195,8,'__________________________________________________________________________________________________________________________________________');
$pdf->leyendas(12,206,'Arial','B',7,100,8,$keyRefEmpl[1]['empleos_desempeniados_nombre_empresa']);
$pdf->leyendas(59,206,'Arial','B',7,100,8,$keyRefEmpl[1]['empleos_desempeniados_cargo']);
$pdf->leyendas(97,206,'Arial','B',7,100,8,$keyRefEmpl[1]['empleos_desempeniados_desde_mes']);
$pdf->leyendas(105,206,'Arial','B',7,100,8,$keyRefEmpl[1]['empleos_desempeniados_desde_anio']);
$pdf->leyendas(116,206,'Arial','B',7,100,8,$keyRefEmpl[1]['empleos_desempeniados_hasta_mes']);
$pdf->leyendas(123,206,'Arial','B',7,100,8,$keyRefEmpl[1]['empleos_desempeniados_hasta_anio']);
$pdf->leyendas(133,206,'Arial','B',7,100,8,$keyRefEmpl[1]['empleos_desempeniados_sueldo_inicial']);
$pdf->leyendas(145,206,'Arial','B',7,100,8,$keyRefEmpl[1]['empleos_desempeniados_sueldo_final']);
$pdf->leyendas(157,206,'Arial','B',5,100,8,$keyRefEmpl[1]['empleos_desempeniados_motivo_cambio']);
$pdf->leyendas(11,208,'Arial','',7,195,8,'__________________________________________________________________________________________________________________________________________');
$pdf->leyendas(12,213,'Arial','B',7,100,8,$keyRefEmpl[2]['empleos_desempeniados_nombre_empresa']);
$pdf->leyendas(59,213,'Arial','B',7,100,8,$keyRefEmpl[2]['empleos_desempeniados_cargo']);
$pdf->leyendas(97,213,'Arial','B',7,100,8,$keyRefEmpl[2]['empleos_desempeniados_desde_mes']);
$pdf->leyendas(105,213,'Arial','B',7,100,8,$keyRefEmpl[2]['empleos_desempeniados_desde_anio']);
$pdf->leyendas(116,213,'Arial','B',7,100,8,$keyRefEmpl[2]['empleos_desempeniados_hasta_mes']);
$pdf->leyendas(123,213,'Arial','B',7,100,8,$keyRefEmpl[2]['empleos_desempeniados_hasta_anio']);
$pdf->leyendas(133,213,'Arial','B',7,100,8,$keyRefEmpl[2]['empleos_desempeniados_sueldo_inicial']);
$pdf->leyendas(145,213,'Arial','B',7,100,8,$keyRefEmpl[2]['empleos_desempeniados_sueldo_final']);
$pdf->leyendas(157,213,'Arial','B',5,100,8,$keyRefEmpl[2]['empleos_desempeniados_motivo_cambio']);
$pdf->leyendas(11,214,'Arial','',7,195,8,'__________________________________________________________________________________________________________________________________________');


$pdf->multicelda(58,184,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(58,186,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(58,188,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(58,190,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(58,192,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(58,194,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(58,196,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(58,198,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(58,200,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(58,202,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(58,204,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(58,206,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(58,208,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(58,210,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(58,212,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(58,214,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(58,215,190,6,'Arial','',6,100,8,"|");



$pdf->multicelda(93,184,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(93,186,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(93,188,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(93,190,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(93,192,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(93,194,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(93,196,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(93,198,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(93,200,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(93,202,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(93,204,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(93,206,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(93,208,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(93,210,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(93,212,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(93,214,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(93,215,190,6,'Arial','',6,100,8,"|");





$pdf->multicelda(102,190,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(102,192,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(102,194,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(102,196,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(102,198,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(102,200,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(102,202,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(102,204,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(102,206,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(102,208,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(102,210,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(102,212,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(102,214,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(102,215,190,6,'Arial','',6,100,8,"|");



$pdf->multicelda(112,184,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(112,186,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(112,188,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(112,190,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(112,192,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(112,194,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(112,196,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(112,198,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(112,200,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(112,202,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(112,204,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(112,206,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(112,208,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(112,210,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(112,212,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(112,214,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(112,215,190,6,'Arial','',6,100,8,"|");



$pdf->multicelda(121,190,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(121,192,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(121,194,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(121,196,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(121,198,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(121,200,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(121,202,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(121,204,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(121,206,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(121,208,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(121,210,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(121,212,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(121,214,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(121,215,190,6,'Arial','',6,100,8,"|");


$pdf->multicelda(130,184,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(130,186,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(130,188,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(130,190,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(130,192,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(130,194,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(130,196,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(130,198,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(130,200,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(130,202,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(130,204,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(130,206,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(130,208,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(130,210,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(130,212,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(130,214,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(130,215,190,6,'Arial','',6,100,8,"|");

$pdf->multicelda(143,190,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(143,192,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(143,194,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(143,196,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(143,198,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(143,200,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(143,202,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(143,204,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(143,206,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(143,208,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(143,210,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(143,212,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(143,214,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(143,215,190,6,'Arial','',6,100,8,"|");


$pdf->multicelda(156,184,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(156,186,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(156,188,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(156,190,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(156,192,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(156,194,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(156,196,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(156,198,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(156,200,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(156,202,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(156,204,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(156,206,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(156,208,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(156,210,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(156,212,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(156,214,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(156,215,190,6,'Arial','',6,100,8,"|");




/*************************INGRESOS***********************************/
$datosPrestamo = $DAO->mostrarAll($conexion,"SELECT * FROM creditos WHERE cre_solic_id='$buscar'");
foreach($datosPrestamo as $filaPrestamo){}
/********************************C**********************************/

$pdf->leyendas(12,223,'Arial','',7,95,8,'C.- CARACTERISTICAS DEL PRESTAMO SOLICITADO');
$pdf->leyendas(12,228,'Arial','',7,95,8,'1 MONTO SOLICITADO  ____________________________________');
$pdf->leyendas(55,227,'Arial','B',7,95,8,"$ ".number_format($filaPrestamo['cre_monto'], 2, '.', ','));

$pdf->leyendas(90,228,'Arial','',7,95,8,'2 PLAZO SOLICITADO(AÑOS)  ______________');
$pdf->leyendas(132,227,'Arial','B',7,95,8,$filaPrestamo['cre_plazo_anio']);

$pdf->leyendas(145,228,'Arial','',7,95,8,'PLAZO SOLICITADO(DIAS)  ________________');
$pdf->leyendas(185,227,'Arial','B',7,95,8,$filaPrestamo['cre_plazo_dias']);

$pdf->leyendas(12,235,'Arial','',7,200,8,'4 DESTINO  ______________________________________________________________________________________________________________________________');

$pdf->leyendas(12,241,'Arial','',7,200,8,'________________________________________________________________________________________________________________________________________');
$pdf->multicelda(27,235,175,6,'Arial','B',5.8,230,8,utf8_decode($filaPrestamo['cre_destino_credito']),'J');

$pdf->leyendas(12,248,'Arial','',7,100,8,'5 FORMA DE PAGO  ___________________________');
$pdf->leyendas(37,247,'Arial','B',7,95,8,$filaPrestamo['cre_num_cuotas']." CUOTA(S) ".$filaPrestamo['cre_forma_pago']);

$pdf->leyendas(75,248,'Arial','',7,100,8,'CUOTA US$  _______________________');
$pdf->leyendas(100,247,'Arial','B',7,230,8,"$ ".$filaPrestamo['cre_cuota']);

$pdf->leyendas(124,248,'Arial','',7,100,8,'6 FORMA DE DESEMBOLSO ______________________________');
$pdf->leyendas(162,247,'Arial','B',7,95,8,$filaPrestamo['cre_forma_desembolso']);

$pdf->cuadrogrande(11,224,193,30,3,D);




/********************************C************************************/

/****************************************D*************************************/
$pdf->cuadrogrande(11,255,193,38,3,D);
$pdf->leyendas(12,254,'Arial','',7,95,8,'D.- CODIGOS');

$pdf->leyendas(12,260,'Arial','',7,120,8,'GEOGRAFICO ______________________________________________________');
$pdf->leyendas(34,259,'Arial','B',8,95,8,$filaPrestamo['codigo_geografico']);
$pdf->leyendas(110,260,'Arial','',7,120,8,'BENEFICIARIO _____________________________________________________');
$pdf->leyendas(138,259,'Arial','B',8,95,8,$filaPrestamo['cre_beneficiarios']);

$pdf->leyendas(12,266,'Arial','',7,120,8,'ACTIVIDAD PRODUCTIVA _____________________________________________');
$pdf->leyendas(44,265,'Arial','B',8,95,8,$filaPrestamo['cod_actividad_productiva']);
$pdf->leyendas(110,266,'Arial','',7,120,8,'CLASIFICACION ____________________________________________________');
$pdf->leyendas(138,265,'Arial','B',8,95,8,$filaPrestamo['cre_calificacion']);
$pdf->leyendas(12,272,'Arial','',7,200,8,'FUENTE DE FONDOS ______________________________________________________________________________________________________________________');
$pdf->leyendas(40,271,'Arial','B',6,95,8,$filaPrestamo['cre_fuente_fondos']);

$pdf->leyendas(12,278,'Arial','',7,200,8,'DESTINO _________________________________________________________________________________________________________________________________');
$pdf->leyendas(12,284,'Arial','',7,200,8,'_________________________________________________________________________________________________________________________________________');
$pdf->multicelda(25,278,175,6,'Arial','B',5.8,295,8,utf8_decode($filaPrestamo['cre_destino_credito']),'J');
/**********************************D********************************************/

$datosPromo = $DAO->mostrarAll($conexion,"SELECT cli_nombre,cli_apellido FROM usuarios WHERE usuario_nombre='$filaPrestamo[20]'");
foreach($datosPromo as $filaPromo){}

$pdf->leyendas(15,300,'Arial','',7,100,8,'PROMOTOR:     '.$filaPromo[0]." ".$filaPromo[1]);
$pdf->leyendas(31,301,'Arial','',7,180,8,'_____________________________________________________________________________________________________');

$pdf->AddPage();


$pdf->multicelda(80,15,190,6,'Arial','',7,100,8,'CAJA DE CREDITO DE SAN VICENTE');



/***********************************************E************************************************/
$datosUsu = $DAO->mostrarAll($conexion,"select * from ref_operacions_cajas_de_credito where cli_correlativo='$cli_correlativo'  order by ref_operaciones_correlativo desc limit 4 ");
//foreach ($datosUsu as $keyObli) {}

$pdf->cuadrogrande(11,28,193,54,3,D);
$pdf->leyendas(12,28,'Arial','',7,100,8,utf8_decode("E.- REFERENCIAS SOBRE OPERACIONES CON ESTA U OTRA CAJA DE CREDITO"));
$pdf->leyendas(11,29,'Arial','',7,200,8,'__________________________________________________________________________________________________________________________________________');


$pdf->multicelda(12,38,40,3,'Arial','',7,100,8,utf8_decode("PRESTAMO N°"));
$pdf->leyendas(42,36,'Arial','',7,100,8,"MONTO");
$pdf->leyendas(74,34,'Arial','',7,100,8,"FECHA DE ");
$pdf->leyendas(60,38,'Arial','',7,100,8,"CONSTITUCION");
$pdf->leyendas(81,38,'Arial','',7,100,8,"VENCIMIENTO");
$pdf->leyendas(103,35,'Arial','',7,100,8,"ESTADO");
$pdf->leyendas(121,36,'Arial','',7,100,8,"SALDO ACTUAL");
$pdf->multicelda(144,36,26,3,'Arial','',7,50,8,"INTERESES PAGADOS HASTA",'C');
$pdf->leyendas(175,36,'Arial','',7,100,8,"DESTINO");


$pdf->leyendas(11,38,'Arial','',7,200,8,'__________________________________________________________________________________________________________________________________________');
$pdf->leyendas(12,45,'Arial','B',7,100,8,$datosUsu[0][1]);
if($datosUsu[0][2]!=""){
$pdf->multicelda(36,47,23,1,'Arial','B',7,100,8,"$ ".number_format($datosUsu[0][2],2,'.',','),'R');

}
if($datosUsu[0][3]!='0000-00-00' && $datosUsu[0][3]!=''){
$daterefcaja = date_create($datosUsu[0][3]);
 $fechaCaja=date_format($daterefcaja,'d/m/Y');
$pdf->leyendas(62,44,'Arial','B',7,200,8,$fechaCaja);
}else{
	$pdf->leyendas(68,44,'Arial','B',7,200,8,"");
}

if($datosUsu[0][4]!='0000-00-00' && $datosUsu[0][4]!=''){
$daterefcaja1 = date_create($datosUsu[0][4]);
 $fechaCaja1=date_format($daterefcaja1,'d/m/Y');
$pdf->leyendas(84,44,'Arial','B',7,200,8,$fechaCaja1);
}else{
	$pdf->leyendas(89,44,'Arial','B',7,200,8,"");
}

if( $datosUsu[0][5]!='0'){

$pdf->leyendas(101,44,'Arial','B',7,200,8,$$datosUsu[0][5]);
}else{
$pdf->leyendas(100,44,'Arial','B',7,200,8,"");
}

if($datosUsu[0][6]!=""){
$pdf->multicelda(120,47,23,1,'Arial','B',7,200,8,"$ ".number_format($datosUsu[0][6],2,'.',','),'R');
}
if($datosUsu[0][7]!='0000-00-00' && $datosUsu[0][7]!=''){
$daterefcaja3 = date_create($datosUsu[0][7]);
 $fechaCaja3=date_format($daterefcaja3,'d/m/Y');
$pdf->leyendas(148,44,'Arial','B',7,200,8,$fechaCaja3);
}else{
$pdf->leyendas(149,44,'Arial','B',7,200,8,"");
}


$pdf->leyendas(171,44,'Arial','',6,100,8,$datosUsu[0][8]);

$pdf->leyendas(11,46,'Arial','',7,200,8,'__________________________________________________________________________________________________________________________________________');

$pdf->leyendas(12,52,'Arial','B',7,100,8,$datosUsu[1][1]);
if($datosUsu[1][2]!=""){
$pdf->multicelda(36,54,23,1,'Arial','B',7,100,8,"$ ".number_format($datosUsu[1][2],2,'.',','),'R');

}
if($datosUsu[1][3]!='0000-00-00' && $datosUsu[1][3]!=''){
$daterefcaja = date_create($datosUsu[1][3] );
 $fechaCaja=date_format($daterefcaja,'d/m/Y');
$pdf->leyendas(62,52,'Arial','B',7,200,8,$fechaCaja);
}else{
	$pdf->leyendas(68,52,'Arial','B',7,200,8,"");
}

if($datosUsu[1][4]!='0000-00-00' && $datosUsu[1][4]!=''){
$daterefcaja1 = date_create($datosUsu[1][4]);
 $fechaCaja1=date_format($daterefcaja1,'d/m/Y');
$pdf->leyendas(84,52,'Arial','B',7,200,8,$fechaCaja1);
}else{
	$pdf->leyendas(89,52,'Arial','B',7,200,8,"");
}

if( $datosUsu[1][5]!=''){

$pdf->leyendas(101,52,'Arial','B',7,200,8,$datosUsu[1][5]);
}else{
$pdf->leyendas(100,52,'Arial','B',7,200,8,"");
}

if($datosUsu[1][6]!=""){
$pdf->multicelda(120,54,23,1,'Arial','B',7,200,8,"$ ".number_format($datosUsu[1][6],2,'.',','),'R');
}
if($datosUsu[1][7]!='0000-00-00' && $datosUsu[1][7]!=''){
$daterefcaja3 = date_create($datosUsu[1][7]);
 $fechaCaja3=date_format($daterefcaja3,'d/m/Y');
$pdf->leyendas(148,52,'Arial','B',7,200,8,$fechaCaja3);
}else{
$pdf->leyendas(149,52,'Arial','B',7,200,8,"");
}


$pdf->leyendas(171,52,'Arial','',6,100,8,$datosUsu[1][8]);
$pdf->leyendas(11,53,'Arial','',7,200,8,'__________________________________________________________________________________________________________________________________________');

$pdf->leyendas(12,59,'Arial','B',7,100,8,$datosUsu[2][1]);
if($datosUsu[2][2]!=""){
$pdf->multicelda(36,61,23,1,'Arial','B',7,100,8,"$ ".number_format($datosUsu[2][2],2,'.',','),'R');

}
if($datosUsu[2][3]!='0000-00-00' && $datosUsu[2][3]!=''){
$daterefcaja = date_create($datosUsu[2][3]);
 $fechaCaja=date_format($daterefcaja,'d/m/Y');
$pdf->leyendas(62,59,'Arial','B',7,200,8,$fechaCaja);
}else{
	$pdf->leyendas(68,59,'Arial','B',7,200,8,"");
}

if($datosUsu[2][4]!='0000-00-00' && $datosUsu[2][4]!=''){
$daterefcaja1 = date_create($datosUsu[2][4]);
 $fechaCaja1=date_format($daterefcaja1,'d/m/Y');
$pdf->leyendas(84,59,'Arial','B',7,200,8,$fechaCaja1);
}else{
	$pdf->leyendas(89,59,'Arial','B',7,200,8,"");
}

if($datosUsu[2][5]!=''){

$pdf->leyendas(101,59,'Arial','B',7,200,8,$$datosUsu[2][5]);
}else{
$pdf->leyendas(100,59,'Arial','B',7,200,8,"");
}
if($datosUsu[2][6]!=""){
$pdf->multicelda(120,61,23,1,'Arial','B',7,200,8,"$ ".number_format($datosUsu[2][6],2,'.',','),'R');
}
if($datosUsu[2][7]!='0000-00-00' && $datosUsu[2][7]!=''){
$daterefcaja3 = date_create($datosUsu[2][7]);
 $fechaCaja3=date_format($daterefcaja3,'d/m/Y');
$pdf->leyendas(148,59,'Arial','B',7,200,8,$fechaCaja3);
}else{
$pdf->leyendas(149,59,'Arial','B',7,200,8,"");
}


$pdf->leyendas(171,59,'Arial','',6,100,8,$datosUsu[2][8]);

$pdf->leyendas(11,60,'Arial','',7,200,8,'__________________________________________________________________________________________________________________________________________');

$pdf->leyendas(12,66,'Arial','B',7,100,8,$datosUsu[3][1]);
if($datosUsu[3][2]!=""){
$pdf->multicelda(36,68,23,1,'Arial','B',7,100,8,"$ ".number_format($datosUsu[3][2],2,'.',','),'R');

}
if($datosUsu[3][3]!='0000-00-00' && $datosUsu[3][3]!=''){
$daterefcaja = date_create($datosUsu[3][3]);
 $fechaCaja=date_format($daterefcaja,'d/m/Y');
$pdf->leyendas(62,66,'Arial','B',7,200,8,$fechaCaja);
}else{
	$pdf->leyendas(68,66,'Arial','B',7,200,8,"");
}

if($datosUsu[3][4]!='0000-00-00' && $datosUsu[3][4]!=''){
$daterefcaja1 = date_create($datosUsu[3][4]);
 $fechaCaja1=date_format($daterefcaja1,'d/m/Y');
$pdf->leyendas(84,66,'Arial','B',7,200,8,$fechaCaja1);
}else{
	$pdf->leyendas(89,66,'Arial','B',7,200,8,"");
}

if($datosUsu[3][5]!='0000-00-00' && $datosUsu[3][5]!=''){
$daterefcaja2 = date_create($datosUsu[3][5]);
 $fechaCaja2=date_format($daterefcaja2,'d/m/Y');
$pdf->leyendas(101,66,'Arial','B',7,200,8,$fechaCaja2);
}else{
$pdf->leyendas(105,66,'Arial','B',7,200,8,"");
}
if($datosUsu[3][6]!=""){
$pdf->multicelda(120,68,23,1,'Arial','B',7,200,8,"$ ".number_format($datosUsu[3][6],2,'.',','),'R');
}
if($datosUsu[3][7]!='0000-00-00' && $datosUsu[3][7]!=''){
$daterefcaja3 = date_create($datosUsu[3][7]);
 $fechaCaja3=date_format($daterefcaja3,'d/m/Y');
$pdf->leyendas(148,66,'Arial','B',7,200,8,$fechaCaja3);
}else{
$pdf->leyendas(149,66,'Arial','B',7,200,8,"");
}


$pdf->leyendas(171,66,'Arial','',6,100,8,$datosUsu[3][8]);

$pdf->leyendas(11,67,'Arial','',7,200,8,'__________________________________________________________________________________________________________________________________________');


$pdf->leyendas(119,31,'Arial','',6,100,8,"|");$pdf->leyendas(58,31,'Arial','',6,100,8,"|");
$pdf->leyendas(119,32,'Arial','',6,100,8,"|");$pdf->leyendas(58,32,'Arial','',6,100,8,"|");
$pdf->leyendas(119,33,'Arial','',6,100,8,"|");$pdf->leyendas(58,33,'Arial','',6,100,8,"|");
$pdf->leyendas(119,34,'Arial','',6,100,8,"|");$pdf->leyendas(58,34,'Arial','',6,100,8,"|");
$pdf->leyendas(119,35,'Arial','',6,100,8,"|");$pdf->leyendas(58,35,'Arial','',6,100,8,"|");
$pdf->leyendas(119,37,'Arial','',6,100,8,"|");$pdf->leyendas(58,37,'Arial','',6,100,8,"|");
$pdf->leyendas(119,39,'Arial','',6,100,8,"|");$pdf->leyendas(58,39,'Arial','',6,100,8,"|");
$pdf->leyendas(119,41,'Arial','',6,100,8,"|");$pdf->leyendas(58,41,'Arial','',6,100,8,"|");
$pdf->leyendas(119,43,'Arial','',6,100,8,"|");$pdf->leyendas(58,43,'Arial','',6,100,8,"|");
$pdf->leyendas(119,45,'Arial','',6,100,8,"|");$pdf->leyendas(58,45,'Arial','',6,100,8,"|");
$pdf->leyendas(119,47,'Arial','',6,100,8,"|");$pdf->leyendas(58,47,'Arial','',6,100,8,"|");
$pdf->leyendas(119,49,'Arial','',6,100,8,"|");$pdf->leyendas(58,49,'Arial','',6,100,8,"|");
$pdf->leyendas(119,51,'Arial','',6,100,8,"|");$pdf->leyendas(58,51,'Arial','',6,100,8,"|");
$pdf->leyendas(119,53,'Arial','',6,100,8,"|");$pdf->leyendas(58,53,'Arial','',6,100,8,"|");
$pdf->leyendas(119,55,'Arial','',6,100,8,"|");$pdf->leyendas(58,55,'Arial','',6,100,8,"|");
$pdf->leyendas(119,57,'Arial','',6,100,8,"|");$pdf->leyendas(58,57,'Arial','',6,100,8,"|");
$pdf->leyendas(119,59,'Arial','',6,100,8,"|");$pdf->leyendas(58,59,'Arial','',6,100,8,"|");
$pdf->leyendas(119,61,'Arial','',6,100,8,"|");$pdf->leyendas(58,61,'Arial','',6,100,8,"|");
$pdf->leyendas(119,63,'Arial','',6,100,8,"|");$pdf->leyendas(58,63,'Arial','',6,100,8,"|");
$pdf->leyendas(119,65,'Arial','',6,100,8,"|");$pdf->leyendas(58,65,'Arial','',6,100,8,"|");
$pdf->leyendas(119,67,'Arial','',6,100,8,"|");$pdf->leyendas(58,67,'Arial','',6,100,8,"|");
//$pdf->leyendas(119,68,'Arial','',6,100,8,"|");$pdf->leyendas(58,68,'Arial','',6,100,8,"|");

$pdf->leyendas(35,31,'Arial','',6,100,8,"|");$pdf->leyendas(142,31,'Arial','',6,100,8,"|");
$pdf->leyendas(35,32,'Arial','',6,100,8,"|");$pdf->leyendas(142,32,'Arial','',6,100,8,"|");
$pdf->leyendas(35,33,'Arial','',6,100,8,"|");$pdf->leyendas(142,33,'Arial','',6,100,8,"|");
$pdf->leyendas(35,34,'Arial','',6,100,8,"|");$pdf->leyendas(142,34,'Arial','',6,100,8,"|");
$pdf->leyendas(35,35,'Arial','',6,100,8,"|");$pdf->leyendas(142,35,'Arial','',6,100,8,"|");
$pdf->leyendas(35,37,'Arial','',6,100,8,"|");$pdf->leyendas(142,37,'Arial','',6,100,8,"|");
$pdf->leyendas(35,39,'Arial','',6,100,8,"|");$pdf->leyendas(142,39,'Arial','',6,100,8,"|");
$pdf->leyendas(35,41,'Arial','',6,100,8,"|");$pdf->leyendas(142,41,'Arial','',6,100,8,"|");
$pdf->leyendas(35,43,'Arial','',6,100,8,"|");$pdf->leyendas(142,43,'Arial','',6,100,8,"|");
$pdf->leyendas(35,45,'Arial','',6,100,8,"|");$pdf->leyendas(142,45,'Arial','',6,100,8,"|");
$pdf->leyendas(35,47,'Arial','',6,100,8,"|");$pdf->leyendas(142,47,'Arial','',6,100,8,"|");
$pdf->leyendas(35,49,'Arial','',6,100,8,"|");$pdf->leyendas(142,49,'Arial','',6,100,8,"|");
$pdf->leyendas(35,51,'Arial','',6,100,8,"|");$pdf->leyendas(142,51,'Arial','',6,100,8,"|");
$pdf->leyendas(35,53,'Arial','',6,100,8,"|");$pdf->leyendas(142,53,'Arial','',6,100,8,"|");
$pdf->leyendas(35,55,'Arial','',6,100,8,"|");$pdf->leyendas(142,55,'Arial','',6,100,8,"|");
$pdf->leyendas(35,57,'Arial','',6,100,8,"|");$pdf->leyendas(142,57,'Arial','',6,100,8,"|");
$pdf->leyendas(35,59,'Arial','',6,100,8,"|");$pdf->leyendas(142,59,'Arial','',6,100,8,"|");
$pdf->leyendas(35,61,'Arial','',6,100,8,"|");$pdf->leyendas(142,61,'Arial','',6,100,8,"|");
$pdf->leyendas(35,63,'Arial','',6,100,8,"|");$pdf->leyendas(142,63,'Arial','',6,100,8,"|");
$pdf->leyendas(35,65,'Arial','',6,100,8,"|");$pdf->leyendas(142,65,'Arial','',6,100,8,"|");
$pdf->leyendas(35,67,'Arial','',6,100,8,"|");$pdf->leyendas(142,67,'Arial','',6,100,8,"|");
//$pdf->leyendas(35,68,'Arial','',6,100,8,"|");$pdf->leyendas(142,68,'Arial','',6,100,8,"|");

$pdf->leyendas(170,31,'Arial','',6,100,8,"|");
$pdf->leyendas(170,32,'Arial','',6,100,8,"|");
$pdf->leyendas(170,33,'Arial','',6,100,8,"|");
$pdf->leyendas(170,34,'Arial','',6,100,8,"|");
$pdf->leyendas(170,35,'Arial','',6,100,8,"|");
$pdf->leyendas(170,37,'Arial','',6,100,8,"|");
$pdf->leyendas(170,39,'Arial','',6,100,8,"|");
$pdf->leyendas(170,41,'Arial','',6,100,8,"|");
$pdf->leyendas(170,43,'Arial','',6,100,8,"|");
$pdf->leyendas(170,45,'Arial','',6,100,8,"|");
$pdf->leyendas(170,47,'Arial','',6,100,8,"|");
$pdf->leyendas(170,49,'Arial','',6,100,8,"|");
$pdf->leyendas(170,51,'Arial','',6,100,8,"|");
$pdf->leyendas(170,53,'Arial','',6,100,8,"|");
$pdf->leyendas(170,55,'Arial','',6,100,8,"|");
$pdf->leyendas(170,57,'Arial','',6,100,8,"|");
$pdf->leyendas(170,59,'Arial','',6,100,8,"|");
$pdf->leyendas(170,61,'Arial','',6,100,8,"|");
$pdf->leyendas(170,63,'Arial','',6,100,8,"|");
$pdf->leyendas(170,65,'Arial','',6,100,8,"|");
$pdf->leyendas(170,67,'Arial','',6,100,8,"|");
//$pdf->leyendas(170,68,'Arial','',6,100,8,"|");

$pdf->leyendas(58,35,'Arial','',6,100,8,"___________________________________");


$pdf->leyendas(99,31,'Arial','',6,100,8,"|");
$pdf->leyendas(99,33,'Arial','',6,100,8,"|");
$pdf->leyendas(99,35,'Arial','',6,100,8,"|");
$pdf->leyendas(99,37,'Arial','',6,100,8,"|");$pdf->leyendas(80,37,'Arial','',6,100,8,"|");
$pdf->leyendas(99,39,'Arial','',6,100,8,"|");$pdf->leyendas(80,39,'Arial','',6,100,8,"|");
$pdf->leyendas(99,41,'Arial','',6,100,8,"|");$pdf->leyendas(80,41,'Arial','',6,100,8,"|");
$pdf->leyendas(99,43,'Arial','',6,100,8,"|");$pdf->leyendas(80,43,'Arial','',6,100,8,"|");
$pdf->leyendas(99,45,'Arial','',6,100,8,"|");$pdf->leyendas(80,45,'Arial','',6,100,8,"|");
$pdf->leyendas(99,47,'Arial','',6,100,8,"|");$pdf->leyendas(80,47,'Arial','',6,100,8,"|");
$pdf->leyendas(99,49,'Arial','',6,100,8,"|");$pdf->leyendas(80,49,'Arial','',6,100,8,"|");
$pdf->leyendas(99,51,'Arial','',6,100,8,"|");$pdf->leyendas(80,51,'Arial','',6,100,8,"|");
$pdf->leyendas(99,53,'Arial','',6,100,8,"|");$pdf->leyendas(80,53,'Arial','',6,100,8,"|");
$pdf->leyendas(99,55,'Arial','',6,100,8,"|");$pdf->leyendas(80,55,'Arial','',6,100,8,"|");
$pdf->leyendas(99,57,'Arial','',6,100,8,"|");$pdf->leyendas(80,57,'Arial','',6,100,8,"|");
$pdf->leyendas(99,59,'Arial','',6,100,8,"|");$pdf->leyendas(80,59,'Arial','',6,100,8,"|");
$pdf->leyendas(99,61,'Arial','',6,100,8,"|");$pdf->leyendas(80,61,'Arial','',6,100,8,"|");
$pdf->leyendas(99,63,'Arial','',6,100,8,"|");$pdf->leyendas(80,63,'Arial','',6,100,8,"|");
$pdf->leyendas(99,65,'Arial','',6,100,8,"|");$pdf->leyendas(80,65,'Arial','',6,100,8,"|");
$pdf->leyendas(99,67,'Arial','',6,100,8,"|");$pdf->leyendas(80,67,'Arial','',6,100,8,"|");
//$pdf->leyendas(99,68,'Arial','',6,100,8,"|");$pdf->leyendas(80,68,'Arial','',6,100,8,"|");


$pdf->leyendas(12,74,'Arial','',7,200,8,"OBSERVACIONES _________________________________________________________________________________________________________________________");
$pdf->leyendas(35,73,'Arial','',7,230,8,$filaPrestamo['cre_observaciones_ref_caja']);
/*********************************************E*************************************************/

/************************************F****************************************************/
  $datosBnk = $DAO->mostrarAll($conexion,"select * from ref_comerciales_bancarias where (cli_correlativo LIKE '$cli_correlativo') order by cli_correlativo_referencia desc LIMIT 2");

$pdf->cuadrogrande(11,83,193,26,3,D);
$pdf->leyendas(12,81,'Arial','',7,100,8,"F.- REFERENCIAS BANCARIAS O COMERCIALES DEL SOLICITANTE");
$pdf->leyendas(11,82,'Arial','',7,200,8,'__________________________________________________________________________________________________________________________________________');
$pdf->leyendas(12,87,'Arial','',8,200,8,'NOMBRE Y DIRECCION');
$pdf->leyendas(75,87,'Arial','',8,200,8,'TELEFONO');
$pdf->leyendas(102,87,'Arial','',8,200,8,'CLASE DE OPERACION');
$pdf->leyendas(145,87,'Arial','',8,200,8,'SALDO ACTUAL');
$pdf->multicelda(175,88,28,3,'Arial','',8,200,8,'FECHA DE CANCELACION');
$pdf->leyendas(11,89,'Arial','',7,200,8,'__________________________________________________________________________________________________________________________________________');
$pdf->leyendas(12,94,'Arial','B',8,200,8,$datosBnk[0][2]);
$pdf->leyendas(74,94,'Arial','B',8,200,8,$datosBnk[0][4]);
$pdf->leyendas(96,94,'Arial','B',8,200,8,$datosBnk[0][5]);
if($datosBnk[0][6]!=""){
$pdf->leyendas(140,94,'Arial','B',8,200,8,"$ ".number_format($datosBnk[0][6],2,'.',','));
}
if($datosBnk[0][7]!='0000-00-00' && $datosBnk[0][7]!=''){
	$date = date_create($datosBnk[0][7]);
	$fecBn=date_format($date,'d/m/Y');
}else{
	$fecBn="";
}
$pdf->leyendas(174,94,'Arial','B',8,200,8,$fecBn);
$pdf->leyendas(11,102,'Arial','',7,200,8,'__________________________________________________________________________________________________________________________________________');
$pdf->leyendas(12,100,'Arial','B',8,200,8,$datosBnk[1][2]);
$pdf->leyendas(74,100,'Arial','B',8,200,8,$datosBnk[1][4]);
$pdf->leyendas(96,100,'Arial','B',8,200,8,$datosBnk[1][5]);
if($datosBnk[1][6]!=""){
$pdf->leyendas(140,100,'Arial','B',8,200,8,"$ ".number_format($datosBnk[1][6],2,'.',','));
}
if($datosBnk[1][7]!='0000-00-00' && $datosBnk[1][7]!=''){
	$date1 = date_create($datosBnk[1][7]);
	$fec1=date_format($date1,'d/m/Y');
}
$pdf->leyendas(174,100,'Arial','B',8,200,8,$fec1);
$pdf->leyendas(11,95,'Arial','',7,200,8,'__________________________________________________________________________________________________________________________________________');
$pdf->multicelda(68,85,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(68,87,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(68,89,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(68,91,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(68,93,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(68,95,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(68,97,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(68,99,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(68,101,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(68,103,190,6,'Arial','',6,100,8,"|");




$pdf->multicelda(94,85,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(94,87,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(94,89,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(94,91,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(94,93,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(94,95,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(94,97,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(94,99,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(94,101,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(94,103,190,6,'Arial','',6,100,8,"|");



$pdf->multicelda(138,85,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(138,87,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(138,89,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(138,91,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(138,93,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(138,95,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(138,97,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(138,99,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(138,101,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(138,103,190,6,'Arial','',6,100,8,"|");


$pdf->multicelda(170,85,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(170,87,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(170,89,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(170,91,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(170,93,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(170,95,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(170,97,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(170,99,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(170,101,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(170,103,190,6,'Arial','',6,100,8,"|");



/********************************************F******************************************/

/**************************************************G*************************************/

  $datosPer = $DAO->mostrarAll($conexion,"select * from ref_personales_familiares where (cli_correlativo LIKE '$cli_correlativo') and ref_tipo_referencia_p_f='PERSONAL' order by ref_correlativo_referencia desc limit 2");


$pdf->cuadrogrande(11,110,193,24,3,D);
$pdf->leyendas(12,109,'Arial','',7,100,8,"G.- REFERENCIAS PERSONALES DEL SOLICITANTE");
$pdf->leyendas(11,110,'Arial','',7,200,8,'__________________________________________________________________________________________________________________________________________');

$pdf->leyendas(11,114,'Arial','',7,200,8,'NOMBRE');
$pdf->leyendas(95,114,'Arial','',7,200,8,'DIRECCION');
$pdf->leyendas(180,114,'Arial','',7,200,8,'TELEFONO');
$pdf->leyendas(11,115,'Arial','',7,200,8,'__________________________________________________________________________________________________________________________________________');
$pdf->leyendas(12,120,'Arial','B',8,200,8,$datosPer[0][3]);
$pdf->leyendas(82,120,'Arial','B',8,200,8,$datosPer[0][4]);
$pdf->leyendas(180,120,'Arial','B',8,200,8,$datosPer[0][5]);
$pdf->leyendas(11,122,'Arial','',7,200,8,'__________________________________________________________________________________________________________________________________________');
$pdf->leyendas(12,127,'Arial','B',8,200,8,$datosPer[1][3]);
$pdf->leyendas(82,127,'Arial','B',8,200,8,$datosPer[1][4]);
$pdf->leyendas(180,127,'Arial','B',8,200,8,$datosPer[1][5]);
$pdf->leyendas(11,128,'Arial','',7,200,8,'__________________________________________________________________________________________________________________________________________');

/**************************************G*******************************************/

/**************************************************H*************************************/
  $datosFam = $DAO->mostrarAll($conexion,"select * from ref_personales_familiares where (cli_correlativo LIKE '$cli_correlativo') and ref_tipo_referencia_p_f='FAMILIAR' order by ref_correlativo_referencia desc limit 3");

$pdf->cuadrogrande(11,136,193,26,3,D);
$pdf->leyendas(12,135,'Arial','',7,100,8,"H.- REFERENCIAS DE FAMILIARES QUE NO VIVAN CON USTED");
$pdf->leyendas(11,136,'Arial','',7,200,8,'__________________________________________________________________________________________________________________________________________');
$pdf->leyendas(11,140,'Arial','',7,200,8,'NOMBRE');
$pdf->leyendas(95,140,'Arial','',7,200,8,'DIRECCION');
$pdf->leyendas(180,140,'Arial','',7,200,8,'TELEFONO');
$pdf->leyendas(11,141,'Arial','',7,200,8,'__________________________________________________________________________________________________________________________________________');

$pdf->leyendas(12,146,'Arial','B',8,200,8,$datosFam[0][3]);
$pdf->leyendas(82,146,'Arial','B',8,200,8,$datosFam[0][4]);
$pdf->leyendas(180,146,'Arial','B',8,200,8,$datosFam[0][5]);
$pdf->leyendas(11,147,'Arial','',7,200,8,'__________________________________________________________________________________________________________________________________________');
$pdf->leyendas(12,153,'Arial','B',8,200,8,$datosFam[1][3]);
$pdf->leyendas(82,153,'Arial','B',8,200,8,$datosFam[1][4]);
$pdf->leyendas(180,153,'Arial','B',8,200,8,$datosFam[1][5]);
$pdf->leyendas(11,154,'Arial','',7,200,8,'__________________________________________________________________________________________________________________________________________');
$pdf->leyendas(12,133,'Arial','B',8,200,8,$datosFam[2][3]);
$pdf->leyendas(82,133,'Arial','B',8,200,8,$datosFam[2][4]);
$pdf->leyendas(180,133,'Arial','B',8,200,8,$datosFam[2][5]);

/**************************************H*******************************************/

/******************************I**************************************************/

  $datosGFam = $DAO->mostrarAll($conexion,"select * from ref_grupo_familiar where (cli_correlativo LIKE '$cli_correlativo')  order by gf_correlativo desc limit 5");

$pdf->cuadrogrande(11,164,193,49,3,D);
$pdf->leyendas(12,163,'Arial','',7,100,8,"I.- GRUPO FAMILIAR:  N° DE PERSONAS DEPENDIENTES DEL SOLICITANTE");
$pdf->leyendas(11,164,'Arial','',7,200,8,'__________________________________________________________________________________________________________________________________________');
$pdf->leyendas(12,168,'Arial','',7,200,8,'NOMBRE');
$pdf->leyendas(80,168,'Arial','',7,200,8,'SEXO');
$pdf->leyendas(92,168,'Arial','',7,200,8,'EDAD');
$pdf->leyendas(105,168,'Arial','',7,200,8,'PARENTESCO');
$pdf->leyendas(140,168,'Arial','',7,200,8,'OCUPACION');
$pdf->leyendas(172,168,'Arial','',7,200,8,'INGRESO MENSUAL');
$pdf->leyendas(11,169,'Arial','',7,200,8,'__________________________________________________________________________________________________________________________________________');
$pdf->leyendas(12,174,'Arial','B',8,200,8,$datosGFam[0][2]);
if($datosGFam[0][3]!="NO ESPECIFICADO"){
$pdf->leyendas(83,174,'Arial','B',8,200,8,$datosGFam[0][3][0]);
}else{
	$pdf->leyendas(83,174,'Arial','B',8,200,8,"-");
}
if($datosGFam[0][4]!="0"){
$pdf->leyendas(94,174,'Arial','B',8,200,8,$datosGFam[0][4]);
}else{
	$pdf->leyendas(94,174,'Arial','B',8,200,8,"-");
}
if($datosGFam[0][6]!="NO ESPECIFICADO"){
$pdf->leyendas(107,174,'Arial','B',7.2,200,8,$datosGFam[0][6]);
}else{
	$pdf->leyendas(110,174,'Arial','B',7.2,200,8,"-");
}
$pdf->leyendas(139,174,'Arial','B',8,200,8,$datosGFam[0][7]);
if($datosGFam[0][8]!=""){
$pdf->leyendas(176,174,'Arial','B',8,200,8,"$ ".number_format($datosGFam[0][8],2,'.',','));
}
$pdf->leyendas(11,176,'Arial','',7,200,8,'__________________________________________________________________________________________________________________________________________');
$pdf->leyendas(12,182,'Arial','B',8,200,8,$datosGFam[1][2]);
if($datosGFam[1][3]!="NO ESPECIFICADO"){
$pdf->leyendas(83,182,'Arial','B',8,200,8,$datosGFam[1][3][0]);
}else{
$pdf->leyendas(83,182,'Arial','B',8,200,8,"-");
}
if($datosGFam[1][4]!="0"){
$pdf->leyendas(94,182,'Arial','B',8,200,8,$datosGFam[1][4]);
}else{
	$pdf->leyendas(94,182,'Arial','B',8,200,8,"-");
}
if($datosGFam[1][6]!="NO ESPECIFICADO"){
$pdf->leyendas(107,182,'Arial','B',7.2,200,8,$datosGFam[1][6]);
}else{
	$pdf->leyendas(110,182,'Arial','B',7.2,200,8,"-");
}
$pdf->leyendas(139,182,'Arial','B',8,200,8,$datosGFam[1][7]);
if($datosGFam[1][8]!=""){
$pdf->leyendas(176,182,'Arial','B',8,200,8,"$ ".number_format($datosGFam[1][8],2,'.',','));
}
$pdf->leyendas(11,184,'Arial','',7,200,8,'__________________________________________________________________________________________________________________________________________');
$pdf->leyendas(12,190,'Arial','B',8,200,8,$datosGFam[2][2]);
if($datosGFam[2][3]!="NO ESPECIFICADO"){
$pdf->leyendas(83,190,'Arial','B',8,200,8,$datosGFam[2][3][0]);
}else{
	$pdf->leyendas(83,190,'Arial','B',8,200,8,"-");
}
if($datosGFam[2][4]!="0")
{
	$pdf->leyendas(94,190,'Arial','B',8,200,8,$datosGFam[2][4]);
}else{
$pdf->leyendas(94,190,'Arial','B',8,200,8,"-");
}
if($datosGFam[2][6]!="NO ESPECIFICADO"){
$pdf->leyendas(107,190,'Arial','B',7.2,200,8,$datosGFam[2][6]);
}else{
	$pdf->leyendas(110,190,'Arial','B',7.2,200,8,"-");
}
$pdf->leyendas(139,190,'Arial','B',8,200,8,$datosGFam[2][7]);
if($datosGFam[2][8]!=""){
$pdf->leyendas(176,190,'Arial','B',8,200,8,"$".number_format($datosGFam[2][8],2,'.',','));
}
$pdf->leyendas(11,192,'Arial','',7,200,8,'__________________________________________________________________________________________________________________________________________');

$pdf->leyendas(12,197,'Arial','B',8,200,8,$datosGFam[3][2]);
if($datosGFam[3][3]!="NO ESPECIFICADO"){
$pdf->leyendas(83,197,'Arial','B',8,200,8,$datosGFam[3][3][0]);
}else{
$pdf->leyendas(83,197,'Arial','B',8,200,8,"-");
}
if($datosGFam[3][4]!="0"){
$pdf->leyendas(94,197,'Arial','B',8,200,8,$datosGFam[3][4]);
}else{
	$pdf->leyendas(94,197,'Arial','B',8,200,8,"-");
}
if($datosGFam[3][6]!="NO ESPECIFICADO"){
$pdf->leyendas(107,197,'Arial','B',7.2,200,8,$datosGFam[3][6]);
}else{
$pdf->leyendas(110,197,'Arial','B',7.2,200,8,"-");
}
$pdf->leyendas(139,197,'Arial','B',8,200,8,$datosGFam[3][7]);
if($datosGFam[3][8]!=""){
$pdf->leyendas(176,197,'Arial','B',8,200,8,"$".number_format($datosGFam[3][8],2,'.',','));
}
$pdf->leyendas(11,199,'Arial','',7,200,8,'__________________________________________________________________________________________________________________________________________');
$pdf->leyendas(12,204,'Arial','B',8,200,8,$datosGFam[4][2]);
if($datosGFam[4][3]!="NO ESPECIFICADO"){
$pdf->leyendas(83,204,'Arial','B',8,200,8,$datosGFam[4][3][0]);
}else{
	$pdf->leyendas(83,204,'Arial','B',8,200,8,"-");
}
if($datosGFam[4][4]!="0"){
$pdf->leyendas(94,204,'Arial','B',8,200,8,$datosGFam[4][4]);
}else{
	$pdf->leyendas(94,204,'Arial','B',8,200,8,"-");
}
if($datosGFam[4][6]!="NO ESPECIFICADO"){
$pdf->leyendas(107,204,'Arial','B',7.2,200,8,$datosGFam[4][6]);
}else{
	$pdf->leyendas(110,204,'Arial','B',7.2,200,8,"-");
}
$pdf->leyendas(139,204,'Arial','B',8,200,8,$datosGFam[4][7]);
if($datosGFam[4][8]!=""){
$pdf->leyendas(176,204,'Arial','B',8,200,8,"$".number_format($datosGFam[4][8],2,'.',','));
}

$pdf->multicelda(78,167,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(78,169,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(78,171,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(78,173,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(78,175,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(78,176,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(78,178,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(78,180,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(78,182,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(78,184,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(78,186,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(78,188,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(78,190,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(78,192,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(78,194,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(78,196,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(78,198,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(78,200,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(78,202,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(78,204,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(78,206,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(78,208,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(78,209,190,6,'Arial','',6,100,8,"|");

$pdf->multicelda(90,167,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(90,169,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(90,171,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(90,173,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(90,175,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(90,176,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(90,178,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(90,180,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(90,182,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(90,184,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(90,186,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(90,188,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(90,190,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(90,192,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(90,194,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(90,196,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(90,198,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(90,200,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(90,202,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(90,204,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(90,206,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(90,208,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(90,209,190,6,'Arial','',6,100,8,"|");

$pdf->multicelda(102,167,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(102,169,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(102,171,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(102,173,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(102,175,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(102,176,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(102,178,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(102,180,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(102,182,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(102,184,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(102,186,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(102,188,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(102,190,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(102,192,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(102,194,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(102,196,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(102,198,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(102,200,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(102,202,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(102,204,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(102,206,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(102,208,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(102,209,190,6,'Arial','',6,100,8,"|");


$pdf->multicelda(127,167,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(127,169,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(127,171,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(127,173,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(127,175,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(127,176,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(127,178,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(127,180,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(127,182,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(127,184,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(127,186,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(127,188,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(127,190,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(127,192,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(127,194,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(127,196,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(127,198,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(127,200,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(127,202,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(127,204,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(127,206,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(127,208,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(127,209,190,6,'Arial','',6,100,8,"|");


$pdf->multicelda(170,167,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(170,169,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(170,171,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(170,173,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(170,175,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(170,176,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(170,178,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(170,180,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(170,182,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(170,184,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(170,186,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(170,188,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(170,190,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(170,192,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(170,194,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(170,196,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(170,198,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(170,200,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(170,202,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(170,204,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(170,206,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(170,208,190,6,'Arial','',6,100,8,"|");
$pdf->multicelda(170,209,190,6,'Arial','',6,100,8,"|");



/*******************************I*******************************************/
/*******************************J******************************************/

$conyuge = $DAO->mostrarAll($conexion,"select * from ref_conyuge where cli_correlativo='$cli_correlativo'");

$profesionUoficio = $DAO->mostrarAll($conexion,"select po_profesion from cat_profesiones_oficios where po_codigo_profesion='$conyuge[0][5]'");

$pdf->leyendas(12,216,'Arial','',7,100,8,"J.- DATOS DEL CONYUGE");
$pdf->leyendas(12,222,'Arial','',7,200,8,'1 ________________________________________________________________________________________________________');
$pdf->leyendas(25,227,'Arial','',7,100,8,"PRIMER APELLIDO");
$pdf->leyendas(70,227,'Arial','',7,100,8,"SEGUNDO APELLIDO");
$pdf->leyendas(120,227,'Arial','',7,100,8,"NOMBRES");
$pdf->leyendas(26,221,'Arial','B',8,100,8,$conyuge[0][1]);
$pdf->leyendas(71,221,'Arial','B',8,100,8,$conyuge[0][2]);
$pdf->leyendas(114,221,'Arial','B',8,100,8,$conyuge[0][3]);
$pdf->leyendas(160,222,'Arial','',7,200,8,'2 ___________________________');
$pdf->leyendas(166,227,'Arial','',7,100,8,"FECHA DE NACIMIENTO");
if($conyuge[0][4]!='0000-00-00'){
	$dateCony = date_create($conyuge[0][4]);
	$feccony=date_format($dateCony,'d/m/Y');
}else{
	$feccony="-";
}
$pdf->leyendas(172,221,'Arial','B',8,100,8,$feccony);

$pdf->leyendas(12,235,'Arial','',7,200,8,'3 ______________________________________________________');
$pdf->leyendas(35,239,'Arial','',7,200,8,'PROFESION U OFICIO');
$pdf->leyendas(32,234,'Arial','B',8,100,8,utf8_decode($profesionUoficio[0][0]));
$pdf->leyendas(90,235,'Arial','',7,200,8,'4 _______________________________________________');
$pdf->leyendas(115,239,'Arial','',7,200,8,'DUI N°');
if($conyuge[0][6]!=""){
$pdf->leyendas(112,234,'Arial','B',8,100,8,$conyuge[0][6]);
}else{
	$pdf->leyendas(115,175,'Arial','B',8,100,8,"-");
}
if($conyuge[0][7]!='0000-00-00'){
	$dateexten = date_create($conyuge[0][7]);
	$fecExten=date_format($dateexten,'d/m/Y');
}else{
	$fecExten="-";
}
$pdf->leyendas(160,235,'Arial','',7,200,8,'5 ___________________________');
$pdf->leyendas(167,239,'Arial','',7,200,8,'FECHA DE EXTENSION');

$pdf->leyendas(174,234,'Arial','B',8,100,8,$fecExten);
$pdf->leyendas(12,246,'Arial','',7,200,8,'6 N° NIT ____________________________________________________________');
if($conyuge[0][8]!=""){
$pdf->leyendas(45,245,'Arial','B',8,100,8,$conyuge[0][8]);
}else{
	$pdf->leyendas(48,245,'Arial','B',8,100,8,"-");
}
$pdf->leyendas(107,246,'Arial','',7,200,8,'7 N° ISSS ___________________________________________________________');
if($conyuge[0][9]!=""){
$pdf->leyendas(115,245,'Arial','B',8,100,8,$conyuge[0][9]);
}else{
	$pdf->leyendas(130,245,'Arial','B',8,100,8,"-");
}
$pdf->leyendas(12,255,'Arial','',7,200,8,'8 N° N.I.P. ___________________________________');
if($conyuge[0][10]!=""){
$pdf->leyendas(27,254,'Arial','B',8,100,8,$conyuge[0][10]);
}else{
	$pdf->leyendas(35,254,'Arial','B',8,100,8,"-");
}
$pdf->leyendas(74,255,'Arial','',7,200,8,'9 N° INEP ___________________________________');
if($conyuge[0][11]!=""){
$pdf->leyendas(95,254,'Arial','B',8,100,8,$conyuge[0][11]);
}else{
	$pdf->leyendas(100,254,'Arial','B',8,100,8,"-");
}
$pdf->leyendas(135,255,'Arial','',7,200,8,'10 N° MILITAR ___________________________________');
if($conyuge[0][12]!=""){
$pdf->leyendas(154,254,'Arial','B',8,100,8,$conyuge[0][12]);
}else{
	$pdf->leyendas(160,254,'Arial','B',8,100,8,"-");
}

$pdf->leyendas(12,264,'Arial','',7,200,8,'11 ________________________________________________________________');
$pdf->leyendas(45,269,'Arial','',7,200,8,'LUGAR DE TRABAJO');
if($conyuge[0][13]!=""){
$pdf->leyendas(40,263,'Arial','B',8,100,8,$conyuge[0][13]);
}else{
	$pdf->leyendas(53,263,'Arial','B',8,100,8,"-");
}
$pdf->leyendas(106,264,'Arial','',7,200,8,'12 __________________________________________________________________');
$pdf->leyendas(135,269,'Arial','',7,200,8,'DIRECCION LUGAR DE TRABAJO');
if($conyuge[0][14]!=""){
$pdf->leyendas(112,263,'Arial','B',8,100,8,$conyuge[0][14]);
}else{
	$pdf->leyendas(120,263,'Arial','B',8,100,8,"-");
}
$pdf->leyendas(12,278,'Arial','',7,200,8,'13 __________________________');
$pdf->leyendas(25,283,'Arial','',7,200,8,'TELEFONO');

if($conyuge[0][15]!=""){
$pdf->leyendas(24,277,'Arial','B',8,100,8,$conyuge[0][15]);
}else{
	$pdf->leyendas(36,193,'Arial','B',8,100,8,"-");
}
$pdf->leyendas(54,278,'Arial','',7,200,8,'14 _______________________________________________________________');
$pdf->leyendas(82,283,'Arial','',7,200,8,'PUESTO QUE DESEMPEÑA');
if($conyuge[0][16]!=""){
$pdf->leyendas(90,277,'Arial','B',8,100,8,$conyuge[0][16]);
}else{
	$pdf->leyendas(95,193,'Arial','B',8,100,8,"-");
}
$pdf->leyendas(146,278,'Arial','',7,200,8,'15 _____________________________________');
$pdf->leyendas(160,283,'Arial','',7,200,8,'TIEMPO DE DESEMPEÑARLO');
if($conyuge[0][17]!="0"){
$pdf->leyendas(172,277,'Arial','B',8,100,8,$conyuge[0][17]." AÑOS");
}else{
	$pdf->leyendas(178,193,'Arial','B',8,100,8,"-");
}
$pdf->cuadrogrande(11,216,193,80,3,D);
/*******************************J******************************************/





$pdf->leyendas(12,300,'Arial','',7,100,8,'PROMOTOR:     '.$filaPromo[0]." ".$filaPromo[1]);
$pdf->leyendas(28,301,'Arial','',7,190,8,'___________________________________________________________________________________________________________');

$pdf->AddPage();

$ingresosDurante = $DAO->mostrarAll($conexion,"select * from ingresos_anuales_durante_anio_amortizar where cre_solic_id='$buscar' and ia_comentario='DURANTEANIO'");
foreach ($ingresosDurante as $keyingresosDurante) {
	# code...
}
$pdf->cuadrogrande(11,10,193,290,3,D);
$pdf->leyendas(12,10,'Arial','',7,190,8,'K.- CAPACIDAD DE PAGO DEL SOLICITANTE DURANTE EL AÑO QUE EMPEZARAA A AMORTIZAR');

$pdf->leyendas(40,16,'Arial','B',7,190,8,'INGRESOS ANUALES');
$pdf->leyendas(135,16,'Arial','B',7,190,8,'EGRESOS ANUALES');

/* -----------------------------INGRESOS --------------------------------------- */
$pdf->leyendas(12,22,'Arial','',6,190,8,'Sueldo o Salario Mensual');
$pdf->leyendas(42,22,'Arial','',6,190,8,'_________________________');
if($keyingresosDurante['ia_sueldo_mensual']!="0.00" && $keyingresosDurante['ia_sueldo_mensual']!=""){
$pdf->multicelda(42,24,30,1,'Arial','B',6,190,8,"$ ".number_format($keyingresosDurante['ia_sueldo_mensual'],2,'.',','),'R');
}else{
	$pdf->multicelda(42,24,30,1,'Arial','B',6,190,8,"-",'R');
}
$pdf->leyendas(79,22,'Arial','',6,190,8,'_________________________');
if($keyingresosDurante['ia_sueldo_anual']!="0.00" && $keyingresosDurante['ia_sueldo_anual']!=""){
$pdf->multicelda(79,24,30,1,'Arial','B',6,190,8,"$ ".number_format($keyingresosDurante['ia_sueldo_anual'],2,'.',','),'R');
}else{
$pdf->multicelda(79,24,30,1,'Arial','B',6,190,8,"-",'R');
}
$pdf->leyendas(12,27,'Arial','',6,190,8,'Servicios Profesionales');
$pdf->leyendas(42,27,'Arial','',6,190,8,'_________________________');
if($keyingresosDurante['ia_serv_prof_mensual']!="0.00" && $keyingresosDurante['ia_serv_prof_mensual']!=""){
$pdf->multicelda(42,29,30,1,'Arial','B',6,190,8,"$ ".number_format($keyingresosDurante['ia_serv_prof_mensual'],2,'.',','),'R');
}else{
$pdf->multicelda(42,29,30,1,'Arial','B',6,190,8,"-",'R');
}
$pdf->leyendas(79,27,'Arial','',6,190,8,'_________________________'); 
if($keyingresosDurante['ia_serv_prof_anual']!="0.00" && $keyingresosDurante['ia_serv_prof_anual']!=""){
$pdf->multicelda(79,29,30,1,'Arial','B',6,190,8,"$ ".number_format($keyingresosDurante['ia_serv_prof_anual'],2,'.',','),'R');
}else{
$pdf->multicelda(79,29,30,1,'Arial','B',6,190,8,"-",'R');
}
$pdf->leyendas(12,32,'Arial','',6,190,8,'Comisiones');
$pdf->leyendas(79,32,'Arial','',6,190,8,'_________________________');
if($keyingresosDurante['ia_comisiones']!="0.00" && $keyingresosDurante['ia_comisiones']!=""){
$pdf->multicelda(79,34,30,1,'Arial','B',6,190,8,"$ ".number_format($keyingresosDurante['ia_comisiones'],2,'.',','),'R');
}else{
$pdf->multicelda(79,34,30,1,'Arial','B',6,190,8,"-",'R');
}
$pdf->leyendas(12,37,'Arial','',6,190,8,'Intereses');
$pdf->leyendas(79,37,'Arial','',6,190,8,'_________________________');
if($keyingresosDurante['ia_intereses']!="0.00" && $keyingresosDurante['ia_intereses']!=""){
$pdf->multicelda(79,39,30,1,'Arial','B',6,190,8,"$ ".number_format($keyingresosDurante['ia_intereses'],2,'.',','),'R');
}else{
$pdf->multicelda(79,39,30,1,'Arial','B',6,190,8,"-",'R');
}
$pdf->leyendas(12,42,'Arial','',6,190,8,'Arrendamiento de Propiedades');
$pdf->leyendas(44,42,'Arial','',6,190,8,'________________________');
if($keyingresosDurante['ia_arrendamiento_mensual']!="0.00" && $keyingresosDurante['ia_arrendamiento_mensual']!=""){
$pdf->multicelda(42,44,30,1,'Arial','B',6,190,8,"$ ".number_format($keyingresosDurante['ia_arrendamiento_mensual'],2,'.',','),'R');
}else{
$pdf->multicelda(42,44,30,1,'Arial','B',6,190,8,"-",'R');
}
$pdf->leyendas(79,42,'Arial','',6,190,8,'_________________________');
if($keyingresosDurante['ia_arrendamiento_anual']!="0.00" && $keyingresosDurante['ia_arrendamiento_anual']!=""){
$pdf->multicelda(79,44,30,1,'Arial','B',6,190,8,"$ ".number_format($keyingresosDurante['ia_arrendamiento_anual'],2,'.',','),'R');
}else{
$pdf->multicelda(79,44,30,1,'Arial','B',6,190,8,"-",'R');
}
$pdf->leyendas(12,47,'Arial','',6,190,8,'Venta de Productos Agricolas');
$pdf->leyendas(44,47,'Arial','',6,190,8,'________________________');
if($keyingresosDurante['ia_venta_productos_agricolas_mensual']!="0.00" && $keyingresosDurante['ia_venta_productos_agricolas_mensual']!=""){
$pdf->multicelda(42,49,30,1,'Arial','B',6,190,8,"$ ".number_format($keyingresosDurante['ia_venta_productos_agricolas_mensual'],2,'.',','),'R');
}else{
	$pdf->multicelda(42,49,30,1,'Arial','B',6,190,8,"-",'R');
}
$pdf->leyendas(79,47,'Arial','',6,190,8,'_________________________');
if($keyingresosDurante['ia_venta_productos_agricolas_anual']!="0.00" && $keyingresosDurante['ia_venta_productos_agricolas_anual']!=""){
$pdf->multicelda(79,49,30,1,'Arial','B',6,190,8,"$ ".number_format($keyingresosDurante['ia_venta_productos_agricolas_anual'],2,'.',','),'R');
}else{
$pdf->multicelda(79,49,30,1,'Arial','B',6,190,8,"-",'R');
}

$pdf->leyendas(12,52,'Arial','',6,190,8,'Maiz');
$pdf->leyendas(20,52,'Arial','',6,190,8,'________________ qq');
if($keyingresosDurante['ia_maiz_qq']!="0.00" && $keyingresosDurante['ia_maiz_qq']!=""){
$pdf->multicelda(21,54,18,1,'Arial','B',6,190,8,number_format($keyingresosDurante['ia_maiz_qq'],2,'.',','),'R');
}else{
$pdf->multicelda(21,54,18,1,'Arial','B',6,190,8,'-','R');
}
$pdf->leyendas(44,52,'Arial','',6,190,8,'________________________ Msz.');
if($keyingresosDurante['ia_maiz_mzs']!="0.00" && $keyingresosDurante['ia_maiz_mzs']!=""){
$pdf->multicelda(44,54,28,1,'Arial','B',6,190,8,number_format($keyingresosDurante['ia_maiz_mzs'],2,'.',','),'R');
}else{
$pdf->multicelda(44,54,28,1,'Arial','B',6,190,8,'-','R');
}
$pdf->leyendas(79,52,'Arial','',6,190,8,'_________________________');
if($keyingresosDurante['ia_maiz_anual']!="0.00" && $keyingresosDurante['ia_maiz_anual']!=""){
$pdf->multicelda(79,54,30,1,'Arial','B',6,190,8,"$ ".number_format($keyingresosDurante['ia_maiz_anual'],2,'.',','),'R');
}else{
$pdf->multicelda(79,54,30,1,'Arial','B',6,190,8,"-",'R');
}
$pdf->leyendas(12,57,'Arial','',6,190,8,'Arroz');
$pdf->leyendas(20,57,'Arial','',6,190,8,'________________ qq');
if($keyingresosDurante['ia_arroz_qq']!="0.00" && $keyingresosDurante['ia_arroz_qq']!=""){
$pdf->multicelda(21,59,18,1,'Arial','B',6,190,8,number_format($keyingresosDurante['ia_arroz_qq'],2,'.',','),'R');
}else{
$pdf->multicelda(21,59,18,1,'Arial','B',6,190,8,'-','R');
}
$pdf->leyendas(44,57,'Arial','',6,190,8,'________________________ Msz.');
if($keyingresosDurante['ia_arroz_mzs']!="0.00" && $keyingresosDurante['ia_arroz_mzs']!=""){
$pdf->multicelda(44,59,28,1,'Arial','B',6,190,8,number_format($keyingresosDurante['ia_arroz_mzs'],2,'.',','),'R');
}else{
$pdf->multicelda(44,59,28,1,'Arial','B',6,190,8,'-','R');
}
$pdf->leyendas(79,57,'Arial','',6,190,8,'_________________________');
if($keyingresosDurante['ia_arroz_anual']!="0.00" && $keyingresosDurante['ia_arroz_anual']!=""){
$pdf->multicelda(79,59,30,1,'Arial','B',6,190,8,"$ ".number_format($keyingresosDurante['ia_arroz_anual'],2,'.',','),'R');
}else{
$pdf->multicelda(79,59,30,1,'Arial','B',6,190,8,"-",'R');
}
$pdf->leyendas(12,62,'Arial','',6,190,8,'Maicillo');
$pdf->leyendas(20,62,'Arial','',6,190,8,'________________ qq');
if($keyingresosDurante['ia_maicillo_qq']!="0.00" && $keyingresosDurante['ia_maicillo_qq']!=""){
$pdf->multicelda(21,64,18,1,'Arial','B',6,190,8,number_format($keyingresosDurante['ia_maicillo_qq'],2,'.',','),'R');
}else{
$pdf->multicelda(21,64,18,1,'Arial','B',6,190,8,'-','R');
}
$pdf->leyendas(44,62,'Arial','',6,190,8,'________________________ Msz.');
if($keyingresosDurante['ia_maicillo_mzs']!="0.00" && $keyingresosDurante['ia_maicillo_mzs']!=""){
$pdf->multicelda(44,64,28,1,'Arial','B',6,190,8,number_format($keyingresosDurante['ia_maicillo_mzs'],2,'.',','),'R');
}else{
$pdf->multicelda(44,64,28,1,'Arial','B',6,190,8,'-','R');
}
$pdf->leyendas(79,62,'Arial','',6,190,8,'_________________________');
if($keyingresosDurante['ia_maicillo_anual']!="0.00" && $keyingresosDurante['ia_maicillo_anual']!=""){
$pdf->multicelda(79,64,30,1,'Arial','B',6,190,8,"$ ".number_format($keyingresosDurante['ia_maicillo_anual'],2,'.',','),'R');
}else{
$pdf->multicelda(79,64,30,1,'Arial','B',6,190,8,"-",'R');
}
$pdf->leyendas(12,67,'Arial','',6,190,8,'Frijol');
$pdf->leyendas(20,67,'Arial','',6,190,8,'________________ qq');
if($keyingresosDurante['ia_frijol_qq']!="0.00" && $keyingresosDurante['ia_frijol_qq']!=""){
$pdf->multicelda(21,69,18,1,'Arial','B',6,190,8,number_format($keyingresosDurante['ia_frijol_qq'],2,'.',','),'R');
}else{
$pdf->multicelda(21,69,18,1,'Arial','B',6,190,8,'-','R');
}
$pdf->leyendas(44,67,'Arial','',6,190,8,'________________________ Msz.');
if($keyingresosDurante['ia_frijol_mzs']!="0.00" && $keyingresosDurante['ia_frijol_mzs']!=""){
$pdf->multicelda(44,69,28,1,'Arial','B',6,190,8,number_format($keyingresosDurante['ia_frijol_mzs'],2,'.',','),'R');
}else{
$pdf->multicelda(44,69,28,1,'Arial','B',6,190,8,'-','R');
}
$pdf->leyendas(79,67,'Arial','',6,190,8,'_________________________');
if($keyingresosDurante['ia_frijol_anual']!="0.00" && $keyingresosDurante['ia_frijol_anual']!=""){
$pdf->multicelda(79,69,30,1,'Arial','B',6,190,8,"$ ".number_format($keyingresosDurante['ia_frijol_anual'],2,'.',','),'R');
}else{
$pdf->multicelda(79,69,30,1,'Arial','B',6,190,8,"-",'R');
}
$pdf->leyendas(12,72,'Arial','',6,190,8,'Cafe');
$pdf->leyendas(20,72,'Arial','',6,190,8,'_______________ qq');
if($keyingresosDurante['ia_cafe_qq']!="0.00" && $keyingresosDurante['ia_cafe_qq']!=""){
$pdf->multicelda(21,74,18,1,'Arial','B',6,190,8,number_format($keyingresosDurante['ia_cafe_qq'],2,'.',','),'R');
}else{
$pdf->multicelda(21,74,18,1,'Arial','B',6,190,8,'-','R');
}
$pdf->leyendas(44,72,'Arial','',6,190,8,'________________________ Msz.');
if($keyingresosDurante['ia_cafe_mzs']!="0.00" && $keyingresosDurante['ia_cafe_mzs']!=""){
$pdf->multicelda(44,74,28,1,'Arial','B',6,190,8,number_format($keyingresosDurante['ia_cafe_mzs'],2,'.',','),'R');
}else{
$pdf->multicelda(44,74,28,1,'Arial','B',6,190,8,'-','R');
}
$pdf->leyendas(79,72,'Arial','',6,190,8,'_________________________');
if($keyingresosDurante['ia_cafe_anual']!="0.00" && $keyingresosDurante['ia_cafe_anual']!=""){
$pdf->multicelda(79,74,30,1,'Arial','B',6,190,8,"$ ".number_format($keyingresosDurante['ia_cafe_anual'],2,'.',','),'R');
}else{
$pdf->multicelda(79,74,30,1,'Arial','B',6,190,8,"-",'R');
}
$pdf->leyendas(12,77,'Arial','',6,190,8,'Caña');
$pdf->leyendas(20,77,'Arial','',6,190,8,'________________Ton');
if($keyingresosDurante['ia_cania_qq']!="0.00" && $keyingresosDurante['ia_cania_qq']!=""){
$pdf->multicelda(21,79,18,1,'Arial','B',6,190,8,number_format($keyingresosDurante['ia_cania_qq'],2,'.',','),'R');
}else{
	$pdf->multicelda(21,79,18,1,'Arial','B',6,190,8,'-','R');
}
$pdf->leyendas(44,77,'Arial','',6,190,8,'________________________ Msz.');
if($keyingresosDurante['ia_cania_mzs']!="0.00" && $keyingresosDurante['ia_cania_mzs']!=""){
$pdf->multicelda(44,79,28,1,'Arial','B',6,190,8,number_format($keyingresosDurante['ia_cania_mzs'],2,'.',','),'R');
}else{
$pdf->multicelda(44,79,28,1,'Arial','B',6,190,8,'-','R');
}
$pdf->leyendas(79,77,'Arial','',6,190,8,'_________________________');
if($keyingresosDurante['ia_cania_anual']!="0.00" && $keyingresosDurante['ia_cania_anual']!=""){
$pdf->multicelda(79,79,30,1,'Arial','B',6,190,8,"$ ".number_format($keyingresosDurante['ia_cania_anual'],2,'.',','),'R');
}else{
$pdf->multicelda(79,79,30,1,'Arial','B',6,190,8,"-",'R');
}

$pdf->leyendas(20,82,'Arial','',6,190,8,'_________________');
$pdf->leyendas(21,81,'Arial','B',6,190,8,$keyingresosDurante['ia_otros_nombre']);
$pdf->leyendas(44,82,'Arial','',6,190,8,'________________________ Msz.');
if($keyingresosDurante['ia_otros_mzs']!="0.00" && $keyingresosDurante['ia_otros_mzs']!=""){
$pdf->multicelda(44,84,28,1,'Arial','B',6,190,8,number_format($keyingresosDurante['ia_otros_mzs'],2,'.',','),'R');
}else{
$pdf->multicelda(44,84,28,1,'Arial','B',6,190,8,'-','R');
}
$pdf->leyendas(79,82,'Arial','',6,190,8,'_________________________');
if($keyingresosDurante['ia_otros_anual']!="0.00" && $keyingresosDurante['ia_otros_anual']!=""){
$pdf->multicelda(79,84,30,1,'Arial','B',6,190,8,"$ ".number_format($keyingresosDurante['ia_otros_anual'],2,'.',','),'R');
}else{
$pdf->multicelda(79,84,30,1,'Arial','B',6,190,8,"-",'R');
}
$pdf->leyendas(20,87,'Arial','',6,190,8,'_________________');
$pdf->leyendas(21,86,'Arial','B',6,190,8,$keyingresosDurante['ia_otros_nombre2']);
$pdf->leyendas(44,87,'Arial','',6,190,8,'________________________ Msz.');
if($keyingresosDurante['ia_otros_mzs2']!="0.00" && $keyingresosDurante['ia_otros_mzs2']!=""){
$pdf->multicelda(44,89,28,1,'Arial','B',6,190,8,number_format($keyingresosDurante['ia_otros_mzs2'],2,'.',','),'R');
}else{
$pdf->multicelda(44,89,28,1,'Arial','B',6,190,8,'-','R');
}
$pdf->leyendas(79,87,'Arial','',6,190,8,'_________________________');
if($keyingresosDurante['ia_otros_anual2']!="0.00" && $keyingresosDurante['ia_otros_anual2']!=""){
$pdf->multicelda(79,89,30,1,'Arial','B',6,190,8,"$ ".number_format($keyingresosDurante['ia_otros_anual2'],2,'.',','),'R');
}else{
$pdf->multicelda(79,89,30,1,'Arial','B',6,190,8,"-",'R');
}
$pdf->leyendas(12,92,'Arial','',6,190,8,'Venta de Productos Pecuarios');
$pdf->leyendas(79,92,'Arial','',6,190,8,'_________________________');


$pdf->leyendas(12,97,'Arial','',6,190,8,'Leche');
$pdf->leyendas(23,97,'Arial','',6,190,8,'__________________________________________ Bot.');
if($keyingresosDurante['ia_prod_pecuario_leche_bot']!="0.00" && $keyingresosDurante['ia_prod_pecuario_leche_bot']!=""){
$pdf->multicelda(44,99,28,1,'Arial','B',6,190,8,number_format($keyingresosDurante['ia_prod_pecuario_leche_bot'],2,'.',','),'R');
}else{
$pdf->multicelda(44,99,28,1,'Arial','B',6,190,8,'-','R');
}
$pdf->leyendas(79,97,'Arial','',6,190,8,'_________________________');
if($keyingresosDurante['ia_prod_pecuario_leche_anual']!="0.00" && $keyingresosDurante['ia_prod_pecuario_leche_anual']!=""){
$pdf->multicelda(79,99,30,1,'Arial','B',6,190,8,"$ ".number_format($keyingresosDurante['ia_prod_pecuario_leche_anual'],2,'.',','),'R');
}else{
$pdf->multicelda(79,99,30,1,'Arial','B',6,190,8,"-",'R');
}

$pdf->leyendas(12,102,'Arial','',6,190,8,'Ganado');
$pdf->leyendas(23,102,'Arial','',6,190,8,'__________________________________________ Cab.');
if($keyingresosDurante['ia_prod_pecuario_ganado_cab']!="0.00" && $keyingresosDurante['ia_prod_pecuario_ganado_cab']!=""){
$pdf->multicelda(44,104,28,1,'Arial','B',6,190,8,number_format($keyingresosDurante['ia_prod_pecuario_ganado_cab'],2,'.',','),'R');
}else{
$pdf->multicelda(44,104,28,1,'Arial','B',6,190,8,'-','R');
}
$pdf->leyendas(79,102,'Arial','',6,190,8,'_________________________');
if($keyingresosDurante['ia_prod_pecuario_ganado_anual']!="0.00" && $keyingresosDurante['ia_prod_pecuario_ganado_anual']!=""){
$pdf->multicelda(79,104,30,1,'Arial','B',6,190,8,"$ ".number_format($keyingresosDurante['ia_prod_pecuario_ganado_anual'],2,'.',','),'R');
}else{
$pdf->multicelda(79,104,30,1,'Arial','B',6,190,8,"-",'R');
}

$pdf->leyendas(12,107,'Arial','',6,190,8,'Ingreso por Comercio');
$pdf->leyendas(38,107,'Arial','',6,190,8,'_________________________________');
$pdf->leyendas(39,106,'Arial','B',6,190,8,$keyingresosDurante['ia_ingreso_por_comercio_nombre']);
$pdf->leyendas(79,107,'Arial','',6,190,8,'_________________________');
if($keyingresosDurante['ia_ingreso_por_comercio_cantidad']!="0.00" && $keyingresosDurante['ia_ingreso_por_comercio_cantidad']!=""){
$pdf->multicelda(79,109,30,1,'Arial','B',6,190,8,"$ ".number_format($keyingresosDurante['ia_ingreso_por_comercio_cantidad'],2,'.',','),'R');
}else{
$pdf->multicelda(79,109,30,1,'Arial','B',6,190,8,"-",'R');
}

$pdf->leyendas(38,112,'Arial','',7,190,8,'____________________________');
$pdf->leyendas(39,111,'Arial','B',6,190,8,$keyingresosDurante['ia_ingreso_por_comercio_nombre2']);
$pdf->leyendas(79,112,'Arial','',7,190,8,'______________________');
if($keyingresosDurante['ia_ingreso_por_comercio_cantidad2']!="0.00" && $keyingresosDurante['ia_ingreso_por_comercio_cantidad2']!=""){
$pdf->multicelda(79,114,30,1,'Arial','B',6,190,8,"$ ".number_format($keyingresosDurante['ia_ingreso_por_comercio_cantidad2'],2,'.',','),'R');
}else{
$pdf->multicelda(79,114,30,1,'Arial','B',6,190,8,"-",'R');
}

$pdf->leyendas(12,117,'Arial','',6,190,8,'Ayuda Familiar');
$pdf->leyendas(12,122,'Arial','',6,190,8,'________________________');
$pdf->leyendas(13,121,'Arial','B',6,190,8,$keyingresosDurante['ia_ayuda_familiar_nombre']);
$pdf->leyendas(44,122,'Arial','',6,190,8,'___________________________');
if($keyingresosDurante['ia_ayuda_familiar_mensual']!="0.00" && $keyingresosDurante['ia_ayuda_familiar_mensual']!=""){
$pdf->multicelda(44,124,30,1,'Arial','B',6,190,8,"$ ".number_format($keyingresosDurante['ia_ayuda_familiar_mensual'],2,'.',','),'R');
}else{
$pdf->multicelda(44,124,30,1,'Arial','B',6,190,8,"-",'R');
}
$pdf->leyendas(79,122,'Arial','',6,190,8,'_________________________');
if($keyingresosDurante['ia_ayuda_familiar_anual']!="0.00" && $keyingresosDurante['ia_ayuda_familiar_anual']!=""){
$pdf->multicelda(79,124,30,1,'Arial','B',6,190,8,"$ ".number_format($keyingresosDurante['ia_ayuda_familiar_anual'],2,'.',','),'R');
}else{
$pdf->multicelda(79,124,30,1,'Arial','B',6,190,8,"-",'R');
}

$pdf->leyendas(12,127,'Arial','',6,190,8,'________________________');
$pdf->leyendas(13,126,'Arial','B',6,190,8,$keyingresosDurante['ia_ayuda_familiar_nombre2']);
$pdf->leyendas(44,127,'Arial','',6,190,8,'___________________________');
if($keyingresosDurante['ia_ayuda_familiar_mensual2']!="0.00" && $keyingresosDurante['ia_ayuda_familiar_mensual2']!=""){
$pdf->multicelda(44,129,30,1,'Arial','B',6,190,8,"$ ".number_format($keyingresosDurante['ia_ayuda_familiar_mensual2'],2,'.',','),'R');
}else{
$pdf->multicelda(44,129,30,1,'Arial','B',6,190,8,"-",'R');
}
$pdf->leyendas(79,127,'Arial','',6,190,8,'_________________________');
if($keyingresosDurante['ia_ayuda_familiar_anual2']!="0.00" && $keyingresosDurante['ia_ayuda_familiar_anual2']!=""){
$pdf->multicelda(79,129,30,1,'Arial','B',6,190,8,"$ ".number_format($keyingresosDurante['ia_ayuda_familiar_anual2'],2,'.',','),'R');
}else{
$pdf->multicelda(79,129,30,1,'Arial','B',6,190,8,"-",'R');
}

$pdf->leyendas(12,132,'Arial','',6,190,8,'Ingreso por Prestamo Solicitado');
$pdf->leyendas(79,132,'Arial','',6,190,8,'_________________________');
if($keyingresosDurante['ia_ingreso_por_prestamo_solicitado']!="0.00" && $keyingresosDurante['ia_ingreso_por_prestamo_solicitado']!=""){
$pdf->multicelda(79,134,30,1,'Arial','B',6,190,8,"$ ".number_format($keyingresosDurante['ia_ingreso_por_prestamo_solicitado'],2,'.',','),'R');
}else{
$pdf->multicelda(79,134,30,1,'Arial','B',6,190,8,"-",'R');
}

$pdf->leyendas(12,137,'Arial','',6,190,8,'Otros Ingresos');
$pdf->leyendas(32,137,'Arial','',6,190,8,'_____________________________________');
$pdf->leyendas(33,136,'Arial','B',6,190,8,$keyingresosDurante['ia_otros_ingresos_nombre']);
$pdf->leyendas(79,137,'Arial','',6,190,8,'_________________________');
if($keyingresosDurante['ia_otros_ingresos_cantidad']!="0.00" && $keyingresosDurante['ia_otros_ingresos_cantidad']!=""){
$pdf->multicelda(79,139,30,1,'Arial','B',6,190,8,"$ ".number_format($keyingresosDurante['ia_otros_ingresos_cantidad'],2,'.',','),'R');
}else{
$pdf->multicelda(79,139,30,1,'Arial','B',6,190,8,"-",'R');
}

$pdf->leyendas(12,142,'Arial','',6,190,8,'TOTAL MENSUAL');

$sum_men = ($keyingresosDurante['ia_sueldo_anual']+
$keyingresosDurante['ia_serv_prof_anual']+
$keyingresosDurante['ia_comisiones']+
$keyingresosDurante['ia_intereses']+
$keyingresosDurante['ia_arrendamiento_anual']+
$keyingresosDurante['ia_venta_productos_agricolas_anual']+
$keyingresosDurante['ia_maiz_anual']+
$keyingresosDurante['ia_arroz_anual']+
$keyingresosDurante['ia_maicillo_anual']+
$keyingresosDurante['ia_frijol_anual']+
$keyingresosDurante['ia_cafe_anual']+
$keyingresosDurante['ia_cania_anual']+
$keyingresosDurante['ia_otros_anual']+
$keyingresosDurante['ia_otros_anual2']+
$keyingresosDurante['ia_prod_pecuario_leche_anual']+
$keyingresosDurante['ia_prod_pecuario_ganado_anual']+
$keyingresosDurante['ia_ingreso_por_comercio_cantidad']+
$keyingresosDurante['ia_ingreso_por_comercio_cantidad2']+
$keyingresosDurante['ia_ayuda_familiar_anual']+
$keyingresosDurante['ia_ayuda_familiar_anual2'])/12 ;


if($sum_men!="0.00" || $sum_men!=""){
$pdf->multicelda(25,144,30,1,'Arial','B',6,190,8,"$ ".number_format($sum_men,2,'.',','),'R');
}else{
$pdf->multicelda(25,144,30,1,'Arial','B',6,190,8,"-",'R');
}
$pdf->leyendas(32,142,'Arial','',6,190,8,'_________________________');

$pdf->leyendas(65,142,'Arial','',6,190,8,'TOTAL');
$pdf->leyendas(79,142,'Arial','',6,190,8,'_________________________');
if($keyingresosDurante['ia_total']!="0.00" && $keyingresosDurante['ia_total']!=""){
$pdf->multicelda(79,144,30,1,'Arial','B',6,190,8,"$ ".number_format($keyingresosDurante['ia_total'],2,'.',','),'R');
}else{
$pdf->multicelda(79,144,30,1,'Arial','B',6,190,8,"-",'R');
}
/* -----------------------------INGRESOS --------------------------------------- */
/* ----------------------------EGRESOSS------------------------------------- */
$egresosDurante = $DAO->mostrarAll($conexion,"select * from ea_anuales_durante_anio_amortizar where cre_solic_id='$buscar' and ea_comentario='DURANTEANIO'");
foreach ($egresosDurante as $keyegresosDurante) {
	# code...
}

$pdf->leyendas(115,22,'Arial','',6,190,8,'Gastos del Hogar');
$pdf->leyendas(135,22,'Arial','',6,190,8,'________________________');
if($keyegresosDurante['ea_gastos_hogar_mensual']!="0.00" && $keyegresosDurante['ea_gastos_hogar_mensual']!=""){
$pdf->multicelda(134,24,30,1,'Arial','B',6,190,8,"$ ".number_format($keyegresosDurante['ea_gastos_hogar_mensual'],2,'.',','),'R');
}else{
$pdf->multicelda(134,24,30,1,'Arial','B',6,190,8,"-",'R');
}
$pdf->leyendas(169,22,'Arial','',6,190,8,'__________________________');
if($keyegresosDurante['ea_gastos_hogar_anual']!="0.00" && $keyegresosDurante['ea_gastos_hogar_anual']!=""){
$pdf->multicelda(170,24,30,1,'Arial','B',6,190,8,"$ ".number_format($keyegresosDurante['ea_gastos_hogar_anual'],2,'.',','),'R');
}else{
$pdf->multicelda(170,24,30,1,'Arial','B',6,190,8,"-",'R');
}

$pdf->leyendas(115,27,'Arial','',6,190,8,'Costo de Produccion Agricola');
$pdf->leyendas(169,27,'Arial','',6,190,8,'__________________________');
if($keyegresosDurante['ea_costo_prod_agricola']!="0.00" && $keyegresosDurante['ea_costo_prod_agricola']!=""){
$pdf->multicelda(170,29,30,1,'Arial','B',6,190,8,"$ ".number_format($keyegresosDurante['ea_costo_prod_agricola'],2,'.',','),'R');
}else{
$pdf->multicelda(170,29,30,1,'Arial','B',6,190,8,"-",'R');
}

$pdf->leyendas(115,32,'Arial','',6,190,8,'Maiz');
$pdf->leyendas(130,32,'Arial','',6,190,8,'____________________________ Msz.');
if($keyegresosDurante['ea_costos_maiz_mzs']!="0.00" && $keyegresosDurante['ea_costos_maiz_mzs']!=""){
$pdf->multicelda(134,34,30,1,'Arial','B',6,190,8,number_format($keyegresosDurante['ea_costos_maiz_mzs'],2,'.',','),'R');
}else{
$pdf->multicelda(134,34,30,1,'Arial','B',6,190,8,'-','R');
}
$pdf->leyendas(169,32,'Arial','',6,190,8,'__________________________');
if($keyegresosDurante['ea_costos_maiz_anual']!="0.00" && $keyegresosDurante['ea_costos_maiz_anual']!=""){
$pdf->multicelda(170,34,30,1,'Arial','B',6,190,8,"$ ".number_format($keyegresosDurante['ea_costos_maiz_anual'],2,'.',','),'R');
}else{
$pdf->multicelda(170,34,30,1,'Arial','B',6,190,8,"-",'R');
}

$pdf->leyendas(115,37,'Arial','',6,190,8,'Arroz');
$pdf->leyendas(130,37,'Arial','',6,190,8,'____________________________ Msz.');
if($keyegresosDurante['ea_costos_arroz_mzs']!="0.00" && $keyegresosDurante['ea_costos_arroz_mzs']!=""){
$pdf->multicelda(134,39,30,1,'Arial','B',6,190,8,number_format($keyegresosDurante['ea_costos_arroz_mzs'],2,'.',','),'R');
}else{
$pdf->multicelda(134,39,30,1,'Arial','B',6,190,8,'-','R');
}
$pdf->leyendas(169,37,'Arial','',6,190,8,'__________________________');
if($keyegresosDurante['ea_costos_arroz_anual']!="0.00" && $keyegresosDurante['ea_costos_arroz_anual']!=""){
$pdf->multicelda(170,39,30,1,'Arial','B',6,190,8,"$ ".number_format($keyegresosDurante['ea_costos_arroz_anual'],2,'.',','),'R');
}else{
$pdf->multicelda(170,39,30,1,'Arial','B',6,190,8,"-",'R');
}

$pdf->leyendas(115,42,'Arial','',6,190,8,'Maicillo');
$pdf->leyendas(130,42,'Arial','',6,190,8,'____________________________ Msz.');
if($keyegresosDurante['ea_costos_maicillo_mzs']!="0.00" && $keyegresosDurante['ea_costos_maicillo_mzs']!=""){
$pdf->multicelda(134,44,30,1,'Arial','B',6,190,8,number_format($keyegresosDurante['ea_costos_maicillo_mzs'],2,'.',','),'R');
}else{
$pdf->multicelda(134,44,30,1,'Arial','B',6,190,8,'-','R');
}
$pdf->leyendas(169,42,'Arial','',6,190,8,'__________________________');
if($keyegresosDurante['ea_costos_maicillo_anual']!="0.00" && $keyegresosDurante['ea_costos_maicillo_anual']!=""){
$pdf->multicelda(170,44,30,1,'Arial','B',6,190,8,"$ ".number_format($keyegresosDurante['ea_costos_maicillo_anual'],2,'.',','),'R');
}else{
$pdf->multicelda(170,44,30,1,'Arial','B',6,190,8,"-",'R');
}

$pdf->leyendas(115,47,'Arial','',6,190,8,'Frijol');
$pdf->leyendas(130,47,'Arial','',6,190,8,'____________________________ Msz.');
if($keyegresosDurante['ea_costos_frijol_mzs']!="0.00" && $keyegresosDurante['ea_costos_frijol_mzs']!=""){
$pdf->multicelda(134,49,30,1,'Arial','B',6,190,8,number_format($keyegresosDurante['ea_costos_frijol_mzs'],2,'.',','),'R');
}else{
$pdf->multicelda(134,49,30,1,'Arial','B',6,190,8,'-','R');
}
$pdf->leyendas(169,47,'Arial','',6,190,8,'__________________________');
if($keyegresosDurante['ea_costos_frijol_anual']!="0.00" && $keyegresosDurante['ea_costos_frijol_anual']!=""){
$pdf->multicelda(170,49,30,1,'Arial','B',6,190,8,"$ ".number_format($keyegresosDurante['ea_costos_frijol_anual'],2,'.',','),'R');
}else{
$pdf->multicelda(170,49,30,1,'Arial','B',6,190,8,"-",'R');
}

$pdf->leyendas(115,52,'Arial','',6,190,8,'Café');
$pdf->leyendas(130,52,'Arial','',6,190,8,'____________________________ Msz.');
if($keyegresosDurante['ea_costos_cafe_mzs']!="0.00" && $keyegresosDurante['ea_costos_cafe_mzs']!=""){
$pdf->multicelda(134,54,30,1,'Arial','B',6,190,8,number_format($keyegresosDurante['ea_costos_cafe_mzs'],2,'.',','),'R');
}else{
$pdf->multicelda(134,54,30,1,'Arial','B',6,190,8,'-','R');
}
$pdf->leyendas(169,52,'Arial','',6,190,8,'__________________________');
if($keyegresosDurante['ea_costos_cafe_anual']!="0.00" && $keyegresosDurante['ea_costos_cafe_anual']!=""){
$pdf->multicelda(170,54,30,1,'Arial','B',6,190,8,"$ ".number_format($keyegresosDurante['ea_costos_cafe_anual'],2,'.',','),'R');
}else{
$pdf->multicelda(170,54,30,1,'Arial','B',6,190,8,"-",'R');
}

$pdf->leyendas(115,57,'Arial','',6,190,8,'Caña');
$pdf->leyendas(130,57,'Arial','',6,190,8,'____________________________ Msz.');
if($keyegresosDurante['ea_costos_cania_mzs']!="0.00" && $keyegresosDurante['ea_costos_cania_mzs']!=""){
$pdf->multicelda(134,59,30,1,'Arial','B',6,190,8,number_format($keyegresosDurante['ea_costos_cania_mzs'],2,'.',','),'R');
}else{
$pdf->multicelda(134,59,30,1,'Arial','B',6,190,8,'-','R');
}
$pdf->leyendas(169,57,'Arial','',6,190,8,'__________________________');
if($keyegresosDurante['ea_costos_cania_anual']!="0.00" && $keyegresosDurante['ea_costos_cania_anual']!=""){
$pdf->multicelda(170,59,30,1,'Arial','B',6,190,8,"$ ".number_format($keyegresosDurante['ea_costos_cania_anual'],2,'.',','),'R');
}else{
$pdf->multicelda(170,59,30,1,'Arial','B',6,190,8,"-",'R');
}

$pdf->leyendas(115,62,'Arial','',6,190,8,'Algodón');
$pdf->leyendas(130,62,'Arial','',6,190,8,'____________________________ Msz.');
if($keyegresosDurante['ea_costos_algodon_mzs']!="0.00" && $keyegresosDurante['ea_costos_algodon_mzs']!=""){
$pdf->multicelda(134,64,30,1,'Arial','B',6,190,8,number_format($keyegresosDurante['ea_costos_algodon_mzs'],2,'.',','),'R');
}else{
$pdf->multicelda(134,64,30,1,'Arial','B',6,190,8,'-','R');
}
$pdf->leyendas(169,62,'Arial','',6,190,8,'__________________________');
if($keyegresosDurante['ea_costos_algodon_anual']!="0.00" && $keyegresosDurante['ea_costos_algodon_anual']!=""){
$pdf->multicelda(170,64,30,1,'Arial','B',6,190,8,"$ ".number_format($keyegresosDurante['ea_costos_algodon_anual'],2,'.',','),'R');
}else{
$pdf->multicelda(170,64,30,1,'Arial','B',6,190,8,"-",'R');
}


$pdf->leyendas(130,67,'Arial','',6,190,8,'____________________________');
$pdf->leyendas(131,66,'Arial','',6,190,8,$keyegresosDurante['ea_costos_otros_nombre']);
$pdf->leyendas(169,67,'Arial','',6,190,8,'__________________________');
if($keyegresosDurante['ea_costos_otros_anual']!="0.00" && $keyegresosDurante['ea_costos_otros_anual']!=""){
$pdf->multicelda(170,69,30,1,'Arial','B',6,190,8,"$ ".number_format($keyegresosDurante['ea_costos_otros_anual'],2,'.',','),'R');
}else{
$pdf->multicelda(170,69,30,1,'Arial','B',6,190,8,"-",'R');
}

$pdf->leyendas(130,72,'Arial','',6,190,8,'____________________________');
$pdf->leyendas(131,71,'Arial','',6,190,8,$keyegresosDurante['ea_costos_otros_nombre2']);
$pdf->leyendas(169,72,'Arial','',6,190,8,'__________________________');
if($keyegresosDurante['ea_costos_otros_anual2']!="0.00" && $keyegresosDurante['ea_costos_otros_anual2']!=""){
$pdf->multicelda(170,74,30,1,'Arial','B',6,190,8,"$ ".number_format($keyegresosDurante['ea_costos_otros_anual2'],2,'.',','),'R');
}else{
$pdf->multicelda(170,74,30,1,'Arial','B',6,190,8,"-",'R');
}

$pdf->leyendas(115,77,'Arial','',6,190,8,'Costo de Produccion Pecuaria');

$pdf->leyendas(115,82,'Arial','',6,190,8,'Costo de Prod.');
$pdf->leyendas(132,82,'Arial','',6,190,8,'__________________________ Bot.');
if($keyegresosDurante['ea_costos_prod_leche_bot']!="0.00" && $keyegresosDurante['ea_costos_prod_leche_bot']!=""){
$pdf->multicelda(134,84,30,1,'Arial','B',6,190,8,number_format($keyegresosDurante['ea_costos_prod_leche_bot'],2,'.',','),'R');
}else{
$pdf->multicelda(134,84,30,1,'Arial','B',6,190,8,'-','R');
}
$pdf->leyendas(169,82,'Arial','',6,190,8,'__________________________');
if($keyegresosDurante['ea_costos_prod_leche_anual']!="0.00" && $keyegresosDurante['ea_costos_prod_leche_anual']!=""){
$pdf->multicelda(170,84,30,1,'Arial','B',6,190,8,"$ ".number_format($keyegresosDurante['ea_costos_prod_leche_anual'],2,'.',','),'R');
}else{
$pdf->multicelda(170,84,30,1,'Arial','B',6,190,8,"-",'R');
}

$pdf->leyendas(115,87,'Arial','',6,190,8,'Costos Queso');
$pdf->leyendas(132,87,'Arial','',6,190,8,'__________________________ Arr.');
if($keyegresosDurante['ea_costos_prod_ganado_cab']!="0.00" && $keyegresosDurante['ea_costos_prod_ganado_cab']!=""){
$pdf->multicelda(134,89,30,1,'Arial','B',6,190,8,number_format($keyegresosDurante['ea_costos_prod_ganado_cab'],2,'.',','),'R');
}else{
$pdf->multicelda(134,89,30,1,'Arial','B',6,190,8,'-','R');
}
$pdf->leyendas(169,87,'Arial','',6,190,8,'__________________________');
if($keyegresosDurante['ea_costos_prod_ganado_anual']!="0.00" && $keyegresosDurante['ea_costos_prod_ganado_anual']!=""){
$pdf->multicelda(170,89,30,1,'Arial','B',6,190,8,"$ ".number_format($keyegresosDurante['ea_costos_prod_ganado_anual'],2,'.',','),'R');
}else{
$pdf->multicelda(170,89,30,1,'Arial','B',6,190,8,"-",'R');
}

$pdf->leyendas(115,92,'Arial','',6,190,8,'Costos Prod.');
$pdf->leyendas(132,92,'Arial','',6,190,8,'__________________________ Cab.');
if($keyegresosDurante['ea_costos_prod_ganado_cab']!="0.00" && $keyegresosDurante['ea_costos_prod_ganado_cab']!=""){
$pdf->multicelda(134,94,30,1,'Arial','B',6,190,8,number_format($keyegresosDurante['ea_costos_prod_ganado_cab'],2,'.',','),'R');
}else{
$pdf->multicelda(134,94,30,1,'Arial','B',6,190,8,'-','R');
}
$pdf->leyendas(169,92,'Arial','',6,190,8,'__________________________');
if($keyegresosDurante['ea_costos_prod_ganado_anual']!="0.00" && $keyegresosDurante['ea_costos_prod_ganado_anual']!=""){
$pdf->multicelda(170,94,30,1,'Arial','B',6,190,8,"$ ".number_format($keyegresosDurante['ea_costos_prod_ganado_anual'],2,'.',','),'R');
}else{
$pdf->multicelda(170,94,30,1,'Arial','B',6,190,8,"-",'R');
}

$pdf->leyendas(132,97,'Arial','',6,190,8,'__________________________');
$pdf->leyendas(133,96,'Arial','',6,190,8,$keyegresosDurante['ea_costos_otros_prod_pecuario_nombre']);
$pdf->leyendas(169,97,'Arial','',6,190,8,'__________________________');
if($keyegresosDurante['ea_costos_otros_prod_pecuario_anual']!="0.00" && $keyegresosDurante['ea_costos_otros_prod_pecuario_anual']!=""){
$pdf->multicelda(170,99,30,1,'Arial','B',6,190,8,"$ ".number_format($keyegresosDurante['ea_costos_otros_prod_pecuario_anual'],2,'.',','),'R');
}else{
$pdf->multicelda(170,99,30,1,'Arial','B',6,190,8,"-",'R');
}

$pdf->leyendas(115,102,'Arial','',6,190,8,'Gastos de Comercio');
$pdf->leyendas(169,102,'Arial','',6,190,8,'__________________________');
if($keyegresosDurante['ea_gastos_de_comercio']!="0.00" && $keyegresosDurante['ea_gastos_de_comercio']!=""){
$pdf->multicelda(170,104,30,1,'Arial','B',6,190,8,"$ ".number_format($keyegresosDurante['ea_gastos_de_comercio'],2,'.',','),'R');
}else{
$pdf->multicelda(170,104,30,1,'Arial','B',6,190,8,"-",'R');
}

$pdf->leyendas(115,107,'Arial','',6,190,8,'Pago Prest Hipot.');
$pdf->leyendas(135,107,'Arial','',6,190,8,'________________________ ');
if($keyegresosDurante['ea_pago_prest_hipo_mensual']!="0.00" && $keyegresosDurante['ea_pago_prest_hipo_mensual']!=""){
$pdf->multicelda(134,109,30,1,'Arial','B',6,190,8,"$ ".number_format($keyegresosDurante['ea_pago_prest_hipo_mensual'],2,'.',','),'R');
}else{
$pdf->multicelda(134,109,30,1,'Arial','B',6,190,8,"-",'R');
}
$pdf->leyendas(169,107,'Arial','',6,190,8,'__________________________');
if($keyegresosDurante['ea_pago_prest_hipo_anual']!="0.00" && $keyegresosDurante['ea_pago_prest_hipo_anual']!=""){
$pdf->multicelda(170,109,30,1,'Arial','B',6,190,8,"$ ".number_format($keyegresosDurante['ea_pago_prest_hipo_anual'],2,'.',','),'R');
}else{
$pdf->multicelda(170,109,30,1,'Arial','B',6,190,8,"-",'R');
}

$pdf->leyendas(115,112,'Arial','',6,190,8,'Pago Prest Pers.');
$pdf->leyendas(135,112,'Arial','',6,190,8,'________________________ ');
if($keyegresosDurante['ea_pago_prest_person_mensual']!="0.00" && $keyegresosDurante['ea_pago_prest_person_mensual']!=""){
$pdf->multicelda(134,114,30,1,'Arial','B',6,190,8,"$ ".number_format($keyegresosDurante['ea_pago_prest_person_mensual'],2,'.',','),'R');
}else{
$pdf->multicelda(134,114,30,1,'Arial','B',6,190,8,"-",'R');
}
$pdf->leyendas(169,112,'Arial','',6,190,8,'__________________________');
if($keyegresosDurante['ea_pago_prest_person_anual']!="0.00" && $keyegresosDurante['ea_pago_prest_person_anual']!=""){
$pdf->multicelda(170,114,30,1,'Arial','B',6,190,8,"$ ".number_format($keyegresosDurante['ea_pago_prest_person_anual'],2,'.',','),'R');
}else{
	$pdf->multicelda(170,114,30,1,'Arial','B',6,190,8,"-",'R');
}

$pdf->leyendas(115,117,'Arial','',6,190,8,'Otras Deudas');
$pdf->leyendas(135,117,'Arial','',6,190,8,'________________________ ');
if($keyegresosDurante['ea_otras_deudas_mensul']!="0.00" && $keyegresosDurante['ea_otras_deudas_mensul']!=""){
$pdf->multicelda(134,119,30,1,'Arial','B',6,190,8,"$ ".number_format($keyegresosDurante['ea_otras_deudas_mensul'],2,'.',','),'R');
}else{
$pdf->multicelda(134,119,30,1,'Arial','B',6,190,8,"-",'R');
}
$pdf->leyendas(169,117,'Arial','',6,190,8,'__________________________');
if($keyegresosDurante['ea_otras_deudas_anual']!="0.00" && $keyegresosDurante['ea_otras_deudas_anual']!=""){
$pdf->multicelda(170,119,30,1,'Arial','B',6,190,8,"$ ".number_format($keyegresosDurante['ea_otras_deudas_anual'],2,'.',','),'R');
}else{
$pdf->multicelda(170,119,30,1,'Arial','B',6,190,8,"-",'R');
}

$pdf->leyendas(115,122,'Arial','',6,190,8,'Desc. de Ley');
$pdf->leyendas(135,122,'Arial','',6,190,8,'________________________ ');
if($keyegresosDurante['ea_desc_de_ley_mensual']!="0.00" && $keyegresosDurante['ea_desc_de_ley_mensual']!=""){
$pdf->multicelda(134,124,30,1,'Arial','B',6,190,8,"$ ".number_format($keyegresosDurante['ea_desc_de_ley_mensual'],2,'.',','),'R');
}else{
$pdf->multicelda(134,124,30,1,'Arial','B',6,190,8,"-",'R');
}
$pdf->leyendas(169,122,'Arial','',6,190,8,'__________________________');
if($keyegresosDurante['ea_desc_de_ley_anual']!="0.00" && $keyegresosDurante['ea_desc_de_ley_anual']!=""){
$pdf->multicelda(170,124,30,1,'Arial','B',6,190,8,"$ ".number_format($keyegresosDurante['ea_desc_de_ley_anual'],2,'.',','),'R');
}else{
$pdf->multicelda(170,124,30,1,'Arial','B',6,190,8,"-",'R');
}

$pdf->leyendas(115,127,'Arial','',6,190,8,'Pago Prestamo Solic.');
$pdf->leyendas(138,127,'Arial','',6,190,8,'______________________');
if($keyegresosDurante['ea_pago_prestamo_solic_mensual']!="0.00" && $keyegresosDurante['ea_pago_prestamo_solic_mensual']!=""){
$pdf->multicelda(134,129,30,1,'Arial','B',6,190,8,"$ ".number_format($keyegresosDurante['ea_pago_prestamo_solic_mensual'],2,'.',','),'R');
}else{
$pdf->multicelda(134,129,30,1,'Arial','B',6,190,8,"-",'R');
}
$pdf->leyendas(169,127,'Arial','',6,190,8,'__________________________');
if($keyegresosDurante['ea_pago_prestamo_solic_anual']!="0.00" && $keyegresosDurante['ea_pago_prestamo_solic_anual']!=""){
$pdf->multicelda(170,129,30,1,'Arial','B',6,190,8,"$ ".number_format($keyegresosDurante['ea_pago_prestamo_solic_anual'],2,'.',','),'R');
}else{
$pdf->multicelda(170,129,30,1,'Arial','B',6,190,8,"-",'R');
}

$pdf->leyendas(115,132,'Arial','',6,190,8,'Interes');
$pdf->leyendas(169,132,'Arial','',6,190,8,'__________________________');
if($keyegresosDurante['ea_intereses_anuales']!="0.00" && $keyegresosDurante['ea_intereses_anuales']!=""){
$pdf->multicelda(170,134,30,1,'Arial','B',6,190,8,"$ ".number_format($keyegresosDurante['ea_intereses_anuales'],2,'.',','),'R');
}else{
$pdf->multicelda(170,134,30,1,'Arial','B',6,190,8,"-",'R');
}

$pdf->leyendas(115,137,'Arial','',6,190,8,'Comisiones');
$pdf->leyendas(169,137,'Arial','',6,190,8,'__________________________');
if($keyegresosDurante['ea_comisiones_anuales']!="0.00" && $keyegresosDurante['ea_comisiones_anuales']!=""){
$pdf->multicelda(170,139,30,1,'Arial','B',6,190,8,"$ ".number_format($keyegresosDurante['ea_comisiones_anuales'],2,'.',','),'R');
}else{
$pdf->multicelda(170,139,30,1,'Arial','B',6,190,8,"-",'R');
}

$pdf->leyendas(115,142,'Arial','',6,190,8,'Impuestos');
$pdf->leyendas(169,142,'Arial','',6,190,8,'__________________________');
if($keyegresosDurante['ea_impuestos_anuales']!="0.00" && $keyegresosDurante['ea_impuestos_anuales']!=""){
$pdf->multicelda(170,144,30,1,'Arial','B',6,190,8,"$ ".number_format($keyegresosDurante['ea_impuestos_anuales'],2,'.',','),'R');
}else{
$pdf->multicelda(170,144,30,1,'Arial','B',6,190,8,"-",'R');
}

$pdf->leyendas(115,147,'Arial','',6,190,8,'Inversion Crédito');
$pdf->leyendas(135,147,'Arial','',6,190,8,'________________________ ');
$pdf->leyendas(133,146,'Arial','',6,190,8,$keyegresosDurante['ea_inversion_credito_nombre1']);
$pdf->leyendas(169,147,'Arial','',6,190,8,'__________________________');
if($keyegresosDurante['ea_inversion_credito_anual1']!="0.00" && $keyegresosDurante['ea_inversion_credito_anual1']!=""){
$pdf->multicelda(170,149,30,1,'Arial','B',6,190,8,"$ ".number_format($keyegresosDurante['ea_inversion_credito_anual1'],2,'.',','),'R');
}else{
$pdf->multicelda(170,149,30,1,'Arial','B',6,190,8,"-",'R');
}

$pdf->leyendas(115,152,'Arial','',7,190,8,'____________________________________ ');
$pdf->leyendas(133,151,'Arial','',6,190,8,$keyegresosDurante['ea_inversion_credito_nombre2']);
$pdf->leyendas(169,152,'Arial','',7,190,8,'______________________');
if($keyegresosDurante['ea_inversion_credito_anual2']!="0.00" && $keyegresosDurante['ea_inversion_credito_anual2']!=""){
$pdf->multicelda(170,154,30,1,'Arial','B',6,190,8,"$ ".number_format($keyegresosDurante['ea_inversion_credito_anual2'],2,'.',','),'R');
}else{
$pdf->multicelda(170,154,30,1,'Arial','B',6,190,8,"-",'R');
}

$pdf->leyendas(115,157,'Arial','',7,190,8,'____________________________________ ');
$pdf->leyendas(133,156,'Arial','',6,190,8,$keyegresosDurante['ea_inversion_credito_nombre3']);
$pdf->leyendas(169,157,'Arial','',7,190,8,'______________________');
if($keyegresosDurante['ea_inversion_credito_anual3']!="0.00" && $keyegresosDurante['ea_inversion_credito_anual3']!=""){
$pdf->multicelda(170,159,30,1,'Arial','B',6,190,8,"$ ".number_format($keyegresosDurante['ea_inversion_credito_anual3'],2,'.',','),'R');
}else{
$pdf->multicelda(170,159,30,1,'Arial','B',6,190,8,"-",'R');
}

$pdf->leyendas(75,162,'Arial','',6,190,8,'EXCEDENTE NETO ANUAL ');
$pdf->leyendas(115,162,'Arial','',6,190,8,'______________________');
if(($keyingresosDurante['ia_total']-$keyegresosDurante['ea_total'])!="0.00"){
$pdf->multicelda(116,164,25,1,'Arial','B',6,190,8,"$ ".number_format(($keyingresosDurante['ia_total']-$keyegresosDurante['ea_total']),2,'.',','),'R');
}else{
$pdf->multicelda(116,164,25,1,'Arial','B',6,190,8,"-",'R');
}

$pdf->leyendas(150,162,'Arial','',6,190,8,'TOTAL ');
$pdf->leyendas(169,162,'Arial','',6,190,8,'__________________________');
if($keyegresosDurante['ea_total']!="0.00" && $keyegresosDurante['ea_total']!=""){
$pdf->multicelda(170,164,30,1,'Arial','B',6,190,8,"$ ".number_format($keyegresosDurante['ea_total'],2,'.',','),'R');
}else{
$pdf->multicelda(170,164,30,1,'Arial','B',6,190,8,"-",'R');
}
/* ----------------------------EGRESOSS------------------------------------- */

$pdf->leyendas(12,166,'Arial','',7,290,8,'__________________________________________________________________________________________________________________________________________');

$juramento = $DAO->mostrarAll($conexion,"select * from configuracion_informes where  id_conf='1'");
$pdf->multicelda(12,172,190,3,'Arial','',6,100,8,(utf8_decode($juramento[0][1])),'J');


$lugar_fecha = $DAO->mostrarAll($conexion,"select * from capacidad_pago_durante_anio_amortizar where  cre_solic_id='$buscar'");
foreach ($lugar_fecha as $keyCapacidadDurante) {
	# code...
}

$pdf->leyendas(62,192,'Arial','',7,290,8,' LUGAR Y FECHA  ____________________________________________________________________________________');
$pdf->leyendas(110,197,'Arial','',7,290,8,'DIA');
$pdf->leyendas(95,191,'Arial','',8,200,7,$keyCapacidadDurante['cp_lugar'].",".$keyCapacidadDurante['cp_dia']);
$pdf->leyendas(135,191,'Arial','',8,100,7,"DE ".$keyCapacidadDurante['cp_mes']." DE");
$pdf->leyendas(179,191,'Arial','',8,100,7,$keyCapacidadDurante['cp_anio']);
$pdf->leyendas(145,197,'Arial','',7,290,8,'MES');
$pdf->leyendas(180,197,'Arial','',7,290,8,'AÑO');

$pdf->leyendas(80,202,'Arial','',7,290,8,'HUELLAS DIGITALES');
$pdf->leyendas(80,205,'Arial','',7,290,8,'SI NO SABE FIRMAR');
$cliente = $DAO->mostrarAll($conexion,"select cli_nombre_dui from clientes where cli_correlativo='$cli_correlativo'");
$pdf->leyendas(12,211,'Arial','',7,290,8,'___________________________________');
$pdf->leyendas(13,214,'Arial','',7,290,8,$cliente[0][0]);
$pdf->leyendas(18,218,'Arial','',7,290,8,'FIRMA DEL SOLICITANTE');

$pdf->leyendas(120,211,'Arial','',7,290,8,'________________________');
$pdf->leyendas(124,214,'Arial','',7,290,8,'PULGAR IZQUIERDO');

$pdf->leyendas(160,211,'Arial','',7,290,8,'________________________');
$pdf->leyendas(164,214,'Arial','',7,290,8,'PULGAR DERECHO');



if(($value['id_comite']==1 || $value['id_comite']==2) && $value['cli_es_empleado']==0){
	$pdf->leyendas(12,224,'Arial','',6,200,7,' El comité de credito _______ ');
	$pdf->leyendas(35,223,'Arial','',8,200,7,$value['id_comite']);
	$pdf->leyendas(40,224,'Arial','',6,220,7,' de la Caja de Crédito de San Vicente, conoció la presente solicitud en sesión N° _______________________________ del dia _________________________________');
	$pdf->leyendas(12,229,'Arial','',6,220,7,'y acordó: _______________________________________________________________________________________________________________________________________________________');
	$pdf->leyendas(12,234,'Arial','',6,220,7,'_______________________________________________________________________________________________________________________________________________________________');

	$comite = $DAO->mostrarAll($conexion,"select * from comites where id_comite='$value[78]'");
foreach ($comite as $keyComite) {
	# code...
}

$pdf->leyendas(12,245,'Arial','',7,200,8,'________________________________________');
$pdf->leyendas(25,250,'Arial','',7,200,8,$keyComite[4]);

$pdf->leyendas(80,245,'Arial','',7,200,8,'________________________________________');
$pdf->leyendas(94,250,'Arial','',7,200,8,$keyComite[5]);

$pdf->leyendas(144,245,'Arial','',7,200,8,'________________________________________');
$pdf->leyendas(159,250,'Arial','',7,200,8,$keyComite[6]);

}else if($value['id_comite']==3 || $value['cli_es_empleado']==1){
	$pdf->leyendas(12,224,'Arial','',6,200,7,'La Junta Directiva ');
	$pdf->leyendas(30,224,'Arial','',6,220,7,'de la Caja de Crédito de San Vicente, conoció la presente solicitud en sesión N° _______________________________ del dia __________________________________________');
	$pdf->leyendas(12,229,'Arial','',6,220,7,'y acordó: _______________________________________________________________________________________________________________________________________________________');
	$pdf->leyendas(12,234,'Arial','',6,220,7,'_______________________________________________________________________________________________________________________________________________________________');	

$pdf->leyendas(12,245,'Arial','',7,200,8,'________________________________________');
$pdf->leyendas(29,250,'Arial','',7,200,8,'PRESIDENTE');

$pdf->leyendas(80,245,'Arial','',7,200,8,'________________________________________');
$pdf->leyendas(98,250,'Arial','',7,200,8,'PRIMER DIRECTOR');

$pdf->leyendas(144,245,'Arial','',7,200,8,'________________________________________');
$pdf->leyendas(165,250,'Arial','',7,200,8,'SECRETARIO');
}






if($value['cli_es_empleado']==0){
	$pdf->leyendas(12,258,'Arial','',7,200,8,"OBSERVACIONES:");
	$pdf->leyendas(12,265,'Arial','',6,220,7,'_______________________________________________________________________________________________________________________________________________________________');
	$pdf->leyendas(12,272,'Arial','',6,220,7,'_______________________________________________________________________________________________________________________________________________________________');
	$pdf->leyendas(12,279,'Arial','',6,220,7,'_______________________________________________________________________________________________________________________________________________________________');
	$pdf->leyendas(12,286,'Arial','',6,220,7,'_______________________________________________________________________________________________________________________________________________________________');
	$pdf->leyendas(12,293,'Arial','',6,220,7,'_______________________________________________________________________________________________________________________________________________________________');
	$pdf->multicelda(12,265,189,7,'Arial','B',6,100,8,$keyCapacidadDurante['cp_observaciones'],'J');
}else if($value['cli_es_empleado']==1){

	$pdf->leyendas(12,258,'Arial','',6,220,7,'_______________________________________________________________________________________________________________________________________________________________');
	$pdf->leyendas(12,264,'Arial','',6,220,7,'_______________________________________________________________________________________________________________________________________________________________');
	$pdf->leyendas(12,270,'Arial','',6,220,7,'_______________________________________________________________________________________________________________________________________________________________');
	$pdf->leyendas(12,276,'Arial','',6,220,7,'_______________________________________________________________________________________________________________________________________________________________');
	$pdf->leyendas(12,282,'Arial','',6,220,7,'_______________________________________________________________________________________________________________________________________________________________');

	$pdf->leyendas(12,257,'Arial','',7,450,8,"La presente solicitud fue conocida y analizada por el comite de credito:       ".$value[78]."      Acta N°:                                          de fecha:");
	$pdf->leyendas(12,263,'Arial','',7,450,8,"y resolvó:");
	$pdf->leyendas(12,269,'Arial','',7,450,8,"Monto:    ".number_format($filaPrestamo['cre_monto'],2,'.',','));
	$pdf->leyendas(75,269,'Arial','',7,450,8,"Plazo:    ".$filaPrestamo['cre_plazo_anio']);
	$pdf->leyendas(125,269,'Arial','',7,450,8,"Tasa de interes:    ");
	$pdf->leyendas(12,275,'Arial','',7,450,8,"Garantia:							HIPOTECARIA");
	$pdf->leyendas(75,275,'Arial','',7,450,8,"Forma de pago:    ".$filaPrestamo['cre_num_cuotas']." CUOTA(S) ".$filaPrestamo['cre_forma_pago']."(ES)");
	$pdf->leyendas(12,281,'Arial','',7,200,8,"OBSERVACIONES:");
	$pdf->multicelda(35,281,189,7,'Arial','B',6,100,8,substr($keyCapacidadDurante['cp_observaciones'],0,127),'J');
	$comite = $DAO->mostrarAll($conexion,"select * from comites where id_comite='$value[78]'");
foreach ($comite as $keyComite) {
	# code...
}

	$pdf->leyendas(12,289,'Arial','',7,200,8,'________________________________________');
	$pdf->leyendas(25,293,'Arial','',7,200,8,$keyComite[4]);

	$pdf->leyendas(80,289,'Arial','',7,200,8,'________________________________________');
	$pdf->leyendas(94,293,'Arial','',7,200,8,$keyComite[5]);

	$pdf->leyendas(144,289,'Arial','',7,200,8,'________________________________________');
	$pdf->leyendas(159,293,'Arial','',7,200,8,$keyComite[6]);
}


$pdf->leyendas(12,301,'Arial','',7,100,8,'PROMOTOR:     '.$filaPromo[0]." ".$filaPromo[1]);
$pdf->leyendas(28,302,'Arial','',7,190,8,'___________________________________________________________________________________________________________');



$pdf->AddPage();
$pdf->cuadrogrande(11,10,193,294,3,D);

$pdf->leyendas(12,9,'Arial','',7,100,8,'M. DESCRIPCION DE LAS GARANTIAS OFRECIDAS');
$pdf->leyendas(12,14,'Arial','',6,220,7,'_______________________________________________________________________________________________________________________________________________________________');
$pdf->leyendas(12,18,'Arial','',6,220,7,'_______________________________________________________________________________________________________________________________________________________________');
$pdf->leyendas(12,22,'Arial','',6,220,7,'_______________________________________________________________________________________________________________________________________________________________');
$pdf->leyendas(12,26,'Arial','',6,220,7,'_______________________________________________________________________________________________________________________________________________________________');
$pdf->leyendas(12,30,'Arial','',6,220,7,'_______________________________________________________________________________________________________________________________________________________________');
$pdf->leyendas(12,34,'Arial','',6,220,7,'_______________________________________________________________________________________________________________________________________________________________');
$pdf->multicelda(12,15,189,4,'Arial','B',7,100,8,utf8_decode($filaPrestamo['cre_descrip_garantias_ofresidas']),'J');

$pdf->leyendas(12,39,'Arial','',7,100,8,'N. LA INVERSION SE HARÁ CONFORME AL SIGUIENTE DETALLE');
$pdf->leyendas(12,44,'Arial','',6,220,7,'_______________________________________________________________________________________________________________________________________________________________');
$pdf->leyendas(12,48,'Arial','',6,220,7,'_______________________________________________________________________________________________________________________________________________________________');
$pdf->leyendas(12,52,'Arial','',6,220,7,'_______________________________________________________________________________________________________________________________________________________________');
$pdf->leyendas(12,56,'Arial','',6,220,7,'_______________________________________________________________________________________________________________________________________________________________');
$pdf->leyendas(12,60,'Arial','',6,220,7,'_______________________________________________________________________________________________________________________________________________________________');
$pdf->leyendas(12,64,'Arial','',6,220,7,'_______________________________________________________________________________________________________________________________________________________________');
$pdf->multicelda(12,45,137,4,'Arial','B',7,100,8,utf8_decode($filaPrestamo['cre_inversion_conforme_a']),'J');
$pdf->leyendas(160,47,'Arial','',7,220,7,"$ ".number_format($filaPrestamo['cre_monto'],2,'.',','));

$pdf->leyendas(150,46,'Arial','',6,220,7,'|');
$pdf->leyendas(150,48,'Arial','',6,220,7,'|');
$pdf->leyendas(150,50,'Arial','',6,220,7,'|');
$pdf->leyendas(150,52,'Arial','',6,220,7,'|');
$pdf->leyendas(150,54,'Arial','',6,220,7,'|');
$pdf->leyendas(150,56,'Arial','',6,220,7,'|');
$pdf->leyendas(150,58,'Arial','',6,220,7,'|');
$pdf->leyendas(150,60,'Arial','',6,220,7,'|');
$pdf->leyendas(150,62,'Arial','',6,220,7,'|');
$pdf->leyendas(150,64,'Arial','',6,220,7,'|');


$pdf->leyendas(12,69,'Arial','',6,220,7,'CODIGO ACTIVIDAD PRODUCTIVA');
$pdf->leyendas(62,69,'Arial','',6,220,7,'________________________');
$pdf->leyendas(63,68,'Arial','',6,220,7,$filaPrestamo['cod_actividad_productiva']);

$pdf->leyendas(140,69,'Arial','',6,220,7,'CODIGO BENEFICIARIO');
$pdf->leyendas(170,69,'Arial','',6,220,7,'_________________________');
$pdf->leyendas(171,68,'Arial','',6,220,7,$filaPrestamo['cre_beneficiarios']);

$pdf->leyendas(140,73,'Arial','',6,220,7,'CODIGO GEOGRAFICO');
$pdf->leyendas(170,73,'Arial','',6,220,7,'_________________________');
$pdf->leyendas(171,72,'Arial','',6,220,7,$filaPrestamo['codigo_geografico']);

$pdf->leyendas(12,72,'Arial','',6,220,7,'IND. JEFE GRUPO');
$pdf->leyendas(38,72,'Arial','',6,220,7,'_____');

$pdf->leyendas(12,76,'Arial','',7,220,7,'O. CAPACIDAD DE PAGO DEL SOLICITANTE AL 31 DE DICIEMBRE ANTERIOR');

$pdf->leyendas(40,80,'Arial','B',7,190,8,'INGRESOS ANUALES');
$pdf->leyendas(135,80,'Arial','B',7,190,8,'EGRESOS ANUALES');

/* -----------------------------INGRESOS --------------------------------------- */
$ingresosAnterior = $DAO->mostrarAll($conexion,"select * from ingresos_anuales_durante_anio_amortizar where cre_solic_id='$buscar' and ia_comentario='ANIOANTERIOR'");
foreach ($ingresosAnterior as $keyingresosAnterior) {
	# code...
}
$pdf->leyendas(12,85,'Arial','',6,190,8,'Sueldo o Salario Mensual');
$pdf->leyendas(42,85,'Arial','',6,190,8,'_________________________');
if($keyingresosAnterior['ia_sueldo_mensual']!="0.00" && $keyingresosAnterior['ia_sueldo_mensual']!=""){
$pdf->multicelda(42,87,30,1,'Arial','B',6,190,8,"$ ".number_format($keyingresosAnterior['ia_sueldo_mensual'],2,'.',','),'R');
}else{
$pdf->multicelda(42,87,30,1,'Arial','B',6,190,8,"-",'R');
}
$pdf->leyendas(79,85,'Arial','',6,190,8,'_________________________');
if($keyingresosAnterior['ia_sueldo_anual']!="0.00" && $keyingresosAnterior['ia_sueldo_anual']!=""){
$pdf->multicelda(79,87,30,1,'Arial','B',6,190,8,"$ ".number_format($keyingresosAnterior['ia_sueldo_anual'],2,'.',','),'R');
}else{
$pdf->multicelda(79,87,30,1,'Arial','B',6,190,8,"-",'R');
}
$pdf->leyendas(12,90,'Arial','',6,190,8,'Servicios Profesionales');
$pdf->leyendas(42,90,'Arial','',6,190,8,'_________________________');
if($keyingresosAnterior['ia_serv_prof_mensual']!="0.00" && $keyingresosAnterior['ia_serv_prof_mensual']!=""){
$pdf->multicelda(42,92,30,1,'Arial','B',6,190,8,"$ ".number_format($keyingresosAnterior['ia_serv_prof_mensual'],2,'.',','),'R');
}else{
$pdf->multicelda(42,92,30,1,'Arial','B',6,190,8,"-",'R');
}
$pdf->leyendas(79,90,'Arial','',6,190,8,'_________________________');
if($keyingresosAnterior['ia_serv_prof_anual']!="0.00" && $keyingresosAnterior['ia_serv_prof_anual']!=""){
$pdf->multicelda(79,92,30,1,'Arial','B',6,190,8,"$ ".number_format($keyingresosAnterior['ia_serv_prof_anual'],2,'.',','),'R');
}else{
$pdf->multicelda(79,92,30,1,'Arial','B',6,190,8,"-",'R');
}
$pdf->leyendas(12,95,'Arial','',6,190,8,'Comisiones');
$pdf->leyendas(79,95,'Arial','',6,190,8,'_________________________');
if($keyingresosAnterior['ia_comisiones']!="0.00" && $keyingresosAnterior['ia_comisiones']!=""){
$pdf->multicelda(79,97,30,1,'Arial','B',6,190,8,"$ ".number_format($keyingresosAnterior['ia_comisiones'],2,'.',','),'R');
}else{
$pdf->multicelda(79,97,30,1,'Arial','B',6,190,8,"-",'R');
}
$pdf->leyendas(12,100,'Arial','',6,190,8,'Intereses');
$pdf->leyendas(79,100,'Arial','',6,190,8,'_________________________');
if($keyingresosAnterior['ia_intereses']!="0.00" && $keyingresosAnterior['ia_intereses']!=""){
$pdf->multicelda(79,102,30,1,'Arial','B',6,190,8,"$ ".number_format($keyingresosAnterior['ia_intereses'],2,'.',','),'R');
}else{
$pdf->multicelda(79,102,30,1,'Arial','B',6,190,8,"-",'R');
}
$pdf->leyendas(12,105,'Arial','',6,190,8,'Arrendamiento de Propiedades');
$pdf->leyendas(44,105,'Arial','',6,190,8,'________________________');
if($keyingresosAnterior['ia_arrendamiento_mensual']!="0.00" && $keyingresosAnterior['ia_arrendamiento_mensual']!=""){
$pdf->multicelda(42,107,30,1,'Arial','B',6,190,8,"$ ".number_format($keyingresosAnterior['ia_arrendamiento_mensual'],2,'.',','),'R');
}else{
$pdf->multicelda(42,107,30,1,'Arial','B',6,190,8,"-",'R');
}
$pdf->leyendas(79,105,'Arial','',6,190,8,'_________________________');
if($keyingresosAnterior['ia_arrendamiento_anual']!="0.00" && $keyingresosAnterior['ia_arrendamiento_anual']!=""){
$pdf->multicelda(79,107,30,1,'Arial','B',6,190,8,"$ ".number_format($keyingresosAnterior['ia_arrendamiento_anual'],2,'.',','),'R');
}else{
$pdf->multicelda(79,107,30,1,'Arial','B',6,190,8,"-",'R');
}

$pdf->leyendas(12,110,'Arial','',6,190,8,'Venta de Productos Agricolas');
$pdf->leyendas(44,110,'Arial','',6,190,8,'________________________');
if($keyingresosAnterior['ia_venta_productos_agricolas_mensual']!="0.00" && $keyingresosAnterior['ia_venta_productos_agricolas_mensual']!=""){
$pdf->multicelda(42,112,30,1,'Arial','B',6,190,8,"$ ".number_format($keyingresosAnterior['ia_venta_productos_agricolas_mensual'],2,'.',','),'R');
}else{
$pdf->multicelda(42,112,30,1,'Arial','B',6,190,8,"-",'R');
}
$pdf->leyendas(79,110,'Arial','',6,190,8,'_________________________');
if($keyingresosAnterior['ia_venta_productos_agricolas_anual']!="0.00" && $keyingresosAnterior['ia_venta_productos_agricolas_anual']!=""){
$pdf->multicelda(79,112,30,1,'Arial','B',6,190,8,"$ ".number_format($keyingresosAnterior['ia_venta_productos_agricolas_anual'],2,'.',','),'R');
}else{
$pdf->multicelda(79,112,30,1,'Arial','B',6,190,8,"-",'R');
}

$pdf->leyendas(12,115,'Arial','',6,190,8,'Maiz');
$pdf->leyendas(20,115,'Arial','',6,190,8,'________________ qq');
if($keyingresosAnterior['ia_maiz_qq']!="0.00" && $keyingresosAnterior['ia_maiz_qq']!=""){
$pdf->multicelda(21,117,18,1,'Arial','B',6,190,8,number_format($keyingresosAnterior['ia_maiz_qq'],2,'.',','),'R');
}else{
$pdf->multicelda(21,117,18,1,'Arial','B',6,190,8,'-','R');
}
$pdf->leyendas(44,115,'Arial','',6,190,8,'________________________ Msz.');
if($keyingresosAnterior['ia_maiz_mzs']!="0.00" && $keyingresosAnterior['ia_maiz_mzs']!=""){
$pdf->multicelda(44,117,28,1,'Arial','B',6,190,8,number_format($keyingresosAnterior['ia_maiz_mzs'],2,'.',','),'R');
}else{
$pdf->multicelda(44,117,28,1,'Arial','B',6,190,8,'-','R');
}
$pdf->leyendas(79,115,'Arial','',6,190,8,'_________________________');
if($keyingresosAnterior['ia_maiz_anual']!="0.00" && $keyingresosAnterior['ia_maiz_anual']!=""){
$pdf->multicelda(79,117,30,1,'Arial','B',6,190,8,"$ ".number_format($keyingresosAnterior['ia_maiz_anual'],2,'.',','),'R');
}else{
$pdf->multicelda(79,117,30,1,'Arial','B',6,190,8,"-",'R');
}
$pdf->leyendas(12,120,'Arial','',6,190,8,'Arroz');
$pdf->leyendas(20,120,'Arial','',6,190,8,'________________ qq');
if($keyingresosAnterior['ia_arroz_qq']!="0.00" && $keyingresosAnterior['ia_arroz_qq']!=""){
$pdf->multicelda(21,122,18,1,'Arial','B',6,190,8,number_format($keyingresosAnterior['ia_arroz_qq'],2,'.',','),'R');
}else{
$pdf->multicelda(21,122,18,1,'Arial','B',6,190,8,'-','R');
}
$pdf->leyendas(44,120,'Arial','',6,190,8,'________________________ Msz.');
if($keyingresosAnterior['ia_arroz_mzs']!="0.00" && $keyingresosAnterior['ia_arroz_mzs']!=""){
$pdf->multicelda(44,122,28,1,'Arial','B',6,190,8,number_format($keyingresosAnterior['ia_arroz_mzs'],2,'.',','),'R');
}else{
$pdf->multicelda(44,122,28,1,'Arial','B',6,190,8,"-",'R');
}
$pdf->leyendas(79,120,'Arial','',6,190,8,'_________________________');
if($keyingresosAnterior['ia_arroz_anual']!="0.00" && $keyingresosAnterior['ia_arroz_anual']!=""){
$pdf->multicelda(79,122,30,1,'Arial','B',6,190,8,"$ ".number_format($keyingresosAnterior['ia_arroz_anual'],2,'.',','),'R');
}else{
$pdf->multicelda(79,122,30,1,'Arial','B',6,190,8,"-",'R');
}
$pdf->leyendas(12,125,'Arial','',6,190,8,'Maicillo');
$pdf->leyendas(20,125,'Arial','',6,190,8,'________________ qq');
if($keyingresosAnterior['ia_maicillo_qq']!="0.00" && $keyingresosAnterior['ia_maicillo_qq']!=""){
$pdf->multicelda(21,127,18,1,'Arial','B',6,190,8,number_format($keyingresosAnterior['ia_maicillo_qq'],2,'.',','),'R');
}else{
$pdf->multicelda(21,127,18,1,'Arial','B',6,190,8,'-','R');
}
$pdf->leyendas(44,125,'Arial','',6,190,8,'________________________ Msz.');
if($keyingresosAnterior['ia_maicillo_mzs']!="0.00" && $keyingresosAnterior['ia_maicillo_mzs']!=""){
$pdf->multicelda(44,127,28,1,'Arial','B',6,190,8,number_format($keyingresosAnterior['ia_maicillo_mzs'],2,'.',','),'R');
}else{
$pdf->multicelda(44,127,28,1,'Arial','B',6,190,8,'-','R');
}
$pdf->leyendas(79,125,'Arial','',6,190,8,'_________________________');
if($keyingresosAnterior['ia_maicillo_anual']!="0.00" && $keyingresosAnterior['ia_maicillo_anual']!=""){
$pdf->multicelda(79,127,30,1,'Arial','B',6,190,8,"$ ".number_format($keyingresosAnterior['ia_maicillo_anual'],2,'.',','),'R');
}else{
$pdf->multicelda(79,127,30,1,'Arial','B',6,190,8,"-",'R');
}
$pdf->leyendas(12,130,'Arial','',6,190,8,'Frijol');
$pdf->leyendas(20,130,'Arial','',6,190,8,'________________ qq');
if($keyingresosAnterior['ia_frijol_qq']!="0.00" && $keyingresosAnterior['ia_frijol_qq']!=""){
$pdf->multicelda(21,132,18,1,'Arial','B',6,190,8,number_format($keyingresosAnterior['ia_frijol_qq'],2,'.',','),'R');
}else{
	$pdf->multicelda(21,132,18,1,'Arial','B',6,190,8,'-','R');
}
$pdf->leyendas(44,130,'Arial','',6,190,8,'________________________ Msz.');
if($keyingresosAnterior['ia_frijol_mzs']!="0.00" && $keyingresosAnterior['ia_frijol_mzs']!=""){
$pdf->multicelda(44,132,28,1,'Arial','B',6,190,8,number_format($keyingresosAnterior['ia_frijol_mzs'],2,'.',','),'R');
}else{
$pdf->multicelda(44,132,28,1,'Arial','B',6,190,8,"-",'R');
}
$pdf->leyendas(79,130,'Arial','',6,190,8,'_________________________');
if($keyingresosAnterior['ia_frijol_anual']!="0.00" && $keyingresosAnterior['ia_frijol_anual']!=""){
$pdf->multicelda(79,132,30,1,'Arial','B',6,190,8,"$ ".number_format($keyingresosAnterior['ia_frijol_anual'],2,'.',','),'R');
}else{
$pdf->multicelda(79,132,30,1,'Arial','B',6,190,8,"-",'R');
}
$pdf->leyendas(12,135,'Arial','',6,190,8,'Cafe');
$pdf->leyendas(20,135,'Arial','',6,190,8,'_______________ qq');
if($keyingresosAnterior['ia_cafe_qq']!="0.00" && $keyingresosAnterior['ia_cafe_qq']!=""){
$pdf->multicelda(21,137,18,1,'Arial','B',6,190,8,number_format($keyingresosAnterior['ia_cafe_qq'],2,'.',','),'R');
}else{
$pdf->multicelda(21,137,18,1,'Arial','B',6,190,8,"-",'R');
}
$pdf->leyendas(44,135,'Arial','',6,190,8,'________________________ Msz.');
if($keyingresosAnterior['ia_cafe_mzs']!="0.00" && $keyingresosAnterior['ia_cafe_mzs']!=""){
$pdf->multicelda(44,137,28,1,'Arial','B',6,190,8,number_format($keyingresosAnterior['ia_cafe_mzs'],2,'.',','),'R');
}else{
$pdf->multicelda(44,137,28,1,'Arial','B',6,190,8,"-",'R');
}
$pdf->leyendas(79,135,'Arial','',6,190,8,'_________________________');
if($keyingresosAnterior['ia_cafe_anual']!="0.00" && $keyingresosAnterior['ia_cafe_anual']!=""){
$pdf->multicelda(79,137,30,1,'Arial','B',6,190,8,"$ ".number_format($keyingresosAnterior['ia_cafe_anual'],2,'.',','),'R');
}else{
$pdf->multicelda(79,137,30,1,'Arial','B',6,190,8,"-",'R');
}
$pdf->leyendas(12,140,'Arial','',6,190,8,'Caña');
$pdf->leyendas(20,140,'Arial','',6,190,8,'________________Ton');
if($keyingresosAnterior['ia_cania_qq']!="0.00" && $keyingresosAnterior['ia_cania_qq']!=""){
$pdf->multicelda(21,142,18,1,'Arial','B',6,190,8,number_format($keyingresosAnterior['ia_cania_qq'],2,'.',','),'R');
}else{
$pdf->multicelda(21,142,18,1,'Arial','B',6,190,8,"-",'R');
}
$pdf->leyendas(44,140,'Arial','',6,190,8,'________________________ Msz.');
if($keyingresosAnterior['ia_cania_mzs']!="0.00" && $keyingresosAnterior['ia_cania_mzs']!=""){
$pdf->multicelda(44,142,28,1,'Arial','B',6,190,8,number_format($keyingresosAnterior['ia_cania_mzs'],2,'.',','),'R');
}else{
$pdf->multicelda(44,142,28,1,'Arial','B',6,190,8,"-",'R');
}
$pdf->leyendas(79,140,'Arial','',6,190,8,'_________________________');
if($keyingresosAnterior['ia_cania_anual']!="0.00" && $keyingresosAnterior['ia_cania_anual']!=""){
$pdf->multicelda(79,142,30,1,'Arial','B',6,190,8,"$ ".number_format($keyingresosAnterior['ia_cania_anual'],2,'.',','),'R');
}else{
$pdf->multicelda(79,142,30,1,'Arial','B',6,190,8,"-",'R');
}

$pdf->leyendas(20,145,'Arial','',6,190,8,'_________________');
$pdf->leyendas(21,144,'Arial','B',6,190,8,$keyingresosAnterior['ia_otros_nombre']);
$pdf->leyendas(44,145,'Arial','',6,190,8,'________________________ Msz.');
if($keyingresosAnterior['ia_otros_mzs']!="0.00" && $keyingresosAnterior['ia_otros_mzs']!=""){
$pdf->multicelda(44,147,28,1,'Arial','B',6,190,8,number_format($keyingresosAnterior['ia_otros_mzs'],2,'.',','),'R');
}else{
$pdf->multicelda(44,147,28,1,'Arial','B',6,190,8,"-",'R');
}
$pdf->leyendas(79,145,'Arial','',6,190,8,'_________________________');
if($keyingresosAnterior['ia_otros_anual']!="0.00" && $keyingresosAnterior['ia_otros_anual']!=""){
$pdf->multicelda(79,147,30,1,'Arial','B',6,190,8,"$ ".number_format($keyingresosAnterior['ia_otros_anual'],2,'.',','),'R');
}else{
$pdf->multicelda(79,147,30,1,'Arial','B',6,190,8,"-",'R');
}
$pdf->leyendas(20,150,'Arial','',6,190,8,'_________________');
$pdf->leyendas(21,149,'Arial','B',6,190,8,$keyingresosAnterior['ia_otros_nombre2']);
$pdf->leyendas(44,150,'Arial','',6,190,8,'________________________ Msz.');
if($keyingresosAnterior['ia_otros_mzs2']!="0.00" && $keyingresosAnterior['ia_otros_mzs2']!=""){
$pdf->multicelda(44,152,28,1,'Arial','B',6,190,8,number_format($keyingresosAnterior['ia_otros_mzs2'],2,'.',','),'R');
}else{
$pdf->multicelda(44,152,28,1,'Arial','B',6,190,8,"-",'R');
}
$pdf->leyendas(79,150,'Arial','',6,190,8,'_________________________');
if($keyingresosAnterior['ia_otros_anual2']!="0.00" && $keyingresosAnterior['ia_otros_anual2']!=""){
$pdf->multicelda(79,152,30,1,'Arial','B',6,190,8,"$ ".number_format($keyingresosAnterior['ia_otros_anual2'],2,'.',','),'R');
}else{
$pdf->multicelda(79,152,30,1,'Arial','B',6,190,8,"-",'R');
}
$pdf->leyendas(12,155,'Arial','',6,190,8,'Venta de Productos Pecuarios');
$pdf->leyendas(79,155,'Arial','',6,190,8,'_________________________');


$pdf->leyendas(12,160,'Arial','',6,190,8,'Leche');
$pdf->leyendas(23,160,'Arial','',6,190,8,'__________________________________________ Bot.');
if($keyingresosAnterior['ia_prod_pecuario_leche_bot']!="0.00" && $keyingresosAnterior['ia_prod_pecuario_leche_bot']!=""){
$pdf->multicelda(44,162,28,1,'Arial','B',6,190,8,number_format($keyingresosAnterior['ia_prod_pecuario_leche_bot'],2,'.',','),'R');
}else{
$pdf->multicelda(44,162,28,1,'Arial','B',6,190,8,'-','R');
}
$pdf->leyendas(79,160,'Arial','',6,190,8,'_________________________');
if($keyingresosAnterior['ia_prod_pecuario_leche_anual']!="0.00" && $keyingresosAnterior['ia_prod_pecuario_leche_anual']!=""){
$pdf->multicelda(79,162,30,1,'Arial','B',6,190,8,"$ ".number_format($keyingresosAnterior['ia_prod_pecuario_leche_anual'],2,'.',','),'R');
}else{
$pdf->multicelda(79,162,30,1,'Arial','B',6,190,8,"-",'R');
}

$pdf->leyendas(12,165,'Arial','',6,190,8,'Ganado');
$pdf->leyendas(23,165,'Arial','',6,190,8,'__________________________________________ Cab.');
if($keyingresosAnterior['ia_prod_pecuario_ganado_cab']!="0.00" && $keyingresosAnterior['ia_prod_pecuario_ganado_cab']!=""){
$pdf->multicelda(44,167,28,1,'Arial','B',6,190,8,number_format($keyingresosAnterior['ia_prod_pecuario_ganado_cab'],2,'.',','),'R');
}else{
$pdf->multicelda(44,167,28,1,'Arial','B',6,190,8,"-",'R');
}
$pdf->leyendas(79,165,'Arial','',6,190,8,'_________________________');
if($keyingresosAnterior['ia_prod_pecuario_ganado_anual']!="0.00" && $keyingresosAnterior['ia_prod_pecuario_ganado_anual']!=""){
$pdf->multicelda(79,167,30,1,'Arial','B',6,190,8,"$ ".number_format($keyingresosAnterior['ia_prod_pecuario_ganado_anual'],2,'.',','),'R');
}else{
$pdf->multicelda(79,167,30,1,'Arial','B',6,190,8,"-",'R');
}

$pdf->leyendas(12,170,'Arial','',6,190,8,'Ingreso por Comercio');
$pdf->leyendas(38,170,'Arial','',6,190,8,'_________________________________');
$pdf->leyendas(39,172,'Arial','B',6,190,8,$keyingresosAnterior['ia_ingreso_por_comercio_nombre']);
$pdf->leyendas(79,170,'Arial','',6,190,8,'_________________________');
if($keyingresosAnterior['ia_ingreso_por_comercio_cantidad']!="0.00" && $keyingresosAnterior['ia_ingreso_por_comercio_cantidad']!=""){
$pdf->multicelda(79,172,30,1,'Arial','B',6,190,8,"$ ".number_format($keyingresosAnterior['ia_ingreso_por_comercio_cantidad'],2,'.',','),'R');
}else{
$pdf->multicelda(79,172,30,1,'Arial','B',6,190,8,"-",'R');
}

$pdf->leyendas(38,175,'Arial','',7,190,8,'____________________________');
$pdf->leyendas(39,174,'Arial','B',6,190,8,$keyingresosAnterior['ia_ingreso_por_comercio_nombre2']);
$pdf->leyendas(79,175,'Arial','',7,190,8,'______________________');
if($keyingresosAnterior['ia_ingreso_por_comercio_cantidad2']!="0.00" && $keyingresosAnterior['ia_ingreso_por_comercio_cantidad2']!=""){
$pdf->multicelda(79,177,30,1,'Arial','B',6,190,8,"$ ".number_format($keyingresosAnterior['ia_ingreso_por_comercio_cantidad2'],2,'.',','),'R');
}else{
$pdf->multicelda(79,177,30,1,'Arial','B',6,190,8,"-",'R');
}

$pdf->leyendas(12,180,'Arial','',6,190,8,'Ayuda Familiar');
$pdf->leyendas(12,185,'Arial','',6,190,8,'________________________');
$pdf->leyendas(13,184,'Arial','B',6,190,8,$keyingresosAnterior['ia_ayuda_familiar_nombre']);
$pdf->leyendas(44,185,'Arial','',6,190,8,'___________________________');
if($keyingresosAnterior['ia_ayuda_familiar_mensual']!="0.00" && $keyingresosAnterior['ia_ayuda_familiar_mensual']!=""){
$pdf->multicelda(44,187,30,1,'Arial','B',6,190,8,"$ ".number_format($keyingresosAnterior['ia_ayuda_familiar_mensual'],2,'.',','),'R');
}else{
$pdf->multicelda(44,187,30,1,'Arial','B',6,190,8,"-",'R');
}
$pdf->leyendas(79,185,'Arial','',6,190,8,'_________________________');
if($keyingresosAnterior['ia_ayuda_familiar_anual']!="0.00" && $keyingresosAnterior['ia_ayuda_familiar_anual']!=""){
$pdf->multicelda(79,187,30,1,'Arial','B',6,190,8,"$ ".number_format($keyingresosAnterior['ia_ayuda_familiar_anual'],2,'.',','),'R');
}else{
	$pdf->multicelda(79,187,30,1,'Arial','B',6,190,8,"-",'R');
}

$pdf->leyendas(12,190,'Arial','',6,190,8,'________________________');
$pdf->leyendas(13,189,'Arial','B',6,190,8,$keyingresosAnterior['ia_ayuda_familiar_nombre2']);
$pdf->leyendas(44,190,'Arial','',6,190,8,'___________________________');
if($keyingresosAnterior['ia_ayuda_familiar_mensual2']!="0.00" && $keyingresosAnterior['ia_ayuda_familiar_mensual2']!=""){
$pdf->multicelda(44,192,30,1,'Arial','B',6,190,8,"$ ".number_format($keyingresosAnterior['ia_ayuda_familiar_mensual2'],2,'.',','),'R');
}else{
$pdf->multicelda(44,192,30,1,'Arial','B',6,190,8,"-",'R');
}
$pdf->leyendas(79,190,'Arial','',6,190,8,'_________________________');
if($keyingresosAnterior['ia_ayuda_familiar_anual2']!="0.00" && $keyingresosAnterior['ia_ayuda_familiar_anual2']!=""){
$pdf->multicelda(79,192,30,1,'Arial','B',6,190,8,"$ ".number_format($keyingresosAnterior['ia_ayuda_familiar_anual2'],2,'.',','),'R');
}else{
$pdf->multicelda(79,192,30,1,'Arial','B',6,190,8,"-",'R');
}


$pdf->leyendas(12,195,'Arial','',6,190,8,'Otros Ingresos');
$pdf->leyendas(32,195,'Arial','',6,190,8,'_____________________________________');
$pdf->leyendas(33,194,'Arial','B',6,190,8,$keyingresosAnterior['ia_otros_ingresos_nombre']);
$pdf->leyendas(79,195,'Arial','',6,190,8,'_________________________');
if($keyingresosAnterior['ia_otros_ingresos_cantidad']!="0.00" && $keyingresosAnterior['ia_otros_ingresos_cantidad']!=""){
$pdf->multicelda(79,197,30,1,'Arial','B',6,190,8,"$ ".number_format($keyingresosAnterior['ia_otros_ingresos_cantidad'],2,'.',','),'R');
}else{
$pdf->multicelda(79,197,30,1,'Arial','B',6,190,8,"-",'R');
}


$pdf->leyendas(65,200,'Arial','',6,190,8,'TOTAL');
$pdf->leyendas(79,200,'Arial','',6,190,8,'_________________________');
if($keyingresosAnterior['ia_total']!="0.00" && $keyingresosAnterior['ia_total']!=""){
$pdf->multicelda(79,202,30,1,'Arial','B',6,190,8,"$ ".number_format($keyingresosAnterior['ia_total'],2,'.',','),'R');
}else{
$pdf->multicelda(79,202,30,1,'Arial','B',6,190,8,"-",'R');
}
/* -----------------------------INGRESOS --------------------------------------- */

/* -----------------------------EGRESOS --------------------------------------- */
$egresosAnterior = $DAO->mostrarAll($conexion,"select * from ea_anuales_durante_anio_amortizar where cre_solic_id='$buscar' and ea_comentario='ANIOANTERIOR'");
foreach ($egresosAnterior as $keyegresosAnterior) {
	# code...
}
$pdf->leyendas(115,85,'Arial','',6,190,8,'Gastos del Hogar');
$pdf->leyendas(135,85,'Arial','',6,190,8,'________________________');
if($keyegresosAnterior['ea_gastos_hogar_mensual']!="0.00" && $keyegresosAnterior['ea_gastos_hogar_mensual']!=""){
$pdf->multicelda(134,87,30,1,'Arial','B',6,190,8,"$ ".number_format($keyegresosAnterior['ea_gastos_hogar_mensual'],2,'.',','),'R');
}else{
$pdf->multicelda(134,87,30,1,'Arial','B',6,190,8,"-",'R');
}
$pdf->leyendas(169,85,'Arial','',6,190,8,'__________________________');
if($keyegresosAnterior['ea_gastos_hogar_anual']!="0.00" && $keyegresosAnterior['ea_gastos_hogar_anual']!=""){
$pdf->multicelda(170,87,30,1,'Arial','B',6,190,8,"$ ".number_format($keyegresosAnterior['ea_gastos_hogar_anual'],2,'.',','),'R');
}else{
$pdf->multicelda(170,87,30,1,'Arial','B',6,190,8,"-",'R');
}

$pdf->leyendas(115,90,'Arial','',6,190,8,'Costo de Produccion Agricola');
$pdf->leyendas(169,90,'Arial','',6,190,8,'__________________________');
if($keyegresosAnterior['ea_costo_prod_agricola']!="0.00" && $keyegresosAnterior['ea_costo_prod_agricola']!=""){
$pdf->multicelda(170,92,30,1,'Arial','B',6,190,8,"$ ".number_format($keyegresosAnterior['ea_costo_prod_agricola'],2,'.',','),'R');
}else{
$pdf->multicelda(170,92,30,1,'Arial','B',6,190,8,"-",'R');
}

$pdf->leyendas(115,95,'Arial','',6,190,8,'Maiz');
$pdf->leyendas(130,95,'Arial','',6,190,8,'____________________________ Msz.');
if($keyegresosAnterior['ea_costos_maiz_mzs']!="0.00" && $keyegresosAnterior['ea_costos_maiz_mzs']!=""){
$pdf->multicelda(134,97,30,1,'Arial','B',6,190,8,number_format($keyegresosAnterior['ea_costos_maiz_mzs'],2,'.',','),'R');
}else{
$pdf->multicelda(134,97,30,1,'Arial','B',6,190,8,"-",'R');
}
$pdf->leyendas(169,95,'Arial','',6,190,8,'__________________________');
if($keyegresosAnterior['ea_costos_maiz_anual']!="0.00" && $keyegresosAnterior['ea_costos_maiz_anual']!=""){
$pdf->multicelda(170,97,30,1,'Arial','B',6,190,8,"$ ".number_format($keyegresosAnterior['ea_costos_maiz_anual'],2,'.',','),'R');
}else{
$pdf->multicelda(170,97,30,1,'Arial','B',6,190,8,"-",'R');
}

$pdf->leyendas(115,100,'Arial','',6,190,8,'Arroz');
$pdf->leyendas(130,100,'Arial','',6,190,8,'____________________________ Msz.');
if($keyegresosAnterior['ea_costos_arroz_mzs']!="0.00" && $keyegresosAnterior['ea_costos_arroz_mzs']!=""){
$pdf->multicelda(134,102,30,1,'Arial','B',6,190,8,number_format($keyegresosAnterior['ea_costos_arroz_mzs'],2,'.',','),'R');
}else{
$pdf->multicelda(134,102,30,1,'Arial','B',6,190,8,'-','R');
}
$pdf->leyendas(169,100,'Arial','',6,190,8,'__________________________');
if($keyegresosAnterior['ea_costos_arroz_anual']!="0.00" && $keyegresosAnterior['ea_costos_arroz_anual']!=""){
$pdf->multicelda(170,102,30,1,'Arial','B',6,190,8,"$ ".number_format($keyegresosAnterior['ea_costos_arroz_anual'],2,'.',','),'R');
}else{
$pdf->multicelda(170,102,30,1,'Arial','B',6,190,8,"-",'R');
}

$pdf->leyendas(115,105,'Arial','',6,190,8,'Maicillo');
$pdf->leyendas(130,105,'Arial','',6,190,8,'____________________________ Msz.');
if($keyegresosAnterior['ea_costos_maicillo_mzs']!="0.00" && $keyegresosAnterior['ea_costos_maicillo_mzs']!=""){
$pdf->multicelda(134,107,30,1,'Arial','B',6,190,8,number_format($keyegresosAnterior['ea_costos_maicillo_mzs'],2,'.',','),'R');
}else{
$pdf->multicelda(134,107,30,1,'Arial','B',6,190,8,"-",'R');
}
$pdf->leyendas(169,105,'Arial','',6,190,8,'__________________________');
if($keyegresosAnterior['ea_costos_maicillo_anual']!="0.00" && $keyegresosAnterior['ea_costos_maicillo_anual']!=""){
$pdf->multicelda(170,107,30,1,'Arial','B',6,190,8,"$ ".number_format($keyegresosAnterior['ea_costos_maicillo_anual'],2,'.',','),'R');
}else{
$pdf->multicelda(170,107,30,1,'Arial','B',6,190,8,"-",'R');
}

$pdf->leyendas(115,110,'Arial','',6,190,8,'Frijol');
$pdf->leyendas(130,110,'Arial','',6,190,8,'____________________________ Msz.');
if($keyegresosAnterior['ea_costos_frijol_mzs']!="0.00" && $keyegresosAnterior['ea_costos_frijol_mzs']!=""){
$pdf->multicelda(134,112,30,1,'Arial','B',6,190,8,number_format($keyegresosAnterior['ea_costos_frijol_mzs'],2,'.',','),'R');
}else{
$pdf->multicelda(134,112,30,1,'Arial','B',6,190,8,"-",'R');
}
$pdf->leyendas(169,110,'Arial','',6,190,8,'__________________________');
if($keyegresosAnterior['ea_costos_frijol_anual']!="0.00" && $keyegresosAnterior['ea_costos_frijol_anual']!=""){
$pdf->multicelda(170,112,30,1,'Arial','B',6,190,8,"$ ".number_format($keyegresosAnterior['ea_costos_frijol_anual'],2,'.',','),'R');
}else{
$pdf->multicelda(170,112,30,1,'Arial','B',6,190,8,"-",'R');
}

$pdf->leyendas(115,115,'Arial','',6,190,8,'Café');
$pdf->leyendas(130,115,'Arial','',6,190,8,'____________________________ Msz.');
if($keyegresosAnterior['ea_costos_cafe_mzs']!="0.00" && $keyegresosAnterior['ea_costos_cafe_mzs']!=""){
$pdf->multicelda(134,117,30,1,'Arial','B',6,190,8,number_format($keyegresosAnterior['ea_costos_cafe_mzs'],2,'.',','),'R');
}else{
$pdf->multicelda(134,117,30,1,'Arial','B',6,190,8,"-",'R');
}
$pdf->leyendas(169,115,'Arial','',6,190,8,'__________________________');
if($keyegresosAnterior['ea_costos_cafe_anual']!="0.00" && $keyegresosAnterior['ea_costos_cafe_anual']!=""){
$pdf->multicelda(170,117,30,1,'Arial','B',6,190,8,"$ ".number_format($keyegresosAnterior['ea_costos_cafe_anual'],2,'.',','),'R');
}else{
$pdf->multicelda(170,117,30,1,'Arial','B',6,190,8,"-",'R');
}

$pdf->leyendas(115,120,'Arial','',6,190,8,'Caña');
$pdf->leyendas(130,120,'Arial','',6,190,8,'____________________________ Msz.');
if($keyegresosAnterior['ea_costos_cania_mzs']!="0.00" && $keyegresosAnterior['ea_costos_cania_mzs']!=""){
$pdf->multicelda(134,122,30,1,'Arial','B',6,190,8,number_format($keyegresosAnterior['ea_costos_cania_mzs'],2,'.',','),'R');
}else{
$pdf->multicelda(134,122,30,1,'Arial','B',6,190,8,"-",'R');
}
$pdf->leyendas(169,120,'Arial','',6,190,8,'__________________________');
if($keyegresosAnterior['ea_costos_cania_anual']!="0.00" && $keyegresosAnterior['ea_costos_cania_anual']!=""){
$pdf->multicelda(170,122,30,1,'Arial','B',6,190,8,"$ ".number_format($keyegresosAnterior['ea_costos_cania_anual'],2,'.',','),'R');
}else{
$pdf->multicelda(170,122,30,1,'Arial','B',6,190,8,"-",'R');
}

$pdf->leyendas(115,125,'Arial','',6,190,8,'Algodón');
$pdf->leyendas(130,125,'Arial','',6,190,8,'____________________________ Msz.');
if($keyegresosAnterior['ea_costos_algodon_mzs']!="0.00" && $keyegresosAnterior['ea_costos_algodon_mzs']!=""){
$pdf->multicelda(134,127,30,1,'Arial','B',6,190,8,number_format($keyegresosAnterior['ea_costos_algodon_mzs'],2,'.',','),'R');
}else{
$pdf->multicelda(134,127,30,1,'Arial','B',6,190,8,"-",'R');
}
$pdf->leyendas(169,125,'Arial','',6,190,8,'__________________________');
if($keyegresosAnterior['ea_costos_algodon_anual']!="0.00" && $keyegresosAnterior['ea_costos_algodon_anual']!=""){
$pdf->multicelda(170,127,30,1,'Arial','B',6,190,8,"$ ".number_format($keyegresosAnterior['ea_costos_algodon_anual'],2,'.',','),'R');
}else{
$pdf->multicelda(170,127,30,1,'Arial','B',6,190,8,"-",'R');
}


$pdf->leyendas(130,130,'Arial','',6,190,8,'____________________________');
$pdf->leyendas(131,129,'Arial','',6,190,8,$keyegresosAnterior['ea_costos_otros_nombre']);
$pdf->leyendas(169,130,'Arial','',6,190,8,'__________________________');
if($keyegresosDurante['ea_costos_otros_anual']!="0.00" && $keyegresosDurante['ea_costos_otros_anual']!=""){
$pdf->multicelda(170,132,30,1,'Arial','B',6,190,8,"$ ".number_format($keyegresosDurante['ea_costos_otros_anual'],2,'.',','),'R');
}else{
$pdf->multicelda(170,132,30,1,'Arial','B',6,190,8,"-",'R');
}

$pdf->leyendas(130,135,'Arial','',6,190,8,'____________________________');
$pdf->leyendas(131,134,'Arial','',6,190,8,$keyegresosAnterior['ea_costos_otros_nombre2']);
$pdf->leyendas(169,135,'Arial','',6,190,8,'__________________________');
if($keyegresosAnterior['ea_costos_otros_anual2']!="0.00" && $keyegresosAnterior['ea_costos_otros_anual2']!=""){
$pdf->multicelda(170,137,30,1,'Arial','B',6,190,8,"$ ".number_format($keyegresosAnterior['ea_costos_otros_anual2'],2,'.',','),'R');
}else{
$pdf->multicelda(170,137,30,1,'Arial','B',6,190,8,"-",'R');
}

$pdf->leyendas(115,140,'Arial','',6,190,8,'Costo de Produccion Pecuaria');

$pdf->leyendas(115,145,'Arial','',6,190,8,'Costo de Prod.');
$pdf->leyendas(132,145,'Arial','',6,190,8,'__________________________ Bot.');
if($keyegresosAnterior['ea_costos_prod_leche_bot']!="0.00" && $keyegresosAnterior['ea_costos_prod_leche_bot']!=""){
$pdf->multicelda(134,147,30,1,'Arial','B',6,190,8,number_format($keyegresosAnterior['ea_costos_prod_leche_bot'],2,'.',','),'R');
}else{
$pdf->multicelda(134,147,30,1,'Arial','B',6,190,8,'-','R');
}
$pdf->leyendas(169,145,'Arial','',6,190,8,'__________________________');
if($keyegresosAnterior['ea_costos_prod_leche_anual']!="0.00" && $keyegresosAnterior['ea_costos_prod_leche_anual']!=""){
$pdf->multicelda(170,147,30,1,'Arial','B',6,190,8,"$ ".number_format($keyegresosAnterior['ea_costos_prod_leche_anual'],2,'.',','),'R');
}else{
$pdf->multicelda(170,147,30,1,'Arial','B',6,190,8,"-",'R');	
}

$pdf->leyendas(115,150,'Arial','',6,190,8,'Costos Queso');
$pdf->leyendas(132,150,'Arial','',6,190,8,'__________________________ Arr.');
if($keyegresosAnterior['ea_costos_prod_ganado_cab']!="0.00" && $keyegresosAnterior['ea_costos_prod_ganado_cab']!=""){
$pdf->multicelda(134,152,30,1,'Arial','B',6,190,8,number_format($keyegresosAnterior['ea_costos_prod_ganado_cab'],2,'.',','),'R');
}else{
$pdf->multicelda(134,152,30,1,'Arial','B',6,190,8,'-','R');
}
$pdf->leyendas(169,150,'Arial','',6,190,8,'__________________________');
if($keyegresosAnterior['ea_costos_prod_ganado_anual']!="0.00" && $keyegresosAnterior['ea_costos_prod_ganado_anual']!=""){
$pdf->multicelda(170,152,30,1,'Arial','B',6,190,8,"$ ".number_format($keyegresosAnterior['ea_costos_prod_ganado_anual'],2,'.',','),'R');
}else{
$pdf->multicelda(170,152,30,1,'Arial','B',6,190,8,"-",'R');
}

$pdf->leyendas(115,155,'Arial','',6,190,8,'Costos Prod.');
$pdf->leyendas(132,155,'Arial','',6,190,8,'__________________________ Cab.');
if($keyegresosAnterior['ea_costos_prod_ganado_cab']!="0.00" && $keyegresosAnterior['ea_costos_prod_ganado_cab']!=""){
$pdf->multicelda(134,157,30,1,'Arial','B',6,190,8,number_format($keyegresosAnterior['ea_costos_prod_ganado_cab'],2,'.',','),'R');
}else{
$pdf->multicelda(134,157,30,1,'Arial','B',6,190,8,"-",'R');
}
$pdf->leyendas(169,155,'Arial','',6,190,8,'__________________________');
if($keyegresosAnterior['ea_costos_prod_ganado_anual']!="0.00" && $keyegresosAnterior['ea_costos_prod_ganado_anual']!=""){
$pdf->multicelda(170,157,30,1,'Arial','B',6,190,8,"$ ".number_format($keyegresosAnterior['ea_costos_prod_ganado_anual'],2,'.',','),'R');
}else{
$pdf->multicelda(170,157,30,1,'Arial','B',6,190,8,"-",'R');
}

$pdf->leyendas(132,160,'Arial','',6,190,8,'__________________________');
$pdf->leyendas(133,159,'Arial','',6,190,8,$keyegresosAnterior['ea_costos_otros_prod_pecuario_nombre']);
$pdf->leyendas(169,160,'Arial','',6,190,8,'__________________________');
if($keyegresosAnterior['ea_costos_otros_prod_pecuario_anual']!="0.00" && $keyegresosAnterior['ea_costos_otros_prod_pecuario_anual']!=""){
$pdf->multicelda(170,162,30,1,'Arial','B',6,190,8,"$ ".number_format($keyegresosAnterior['ea_costos_otros_prod_pecuario_anual'],2,'.',','),'R');
}else{
$pdf->multicelda(170,162,30,1,'Arial','B',6,190,8,"-",'R');
}

$pdf->leyendas(115,165,'Arial','',6,190,8,'Gastos de Comercio');
$pdf->leyendas(169,165,'Arial','',6,190,8,'__________________________');
if($keyegresosAnterior['ea_gastos_de_comercio']!="0.00" && $keyegresosAnterior['ea_gastos_de_comercio']!=""){
$pdf->multicelda(170,167,30,1,'Arial','B',6,190,8,"$ ".number_format($keyegresosAnterior['ea_gastos_de_comercio'],2,'.',','),'R');
}else{
$pdf->multicelda(170,167,30,1,'Arial','B',6,190,8,"-",'R');
}

$pdf->leyendas(115,170,'Arial','',6,190,8,'Pago Prest Hipot.');
$pdf->leyendas(135,170,'Arial','',6,190,8,'________________________ ');
if($keyegresosAnterior['ea_pago_prest_hipo_mensual']!="0.00" && $keyegresosAnterior['ea_pago_prest_hipo_mensual']!=""){
$pdf->multicelda(134,172,30,1,'Arial','B',6,190,8,"$ ".number_format($keyegresosAnterior['ea_pago_prest_hipo_mensual'],2,'.',','),'R');
}else{
$pdf->multicelda(134,172,30,1,'Arial','B',6,190,8,"-",'R');
}
$pdf->leyendas(169,170,'Arial','',6,190,8,'__________________________');
if($keyegresosAnterior['ea_pago_prest_hipo_anual']!="0.00" && $keyegresosAnterior['ea_pago_prest_hipo_anual']!=""){
$pdf->multicelda(170,172,30,1,'Arial','B',6,190,8,"$ ".number_format($keyegresosAnterior['ea_pago_prest_hipo_anual'],2,'.',','),'R');
}else{
$pdf->multicelda(170,172,30,1,'Arial','B',6,190,8,"-",'R');
}

$pdf->leyendas(115,175,'Arial','',6,190,8,'Pago Prest Pers.');
$pdf->leyendas(135,175,'Arial','',6,190,8,'________________________ ');
if($keyegresosAnterior['ea_pago_prest_person_mensual']!="0.00" && $keyegresosAnterior['ea_pago_prest_person_mensual']!=""){
$pdf->multicelda(134,177,30,1,'Arial','B',6,190,8,"$ ".number_format($keyegresosAnterior['ea_pago_prest_person_mensual'],2,'.',','),'R');
}else{
$pdf->multicelda(134,177,30,1,'Arial','B',6,190,8,"-",'R');
}
$pdf->leyendas(169,175,'Arial','',6,190,8,'__________________________');
if($keyegresosAnterior['ea_pago_prest_person_anual']!="0.00" && $keyegresosAnterior['ea_pago_prest_person_anual']!=""){
$pdf->multicelda(170,177,30,1,'Arial','B',6,190,8,"$ ".number_format($keyegresosAnterior['ea_pago_prest_person_anual'],2,'.',','),'R');
}else{
$pdf->multicelda(170,177,30,1,'Arial','B',6,190,8,"-",'R');
}

$pdf->leyendas(115,180,'Arial','',6,190,8,'Otras Deudas');
$pdf->leyendas(135,180,'Arial','',6,190,8,'________________________ ');
if($keyegresosAnterior['ea_otras_deudas_mensul']!="0.00" && $keyegresosAnterior['ea_otras_deudas_mensul']!=""){
$pdf->multicelda(134,182,30,1,'Arial','B',6,190,8,"$ ".number_format($keyegresosAnterior['ea_otras_deudas_mensul'],2,'.',','),'R');
}else{
$pdf->multicelda(134,182,30,1,'Arial','B',6,190,8,"-",'R');
}
$pdf->leyendas(169,180,'Arial','',6,190,8,'__________________________');
if($keyegresosAnterior['ea_otras_deudas_anual']!="0.00" && $keyegresosAnterior['ea_otras_deudas_anual']!=""){
$pdf->multicelda(170,182,30,1,'Arial','B',6,190,8,"$ ".number_format($keyegresosAnterior['ea_otras_deudas_anual'],2,'.',','),'R');
}else{
$pdf->multicelda(170,182,30,1,'Arial','B',6,190,8,"-",'R');
}

$pdf->leyendas(115,185,'Arial','',6,190,8,'Desc. de Ley');
$pdf->leyendas(135,185,'Arial','',6,190,8,'________________________ ');
if($keyegresosAnterior['ea_desc_de_ley_mensual']!="0.00" && $keyegresosAnterior['ea_desc_de_ley_mensual']!=""){
$pdf->multicelda(134,187,30,1,'Arial','B',6,190,8,"$ ".number_format($keyegresosAnterior['ea_desc_de_ley_mensual'],2,'.',','),'R');
}else{
$pdf->multicelda(134,187,30,1,'Arial','B',6,190,8,"-",'R');
}
$pdf->leyendas(169,185,'Arial','',6,190,8,'__________________________');
if($keyegresosAnterior['ea_desc_de_ley_anual']!="0.00" && $keyegresosAnterior['ea_desc_de_ley_anual']!=""){
$pdf->multicelda(170,187,30,1,'Arial','B',6,190,8,"$ ".number_format($keyegresosAnterior['ea_desc_de_ley_anual'],2,'.',','),'R');
}else{
$pdf->multicelda(170,187,30,1,'Arial','B',6,190,8,"-",'R');
}

$pdf->leyendas(115,190,'Arial','',6,190,8,'Pago Prestamo Solic.');
$pdf->leyendas(138,190,'Arial','',6,190,8,'______________________');
if($keyegresosAnterior['ea_pago_prestamo_solic_mensual']!="0.00" && $keyegresosAnterior['ea_pago_prestamo_solic_mensual']!=""){
$pdf->multicelda(134,192,30,1,'Arial','B',6,190,8,"$ ".number_format($keyegresosAnterior['ea_pago_prestamo_solic_mensual'],2,'.',','),'R');
}else{
$pdf->multicelda(134,192,30,1,'Arial','B',6,190,8,"-",'R');
}
$pdf->leyendas(169,190,'Arial','',6,190,8,'__________________________');
if($keyegresosAnterior['ea_pago_prestamo_solic_anual']!="0.00" && $keyegresosAnterior['ea_pago_prestamo_solic_anual']!=""){
$pdf->multicelda(170,192,30,1,'Arial','B',6,190,8,"$ ".number_format($keyegresosAnterior['ea_pago_prestamo_solic_anual'],2,'.',','),'R');
}else{
$pdf->multicelda(170,192,30,1,'Arial','B',6,190,8,"-",'R');
}

$pdf->leyendas(115,195,'Arial','',6,190,8,'Interes');
$pdf->leyendas(169,195,'Arial','',6,190,8,'__________________________');
if($keyegresosAnterior['ea_intereses_anuales']!="0.00" && $keyegresosAnterior['ea_intereses_anuales']!=""){
$pdf->multicelda(170,197,30,1,'Arial','B',6,190,8,"$ ".number_format($keyegresosAnterior['ea_intereses_anuales'],2,'.',','),'R');
}else{
$pdf->multicelda(170,197,30,1,'Arial','B',6,190,8,"-",'R');
}

$pdf->leyendas(115,200,'Arial','',6,190,8,'Comisiones');
$pdf->leyendas(169,200,'Arial','',6,190,8,'__________________________');
if($keyegresosAnterior['ea_comisiones_anuales']!="0.00" && $keyegresosAnterior['ea_comisiones_anuales']!=""){
$pdf->multicelda(170,202,30,1,'Arial','B',6,190,8,"$ ".number_format($keyegresosAnterior['ea_comisiones_anuales'],2,'.',','),'R');
}else{
$pdf->multicelda(170,202,30,1,'Arial','B',6,190,8,"-",'R');
}

$pdf->leyendas(115,205,'Arial','',6,190,8,'Impuestos');
$pdf->leyendas(169,205,'Arial','',6,190,8,'__________________________');
if($keyegresosAnterior['ea_impuestos_anuales']!="0.00" && $keyegresosAnterior['ea_impuestos_anuales']!=""){
$pdf->multicelda(170,207,30,1,'Arial','B',6,190,8,"$ ".number_format($keyegresosAnterior['ea_impuestos_anuales'],2,'.',','),'R');
}else{
$pdf->multicelda(170,207,30,1,'Arial','B',6,190,8,"-",'R');
}

$pdf->leyendas(115,210,'Arial','',6,190,8,'Inversion Crédito');
$pdf->leyendas(135,210,'Arial','',6,190,8,'________________________ ');
$pdf->leyendas(133,209,'Arial','',6,190,8,$keyegresosAnterior['ea_inversion_credito_nombre1']);
$pdf->leyendas(169,210,'Arial','',6,190,8,'__________________________');
if($keyegresosAnterior['ea_inversion_credito_anual1']!="0.00" && $keyegresosAnterior['ea_inversion_credito_anual1']!=""){
$pdf->multicelda(170,212,30,1,'Arial','B',6,190,8,"$ ".number_format($keyegresosAnterior['ea_inversion_credito_anual1'],2,'.',','),'R');
}else{
$pdf->multicelda(170,212,30,1,'Arial','B',6,190,8,"-",'R');
}
/********************************************************************************/
$pdf->leyendas(115,215,'Arial','',7,190,8,'____________________________________ ');
$pdf->leyendas(133,214,'Arial','',6,190,8,$keyegresosAnterior['ea_inversion_credito_nombre2']);
$pdf->leyendas(169,215,'Arial','',7,190,8,'______________________');
if($keyegresosAnterior['ea_inversion_credito_anual2']!="0.00" && $keyegresosAnterior['ea_inversion_credito_anual2']!=""){
$pdf->multicelda(170,217,30,1,'Arial','B',6,190,8,"$ ".number_format($keyegresosAnterior['ea_inversion_credito_anual2'],2,'.',','),'R');
}else{
	$pdf->multicelda(170,217,30,1,'Arial','B',6,190,8,"-",'R');
}

$pdf->leyendas(115,220,'Arial','',7,190,8,'____________________________________ ');
$pdf->leyendas(133,234,'Arial','',6,190,8,$keyegresosAnterior['ea_inversion_credito_nombre3']);
$pdf->leyendas(169,220,'Arial','',7,190,8,'______________________');
if($keyegresosAnterior['ea_inversion_credito_anual3']!="0.00" && $keyegresosAnterior['ea_inversion_credito_anual3']!=""){
$pdf->multicelda(170,222,30,1,'Arial','B',6,190,8,"$ ".number_format($keyegresosAnterior['ea_inversion_credito_anual3'],2,'.',','),'R');
}else{
$pdf->multicelda(170,222,30,1,'Arial','B',6,190,8,"-",'R');
}

$pdf->leyendas(75,225,'Arial','',6,190,8,'EXCEDENTE NETO ANUAL ');
$pdf->leyendas(115,225,'Arial','',6,190,8,'______________________');
if(($keyingresosAnterior['ia_total']-$keyegresosAnterior['ea_total'])!="0.00"){
$pdf->multicelda(116,227,25,1,'Arial','B',6,190,8,"$ ".number_format(($keyingresosAnterior['ia_total']-$keyegresosAnterior['ea_total']),2,'.',','),'R');
}else{
$pdf->multicelda(116,227,25,1,'Arial','B',6,190,8,'-','R');	
}
$pdf->leyendas(150,225,'Arial','',6,190,8,'TOTAL ');
$pdf->leyendas(169,225,'Arial','',6,190,8,'__________________________');
if($keyegresosAnterior['ea_total']!="0.00" && $keyegresosAnterior['ea_total']!=""){
$pdf->multicelda(170,227,30,1,'Arial','B',6,190,8,"$ ".number_format($keyegresosAnterior['ea_total'],2,'.',','),'R');
}else{
$pdf->multicelda(170,227,30,1,'Arial','B',6,190,8,"-",'R');
}
$pdf->leyendas(12,227,'Arial','',6,190,8,'_______________________________________________________________________________________________________________________________________________________________________');
$estadoF = $DAO->mostrarAll($conexion,"select * from estado_financiero_solicitante where cre_solic_id='$buscar' ");
foreach ($estadoF as $keyestadoF) {
	# code...
}

$pdf->leyendas(12,231,'Arial','',7,190,8,'P. INFORME DEL ESTADO FINANCIERO DEL SOLICITANTE AL');
$pdf->leyendas(102,231,'Arial','',7,190,8,'__________');
$pdf->leyendas(107,230,'Arial','',7,190,8,$keyestadoF['ef_fecha_dia']);
$pdf->leyendas(118,230,'Arial','',7,190,8,'DE');
$pdf->leyendas(122,231,'Arial','',7,190,8,'________________________________');
$pdf->leyendas(138,230,'Arial','',7,190,8,$keyestadoF['ef_fecha_mes']);
$pdf->leyendas(168,230,'Arial','',7,190,8,'DE');
$pdf->leyendas(173,231,'Arial','',7,190,8,'______________');
$pdf->leyendas(178,230,'Arial','',7,190,8,$keyestadoF['ef_fecha_anio']);

$pdf->leyendas(40,235,'Arial','B',7,190,8,'ACTIVO');
$pdf->leyendas(135,235,'Arial','B',7,190,8,'PASIVO');

$pdf->leyendas(12,238,'Arial','',7,190,8,'Dinero en Efectivo');
$pdf->leyendas(69,238,'Arial','',6,190,8,'______________________');
if($keyestadoF['ef_act_dinero_efectivo']!="0.00" && $keyestadoF['ef_act_dinero_efectivo']!=""){
$pdf->multicelda(70,241,26,1,'Arial','B',7,190,8,"$ ".number_format($keyestadoF['ef_act_dinero_efectivo'],2,'.',','),'R');
}else{
$pdf->multicelda(70,241,26,1,'Arial','B',7,190,8,"-",'R');
}
$pdf->leyendas(12,242,'Arial','',7,190,8,'Dinero en Bancos');
$pdf->leyendas(69,242,'Arial','',6,190,8,'______________________');
if($keyestadoF['ef_act_dinero_bancos']!="0.00" && $keyestadoF['ef_act_dinero_bancos']!=""){
$pdf->multicelda(70,245,26,1,'Arial','B',7,190,8,"$ ".number_format($keyestadoF['ef_act_dinero_bancos'],2,'.',','),'R');
}else{
$pdf->multicelda(70,245,26,1,'Arial','B',7,190,8,"-",'R');
}
$pdf->leyendas(12,246,'Arial','',7,190,8,'Bonos o Acciones');
$pdf->leyendas(69,246,'Arial','',6,190,8,'______________________');
if($keyestadoF['ef_act_bonos_acciones']!="0.00" && $keyestadoF['ef_act_bonos_acciones']!=""){
$pdf->multicelda(70,249,26,1,'Arial','B',7,190,8,"$ ".number_format($keyestadoF['ef_act_bonos_acciones'],2,'.',','),'R');
}else{
$pdf->multicelda(70,249,26,1,'Arial','B',7,190,8,"-",'R');
}
$pdf->leyendas(12,250,'Arial','',7,190,8,'Inmuebles Rurales Inscritos Msz.');
$pdf->leyendas(69,250,'Arial','',6,190,8,'______________________');
if($keyestadoF['ef_act_inmuebles_rurales_inscritos']!="0.00" && $keyestadoF['ef_act_inmuebles_rurales_inscritos']!=""){
$pdf->multicelda(70,253,26,1,'Arial','B',7,190,8,"$ ".number_format($keyestadoF['ef_act_inmuebles_rurales_inscritos'],2,'.',','),'R');
}else{
$pdf->multicelda(70,253,26,1,'Arial','B',7,190,8,"-",'R');
}
$pdf->leyendas(12,254,'Arial','',7,190,8,'Inmuebles Rurales No Inscritos Msz.');
$pdf->leyendas(69,254,'Arial','',6,190,8,'______________________');
if($keyestadoF['ef_act_inmuebles_rurales_no_inscritos']!="0.00" && $keyestadoF['ef_act_inmuebles_rurales_no_inscritos']!=""){
$pdf->multicelda(70,257,26,1,'Arial','B',7,190,8,"$ ".number_format($keyestadoF['ef_act_inmuebles_rurales_no_inscritos'],2,'.',','),'R');
}else{
$pdf->multicelda(70,257,26,1,'Arial','B',7,190,8,"-",'R');
}
$pdf->leyendas(12,258,'Arial','',7,190,8,'Inmuebles Urbanos');
$pdf->leyendas(69,258,'Arial','',6,190,8,'______________________');
if($keyestadoF['ef_act_inmuebles_urbanos']!="0.00" && $keyestadoF['ef_act_inmuebles_urbanos']!=""){
$pdf->multicelda(70,261,26,1,'Arial','B',7,190,8,"$ ".number_format($keyestadoF['ef_act_inmuebles_urbanos'],2,'.',','),'R');
}else{
$pdf->multicelda(70,261,26,1,'Arial','B',7,190,8,"-",'R');
}
$pdf->leyendas(12,262,'Arial','',7,190,8,'Existencia de Productos');
$pdf->leyendas(69,262,'Arial','',6,190,8,'______________________');
if($keyestadoF['ef_act_existencia_productos']!="0.00" && $keyestadoF['ef_act_existencia_productos']!=""){
$pdf->multicelda(70,265,26,1,'Arial','B',7,190,8,"$ ".number_format($keyestadoF['ef_act_existencia_productos'],2,'.',','),'R');
}else{
$pdf->multicelda(70,265,26,1,'Arial','B',7,190,8,"-",'R');
}
$pdf->leyendas(12,266,'Arial','',7,190,8,'Cuentas por Cobrar');
$pdf->leyendas(69,266,'Arial','',6,190,8,'______________________');
if($keyestadoF['ef_act_cuentas_por_cobrar']!="0.00" && $keyestadoF['ef_act_cuentas_por_cobrar']!=""){
$pdf->multicelda(70,269,26,1,'Arial','B',7,190,8,"$ ".number_format($keyestadoF['ef_act_cuentas_por_cobrar'],2,'.',','),'R');
}else{
$pdf->multicelda(70,269,26,1,'Arial','B',7,190,8,"-",'R');
}
$pdf->leyendas(12,270,'Arial','',7,190,8,'Muebles del Hogar');
$pdf->leyendas(69,270,'Arial','',6,190,8,'______________________');
if($keyestadoF['ef_act_muebles_hogar']!="0.00" && $keyestadoF['ef_act_muebles_hogar']!=""){
$pdf->multicelda(70,273,26,1,'Arial','B',7,190,8,"$ ".number_format($keyestadoF['ef_act_muebles_hogar'],2,'.',','),'R');
}else{
$pdf->multicelda(70,273,26,1,'Arial','B',7,190,8,"-",'R');
}
$pdf->leyendas(12,274,'Arial','',7,190,8,'Vehiculos');
$pdf->leyendas(30,274,'Arial','',6,190,8,'_____________________________');
$pdf->leyendas(31,274,'Arial','B',7,190,8,$keyestadoF['ef_act_vehiculos_descripcion']);
$pdf->leyendas(69,274,'Arial','',6,190,8,'______________________');
if($keyestadoF['ef_act_vehiculos_costo']!="0.00" && $keyestadoF['ef_act_vehiculos_costo']!=""){
$pdf->multicelda(70,277,26,1,'Arial','B',7,190,8,"$ ".number_format($keyestadoF['ef_act_vehiculos_costo'],2,'.',','),'R');
}else{
$pdf->multicelda(70,277,26,1,'Arial','B',7,190,8,"-",'R');
}
$pdf->leyendas(12,278,'Arial','',7,190,8,'Maquinaria');
$pdf->leyendas(30,278,'Arial','',6,190,8,'_____________________________');
$pdf->leyendas(31,278,'Arial','',6,190,8,$keyestadoF['ef_act_maquinaria_descripcion']);
$pdf->leyendas(69,278,'Arial','',6,190,8,'______________________');
if($keyestadoF['ef_act_maquinaria_costo']!="0.00" && $keyestadoF['ef_act_maquinaria_costo']!=""){
$pdf->multicelda(70,281,26,1,'Arial','B',7,190,8,"$ ".number_format($keyestadoF['ef_act_maquinaria_costo'],2,'.',','),'R');
}else{
$pdf->multicelda(70,281,26,1,'Arial','B',7,190,8,"-",'R');
}
$pdf->leyendas(12,282,'Arial','',7,190,8,'Ganado');
$pdf->leyendas(30,282,'Arial','',6,190,8,'_____________________________');
$pdf->leyendas(31,282,'Arial','',6,190,8,$keyestadoF['ef_act_ganado_descripcion']);
$pdf->leyendas(69,282,'Arial','',6,190,8,'______________________');
if($keyestadoF['ef_act_ganado_costo']!="0.00" && $keyestadoF['ef_act_ganado_costo']!=""){
$pdf->multicelda(70,285,26,1,'Arial','B',7,190,8,"$ ".number_format($keyestadoF['ef_act_ganado_costo'],2,'.',','),'R');
}else{
$pdf->multicelda(70,285,26,1,'Arial','B',7,190,8,"-",'R');
}
$pdf->leyendas(12,287,'Arial','',7,190,8,'TOTAL');
$pdf->leyendas(69,287,'Arial','',6,190,8,'______________________');
if($keyestadoF['ef_act_total']!="0.00" && $keyestadoF['ef_act_total']!=""){
$pdf->multicelda(70,290,26,1,'Arial','B',7,190,8,"$ ".number_format($keyestadoF['ef_act_total'],2,'.',','),'R');
}else{
$pdf->multicelda(70,290,26,1,'Arial','B',7,190,8,"-",'R');
}

$pdf->leyendas(107,238,'Arial','',7,190,8,'Deudas Hipotecarias');
$pdf->leyendas(155,238,'Arial','',6,190,8,'______________________');
if($keyestadoF['ef_pas_deudas_hipotecarias']!="0.00" && $keyestadoF['ef_pas_deudas_hipotecarias']!=""){
$pdf->multicelda(156,241,26,1,'Arial','B',7,190,8,"$ ".number_format($keyestadoF['ef_pas_deudas_hipotecarias'],2,'.',','),'R');
}else{
$pdf->multicelda(156,241,26,1,'Arial','B',7,190,8,"-",'R');
}
$pdf->leyendas(107,242,'Arial','',7,190,8,'Deudas Personales');
$pdf->leyendas(155,242,'Arial','',6,190,8,'______________________');
if($keyestadoF['ef_pas_deudas_personales']!="0.00" && $keyestadoF['ef_pas_deudas_personales']!=""){
$pdf->multicelda(156,245,26,1,'Arial','B',7,190,8,"$ ".number_format($keyestadoF['ef_pas_deudas_personales'],2,'.',','),'R');
}else{
$pdf->multicelda(156,245,26,1,'Arial','B',7,190,8,"-",'R');
}
$pdf->leyendas(107,246,'Arial','',7,190,8,'Prestamos Agricolas');
$pdf->leyendas(155,246,'Arial','',6,190,8,'______________________');
if($keyestadoF['ef_pas_prestamos_agricolas']!="0.00" && $keyestadoF['ef_pas_prestamos_agricolas']!=""){
$pdf->multicelda(156,249,26,1,'Arial','B',7,190,8,"$ ".number_format($keyestadoF['ef_pas_prestamos_agricolas'],2,'.',','),'R');
}else{
$pdf->multicelda(156,249,26,1,'Arial','B',7,190,8,"-",'R');
}
$pdf->leyendas(107,250,'Arial','',7,190,8,'Deudas por Vehículo');
$pdf->leyendas(155,250,'Arial','',6,190,8,'______________________');
if($keyestadoF['ef_pas_deudas_por_vehiculo']!="0.00" && $keyestadoF['ef_pas_deudas_por_vehiculo']!=""){
$pdf->multicelda(156,253,26,1,'Arial','B',7,190,8,"$ ".number_format($keyestadoF['ef_pas_deudas_por_vehiculo'],2,'.',','),'R');
}else{
$pdf->multicelda(156,253,26,1,'Arial','B',7,190,8,"-",'R');
}
$pdf->leyendas(107,254,'Arial','',7,190,8,'Deudas Compra Maquinaria');
$pdf->leyendas(155,254,'Arial','',6,190,8,'______________________');
if($keyestadoF['ef_pas_deudas_compra_maquinaria']!="0.00" && $keyestadoF['ef_pas_deudas_compra_maquinaria']!=""){
$pdf->multicelda(156,257,26,1,'Arial','B',7,190,8,"$ ".number_format($keyestadoF['ef_pas_deudas_compra_maquinaria'],2,'.',','),'R');
}else{
$pdf->multicelda(156,257,26,1,'Arial','B',7,190,8,"-",'R');
}
$pdf->leyendas(107,258,'Arial','',7,190,8,'Deudas con Proveedores');
$pdf->leyendas(155,258,'Arial','',6,190,8,'______________________');
if($keyestadoF['ef_pas_deudas_con_proveedores']!="0.00" && $keyestadoF['ef_pas_deudas_con_proveedores']!=""){
$pdf->multicelda(156,261,26,1,'Arial','B',7,190,8,"$ ".number_format($keyestadoF['ef_pas_deudas_con_proveedores'],2,'.',','),'R');
}else{
$pdf->multicelda(156,261,26,1,'Arial','B',7,190,8,"-",'R');
}
$pdf->leyendas(107,262,'Arial','',7,190,8,'Otras Deudas');
$pdf->leyendas(155,262,'Arial','',6,190,8,'______________________');
if($keyestadoF['ef_pas_otras_deudas']!="0.00" && $keyestadoF['ef_pas_otras_deudas']!=""){
$pdf->multicelda(156,265,26,1,'Arial','B',7,190,8,"$ ".number_format($keyestadoF['ef_pas_otras_deudas'],2,'.',','),'R');
}else{
$pdf->multicelda(156,265,26,1,'Arial','B',7,190,8,"-",'R');
}
$pdf->leyendas(107,270,'Arial','',7,190,8,'SUB TOTAL');
$pdf->leyendas(155,270,'Arial','',6,190,8,'______________________');
if($keyestadoF['ef_pas_subtotal']!="0.00" && $keyestadoF['ef_pas_subtotal']!=""){
$pdf->multicelda(156,273,26,1,'Arial','B',7,190,8,"$ ".number_format($keyestadoF['ef_pas_subtotal'],2,'.',','),'R');
}else{
$pdf->multicelda(156,273,26,1,'Arial','B',7,190,8,"-",'R');
}
$pdf->leyendas(107,278,'Arial','',7,190,8,'CAPITAL LIQUIDO');
$pdf->leyendas(155,278,'Arial','',6,190,8,'______________________');
if($keyestadoF['ef_capital_liquido']!="0.00" && $keyestadoF['ef_capital_liquido']!=""){
$pdf->multicelda(156,281,26,1,'Arial','B',7,190,8,"$ ".number_format($keyestadoF['ef_capital_liquido'],2,'.',','),'R');
}else{
$pdf->multicelda(156,281,26,1,'Arial','B',7,190,8,"-",'R');
}
$pdf->leyendas(107,287,'Arial','',7,190,8,'TOTAL');
$pdf->leyendas(155,287,'Arial','',6,190,8,'______________________');
if($keyestadoF['ef_pas_total']!="0.00" && $keyestadoF['ef_pas_total']!=""){
$pdf->multicelda(156,290,26,1,'Arial','B',7,190,8,"$ ".number_format($keyestadoF['ef_pas_total'],2,'.',','),'R');
}else{
$pdf->multicelda(156,290,26,1,'Arial','B',7,190,8,"-",'R');
}

$pdf->leyendas(12,289,'Arial','',6,190,8,'_______________________________________________________________________________________________________________________________________________________________________');
$pdf->leyendas(12,293,'Arial','',7,190,8,'Q. INDICADORES FINANCIEROS');

$pdf->leyendas(12,297,'Arial','',7,190,8,'LIQUIDEZ');
$pdf->leyendas(30,297,'Arial','',7,190,8,'____________________________');
$pdf->multicelda(31,299,38,1,'Arial','B',7,190,8,number_format($keyestadoF['ef_ind_liquidez'],5,'.',','),'R');

$pdf->leyendas(75,297,'Arial','',7,190,8,'ENDEUDAMIENTO');
$pdf->leyendas(100,297,'Arial','',7,190,8,'____________________________');
$pdf->multicelda(101,299,38,1,'Arial','B',7,190,8,number_format($keyestadoF['ef_ind_endeudamiento'],5,'.',','),'R');

$pdf->leyendas(145,297,'Arial','',7,190,8,'SOLVENCIA');
$pdf->leyendas(160,297,'Arial','',7,190,8,'____________________________');
$pdf->multicelda(161,299,38,1,'Arial','B',7,190,8,number_format($keyestadoF['ef_ind_solvencia'],5,'.',','),'R');

/* -----------------------------EGRESOS --------------------------------------- */
$pdf->leyendas(12,302,'Arial','',7,100,8,'PROMOTOR:     '.$filaPromo[0]." ".$filaPromo[1]);
/*$pdf->leyendas(28,303,'Arial','',7,190,8,'___________________________________________________________________________________________________________');*/



$pdf->Output(); //Salida al navegador
?>