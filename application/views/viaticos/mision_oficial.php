<script type="text/javascript">
    function cambiar_editar(id,nombre,fecha_mision,actividad_realizada,bandera){
        $("#id_mision").val(id);
        $("#nombre_empleado").val(nombre);
        $("#fecha_mision").val(fecha_mision);
        $("#nombre_empresa").val("");
        $("#direccion_empresa").val("");
        $("#actividad").val(actividad_realizada);        

        if(bandera == "edit"){
            $("#ttl_form").removeClass("bg-success");
            $("#ttl_form").addClass("bg-info");
            $("#btnadd").hide(0);
            $("#btnedit").show(0);
            $("#cnt-tabla").hide(0);
            $("#cnt_form").show(0);
            $("#ttl_form").children("h4").html("<span class='fa fa-wrench'></span> Editar solicitud");
            tabla_empresas_visitadas();
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

        tabla_empresas_visitadas();

        $("#ttl_form").children("h4").html("<span class='mdi mdi-plus'></span> Nueva solicitud");
    }

    function cerrar_mantenimiento(){
        $("#cnt-tabla").show(0);
        $("#cnt_form").hide(0);
    }

    function cerrar_mantenimiento_viaticos(){
        $("#cnt-tabla").show(0);
        $("#cnt-viaticos").hide(0);
    }

    function editar_horario(){
        $("#band").val("edit");
        gestionar_mision();
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
            gestionar_mision();
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
            tabla_empresas_visitadas()
        });  
    }

	function add(button) {
	    var row = button.parentNode.parentNode;
	  	var cells = row.querySelectorAll('td:not(:last-of-type)');
	  	addToCartTable(cells);
	}

	function remove(obj,otro) {

		if(otro == 'editar')
			var row = obj.parentNode.parentNode;
		else
			var row = this.parentNode.parentNode;
	    
	    document.querySelector('#target tbody').removeChild(row);
	}

	function addToCartTable(cells) {
	    var nombre_empresa = $("#nombre_empresa").val();
	    var direccion_empresa = $("#direccion_empresa").val();
	    var municipio = $("#municipio").val();
	    var departamento = $("#departamento").val();
	    var tipo;

	    if(validar_empresas_visitadas()){

		    if(departamento.search("departamento") == 0){
		    	departamento = departamento.replace("departamento", "");
		    	tipo = "departamento";
		    }else{
		    	departamento = departamento.replace("oficina", "");
		    	tipo = "oficina";
		    }
		   
		   	var newRow = document.createElement('tr');

		   	var cellInputs = createCellHide();
		   	cellInputs.appendChild(createInputQty(municipio))
		   	cellInputs.appendChild(createInputQty(nombre_empresa))
		   	cellInputs.appendChild(createInputQty(direccion_empresa))
		   	cellInputs.appendChild(createInputQty(tipo))
		   	cellInputs.appendChild(createInputQty(departamento))
		   	newRow.appendChild(cellInputs);
		   
		   	newRow.appendChild(createCell(nombre_empresa));
		   	newRow.appendChild(createCell(direccion_empresa));

		   	var cellsorter = createCell();
		   	cellsorter.appendChild(createSorterBtn2())
		   	cellsorter.appendChild(createSorterBtn3())
		   	newRow.appendChild(cellsorter);

		   	var cellRemoveBtn = createCell();
		   	cellRemoveBtn.appendChild(createRemoveBtn())
		   	newRow.appendChild(cellRemoveBtn);
		   
		   	document.querySelector('#target tbody').appendChild(newRow);
		}
	}

	function validar_empresas_visitadas(){
		var validacion = [	COMBO("departamento"),
							COMBO("municipio"), 
	    					TEXTO("nombre_empresa",3,200), 
	    					TEXTO('direccion_empresa',3,200) ];

	    if($.inArray(false, validacion ) == -1){
	    	return true;
	    }else{
	    	return false;
	    }


	}

	function validar_mision(){
		var validacion = [	TEXTO("actividad",3,200),
							FECHA("fecha_mision") ];
		var tabla_vacia = $("#target").children("tbody").find("tr");

	    if($.inArray(false, validacion ) == -1){
	    	if(tabla_vacia.length > 0){
	    		return true;
	    	}else{
	    		swal({ title: "¡Faltan datos!", text: "No se han registrado empresas visitadas.", type: "warning", showConfirmButton: true });
	    		return false;
	    	}
	    }else{
	    	return false;
	    }
	}

	function createInputQty(val) {
	    var inputQty = document.createElement('input');
	  	inputQty.type = 'text';
	  	inputQty.required = 'true';
	  	inputQty.value = val;
	  	inputQty.className = 'form-control'
	  	return inputQty;
	}

	function createSorterBtn2() {
		var btnRemove = document.createElement('button');
	 	btnRemove.className = 'btn btn-xs btn-success';
	 	btnRemove.type = 'button';
	  	btnRemove.onclick = bajarFila;
	  	btnRemove.innerHTML = '<span class="fa fa-chevron-down"></span>';
	  	return btnRemove;
	}

    function createSorterBtn3() {
		var btnRemove = document.createElement('button');
	 	btnRemove.className = 'btn btn-xs btn-success';
	 	btnRemove.type = 'button';
	  	btnRemove.onclick = subirFila;
	  	btnRemove.innerHTML = '<span class="fa fa-chevron-up"></span>';
	  	return btnRemove;
	}

	function createRemoveBtn() {
		var btnRemove = document.createElement('button');
	 	btnRemove.className = 'btn btn-xs btn-danger';
	 	btnRemove.type = 'button';
	  	btnRemove.onclick = remove;
	  	btnRemove.innerHTML = '<span class="fa fa-remove"></span>';
	  	return btnRemove;
	}

	function createCell(text) {
		var td = document.createElement('td');
	  	if(text) {
	    	td.innerText = text;
	  	}
	  	return td;
	}

	function createCellHide(text) {
		var td = document.createElement('td');
	  	if(text) {
	    	td.innerText = text;
	  	}
	  	td.style = "display: none";
	  	return td;
	}

	function cambiar_municio(){
		var departamento = $("#departamento").val();

	    if(departamento.search("departamento") == 0){
	    	$("#nombre_empresa").val("");
	    	$("#direccion_empresa").val("");
	    }else{
	    	$("#nombre_empresa").val($('#departamento option:selected').html());
	    }
	    combo_municipio();
	}

	function recorrer_empresas(bandera){
		var filas = $("#target").children("tbody").children("tr");
		var celdas, inputs, query = "";
		var municipios = [];
		var empresas = [];
		var direcciones = [];
		var tipos = [];
		var departamentos = [];

		for(i=0; i<filas.length; i++){
			celdas = $(filas[i]).children("td");
			inputs = $(celdas[0]).children("input");
			municipios.push($(inputs[0]).val());
			empresas.push($(inputs[1]).val());
			direcciones.push($(inputs[2]).val());
			tipos.push($(inputs[3]).val());
			departamentos.push($(inputs[4]).val());
		}

		guardar_empresas_visitadas(municipios, empresas, direcciones, tipos, departamentos, bandera);
	}

	function guardar_empresas_visitadas(municipio, empresa, direccion, tipo, departamento, bandera){
		var departamentos = JSON.stringify(departamento);
		var municipios = JSON.stringify(municipio);
		var empresas = JSON.stringify(empresa);
		var direcciones = JSON.stringify(direccion);
		var tipos = JSON.stringify(tipo);
		var nr = JSON.stringify(new Array($("#nr").val()));

		if(bandera == "guardar"){
			id_mision = "vacio";
		}else{
			id_mision = $("#id_mision").val();
		}

	   	$.ajax({
	        type: "POST",
	        url: "<?php echo site_url(); ?>/viatico/mision_oficial/gestionar_empresas_visitadas",
	        data: {municipios : municipios, empresas : empresas, direcciones : direcciones,nr : nr, tipos : tipos, departamentos : departamentos, id_mision : id_mision},
	        cache: false,
	        success: function(response){
	            if(response == "exito"){
	            	cambiar_pestaña(id_mision, bandera);
	            }
	        }
	    });
	}

	function eliminar_empresas_visitadas(){
	   	$.ajax({
	        type: "POST",
	        url: "<?php echo site_url(); ?>/viatico/mision_oficial/eliminar_empresas_visitadas",
	        data: {id_mision : $("#id_mision").val()},
	        cache: false,
	        success: function(response){
	            if(response == "exito"){
	            	recorrer_empresas("editar");
	            }
	        }
	    });
	}

	function gestionar_mision(){
		if(validar_mision()){
			var formData = new FormData(document.getElementById("formajax"));
	        $.ajax({
	        		type:  'POST',
	                url:   '<?php echo site_url(); ?>/viatico/mision_oficial/gestionar_mision',
	                dataType: "html",
	            	data: formData,
	                cache: false,
	                contentType: false,
	           		processData: false
	        })
	        .done(function(data){ //una vez que el archivo recibe el request lo procesa y lo devuelve
	        	if(data == "exito"){
	                if($("#band").val() == "save"){
	                    recorrer_empresas("guardar");
	                }else if($("#band").val() == "edit"){
	                    eliminar_empresas_visitadas();
	                }else{
	                    swal({ title: "¡Borrado exitoso!", type: "success", showConfirmButton: true });
	                    tablahorarios();
	                }
	            }else{
	                swal({ title: "¡Ups! Error", text: "Intentalo nuevamente.", type: "error", showConfirmButton: true });
	            }
	        })
	    }
	}

	function combo_municipio(){
        id_departamento = $("#departamento").val();

        if(id_departamento.search("departamento") == 0){
	    	id_departamento = id_departamento.replace("departamento", "");
	    	tipo = "departamento";
	    }else{
	    	id_departamento = id_departamento.replace("oficina", "");
	    	tipo = "oficina";
	    }

        if(window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp_municipio=new XMLHttpRequest();
        }else{// code for IE6, IE5
            xmlhttp_municipio=new ActiveXObject("Microsoft.XMLHTTPB");
        }

        xmlhttp_municipio.onreadystatechange=function(){
            if (xmlhttp_municipio.readyState==4 && xmlhttp_municipio.status==200){
                  document.getElementById("combo_municipio").innerHTML=xmlhttp_municipio.responseText;
                  $(".select2").select2();
                  if($("#municipio").val() != 0){
                  	$("#direccion_empresa").val($('#municipio option:selected').html())
                  }
                  validar_empresas_visitadas();
            }
        }

        xmlhttp_municipio.open("GET","<?php echo site_url(); ?>/viatico/mision_oficial/combo_municipios?id_departamento="+id_departamento+"&tipo="+tipo,true);
        xmlhttp_municipio.send();
    }

    function tabla_empresas_visitadas(){
        id_mision = $("#id_mision").val();

        if(window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp_municipio=new XMLHttpRequest();
        }else{// code for IE6, IE5
            xmlhttp_municipio=new ActiveXObject("Microsoft.XMLHTTPB");
        }

        xmlhttp_municipio.onreadystatechange=function(){
            if (xmlhttp_municipio.readyState==4 && xmlhttp_municipio.status==200){
                  document.getElementById("cnt_empresas").innerHTML=xmlhttp_municipio.responseText;
            }
        }

        xmlhttp_municipio.open("GET","<?php echo site_url(); ?>/viatico/mision_oficial/tabla_empresas_visitadas?id_mision="+id_mision,true);
        xmlhttp_municipio.send();
    }

    function tabla_empresas_viaticos(id_mision, bandera){
        if(window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp_municipio=new XMLHttpRequest();
        }else{// code for IE6, IE5
            xmlhttp_municipio=new ActiveXObject("Microsoft.XMLHTTPB");
        }

        xmlhttp_municipio.onreadystatechange=function(){
            if (xmlhttp_municipio.readyState==4 && xmlhttp_municipio.status==200){
                  document.getElementById("cnt-viaticos").innerHTML=xmlhttp_municipio.responseText;
                  $('[data-toggle="tooltip"]').tooltip();

            }
        }

        xmlhttp_municipio.open("GET","<?php echo site_url(); ?>/viatico/mision_oficial/tabla_empresas_viaticos?id_mision="+id_mision+"&tipo="+bandera,true);
        xmlhttp_municipio.send();
    }

    function cambiar_viaticos(id_mision, bandera){
    	$("#cnt_form").hide(0);
        $("#cnt-viaticos").show(0);
        tabla_empresas_viaticos(id_mision, bandera);
    }

    function bajarFila(obj, otro){
    	if(otro == 'editar')
			var row = $(obj).parents("tr:first");
		else
			var row = $(this).parents("tr:first");

    	row.insertAfter(row.next());
    }

    function subirFila(obj, otro){
    	if(otro == 'editar')
			var row = $(obj).parents("tr:first");
		else
			var row = $(this).parents("tr:first");

    	row.insertBefore(row.prev());
    }

    function verificar_viaticos(obj){
    	var fila = $(obj).parents("tr:first");
    	var cells = $(fila).children("td");

    	var hora_inicio = $($(cells[3]).find("input")).val();
    	var hora_fin = $($(cells[4]).find("input")).val();

    	var viatico = $($(cells[6]).find("input")).val(viatico);;

    	if(hora_inicio != "" && hora_fin != ""){
    		calcular_viaticos(hora_inicio, hora_fin, viatico)
    	}

    	
    }

    function calcular_viaticos(hora_inicio, hora_fin, obj){
        ajax = objetoAjax();
        ajax.open("POST", "<?php echo site_url(); ?>/viatico/mision_oficial/calcular_viaticos", true);
        ajax.onreadystatechange = function() {
            if (ajax.readyState == 4){
                $(obj).val(ajax.responseText);               
            }
        } 
        ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded"); 
        ajax.send("&hora_inicio="+hora_inicio+"&hora_fin="+hora_fin)
    }

    function recorrer_solicitud(){
    	var filas = $("#tabla_viaticos").children("tbody").find("tr");

    	var query = "UPDATE vyp_empresas_visitadas SET\n";

    	var origenes = "origen = CASE id_empresas_visitadas\n";
    	var hora_salida = "hora_salida = CASE id_empresas_visitadas\n";
    	var hora_llegada = "hora_llegada = CASE id_empresas_visitadas\n";
    	var kilometraje = "kilometraje = CASE id_empresas_visitadas\n";
    	var viaticos = "viaticos = CASE id_empresas_visitadas\n";
    	var pasajes = "pasajes = CASE id_empresas_visitadas\n";

    	var id_empresa = "";

    	var id;

    	for(i=0; i<filas.length; i++){
    		var celdas = $(filas[i]).find("td");
    		id = $($(celdas[0]).find("input")[0]).val();
    		id_empresa += id+",";
    		origenes += "WHEN "+id+" THEN '"+$(celdas[1]).html()+"'\n";
    		hora_salida += "WHEN "+id+" THEN '"+$($(celdas[3]).find("input")).val()+"'\n";
    		hora_llegada += "WHEN "+id+" THEN '"+$($(celdas[4]).find("input")).val()+"'\n";
    		kilometraje += "WHEN "+id+" THEN '"+$($(celdas[5]).find("input")).val()+"'\n";
    		viaticos += "WHEN "+id+" THEN '"+$($(celdas[6]).find("input")).val()+"'\n";
    		pasajes += "WHEN "+id+" THEN '"+$($(celdas[7]).find("input")).val()+"'\n";
    	}

    	origenes += "END,\n";
    	hora_salida += "END,\n";
    	hora_llegada += "END,\n";
    	kilometraje += "END,\n";
    	viaticos += "END,\n";
    	pasajes += "END\n";

    	id_empresa = id_empresa.substr(0,id_empresa.length-1);

    	query += origenes+hora_salida+hora_llegada+kilometraje+viaticos+pasajes+" WHERE id_empresas_visitadas IN ("+id_empresa+");";

    	generar_solicitud(query);

    }

    function generar_solicitud(query){       
        jugador = document.getElementById('area');
        
        ajax = objetoAjax();
        ajax.open("POST", "<?php echo site_url(); ?>/viatico/mision_oficial/generar_solicitud", true);
        ajax.onreadystatechange = function() {
            if (ajax.readyState == 4){
                jugador.value = (ajax.responseText);
                if(jugador.value == "exito"){
                    swal({ title: "Solicitud enviada!", type: "success", showConfirmButton: true });
                    tablahorarios();
                }else{
                    swal({ title: "¡Ups! Error", text: "Intentalo nuevamente.", type: "error", showConfirmButton: true });
                }
            }
        } 
        ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded"); 
        ajax.send("&query="+query)
    }

    function cambiar_pestaña(id_mision, bandera){
    	//tablahorarios();
    	if(id_mision == "vacio"){
    		obtener_ultima_mision();
    	}else{
    		cambiar_viaticos(id_mision, bandera);
    	}

    }

    function obtener_ultima_mision(){ 
    	nr = $("#nr").val();              
        ajax = objetoAjax();
        ajax.open("POST", "<?php echo site_url(); ?>/viatico/mision_oficial/obtener_ultima_mision", true);
        ajax.onreadystatechange = function() {
            if (ajax.readyState == 4){
                cambiar_viaticos(ajax.responseText);
            }
        } 
        ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded"); 
        ajax.send("&nr="+nr)
    }

    function imprimir_solicitud(id_mision){
    	window.open('<?php echo site_url(); ?>/viatico/mision_oficial/imprimir_solicitud?id_mision='+id_mision, '_blank');
    }

</script>

<style type="text/css">
	.t_error {
	    position: relative;
	    display: inline-block;
	}

	.t_error .select2-selection{
	    border-color: #d50000;
	    background-color: #da050508;
	}

	.t_error .form-control{
	    border-color: #d50000;
	    background-color: #da050508;
	}

	.text_validate {
	    display: none;
	    font-size: 14px;
	}

	.t_error .t_errortext {
	    visibility: hidden;
	    max-width: 500px;
	    background-color: #da0505d1;
	    color: #fff;
	    text-align: center;
	    border-radius: 0px 0px 6px 6px;
	    padding: 3px 10px 3px 10px;
	    
	    /* Position the tooltip */
	    position: absolute;
	    z-index: 1;
	    top: 100%;
    	left: 4%; 
	}

	.t_error:hover .t_errortext {
		display: block;
	    visibility: visible;
	}

	.t_success .select2-selection{
	    border-color: #18bc9c;
	}

	.t_success .form-control{
	    border-color: #18bc9c;	    
	}
</style>
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
                <h3 class="text-themecolor m-b-0 m-t-0">Gestión de solicitudes de viáticos y pasajes</h3>
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
                        
                        <?php echo form_open('', array('id' => 'formajax', 'style' => 'margin-top: 0px;', 'class' => 'm-t-40')); ?>
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
                                    <input type="text" id="nombre_empleado" name="nombre_empleado" class="form-control" required="" minlength="3" value="<?php echo $nombre_usuario; ?>" readonly data-validation-required-message="Este campo es requerido">
                                    <div class="help-block"></div>
                                </div>
                                <div class="form-group col-lg-6">   
                                    <h5>Fecha de misión: <span class="text-danger">*</span></h5>
                                    <input type="text" data-date-end-date="0d" onkeyup="FECHA('fecha_mision')" value="<?php echo date('d-m-Y'); ?>" class="form-control" id="fecha_mision" name="fecha_mision" placeholder="dd/mm/yyyy">
                                    <span class="text_validate"></span>                    
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-lg-12" style="height: 83px;">
                                    <h5>Actividad realizada: <span class="text-danger">*</span></h5>
                                    <textarea type="text" onkeyup="TEXTO('actividad',3,500);" id="actividad" name="actividad" class="form-control" required="" placeholder="Describa la actividad realizada en la misión" minlength="3" data-validation-required-message="Este campo es requerido"></textarea>
                                    <span class="text_validate"></span>
                                </div>
                            </div>

                            <div class="row">
                            	<div class="form-group col-lg-12 m-b-5" align="right">
                                    <button type="button" onclick="$('#myModal').modal('show');" class="pull-right btn btn-success">
                                      Registrar empresa visitada
                                    </button>
                                </div>
                            </div>

                            <div class="row" id="cnt_empresas">
                                
                            </div>

                            <div align="right" id="btnadd">
                                <button type="reset" class="btn waves-effect waves-light btn-success"><i class="mdi mdi-recycle"></i> Limpiar</button>
                                <button type="button" onClick="gestionar_mision();" class="btn waves-effect waves-light btn-success2"><i class="mdi mdi-plus"></i> Guardar</button>
                            </div>
                            <div align="right" id="btnedit" style="display: none;">
                                <button type="reset" class="btn waves-effect waves-light btn-success"><i class="mdi mdi-recycle"></i> Limpiar</button>
                                <button type="button" onclick="editar_horario()" class="btn waves-effect waves-light btn-info"><i class="mdi mdi-pencil"></i> Editar</button>
                                <button type="button" onclick="cambiar_pestaña($('#id_mision').val(),'editar')" class="btn waves-effect waves-light btn-success2">Siguiente <i class="mdi mdi-chevron-right"></i></button>
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

            <div class="col-lg-12" id="cnt-viaticos">

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

<!-- sample modal content -->
<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Gestionar empresas visitadas</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">



                <div class="row">
                	<div class="form-group col-lg-12">
                        <h5>Oficina / Departamento: <span class="text-danger">*</span></h5>
                        <select id="departamento" name="departamento" class="select2" onchange="cambiar_municio();" style="width: 100%">
                            <option value="0">[Elija la oficina o departamento]</option>
                            <optgroup label="OFICINAS">
                            <?php 
                                $destino = $this->db->get("vyp_oficinas");
                                if($destino->num_rows() > 0){
                                    foreach ($destino->result() as $fila) {              
                                       echo '<option class="m-l-50" value="oficina'.$fila->id_departamento.'">'.$fila->nombre_oficina.'</option>';
                                    }
                                }
                            ?>
                            </optgroup>
                            <optgroup label="DEPARTAMENTOS">
                                <?php 
                                    $deptos = $this->db->get("org_departamento");
                                    if($deptos->num_rows() > 0){
                                        foreach ($deptos->result() as $fila) {
                                        	echo '<option class="m-l-50" value="departamento'.$fila->id_departamento.'">'.$fila->departamento.'</option>';            
                                        }
                                    }
                                ?>
                            </optgroup>
                        </select>
						<span class="text_validate"></span>
                    </div>
                </div>

                <div id="combo_municipio">
               	</div>

                <div class="row">
                	<div class="form-group col-lg-12">
                        <h5>Nombre de la empresa: <span class="text-danger">*</span></h5>
                        <input type="text" id="nombre_empresa" onkeyup="TEXTO('nombre_empresa',3,200);" name="nombre_empresa" class="form-control" placeholder="Ingrese el nombre de la empresa">
                        <span class="text_validate"></span>
                    </div>
                </div>

                <div class="row">
                	<div class="form-group col-lg-12">
                        <h5>Dirección: <span class="text-danger">*</span></h5>
                        <textarea id="direccion_empresa" name="direccion_empresa" onkeyup="TEXTO('direccion_empresa',3,200);" class="form-control" placeholder="Ingrese la dirección de la empresa" rows="2"></textarea>
                        <span class="text_validate"></span>
                    </div>
               	</div>


            </div>
            <div class="modal-footer">
            	<button type="button" onclick="add(this)" class="pull-right btn btn-success2" data-dismiss="modal">Agregar</button>
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<script>
$(function(){ 

    $(document).ready(function(){         
        $('#fecha_mision').datepicker({
        	format: 'dd-mm-yyyy',
            autoclose: true,
            todayHighlight: true
        });
    });


    $(document).ready(function(){
	    $(".up,.down").click(function(){
	        var row = $(this).parents("tr:first");
	        if ($(this).is(".up")) {
	            row.insertBefore(row.prev());
	        } else {
	            row.insertAfter(row.next());
	        }
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