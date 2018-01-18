<div class="card">
    <div class="card-header">
        <h4 class="card-title m-b-0">Listado de viáticos</h4>
    </div>
    <div class="card-body b-t" style="padding-top: 7px;">
        <div class="pull-right">
            <button type="button" onclick="cambiar_nuevo();" class="btn waves-effect waves-light btn-success2" data-toggle="tooltip" title="Clic para agregar un nuevo registro"><span class="mdi mdi-plus"></span> Nuevo registro</button>
        </div>
        <div class="table-responsive">
            <table id="myTable" class="table table-hover product-overview">
                <thead class="bg-info text-white">
                    <tr>
                        <th>#</th>
                        <th>Descripción</th>
                        <th>Horario</th>                        
                        <th>Monto</th>
                        <th>Tipo</th>
                        <th>Estado</th>
                        <th>(*)</th>
                    </tr>
                </thead>
                <tbody>
                <?php 

                    $horarios = $this->db->query("SELECT * FROM vyp_horario_viatico ORDER BY estado DESC, hora_inicio ASC");
                    $correlativo = 0;

                    if(!empty($horarios)){
                        foreach ($horarios->result() as $fila) {
                            $correlativo++;
                          echo "<tr>";
                            echo "<td>".$correlativo."</td>";
                            echo "<td>".$fila->descripcion."</td>";
                            echo "<td>".date("h:i A",strtotime($fila->hora_inicio))." - ".date("h:i A",strtotime($fila->hora_fin))."</td>";
                            echo "<td>$ ".number_format($fila->monto,2)."</td>";
                            echo ($fila->id_tipo == "1") ? '<td>Viático</td>' : '<td>Restrición</td>';
                            echo ($fila->estado == "1") ? '<td><span class="label label-success">Activo</span></td>' : '<td><span class="label label-danger">Inactivo</span></td>';


                           
                            echo "<td>";
                            $array = array($fila->id_horario_viatico, $fila->descripcion, date("H:i",strtotime($fila->hora_inicio)), date("H:i",strtotime($fila->hora_fin)), number_format($fila->monto,2), $fila->id_tipo, $fila->estado);
                            array_push($array, "edit");
                            echo generar_boton($array,"cambiar_editar","btn-info","fa fa-wrench","Editar");
                            unset($array[endKey($array)]); //eliminar el ultimo elemento de un array
                            array_push($array, "delete");
                            if($fila->estado == "1"){
                                echo generar_boton($array,"cambiar_editar","btn-danger","fa fa-chevron-down","Dar de baja");
                            }else{
                                echo generar_boton($array,"cambiar_editar","btn-success","fa fa-chevron-up","Activar");
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
<script type="text/javascript">
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
</script>