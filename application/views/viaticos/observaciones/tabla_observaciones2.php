
        <div class="table-responsive">
            <table id="myTable2" class="table table-hover product-overview">
                <thead class="bg-info text-white">
                    <tr>
                        <th>Fecha</th>
                        <th>Descripción</th> 
                        <th>Solicitante</th>
                        <th>(*)</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    $user = $this->session->userdata('usuario_viatico');
                    if(empty($user)){
                        header("Location: ".site_url()."/login");
                        exit();
                    }

                    $pos = strpos($user, ".")+1;
                    $inicialUser = strtoupper(substr($user,0,1).substr($user, $pos,1));

                    $nr = $this->db->query("SELECT * FROM org_usuario WHERE usuario = '".$user."' LIMIT 1");
                    $nr_usuario = ""; $nombre_usuario;
                    if($nr->num_rows() > 0){
                        foreach ($nr->result() as $fila) { 
                            $nr_usuario = $fila->nr; 
                            $nombre_usuario = $fila->nombre_completo;
                        }
                    }

                    $mision = $this->db->query("SELECT m.*, a.nombre_vyp_actividades AS nombre_actividad FROM vyp_mision_oficial AS m JOIN vyp_actividades AS a ON m.id_actividad_realizada = a.id_vyp_actividades  AND (m.estado = 3 AND m.nr_jefe_regional = '".$nr_usuario."') ORDER BY m.fecha_solicitud DESC");
                    if($mision->num_rows() > 0){
                        foreach ($mision->result() as $fila) {
                            echo "<tr>";
                            echo "<td>".$fila->fecha_solicitud."</td>";
                            echo "<td>".$fila->nombre_actividad."</td>";
                            echo "<td>".$fila->nombre_completo."</td>";

                            echo "<td>";
                            $array = array($fila->id_mision_oficial, $fila->estado);
                            echo generar_boton($array,"cambiar_mision","btn-info","fa fa-wrench","Revisar solicitud");
                            echo "</td>";

                           echo "</tr>";
                        }
                    }
                ?>
                </tbody>
            </table>
        </div>
        <input type="hidden" id="numObservacion2" name="numObservacion2" value="<?php echo $mision->num_rows(); ?>">
    