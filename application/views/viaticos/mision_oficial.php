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

	function add(button) {
	    var row = button.parentNode.parentNode;
	  	var cells = row.querySelectorAll('td:not(:last-of-type)');
	  	addToCartTable(cells);
	}

	function remove() {
	    var row = this.parentNode.parentNode;
	    document.querySelector('#target tbody')
	            .removeChild(row);
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

		   	var cellRemoveBtn = createCell();
		   	cellRemoveBtn.appendChild(createRemoveBtn())
		   	newRow.appendChild(cellRemoveBtn);
		   
		   	document.querySelector('#target tbody').appendChild(newRow);
		}
	}

	function validar_empresas_visitadas(){
		var validacion = [	COMBO("municipio"), 
	    					TEXTO("nombre_empresa",3,200), 
	    					TEXTO('direccion_empresa',3,200) ];

	    if($.inArray(false, validacion ) == -1){
	    	return true;
	    }else{
	    	return false;
	    }
	}

	function validar_mision(){
		var validacion = [	TEXTO("actividad",3,200) ];

	    if($.inArray(false, validacion ) == -1){
	    	return true;
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

	function createRemoveBtn() {
		var btnRemove = document.createElement('button');
	 	btnRemove.className = 'btn btn-xs btn-danger';
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

	function recorrer_empresas(){
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

		guardar_empresas_visitadas(municipios, empresas, direcciones, tipos, departamentos);
	}

	function guardar_empresas_visitadas(municipio, empresa, direccion, tipo, departamento){
		var departamentos = JSON.stringify(departamento);
		var municipios = JSON.stringify(municipio);
		var empresas = JSON.stringify(empresa);
		var direcciones = JSON.stringify(direccion);
		var tipos = JSON.stringify(tipo);
		var nr = JSON.stringify(new Array($("#nr").val()));
	   	$.ajax({
	        type: "POST",
	        url: "<?php echo site_url(); ?>/viatico/mision_oficial/gestionar_empresas_visitadas",
	        data: {municipios : municipios, empresas : empresas, direcciones : direcciones,nr : nr, tipos : tipos, departamentos : departamentos},
	        cache: false,
	        success: function(response){
	            alert(response);
	        }
	    });
	}

	function guardar_mision(){
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
	        	alert(data)
	        	if(data == "exito"){
	                cerrar_mantenimiento();
	                if($("#band").val() == "save"){
	                    recorrer_empresas();
	                }else if($("#band").val() == "edit"){
	                    swal({ title: "¡Modificación exitosa!", type: "success", showConfirmButton: true });
	                }else{
	                    swal({ title: "¡Borrado exitoso!", type: "success", showConfirmButton: true });
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
                  }else{

                  }
            }
        }

        xmlhttp_municipio.open("GET","<?php echo site_url(); ?>/viatico/mision_oficial/combo_municipios?id_departamento="+id_departamento+"&tipo="+tipo,true);
        xmlhttp_municipio.send();
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
	    color: #d50000;
	}

	.t_error .form-control{
	    border-color: #d50000;
	    background-color: #da050508;
	    color: #d50000;
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
	    background-color: #18bc9c0a;
	    color: #18bc9c;
	}

	.t_success .form-control{
	    border-color: #18bc9c;
	    background-color: #18bc9c0a;
	    color: #18bc9c;
	}

	.t_success .t_successtext {
	    visibility: hidden;
	    max-width: 500px;
	    background-color: #18bc9c;
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

	.t_success:hover .t_successtext {
		display: block;
	    visibility: visible;
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
                                <div class="form-group col-lg-6 m-b-15">   
                                    <h5>Fecha de misión: <span class="text-danger">*</span></h5>
                                    <input type="text" data-date-end-date="0d" value="<?php echo date('d-m-Y'); ?>" class="form-control" id="fecha_mision" name="fecha_mision" placeholder="dd/mm/yyyy">                       
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-lg-12">
                                    <h5>Actividad realizada: <span class="text-danger">*</span></h5>
                                    <textarea type="text" onkeyup="TEXTO('actividad',3,500);" id="actividad" name="actividad" class="form-control" required="" placeholder="Describa la actividad realizada en la misión" minlength="3" data-validation-required-message="Este campo es requerido"></textarea>
                                    <div class="help-block"></div>
                                </div>
                            </div>

                            <div class="row">
                            	<div class="form-group col-lg-6">
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
                                <div class="form-group col-lg-6" id="combo_municipio">
                                    
                                </div>                                
                            </div>

                            <div class="row">
                            	<div class="form-group col-lg-6">
                                    <h5>Nombre de la empresa: <span class="text-danger">*</span></h5>
                                    <input type="text" id="nombre_empresa" onkeyup="TEXTO('nombre_empresa',3,200);" name="nombre_empresa" class="form-control" placeholder="Ingrese el nombre de la empresa">
                                    <span class="text_validate"></span>
                                </div>
                                <div class="form-group col-lg-6">
                                    <h5>Dirección: <span class="text-danger">*</span></h5>
                                    <input type="text" id="direccion_empresa" name="direccion_empresa" onkeyup="TEXTO('direccion_empresa',3,200);" class="form-control" placeholder="Ingrese la dirección de la empresa" minlength="3">
                                    <span class="text_validate"></span>
                                </div>
                            </div>

                            <div class="row">
                            	<div class="form-group col-lg-12 m-b-5" align="right">
                                    <button type="button" onclick="add(this)" class="pull-right btn btn-primary">
                                      Agregar
                                    </button>
                                </div>
                            </div>

                            <div class="row">
                                <div class="table-responsive">
                                <table id="target" class="table table-bordered table-hover">
                                  	<thead>
	                                    <tr>
	                                    	<th style="display: none;">Inputs</th>
	                                  		<th>Empresa visitada</th>
	                                  		<th>Dirección</th>
	                                  		<th>(*)</th>
	                                	</tr>
                                  	</thead>
                                  	<tbody></tbody>
                                </table>
                                </div>
                            </div>

                            <div align="right" id="btnadd">
                                <button type="reset" class="btn waves-effect waves-light btn-success"><i class="mdi mdi-recycle"></i> Limpiar</button>
                                <button type="button" onClick="guardar_mision();" class="btn waves-effect waves-light btn-success2"><i class="mdi mdi-plus"></i> Guardar</button>
                                <button type="button" onclick="recorrer_empresas();" class="btn waves-effect waves-light btn-success2"><i class="mdi mdi-plus"></i> Recorrer</button>
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