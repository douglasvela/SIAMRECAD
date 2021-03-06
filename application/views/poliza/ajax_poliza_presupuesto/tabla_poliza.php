<div class="card">
    <div class="card-header">
        <h4 class="card-title m-b-0">Listado de pólizas</h4>
    </div>
    <div class="card-body b-t"  style="padding-top: 7px;">
        <div class="table-responsive">
            <table id="myTable" class="table table-hover product-overview">
                <thead class="bg-info text-white">
                    <tr>
                        <th># póliza</th>
                        <th>Mes</th>
                        <th>Año</th> 
                        <th>Monto</th>
                        <th>Estado</th>
                        <th>(*)</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    $poliza = $this->db->query("SELECT no_poliza, mes, mes_poliza, anio, SUM(total) AS total, estado, cod_presupuestario, nombre_banco, cuenta_bancaria FROM vyp_poliza WHERE estado = '0' GROUP BY no_poliza");
                    if($poliza->num_rows() > 0){
                        foreach ($poliza->result() as $fila) {
                            echo "<tr>";
                            echo "<td>".$fila->no_poliza."</td>";
                            echo "<td>".$fila->mes_poliza."</td>";
                            echo "<td>".$fila->anio."</td>";
                            echo "<td>$ ".$fila->total."</td>";

                            if($fila->estado == 0){
                                echo '<td><span class="label label-danger">Revisión presupuestaria</span></td>';
                            }else if($fila->estado == 1){
                                echo '<td><span class="label label-success">Pagada</span></td>';
                            }

                            echo "<td>";
                            
                            $array = array($fila->no_poliza, $fila->mes, $fila->anio, $fila->total, $fila->estado, $fila->cod_presupuestario, $fila->nombre_banco, $fila->cuenta_bancaria);
                            if(tiene_permiso($segmentos=2,$permiso=4)){
                                array_push($array, "edit");
                                echo generar_boton($array,"cambiar_editar","btn-info","fa fa-wrench","Editar");
                            }
                            echo generar_boton(array($fila->no_poliza, $fila->mes_poliza, $fila->anio),"imprimir_poliza","btn-default","fa fa-print","Imprimir poliza");
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