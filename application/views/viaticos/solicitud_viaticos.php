<?php
    $mantenimiento = false;
    if($mantenimiento){
        header("Location: ".site_url()."/mantenimiento");
        exit();
    }
?>

<?php
    $horario_viaticos = $this->db->query("SELECT * FROM vyp_horario_viatico WHERE id_tipo = '1' AND estado = '1'");
    $restric_viaticos = $this->db->query("SELECT * FROM vyp_horario_viatico WHERE id_tipo = '2' AND estado = '1'");
?>

<script type="text/javascript">
    /*****************************************************************************************************
    ******************************* Recuperando los horarios de viaticos ********************************/

    var DistanciaMinima = 15;

    var viaticos = [];
    var restricciones = [];

    function cargarViaticos(){
        <?php
            if($horario_viaticos->num_rows() > 0){
                foreach ($horario_viaticos->result() as $filahor) {
        ?>
        viaticos.push([
            <?php
                echo "'".$filahor->id_horario_viatico."', ";
                echo "'".$filahor->descripcion."', ";
                echo "'".substr($filahor->hora_inicio,0,5)."', ";
                echo "'".substr($filahor->hora_fin,0,5)."', ";
                echo "'".$filahor->monto."'";
            ?>
        ]);
        <?php
                }
            }
        ?>

        <?php
            if($restric_viaticos->num_rows() > 0){
                foreach ($restric_viaticos->result() as $filares) {
        ?>
        restricciones.push([
            <?php
                echo "'".$filares->id_horario_viatico."', ";
                echo "'".$filares->descripcion."', ";
                echo "'".substr($filares->hora_inicio,0,5)."', ";
                echo "'".substr($filares->hora_fin,0,5)."', ";
                echo "'".$filares->id_restriccion."'";
            ?>
        ]);
        <?php
                }
            }
        ?>
    }

    function verificar_viaticos(){        
        var hora_salida = $("#hora_salida").val();
        var hora_llegada = $("#hora_llegada").val();
        var distancia = parseFloat($("#id_distancia option:selected").text().trim());
        var visibles = [];
        var hay_viaticos;

        if((hora_salida != "" && hora_llegada != "") && (hora_salida < hora_llegada) && distancia > DistanciaMinima){
            for(j=0; j<viaticos.length; j++){

                if(((hora_salida <= viaticos[j][2] && hora_llegada >= viaticos[j][2]) || (hora_salida >= viaticos[j][2] && hora_salida <= viaticos[j][3]))){
                    if(!tiene_restriccion(hora_salida, hora_llegada)){
                        $("#cnt"+viaticos[j][0]).show(0);
                        document.getElementById("checkbox"+viaticos[j][0]).checked = 1;
                        visibles.push([viaticos[j][0],'visible']);
                    }else{
                        $("#cnt"+viaticos[j][0]).hide(0);
                        document.getElementById("checkbox"+viaticos[j][0]).checked = 0;
                        visibles.push([viaticos[j][0],'oculto']);
                    }
                }else{
                    $("#cnt"+viaticos[j][0]).hide(0);
                    document.getElementById("checkbox"+viaticos[j][0]).checked = 0;
                    visibles.push([viaticos[j][0],'oculto']);
                }

            }

            hay_viaticos = recorre_tabla(visibles);
            if(hay_viaticos){
                $("#myModal").modal("show");
            }else{
                $.toast({ heading: 'No hay viáticos', text: 'Viáticos no disponibles', position: 'top-right', loaderBg:'#3c763d', icon: 'warning', hideAfter: 4000, stack: 6 });
                            bandera = false;
            }

        }else{
            if(hora_salida == "" || hora_llegada == ""){
                swal({ title: "Horario no válido", text: "Completa la hora de salida y llegada del lugar visitado", type: "warning", showConfirmButton: true });
            }else if(hora_salida > hora_llegada){
                swal({ title: "Horario no válido", text: "La hora de salida debe ser menor a la hora de llegada", type: "warning", showConfirmButton: true });
            }else{
                 swal({ title: "Distancia no válida", text: "La distancia debe ser mayor a 15 Km", type: "warning", showConfirmButton: true });
            }
            
        }

    }


    function recorre_tabla(viaticos_visibles){
        var fecha = $("#fecha_mision option:selected").text();
        var celdas;
        var filas = $("#tabla_viaticos").find("tbody").find("tr");
        var horarios = $("#horarios").val();
        var id_horarios;
        var band_visible = false;

        for(l=0; l< (filas.length-1); l++){
            celdas = $(filas[l]).children("td");
            horarios2 = $($(celdas[4]).children("input")[0]).val();
            fecha2 = $(celdas[0]).text();
            if(fecha.trim() == fecha2.trim()){
                
                    if(horarios == horarios2){
                        if(horarios2 != ""){
                            id_horarios = horarios2.split(",");
                        }else{
                            id_horarios = "";
                        }
                        for(m=0; m<id_horarios.length; m++){
                            $("#cnt"+id_horarios[m]).show(0);
                            document.getElementById("checkbox"+id_horarios[m]).checked = 1;
                            for(z=0; z<viaticos_visibles.length; z++){
                                if(viaticos_visibles[z][0] == id_horarios[m]){
                                    viaticos_visibles[z][1] = 'visible';
                                }
                            }
                        }
                    }else{
                        if(horarios2 != ""){
                            id_horarios = horarios2.split(",");
                        }else{
                            id_horarios = "";
                        }

                        for(m=0; m<id_horarios.length; m++){
                            $("#cnt"+id_horarios[m]).hide(0);
                            document.getElementById("checkbox"+id_horarios[m]).checked = 0;
                            for(z=0; z<viaticos_visibles.length; z++){
                                if(viaticos_visibles[z][0] == id_horarios[m]){
                                    viaticos_visibles[z][1] = 'oculto';
                                }
                            }
                        }
                    }
                
            }
        }

        for(z=0; z<viaticos_visibles.length; z++){
            if(viaticos_visibles[z][1] == "visible"){
                band_visible = true;
            }
        }

        return band_visible;
    }

    function validar_horarios_viaticos(){
        var fecha = $("#fecha_mision option:selected").text();
        var celdas, fecha2;
        var filas = $("#tabla_viaticos").find("tbody").find("tr");

        var hora_salida = $("#hora_salida").val();
        var hora_llegada = $("#hora_llegada").val();
        var id_empresa_viatico = $("#id_empresa_viatico").val();

        var bandera = true;

        if(hora_salida < hora_llegada){

            for(l=0; l< (filas.length-1); l++){
                celdas = $(filas[l]).children("td");
                id_empresa_viatico2 = $($(celdas[0]).children("input")[0]).val();

                hora_salida2 = $(celdas[2]).text().trim();
                hora_salida2 = hora_salida2.substr(0,5);
                hora_llegada2 = $(celdas[3]).text().trim();
                hora_llegada2 = hora_llegada2.substr(0,5);
                fecha2 = $(celdas[0]).text().trim();

                if(fecha == fecha2){
                    if(id_empresa_viatico2 != id_empresa_viatico){
                        if(((hora_salida <= hora_salida2 && hora_llegada >= hora_salida2) || (hora_salida >= hora_salida2 && hora_salida <= hora_llegada2))){
                            $.toast({ heading: 'Choque de horario', text: 'La hora de ejecución de la ruta choca con una ya existente', position: 'top-right', loaderBg:'#3c763d', icon: 'warning', hideAfter: 4000, stack: 6 });
                            bandera = false;
                        }
                    }
                }
            }

        }else{
            $.toast({ heading: 'Horas incorrectas', text: 'La hora de salida debe ser menor a la de llegada.', position: 'top-right', loaderBg:'#3c763d', icon: 'warning', hideAfter: 4000, stack: 6 });
            bandera = false;
        }

        return bandera;

    }

    function calcular_viaticos(){
        var total_viaticos = 0;
        var id_horarios = "";
        
        for(k=0; k<viaticos.length; k++){
            if(document.getElementById("checkbox"+viaticos[k][0]).checked){
                total_viaticos = parseFloat(total_viaticos) + parseFloat(viaticos[k][4]);
                id_horarios += viaticos[k][0]+",";
            }
        }

        id_horarios = id_horarios.substring(0, (id_horarios.length-1))

        $("#viatico").val(total_viaticos.toFixed(2));
        $("#horarios").val(id_horarios);
        $("#myModal").modal("hide");
    }

    function tiene_restriccion(hora_salida, hora_llegada){
        var band_rest = false;

        for(i=0; i<restricciones.length; i++){
            if(restricciones[i][4] == "1"){
                if(hora_salida >= restricciones[i][2] && hora_salida <= restricciones[i][3]){
                    band_rest = true;
                    $.toast({ heading: 'Restricción hora salida', text: restricciones[i][1]+': '+restricciones[i][2]+" - "+restricciones[i][3], position: 'top-right', loaderBg:'#000', icon: 'warning', hideAfter: 4000, stack: 6 });
                }
            }else if($restricciones[i][4] == "2"){
                if(hora_llegada >= restricciones[i][2] && hora_llegada <= restricciones[i][3]){
                    band_rest = true;
                    $.toast({ heading: 'Restricción hora llegada', text: restricciones[i][1]+': '+restricciones[i][2]+" - "+restricciones[i][3], position: 'top-right', loaderBg:'#000', icon: 'warning', hideAfter: 4000, stack: 6 });
                }
            }else if($restricciones[i][4] == "3"){
                if((hora_salida >= restricciones[i][2] && hora_salida <= restricciones[i][3]) && (hora_llegada >= restricciones[i][2] && hora_llegada <= restricciones[i][3])){
                    band_rest = true;
                    $.toast({ heading: 'Restricción hora salida y llegada', text: restricciones[i][1]+': '+restricciones[i][2]+" - "+restricciones[i][3], position: 'top-right', loaderBg:'#000', icon: 'warning', hideAfter: 4000, stack: 6 });
                }
            }else if($restricciones[i][4] == "4"){
                if((hora_salida >= restricciones[i][2] && hora_salida <= restricciones[i][3]) || (hora_llegada >= restricciones[i][2] && hora_llegada <= restricciones[i][3])){
                    band_rest = true;
                    $.toast({ heading: 'Restricción hora salida y llegada', text: restricciones[i][1]+': '+restricciones[i][2]+" - "+restricciones[i][3], position: 'top-right', loaderBg:'#000', icon: 'warning', hideAfter: 4000, stack: 6 });
                }
            }
        }

        return band_rest;
    }

    function iniciar(){
        tabla_solicitudes();
        cargarViaticos();
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

    function informacion_empleado(){
    	var nr_usuario = $("#nr").val();
        if(window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp_municipio=new XMLHttpRequest();
        }else{// code for IE6, IE5
            xmlhttp_municipio=new ActiveXObject("Microsoft.XMLHTTPB");
        }

        xmlhttp_municipio.onreadystatechange=function(){
            if (xmlhttp_municipio.readyState==4 && xmlhttp_municipio.status==200){
                  document.getElementById("cnt_informacion_empleado").innerHTML=xmlhttp_municipio.responseText;
                  //$(".select2").select2();
            }
        }
        xmlhttp_municipio.open("GET","<?php echo site_url(); ?>/viaticos/solicitud_viatico/informacion_empleado?nr_usuario="+nr_usuario,true);
        xmlhttp_municipio.send();
    }

    function cerrar_mantenimiento(){
        $("#cnt_tabla").show(0);
        $("#cnt_form").hide(0);
    }

    function cambiar_nuevo(){
        $("#id_mision").val("");
        $("#nr").val("").trigger('change.select2');
        $("#nombre_empresa").val("");
        $("#direccion_empresa").val("");
        $("#id_actividad").val("").trigger('change.select2');
        $("#detalle_actividad").val('');
        $("#band").val("save");

        $("#ttl_form").addClass("bg-success");
        $("#ttl_form").removeClass("bg-info");

        $("#btnadd").show(0);
        $("#btnedit").hide(0);

        $("#cnt_tabla").hide(0);
        $("#cnt_form").show(0);

        form_mision();

        $("#ttl_form").children("h4").html("<span class='mdi mdi-plus'></span> Nueva solicitud de viáticos y pasajes");
    }

    function cambiar_editar(id,nr,fecha_mision_inicio,fecha_mision_fin,actividad_realizada,detalle_actividad,bandera){
        $("#id_mision").val(id);
        $("#nr").val(nr).trigger('change.select2');
        $("#fecha_mision_inicio").val(fecha_mision_inicio);
        $("#fecha_mision_fin").val(fecha_mision_fin);
        $("#nombre_empresa").val("");
        $("#direccion_empresa").val("");
        $("#detalle_actividad").val(detalle_actividad);
        $('#id_actividad').val(actividad_realizada).trigger('change.select2');       

        if(bandera == "edit"){
            //observaciones(id);
            form_mision();
            $("#ttl_form").removeClass("bg-success");
            $("#ttl_form").addClass("bg-info");
            $("#btnadd").hide(0);
            $("#btnedit").show(0);
            $("#cnt_tabla").hide(0);
            $("#cnt_form").show(0);
            $("#ttl_form").children("h4").html("<span class='fa fa-wrench'></span> Editar solicitud de viáticos y pasajes");
        }else{
            eliminar_mision();
        }
    }

    function eliminar_mision(){
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
            $("#formajax").submit();
        });
    }

    function cambiar_eliminar_destino(id_empresa_visitada){
        swal({   
            title: "¿Está seguro?",   
            text: "¡Desea eliminar el registro!",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#fc4b6c",   
            confirmButtonText: "Sí, deseo eliminar!",   
            closeOnConfirm: true 
        }, function(){   
            eliminar_destino(id_empresa_visitada)
        });
    }

    function eliminar_destino(id_empresa_visitada){
        ajax = objetoAjax();
        ajax.open("POST", "<?php echo site_url(); ?>/viaticos/solicitud_viatico/eliminar_destino", true);
        ajax.onreadystatechange = function() {
            if (ajax.readyState == 4){
               tabla_empresas_visitadas();
            }
        } 
        ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded"); 
        ajax.send("&id_empresa_visitada="+id_empresa_visitada)
    }

    function editar_mision(){
        $("#band").val("edit");
        $("#submit_button").click();
    }

    function form_mision(){
        $("#cnt_mision").show(0);
        $("#cnt_rutas").hide(0);
        $("#cnt_viaticos").hide(0);
    }

    function form_rutas(){
        tabla_empresas_visitadas(function(){ form_oficinas() });
        $("#cnt_mision").hide(0);
        $("#cnt_rutas").show(0);
        $("#cnt_viaticos").hide(0);
        document.getElementById("destino_oficina").checked = true;
    }

    function tabla_empresas_visitadas(callback){
        var id_mision = $("#id_mision").val();
        var nr = $("#nr").val();    
        var newName = 'John Smith',
    	xhr = new XMLHttpRequest();
		xhr.open('GET', "<?php echo site_url(); ?>/viaticos/solicitud_viatico/tabla_empresas_visitadas?id_mision="+id_mision+"&nr="+nr);
		xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		xhr.onload = function() {
		    if (xhr.status === 200 && xhr.responseText !== newName) {
		        document.getElementById("cnt_empresas").innerHTML = xhr.responseText;
		        if(typeof callback == "function"){
		        	callback();
		      	}
		    }else if (xhr.status !== 200) {
		        swal({ title: "Ups! ocurrió un Error", text: "Al parecer la tabla de empresas visitadas no se cargó correctamente por favor recarga la página e intentalo nuevamente", type: "error", showConfirmButton: true });
		    }
		};
		xhr.send(encodeURI('name=' + newName));
    }

    function form_oficinas(){
    	$("#cnt_mapa").animate({height: '0', opacity: '0'}, 750);
        $("#nombre_empresa").parent().hide(0);
        $("#direccion_empresa").parent().hide(0);
        $("#municipio").parent().hide(0);
        $("#nombre_empresa").val("");
        $("#direccion_empresa").val("");
        combo_oficina_departamento("oficina");
    }

    var id_departamento_mapa = "";
    var id_municipio_mapa = "";

    function combo_oficina_departamento(tipo){
    	var newName = 'Otro nombre',
    	xhr = new XMLHttpRequest();

		xhr.open('GET', "<?php echo site_url(); ?>/viaticos/solicitud_viatico/combo_oficinas_departamentos?tipo="+tipo);
		xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		xhr.onload = function() {
		    if (xhr.status === 200 && xhr.responseText !== newName) {
		        document.getElementById("combo_departamento").innerHTML = xhr.responseText;
		        $(".select2").select2();
			   	if(tipo == "mapa"){
			    	$('#departamento').val(id_departamento_mapa).trigger('change.select2');
			    }else{
			    	combo_municipio(tipo);
			   	}
		    }else if (xhr.status !== 200) {
		        swal({ title: "Ups! ocurrió un Error", text: "Al parecer no todos los objetos se cargaron correctamente por favor recarga la página e intentalo nuevamente", type: "error", showConfirmButton: true });
		    }
		};
		xhr.send(encodeURI('name=' + newName));
    }

    function combo_municipio(tipo){   	
        var id_departamento = $("#departamento").val();
        var newName = 'John Smith',

    	xhr = new XMLHttpRequest();
		xhr.open('GET', "<?php echo site_url(); ?>/viaticos/solicitud_viatico/combo_municipios?id_departamento="+id_departamento+"&tipo="+tipo);
		xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		xhr.onload = function() {
		    if (xhr.status === 200 && xhr.responseText !== newName) {
		        document.getElementById("combo_municipio").innerHTML = xhr.responseText;
		        $(".select2").select2();
              	if(tipo == "oficina"){
                    if($("#departamento").val() != ""){
                        $("#nombre_empresa").val($("#departamento option:selected").text());
                        $("#direccion_empresa").val($("#departamento option:selected").text());
                        $("#nombre_empresa").parent().hide(0);
                        $("#direccion_empresa").parent().hide(0);
                        $("#municipio").parent().hide(0);
                    }else{
                        $("#nombre_empresa").parent().hide(0);
                        $("#direccion_empresa").parent().hide(0);
                        $("#municipio").parent().hide(0);
                        $("#nombre_empresa").val("");
                        $("#direccion_empresa").val("");
                    }
                    input_distancia(tipo);
              	}else if(tipo == "departamento"){
                    $("#nombre_empresa").parent().show(0);
                    $("#direccion_empresa").parent().show(0);
                    $("#municipio").parent().show(0);
                    input_distancia(tipo);
              	}else if(tipo == "mapa"){
                    $("#nombre_empresa").parent().show(0);
                    $("#direccion_empresa").parent().show(0);
                    $("#municipio").parent().show(0);
                    $('#municipio').val(id_municipio_mapa).trigger('change.select2');
                    input_distancia(tipo);
              	}
		    }
		    else if (xhr.status !== 200) {
		        swal({ title: "Ups! ocurrió un Error", text: "Al parecer no todos los objetos se cargaron correctamente por favor recarga la página e intentalo nuevamente", type: "error", showConfirmButton: true });
		    }
		};
		xhr.send(encodeURI('name=' + newName));
    }

    function input_distancia(tipo){
        var id_departamento = $("#departamento").val();
        var id_municipio = $("#municipio").val();

        if(window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp_municipio=new XMLHttpRequest();
        }else{// code for IE6, IE5
            xmlhttp_municipio=new ActiveXObject("Microsoft.XMLHTTPB");
        }

        xmlhttp_municipio.onreadystatechange=function(){
            if (xmlhttp_municipio.readyState==4 && xmlhttp_municipio.status==200){
                  document.getElementById("input_distancia").innerHTML=xmlhttp_municipio.responseText;
                  $(".select2").select2();
                  distancia_total_mapa = 0;
            }
        }
        xmlhttp_municipio.open("GET","<?php echo site_url(); ?>/viaticos/solicitud_viatico/input_distancia?id_departamento="+id_departamento+"&id_municipio="+id_municipio+"&tipo="+tipo+"&distancia="+distancia_total_mapa,true);
        xmlhttp_municipio.send();
    }

    function form_folleto_viaticos(){
    	$("#cnt_mapa").animate({height: '0', opacity: '0'}, 750);
        combo_oficina_departamento("departamento");
        $("#nombre_empresa").parent().show(0);
        $("#direccion_empresa").parent().show(0);
        $("#municipio").parent().show(0);
        $("#nombre_empresa").val("");
        $("#direccion_empresa").val("");
    }

    function form_mapa(){
        var container = document.getElementById("input-div");
        container.innerHTML= '<input type="text" class="controlers" id="search_input" placeholder="Escribe una ubicación a buscar"/>';
        LatOrigen = {       //Contiene la ubicación de la oficina de origen del usuario
            lat: parseFloat($("#latitud_oficina").val()), 
            lng: parseFloat($("#longitud_oficina").val())
        };

        $("#cnt_mapa").animate({height: '500px', opacity: '1'}, 750);
        $.when(initMap()).then($("#dirigir").click());

        combo_oficina_departamento("mapa");
        $("#nombre_empresa").parent().show(0);
        $("#direccion_empresa").parent().show(0);
        $("#municipio").parent().show(0);
        $("#nombre_empresa").val("");
        $("#direccion_empresa").val("");
    }

    function finalizarBusquedaMapa(){
        $("#cnt_mapa").animate({height: '0', opacity: '0'}, 750);

        $("#direccion_empresa").val(direccion_mapa);
        var municipio = municipio_mayus(direccion_mapa);
        obtener_id_municipio(municipio);
    }

    function municipio_mayus(municipio_minus){
        var direccion = municipio_minus;
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

        municipio = municipio.replace(/[Áá]/gi,"A");
        municipio = municipio.replace(/[Éé]/gi,"E");
        municipio = municipio.replace(/[Íí]/gi,"I");
        municipio = municipio.replace(/[Óó]/gi,"O");
        municipio = municipio.replace(/[Úú]/gi,"U");

        municipio = municipio.toUpperCase();
        return municipio;
    }

    function obtener_id_municipio(municipio){
        var formData = new FormData();
        formData.append("id_municipio", municipio);

        $.ajax({
            url: "<?php echo site_url(); ?>/viaticos/solicitud_viatico/obtener_id_municipio",
            type: "post",
            dataType: "html",
            data: formData,
            cache: false,
            contentType: false,
            processData: false
        })
        .done(function(res){
            if(res == "fracaso"){
                var municipio = municipio_mayus(direccion_departamento_mapa);
                obtener_id_municipio2(municipio);
            }else{
                id_municipio_mapa = res;
                obtener_id_departamento(res);
            }
             
        });
    }

    function obtener_id_municipio2(municipio){
        var formData = new FormData();
        formData.append("id_municipio", municipio);

        $.ajax({
            url: "<?php echo site_url(); ?>/viaticos/solicitud_viatico/obtener_id_municipio",
            type: "post",
            dataType: "html",
            data: formData,
            cache: false,
            contentType: false,
            processData: false
        })
        .done(function(res){
            if(res == "fracaso"){
                swal({ title: "Departamento y municipio no encontrado", text: "Debe seleccionar manualmente el departamento y municipio de destino.", type: "warning", showConfirmButton: true });
                input_distancia("mapa");
            }else{
                id_municipio_mapa = res;
                obtener_id_departamento(res);
                swal({ title: "Verificar municipio", text: "La direccion no se encontro completa, es posible que el municipio mostrado no se el correcto. De ser así, seleccionelo manualmente", type: "warning", showConfirmButton: true });
            }
             
        });
    }

    function obtener_id_departamento(id_municipio){
        var formData = new FormData();
        formData.append("id_municipio", id_municipio);

        $.ajax({
            url: "<?php echo site_url(); ?>/viaticos/solicitud_viatico/obtener_id_departamento",
            type: "post",
            dataType: "html",
            data: formData,
            cache: false,
            contentType: false,
            processData: false
        })
        .done(function(res){
            if(res == "fracaso"){
                swal({ title: "Departamento y municipio no encontrado", text: "Debe seleccionar manualmente el departamento y municipio de destino.", type: "warning", showConfirmButton: true });
            }else{
                id_departamento_mapa = res;
                combo_oficina_departamento("mapa");
            }
        });
    }

    function gestionar_destino(band){
        $("#band2").val(band);
        $("#btn_submit").click();
    }

    function tabla_empresas_viaticos(tipo){
        var id_mision = $("#id_mision").val();
        var nr = $("#nr").val();
        if(window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp_municipio=new XMLHttpRequest();
        }else{// code for IE6, IE5
            xmlhttp_municipio=new ActiveXObject("Microsoft.XMLHTTPB");
        }
        xmlhttp_municipio.onreadystatechange=function(){
            if (xmlhttp_municipio.readyState==4 && xmlhttp_municipio.status==200){
                  document.getElementById("tabla_viaticos").innerHTML=xmlhttp_municipio.responseText;
                  $('[data-toggle="tooltip"]').tooltip();
                  imagen("");
                  $('.image-popup-no-margins').magnificPopup({
						type: 'image',
						closeOnContentClick: true,
						closeBtnInside: false,
						fixedContentPos: true,
						mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
						image: {
							verticalFit: true
						},
						zoom: {
							enabled: true,
							duration: 300 // don't foget to change the duration also in CSS
						}
					});
            }
        }
        xmlhttp_municipio.open("GET","<?php echo site_url(); ?>/viaticos/solicitud_viatico/tabla_empresas_viaticos?id_mision="+id_mision+"&nr="+nr+"&tipo="+tipo,true);
        xmlhttp_municipio.send();
    }

    function imagen(ruta){
        if(window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp_municipio=new XMLHttpRequest();
        }else{// code for IE6, IE5
            xmlhttp_municipio=new ActiveXObject("Microsoft.XMLHTTPB");
        }
        xmlhttp_municipio.onreadystatechange=function(){
            if (xmlhttp_municipio.readyState==4 && xmlhttp_municipio.status==200){
                  document.getElementById("factura").innerHTML=xmlhttp_municipio.responseText;
                  $('.dropify').dropify();
            }
        }
        xmlhttp_municipio.open("GET","<?php echo site_url(); ?>/viaticos/solicitud_viatico/dropify?ruta="+ruta,true);
        xmlhttp_municipio.send();
    }

    function form_empresas_viaticos(tipo){
        var id_mision = $("#id_mision").val();
        var nr = $("#nr").val();
        if(window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp_municipio=new XMLHttpRequest();
        }else{// code for IE6, IE5
            xmlhttp_municipio=new ActiveXObject("Microsoft.XMLHTTPB");
        }
        xmlhttp_municipio.onreadystatechange=function(){
            if (xmlhttp_municipio.readyState==4 && xmlhttp_municipio.status==200){
                  document.getElementById("cnt_form_viaticos").innerHTML=xmlhttp_municipio.responseText;
                  	$('[data-toggle="tooltip"]').tooltip();
                    tabla_empresas_viaticos(tipo);
            }
        }
        xmlhttp_municipio.open("GET","<?php echo site_url(); ?>/viaticos/solicitud_viatico/form_empresas_viaticos?id_mision="+id_mision+"&nr="+nr+"&tipo="+tipo,true);
        xmlhttp_municipio.send();
    }

    function form_viaticos(){
        $("#cnt_mision").hide(0);
        $("#cnt_rutas").hide(0);
        $("#cnt_viaticos").show(0);
        form_empresas_viaticos("guardar");
    }

    function cambiarkilometraje(id_destino){
        if($("#id_oficina_origen").val() == id_destino){
            buscar_ultimo_destino($("#band_viatico").val());
        }else{
    	   $("#id_distancia").val(id_destino);
        }
    }

    function buscar_ultimo_destino(tipo){
        var filas = $("#tabla_viaticos").find("tbody").find("tr");
        var celdas, celdas2;

        if(tipo == "save"){
            celdas = $(filas[filas.length-2]).children("td");
            id_viatico = $($(celdas[0]).children("input")[1]).val();
            $("#id_distancia").val(id_viatico);
        }else{
            var id = $("#id_empresa_viatico").val();
            for(l=0; l < (filas.length-1); l++){
                celdas = $(filas[l]).children("td");
                id_viatico = $($(celdas[0]).children("input")[0]).val();
                if(id_viatico == id){
                    celdas2 = $(filas[l-1]).children("td");
                    id_viatico2 = $($(celdas2[0]).children("input")[1]).val();
                    $("#id_distancia").val(id_viatico2);
                }
            }
        }
    }

    function cambiarFactura(){
    	if(document.getElementById("band_factura").checked){
    		$("#factura").show(500);
    	}else{
    		$("#factura").hide(500);
    	}
    }

    function buscar_idmision(){
        var nr = $("#nr").val();

        ajax = objetoAjax();
        ajax.open("POST", "<?php echo site_url(); ?>/viaticos/solicitud_viatico/obtener_ultima_mision", true);
        ajax.onreadystatechange = function() {
            if (ajax.readyState == 4){
                $("#id_mision").val(ajax.responseText);
                form_rutas();              
            }
        } 
        ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded"); 
        ajax.send("&nr="+nr)
    }

    function cambiar_editar_viatico(id_viatico, id_origen, id_destino, hora_salida, hora_llegada, pasaje, viatico, alojamiento, horarios, fecha, id_mision, factura, kilometraje,band){
        $("#id_empresa_viatico").val(id_viatico);
        $("#fecha_mision").val(fecha);
        $("#id_origen").val(id_origen);
        $("#id_destino").val(id_destino);
        $("#hora_salida").val(hora_salida);
        $("#hora_llegada").val(hora_llegada);
        $("#horarios").val(horarios);
        $("#pasaje").val(pasaje);
        $("#viatico").val(viatico);
        $("#id_distancia").val(id_destino);
        $("#alojamiento").val(alojamiento);

        $("#band_viatico").val(band);
        $("#btnadd3").hide(0);
        $("#btnedit3").show(0);

        cambiarkilometraje(id_destino)

        if(band == "edit"){
            var ruta = "";
            if(parseFloat(alojamiento) > 0){
                document.getElementById("band_factura").checked = 1;
                cambiarFactura();
                ruta = "<?php echo base_url(); ?>assets/viaticos/facturas/"+factura;
            }else{
                document.getElementById("band_factura").checked = 0;
                cambiarFactura();
                ruta = "";
            }

            imagen(ruta);

            $( "html, body" ).animate({scrollTop:100}, '500');
        }else{
            eliminar_viaticos()
        }
    }

    function validar_factura(){
        var bandera = false;

        if(document.getElementById("band_factura").checked == 1 && $("#band_viatico").val() != "delete"){
            if($("#file").data("defaultFile") != ""){
                bandera = true;
            }else{
                if($("#file").val() != ""){
                    bandera = true;
                }else{
                    swal({ title: "Falta factura", text: "Debes comprobar tu pago alojamiento subiendo una imagen de la factura que recibiste.", type: "warning", showConfirmButton: true });
                }
            }
        }else{
            bandera = true;
        }

        return bandera;
    }

    function cambiar_nuevo_viatico(){
        $("#id_empresa_viatico").val("");
        //$("#fecha_mision").val(fecha);
        //$("#id_origen").val(id_origen);
        //$("#id_destino").val(id_destino);
        $("#hora_salida").val("");
        $("#hora_llegada").val("");
        $("#horarios").val("");
        $("#pasaje").val("0.00");
        $("#viatico").val("0.00");
        //$("#id_distancia").val(id_destino);
        $("#alojamiento").val("0.00");

        $("#band_viatico").val("save");
        $("#btnadd3").show(0);
        $("#btnedit3").hide(0);

        document.getElementById("band_factura").checked = 0;
        cambiarFactura();
        imagen("");
        tabla_empresas_viaticos();

        //$( "html, body" ).animate({scrollTop:100}, '500');
    }

    function eliminar_viaticos(){
        swal({   
            title: "¿Está seguro?",   
            text: "¡Desea eliminar el registro!",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#fc4b6c",   
            confirmButtonText: "Sí, deseo eliminar!",   
            closeOnConfirm: false 
        }, function(){   
            $("#btn_submit3").click();
        });
    }

    function generar_solicitud(){
        var id_mision = $("#id_mision").val();
        var total_viaticos = parseFloat($("#total_viaticos").val());
        if(total_viaticos > 0){
            ajax = objetoAjax();
            ajax.open("POST", "<?php echo site_url(); ?>/viaticos/solicitud_viatico/generear_solicitud", true);
            ajax.onreadystatechange = function() {
                if (ajax.readyState == 4){
                    $("#area").val(ajax.responseText)
                    if(ajax.responseText == "exito"){
                        tabla_solicitudes();
                        swal({ title: "!Solicitud exitosa!", type: "success", showConfirmButton: true });
                        cerrar_mantenimiento();
                        imprimir_solicitud(id_mision);
                    }else{
                        swal({ title: "¡Ups! Error", text: "Intentalo nuevamente.", type: "error", showConfirmButton: true });
                    }           
                }
            } 
            ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded"); 
            ajax.send("&id_mision="+id_mision)
        }else{
            swal({ title: "No hay viáticos", text: "La columna de viáticos no puede estar en $0.00 (no se reconoce como solicitud de viático)", type: "warning", showConfirmButton: true });
        }
    }

    function imprimir_solicitud(id_mision){
        window.open("<?php echo site_url(); ?>/viaticos/solicitud_viatico/imprimir_solicitud?id_mision="+id_mision, '_blank');
    }

    function verificar_fechas(){
        var id_mision = $("#id_mision").val();
        var fecha1 = $("#fecha_mision_inicio").val();
        var fecha2 = $("#fecha_mision_fin").val();

        ajax = objetoAjax();
        ajax.open("POST", "<?php echo site_url(); ?>/viaticos/solicitud_viatico/fecha_repetida", true);
        ajax.onreadystatechange = function() {
            if (ajax.readyState == 4){
                $("#area").val(ajax.responseText)
                if(ajax.responseText == "exito"){
                    generar_solicitud();
                }else if(ajax.responseText == "fecha_repetida"){
                    swal({   
                        title: "¿Está seguro?",   
                        text: "¡Existe una solicitud que coincide con la fecha de ejecución de la misión!",   
                        type: "warning",   
                        showCancelButton: true,   
                        confirmButtonColor: "#fc4b6c",   
                        confirmButtonText: "Sí, deseo continuar!",   
                        closeOnConfirm: false 
                    }, function(){   
                        generar_solicitud();
                    });
                }else{
                    swal({ title: "¡Ups! Error", text: "Intentalo nuevamente.", type: "error", showConfirmButton: true });
                }           
            }
        } 
        ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded"); 
        ajax.send("&id_mision="+id_mision+"&fecha1="+fecha1+"&fecha2="+fecha2)
    }

</script>

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

    .nueva_clase{
        background-color: #0000001a;
        padding-left: 3px;
        padding-right: 3px;
        font-weight: 500;
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
			                        <select id="nr" name="nr" class="select2" style="width: 100%" required="" onchange="informacion_empleado();">
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
                                <div class="form-group col-lg-3">   
                                    <h5>Fecha de misión (inicio): <span class="text-danger">*</span></h5>
                                    <input type="text" pattern="\d{1,2}-\d{1,2}-\d{4}" required="" data-date-start-date="-4d" value="<?php echo date('d-m-Y'); ?>" class="form-control" id="fecha_mision_inicio" name="fecha_mision_inicio" placeholder="dd/mm/yyyy">
                                    <div class="help-block"></div>
                                </div>
                                <div class="form-group col-lg-3">   
                                    <h5>Fecha misión (fin): <span class="text-danger">*</span></h5>
                                    <input type="text" pattern="\d{1,2}-\d{1,2}-\d{4}" data-date-end-date="0d" data-date-start-date="0d" required="" value="<?php echo date('d-m-Y'); ?>" class="form-control" id="fecha_mision_fin" name="fecha_mision_fin" placeholder="dd/mm/yyyy">
                                    <div class="help-block"></div>
                                </div>
                            </div>

                            <div class="row" id="cnt_informacion_empleado"></div>

                            <div class="row" id="cnt_combo_actividad">
                                                               
                            </div>

                            <div class="row">
                                <div class="form-group col-lg-12" style="height: 83px;">
                                    <h5>Detalle de la actividad: <span class="text-danger">*</span></h5>
                                    <textarea type="text" id="detalle_actividad" name="detalle_actividad" class="form-control" required="" placeholder="Describa la actividad realizada en la misión" minlength="3" data-validation-required-message="Este campo es requerido"></textarea>
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
                                <button type="button" onclick="form_viaticos();" class="btn waves-effect waves-light btn-success2">Continuar <i class="mdi mdi-chevron-right"></i></button>
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
                            <?php echo form_open('', array('id' => 'form_empresas_viaticos', 'style' => 'margin-top: 0px;', 'class' => 'm-t-40', 'enctype' => 'multipart/form-data')); ?>
                            <div id="cnt_form_viaticos"></div>
                            <?php echo form_close(); ?>
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
                    if($horario_viaticos->num_rows() > 0){
                        foreach ($horario_viaticos->result() as $fila) {
                ?>
                    <div class="form-check" id="cnt<?php echo $fila->id_horario_viatico; ?>">
                        <label class="custom-control custom-checkbox">
                            <input type="checkbox" id="checkbox<?php echo $fila->id_horario_viatico; ?>" class="custom-control-input" value="<?php echo $fila->id_horario_viatico; ?>">
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
                <button type="button" onclick="calcular_viaticos();" class="btn btn-success waves-effect">Aceptar</button>
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
            <div class="modal-body" id="">
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
    	var date = new Date();
            var currentMonth = date.getMonth();
            var currentDate = date.getDate();
            var currentYear = date.getFullYear();

        $('#fecha_mision_inicio').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true,
            todayHighlight: true,
            daysOfWeekDisabled: [0,6]
        });

        $('#fecha_mision_fin').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true,
            todayHighlight: true,
            daysOfWeekDisabled: [0,6]
        });

        $('#dirigir').click(function(){ //Id del elemento cliqueable
            $('html, body').animate({scrollTop:0}, 1000);
            return false;
        });

    });

    $("#formajax").on("submit", function(e){
        e.preventDefault();      
        var formData = new FormData(document.getElementById("formajax"));
        formData.append('nombre_completo', $("#nr option:selected").text());
        $.ajax({
                type:  'POST',
                url:   '<?php echo site_url(); ?>/viaticos/solicitud_viatico/gestionar_mision',
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


    $("#form_empresas_viaticos").on("submit", function(e){
        e.preventDefault();   

        if(validar_horarios_viaticos() && validar_factura()){
            var formData = new FormData(document.getElementById("form_empresas_viaticos"));
            //formData.append('nombre_completo', $("#nr option:selected").text());
            formData.append("nombre_origen", $("#id_origen option:selected").text().trim());
            formData.append("nombre_destino", $("#id_destino option:selected").text().trim());
            formData.append("kilometraje", $("#id_distancia option:selected").text().trim());
            formData.append("id_mision", $("#id_mision").val());
            $.ajax({
                    type:  'POST',
                    url:   '<?php echo site_url(); ?>/viaticos/solicitud_viatico/gestionar_viaticos',
                    dataType: "html",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false
            })
            .done(function(data){ //una vez que el archivo recibe el request lo procesa y lo devuelve
                if(data == "exito"){
                    if($("#band_viatico").val() == "save"){
                        swal({ title: "¡Registro exitoso!", type: "success", showConfirmButton: true });
                    }else if($("#band_viatico").val() == "edit"){
                        swal({ title: "¡Modificación exitosa!", type: "success", showConfirmButton: true });
                    }else{
                        swal({ title: "¡Borrado exitoso!", type: "success", showConfirmButton: true });
                    }
                    cambiar_nuevo_viatico();
                }else{
                    swal({ title: "¡Ups! Error", text: "Intentalo nuevamente.", type: "error", showConfirmButton: true });
                }
            });
        }


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
            var descripcion = $("#nombre_oficina").val()+" - "+$("#departamento option:selected").text();
        }else{            
            var descripcion = $("#nombre_oficina").val()+" - "+$("#departamento option:selected").text()+"/"+$("#municipio option:selected").text();
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
            url:   '<?php echo site_url(); ?>/viaticos/solicitud_viatico/gestionar_destinos',
            data: formData,
            cache: false
        })
        .done(function(data){
            if(data == "exito"){
                tabla_empresas_visitadas();
                $.toast({ heading: 'Registro exitoso', text: 'Se agregó una nueva empresa visitada.', position: 'top-right', loaderBg:'#3c763d', icon: 'success', hideAfter: 2000, stack: 6 });
            }else{
                swal({ title: "¡Ups! Error", text: "Intentalo nuevamente.", type: "error", showConfirmButton: true });
            }
        });
    });

});

</script>


<script>

    var direccion_mapa;
    var distancia_total_mapa = 0;
    var distancia_carretera_mapa;
    var direccion_departamento_mapa;

    var LatDestino = "";    // Guardará el destino buscado por el usuario
    var LatOrigen = "";

    function initMap() {
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
            title: $("#nombre_oficina").val(),
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