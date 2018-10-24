<div class="table-responsive">
    <table class="table table-hover product-overview" width="100%">
        <thead class="bg-info text-white">
            <tr>
                <th>Actor</th>
                <th>Descripción</th>
                <th>Fecha</th>
                <th>Tardó</th>
            </tr>
        </thead>
        <tbody>
        <?php 
            $id_mision = $_GET["id_mision"];

            $bitacora = $this->db->query("SELECT * FROM vyp_bitacora_solicitud_viatico WHERE id_mision = '".$id_mision."'");
            if($bitacora->num_rows() > 0){
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
                    echo "<td>".$fila->descripcion."</td>";
                    echo "<td>".date("d/m/Y",strtotime($fila->fecha_actualizacion))."</td>";
                    echo "<td>".$fila->tiempo_dias." días</td>";
                  echo "</tr>";
                }
            }
        ?>
        </tbody>
    </table>
</div>