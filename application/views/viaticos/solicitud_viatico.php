<script type="text/javascript">

    function iniciar(){
        tabla_solicitudes();        
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

    function tabla_solicitudes(){    
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
            }
        }
        xmlhttpB.open("GET","<?php echo site_url(); ?>/viatico/solicitud/tabla_solicitudes",true);
        xmlhttpB.send(); 
    }

    function combo_oficina_departamento(tipo){
        if(window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp_municipio=new XMLHttpRequest();
        }else{// code for IE6, IE5
            xmlhttp_municipio=new ActiveXObject("Microsoft.XMLHTTPB");
        }

        xmlhttp_municipio.onreadystatechange=function(){
            if (xmlhttp_municipio.readyState==4 && xmlhttp_municipio.status==200){
                  document.getElementById("combo_departamento").innerHTML=xmlhttp_municipio.responseText;
                  $(".select2").select2();
                  combo_municipio(tipo);
            }
        }
        xmlhttp_municipio.open("GET","<?php echo site_url(); ?>/viatico/solicitud/combo_oficinas_departamentos?tipo="+tipo,true);
        xmlhttp_municipio.send();
    }

    function combo_municipio(tipo){
        var id_departamento = $("#departamento").val();
        if(window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp_municipio=new XMLHttpRequest();
        }else{// code for IE6, IE5
            xmlhttp_municipio=new ActiveXObject("Microsoft.XMLHTTPB");
        }

        xmlhttp_municipio.onreadystatechange=function(){
            if (xmlhttp_municipio.readyState==4 && xmlhttp_municipio.status==200){
                  document.getElementById("combo_municipio").innerHTML=xmlhttp_municipio.responseText;
                  $(".select2").select2();
                  if(tipo == "oficina"){
                    if($("#departamento").val() != ""){
                        $("#nombre_empresa").val($("#departamento option:selected").text());
                        $("#direccion_empresa").val($("#municipio option:selected").text());
                        $("#nombre_empresa").parent().hide(0);
                        $("#direccion_empresa").parent().hide(0);
                        $("#municipio").parent().hide(0);
                    }else{
                        $("#nombre_empresa").parent().hide(0);
                        $("#direccion_empresa").parent().hide(0);
                        $("#municipio").parent().hide(0);
                        $("#nombre_empresa").val("");
                        $("#direccion_empresa").val("");
                    }
                    input_distancia(tipo);
                  }else if(tipo == "departamento"){
                    $("#nombre_empresa").parent().show(0);
                    $("#direccion_empresa").parent().show(0);
                    $("#municipio").parent().show(0);
                    input_distancia(tipo);
                  }
            }
        }
        xmlhttp_municipio.open("GET","<?php echo site_url(); ?>/viatico/solicitud/combo_municipios?id_departamento="+id_departamento+"&tipo="+tipo,true);
        xmlhttp_municipio.send();
    }

    function input_distancia(tipo){
        var id_departamento = $("#departamento").val();
        var id_municipio = $("#municipio").val();
        if(window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp_municipio=new XMLHttpRequest();
        }else{// code for IE6, IE5
            xmlhttp_municipio=new ActiveXObject("Microsoft.XMLHTTPB");
        }

        xmlhttp_municipio.onreadystatechange=function(){
            if (xmlhttp_municipio.readyState==4 && xmlhttp_municipio.status==200){
                  document.getElementById("input_distancia").innerHTML=xmlhttp_municipio.responseText;
                  $(".select2").select2();
            }
        }
        xmlhttp_municipio.open("GET","<?php echo site_url(); ?>/viatico/solicitud/input_distancia?id_departamento="+id_departamento+"&id_municipio="+id_municipio+"&tipo="+tipo,true);
        xmlhttp_municipio.send();
    }

    function tabla_empresas_visitadas(callback){
        var id_mision = $("#id_mision").val();

        if(window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp_municipio=new XMLHttpRequest();
        }else{// code for IE6, IE5
            xmlhttp_municipio=new ActiveXObject("Microsoft.XMLHTTPB");
        }

        xmlhttp_municipio.onreadystatechange=function(){
            if (xmlhttp_municipio.readyState==4 && xmlhttp_municipio.status==200){
                  document.getElementById("cnt_empresas").innerHTML=xmlhttp_municipio.responseText;
                  if(typeof callback != "undefined"){
                    callback();
                  }
            }
        }

        xmlhttp_municipio.open("GET","<?php echo site_url(); ?>/viatico/solicitud/tabla_empresas_visitadas?id_mision="+id_mision,true);
        xmlhttp_municipio.send();
    }

    function tabla_empresas_viaticos(tipo){
        var id_mision = $("#id_mision").val();
        if(window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp_municipio=new XMLHttpRequest();
        }else{// code for IE6, IE5
            xmlhttp_municipio=new ActiveXObject("Microsoft.XMLHTTPB");
        }

        xmlhttp_municipio.onreadystatechange=function(){
            if (xmlhttp_municipio.readyState==4 && xmlhttp_municipio.status==200){
                  document.getElementById("tabla_viaticos").innerHTML=xmlhttp_municipio.responseText;
                  $('[data-toggle="tooltip"]').tooltip();

            }
        }

        xmlhttp_municipio.open("GET","<?php echo site_url(); ?>/viatico/solicitud/tabla_empresas_viaticos?id_mision="+id_mision+"&tipo="+tipo,true);
        xmlhttp_municipio.send();
    }

    function form_mision(){
        $("#cnt_mision").show(0);
        $("#cnt_rutas").hide(0);
        $("#cnt_viaticos").hide(0);
    }

    function form_rutas(){
        tabla_empresas_visitadas(function(){ form_oficinas() });
        $("#cnt_mision").hide(0);
        $("#cnt_rutas").show(0);
        $("#cnt_viaticos").hide(0);
        document.getElementById("destino_oficina").checked = true;
    }

    function form_viaticos(){
        $("#cnt_mision").hide(0);
        $("#cnt_rutas").hide(0);
        $("#cnt_viaticos").show(0);
        tabla_empresas_viaticos("guardar");
    }

    function form_oficinas(){
        combo_oficina_departamento("oficina");
        $("#nombre_empresa").parent().hide(0);
        $("#direccion_empresa").parent().hide(0);
        $("#municipio").parent().hide(0);
        $("#nombre_empresa").val("");
        $("#direccion_empresa").val("");
    }

    function form_folleto_viaticos(){
        combo_oficina_departamento("departamento");
        $("#nombre_empresa").parent().show(0);
        $("#direccion_empresa").parent().show(0);
        $("#municipio").parent().show(0);
        $("#nombre_empresa").val("");
        $("#direccion_empresa").val("");
    }

    function form_mapa(){
        
    }

    function editar_mision(){
        $("#band").val("edit");
        $("#formajax").submit();
    }

    function cerrar_mantenimiento(){
        $("#cnt_tabla").show(0);
        $("#cnt_form").hide(0);
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

        $("#cnt_tabla").hide(0);
        $("#cnt_form").show(0);

        form_mision();

        $("#ttl_form").children("h4").html("<span class='mdi mdi-plus'></span> Nueva solicitud de viáticos y pasajes");
    }

    function cambiar_editar(id,nombre,fecha_mision,actividad_realizada,bandera){
        $("#id_mision").val(id);
        $("#nombre_empleado").val(nombre);
        $("#fecha_mision").val(fecha_mision);
        $("#nombre_empresa").val("");
        $("#direccion_empresa").val("");
        $("#actividad").val(actividad_realizada);        

        if(bandera == "edit"){
            form_mision();
            $("#ttl_form").removeClass("bg-success");
            $("#ttl_form").addClass("bg-info");
            $("#btnadd").hide(0);
            $("#btnedit").show(0);
            $("#cnt_tabla").hide(0);
            $("#cnt_form").show(0);
            $("#ttl_form").children("h4").html("<span class='fa fa-wrench'></span> Editar solicitud de viáticos y pasajes");
        }else{
            eliminar_mision();
        }
    }

    function cambiar_eliminar_destino(id_empresa_visitada){
        swal({   
            title: "¿Está seguro?",   
            text: "¡Desea eliminar el registro!",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#fc4b6c",   
            confirmButtonText: "Sí, deseo eliminar!",   
            closeOnConfirm: true 
        }, function(){   
            eliminar_destino(id_empresa_visitada)
        });
    }

    function eliminar_destino(id_empresa_visitada){
        ajax = objetoAjax();
        ajax.open("POST", "<?php echo site_url(); ?>/viatico/solicitud/eliminar_destino", true);
        ajax.onreadystatechange = function() {
            if (ajax.readyState == 4){
               tabla_empresas_visitadas();              
            }
        } 
        ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded"); 
        ajax.send("&id_empresa_visitada="+id_empresa_visitada)
    }

    function eliminar_mision(){
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
            $("#formajax").submit();
        });
    }

    function gestionar_destino(band){
        $("#band2").val(band);
        $("#btn_submit").click();
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
                <h3 class="text-themecolor m-b-0 m-t-0">
                	<?php 
                		echo $titulo = ucfirst("Solicitud de viáticos y pasajes"); 
                	?>
                	</h3>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Fin TITULO de la página de sección -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Inicio del CUERPO DE LA SECCIÓN -->
        <!-- ============================================================== -->
        <div class="row">

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


                        <!-- ============================================================== -->
                        <!-- Inicio del FORMULARIO DATOS DE MISIÓN -->
                        <!-- ============================================================== -->
                        <div id="cnt_mision">

                            <h3 class="box-title" style="margin: 0px;">
                                <button type="button" class="btn waves-effect waves-light btn-lg btn-danger" style="padding: 1px 10px 1px 10px;">Paso 1</button>&emsp;
                                Datos de la misión
                            </h3>
                            <hr class="m-t-0 m-b-30">
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

                                $empleado = $this->db->query("SELECT e.id_empleado, UPPER(CONCAT_WS(' ', e.primer_nombre, e.segundo_nombre, e.tercer_nombre, e.primer_apellido, e.segundo_apellido, e.apellido_casada)) AS nombre_completo FROM sir_empleado AS e WHERE e.nr = '".$nr_usuario."' ORDER BY primer_nombre");

                                if($empleado->num_rows() > 0){
                                    foreach ($empleado->result() as $fila) {              
                                       $nombre_usuario = trim($fila->nombre_completo);
                                    }
                                }

                            ?>
                            <input type="hidden" id="id_mision" name="id_mision" value="">
                            <input type="hidden" id="nr" name="nr" value="<?php echo $nr_usuario; ?>">
                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <h5>Nombre del empleado: <span class="text-danger">*</span></h5>
                                    <input type="text" id="nombre_empleado" name="nombre_empleado" class="form-control" required="" minlength="3" value="<?php echo $nombre_usuario; ?>" readonly data-validation-required-message="Este campo es requerido">
                                    <div class="help-block"></div>
                                </div>
                                <div class="form-group col-lg-6">   
                                    <h5>Fecha de misión: <span class="text-danger">*</span></h5>
                                    <input type="text" pattern="\d{1,2}-\d{1,2}-\d{4}" data-date-end-date="0d" data-date-start-date="-5d" onkeyup="FECHA('fecha_mision')" required="" value="<?php echo date('d-m-Y'); ?>" class="form-control" id="fecha_mision" name="fecha_mision" placeholder="dd/mm/yyyy">
                                    <div class="help-block"></div>                   
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-lg-12" style="height: 83px;">
                                    <h5>Actividad realizada: <span class="text-danger">*</span></h5>
                                    <textarea type="text" onkeyup="TEXTO('actividad',3,500);" id="actividad" name="actividad" class="form-control" required="" placeholder="Describa la actividad realizada en la misión" minlength="3" data-validation-required-message="Este campo es requerido"></textarea>
                                    <div class="help-block"></div>
                                </div>
                            </div>

                            <div align="right" id="btnadd">
                                <button type="reset" class="btn waves-effect waves-light btn-success"><i class="mdi mdi-recycle"></i> Limpiar</button>
                                <button type="submit" class="btn waves-effect waves-light btn-success2">Continuar <i class="mdi mdi-chevron-right"></i></button>
                            </div>
                            <div align="right" id="btnedit" style="display: none;">
                                <button type="reset" class="btn waves-effect waves-light btn-success"><i class="mdi mdi-recycle"></i> Limpiar</button>
                                <button type="button" onclick="editar_mision()" class="btn waves-effect waves-light btn-success2">Continuar <i class="mdi mdi-chevron-right"></i></button>
                            </div>
                        <?php echo form_close(); ?>
                        </div>
                        <!-- ============================================================== -->
                        <!-- Fin del FORMULARIO DATOS DE MISIÓN -->
                        <!-- ============================================================== -->


                        <!-- ============================================================== -->
                        <!-- Inicio del FORMULARIO EMPRESAS VISITADAS -->
                        <!-- ============================================================== -->
                        <div id="cnt_rutas" style="display: none;">
                            <h3 class="box-title" style="margin: 0px;">
                                <button type="button" class="btn waves-effect waves-light btn-lg btn-danger" style="padding: 1px 10px 1px 10px;">Paso 2</button>&emsp;
                                Empresas visitadas
                            </h3>
                            <hr class="m-t-0 m-b-30">
                            <?php echo form_open('', array('id' => 'form_empresas_visitadas', 'style' => 'margin-top: 0px;', 'class' => 'm-t-40')); ?>
                            <div class="row">
                                <input type="hidden" id="band2" name="band2" value="save">
                                <div class="form-group col-lg-12">
                                    <h5>Opciones de destino: <span class="text-danger">*</span></h5>
                                    <input type="radio" id="destino_oficina" checked="" name="r_destino" value="destino_oficina"> 
                                    <label for="destino_oficina" onclick="form_oficinas();">Oficina MTPS</label>&emsp;
                                    <input type="radio" id="destino_municipio" name="r_destino" value="destino_municipio">
                                    <label for="destino_municipio" onclick="form_folleto_viaticos();">Folleto de distancias</label>&emsp;
                                    <input type="radio" id="destino_mapa" name="r_destino" value="destino_mapa">
                                    <label for="destino_mapa" onclick="form_mapa();">Buscar en mapa</label>
                                </div>
                                
                            </div>

                            <div class="row">
                                <div class="form-group col-lg-6" id="combo_departamento">
                                </div>
                                <div class="form-group col-lg-6" id="combo_municipio">
                                </div>
                                <div class="form-group col-lg-6" id="input_distancia">
                                </div>
                            
                                <div class="form-group col-lg-6">
                                    <h5>Nombre de la empresa: <span class="text-danger">*</span></h5>
                                    <input type="text" id="nombre_empresa" name="nombre_empresa" class="form-control" placeholder="Ingrese el nombre de la empresa" required>
                                    <span class="help-block"></span>
                                </div>
                                <div class="form-group col-lg-12">
                                    <h5>Dirección: <span class="text-danger">*</span></h5>
                                    <textarea id="direccion_empresa" name="direccion_empresa" class="form-control" placeholder="Ingrese la dirección de la empresa" rows="2" required></textarea>
                                    <span class="help-block"></span>
                                </div>
                            </div>

                            <button style="display: none;" type="submit" id="btn_submit" class="btn waves-effect waves-light btn-success2">submit</button>

                            <div align="right" id="btnadd2">
                                <button type="reset" class="btn waves-effect waves-light btn-success"><i class="mdi mdi-recycle"></i> Limpiar</button>
                                <button type="button" onclick="gestionar_destino('save')" class="btn waves-effect waves-light btn-success2"><i class="mdi mdi-plus"></i> Agregar destino</button>
                            </div>
                            <div align="right" id="btnedit2" style="display: none;">
                                <button type="reset" class="btn waves-effect waves-light btn-success"><i class="mdi mdi-recycle"></i> Limpiar</button>
                                <button type="button" onclick="editar_mision()" class="btn waves-effect waves-light btn-success2">Continuar <i class="mdi mdi-chevron-right"></i></button>
                            </div>
                            <?php echo form_close(); ?>

                            <!-- Inicio de la TABLA EMPRESAS VISITADAS -->
                            <div class="row" id="cnt_empresas"></div>
                            <!-- Fin de la TABLA EMPRESAS VISITADAS -->

                            <div align="right">
                                <button type="button" onclick="form_viaticos();" class="btn waves-effect waves-light btn-success2">Continuar <i class="mdi mdi-chevron-right"></i></button>
                            </div>

                        </div>
                        <!-- ============================================================== -->
                        <!-- Fin del FORMULARIO EMPRESAS VISITADAS -->
                        <!-- ============================================================== -->


                        <!-- ============================================================== -->
                        <!-- Inicio del FORMULARIO DE VIÁTICOS Y PASAJES -->
                        <!-- ============================================================== -->
                        <div id="cnt_viaticos">
                             <h3 class="box-title" style="margin: 0px;">
                                <button type="button" class="btn waves-effect waves-light btn-lg btn-danger" style="padding: 1px 10px 1px 10px;">Paso 3</button>&emsp;
                                Detalle de viáticos y pasajes
                            </h3>
                            <hr class="m-t-0 m-b-10">
                            <div id="tabla_viaticos"></div>
                        </div>
                        <!-- ============================================================== -->
                        <!-- Fin del FORMULARIO DE VIÁTICOS Y PASAJES -->
                        <!-- ============================================================== -->


                    </div>
                </div>
            </div>
            <div class="col-lg-1"></div>

            <div class="col-lg-12" id="cnt_tabla">

            </div>

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

    $("#formajax").on("submit", function(e){
        e.preventDefault();      
        var formData = new FormData(document.getElementById("formajax"));
        $.ajax({
                type:  'POST',
                url:   '<?php echo site_url(); ?>/viatico/solicitud/gestionar_mision',
                dataType: "html",
                data: formData,
                cache: false,
                contentType: false,
                processData: false
        })
        .done(function(data){ //una vez que el archivo recibe el request lo procesa y lo devuelve
            if(data == "exito"){
                if($("#band").val() == "save"){
                    //swal({ title: "¡Registro exitoso!", type: "success", showConfirmButton: true });
                    form_rutas();
                }else if($("#band").val() == "edit"){
                    //swal({ title: "¡Modificación exitosa!", type: "success", showConfirmButton: true });
                    form_rutas();
                }else{
                    swal({ title: "¡Borrado exitoso!", type: "success", showConfirmButton: true });
                }
                tabla_solicitudes();
            }else{
                swal({ title: "¡Ups! Error", text: "Intentalo nuevamente.", type: "error", showConfirmButton: true });
            }
        });
    });


    $("#form_empresas_visitadas").on("submit", function(e){
        e.preventDefault();
        var formData = {
            "id_mision" : $("#id_mision").val(),
            "departamento" : $("#departamento").val(),
            "municipio" : $("#municipio").val(),
            "nombre_empresa" : $("#nombre_empresa").val(),
            "direccion_empresa" : $("#direccion_empresa").val(),
            "tipo" : $('input[name=r_destino]:checked').val(),
            "band" : $("#band2").val()
        };
        $.ajax({
            type:  'POST',
            url:   '<?php echo site_url(); ?>/viatico/solicitud/gestionar_destinos',
            data: formData,
            cache: false
        })
        .done(function(data){
            if(data == "exito"){
                tabla_empresas_visitadas();
            }else{
                swal({ title: "¡Ups! Error", text: "Intentalo nuevamente.", type: "error", showConfirmButton: true });
            }
        });
    });

});

</script>