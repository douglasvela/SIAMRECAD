
<?php
    $mantenimiento = false;
    if($mantenimiento){
        header("Location: ".site_url()."/mantenimiento");
        exit();
    }

    $user = $this->session->userdata('usuario_viatico');

    $nr = $this->db->query("SELECT * FROM org_usuario WHERE usuario = '".$user."' LIMIT 1");
    $nr_usuario = "";
    if($nr->num_rows() > 0){
        foreach ($nr->result() as $fila) { 
            $nr_usuario = $fila->nr; 
        }
    }

    $empleado_informacion = $this->db->query("SELECT e.id_empleado, e.nr, ei.id_seccion, cf.funcional, UPPER(CONCAT_WS(' ', e.primer_nombre, e.segundo_nombre, e.tercer_nombre, e.primer_apellido, e.segundo_apellido, e.apellido_casada)) AS nombre_completo, telefono_contacto, e.correo, s.nombre_seccion, ei.id_empleado_informacion_laboral FROM sir_empleado AS e JOIN sir_empleado_informacion_laboral AS ei ON e.id_empleado = ei.id_empleado AND ei.id_empleado_informacion_laboral = (SELECT MAX(i2.id_empleado_informacion_laboral) FROM sir_empleado_informacion_laboral AS i2 WHERE e.id_empleado = i2.id_empleado) AND e.nr = '".$nr_usuario."' JOIN sir_cargo_funcional AS cf ON cf.id_cargo_funcional = ei.id_cargo_funcional JOIN org_seccion AS s ON s.id_seccion = ei.id_seccion");

        foreach ($empleado_informacion->result() as $filainfoe) {
        	$id_seccion = $filainfoe->id_seccion;
        }

    $rango_consulta = obtener_rango($segmentos='2', $permiso='1');
    $rango_registro = obtener_rango($segmentos='2', $permiso='2');

    // Características del navegador
$ua=$this->config->item("navegator");
$navegatorless = false;
if(floatval($ua['version']) < $this->config->item("last_version")){
    $navegatorless = true;
}
?>
<!DOCTYPE html>
<html>
<head>
	<script type="text/javascript">
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
	    function iniciar(){

	    	<?php if(isset($estado_solicitud)){ ?>
		        $($("#tabs_estados").find("a")[<?=$estado_solicitud?>]).click();
		    <?php } ?>

	    	<?php if(tiene_permiso($segmentos=2,$permiso=1)){ ?>
	    	tabla_pasaje_unidad();
	    	<?php }else{ ?>
            $("#cnt_tabla").html("Usted no tiene permiso para este formulario.");     
      		<?php } ?>
	    }
	 var estado_pestana = "";
	function cambiar_pestana(tipo){
		estado_pestana = tipo;
		tabla_pasaje_unidad();
	}
	function tabla_pasaje_unidad(){ 
	  	var fechas = $("#fecha1").val();
	   	var nr = $("#nr").val();
	    if(window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
	        xmlhttpB=new XMLHttpRequest();
	    }else{// code for IE6, IE5
	        xmlhttpB=new ActiveXObject("Microsoft.XMLHTTPB");
	    }
	    xmlhttpB.onreadystatechange=function(){
	        if (xmlhttpB.readyState==4 && xmlhttpB.status==200){
	            document.getElementById("cnt_pasaje").innerHTML=xmlhttpB.responseText;
	                $('#myTable').DataTable({
	                	"order": [[ 0, "desc" ]]
	                });
	                $('[data-toggle="tooltip"]').tooltip();              
	            }
	        }
	        xmlhttpB.open("GET","<?php echo site_url(); ?>/pasajes/pasaje/tabla_pasaje_unidad?nr="+nr+"&fecha1="+fechas+"&estado="+estado_pestana, true);
	        xmlhttpB.send(); 
	   
		}
	 

    function combo_municipio(municipio,valor){     
        var id_municipio = municipio;
        var newName = 'John Smith',
        xhr_m = new XMLHttpRequest();
        xhr_m.open('GET', "<?php echo site_url(); ?>/pasajes/Lista_pasaje/combo_municipios1?id_municipio="+id_municipio+"&val="+valor);
        xhr_m.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr_m.onload = function() {
            if (xhr_m.status === 200 && xhr_m.responseText !== newName) {
                document.getElementById("combo_municipio").innerHTML = xhr_m.responseText;
                $("#departamento").val($("#id_departamento_copia").val()).trigger('change.select2');
            }
            else if (xhr_m.status !== 200) {
                swal({ title: "Ups! ocurrió un Error", text: "Al parecer no todos los objetos se cargaron correctamente por favor recarga la página e intentalo nuevamente", type: "error", showConfirmButton: true });
            }
        };
        xhr_m.send(encodeURI('name=' + newName));
    }
    function cambiar_nuevo(){

        $("#band_solicitud").val("save");

        $("#ttl_form1").addClass("bg-success");
        $("#ttl_form1").removeClass("bg-info");

       // $("#btnadd").show(0);
       // $("#btnedit").hide(0);

        $("#cnt_tabla").hide(0);
        $("#cnt_solicitud").show(0);
        limpiar_solicitud();
        $("#ttl_form1").children("h4").html("<span class='mdi mdi-plus'></span> Nueva solicitud de pasaje");
 		
    }
    function cerrar_mantenimiento1(){
    	$("#cnt_tabla").show(0);
        $("#cnt_solicitud").hide(0);
        tabla_pasaje_unidad();$("#cnt_observaciones").hide(0);
        limpiar_solicitud();
    }
    
    function mostrarform_detallado(){
    	$("#cnt_form").show(0);
        $("#cnt_solicitud").hide(0);
        $("#ttl_form2").children("h4").html("<span class='mdi mdi-plus'></span> Detalle de la solicitud");
        tabla_pasajes_detallado();
        //ombo_municipio();
    }
    function cerrar_mantenimiento2(){
    	$("#cnt_form").hide(0);
        $("#cnt_solicitud").show(0);
        $("#cnt_observaciones").hide(0);
    }
    	function tabla_pasajes_detallado(){ 
	    	 var nr_empleado = $("#nr_empleado").val();
	    	 var id_mision = $("#id_mision_pasajes").val();
	        if(window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
	            xmlhttpPD=new XMLHttpRequest();
	        }else{// code for IE6, IE5
	            xmlhttpPD=new ActiveXObject("Microsoft.XMLHTTPB");
	        }
	        xmlhttpPD.onreadystatechange=function(){
	            if (xmlhttpPD.readyState==4 && xmlhttpPD.status==200){
	                document.getElementById("cnt_pasaje_detalle").innerHTML=xmlhttpPD.responseText;
	                 $('[data-toggle="tooltip"]').tooltip();
	              
	                $('#myTable_detallado').DataTable();
	            }
	        }
	        xmlhttpPD.open("GET","<?php echo site_url(); ?>/pasajes/pasaje/tabla_pasajes_detallado?nr_empleado="+nr_empleado+"&id_mision="+id_mision, true);
	        xmlhttpPD.send(); 
	   
		}
			

		function mantto_solicitud(){
			
			var formData = new FormData();
			if($("#band_solicitud").val()=="save" || $("#band_solicitud").val()=="edit"){
				if($("#nr_empleado").val()=="0" || !$("#fecha_solicitud").val() || !$("#mes_anio_pasaje").val()){
					swal({ title: "¡Ups! Error", text: "Campos requeridos", type: "error", showConfirmButton: true });
	       			return;
				}
			}
			if($("#band_solicitud").val()=="edit" || $("#band_solicitud").val()=="delete"){
				formData.append("id_mision_pasajes", $("#id_mision_pasajes").val());	
			}
	        formData.append("nr_empleado", $("#nr_empleado").val());

	        var nombre=$('select[name="nr_empleado"] option:selected').text();
	        var nombre_ = nombre.split("-");
	        var nombre_completo = nombre_[0];
	        formData.append("nombre_completo", nombre_completo);
	        formData.append("fecha_solicitud", $("#fecha_solicitud").val());
	        formData.append("band", $("#band_solicitud").val());
	        
	        var f_parts = $("#mes_anio_pasaje").val().split("-");
	        formData.append("mes_pasaje", f_parts[1]);
	        formData.append("anio_pasaje", f_parts[0]);


	        $.ajax({
	            url: "<?php echo site_url(); ?>/pasajes/Pasaje/gestionar_pasaje",
	            type: "post",
	            dataType: "html",
	            data: formData,
	            cache: false,
	            contentType: false,
	            processData: false
	        })
	        .done(function(res1){
				var res=res1.split(",");
	            if(res[0] == "exito"){

	                if($("#band_solicitud").val() == "save"){
	                    swal({ title: "¡Registro exitoso!", type: "success", showConfirmButton: true });
	                    mostrarform_detallado();$("#band_solicitud").val("edit");$("#id_mision_pasajes").val(res[1]);tabla_pasajes_detallado();
	                }else if($("#band_solicitud").val() == "edit"){
	                    //swal({ title: "¡Modificación exitosa!", type: "success", showConfirmButton: true });
	                    mostrarform_detallado();tabla_pasajes_detallado();
	                }else{
	                    swal({ title: "¡Borrado exitoso!", type: "success", showConfirmButton: true });
	                    tabla_pasaje_unidad();
	                }
	                
	            }else if(res[0] == "mision_duplicado"){
	            	swal({ title: "¡Ups! Error", text: "Ya registró una solicitud en esta fecha.", type: "error", showConfirmButton: true });
	            }else{
	                swal({ title: "¡Ups! Error", text: "Intentalo nuevamente.", type: "error", showConfirmButton: true });
	            }
	        });
		}
		function eliminar_solicitud(id_mision_pasajes){
			$("#id_mision_pasajes").val(id_mision_pasajes);
			enviar_eliminar_solicitud();
		}
		function enviar_eliminar_solicitud(){
			$("#band_solicitud").val("delete");
		       swal({
		           title: "¿Está seguro?",
		           text: "¡Desea eliminar el registro!",
		           type: "warning",
		           showCancelButton: true,
		           confirmButtonColor: "#fc4b6c",
		           confirmButtonText: "Sí, deseo eliminar!",
		           closeOnConfirm: false
		       }, function(){
		           mantto_solicitud();
		       });
		}
		function cambiar_editar(id_mision_pasajes,fecha_solicitud_pasaje,nr,mes_anio_pasaje){
			$("#cnt_tabla").hide(0);
        	$("#cnt_solicitud").show(0);
        	$("#ttl_form1").children("h4").html("<span class='mdi mdi-plus'></span> Editar solicitud de pasaje");
        	$("#id_mision_pasajes").val(id_mision_pasajes);
        	$("#fecha_solicitud").val(fecha_solicitud_pasaje);
        	$("#nr_empleado").val(nr).trigger("change.select2");
        	//$("#mes_anio_pasaje").val(mes_anio_pasaje).trigger('change');
        	$('#mes_anio_pasaje').datepicker('setDate', mes_anio_pasaje );
        	$("#band_solicitud").val("edit");
        	observaciones(id_mision_pasajes);
        	$("#cnt_observaciones").show(0);
		}
		var contador_detalle_solicitud=0;
		function mantto_detalle_solicitud(){
			if($("#band_detalle_solicitud").val()=="save" || $("#band_detalle_solicitud").val()=="edit"){
				if($("#fecha_detalle").val()=="" || $("#departamento").val()=='0' || $("#municipio").val()=='0' || $("#empresa").val()==''
					|| $("#direccion").val()=="" || $("#id_actividad").val()=='0' || $("#monto").val()=="" || $("#monto").val()==""){
					swal({ title: "¡Ups!", text: "Campos requeridos sin llenar.", type: "error", showConfirmButton: true });
					return;
				}
			}
			var formData = new FormData();
			formData.append("band_detalle_solicitud", $("#band_detalle_solicitud").val());
			formData.append("fecha_detalle", $("#fecha_detalle").val());
			formData.append("departamento", $("#departamento").val());
			formData.append("municipio", $("#municipio").val());
			formData.append("empresa", $("#empresa").val());
			formData.append("direccion", $("#direccion").val());
			formData.append("expediente", $("#expediente").val());
			formData.append("id_actividad", $("#id_actividad").val());
			formData.append("nr_empleado", $("#nr_empleado").val());
			formData.append("monto", $("#monto").val());
			formData.append("id_mision", $("#id_mision_pasajes").val());

			if($("#band_detalle_solicitud").val()=="edit" || $("#band_detalle_solicitud").val()=="delete") formData.append("id_detalle_solicitud", $("#id_detalle_solicitud").val());
			$.ajax({
	            url: "<?php echo site_url(); ?>/pasajes/Pasaje/gestionar_detalle_pasaje",
	            type: "post",
	            dataType: "html",
	            data: formData,
	            cache: false,
	            contentType: false,
	            processData: false
	        })
	        .done(function(res){
	            if(res == "exito"){
	                if($("#band_detalle_solicitud").val() == "save"){
	                    swal({ title: "¡Registro exitoso!", type: "success", showConfirmButton: true });
	                    tabla_pasajes_detallado();
	                    document.getElementById("boton_editar_detallado").style.display="none";
						document.getElementById("boton_agregar_detallado").style.display="block";
						contador_detalle_solicitud++;
	                }else if($("#band_detalle_solicitud").val() == "edit"){
	                    swal({ title: "¡Modificación exitosa!", type: "success", showConfirmButton: true });
	                    tabla_pasajes_detallado();
	                    document.getElementById("boton_editar_detallado").style.display="none";
						document.getElementById("boton_agregar_detallado").style.display="block";
						contador_detalle_solicitud++;
	                }else{
	                    swal({ title: "¡Borrado exitoso!", type: "success", showConfirmButton: true });
	                    tabla_pasajes_detallado();
	                    contador_detalle_solicitud++;
	                }
	                limpiar_form_detallado();
	            }else if(res=="monto_invalido"){
	            	swal({ title: "¡Ups! Error", text: "Monto no es valido.", type: "error", showConfirmButton: true });
	            }else if(res=="pasaje_duplicado"){
	            	swal({ title: "¡Ups! Error", text: "Ya ingreso pasajes es esta fecha.", type: "error", showConfirmButton: true });
	            }else{
	                console.log(res)
	                swal({ title: "¡Ups! Error", text: "Intentalo nuevamente.", type: "error", showConfirmButton: true });
	            }

	        });
		}
		function cambiar_detallado_editar(id_solicitud_pasaje,fecha_mision,id_departamento,id_municipio,no_expediente,empresa_visitada,direccion_empresa,monto_pasaje,id_actividad_realizada){
			
			$("#band_detalle_solicitud").val("edit");
			$("#id_detalle_solicitud").val(id_solicitud_pasaje);
			$("#fecha_detalle").val(fecha_mision);
			$("#departamento").val(id_departamento).trigger('change.select2');
			$("#municipio").val(id_municipio).trigger("change.select2");
			combo_municipio(id_departamento,id_municipio);
			$("#empresa").val(empresa_visitada);
			$("#direccion").val(direccion_empresa);
			$("#expediente").val(no_expediente);
			$("#id_actividad").val(id_actividad_realizada).trigger('change.select2');;
			//$("#nr_empleado").val();
			$("#monto").val(monto_pasaje);
			//$("#id_mision_pasajes").val();
			document.getElementById("boton_editar_detallado").style.display="block";
			document.getElementById("boton_agregar_detallado").style.display="none";
		}
		function limpiar_form_detallado(){
			$("#band_detalle_solicitud").val("save");
			$("#id_detalle_solicitud").val("");
			$("#fecha_detalle").val("");
			$("#departamento").val("0").trigger("change.select2");
			$("#municipio").val("0").trigger("change.select2");
			$("#empresa").val("");
			$("#direccion").val("");
			$("#expediente").val("");
			$("#id_actividad").val("").trigger('change.select2');;
			$("#monto").val("");
		}
		function eliminar_detallado_pasaje(id_solicitud_pasaje){
			$("#id_detalle_solicitud").val(id_solicitud_pasaje);
			enviar_eliminar_detallado_pasaje();
		}
		function enviar_eliminar_detallado_pasaje(){
			$("#band_detalle_solicitud").val("delete");
		       swal({
		           title: "¿Está seguro?",
		           text: "¡Desea eliminar el registro!",
		           type: "warning",
		           showCancelButton: true,
		           confirmButtonColor: "#fc4b6c",
		           confirmButtonText: "Sí, deseo eliminar!",
		           closeOnConfirm: false
		       }, function(){
		           mantto_detalle_solicitud();
		       });
		}
		function enviararevision(){
			var formData = new FormData();
			formData.append("id_mision_pasajes", $("#id_mision_pasajes").val());
			
			$.ajax({
	            url: "<?php echo site_url(); ?>/pasajes/Pasaje/gestionar_revision1",
	            type: "post",
	            dataType: "html",
	            data: formData,
	            cache: false,
	            contentType: false,
	            processData: false
	        }).done(function(res){
	            if(res == "exito"){
	            	swal({ title: "¡Registro exitoso!", type: "success", showConfirmButton: true });
	            	cerrar_mantenimiento2();
	            	cerrar_mantenimiento1();
	            	tabla_pasaje_unidad();
	            }else if(res == "fracaso"){
	            	swal({ title: "¡Solicitud Incompleta!", type: "error", showConfirmButton: true });
	            	cerrar_mantenimiento2();
	            	cerrar_mantenimiento1();
	            	tabla_pasaje_unidad();
	            }else{
	            	swal({ title: "Error verifique dirección de correo o conexión", type: "error", showConfirmButton: true });
	            	cerrar_mantenimiento2();
	            	cerrar_mantenimiento1();
	            	tabla_pasaje_unidad();
	            }
	            
	        });
		}

	function limpiar_solicitud(){
		$("#band_solicitud").val("save");
		$("#fecha_solicitud").val("");
		//$("#mes_anio_pasaje").val("");
		$('#mes_anio_pasaje').datepicker('setDate', '<?php echo date("Y-m"); ?>' );
		$("#id_mision_pasajes").val("");
	}
		
    function observaciones(id_mision){    
        if(window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttpB=new XMLHttpRequest();
        }else{// code for IE6, IE5
            xmlhttpB=new ActiveXObject("Microsoft.XMLHTTPB");
        }
        xmlhttpB.onreadystatechange=function(){
            if (xmlhttpB.readyState==4 && xmlhttpB.status==200){
                document.getElementById("cnt_observaciones").innerHTML=xmlhttpB.responseText;
                $('[data-toggle="tooltip"]').tooltip();
            }
        }
        xmlhttpB.open("GET","<?php echo site_url(); ?>/pasajes/pasaje/observaciones?id_mision="+id_mision,true);
        xmlhttpB.send(); 
    }

    function recorre_observaciones(){
        var checkbox = $("#tasklist").find("input");
        var sin_observaciones = 0;
        var ides="";
        for(i=0; i<checkbox.length; i++){
            if(!checkbox[i].checked){
                sin_observaciones++;
            }
        }
        $( "input[id$='id_ob']:checked" ).each(function() {
        	var id_sol = $("#id_mision_pasajes").val();
	        enviar_observaciones_revisadas($(this).val(),id_sol);
		});
		
        if(sin_observaciones > 0){
            swal({ title: "Ups!", text: "Hay observaciones sin marcar, es posible que no se hayan solventado todas.", type: "warning", showConfirmButton: true }); 
            cerrar_mantenimiento2();
            cerrar_mantenimiento1();
            tabla_pasaje_unidad();
        }else{
            enviararevision();
        } 

        limpiar_form_detallado();
        limpiar_solicitud();
        
    }
    function enviar_observaciones_revisadas(ides,id_sol){
    	var formData = new FormData();
			formData.append("ides", ides);
			formData.append("idsol", id_sol);
			$.ajax({
	            url: "<?php echo site_url(); ?>/pasajes/Pasaje/corregir_observaciones",
	            type: "post",
	            dataType: "html",
	            data: formData,
	            cache: false,
	            contentType: false,
	            processData: false
	        }).done(function(res){
	            if(res == "exito"){
	            	swal({ title: "Correcciones exitosas!", type: "success", showConfirmButton: true });
	            	cerrar_mantenimiento2();
	            	cerrar_mantenimiento1();
	            	tabla_pasaje_unidad();

	            }
	        });
    }

    function mostrar_reporte(nr_emple,month,id_mision){
    	var xhr = "<?php echo site_url()?>";
    	window.open(xhr+"/pasajes/Lista_pasaje/imprimir_solicitud?nr="+nr_emple + "&fecha2="+month + "&id="+id_mision,"_blank");
    }
    function poner_mes(fecha){
    	partes = fecha.split("-");
    	$('#mes_anio_pasaje').datepicker('setDate', partes[2]+"-"+partes[1] );
    }

    function bitacora(id_mision, disponibilidad){
        if(disponibilidad == 0){
            swal({ title: "No disponible", text: "La bitácora está disponible para solicitudes elaboradas a partir del: 25/10/2018", type: "info", showConfirmButton: true });
        }else{
            var newName = 'AjaxCall', xhr = new XMLHttpRequest();
            xhr.open('GET', "<?php echo site_url(); ?>/pasajes/pasaje/bitacora?id_mision="+id_mision);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200 && xhr.responseText !== newName) {
                    document.getElementById("cnt_bitacora").innerHTML = xhr.responseText;
                    $("#modal_bitacora").modal('show');
                    $('[data-toggle="tooltip"]').tooltip();
                }else if (xhr.status !== 200) {
                    swal({ title: "Ups! ocurrió un Error", text: "Al parecer la tabla de bitácora no se cargó correctamente por favor recarga la página e intentalo nuevamente", type: "error", showConfirmButton: true });
                }
            };
            xhr.send(encodeURI('name=' + newName));
        }
    }

	</script>
</head>
<body>

	<div class="page-wrapper">
	    <div class="container-fluid">
	        <button id="notificacion" style="display: none;" class="tst1 btn btn-success2">Info Message</button>

	        <div class="row page-titles">
	            <div class="align-self-center" align="center">
	                <h3 class="text-themecolor m-b-0 m-t-0">Solicitud de pasajes</h3>
	            </div>
	        </div>
	         <div class="row ">
	            <div class="col-lg-12" id="cnt_tabla" style="display: block;">
	                <div class="card">
	                    <div class="card-header bg-success2" id="">
	                        <h4 class="card-title m-b-0 text-white">Listado de solicitudes de pasajes</h4>
	                    </div>
	                    <div class="card-body b-t">
	                    	 <div class="pull-right">
	                    	 	<?php 
	                    	 	if(tiene_permiso($segmentos=2,$permiso=2)){
	                    	 	?>
	                            <button type="button" onclick="cambiar_nuevo();" class="btn waves-effect waves-light btn-success2"><span class="mdi mdi-plus"></span> Nuevo registro</button>
	                            <?php
	                        	}
	                            ?>
	                        </div>
	                    	<div class="row ">
								<div class="form-group col-lg-6 <?php if($navegatorless){ echo "pull-left"; } ?>">
	                                <h5 style="display:block">Solicitante: <span class="text-danger"></span></h5>
	                                <select id="nr" name="nr" class="select2" style="width: 100%" required onchange="tabla_pasaje_unidad()">
	                                <option value=''>[Elija el empleado]</option>
	                                <?php
	                                	if($rango_consulta == "2"){
                                            $add = "AND ei.id_seccion = '".$id_seccion."'";
                                        }else if($rango_consulta == "3"){
                                            $oficinas_departamentales = array(52,53,54,55,56,57,58,59,60,61,64,65,66);
                                            if (in_array($id_seccion, $oficinas_departamentales)) {
                                                $add = "AND ei.id_seccion = '".$id_seccion."'";
                                            }else{
                                                $add = "AND ei.id_seccion NOT IN(52,53,54,55,56,57,58,59,60,61,64,65,66)";
                                            }
                                        }else if($rango_consulta == "4"){
                                            $add = "";
                                        }else{
                                            $add = "AND e.nr = '".$nr_usuario."'";
                                        }

	                                    $dataEmpleado2 = $this->db->query("SELECT e.id_empleado, e.nr, UPPER(CONCAT_WS(' ', e.primer_nombre, e.segundo_nombre, e.tercer_nombre, e.primer_apellido, e.segundo_apellido, e.apellido_casada)) AS nombre_completo, ei.id_empleado_informacion_laboral FROM sir_empleado AS e JOIN sir_empleado_informacion_laboral AS ei ON e.id_empleado = ei.id_empleado AND ei.id_empleado_informacion_laboral = (SELECT MAX(i2.id_empleado_informacion_laboral) FROM sir_empleado_informacion_laboral AS i2 WHERE e.id_empleado = i2.id_empleado) ".$add." AND e.id_estado = '00001' GROUP BY e.id_empleado ORDER BY e.primer_nombre, e.segundo_nombre, e.tercer_nombre, e.primer_apellido, e.segundo_apellido, e.apellido_casada");
	                                        if($dataEmpleado2->num_rows() > 0){
	                                            foreach ($dataEmpleado2->result() as $fila2) {
	                                            	if($nr_usuario == $fila2->nr){
	                                 ?>
	<option class="m-l-50" selected value="<?php echo $fila2->nr; ?>" ><?php echo preg_replace ('/[ ]+/', ' ',$fila2->nombre_completo.' - '.$fila2->nr) ?></option>
	                                <?php
	                                				}else{
	                                ?>
	<option class="m-l-50" value="<?php echo $fila2->nr; ?>"><?php echo preg_replace ('/[ ]+/', ' ',$fila2->nombre_completo.' - '.$fila2->nr) ?></option>
	                                <?php

	                               
	                            }
	                                		}		
	                                         	
	                                    }
	                                    //$u_rec_id = $this->session->userdata('rec_id');
	                                ?>
	                                </select>
	                            </div>
	                            <div class="form-group col-lg-3 <?php if($navegatorless){ echo "pull-left"; } ?>" style="display: none;">
	                            	<h5 style="display:block;">Fecha de pasaje: <span class="text-danger"></span></h5>
	                            	<input type="text"  class="form-control" id="fecha1" name="fecha1" value="<?php echo date('Y-m'); ?>"  onchange="tabla_pasaje_unidad();">
	                            </div>
	                            
	                        </div>
	                        <div class="row col-lg-12">
		                        <ul class="nav nav-tabs customtab2 <?php if($navegatorless){ echo "pull-left"; } ?>" style='width: 100%;' role="tablist" id="tabs_estados">
		                            <li class="nav-item <?php if($navegatorless){ echo "pull-left"; } ?>"> 
		                                <a class="nav-link active" onclick="cambiar_pestana('');" data-toggle="tab" href="#">
		                                    <span class="hidden-sm-up"><i class="ti-home"></i></span> 
		                                    <span class="hidden-xs-down">Todas</span></a> 
		                            </li>
		                            <li class="nav-item <?php if($navegatorless){ echo "pull-left"; } ?>"> 
		                                <a class="nav-link" onclick="cambiar_pestana('1');" data-toggle="tab" href="#">
		                                    <span class="hidden-sm-up"><i class="ti-home"></i></span> 
		                                    <span class="hidden-xs-down">Incompletas</span></a> 
		                            </li>
		                            <li class="nav-item <?php if($navegatorless){ echo "pull-left"; } ?>"> 
		                                <a class="nav-link" onclick="cambiar_pestana('2');" data-toggle="tab" href="#">
		                                    <span class="hidden-sm-up"><i class="ti-home"></i></span> 
		                                    <span class="hidden-xs-down">En revisión</span></a> 
		                            </li>
		                            <li class="nav-item <?php if($navegatorless){ echo "pull-left"; } ?>"> 
		                                <a class="nav-link" onclick="cambiar_pestana('3');" data-toggle="tab" href="#">
		                                    <span class="hidden-sm-up"><i class="ti-home"></i></span> 
		                                    <span class="hidden-xs-down">Observadas</span></a> 
		                            </li>
		                            <li class="nav-item <?php if($navegatorless){ echo "pull-left"; } ?>"> 
		                                <a class="nav-link" onclick="cambiar_pestana('4');" data-toggle="tab" href="#">
		                                    <span class="hidden-sm-up"><i class="ti-home"></i></span> 
		                                    <span class="hidden-xs-down">Aprobadas</span></a> 
		                            </li>
		                            <li class="nav-item <?php if($navegatorless){ echo "pull-left"; } ?>"> 
		                                <a class="nav-link" onclick="cambiar_pestana('5');" data-toggle="tab" href="#">
		                                    <span class="hidden-sm-up"><i class="ti-home"></i></span> 
		                                    <span class="hidden-xs-down">Pagadas</span></a> 
		                            </li>
		                        </ul>
		                    </div>
	                        <div id="cnt_pasaje">Seleccione un solicitante y una fecha</div>
	                    </div>
	                    
	                </div>
	            </div>
	        </div>


	        <div class="row justify-content-center">
				<div class="col-lg-12" id="cnt_observaciones"></div>
	            <div class="col-lg-12" id="cnt_solicitud" style="display: none;">
	                
	                <div class="card">
	                    <div class="card-header bg-success2" id="ttl_form1">
	                         <div class="card-actions text-white">
	                            <a style="font-size: 16px;" onclick="cerrar_mantenimiento1();"><i class="mdi mdi-window-close"></i></a>
	                        </div>
	                        <h4 class="card-title m-b-0 text-white"></h4>
	                    </div>

	                    <div class="card-body b-t">
	                    	  
	                    	<div class="row ">
	                    		<div class="form-group col-lg-5 <?php if($navegatorless){ echo "pull-left"; } ?>">
	                    			<input type="hidden" id="band_solicitud" name="band_solicitud" value="save">
		                            <input type="hidden" id="id_mision_pasajes" name="id_mision_pasajes">
		                               <label for="" class="font-weight-bold">Solicitante: <span class="text-danger">*</span></label>
		                                <select id="nr_empleado" name="nr_empleado" class="select2" style="width: 100%" required >
		                                <option value='0'>[Elija el empleado]</option>
		                                <?php
		                                	if($rango_consulta == "2"){
	                                            $add = "AND ei.id_seccion = '".$id_seccion."'";
	                                        }else if($rango_consulta == "3"){
	                                            $oficinas_departamentales = array(52,53,54,55,56,57,58,59,60,61,64,65,66);
	                                            if (in_array($id_seccion, $oficinas_departamentales)) {
	                                                $add = "AND ei.id_seccion = '".$id_seccion."'";
	                                            }else{
	                                                $add = "AND ei.id_seccion NOT IN(52,53,54,55,56,57,58,59,60,61,64,65,66)";
	                                            }
	                                        }else if($rango_consulta == "4"){
	                                            $add = "";
	                                        }else{
	                                            $add = "AND e.nr = '".$nr_usuario."'";
	                                        }

		                                    $dataEmpleado2 = $this->db->query("SELECT e.id_empleado, e.nr, UPPER(CONCAT_WS(' ', e.primer_nombre, e.segundo_nombre, e.tercer_nombre, e.primer_apellido, e.segundo_apellido, e.apellido_casada)) AS nombre_completo, ei.id_empleado_informacion_laboral FROM sir_empleado AS e JOIN sir_empleado_informacion_laboral AS ei ON e.id_empleado = ei.id_empleado AND ei.id_empleado_informacion_laboral = (SELECT MAX(i2.id_empleado_informacion_laboral) FROM sir_empleado_informacion_laboral AS i2 WHERE e.id_empleado = i2.id_empleado) ".$add." AND e.id_estado = '00001' GROUP BY e.id_empleado ORDER BY e.primer_nombre, e.segundo_nombre, e.tercer_nombre, e.primer_apellido, e.segundo_apellido, e.apellido_casada");
		                                        if($dataEmpleado2->num_rows() > 0){
		                                            foreach ($dataEmpleado2->result() as $fila2) {
		                                            	if($nr_usuario == $fila2->nr){
		                                 ?>
		<option class="m-l-50" selected value="<?php echo $fila2->nr; ?>" ><?php echo preg_replace ('/[ ]+/', ' ',$fila2->nombre_completo.' - '.$fila2->nr) ?></option>
		                                <?php
		                                				}else{
		                                ?>
		<option class="m-l-50" value="<?php echo $fila2->nr; ?>"><?php echo preg_replace ('/[ ]+/', ' ',$fila2->nombre_completo.' - '.$fila2->nr) ?></option>
		                                <?php
		                            }
		                                		}		    	
		                                    }
		                                ?>
		                                </select>
	                    		</div>
	                    		<div class="form-group col-lg-3 <?php if($navegatorless){ echo "pull-left"; } ?>">
	                    			<label for="" class="font-weight-bold">Fecha Solicitud: <span class="text-danger">*</span></label>
	                    			 
	                    			<input type="text" pattern="\d{1,2}-\d{1,2}-\d{4}" required="" class="form-control" id="fecha_solicitud" name="fecha_solicitud" placeholder="dd/mm/yyyy" onchange="poner_mes(this.value)" readonly="">
                                    <div class="help-block"></div>
	                    		</div>
	                    		<div class="form-group col-lg-3 <?php if($navegatorless){ echo "pull-left"; } ?>">
	                    			<label for="" class="font-weight-bold">Mes de Pasaje: <span class="text-danger">*</span></label>
	                    			<input type="text" class="form-control" id="mes_anio_pasaje" name="mes_anio_pasaje" readonly="">
	                    		</div>
	                    		
	                    	</div>
		                    	<div class="clearfix">
		                    	  <div class="pull-left">
	                               <button type="button" onclick="cerrar_mantenimiento1();" class="btn waves-effect waves-light"><span class="mdi mdi-keyboard-return"></span> Volver</button>
	                            </div>
		                    	<div class="pull-right">
		                            <button type="button" onclick="mantto_solicitud();" class="btn waves-effect waves-light btn-success"><span class="mdi mdi-arrow-right"></span> Siguiente</button>
		                        </div>
		                    </div>
	                    </div>
	                </div>
	            </div>
	        </div>

			
			<div class="row justify-content-center">

	            <div class="col-lg-12" id="cnt_form" style="display: none;">
	                <div class="card">
	                    <div class="card-header bg-success2" id="ttl_form2">
	                         <div class="card-actions text-white">
	                            <a style="font-size: 16px;" onclick="cerrar_mantenimiento2(); cerrar_mantenimiento1();"><i class="mdi mdi-window-close"></i></a>
	                        </div>
	                        <h4 class="card-title m-b-0 text-white"></h4>
	                    </div>
	                    <div class="card-body b-t">
	                    	<div class="row ">
	                    		<div class="form-group col-lg-3 <?php if($navegatorless){ echo "pull-left"; } ?>">
	                    			<input type="hidden" id="band_detalle_solicitud" name="band_detalle_solicitud" value="save">
	                    			<input type="hidden" id="id_detalle_solicitud" name="id_detalle_solicitud" value="">
	                    			<label for="fecha_detalle" class="font-weight-bold">Fecha: <span class="text-danger">*</span></label>
	                    			 
	                    			<input type="text" pattern="\d{1,2}-\d{1,2}-\d{4}" required="" class="form-control" id="fecha_detalle" name="fecha_detalle" placeholder="dd/mm/yyyy" onchange="">
                                    <div class="help-block"></div>
	                    		</div>
	                    	
	                    		<div class="" id="combo_municipio" ></div>
	                    		<div class="form-group col-lg-3 <?php if($navegatorless){ echo "pull-left"; } ?>">
                    				<label class="font-weight-bold">Municipio: <span class="text-danger">*</span></label>
                    				<select id="municipio" name="municipio" class="select2" style="width: 100%" required onchange="combo_municipio(this.value,null)">
                    					<option value='0'>[Elija el departamento]</option>
								    <?php 
								        $municipio = $this->db->query("SELECT * FROM org_municipio ORDER BY municipio");
								        if($municipio->num_rows() > 0){
								            foreach ($municipio->result() as $fila2) {              
								               echo '<option class="m-l-50" value="'.$fila2->id_municipio.'">'.$fila2->municipio.'</option>';
								            }
								        }
								    ?>
									</select>
	                    			
	                    		</div>
	                    		<div class="form-group col-lg-3 <?php if($navegatorless){ echo "pull-left"; } ?>">
	                    			<label class='font-weight-bold'>Departamento: <span class='text-danger'>*</span></label>
	                    			<select id="departamento" name="departamento" class="select2" style="width: 285px" required>
	                    				<option value='0'>[Elija el departamento]</option>
	                    				<?php 
	                    				 $departamento = $this->db->query("SELECT * FROM org_departamento ORDER BY departamento");
							                if($departamento->num_rows() > 0){
							                    foreach ($departamento->result() as $fila2) {              
							                       echo '<option class="m-l-50" value="'.$fila2->id_departamento.'">'.$fila2->departamento.'</option>';
							                    }
							                }
	                    				?>
	                    			</select>
	                    		</div>
	                    	</div>
	                    	<div class="row">
	                    		<div class="form-group col-lg-3 <?php if($navegatorless){ echo "pull-left"; } ?>">
	                    			<label for="empresa" class="font-weight-bold">Nombre de la Empresa: <span class="text-danger">*</span></label>
	                    			<input type="text" id="empresa" name="empresa" class="form-control" required="" data-validation-required-message="Este campo es requerido" placeholder="Escriba Nombre de la empresa"  > 
	                    		</div>
	                    		<div class="form-group col-lg-6 <?php if($navegatorless){ echo "pull-left"; } ?>">
	                    			<label for="direccion" class="font-weight-bold">Dirección de la Empresa: <span class="text-danger">*</span></label>
	                    			 <input type="text"  id="direccion" name="direccion" class="form-control" required="" placeholder="Escriba la dirección" minlength="3" data-validation-required-message="Este campo es requerido">
	                    		</div>
	                    		<div class="form-group col-lg-3 <?php if($navegatorless){ echo "pull-left"; } ?>">
	                    			<label for="expediente" class="font-weight-bold">No de Expediente: </label>
	                    			<input type="text" id="expediente" name="expediente" class="form-control" placeholder="Escriba No de expediente"  >
	                    		</div>
	                    	</div>
	                    	<div class="row">
	                    		<div class="form-group col-lg-9 <?php if($navegatorless){ echo "pull-left"; } ?>">
	                    			<label for="id_actividad" class="font-weight-bold">Nombre de la Actividad: <span class="text-danger">*</span></label>
	                    			<select id="id_actividad" name="id_actividad" class="select2" required=''  style="width: 100%" >
					                <option value=''>[Elija una actividad]</option>
					                <?php 
					                  $actividad = $this->db->query("SELECT * FROM vyp_actividades WHERE depende_vyp_actividades = 0 OR depende_vyp_actividades = '' OR depende_vyp_actividades IS NULL ORDER BY nombre_vyp_actividades");
					                  if($actividad->num_rows() > 0){
					                    foreach ($actividad->result() as $filaa) {              
					                      echo '<option class="m-l-50" value="'.$filaa->id_vyp_actividades.'">'.$filaa->nombre_vyp_actividades.'</option>';
					                      $activida_sub = $this->db->query("SELECT * FROM vyp_actividades WHERE depende_vyp_actividades = '".$filaa->id_vyp_actividades."' ORDER BY nombre_vyp_actividades");
					                      if($activida_sub->num_rows() > 0){
					                        foreach ($activida_sub->result() as $filasub) {              
					                          echo '<option class="m-l-50" value="'.$filasub->id_vyp_actividades.'"> &emsp;&#x25B6; '.$filasub->nombre_vyp_actividades.'</option>';
					                        }
					                      }
					                    }
					                  }
					                ?>
					              </select>
	                    		</div>
	                    		<div class="form-group col-lg-3 <?php if($navegatorless){ echo "pull-left"; } ?>">
	                    			<label for="monto" class="font-weight-bold">Monto: <span class="text-danger">*</span></label>
	                    			<input type="number" id="monto" name="monto" class="form-control" min="0.00" placeholder="Digite el monto de pasaje" >
	                    		</div>
	                    	</div>
	                    	<div class="clearfix">
		                    	<div class="pull-right">
		                    		<div id="boton_agregar_detallado">
		                    			<button type="button" onclick="mantto_detalle_solicitud()" class="btn waves-effect waves-light btn-success2"><span class="mdi mdi-plus"></span> Agregar</button>
		                    		</div>
		                            <div id="boton_editar_detallado" style="display: none">
			                            <button type="button" onclick="mantto_detalle_solicitud()" class="btn waves-effect waves-light btn-success"><span class="mdi mdi-plus"></span> Editar</button>
			                        </div>
		                        </div>
		                    </div>
	                    	<div id="cnt_pasaje_detalle"></div>
	                    	<br><br>
	                    	<div class="clearfix">
		                    	<div class="pull-left">
	                               <button type="button" onclick="cerrar_mantenimiento2();" class="btn waves-effect waves-light"><span class="mdi mdi-keyboard-return"></span> Volver</button>
	                            </div>
	                            <div class="pull-right">
	                            	<?php 
	                            		$dias_enviar_solicitud = array('1','2'); //dias habilitados para enviar solicitudes.
	                            		$sentinela = false;
	                            		$hoy = date('Y-m-d');
	                            		$dia = explode('-',$hoy);
	                            		for ($i=0; $i < count($dias_enviar_solicitud); $i++) { 
	                            			if($dias_enviar_solicitud[$i] == $dia[2]){
	                            				$sentinela = true;
	                            			}
	                            		}
	                            		if($sentinela){
	                            	?>
		                            <button type="button" onclick="recorre_observaciones();" class="btn waves-effect waves-light btn-success">Enviar solicitud <span class="mdi mdi-send"></span></button>
		                            <?php }else{
		                            	?>
									<button type="button" onclick="cerrar_mantenimiento2();cerrar_mantenimiento1();tabla_pasaje_unidad();" class="btn waves-effect waves-light btn-success">Finalizar <span class="mdi mdi-send"></span></button>	
		                            	<?php
		                            	}
		                            ?>
		                        </div>
		                    </div>
	                    </div>
	                </div>
	            </div>
	        </div>




<div id="modal_bitacora" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Bitácora de la solicitud</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body" id="cnt_bitacora">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success waves-effect" data-dismiss="modal">Aceptar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>



	    </div>
	</div>


</body>
</html>
 
<script>
	$(function(){
		$('#fecha_solicitud').datepicker({
	        format: 'dd-mm-yyyy',
	        autoclose: true,
	        todayHighlight: true,
	        daysOfWeekDisabled: [0,6]
	        
        });
        $('#fecha_detalle').datepicker({
	        format: 'dd-mm-yyyy',
	        autoclose: true,
	        todayHighlight: true,
	        endDate: moment().format("DD-MM-YYYY"),
	        daysOfWeekDisabled: [0,6]
        });

        $('#fecha1').datepicker({
        	format: 'yyyy-mm',
	        startView: 1,
  			minViewMode: 1
        });

        $('#mes_anio_pasaje').datepicker({
        	format: 'yyyy-mm',
	        startView: 1,
  			minViewMode: 1
        });

	        var date = new Date();
			var limite_inicio =  moment([date.getFullYear(), date.getMonth()-1, 1]);
            if(moment().format("e") == 0){
                limite_inicio.add(1,'days');
            }else if(moment().format("e") == 6){
                limite_inicio.add(2,'days');
            }

            $("#fecha_solicitud").datepicker("setStartDate", limite_inicio.format("DD-MM-YYYY") );

            var limite_fin = moment([date]);
            //limite_fin.add(6,'days');
            if(limite_fin.format("e") == 6){
                limite_fin.add(2,'days');
            }else if(limite_fin.format("e") == 0){
                limite_fin.add(1,'days');
            }

            $("#fecha_solicitud").datepicker("setEndDate", limite_fin.format("DD-MM-YYYY") );
	});
</script>