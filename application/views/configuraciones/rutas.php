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
    function cambiar_editar(id_vyp_rutas,nombre_vyp_rutas,descr_origen_vyp_rutas,latitud_origen_vyp_rutas,longitud_origen_vyp_rutas,descr_destino_vyp_rutas,latitud_destino_vyp_rutas,longitud_destino_vyp_rutas,distancia_km_vyp_rutas,tiempo_vyp_rutas, bandera){
         $("#id_vyp_rutas").val(id_vyp_rutas);
        $("#nombre_vyp_rutas").val(nombre_vyp_rutas);
        $("#descr_origen_vyp_rutas").val(descr_origen_vyp_rutas);
        $("#descr_destino_vyp_rutas").val(descr_destino_vyp_rutas);
        $("#distancia_km_vyp_rutas").val(distancia_km_vyp_rutas);
        $("#tiempo_vyp_rutas").val(tiempo_vyp_rutas);
        $("#latitud_origen_vyp_rutas").val(latitud_origen_vyp_rutas);
        $("#latitud_destino_vyp_rutas").val(latitud_destino_vyp_rutas);
        $("#longitud_origen_vyp_rutas").val(longitud_origen_vyp_rutas);
        $("#longitud_destino_vyp_rutas").val(longitud_destino_vyp_rutas);

        if(bandera == "edit"){
            $("#ttl_form").removeClass("bg-success");
            $("#ttl_form").addClass("bg-info");
            $("#btnadd").hide(0);
            $("#btnedit").show(0);
            $("#cnt-tabla").hide(0);
            $("#cnt_form").show(0);
            initMap(latitud_origen_vyp_rutas,longitud_origen_vyp_rutas,latitud_destino_vyp_rutas,longitud_destino_vyp_rutas);
            $("#ttl_form").children("h4").html("<span class='fa fa-wrench'></span> Editar Ruta");7
        }else{
            eliminar_ruta();
        }
    }

    function cambiar_nuevo(){
        $("#id_vyp_rutas").val("");
        $("#nombre_vyp_rutas").val("");
        $("#descr_origen_vyp_rutas").val("");
        $("#descr_destino_vyp_rutas").val("");
        $("#distancia_km_vyp_rutas").val("");
        $("#tiempo_vyp_rutas").val("");
        $("#latitud_origen_vyp_rutas").val("");
        $("#latitud_destino_vyp_rutas").val("");
        $("#longitud_origen_vyp_rutas").val("");
        $("#longitud_destino_vyp_rutas").val("");

        $("#band").val("save");

        $("#ttl_form").addClass("bg-success");
        $("#ttl_form").removeClass("bg-info");

        $("#btnadd").show(0);
        $("#btnedit").hide(0);

        $("#cnt-tabla").hide(0);
        $("#cnt_form").show(0);
        initMap();
        $("#ttl_form").children("h4").html("<span class='mdi mdi-plus'></span> Nueva Ruta");
    }


    function cerrar_mantenimiento(){
        $("#id_vyp_rutas").val("");
        $("#nombre_vyp_rutas").val("");
        $("#descr_origen_vyp_rutas").val("");
        $("#descr_destino_vyp_rutas").val("");
        $("#distancia_km_vyp_rutas").val("");
        $("#tiempo_vyp_rutas").val("");
        $("#latitud_origen_vyp_rutas").val("");
        $("#latitud_destino_vyp_rutas").val("");
        $("#longitud_origen_vyp_rutas").val("");
        $("#longitud_destino_vyp_rutas").val("");

        $("#cnt-tabla").show(0);
        $("#cnt_form").hide(0);

    }

    function editar_ruta(){
        $("#band").val("edit");
        $("#submit").click();
    }

    function eliminar_ruta(){
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
        tablaRutas();
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
        });  
    }

    function tablaRutas(){          
        $( "#cnt-tabla" ).load("<?php echo site_url(); ?>/configuraciones/rutas/tabla_rutas", function() {
            $('#myTable').DataTable();
            $('[data-toggle="tooltip"]').tooltip();
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
                <h3 class="text-themecolor m-b-0 m-t-0">Gestión de Rutas</h3>
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
                        <h4 class="card-title m-b-0 text-white">Listado de Rutas</h4>
                    </div>
                    <div class="card-body b-t">

                        <?php echo form_open('', array('id' => 'formajax', 'style' => 'margin-top: 0px;', 'class' => 'm-t-40', 'novalidate' => '')); ?>
                            <input type="hidden" id="band" name="band" value="save">
                            <input type="hidden" placeholder="id#" id="id_vyp_rutas" name="id_vyp_rutas">
                          

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nombre_vyp_rutas" class="font-weight-bold">Nombre de la Ruta: <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="nombre_vyp_rutas" name="nombre_vyp_rutas" required="" placeholder="Nombre de la Ruta" data-validation-required-message="Este campo es requerido">
                                       <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>
                             <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="descr_origen_vyp_rutas" class="font-weight-bold">Descripció de origen de la Ruta: <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="descr_origen_vyp_rutas" name="descr_origen_vyp_rutas" required="" placeholder="Descripcion de origen" data-validation-required-message="Este campo es requerido">
                                       <div class="help-block"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="descr_destino_vyp_rutas" class="font-weight-bold">Descripción de destino de la Ruta: <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="descr_destino_vyp_rutas" name="descr_destino_vyp_rutas" required="" placeholder="Descripción de destino" data-validation-required-message="Este campo es requerido">
                                       <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>
                             <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="distancia_km_vyp_rutas" class="font-weight-bold">Distancia de la ruta: <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="distancia_km_vyp_rutas" name="distancia_km_vyp_rutas" required="" placeholder="Distancia de la Ruta" data-validation-required-message="Este campo es requerido">
                                       <div class="help-block"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tiempo_vyp_rutas" class="font-weight-bold">Tiempo de viaje de la Ruta: <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="tiempo_vyp_rutas" name="tiempo_vyp_rutas" required="" placeholder="Tiempo de viaje de la Ruta" data-validation-required-message="Este campo es requerido">
                                       <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>
                                        
                                       
                           <div id="divider" class="row" >
                                <div class="col-lg-8 col-md-7 otro" >
                                        <div id="map"></div>
                        <div class="form-group">
                            <input type="hidden"   placeholder="lat origen" id="latitud_origen_vyp_rutas" name="latitud_origen_vyp_rutas" required="" data-validation-required-message="El campo Origen es requerido"> <div class="help-block"></div>
                        </div>
                        <div class="form-group">
                             <input type="hidden" placeholder="lat destino" id="latitud_destino_vyp_rutas"  name="latitud_destino_vyp_rutas" required="" data-validation-required-message="El campo Destino es requerido"> <div class="help-block"></div>  
                        </div>
                        <div class="form-group">
                            <input type="hidden" placeholder="lon origen" id="longitud_origen_vyp_rutas" name="longitud_origen_vyp_rutas" >
                        </div>
                        

                        <input type="hidden" placeholder="lon destino" id="longitud_destino_vyp_rutas" name="longitud_destino_vyp_rutas" >

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


                                    <div>
                                        <strong>Resultados</strong>
                                    </div>
                                   <div id="output">Los resultados aparecerán aquí</div>
                                    

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
                                <button type="button" onclick="editar_ruta()" class="btn waves-effect waves-light btn-info"><i class="mdi mdi-pencil"></i> Editar</button>
                            </div>

                        <?php echo form_close(); ?>
                    </div>

                </div>
            </div>
            <div class="col-lg-1"></div>
                <div class="col-lg-12" id="cnt-tabla">
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
            url: "<?php echo site_url(); ?>/configuraciones/rutas/gestionar_rutas",
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
                tablaRutas();$("#band").val('save');
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
      
      function initMap(latOrigen,lngOrigen,latDestino,lngDestino) {
        var bounds = new google.maps.LatLngBounds;
        var markersArray = [];

        var origin1 = "";
        var destinationA = "";


        var geocoder = new google.maps.Geocoder;

        var service = new google.maps.DistanceMatrixService;
         
        var directionsService = new google.maps.DirectionsService();

        if(latOrigen){
            var map = new google.maps.Map(document.getElementById('map'), {
                center:  new google.maps.LatLng(latOrigen, lngDestino),
                zoom: 17
            });
            origin1 = new google.maps.LatLng(latOrigen, lngOrigen);
            destinationA = new google.maps.LatLng(latDestino, lngDestino);
            calcula_distancia();pinta_recorrido();
        }else{
            var map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: 13.705542923582362, lng: -89.20029401779175},
                zoom: 12
            });
        }
        var directionsDisplay = new google.maps.DirectionsRenderer({
          map: map
        });
        map.addListener('click', function(e) {
            deleteMarkers_O();
            addMarker_origen(e.latLng, map);
            origin1=e.latLng;
            var cadenaOrigen = String(origin1);
            
            var separador= ",";
            arregloDeSubCadenasOrigen = cadenaOrigen.split(separador);
            arregloOrigen1 = arregloDeSubCadenasOrigen[0].substring(1);
            
            pos_origen=arregloDeSubCadenasOrigen[1].indexOf(')');
            arregloOrigen2 = arregloDeSubCadenasOrigen[1].substring(0,pos_origen);

            document.getElementById('latitud_origen_vyp_rutas').value=arregloOrigen1;
            document.getElementById('longitud_origen_vyp_rutas').value=arregloOrigen2;

            if(destinationA){
              calcula_distancia();pinta_recorrido();
            }
        });
        map.addListener('rightclick', function(e) {
              deleteMarkers_D();
             addMarker_destino(e.latLng, map);
             destinationA=e.latLng;

            var cadenaOrigen = String(destinationA);
            
            var separadorD= ",";
            arregloDeSubCadenasDestino = cadenaOrigen.split(separadorD);
            arregloDestino1 = arregloDeSubCadenasDestino[0].substring(1);
            
            pos_destino=arregloDeSubCadenasDestino[1].indexOf(')');
            arregloDestino2 = arregloDeSubCadenasDestino[1].substring(0,pos_destino);

            document.getElementById('latitud_destino_vyp_rutas').value=arregloDestino1;
            document.getElementById('longitud_destino_vyp_rutas').value=arregloDestino2;

             if(origin1){
              calcula_distancia();pinta_recorrido();
              }
         
        });//termina event
        function calcula_distancia(){
          service.getDistanceMatrix({
          origins: [origin1],
          destinations: [destinationA],
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
            var showGeocodedAddressOnMap = function(asDestination) {
              return function(results, status) {
                if (status === 'OK') {
                  map.fitBounds(bounds.extend(results[0].geometry.location));
                  
                } else {
                  alert('Geocode was not successful due to: ' + status);
                }
              };
            };

            for (var i = 0; i < originList.length; i++) {
              var results = response.rows[i].elements;
              geocoder.geocode({'address': originList[i]},
                  showGeocodedAddressOnMap(false));
              for (var j = 0; j < results.length; j++) {
                geocoder.geocode({'address': destinationList[j]},
                    showGeocodedAddressOnMap(true));
                 outputDiv.innerHTML += "<b>Origen:</b> "+originList[i] + '<br><b>Destino:</b> ' + destinationList[j] +
                    '<br><b>Distancia:</b> ' + results[j].distance.text + '<br><b>Tiempo:</b> ' +//distancia
                    results[j].duration.text + '<br>';
                $("#descr_origen_vyp_rutas").val(originList[i]);
                $("#descr_destino_vyp_rutas").val(destinationList[j]);
                $("#distancia_km_vyp_rutas").val(results[j].distance.text);
                $("#tiempo_vyp_rutas").val(results[j].duration.text);

              }
            }
          }
          
        });
        }
        function pinta_recorrido(){
           var request = {
          destination: destinationA,
          origin: origin1,
          travelMode: 'DRIVING'
           };

        // Pass the directions request to the directions service.
        
        directionsService.route(request, function(response, status) {
          if (status == 'OK') {
            // Display the route on the map.
             
            directionsDisplay.setDirections(response);
          deleteMarkers_D();
          deleteMarkers_O();
          }
        });
        }


        document.getElementById('submit').addEventListener('click', function() {
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


      function addMarker_destino(location, map) {
        // Add the marker at the clicked location, and add the next-available label

        var marker = new google.maps.Marker({
          position: location,//labels[labelIndex++ % labels.length]
          map: map,
          animation: google.maps.Animation.DROP
        });
         markersD.push(marker);

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

      function geocodeAddress(geocoder, resultsMap) {

        var address = document.getElementById('address').value;
        geocoder.geocode({'address': address}, function(results, status) {
          if (status === google.maps.GeocoderStatus.OK) {
            resultsMap.setCenter(results[0].geometry.location);
            //addMarker_origen(results[0].geometry.location, resultsMap);
          } else {
            alert('Geocode was not successful for the following reason: ' + status);
            
          }
        });
      }
    </script>
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA4M5mZA-qqtRgioLuZ4Kyg6ojl71EJ3ek&callback=initMap">
</script>
