<div class="card">
    <div class="card-header">
        <h4 class="card-title m-b-0">Pasajes</h4>
    </div>
    <div class="card-body b-t"  style="padding-top: 7px;">
        <div class="pull-right">
            <button type="button" onclick="cambiar_nuevo();" class="btn waves-effect waves-light btn-success2" data-toggle="tooltip" title="Clic para agregar un nuevo registro"><span class="mdi mdi-plus"></span> Nuevo registro</button>
        </div>
        <div class="table-responsive">
            <table id="myTable" class="table table-hover product-overview">
                <thead class="bg-info text-white">
                    <tr>
                        <th>#</th>
                        <th>Fecha</th>
                        <th>No. Expediente</th>
                        <th>Empresa visitada</th> 
                        <th>Dirección </th> 
                        <th>NR</th> 
                        <th>Monto</th> 

                        <th>(*)</th>
                    </tr>
                </thead>
                <tbody>

                 <?php
                 
                     ?>


                <?php 
                    $pasajes = $this->db->get("vyp_pasajes");
                      $user = $this->session->userdata('usuario_viatico');
                                $nr = $this->db->query("SELECT * FROM org_usuario WHERE usuario = '".$user."' LIMIT 1");
                                $nr_usuario = ""; $nombre_usuario;
                    if(!empty($pasajes) && ($nr->num_rows() > 0)){

                               
                                   
                                
                        foreach ($pasajes->result() as $fila) {
                           foreach($nr->result() as $fila1){
                                        $nr_usuario = $fila1->nr; 
                            echo "<tr>";
                            echo "<td>".$fila->id_solicitud_pasaje."</td>";
                             $fila->fecha_mision=date("d-m-Y",strtotime($fila->fecha_mision));
                            echo "<td>".$fila->fecha_mision."</td>";
                            echo "<td>".$fila->no_expediente."</td>";
                             echo "<td>".$fila->empresa_visitada."</td>";
                             echo "<td>".$fila->direccion_empresa."</td>";
                              echo "<td>".$nr_usuario."</td>";
                              echo "<td>".$fila->monto_pasaje."</td>";
             echo "<td>";
             $array = array($fila->id_solicitud_pasaje, date("d-m-Y",strtotime($fila->fecha_mision)), $fila->no_expediente,$fila->empresa_visitada,$fila->direccion_empresa,$nr_usuario,$fila->monto_pasaje, 
                $fila->estado);
                            array_push($array, "edit");
                            echo generar_boton($array,"cambiar_editar","btn-info","fa fa-wrench","Editar");
                            unset($array[endKey($array)]); //eliminar el ultimo elemento de un array
                            array_push($array, "delete");
                            echo generar_boton($array,"cambiar_editar","btn-danger","fa fa-close","Eliminar");
                            echo "</td>";

                           echo "</tr>";
                        }
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