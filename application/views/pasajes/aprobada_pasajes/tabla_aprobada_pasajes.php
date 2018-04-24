<div class="card">
    <div class="card-header">
        <h4 class="card-title m-b-0">Listado de solicitudes</h4>
    </div>
    <div class="card-body b-t"  style="padding-top: 7px;">
        <div class="table-responsive">
            <table id="myTable" class="table table-hover product-overview">
                <thead class="bg-info text-white">
                    <tr>
                        <th>Fecha</th>
                        <th>Mes</th> 
                        <th>Año</th> 
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

                    $mision = $this->db->query("SELECT * FROM vyp_mision_pasajes ");
                    if($mision->num_rows() > 0){
                        foreach ($mision->result() as $fila) {
                            echo "<tr>";
                            echo "<td>".$fila->fecha_solicitud_pasaje."</td>";
                             echo "<td>".$fila->mes_pasaje."</td>";
                              echo "<td>".$fila->anio_pasaje."</td>";
                          //  echo "<td>".$fila->id_actividad_realizada."</td>";
                            echo "<td>".$fila->nombre_empleado."</td>";
$fecha=$fila->anio_pasaje .'-'. $fila->mes_pasaje;
                            echo "<td>";
                            $array = array($fila->nr, $fecha,$fila->id_mision_pasajes);
                            echo generar_boton($array,"imprimir_solicitud","btn-default","fa fa-print","Ver solicitud");
                            echo "</td>";

                           echo "</tr>";
                        }
                    }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
</script>