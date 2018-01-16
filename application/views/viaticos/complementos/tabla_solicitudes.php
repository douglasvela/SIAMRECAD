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
                    $mision = $this->db->get("vyp_mision_oficial");
                    if($mision->num_rows() > 0){
                        foreach ($mision->result() as $fila) {
                          echo "<tr>";
                            echo "<td>".date("d/m/Y",strtotime($fila->fecha_mision))."</td>";
                            echo "<td>".$fila->actividad_realizada."</td>";
                            if($fila->estado == "incompleta"){
                                echo '<td><span class="label label-danger">'.$fila->estado.'</span></td>';
                            }else if($fila->estado == "revision"){
                                echo '<td><span class="label label-success">'.$fila->estado.'</span></td>';
                            }else if($fila->estado == "observada"){
                                echo '<td><span class="label label-danger">'.$fila->estado.'</span></td>';
                            }else if($fila->estado == "aprobada"){
                                echo '<td><span class="label label-success">'.$fila->estado.'</span></td>';
                            }
                            
                            echo "<td>";
                            $array = array($fila->id_mision_oficial, $fila->nombre_completo, date("d-m-Y",strtotime($fila->fecha_mision)), $fila->actividad_realizada);
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