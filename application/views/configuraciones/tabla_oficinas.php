<div class="card">
    <div class="card-header">
        <div class="card-actions">
           
        </div>
        <h4 class="card-title m-b-0">Listado de Oficinas</h4>
    </div>
    <div class="card-body b-t"  style="padding-top: 7px;">
        <div class="pull-right">
            <button type="button" onclick="cambiar_nuevo();" class="btn waves-effect waves-light btn-success2"><span class="mdi mdi-plus"></span> Nuevo registro</button>
        </div>
        <div class="table-responsive">
            <table id="myTable" class="table table-bordered product-overview">
                <thead class="bg-info text-white">
                    <tr>
                        <th>Id</th>
                        <th>Nombre de la Oficina</th>
                        <th>Dirección de la Oficina</th>
                        <th>Jefe de la Oficina</th>
                        <th>Email</th>
                
                       
                        <th>Depto</th>
                        <th>Municipio</th>
                                <th>Tel.</th>
                        <th style="min-width: 85px;">(*)</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                	$oficinas = $this->db->get("vyp_oficinas");
                    if(!empty($oficinas)){
                        foreach ($oficinas->result() as $fila) {
                            echo "<tr>";
                            echo "<td>".$fila->id_oficina."</td>";
                            echo "<td>".$fila->nombre_oficina."</td>";
                            echo "<td>".$fila->direccion_oficina."</td>";
                            echo "<td>".$fila->jefe_oficina."</td>";
                            echo "<td>".$fila->email_oficina."</td>";
                            $this->db->where("id_departamento",$fila->id_departamento);
                            $depto = $this->db->get("org_departamento");
                            foreach ($depto->result() as $keydepto) {
                              echo "<td>".$keydepto->departamento."</td>";
                            }
                           
                           $this->db->where("id_municipio",$fila->id_municipio);
                            $munic = $this->db->get("org_municipio");
                            foreach ($munic->result() as $keymunic) {
                              echo "<td>".$keymunic->municipio."</td>";
                            }

                            /******* botón para la gestión de TELEFONOS **********/
                            echo "<td>";
                              $arrayTel = array($fila->id_oficina,$fila->nombre_oficina);
                              echo generar_boton($arrayTel,"cambiar_phone","btn-info","mdi mdi-phone-plus","Teléfono(s)");
                            echo "</td>";

                            /******* botones para la edición de OFICINAS **********/
                            echo "<td>";
                              $array = array($fila->id_oficina, $fila->nombre_oficina, $fila->direccion_oficina, $fila->jefe_oficina, $fila->email_oficina, $fila->latitud_oficina,$fila->longitud_oficina,$fila->id_departamento,$fila->id_municipio);
                              array_push($array, "edit");
                              echo generar_boton($array,"cambiar_editar","btn-info","fa fa-wrench","Editar");
                              unset($array[endKey($array)]); //eliminar el ultimo elemento de un array
                              array_push($array, "delete");
                              echo generar_boton($array,"cambiar_editar","btn-danger","fa fa-close","Eliminar");
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
$(function(){
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
});
</script>