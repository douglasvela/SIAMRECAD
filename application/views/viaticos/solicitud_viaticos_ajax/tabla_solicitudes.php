<div class="card">
    <div class="card-header">
        <h4 class="card-title m-b-0">Listado de misiones oficiales</h4>
    </div>
    <div class="card-body b-t" style="padding-top: 7px;">
        <div class="pull-right">
            <button type="button" onclick="cambiar_nuevo();" class="btn waves-effect waves-light btn-success2" data-toggle="tooltip" title="Clic para agregar un nuevo registro"><span class="mdi mdi-plus"></span> Nuevo registro</button>
        </div>
        <div class="table-responsive">
            <table id="myTable" class="table table-hover product-overview">
                <thead class="bg-info text-white">
                    <tr>
                        <th>Fecha</th>
                        <th>Actividad realizada</th>
                        <th>Estado</th>
                        <th>(*)</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    $mision = $this->db->query("SELECT m.*, a.nombre_vyp_actividades AS nombre_actividad FROM vyp_mision_oficial AS m JOIN vyp_actividades AS a ON m.id_actividad_realizada = a.id_vyp_actividades");
                    if($mision->num_rows() > 0){
                        foreach ($mision->result() as $fila) {
                          echo "<tr>";
                            if($fila->fecha_mision_inicio == $fila->fecha_mision_fin){
                                echo "<td>".date("d/m/Y",strtotime($fila->fecha_mision_inicio))."</td>";
                            }else{
                                echo "<td>".date("d/m/Y",strtotime($fila->fecha_mision_inicio))." - ".date("d/m/Y",strtotime($fila->fecha_mision_fin))."</td>";
                            }
                            echo "<td>".$fila->nombre_actividad."</td>";
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
                            $array = array($fila->id_mision_oficial, $fila->nr_empleado, date("d-m-Y",strtotime($fila->fecha_mision_inicio)), date("d-m-Y",strtotime($fila->fecha_mision_fin)), $fila->id_actividad_realizada, $fila->detalle_actividad, $fila->estado, $fila->ruta_justificacion);
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
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
</script>