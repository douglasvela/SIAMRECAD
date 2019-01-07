<div class="card">
    <div class="card-header">
        <h4 class="card-title m-b-0">Listado de pagos de emergencia</h4>
    </div>
    <div class="card-body b-t"  style="padding-top: 7px;">
        <div class="pull-right">
            <?php if(tiene_permiso($segmentos=2,$permiso=2)){ ?>
            <button type="button" onclick="cambiar_nuevo();" class="btn waves-effect waves-light btn-success2" data-toggle="tooltip" title="Clic para agregar un nuevo registro"><span class="mdi mdi-plus"></span> Nuevo registro</button>
            <?php } ?>
        </div>
        <div class="table-responsive">
            <table id="myTable" class="table table-hover product-overview">
                <thead class="bg-info text-white">
                    <tr>
                        <th>Fecha pago</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Monto</th> 
                        <th>Estado</th>
                        <th>(*)</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    $pagos = $this->db->query("SELECT p.*, u.nombre_completo, a.* FROM vyp_pago_emergencia AS p JOIN org_usuario AS u ON u.nr = p.nr JOIN vyp_actividades AS a ON a.id_vyp_actividades = p.id_actividad");
                    $contador = 0;
                    if($pagos->num_rows() > 0){
                        $puede_editar = tiene_permiso($segmentos=2,$permiso=4);
                        $puede_eliminar = tiene_permiso($segmentos=2,$permiso=3);
                        foreach ($pagos->result() as $fila) {
                            $contador++;
                            echo "<tr>";
                            echo "<td>".date("d-m-Y",strtotime($fila->fecha_pago))."</td>";
                            echo "<td>".$fila->nombre_completo."</td>";
                            echo "<td>".$fila->nombre_vyp_actividades."</td>";
                            echo "<td>$ ".$fila->monto."</td>";

                            if($fila->estado == 0){
                                echo '<td><span class="label label-danger">Solicitud pendiente</span></td>';
                            }else if($fila->estado == 1){
                                echo '<td><span class="label label-success">Completada</span></td>';
                            }

                            echo "<td>";
                            $array = array($fila->id_pago_emergencia, $fila->nr, date("d-m-Y",strtotime($fila->fecha_mision_inicio)), date("d-m-Y",strtotime($fila->fecha_mision_fin)), $fila->id_actividad, $fila->tipo_pago, $fila->monto, $fila->num_cheque,date("d-m-Y",strtotime($fila->fecha_pago)));
                            if($puede_editar){
                                array_push($array, "edit");
                                echo generar_boton($array,"cambiar_editar","btn-info","fa fa-wrench","Editar");
                                unset($array[endKey($array)]); //eliminar el ultimo elemento de un array
                            }
                            if($puede_eliminar){                                
                                if($fila->estado == 0){
                                    array_push($array, "delete");
                                    echo generar_boton($array,"cambiar_editar","btn-danger","fa fa-close","Eliminar");
                                }else{
                                    array_push($array, "down");
                                    echo generar_boton($array,"cambiar_editar","btn-danger","fa fa-chevron-down","Cambiar estado");
                                }
                            }   
                            
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