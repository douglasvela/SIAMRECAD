
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
     
   echo '<input type="text" id="nr_jefe_inmediato" name="nr_jefe_inmediato" value="'.$nr_jefe_inmediato.'" required style="visibility:hidden">';
    echo '<input type="text" id="nr_jefe_regional" name="nr_jefe_regional" value="'.$nr_jefe_regional.'" required style="visibility:hidden">';


    }

    //list($mes_pasaje, $anio_pasaje)= explode ("-",$fecha_mes);
?>
<style type="text/css" media="screen">
  table {
  font-size: 62.5%;
}
</style>
  

      
<div class="table-responsive">
    <table id="myTable" class="table table-hover product-overview" style="margin-bottom: 0px;">
        <thead class="bg-inverse text-white">
            <tr>
                <th >Fecha</th>
                <th>No. Expediente</th>
                <th>Departamento</th>
                <th>Municipio</th>
                <th>Empresa visitada</th>
                <th>Direccion</th>
                <th>Actividad realizada</th>
                 <th>Monto</th>
                <th>(*)</th>
            </tr>
        </thead>
        <tbody>

        <tr>
            <td>
              <input type="text" pattern="\d{1,2}-\d{1,2}-\d{4}" required=""  class="form-control" id="fecha" name="fecha" placeholder="dd/mm/yyyy"  onchange ="info_pasajes();"   >
            </td>
            <td  >
              <input type="text" id="expediente" name="expediente" class="form-control"  >
            </td>
            <td>
              <div class="" id="combo_departamento" ></div>                            
            </td>
            <td>
              <div class="" id="combo_municipio" ></div>
            </td>
            <td>
              <input type="text" id="empresa" name="empresa" class="form-control" required="" data-validation-required-message="Este campo es requerido"  > 
            </td>
            <td>
              <input type="text"  id="direccion" name="direccion" class="form-control" required="" placeholder="Escriba la dirección" minlength="3" data-validation-required-message="Este campo es requerido">
            </td>
            <td >
              <select id="id_actividad" name="id_actividad" class="select2" required=''  style="width: 100%" >
                <option value=''>[Elija una actividad]</option>
                <?php 
                  $actividad = $this->db->query("SELECT * FROM vyp_actividades WHERE depende_vyp_actividades = 0 OR depende_vyp_actividades = '' OR depende_vyp_actividades IS NULL");
                  if($actividad->num_rows() > 0){
                    foreach ($actividad->result() as $filaa) {              
                      echo '<option class="m-l-50" value="'.$filaa->id_vyp_actividades.'">'.$filaa->nombre_vyp_actividades.'</option>';
                      $activida_sub = $this->db->query("SELECT * FROM vyp_actividades WHERE depende_vyp_actividades = '".$filaa->id_vyp_actividades."'");
                      if($activida_sub->num_rows() > 0){
                        foreach ($activida_sub->result() as $filasub) {              
                          echo '<option class="m-l-50" value="'.$filasub->id_vyp_actividades.'"> &emsp;&#x25B6; '.$filasub->nombre_vyp_actividades.'</option>';
                        }
                      }
                    }
                  }
                ?>
              </select>
            </td>
            <td  >
              <input type="text" id="monto" name="monto" class="form-control" required="" data-validation-required-message="Este campo es requerido"  >
            </td>
            <td>
              <button type="submit" class="btn waves-effect waves-light btn-rounded btn-sm btn-success2" data-toggle="tooltip" title="Agregar" ><span class="fa fa-plus"></span></button>
            </td>  
        </tr>
        <?php

        list($otrafecha)= explode ("-",$fecha_mes); 
        list($anio, $mes)= explode ("-",$fecha_mes);  

      $cuenta = $this->db->query("SELECT p.*, m.municipio as municipio, d.departamento as departamento, a.nombre_vyp_actividades AS nombre_actividad FROM org_municipio AS m JOIN vyp_pasajes AS p JOIN org_departamento as d JOIN vyp_actividades as a ON p.nr = '".$nr_empleado."' AND p.fecha_mision LIKE '%".$fecha_mes."%' AND m.id_municipio=p.id_municipio AND d.id_departamento=p.id_departamento AND p.id_actividad_realizada=a.id_vyp_actividades ORDER BY p.fecha_mision");
            if($cuenta->num_rows() > 0){
                foreach ($cuenta->result() as $fila) {
                  echo "<tr>";
                             $fila->fecha_mision=date("d-m-Y",strtotime($fila->fecha_mision));
                            echo "<td>".$fila->fecha_mision."</td>";
                            echo "<td>".$fila->no_expediente."</td>";
                            echo "<td>".$fila->departamento."</td>";
                            echo "<td>".$fila->municipio."</td>";
                            echo "<td>".$fila->empresa_visitada."</td>";
                            echo "<td>".$fila->direccion_empresa."</td>";
                            echo "<td>".$fila->nombre_actividad."</td>";
                            echo "<td>".$fila->monto_pasaje."</td>";
                    echo "<td>";
                   $array = array($fila->id_solicitud_pasaje, date("d-m-Y",strtotime($fila->fecha_mision)), $fila->no_expediente,$fila->empresa_visitada,$fila->direccion_empresa, $fila->nr,$fila->monto_pasaje,$fila->departamento, $fila->municipio, $fila->nombre_actividad);
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
    <h5 class="text-muted m-b-0">Ingrese un solicitante y una fecha para ver solicitudes de pasajes</h5>
<?php
 }
?>
<script>
$(function(){
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
});
</script>