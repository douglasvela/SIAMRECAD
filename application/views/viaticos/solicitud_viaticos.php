<style>

    #map {
        height: 450px;
    }

    #output {
        font-size: 14px;
    }
  
    .controlers {
        margin-top: 10px;
        border: 1px solid transparent;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        height: 32px;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
    }

    #search_input {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 500px;
    }

    #search_input:focus {
        border-color: #4d90fe;
    }

    .list-task .task-done span {
        text-decoration: line-through;
    }
</style>

<script type="text/javascript">
    /*****************************************************************************************************
    ******************************* Recuperando los horarios de viaticos ********************************/

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
                combo_actividad_realizada();
                $('#myTable').DataTable();
                $('[data-toggle="tooltip"]').tooltip();
            }
        }
        xmlhttpB.open("GET","<?php echo site_url(); ?>/viaticos/solicitud_viatico/tabla_solicitudes",true);
        xmlhttpB.send(); 
    }

    function combo_actividad_realizada(){
        if(window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp_municipio=new XMLHttpRequest();
        }else{// code for IE6, IE5
            xmlhttp_municipio=new ActiveXObject("Microsoft.XMLHTTPB");
        }

        xmlhttp_municipio.onreadystatechange=function(){
            if (xmlhttp_municipio.readyState==4 && xmlhttp_municipio.status==200){
                  document.getElementById("cnt_combo_actividad").innerHTML=xmlhttp_municipio.responseText;
                  $(".select2").select2();
            }
        }
        xmlhttp_municipio.open("GET","<?php echo site_url(); ?>/viaticos/solicitud_viatico/combo_actividad_realizada",true);
        xmlhttp_municipio.send();
    }

    function cambiar_nuevo(){
        $("#id_mision").val("");
        $("#nombre_empresa").val("");
        $("#direccion_empresa").val("");
        $("#actividad").val("").trigger('change.select2');
        $("#detalle_actividad").val('');
        $("#band").val("save");

        $("#ttl_form").addClass("bg-success");
        $("#ttl_form").removeClass("bg-info");

        $("#btnadd").show(0);
        $("#btnedit").hide(0);

        $("#cnt_tabla").hide(0);
        $("#cnt_form").show(0);

        //form_mision();

        $("#ttl_form").children("h4").html("<span class='mdi mdi-plus'></span> Nueva solicitud de viáticos y pasajes");
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
        <a id="dirigir" name="dirigir" href="#cnt_mapa"></a>
        
        <div  class="row" id="cnt_mapa" style="height: 0px; opacity: 0;">
            <div class="col-lg-12 col-md-12" >
                    <div id="input-div"></div>
                    <div id="map" ></div>                       
            </div>
            <div class="col-lg-12">
                <div class="card" style="margin-bottom: 15px;">
                   <p style="margin: 5px 10px 5px 10px;"><span id="output"><b>Destino: </b>Los resultados aparecerán aquí</span></p>
                </div>
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

                        <div id="cnt_observaciones"></div>
                        <!-- ============================================================== -->
                        <!-- Inicio del FORMULARIO DATOS DE MISIÓN -->
                        <!-- ============================================================== -->
                        <div id="cnt_mision">

                            <h3 class="box-title" style="margin: 0px;">
                                <button type="button" class="btn waves-effect waves-light btn-lg btn-danger" style="padding: 1px 10px 1px 10px;">Paso 1</button>&emsp;
                                Datos de la misión
                            </h3>
                            <hr class="m-t-0 m-b-30">
                            <?php echo form_open('', array('id' => 'formajax', 'style' => 'margin-top: 0px;', 'class' => 'm-t-40')); ?>
                            <input type="hidden" id="band" name="band" value="save">
                            <input type="hidden" id="id_mision" name="id_mision" value="">
                            


                            <input type="hidden" id="nr_jefe_inmediato" name="nr_jefe_inmediato" value="">
                            <input type="hidden" id="nr_jefe_regional" name="nr_jefe_regional" value="">
                            <div class="row">
                                <div class="form-group col-lg-6"> 
			                        <h5>Empleado: <span class="text-danger">*</span></h5>                           
			                        <select id="nr" name="nr" class="select2" style="width: 100%" required="" onchange="cambiar_informacion();">
			                            <option value="">[Elija el empleado]</option>
			                            <?php 
			                                $otro_empleado = $this->db->query("SELECT e.id_empleado, e.nr, UPPER(CONCAT_WS(' ', e.primer_nombre, e.segundo_nombre, e.tercer_nombre, e.primer_apellido, e.segundo_apellido, e.apellido_casada)) AS nombre_completo FROM sir_empleado AS e WHERE e.id_estado = '00001' ORDER BY e.primer_nombre, e.segundo_nombre, e.tercer_nombre, e.primer_apellido, e.segundo_apellido, e.apellido_casada");
			                                if($otro_empleado->num_rows() > 0){
			                                    foreach ($otro_empleado->result() as $fila) {              
			                                       echo '<option class="m-l-50" value="'.$fila->nr.'">'.$fila->nombre_completo.' - '.$fila->nr.'</option>';
			                                    }
			                                }
			                            ?>
			                        </select>
			                        <div class="help-block"></div>
			                    </div>
                                <div class="form-group col-lg-6">   
                                    <h5>Fecha de misión: <span class="text-danger">*</span></h5>
                                    <!--<input type="text" pattern="\d{1,2}-\d{1,2}-\d{4}" data-date-end-date="0d" data-date-start-date="-5d" onkeyup="FECHA('fecha_mision')" required="" value="<?php echo date('d-m-Y'); ?>" class="form-control" id="fecha_mision" name="fecha_mision" placeholder="dd/mm/yyyy">
                                    <div class="help-block"></div>-->
                                    <div class="input-daterange input-group" id="date-range">
                                        <input type="text" class="form-control" name="start" />
                                        <span class="input-group-addon bg-info b-0 text-white">to</span>
                                        <input type="text" class="form-control" name="end" />
                                    </div>
                                </div>
                            </div>

                            <div class="row" id="cnt_combo_actividad">
                                                               
                            </div>

                            <div class="row">
                                <div class="form-group col-lg-12" style="height: 83px;">
                                    <h5>Detalle de la actividad: <span class="text-danger">*</span></h5>
                                    <textarea type="text" onkeyup="TEXTO('actividad',3,500);" id="detalle_actividad" name="detalle_actividad" class="form-control" required="" placeholder="Describa la actividad realizada en la misión" minlength="3" data-validation-required-message="Este campo es requerido"></textarea>
                                    <div class="help-block"></div>
                                </div>
                            </div>

                            <button type="submit" id="submit_button" style="display: none;" class="btn waves-effect waves-light btn-success2">Continuar <i class="mdi mdi-chevron-right"></i></button>

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
                                    <label for="destino_municipio" onclick="form_folleto_viaticos();">Municipio</label>&emsp;
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
                                <button type="button" onclick="verficar_oficina_destino();" class="btn waves-effect waves-light btn-success2">Continuar <i class="mdi mdi-chevron-right"></i></button>
                            </div>

                        </div>
                        <!-- ============================================================== -->
                        <!-- Fin del FORMULARIO EMPRESAS VISITADAS -->
                        <!-- ============================================================== -->


                        <!-- ============================================================== -->
                        <!-- Inicio del FORMULARIO DE VIÁTICOS Y PASAJES -->
                        <!-- ============================================================== -->
                        <div id="cnt_viaticos" style="display: none;">
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


<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Viáticos presentados</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body" id="contenedor_viatico">
                <p>Seleccione los viáticos a cobrar.</p>
                <?php 

                    $horarios = $this->db->get("vyp_horario_viatico");

                    if(!empty($horarios)){
                        foreach ($horarios->result() as $fila) {
                ?>
                    <div class="form-check" id="cnt<?php echo $fila->id_horario_viatico; ?>">
                        <label class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" value="<?php echo $fila->id_horario_viatico; ?>">
                            <span class="custom-control-indicator"></span>
                            <span class="custom-control-description"><?php echo $fila->descripcion; ?></span>
                        </label>
                    </div>
                <?php
                        }
                    }
                ?>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancelar</button>
                <button type="button" onclick="recorrer_modal();" class="btn btn-success waves-effect">Aceptar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<div id="modal_perfil" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Faltan datos en tu perfil</h4>
            </div>
            <div class="modal-body" id="contenedor_viatico">
                <h4 style="margin-bottom: 20px;">Lamentamos los inconvenientes. <span class="mdi mdi-emoticon-sad" style="font-size: 35px;"></span></h4>

                <p align="justify">Parece que a tu perfil le faltan datos que son requeridos para la elaboración de solicitud de viáticos y pasajes, por favor haz clic en el botón "ACEPTAR" y completa tu perfil para poder acceder a esta sección del sistema.</p>

            </div>
            <div class="modal-footer">
                <a href="<?php echo site_url().'/cuenta/perfil'; ?>" class="btn btn-info waves-effect text-white">ACEPTAR</a>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div id="modal_actividad" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <?php echo form_open('', array('id' => 'form_actividades', 'style' => 'margin-top: 0px;', 'class' => 'm-t-40')); ?>
            <div class="modal-header">
                <h4 class="modal-title">Nueva actividad realizada</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="form-group col-lg-12">
                    <h5>Actividad realizada: <span class="text-danger">*</span></h5>
                    <input type="text" id="nueva_actividad" name="nueva_actividad" class="form-control" required="" minlength="3" data-validation-required-message="Ingrese la actividad realizada">
                    <div class="help-block"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-success waves-effect">Limpiar</button>
                <button type="submit" class="btn btn-success2 waves-effect">Registrar</button>
            </div>
            <?php echo form_close(); ?>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<script>
$(function(){  

    $(document).ready(function(){         
        $('#fecha_mision').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true,
            todayHighlight: true
        });

        $('#dirigir').click(function(){ //Id del elemento cliqueable
            $('html, body').animate({scrollTop:0}, 1000);
            return false;
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
                    buscar_idmision();
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
        var tipo = $('input[name=r_destino]:checked').val();

        if($('#distancia').prop("readonly")){
            var existe = "true";
        }else{
            var existe = "false";   
        }

        if(tipo == "destino_mapa"){
            var latitud = LatDestino.lat();
            var longitud = LatDestino.lng();
        }else{
            var latitud = "";
            var longitud = "";
        }

        if(tipo == "destino_oficina"){
            var descripcion = "<?php echo $filaofi->nombre_oficina; ?>"+" - "+$("#departamento option:selected").text();
        }else{            
            var descripcion = "<?php echo $filaofi->nombre_oficina; ?>"+" - "+$("#departamento option:selected").text()+"/"+$("#municipio option:selected").text();
        }
        var formData = {
            "id_mision" : $("#id_mision").val(),
            "departamento" : $("#departamento").val(),
            "municipio" : $("#municipio").val(),
            "nombre_empresa" : $("#nombre_empresa").val(),
            "direccion_empresa" : $("#direccion_empresa").val(),
            "distancia" : $("#distancia").val(),
            "tipo" : tipo,
            "band" : $("#band2").val(),
            "descripcion_destino" : descripcion,
            "id_oficina_origen" : $("#id_oficina_origen").val(),
            "latitud_destino" : latitud,
            "longitud_destino" : longitud,
            "id_destino" : $("#id_destino_vyp").val(),
            "existe" : existe,
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


    $("#form_actividades").on("submit", function(e){
        e.preventDefault();      
        var formData = new FormData(document.getElementById("form_actividades"));
        $.ajax({
                type:  'POST',
                url:   '<?php echo site_url(); ?>/viatico/solicitud/nueva_actividad',
                dataType: "html",
                data: formData,
                cache: false,
                contentType: false,
                processData: false
        })
        .done(function(data){ //una vez que el archivo recibe el request lo procesa y lo devuelve
            if(data == "exito"){
                combo_actividad_realizada();
                $("#modal_actividad").modal('hide');
                swal({ title: "¡Registro exitoso!", type: "success", showConfirmButton: true });
            }else if(data == "duplicado"){
                swal({ title: "¡Ya existe!", text: "La actividad ya está registrada.", type: "warning", showConfirmButton: true });
            }else{
                swal({ title: "¡Ups! Error", text: "Intentalo nuevamente.", type: "error", showConfirmButton: true });
            }
        });
    });

});

</script>


<script>

    var direccion_mapa;
    var distancia_total_mapa;
    var distancia_carretera_mapa;
    var direccion_departamento_mapa;

    var LatDestino = "";    // Guardará el destino buscado por el usuario

    function initMap() {
        var LatOrigen = {       //Contiene la ubicación de la oficina de origen del usuario
            lat: <?php echo $filaofi->latitud_oficina; ?>, 
            lng: <?php echo $filaofi->longitud_oficina; ?>
        };

        var markersD = [];      //Se le agregarán las marcas de punto del destino
        var flightPath = ""; //Agregado para dibujar linea recta (Para mostrar distancia lineal)
        var distancia_faltante = "";    //Servirá para agregar la distancia faltante al punto buscado, ya que google
                                        //solo recorre calles y no siempre logra llegar al punto buscado

        var map = new google.maps.Map(document.getElementById('map'), { //Inicia el mapa google en el lugar de origen
            zoom: 12,
            center: LatOrigen,            
            streetViewControl: false,
            zoomControl: true,
            zoomControlOptions: {
                position: google.maps.ControlPosition.RIGHT_CENTER
            },
        });

        var geocoder = new google.maps.Geocoder;    //Localiza lugares a traves de la geocodificación
        var geocoder2 = new google.maps.Geocoder;    //Localiza lugares a traves de la geocodificación
        var service = new google.maps.DistanceMatrixService;    //Permite calcular la distancia entre lugares
        var directionsService = new google.maps.DirectionsService();    //Encuentra lugares y detalla recorridos

        var centerControlDiv = document.createElement('div');
        var centerControl = new CenterControl(centerControlDiv, map);
        centerControlDiv.index = 1;
        map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(centerControlDiv);

        var input = document.getElementById('search_input');    //Obteniendo buscador de lugares
        var searchBox = new google.maps.places.SearchBox(input);    //Convirtiendo a objeto google search
        var markers = [];   //Contendrá la marca de punto del lugar buscado


        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input); //agregá el buscador de lugares

        map.addListener('bounds_changed', function() {  //Detecta cambios en el zoom del mapa
            searchBox.setBounds(map.getBounds()); //Adapta bounds del input search
        });

        searchBox.addListener('places_changed', function() {    //Realiza la busqueda de un lugar con el input search
            var places = searchBox.getPlaces();

            if (places.length == 0) {
                return;
            }

            // Borra las marcas de busquedas antiguas.
            markers.forEach(function(marker) {
                marker.setMap(null);
            });
            markers = [];

            // For each place, get the icon, name and location.
            var bounds = new google.maps.LatLngBounds();
            places.forEach(function(place) {
                if (!place.geometry) {
                    console.log("Returned place contains no geometry");
                    return;
                }
                var icon = {
                    url: place.icon,
                    size: new google.maps.Size(71, 71),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(17, 34),
                    scaledSize: new google.maps.Size(25, 25)
                };

                // Create a marker for each place.
                markers.push(new google.maps.Marker({
                    map: map,
                    icon: icon,
                    title: place.name,
                    position: place.geometry.location
                }));

                if (place.geometry.viewport) {
                    // Only geocodes have viewport.
                    bounds.union(place.geometry.viewport);
                } else {
                    bounds.extend(place.geometry.location);
                }
            });
            map.fitBounds(bounds);
        });

        var directionsDisplay = new google.maps.DirectionsRenderer({
            map: map,
            suppressMarkers:true
        });

        var marker = new google.maps.Marker({
            position: LatOrigen,
            map: map,
            title: 'Origen: <?php echo $filaofi->nombre_oficina; ?>',
            icon: '<?php echo base_url()."/assets/images/marker_origen.png"; ?>'
        });

        map.addListener('click', function(e) {
            LatDestino = e.latLng;
            deleteMarkers_D();
            addMarker_destino(e.latLng, map);
            pinta_recorrido();
        });

        if(LatDestino != ""){            
            deleteMarkers_D();
            addMarker_destino(LatDestino, map);
            pinta_recorrido()
        }

        function addMarker_destino(location, map) {
            var address = "Dirección desconocida";
            geocoder2.geocode({'latLng': location}, function(results, status) {
                direccion_departamento_mapa = results[1].formatted_address;
                if (status == google.maps.GeocoderStatus.OK) {
                    address = results[0]['formatted_address'];
                    address = address.replace('Unnamed Road', "Carretera desconocida")

                    // Add the marker at the clicked location, and add the next-available label
                    var marker = new google.maps.Marker({
                        position: location,//labels[labelIndex++ % labels.length]
                        map: map,
                        animation: google.maps.Animation.DROP,
                        title: "Destino: "+address
                    });
                    markersD.push(marker);
                }else{
                    var marker = new google.maps.Marker({
                        position: location,//labels[labelIndex++ % labels.length]
                        map: map,
                        animation: google.maps.Animation.DROP,
                        title: "Destino: "+address
                    });
                    markersD.push(marker);
                }
            });
        }

        function deleteMarkers_D() {
            clearMarkers_D();
            markersD = [];
        }
        function setMapOnAll_D(map) {
            for (var i = 0; i < markersD.length; i++) {
                markersD[i].setMap(map);
            }
        }

        // Removes the markers from the map, but keeps them in the array.
        function clearMarkers_D() {
            setMapOnAll_D(null);
        }

        function calcula_distancia(distance){
            service.getDistanceMatrix({
            origins: [LatOrigen],
            destinations: [LatDestino],
            travelMode: 'DRIVING',
            unitSystem: google.maps.UnitSystem.METRIC,
            avoidHighways: false,
            avoidTolls: false
            }, function(response, status) {
                if (status !== 'OK') {
                    alert('Error was: ' + status);
                } else {
                    var originList = response.originAddresses;
                    var destinationList = response.destinationAddresses;

                    var outputDiv = document.getElementById('output');
                    outputDiv.innerHTML = '';

                    var showGeocodedAddressOnMap = function(asDestination) { //si se quita da error
                        return function(results, status) {
                            if (status === 'OK') {
                                //map.fitBounds(bounds.extend(results[0].geometry.location));
                            } else {
                              //alert('Geocode no tuvo éxito debido a: ' + status);
                            }
                        };
                    };

                    for (var i = 0; i < originList.length; i++) {
                        var results = response.rows[i].elements;
                        geocoder.geocode({'address': originList[i]}, showGeocodedAddressOnMap(false));
                        for (var j = 0; j < results.length; j++) {
                            geocoder.geocode({'address': destinationList[j]}, showGeocodedAddressOnMap(false));

                            var distancia_carretera = results[j].distance.text.replace(',', ".");
                            var distancia_total = (parseFloat(distancia_carretera) + parseFloat(distance)).toFixed(2);
                            var direccion = destinationList[j].replace('Unnamed Road', "Carretera desconocida");

                            outputDiv.innerHTML += "<span class='pull-left'><b>Destino: </b>"+direccion+"<br></span>";
                            outputDiv.innerHTML += "<span class='pull-right'><b>Distancia: </b>"+distancia_total+" Km</span>";

                            direccion_mapa = direccion;
                            distancia_total_mapa = distancia_total;
                            distancia_carretera_mapa = distancia_carretera;
                        }
                    }
                }
            });
        }

        function pinta_recorrido(){
            var request = {
                origin: LatOrigen,
                destination: LatDestino,
                travelMode: 'DRIVING'
            };

            // Pass the directions request to the directions service.        
            directionsService.route(request, function(response, status) {


                var summaryPanel = "";
                var route = response.routes[0];
                    for (var i = 0; i < route.legs.length; i++) {
                        /**************************************************************************************/
                        /***************** Inicio para dibujar y calcular distancia lineal ********************/
                        if(flightPath != ""){
                            flightPath.setMap(null);
                        }

                        flightPath = new google.maps.Polyline({
                            path: [route.legs[i].end_location, LatDestino],
                            strokeColor: '#73b9ff',
                            strokeOpacity: 1.0,
                            strokeWeight: 6,
                            fillColor: '#7bb6ee',
                            fillOpacity: 1.0
                        });

                        flightPath.setMap(map);

                        var distancia_faltante = google.maps.geometry.spherical.computeDistanceBetween(route.legs[i].end_location, LatDestino);
                        if(distancia_faltante != 0){
                            distancia_faltante = parseFloat(distancia_faltante/1000).toFixed(2);
                        }

                        calcula_distancia(distancia_faltante);

                        /***************** Fin de dibujo y cálculo de distancia lineal ********************/
                        /**********************************************************************************/
                    }
                if (status == 'OK') {
                    // Muestra la ruta del punto de origen al punto destino.
                    directionsDisplay.setDirections(response);
                }
            });
        }

        function CenterControl(controlDiv, map) {
            // Set CSS for the control border.
            var controlUI = document.createElement('div');
            controlUI.style.backgroundColor = '#fc4b6c';
            controlUI.style.border = '2px solid #fc4b6c';
            controlUI.style.color = '2px solid #fff';
            controlUI.style.borderRadius = '3px';
            controlUI.style.boxShadow = '0 2px 6px rgba(0,0,0,.3)';
            controlUI.style.cursor = 'pointer';
            controlUI.style.marginBottom = '10px';
            controlUI.style.marginRight = '10px';
            controlUI.style.textAlign = 'center';
            controlUI.title = 'Clic para finalizar la búsqueda y ocultar mapa';
            controlDiv.appendChild(controlUI);

            // Set CSS for the control interior.
            var controlText = document.createElement('div');
            controlText.style.color = '#fff';
            controlText.style.fontFamily = 'Roboto,Arial,sans-serif';
            controlText.style.fontSize = '16px';
            controlText.style.lineHeight = '30px';
            controlText.style.paddingLeft = '5px';
            controlText.style.paddingRight = '5px';
            controlText.innerHTML = 'Finalizar búsqueda';
            controlUI.appendChild(controlText);

            // Setup the click event listeners: simply set the map to Chicago.
            controlUI.addEventListener('click', function() {
                finalizarBusquedaMapa();
            });

        }

    }
    </script>
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA4M5mZA-qqtRgioLuZ4Kyg6ojl71EJ3ek&libraries=places">
</script>