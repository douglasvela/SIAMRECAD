<script type="text/javascript">
    function cambiar_editar(id,nombre,caracteristicas,codigo,bandera){
        $("#idb").val(id);
        $("#nombre").val(nombre);
        $("#caracteristicas").val(caracteristicas);
        $("#codigo").val(codigo);

        if(bandera == "edit"){
            $("#ttl_form").removeClass("bg-success");
            $("#ttl_form").addClass("bg-info");
            $("#btnadd").hide(0);
            $("#btnedit").show(0);
            $("#cnt-tabla").hide(0);
            $("#cnt_form").show(0);
            $("#ttl_form").children("h4").html("<span class='fa fa-wrench'></span> Editar Banco");
        }else{
            eliminar_banco();
        }
    }

    function cambiar_nuevo(){
        $("#idb").val("");
        $("#nombre").val("");
        $("#caracteristicas").val("");
        $("#codigo").val("");
        $("#band").val("save");
        $("#ttl_form").addClass("bg-success");
        $("#ttl_form").removeClass("bg-info");

        $("#btnadd").show(0);
        $("#btnedit").hide(0);

        $("#cnt-tabla").hide(0);
        $("#cnt_form").show(0);

        $("#ttl_form").children("h4").html("<span class='mdi mdi-plus'></span> Nuevo banco");
    }

    function cerrar_mantenimiento(){
        $("#cnt-tabla").show(0);
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
        <?php
          $data['id_modulo'] = $this->uri->segment(4);
          $data['id_usuario'] = $this->session->userdata('id_usuario_viatico');
          $data['id_permiso']="1";
          if(buscar_permiso($data)){
        ?>
        tablabancos(<?php echo $this->uri->segment(4);?>);
        <?php
          }else{
        ?>
            $("#cnt-tabla").html("Usted no tiene permiso para este formulario.");     
        <?php
          }
        ?>
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

    function tablabancos(id_modulo){          
        $( "#cnt-tabla" ).load("<?php echo site_url(); ?>/configuraciones/bancos/tabla_bancos/"+id_modulo, function() {
            $('#myTable').DataTable();
            $('[data-toggle="tooltip"]').tooltip();
        });  
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
                <h3 class="text-themecolor m-b-0 m-t-0">Gestión de bancos</h3>
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
                    <div class="card-header bg-success2" id="ttl_form">
                        <div class="card-actions text-white">
                            <a style="font-size: 16px;" onclick="cerrar_mantenimiento();"><i class="mdi mdi-window-close"></i></a>
                        </div>
                        <h4 class="card-title m-b-0 text-white">Listado de bancos</h4>
                    </div>
                    <div class="card-body b-t">
                        
                        <?php echo form_open('', array('id' => 'formajax', 'style' => 'margin-top: 0px;', 'class' => 'm-t-40', 'novalidate' => '')); ?>
                            <input type="hidden" id="band" name="band" value="save">
                            <input type="hidden" id="idb" name="idb" value="">
                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <h5>Nombre: <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" id="nombre" name="nombre" class="form-control" required="" data-validation-required-message="Este campo es requerido">
                                        <div class="help-block"></div>
                                    </div>
                                </div>

                                <div class="form-group col-lg-6" style="display: none;">
                                    <h5>Características: </h5>
                                    <div class="controls">
                                        <input type="text" id="caracteristicas" name="caracteristicas" class="form-control">
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <h5>Código del banco: </h5>
                                    <div class="controls">
                                        <input type="text" id="codigo" name="codigo" class="form-control" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="form-group col-lg-6">
                                    <h5>Campos de la base: <span class="text-danger">*</span></h5>
                                    <div class="input-group">
                                        <select id="nr" name="nr" class="select2" style="width: 100%" required="" onchange="informacion_empleado();">
                                            <option value="">[Elija el empleado]</option>
                                            <optgroup label="Bancos">
                                                <option value="b.codigo">Código</option>
                                                <option value="b.nombre">Nombre</option>
                                            </optgroup>
                                            <optgroup label="Persona empleada">
                                                <option value="e.DUI">DUI</option>
                                                <option value="e.nombre_completo">Nombre</option>
                                                <option value="e.cuenta_banco">Cuenta bancaria</option>
                                            </optgroup>
                                            <optgroup label="Poliza">
                                                <option value="p.no_poliza">No Poliza</option>
                                                <option value="SUM(p.total) AS total">Monto en viáticos</option>
                                            </optgroup>
                                        </select>
                                        <div class="input-group-addon btn btn-default" onclick="agregar_columna();" data-toggle="tooltip" title="" data-original-title="Agregar"><i class="mdi mdi-plus"></i></div>
                                    </div>
                                </div>

                                <div class="form-group col-lg-6">
                                    <h5>Otro campo: <span class="text-danger">*</span></h5>
                                    <div class="input-group">
                                        <select id="nr" name="nr" class="select2" style="width: 100%" required="" onchange="informacion_empleado();">
                                            <option value="">[Elija el empleado]</option>
                                            <optgroup label="Bancos">
                                                <option value="b.codigo">Código</option>
                                                <option value="b.nombre">Nombre</option>
                                            </optgroup>
                                            <optgroup label="Persona empleada">
                                                <option value="e.DUI">DUI</option>
                                                <option value="e.nombre_completo">Nombre</option>
                                                <option value="e.DUI">DUI</option>
                                            </optgroup>
                                        </select>
                                        <div class="input-group-addon btn btn-default" onclick="agregar_columna();" data-toggle="tooltip" title="" data-original-title="Agregar"><i class="mdi mdi-plus"></i></div>
                                    </div>
                                </div>

                            </div>
                            
                            <button id="submit" type="submit" style="display: none;"></button>
                            <div align="right" id="btnadd">
                                <button type="reset" class="btn waves-effect waves-light btn-success"><i class="mdi mdi-recycle"></i> Limpiar</button>
                                <button type="submit" class="btn waves-effect waves-light btn-success2"><i class="mdi mdi-plus"></i> Guardar</button>
                            </div>
                            <div align="right" id="btnedit" style="display: none;">
                                <button type="reset" class="btn waves-effect waves-light btn-success"><i class="mdi mdi-recycle"></i> Limpiar</button>
                                <button type="button" onclick="editar_banco()" class="btn waves-effect waves-light btn-info"><i class="mdi mdi-pencil"></i> Editar</button>
                            </div>

                        <?php echo form_close(); ?>
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
            <div class="col-lg-12" id="cnt-tabla">
                 
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
            url: "<?php echo site_url(); ?>/configuraciones/bancos/gestionar_bancos",
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
                tablabancos(<?php echo $this->uri->segment(4);?>);
            }else{
                swal({ title: "¡Ups! Error", text: "Intentalo nuevamente.", type: "error", showConfirmButton: true });
            }
        });
            
    });
});

</script>