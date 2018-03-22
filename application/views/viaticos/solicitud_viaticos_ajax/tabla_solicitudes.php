<div class="table-responsive">
            <table id="myTable" class="table table-hover product-overview" width="100%">
                <thead class="bg-info text-white">
                    <tr>
                        <th style="display: none;">Fecha</th>
                        <th width="130px">Fecha</th>
                        <th>Actividad realizada</th>
                        <th>Nombre del solicitante</th>
                        <th>Estado</th>
                        <th width="150px">(*)</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    $nr = $_GET["nr"];

                    $add = "";

                    if(!empty($nr)){
                        $add = "AND m.nr_empleado = '".$nr."'";
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
                                echo '<td><span class="label label-danger">Incompleta</span></td>';
                            }else if($fila->estado == 1){
                                echo '<td><span class="label label-success">Revisión 1</span></td>';
                            }else if($fila->estado == 2){
                                echo '<td><span class="label label-danger">Observaciones 1</span></td>';
                            }else if($fila->estado == 3){
                                echo '<td><span class="label label-success">Revisión 2</span></td>';
                            }else if($fila->estado == 4){
                                echo '<td><span class="label label-danger">Observaciones 2</span></td>';
                            }else if($fila->estado == 5){
                                echo '<td><span class="label label-success">Revisión 3</span></td>';
                            }else if($fila->estado == 6){
                                echo '<td><span class="label label-danger">Observaciones 3</span></td>';
                            }else if($fila->estado == 7){
                                echo '<td><span class="label label-success">Aprobada</span></td>';
                            }else if($fila->estado == 8){
                                echo '<td><span class="label label-success">Pagada</span></td>';
                            }
                            
                            echo "<td>";

                            if($fila->ultima_observacion == "0000-00-00 00:00:00"){
                                $fecha_observacion = "falta";
                            }else{
                                $fecha_observacion = date("Y-m-d",strtotime($fila->ultima_observacion));
                            }

                            $array = array($fila->id_mision_oficial, $fila->nr_empleado, date("d-m-Y",strtotime($fila->fecha_mision_inicio)), date("d-m-Y",strtotime($fila->fecha_mision_fin)), $fila->id_actividad_realizada, $fila->detalle_actividad, $fila->estado, $fila->ruta_justificacion, date("Y-m-d",strtotime($fila->fecha_solicitud)), $fecha_observacion);
                            array_push($array, "edit");
                            echo generar_boton($array,"cambiar_editar","btn-info","fa fa-wrench","Editar");
                            unset($array[endKey($array)]); //eliminar el ultimo elemento de un array
                            array_push($array, "delete");
                            echo generar_boton($array,"cambiar_editar","btn-danger","fa fa-close","Eliminar");
                            echo generar_boton(array($fila->id_mision_oficial),"imprimir_solicitud","btn-default","fa fa-print","Imprimir");
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