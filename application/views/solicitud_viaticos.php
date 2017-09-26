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
        font-size: 11px;
      }
    </style>
<div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
</div>
<div id="main-wrapper">
	<div class="page-wrapper">
		<div class="container-fluid">
			<div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body wizard-content">
                                <h4 class="card-title">Solicitud de Viáticos</h4>
                                <h6 class="card-subtitle">You can find the <a href="http://www.jquery-steps.com" target="_blank">offical website</a></h6>
                                <form action="#" class="tab-wizard wizard-circle">
                                    <!-- Step 1 -->
                                    <h6>EMPRESA VISITADA</h6>
                                    <section>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Nombre de la Empresa :</label>
                                                    <input type="text" class="form-control" id=""> </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Dirección de la Empresa :</label>
                                                    <input type="text" class="form-control" id="">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="">Actividad realizada :</label>
                                                    <textarea name="" id="" rows="6" class="form-control"></textarea>
                                                </div>
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
                                                      <input id="submit" class="btn btn-rounded btn-block btn-success" type="button" value="Buscar">
                                                      <br><br>
                                                      <div>
                                                        <strong>Resultados</strong>
                                                      </div>
                                                      <div id="output">Los resultados aparecerán aquí</div>
                                                      <br><br><br><br><br><br><br><br>
                                                  </div>
                                                </div>
                                    </section>
                                    <!-- Step 2 -->
                                    <h6>DETALLE / LUGAR DE SALIDA Y LLEGADA</h6>
                                    <section>
                                        <div class="row form-material">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="m-t-20">Default Material Date Picker</label>
                                        <input type="text" class="form-control" placeholder="2017-06-04" id="mdate">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="card-title">Data Table</h4>
                                                <h6 class="card-subtitle">Data table example</h6>
                                                <div class="table-responsive m-t-40">
                                                    <table id="myTable" class="table table-bordered table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>Fecha Misión</th>
                                                                <th>Detalle Lugar de Salida y LLegada</th>
                                                                <th>Hora de Salida</th>
                                                                <th>Hora de Llegada</th>
                                                                <th>Pasajes al Interior</th>
                                                                <th>Viáticos</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>11/11/2017</td>
                                                                <td>Sede Central San Salvador - Sede Paracentral San Vicente</td>
                                                                <td>7:30:00 AM</td>
                                                                <td>4:40:00 PM</td>
                                                                <td>$ 0.00</td>
                                                                <td>$ 8.00</td>
                                                            </tr>
                                                            <tr>
                                                                <td>11/11/2017</td>
                                                                <td>Sede Central San Salvador - Sede Santa Ana</td>
                                                                <td>7:30:00 AM</td>
                                                                <td>4:40:00 PM</td>
                                                                <td>$ 0.00</td>
                                                                <td>$ 4.00</td>
                                                            </tr>
                                                        </tbody>
                                                    </table> 
                                                </div> 
                                            </div>
                                        </div>
                                      
                                    </section>
                                    <!-- Step 3 -->
                                    <h6>DATOS DEL EMPLEADO Y BANCO</h6>
                                    <section>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Nombre  :</label>
                                                    <input type="text" class="form-control" id=""> </div>
                                                <div class="form-group">
                                                    <label for="">Cargo Nominal  :</label>
                                                    <input type="text" class="form-control" id=""> </div>
                                                 <div class="form-group">
                                                    <label for="">Cargo Funcional  :</label>
                                                    <input type="text" class="form-control" id=""> </div>
                                                
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="">Código :</label>
                                                    <input type="text" class="form-control" id="">
                                                </div>
                                                <div class="form-group">
                                                    <label>Teléfono :</label>
                                                    <input type="tel" class="form-control" id="">
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Linea de Trabajo :</label>
                                                    <input type="text" class="form-control" id="">
                                                </div>
                                               
                
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="">Sueldo :</label>
                                                    <input type="text" class="form-control" id="">
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Unida Pres :</label>
                                                    <input type="text" class="form-control" id="">
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Nombre del Banco  :</label>
                                                    <input type="text" class="form-control" id=""> </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Nombre del Banco  :</label>
                                                    <input type="text" class="form-control" id=""> </div>
                                            </div>
                                        </div>
                                    </section>
                                    <!-- Step 4 -->
                                    <h6>Remark</h6>
                                    <section>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="behName1">Behaviour :</label>
                                                    <input type="text" class="form-control" id="behName1">
                                                </div>
                                                <div class="form-group">
                                                    <label for="participants1">Confidance</label>
                                                    <input type="text" class="form-control" id="participants1">
                                                </div>
                                                <div class="form-group">
                                                    <label for="participants1">Result</label>
                                                    <select class="custom-select form-control" id="participants1" name="location">
                                                        <option value="">Select Result</option>
                                                        <option value="Selected">Selected</option>
                                                        <option value="Rejected">Rejected</option>
                                                        <option value="Call Second-time">Call Second-time</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="decisions1">Comments</label>
                                                    <textarea name="decisions" id="decisions1" rows="4" class="form-control"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>Rate Interviwer :</label>
                                                    <div class="c-inputs-stacked">
                                                        <label class="inline custom-control custom-checkbox block">
                                                            <input type="checkbox" class="custom-control-input"> <span class="custom-control-indicator"></span> <span class="custom-control-description ml-0">1 star</span> </label>
                                                        <label class="inline custom-control custom-checkbox block">
                                                            <input type="checkbox" class="custom-control-input"> <span class="custom-control-indicator"></span> <span class="custom-control-description ml-0">2 star</span> </label>
                                                        <label class="inline custom-control custom-checkbox block">
                                                            <input type="checkbox" class="custom-control-input"> <span class="custom-control-indicator"></span> <span class="custom-control-description ml-0">3 star</span> </label>
                                                        <label class="inline custom-control custom-checkbox block">
                                                            <input type="checkbox" class="custom-control-input"> <span class="custom-control-indicator"></span> <span class="custom-control-description ml-0">4 star</span> </label>
                                                        <label class="inline custom-control custom-checkbox block">
                                                            <input type="checkbox" class="custom-control-input"> <span class="custom-control-indicator"></span> <span class="custom-control-description ml-0">5 star</span> </label>
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
            
          } else {
            alert('Geocode was not successful for the following reason: ' + status);
            
          }
        });
      }
    </script>
     <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA4M5mZA-qqtRgioLuZ4Kyg6ojl71EJ3ek&callback=initMap">
    </script>
     <script >
    $(document).ready(function() {
        $('#myTable').DataTable();
         //calendario
         $('#mdate').bootstrapMaterialDatePicker({
            weekStart: 0,
            time: false
        });
    });

</script>
