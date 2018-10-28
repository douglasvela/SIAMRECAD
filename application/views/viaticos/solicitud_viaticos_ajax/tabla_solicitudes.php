<div class="table-responsive">
            <table id="myTable" class="table table-hover product-overview" width="100%">
                <thead class="bg-info text-white">
                    <tr>
                        <th style="display: none;">Fecha</th>
                        <th width="130px">Fecha</th>
                        <th>Actividad realizada</th>
                        <th>Persona solicitante</th>
                        <th>Estado</th>
                        <th width="150px">(*)</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    $nr = $_GET["nr"];
                    $tipo = $_GET["tipo"];

                    $add = "";

                    if(!empty($nr)){
                        $add .= "AND m.nr_empleado = '".$nr."'";
                    }

                    if(!empty($tipo)){
                        if($tipo == "1"){
                            $add .= " AND m.estado = '0'";
                        }else if($tipo == "2"){
                            $add .= " AND (m.estado = '1' || m.estado = '3' || m.estado = '5')";
                        }else if($tipo == "3"){
                            $add .= " AND (m.estado = '2' || m.estado = '4' || m.estado = '6')";
                        }else if($tipo == "4"){
                            $add .= " AND m.estado = '7'";
                        }else{
                            $add .= " AND m.estado = '8'";
                        }
                    }

                    $mision = $this->db->query("SELECT m.*, a.nombre_vyp_actividades AS nombre_actividad FROM vyp_mision_oficial AS m JOIN vyp_actividades AS a ON m.id_actividad_realizada = a.id_vyp_actividades  ".$add." ORDER BY m.id_mision_oficial DESC");
                    if($mision->num_rows() > 0){
                        $contador = 0;
                        foreach ($mision->result() as $fila) {
                            $contador++;
                          echo "<tr>";
                            echo "<td style='display: none;'>".$contador."</td>";

                            if($fila->fecha_solicitud == "0000-00-00 00:00:00"){
                                echo "<td>PENDIENTE</td>";
                            }else{
                                echo "<td>".date("d/m/Y",strtotime($fila->fecha_solicitud))."</td>";
                            }
                            
                            echo "<td>".$fila->nombre_actividad."</td>";
                            echo "<td>".$fila->nombre_completo."</td>";

                            if($fila->estado == 0){
                                echo '<td><span class="label label-light-danger">Incompleta</span></td>';
                            }else if($fila->estado == 1){
                                echo '<td><span class="label label-light-info">Revisión jefe inmediato</span></td>';
                            }else if($fila->estado == 2){
                                echo '<td><span class="label label-warning">Observación jefe inmediato</span></td>';
                            }else if($fila->estado == 3){
                                echo '<td><span class="label label-light-info">Revisión director de área o jefe regional</span></td>';
                            }else if($fila->estado == 4){
                                echo '<td><span class="label label-warning">Observación director de área o jefe regional</span></td>';
                            }else if($fila->estado == 5){
                                echo '<td><span class="label label-light-info">Revisión fondo circulante</span></td>';
                            }else if($fila->estado == 6){
                                echo '<td><span class="label label-warning">Observación fondo circulante</span></td>';
                            }else if($fila->estado == 7){
                                echo '<td><span class="label label-success">Aprobada</span></td>';
                            }else if($fila->estado == 8){
                                echo '<td><span class="label label-danger">Pagada</span></td>';
                            }
                            
                            echo "<td>";

                            if($fila->ultima_observacion == "0000-00-00 00:00:00"){
                                $fecha_observacion = "falta";
                            }else{
                                $fecha_observacion = date("Y-m-d",strtotime($fila->ultima_observacion));
                            }

                            $array = array($fila->id_mision_oficial, $fila->nr_empleado, date("d-m-Y",strtotime($fila->fecha_mision_inicio)), date("d-m-Y",strtotime($fila->fecha_mision_fin)), $fila->id_actividad_realizada, $fila->detalle_actividad, $fila->estado, $fila->ruta_justificacion, date("Y-m-d",strtotime($fila->fecha_solicitud)), $fecha_observacion, $fila->oficina_solicitante_motorista);
                            if($fila->estado < 7){
                                if(tiene_permiso($segmentos=2,$permiso=4)){
                                    array_push($array, "edit");
                                    echo generar_boton($array,"cambiar_editar","btn-info","fa fa-wrench","Editar");
                                }
                            }else{
                               if(tiene_permiso($segmentos=2,$permiso=4)){
                                    array_push($array, "edit");
                                    echo generar_boton(array(),"disable","btn-default disabled","fa fa-wrench","Editar");
                                } 
                            }
                            if($fila->estado == 0){
                                if(tiene_permiso($segmentos=2,$permiso=3)){
                                    unset($array[endKey($array)]); //eliminar el ultimo elemento de un array
                                    array_push($array, "delete");
                                    echo generar_boton($array,"cambiar_editar","btn-danger","fa fa-close","Eliminar");
                                }
                            }else{
                                echo generar_boton(array($fila->id_mision_oficial),"ver_solicitud_html","btn-default","mdi mdi-file-document","Visualizar solicitud");
                            }

                            if(date("Y-m-d", strtotime($fila->fecha_solicitud)) > "2018-10-24"){
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
        </div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
</script>