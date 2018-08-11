 <?php if(tiene_permiso($segmentos=3,$permiso=1)){   
    ?>       
        <div class="table-responsive">
            <table id="myTable3" class="table table-hover product-overview">
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

                    $linea = $_GET["linea"];
                    $lt = "";

                    if(!empty($linea)){
                        $lt = "AND lt.linea_trabajo = '".$linea."'";
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

                    $mision = $this->db->query("SELECT m.*, a.nombre_vyp_actividades AS nombre_actividad FROM vyp_mision_oficial AS m JOIN vyp_actividades AS a ON m.id_actividad_realizada = a.id_vyp_actividades AND m.estado = 5 JOIN sir_empleado AS emp ON emp.nr = m.nr_empleado JOIN (SELECT id_empleado_informacion_laboral as id_empleado_informacion_laboral, id_empleado, id_linea_trabajo, id_cargo_funcional, id_seccion FROM sir_empleado_informacion_laboral GROUP BY id_empleado ORDER BY id_empleado_informacion_laboral) AS ei ON ei.id_empleado = emp.id_empleado AND ei.id_empleado_informacion_laboral = (SELECT MAX(i2.id_empleado_informacion_laboral) FROM sir_empleado_informacion_laboral AS i2 WHERE e.id_empleado = i2.id_empleado) JOIN org_linea_trabajo AS lt ON lt.id_linea_trabajo = ei.id_linea_trabajo ".$lt." ORDER BY m.fecha_solicitud DESC");
                    if($mision->num_rows() > 0){
                        foreach ($mision->result() as $fila) {
                            echo "<tr>";
                            echo "<td>".$fila->fecha_solicitud."</td>";
                            echo "<td>".$fila->nombre_actividad."</td>";
                            echo "<td>".$fila->nombre_completo."</td>";

                            echo "<td>";
                            if(tiene_permiso($segmentos=3,$permiso=4)){
                            $array = array($fila->id_mision_oficial, $fila->estado);
                            echo generar_boton($array,"cambiar_mision","btn-info","fa fa-wrench","Revisar solicitud");
                            }
                            echo "</td>";

                           echo "</tr>";
                        }
                    }
                ?>
                </tbody>
            </table>
        </div>
        <input type="hidden" id="numObservacion3" name="numObservacion3" value="<?php echo $mision->num_rows(); ?>">
<?php } ?>