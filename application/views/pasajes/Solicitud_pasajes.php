

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

	    }
	    function tabla_pasaje_unidad(){ 
	    	fechas = $("#fecha1").val();
	    	nr = $("#nr").val();
	        if(window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
	            xmlhttpB=new XMLHttpRequest();
	        }else{// code for IE6, IE5
	            xmlhttpB=new ActiveXObject("Microsoft.XMLHTTPB");
	        }
	        xmlhttpB.onreadystatechange=function(){
	            if (xmlhttpB.readyState==4 && xmlhttpB.status==200){
	                document.getElementById("cnt_pasaje").innerHTML=xmlhttpB.responseText;
	                 $('[data-toggle="tooltip"]').tooltip();
	                $('#fecha').datepicker({
	                    format: 'dd-mm-yyyy',
	                    autoclose: true,
	                    todayHighlight: true
	                });
	                
	                $('#myTable').DataTable();
	            }
	        }
	        xmlhttpB.open("GET","<?php echo site_url(); ?>/pasajes/pasaje/tabla_pasaje_unidad?nr="+nr+"&fecha1="+fechas, true);
	        xmlhttpB.send(); 
	   
		}
	function combo_oficina_departamento(tipo){
        var nr = $("#nr").val();
        var newName = 'Otro nombre',
        xhr = new XMLHttpRequest();

        xhr.open('GET', "<?php echo site_url(); ?>/pasajes/Lista_pasaje/combo_oficinas_departamentos1?tipo="+tipo+"&nr="+nr);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status === 200 && xhr.responseText !== newName) {
                document.getElementById("combo_departamento").innerHTML = xhr.responseText;
                // document.getElementById("combo_departamento1").innerHTML = xhr.responseText;
                $(".select2").select2();
                if(tipo == "mapa"){
                    $('#departamento').val(id_departamento_mapa).trigger('change.select2');
                }else{
                    combo_municipio(tipo);
                }
            }else if (xhr.status !== 200) {
                swal({ title: "Ups! ocurrió un Error", text: "Al parecer no todos los objetos se cargaron correctamente por favor recarga la página e intentalo nuevamente", type: "error", showConfirmButton: true });
            }
        };
        xhr.send(encodeURI('name=' + newName));
    }

    function combo_municipio(tipo){     
        var id_departamento = $("#departamento").val();
        var newName = 'John Smith',

        xhr = new XMLHttpRequest();
        xhr.open('GET', "<?php echo site_url(); ?>/pasajes/Lista_pasaje/combo_municipios1?id_departamento="+id_departamento+"&tipo="+tipo);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status === 200 && xhr.responseText !== newName) {
                document.getElementById("combo_municipio").innerHTML = xhr.responseText;
                // document.getElementById("combo_municipio1").innerHTML = xhr.responseText;
                $(".select2").select2();
                if(tipo == "oficina"){
                    if($("#departamento").val() != ""){
                       // $("#nombre_empresa").val($("#departamento option:selected").text());
                        //$("#direccion_empresa").val($("#departamento option:selected").text());
                        //$("#nombre_empresa").parent().parent().hide(0);
                        //$("#direccion_empresa").parent().hide(0);
                        $("#municipio").parent().hide(0);
                    }else{
                       
                        $("#municipio").parent().hide(0);
                        
                    }
                   // input_distancia(tipo);
                }else if(tipo == "departamento"){
                  
                    $("#municipio").parent().show(0);
                   // input_distancia(tipo);
                }
            }
            else if (xhr.status !== 200) {
                swal({ title: "Ups! ocurrió un Error", text: "Al parecer no todos los objetos se cargaron correctamente por favor recarga la página e intentalo nuevamente", type: "error", showConfirmButton: true });
            }
        };
        xhr.send(encodeURI('name=' + newName));
    }
    function cambiar_nuevo(){

        $("#band").val("save");

        $("#ttl_form").addClass("bg-success");
        $("#ttl_form").removeClass("bg-info");

       // $("#btnadd").show(0);
       // $("#btnedit").hide(0);

        $("#cnt_tabla").hide(0);
        $("#cnt_form").show(0);
        //$("#cnt_form").removeClass("col-lg-10");
        //$("#cnt_form").addClass("col-lg-10");
        $("#panel_mapa").hide(10);
        $("#ttl_form").children("h4").html("<span class='mdi mdi-plus'></span> Nueva Solicitud de Pasaje");
 		combo_oficina_departamento("departamento");
    }
    function cerrar_mantenimiento(){
    	$("#cnt_tabla").show(0);
        $("#cnt_form").hide(0);
    }
	</script>
</head>
<body>

	<div class="page-wrapper">
	    <div class="container-fluid">
	        <button id="notificacion" style="display: none;" class="tst1 btn btn-success2">Info Message</button>

	        <div class="row page-titles">
	            <div class="align-self-center" align="center">
	                <h3 class="text-themecolor m-b-0 m-t-0">Solicitud de Pasajes</h3>
	            </div>
	        </div>
	         <div class="row ">
	            <div class="col-lg-12" id="cnt_tabla" style="display: block;">
	                <div class="card">
	                    <div class="card-header bg-success2" id="">
	                        <h4 class="card-title m-b-0 text-white">Datos</h4>
	                    </div>
	                    <div class="card-body b-t">
	                    	<div class="row ">
								<div class="form-group col-lg-6">
	                                <h5>Solicitante: <span class="text-danger">*</span></h5>
	                                <select id="nr" name="nr" class="select2" style="width: 100%" required onchange="tabla_pasaje_unidad()">
	                                <option value=''>[Elija el empleado]</option>
	                                <?php
	                                    $dataEmpleado2 = $this->db->query("SELECT e.id_empleado, e.nr, UPPER(CONCAT_WS(' ', e.primer_nombre, e.segundo_nombre, e.tercer_nombre, e.primer_apellido, e.segundo_apellido, e.apellido_casada)) AS nombre_completo FROM sir_empleado AS e WHERE e.id_estado = '00001' ORDER BY e.primer_nombre, e.segundo_nombre, e.tercer_nombre, e.primer_apellido, e.segundo_apellido, e.apellido_casada");
	                                        if($dataEmpleado2->num_rows() > 0){
	                                            foreach ($dataEmpleado2->result() as $fila2) {
	                                 ?>
	<option class="m-l-50" value="<?php echo $fila2->nr; ?>"><?php echo preg_replace ('/[ ]+/', ' ',$fila2->nombre_completo.' - '.$fila2->nr) ?></option>
	                                <?php
	                                        } 	
	                                    }
	                                    //$u_rec_id = $this->session->userdata('rec_id');
	                                ?>
	                                </select>
	                            </div>
	                            <div class="form-group col-lg-3">
	                            	<h5>Fecha: <span class="text-danger">*</span></h5>
	                            	<input type="month"  class="form-control" id="fecha1" name="fecha1"  onchange="tabla_pasaje_unidad();">
	                            </div>
	                             <div class="form-group col-lg-3">
	                             	<br>
	                            <button type="button" onclick="cambiar_nuevo();" class="btn waves-effect waves-light btn-success2"><span class="mdi mdi-plus"></span> Nuevo registro</button>
	                        </div>
	                        </div>
	                        
	                        <div id="cnt_pasaje">Seleccione un solicitante y una fecha</div>
	                    </div>
	                    
	                </div>
	            </div>
	        </div>

			
			<div class="row justify-content-center">

	            <div class="col-lg-12" id="cnt_form" style="display: none;">
	                <div class="card">
	                    <div class="card-header bg-success2" id="ttl_form">
	                        <div class="card-actions text-white">
	                            <a style="font-size: 16px;" onclick="cerrar_mantenimiento();"><i class="mdi mdi-window-close"></i></a>
	                        </div>
	                        <h4 class="card-title m-b-0 text-white"></h4>
	                    </div>
	                    <div class="card-body b-t">
	                    	<div class="row ">
	                    		<div class="form-group col-lg-3">
	                    			<label for="fecha" class="font-weight-bold">Fecha: <span class="text-danger">*</span></label>
	                    			 
	                    			<input type="text" pattern="\d{1,2}-\d{1,2}-\d{4}" required="" class="form-control" id="fecha" name="fecha" placeholder="dd/mm/yyyy" onchange="">
                                    <div class="help-block"></div>
	                    		</div>
	                    		
	                    		<div class="form-group col-lg-3">
	                    			<div class="" id="combo_departamento" ></div> 
	                    		</div>
	                    		<div class="form-group col-lg-3">
	                    			<div class="" id="combo_municipio" ></div>
	                    		</div>
	                    	</div>
	                    	<div class="row">
	                    		<div class="form-group col-lg-3">
	                    			<label for="empresa" class="font-weight-bold">Nombre de la Empresa: <span class="text-danger">*</span></label>
	                    			<input type="text" id="empresa" name="empresa" class="form-control" required="" data-validation-required-message="Este campo es requerido" placeholder="Escriba Nombre de la empresa"  > 
	                    		</div>
	                    		<div class="form-group col-lg-6">
	                    			<label for="direccion" class="font-weight-bold">Dirección de la Empresa: <span class="text-danger">*</span></label>
	                    			 <input type="text"  id="direccion" name="direccion" class="form-control" required="" placeholder="Escriba la dirección" minlength="3" data-validation-required-message="Este campo es requerido">
	                    		</div>
	                    		<div class="form-group col-lg-3">
	                    			<label for="expediente" class="font-weight-bold">No de Expediente: <span class="text-danger">*</span></label>
	                    			<input type="text" id="expediente" name="expediente" class="form-control" placeholder="Escriba No de expediente"  >
	                    		</div>
	                    	</div>
	                    	<div class="row">
	                    		<div class="form-group col-lg-3">
	                    			<label for="id_actividad" class="font-weight-bold">Nombre de la Actividad: <span class="text-danger">*</span></label>
	                    			<select id="id_actividad" name="id_actividad" class="select2" required=''  style="width: 100%" >
					                <option value=''>[Elija una actividad]</option>
					                <?php 
					                  $actividad = $this->db->query("SELECT * FROM vyp_actividades WHERE depende_vyp_actividades = 0 OR depende_vyp_actividades = '' OR depende_vyp_actividades IS NULL");
					                  if($actividad->num_rows() > 0){
					                    foreach ($actividad->result() as $filaa) {              
					                      echo '<option class="m-l-50" value="'.$filaa->id_vyp_actividades.'">'.$filaa->nombre_vyp_actividades.'</option>';
					                      $activida_sub = $this->db->query("SELECT * FROM vyp_actividades WHERE depende_vyp_actividades = '".$filaa->id_vyp_actividades."'");
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
	                    		<div class="form-group col-lg-3">
	                    			<label for="monto" class="font-weight-bold">Monto: <span class="text-danger">*</span></label>
	                    			<input type="text" id="monto" name="monto" class="form-control" required="" data-validation-required-message="Este campo es requerido" placeholder="Digite el monto de pasaje" >
	                    		</div>
	                    	</div>
	                    </div>
	                </div>
	            </div>
	        </div>








	    </div>
	</div>


</body>
</html>
<script src="<?php echo base_url(); ?>assets/plugins/cropper/cropper-init.js"></script>
<script>
	$(function(){
		$('#fecha').datepicker({
	        format: 'dd-mm-yyyy',
	        autoclose: true,
	        todayHighlight: true,
	        daysOfWeekDisabled: [0,6]
        });
	});
</script>