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

            //document.getElementById('latitud_origen_vyp_rutas').value=arregloOrigen1;
          //  document.getElementById('longitud_origen_vyp_rutas').value=arregloOrigen2;

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

          //  document.getElementById('latitud_destino_vyp_rutas').value=arregloDestino1;
            //document.getElementById('longitud_destino_vyp_rutas').value=arregloDestino2;

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