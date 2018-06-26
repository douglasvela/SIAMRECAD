<?php

function mes($mes){$mesesarray = array('ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE'); return $mesesarray[($mes-1)]; }


$generalidades = $this->db->query("SELECT * FROM vyp_generalidades");

$id_generalidad = ""; $pasaje = "0.00"; $alojamiento = "0.00"; $num_cuenta = ""; $id_banco = ""; $banco = ""; $num_cuenta = "";
if($generalidades->num_rows() > 0){
    foreach ($generalidades->result() as $filag) {
      $id_generalidad = $filag->id_generalidad;
      $pasaje = $filag->pasaje;
      $alojamiento = $filag->alojamiento;
      $id_banco = $filag->id_banco;
      $banco = mb_strtoupper($filag->banco);
      $num_cuenta = $filag->num_cuenta;
      $limite_poliza = $filag->limite_poliza;
      $cod_presupuestario = $filag->codigo_presupuestario;
    }
}

?>

<script type="text/javascript">
  var orden_poliza = "automatico";

  function iniciar(){
    <?php if(tiene_permiso($segmentos=2,$permiso=1)){ ?>
    tabla_poliza();
    <?php }else{ ?>
            $("#cnt_tabla_poliza").html("Usted no tiene permiso para este formulario.");     
      <?php } ?>
  }

  function tabla_generar_poliza(){
    var mes = $("#nombre7").val();
    var anio = $("#nombre8").val();
    var num_poliza = $("#nombre1").val();
    var tipo_poliza = $("#tipo_poliza").val();

    var newName = 'AjaxCall', xhr = new XMLHttpRequest();

    xhr.open('GET', "<?php echo site_url(); ?>/poliza/poliza/tabla_generar_poliza?mes="+mes+"&anio="+anio+"&num_poliza="+num_poliza+"&orden_poliza="+orden_poliza+"&tipo_poliza="+tipo_poliza);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (xhr.status === 200 && xhr.responseText !== newName) {
            document.getElementById("cnt_generar_poliza").innerHTML = xhr.responseText;

            $("#nombre5").val($("#total").val());
            $("#nombre6").text($("#total_texto").val());
            $("#nombre1").val($("#no_poliza").val());
            if($("#restantes").val() == "0"){
              $("#btn_restantes").html($("#restantes").val())
            }else{
              $("#btn_restantes").html('<span class="label label-danger">'+$("#restantes").val()+'</span>')
            }

            $("#body_tabla").html(decodeURIComponent(escape(atob($("#filas_tabla").val()))));

            sortTable()
            
        }else if (xhr.status !== 200) {
            swal({ title: "Ups! ocurrió un Error", text: "Al parecer la tabla de poliza generada no se cargó correctamente por favor recarga la página e intentalo nuevamente", type: "error", showConfirmButton: true });
        }
    };
    xhr.send(encodeURI('name=' + newName));
  }

  function tabla_poliza(){
    var newName = 'AjaxCall', xhr = new XMLHttpRequest();

    xhr.open('GET', "<?php echo site_url(); ?>/poliza/poliza/tabla_poliza");
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (xhr.status === 200 && xhr.responseText !== newName) {
            document.getElementById("cnt_tabla_poliza").innerHTML = xhr.responseText;
            $('#myTable').DataTable();
        }else if (xhr.status !== 200) {
            swal({ title: "Ups! ocurrió un Error", text: "Al parecer la tabla de poliza generada no se cargó correctamente por favor recarga la página e intentalo nuevamente", type: "error", showConfirmButton: true });
        }
    };
    xhr.send(encodeURI('name=' + newName));
  }




  function sortTable() {
  var table, rows, switching, i, x, y, shouldSwitch;
  table = document.getElementById("body_poliza");
  switching = true;
  /* Make a loop that will continue until
  no switching has been done: */
  while (switching) {
    // Start by saying: no switching is done:
    switching = false;
    rows = table.getElementsByTagName("TR");
    /* Loop through all table rows (except the
    first, which contains table headers): */

    for (i = 0; i < (rows.length - 2); i++) {
      // Start by saying there should be no switching:
      shouldSwitch = false;
      /* Get the two elements you want to compare,
      one from current row and one from the next: */
      x = rows[i].getElementsByTagName("TD")[11];
      y = rows[i + 1].getElementsByTagName("TD")[11];
      // Check if the two rows should switch place:
      if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
        // I so, mark as a switch and break the loop:
        shouldSwitch= true;
        break;
      }
    }
    if (shouldSwitch) {
      /* If a switch has been marked, make the switch
      and mark that a switch has been done: */
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
    }
  }

  var filas = $("#tabla_poliza>tbody").find("tr");
  if((filas.length-1) > 0){
    for(k=0; k< (filas.length-1); k++){
      var celdas = $(filas[k]).children("td");
      $(celdas[0]).text(k+1);
    }
  }


}




  function recorrer_poliza(){
    var filas = $("#tabla_poliza>tbody").find("tr");

    if((filas.length-1) > 0){

      var script = "INSERT INTO vyp_poliza (no_doc, no_poliza, mes_poliza, fecha_elaboracion, no_cuenta_cheque, nr, fecha_mision, nombre_empleado, detalle_mision, sede, cargo_funcional, linea_presup1, linea_presup2, viatico, pasaje, total, mes, anio, cuenta_bancaria, cod_presupuestario, id_mision, nombre_banco,fecha_elaboracion_poliza, tipo_solicitud) VALUES\n";

      for(i=0; i< (filas.length-1); i++){
        var celdas = $(filas[i]).children("td");
        var ndocu = $(celdas[0]).text().trim();
        var mespo = $(celdas[2]).text().trim();
        var felab = $(celdas[3]).text().trim();
        var ncuen = $(celdas[4]).text().trim();
        var nremp = $(celdas[5]).text().trim();
        var fmisi = $(celdas[6]).text().trim();
        var nomem = $(celdas[7]).text().trim();
        var dmisi = $(celdas[8]).html().trim();
        var csede = $(celdas[9]).text().trim();
        var cargo = $(celdas[10]).text().trim();
        var linea1 = $(celdas[11]).text().trim();
        var linea2 = $(celdas[11]).text().trim();
        var pasaj = $($(celdas[12]).children("input")[0]).val();
        var viati = $($(celdas[13]).children("input")[0]).val();
        var total = $($(celdas[14]).children("input")[0]).val();

        var idmis = $($(celdas[1]).children("input")[0]).val();
        var tipo_solicitud = $($(celdas[1]).children("input")[1]).val();

        var mescb = $("#nombre7").val();
        var anioc = $("#nombre8").val();
        var mtpsc = $("#nombre10").val();
        var cpres = $("#nombre3").val();
        var npoli = $("#nombre1").val();
        var banco = $("#nombre9").val();

        var fecha_elaboracion_poliza = moment().format("YYYY-MM-DD");


        if(i == (filas.length-2)){
          script += "('"+ndocu+"', '"+npoli+"', '"+mespo+"', '"+felab+"', '"+ncuen+"', '"+nremp+"', '"+fmisi+"', '"+nomem+"', '"+dmisi+"', '"+csede+"', '"+cargo+"', '"+linea1+"', '"+linea2+"', '"+viati+"', '"+pasaj+"', '"+total+"', '"+mescb+"', '"+anioc+"', '"+mtpsc+"', '"+cpres+"', '"+idmis+"', '"+banco+"', '"+fecha_elaboracion_poliza+"', '"+tipo_solicitud+"');";
        }else{
          script += "('"+ndocu+"', '"+npoli+"', '"+mespo+"', '"+felab+"', '"+ncuen+"', '"+nremp+"', '"+fmisi+"', '"+nomem+"', '"+dmisi+"', '"+csede+"', '"+cargo+"', '"+linea1+"', '"+linea2+"', '"+viati+"', '"+pasaj+"', '"+total+"', '"+mescb+"', '"+anioc+"', '"+mtpsc+"', '"+cpres+"', '"+idmis+"', '"+banco+"', '"+fecha_elaboracion_poliza+"', '"+tipo_solicitud+"'),\n";
        }
      }

      insertar_poliza(script)

    }else{
      swal({ title: "Póliza vacía", text: "No se puede generar una poliza sin viáticos.", type: "warning", showConfirmButton: true });
    }

  }

  function insertar_poliza(sql){
      var formData = {
          "sql" : sql
      };
      $.ajax({
          type:  'POST',
          url:   '<?php echo site_url(); ?>/poliza/poliza/insertar_poliza',
          data: formData,
          cache: false
      })
      .done(function(data){
          if(data == "exito"){
              swal({ title: "¡Registro exitoso!", type: "success", showConfirmButton: true });
              tabla_poliza();
              orden_poliza = "automatico";
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
          url:   '<?php echo site_url(); ?>/poliza/poliza/eliminar_poliza',
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

  function cambiar_editar(no_poliza, mes_poliza, anio_poliza, total, estado, band){

    if(band == "edit"){

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
    tabla_generar_poliza();
    $("#cnt_registros_polizas").hide(300);
    $("#cnt_poliza").show(300);
  }

  function cerrar_mantenimiento(){
    $("#cnt_registros_polizas").show(300);
    $("#cnt_poliza").hide(300);
  }

  function cambiar_orden(tipo){
    orden_poliza = tipo;
    if(tipo == "manual"){
      $("#cnt_manual").hide(0);
      $("#cnt_automatico").show(0);
    }else{
      $("#cnt_manual").show(0);
      $("#cnt_automatico").hide(0);
    }
    tabla_generar_poliza();
  }

  function imprimir_poliza(no_poliza, mes, anio){
    window.open("<?php echo site_url(); ?>/poliza/poliza/imprimir_poliza?no_poliza="+no_poliza+"&mes="+mes+"&anio="+anio, '_blank');
  }

  function imprimir_poliza_completa(no_poliza, mes, anio){
    window.open("<?php echo site_url(); ?>/poliza/poliza/imprimir_poliza_completa?no_poliza="+no_poliza+"&mes="+mes+"&anio="+anio, '_blank');
  }

  function mostrar_pendientes(){
    $("#cnt_pendientes").show(500);
    $("#cnt_generar_poliza").hide(500);
    $("#btn_volver").show(0);
  }

  function retornar_poliza_generada(){
    $("#cnt_pendientes").hide(500);
    $("#cnt_generar_poliza").show(500);
    $("#btn_volver").hide(0);
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
                    echo $titulo = ucfirst("Gestión de polizas"); 
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
                  <div class="input-group">
                      <input type="text" id="nombre1" name="nombre1" class="form-control" required="" onchange="tabla_generar_poliza();">
                      <div id="cnt_manual" class="input-group-addon btn btn-default" onclick="cambiar_orden('manual');" data-toggle="tooltip" title="" data-original-title="Clic para cambiar a manual"><i class="mdi mdi-account-convert"></i></div>
                      <div style="display: none;" id="cnt_automatico" class="input-group-addon btn btn-default" onclick="cambiar_orden('automatico');" data-toggle="tooltip" title="" data-original-title="Clic para cambiar a automático"><i class="mdi mdi-book-open-page-variant"></i></div>
                  </div>
                </span></div></td>
                <td> <h5 align="justify"> MES:</h5></td>
                <td><div align="justify"><span class="controls">
                  <select class="custom-select" id="nombre7" style="width: 100%; background-color: #fff;" onchange="tabla_generar_poliza();">
                    <?php
                      $mes_actual;
                      for($i=1; $i<=12; $i++){

                        if(date("n") == $i){
                          $mes_actual = "selected";
                        }else{
                          $mes_actual = "";
                        }

                        if($i>9){
                          echo '<option value="'.$i.'" '.$mes_actual.'>'.mes($i).'</option>';
                        }else{
                          echo '<option value="0'.$i.'" '.$mes_actual.'>'.mes($i).'</option>';
                        }
                      }
                    ?>
                    </select>
                </span></div></td>
              </tr>
              <tr>
                <td><h5 align="justify">INSTITUCIÓN:</h5></td>
                <td ><div align="justify"><span class="controls">
                  <input type="text" id="nombre2" name="nombre2" class="form-control" value="MINISTERIO DE TRABAJO Y PREVISION SOCIAL" disabled=""/>
                </span></div></td>
                <td> <h5 align="justify"> EJERCICIO FINANCIERO FISCAL: </h5></td>
                <td><div align="justify"><span class="controls">
                  <input type="text" id="nombre8" name="nombre8" class="form-control" onchange="tabla_generar_poliza();" value="<?php echo date("Y"); ?>" />
                </span></div></td>
              </tr>
              <tr>
                <td height="25"><h5 align="justify">CÓDIGO PRESUPUESTARIO: </h5></td>
                <td><div align="justify"><span class="controls">
                  <input type="text" id="nombre3" name="nombre3" class="form-control" value="<?php echo $cod_presupuestario; ?>" />
                </span></div></td>
                <td> <h5 align="justify"> NOMBRE DEL BANCO: </h5></td>
                <td><div align="justify"><span class="controls">
                  <input type="text" id="nombre9" name="nombre9" class="form-control" value="<?php echo $banco; ?>"/>
                </span></div></td>
              </tr>
              <tr>
                <td height="25"><h5 align="justify">DENOMINACIÓN DEL MONTO FIJO: </h5></td>
                <td><div align="justify"><span class="controls">
                  <input type="text" id="nombre4" name="nombre4" class="form-control" value="FONDO CIRCULANTE DEL MTPS" disabled="" />
                </span></div></td>
                <td> <h5 align="justify">No. CUENTA BANCARIA: </h5></td>
                <td><div align="justify"><span class="controls">
                  <input type="text" id="nombre10" name="nombre10" class="form-control" required="required" value="<?php echo $num_cuenta; ?>" />
                </span></div></td>
              </tr>
              <tr>
                <td height="25"> <h5 align="justify"> MONTO TOTAL DEL REINTEGRO: </h5></td>
                <td><div align="justify"><span class="controls">
                  <div class="input-group">
                      <div class="input-group-addon"><i class="fa fa-dollar"></i></div>
                      <input type="number" id="nombre5" name="nombre5" class="form-control" step="any" required="">
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
                  <input type="text" id="nombre12" name="nombre12" class="form-control" />
                </span></div></td>
              </tr>
            </table>
      </div>
      <br>

      <select class="custom-select" id="tipo_poliza" style="background-color: #fff;" onchange="tabla_generar_poliza();">
        <option value="banco">Banco y cheque</option>
        <option value="efectivo">Efectivo</option>
      </select>

      <button class="pull-right btn btn-rounded btn-default" data-toggle="tooltip" title="Clic para ver las Solicitudes restantes" onclick="mostrar_pendientes();">Solicitudes restantes: <output id="btn_restantes"></output></button>

      <button class="pull-right btn btn-rounded btn-default" id="btn_volver" style="margin-right: 10px; display: none;" onclick="retornar_poliza_generada();"><span class="mdi mdi-undo"></span> Volver</button>
      
      <div id="cnt_generar_poliza"></div>

      <div class="table-responsive" id="cnt_pendientes" style="display: none;">
        <table class="table table-hover product-overview bg-white">
            <thead class="bg-info text-white" style="font-size: 11px;">
             
                <tr>
                  <th style="padding: 7px" width="25px" rowspan="2">#</th>
                    <th style="padding: 7px" width="40px" rowspan="2">Fecha elaboración</th>
                    <th style="padding: 7px" width="50px" rowspan="2">No. cheque/ cuenta</th>
                    <th style="padding: 7px" width="40px" rowspan="2">Código empleado</th>
                    <th style="padding: 7px" width="70px" rowspan="2">Fecha misión</th>
                    <th style="padding: 7px" width="100px" rowspan="2">Nombre empleado</th>
                    <th style="padding: 7px" width="120px" rowspan="2">Detalle misión</th>
                    <th style="padding: 7px" width="120px" rowspan="2">Sede</th>
                    <th style="padding: 7px" width="30px" rowspan="2">Cargo funcional</th>
                    <th style="padding: 7px" width="25px"  rowspan="2">UP/LT</th>
                  <th style="padding: 7px" colspan="2" ><div align="center">Detalle de objetos especificos </div></th>
                  <th style="padding: 7px" width="60px"  rowspan="2" >Total</th>
                </tr>
                <tr>
                    <!-- <th width="48"  >54401</th> -->
                    <th style="padding: 7px" width="30px" >54401</th>
                    <!-- <th width="48" >54403</th> -->
                    <th style="padding: 7px" width="30px" >54403</th>
                </tr>
            </thead>
            <tbody style="font-size: 11px;" id="body_tabla">

            </tbody>
        </table>
      </div>

    </div>
    
    <br>

    <div class="form-group" style="display: none;">
        <textarea id="area" class="form-control" rows="10"></textarea>
    </div>

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