<script type="text/javascript">
    function cambiar_editar(id,descripcion,hora_inicio,hora_fin,monto){
        $("#idhorario").val(id);
        $("#descripcion").val(descripcion);
        $("#hora_inicio").val(hora_inicio);
        $("#hora_fin").val(hora_fin);
        $("#monto").val(monto);

        $("#ttl_form").removeClass("bg-success");
        $("#ttl_form").addClass("bg-info");

        $("#btnadd").hide(0);
        $("#btnedit").show(0);

        $("#cnt-tabla").hide(0);
        $("#cnt_form").show(0);

        $("#ttl_form").children("h4").html("<span class='fa fa-wrench'></span> Editar viático");
    }

    function cambiar_nuevo(){
        $("#idhorario").val("");
        $("#descripcion").val("");
        $("#hora_inicio").val("");
        $("#hora_fin").val("");
        $("#monto").val("");
        $("#band").val("save");

        $("#ttl_form").addClass("bg-success");
        $("#ttl_form").removeClass("bg-info");

        $("#btnadd").show(0);
        $("#btnedit").hide(0);

        $("#cnt-tabla").hide(0);
        $("#cnt_form").show(0);

        $("#ttl_form").children("h4").html("<span class='mdi mdi-plus'></span> Nuevo viático");
    }

    function cerrar_mantenimiento(){
        $("#cnt-tabla").show(0);
        $("#cnt_form").hide(0);
    }

    function editar_horario(obj){
        $("#band").val("edit");
        $("#submit").click();
    }

    function eliminar_horario(obj){
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
        tablausuarios();        
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

    function tablausuarios(){        
        if(window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttpB=new XMLHttpRequest();
        }else{// code for IE6, IE5
            xmlhttpB=new ActiveXObject("Microsoft.XMLHTTPB");
        }
        
        xmlhttpB.onreadystatechange=function(){
            if (xmlhttpB.readyState==4 && xmlhttpB.status==200){
                  document.getElementById("cnt-tabla").innerHTML=xmlhttpB.responseText;
                  $('#myTable').DataTable();
            }
        }
        
        xmlhttpB.open("GET","<?php echo site_url(); ?>/usuarios/tablausuarios",true);
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
                <h3 class="text-themecolor m-b-0 m-t-0">Administración de usuarios</h3>
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
                        <h4 class="card-title m-b-0 text-white">Listado de usuarios</h4>
                    </div>
                    <div class="card-body b-t">
                        
                        <?php echo form_open('', array('id' => 'formajax', 'style' => 'margin-top: 0px;', 'class' => 'm-t-40', 'novalidate' => '')); ?>
                            <input type="hidden" id="band" name="band" value="save">
                            <input type="hidden" id="idusuario" name="idusuario" value="">
                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <h5>Nombre: <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" id="nombre" name="nombre" class="form-control" required="" placeholder="Ingrese el nombre" minlength="3" data-validation-required-message="Este campo es requerido">
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <h5>Apellido: <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" id="apellido" name="apellido" class="form-control" required="" placeholder="Ingrese el apellido" minlength="3" data-validation-required-message="Este campo es requerido">
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>        
                                               
                            <div class="row">
                            	<div class="form-group col-lg-6">
                                    <h5>Genero: <span class="text-danger">*</span></h5>
                                    <fieldset class="controls">
                                        <?php
	                                		$genero = $this->db->get("org_genero");

						                    if(!empty($genero)){
						                        foreach ($genero->result() as $fila) {
						                        	echo '<label class="custom-control custom-radio">';
						                        	echo '<input type="radio" value="'.strtolower($fila->id_genero).'" data-validation-required-message="Seleccione el genero" name="genero" id="'.strtolower($fila->genero).'" class="custom-control-input" required>';
						                        	echo '<span class="custom-control-indicator"></span> <span class="custom-control-description">'.ucfirst(strtolower($fila->genero)).'</span>';
						                        	echo '</label>';
						                        }
						                    }
	                                	?>
                                    </fieldset>
                                </div> 
                                <div class="form-group col-lg-6">
                                    <h5>Hora fin: <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="time" id="hora_fin" name="hora_fin" class="form-control" required="" placeholder="desayuno, almuerzo, cena" data-validation-required-message="Este campo es requerido">
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>
                            <button id="submit" type="submit" style="display: none;"></button>
                            <div align="right" id="btnadd">
                                <button type="submit" class="btn waves-effect waves-light btn-success2"><i class="mdi mdi-plus"></i> Guardar</button>
                            </div>
                            <div align="right" id="btnedit" style="display: none;">
                                <button type="button" onclick="editar_horario(this)" class="btn waves-effect waves-light btn-info"><i class="mdi mdi-pencil"></i> Editar</button>
                                <button type="button" onclick="eliminar_horario(this)" class="btn waves-effect waves-light btn-danger"><i class="mdi mdi-window-close"></i> Eliminar</button>
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
            url: "<?php echo site_url(); ?>/usuarios/usuarios/gestionar_usuarios",
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