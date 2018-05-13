<?php

function mes($mes){
 setlocale(LC_TIME, 'spanish');  
 $nombre=strftime("%B",mktime(0, 0, 0, $mes, 1, 2000)); 
 return strtoupper($nombre);
}


?>
<script type="text/javascript">
  var orden_poliza = "automatico";
  var contador_clic = 0;
  var primer_index;
  var segundo_index;

  function iniciar(){
    tabla_poliza();
  }

  function tabla_generar_poliza(num_poliza, mes, anio){
    var newName = 'AjaxCall', xhr = new XMLHttpRequest();

    xhr.open('GET', "<?php echo site_url(); ?>/poliza/poliza_presupuesto/tabla_generar_poliza?mes="+mes+"&anio="+anio+"&num_poliza="+num_poliza);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (xhr.status === 200 && xhr.responseText !== newName) {
            document.getElementById("cnt_generar_poliza").innerHTML = xhr.responseText;

            $("#nombre5").val($("#total").val());
            $("#nombre6").text($("#total_texto").val());

            calcular();
            
        }else if (xhr.status !== 200) {
            swal({ title: "Ups! ocurrió un Error", text: "Al parecer la tabla de poliza generada no se cargó correctamente por favor recarga la página e intentalo nuevamente", type: "error", showConfirmButton: true });
        }
    };
    xhr.send(encodeURI('name=' + newName));
  }

  function tabla_poliza(){
    var newName = 'AjaxCall', xhr = new XMLHttpRequest();

    xhr.open('GET', "<?php echo site_url(); ?>/poliza/poliza_presupuesto/tabla_poliza");
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (xhr.status === 200 && xhr.responseText !== newName) {
            document.getElementById("cnt_tabla_poliza").innerHTML = xhr.responseText;
        }else if (xhr.status !== 200) {
            swal({ title: "Ups! ocurrió un Error", text: "Al parecer la tabla de poliza generada no se cargó correctamente por favor recarga la página e intentalo nuevamente", type: "error", showConfirmButton: true });
        }
    };
    xhr.send(encodeURI('name=' + newName));
  }


  function recorrer_poliza(){
    var filas = $("#tabla_poliza>tbody").find("tr");
    var idspoliza = "";

    if((filas.length-1) > 0 && $("#nombre11").val() != ""){

      var script = "UPDATE vyp_poliza SET\n";
      var linea_presupuestaria2 = "linea_presup2 = CASE id_poliza\n";
      var compromiso_presupuest = "compromiso_presupuestario = CASE id_poliza\n";

      var compromiso = $("#nombre11").val();

      for(i=0; i< (filas.length-1); i++){
        var celdas = $(filas[i]).children("td");

        var idpol = $($(celdas[0]).children("input")[0]).val();
        var linea = $(celdas[10]).text().trim();
        var mescb = $("#nombre7").val();
        var anioc = $("#nombre8").val();
        var npoli = $("#nombre1").val();

        if(i == (filas.length-2)){
          idspoliza += idpol;
          linea_presupuestaria2 += "WHEN "+idpol+" THEN '"+linea+"'\n";
          compromiso_presupuest += "WHEN "+idpol+" THEN '"+compromiso+"'\n";
        }else{
          idspoliza += idpol+", ";
          linea_presupuestaria2 += "WHEN "+idpol+" THEN '"+linea+"'\n";
          compromiso_presupuest += "WHEN "+idpol+" THEN '"+compromiso+"'\n";
        }
      }

      script += linea_presupuestaria2+"END,\n"+compromiso_presupuest+"END\nWHERE id_poliza IN ("+idspoliza+");";

      //$("#area").val(script)
      editar_poliza(script, npoli, anioc)

    }else{
      if($("#nombre11").val() == ""){
        swal({ title: "# de compromiso", text: "Falta el número de compromiso presupuestario.", type: "warning", showConfirmButton: true });
      }else{
        swal({ title: "Póliza vacía", text: "No se puede editar una poliza sin viáticos.", type: "warning", showConfirmButton: true });
      }
    }

  }

  function editar_poliza(sql, no_poliza, anio){
      var formData = {
          "sql" : sql,
          "no_poliza" : no_poliza,
          "anio" : anio
      };
      $.ajax({
          type:  'POST',
          url:   '<?php echo site_url(); ?>/poliza/poliza_presupuesto/editar_poliza',
          data: formData,
          cache: false
      })
      .done(function(data){
          if(data == "exito"){
              swal({ title: "¡Edición exitosa!", type: "success", showConfirmButton: true });
              tabla_poliza();
              cerrar_mantenimiento();
          }else{
              swal({ title: "¡Ups! Error", text: "Intentalo nuevamente.", type: "error", showConfirmButton: true });
          }
      });
  }

  function eliminar_poliza(no_poliza){
      var formData = {
          "no_poliza" : no_poliza
      };
      $.ajax({
          type:  'POST',
          url:   '<?php echo site_url(); ?>/poliza/poliza_presupuesto/eliminar_poliza',
          data: formData,
          cache: false
      })
      .done(function(data){
          if(data == "exito"){
              swal({ title: "¡Registro exitoso!", type: "success", showConfirmButton: true });
          }else{
              swal({ title: "¡Ups! Error", text: "Intentalo nuevamente.", type: "error", showConfirmButton: true });
          }
          tabla_poliza();
      });
  }

  function cambiar_editar(no_poliza, mes_poliza, anio_poliza, total, estado, cpresupuestario, nombre_banco, cuenta_bancaria, band){
    if(band == "edit"){
      $("#nombre1").val(no_poliza)
      $("#nombre7").val(mes_poliza)
      $("#nombre8").val(anio_poliza)
      $("#nombre3").val(cpresupuestario)
      $("#nombre9").val(nombre_banco)
      $("#nombre10").val(cuenta_bancaria)
      cambiar_nuevo();
      tabla_generar_poliza(no_poliza, mes_poliza, anio_poliza)
    }else{
      swal({   
        title: "¿Está seguro?",   
        text: "¡Desea eliminar el registro!",   
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#fc4b6c",   
        confirmButtonText: "Sí, deseo eliminar!",   
        closeOnConfirm: false 
      }, function(){   
          eliminar_poliza(no_poliza);
      });
    }
  }

  function cambiar_nuevo(){
    $("#cnt_registros_polizas").hide(300);
    $("#cnt_poliza").show(300);
    $("#nombre11").val("")
  }

  function cerrar_mantenimiento(){
    $("#cnt_registros_polizas").show(300);
    $("#cnt_poliza").hide(300);
  }

  function cambiar_orden(tipo){
    orden_poliza = tipo;
    tabla_generar_poliza();
    if(tipo == "manual"){
      $("#cnt_manual").hide(0);
      $("#cnt_automatico").show(0);
    }else{
      $("#cnt_manual").show(0);
      $("#cnt_automatico").hide(0);
    }
  }

  function imprimir_poliza(no_poliza, mes, anio){
    window.open("<?php echo site_url(); ?>/poliza/poliza/imprimir_poliza?no_poliza="+no_poliza+"&mes="+mes+"&anio="+anio, '_blank');
  }

  function nuevo_clic(obj){
    contador_clic++;
    if(contador_clic == 1){
      $(obj).addClass("table-warning");
      primer_index = $(obj).index();
      $.toast({ heading: 'Selección habilitada', text: 'Seleccione el ultimo registro al que desea modificar la linea presupuestaria', position: 'top-right', loaderBg:'#000', icon: 'info', hideAfter: 4000, stack: 6 });
    }else{
      var registros = $("#tabla_poliza>tbody").find("tr");
      $("#tabla_poliza>tbody").find("tr").removeClass("table-warning");
      segundo_index = $(obj).index();
      if(segundo_index < primer_index){
        var aux = segundo_index;
        segundo_index = primer_index;
        primer_index = aux;
      }

      for(i = primer_index; i<= segundo_index; i++){
        $(registros[i]).addClass("table-warning");
      }

      $("#modal_linea").modal("show");
    }
  }

  function reemplazar_linea(){
    var registros = $("#tabla_poliza>tbody").find("tr");

      for(i = primer_index; i<= segundo_index; i++){
        var celdas = $(registros[i]).children("td");

        $(celdas[10]).text($("#id_linea").val());
      }

      cancelar();
      calcular();
  }

  function cancelar(){
    $("#tabla_poliza>tbody").find("tr").removeClass("table-warning");
    contador_clic = 0;
    primer_index = "";
    segundo_index = "";
  }

  function calcular(){
    var arreglo = [];
    var arreglo2 = [];
    var fila = $("#tabla_poliza>tbody").find("tr");
    var contar = 0;
    var contar2 = 0;

    for(j=0; j< fila.length-1; j++){
      var celdas = $(fila[j]).find("td");

      var linea1 = $(celdas[9]).text().trim();
      var monto = $(celdas[13]).text().trim();
      monto = monto.substring(2, monto.length);

      if(typeof(arreglo[linea1]) == "undefined"){
        contar++;
        arreglo[linea1] = [linea1, 0];
        arreglo[linea1][1] = parseFloat(arreglo[linea1][1]) + parseFloat(monto);
      }else{
        arreglo[linea1][1] = parseFloat(arreglo[linea1][1]) + parseFloat(monto);
      }
    }

    arreglo = sortProperties(arreglo);
    var registros = "";
    var registros2 = "";

    for(h=0; h<arreglo.length; h++){
      registros += "<td>"+arreglo[h][0]+"</td>";
      registros2 +="<td>$ "+(arreglo[h][1][1]).toFixed(2)+"</td>";
    }

    registros = "<thead><tr><th colspan='"+(contar+1)+"' class='bg-inverse text-white'>Subtotales originales</th></tr></thead><tbody><tr><th class='bg-inverse text-white'>Líneas</th>"+registros+"<tr>";
    registros += "<tr><th class='bg-inverse text-white'>Total</th>"+registros2+"<tr></tbody>";


    $("#subtotales1").html(registros);

    for(l=0; l< fila.length-1; l++){
      var celdas = $(fila[l]).find("td");

      var linea1 = $(celdas[10]).text().trim();
      var monto = $(celdas[13]).text().trim();
      monto = monto.substring(2, monto.length);

      if(typeof(arreglo2[linea1]) == "undefined"){
        contar2++;
        arreglo2[linea1] = [parseInt(linea1), 0];
        arreglo2[linea1][1] = parseFloat(arreglo2[linea1][1]) + parseFloat(monto);
      }else{
        arreglo2[linea1][1] = parseFloat(arreglo2[linea1][1]) + parseFloat(monto);
      }
    }

    arreglo2 = sortProperties(arreglo2);
    var registros = "";
    var registros2 = "";

    for(k=0; k<arreglo2.length; k++){
      registros += "<td>"+arreglo2[k][0]+"</td>";
      registros2 +="<td>$ "+(arreglo2[k][1][1]).toFixed(2)+"</td>";
    }

    registros = "<thead><tr><th colspan='"+(contar2+1)+"' class='bg-inverse text-white'>Subtotales del área de presupuesto</th></tr></thead><tbody><tr><th class='bg-inverse text-white'>Líneas</th>"+registros+"<tr>";
    registros += "<tr><th class='bg-inverse text-white'>Total</th>"+registros2+"<tr></tbody>";

    $("#subtotales2").html(registros);
  }

  function sortProperties(obj)
{
  // convert object into array
  var sortable=[];
  for(var key in obj)
    if(obj.hasOwnProperty(key))
      sortable.push([key, obj[key]]); // each item is an array in format [key, value]
  
  // sort items by value
  sortable.sort(function(a, b)
  {
    var x=a[1].toString(),
      y=b[1].toString();
    return x<y ? -1 : x>y ? 1 : 0;
  });
  return sortable; // array in format [ [ key1, val1 ], [ key2, val2 ], ... ]
}

</script>

  <div class="page-wrapper">
    <div class="container-fluid">
      <!-- ============================================================== -->
        <!-- TITULO de la página de sección -->
        <!-- ============================================================== -->
        <div class="row page-titles">
            <div class="align-self-center" align="center">
                <h3 class="text-themecolor m-b-0 m-t-0">
                  <?php 
                    echo $titulo = ucfirst("Gestión de polizas (presupuesto)"); 
                  ?>
                  </h3>
            </div>
        </div>
    

    <div id="cnt_registros_polizas">
      
      <div id="cnt_tabla_poliza"></div>
    </div>

    <div id="cnt_poliza" style="display: none;">
      <div class="pull-right">          
        <button type="button" onclick="cerrar_mantenimiento();" class="btn waves-effect waves-light btn-default" data-toggle="tooltip" title="Clic para regresar"><span class="mdi mdi-undo"></span> Volver</button>
    </div>
      <div class="table-responsive">
            <div class="align-self-center" align="center">
                   <h4 align="center" class="card-title m-b-0">MINISTERIO DE TRABAJO Y PREVISION SOCIAL <p align="center">POLIZA DE REINTEGRO DEL FONDO CIRCULANTE</p></h4>
       
            <table width="1206" height="166" border="0">
              <tr>
                <td width="326"><h5 align="justify">No. POLIZA: </h5></td>
                <td width="257"><div align="justify"><span class="controls">
                  <input type="text" id="nombre1" name="nombre1" class="form-control" style="background-color: #fff;" readonly="">
                </span></div></td>
                <td> <h5 align="justify"> MES:</h5></td>
                <td><div align="justify"><span class="controls">
                  <select class="custom-select" id="nombre7" style="width: 100%; background-color: #fff;" disabled>
                    <?php
                      for($i=1; $i<=12; $i++){
                        if($i>9){
                          echo '<option value="'.$i.'">'.mes($i).'</option>';
                        }else{
                          echo '<option value="0'.$i.'">'.mes($i).'</option>';
                        }
                      }
                    ?>
                    </select>
                </span></div></td>
              </tr>
              <tr>
                <td><h5 align="justify">INSTITUCIÓN:</h5></td>
                <td ><div align="justify"><span class="controls">
                  <input type="text" id="nombre2" name="nombre2" class="form-control" value="MINISTERIO DE TRABAJO Y PREVISION SOCIAL" readonly="" style="background-color: #fff;"/>
                </span></div></td>
                <td> <h5 align="justify"> EJERCICIO FINANCIERO FISCAL: </h5></td>
                <td><div align="justify"><span class="controls">
                  <input type="text" id="nombre8" name="nombre8" class="form-control" readonly style="background-color: #fff;"/>
                </span></div></td>
              </tr>
              <tr>
                <td height="25"><h5 align="justify">CÓDIGO PRESUPUESTARIO: </h5></td>
                <td><div align="justify"><span class="controls">
                  <input type="text" id="nombre3" name="nombre3" class="form-control" readonly style="background-color: #fff;"/>
                </span></div></td>
                <td> <h5 align="justify"> NOMBRE DEL BANCO: </h5></td>
                <td><div align="justify"><span class="controls">
                  <input type="text" id="nombre9" name="nombre9" class="form-control" readonly style="background-color: #fff;"/>
                </span></div></td>
              </tr>
              <tr>
                <td height="25"><h5 align="justify">DENOMINACIÓN DEL MONTO FIJO: </h5></td>
                <td><div align="justify"><span class="controls">
                  <input type="text" id="nombre4" name="nombre4" class="form-control" value="FONDO CIRCULANTE DEL MTPS" readonly style="background-color: #fff;"/>
                </span></div></td>
                <td> <h5 align="justify">No. CUENTA BANCARIA: </h5></td>
                <td><div align="justify"><span class="controls">
                  <input type="text" id="nombre10" name="nombre10" class="form-control" readonly style="background-color: #fff;" />
                </span></div></td>
              </tr>
              <tr>
                <td height="25"> <h5 align="justify"> MONTO TOTAL DEL REINTEGRO: </h5></td>
                <td><div align="justify"><span class="controls">
                  <div class="input-group">
                      <div class="input-group-addon"><i class="fa fa-dollar"></i></div>
                      <input type="number" id="nombre5" name="nombre5" class="form-control" readonly style="background-color: #fff;">
                  </div>
                </span></div></td>
                <td><h5 align="justify">No. COMPROMISO PRESUPUESTARIO:</h5></td>
                <td><div align="justify"><span class="controls">
                  <input type="text" id="nombre11" name="nombre11" class="form-control" />
                </span></div></td>
              </tr>
              <tr>
                <td height="25"> <h5 align="justify">CANTIDAD EN LETRAS: </h5></td>
                <td><div align="justify"><span class="controls">
                <small id="nombre6"></small>
                </span></div></td>
                <td><h5 align="justify">FECHA DE CANCELADO: </h5></td>
                <td><div align="justify"><span class="controls">
                  <input type="text" id="nombre12" name="nombre12" class="form-control" readonly style="background-color: #fff;"/>
                </span></div></td>
              </tr>
            </table>
      </div>

      <div class="table-responsive">
        <table class="table table-hover table-bordered bg-white" style="width: 100%; font-size: 13px;" id="subtotales1">
        </table>
      </div>

      <div class="table-responsive">
        <table class="table table-hover table-bordered bg-white" style="width: 100%; font-size: 13px;" id="subtotales2">
        </table>
      </div>
     
      <div id="cnt_generar_poliza"></div>
    </div>

    <div align="right">
      <button type="button" onclick="recorrer_poliza();" class="btn btn-info">Guardar ediciones</button>
    </div>
    
    <br>

    <div class="form-group" style="display: none;">
        <textarea id="area" class="form-control" rows="10"></textarea>
    </div>

 </div>
</div>


<div id="modal_linea" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Cambio de línea presupuestaria</h4>
                <button type="button" class="close" onclick="cancelar();" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                 <div class="row container">
                    <div class="col-lg-12">
                        <h5>Línea presupuestaria</h5>
                        <select id="id_linea" name="id_linea" class="select2" style="width: 100%" required>
                            <option value=''>[Elija la nueva línea presupuestaria]</option>
                            <?php
                                $linea_presupuestaria = $this->db->query("SELECT * FROM org_linea_trabajo ORDER BY linea_trabajo");
                                if($linea_presupuestaria->num_rows() > 0){
                                    foreach ($linea_presupuestaria->result() as $fila2) {              
                                       echo '<option class="m-l-50" value="'.$fila2->linea_trabajo.'">'.$fila2->linea_trabajo.'</option>';
                                    }
                                }
                             ?>
                        </select>
                    </div>
                 </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" onclick="cancelar();" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-info waves-effect text-white" onclick="reemplazar_linea();" data-dismiss="modal">Confirmar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


</div>