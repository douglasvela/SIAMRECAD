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
      <?php if(tiene_permiso($segmentos=2,$permiso=1)){ ?>
      tabla_poliza_pago();
      <?php }else{ ?>
            $("#cnt_tabla_poliza").html("Usted no tiene permiso para este formulario.");     
      <?php } ?>
  }

  function tabla_pendiente_pago(){
    var newName = 'AjaxCall', xhr = new XMLHttpRequest();

    xhr.open('GET', "<?php echo site_url(); ?>/poliza/poliza_pago/tabla_polizas_pendientes");
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (xhr.status === 200 && xhr.responseText !== newName) {
            document.getElementById("cnt_generar_poliza").innerHTML = xhr.responseText;
            
        }else if (xhr.status !== 200) {
            swal({ title: "Ups! ocurrió un Error", text: "Al parecer la tabla de poliza generada no se cargó correctamente por favor recarga la página e intentalo nuevamente", type: "error", showConfirmButton: true });
        }
    };
    xhr.send(encodeURI('name=' + newName));
  }

  function tabla_poliza_pago(){
    var newName = 'AjaxCall', xhr = new XMLHttpRequest();

    xhr.open('GET', "<?php echo site_url(); ?>/poliza/poliza_pago/tabla_poliza_pago");
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

  function tabla_registros_planillas(sql,polis){
    var newName = 'AjaxCall', xhr = new XMLHttpRequest();
    var id_banco = $("#id_banco2").val();

    xhr.open('GET', "<?php echo site_url(); ?>/poliza/poliza_pago/tabla_registros_planillas?id_banco="+id_banco+"&sql="+sql+"&polis="+polis);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (xhr.status === 200 && xhr.responseText !== newName) {
            document.getElementById("cnt_registros_planillas").innerHTML = xhr.responseText;
            $('#myTable2').DataTable({
              dom: 'Bfrtip',
              buttons: [
                  'copy', 'csv', 'excel', 'pdf', 'print'
              ]
          });
        }else if (xhr.status !== 200) {
            swal({ title: "Ups! ocurrió un Error", text: "Al parecer la tabla de registros de planilla no se cargó correctamente por favor recarga la página e intentalo nuevamente", type: "error", showConfirmButton: true });
        }
    };
    xhr.send(encodeURI('name=' + newName));
  }

  function recorrer_poliza(){
    var filas = $("#tabla_pendiente_pago>tbody").find("tr");
    var idspoliza = "";
    var polis = "";
    var mes = "";
    var anio = "";
    var monto = 0;

    if((filas.length) > 0){
      var script = "";

      for(i=0; i< filas.length; i++){
        var celdas = $(filas[i]).children("td");
        var inputs = $(celdas[6]).children("input");
        var no_poliza = $(inputs[1]).val();
        mes = $(inputs[2]).val();
        anio = $(inputs[3]).val();
        var selected = inputs[0].checked;
        var idp = "p"+i;

        if(selected){
          script += "SELECT "+idp+".* FROM vyp_poliza AS "+idp+" WHERE no_poliza = '"+no_poliza+"' AND mes_poliza = '"+mes+"' AND anio = '"+anio+"' UNION ";
          polis += no_poliza+" ";
          monto += parseFloat($(inputs[4]).val());
        }
      }

      monto = monto.toFixed(2);

      if(script != ""){
        script = script.substring(0,script.length-6);
        polis = polis.substring(0,polis.length-1);
        planillas();
        generar_pago(script, polis, monto, anio)
        $("#area").val(script)
        //editar_poliza(script, npoli, anioc)
      }else{
        swal({ title: "Poliza sin seleccionar", text: "Cero polizas seleccionadas. Seleccione al menos una poliza para realizar pago", type: "warning", showConfirmButton: true });
      }

    }else{
        swal({ title: "No hay polizas", text: "Pólizas pendientes agotadas.", type: "warning", showConfirmButton: true });
    }

  }


  function generar_pago(sql,polis,monto,anio){
      var formData = {
          "sql" : sql,
          "polis" : polis,
          "monto" : monto,
          "anio" : anio
      };

      $.ajax({
          type:  'POST',
          url:   '<?php echo site_url(); ?>/poliza/poliza_pago/generar_pago',
          data: formData,
          cache: false
      })
      .done(function(data){
          genera_planillas(sql,polis)
      });
  }



  function genera_planillas(sql,polis){
      var formData = {
          "sql" : sql,
          "polis" : polis
      };

      $.ajax({
          type:  'POST',
          url:   '<?php echo site_url(); ?>/poliza/poliza_pago/tabla_planillas',
          data: formData,
          cache: false
      })
      .done(function(data){
          $('#cnt_planillas').html(data);
      });
  }

  function genera_planillas2(sql,polis){
    planillas();
      var formData = {
          "sql" : atob(sql),
          "polis" : polis
      };

      $.ajax({
          type:  'POST',
          url:   '<?php echo site_url(); ?>/poliza/poliza_pago/tabla_planillas',
          data: formData,
          cache: false
      })
      .done(function(data){
          $('#cnt_planillas').html(data);
      });
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

  

  function download(filename, text)
  {
    var element = document.createElement('a');
    element.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(text));
    element.setAttribute('download', filename);
 
    element.style.display = 'none';
    document.body.appendChild(element);
 
    element.click();
 
    document.body.removeChild(element);
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
    tabla_pendiente_pago();
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

  function imprimir_poliza(no_poliza, anio){
    window.open("<?php echo site_url(); ?>/poliza/poliza_pago/imprimir_resumen_solicitudes?no_poliza="+no_poliza+"&anio="+anio, '_blank');
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
  }

  function cancelar(){
    $("#tabla_poliza>tbody").find("tr").removeClass("table-warning");
    contador_clic = 0;
    primer_index = "";
    segundo_index = "";
  }

  function planillas(){
    $("#cnt_registros_polizas").hide(300);
    $("#cnt_planillas").show(300);
    $("#cnt_poliza").hide(300);
  }

  function cerrar_mantenimiento2(){
    $("#cnt_poliza").show(300);
    $("#cnt_planillas").hide(300);

    if($("#cnt_generar_poliza").html().trim() ==""){
      $("#cnt_registros_polizas").show(300);
      $("#cnt_poliza").hide(300);
    }

  }

  function descargarArchivo(contenidoEnBlob, nombreArchivo) {
    var reader = new FileReader();
    reader.onload = function (event) {
        var save = document.createElement('a');
        save.href = event.target.result;
        save.target = '_blank';
        save.download = nombreArchivo || 'archivo.dat';
        var clicEvent = new MouseEvent('click', {
            'view': window,
                'bubbles': true,
                'cancelable': true
        });
        save.dispatchEvent(clicEvent);
        (window.URL || window.webkitURL).revokeObjectURL(save.href);
    };
    reader.readAsDataURL(contenidoEnBlob);
};


function generar_txt(resumen, nombre){
  descargarArchivo(generarTexto(resumen), nombre+'.txt');
}

function generar_excel(resumen, nombre){
  descargarArchivo(generarExcel(resumen), nombre+'.xls');
}

//Genera un objeto Blob con los datos en un archivo TXT
function generarTexto(datos) {
    var texto = [];
    texto.push(atob(datos));
    return new Blob(texto, {
        type: 'text/plain'
    });
};

function generarExcel(datos) {
    var texto = [];
    texto.push(atob(datos));
    return new Blob(texto, {
        type: 'application/xls'
    });
};

//Genera un objeto Blob con los datos en un archivo XML
function generarXml(datos) {
    var texto = [];
    texto.push('<?xml version="1.0" encoding="UTF-8" ?>\n');
    texto.push('<datos>\n');
    texto.push('\t<nombre>');
    texto.push(escaparXML(datos.nombre));
    texto.push('</nombre>\n');
    texto.push('\t<telefono>');
    texto.push(escaparXML(datos.telefono));
    texto.push('</telefono>\n');
    texto.push('\t<fecha>');
    texto.push(escaparXML(datos.fecha));
    texto.push('</fecha>\n');
    texto.push('</datos>');
    //No olvidemos especificar el tipo MIME correcto :)
    return new Blob(texto, {
        type: 'application/xml'
    });
};

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
                    echo $titulo = ucfirst("Gestión de pago de polizas"); 
                  ?>
                  </h3>
            </div>
        </div>
    

    <div id="cnt_registros_polizas">
      
      <div id="cnt_tabla_poliza"></div>
    </div>

    <div id="cnt_planillas"></div>

    <div id="cnt_poliza" style="display: none;">	     
	      <div id="cnt_generar_poliza"></div>
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
                                $linea_presupuestaria = $this->db->query("SELECT * FROM org_linea_trabajo");
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