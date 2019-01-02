<div class="table-responsive">
            <table id="myTable" class="table table-hover product-overview" width="100%">
                <thead class="bg-info text-white">
                    <tr>
                        <th style="display: none;">Fecha</th>
                        <th width="130px">Fecha</th>
                        <th>Actividad realizada</th>
                        <th>Persona solicitante</th>
                        <th style="min-width: 165px; max-width: 165px;">Estado</th>
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

                            if(!in_array($fila->estado, array(1,3,5)) && $fila->estado < 7){
                                if($fila->estado == 0){
                                    $restante = 2 - get_days_count($fila->fecha_mision_fin, date("Y-m-d"));
                                }else{
                                    $restante = 2 - get_days_count(substr($fila->ultima_observacion,0,10), date("Y-m-d"));
                                }
                                $priority = "text-danger";
                                if($restante == 2){
                                    $priority = "text-primary";
                                }elseif($restante == 1){
                                    $priority = "text-warning";
                                }elseif($restante == 1){
                                    $priority = "text-danger";
                                }
                                // FAlta php diff without weekend
                                if($restante < 0){
                                    $vencida = true;
                                    $restante = "<h6 class='".$priority."'>PLAZO VENCIDO</h6>";
                                }else{
                                    $restante = "<h6 class='".$priority."'>RESTA: ".$restante." día(s)</h6>";
                                    $vencida = false;
                                }
                            }else{
                                if($fila->estado >= 7){
                                    $restante = "";
                                }else{
                                    $restante = "<h6 class='text-info'>EN ESPERA</h6>";
                                }
                                $vencida = false;
                            }

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
                            echo "<td align='center'>";
                            if($fila->estado == 0){
                                echo '<span style="width: 100%;" class="label label-light-danger">Incompleta</span>';
                            }else if($fila->estado == 1){
                                echo '<span class="label label-light-info">Revisión jefatura inmediata</span>';
                            }else if($fila->estado == 2){
                                echo '<span class="label label-warning">Observación jefatura inmediata</span>';
                            }else if($fila->estado == 3){
                                echo '<span class="label label-light-info">Revisión dirección / jefatura regional</span>';
                            }else if($fila->estado == 4){
                                echo '<span class="label label-warning">Observación dirección / jefatura regional</span>';
                            }else if($fila->estado == 5){
                                echo '<span class="label label-light-info">Revisión fondo circulante</span>';
                            }else if($fila->estado == 6){
                                echo '<span class="label label-warning">Observación fondo circulante</span>';
                            }else if($fila->estado == 7){
                                echo '<span style="width: 100%;" class="label label-success">Aprobada</span>';
                            }else if($fila->estado == 8){
                                echo '<span style="width: 100%;" class="label label-danger">Pagada</span>';
                            } echo "<br>".$restante."</td>";
                            
                            echo "<td>";

                            if($fila->ultima_observacion == "0000-00-00 00:00:00"){
                                $fecha_observacion = "falta";
                            }else{
                                $fecha_observacion = date("Y-m-d",strtotime($fila->ultima_observacion));
                            }

                            $array = array($fila->id_mision_oficial, $fila->nr_empleado, date("d-m-Y",strtotime($fila->fecha_mision_inicio)), date("d-m-Y",strtotime($fila->fecha_mision_fin)), $fila->id_actividad_realizada, $fila->detalle_actividad, $fila->estado, $fila->ruta_justificacion, date("Y-m-d",strtotime($fila->fecha_solicitud)), $fecha_observacion, $fila->oficina_solicitante_motorista, $fila->observaciones, $vencida);

                            if(tiene_permiso($segmentos=2,$permiso=4)){
                                if($fila->estado < 7){
                                        array_push($array, "edit");
                                        echo generar_boton($array,"cambiar_editar","btn-info","fa fa-wrench","Editar");
                                }else{
                                        array_push($array, "edit");
                                        echo generar_boton(array(),"disable","btn-default disabled","fa fa-wrench","");
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

                            echo generar_boton(array($fila->id_mision_oficial, 1),"bitacora","btn-warning","mdi mdi-information-variant","Bitácora de la solicitud");

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