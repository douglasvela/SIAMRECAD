<blockquote>
  Seleccione un banco para generar la planilla
</blockquote>

<?php

$sql = base64_decode($_GET["sql"]);
$polis = base64_decode($_GET["polis"]);
$id_banco = $_GET["id_banco"];

$estruc = "";
$array = array();

$estructura = $this->db->query("SELECT * FROM vyp_estructura_planilla");
if($estructura->num_rows() > 0){
    foreach ($estructura->result() as $fila2) {              
   		$estruc .= $fila2->valor_campo.", ";
   		$buscada = explode(" AS ", $fila2->valor_campo);
   		array_push($array, $buscada[1]);
    }
}
$estruc = substr($estruc, 0,-2);

$consulta = "SELECT ".$estruc." FROM (".$sql.") AS p JOIN sir_empleado AS e ON p.nr = e.nr JOIN vyp_empleado_cuenta_banco AS ec ON ec.nr = p.nr AND ec.id_banco = '".$id_banco."' GROUP BY p.nr";

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
   					$resumen .= $correlativo.",";
   				}else{
   					if($otra == "no_poliza"){
   						$resumen .= "PAGO DE VIATICOS Y PASAJES POLIZAS ".$polis.",";
   					}else{
   						$resumen .= $fila3->$otra.",";
   					}
   				}
   			}
		}
    }
}

echo nl2br($resumen);


$banco_cual = "";
$cual_banco = $this->db->query("SELECT * FROM vyp_bancos WHERE id_banco = '".$id_banco."'");
if($cual_banco->num_rows() > 0){
    foreach ($cual_banco->result() as $filab) {              
   		$banco_cual = $filab->nombre;
    }
}


$nombre_archivo = "POLIZA ".$polis." ".$banco_cual.".txt";
$ruta = "assets/viaticos/polizas/";
 
    if(file_exists($nombre_archivo))
    {
        $mensaje = "El Archivo $nombre_archivo se ha modificado";
    }
 
    else
    {
        $mensaje = "El Archivo $nombre_archivo se ha creado";
    }
 
    if($archivo = fopen($ruta.$nombre_archivo, "w+"))
    {
        if(fwrite($archivo, $resumen."\r\n"))
        {
            echo "Se ha ejecutado correctamente";
        }
        else
        {
            echo "Ha habido un problema al crear el archivo";
        }
 
        fclose($archivo);
    }
?>

  </div>
</div>