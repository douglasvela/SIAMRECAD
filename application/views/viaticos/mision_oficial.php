<script type="text/javascript">
    function cambiar_editar(id,nombre,fecha_mision,nombre_empresa,direccion_empresa,actividad_realizada,bandera){
        $("#id_mision").val(id);
        $("#nombre_empleado").val(nombre);
        $("#fecha_mision").val(fecha_mision);
        $("#nombre_empresa").val(nombre_empresa);
        $("#direccion_empresa").val(direccion_empresa);
        $("#actividad").val(actividad_realizada);        

        if(bandera == "edit"){
            $("#ttl_form").removeClass("bg-success");
            $("#ttl_form").addClass("bg-info");
            $("#btnadd").hide(0);
            $("#btnedit").show(0);
            $("#cnt-tabla").hide(0);
            $("#cnt_form").show(0);
            $("#ttl_form").children("h4").html("<span class='fa fa-wrench'></span> Editar misión");
        }else{
            eliminar_horario();
        }
    }

    function cambiar_nuevo(){
        $("#id_mision").val("");
        $("#nombre_empresa").val("");
        $("#direccion_empresa").val("");
        $("#actividad").val("");
        $("#band").val("save");

        $("#ttl_form").addClass("bg-success");
        $("#ttl_form").removeClass("bg-info");

        $("#btnadd").show(0);
        $("#btnedit").hide(0);

        $("#cnt-tabla").hide(0);
        $("#cnt_form").show(0);

        $("#ttl_form").children("h4").html("<span class='mdi mdi-plus'></span> Nueva misión");
    }

    function cerrar_mantenimiento(){
        $("#cnt-tabla").show(0);
        $("#cnt_form").hide(0);
    }

    function editar_horario(){
        $("#band").val("edit");
        $("#submit").click();
    }

    function eliminar_horario(){
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
        tablahorarios();        
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
        $( "#cnt-tabla" ).load("<?php echo site_url(); ?>/viatico/mision_oficial/tabla_misiones", function() {
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
                <h3 class="text-themecolor m-b-0 m-t-0">Gestión de misiones oficiales</h3>
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
                        <h4 class="card-title m-b-0 text-white"></h4>
                    </div>
                    <div class="card-body b-t">
                        
                        <?php echo form_open('', array('id' => 'formajax', 'style' => 'margin-top: 0px;', 'class' => 'm-t-40', 'novalidate' => '')); ?>
                            <input type="hidden" id="band" name="band" value="save">
                            <?php
                                $user = $this->session->userdata('usuario_viatico');
                                $nr = $this->db->query("SELECT * FROM org_usuario WHERE usuario = '".$user."' LIMIT 1");
                                $nr_usuario = ""; $nombre_usuario;
                                if($nr->num_rows() > 0){
                                    foreach ($nr->result() as $fila) { 
                                        $nr_usuario = $fila->nr; 
                                        $nombre_usuario = $fila->nombre_completo;
                                    }
                                }

                            ?>
                            <input type="hidden" id="id_mision" name="id_mision" value="">
                            <input type="hidden" id="nr" name="nr" value="<?php echo $nr_usuario; ?>">
                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <h5>Nombre del empleado: <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" id="nombre_empleado" name="nombre_empleado" class="form-control" required="" minlength="3" value="<?php echo $nombre_usuario; ?>" readonly data-validation-required-message="Este campo es requerido">
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                                <div class="form-group col-lg-6 m-b-15">   
                                    <h5>Fecha de misión: <span class="text-danger">*</span></h5>
                                    <input type="text" data-date-end-date="0d" value="<?php echo date('d-m-Y'); ?>" class="form-control" id="fecha_mision" name="fecha_mision" placeholder="dd/mm/yyyy">                       
                                </div>

                            </div>

                            <div class="row">
                            	<div class="form-group col-lg-4">
                                    <h5>Nombre de la empresa: <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" id="nombre_empresa" name="nombre_empresa" class="form-control" required="" placeholder="Ingrese el nombre de la empresa" minlength="3" data-validation-required-message="Este campo es requerido">
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                                <div class="form-group col-lg-8">
                                    <h5>Dirección: <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" id="direccion_empresa" name="direccion_empresa" class="form-control" required="" placeholder="Ingrese la dirección de la empresa" minlength="3" data-validation-required-message="Este campo es requerido">
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-lg-12">
                                    <h5>Actividad realizada: <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <textarea type="text" id="actividad" name="actividad" class="form-control" required="" placeholder="Describa la actividad realizada en la misión" minlength="3" data-validation-required-message="Este campo es requerido"></textarea>
                                        <div class="help-block"></div>
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
                                <button type="button" onclick="editar_horario()" class="btn waves-effect waves-light btn-info"><i class="mdi mdi-pencil"></i> Editar</button>
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

    $(document).ready(function(){         
        $('#fecha_mision').datepicker({
        	format: 'dd-mm-yyyy',
            autoclose: true,
            todayHighlight: true
        });
    });
});

$(function(){     
    $("#formajax").on("submit", function(e){
        e.preventDefault();
        var f = $(this);
        var formData = new FormData(document.getElementById("formajax"));
        formData.append("dato", "valor");
        
        $.ajax({
            url: "<?php echo site_url(); ?>/viatico/mision_oficial/gestionar_mision",
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
                tablahorarios();
            }else{
                swal({ title: "¡Ups! Error", text: "Intentalo nuevamente.", type: "error", showConfirmButton: true });
            }
        });
            
    });
});

</script>