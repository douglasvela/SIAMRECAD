<div class="card">
    <div class="card-header">
        <h4 class="card-title m-b-0">Listado de pólizas</h4>
    </div>
    <div class="card-body b-t"  style="padding-top: 7px;">
        <div class="pull-right">
            <?php if(tiene_permiso($segmentos=2,$permiso=2)){ ?>
            <button type="button" onclick="cambiar_nuevo();" class="btn waves-effect waves-light btn-success2" data-toggle="tooltip" title="Clic para agregar un nuevo pago"><span class="mdi mdi-plus"></span> Nuevo pago</button>
            <?php } ?>
        </div>
        <div class="table-responsive">
            <table id="myTable" class="table table-hover product-overview">
                <thead class="bg-info text-white">
                    <tr>
                        <th>#</th>
                        <th>Pólizas</th>
                        <th>Año</th> 
                        <th>Fecha pago</th>
                        <th>Monto</th>
                        <th>Estado</th>
                        <th>(*)</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    $poliza = $this->db->query("SELECT * FROM vyp_pago_poliza");
                    $correlativo = 0;
                    if($poliza->num_rows() > 0){
                        foreach ($poliza->result() as $fila) {
                            $correlativo++;
                            echo "<tr>";
                            echo "<td>".$correlativo."</td>";
                            echo "<td>Pólizas ".str_replace(" ", ", ", $fila->polizas)."</td>";
                            echo "<td>".$fila->anio."</td>";
                            echo "<td>".date("d-m-Y", strtotime($fila->fecha_pago))."</td>";
                            echo "<td>$ ".$fila->monto."</td>";                           
                            echo '<td><span class="label label-danger">Pagado</span></td>';

                            echo "<td>";
                            $array = array(base64_encode($fila->sql), $fila->polizas);
                            if(tiene_permiso($segmentos=2,$permiso=4)){  
                                //array_push($array, "edit");
                                echo generar_boton($array,"genera_planillas2","btn-info","fa fa-wrench","Editar");
                            }
                            echo generar_boton(array($fila->polizas, $fila->anio),"imprimir_poliza","btn-default","fa fa-print","Imprimir");
                            unset($array[endKey($array)]); //eliminar el ultimo elemento de un array
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