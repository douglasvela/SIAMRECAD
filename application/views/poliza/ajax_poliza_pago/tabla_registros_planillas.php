<br>
<?php

$sql = base64_decode($_GET["sql"]);
$polis = base64_decode($_GET["polis"]);
$id_banco = $_GET["id_banco"];

$estruc = "";
$array = array();

$estructura = $this->db->query("SELECT * FROM vyp_estructura_planilla WHERE id_banco = '".$id_banco."' ORDER BY orden");
if($estructura->num_rows() > 0){
    foreach ($estructura->result() as $fila2) {              
   		$estruc .= $fila2->valor_campo.", ";
   		$buscada = explode(" AS ", $fila2->valor_campo);
   		array_push($array, $buscada[1]);
    }
    $estruc = substr($estruc, 0,-2);
}


$banco_cual = ""; $delimitador = "";
    $cual_banco = $this->db->query("SELECT * FROM vyp_bancos WHERE id_banco = '".$id_banco."'");
    if($cual_banco->num_rows() > 0){
        foreach ($cual_banco->result() as $filab) {              
          $banco_cual = $filab->nombre;
          $delimitador = $filab->delimitador;

        }
    }

if($estruc != ""){

$consulta2 = "SELECT ".$estruc." FROM (".$sql.") AS p JOIN sir_empleado AS e ON p.nr = e.nr JOIN vyp_empleado_cuenta_banco AS ec ON ec.nr = p.nr AND ec.id_banco = '".$id_banco."' JOIN vyp_bancos AS b ON b.id_banco = ec.id_banco GROUP BY p.nr";

$planilla2 = $this->db->query($consulta2);

$count2 = count($array);
$planilla2->num_rows();
$correlativo = 0;
if($planilla2->num_rows() > 0){

  //$resumen2 .=  "<table style='font-size: 14px;'>";

  echo "<table class='table table-hover product-overview' style='font-size: 14px;'>";
  echo "<thead>";
  echo "<tr>";
  if($estructura->num_rows() > 0){
      foreach ($estructura->result() as $fila2) {
        echo "<th>";              
          echo $fila2->nombre_campo;
        echo "</th>";
      }
  }
  echo "</tr>";
  echo "</thead>";

  echo"<tbody>";

  //$resumen2 .="<tbody>";

    foreach ($planilla2->result() as $fila3) {
      $correlativo++;
      echo "<tr>";
      for ($i = 0; $i < $count2; $i++) {
        echo "<td>";
        $otra2 = $array[$i];
        if($i == ($count2-1)){
          if($otra2 == "correlativo"){
            echo $correlativo;
            $resumen2 .= $correlativo."\t";
          }else{
            if($otra2 == "no_poliza"){
              echo "PAGO DE VIATICOS Y PASAJES POLIZAS ".$polis;
              $resumen2 .= "PAGO DE VIATICOS Y PASAJES POLIZAS ".$polis."\t";
            }else{
              echo $fila3->$otra2;
              $resumen2 .= $fila3->$otra2."\t";
            }
          }
        }else{
          if($otra2 == "correlativo"){
            echo $correlativo;
            $resumen2 .= $correlativo."\t";
          }else{
            if($otra2 == "no_poliza"){
              echo "PAGO DE VIATICOS Y PASAJES POLIZAS ".$polis;
              $resumen2 .= "PAGO DE VIATICOS Y PASAJES POLIZAS ".$polis."\t";
            }else{
              echo str_replace( "," , "" , $fila3->$otra2);
              $resumen2 .= str_replace( "," , "" , $fila3->$otra2)."\t";
            }
          }
        }
        echo "</td>";
      }
      $resumen2 .= "\r\n";
      echo "</tr>";
  }
  echo "</table></tbody>";
  //$resumen2 .= "</table></tbody>";
}else{
  echo "<blockquote>Seleccione un banco para generar la planilla</blockquote>";
}

//echo $resumen2;

echo "<br>";




$consulta = "SELECT ".$estruc." FROM (".$sql.") AS p JOIN sir_empleado AS e ON p.nr = e.nr JOIN vyp_empleado_cuenta_banco AS ec ON ec.nr = p.nr AND ec.id_banco = '".$id_banco."' JOIN vyp_bancos AS b ON b.id_banco = ec.id_banco GROUP BY p.nr";

$planilla = $this->db->query($consulta);

$count = count($array);
$planilla->num_rows();
$correlativo = 0;
$resumen = "";
if($planilla->num_rows() > 0){
    foreach ($planilla->result() as $fila3) {
    	$correlativo++;
   		for ($i = 0; $i < $count; $i++) {
   			$otra = $array[$i];
   			if($i == ($count-1)){
   				if($otra == "correlativo"){
   					$resumen .= $correlativo."\r\n";
   				}else{
   					if($otra == "no_poliza"){
   						$resumen .= "PAGO DE VIATICOS Y PASAJES POLIZAS ".$polis."\r\n";
   					}else{
   						$resumen .= $fila3->$otra."\r\n";
   					}
   				}
   			}else{
   				if($otra == "correlativo"){
   					$resumen .= $correlativo.$delimitador;
   				}else{
   					if($otra == "no_poliza"){
   						$resumen .= "PAGO DE VIATICOS Y PASAJES POLIZAS ".$polis.",";
   					}else{
   						$resumen .= str_replace( "," , "" , $fila3->$otra).$delimitador;
   					}
   				}
   			}
		}
    }
}

}else{
  echo '<div class="alert alert-danger" style="width: 100%;">';
    echo '<h3 class="text-danger"><i class="fa fa-exclamation-triangle"></i> No se ha generado la estructura de la planilla para este banco</h3>';
    //echo '<h5 class="text-danger"><b>Por favor haga clic sobre el siguiente botón para </b></h5>';
  echo '</div>';
}

//echo nl2br($resumen);


    $nombre_archivo = "POLIZA ".$polis." ".$banco_cual;
    $nombre_archivo2 = "POLIZA ".$polis." ".$banco_cual;
    $ruta = "assets/viaticos/polizas/";
 
      /*if(file_exists($nombre_archivo)){
          $mensaje = "El Archivo $nombre_archivo se ha modificado";
      }else{
          $mensaje = "El Archivo $nombre_archivo se ha creado";
      }
 
      if($archivo = fopen($ruta.$nombre_archivo, "w+")){
          if(fwrite($archivo, $resumen."\r\n")){
              //echo "Se ha ejecutado correctamente";
          }else{
              //echo "Ha habido un problema al crear el archivo";
          }
          fclose($archivo);
      }*/

?>

<div class="pull-right" align="right">
<button type="button" onclick="generar_txt('<?php echo base64_encode($resumen); ?>', '<?php echo $nombre_archivo; ?>');" class="btn waves-effect waves-light btn-info"><span class="mdi mdi-file-document"></span>Exportar como .txt</button>
<button type="button" onclick="generar_excel('<?php echo base64_encode($resumen2); ?>', '<?php echo $nombre_archivo2; ?>');" class="btn waves-effect waves-light btn-info"><span class="mdi mdi-file-excel"></span>Exportar como .xlsx</button>
</div>

  </div>
</div>