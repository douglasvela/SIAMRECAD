<div class="table-responsive">
    <table class="table table-hover product-overview" width="100%">
        <thead class="bg-info text-white">
            <tr>
                <th>Rol</th>
                <th>Persona</th>
                <th>Descripción</th>
                <th>Fecha</th>
                <th>Tardó</th>
            </tr>
        </thead>
        <tbody>
        <?php 
            $id_mision = $_GET["id_mision"];

            $bitacora = $this->db->query("SELECT b.*, u.nombre_completo FROM vyp_bitacora_solicitud_viatico AS b JOIN org_usuario AS u ON u.nr = b.nr_persona_actualiza AND id_mision = '".$id_mision."' ");

            if($bitacora->num_rows() > 0){
                $fila0 = $bitacora->row();
                if($fila0->persona_actualiza == 1){ $actor = "SOLICITANTE";
                }else if($fila0->persona_actualiza == 2){ $actor = "JEFATURA INMEDIATA";
                }else if($fila0->persona_actualiza == 3){ $actor = "DIRECCIÓN O JEFATURA REGIONAL";
                }else if($fila0->persona_actualiza == 4){ $actor = "FONDO CIRCULANTE"; }

                echo "<tr>";
                    echo "<td>".$actor."</td>";                    
                    echo "<td>".$fila0->nombre_completo."</td>";
                    echo "<td>FINALIZÓ SU MISIÓN OFICIAL</td>";
                    echo "<td>".date("d/m/Y",strtotime($fila0->fecha_antigua))."</td>";
                    echo "<td> - </td>";
                echo "</tr>";

                $contador = 0;
                foreach ($bitacora->result() as $fila) {
                    if($fila->persona_actualiza == 1){
                    	$actor = "SOLICITANTE";
                    }else if($fila->persona_actualiza == 2){
                    	$actor = "JEFATURA INMEDIATA";
                    }else if($fila->persona_actualiza == 3){
                    	$actor = "DIRECCIÓN DE ÁREA O JEFATURA REGIONAL";
                    }else if($fila->persona_actualiza == 4){
                    	$actor = "FONDO CIRCULANTE";
                    }
                  echo "<tr>";
                    echo "<td>".$actor."</td>";                    
                    echo "<td>".$fila->nombre_completo."</td>";
                    echo "<td>".$fila->descripcion."</td>";
                    echo "<td>".date("d/m/Y",strtotime($fila->fecha_actualizacion))."</td>";
                    echo "<td>".$fila->tiempo_dias." día(s)</td>";
                  echo "</tr>";
                }
            }
        ?>
        </tbody>
    </table>
</div>