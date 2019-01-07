<div class="card">
    <div class="card-header">
        <h4 class="card-title m-b-0">Listado de bancos</h4>
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
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Código A</th>
                        <th>Código B</th>
                        <th>(*)</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    $bancos = $this->db->get("vyp_bancos");
                    if($bancos->num_rows() > 0){
                        $puede_editar = tiene_permiso($segmentos=2,$permiso=4);
                        $puede_eliminar = tiene_permiso($segmentos=2,$permiso=3);
                        foreach ($bancos->result() as $fila) {
                            echo "<tr>";
                            echo "<td>".$fila->id_banco."</td>";
                            echo "<td>".$fila->nombre."</td>";
                            echo "<td>".$fila->codigo_a."</td>";
                            echo "<td>".$fila->codigo_b."</td>";

                            echo "<td>";
                            $array = array($fila->id_banco, $fila->nombre, $fila->caracteristicas, $fila->codigo_a, $fila->codigo_b, $fila->delimitador);

                            if($puede_editar){
                                array_push($array, "edit");
                                echo generar_boton($array,"cambiar_editar","btn-info","fa fa-wrench","Editar");
                                unset($array[endKey($array)]); //eliminar el ultimo elemento de un array
                            }
                            if($puede_eliminar){
                                array_push($array, "delete");
                                echo generar_boton($array,"cambiar_editar","btn-danger","fa fa-close","Eliminar");
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