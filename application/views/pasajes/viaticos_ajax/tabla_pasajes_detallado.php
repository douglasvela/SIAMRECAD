<style type="text/css" media="screen">
  table {
  font-size: 100%;
}
</style>      
<div class="table-responsive">
    <table id="myTable_detallado" class="table table-hover product-overview" style="margin-bottom: 0px;">
        <thead class="bg-inverse text-white">
            <tr>
                <th >Id</th>
                <th>Fecha Solicitud</th>
                <th>NR</th>
                <th>Nombre Solicitante</th>
                <th>Mes</th>
                <th>Año</th>
                 <th>Estado</th>
                 <th>Monto</th>
                <th>(*)</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $fecha_mes="2017-04";
        $nr_empleado=$_GET['nr_empleado'];
        list($otrafecha)= explode ("-",$fecha_mes); 
        $mes = $otrafecha[1];
        list($anio, $mes)= explode ("-",$fecha_mes);  

      $cuenta = $this->db->query("SELECT * FROM vyp_mision_pasajes AS p WHERE p.nr = '".$nr_empleado."' AND p.mes_pasaje='".$mes."' ORDER BY p.mes_pasaje DESC");
            if($cuenta->num_rows() > 0){
                foreach ($cuenta->result() as $fila) {
                  echo "<tr>";
                             $fila->fecha_solicitud_pasaje=date("d-m-Y",strtotime($fila->fecha_solicitud_pasaje));
                            echo "<td>".$fila->id_mision_pasajes."</td>";
                            echo "<td>".$fila->fecha_solicitud_pasaje."</td>";
                            
                            echo "<td>".$fila->nr."</td>";
                            echo "<td>".$fila->nombre_empleado."</td>";
                            echo "<td>".$fila->mes_pasaje."</td>";
                            echo "<td>".$fila->anio_pasaje."</td>";

                            if($fila->estado == 0){
                                echo '<td><span class="label label-danger">Incompleta</span></td>';
                            }else if($fila->estado == 1){
                                echo '<td><span class="label label-success">Revisión 1</span></td>';
                            }else if($fila->estado == 2){
                                echo '<td><span class="label label-danger">Observaciones 1</span></td>';
                            }else if($fila->estado == 3){
                                echo '<td><span class="label label-success">Revisión 2</span></td>';
                            }else if($fila->estado == 4){
                                echo '<td><span class="label label-danger">Observaciones 2</span></td>';
                            }else if($fila->estado == 5){
                                echo '<td><span class="label label-success">Revisión 3</span></td>';
                            }else if($fila->estado == 6){
                                echo '<td><span class="label label-danger">Observaciones 3</span></td>';
                            }else if($fila->estado == 7){
                                echo '<td><span class="label label-success">Aprobada</span></td>';
                            }else if($fila->estado == 8){
                                echo '<td><span class="label label-success">Pagada</span></td>';
                            }
                           
                            echo "<td></td>";
                    echo "<td>";
                   $array = array();
                    array_push($array, "edit");
                    echo generar_boton($array,"cambiar_editar","btn-info","fa fa-wrench","Editar");
                    unset($array[endKey($array)]); //eliminar el ultimo elemento de un array
                    echo generar_boton(array(),"eliminar_pasaje","btn-danger","fa fa-close","Eliminar");
                    echo "</td>";
                  echo "</tr>";
                }
            }else{
                echo "<tr>";
                    echo "<td colspan='9'>No hay registros de pasajes</td>";
                echo "</tr>";
            }
        ?>
        </tbody>
    </table>
</div>


<script>
$(function(){
    $(document).ready(function() {
        $('#myTable_detallado').DataTable();
    });
});
</script>