<div class="card">
    <div class="card-header">
        <h4 class="card-title m-b-0">Listado de solicitudes</h4>
    </div>
    <div class="card-body b-t"  style="padding-top: 7px;">
        <div class="pull-right">
            <button type="button" onclick="cambiar_nuevo();" class="btn waves-effect waves-light btn-success2" data-toggle="tooltip" title="Clic para agregar un nuevo registro"><span class="mdi mdi-plus"></span> Nuevo registro</button>
        </div>
        <div class="table-responsive">
            <table id="myTable" class="table table-hover product-overview">
                <thead class="bg-info text-white">
                    <tr>
                        <th>Fecha</th>
                        <th>Descripción</th> 
                        <th>Solicitante</th>
                        <th>(*)</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    $mision = $this->db->query("SELECT * FROM vyp_mision_oficial WHERE estado = 'revision'");
                    if($mision->num_rows() > 0){
                        foreach ($mision->result() as $fila) {
                            echo "<tr>";
                            echo "<td>".$fila->fecha_solicitud."</td>";
                            echo "<td>".$fila->actividad_realizada."</td>";
                            echo "<td>".$fila->nombre_completo."</td>";

                            echo "<td>";
                            $array = array($fila->id_mision_oficial);
                            echo generar_boton($array,"cambiar_mision","btn-info","fa fa-wrench","Revisar solicitud");
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