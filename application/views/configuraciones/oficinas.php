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


<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="align-self-center" align="center">
                <h3 class="text-themecolor m-b-0 m-t-0">Gestión de Oficinas del Ministerio de Trabajo</h3>
            </div>
        </div>
		 <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-outline-info">
                            
                            <div class="card-body">
                                <form action="#" class="form-horizontal">
                                    <div class="form-body">
                                        <h3 class="box-title">Información De la Oficina</h3>
                                        <hr class="m-t-0 m-b-40">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="" class="font-weight-bold">Nombre de la Oficina:</label>
                                                    <input type="text" class="form-control" id=""> </div>
                                                <div class="form-group">
                                                    <label for="" class="font-weight-bold">Dirección de la Oficina :</label>
                                                    <input type="text" class="form-control" id=""> </div>
                                                 
                                                
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="" class="font-weight-bold">Departamento:</label>
                                                    <input type="text" class="form-control" id="">
                                                </div>                                                                                       
                
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="" class="font-weight-bold">Municipio :</label>
                                                    <input type="text" class="form-control" id="">
                                                </div>
                                                
                                            </div>
                                        </div>
                                        
                                        <h3 class="box-title">Ubicación Geográfica</h3>
                                        <hr class="m-t-0 m-b-40">
                                        <!--/row-->
                                        <div class="">
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
                                                      <input id="submit" class="btn btn-rounded btn-block btn-success" type="button" value="Buscar">
                                                      <br><br>
                                                      <div>
                                                        <strong>Resultados</strong>
                                                      </div>
                                                      <div id="output">Los resultados aparecerán aquí</div>
                                                      <br><br><br><br><br><br><br><br>
                                                  </div>
                                                </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-offset-3 col-md-3">
                                                        <button type="submit" class="btn waves-effect waves-light btn-block btn-success">Guardar</button>
                                                    </div> 
                                                    <div class="col-md-offset-3 col-md-3">
                                                        <button type="button" class="btn waves-effect waves-light btn-block btn-danger">Cancelar</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6"> </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Datos de las Oficinas</h4>
                    <h6 class="card-subtitle"></h6>
                    <div class="table-responsive m-t-40">
                        <table id="myTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Nombre de la Oficina</th>
                                    <th>Dirección de la Oficina</th>
                                    <th>Departamento</th>
                                    <th>Municipio</th>
                                    <th>Coordenadas</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Sede Central San Salvador</td>
                                    <td>3# calle oriente, barrio san donis</td>
                                    <td>san Salvador</td>
                                    <td>San Salvador</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Sede Santa Ana</td>
                                    <td>5A avenida norte, barrio san luis</td>
                                    <td>Santa Ana</td>
                                    <td>Santa Ana</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table> 
                    </div> 
                </div>
            </div>
    </div>

</div>
<script>
      var markersO = [];
      var markersD = [];

      var distancia = "";
      
      function initMap() {
        var bounds = new google.maps.LatLngBounds;
        var markersArray = [];

        var origin1 = "";
        var destinationA = "";


        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat:  13.645121, lng: -88.784149},
          zoom: 17
        });
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
        
        if(destinationA){
          calcula_distancia();pinta_recorrido();
        }
        });
        map.addListener('rightclick', function(e) {
          deleteMarkers_D();
         addMarker_destino(e.latLng, map);
         destinationA=e.latLng;
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

                    distancia = results[j].distance.text;
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
    <script>


    $(function(){ 
 
        $(document).ready(function(){
            $('#myTable').DataTable();
             //calendario
             
            
        });
    });


</script>