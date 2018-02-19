 <style>

      @media screen and (max-width: 770px) {
        .otro {
            height: 500px;
        }
      }

      #divider {
          height: 89%;
      }

      #map {
        height: 100%;
      }

      #output {
        font-size: 14px;
      }
    </style>
<script type="text/javascript">

    function editar_oficina(id_vyp_rutas,id_oficina_origen_vyp_rutas,descripcion_destino_vyp_rutas,id_oficina_destino_vyp_rutas,km_vyp_rutas){
        limpiar();
        $("#cnt-tabla").hide(0);
        $("#cnt_form").show(0);
        mostrarpanel_oficina();


       document.getElementById('destino_oficina').checked = true;
        $("#id_vyp_rutas").val(id_vyp_rutas);
        $("#id_oficina_origen_vyp_rutas").val(id_oficina_origen_vyp_rutas);
        $("#descripcion_destino_vyp_rutas").val(descripcion_destino_vyp_rutas);
        $("#id_oficina_destino_vyp_rutas").val(id_oficina_destino_vyp_rutas);
        $("#km_vyp_rutas").val(km_vyp_rutas);
         $("#btnadd").hide(0);
        $("#btnedit").show(0);
        $("#band").val("edit");
     }
     function editar_municipio(id_vyp_rutas,id_oficina_origen_vyp_rutas,descripcion_destino_vyp_rutas,id_departamento_vyp_rutas,id_municipio_vyp_rutas,km_vyp_rutas){
        limpiar();
         $("#cnt-tabla").hide(0);
        $("#cnt_form").show(0);
        mostrarpanel_municipio();

        document.getElementById('destino_municipio').checked = true;
        $("#id_vyp_rutas").val(id_vyp_rutas);
        $("#id_oficina_origen_vyp_rutas").val(id_oficina_origen_vyp_rutas);
        $("#descripcion_destino_vyp_rutas").val(descripcion_destino_vyp_rutas);
        $("#id_departamento_vyp_rutas").val(id_departamento_vyp_rutas);
       buscarMunicipio(id_departamento_vyp_rutas,id_municipio_vyp_rutas);
        $("#km_vyp_rutas").val(km_vyp_rutas);
        $("#btnadd").hide(0);
        $("#btnedit").show(0);
        $("#band").val("edit");
    }

    function editar_mapa(id_vyp_rutas,id_oficina_origen_vyp_rutas,descripcion_destino_vyp_rutas,id_departamento_vyp_rutas,id_municipio_vyp_rutas,km_vyp_rutas,latitud_destino_vyp_rutas,longitud_destino_vyp_rutas){
        limpiar();
        $("#cnt-tabla").hide(0);
        $("#cnt_form").show(0);
        $("#cnt_form").removeClass("col-lg-10");
        $("#cnt_form").addClass("col-lg-6");
        $("#form_mapa").show(500);
        $("#panel_municipio").show(50);$("#panel_oficina").hide(50);

        document.getElementById('destino_mapa').checked = true;
        $("#id_vyp_rutas").val(id_vyp_rutas);
        $("#id_oficina_origen_vyp_rutas").val(id_oficina_origen_vyp_rutas);
        $("#descripcion_destino_vyp_rutas").val(descripcion_destino_vyp_rutas);
        $("#id_departamento_vyp_rutas").val(id_departamento_vyp_rutas);

        obtenerOrigen(id_oficina_origen_vyp_rutas,"1",latitud_destino_vyp_rutas,longitud_destino_vyp_rutas);
        buscarMunicipio(id_departamento_vyp_rutas,id_municipio_vyp_rutas);
        $("#km_vyp_rutas").val(km_vyp_rutas);
        $("#latitud_destino_vyp_rutas").val(latitud_destino_vyp_rutas);
        $("#longitud_destino_vyp_rutas").val(longitud_destino_vyp_rutas);
            $("#btnadd").hide(0);
        $("#btnedit").show(0);
        $("#band").val("edit");
    }
    function cambiar_nuevo(){


        $("#band").val("save");

        $("#ttl_form").addClass("bg-success");
        $("#ttl_form").removeClass("bg-info");

        $("#btnadd").show(0);
        $("#btnedit").hide(0);

        $("#cnt-tabla").hide(0);
        $("#cnt_form").show(0);

        $("#ttl_form").children("h4").html("<span class='mdi mdi-plus'></span> Nueva Ruta");
        limpiar();
    }


    function cerrar_mantenimiento(){
        $("#cnt-tabla").show(0);
        $("#cnt_form").hide(0);
        $("#form_mapa").hide(0);
        limpiar();
    }
    function limpiar(){
        //$("input[name='t_destinos']:checked").removeAttr("checked");
        document.getElementById('destino_mapa').checked = false;
        document.getElementById('destino_municipio').checked = false;
        document.getElementById('destino_oficina').checked = false;
        $('#id_oficina_destino_vyp_rutas').val("");
        $('#id_oficina_origen_vyp_rutas').val("");
        $('#descripcion_destino_vyp_rutas').val("");
        $('#km_vyp_rutas').val("");
        $('#id_departamento').val("");
        $('#id_municipio').val("");
        $('#latitud_destino_vyp_rutas').val("");
        $('#longitud_destino_vyp_rutas').val("");
        $("#direccion_origen1").val("");
        $("#direccion_origen2").val("");
    }


    function eliminar_ruta(id){
        $("#band").val("delete");
        swal({
            title: "¿Está seguro?",
            text: "¡Desea eliminar el registro!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#fc4b6c",
            confirmButtonText: "Sí, deseo eliminar!",
            closeOnConfirm: false
        }, function(){
            $("#id_vyp_rutas").val(id);
            preparar_ruta($("#band").val());
        });
    }

    function iniciar(){
       // tablaRutas("destino_oficina");
    }

    function objetoAjax(){
        var xmlhttp = false;
        try {
            xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e) {
            try { xmlhttp = new ActiveXObject("Microsoft.XMLHTTP"); } catch (E) { xmlhttp = false; }
        }
        if (!xmlhttp && typeof XMLHttpRequest!='undefined') { xmlhttp = new XMLHttpRequest(); }
        return xmlhttp;
    }

    function tablaoficinas(){
        $( "#cnt-tabla" ).load("<?php echo site_url(); ?>/configuraciones/oficinas/tabla_oficinas", function() {
            $('#myTable').DataTable();
            $('[data-toggle="tooltip"]').tooltip();
        });
    }

    function tablaRutas(destino){

        $( "#cnt-tabla" ).load("<?php echo site_url(); ?>/configuraciones/rutas/tabla_rutas/"+destino, function() {
            $('#myTable').DataTable();
            $('[data-toggle="tooltip"]').tooltip();
        });
    }



    function mostrarpanel_oficina(){
        $("#panel_oficina").show(50);
        $("#cnt_form").removeClass("col-lg-6");
        $("#cnt_form").addClass("col-lg-10");
        $("#panel_municipio").hide(50);$("#form_mapa").hide(10);
    }


    function mostrarpanel_mapa(){
       //$("#btnadd").hide(0);
        $("#cnt_form").removeClass("col-lg-10");
        $("#cnt_form").addClass("col-lg-6");
        $("#form_mapa").show(500);initMap();
        $("#panel_municipio").show(50);$("#panel_oficina").hide(50);
        if($('#id_oficina_origen_vyp_rutas').val()!=""){
            obtenerOrigen($("#id_oficina_origen_vyp_rutas").val(),"2");
        }

    }
    function mostrarpanel_municipio(){
        $("#form_mapa").hide(10);
        $("#cnt_form").removeClass("col-lg-6");
        $("#cnt_form").addClass("col-lg-10");
        $("#panel_municipio").show(50);
        $("#panel_oficina").hide(50);
    }
    function buscarMunicipio(id_departamento,seleccion){
        id=id_departamento+="x"+seleccion;
        if(window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp=new XMLHttpRequest();
        }else{// code for IE6, IE5
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTPB");
        }

        xmlhttp.onreadystatechange=function(){
            if (xmlhttp.readyState==4 && xmlhttp.status==200){
                  document.getElementById("municipios").innerHTML=xmlhttp.responseText;
            }
        }

        xmlhttp.open("GET","<?php echo site_url(); ?>/configuraciones/oficinas/mostrarComboMunicipi2/"+id,true);
        xmlhttp.send();
    }
    function manttorutas(id_vyp_rutas,band,opcionruta_vyp_rutas,id_oficina_origen_vyp_rutas,id_oficina_destino_vyp_rutas,descripcion_destino_vyp_rutas,km_vyp_rutas,id_departamento,id_municipio,latitud_destino_vyp_rutas,longitud_destino_vyp_rutas){
        var formData = new FormData();
        formData.append("id_vyp_rutas", id_vyp_rutas);
        formData.append("id_oficina_origen_vyp_rutas", id_oficina_origen_vyp_rutas);
        formData.append("id_oficina_destino_vyp_rutas", id_oficina_destino_vyp_rutas);
        formData.append("opcionruta_vyp_rutas", opcionruta_vyp_rutas);
        formData.append("band", band);
        formData.append("descripcion_destino_vyp_rutas",descripcion_destino_vyp_rutas);
        formData.append("km_vyp_rutas",km_vyp_rutas);
        formData.append("id_departamento",id_departamento);
        formData.append("id_municipio",id_municipio);
        formData.append("latitud_destino_vyp_rutas",latitud_destino_vyp_rutas);
        formData.append("longitud_destino_vyp_rutas",longitud_destino_vyp_rutas);

        $.ajax({
            url: "<?php echo site_url(); ?>/configuraciones/rutas/gestionar_rutas",
            type: "post",
            dataType: "html",
            data: formData,
            cache: false,
            contentType: false,
            processData: false
        })
        .done(function(res){

            if(res == "exito"){
               $("input[name='t_destinos']:checked").removeAttr("checked"); cerrar_mantenimiento();
                if($("#band").val() == "save"){
                    swal({ title: "¡Registro exitoso!", type: "success", showConfirmButton: true });
                }else if($("#band").val() == "edit"){
                    swal({ title: "¡Modificación exitosa!", type: "success", showConfirmButton: true });
                }else{
                    swal({ title: "¡Borrado exitoso!", type: "success", showConfirmButton: true });
                }
                tablaRutas("destino_oficina");$("#band").val('save');limpiar();
            }else{
                swal({ title: "¡Ups! Error", text: "Intentalo nuevamente.", type: "error", showConfirmButton: true });
            }
        });
    }


    function obtenerOrigen(id,opcionCargarMapa,latitud_destino_vyp_rutas,longitud_destino_vyp_rutas){
        if($('input[id="destino_mapa"]').is(':checked')){
            var formData = new FormData();
            formData.append("id_oficina_origen_vyp_rutas", id);

            $.ajax({
                url: "<?php echo site_url(); ?>/configuraciones/rutas/obtener_origen",
                type: "post",
                dataType: "html",
                data: formData,
                cache: false,
                contentType: false,
                processData: false
            })
            .done(function(res){
                //console.log(res);
                var algo = res.split(",");

                $("#direccion_origen1").val(algo[0]);
                $("#direccion_origen2").val(algo[1]);
                 if(opcionCargarMapa==1){

                    initMap(algo[0],algo[1],latitud_destino_vyp_rutas,longitud_destino_vyp_rutas);
                 }
            });
        }
    }
     function buscarmapa(){
        var departamento = $("#id_departamento_vyp_rutas option:selected").html();
        var municipio = $("#id_municipio option:selected").html();
        $("#address").val(municipio.trim()+","+departamento.trim());
        $("#submit_ubi").click();
     }








     function mostrarReporteEmpleado(){
       var id = $("#id_empleado").val();
       if(id==""){
         swal({ title: "¡Ups! Error", text: "Completa los campos.", type: "error", showConfirmButton: true });
       }else{
        var xhr = "<?php echo base_url()?>" 
         window.open(xhr+"index.php/informes/menu_reportes/reporte_viatico_pendiente_empleado/"+id,"_blank");
       }
     }
     function mostrarReportePagados(){
       var id = $("#id_empleado2").val();
       var fecha_min = $("#fecha_min").val();
       var fecha_max = $("#fecha_max").val();
       if(id=="" || fecha_max=="" || fecha_min==""){
         swal({ title: "¡Ups! Error", text: "Completa los campos.", type: "error", showConfirmButton: true });
       }else{
          window.open("menu_reportes/reporte_viatico_pagado_empleado/"+id+"/"+fecha_min+"/"+fecha_max,"_blank");
       }
     }
     function mostrarReporteViaticosMayoraMenor(){
       var fecha = $("#fecha_monto").val();
       var dir;
       if($("#seccion4").val()!="0"){
         dir = $("#seccion4").val();
       }else if($("#seccion3").val()!="0"){
         dir = $("#seccion3").val();
       }else if($("#seccion2").val()!="0"){
         dir = $("#seccion2").val();
       }else if($("#seccion1").val()!="0"){
         dir = $("#seccion1").val();
       }else if($("#seccion_principal").val()!="0"){
         dir = $("#seccion_principal").val();
       }else{
         swal({ title: "¡Ups! Error", text: "Completa los campos.", type: "error", showConfirmButton: true });
         return;
       }
       if(fecha==""){
          swal({ title: "¡Ups! Error", text: "Completa los campos.", type: "error", showConfirmButton: true });
       }else{
          window.open("menu_reportes/reporte_monto_viatico_mayor_a_menor/"+fecha+"/"+dir,"_blank");
       }
     }

     function buscarSeccion(id){

         if(window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
             xmlhttp=new XMLHttpRequest();
         }else{// code for IE6, IE5
             xmlhttp=new ActiveXObject("Microsoft.XMLHTTPB");
         }

         xmlhttp.onreadystatechange=function(){
             if (xmlhttp.readyState==4 && xmlhttp.status==200){
                   document.getElementById("micomboseccion").innerHTML=xmlhttp.responseText;
             }
         }

         xmlhttp.open("GET","<?php echo site_url(); ?>/informes/menu_reportes/mostrarCombo/"+id,true);
         xmlhttp.send();
     }
     function buscarSeccion2(id){

         if(window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
             xmlhttp2=new XMLHttpRequest();
         }else{// code for IE6, IE5
             xmlhttp2=new ActiveXObject("Microsoft.XMLHTTPB");
         }

         xmlhttp2.onreadystatechange=function(){
             if (xmlhttp2.readyState==4 && xmlhttp2.status==200){
                   document.getElementById("micomboseccion2").innerHTML=xmlhttp2.responseText;
             }
         }

         xmlhttp2.open("GET","<?php echo site_url(); ?>/informes/menu_reportes/mostrarCombo2/"+id,true);
         xmlhttp2.send();
     }
     function buscarSeccion3(id){

         if(window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
             xmlhttp3=new XMLHttpRequest();
         }else{// code for IE6, IE5
             xmlhttp3=new ActiveXObject("Microsoft.XMLHTTPB");
         }

         xmlhttp3.onreadystatechange=function(){
             if (xmlhttp3.readyState==4 && xmlhttp3.status==200){
                   document.getElementById("micomboseccion3").innerHTML=xmlhttp3.responseText;
             }
         }

         xmlhttp3.open("GET","<?php echo site_url(); ?>/informes/menu_reportes/mostrarCombo3/"+id,true);
         xmlhttp3.send();
     }
     function buscarSeccion4(id){

         if(window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
             xmlhttp4=new XMLHttpRequest();
         }else{// code for IE6, IE5
             xmlhttp4=new ActiveXObject("Microsoft.XMLHTTPB");
         }

         xmlhttp4.onreadystatechange=function(){
             if (xmlhttp4.readyState==4 && xmlhttp4.status==200){
                   document.getElementById("micomboseccion4").innerHTML=xmlhttp4.responseText;
             }
         }

         xmlhttp4.open("GET","<?php echo site_url(); ?>/informes/menu_reportes/mostrarCombo4/"+id,true);
         xmlhttp4.send();
     }
     function limpiarSeccion(){
        $("#seccion4").val("0");
        $("#seccion3").val("0");
        $("#seccion2").val("0");
        $("#seccion1").val("0");
        $("#seccion_principal").val("0");
     }
     function mostrarReportePorPeriodo(){
       $anio = $("#anio_actual").val();
        $primer_mes = $("#primer_mes").val();
        $segundo_mes = $("#segundo_mes").val();
        $tercer_mes = $("#tercer_mes").val();
        $cuarto_mes = $("#cuarto_mes").val();
        $quinto_mes = $("#quinto_mes").val();
        $sexto_mes = $("#sexto_mes").val();
        if($anio!=""){
          window.open("menu_reportes/reporte_viaticos_por_periodo/"+$anio+"/"+$primer_mes+"/"+$segundo_mes+"/"+$tercer_mes+"/"+$cuarto_mes+"/"+$quinto_mes+"/"+$sexto_mes,"_blank");
        }else{
          swal({ title: "¡Ups! Error", text: "Completa los campos.", type: "error", showConfirmButton: true });
        }
     }
     function limpiarMeses(){
       $("#primer_mes").val("0");
       $("#segundo_mes").val("0");
       $("#tercer_mes").val("0");
       $("#cuarto_mes").val("0");
       $("#quinto_mes").val("0");
       $("#sexto_mes").val("0");
     }
     function prueba(){
        var xhr = "<?php echo base_url()?>" 
        window.open(xhr+"index.php/informes/menu_reportes/reporte_ejemplo","_blank");
     }
</script>

<!-- ============================================================== -->
<!-- Inicio de DIV de inicio (ENVOLTURA) -->
<!-- ============================================================== -->
<div class="page-wrapper">
    <div class="container-fluid">
        <button id="notificacion" style="display: none;" class="tst1 btn btn-success2">Info Message</button>

        <div class="row page-titles">
            <div class="align-self-center" align="center">
                <h3 class="text-themecolor m-b-0 m-t-0">Listado de Reportes</h3>
            </div>
        </div>

        <div class="row justify-content-center">

            <div class="col-lg-12 " id="cnt_form" style="display: block;">
                <div class="card">
                    <div class="card-header bg-success2" id="ttl_form">
                        <div class="card-actions text-white">
                            <a style="font-size: 16px;" onclick=""><i class="mdi mdi-window-close"></i></a>
                        </div>
                        <h4 class="card-title m-b-0 text-white">Reportes</h4>
                    </div>
                    <div class="card-body b-t">

                        <?php echo form_open('', array('id' => 'formajax', 'style' => 'margin-top: 0px;', 'class' => 'm-t-40', 'novalidate' => '')); ?>

                        <div class="row">
                          <div class="col-md-12">
                              <div class="card">
                                  <div class="card-body">
                                      <h4 style="display:none" class="card-title">Customtab vertical Tab</h4>
                                      <h6 class="card-subtitle" style="display:none">Use default tab with class <code>vtabs, tabs-vertical &amp; customvtab</code></h6>
                                      <!-- Nav tabs -->
                                      <div class="vtabs customvtab">
                                          <ul class="nav nav-tabs tabs-vertical" role="tablist">
                                              <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home3" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Viaticos Pendiente de Pago por Empleado</span> </a> </li>
                                              <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile3" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Viaticos Pagados en un Periodo</span></a> </li>
                                              <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#messages3" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Viáticos por empleado de mayor a menor</span></a> </li>
                                              <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#messages4" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Viáticos Trimestral, Semestral y Anual</span></a> </li>
                                          </ul>
                                          <!-- Tab panes -->
                                          <div class="tab-content">
                                              <div class="tab-pane active" id="home3" role="tabpanel">
                                                  <div class="p-20">
                                                    <div class="row">
                                                        <div class="col-md-10">
                                                          <div class="form-group">
                                                            <h5>Empleado: <span class="text-danger">*</span></h5>
                                                              <select id="id_empleado" name="id_empleado" class="select2" onchange="" style="width: 100%" required>
                                                              <option value=''>[Elija el empleado]</option>
                                                              <?php
                                                              $dataEmpleado = $this->db->query("SELECT * FROM sir_empleado");

                                                              $sess= $this->session->userdata('id_usuario_viatico');
                                                              $dataEmpleado2 = $this->db->query("SELECT nr FROM org_usuario where id_usuario='$sess'");
                                                              if($dataEmpleado2->num_rows()>0){
                                                                foreach ($dataEmpleado2->result() as $fila3) {}
                                                              }

                                                              if($dataEmpleado->num_rows() > 0){
                                                                  foreach ($dataEmpleado->result() as $fila2) {
                                                              ?>
<option class="m-l-50" value="<?php echo $fila2->nr; ?>" <?php if(isset($fila3)){ if($fila2->nr==$fila3->nr){ echo "selected"; }} ?>><?php echo $fila2->primer_nombre." ".$fila2->segundo_nombre." ".$fila2->primer_apellido." ".$fila2->segundo_apellido; ?></option>

                                                              <?php
                                                                  }
                                                              }
                                                              //$u_rec_id = $this->session->userdata('rec_id');
                                                              ?>
                                                            </select>
                                                          </div>
                                                        </div>
                                                        <div class="col-md-10">
                                                          <div class="form-group">
                                                            <button type="button" onclick="mostrarReporteEmpleado()" class="btn waves-effect waves-light btn-success2"><i class="mdi mdi-file-pdf"></i> Ejecutar Reporte</button>
                                                            <input type="button" value="prueba" onclick="prueba()">
                                                          </div>
                                                        </div>
                                                    </div>
                                                  </div>
                                              </div>
                                              <div class="tab-pane  p-20" id="profile3" role="tabpanel">
                                                <div class="row">
                                                    <div class="col-md-10">
                                                      <div class="form-group">
                                                        <h5>Empleado: <span class="text-danger">*</span></h5>
                                                          <select id="id_empleado2" name="id_empleado2" class="select2" onchange="" style="width: 100%" required>';
                                                          <option value=''>[Elija el empleado]</option>
                                                          <?php
                                                          $datasEmpleado = $this->db->query("SELECT * FROM sir_empleado");

                                                          $sess2= $this->session->userdata('id_usuario_viatico');
                                                          $datasEmpleado2 = $this->db->query("SELECT nr FROM org_usuario where id_usuario='$sess2'");
                                                          if($datasEmpleado2->num_rows()>0){
                                                            foreach ($datasEmpleado2->result() as $fila4) {}
                                                          }

                                                          if($datasEmpleado->num_rows() > 0){
                                                              foreach ($datasEmpleado->result() as $fila2) {
                                                            ?>
<option class="m-l-50" value="<?php echo $fila2->nr; ?>" <?php if(isset($fila4)){ if($fila2->nr==$fila4->nr){ echo "selected";} } ?>><?php echo $fila2->primer_nombre." ".$fila2->segundo_nombre." ".$fila2->primer_apellido." ".$fila2->segundo_apellido; ?></option>
                                                            <?php
                                                              }
                                                          }
                                                          ?>
                                                        </select>
                                                      </div>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <div class="form-group">
                                                          <h5>Fecha Mínima: <span class="text-danger">*</span></h5>
                                                        <input type="text" pattern="\d{1,2}-\d{1,2}-\d{4}" data-date-end-date="0d"  onkeyup="FECHA('fecha_mision')" required="" value="<?php echo date('d-m-Y'); ?>" class="form-control" id="fecha_min" name="fecha_min" placeholder="dd/mm/yyyy">
                                                      </div>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <div class="form-group">
                                                          <h5>Fecha Mínima: <span class="text-danger">*</span></h5>
                                                        <input type="text" pattern="\d{1,2}-\d{1,2}-\d{4}" data-date-end-date="0d"  onkeyup="FECHA('fecha_mision')" required="" value="<?php echo date('d-m-Y'); ?>" class="form-control" id="fecha_max" name="fecha_max" placeholder="dd/mm/yyyy">
                                                      </div>
                                                    </div>
                                                    <div class="col-md-10">
                                                      <div class="form-group">
                                                        <button type="button" onclick="mostrarReportePagados()" class="btn waves-effect waves-light btn-success2"><i class="mdi mdi-file-pdf"></i> Ejecutar Reporte</button>
                                                      </div>
                                                    </div>
                                                </div>
                                              </div>
                                              <div class="tab-pane p-20" id="messages3" role="tabpanel">
                                                <div class="row">
                                                  <div class="col-md-6">
                                                      <div class="form-group">
                                                        <h5>Año: <span class="text-danger">*</span></h5>
                                                      <input type="text" value="<?php echo date('Y'); ?>" class="date-own form-control" id="fecha_monto" name="fecha_monto" placeholder="yyyy">
                                                    </div>
                                                  </div>

                                                  <div class="col-md-6">
                                                    <div class="form-group">
                                                      <h5>Dirección: <span class="text-danger">*</span></h5>
                                                        <select id="seccion_principal" name="seccion_principal" class="form-control" onchange="buscarSeccion(this.value)" style="width: 100%" >
                                                          <option value="0">[Seleccione]</option>
                                                        <?php
                                                        $datos = $this->db->query("SELECT * FROM org_seccion where depende='0'");

                                                        if($datos->num_rows() > 0){
                                                            foreach ($datos->result() as $filadatos) {
                                                        ?>
  <option class="m-l-50" value="<?php echo $filadatos->id_seccion; ?>"><?php echo $filadatos->nombre_seccion; ?></option>

                                                        <?php
                                                            }
                                                        }
                                                        //$u_rec_id = $this->session->userdata('rec_id');
                                                        ?>
                                                      </select>
                                                    </div>
                                                  </div>
                                                  <div  id="micomboseccion" class="form-group col-md-6">
                                                      <select class="form-control" id="seccion1">
                                                        <option value="0">[Elija Seccion]</option>
                                                      </select>
                                                  </div>
                                                  <div  id="micomboseccion2" class="form-group col-md-6">
                                                    <select class="form-control" id="seccion2">
                                                      <option value="0">[Elija Seccion]</option>
                                                    </select>
                                                  </div>
                                                  <div  id="micomboseccion3" class="form-group col-md-6">
                                                    <select class="form-control" id="seccion3">
                                                      <option value="0">[Elija Seccion]</option>
                                                    </select>
                                                  </div>
                                                  <div  id="micomboseccion4" class="form-group col-md-6">
                                                    <select class="form-control" id="seccion4">
                                                      <option value="0">[Elija Seccion]</option>
                                                    </select>
                                                  </div>

                                                <div class="col-md-10">
                                                  <div class="form-group">
                                                    <button type="button" onclick="mostrarReporteViaticosMayoraMenor()" class="btn waves-effect waves-light btn-success2"><i class="mdi mdi-file-pdf"></i> Ejecutar Reporte</button>
                                                    <button type="button" onclick="limpiarSeccion()" class="btn waves-effect waves-light btn-info"><i class="mdi mdi-history"></i> Limpiar</button>
                                                  </div>
                                                </div>
                                              </div>
                                              </div>
                                              <div class="tab-pane p-20" id="messages4" role="tabpanel">

                                              <h4 style="display:none" class="card-title">Reporte Semestral</h4>
                                              <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                      <h5>Año: <span class="text-danger">*</span></h5>
                                                    <input type="text" value="<?php echo date('Y'); ?>" class="date-own form-control" id="anio_actual" name="anio_actual" placeholder="yyyy">
                                                  </div>
                                                </div>

                                                <div class="col-md-3">
                                                  <div class="form-group">
                                                    <h5>Primer Mes: <span class="text-danger"></span></h5>
                                                      <select id="primer_mes" name="primer_mes" class="form-control" onchange="" style="width: 100%" >
                                                        <option value="0">[Seleccione]</option>
                                                        <option class="m-l-50" value="1">Enero</option>
                                                        <option class="m-l-50" value="2">Febrero</option>
                                                        <option class="m-l-50" value="3">Marzo</option>
                                                        <option class="m-l-50" value="4">Abril</option>
                                                        <option class="m-l-50" value="5">Mayo</option>
                                                        <option class="m-l-50" value="6">Junio</option>
                                                        <option class="m-l-50" value="7">Julio</option>
                                                        <option class="m-l-50" value="8">Agosto</option>
                                                        <option class="m-l-50" value="9">Septiembre</option>
                                                        <option class="m-l-50" value="10">Octubre</option>
                                                        <option class="m-l-50" value="11">Noviembre</option>
                                                        <option class="m-l-50" value="12">Diciembre</option>
                                                    </select>
                                                  </div>
                                                </div>
                                                <div  id="micomboseccion" class="form-group col-md-3">
                                                  <h5>Segundo Mes: <span class="text-danger"></span></h5>
                                                    <select id="segundo_mes" name="segundo_mes" class="form-control" onchange="" style="width: 100%" >
                                                      <option value="0">[Seleccione]</option>
                                                      <option class="m-l-50" value="1">Enero</option>
                                                      <option class="m-l-50" value="2">Febrero</option>
                                                      <option class="m-l-50" value="3">Marzo</option>
                                                      <option class="m-l-50" value="4">Abril</option>
                                                      <option class="m-l-50" value="5">Mayo</option>
                                                      <option class="m-l-50" value="6">Junio</option>
                                                      <option class="m-l-50" value="7">Julio</option>
                                                      <option class="m-l-50" value="8">Agosto</option>
                                                      <option class="m-l-50" value="9">Septiembre</option>
                                                      <option class="m-l-50" value="10">Octubre</option>
                                                      <option class="m-l-50" value="11">Noviembre</option>
                                                      <option class="m-l-50" value="12">Diciembre</option>
                                                  </select>
                                                </div>
                                                <div  id="micomboseccion2" class="form-group col-md-3">
                                                  <h5>Tercer Mes: <span class="text-danger"></span></h5>
                                                    <select id="tercer_mes" name="tercer_mes" class="form-control" onchange="" style="width: 100%" >
                                                      <option value="0">[Seleccione]</option>
                                                      <option class="m-l-50" value="1">Enero</option>
                                                      <option class="m-l-50" value="2">Febrero</option>
                                                      <option class="m-l-50" value="3">Marzo</option>
                                                      <option class="m-l-50" value="4">Abril</option>
                                                      <option class="m-l-50" value="5">Mayo</option>
                                                      <option class="m-l-50" value="6">Junio</option>
                                                      <option class="m-l-50" value="7">Julio</option>
                                                      <option class="m-l-50" value="8">Agosto</option>
                                                      <option class="m-l-50" value="9">Septiembre</option>
                                                      <option class="m-l-50" value="10">Octubre</option>
                                                      <option class="m-l-50" value="11">Noviembre</option>
                                                      <option class="m-l-50" value="12">Diciembre</option>
                                                  </select>
                                                </div>

                                            </div>
                                            <div class="row">
                                              <div class="col-md-3">
                                                  <div class="form-group">

                                                </div>
                                              </div>

                                              <div class="col-md-3">
                                                <div class="form-group">
                                                  <h5>Cuarto Mes: <span class="text-danger"></span></h5>
                                                    <select id="cuarto_mes" name="primer_mes" class="form-control" onchange="" style="width: 100%" >
                                                      <option value="0">[Seleccione]</option>
                                                      <option class="m-l-50" value="1">Enero</option>
                                                      <option class="m-l-50" value="2">Febrero</option>
                                                      <option class="m-l-50" value="3">Marzo</option>
                                                      <option class="m-l-50" value="4">Abril</option>
                                                      <option class="m-l-50" value="5">Mayo</option>
                                                      <option class="m-l-50" value="6">Junio</option>
                                                      <option class="m-l-50" value="7">Julio</option>
                                                      <option class="m-l-50" value="8">Agosto</option>
                                                      <option class="m-l-50" value="9">Septiembre</option>
                                                      <option class="m-l-50" value="10">Octubre</option>
                                                      <option class="m-l-50" value="11">Noviembre</option>
                                                      <option class="m-l-50" value="12">Diciembre</option>
                                                  </select>
                                                </div>
                                              </div>
                                              <div  id="micomboseccion" class="form-group col-md-3">
                                                <h5>Quinto Mes: <span class="text-danger"></span></h5>
                                                  <select id="quinto_mes" name="segundo_mes" class="form-control" onchange="" style="width: 100%" >
                                                    <option value="0">[Seleccione]</option>
                                                    <option class="m-l-50" value="1">Enero</option>
                                                    <option class="m-l-50" value="2">Febrero</option>
                                                    <option class="m-l-50" value="3">Marzo</option>
                                                    <option class="m-l-50" value="4">Abril</option>
                                                    <option class="m-l-50" value="5">Mayo</option>
                                                    <option class="m-l-50" value="6">Junio</option>
                                                    <option class="m-l-50" value="7">Julio</option>
                                                    <option class="m-l-50" value="8">Agosto</option>
                                                    <option class="m-l-50" value="9">Septiembre</option>
                                                    <option class="m-l-50" value="10">Octubre</option>
                                                    <option class="m-l-50" value="11">Noviembre</option>
                                                    <option class="m-l-50" value="12">Diciembre</option>
                                                </select>
                                              </div>
                                              <div  id="micomboseccion2" class="form-group col-md-3">
                                                <h5>Sexto Mes: <span class="text-danger"></span></h5>
                                                  <select id="sexto_mes" name="tercer_mes" class="form-control" onchange="" style="width: 100%" >
                                                    <option value="0">[Seleccione]</option>
                                                    <option class="m-l-50" value="1">Enero</option>
                                                    <option class="m-l-50" value="2">Febrero</option>
                                                    <option class="m-l-50" value="3">Marzo</option>
                                                    <option class="m-l-50" value="4">Abril</option>
                                                    <option class="m-l-50" value="5">Mayo</option>
                                                    <option class="m-l-50" value="6">Junio</option>
                                                    <option class="m-l-50" value="7">Julio</option>
                                                    <option class="m-l-50" value="8">Agosto</option>
                                                    <option class="m-l-50" value="9">Septiembre</option>
                                                    <option class="m-l-50" value="10">Octubre</option>
                                                    <option class="m-l-50" value="11">Noviembre</option>
                                                    <option class="m-l-50" value="12">Diciembre</option>
                                                </select>
                                              </div>
                                            <div class="col-md-10">
                                              <div class="form-group">
                                                <button type="button" onclick="mostrarReportePorPeriodo()" class="btn waves-effect waves-light btn-success2"><i class="mdi mdi-file-pdf"></i> Ejecutar Reporte</button>
                                                <button type="button" onclick="limpiarMeses()" class="btn waves-effect waves-light btn-info"><i class="mdi mdi-history"></i> Limpiar</button>
                                              </div>
                                            </div>
                                          </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                        </div>

                        <?php echo form_close(); ?>
                    </div>

                </div>
            </div>

            <div class="col-lg-1"></div>
                <div class="col-lg-12" id="cnt-tabla">
            </div>

        </div>



    </div>
</div>

<script>

$(function(){


      $(document).ready(function(){
          $('#fecha_min').datepicker({
              format: 'dd-mm-yyyy',
              autoclose: true,
              todayHighlight: true
          });
      });
      $(document).ready(function(){
          $('#fecha_max').datepicker({
              format: 'dd-mm-yyyy',
              autoclose: true,
              todayHighlight: true
          });
      });
      $(document).ready(function(){
          $('.date-own').datepicker({
            minViewMode: 2,
            format: 'yyyy',
            autoclose: true,
            todayHighlight: true
          });
      });

    $("#formajax").on("submit", function(e){
        e.preventDefault();
        var f = $(this);
        var formData = new FormData(document.getElementById("formajax"));
        formData.append("dato", "valor");

        $.ajax({
            url: "<?php echo site_url(); ?>/configuraciones/rutas/gestionar_rutas",
            type: "post",
            dataType: "html",
            data: formData,
            cache: false,
            contentType: false,
            processData: false
        })
        .done(function(res){
            if(res == "exito"){
                cerrar_mantenimiento();
                if($("#band").val() == "save"){
                    swal({ title: "¡Registro exitoso!", type: "success", showConfirmButton: true });
                }else if($("#band").val() == "edit"){
                    swal({ title: "¡Modificación exitosa!", type: "success", showConfirmButton: true });
                }else{
                    swal({ title: "¡Borrado exitoso!", type: "success", showConfirmButton: true });
                }
                tablaRutas();$("#band").val('save');
            }else{
                swal({ title: "¡Ups! Error", text: "Intentalo nuevamente.", type: "error", showConfirmButton: true });
            }
        });

    });


});

</script>
