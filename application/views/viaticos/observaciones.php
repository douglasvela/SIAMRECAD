<script type="text/javascript">   

    var gid_mision;
    function cambiar_mision(id_mision){  
        gid_mision = id_mision;     
        $("#btnadd").show(0);
        $("#btnedit").hide(0);
        $("#cnt_tabla").hide(0);
        $("#cnt_form").show(0);
        $("#ttl_form").children("h4").html("<span class='mdi mdi-wrench'></span> Revisando solicitud");
        tabla_empresas_visitadas(gid_mision);
    }

    function cerrar_mantenimiento(){
        $("#cnt_tabla").show(0);
        $("#cnt_form").hide(0);
    }

    function editar_banco(){
        $("#band").val("edit");
        $("#submit").click();
    }

    function eliminar_banco(){
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
            $("#submit").click(); 
        });
    }

    function iniciar(){
        tabla_observaciones();
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

    function tabla_observaciones(){    
        if(window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttpB=new XMLHttpRequest();
        }else{// code for IE6, IE5
            xmlhttpB=new ActiveXObject("Microsoft.XMLHTTPB");
        }
        xmlhttpB.onreadystatechange=function(){
            if (xmlhttpB.readyState==4 && xmlhttpB.status==200){
                document.getElementById("cnt_tabla").innerHTML=xmlhttpB.responseText;
                $('#myTable').DataTable();
                $('[data-toggle="tooltip"]').tooltip();
                //var ths = $("#myTable").find("thead").find("th");
                //$(ths[0]).click();
            }
        }
        xmlhttpB.open("GET","<?php echo site_url(); ?>/viatico/observaciones/tabla_observaciones",true);
        xmlhttpB.send(); 
    }

    function tabla_empresas_visitadas(id_mision){    
        if(window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttpB=new XMLHttpRequest();
        }else{// code for IE6, IE5
            xmlhttpB=new ActiveXObject("Microsoft.XMLHTTPB");
        }
        xmlhttpB.onreadystatechange=function(){
            if (xmlhttpB.readyState==4 && xmlhttpB.status==200){
                document.getElementById("cnt_tabla_empresas").innerHTML=xmlhttpB.responseText;
                //$('#myTable').DataTable();
                $('[data-toggle="tooltip"]').tooltip();
                $('#demo-foo-row-toggler').footable();
                var ths = $("#demo-foo-row-toggler").find("thead").find("th").removeClass("footable-sortable");
                $("#demo-foo-row-toggler").find("thead").find("span").remove();
                listado_observaciones()
                //var ths = $("#myTable").find("thead").find("th");
                //$(ths[0]).click();
            }
        }
        xmlhttpB.open("GET","<?php echo site_url(); ?>/viatico/observaciones/tabla_empresas_visitadas?id_mision="+id_mision,true);
        xmlhttpB.send(); 
    }

    function listado_observaciones(){    
        if(window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttpB=new XMLHttpRequest();
        }else{// code for IE6, IE5
            xmlhttpB=new ActiveXObject("Microsoft.XMLHTTPB");
        }
        xmlhttpB.onreadystatechange=function(){
            if (xmlhttpB.readyState==4 && xmlhttpB.status==200){
                document.getElementById("cnt_lista_observaciones").innerHTML=xmlhttpB.responseText;
                $('[data-toggle="tooltip"]').tooltip();
            }
        }
        xmlhttpB.open("GET","<?php echo site_url(); ?>/viatico/observaciones/listado_observaciones?id_mision="+gid_mision,true);
        xmlhttpB.send(); 
    }

    function agregar_observacion_empresa(id_empresa_visitada, observacion){
        $("#id_empresa_visitada").val(id_empresa_visitada);
        $("#observacion_evisitada").val(observacion);
        $("#myModal").modal("show");
    }

    function eliminar_saltos(obj){        
        var cadena = $(obj).val();
        var sin_salto = cadena.split("\n").join("");
        $(obj).val(sin_salto);
    }

    function eliminar_observacion(id_observacion){
        ajax = objetoAjax();
        ajax.open("POST", "<?php echo site_url(); ?>/viatico/observaciones/eliminar_observacion", true);
        ajax.onreadystatechange = function() {
            if (ajax.readyState == 4){
                if(ajax.responseText == "exito"){
                    $.toast({ heading: 'Observación eliminada', text: 'El registro de observación fue eliminado exitosamente.', position: 'top-right', loaderBg:'#fc4b6c', icon: 'error', hideAfter: 3500, stack: 6
                    });
                    listado_observaciones();
                }else{
                    swal({ title: "¡Ups! Error", text: "Intentalo nuevamente.", type: "error", showConfirmButton: true });
                }
            }
        } 
        ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded"); 
        ajax.send("&id_observacion="+id_observacion)
    }

    function eliminar_observacion_empresa(){
        var id_empresa_visitada = $("#id_empresa_visitada").val();

        ajax = objetoAjax();
        ajax.open("POST", "<?php echo site_url(); ?>/viatico/observaciones/eliminar_observacion_empresa", true);
        ajax.onreadystatechange = function() {
            if (ajax.readyState == 4){
                if(ajax.responseText == "exito"){
                    $.toast({ heading: 'Observación eliminada', text: 'El registro de observación fue eliminado exitosamente.', position: 'top-right', loaderBg:'#fc4b6c', icon: 'error', hideAfter: 3500, stack: 6
                    });
                    tabla_empresas_visitadas(gid_mision);
                    $("#myModal").modal("hide");
                }else{
                    swal({ title: "¡Ups! Error", text: "Intentalo nuevamente.", type: "error", showConfirmButton: true });
                }
            }
        } 
        ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded"); 
        ajax.send("&id_empresa="+id_empresa_visitada)
    }

    function verificar_observaciones(){
        ajax = objetoAjax();
        ajax.open("POST", "<?php echo site_url(); ?>/viatico/observaciones/verificar_observaciones", true);
        ajax.onreadystatechange = function() {
            if (ajax.readyState == 4){
                if(ajax.responseText == "observaciones"){
                    swal({   
                        title: "Observaciones encontradas",   
                        text: "¿Desea observar la solicitud?",   
                        type: "warning",   
                        showCancelButton: true,   
                        confirmButtonColor: "#fc4b6c",   
                        confirmButtonText: "Sí, deseo observar!",   
                        closeOnConfirm: true 
                    }, function(){   
                         cambiar_estado_solicitud("observada");
                    });
                }else if(ajax.responseText == "aprobar"){
                    swal({   
                        title: "Sin observaciones",   
                        text: "¿Desea aprobar la solicitud?",   
                        type: "warning",   
                        showCancelButton: true,   
                        confirmButtonColor: "#fc4b6c",   
                        confirmButtonText: "Sí, deseo aprobar!",   
                        closeOnConfirm: true 
                    }, function(){   
                         cambiar_estado_solicitud("aprobada");
                    });
                }else{
                    swal({ title: "¡Ups! Error", text: "Intentalo nuevamente.", type: "error", showConfirmButton: true });
                }
            }
        } 
        ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded"); 
        ajax.send("&id_mision="+gid_mision)
    }

    function cambiar_estado_solicitud(estado){
        ajax = objetoAjax();
        ajax.open("POST", "<?php echo site_url(); ?>/viatico/observaciones/cambiar_estado_solicitud", true);
        ajax.onreadystatechange = function() {
            if (ajax.readyState == 4){
                if(ajax.responseText == "exito"){
                    alert("Cambios aplicados exitosamente")
                }else{
                    swal({ title: "¡Ups! Error", text: "Intentalo nuevamente.", type: "error", showConfirmButton: true });
                }
            }
        } 
        ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded"); 
        ajax.send("&id_mision="+gid_mision+"&estado="+estado)
    }

</script>

<!-- ============================================================== -->
<!-- Inicio de DIV de inicio (ENVOLTURA) -->
<!-- ============================================================== -->
<div class="page-wrapper">
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- TITULO de la página de sección -->
        <!-- ============================================================== -->
        <div class="row page-titles">
            <div class="align-self-center" align="center">
                <h3 class="text-themecolor m-b-0 m-t-0">Gestión de observación de solicitudes</h3>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Fin TITULO de la página de sección -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Inicio del CUERPO DE LA SECCIÓN -->
        <!-- ============================================================== -->
        <div class="row">
            <!-- ============================================================== -->
            <!-- Inicio del FORMULARIO de gestión -->
            <!-- ============================================================== -->
            <div class="col-lg-1"></div>
            <div class="col-lg-10" id="cnt_form" style="display: none;">
                <div class="card">
                    <div class="card-header bg-info" id="ttl_form">
                        <div class="card-actions text-white">
                            <a style="font-size: 16px;" onclick="cerrar_mantenimiento();"><i class="mdi mdi-window-close"></i></a>
                        </div>
                        <h4 class="card-title m-b-0 text-white">Listado de solicitudes</h4>
                    </div>
                    <div class="card-body b-t">


                        <div id="cnt_tabla_empresas"></div>


                        <?php echo form_open('', array('id' => 'formajax2', 'style' => 'margin-top: 0px;', 'class' => 'input-form', 'novalidate' => '')); ?>
                            <label class="control-label m-t-20" for="example-input1-group2">Nueva observación</label>
                            <div class="row">
                                <div class="col-lg-12 form-group">
                                    <div class="input-group">
                                        <input type="text" id="observacion" name="observacion" class="form-control" placeholder="Detalle de la observación" required="" minlength="5">
                                        <span class="input-group-btn">
                                          <button class="btn btn-success2" type="submit">Agregar</button>
                                        </span>
                                    </div>
                                    <div class="help-block"></div>
                                </div>
                            </div>

                        <?php echo form_close(); ?>


                        <div id="cnt_lista_observaciones"></div>

                        <div align="right">
                            <button type="button" onclick="verificar_observaciones();" class="btn waves-effect waves-light btn-success"><i class="mdi mdi-plus"></i>Finalizar observaciones</button>
                        </div>


                    </div>
                </div>
            </div>
            <div class="col-lg-1"></div>
            <!-- ============================================================== -->
            <!-- Fin del FORMULARIO de gestión -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Inicio de la TABLA -->
            <!-- ============================================================== -->
            <div class="col-lg-12" id="cnt_tabla">

            </div>
            <!-- ============================================================== -->
            <!-- Fin de la TABLA -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- Fin CUERPO DE LA SECCIÓN -->
        <!-- ============================================================== -->
    </div> 
</div>
<!-- ============================================================== -->
<!-- Fin de DIV de inicio (ENVOLTURA) -->
<!-- ============================================================== -->

<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <?php echo form_open('', array('id' => 'formajax', 'style' => 'margin-top: 0px;', 'class' => 'm-t-40', 'novalidate' => '')); ?>
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Asistente de observaciones</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body" id="contenedor_viatico">

                <input type="hidden" id="id_empresa_visitada" name="id_empresa_visitada">
                <div class="row">
                    <div class="form-group col-lg-12">
                        <h5>Observación: <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <textarea type="text" id="observacion_evisitada" name="observacion_evisitada" minlength="5" maxlength="200" class="form-control" required="" data-validation-required-message="Este campo es requerido" onkeyup="eliminar_saltos(this);"></textarea>
                            <div class="help-block"></div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancelar</button>
                <button type="button" onclick="eliminar_observacion_empresa();" class="btn btn-danger waves-effect">Eliminar</button>
                <button type="submit" class="btn btn-success waves-effect">Aceptar</button>
            </div>
            <?php echo form_close(); ?>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<script>

$(function(){     
    $("#formajax").on("submit", function(e){
        e.preventDefault();

        var formData = {
            "id_empresa_visitada" : $("#id_empresa_visitada").val(),
            "observacion_evisitada" : $("#observacion_evisitada").val()
        };
        $.ajax({
            type:  'POST',
            url:   '<?php echo site_url(); ?>/viatico/observaciones/observar_empresa',
            data: formData,
            cache: false
        })
        .done(function(res){
            if(res == "exito"){
                swal({ title: "¡Observación exitosa!", type: "success", showConfirmButton: true });
                tabla_empresas_visitadas(gid_mision);
                $("#myModal").modal("hide");
            }else{
                swal({ title: "¡Ups! Error", text: "Intentalo nuevamente.", type: "error", showConfirmButton: true });
            }
        });
            
    });
});

$(function(){     
    $("#formajax2").on("submit", function(e){
        e.preventDefault();

        var formData = {
            "id_mision" : gid_mision,
            "observacion" : $("#observacion").val()
        };
        $.ajax({
            type:  'POST',
            url:   '<?php echo site_url(); ?>/viatico/observaciones/otra_observacion',
            data: formData,
            cache: false
        })
        .done(function(res){
            if(res == "exito"){
                $.toast({ heading: 'Observación registrada', text: 'La observación se registró exitosamente.', position: 'top-right', loaderBg:'#3c763d', icon: 'success', hideAfter: 3500, stack: 6
                });
                listado_observaciones();
            }else{
                swal({ title: "¡Ups! Error", text: "Intentalo nuevamente.", type: "error", showConfirmButton: true });
            }
        });
            
    });
});

</script>