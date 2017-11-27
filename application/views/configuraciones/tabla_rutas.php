<div class="card">
    <div class="card-header">
        <div class="card-actions">
           
            <a style="font-size: 16px;" onclick="cerrar_tabla_phone();"><i class="mdi mdi-window-close"></i></a>
                       
        </div>
        <h4 class="card-title m-b-0">Listado de Rutas</h4>
    </div>
    <div class="card-body b-t"  style="padding-top: 7px;">

        <div class="pull-right">
            <button type="button" onclick="cambiar_nuevo();" class="btn waves-effect waves-light btn-success2"><span class="mdi mdi-plus"></span> Nuevo registro</button>
        </div>
      
        <div class="table-responsive">
            <table id="myTable" class="table table-hover product-overview">
                <thead class="bg-info text-white">
                    <tr>
                        <th>Nombre</th>
                        <th>Descripcion del origen</th>
                        <th>Descripcion del destino</th>
                        <th>Distancia</th>
                        <th>Tiempo</th>
                        <th style="min-width: 85px;">#</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                	
                    if(!empty($rutas)){
                        foreach ($rutas->result() as $fila) {
                           echo "<tr>";
                          
                           echo "<td>".$fila->nombre_vyp_rutas."</td>";
                           echo "<td>".$fila->descr_origen_vyp_rutas."</td>";                           
                           echo "<td>".$fila->descr_destino_vyp_rutas."</td>";
                           echo "<td>".$fila->distancia_km_vyp_rutas."</td>";
                           echo "<td>".$fila->tiempo_vyp_rutas."</td>";
                            
                            echo "<td>";
                            $array = array($fila->id_vyp_rutas,$fila->nombre_vyp_rutas,$fila->descr_origen_vyp_rutas,$fila->latitud_origen_vyp_rutas,$fila->longitud_origen_vyp_rutas,$fila->descr_destino_vyp_rutas,$fila->latitud_destino_vyp_rutas,$fila->longitud_destino_vyp_rutas,$fila->distancia_km_vyp_rutas,$fila->tiempo_vyp_rutas);
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


