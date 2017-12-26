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

    function cambiar_editar(id_oficina,nombre_oficina,direccion_oficina,jefe_oficina,email_oficina,latitud_oficina,longitud_oficina,id_departamento,id_municipio,bandera){
        $("#id_oficina").val(id_oficina);
        $("#nombre_oficina").val(nombre_oficina);
        $("#direccion_oficina").val(direccion_oficina);
        $("#latitud_oficina").val(latitud_oficina);
        $("#longitud_oficina").val(longitud_oficina);
        $("#jefe_oficina").val(jefe_oficina);
        $("#email_oficina").val(email_oficina);
         $("#id_departamento").val(id_departamento);
         buscarMunicipio(id_departamento,id_municipio);
        if(bandera == "edit"){
            $("#ttl_form").removeClass("bg-success");
            $("#ttl_form").addClass("bg-info");
            $("#btnadd").hide(0);
            $("#btnedit").show(0);
            $("#cnt-tabla").hide(0);
            $("#cnt_form").show(0);
            initMap(latitud_oficina,longitud_oficina);
            $("#ttl_form").children("h4").html("<span class='fa fa-wrench'></span> Editar Oficina");
        }else{
            eliminar_horario();
        }
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
         $("#id_departamento").val("");
         buscarMunicipio();
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
        tablaoficinas();
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
        $( "#cnt-tabla" ).load("<?php echo site_url(); ?>/configuraciones/oficinas/tabla_oficinas", function() {
            $('#myTable').DataTable();
            $('[data-toggle="tooltip"]').tooltip();
            buscarMunicipio(0,"null");
        });  
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
                $("#id_municipio").val($(options[i]).val());
            }
        }
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
                        <h4 class="card-title m-b-0 text-white">Listado de Oficinas</h4>
                    </div>
                    <div class="card-body b-t">

                        <?php echo form_open('', array('id' => 'formajax', 'style' => 'margin-top: 0px;', 'class' => 'm-t-40', 'novalidate' => '')); ?>
                            <input type="hidden" id="band" name="band" value="save">
                            <input type="hidden" id="id_oficina" name="id_oficina" value="<?php echo set_value('id_oficina'); ?>">
                            


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nombre_oficina" class="font-weight-bold">Nombre de la Oficina: <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="nombre_oficina" name="nombre_oficina" required="" placeholder="Nombre de la Oficina" data-validation-required-message="Este campo es requerido">
                                       <div class="help-block"></div>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="direccion_oficina" class="font-weight-bold">Dirección de la Oficina :<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="direccion_oficina" name="direccion_oficina" required="" placeholder="Dirección de la Oficina" data-validation-required-message="Este campo es requerido">
                                        <div class="help-block"></div> </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="id_departamento" class="font-weight-bold">Departamento de la Oficina: <span class="text-danger">*</span></label>
                                        <select id="id_departamento" name="id_departamento" class="form-control" onchange="buscarMunicipio(this.value,'null')">
                                            <option value="">[Seleccione]</option>
                                            <?php
                                                $this->db->where("id_departamento <","15");
                                                $seccion = $this->db->get("org_departamento");

                                                if(!empty($seccion)){
                                                    foreach ($seccion->result() as $fila) {
                                            ?>
                                                <option  value="<?php echo $fila->id_departamento ?>" onclick="buscarMunicipio('<?php echo $fila->id_departamento;?>','null')" > 
                                                    <?php echo $fila->departamento ?>
                                                </option>;
                                            <?php
                                                    }
                                                }
                                            ?>
                                        </select>
                                       <div class="help-block"></div>
                                    </div>

                                </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                          <label for="id_municipio" class="font-weight-bold">Municipio de la Oficina: <span class="text-danger">*</span></label>
                                        <div id="municipios">
                                            <select class="form-control" id="id_municipio">
                                                <option>[Seleccione]</option>
                                            </select>
                                        </div>
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="jefe_oficina" class="font-weight-bold">Jefe de la Oficina: <span class="text-danger">*</span></label>
                                      <!--<input type="text" class="form-control" id="jefe_oficina" name="jefe_oficina" required="" placeholder="Nombre del Jefe de la Oficina" data-validation-required-message="Este campo es requerido"> -->
                                      <select id="jefe_oficina" name="jefe_oficina" class="form-control"  style="width: 100%">
                                        <option value="">[Elija el Jefe]</option>
                                        <?php 
                                            $empleado = $this->db->query("SELECT e.id_empleado, UPPER(CONCAT_WS(' ', e.primer_nombre, e.segundo_nombre, e.tercer_nombre, e.primer_apellido, e.segundo_apellido, e.apellido_casada)) AS nombre_completo FROM sir_empleado AS e ORDER BY primer_nombre");

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
                              <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email_oficina" class="font-weight-bold">Email :<span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" id="email_oficina" name="email_oficina" required="" placeholder="Email" data-validation-required-message="Este campo es requerido">
                                        <div class="help-block"></div> </div>
                                </div>
                            </div>
                           <div id="divider" class="row" >
                                <div class="col-lg-8 col-md-7 otro" >
                                        <div id="map"></div>
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
                                <div class="col-lg-4 col-md-5" >
                                    <div class="form-group">
                                        <label>Buscar ubicación</label>
                                        <input id="address" class="form-control form-control-line" type="text" placeholder="municipio, departamento, pais">
                                    </div>
                                    <div align="right">
                                        <button id="submit_ubi" class="btn waves-effect waves-light btn-success" type="button"><i class="mdi mdi-magnify"></i> Buscar</button>
                                    </div>
                                    <br><br>


                                    <br><br><br><br><br><br><br><br>
                                </div>
                            </div>

                            <button id="submit" type="submit" style="display: none;"></button>
                            <div align="right" id="btnadd">
                                <button type="reset" class="btn waves-effect waves-light btn-success"><i class="mdi mdi-recycle"></i> Limpiar</button>
                                <button type="submit" class="btn waves-effect waves-light btn-success2"><i class="mdi mdi-plus"></i> Guardar</button>
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

                        <?php echo form_open('', array('id' => 'form_phone', 'style' => 'margin-top: 0px;', 'class' => 'm-t-40', 'novalidate' => '')); ?>
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

<script>

$(function(){
    $("#formajax").on("submit", function(e){
        e.preventDefault();
        var f = $(this);
        var formData = new FormData(document.getElementById("formajax"));
        formData.append("dato", "valor");

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
            if(res == "exito"){
                cerrar_mantenimiento();
                if($("#band").val() == "save"){
                    swal({ title: "¡Registro exitoso!", type: "success", showConfirmButton: true });
                }else if($("#band").val() == "edit"){
                    swal({ title: "¡Modificación exitosa!", type: "success", showConfirmButton: true });
                }else{
                    swal({ title: "¡Borrado exitoso!", type: "success", showConfirmButton: true });
                }
                tablaoficinas();$("#band").val('save');
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
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA4M5mZA-qqtRgioLuZ4Kyg6ojl71EJ3ek&callback=initMap">
</script>
