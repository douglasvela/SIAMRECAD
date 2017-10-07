 <style>

      html, body {
        height: 100%;
        margin: 0;
        padding: 0;

      }

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
    function cambiar_editar(id_oficina,nombre_oficina,direccion_oficina,latitud_oficina,longitud_oficina){
         $("#id_oficina").val(id_oficina);
         $("#nombre_oficina").val(nombre_oficina);
         $("#direccion_oficina").val(direccion_oficina);
         $("#latitud_oficina").val(latitud_oficina);
         $("#longitud_oficina").val(longitud_oficina);


        $("#ttl_form").removeClass("bg-success");
        $("#ttl_form").addClass("bg-info");

        $("#btnadd").hide(0);
        $("#btnedit").show(0);

        $("#cnt-tabla").hide(0);
        $("#cnt_form").show(0);

        initMap(latitud_oficina,longitud_oficina);
        $("#ttl_form").children("h4").html("<span class='fa fa-wrench'></span> Editar Oficina");
    }

    function cambiar_nuevo(){
        
        $("#band").val("save");

        $("#ttl_form").addClass("bg-success");
        $("#ttl_form").removeClass("bg-info");

        $("#btnadd").show(0);
        $("#btnedit").hide(0);

        $("#cnt-tabla").hide(0);
        $("#cnt_form").show(0);
        initMap("");
        $("#ttl_form").children("h4").html("<span class='mdi mdi-plus'></span> Nueva Oficina");
    }


    function cerrar_mantenimiento(){
        $("#id_oficina").val("");
        $("#nombre_oficina").val("");
        $("#direccion_oficina").val("");
        $("#cnt-tabla").show(0);
        $("#cnt_form").hide(0);
    }

    function editar_horario(obj){
        $("#band").val("edit");
        $("#submit").click();
    }

    function eliminar_horario(obj){
        $("#band").val("delete");
        $("#submit").click();
    }

    <?php if($notificacion != "nada"){ ?>
        var notificacion = setTimeout(function(){ $("#notificacion").click(); }, 1);
    <?php } ?>

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
            <div class="col-lg-12" id="cnt_form" style="display: none; padding-left: 100px; padding-right: 100px;">
                <div class="card">
                    <div class="card-header bg-success2" id="ttl_form">
                        <div class="card-actions text-white">
                            <a style="font-size: 16px;" onclick="cerrar_mantenimiento();"><i class="mdi mdi-window-close"></i></a>
                        </div>
                        <h4 class="card-title m-b-0 text-white">Listado de Oficinas</h4>
                    </div>
                    <div class="card-body b-t">
                        
                        <?php echo form_open('oficinas/gestionar_oficinas', array('style' => 'margin-top: 0px;', 'class' => 'm-t-40')); ?>
                            <input type="hidden" id="band" name="band" value="save">
                            <input type="hidden" id="id_oficina" name="id_oficina" value="">
                            <input type="text" id="latitud_oficina" name="latitud_oficina">
                            <input type="text" id="longitud_oficina" name="longitud_oficina">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nombre_oficina" class="font-weight-bold">Nombre de la Oficina:</label>
                                        <input type="text" class="form-control" id="nombre_oficina" name="nombre_oficina"> </div>
                                
                                </div> 
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="direccion_oficina" class="font-weight-bold">Dirección de la Oficina :</label>
                                        <input type="text" class="form-control" id="direccion_oficina" name="direccion_oficina"> </div>
                                </div>
                            </div>
                           <div id="divider" class="row" >
                                <div class="col-lg-8 col-md-7 otro" >
                                        <div id="map"></div>
                                </div>
                                <div class="col-lg-4 col-md-5" >
                                    <br><br>
                                    <div class="form-group">
                                        <label>Buscar ubicación</label>
                                        <input id="address" class="form-control form-control-line" type="text" placeholder="municipio, departamento, pais">
                                    </div>
                                    <input id="submit_ubi" class="btn btn-rounded btn-block btn-success" type="button" value="Buscar">
                                    <br><br>
                                    
                                    <strong>Resultados</strong>
                                    
                                    <div id="output">Los resultados aparecerán aquí</div>
                                    <br><br><br><br><br><br><br><br>
                                </div>
                            </div>

                            <button id="submit" type="submit" style="display: none;"></button>
                            <div align="right" id="btnadd">
                                <button type="submit" class="btn waves-effect waves-light btn-success2"><i class="mdi mdi-plus"></i> Guardar</button>
                            </div>
                            <div align="right" id="btnedit" style="display: none;">
                                <button type="button" onclick="editar_horario(this)" class="btn waves-effect waves-light btn-info"><i class="mdi mdi-pencil"></i> Editar</button>
                                <button type="button" onclick="eliminar_horario(this)" class="btn waves-effect waves-light btn-danger"><i class="mdi mdi-window-close"></i> Eliminar</button>
                            </div>

                        <?php echo form_close(); ?>
                    </div>

                </div>
            </div>
            <!-- ============================================================== -->
            <!-- Fin del FORMULARIO de gestión -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Inicio de la TABLA -->
            <!-- ============================================================== -->
            <div class="col-lg-12" id="cnt-tabla">
                <div class="card">
                    <div class="card-header">
                        <div class="card-actions">
                           
                        </div>
                        <h4 class="card-title m-b-0">Listado de Oficinas</h4>
                    </div>
                    <div class="card-body b-t">
                        <div class="pull-right">
                            <button type="button" onclick="cambiar_nuevo();" class="btn btn-rounded btn-success2"><span class="mdi mdi-plus"></span> Nuevo registro</button>
                        </div>
                        <div class="table-responsive" style="margin-top: 0px;">
                            <table id="myTable" class="table table-bordered">
                                <thead class="bg-info text-white">
                                    <tr>
                                        <th>Id</th>
                                        <th>Nombre de la Oficina</th>
                                        <th>Dirección de la Oficina</th>
                                        <th>Coordenadas</th>
                                        <th>(*)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    if(!empty($oficinas)){
                                        foreach ($oficinas->result() as $fila) {
                                           echo "<tr>";
                                           echo "<td>".$fila->id_oficina."</td>";
                                           echo "<td>".$fila->nombre_oficina."</td>";
                                           echo "<td>".$fila->direccion_oficina."</td>";
                                           echo "<td>".$fila->latitud_oficina." , ".$fila->longitud_oficina."</td>";
                                           $array = array($fila->id_oficina, $fila->nombre_oficina, $fila->direccion_oficina, $fila->latitud_oficina,$fila->longitud_oficina);
                                           echo boton_tabla($array,"cambiar_editar");
                                           echo "</tr>";
                                        }
                                    }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
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
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
    
    $(function() {
        $('#notificacion').click(function(){
            swal("Éxito!", "<?php echo $notificacion; ?>.", "success")
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
                center: {lat: 13.645121, lng:-88.784149},
                zoom: 17
            }); addMarker_origen({lat: 13.645121, lng:-88.784149},map);
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
            alert('Ubicación no encontrada: ' + status);
            
          }
        });
      }
    </script>
     <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA4M5mZA-qqtRgioLuZ4Kyg6ojl71EJ3ek&callback=initMap">
    </script>