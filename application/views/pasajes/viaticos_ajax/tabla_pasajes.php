

<?php 
    $nr_empleado = $_GET["nr"];
   $fecha_mes = $_GET["fecha1"];
  
    if(!empty($nr_empleado) AND !empty($fecha_mes)){
    $info_empleado = $this->db->query("SELECT * FROM vyp_informacion_empleado WHERE nr = '".$nr_empleado."'");
    if($info_empleado->num_rows() > 0){ 
        foreach ($info_empleado->result() as $filas) {}
        $oficina_origen = $this->db->query("SELECT * FROM vyp_oficinas WHERE id_oficina = '".$filas->id_oficina_departamental."'");
      if($oficina_origen->num_rows() > 0){ 
          foreach ($oficina_origen->result() as $filaofi) {}
      }
      $director_jefe_regional = $this->db->query("SELECT nr FROM sir_empleado WHERE id_empleado = '".$filaofi->jefe_oficina."'");
      if($director_jefe_regional->num_rows() > 0){ 
          foreach ($director_jefe_regional->result() as $filadir) {}
      }
      $nr_jefe_inmediato = $filas->nr_jefe_inmediato;
      $nr_jefe_regional = $filadir->nr;
     
    echo '<input type="text" id="nr_jefe_inmediato" name="nr_jefe_inmediato" value="'.$nr_jefe_inmediato.'" required>';
    echo '<input type="text" id="nr_jefe_regional" name="nr_jefe_regional" value="'.$nr_jefe_regional.'" required>';
    }
?>

      
<div class="table-responsive">
    <table id="target" class="table table-hover product-overview" style="margin-bottom: 0px;">
        <thead class="bg-inverse text-white">
            <tr>
                <th>Fecha</th>
                <th>No. Expediente</th>
                <th>Departamento</th>
                <th>Municipio</th>
                <th>Empresa visitada</th>
                <th>Direccion</th>
                 <th>Monto</th>
                 <th>Estado</th>
                <th width="100px">(*)</th>
            </tr>
        </thead>
        <tbody>

<tr>

            <td style="padding: 7px 5px;">
              

              <input type="text" pattern="\d{1,2}-\d{1,2}-\d{4}" required=""  class="form-control" id="fecha" name="fecha" placeholder="dd/mm/yyyy" style="width: 120px;" onchange ="info_pasajes();">
            </td>

            <td style="padding: 7px 5px;">
                 <input type="text" id="expediente" name="expediente" class="form-control" style="width: 130px;">
            </td>
          <td style="padding: 7px 5px;">
            <input type="text" id="departamento" name="departamento" class="form-control" required="" data-validation-required-message="Este campo es requerido"> 
                                
                                </td>
                              <td style="padding: 7px 5px;">
                                 <input type="text" id="municipio" name="municipio" class="form-control" required="" data-validation-required-message="Este campo es requerido"> 
                                </td>

            <td style="padding: 7px 5px;">
                <input type="text" id="empresa" name="empresa" class="form-control" required="" data-validation-required-message="Este campo es requerido"> 
            </td>
            <td style="padding: 7px 5px;">
                <input type="text"  id="direccion" name="direccion" class="form-control" required="" placeholder="Escriba la dirección" minlength="3" data-validation-required-message="Este campo es requerido" style="width: 450px;">

            </td>
            <td colspan="2" style="padding: 7px 5px;">
                <input type="text" id="monto" name="monto" class="form-control" required="" data-validation-required-message="Este campo es requerido" style="width: 80px;">
            </td>

            <td style="padding: 7px 5px;" >
            
           <button type="submit" class="btn waves-effect waves-light btn-rounded btn-sm btn-success2" data-toggle="tooltip" title="Agregar"><span class="fa fa-plus"></span></button>
              
            </td>  
</tr>
        <?php 

          $cuenta = $this->db->query("SELECT p.*, m.municipio as municipio, d.departamento as departamento FROM org_municipio AS m JOIN vyp_pasajes AS p JOIN org_departamento as d ON p.nr = '".$nr_empleado."' AND p.fecha_mision LIKE '%".$fecha_mes."%' AND m.id_municipio=p.id_municipio AND d.id_departamento=p.id_departamento AND d.id_departamento = m.id_departamento_pais ORDER BY p.fecha_mision");
            if($cuenta->num_rows() > 0){
                foreach ($cuenta->result() as $fila) {
                  echo "<tr>";
                 //echo "<td>".$fila->id_solicitud_pasaje."</td>";
                             $fila->fecha_mision=date("d-m-Y",strtotime($fila->fecha_mision));
                            echo "<td>".$fila->fecha_mision."</td>";
                             echo "<td>".$fila->no_expediente."</td>";
                            echo "<td>".$fila->departamento."</td>";
                            echo "<td>".$fila->municipio."</td>";
                           
                             echo "<td>".$fila->empresa_visitada."</td>";
                             echo "<td>".$fila->direccion_empresa."</td>";
                             // echo "<td>".$fila->nr."</td>";
                              echo "<td>".$fila->monto_pasaje."</td>";
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
                    echo "<td>";
                   $array = array($fila->id_solicitud_pasaje, date("d-m-Y",strtotime($fila->fecha_mision)), $fila->no_expediente,$fila->empresa_visitada,$fila->direccion_empresa, $fila->nr,$fila->monto_pasaje);
                    array_push($array, "edit");
                    echo generar_boton($array,"cambiar_editar","btn-info","fa fa-wrench","Editar");
                    unset($array[endKey($array)]); //eliminar el ultimo elemento de un array
                    echo generar_boton(array($fila->id_solicitud_pasaje),"eliminar_pasaje","btn-danger","fa fa-close","Eliminar");
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