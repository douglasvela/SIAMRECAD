<?php

$id_mision = $_GET["id_mision"];

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
                        <div class="round round-lg align-self-center round-info"><i class="<?php echo $icono; ?>"></i></div>
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