<?php session_start();

include_once('PDF_Valuos.php');
$pdf = new PDF('P','mm','Letter');

$idval = $_GET['idval'];
$color = "green";

	include_once ("../modelo/Conexion.php");
        include_once ("../modelo/DAO.php");
        $conexions=new Conexion();
        $conexion=$conexions->conectar();
        $DAO=new DAO();
        
$datosperi = $DAO->mostrarAll($conexion,"select id_usuario_nombre from val_valuos where id_val_valuos='$idval'");
foreach ($datosperi as $keydatosperi) {
  # code...
}
$datosPerito = $DAO->mostrarAll($conexion,"select agencia,usuario_nombre from usuarios where usuario_id='$keydatosperi[0]'");
foreach ($datosPerito as $valuePerito) {}

$pdf->Setentidad(array($valuePerito[0]));
$pdf->SetUsuario(array($valuePerito[1]));
$pdf->Set_id_val_valuos(array($idval));


$dato=$DAO->mostrarAll($conexion,"select cli_codigo_cliente,val_ubicacion,latitud,longitud,val_comentario_ubicacion_maps,val_comentario_croquis,val_zoom_maps,val_type_maps from val_valuos where id_val_valuos='$idval'");
        foreach ($dato as $value) {
        	
        }
$datoU=$DAO->mostrarAll($conexion,"select cli_nombre_dui from clientes where cli_correlativo='$value[0]'");
        foreach ($datoU as $valueU) {
        	
        }
        $zoom2=($value['val_zoom_maps']);
        $typemap2 =($value['val_type_maps']);
$coordenadas = trim($value[2]).",".trim($value[3]);
//13.647196225690568,-88.78665447235107
$pdf->AddPage();
 $pdf->SetMargins(18,15,15);
$im1 = "https://maps.googleapis.com/maps/api/staticmap?center=".$coordenadas."&zoom=".$zoom."&size=760x380&maptype=".$typemap."&markers=color:".$color."%7Clabel:V%7C".$coordenadas."&key=AIzaSyAhDvBbtuSNTbZN460iRTPBICSnlHfFNeE";

$im = "https://maps.googleapis.com/maps/api/staticmap?zoom=".$zoom2."&size=760x380&maptype=".$typemap2."&markers=color:".$color."%7Clabel:%7C".$coordenadas."&key=AIzaSyAhDvBbtuSNTbZN460iRTPBICSnlHfFNeE";


//$pdf->leyendas(85,15,'Arial','B',10,135,8,"INFORME DE VALUACION");
$pdf->leyendas(17,30,'Arial','B',10,135,8,"SOLICITANTE: ");
$pdf->leyendas(50,30,'Arial','',10,135,8,($valueU[0]));
$pdf->leyendas(17,35,'Arial','B',10,135,8,"UBICACIÓN DEL INMUEBLE");
$pdf->SetWidths(array(180));
$pdf->SetAligns(array('J'));$pdf->SetDrawColor(255,255,255);
$pdf->Row(array(utf8_decode($value['val_comentario_ubicacion_maps'])),array('0'),array(array('Arial','','10')),false);
$pdf->Image($im,27,55,160,80,'PNG');


$ruta = "../../imagenes_valuos/".$idval; // Indicar ruta
//$ruta = "/html/imagenes_valuos/0001-32-00-1";
        if (is_dir($ruta)) {
             if ($filehandle = opendir($ruta)) {
               
                  while (false !== ($file = readdir($filehandle))) {
                     if ($file != "." && $file != "..") {
                        $tamanyo = getimagesize($ruta."/".$file);
                        $ext = $tamanyo['mime'];
                        $ext1 = explode('/',$ext);
                        $path = $ruta."/".$file;  
                    }
                  }
                
              }
$pdf->leyendas(17,137,'Arial','B',10,135,8,"CROQUIS DEL INMUEBLE");
$pdf->Row(array(utf8_decode($value['val_comentario_croquis'])),array('0'),array(array('Arial','','10')),false);
$pdf->Image($path,27,149,160,120,$ext1[1]);
        }




 $pdf->Output(); //Salida al navegador
?>