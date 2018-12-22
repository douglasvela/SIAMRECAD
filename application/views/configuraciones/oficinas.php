<?php
// Características del navegador
$ua=$this->config->item("navegator");
$navegatorless = false;
if(floatval($ua['version']) < $this->config->item("last_version")){
    $navegatorless = true;
}
?>
 <style>

    @media screen and (max-width: 770px) {
        .otro {
            height: 500px;
        }
      }

      #divider {
          height: 89%;
      }

      #map {
        height: 100%;
      }

      #output {
        font-size: 14px;
      }
    </style>
<script type="text/javascript">

    function cambiar_editar(id_oficina,nombre_oficina,direccion_oficina,jefe_oficina,email_oficina,latitud_oficina,longitud_oficina,id_departamento,id_municipio,id_zona,bandera){
        $("#id_oficina").val(id_oficina);
        $("#nombre_oficina").val(nombre_oficina);
        $("#direccion_oficina").val(direccion_oficina);
        $("#latitud_oficina").val(latitud_oficina);
        $("#longitud_oficina").val(longitud_oficina);
        $("#jefe_oficina").val(jefe_oficina).trigger("change.select2");
        $("#email_oficina").val(email_oficina);
         $("#id_departamento").val(id_departamento).trigger("change.select2");
         $("#id_municipio").val(id_municipio).trigger("change.select2");
         $("#id_zona").val(id_zona).trigger("change.select2");
         open_form('1');

         //buscarMunicipio(id_departamento,id_municipio);
        if(bandera == "edit"){
            $("#ttl_form").removeClass("bg-success");
            $("#ttl_form").addClass("bg-info");
            $("#btnadd").hide(0);
            $("#btnedit").show(0);
            $("#cnt-tabla").hide(0);
            $("#cnt_form").show(0);
            initMap(latitud_oficina,longitud_oficina);
            $("#divider").show(300);
            $("#ttl_form").children("h4").html("<span class='fa fa-wrench'></span> Editar Oficina");
        }else{
            verificar_eliminacion();
        }
    }

    function verificar_eliminacion(){        
        var parametros = {
                "id_oficina" : $("#id_oficina").val(),
                "nombre" : $("#nombre_oficina").val()
        };
        $.ajax({
            data:  parametros, //datos que se envian a traves de ajax
            url:   '<?php echo site_url(); ?>/configuraciones/oficinas/verificar_dependencias', //archivo que recibe la peticion
            type:  'post', //método de envio
            success:  function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                if(response == "eliminar"){
                    eliminar_horario();
                }else{
                    $('#myModal').modal('show'); // abrir
                    $("#resultado").html("No se puede eliminar la oficina '"+parametros["nombre"]+"' por que ya está asignada a los empleados: <br><br>"+response);
                }
            }
        });
    }

    function cambiar_nuevo(){
        $("#id_oficina").val("");
         $("#nombre_oficina").val("");
         $("#direccion_oficina").val("");
         $("#latitud_oficina").val("");
         $("#longitud_oficina").val("");
         $("#jefe_oficina").val("");
         $("#email_oficina").val("");
        $("#band").val("save");
        open_form('1');

        $("#ttl_form").addClass("bg-success");
        $("#ttl_form").removeClass("bg-info");

        $("#btnadd").show(0);
        $("#btnedit").hide(0);

        $("#cnt-tabla").hide(0);
        $("#cnt_form").show(0);
        initMap($("#latitud_oficina").val(),$("#longitud_oficina").val());
        $("#ttl_form").children("h4").html("<span class='mdi mdi-plus'></span> Nueva Oficina");
    }


    function cerrar_mantenimiento(){
        $("#id_oficina").val("");
        $("#nombre_oficina").val("");
        $("#direccion_oficina").val("");
        $("#cnt-tabla").show(0);
        $("#cnt_form").hide(0);
         $("#jefe_oficina").val("");
         $("#email_oficina").val("");
         $("#id_departamento").val("").trigger("change.select2");
         $("#id_municipio").val("").trigger("change.select2");
         $("#jefe_oficina").val("").trigger("change.select2");
         $("#id_zona").val("0").trigger("change.select2");
         $("#divider").hide(300);
         //buscarMunicipio();
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
        <?php if(tiene_permiso($segmentos=2,$permiso=1)){ ?>
            tablaoficinas();
        <?php }else{ ?>
            $("#cnt-tabla").html("Usted no tiene permiso para este formulario.");     
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

    function tablaoficinas(){          
        $( "#cnt-tabla" ).load("<?php echo site_url(); ?>/configuraciones/oficinas/tabla_oficinas/", function() {
            $('#myTable').DataTable();
            $('[data-toggle="tooltip"]').tooltip();
           // buscarMunicipio(0,"null");
        });  
    }

    function tabla_oficina_autorizador(){
        var newName = 'ajaxCall', xhr = new XMLHttpRequest();
        var id_oficina = $("#id_oficina").val();

        xhr.open('GET', "<?php echo site_url(); ?>/configuraciones/oficinas/tabla_oficina_autorizador?id_oficina="+id_oficina);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status === 200 && xhr.responseText !== newName) {
                document.getElementById("cnt_autorizadores").innerHTML = xhr.responseText;
                //$('#myTable').DataTable();
                open_form('2');
                $('[data-toggle="tooltip"]').tooltip();
            }else if (xhr.status !== 200) {
                swal({ title: "Ups! ocurrió un Error", text: "Al parecer un componente no se cargó correctamente por favor recarga la página e intentalo nuevamente", type: "error", showConfirmButton: true });
            }
        };
        xhr.send(encodeURI('name=' + newName));
    }

    function cambiar_phone(id_oficina,nombre_oficina){
        $("#cnt-tabla").hide(0);
        $("#cnt-tabla-phone").show(0);
        document.getElementById('id_oficina_vyp_oficnas_telefono').value=id_oficina;
        tablaoficinas_phone(id_oficina);
    }
    function cerrar_mantenimiento_phone(){
        $("#cnt-tabla-phone").show(0);
        $("#cnt_form_phone").hide(0);
    }

    function tablaoficinas_phone(id_oficina){          
        $( "#cnt-tabla-phone" ).load("<?php echo site_url(); ?>/configuraciones/oficinas/tabla_telefonos/"+id_oficina, function() {
            $('#myTable_phone').DataTable();
            $('[data-toggle="tooltip"]').tooltip();
        });  
    }

 
    function cambiar_nuevo_phone(){
        $("#telefono_vyp_oficnas_telefono").val("");
        $("#id_vyp_oficinas_telefono").val("");
        $("#band_phone").val("save");

        $("#btnadd_phone").show(0);
        $("#btnedit_phone").hide(0);

        $("#cnt-tabla-phone").hide(0);
        $("#cnt_form_phone").show(0);
    }
    function cerrar_tabla_phone(){
        $("#cnt-tabla").show(0);
        $("#cnt-tabla-phone").hide(0);
    }
    function cambiar_editar_phone(id_vyp_oficinas_telefono,id_oficina_vyp_oficnas_telefono,telefono_vyp_oficnas_telefono,bandera){
        $("#id_vyp_oficinas_telefono").val(id_vyp_oficinas_telefono);
        $("#telefono_vyp_oficnas_telefono").val(telefono_vyp_oficnas_telefono);
        if(bandera == "edit"){
            $("#cnt-tabla-phone").hide(0);
            $("#cnt_form_phone").show(0);
            $("#btnadd_phone").hide(0);
            $("#btnedit_phone").show(0);
        }else{
            eliminar_oficina_phone();
        }
    }
    function editar_oficina_phone(){
        $("#band_phone").val("edit");
        $("#submit_phone").click();
    }
    function eliminar_oficina_phone(){
        $("#band_phone").val("delete");
        swal({
            title: "¿Está seguro?",
            text: "¡Desea eliminar el registro!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#fc4b6c",
            confirmButtonText: "Sí, deseo eliminar!",
            closeOnConfirm: false
        }, function(){
            $("#submit_phone").click();
        });
    }
    function buscarMunicipio(id_departamento,seleccion){
        id=id_departamento+="x"+seleccion;
        if(window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp_municipio=new XMLHttpRequest();
        }else{// code for IE6, IE5
            xmlhttp_municipio=new ActiveXObject("Microsoft.XMLHTTPB");
        }

        xmlhttp_municipio.onreadystatechange=function(){
            if (xmlhttp_municipio.readyState==4 && xmlhttp_municipio.status==200){
                  document.getElementById("municipios").innerHTML=xmlhttp_municipio.responseText;
                  $("#id_municipio").val().trigger('change.select2');
            }
        }

        xmlhttp_municipio.open("GET","<?php echo site_url(); ?>/configuraciones/oficinas/mostrarComboMunicipi/"+id,true);
        xmlhttp_municipio.send();
    }

    function buscar_id(municipio){
        var options = $("#id_municipio").find("option");
        var texto = "", id = "";

        municipio = municipio.replace(/[Áá]/gi,"A");
        municipio = municipio.replace(/[Éé]/gi,"E");
        municipio = municipio.replace(/[Íí]/gi,"I");
        municipio = municipio.replace(/[Óó]/gi,"O");
        municipio = municipio.replace(/[Úú]/gi,"U");

        municipio = municipio.toUpperCase();

        for(var i = 0; i < options.length; i++){
            texto = $(options[i]).html().trim();
            if(texto.toUpperCase().indexOf(municipio) > -1){
                //$("#id_municipio").val($(options[i]).val());
                $("#id_municipio").val($(options[i]).val()).trigger('change.select2');
                buscar_id2();
            }
        }
      }
    function buscar_id2(){
        var formData = new FormData();
        formData.append("id_municipio", $("#id_municipio").val());

        $.ajax({
            url: "<?php echo site_url(); ?>/configuraciones/oficinas/mostrarDepartamento",
            type: "post",
            dataType: "html",
            data: formData,
            cache: false,
            contentType: false,
            processData: false
        })
        .done(function(res){
             //$("#id_departamento").val(res);
             $('#id_departamento').val(res).trigger('change.select2');
        });
    }
    function buscarCorreo(){
        var formData = new FormData();
        formData.append("jefe_oficina", $("#jefe_oficina").val());

        $.ajax({
            url: "<?php echo site_url(); ?>/configuraciones/oficinas/mostrarCorreoJefe",
            type: "post",
            dataType: "html",
            data: formData,
            cache: false,
            contentType: false,
            processData: false
        })
        .done(function(res){
             $("#email_oficina").val(res);
        });
    }
    function seleccionar_zona(){
        switch($("#id_departamento").val()){
            case '00001':
                $("#id_zona").val('1').trigger("change.select2");
            break;
            case '00002':
                $("#id_zona").val('1').trigger("change.select2");
            break;
            case '00003':
                $("#id_zona").val('1').trigger("change.select2");
            break;
            case '00004':
                $("#id_zona").val('2').trigger("change.select2");
            break;
            case '00005':
                $("#id_zona").val('2').trigger("change.select2");
            break;
            case '00005':
                $("#id_zona").val('2').trigger("change.select2");
            break;
            case '00007':
                $("#id_zona").val('2').trigger("change.select2");
            break;
            case '00008':
                $("#id_zona").val('2').trigger("change.select2");
            break;
            case '00009':
                $("#id_zona").val('2').trigger("change.select2");
            break;
            case '00010':
                $("#id_zona").val('2').trigger("change.select2");
            break;
            case '00011':
                $("#id_zona").val('3').trigger("change.select2");
            break;
            case '00012':
                $("#id_zona").val('3').trigger("change.select2");
            break;
            case '00013':
                $("#id_zona").val('3').trigger("change.select2");
            break;
            case '00014':
                $("#id_zona").val('3').trigger("change.select2");
            break;
        }
    }
    function open_form(num){
        $("#cnt_form"+num).show(0);
        $("#cnt_form"+num).siblings("div").hide(0);
        $("#divider").hide(300);
    }
    function nuevo_autorizador(){
        var id_sistema = '<?php echo $this->config->item("id_sistema"); ?>';
        $("#band_autorizador").val("save");
        $("#nr_autorizador").val("").trigger('change.select2');
        $("#id_sistema").val(id_sistema).trigger('change.select2');
        $("#modal_autorizador").modal("show");
    }
    function cambiar_autorizador(id_oficina_autorizador, nr_autorizador, id_sistema, band){
        $("#band_autorizador").val(band);
        $("#id_oficina_autorizador").val(id_oficina_autorizador);
        $("#nr_autorizador").val(nr_autorizador);
        $("#id_sistema").val(id_sistema);

        if(band == "edit"){
            $("#modal_autorizador").modal("show");
        }else{
            eliminar_autorizador();
        }
    }
    function eliminar_autorizador(){
        swal({   
            title: "¿Está seguro?",   
            text: "¡Desea eliminar el registro!",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#fc4b6c",   
            confirmButtonText: "Sí, deseo eliminar!",   
            closeOnConfirm: true 
        }, function(){   
            $("#submit2").click(); 
        });
    }
</script>

<!-- ============================================================== -->
<!-- Inicio de DIV de inicio (ENVOLTURA) -->
<!-- ============================================================== -->
<div class="page-wrapper">
    <div class="container-fluid">
        <button id="notificacion" style="display: none;" class="tst1 btn btn-success2">Info Message</button>
        <!-- ============================================================== -->
        <!-- TITULO de la página de sección -->
        <!-- ============================================================== -->
        <div class="row page-titles">
            <div class="align-self-center" align="center">
                <h3 class="text-themecolor m-b-0 m-t-0">Gestión de Oficinas del MTPS</h3>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Fin TITULO de la página de sección -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Inicio del CUERPO DE LA SECCIÓN -->
        <!-- ============================================================== -->
        <div class="row" <?php if($navegatorless){ echo "style='margin-right: 80px;'"; } ?>>
            <!-- ============================================================== -->
            <!-- Inicio del FORMULARIO de gestión -->
            <!-- ============================================================== -->

            <div id="divider" class="row" style="display: none; width: 100%;">
                <div class="col-lg-12 <?php if($navegatorless){ echo "pull-left"; } ?>" >
                    <div class="input-group">
                        <input id="address" class="form-control form-control-line pull-left" type="text" placeholder="municipio, departamento, pais" style="width: 82%">
                        <button id="submit_ubi" class="btn input-group-addon-right waves-effect waves-light btn-success" type="button" style="width: 15%"><i class="mdi mdi-magnify"></i> Buscar</button>
                    </div>
                </div>
                <div class="col-lg-12 otro <?php if($navegatorless){ echo "pull-left"; } ?>" >
                    <div id="map" style="height: 430px;"></div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="hidden" id="latitud_oficina" name="latitud_oficina" required="" data-validation-required-message="Este campo es requerido">
                                <div class="help-block"></div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="longitud_oficina" name="longitud_oficina"  required="">
                </div>
            </div>

            <div class="col-lg-1"></div>
            <div class="col-lg-10" id="cnt_form" style="display: none;">
                
                    <div class="card">
                        <div class="card-header bg-success2" id="ttl_form">
                            <div class="card-actions text-white">
                                <a style="font-size: 16px;" onclick="cerrar_mantenimiento();"><i class="mdi mdi-window-close"></i></a>
                            </div>
                            <h4 class="card-title m-b-0 text-white">Listado de Oficinas</h4>
                        </div>
                        <div class="card-body b-t">
                            <div id="cnt_form1">
                            <?php echo form_open('', array('id' => 'formajax', 'style' => 'margin-top: 0px;', 'class' => 'm-t-40')); ?>
                                <input type="hidden" id="band" name="band" value="save">
                                <input type="hidden" id="id_oficina" name="id_oficina" value="<?php echo set_value('id_oficina'); ?>">
                                
                                <div align="right">
                                    <button type="button" class="btn waves-effect waves-light btn-success" onclick="$('#divider').show(300);"><i class="mdi mdi-map"></i> Ubicar oficina en mapa</button>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 <?php if($navegatorless){ echo "pull-left"; } ?>">
                                        <div class="form-group">
                                            <label for="nombre_oficina" class="font-weight-bold">Nombre de la Oficina: <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="nombre_oficina" name="nombre_oficina" required="" placeholder="Nombre de la Oficina" data-validation-required-message="Este campo es requerido">
                                           <div class="help-block"></div>
                                        </div>

                                    </div>
                                    <div class="col-lg-6 <?php if($navegatorless){ echo "pull-left"; } ?>">
                                        <div class="form-group">
                                            <label for="direccion_oficina" class="font-weight-bold">Dirección de la Oficina :<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="direccion_oficina" name="direccion_oficina" required="" placeholder="Dirección de la Oficina" data-validation-required-message="Este campo es requerido">
                                            <div class="help-block"></div> </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 <?php if($navegatorless){ echo "pull-left"; } ?>">
                                        <div class="form-group">
                                            <label for="id_departamento" class="font-weight-bold">Departamento de la Oficina: <span class="text-danger">*</span></label>
                                            <select id="id_departamento" name="id_departamento" class="select2" onchange="seleccionar_zona()" style="width: 100%">
                                                <option value="">[Seleccione]</option>
                                                <?php
                                                    $this->db->where("id_departamento <","15");
                                                    $seccion = $this->db->get("org_departamento");

                                                    if(!empty($seccion)){
                                                        foreach ($seccion->result() as $fila) {
                                                ?>
                                                    <option  value="<?php echo $fila->id_departamento ?>" onclick="','null')" > 
                                                        <?php echo preg_replace ('/[ ]+/', ' ',$fila->departamento) ?>
                                                    </option>;
                                                <?php
                                                        }
                                                    }
                                                ?>
                                            </select>
                                           <div class="help-block"></div>
                                        </div>

                                    </div>
                                     <div class="col-lg-4 <?php if($navegatorless){ echo "pull-left"; } ?>">
                                        <div class="form-group">
                                              <label for="id_municipio" class="font-weight-bold">Municipio de la Oficina: <span class="text-danger">*</span></label>
                                            <select id="id_municipio" name="id_municipio" class="select2" style="width: 100%" onchange="">
                                                <option value="">[Seleccione]</option>
                                                    <?php
                                                        //$this->db->where("id_departamento_pais",$id_departamento);
                                                        $seccion = $this->db->get("org_municipio");
                                                        if(!empty($seccion)){
                                                        foreach ($seccion->result() as $fila) {
                                                    ?>
                                                        <option  value="<?php echo $fila->id_municipio ?>"> 
                                                    <?php 
                                                        echo $fila->municipio;
                                                    ?>
                                                        </option>;
                                                    <?php
                                                        }
                                                        }
                                                    ?>
                                            </select>
                                            <div class="help-block"></div>
                                        </div>
                                    </div>
                                     <div class="col-lg-4 <?php if($navegatorless){ echo "pull-left"; } ?>">
                                        <div class="form-group">
                                              <label for="id_zona" class="font-weight-bold">Zona de la Oficina: <span class="text-danger">*</span></label>
                                            <select id="id_zona" name="id_zona" class="select2" style="width: 100%" onchange="">
                                                <option value="0">[Seleccione]</option>
                                                        <option  value="1">Zona Occidente</option>
                                                        <option  value="2">Zona Central</option>
                                                        <option  value="3">Zona Oriental</option>
                                            </select>
                                            <div class="help-block"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                  <div class="col-lg-6 <?php if($navegatorless){ echo "pull-left"; } ?>">
                                      <div class="form-group">
                                          <label for="jefe_oficina" class="font-weight-bold">Jefatura de dirección o regional: <span class="text-danger">*</span></label>
                                          <!--<input type="text" class="form-control" id="jefe_oficina" name="jefe_oficina" required="" placeholder="Nombre del Jefe de la Oficina" data-validation-required-message="Este campo es requerido"> -->
                                          <select id="jefe_oficina" name="jefe_oficina" class="select2"  style="width: 100%" onchange="buscarCorreo(this.value);">
                                            <option value="">[Elija la jefatura]</option>
                                            <?php 
                                                $empleado = $this->db->query("SELECT e.id_empleado, e.nr, UPPER(CONCAT_WS(' ', e.primer_nombre, e.segundo_nombre, e.tercer_nombre, e.primer_apellido, e.segundo_apellido, e.apellido_casada)) AS nombre_completo FROM sir_empleado AS e WHERE e.id_estado = '00001' ORDER BY e.primer_nombre, e.segundo_nombre, e.tercer_nombre, e.primer_apellido, e.segundo_apellido, e.apellido_casada");

                                                if($empleado->num_rows() > 0){
                                                    foreach ($empleado->result() as $fila) {              
                                                       echo '<option class="m-l-50" value="'.$fila->id_empleado.' '.$fila->primer_apellido.'">'.$fila->nombre_completo.'</option>';
                                                    }
                                                }
                                            ?>
                                        </select>
                                         <div class="help-block"></div>
                                      </div>
                                  </div>
                                  <div class="col-lg-6 <?php if($navegatorless){ echo "pull-left"; } ?>">
                                        <div class="form-group">
                                            <label for="email_oficina" class="font-weight-bold">Email :<span class="text-danger">*</span></label>
                                            <input type="email" class="form-control" id="email_oficina" name="email_oficina" required="" placeholder="Email" data-validation-required-message="Este campo es requerido">
                                            <div class="help-block"></div> </div>
                                    </div>
                                </div>

                                <button id="submit" type="submit" style="display: none;"></button>
                                <div align="right" id="btnadd">
                                    <button type="reset" class="btn waves-effect waves-light btn-success"><i class="mdi mdi-recycle"></i> Limpiar</button>
                                    <button type="submit" class="btn waves-effect waves-light btn-success2">Siguiente <i class="mdi mdi-chevron-right"></i></button>
                                </div>
                                <div align="right" id="btnedit" style="display: none;">
                                    <button type="reset" class="btn waves-effect waves-light btn-success"><i class="mdi mdi-recycle"></i> Limpiar</button>
                                    <button type="button" onclick="editar_horario()" class="btn waves-effect waves-light btn-info">Siguiente <i class="mdi mdi-chevron-right"></i></button>
                                </div>
                            <?php echo form_close(); ?>
                            </div>
                            <div id="cnt_form2" style="display: none;">
                                <div id="cnt_autorizadores"></div>
                                <div class="clearfix" align="right">
                                    <div class="pull-left">
                                        <?php echo generar_boton_normal(array('1'),"open_form","btn-default","mdi mdi-undo","Volver al paso 2","Volver"); ?>
                                    </div>
                                    <div class="pull-right">
                                        <button type="button" onclick="cerrar_mantenimiento()" class="btn btn-info">Finalizar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="col-lg-1"></div>
                <div class="col-lg-12" id="cnt-tabla">
            </div>

        </div>


        <!-- ============================================================== -->
        <div class="row">
            <!-- ============================================================== -->
            <!-- Inicio del FORMULARIO de gestión -->
            <!-- ============================================================== -->
            <div class="col-lg-1"></div>
            <div class="col-lg-10" id="cnt_form_phone" style="display: none;">
                <div class="card">
                    <div class="card-header bg-success2" id="ttl_form">
                        <div class="card-actions text-white">
                            <a style="font-size: 16px;" onclick="cerrar_mantenimiento_phone();"><i class="mdi mdi-window-close"></i></a>
                        </div>
                        <h4 class="card-title m-b-0 text-white">Listado de Telefonos</h4>
                    </div>
                    <div class="card-body b-t">

                        <?php echo form_open('', array('id' => 'form_phone', 'style' => 'margin-top: 0px;', 'class' => 'm-t-40')); ?>
                            <input type="hidden" id="band_phone" name="band_phone" value="save">
                            <input type="hidden" id="id_vyp_oficinas_telefono" name="id_vyp_oficinas_telefono">
                            <input type="hidden" id="id_oficina_vyp_oficnas_telefono" name="id_oficina_vyp_oficnas_telefono">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="telefono_vyp_oficnas_telefono" class="font-weight-bold">Teléfono de la Oficina: <span class="text-danger">*</span></label>
                                        <input type="tel" class="form-control" id="telefono_vyp_oficnas_telefono" name="telefono_vyp_oficnas_telefono"  pattern="^(7|6|2)[0-9]{3}[-][0-9]{4}" required="" placeholder="Teléfono de la Oficina" data-validation-required-message="Este campo es requerido">
                                       <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>
                           
                            <button id="submit_phone" name="submit_phone" type="submit" style="display: none;"></button>
                            <div align="right" id="btnadd_phone">
                                <button type="reset" class="btn waves-effect waves-light btn-success"><i class="mdi mdi-recycle"></i> Limpiar</button>
                                <button type="submit" class="btn waves-effect waves-light btn-success2"><i class="mdi mdi-plus"></i> Guardar</button>
                            </div>
                            <div align="right" id="btnedit_phone" style="display: none;">
                                <button type="reset" class="btn waves-effect waves-light btn-success"><i class="mdi mdi-recycle"></i> Limpiar</button>
                                <button type="button" onclick="editar_oficina_phone()" class="btn waves-effect waves-light btn-info"><i class="mdi mdi-pencil"></i> Editar</button>
                            </div>

                        <?php echo form_close(); ?>
                    </div>

                </div>
            </div>
            <div class="col-lg-1"></div>
                <div class="col-lg-12" id="cnt-tabla-phone">
                    
            </div>

        </div>



    </div>
</div>

<div id="modal_autorizador" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Gestión de personas que autorizan viáticos y pasajes</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <?php echo form_open('', array('id' => 'formajax2', 'style' => 'margin-top: 0px;', 'class' => 'm-t-40')); ?>
            <div class="modal-body">
                <input type="hidden" name="id_oficina_autorizador" id="id_oficina_autorizador">
                <input type="hidden" name="band_autorizador" id="band_autorizador" value="save">
                <div class="row">
                    <div class="form-group col-lg-12">
                        <h5>Autorizador:</h5>
                        <div class="controls">
                            <select id="nr_autorizador" name="nr_autorizador" class="select2"  style="width: 100%">
                                <option value="">[Elija la persona que autoriza]</option>
                                <?php 
                                    $empleado = $this->db->query("SELECT e.id_empleado, e.nr, UPPER(CONCAT_WS(' ', e.primer_nombre, e.segundo_nombre, e.tercer_nombre, e.primer_apellido, e.segundo_apellido, e.apellido_casada)) AS nombre_completo FROM sir_empleado AS e WHERE e.id_estado = '00001' ORDER BY e.primer_nombre, e.segundo_nombre, e.tercer_nombre, e.primer_apellido, e.segundo_apellido, e.apellido_casada");

                                    if($empleado->num_rows() > 0){
                                        foreach ($empleado->result() as $fila) {              
                                           echo '<option class="m-l-50" value="'.$fila->nr.' '.$fila->primer_apellido.'">'.$fila->nombre_completo.'</option>';
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-12">
                        <h5>Sistema:</h5>
                        <div class="controls">
                            <select id="id_sistema" name="id_sistema" class="select2"  style="width: 100%">
                                <option value="">[Elija el sistema]</option>
                                <?php 
                                    $sistema = $this->db->query("SELECT * FROM org_sistema");

                                    if($sistema->num_rows() > 0){
                                        foreach ($sistema->result() as $filas) { 
                                           echo '<option class="m-l-50" value="'.$filas->id_sistema.'">'.$filas->nombre_sistema.'</option>';
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancelar</button>
                <button type="submit" id="submit2" class="btn btn-info waves-effect text-white">Aceptar</button>
            </div>
            <?php echo form_close(); ?>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- sample modal content -->
<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">¡La oficina posee dependencias!</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <p id="resultado"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info waves-effect" data-dismiss="modal">Aceptar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script>

$(function(){
    $("#formajax").on("submit", function(e){
        e.preventDefault();
        var f = $(this);
        var formData = new FormData(document.getElementById("formajax"));
        formData.append("longitud_oficina", $("#longitud_oficina").val());
        formData.append("latitud_oficina", $("#latitud_oficina").val());
        
        $.ajax({
            url: "<?php echo site_url(); ?>/configuraciones/oficinas/gestionar_oficinas",
            type: "post",
            dataType: "html",
            data: formData,
            cache: false,
            contentType: false,
            processData: false
        })
        .done(function(res){
            var res = res.split(",");
            if(res[0] == "exito"){
                $("#divider").hide(300);
                if($("#band").val() == "save"){
                    cambiar_editar(res[1], $("#nombre_oficina").val(),$("#direccion_oficina").val(),$("#jefe_oficina").val(),$("#email_oficina").val(),$("#latitud_oficina").val(),$("#longitud_oficina").val(),$("#id_departamento").val(),$("#id_municipio").val(),$("#id_zona").val(),'edit');
                    $.toast({ heading: '¡Registro exitoso!', text: 'Oficina registrada', position: 'top-right', loaderBg:'#000', icon: 'success', hideAfter: 4000, stack: 6 });
                    tabla_oficina_autorizador();
                }else if($("#band").val() == "edit"){
                    $.toast({ heading: '¡Modificación exitosa!', text: 'Oficina modificada', position: 'top-right', loaderBg:'#000', icon: 'success', hideAfter: 4000, stack: 6 });
                    tabla_oficina_autorizador();
                }else{
                    swal({ title: "¡Borrado exitoso!", type: "success", showConfirmButton: true });
                }
                tablaoficinas();$("#band").val('save');
            }else if(res=="duplicado"){
                swal({ title: "¡Ups! Error", text: "Oficina ya existe.", type: "error", showConfirmButton: true });
            }else{
                swal({ title: "¡Ups! Error", text: "Intentalo nuevamente.", type: "error", showConfirmButton: true });
            }
        });
    });

    $("#formajax2").on("submit", function(e){
        e.preventDefault();
        var f = $(this);
        var formData = new FormData(document.getElementById("formajax2"));
        formData.append("band", $("#band_autorizador").val());
        formData.append("id_oficina", $("#id_oficina").val());
        
        $.ajax({
            url: "<?php echo site_url(); ?>/configuraciones/oficinas/gestionar_autorizador",
            type: "post",
            dataType: "html",
            data: formData,
            cache: false,
            contentType: false,
            processData: false
        })
        .done(function(res){
            console.log(res)
            if(res == "exito"){
                if($("#band_autorizador").val() == "save"){
                    $.toast({ heading: '¡Registro exitoso!', text: 'Autorizador registrado', position: 'top-right', loaderBg:'#000', icon: 'success', hideAfter: 4000, stack: 6 });
                }else if($("#band_autorizador").val() == "edit"){
                    $.toast({ heading: '¡Modificación exitosa!', text: 'Autorizador modificado', position: 'top-right', loaderBg:'#000', icon: 'success', hideAfter: 4000, stack: 6 });
                }else{
                    $.toast({ heading: 'Borrado exitoso!', text: 'Autorizador eliminado', position: 'top-right', loaderBg:'#000', icon: 'success', hideAfter: 4000, stack: 6 });
                }
                $("#modal_autorizador").modal("hide");
                tabla_oficina_autorizador();
            }else{
                swal({ title: "¡Ups! Error", text: "Intentalo nuevamente.", type: "error", showConfirmButton: true });
            }
        });
    });


    $("#form_phone").on("submit", function(e){
        e.preventDefault();
    
        var form_Data = new FormData(document.getElementById("form_phone"));
        form_Data.append("dato", "valor");

        $.ajax({
            url: "<?php echo site_url(); ?>/configuraciones/oficinas/gestionar_oficinas_telefonos",
            type: "post",
            dataType: "html",
            data: form_Data,
            cache: false,
            contentType: false,
            processData: false
        })
        .done(function(res){
            if(res == "exito"){
                cerrar_mantenimiento_phone();
                if($("#band_phone").val() == "save"){
                    swal({ title: "¡Registro exitoso!", type: "success", showConfirmButton: true });
                }else if($("#band_phone").val() == "edit"){
                    swal({ title: "¡Modificación exitosa!", type: "success", showConfirmButton: true });
                }else{
                    swal({ title: "¡Borrado exitoso!", type: "success", showConfirmButton: true });
                }
                tablaoficinas_phone(document.getElementById('id_oficina_vyp_oficnas_telefono').value);
                $("#band_phone").val('save');
            }else{
                swal({ title: "¡Ups! Error", text: "Intentalo nuevamente.", type: "error", showConfirmButton: true });
            }
        });

    });
});

</script>
<script>
      var markersO = [];
      var markersD = [];
      var distancia = "";

      function initMap(latitud_oficina,longitud_oficina) {
        var bounds = new google.maps.LatLngBounds;
        var markersArray = [];

        var origin1 = "";


        if(latitud_oficina){
            var map = new google.maps.Map(document.getElementById('map'), {
                center:  new google.maps.LatLng(latitud_oficina, longitud_oficina),
                zoom: 17
            });
            addMarker_origen(new google.maps.LatLng(latitud_oficina, longitud_oficina),map);
        }else{
            var map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: 13.705542923582362, lng: -89.20029401779175},
                zoom: 14
            });
        }
        var geocoder = new google.maps.Geocoder;

        var service = new google.maps.DistanceMatrixService;
         var directionsDisplay = new google.maps.DirectionsRenderer({
          map: map
        });
        var directionsService = new google.maps.DirectionsService();

        map.addListener('click', function(e) {
            deleteMarkers_O();
            addMarker_origen(e.latLng, map);
            origin1=e.latLng;
            var cadena = String(origin1);
            //var cadena = "(12.2432343442,-34.42342442444)";
            var separador= ",";
            arregloDeSubCadenas = cadena.split(separador);
            arreglo1 = arregloDeSubCadenas[0].substring(1);

            pos=arregloDeSubCadenas[1].indexOf(')');
            arreglo2 = arregloDeSubCadenas[1].substring(0,pos);
            $("#latitud_oficina").val(arreglo1);
            $("#longitud_oficina").val(arreglo2);

            geocoder.geocode({
            'location': origin1
          }, function(results, status) {
            if (status === google.maps.GeocoderStatus.OK) {
              if (results[1]) {
                var direccion = results[1].formatted_address;
                $("#direccion_oficina").val(direccion);
                var ultimacoma = direccion.lastIndexOf(",");
                direccion = direccion.substring(0,ultimacoma);

                var pultimacoma = direccion.lastIndexOf(",");

                if(pultimacoma == -1){
                    direccion = direccion.trim();
                }else{
                    direccion = direccion.substring(pultimacoma+1);
                    direccion = direccion.trim();
                }
                var municipio = direccion;
                
                buscar_id(municipio);

              } else {
                window.alert('No hay resultados');
              }
            } else {
              window.alert('Geocoder failed due to: ' + status);
            }
          });

        });//termina event




        document.getElementById('submit_ubi').addEventListener('click', function() {
          geocodeAddress(geocoder, map);

        });
      }




      function addMarker_origen(location, map) {
        // Add the marker at the clicked location, and add the next-available label

        var marker = new google.maps.Marker({
          position: location,//labels[labelIndex++ % labels.length]
          map: map,
          animation: google.maps.Animation.DROP
        });

        markersO.push(marker);

      }

      function deleteMarkers_O() {
        clearMarkers_O();
        markersO = [];
      }
      function setMapOnAll_O(map) {
        for (var i = 0; i < markersO.length; i++) {
          markersO[i].setMap(map);
        }
      }

      // Removes the markers from the map, but keeps them in the array.
      function clearMarkers_O() {
        setMapOnAll_O(null);
      }

      function geocodeAddress(geocoder, resultsMap) {

        var address = document.getElementById('address').value;
        geocoder.geocode({'address': address}, function(results, status) {
          if (status === google.maps.GeocoderStatus.OK) {
            resultsMap.setCenter(results[0].geometry.location);
            //addMarker_origen(results[0].geometry.location, resultsMap);
          } else {
            swal({ title: "¡Ubicación no encontrada!", text: "Ingrese una dirección válida.", type: "error", showConfirmButton: true });
          }
        });
      }
</script>
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAD_RReCmr9PVaMwEPM1nfe5T7a1bSSR3Q&callback=initMap">
</script>
