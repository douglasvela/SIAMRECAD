<?php
// Características del navegador
$ua=$this->config->item("navegator");
$navegatorless = false;
if(floatval($ua['version']) < 40){
    $navegatorless = true;
}
?>
<script type="text/javascript">
    function cambiar_editar(id,descripcion,hora_inicio,hora_fin,monto,tipo,id_categoria,id_viatico_restric,estado,bandera){
        $("#idhorario").val(id);
        $("#descripcion").val(descripcion);
        $("#hora_inicio").val(hora_inicio);
        $("#hora_fin").val(hora_fin);
        $("#monto").val(monto);
        $("#estado").val(estado);
        $("#id_tipo").val(tipo);

        $( "#cnt_combo_viatico_hora" ).load("<?php echo site_url(); ?>/configuraciones/horarios/combo_viatico_hora?id_tipo="+tipo, function() {
            $("#id_categoria").val(id_categoria);
             $("#id_viatico_restriccion").val(id_viatico_restric);
        });


        if(bandera == "edit"){
            $("#ttl_form").removeClass("bg-success");
            $("#ttl_form").addClass("bg-info");
            $("#btnadd").hide(0);
            $("#btnedit").show(0);
            $("#cnt_tabla").hide(0);
            $("#cnt_form").show(0);
            $("#ttl_form").children("h4").html("<span class='fa fa-wrench'></span> Editar viático");
        }else{
            eliminar_horario(estado, tipo);
        }
    }

    function cambiar_nuevo(){
        $("#idhorario").val("");
        $("#descripcion").val("");
        $("#hora_inicio").val("");
        $("#hora_fin").val("");
        $("#monto").val("");
        $("#estado").val("1");
        $("#id_tipo").val("1");
        $("#band").val("save");

        $("#ttl_form").addClass("bg-success");
        $("#ttl_form").removeClass("bg-info");

        $("#btnadd").show(0);
        $("#btnedit").hide(0);

        $("#cnt_tabla").hide(0);
        $("#cnt_form").show(0);
        combo_viatico_hora();

        $("#ttl_form").children("h4").html("<span class='mdi mdi-plus'></span> Nuevo viático");
    }

    function cerrar_mantenimiento(){
        $("#cnt_tabla").show(0);
        $("#cnt_form").hide(0);
    }

    function editar_horario(){
        $("#band").val("edit");
        $("#submit").click();
    }

    function eliminar_horario(estado, t){
        $("#band").val("delete");
        if(t == 1){
            var tipo = "el viático seleccionado";
        }else{
            var tipo = "la restricción seleccionada";
        }
        if(estado == 1){
            var text = "Desea desactivar "+tipo;
            var title = "¿Dar de baja?";
        }else{
            var text = "Desea activar "+tipo;
            var title = "¿Activar?";
        }
        
        swal({   
            title: title,   
            text: text,   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#fc4b6c",   
            confirmButtonText: "Sí, continuar",
            closeOnConfirm: false 
        }, function(){
            if(estado == 1){
                $.when( $("#estado").val("0") ).then( $("#submit").click() );
            }else{
                $.when( $("#estado").val("1") ).then( $("#submit").click() );
            }
        });
    }

    function iniciar(){
        <?php if(tiene_permiso($segmentos=2,$permiso=1)){ ?>
        tablahorarios();        
        <?php }else{ ?>
            $("#cnt_tabla").html("Usted no tiene permiso para este formulario.");     
        <?php } ?>
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

    function tablahorarios(){
        if(window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttpB=new XMLHttpRequest();
        }else{// code for IE6, IE5
            xmlhttpB=new ActiveXObject("Microsoft.XMLHTTPB");
        }
        xmlhttpB.onreadystatechange=function(){
            if (xmlhttpB.readyState==4 && xmlhttpB.status==200){
                document.getElementById("cnt_tabla").innerHTML=xmlhttpB.responseText;
                $('[data-toggle="tooltip"]').tooltip();
                $('#myTable').DataTable();
            }
        }
        xmlhttpB.open("GET","<?php echo site_url(); ?>/configuraciones/horarios/tabla_horarios/",true);
        xmlhttpB.send();
    }

    function combo_viatico_hora(){
        var id_tipo = $("#id_tipo").val(); 
        if(window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttpB=new XMLHttpRequest();
        }else{// code for IE6, IE5
            xmlhttpB=new ActiveXObject("Microsoft.XMLHTTPB");
        }
        xmlhttpB.onreadystatechange=function(){
            if (xmlhttpB.readyState==4 && xmlhttpB.status==200){
                document.getElementById("cnt_combo_viatico_hora").innerHTML=xmlhttpB.responseText;                
            }
        }
        xmlhttpB.open("GET","<?php echo site_url(); ?>/configuraciones/horarios/combo_viatico_hora?id_tipo="+id_tipo,true);
        xmlhttpB.send(); 
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
                <h3 class="text-themecolor m-b-0 m-t-0">Gestión de horario de viáticos</h3>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Fin TITULO de la página de sección -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Inicio del CUERPO DE LA SECCIÓN -->
        <!-- ============================================================== -->
        <div class="row" <?php if($navegatorless){ echo "style='margin-right: 80px;'"; } ?>>
            <!-- ============================================================== -->
            <!-- Inicio del FORMULARIO de gestión -->
            <!-- ============================================================== -->
            <div class="col-lg-1"></div>
            <div class="col-lg-10" id="cnt_form" style="display: none;">
                <div class="card">
                    <div class="card-header bg-success2" id="ttl_form">
                        <div class="card-actions text-white">
                            <a style="font-size: 16px;" onclick="cerrar_mantenimiento();"><i class="mdi mdi-window-close"></i></a>
                        </div>
                        <h4 class="card-title m-b-0 text-white">Listado de viáticos</h4>
                    </div>
                    <div class="card-body b-t">
                        
                        <?php echo form_open('', array('id' => 'formajax', 'style' => 'margin-top: 0px;', 'class' => 'm-t-40')); ?>
                            <input type="hidden" id="band" name="band" value="save">
                            <input type="hidden" id="idhorario" name="idhorario" value="">
                            <input type="hidden" id="estado" name="estado" value="1">
                            <div class="row">
                                <div class="form-group col-lg-4 col-sm-12 <?php if($navegatorless){ echo "pull-left"; } ?>">
                                    <h5>Descripción: <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" id="descripcion" name="descripcion" class="form-control" required="" placeholder="desayuno, almuerzo, cena" data-validation-required-message="Este campo es requerido">
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                                <div class="form-group col-lg-4 col-sm-12 <?php if($navegatorless){ echo "pull-left"; } ?>">
                                    <h5>Monto: <span class="text-danger">*</span></h5>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-dollar"></i></div>
                                        <input type="number" id="monto" name="monto" class="form-control" required="" placeholder="0.00" data-validation-required-message="Este campo es requerido" min="0.00" step="any" value="0.00">
                                    </div>
                                    <div class="help-block"></div>
                                </div>
                                <div class="form-group col-lg-4 <?php if($navegatorless){ echo "pull-left"; } ?>">
                                    <h5>Tipo: <span class="text-danger">*</span></h5>
                                    <select id="id_tipo" name="id_tipo" class="form-control custom-select"  style="width: 100%" required="" onchange="combo_viatico_hora();">
                                        <option class="m-l-50" value="1">Viático</option>
                                        <option class="m-l-50" value="2">Restricción</option>
                                    </select>
                                    <div class="help-block"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-lg-4 <?php if($navegatorless){ echo "pull-left"; } ?>">
                                    <h5>Hora inicio: <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="time" id="hora_inicio" name="hora_inicio" class="form-control" required="" placeholder="desayuno, almuerzo, cena" data-validation-required-message="Formato de hora no válido">
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                                <div class="form-group col-lg-4 <?php if($navegatorless){ echo "pull-left"; } ?>">
                                    <h5>Hora fin: <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="time" id="hora_fin" name="hora_fin" class="form-control" required="" placeholder="desayuno, almuerzo, cena" data-validation-required-message="Formato de hora no válido">
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                </div>
                            </div>

                            <div class="row" id="cnt_combo_viatico_hora">
                                
                            </div>


                                <button id="submit" type="submit" style="display: none;"></button>
                                <div align="right" id="btnadd">
                                    <button type="reset" class="btn waves-effect waves-light btn-success"><i class="mdi mdi-recycle"></i> Limpiar</button>
                                    <button type="submit" class="btn waves-effect waves-light btn-success2"><i class="mdi mdi-plus"></i> Guardar</button>
                                </div>
                                <div align="right" id="btnedit" style="display: none;">
                                    <button type="reset" class="btn waves-effect waves-light btn-success"><i class="mdi mdi-recycle"></i> Limpiar</button>
                                    <button type="button" onclick="editar_horario()" class="btn waves-effect waves-light btn-info"><i class="mdi mdi-pencil"></i> Editar</button>
                                </div>

                            </div>

                        <?php echo form_close(); ?>
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

<script>

$(function(){     
    $("#formajax").on("submit", function(e){
        e.preventDefault();
        var f = $(this);
        var formData = new FormData(document.getElementById("formajax"));
        formData.append("dato", "valor");
        
        $.ajax({
            url: "<?php echo site_url(); ?>/configuraciones/horarios/gestionar_horarios",
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
                tablahorarios(<?php echo $this->uri->segment(4);?>);
            }else{
                swal({ title: "¡Ups! Error", text: "Intentalo nuevamente.", type: "error", showConfirmButton: true });
            }
        });
            
    });
});

</script>