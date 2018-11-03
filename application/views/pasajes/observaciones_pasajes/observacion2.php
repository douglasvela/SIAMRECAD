<?php if(tiene_permiso($segmentos=3,$permiso=1)){ ?>
        <div class="table-responsive">
            <table id="myTable2" class="table table-hover product-overview">
                <thead class="bg-info text-white">
                    <tr>
                        <th>Id</th>
                        <th>Fecha solicitud</th>
                        <th>Solicitante</th>
                        <th>Mes</th> 
                        <th>Año</th>
                        <th>Vigencia</th>
                        <th>Prioridad</th>
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

          $mision = $this->db->query("SELECT * FROM vyp_mision_pasajes where estado = 3 AND nr_jefe_regional = '".$nr_usuario."' ORDER BY mes_pasaje");
                   if($mision->num_rows() > 0){ 
               
                foreach ($mision->result() as $fila) {
                    $restante = 2 - get_days_count(substr($fila->ultima_observacion,0,10), date("Y-m-d"));
                    $priority = "<span class='label label-danger'>URGENTE</span>";
                    if($restante == 2){
                        $priority = "<span class='label label-primary'>MEDIA</span>";
                    }elseif($restante == 1){
                        $priority = "<span class='label label-warning'>ALTA</span>";
                    }elseif($restante == 1){
                        $priority = "<span class='label label-danger'>URGENTE</span>";
                    }
                    // FAlta php diff without weekend
                    if($restante < 0){
                        $restante = "VENCIDA";
                    }else{
                        $restante .= " día(s)";
                    }
                    echo "<tr>";
                    echo "<td>".$fila->id_mision_pasajes."</td>";
                    $date = date_create($fila->fecha_solicitud_pasaje);
                    echo "<td>".date_format($date, 'd-m-Y')."</td>";
                    echo "<td>".$fila->nombre_empleado."</td>";
                    echo "<td>".mes($fila->mes_pasaje)."</td>";
                    echo "<td>".$fila->anio_pasaje."</td>";
                    echo "<td>".$restante."</td>";
                    echo "<td>".$priority."</td>";
                   
                    $fecha=$fila->anio_pasaje .'-'. $fila->mes_pasaje;
                    echo "<td>";
                    $array = array($fila->nr, $fila->id_mision_pasajes, $fila->estado, $fila->mes_pasaje);
                    if(tiene_permiso($segmentos=3,$permiso=4)){
                        echo generar_boton($array,"cambiar_mision","btn-info","fa fa-wrench","Revisar solicitud");
                    }
                    echo generar_boton(array($fila->id_mision_pasajes, 1),"bitacora","btn-warning","mdi mdi-information-variant","Bitácora de la solicitud");
                    echo "</td>";

                   echo "</tr>";
                        }
                    }
                ?>
                </tbody>
            </table>
        
        <input type="hidden" id="numObservacion2" name="numObservacion2" value="<?php echo $mision->num_rows(); ?>">
    </div>
    <?php } ?>