<div class="card">
  <div class="card-header">
    <div class="card-actions">
           
    </div>
      <h4 align="center" class="card-title m-b-0">MINISTERIO DE TRABAJO Y PREVISION SOCIAL <p align="center">POLIZA DE REINTEGRO DEL FONDO CIRCULANTE</p></h4>
        
</div>
    <div class="card-body b-t"  style="padding-top: 7px;">
      <div class="table-responsive">
      <table>
      <div class="form-group col-lg-6">
       <tr>
      <th ><h5>INSTITUCIÓN: <span class="text-danger">*</span><span class="controls">
          <input type="text" id="nombre" name="nombre" class="form-control" required="" data-validation-required-message="Este campo es requerido" />
          </span></h5></th >
          <th><h5>CÓDIGO PRESUPUESTARIO: <span class="text-danger">*</span><span class="controls">
            <input type="text" id="nombre" name="nombre" class="form-control" required="" data-validation-required-message="Este campo es requerido" >
          </span></h5></th>
         <th> <h5>DENOMINACIÓN DEL MONTO FIJO: <span class="text-danger">*</span><span class="controls">
            <input type="text" id="nombre" name="nombre" class="form-control" required="" data-validation-required-message="Este campo es requerido" >
          </span></h5></th>
         <th> <h5>MONTO TOTAL DEL REINTEGRO:<span class="text-danger">*</span><span class="controls">
            <input type="text" id="nombre" name="nombre" class="form-control" required="" data-validation-required-message="Este campo es requerido">
          </span></h5>
          <h5>DENOMINACIÓN DEL MONTO FIJO: <span class="text-danger">*</span><span class="controls">
            <input type="text" id="nombre" name="nombre" class="form-control" required="" data-validation-required-message="Este campo es requerido" />
          </span></h5>
<th><h5>CANTIDAD EN LETRAS: <span class="text-danger">*</span><span class="controls">
            <input type="text" id="nombre" name="nombre" class="form-control" required="" data-validation-required-message="Este campo es requerido" >
          </span></h5></th>
           </tr>
          </div>
                                  
          <div class="controls"></div>
<div class="table-responsive">
  <table id="myTable" class="table table-bordered product-overview">
                <thead class="bg-info text-white">
                    <tr>
                        <th width="59" rowspan="2">No.DOC</th>
                        <th width="81" rowspan="2">No.POLIZA</th>
                        <th width="81" rowspan="2">MES DE LA POLIZA</th>
                        <th width="183" rowspan="2">FECHA DE ELABORACION DEL FORMULARIO</th>
                         <th width="107" rowspan="2">No. CHEQUE O CARGO CTA</th>
                          <th width="118" rowspan="2">CÓDIGO DEL EMPLEADO</th>
                          <th width="83" rowspan="2">FECHA DE MISIÓN</th>
                          <th width="41" rowspan="2">SEDE</th>
                          <th width="110" rowspan="2">CARGO FUNCIONAL</th>
                          <th width="44" rowspan="2">UP/LT</th>
                        <th width="150" colspan="4" >DETALLE DE OBJETOS ESPECIFICOS </th>
                        <th width="20" rowspan="2" style="min-width: 85px;">TOTAL</th>
                    </tr>
                    <tr>
                      <th >54401</th>
                      <th >VALOR</th>
                      <th >54403</th>
                      <th >VALOR</th>
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
            <script>
$(function(){
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
});
            </script>
</div>
