<div class="card">
    <div class="card-header">
        <div class="card-actions">
           
            <a style="font-size: 16px;" onclick="cerrar_tabla_phone();"><i class="mdi mdi-window-close"></i></a>
                       
        </div>
        <h4 class="card-title m-b-0">Listado de teléfonos</h4>
    </div>
    <div class="card-body b-t"  style="padding-top: 7px;">

        <div class="pull-right">
            <button type="button" onclick="cambiar_nuevo_phone();" class="btn waves-effect waves-light btn-success2"><span class="mdi mdi-plus"></span> Nuevo registro</button>
        </div>
        <?php
                  $oficinas = $this->db->where("id_oficina_vyp_oficnas_telefono",$id);
                  $oficinas = $this->db->get("vyp_oficinas_telefono");

                  $nombre_of = $this->db->where("id_oficina",$id);
                  $nombre_of = $this->db->get("vyp_oficinas");
                  foreach ($nombre_of->result() as $fila_of) {
        ?>
        <label>Nombre de la oficina: <?php echo $fila_of->nombre_oficina; }?></label>
        <div class="table-responsive">
            <table id="myTable_phone" class="table table-hover product-overview">
                <thead class="bg-info text-white">
                    <tr>
                        <th>Teléfono</th>
                        <th>(*)</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                	
                    if(!empty($oficinas)){
                        foreach ($oficinas->result() as $fila) {
                           echo "<tr>";
                           echo "<td>".$fila->telefono_vyp_oficnas_telefono."</td>";

                           /******* botón para la gestión de TELEFONOS **********/
                            echo "<td>";
                              $array = array($fila->id_vyp_oficinas_telefono,$fila->id_oficina_vyp_oficnas_telefono,$fila->telefono_vyp_oficnas_telefono);
                              array_push($array, "edit");
                              echo generar_boton($array,"cambiar_editar_phone","btn-info","fa fa-wrench","Editar");
                              unset($array[endKey($array)]); //eliminar el ultimo elemento de un array
                              array_push($array, "delete");
                              echo generar_boton($array,"cambiar_editar_phone","btn-danger","fa fa-close","Eliminar");
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
        $('#myTable_phone').DataTable();
    });
});
</script>