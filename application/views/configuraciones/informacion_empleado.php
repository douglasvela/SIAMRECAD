<?php
	
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	header("Expires: Sat, 1 Jul 2000 05:00:00 GMT"); // Fecha en el pasado

    $user = $this->session->userdata('usuario_viatico');
    if(empty($user)){
        header("Location: ".site_url()."/login");
        exit();
    }

    $pos = strpos($user, ".")+1;
    $inicialUser = strtoupper(substr($user,0,1).substr($user, $pos,1));

    $nr = $this->db->query("SELECT * FROM org_usuario WHERE usuario = '".$user."' LIMIT 1");
    $nr_usuario = ""; $nombre_usuario;
    if($nr->num_rows() > 0){
        foreach ($nr->result() as $fila) { 
            $nr_usuario = $fila->nr; 
            $nombre_usuario = $fila->nombre_completo;
        }
    }

    $carpeta = "assets/firmas/";
                        
    //Validamos si la ruta de destino existe, en caso de no existir la creamos
    if(!file_exists($carpeta)){
        mkdir($carpeta, 0777) or die("No se puede crear el directorio de extracci&oacute;n");   
    }

    $empleado = $this->db->query("SELECT e.id_empleado, e.correo, e.telefono_casa, e.telefono_contacto, e.direccion, UPPER(CONCAT_WS(' ', e.primer_nombre, e.segundo_nombre, e.tercer_nombre, e.primer_apellido, e.segundo_apellido, e.apellido_casada)) AS nombre_completo FROM sir_empleado AS e WHERE e.nr = '".$nr_usuario."' ORDER BY primer_nombre");

    if($empleado->num_rows() > 0){
        foreach ($empleado->result() as $fila) {              
           $nombre_completo = trim($fila->nombre_completo);
           $correo = $fila->correo;
           $tel_casa = $fila->telefono_casa;
           $tel_contacto = $fila->telefono_contacto;
           $direccion = $fila->direccion;
        }
    }

    $info_empleado = $this->db->query("SELECT * FROM vyp_informacion_empleado WHERE nr = '".$nr_usuario."'");

    $cuenta_banco = $this->db->query("SELECT * FROM vyp_empleado_cuenta_banco WHERE nr = '".$nr_usuario."' AND estado = 1");

// Características del navegador
$ua=$this->config->item("navegator");
$navegatorless = false;
if(floatval($ua['version']) < $this->config->item("last_version")){
    $navegatorless = true;
}
?>
<script type="text/javascript">
	
	function iniciar(){

        <?php if($navegatorless){ ?>
        swal({ title: "Navegador antiguo", text: "La versión de su navegador está obsoleta. Las firmas no pueden ser recortadas en ésta versión.", type: "warning", showConfirmButton: true });
      <?php } ?>  

        <?php if(tiene_permiso($segmentos=2,$permiso=1)){ ?>
    		cambiar_informacion();
            $('html,body').animate({
                scrollTop: $("body").offset().top
            }, 500);
        <?php }else{ ?>
            $("#cnt_form").html("Usted no tiene permiso para este formulario.");     
        <?php } ?>
	}

	function tabla_cuentas(){ 
		var nr = $("#nr").val();   
        if(window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttpB=new XMLHttpRequest();
        }else{// code for IE6, IE5
            xmlhttpB=new ActiveXObject("Microsoft.XMLHTTPB");
        }
        xmlhttpB.onreadystatechange=function(){
            if (xmlhttpB.readyState==4 && xmlhttpB.status==200){
                document.getElementById("cnt_cuentas_bancarias").innerHTML=xmlhttpB.responseText;
                $('[data-toggle="tooltip"]').tooltip();
                firma_digital();
                $("#id_banco2").select2();
            }
        }
        xmlhttpB.open("GET","<?php echo site_url(); ?>/configuraciones/informacion_empleado/tabla_cuentas?nr="+nr,true);
        xmlhttpB.send(); 
    }

    function firma_digital(){ 
		var nr = $("#nr").val();   
        if(window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttpB=new XMLHttpRequest();
        }else{// code for IE6, IE5
            xmlhttpB=new ActiveXObject("Microsoft.XMLHTTPB");
        }
        xmlhttpB.onreadystatechange=function(){
            if (xmlhttpB.readyState==4 && xmlhttpB.status==200){
                document.getElementById("cnt_firma_digital").innerHTML=xmlhttpB.responseText;
                $('[data-toggle="tooltip"]').tooltip();
            }
        }
        xmlhttpB.open("GET","<?php echo site_url(); ?>/configuraciones/informacion_empleado/firma_digital?nr="+nr,true);
        xmlhttpB.send(); 
    }

    function combo_autorizador(){ 
        var nr = $("#nr").val();
        var id_oficina = $("#id_oficina").val();

        if(window.XMLHttpRequest){ xmlhttpB=new XMLHttpRequest();
        }else{ xmlhttpB=new ActiveXObject("Microsoft.XMLHTTPB"); }

        xmlhttpB.onreadystatechange=function(){
            if (xmlhttpB.readyState==4 && xmlhttpB.status==200){
                document.getElementById("cnt_combo_autorizador").innerHTML=xmlhttpB.responseText;
                $("#nr_autorizador").val($("#nr_autorizador_copy").val()).trigger('change.select2');
                tabla_cuentas();
                $('[data-toggle="tooltip"]').tooltip();
            }
        }
        xmlhttpB.open("GET","<?php echo site_url(); ?>/configuraciones/informacion_empleado/combo_autorizador?id_oficina="+id_oficina,true);
        xmlhttpB.send(); 
    }

    function guardar(){
        var canvas = document.getElementById("canvas");
        var image = canvas.toDataURL();

        var nr = $("#nr").val();

        ajax = objetoAjax();
        ajax.open("POST", "<?php echo site_url(); ?>/configuraciones/informacion_empleado/subir_firma", true);
        ajax.onreadystatechange = function() {
            if (ajax.readyState == 4){
                var response = ajax.responseText;
                if(response == "exito"){
	                $.toast({ heading: 'Modificación exitosa', text: 'Firma digital modificada exitosamente.', position: 'top-right', loaderBg:'#3c763d', icon: 'success', hideAfter: 3500, stack: 6
	                });
	                $("#getCroppedCanvasModal").modal("hide");
	                $('html,body').animate({
		                scrollTop: $("body").offset().top
		            }, 1000);

	                firma_digital();
	                //$('#imagen_firma').attr('src', '<?php echo base_url(); ?>assets/firmas/'+nr+'.png);

                }else{
                    swal({ title: "¡Ups! Error", text: "Intentalo nuevamente.", type: "error", showConfirmButton: true });
                }
            }
        } 
        ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded"); 
        ajax.send("&imagen="+image+"&nr="+nr)
    }

    function mostrar_firma(){
        $.when( $("#cnt_firma").css("visibility", "visible") ).then(function() {
            $(".docs-buttons").show(0);
            $('html,body').animate({
                scrollTop: $("#cnt_firma").offset().top
            }, 1000);
        });
    }

    function ocultar_firma(){
        $.when( $("#cnt_firma").css("visibility", "hidden") ).then(function() {
            $(".docs-buttons").hide(0);
            $('html,body').animate({
                scrollTop: $("body").offset().top
            }, 1000);
        });
    }

    function cambiar_informacion(){
    	var nr = $("#nr").val();   
        if(window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttpB=new XMLHttpRequest();
        }else{// code for IE6, IE5
            xmlhttpB=new ActiveXObject("Microsoft.XMLHTTPB");
        }
        xmlhttpB.onreadystatechange=function(){
            if (xmlhttpB.readyState==4 && xmlhttpB.status==200){
                document.getElementById("cnt_informacion_empleado").innerHTML=xmlhttpB.responseText;
                $("#id_empleado").val($("#nr_jefe_copy").val()).trigger('change.select2');
                $("#id_oficina").val($("#id_oficina_copy").val()).trigger('change.select2');
                if($("#nr").val() == ""){
                    $("#cnt_combos").hide(0);
                }else{
                    $("#cnt_combos").show(0);
                }
            }
        }
        xmlhttpB.open("GET","<?php echo site_url(); ?>/configuraciones/informacion_empleado/tabla_informacion_empleado?nr="+nr,true);
        xmlhttpB.send(); 
    }

    function cambiar_editar(id, nr, id_banco, cuenta, estado, band){
    	$("#id_empleado_banco").val(id);
    	$("#nr2").val(nr);
    	$("#id_banco").val(id_banco).trigger('change.select2');
    	$("#cuenta").val(cuenta);
    	$("#estado").val(estado);

    	if(band == 'edit'){
    		$("#modal_cuenta_bancaria").modal('show');
    		$("#band").val(band);
    	}else{
    		$("#band").val(band);
    		$("#submitbutton").click();
    	}
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
                <h3 class="text-themecolor m-b-0 m-t-0">Configuracion de datos del empleado</h3>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Fin TITULO de la página de sección -->
        <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <!-- Row -->
    <div class="row" <?php if($navegatorless){ echo "style='margin-right: 80px;'"; } ?>>     
        <!-- Column -->
        <div class="col-lg-1"></div>
        <div class="col-lg-10" id="cnt_form">
            <div class="card">


            	<div class="card-header bg-info">
                    <h4 class="card-title m-b-0 text-white">Configuraciones de datos de la persona solicitante</h4>
                </div>
                <div class="card-body b-t">
                	<?php echo form_open('', array('id' => 'formajax', 'style' => 'margin-top: 0px;', 'class' => 'm-t-40', 'autocomplete' => 'off')); ?>
                    <div class="row">                    	
                        <div class="form-group col-lg-8"> 
                            <h5>Persona solicitante a configurar: <span class="text-danger">*</span></h5>                           
                            <select id="nr" name="nr" class="select2" style="width: 100%" required="" onchange="cambiar_informacion();">
                                <option value="">[Elija la persona solicitante]</option>
                                <?php 
                                    $otro_empleado = $this->db->query("SELECT e.id_empleado, e.nr, UPPER(CONCAT_WS(' ', e.primer_nombre, e.segundo_nombre, e.tercer_nombre, e.primer_apellido, e.segundo_apellido, e.apellido_casada)) AS nombre_completo FROM sir_empleado AS e WHERE e.id_estado = '00001' ORDER BY e.primer_nombre, e.segundo_nombre, e.tercer_nombre, e.primer_apellido, e.segundo_apellido, e.apellido_casada");
                                    if($otro_empleado->num_rows() > 0){
                                        foreach ($otro_empleado->result() as $filae) {              
                                           echo '<option class="m-l-50" value="'.$filae->nr.'">'.preg_replace ('/[ ]+/', ' ', $filae->nombre_completo.' - '.$filae->nr).'</option>';
                                        }
                                    }
                                ?>
                            </select>
                            <div class="help-block"></div>
                        </div>
                    </div>

                    <h5>Información laboral de la persona solicitante</h5>
                    <blockquote class="m-t-10">

                    <div id="cnt_combos" style="display: none;">
                        <div class="row">
                            <div class="form-group col-lg-6 <?php if($navegatorless){ echo "pull-left"; } ?>"> 
                                <h5>Jefatura inmediata: <span class="text-danger">*</span></h5>                           
                                <select id="id_empleado" name="id_empleado" class="select2" style="width: 100%" required="">
                                    <option value="">[Elija la jefatura inmediata]</option>
                                    <?php 
                                        $otro_empleado = $this->db->query("SELECT e.id_empleado, e.nr, UPPER(CONCAT_WS(' ', e.primer_nombre, e.segundo_nombre, e.tercer_nombre, e.primer_apellido, e.segundo_apellido, e.apellido_casada)) AS nombre_completo FROM sir_empleado AS e, sir_cargo_funcional AS cf WHERE cf.id_cargo_funcional IN (SELECT i.id_cargo_funcional FROM sir_empleado_informacion_laboral AS i WHERE e.id_empleado = i.id_empleado AND i.id_empleado_informacion_laboral = (SELECT MAX(i2.id_empleado_informacion_laboral) FROM sir_empleado_informacion_laboral AS i2 WHERE e.id_empleado = i2.id_empleado)) AND e.id_estado = '00001' ORDER BY e.primer_nombre, e.segundo_nombre, e.tercer_nombre, e.primer_apellido, e.segundo_apellido, e.apellido_casada");
                                        if($otro_empleado->num_rows() > 0){
                                            foreach ($otro_empleado->result() as $fila) {                    
                                                echo '<option class="m-l-50" value="'.$fila->nr.'">'.preg_replace ('/[ ]+/', ' ', $fila->nombre_completo.' - '.$fila->nr).'</option>';     
                                            }
                                        }
                                    ?>
                                </select>
                                <div class="help-block"></div>
                            </div>
                            <div class="form-group col-lg-6 <?php if($navegatorless){ echo "pull-left"; } ?>" onchange="combo_autorizador();"> 
                                <h5>Oficina departamental: <span class="text-danger">*</span></h5>
                                <select id="id_oficina" name="id_oficina" class="select2" style="width: 100%" required="">
                                    <option value="">[Elija oficina en que labora]</option>
                                    <?php 
                                        $oficina = $this->db->query("SELECT * FROM vyp_oficinas");
                                        if($oficina->num_rows() > 0){
                                            foreach ($oficina->result() as $fila2){
                                                    echo '<option class="m-l-50" value="'.$fila2->id_oficina.'">'.$fila2->nombre_oficina.'</option>';
                                            }
                                        }
                                    ?>
                                </select>
                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div id="cnt_combo_autorizador"></div>

                    </div>

                    	<div id="cnt_informacion_empleado"></div>
                    </blockquote>

	                <?php echo form_close(); ?>
	                <br>
	                <h5>Cuenta(s) bancaria(s) de la persona solicitante</h5>
	                <blockquote class="m-t-10">
	                	<?php echo form_open('', array('id' => 'formcuentas2', 'style' => 'margin-top: 0px;', 'class' => 'm-t-40')); ?>
	                    <div id="cnt_cuentas_bancarias"></div>
	                    <?php echo form_close(); ?>
	                </blockquote>

                </div>



            </div>

            <div class="row" id="cnt_firma" style="visibility: hidden;">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-actions">
                                    <a class="btn-close" onclick="ocultar_firma();"><i class="ti-close"></i></a>
                                </div>
                                <h4 class="card-title m-b-0">Asistente para recortes de firma</h4>
                            </div>
                            <div class="card-body b-t">
                                <!-- .Your image -->
                                <div class="row">
                                    <div class="col-lg-12 docs-buttons">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-success" data-method="zoom" data-option="0.1" title="Zoom In"> <span class="docs-tooltip" data-toggle="tooltip" title="Acercar"> <span class="fa fa-search-plus"></span> </span>
                                            </button>
                                            <button type="button" class="btn btn-success" data-method="zoom" data-option="-0.1" title="Zoom Out"> <span class="docs-tooltip" data-toggle="tooltip" title="Alejar"> <span class="fa fa-search-minus"></span> </span>
                                            </button>
                                        </div>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-success" data-method="rotate" data-option="-90" title="Rotate Left"> <span class="docs-tooltip" data-toggle="tooltip" title="Girar 90° a la izquierda"> <span class="fa fa-rotate-left"></span> </span>
                                            </button>
                                            <button type="button" class="btn btn-success" data-method="rotate" data-option="90" title="Rotate Right"> <span class="docs-tooltip" data-toggle="tooltip" title="Girar 90° a la derecha"> <span class="fa fa-rotate-right"></span> </span>
                                            </button>
                                        </div>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-success" data-method="scaleX" data-option="-1" title="Flip Horizontal"> <span class="docs-tooltip" data-toggle="tooltip" title="Voltear horizontalmente"> <span class="fa fa-arrows-h"></span> </span>
                                            </button>
                                            <button type="button" class="btn btn-success" data-method="scaleY" data-option="-1" title="Voltear verticalmente"> <span class="docs-tooltip" data-toggle="tooltip" title="Invertir vertical"> <span class="fa fa-arrows-v"></span> </span>
                                            </button>
                                        </div>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-info" data-method="move" data-option="-50" data-second-option="0" title="Mover a la Izquierda"> <span class="docs-tooltip" data-toggle="tooltip" title="Mover a la izquierda"> <span class="fa fa-arrow-left"></span> </span>
                                            </button>
                                            <button type="button" class="btn btn-info" data-method="move" data-option="50" data-second-option="0" title="Mover a la derecha"> <span class="docs-tooltip" data-toggle="tooltip" title="Mover a la derecha"> <span class="fa fa-arrow-right"></span> </span>
                                            </button>
                                            <button type="button" class="btn btn-info" data-method="move" data-option="0" data-second-option="-50" title="Mover hacia arriba"> <span class="docs-tooltip" data-toggle="tooltip" title="Mover hacia arriba"> <span class="fa fa-arrow-up"></span> </span>
                                            </button>
                                            <button type="button" class="btn btn-info" data-method="move" data-option="0" data-second-option="50" title="Mover hacia abajo"> <span class="docs-tooltip" data-toggle="tooltip" title="Mover hacia abajo"> <span class="fa fa-arrow-down"></span> </span>
                                            </button>
                                        </div>
                                        <div class="pull-right" align="right">
                                            <div class="btn-group">
                                            <button type="button" class="btn btn-danger" data-method="reset" title="Reset"> <span class="docs-tooltip" data-toggle="tooltip" title="Reestablecer"> <span class="fa fa-refresh"></span> </span>
                                            </button>
                                            </div>
                                            <div class="btn-group">
                                            <label class="btn btn-danger btn-upload" for="inputImage" title="Upload image file">
                                                <input type="file" class="sr-only" id="inputImage" name="file" accept="image/*">
                                                <span class="docs-tooltip" data-toggle="tooltip" title="Importar imagen"> <span class="fa fa-upload"></span> Importar</span>
                                            </label>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="img-container" style="min-height: 400px; max-height: 400px;"><img id="image" src="<?php echo base_url(); ?>assets/images/big/img.png" width="100%" class="img-responsive" alt="Picture"></div>
                                    </div>
                                </div>
                                <div class="row" style="margin-top: 10px;">
                                    <div class="col-lg-12 docs-buttons">
                                        <div class="pull-right" align="right">
                                            <button type="button" class="btn btn-danger" data-method="getCroppedCanvas"> <span class="docs-tooltip" data-toggle="tooltip" title="Clic para recortar"> <i class="mdi mdi-crop"></i> Recortar y obtener firma </span> </button>
                                        </div>
                                    </div>
                                </div>
                                    <!-- /.Your image -->
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        <div class="col-lg-1"></div>
        <!-- Column -->
    </div>
    <!-- Row -->
    <!-- ============================================================== -->
    <!-- End PAge Content -->
    <!-- ============================================================== -->	




<!-- Show the cropped image in modal -->
<div class="modal docs-cropped" id="getCroppedCanvasModal" aria-hidden="true" aria-labelledby="getCroppedCanvasTitle" role="dialog" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            	<h4 class="modal-title" id="getCroppedCanvasTitle">Firma recortada</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-info" onclick="guardar();"><span class="mdi mdi-upload"></span> Aceptar</a>
                <a style="display: none;" class="btn btn-primary" id="download" href="javascript:void(0);" download="cropped.jpg">Subir</a> </div>
        </div>
    </div>
</div>
<!-- /.modal -->


<div id="modal_cuenta_bancaria" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <?php echo form_open('', array('id' => 'formajax2', 'style' => 'margin-top: 0px;', 'class' => 'm-t-40')); ?>
            <div class="modal-header">
                <h4 class="modal-title">Editar cuenta bancaria</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
            	<input type="hidden" id="band" name="band" value="edit">
            	<input type="hidden" id="nr2" name="nr2" value="edit">
            	<input type="hidden" id="id_empleado_banco" name="id_empleado_banco" value="edit">
            	<input type="hidden" id="estado" name="estado" value="">
                <div class="form-group col-lg-12">
                    <h5>Banco: <span class="text-danger">*</span></h5>
                    <select id="id_banco" name="id_banco" class="select2" style="width: 100%" required="">
                        <option value="">[Elija el banco]</option>
                        <?php 
                            $banco = $this->db->query("SELECT * FROM vyp_bancos");
                            if($banco->num_rows() > 0){
                                foreach ($banco->result() as $fila) {              
                                   echo '<option class="m-l-50" value="'.$fila->id_banco.'">'.$fila->nombre.'</option>';
                                }
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group col-lg-12">
                    <h5>Número de cuenta: <span class="text-danger">*</span></h5>
                    <div class="controls">
                        <input type="text" id="cuenta" name="cuenta" class="form-control" required="">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-info waves-effect" id="submitbutton">Actualizar</button>
            </div>
            <?php echo form_close(); ?>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


    </div> 
</div>
<!-- ============================================================== -->
<!-- Fin de DIV de inicio (ENVOLTURA) -->
<!-- ============================================================== -->
<script src="<?php echo base_url(); ?>assets/plugins/cropper/cropper-init.js"></script>
<script>

$(function(){ 


	$("#formajax").on("submit", function(e){
        e.preventDefault();
        var f = $(this);
        var formData = new FormData(document.getElementById("formajax"));
        formData.append("dato", "valor");
        
        $.ajax({
            url: "<?php echo site_url(); ?>/configuraciones/informacion_empleado/info_empleado",
            type: "post",
            dataType: "html",
            data: formData,
            cache: false,
            contentType: false,
            processData: false
        })
        .done(function(res){
            if(res == "exito"){
                $.toast({ heading: 'Modificación exitosa', text: 'Se aplicaron los cambios exitosamente.', position: 'top-right', loaderBg:'#3c763d', icon: 'success', hideAfter: 3500, stack: 6
                });
                cambiar_informacion();
            }else{
                swal({ title: "¡Ups! Error", text: "Intentalo nuevamente.", type: "error", showConfirmButton: true });
            }
        });
            
    });

	$("#formcuentas2").on("submit", function(e){
        e.preventDefault();
        var f = $(this);
        var formData = new FormData(document.getElementById("formcuentas2"));
        formData.append("dato", "valor");
        $("#band").val('save')
        $("#nr2").val($("#nr").val())

        $("#cuenta").val($("#n_cuenta").val());
        $("#id_banco").val($("#id_banco2").val()).trigger('change.select2');

        //$("#modal_cuenta_bancaria").modal('show')
        $("#submitbutton").click();
    });

    $("#formajax2").on("submit", function(e){
        e.preventDefault();
        var f = $(this);
        var formData = new FormData(document.getElementById("formajax2"));
        formData.append("dato", "valor");
        
        $.ajax({
            url: "<?php echo site_url(); ?>/configuraciones/informacion_empleado/gestionar_cuentas_bancos",
            type: "post",
            dataType: "html",
            data: formData,
            cache: false,
            contentType: false,
            processData: false
        })
        .done(function(res){
            if(res == "exito"){
                if($("#band").val() == "save"){
                    swal({ title: "¡Registro exitoso!", type: "success", showConfirmButton: true });
                }else if($("#band").val() == "edit"){
                    swal({ title: "¡Modificación exitosa!", type: "success", showConfirmButton: true });
                }else{
                    swal({ title: "¡Borrado exitoso!", type: "success", showConfirmButton: true });
                }
                $("#band").val('edit');
                tabla_cuentas();
            }else{
                swal({ title: "¡Ups! Error", text: "Intentalo nuevamente.", type: "error", showConfirmButton: true });
            }
        });
            
    });
});

</script>