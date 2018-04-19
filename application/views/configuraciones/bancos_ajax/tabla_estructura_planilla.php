<div class="card">
    <div class="card-header">
        <h4 class="card-title m-b-0">Columnas de la planilla</h4>
    </div>
    <div class="card-body b-t"  style="padding-top: 7px;">
        <div class="table-responsive">
            <table class="table table-hover product-overview">
                <thead class="bg-info text-white">
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>(*)</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    $estructura = $this->db->get("vyp_estructura_planilla");
                    if($estructura->num_rows() > 0){
                        foreach ($estructura->result() as $fila) {
                            echo "<tr>";
                            echo "<td>".$fila->id_estructura."</td>";
                            echo "<td>".$fila->nombre_campo."</td>";
                            echo "<td>".$fila->valor_campo."</td>";

                            echo "<td>";
                            $array = array($fila->id_estructura);

                            $data['id_modulo'] = $this->uri->segment(4);
                            $data['id_usuario'] = $this->session->userdata('id_usuario_viatico');
                            $data['id_permiso']="3";
                              if(buscar_permiso($data)){
                            echo generar_boton($array,"preguntar_eliminar_columna","btn-danger","fa fa-close","Eliminar");
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