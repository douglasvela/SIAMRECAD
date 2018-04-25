<?php
    
$nr_usuario = $_GET["nr"];
$fecha1 = date("Y-m-d",strtotime($_GET["fecha"]));
//$fecha2 = date("Y-m-d",strtotime($_GET["fecha2"]));
//$id_mision = $_GET["id_mision"];

if(!empty($nr_usuario)){

    $info_empleado = $this->db->query("SELECT * FROM vyp_informacion_empleado WHERE nr = '".$nr_usuario."'");
    if($info_empleado->num_rows() > 0){ 

    	$sql = "SELECT vyp_pasajes.fecha_mision, vyp_pasajes.nr, vyp_mision_oficial.fecha_mision_inicio, vyp_mision_oficial.fecha_mision_fin FROM vyp_pasajes, vyp_mision_oficial where '".$fecha1."' BETWEEN vyp_mision_oficial.fecha_mision_inicio AND vyp_mision_oficial.fecha_mision_fin AND vyp_pasajes.nr='".$nr_usuario."' AND vyp_mision_oficial.nr_empleado='".$nr_usuario."'";

echo "<div id='fechas_repetidas' style='width: 100%;'>";

$fechas = $this->db->query($sql);
if($fechas->num_rows() > 0){
	echo '<div class="alert alert-warning" style="width: 100%;">';

	echo '<h3 class="text-warning">

	<i class="fa fa-exclamation-triangle">

	</i> Fecha(s) repetida(s) coinciden con la misión de viáticos</h3>';


	foreach ($fechas->result() as $filaf) {
		
    }
	echo '</div>';
						}

echo "</div>";
  
    }
}



?>