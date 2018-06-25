<script type="text/javascript">
    function cambiar_editar(id,nombre, caracteristicas, codigo_a, codigo_b, delimitador, bandera){
        $("#idb").val(id);
        $("#nombre").val(nombre);
        $("#caracteristicas").val(caracteristicas);
        $("#codigo_a").val(codigo_a);
        $("#codigo_b").val(codigo_b);
        $("#delimitador").val(delimitador);
        if(bandera == "edit"){
            $("#ttl_form").removeClass("bg-success");
            $("#ttl_form").addClass("bg-info");
            $("#btnadd").hide(0);
            $("#btnedit").show(0);
            $("#cnt_tabla").hide(0);
            $("#cnt_form").show(0);
            $("#ttl_form").children("h4").html("<span class='fa fa-wrench'></span> Editar Banco");
            $("#cnt_registros_estructura").show(500);
            tabla_estructura_planilla();
        }else{
            eliminar_banco();
        }
    }

    function cambiar_nuevo(){
        $("#idb").val("");
        $("#nombre").val("");
        $("#caracteristicas").val("");
        $("#codigo_a").val("");
        $("#codigo_b").val("");
        $("#delimitador").val("");
        $("#band").val("save");
        $("#ttl_form").addClass("bg-success");
        $("#ttl_form").removeClass("bg-info");

        $("#cnt_registros_estructura").hide(0);

        $("#btnadd").show(0);
        $("#btnedit").hide(0);

        $("#cnt_tabla").hide(0);
        $("#cnt_form").show(0);
        $("#ttl_form").children("h4").html("<span class='mdi mdi-plus'></span> Nuevo banco");
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
        <?php if(tiene_permiso($segmentos=2,$permiso=1)){ ?>
            tablabancos();
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

    function tablabancos(){          
        $( "#cnt_tabla" ).load("<?php echo site_url(); ?>/configuraciones/bancos/tabla_bancos/", function() {
            $('#myTable').DataTable();
            $('[data-toggle="tooltip"]').tooltip();
        });  
    }

    function tabla_estructura_planilla(){ 
        var id_banco = $("#idb").val();
        $("#cnt_tabla_estructura").load("<?php echo site_url(); ?>/configuraciones/bancos/tabla_estructura_planilla?id_banco="+id_banco, function(){
            $('[data-toggle="tooltip"]').tooltip();
        });  
    }

    function agregar_columna(){
        var formData = {
          "id_banco" : $("#idb").val(),
          "valor_campo" : $("#columnas").val(),
          "nombre_campo" : $("#columnas option:selected").text().trim()
        };
        $.ajax({
            type:  'POST',
            url: '<?php echo site_url(); ?>/configuraciones/bancos/agregar_columnas',
            data: formData,
            cache: false
        })
        .done(function(data){
            if(data == "exito"){
                swal({ title: "¡Registro exitoso!", type: "success", showConfirmButton: true });
                tabla_estructura_planilla(<?php echo $this->uri->segment(4);?>);
            }else{
                swal({ title: "¡Ups! Error", text: "Intentalo nuevamente.", type: "error", showConfirmButton: true });
            }
        });
    }


    function cambiar_orden(id_banco, id_columna, orden, orden_nuevo){
        $('[data-toggle="tooltip"]').tooltip();
        var formData = {
          "id_banco" : id_banco,
          "id_columna" : id_columna,
          "orden" : orden,
          "orden_nuevo" : orden_nuevo,
        };
        $.ajax({
            type:  'POST',
            url: '<?php echo site_url(); ?>/configuraciones/bancos/cambiar_orden',
            data: formData,
            cache: false
        })
        .done(function(data){
            if(data == "exito"){
                $.toast({ heading: 'Edición exitosa', text: 'Se modificó el orden de las columnas', position: 'top-right', loaderBg:'#000', icon: 'info', hideAfter: 4000, stack: 6 });
                tabla_estructura_planilla();
            }else{
                $.toast({ heading: 'Ocurrió un error', text: 'Ocurrió un error al tratar de modificar el orden de las columnas', position: 'top-right', loaderBg:'#000', icon: 'error', hideAfter: 4000, stack: 6 });
            }
        });
    }


    function preguntar_eliminar_columna(id){
        swal({   
            title: "¿Está seguro?",   
            text: "¡Desea eliminar el registro!",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#fc4b6c",   
            confirmButtonText: "Sí, deseo eliminar!",   
            closeOnConfirm: false 
        }, function(){   
            eliminar_columna(id);
        });
    }

    function eliminar_columna(id){
        var formData = {
          "id_estructura" : id
        };
        $.ajax({
            type:  'POST',
            url: '<?php echo site_url(); ?>/configuraciones/bancos/eliminar_columna',
            data: formData,
            cache: false
        })
        .done(function(data){
            if(data == "exito"){
                swal({ title: "¡Borrado exitoso!", type: "success", showConfirmButton: true });
                tabla_estructura_planilla(<?php echo $this->uri->segment(4);?>);
            }else{
                swal({ title: "¡Ups! Error", text: "Intentalo nuevamente.", type: "error", showConfirmButton: true });
            }
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
                        
                        <?php echo form_open('', array('id' => 'formajax', 'style' => 'margin-top: 0px;', 'class' => 'm-t-40')); ?>
                            <input type="hidden" id="band" name="band" value="save">
                            <input type="hidden" id="idb" name="idb" value="">
                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <h5>Nombre: <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" id="nombre" name="nombre" class="form-control" required="">
                                    </div>
                                </div>

                                <div class="form-group col-lg-6" style="display: none;">
                                    <h5>Características: </h5>
                                    <div class="controls">
                                        <input type="text" id="caracteristicas" name="caracteristicas" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group col-lg-2">
                                    <h5>Código A: </h5>
                                    <div class="controls">
                                        <input type="text" id="codigo_a" name="codigo_a" class="form-control" required="">
                                    </div>
                                </div>
                                <div class="form-group col-lg-2">
                                    <h5>Código B: </h5>
                                    <div class="controls">
                                        <input type="text" id="codigo_b" name="codigo_b" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group col-lg-2">
                                    <h5>Delimitador: </h5>
                                    <div class="controls">
                                        <input type="text" id="delimitador" name="delimitador" class="form-control">
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
                            <br>
                        <?php echo form_close(); ?>

                        <div class="card" style="display: none;" id="cnt_registros_estructura">
                            <div class="card-header">
                                <h4 class="card-title m-b-0">Columnas de la planilla</h4>
                            </div>
                            <div class="card-body b-t"  style="padding-top: 7px;">

                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <h5>Campos de la base: <span class="text-danger">*</span></h5>
                                        <div class="input-group">
                                            <select id="columnas" name="columnas" class="select2" style="width: 100%" required="">
                                                <option value="">[Elija un campo para agregar]</option>
                                                <optgroup label="Bancos">
                                                    <option value="b.nombre AS nombre">Nombre (Banco)</option>
                                                    <option value="b.codigo_a AS codigo_a">Código A (Banco)</option>
                                                    <option value="b.codigo_b AS codigo_b">Código B (Banco)</option>
                                                </optgroup>
                                                <optgroup label="Persona empleada">
                                                    <option value="e.DUI AS DUI">DUI (Empleado)</option>
                                                    <option value="p.nombre_empleado AS nombre_empleado">Nombre (Empleado)</option>
                                                    <option value="ec.numero_cuenta AS numero_cuenta">Cuenta bancaria (Empleado)</option>
                                                </optgroup>
                                                <optgroup label="Poliza">
                                                    <option value="p.no_poliza AS no_poliza">No Poliza (Poliza)</option>
                                                    <option value="SUM(p.total) AS total">Monto en viáticos (Poliza)</option>
                                                </optgroup>
                                                <optgroup label="Otros">
                                                    <option value="'correlativo' AS correlativo">Correlativo (Otros)</option>
                                                    <option value="'' AS blanco">Espacio blanco (Otros)</option>
                                                </optgroup>
                                            </select>
                                            <div class="input-group-addon btn btn-success2" onclick="agregar_columna();" data-toggle="tooltip" title="" data-original-title="Agregar"><i class="mdi mdi-plus"></i></div>
                                        </div>
                                    </div>

                                    <div class="form-group col-lg-6">
                                        <h5>Formato: </h5>
                                        <div class="controls">
                                            <input type="text" id="formato" name="formato" class="form-control">
                                        </div>
                                    </div>

                                </div>
                                
                                <div id="cnt_tabla_estructura"></div>

                            </div>
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
                tablabancos();
            }else{
                swal({ title: "¡Ups! Error", text: "Intentalo nuevamente.", type: "error", showConfirmButton: true });
            }
        });
            
    });
});
</script>