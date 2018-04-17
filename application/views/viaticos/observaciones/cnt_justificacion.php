<?php

$id_mision = $_GET["id_mision"];



$sql = "SELECT sv.* FROM vyp_mision_oficial AS sv JOIN vyp_pago_emergencia AS pe ON pe.nr = sv.nr_empleado AND pe.fecha_mision_inicio = sv.fecha_mision_inicio AND pe.fecha_mision_fin = sv.fecha_mision_fin";

echo "<div id='fechas_repetidas' style='width: 100%;'>";

$fechas = $this->db->query($sql);
if($fechas->num_rows() > 0){
    echo '<div class="alert alert-warning" style="width: 100%;">';
    echo '<h3 class="text-warning"><i class="fa fa-exclamation-triangle"></i> Se encontró pago en</h3>';
    foreach ($fechas->result() as $filaf) {
        echo $filaf->nombre_actividad."<br>";
    }
    echo '</div>';
}

echo "</div>";

function convertir2($fecha){
    return date("d/m/Y",strtotime($fecha))." - Horario no definido";
}






$justificaciones = $this->db->query("SELECT * FROM vyp_justificaciones WHERE id_mision = '".$id_mision."'");

    if($justificaciones->num_rows() > 0){ 
        foreach ($justificaciones->result() as $fila) {

        	$icono = "mdi mdi-file-hidden";

        	if($fila->extension == "jpg"){
				$icono = "mdi mdi-file-image";        		
        	}else if($fila->extension == "pdf"){
				$icono = "mdi mdi-file-pdf";        		
        	}

?>


		<div class="col-lg-4">
            <div class="card">
                <div class="card-body" >
	                	<a class="pull-right" style="font-size: 16px; cursor: pointer;" onclick="alerta_eliminar_justificacion('<?php echo $fila->id_justificacion; ?>','<?php echo $fila->ruta; ?>');"><i class="mdi mdi-window-close"></i></a>
                    <div class="d-flex flex-row">
                        <div class="round round-lg align-self-center round-info" data-toggle="tooltip" title="<?php echo $fila->nombre_real; ?>"><i class="<?php echo $icono; ?>"></i></div>
                        <div class="m-l-10 align-self-center">
                            <h4 class="m-b-0 font-light"><a href="<?php echo base_url().$fila->ruta; ?>" style="cursor: pointer;"><?php echo $fila->nombre; ?></a></h4>
                            <h6 class="text-muted m-b-0">Peso: <?php echo $fila->size; ?></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   

<?php
	}
}
?>