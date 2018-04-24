<?php 
    $nr_empleado = $_GET["nr"];
   $fecha_mes = $_GET["fecha2"];



    if(!empty($nr_empleado) AND !empty($fecha_mes) ){
        list($anio, $mes)= explode ("-",$fecha_mes); 


//echo ($fecha_mes);
?>


<div class="table-responsive">
    <table id="target" class="table table-hover product-overview" style="margin-bottom: 0px;">
        <thead class="bg-inverse text-white">
            <tr>
                <th>Mes</th>
                <th>Año</th>
                <th>Nombre del empleado</th>
             
              
                 <th>Estado o acción</th>
                <th width="100px">(*)</th>
            </tr>
        </thead>
        <tbody>

        <?php 
      /* $cuenta = $this->db->query("SELECT e.id_empleado, e.nr, UPPER(CONCAT_WS(' ', e.primer_nombre, e.segundo_nombre, e.tercer_nombre, e.primer_apellido, e.segundo_apellido, e.apellido_casada)) AS nombre_completo, p.fecha_mision, SUM(p.monto_pasaje) AS monto_pasaje, p.estado as estado FROM sir_empleado AS e JOIN vyp_pasajes AS p ON p.nr = e.nr AND p.fecha_mision LIKE '%".$fecha_mes."%' GROUP BY e.nr ORDER BY e.primer_nombre, e.segundo_nombre, e.tercer_nombre, e.primer_apellido, e.segundo_apellido, e.apellido_casada");
$cuenta2= $this->db->query("SELECT * FROM vyp_mision_pasajes");
*/


$cuenta = $this->db->query("SELECT e.id_empleado, e.nr, UPPER(CONCAT_WS(' ', e.primer_nombre, e.segundo_nombre, e.tercer_nombre, e.primer_apellido, e.segundo_apellido, e.apellido_casada)) AS nombre_completo,p.mes_pasaje,p.anio_pasaje, p.estado as estado,p.ultima_observacion, p.id_mision_pasajes,p.fecha_solicitud_pasaje FROM sir_empleado AS e JOIN vyp_mision_pasajes AS p ON p.nr = e.nr AND p.mes_pasaje='".$mes."' AND p.anio_pasaje= '".$anio."' GROUP BY e.nr ORDER BY e.primer_nombre, e.segundo_nombre, e.tercer_nombre, e.primer_apellido, e.segundo_apellido, e.apellido_casada");      
            if($cuenta->num_rows() > 0){
                foreach ($cuenta->result() as $fila) {
                  echo "<tr>";
                     //echo "<td>".$fila->id_solicitud_pasaje."</td>";
                          //  $fila->fecha_mision=date("m-Y",strtotime($fila->fecha_mision));
                           // echo "<td>".$fila->fecha_mision."</td>";
                  echo "<td>".$fila->mes_pasaje."</td>";
                  echo "<td>".$fila->anio_pasaje."</td>";
                            echo "<td>".$fila->nombre_completo."</td>";
                        
                           // echo "<td>".$fila->monto_pasaje."</td>";
                           
                             // echo "<td>".$fila->estado."</td>";
                            
                   //if($cuenta2->num_rows() > 0){
//foreach ($cuenta2->result() as $fila2) {

               // if(($fila2->nr==$fila->nr )and ($fila2->mes_pasaje==$mes) and ($fila2->anio_pasaje==$anio) )

//                 {
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
                            }else if($fila ->estado == 8){
                                echo '<td><span class="label label-success">Pagada</span></td>';
                            }
                            
               // }

                // }
                
//} 
               /* else  
                {
                                echo '<td><span class="label label-danger">Incompleta</span></td>';
                            
                } */
                                    echo "<td>";

                if($fila->ultima_observacion == "0000-00-00 00:00:00"){
                $fecha_observacion = "falta";
                            }
                            else{
                                $fecha_observacion = date("Y-m-d",strtotime($fila->ultima_observacion));
                            }
                   $array = array($fila->id_mision_pasajes, /*date("d-m-Y",strtotime($fila->fecha_mision)), */$fila->nombre_completo, date("Y-m-d",strtotime($fila->fecha_solicitud_pasaje)),$fecha_observacion,
                    $fila ->estado);
                    array_push($array, "edit");
                    echo generar_boton($array,"ver_pasajes","btn-info","fa fa-wrench","Editar");
                    echo generar_boton(array($fila->nr, $fila->mes_pasaje),"imprimir_solicitud","btn-default","fa fa-print","Imprimir");
                    //unset($array[endKey($array)]); //eliminar el ultimo elemento de un array
                   // echo generar_boton(array(),"eliminar_pasaje","btn-danger","fa fa-close","Eliminar");
                    echo "</td>";
                  echo "</tr>";
               

                }
            }else{
                echo "<tr>";
                    echo "<td colspan='4'>No hay registros de pasajes</td>";
                echo "</tr>";
            }
        ?>
        </tbody>
    </table>
</div>


<?php 
} else{
?>
    <h5 class="text-muted m-b-0">Seleccione un empleado para configurar pasajes</h5>


<?php
 /*<input type="text" pattern="\d{1,2}-\d{1,2}-\d{4}" data-date-end-date="0d" data-date-start-date="-5d" onkeyup="FECHA('fecha')" required="" value="<?php echo date('d-m-Y'); ?>" class="form-control" id="fecha" name="fecha" placeholder="dd/mm/yyyy" style="width: 120px;"> */
}
?>