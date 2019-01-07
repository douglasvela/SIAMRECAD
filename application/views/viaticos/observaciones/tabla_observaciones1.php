<?php if(tiene_permiso($segmentos=3,$permiso=1)){ ?>
<div class="table-responsive">
    <table id="myTable1" class="table table-hover product-overview">
        <thead class="bg-info text-white">
            <tr>
                <th>Fecha</th>
                <th>Descripción</th> 
                <th>Solicitante</th>
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

            $mision = $this->db->query("SELECT m.*, a.nombre_vyp_actividades AS nombre_actividad FROM vyp_mision_oficial AS m JOIN vyp_actividades AS a ON m.id_actividad_realizada = a.id_vyp_actividades AND (m.estado = 1 AND m.nr_jefe_inmediato = '".$nr_usuario."') ORDER BY m.fecha_solicitud DESC");
            if($mision->num_rows() > 0){
                $puede_editar = tiene_permiso($segmentos=3,$permiso=4);
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
                    echo "<td>".date("d/m/Y h:m:i A", strtotime($fila->ultima_observacion))."</td>";
                    echo "<td>".$fila->nombre_actividad."</td>";
                    echo "<td>".$fila->nombre_completo."</td>";
                    echo "<td>".$restante."</td>";
                    echo "<td>".$priority."</td>";
                    echo "<td>";
                    if($puede_editar){
                        $array = array($fila->id_mision_oficial, $fila->estado);
                        echo generar_boton($array,"cambiar_mision","btn-info","fa fa-wrench","Revisar solicitud");
                    }

                    if(date("Y-m-d", strtotime($fila->fecha_solicitud)) > "2018-10-23"){
                        echo generar_boton(array($fila->id_mision_oficial, 1),"bitacora","btn-warning","mdi mdi-information-variant","Bitácora de la solicitud");
                    }else{
                        echo generar_boton(array($fila->id_mision_oficial, 0),"bitacora","btn-warning","mdi mdi-information-variant","Bitácora de la solicitud");
                    }

                    echo "</td>";

                   echo "</tr>";
                }
            }
        ?>
        </tbody>
    </table>
    <input type="hidden" id="numObservacion1" name="numObservacion1" value="<?php echo $mision->num_rows(); ?>">
</div>
<?php }?>