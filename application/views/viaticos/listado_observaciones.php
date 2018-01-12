<div class="card card-body">
    <h3 class="card-title">Lista de observaciones</h3>
    <div class="message-box">
        <div class="message-widget">

        	<?php 
        			$id_mision = $_GET["id_mision"];
                    $observacion = $this->db->query("SELECT * FROM vyp_observacion_solicitud WHERE id_mision = '".$id_mision."'");
                    if($observacion->num_rows() > 0){
                        foreach ($observacion->result() as $fila) {
                            echo '<a href="#!">';
                            	echo '<div class="mail-contnet">';
                            		echo '<h5><span class="fa fa-check"></span>&emsp;'.$fila->observacion."</h5>";
                            		echo '<span class="time" style="margin-left: 32px;">'.$fila->fecha_hora."</span>";
                            	echo '</div>';
                            echo '<div class="user-img pull-right">';
                            $array = array($fila->id_observacion_solicitud);
                            echo generar_boton($array,"eliminar_observacion","btn-danger","fa fa-close","Eliminar observación");
                            echo "</div>";

                           echo "</a>";
                        }
                    }else{
                    	echo "<p>No se han registrado otras observaciones...</p>";
                    }
            ?>
            
        </div>
    </div>
</div>