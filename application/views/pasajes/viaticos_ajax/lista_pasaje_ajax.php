<?php 
    $nr_empleado = $_GET["nr"];
   $fecha_mes = $_GET["fecha2"];

    if(!empty($nr_empleado) AND !empty($fecha_mes) ){
//echo ($fecha_mes);
?>

<div class="table-responsive container">
    <table id="target" class="table table-hover product-overview" style="margin-bottom: 0px;">
        <thead class="bg-inverse text-white">
            <tr>
                <th>Fecha</th>
                <th>Nombre del empleado</th>
                <th>Monto</th>
                <th width="100px">(*)</th>
            </tr>
        </thead>
        <tbody>

        <?php 
       $cuenta = $this->db->query("SELECT e.id_empleado, e.nr, UPPER(CONCAT_WS(' ', e.primer_nombre, e.segundo_nombre, e.tercer_nombre, e.primer_apellido, e.segundo_apellido, e.apellido_casada)) AS nombre_completo, p.fecha_mision, SUM(p.monto_pasaje) AS monto_pasaje FROM sir_empleado AS e JOIN vyp_pasajes AS p ON p.nr = e.nr AND p.fecha_mision LIKE '%".$fecha_mes."%' AND e.id_estado = '00001' GROUP BY e.nr ORDER BY e.primer_nombre, e.segundo_nombre, e.tercer_nombre, e.primer_apellido, e.segundo_apellido, e.apellido_casada");
            if($cuenta->num_rows() > 0){
                foreach ($cuenta->result() as $fila) {
                  echo "<tr>";
                     //echo "<td>".$fila->id_solicitud_pasaje."</td>";
                            $fila->fecha_mision=date("m-Y",strtotime($fila->fecha_mision));
                            echo "<td>".$fila->fecha_mision."</td>";
                            echo "<td>".$fila->nombre_completo."</td>";
                            echo "<td>".$fila->monto_pasaje."</td>";
                    echo "<td>";
                   $array = array(date("d-m-Y",strtotime($fila->fecha_mision)), $fila->nombre_completo,$fila->monto_pasaje);
                    array_push($array, "edit");
                    echo generar_boton($array,"ver_pasajes","btn-info","fa fa-wrench","Editar");
                    echo generar_boton(array($fila->nr, $fila->fecha_mision),"imprimir_solicitud","btn-default","fa fa-print","Imprimir");
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