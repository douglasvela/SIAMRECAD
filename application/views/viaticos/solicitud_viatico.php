<script type="text/javascript">
    function cambiar_editar(id,nombre,caracteristicas){
        $("#idb").val(id);
        $("#nombre").val(nombre);
        $("#caracteristicas").val(caracteristicas);
        $("#ttl_form").removeClass("bg-success");
        $("#ttl_form").addClass("bg-info");

        $("#btnadd").hide(0);
        $("#btnedit").show(0);

        $("#cnt-tabla").hide(0);
        $("#cnt_form").show(0);

        $("#ttl_form").children("h4").html("<span class='fa fa-wrench'></span> Editar Banco");
    }

    function cambiar_nuevo(){
        $("#idb").val("");
        $("#nombre").val("");
        $("#caracteristicas").val("");
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

    function editar_banco(obj){
        $("#band").val("edit");
        $("#submit").click();
    }

    function eliminar_banco(obj){
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
        //tablabancos();
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
        
        xmlhttpB.open("GET","<?php echo site_url(); ?>/configuraciones/tablabancos",true);
        xmlhttpB.send();
    }

    function calcular_viaticos(){
		var hora_inicio = $("#hora_salida").val();
		var hora_fin = $("#hora_regreso").val();       
        
        ajax = objetoAjax();
        ajax.open("POST", "<?php echo site_url(); ?>/viatico/solicitud/calcular_viaticos", true);
        ajax.onreadystatechange = function() {
            if (ajax.readyState == 4){
                $("#viatico").val(ajax.responseText);                
            }
        } 
        ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded"); 
        ajax.send("&hora_inicio="+hora_inicio+"&hora_fin="+hora_fin)
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

var ultimo_destino = "";

function addToCartTable(cells) {
    var trs = $("#target").find("tr");
    var destino = $("#destino option:selected").html();
    if($("#especifico").val() != ""){
        destino +=" -> "+$("#especifico").val();
    }
    var hora_inicio = $("#hora_salida").val();
    var hora_fin = $("#hora_regreso").val();
    var pasaje = "$"+$("#pasaje").val();
    var viatico = "$"+$("#viatico").val();
    
    if(trs.length < 2){
        ultimo_destino = $("#origen option:selected").html();
    }
   
   var newRow = document.createElement('tr');
   
   newRow.appendChild(createCell(ultimo_destino));
   newRow.appendChild(createCell(destino));
   newRow.appendChild(createCell(hora_inicio));
   newRow.appendChild(createCell(hora_fin));
   newRow.appendChild(createCell(viatico));
   newRow.appendChild(createCell(pasaje));
   var cellRemoveBtn = createCell();
   cellRemoveBtn.appendChild(createRemoveBtn())
   newRow.appendChild(cellRemoveBtn);
   
   document.querySelector('#target tbody').appendChild(newRow);
   ultimo_destino = destino;
   $("#hora_salida").val($("#hora_regreso").val());
   $("#hora_regreso").val("");
}

function createInputQty() {
    var inputQty = document.createElement('input');
  inputQty.type = 'number';
  inputQty.required = 'true';
  inputQty.min = 1;
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

        	<!-- Validation wizard -->
            <div class="row" id="validation">
                <div class="col-12">
                    <div class="card wizard-content">
                        <div class="card-body">
                            <form action="#" class="validation-wizard wizard-circle">
                                <!-- Step 1 -->
                                <h6>Empresa Visitada</h6>
                                <section>
                                    <div class="row">
                                    	<div class="col-lg-12">

                                            <div class="row">
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
                                                <div class="form-group col-lg-6">
                                                    <h5>Nombre del empleado: <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" onkeyup="formar_usuario();" id="nombre" name="nombre" class="form-control" required="" placeholder="Ingrese el nombre" minlength="3" value="<?php echo $nombre_usuario; ?>" readonly data-validation-required-message="Este campo es requerido">
                                                        <div class="help-block"></div>
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-6 m-b-15">   
                                                    <h5>Fecha de misión: <span class="text-danger">*</span></h5>
                                                    <input type="text" value="<?php echo date('d/m/Y'); ?>" class="form-control" id="datepicker-autoclose" placeholder="mm/dd/yyyy">                       
                                                </div>

                                            </div>


                                    		<p class="m-b-0"><b>DATOS DE LA EMPRESA VISITADA</b></p>
                                            <blockquote class="m-t-0">
                                            <div class="row">
                                            	<div class="form-group col-lg-4">
				                                    <h5>Nombre de la empresa: <span class="text-danger">*</span></h5>
				                                    <div class="controls">
				                                        <input type="text" id="nombre" name="nombre" class="form-control" required="" placeholder="Ingrese el nombre" minlength="3" data-validation-required-message="Este campo es requerido">
				                                        <div class="help-block"></div>
				                                    </div>
				                                </div>
		                                        <div class="form-group col-lg-8">
				                                    <h5>Dirección: <span class="text-danger">*</span></h5>
				                                    <div class="controls">
				                                        <input type="text" id="nombre" name="nombre" class="form-control" required="" placeholder="Ingrese el nombre" minlength="3" data-validation-required-message="Este campo es requerido">
				                                        <div class="help-block"></div>
				                                    </div>
				                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-lg-12">
                                                    <h5>Actividad realizada: <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" id="nombre" name="nombre" class="form-control" required="" placeholder="Ingrese el nombre" minlength="3" data-validation-required-message="Este campo es requerido">
                                                        <div class="help-block"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            </blockquote>
                                        </div>
                                    </div>
                                </section>
                                <!-- Step 2 -->
                                <h6>Rutas realizadas</h6>
                                <section>
                                    <div class="row">
                                        <div class="form-group col-lg-6 m-b-15">   
                                            <h5>Origen: <span class="text-danger">*</span></h5>                         
                                            <select id="origen" name="origen" class="select2" onchange="" style="width: 100%">
                                                <option value="0">[Elija el origen]</option>
                                                <?php 
                                                    $origen = $this->db->get("vyp_oficinas");
                                                    if($origen->num_rows() > 0){
                                                        foreach ($origen->result() as $fila) { 
                                                            echo '<option class="m-l-50" value="'.$fila->id_oficina.'">'.$fila->nombre_oficina.'</option>';
                                                        }
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-lg-6 m-b-15">
                                            <h5>Destino (Municipio): <span class="text-danger">*</span></h5>
                                            <select id="destino" name="destino" class="select2" onchange="" style="width: 100%">
                                                <option value="0">[Elija el destino]</option>
                                                <optgroup label="OFICINAS">
                                                <?php 
                                                    $destino = $this->db->get("vyp_oficinas");
                                                    if($destino->num_rows() > 0){
                                                        foreach ($destino->result() as $fila) {              
                                                           echo '<option class="m-l-50" value="'.$fila->id_oficina.'">'.$fila->nombre_oficina.'</option>';
                                                        }
                                                    }
                                                ?>
                                                </optgroup>
                                                    <?php 
                                                        $deptos = $this->db->get("org_departamento");
                                                        if($deptos->num_rows() > 0){
                                                            foreach ($deptos->result() as $fila) {              
                                                               echo '<optgroup label="'.$fila->departamento.'">';
                                                                $municipio = $this->db->query("SELECT * FROM org_municipio WHERE id_departamento_pais = ".$fila->id_departamento);
                                                                if($municipio->num_rows() > 0){
                                                                    foreach ($municipio->result() as $fila2) {              
                                                                       echo '<option class="m-l-50" value="'.$fila2->id_municipio.'">'.$fila2->municipio.'</option>';
                                                                    }
                                                                }
                                                                echo "</optgroup>";
                                                            }
                                                        }
                                                    ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-lg-6 m-b-15">   
                                            <h5>Hora de salida: <span class="text-danger">*</span></h5>
                                            <input class="form-control" type='time' name="hora_salida" id="hora_salida">
                                        </div>
                                        <div class="form-group col-lg-6 m-b-15">   
                                            <h5>Hora de retorno: <span class="text-danger">*</span></h5>
                                            <div class="input-group">
                                                <input class="form-control" type='time' name="hora_regreso" id="hora_regreso">
                                                <div class="input-group-addon" style="cursor: pointer;" onclick="calcular_viaticos();"><i class="fa fa-check"></i></div>
                                            </div>
                                            <div class="help-block"></div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-lg-6 m-b-5">
                                            <h5>Destino específico: <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" id="especifico" name="especifico" class="form-control" required="" placeholder="Ingrese el destino especifico" minlength="3" data-validation-required-message="Este campo es requerido">
                                                <div class="help-block"></div>
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-2 m-b-5">
                                            <h5>Distancia: <span class="text-danger">*</span></h5>
                                            <div class="input-group">
                                                <div class="input-group-addon">Km</div>
                                                <input type="number" id="monto" name="monto" class="form-control" required="" placeholder="0.00" data-validation-required-message="Este campo es requerido" min="0.00" value="0.00">
                                            </div>
                                            <div class="help-block"></div>
                                        </div>
                                        
                                        <div class="form-group col-lg-2 m-b-5">
                                            <h5>Viáticos: <span class="text-danger">*</span></h5>
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-dollar"></i></div>
                                                <input type="number" id="viatico" name="viatico" class="form-control" required="" placeholder="0.00" data-validation-required-message="Este campo es requerido" min="0.00" value="0.00">
                                            </div>
                                            <div class="help-block"></div>
                                        </div>
                                        <div class="form-group col-lg-2 m-b-5">
                                            <h5>Pasaje: <span class="text-danger">*</span></h5>
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-dollar"></i></div>
                                                <input type="number" id="pasaje" name="pasaje" class="form-control" required="" placeholder="0.00" data-validation-required-message="Este campo es requerido" min="0.00" value="0.00">
                                            </div>
                                            <div class="help-block"></div>
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
                                          <th>Origen</th>
                                          <th>Destino</th>
                                          <th>Hora salida</th>
                                          <th>Hora retorno</th>
                                          <th>Viatico</th>
                                          <th>Pasaje</th>
                                          <th>(*)</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                      </tbody>
                                    </table>
                                    </div>
                                    </div>
                                </section>
                                <!-- Step 3 -->
                                <h6>Step 3</h6>
                                <section>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="wint1">Interview For :</label>
                                                <input type="text" class="form-control required" id="wint1"> </div>
                                            <div class="form-group">
                                                <label for="wintType1">Interview Type :</label>
                                                <select class="custom-select form-control required" id="wintType1" data-placeholder="Type to search cities" name="wintType1">
                                                    <option value="Banquet">Normal</option>
                                                    <option value="Fund Raiser">Difficult</option>
                                                    <option value="Dinner Party">Hard</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="wLocation1">Location :</label>
                                                <select class="custom-select form-control required" id="wLocation1" name="wlocation">
                                                    <option value="">Select City</option>
                                                    <option value="India">India</option>
                                                    <option value="USA">USA</option>
                                                    <option value="Dubai">Dubai</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="wjobTitle2">Interview Date :</label>
                                                <input type="date" class="form-control required" id="wjobTitle2">
                                            </div>
                                            <div class="form-group">
                                                <label>Requirements :</label>
                                                <div class="c-inputs-stacked">
                                                    <label class="inline custom-control custom-checkbox block">
                                                        <input type="checkbox" class="custom-control-input"> <span class="custom-control-indicator"></span> <span class="custom-control-description ml-0">Employee</span> </label>
                                                    <label class="inline custom-control custom-checkbox block">
                                                        <input type="checkbox" class="custom-control-input"> <span class="custom-control-indicator"></span> <span class="custom-control-description ml-0">Contract</span> </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </form>
                        </div>
                    </div>
                </div>
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