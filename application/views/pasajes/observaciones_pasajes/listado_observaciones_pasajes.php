<div class="card card-body">
    <h3 class="card-title">Lista de observaciones</h3>
    <div class="message-box">
        <div class="message-widget">

        	<?php 
        			$id_mision = $_GET["id_mision"];
                    $observacion = $this->db->query("SELECT o.*, u.nombre_completo FROM vyp_observaciones_pasajes AS o JOIN org_usuario AS u ON o.nr_observador = u.nr AND o.id_mision_pasajes = '".$id_mision."' ORDER BY fecha_hora DESC");
                    if($observacion->num_rows() > 0){
                        foreach ($observacion->result() as $fila) {
                            if($fila->corregido == 0){
                                echo '<a href="#!" style="background-color: #ef5a1630;">';
                            }else{
                                echo '<a href="#!" style="background-color: #16ef2430;">';
                            }
                            	echo '<div class="mail-contnet">';
                            		echo '<h5><span class="fa fa-check"></span>&emsp;'.$fila->observacion."</h5>";
                                    echo '<span class="mail-desc" style="margin-left: 32px;">'.$fila->nombre_completo." - ".$fila->tipo_observador.'</span>';
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