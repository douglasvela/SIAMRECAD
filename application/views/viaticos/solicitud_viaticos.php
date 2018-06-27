<?php
    $mantenimiento = false;
    if($mantenimiento){
        header("Location: ".site_url()."/mantenimiento");
        exit();
    }

    $user = $this->session->userdata('usuario_viatico');
    $nr = $this->db->query("SELECT * FROM org_usuario WHERE usuario = '".$user."' LIMIT 1");
    $nr_usuario = "";
    if($nr->num_rows() > 0){
        foreach ($nr->result() as $fila) { 
            $nr_usuario = $fila->nr; 
        }
    }
    $carpeta = "assets/viaticos/facturas/";
    //Validamos si la ruta de destino existe, en caso de no existir la creamos
    if(!file_exists($carpeta)){
        mkdir($carpeta, 0777) or die("No se puede crear el directorio de extracci&oacute;n");   
    }
    $carpeta2 = "assets/viaticos/justificaciones/";
    //Validamos si la ruta de destino existe, en caso de no existir la creamos
    if(!file_exists($carpeta2)){
        mkdir($carpeta2, 0777) or die("No se puede crear el directorio de extracci&oacute;n");   
    }
    $horario_viaticos = $this->db->query("SELECT * FROM vyp_horario_viatico WHERE id_tipo = '1' AND estado = '1'");
    $restric_viaticos = $this->db->query("SELECT * FROM vyp_horario_viatico WHERE id_tipo = '2' AND estado = '1'");
?>

<script type="text/javascript">
    /*****************************************************************************************************
    ******************************* Recuperando los horarios de viaticos ********************************/
    var DistanciaMinima = 15;
    var ultima_hora_llegada = "23:59";
    var primer_hora_salida = "01:00";
    var viaticos = [];
    var restricciones = [];
    var reg_viaticos = [];
    var reg_alojamiento = [];

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

    function convertir_salida(dist){
        var hs = convertToHour($("#hora_salida").val());
        var hl = convertToHour($("#hora_llegada").val());
        var km = dist;
        var dist_rango = DistanciaMinima; //15 Km
        var tiempo = hl - hs;
        var velocidad = km/tiempo;
        var hora_quince = dist_rango / velocidad;
        var tiempo2 = convertToTime(hora_quince+hs);
        return tiempo2;
    }

    function convertir_llegada(dist){
        var hs = convertToHour($("#hora_salida").val());
        var hl = convertToHour($("#hora_llegada").val());
        var km = dist;
        var dist_rango = km - DistanciaMinima; //kilometraje - 15 Km
        var tiempo = hl - hs;
        var velocidad = km/tiempo;
        var hora_quince = dist_rango / velocidad;
        var tiempo2 = convertToTime(hora_quince+hs);
        return tiempo2;
    }

    function contar_registros_tabla_viaticos(){
        var registros = $("#tabla_viaticos").find("tbody").find("tr");
        return (registros.length-1);
    }

    function validar_viatico_first(hs,hl){
        var fecha_ruta = $("#fecha_mision").val();
        var id_mision = $("#id_mision").val();
        var kilometraje_new = parseFloat($("#id_distancia option:selected").text().trim());
        var band_viatico = false;
        reg_viaticos = [];
        reg_alojamiento = [];
        var monto = 0;

        var body = $("#body_viaticos_encontrados");

        body.html("");

        if(kilometraje_new >= DistanciaMinima){
            for(j=0; j<viaticos.length; j++){
                if(((hs <= viaticos[j][2] && hl >= viaticos[j][2]) || (hs >= viaticos[j][2] && hs <= viaticos[j][3]))){
                    if(!tiene_restriccion(hs, "salida", viaticos[j][2], viaticos[j][3])){
                        band_viatico = true;
                        reg_viaticos.push([fecha_ruta, viaticos[j][0], id_mision, '1', viaticos[j][4]]);
                        monto += parseFloat(viaticos[j][4]);
                        var index = reg_viaticos.length;
                        body.append("<tr>"+
                                    "<td>"+fecha_ruta+"</td>"+
                                    "<td>"+viaticos[j][1]+"</td>"+
                                    "<td>"+parseFloat(viaticos[j][4]).toFixed(2)+"</td>"+
                                    "<td>"+gcheckbox(index)+"</td>"+
                                    "</tr>");
                    }
                }
            }
        }else{
            $.toast({ heading: 'No cumple con viáticos', text: 'Distancia menor a 15 Km. No cumple con viáticos', position: 'top-right', loaderBg:'#3c763d', icon: 'info', hideAfter: 4000, stack: 6 });
        }

        $("#viatico").val(monto.toFixed(2));
        return band_viatico;
    }

    function gcheckbox(indice){      
        return  '<div class="form-check">'+
                    '<label class="custom-control custom-checkbox">'+
                        '<input type="checkbox" onchange="cambiar_viaticos(this)" class="custom-control-input" checked value="'+indice+'">'+
                        '<span class="custom-control-indicator"></span>'+
                        '<span class="custom-control-description"></span>'+
                    '</label>'+
                '</div>';
    }

    function cambiar_viaticos(obj){
        var id_buscado = parseInt(obj.value)-1;

        if(obj.checked){
            for(g=0; g<reg_viaticos.length; g++){
                if(g == id_buscado){
                    reg_viaticos[g][3] = '1';
                    var nuevo_monto = parseFloat($("#viatico").val()) + parseFloat(reg_viaticos[g][4]);
                    $("#viatico").val(nuevo_monto.toFixed(2));
                }
            }  
        }else{
            for(g=0; g<reg_viaticos.length; g++){
                if(g == id_buscado){
                    reg_viaticos[g][3] = '0';
                    var nuevo_monto = parseFloat($("#viatico").val()) - parseFloat(reg_viaticos[g][4]);
                    $("#viatico").val(nuevo_monto.toFixed(2));
                }
            } 
        }
    }

    function verificar_fecha_diferente(){
        var fecha_nueva = $("#fecha_mision").val();

        var registros = $("#tabla_viaticos").find("tbody").find("tr");
        var x = (registros.length-2);
        var celdas = $(registros[x]).children("td");
        var fecha_vieja = $($(celdas[0]).children("input")[2]).val().trim();
        var kilometraje_old = $($(celdas[0]).children("input")[3]).val().trim();

        var fecha1 = moment(fecha_vieja);
        var fecha2 = moment(fecha_nueva);

        //moment().format("DD-MM-YYYY")

        var diferencia = fecha2.diff(fecha1, 'days');

        if(diferencia > 0){
            if(parseFloat(kilometraje_old) >= DistanciaMinima || document.getElementById("justificacion").checked == 1){
                document.getElementById("band_factura").checked = 0;
                document.getElementById("band_factura").disabled = false;
                $.toast({ heading: 'Alojamiento habilitado', text: 'Es posible que haya utilizado alojamiento', position: 'top-right', loaderBg:'#3c763d', icon: 'info', hideAfter: 4000, stack: 6 });
                cambiarFactura();
            }else{
                document.getElementById("band_factura").checked = 0;
                document.getElementById("band_factura").disabled = true;
                cambiarFactura();
            }
        }else{
            document.getElementById("band_factura").checked = 0;
            document.getElementById("band_factura").disabled = true;
            cambiarFactura();
        }
    }

    var total_aloj = 0.00;
    
    function validar_viatico_next(hs,hl){
        var id_mision = $("#id_mision").val();
        var band_viatico = false;
        reg_viaticos = [];
        reg_alojamiento = [];
        total_aloj = 0.00;
        var monto = 0;

        var fecha_ruta_new = $("#fecha_mision").val();
        var kilometraje_new = parseFloat($("#id_distancia option:selected").text().trim());

        var registros = $("#tabla_viaticos").find("tbody").find("tr");
        var x = (registros.length-2);

        var celdas = $(registros[x]).children("td");
        var fecha_ruta_old = $($(celdas[0]).children("input")[2]).val().trim();
        var hora_llegada_old = $(celdas[3]).text().trim();
        var hora_salida_old = $(celdas[2]).text().trim();
        var kilometraje_old = $($(celdas[0]).children("input")[3]).val().trim();

        var id_ruta_old = $($(celdas[0]).children("input")[1]).val().trim();
        var id_oficina_origenes = $("#id_oficina_origen").val().trim(); 

        var fecha1 = moment(fecha_ruta_old);
        var fecha2 = moment(fecha_ruta_new);

        //moment().format("DD-MM-YYYY")

        var diferencia = fecha2.diff(fecha1, 'days');

        var fecha_copy = moment(fecha_ruta_old);    //verifica si la fecha cae sabado o domingo para no contar la diferencia de esos dias
        for(f=0; f<diferencia; f++){                    
            fecha_copy = fecha_copy.add(1,'days');
            if(fecha_copy.format("e") == 6){
                fecha_copy = fecha_copy.add(2,'days');
                diferencia = diferencia - 2;
            }else if(fecha_copy.format("e") == 0){
                fecha_copy = fecha_copy.add(1,'days');
                diferencia = diferencia - 1;
            }
        }

        var ultimo_viatico = "";

        if(parseFloat(kilometraje_old) >= DistanciaMinima){ //si el viatico anterior cumplia con 15 kilometros
            for(h=0; h<viaticos.length; h++){
                if(((hora_salida_old <= viaticos[h][2] && hora_llegada_old >= viaticos[h][2]) || (hora_salida_old >= viaticos[h][2] && hora_salida_old <= viaticos[h][3]))){
                    if(id_ruta_old == id_oficina_origenes){
                        if(!tiene_restriccion(hora_llegada_old, "llegada antigua", viaticos[h][2], viaticos[h][3])){
                            ultimo_viatico = viaticos[h][0];
                        }
                    }else{
                        ultimo_viatico = viaticos[h][0];
                    }
                    
                }
            }
        }

        var id_origen = $("#id_origen").val();
        var id_destino = $("#id_destino").val();
        var restriccion_llegada = "";
        var restriccion_salida = "";

        if(id_origen == id_oficina_origenes){
             for(f=0; f<viaticos.length; f++){
                if( (hs >= viaticos[f][2] && hs <= viaticos[f][3]) ){
                    if(tiene_restriccion(hs, "salida", viaticos[f][2], viaticos[f][3])){
                        restriccion_salida = viaticos[f][0];
                    }
                }
            } 
        }

        if(id_destino == id_oficina_origenes){
             for(f2=0; f2<viaticos.length; f2++){
                if( (hl >= viaticos[f2][2] && hl <= viaticos[f2][3]) ){
                    if(tiene_restriccion(hl, "llegada", viaticos[f2][2], viaticos[f2][3])){
                        restriccion_llegada = viaticos[f2][0];
                    }
                }
            } 
        }

        if(id_ruta_old != id_oficina_origenes){ //Si no ha estado (permanencia) en la oficina de origen, se verifican viáticos

            if(diferencia == 0){    //Si la fecha anterior es igual a la nueva
                var body = $("#body_viaticos_encontrados");
                body.html("");
                hs = hora_llegada_old;
                
                if(kilometraje_old >= DistanciaMinima || document.getElementById("justificacion").checked == 1){ //verifica si la ultima ruta cumplia con 15 Km
                    for(j=0; j<viaticos.length; j++){
                        if(((hs <= viaticos[j][2] && hl >= viaticos[j][2]) || (hs >= viaticos[j][2] && hs <= viaticos[j][3]))){
                            if(viaticos[j][0] != restriccion_salida && viaticos[j][0] != restriccion_llegada){
                                if(viaticos[j][0]!=ultimo_viatico){
                                    band_viatico = true;
                                    reg_viaticos.push([fecha_ruta_new, viaticos[j][0], id_mision, '1', viaticos[j][4]]);
                                    monto += parseFloat(viaticos[j][4]);
                                    var index = reg_viaticos.length;
                                    body.append("<tr>"+
                                                "<td>"+fecha_ruta_new+"</td>"+
                                                "<td>"+viaticos[j][1]+"</td>"+
                                                "<td>"+parseFloat(viaticos[j][4]).toFixed(2)+"</td>"+
                                                "<td>"+gcheckbox(index)+"</td>"+
                                                "</tr>");

                                    ultimo_viatico = viaticos[j][0];
                                }
                            }
                        }
                    }
                }else{
                   $.toast({ heading: 'No cumple con viáticos', text: 'Distancia menor a 15 Km. No cumple con viáticos', position: 'top-right', loaderBg:'#3c763d', icon: 'info', hideAfter: 4000, stack: 6 }); 
                }

                $("#viatico").val(monto.toFixed(2));
            }else{  // sino si la fecha anterior es diferente a la nueva

                var hl2 = hl;
                var body = $("#body_viaticos_encontrados");
                body.html("");
                hl = ultima_hora_llegada;
                if(document.getElementById("band_factura").checked){
                    $("#fecha_alojamiento").val(fecha_ruta_old)
                    fecha_aloj = moment(fecha_ruta_old);
                    for(a=0; a<diferencia; a++){
                        
                        if(fecha_aloj.format("e") == 6){
                            fecha_aloj = fecha_aloj.add(2,'days');
                            //diferencia = diferencia - 2;
                        }else if(fecha_aloj.format("e") == 0){
                            fecha_aloj = fecha_aloj.add(1,'days');
                            //diferencia = diferencia - 1;
                        }

                        reg_alojamiento.push([id_mision, fecha_aloj.format("YYYY-MM-DD"), parseFloat($("#alojamiento").val()).toFixed(2), $("#id_origen").val()]);

                        fecha_aloj = fecha_aloj.add(1,'days');

                    }
                }

                total_aloj = (parseFloat($("#alojamiento").val())*diferencia).toFixed(2);
                hs = hora_llegada_old;

                if(kilometraje_old >= DistanciaMinima || document.getElementById("justificacion").checked == 1){ //verifica si la ultima ruta cumplia con 15 Km                    

                    for(j=0; j<viaticos.length; j++){
                        if(((hs <= viaticos[j][2] && hl >= viaticos[j][2]) || (hs >= viaticos[j][2] && hs <= viaticos[j][3]))){

                            //if(viaticos[j][0] != restriccion_salida && viaticos[j][0] != restriccion_llegada){

                                if(viaticos[j][0]!=ultimo_viatico){
                                    band_viatico = true;
                                    reg_viaticos.push([fecha_ruta_old, viaticos[j][0], id_mision, '1', viaticos[j][4]]);
                                    monto += parseFloat(viaticos[j][4]);
                                    var index = reg_viaticos.length;
                                    body.append("<tr>"+
                                                "<td>"+fecha_ruta_old+"</td>"+
                                                "<td>"+viaticos[j][1]+"</td>"+
                                                "<td>"+parseFloat(viaticos[j][4]).toFixed(2)+"</td>"+
                                                "<td>"+gcheckbox(index)+"</td>"+
                                                "</tr>");
                                }
                            //}
                        }
                    }
                
                    //validacion para los dias nuevos
                    for(f=0; f<diferencia; f++){                   
                        if(f == (diferencia-1)){ //validacion fecha nueva dia 0
                            fecha1 = fecha1.add(1,'days');
                            if(fecha1.format("e") == 6){
                                fecha1 = fecha1.add(2,'days');
                            }else if(fecha1.format("e") == 0){
                                fecha1 = fecha1.add(1,'days');
                            }
                            fecha_ruta_new = fecha1.format("YYYY-MM-DD");
                            hs = primer_hora_salida;
                            hl = hl2;
                            for(j=0; j<viaticos.length; j++){
                                if(((hs <= viaticos[j][2] && hl >= viaticos[j][2]) || (hs >= viaticos[j][2] && hs <= viaticos[j][3]))){
                                    
                                    if(viaticos[j][0] != restriccion_llegada){

                                        band_viatico = true;
                                        reg_viaticos.push([fecha_ruta_new, viaticos[j][0], id_mision, '1', viaticos[j][4]]);
                                        monto += parseFloat(viaticos[j][4]);
                                        var index = reg_viaticos.length;
                                        body.append("<tr>"+
                                                    "<td>"+fecha_ruta_new+"</td>"+
                                                    "<td>"+viaticos[j][1]+"</td>"+
                                                    "<td>"+parseFloat(viaticos[j][4]).toFixed(2)+"</td>"+
                                                    "<td>"+gcheckbox(index)+"</td>"+
                                                    "</tr>");
                                    }
                                }
                            }
                        }else{ //validacion fecha nueva dia > 0   ---> 1,2,3,etc.
                            fecha1 = fecha1.add(1,'days');
                            if(fecha1.format("e") == 6){
                                fecha1 = fecha1.add(2,'days');
                            }else if(fecha1.format("e") == 0){
                                fecha1 = fecha1.add(1,'days');
                            }
                            fecha_ruta_new = fecha1.format("YYYY-MM-DD");
                            hs = primer_hora_salida;
                            hl = ultima_hora_llegada;
                            for(j=0; j<viaticos.length; j++){
                                if(((hs <= viaticos[j][2] && hl >= viaticos[j][2]) || (hs >= viaticos[j][2] && hs <= viaticos[j][3]))){
                                    if(!tiene_restriccion(hs, hl, viaticos[j][2], viaticos[j][3]) || $("#hora_salida").val() >= viaticos[j][2]){
                                        band_viatico = true;
                                        reg_viaticos.push([fecha_ruta_new, viaticos[j][0], id_mision, '1', viaticos[j][4]]);
                                        monto += parseFloat(viaticos[j][4]);
                                        var index = reg_viaticos.length;
                                        body.append("<tr>"+
                                                    "<td>"+fecha_ruta_new+"</td>"+
                                                    "<td>"+viaticos[j][1]+"</td>"+
                                                    "<td>"+parseFloat(viaticos[j][4]).toFixed(2)+"</td>"+
                                                    "<td>"+gcheckbox(index)+"</td>"+
                                                    "</tr>");
                                    }
                                }
                            }
                        }
                    }
                }else{
                    $.toast({ heading: 'No cumple con viáticos', text: 'Distancia menor a 15 Km. No cumple con viáticos', position: 'top-right', loaderBg:'#3c763d', icon: 'info', hideAfter: 4000, stack: 6 }); 
                }

                $("#viatico").val(monto.toFixed(2));
            }

        }else{
            var body = $("#body_viaticos_encontrados");
                body.html("");
                
                if(kilometraje_old >= DistanciaMinima || document.getElementById("justificacion").checked == 1){ //verifica si la ultima ruta cumplia con 15 Km
                    for(j=0; j<viaticos.length; j++){
                        if(((hs <= viaticos[j][2] && hl >= viaticos[j][2]) || (hs >= viaticos[j][2] && hs <= viaticos[j][3]))){
                            if(viaticos[j][0] != restriccion_salida && viaticos[j][0] != restriccion_llegada){
                                if(viaticos[j][0]!=ultimo_viatico){
                                    band_viatico = true;
                                    reg_viaticos.push([fecha_ruta_new, viaticos[j][0], id_mision, '1', viaticos[j][4]]);
                                    monto += parseFloat(viaticos[j][4]);
                                    var index = reg_viaticos.length;
                                    body.append("<tr>"+
                                                "<td>"+fecha_ruta_new+"</td>"+
                                                "<td>"+viaticos[j][1]+"</td>"+
                                                "<td>"+parseFloat(viaticos[j][4]).toFixed(2)+"</td>"+
                                                "<td>"+gcheckbox(index)+"</td>"+
                                                "</tr>");

                                    ultimo_viatico = viaticos[j][0];
                                }
                            }
                        }
                    }
                }else{
                   $.toast({ heading: 'No cumple con viáticos', text: 'Distancia menor a 15 Km. No cumple con viáticos', position: 'top-right', loaderBg:'#3c763d', icon: 'info', hideAfter: 4000, stack: 6 }); 
                }

                $("#viatico").val(monto.toFixed(2));
        }

        return band_viatico;
    }



    function calcular_alojamiento(hs,hl){
        var id_mision = $("#id_mision").val();
        var band_viatico = false;
        //reg_viaticos = [];
        reg_alojamiento = [];
        total_aloj = 0.00;
        var monto = 0;

        var fecha_ruta_new = $("#fecha_mision").val();
        var kilometraje_new = parseFloat($("#id_distancia option:selected").text().trim());

        var registros = $("#tabla_viaticos").find("tbody").find("tr");
        var x = (registros.length-2);

        var celdas = $(registros[x]).children("td");
        var fecha_ruta_old = $($(celdas[0]).children("input")[2]).val().trim();
        var hora_llegada_old = $(celdas[3]).text().trim();
        var hora_salida_old = $(celdas[2]).text().trim();
        var kilometraje_old = $($(celdas[0]).children("input")[3]).val().trim();

        var id_ruta_old = $($(celdas[0]).children("input")[1]).val().trim();
        var id_oficina_origenes = $("#id_oficina_origen").val().trim(); 

        var fecha1 = moment(fecha_ruta_old);
        var fecha2 = moment(fecha_ruta_new);

        //moment().format("DD-MM-YYYY")

        var diferencia = fecha2.diff(fecha1, 'days');

        var fecha_copy = moment(fecha_ruta_old);    //verifica si la fecha cae sabado o domingo para no contar la diferencia de esos dias
        for(f=0; f<diferencia; f++){                    
            fecha_copy = fecha_copy.add(1,'days');
            if(fecha_copy.format("e") == 6){
                fecha_copy = fecha_copy.add(2,'days');
                diferencia = diferencia - 2;
            }else if(fecha_copy.format("e") == 0){
                fecha_copy = fecha_copy.add(1,'days');
                diferencia = diferencia - 1;
            }
        }

        if(id_ruta_old != id_oficina_origenes){ //Si no ha estado (permanencia) en la oficina de origen, se verifican viáticos

            if(diferencia == 0){    //Si la fecha anterior es igual a la nueva
                
            }else{  // sino si la fecha anterior es diferente a la nueva

                var hl2 = hl;
                var body = $("#body_viaticos_encontrados");
                body.html("");
                hl = ultima_hora_llegada;
                if(document.getElementById("band_factura").checked){
                    $("#fecha_alojamiento").val(fecha_ruta_old)
                    fecha_aloj = moment(fecha_ruta_old);
                    for(a=0; a<diferencia; a++){
                        
                        if(fecha_aloj.format("e") == 6){
                            fecha_aloj = fecha_aloj.add(2,'days');
                            //diferencia = diferencia - 2;
                        }else if(fecha_aloj.format("e") == 0){
                            fecha_aloj = fecha_aloj.add(1,'days');
                            //diferencia = diferencia - 1;
                        }

                        reg_alojamiento.push([id_mision, fecha_aloj.format("YYYY-MM-DD"), parseFloat($("#alojamiento").val()).toFixed(2), $("#id_origen").val()]);

                        fecha_aloj = fecha_aloj.add(1,'days');

                    }
                }

                total_aloj = (parseFloat($("#alojamiento").val())*diferencia).toFixed(2);
            }

        }

    }




    function verificar_viaticos(){
        var hora_salida = $("#hora_salida").val();
        var hora_llegada = $("#hora_llegada").val();
        var distancia = parseFloat($("#id_distancia option:selected").text().trim());
        var visibles = [];
        var hay_viaticos = false;


        var id_origenes = $("#id_origen").val();
        var id_destinos = $("#id_destino").val();
        var id_oficina_origenes =  $("#id_oficina_origen").val();

        if((hora_salida != "" && hora_llegada != "") && (hora_salida < hora_llegada)){


            /******************** Validación de que al salir de la oficina cumpla con 15 km ***************************************/
            /*if(id_origenes == id_oficina_origenes){
                hora_salida = convertir_salida(distancia);
                $.toast({ heading: 'Saliendo de la oficina', text: 'Alcanzó los 15 Km aproximadamente a las '+hora_salida, position: 'top-right', loaderBg:'#3c763d', icon: 'info', hideAfter: 6000, stack: 6 });
            }

            if(id_destinos == id_oficina_origenes){
                hora_llegada = convertir_llegada(distancia);
                $.toast({ heading: 'Llegando de la oficina', text: 'Entró en el radio de 15 Km aproximadamente a las '+hora_llegada, position: 'top-right', loaderBg:'#3c763d', icon: 'info', hideAfter: 6000, stack: 6 });
            }*/

            if(contar_registros_tabla_viaticos() == 0){
                hay_viaticos = validar_viatico_first(hora_salida,hora_llegada);
            }else{
                hay_viaticos = validar_viatico_next(hora_salida,hora_llegada);
            }

            if(hay_viaticos){
                $("#myModal").modal("show");
            }else{
                $.toast({ heading: 'No hay viáticos', text: 'Viáticos no disponibles', position: 'top-right', loaderBg:'#3c763d', icon: 'warning', hideAfter: 4000, stack: 6 });
                            bandera = false;
            }

            /*hay_viaticos = recorre_tabla(visibles);
            if(hay_viaticos){
                $("#myModal").modal("show");
            }else{
                $.toast({ heading: 'No hay viáticos', text: 'Viáticos no disponibles', position: 'top-right', loaderBg:'#3c763d', icon: 'warning', hideAfter: 4000, stack: 6 });
                            bandera = false;
            }*/

        }else{
            if(hora_salida == "" || hora_llegada == ""){
                swal({ title: "Horario no válido", text: "Completa la hora de salida y llegada del lugar visitado", type: "warning", showConfirmButton: true });
            }else if(hora_salida > hora_llegada){
                swal({ title: "Horario no válido", text: "La hora de salida debe ser menor a la hora de llegada", type: "warning", showConfirmButton: true });
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

    function tiene_restriccion(hora, text, viatico_inicio, viatico_fin){
        var band_rest = false;

        if((hora >= viatico_inicio && hora <= viatico_fin)){

            for(i=0; i<restricciones.length; i++){
                if(hora >= restricciones[i][2] && hora <= restricciones[i][3]){
                    band_rest = true;
                    $.toast({ heading: 'Restricción hora '+text, text: restricciones[i][1]+': '+restricciones[i][2]+" - "+restricciones[i][3], position: 'top-right', loaderBg:'#000', icon: 'warning', hideAfter: 4000, stack: 6 });
                }
            }

        }

        return band_rest;
    }

    function validar_factura(){
        var bandera = false;
        var alojamiento = parseFloat($("#alojamiento").val().trim());

        if(document.getElementById("band_factura").checked == 1 && $("#band_viatico").val() != "delete"){
            if($("#file").data("defaultFile") != "" && alojamiento > 0){
                bandera = true;
            }else{
                if($("#file").val() != "" && alojamiento > 0){
                    bandera = true;
                }else{
                    if($("#file").val() == ""){
                        swal({ title: "Falta factura", text: "Debes comprobar tu pago alojamiento subiendo una imagen de la factura que recibiste.", type: "warning", showConfirmButton: true });
                    }else{
                        swal({ title: "Monto alojamiento", text: "Debes ingresar el monto que se incurrió en alojamiento", type: "warning", showConfirmButton: true });
                    }
                    
                }
            }
        }else{
            bandera = true;
        }

        return bandera;
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
                        if(hora_salida <= hora_llegada2 || hora_llegada <= hora_llegada2){
                            $.toast({ heading: 'Horario inválido', text: 'El nuevo registro debe respetar el orden ascendente de las fechas y horas', position: 'top-right', loaderBg:'#3c763d', icon: 'warning', hideAfter: 4000, stack: 6 });
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

    function iniciar(){
        <?php if(tiene_permiso($segmentos=2,$permiso=1)){ ?>
            tabla_solicitudes();
            cargarViaticos();
        <?php }else{ ?>
            $("#cnt_tabla").html("Usted no tiene permiso para este formulario.");     
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

    var estado_pestana = "";
    function cambiar_pestana(tipo){
        estado_pestana = tipo;
        tabla_solicitudes();
    }

    function tabla_solicitudes(){
        var nr_empleado = $("#nr_search").val();

        if(window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttpB=new XMLHttpRequest();
        }else{// code for IE6, IE5
            xmlhttpB=new ActiveXObject("Microsoft.XMLHTTPB");
        }
        xmlhttpB.onreadystatechange=function(){
            if (xmlhttpB.readyState==4 && xmlhttpB.status==200){
                document.getElementById("cnt_tabla_solicitudes").innerHTML=xmlhttpB.responseText;
                $('#myTable').DataTable();
                $('[data-toggle="tooltip"]').tooltip();
            }
        }
        xmlhttpB.open("GET","<?php echo site_url(); ?>/viaticos/solicitud_viatico/tabla_solicitudes?nr="+nr_empleado+"&tipo="+estado_pestana,true);
        xmlhttpB.send(); 
    }

    function cerrar_mantenimiento(){
        $("#cnt_tabla").show(0);
        $("#cnt_form").hide(0);
    }

    function informacion_empleado(callback){
        var id_mision = $("#id_mision").val();
        var nr_usuario = $("#nr").val();
        var fecha1 = $("#fecha_mision_inicio").val();
        var fecha2 = $("#fecha_mision_fin").val();
        if(window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp_municipio=new XMLHttpRequest();
        }else{// code for IE6, IE5
            xmlhttp_municipio=new ActiveXObject("Microsoft.XMLHTTPB");
        }

        xmlhttp_municipio.onreadystatechange=function(){
            if (xmlhttp_municipio.readyState==4 && xmlhttp_municipio.status==200){
                  document.getElementById("cnt_informacion_empleado").innerHTML=xmlhttp_municipio.responseText;
                    
                    var newf1 = fecha1.split('-');
                    newf1.reverse();
                    newf1 = newf1.join('-');
                    newf1 = moment(newf1);
                    var newf2 = fecha2.split('-');
                    newf2.reverse();
                    newf2 = newf2.join('-');
                    newf2 = moment(newf2);

                    var diferencia = newf2.diff(newf1, 'days');

                    if(diferencia > 30){
                        $("#fecha_mision_fin").datepicker("setDate", fecha1 );
                    }

                    if(diferencia < 0){
                        $("#fecha_mision_fin").datepicker("setDate", fecha1 );
                        $.toast({ heading: 'Orden de fecha', text: "La fecha de inicio no puede ser mayor a la fecha de fin", position: 'top-right', loaderBg:'#000', icon: 'warning', hideAfter: 4000, stack: 6 });
                    }

                    if(typeof callback == "function"){
                        callback();
                    }
            }
        }
        xmlhttp_municipio.open("GET","<?php echo site_url(); ?>/viaticos/solicitud_viatico/informacion_empleado?nr_usuario="+nr_usuario+"&fecha1="+fecha1+"&fecha2="+fecha2+"&id_mision="+id_mision,true);
        xmlhttp_municipio.send();
    }

    var primer_fecha_inicio = "";
    var primer_fecha_fin = "";

    var ultima_fecha_inicio = "";
    var ultima_fecha_fin = "";

    function validar_dia_limite(estado_solicitud, bandera, fecha_rev_obs){
        var lim_start = 13;
        var days = 1;

        if(bandera == "save"){

            var limite_inicio =  moment().subtract(lim_start,'days');
            var limite_fin =  moment().subtract(1,'days');

            if(limite_fin.format("e") == 0){
                limite_fin.subtract(2,'days');
            }else if(limite_fin.format("e") == 6){
                limite_fin.subtract(1,'days');
            }

            if(moment().format("e") == 0){
                limite_inicio.add(1,'days');
            }else if(moment().format("e") == 6){
                limite_inicio.add(2,'days');
            }

            $("#fecha_mision_inicio").datepicker("setStartDate", limite_inicio.format("DD-MM-YYYY") );
            $("#fecha_mision_fin").datepicker("setStartDate", limite_fin.format("DD-MM-YYYY") );

            primer_fecha_inicio = limite_inicio.format("DD-MM-YYYY");
            primer_fecha_fin = limite_fin.format("DD-MM-YYYY");

            var hoy = moment();
            if(hoy.format("e") == 6){
                hoy.add(2,'days');
            }else if(hoy.format("e") == 0){
                hoy.add(1,'days');
            }

            ultima_fecha_inicio = hoy.format("DD-MM-YYYY");
            ultima_fecha_fin = hoy.format("DD-MM-YYYY");

            $("#fecha_mision_inicio").datepicker("setEndDate", hoy.format("DD-MM-YYYY") );
            $("#fecha_mision_fin").datepicker("setEndDate", hoy.format("DD-MM-YYYY") );

        }else if(bandera == "edit"){
            if(estado_solicitud == "0"){

                var limite_inicio =  moment().subtract(lim_start,'days');
                var limite_fin =  moment().subtract(1,'days');

                var fecha_fin_mision = moment(fecha_rev_obs).add(1,'days');
                var diferencia = 0;

                if(limite_fin.format("e") == 0){
                    limite_fin.subtract(2,'days');
                }else if(limite_fin.format("e") == 6){
                    limite_fin.subtract(1,'days');
                }

                if(fecha_fin_mision.format("e") == 0){
                    fecha_fin_mision.add(1,'days');
                }else if(limite_fin.format("e") == 6){
                    fecha_fin_mision.add(2,'days');
                }

                /*if(moment().format("e") == 0){
                    limite_inicio.add('days',1);
                }else if(moment().format("e") == 6){
                    limite_inicio.add('days',2);
                }*/

                primer_fecha_inicio = limite_inicio.format("DD-MM-YYYY");
                primer_fecha_fin = limite_fin.format("DD-MM-YYYY");

                if(document.getElementById("justificacion").checked == 1){
                    $("#fecha_mision_inicio").datepicker("setStartDate", "" );
                    $("#fecha_mision_fin").datepicker("setStartDate", "" );
                }else{
                    $("#fecha_mision_inicio").datepicker("setStartDate", limite_inicio.format("DD-MM-YYYY") );
                    $("#fecha_mision_fin").datepicker("setStartDate", limite_fin.format("DD-MM-YYYY") );
                }

                var hoy = moment();
                if(hoy.format("e") == 6){
                    hoy.add(2,'days');
                }else if(hoy.format("e") == 0){
                    hoy.add(1,'days');
                }

                ultima_fecha_inicio = hoy.format("DD-MM-YYYY");
                ultima_fecha_fin = hoy.format("DD-MM-YYYY");

                $("#fecha_mision_inicio").datepicker("setEndDate", hoy.format("DD-MM-YYYY") );
                $("#fecha_mision_fin").datepicker("setEndDate", hoy.format("DD-MM-YYYY") );

                diferencia = limite_fin.diff(fecha_fin_mision, 'days');

                if(diferencia > 0){
                    $.toast({ heading: 'Fecha vencida', text: "La ultima fecha para crear su solicitud fué el: "+fecha_fin_mision.format("DD-MM-YYYY"), position: 'top-right', loaderBg:'#000', icon: 'error', hideAfter: 4000, stack: 6 });
                }else{
                    if(document.getElementById("justificacion").checked == 1){
                        $.toast({ heading: 'Advertencia', text: "Envíe su solicitud lo antes posible", position: 'top-right', loaderBg:'#000', icon: 'warning', hideAfter: 4000, stack: 6 });
                    }else{
                        $.toast({ heading: 'Última fecha', text: "La ultima fecha para crear su solicitud es: "+fecha_fin_mision.format("DD-MM-YYYY"), position: 'top-right', loaderBg:'#000', icon: 'warning', hideAfter: 4000, stack: 6 });
                    }
                }

            }else{

                var limite_inicio =  moment(fecha_rev_obs).subtract(lim_start,'days');
                var limite_fin =  moment(fecha_rev_obs).subtract(1,'days');

                var diferencia = 0;
                var newdate = moment(fecha_rev_obs);

                if(limite_fin.format("e") == 0){
                    limite_fin.subtract(2,'days');
                }else if(limite_fin.format("e") == 6){
                    limite_fin.subtract(1,'days');
                }

                /*if(moment().format("e") == 0){
                    limite_inicio.add('days',1);
                }else if(moment().format("e") == 6){
                    limite_inicio.add('days',2);
                }*/

                primer_fecha_inicio = limite_inicio.format("DD-MM-YYYY");
                primer_fecha_fin = limite_fin.format("DD-MM-YYYY");

                if(document.getElementById("justificacion").checked == 1){
                    $("#fecha_mision_fin").datepicker("setStartDate", "" );
                    $("#fecha_mision_inicio").datepicker("setStartDate", "" );
                }else{
                    $("#fecha_mision_fin").datepicker("setStartDate", limite_fin.format("DD-MM-YYYY") );
                    $("#fecha_mision_inicio").datepicker("setStartDate", limite_inicio.format("DD-MM-YYYY") );
                }

                ultima_fecha_inicio = newdate.format("DD-MM-YYYY");
                ultima_fecha_fin = newdate.format("DD-MM-YYYY");

                $("#fecha_mision_inicio").datepicker("setEndDate", newdate.format("DD-MM-YYYY") );
                $("#fecha_mision_fin").datepicker("setEndDate", newdate.format("DD-MM-YYYY") );

                //diferencia = limite_fin.diff(fecha_fin_mision, 'days')

                /*if(diferencia > 0){
                    $.toast({ heading: 'Fecha vencida', text: "La ultima fecha para crear su solicitud fué el: "+fecha_fin_mision.format("DD-MM-YYYY"), position: 'top-right', loaderBg:'#000', icon: 'error', hideAfter: 4000, stack: 6 });
                }else{
                    $.toast({ heading: 'Última fecha', text: "La ultima fecha para crear su solicitud es: HOY", position: 'top-right', loaderBg:'#000', icon: 'warning', hideAfter: 4000, stack: 6 });
                }*/

            }
        }

        return "fin";

    }

    function convert_lim_text(lim){
        var tlim = "-"+lim+"d";
        return tlim;
    }

    function cambiar_nuevo(){
        $("#id_mision").val("");
        $("#nr").val("").trigger('change.select2');
        $("#nombre_empresa").val("");
        $("#direccion_empresa").val("");
        $("#id_actividad").val("").trigger('change.select2');
        $("#detalle_actividad").val('');

        document.getElementById("file3[]").value = "";

        validar_dia_limite("0", "save");

        var nueva_fecha =  moment();

        if(nueva_fecha.format("e") == 6){
            nueva_fecha.add(2,'days');
        }else if(nueva_fecha.format("e") == 0){
            nueva_fecha.add(1,'days');
        }

        document.getElementById("justificacion").checked = 0;
        cambiarJustificacion();

        $("#fecha_mision_inicio").datepicker("setDate", nueva_fecha.format("DD-MM-YYYY") );
        $("#fecha_mision_fin").datepicker("setDate", nueva_fecha.format("DD-MM-YYYY") );

        $("#ttl_form").addClass("bg-success");
        $("#ttl_form").removeClass("bg-info");

        $("#btnadd").show(0);
        $("#btnedit").hide(0);

        $("#cnt_tabla").hide(0);
        $("#cnt_form").show(0);

        form_mision();

        $("#band").val("save");

        $("#ttl_form").children("h4").html("<span class='mdi mdi-plus'></span> Nueva solicitud de viáticos y pasajes");
    }

    function cambiar_editar(id,nr,fecha_mision_inicio,fecha_mision_fin,actividad_realizada,detalle_actividad,estado,ruta_justificacion,fecha_solicitud,fecha_observacion,oficina_solicitante,bandera){

        $("#id_mision").val(id);
        $("#nr").val(nr).trigger('change.select2');
        $("#nombre_empresa").val("");
        $("#direccion_empresa").val("");
        $("#detalle_actividad").val(detalle_actividad);
        $('#id_actividad').val(actividad_realizada).trigger('change.select2');
        if(actividad_realizada == "7"){
            $("#cnt_oficina_solicitante").show(500);
            $('#oficina_solicitante').val(oficina_solicitante).trigger('change.select2');
        }else{
            $("#cnt_oficina_solicitante").hide(500);
            $("#oficina_solicitante").val("").trigger("change.select2");
        }

        document.getElementById("file3[]").value = "";

        var observacion_habilitada = true;

        if(estado == "2" || estado == "4" || estado == "6"){
            var ufobservacion = moment(fecha_observacion).add(1,'days');
            var fhoy = moment();

            var reducir = 0;

            if(ufobservacion.format("e") == 6){
                ufobservacion.add(2,'days');
                reducir = 2;
            }else if(ufobservacion.format("e") == 0){
                ufobservacion.add(1,'days');
                reducir = 1;
            }

            var fecha2 = moment(ufobservacion.format("YYYY-MM-DD"));
            var fecha1 = moment(fhoy.format("YYYY-MM-DD"));

            var diferencia = fecha2.diff(fecha1, 'days');     

            var plazo = diferencia - reducir;

            if(plazo == 0){
                var texto = "Ultimo día para corregir observaciones: HOY";
            }else{
                var texto = "Ultimo día para corregir observaciones: "+ufobservacion.format("DD-MM-YYYY");
            }

            if(diferencia < 0){
                observacion_habilitada = false;
            }else{
                $.toast({ heading: 'Plazo de observaciones', text: texto, position: 'top-right', loaderBg:'#3c763d', icon: 'warning', hideAfter: 4000, stack: 6 });
            }
        }

        var date = fecha_mision_fin;
        var newdate = date.split("-").reverse().join("-");

        $("#cnt_mapa").animate({height: '0', opacity: '0'}, 750);

        if(bandera == "edit"){
            $('#summernote').val(ruta_justificacion);
            if(observacion_habilitada){
                $("#band").val(bandera);
                observaciones(id);
                aplicar(ruta_justificacion);
                if(estado == "0"){
                    valor = validar_dia_limite(estado, "edit", newdate);
                }else{
                    valor = validar_dia_limite(estado, "edit", fecha_solicitud);
                }
                $("#fecha_mision_inicio").datepicker("setDate", fecha_mision_inicio );
                $("#fecha_mision_fin").datepicker("setDate", fecha_mision_fin );
                form_mision();
                $("#ttl_form").removeClass("bg-success");
                $("#ttl_form").addClass("bg-info");
                $("#btnadd").hide(0);
                $("#btnedit").show(0);
                $("#cnt_tabla").hide(0);
                $("#cnt_form").show(0);
                $("#ttl_form").children("h4").html("<span class='fa fa-wrench'></span> Editar solicitud de viáticos y pasajes");     
            }else{
                swal({ title: "Plazo agotado", text: "El plazo de observaciones finalizó el: "+ufobservacion.format("DD-MM-YYYY"), type: "error", showConfirmButton: true });
            }       
        }else{
            document.getElementById("justificacion").checked = 0;
            cambiarJustificacion();
            $("#fecha_mision_inicio").datepicker("setDate", fecha_mision_inicio );
            $("#fecha_mision_fin").datepicker("setDate", fecha_mision_fin );
            eliminar_mision();
        }
        $( "html, body" ).animate({scrollTop:0}, '500');
        $('[data-toggle="tooltip"]').tooltip();
    }

    function aplicar(ruta_justificacion){
        if(ruta_justificacion == ""){
            document.getElementById("justificacion").checked = 0;
            cambiarJustificacion();
        }else{
            document.getElementById("justificacion").checked = 1;
            cambiarJustificacion("<?php echo base_url(); ?>"+ruta_justificacion);
        }
    }

    function observaciones(id_mision){    
        if(window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttpB=new XMLHttpRequest();
        }else{// code for IE6, IE5
            xmlhttpB=new ActiveXObject("Microsoft.XMLHTTPB");
        }
        xmlhttpB.onreadystatechange=function(){
            if (xmlhttpB.readyState==4 && xmlhttpB.status==200){
                document.getElementById("cnt_observaciones").innerHTML=xmlhttpB.responseText;
                $('[data-toggle="tooltip"]').tooltip();
                form_mision();
            }
        }
        xmlhttpB.open("GET","<?php echo site_url(); ?>/viaticos/solicitud_viatico/observaciones?id_mision="+id_mision,true);
        xmlhttpB.send(); 
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
        cuantos = $("body").find(".tooltip.fade.show").hide(3000);
        $("#fechas_repetidas2").html($("#fechas_repetidas").html());
        tabla_empresas_visitadas(function(){ form_oficinas() });
        $("#cnt_mision").hide(0);
        $("#cnt_rutas").show(0);
        $("#cnt_viaticos").hide(0);
        document.getElementById("destino_oficina").checked = true;
        $( "html, body" ).animate({scrollTop:0}, '500');

        //setTimeout(function(){ $("body").find(".tooltip.fade.show").hide(0); }, 600);
        var myVar = setTimeout(alertFunc, 700);
    }

    function alertFunc() {
        $('[data-toggle="tooltip"]').tooltip()
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
        $("#nombre_empresa").parent().parent().hide(0);
        $("#direccion_empresa").parent().hide(0);
        $("#municipio").parent().hide(0);
        $("#nombre_empresa").val("");
        $("#direccion_empresa").val("");
        $("#id_ruta_visitada").val("");
        name_company = "";
        address_company = "";
        id_ruta_visitada = "";
        combo_oficina_departamento("oficina");
    }

    var id_departamento_mapa = "";
    var id_municipio_mapa = "";

    function combo_oficina_departamento(tipo){
        var nr = $("#nr").val();
    	var newName = 'Otro nombre',
    	xhr = new XMLHttpRequest();

		xhr.open('GET', "<?php echo site_url(); ?>/viaticos/solicitud_viatico/combo_oficinas_departamentos?tipo="+tipo+"&nr="+nr);
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
                        $("#nombre_empresa").parent().parent().hide(0);
                        $("#direccion_empresa").parent().hide(0);
                        $("#municipio").parent().hide(0);
                    }else{
                        $("#nombre_empresa").parent().parent().hide(0);
                        $("#direccion_empresa").parent().hide(0);
                        $("#municipio").parent().hide(0);
                        $("#nombre_empresa").val("");
                        $("#direccion_empresa").val("");
                    }
                    input_distancia(tipo);
              	}else if(tipo == "departamento"){
                    $("#nombre_empresa").parent().parent().show(0);
                    $("#direccion_empresa").parent().show(0);
                    $("#municipio").parent().show(0);
                    input_distancia(tipo);
              	}else if(tipo == "mapa"){
                    $("#nombre_empresa").parent().parent().show(0);
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
        var id_oficina_origen = $("#id_oficina_origen").val();

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
                  var destino_mun = document.getElementById('destino_municipio').checked;
                  var dist = parseFloat($("#distancia").val())
                  if(dist == 0 && destino_mun == 1){
                    $("#address").val($("#municipio option:selected").text().trim()+", "+$("#departamento option:selected").text().trim())
                    $("#submit_ubi").click();
                  }
            }
        }
        xmlhttp_municipio.open("GET","<?php echo site_url(); ?>/viaticos/solicitud_viatico/input_distancia?id_departamento="+id_departamento+"&id_municipio="+id_municipio+"&id_oficina_origen="+id_oficina_origen+"&tipo="+tipo+"&distancia="+distancia_total_mapa,true);
        xmlhttp_municipio.send();
    }

    function form_folleto_viaticos(){
        $("#bntmap1").hide(0);
        $("#bntmap2").hide(0);
        $("#cnt_mapa").animate({height: '0', opacity: '0'}, 750);
        combo_oficina_departamento("departamento");
        $("#nombre_empresa").parent().parent().show(0);
        $("#direccion_empresa").parent().show(0);
        $("#municipio").parent().show(0);
        $("#nombre_empresa").val("");
        $("#direccion_empresa").val("");
        $("#id_ruta_visitada").val("");
        name_company = "";
        address_company = "";
        id_ruta_visitada = "";

        var container = document.getElementById("input-div");
        container.innerHTML= '<input type="text" class="controlers" id="search_input" placeholder="Escribe una ubicación a buscar"/>';
        LatOrigen = {       //Contiene la ubicación de la oficina de origen del usuario
            lat: parseFloat($("#latitud_oficina").val()), 
            lng: parseFloat($("#longitud_oficina").val())
        };
        initMap()
        //$("#bntmap1").show(0);
        //$("#bntmap2").show(0);

        //$("#cnt_mapa").animate({height: '500px', opacity: '1'}, 750);
        //$.when(initMap()).then($("#dirigir").click());

    }

    function form_mapa(){
        var container = document.getElementById("input-div");
        container.innerHTML= '<input type="text" class="controlers" id="search_input" placeholder="Escribe una ubicación a buscar"/>';
        LatOrigen = {       //Contiene la ubicación de la oficina de origen del usuario
            lat: parseFloat($("#latitud_oficina").val()), 
            lng: parseFloat($("#longitud_oficina").val())
        };

        $("#bntmap1").show(0);
        $("#bntmap2").show(0);

        $("#cnt_mapa").animate({height: '500px', opacity: '1'}, 750);
        $.when(initMap()).then($("#dirigir").click());

        combo_oficina_departamento("mapa");
        $("#nombre_empresa").parent().parent().show(0);
        $("#direccion_empresa").parent().show(0);
        $("#municipio").parent().show(0);
        $("#nombre_empresa").val("");
        $("#direccion_empresa").val("");
    }

    function finalizarBusquedaMapa(){
        $("#cnt_mapa").animate({height: '0', opacity: '0'}, 750);

        if(name_company == ""){
            $("#nombre_empresa").val("");
            $("#direccion_empresa").val(direccion_mapa);
            $("#id_ruta_visitada").val("");
        }else{
            $("#nombre_empresa").val(name_company);
            $("#direccion_empresa").val(address_company);
            $("#id_ruta_visitada").val(id_ruta_visitada);
        }
        var municipio = municipio_mayus(direccion_mapa);
        obtener_id_municipio(municipio);
        name_company = "";
        address_company = "";
        id_ruta_visitada = "";
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
                    if (document.getElementById("justificacion").checked) {
                        $("#band_factura").removeAttr("disabled");
                    } else {
                        $("#band_factura").attr("disabled", true);
                    }
                    tabla_empresas_viaticos(tipo);
            }
        }
        xmlhttp_municipio.open("GET","<?php echo site_url(); ?>/viaticos/solicitud_viatico/form_empresas_viaticos?id_mision="+id_mision+"&nr="+nr+"&tipo="+tipo,true);
        xmlhttp_municipio.send();
    }

    function tabla_viaticos_encontrados(id_ruta_visitada){
        var id_mision = $("#id_mision").val();
        if(window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp_municipio=new XMLHttpRequest();
        }else{// code for IE6, IE5
            xmlhttp_municipio=new ActiveXObject("Microsoft.XMLHTTPB");
        }
        xmlhttp_municipio.onreadystatechange=function(){
            if (xmlhttp_municipio.readyState==4 && xmlhttp_municipio.status==200){
                  document.getElementById("cnt_viaticos_encontrados").innerHTML=xmlhttp_municipio.responseText;
                    $('[data-toggle="tooltip"]').tooltip();
                    $("#modal_viaticos").modal("show");
            }
        }
        xmlhttp_municipio.open("GET","<?php echo site_url(); ?>/viaticos/solicitud_viatico/tabla_viaticos_encontrados?id_ruta_visitada="+id_ruta_visitada+"&id_mision="+id_mision,true);
        xmlhttp_municipio.send();
    }

    function form_viaticos(){
        $( "html, body" ).animate({scrollTop:0}, '500');
        $('[data-toggle="tooltip"]').tooltip();
        $("#cnt_mapa").animate({height: '0px', opacity: '0'}, 750);
        $("#cnt_mision").hide(0);
        $("#cnt_rutas").hide(0);
        $("#cnt_viaticos").show(0);
        $("#fechas_repetidas3").html($("#fechas_repetidas").html());
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
            $("#cnt_alojamiento").show(500);
            $("#cnt_fecha_alojamiento").show(500);
    	}else{
    		$("#factura").hide(500);
            $("#cnt_alojamiento").hide(500);
            $("#cnt_fecha_alojamiento").hide(500);
            $("#alojamiento").val("0.00");
    	}
    }

    function buscar_idmision(){
        var nr = $("#nr").val();

        ajax = objetoAjax();
        ajax.open("POST", "<?php echo site_url(); ?>/viaticos/solicitud_viatico/obtener_ultima_mision", true);
        ajax.onreadystatechange = function() {
            if (ajax.readyState == 4){
                $("#id_mision").val(ajax.responseText);
                informacion_empleado(function(){ form_rutas() });
            }
        } 
        ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded"); 
        ajax.send("&nr="+nr)
    }

    function cambiar_editar_viatico(id_viatico, id_origen, id_destino, hora_salida, hora_llegada, pasaje, viatico, alojamiento, horarios, fecha, id_mision, factura, kilometraje,band){
        $("#id_empresa_viatico").val(id_viatico);
        $("#id_origen").val(id_origen);
        $("#id_destino").val(id_destino);
        $("#hora_salida").val(hora_salida);
        $("#hora_llegada").val(hora_llegada);
        $("#horarios").val(horarios);
        $("#pasaje").val(pasaje);
        $("#viatico").val(viatico);

        $("#band_viatico").val(band);
        $("#btnadd3").hide(0);
        $("#btnedit3").show(0);

        if(band == "edit"){
            var ruta = "";
            $("#fecha_mision").val(fecha);
            $("#id_distancia").val(id_destino);
            $("#alojamiento").val(alojamiento);
            cambiarkilometraje(id_destino)
            if(parseFloat(alojamiento) > 0){
                document.getElementById("band_factura").checked = 0;
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
        window.open("<?php echo site_url(); ?>/viaticos/solicitud_viatico/imprimir_solicitud_detallada?id_mision="+id_mision, '_blank');
    }

    function verificar_fechas(){
        var id_mision = $("#id_mision").val();
        var fecha1 = $("#fecha_mision_inicio").val();
        var fecha2 = $("#fecha_mision_fin").val();
        var nr = $("#nr").val();

        var filas = $("#tabla_viaticos").find("tbody").find("tr");
        var celdas, hora1, hora2;

        for(l=0; l < (filas.length-1); l++){
            celdas = $(filas[l]).children("td");

            if(l==0){
                hora1 = $(celdas[2]).text().trim();
            }

            if(l == (filas.length-2)){
                hora2 = $(celdas[3]).text().trim();
            }
        }

        ajax = objetoAjax();
        ajax.open("POST", "<?php echo site_url(); ?>/viaticos/solicitud_viatico/fecha_repetida", true);
        ajax.onreadystatechange = function() {
            if (ajax.readyState == 4){
                $("#area").val(ajax.responseText)
                if(ajax.responseText == "exito"){
                    recorre_observaciones();
                }else if(ajax.responseText == "fecha_repetida"){
                    swal({ title: "Choque de misiones", text: "La fecha y hora de esta misión se coincide con el de otra misión", type: "warning", showConfirmButton: true });
                }else{
                    swal({ title: "¡Ups! Error", text: "Intentalo nuevamente.", type: "error", showConfirmButton: true });
                }           
            }
        } 
        ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded"); 
        ajax.send("&id_mision="+id_mision+"&fecha1="+fecha1+"&fecha2="+fecha2+"&hora1="+hora1+"&hora2="+hora2+"&nr="+nr)
    }

    function convertToTime(hour){
        var contenedor = (hour.toString()).split(".");
        var hours = parseInt(contenedor[0]);    //Obtiene la parte entera de la hora
        var minutes = parseInt(parseFloat("0."+contenedor[1])*60);  // convierte decimales a minutos

        hours = hours < 10 ? '0' + hours : hours;
        minutes = minutes < 10 ? '0' + minutes : minutes;

        return hours+":"+minutes;
    }

    function convertToHour(hour){
        var hora1 = (hour).split(":");
        var hora = parseFloat(hora1[0])+(parseFloat(hora1[1]/60));

        return hora;
    }

    function obtener_ultima_ruta(){
        var id_mision = $("#id_mision").val();

        ajax = objetoAjax();
        ajax.open("POST", "<?php echo site_url(); ?>/viaticos/solicitud_viatico/obtener_ultima_ruta", true);
        ajax.onreadystatechange = function() {
            if (ajax.readyState == 4){
                var id_ultima_ruta = ajax.responseText;
                insertar_viaticos_ruta(id_ultima_ruta);             
            }
        } 
        ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded"); 
        ajax.send("&id_mision="+id_mision)
    }

    function insertar_viaticos_ruta(id_ultima_ruta){ 
        if(reg_viaticos.length > 0){
            sql = "INSERT INTO vyp_horario_viatico_solicitud (fecha_ruta, id_horario_viatico, id_mision, estado, id_ruta_visitada) VALUES \n";

            var contador_viaticos_activos = 0;
            for(y=0; y<reg_viaticos.length; y++){
                if(reg_viaticos[y][3] == "1"){
                    sql += "('"+reg_viaticos[y][0]+"','"+reg_viaticos[y][1]+"','"+reg_viaticos[y][2]+"','"+reg_viaticos[y][3]+"','"+id_ultima_ruta+"'),\n";
                    contador_viaticos_activos++;
                }
            }

            sql = sql.substr(0, sql.length-2)+";";

            if(contador_viaticos_activos > 0){

                var formData = {
                    "sql" : sql
                    //"departamento" : $("#departamento").val(),
                };
                $.ajax({
                    type:  'POST',
                    url:   '<?php echo site_url(); ?>/viaticos/solicitud_viatico/insertar_viaticos_ruta',
                    data: formData,
                    cache: false
                })
                .done(function(data){
                    if(data == "exito"){
                        if(reg_alojamiento.length > 0){
                            insertar_alojamiento(id_ultima_ruta)
                        }else{
                            swal({ title: "¡Registro exitoso!", type: "success", showConfirmButton: true });
                            cambiar_nuevo_viatico();
                        }
                    }else{
                        swal({ title: "¡Ups! Error", text: "Intentalo nuevamente.", type: "error", showConfirmButton: true });
                    }
                });
            }else{
                if(reg_alojamiento.length > 0){
                    insertar_alojamiento()
                }else{
                    swal({ title: "¡Registro exitoso!", type: "success", showConfirmButton: true });
                    cambiar_nuevo_viatico();
                } 
            }
        }else{
            if(reg_alojamiento.length > 0){
                insertar_alojamiento();
            }else{
                swal({ title: "¡Registro exitoso!", type: "success", showConfirmButton: true });
                cambiar_nuevo_viatico();
            }
        }
    }

    function insertar_alojamiento(id_ultima_ruta){ 
        sql = "INSERT INTO vyp_alojamientos (id_mision, fecha_alojamiento, monto, id_ruta_visitada) VALUES \n";
        var y2 = 0;
        for(y2=0; y2<reg_alojamiento.length; y2++){
            if(y2 == (reg_alojamiento.length-1)){
                sql += "('"+reg_alojamiento[y2][0]+"','"+reg_alojamiento[y2][1]+"','"+reg_alojamiento[y2][2]+"','"+id_ultima_ruta+"');";
            }else{
                sql += "('"+reg_alojamiento[y2][0]+"','"+reg_alojamiento[y2][1]+"','"+reg_alojamiento[y2][2]+"','"+id_ultima_ruta+"'),\n";
            }
        }        

        var formData = {
            "sql" : sql
            //"departamento" : $("#departamento").val(),
        };
        $.ajax({
            type:  'POST',
            url:   '<?php echo site_url(); ?>/viaticos/solicitud_viatico/insertar_alojamiento',
            data: formData,
            cache: false
        })
        .done(function(data){
            if(data == "exito"){
                swal({ title: "¡Registro exitoso!", type: "success", showConfirmButton: true });
                cambiar_nuevo_viatico();
                total_aloj = 0.00;
                $("#alojamiento").val("0.00");
            }else{
                swal({ title: "¡Ups! Error", text: "Intentalo nuevamente.", type: "error", showConfirmButton: true });
            }
        });
    }

    function cambiarJustificacion(ruta){
        if(document.getElementById("justificacion").checked){
            $("#notificacion_justificacion").show(750);
            $("#cnt_justificacion").show(750);
            $("#cnt_file3").show(750);
            $('#summernote').val('justificacion');
            if($("#band").val()=="save"){
                imagen_justificacion();
            }else{
                imagen_justificacion();
            }
        }else{
            $('#summernote').val("");
            if($("#band").val()=="save"){
                validar_dia_limite("0");
                var nueva_fecha =  moment();

                if(nueva_fecha.format("e") == 6){
                    nueva_fecha.add(2,'days');
                }else if(nueva_fecha.format("e") == 0){
                    nueva_fecha.add(1,'days');
                }

                $("#fecha_mision_inicio").datepicker("setDate", nueva_fecha.format("DD-MM-YYYY") );
                $("#fecha_mision_fin").datepicker("setDate", nueva_fecha.format("DD-MM-YYYY") );
                imagen_justificacion();
            }else{
                imagen_justificacion();
            }
            $("#cnt_justificacion").hide(750);
            $("#notificacion_justificacion").hide(750);
            $("#cnt_file3").hide(750);
        }
    }

    function imagen_justificacion(ruta){
        var newName = 'Otro nombre',
        xhr = new XMLHttpRequest();

        var id_mision = $("#id_mision").val();

        xhr.open('GET', "<?php echo site_url(); ?>/viaticos/solicitud_viatico/cnt_justificacion?id_mision="+id_mision);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status === 200 && xhr.responseText !== newName) {
                document.getElementById("cnt_justificacion").innerHTML = xhr.responseText;
                if(document.getElementById("justificacion").checked){
                    $("#fecha_mision_inicio").datepicker("setStartDate", "" );
                    $("#fecha_mision_fin").datepicker("setStartDate", "" );

                    var fecha_hoy =  moment();

                    if(fecha_hoy.format("e") == 6){
                        fecha_hoy.add(2,'days');
                    }else if(fecha_hoy.format("e") == 0){
                        fecha_hoy.add(1,'days');
                    }

                    $("#fecha_mision_inicio").datepicker("setEndDate", fecha_hoy.format("DD-MM-YYYY") );
                    $("#fecha_mision_fin").datepicker("setEndDate", fecha_hoy.format("DD-MM-YYYY") );
                }else{
                    $("#fecha_mision_inicio").datepicker("setStartDate", primer_fecha_inicio );
                    $("#fecha_mision_fin").datepicker("setStartDate", primer_fecha_fin );
                    $("#fecha_mision_inicio").datepicker("setEndDate", ultima_fecha_inicio );
                    $("#fecha_mision_fin").datepicker("setEndDate", ultima_fecha_fin );
                }
                
            }else if (xhr.status !== 200) {
                swal({ title: "Ups! ocurrió un Error", text: "Al parecer no todos los objetos se cargaron correctamente por favor recarga la página e intentalo nuevamente", type: "error", showConfirmButton: true });
            }
        };
        xhr.send(encodeURI('name=' + newName));
    }

    function validar_justificacion(){
        var bandera = false;

        if(document.getElementById("justificacion").checked == 1){
            if($("#file2").data("defaultFile") != ""){
                bandera = true;
            }else{
                if($("#file2").val() != ""){
                    bandera = true;
                }else{
                    swal({ title: "Falta justificación", text: "Debes agregar una justificación.", type: "warning", showConfirmButton: true });                  
                }
            }

        }else{
            bandera = true;
        }

        return bandera;
    }

    function limpiar_empresas_visitadas(){
        $("#departamento").val("").trigger("change.select2");
        $("#nombre_empresa").val("");
        $("#direccion_empresa").val("");
        $("#id_ruta_visitada").val("");
    }

    function tabla_rutas_almacenadas(){
        var id_oficina_origen = $("#id_oficina_origen").val()
        var id_municipio = $("#municipios_rutas").val();
           
        var newName = 'John Smith',
        xhr = new XMLHttpRequest();
        xhr.open('GET', "<?php echo site_url(); ?>/viaticos/solicitud_viatico/tabla_rutas_almacenadas?id_municipio="+id_municipio+"&id_oficina_origen="+id_oficina_origen);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status === 200 && xhr.responseText !== newName) {
                document.getElementById("cnt_rutas_almacenadas").innerHTML = xhr.responseText;
                $('#tabla_rutas').DataTable();
                $('[data-toggle="tooltip"]').tooltip();
            }else if (xhr.status !== 200) {
                swal({ title: "Ups! ocurrió un Error", text: "Al parecer la tabla de empresas visitadas no se cargó correctamente por favor recarga la página e intentalo nuevamente", type: "error", showConfirmButton: true });
            }
        };
        xhr.send(encodeURI('name=' + newName));
    }

    function rutas_almacenadas(){
        $("#modal_rutas_mapa").modal("show");
        tabla_rutas_almacenadas();
    }


    var name_company = "";
    var address_company = "";
    var id_ruta_visitada = "";
    function abrir_mapa(lat, lng, name, address, id){
        $("#modal_rutas_mapa").modal("hide");
        LatDestino = new google.maps.LatLng(lat,lng);

        var container = document.getElementById("input-div");
        container.innerHTML= '<input type="text" class="controlers" id="search_input" placeholder="Escribe una ubicación a buscar"/>';
        LatOrigen = {       //Contiene la ubicación de la oficina de origen del usuario
            lat: parseFloat($("#latitud_oficina").val()), 
            lng: parseFloat($("#longitud_oficina").val())
        };

        $("#cnt_mapa").animate({height: '500px', opacity: '1'}, 750);
        $.when(initMap()).then($("#dirigir").click());
        $("#nombre_empresa").parent().parent().show(0);
        $("#direccion_empresa").parent().show(0);
        $("#municipio").parent().show(0);

        name_company = name;
        address_company = address;
        id_ruta_visitada = id;
    }

    function recorre_observaciones(){
        var checkbox = $("#tasklist").find("input");
        var tiene_observaciones = false;

        for(i=0; i<checkbox.length; i++){
            if(!checkbox[i].checked){
                tiene_observaciones = true;
            }
        }

        if(tiene_observaciones){
            swal({ title: "Faltan observaciones", text: "Hay observaciones sin marcar, es posible que no se hayan solventado todas.", type: "warning", showConfirmButton: true }); 
        }else{
            generar_solicitud();
        }
    }

    function mostrar_detalle_justifiacion(){
        $("#cnt_detalle_justificacion").show(500);
    }

    function cerrar_detalle_justificacion(){
        $("#cnt_detalle_justificacion").hide(500);   
        //$("#file3").val(null);
    }

    function alerta_eliminar_justificacion(id,ruta){
        swal({   
            title: "¿Está seguro?",   
            text: "¡Desea eliminar el archivo!",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#fc4b6c",   
            confirmButtonText: "Sí, deseo eliminar!",   
            closeOnConfirm: false 
        }, function(){   
            eliminar_archivo_justificacion(id,ruta)
        });
    }

    function eliminar_archivo_justificacion(id,ruta){
        var formData = {
            "id_justificacion" : id,
            "ruta" : ruta
        };

        $.ajax({
            type:  'POST',
            url:   '<?php echo site_url(); ?>/viaticos/solicitud_viatico/eliminar_archivo_justificacion',
            data: formData,
            cache: false
        })
        .done(function(data){

            if(data == "exito"){
                swal({ title: "¡Borrado exitoso!", type: "success", showConfirmButton: true });
                imagen_justificacion();
            }else{
                swal({ title: "¡Ups! Error", text: "Intentalo nuevamente.", type: "error", showConfirmButton: true });
            }
        });   
    }

    function validar_monto_alojamiento(obj, max){
        monto = parseFloat(obj.value);
        if(monto > max){
            obj.value = max;
        }
    }

    function validar_monto_pasaje(obj, max){
        monto = parseFloat(obj.value);
        if(monto > max){
            obj.value = max;
        }
    }

    function cambiar_oficina_solicitante(){
        var id_actividad = $("#id_actividad").val();

        if(id_actividad == "7"){
            $("#cnt_oficina_solicitante").show(500);
        }else{
            $("#cnt_oficina_solicitante").hide(500);
            $("#oficina_solicitante").val("").trigger("change.select2");
        }
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

    .table-clase td, .table-clase th {
  border-color: #a5a5a5; }
</style>
<!-- ============================================================== -->
<!-- Inicio de DIV de inicio (ENVOLTURA) -->
<!-- ============================================================== -->
<input type="hidden" id="address" name="">
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


        <div class="row" id="cnt_detalle_justificacion" style="display: none;">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-info">
                        <div class="card-actions text-white">
                            <a style="font-size: 16px;" onclick="cerrar_detalle_justificacion();"><i class="mdi mdi-window-close"></i></a>
                        </div>
                        <h4 class="card-title m-b-0 text-white">Justificación de pago de viáticos</h4>
                    </div>
                    <div class="card-body">
                        <div id="summernote" class="summernote">
                            <!-- <p style="font-family: arial;">Default Summernote</p> -->
                        </div>
                        <div class="row p-t-10">
                            
                            <div class="col-lg-12" align="right">
                                <button type="button" onclick="cerrar_detalle_justificacion();" class="btn btn-danger">Finalizar</button>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>



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

                            <div class="row">
                                <div class="col-lg-12" id="cnt_informacion_empleado"></div>
                            </div>

<div id='notificacion_justificacion' style='width: 100%; display: none;'>
    <div class="alert alert-info" style="width: 100%;">
        <h5> <span class="mdi mdi-file-document"></span> Justificación de viáticos activa.
        </h5>
    </div>
</div>

                            <div class="row">
                                <div class="form-group col-lg-6"> 
			                        <h5>Empleado: <span class="text-danger">*</span></h5>                           
			                        <select id="nr" name="nr" class="select2" style="width: 100%" required="" onchange="informacion_empleado();">
			                            <option value="">[Elija el empleado]</option>
			                            <?php 
			                                $otro_empleado = $this->db->query("SELECT e.id_empleado, e.nr, UPPER(CONCAT_WS(' ', e.primer_nombre, e.segundo_nombre, e.tercer_nombre, e.primer_apellido, e.segundo_apellido, e.apellido_casada)) AS nombre_completo FROM sir_empleado AS e WHERE e.id_estado = '00001' ORDER BY e.primer_nombre, e.segundo_nombre, e.tercer_nombre, e.primer_apellido, e.segundo_apellido, e.apellido_casada");
			                                if($otro_empleado->num_rows() > 0){
			                                    foreach ($otro_empleado->result() as $fila) {              
			                                       echo '<option class="m-l-50" value="'.$fila->nr.'">'.preg_replace ('/[ ]+/', ' ', $fila->nombre_completo.' - '.$fila->nr).'</option>';
			                                    }
			                                }
			                            ?>
			                        </select>
			                        <div class="help-block"></div>
			                    </div>
                                <div class="form-group col-lg-3">   
                                    <h5>Fecha de misión (inicio): <span class="text-danger">*</span></h5>
                                    <input type="text" pattern="\d{1,2}-\d{1,2}-\d{4}" required="" class="form-control" id="fecha_mision_inicio" name="fecha_mision_inicio" placeholder="dd/mm/yyyy" onchange="informacion_empleado();" readonly="">
                                    <div class="help-block"></div>
                                </div>
                                <div class="form-group col-lg-3">   
                                    <h5>Fecha misión (fin): <span class="text-danger">*</span></h5>
                                    <input type="text" pattern="\d{1,2}-\d{1,2}-\d{4}" required="" class="form-control" id="fecha_mision_fin" name="fecha_mision_fin" placeholder="dd/mm/yyyy" onchange="informacion_empleado()" readonly="">
                                    <div class="help-block"></div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="form-group col-lg-9"> 
                                    <h5>Actividad realizada: <span class="text-danger">*</span></h5>
                                    <div class="input-group">
                                        <select id="id_actividad" name="id_actividad" class="select2" style="width: 100%" required='' onchange="cambiar_oficina_solicitante();">
                                            <option value=''>[Elija una actividad]</option>
                                        <?php 
                                            $actividad = $this->db->query("SELECT * FROM vyp_actividades WHERE depende_vyp_actividades = 0 OR depende_vyp_actividades = '' OR depende_vyp_actividades IS NULL");
                                            if($actividad->num_rows() > 0){
                                                foreach ($actividad->result() as $filaa) {              
                                                   echo '<option class="m-l-50" value="'.$filaa->id_vyp_actividades.'">'.$filaa->nombre_vyp_actividades.'</option>';
                                                   $activida_sub = $this->db->query("SELECT * FROM vyp_actividades WHERE depende_vyp_actividades = '".$filaa->id_vyp_actividades."'");
                                                        if($activida_sub->num_rows() > 0){
                                                            foreach ($activida_sub->result() as $filasub) {              
                                                               echo '<option class="m-l-50" value="'.$filasub->id_vyp_actividades.'"> &emsp;&#x25B6; '.$filasub->nombre_vyp_actividades.'</option>';
                                                            }
                                                        }
                                                }
                                            }
                                        ?>
                                        </select>
                                    </div> 
                                </div>

                                <div class="col-lg-3" align="center">
                                    <h5>Justificación de viático: <span class="text-danger">*</span></h5>
                                    <div class="switch">
                                        <label>No
                                            <input type="checkbox" id="justificacion" name="justificacion" onchange="cambiarJustificacion()"><span class="lever"></span>Sí</label>
                                    </div>
                                </div>
                                                               
                            </div>

                            <div class="row" id="cnt_file3" style="display: none;">
                                <div class="col-lg-12 form-group">
                                    <input type="file" class="form-control" id="file3[]" name="file3[]" multiple>
                                </div>
                            </div>

                            <div class="row" id="cnt_oficina_solicitante" style="display: block;">
                                <div class="col-lg-12 form-group">
                                    <h5>Unidad/Depto./Sección solicitante: <span class="text-danger">*</span></h5>                           
                                    <select id="oficina_solicitante" name="oficina_solicitante" class="select2" style="width: 100%">
                                        <option value="">[Elija la oficina]</option>
                                        <?php 
                                            $oficina_solicitante = $this->db->query("SELECT * FROM org_seccion ORDER BY nivel DESC, nombre_seccion");
                                            if($oficina_solicitante->num_rows() > 0){
                                                foreach ($oficina_solicitante->result() as $fila) {              
                                                   echo '<option class="m-l-50" value="'.$fila->id_seccion.'">'.$fila->nombre_seccion.'</option>';
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-lg-12" style="height: 83px;">
                                    <h5>Detalle de la actividad: <span class="text-danger">*</span></h5>
                                    <textarea type="text" id="detalle_actividad" name="detalle_actividad" class="form-control" placeholder="Describa la actividad realizada en la misión"></textarea>
                                    <div class="help-block"></div>
                                </div>
                            </div>

                            <button type="submit" id="submit_button" style="display: none;" class="btn waves-effect waves-light btn-success2">Continuar <i class="mdi mdi-chevron-right"></i></button>

<!-- /.modal-justificacion -->
<div id="modal_justificacion" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Justificación de viáticos</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                
                

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info waves-effect text-white" data-dismiss="modal">Aceptar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
                            
                            <div class="pull-left" id="subiendo_mision" style="display: none;">
                                <span class="fa fa-spin text-success fa-2x"><span class="mdi mdi-sync"></span></span>
                                Guardando los cambios...
                            </div>
                            <div align="right" id="btnadd">
                                <button type="submit" class="btn waves-effect waves-light btn-success2">Continuar <i class="mdi mdi-chevron-right"></i></button>
                            </div>
                            <div align="right" id="btnedit" style="display: none;">
                                <button type="button" onclick="editar_mision()" class="btn waves-effect waves-light btn-success2">Continuar <i class="mdi mdi-chevron-right"></i></button>
                            </div>
                        <?php echo form_close(); ?>
                        <hr>
                        <div id="cnt_justificacion" class="row"></div>
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
                            <div id="fechas_repetidas2"></div>
                            <?php echo form_open('', array('id' => 'form_empresas_visitadas', 'style' => 'margin-top: 0px;', 'class' => 'm-t-40')); ?>
                            <div class="row">
                                <input type="hidden" id="band2" name="band2" value="save">
                                <input type="hidden" id="id_ruta_visitada" name="id_ruta_visitada" value="">

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
                                    <div class="input-group">
                                        <input type="text" id="nombre_empresa" name="nombre_empresa" class="form-control" placeholder="Ingrese el nombre de la empresa" required>
                                        <div id="bntmap1" class="input-group-addon btn btn-default" onclick="form_mapa();" data-toggle="tooltip" title="" data-original-title="Buscar en mapa"><i class="mdi mdi-google-maps"></i></div>
                                        <div id="bntmap2" class="input-group-addon btn btn-default" onclick="rutas_almacenadas();" data-toggle="tooltip" title="" data-original-title="Buscar en registros almacenados"><i class="mdi mdi-map-marker-radius"></i></div>
                                    </div>
                                </div>
                                <div class="form-group col-lg-12">
                                    <h5>Dirección: <span class="text-danger">*</span></h5>
                                    <textarea id="direccion_empresa" name="direccion_empresa" class="form-control" placeholder="Ingrese la dirección de la empresa" rows="2" required></textarea>
                                </div>

                                
                            </div>

                            <button style="display: none;" type="submit" id="btn_submit" class="btn waves-effect waves-light btn-success2">submit</button>

                            <div align="right" id="btnadd2">
                                <button type="button" onclick="limpiar_empresas_visitadas();" class="btn waves-effect waves-light btn-success"><i class="mdi mdi-recycle"></i> Limpiar</button>
                                <button type="button" onclick="gestionar_destino('save')" class="btn waves-effect waves-light btn-success2"><i class="mdi mdi-plus"></i> Agregar destino</button>
                            </div>
                            <div align="right" id="btnedit2" style="display: none;">
                                <button type="button" onclick="limpiar_empresas_visitadas();" class="btn waves-effect waves-light btn-success"><i class="mdi mdi-recycle"></i> Limpiar</button>
                                <button type="button" onclick="editar_mision()" class="btn waves-effect waves-light btn-success2">Continuar <i class="mdi mdi-chevron-right"></i></button>
                            </div>
                            <?php echo form_close(); ?>

                            <!-- Inicio de la TABLA EMPRESAS VISITADAS -->
                            <div class="row" id="cnt_empresas"></div>
                            <!-- Fin de la TABLA EMPRESAS VISITADAS -->

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
                            <div id="fechas_repetidas3"></div>
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
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title m-b-0">Listado de misiones oficiales</h4>
                    </div>
                    <div class="card-body b-t" style="padding-top: 7px;">
                    <div>
                        <div class="pull-left">
                            <div class="form-group" style="width: 400px;"> 
                                <select id="nr_search" name="nr_search" class="select2" style="width: 100%" required="" onchange="tabla_solicitudes();">
                                    <option value="">[Todos los empleados]</option>
                                <?php 
                                    $otro_empleado = $this->db->query("SELECT e.id_empleado, e.nr, UPPER(CONCAT_WS(' ', e.primer_nombre, e.segundo_nombre, e.tercer_nombre, e.primer_apellido, e.segundo_apellido, e.apellido_casada)) AS nombre_completo FROM sir_empleado AS e WHERE e.id_estado = '00001' ORDER BY e.primer_nombre, e.segundo_nombre, e.tercer_nombre, e.primer_apellido, e.segundo_apellido, e.apellido_casada");
                                    if($otro_empleado->num_rows() > 0){
                                        foreach ($otro_empleado->result() as $fila) {        
                                            if($nr_usuario == $fila->nr){      
                                               echo '<option class="m-l-50" value="'.$fila->nr.'" selected>'.preg_replace ('/[ ]+/', ' ', $fila->nombre_completo.' - '.$fila->nr).'</option>';
                                            }else{
                                                echo '<option class="m-l-50" value="'.$fila->nr.'">'.preg_replace ('/[ ]+/', ' ', $fila->nombre_completo.' - '.$fila->nr).'</option>';
                                            }
                                        }
                                    }
                                ?>
                                </select>
                            </div>
                        </div>

                        <div class="pull-right">
                            <?php if(tiene_permiso($segmentos=2,$permiso=2)){ ?>
                            <button type="button" onclick="cambiar_nuevo();" class="btn waves-effect waves-light btn-success2" data-toggle="tooltip" title="Clic para agregar un nuevo registro"><span class="mdi mdi-plus"></span> Nuevo registro</button>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="row" style="width: 100%"></div>
                    <div>
                        <ul class="nav nav-tabs customtab2" role="tablist">
                            <li class="nav-item"> 
                                <a class="nav-link active" onclick="cambiar_pestana('');" data-toggle="tab" href="#">
                                    <span class="hidden-sm-up"><i class="ti-home"></i></span> 
                                    <span class="hidden-xs-down">Todas</span></a> 
                            </li>
                            <li class="nav-item"> 
                                <a class="nav-link" onclick="cambiar_pestana('1');" data-toggle="tab" href="#">
                                    <span class="hidden-sm-up"><i class="ti-home"></i></span> 
                                    <span class="hidden-xs-down">Incompletas</span></a> 
                            </li>
                            <li class="nav-item"> 
                                <a class="nav-link" onclick="cambiar_pestana('2');" data-toggle="tab" href="#">
                                    <span class="hidden-sm-up"><i class="ti-home"></i></span> 
                                    <span class="hidden-xs-down">En revisión</span></a> 
                            </li>
                            <li class="nav-item"> 
                                <a class="nav-link" onclick="cambiar_pestana('3');" data-toggle="tab" href="#">
                                    <span class="hidden-sm-up"><i class="ti-home"></i></span> 
                                    <span class="hidden-xs-down">Observadas</span></a> 
                            </li>
                            <li class="nav-item"> 
                                <a class="nav-link" onclick="cambiar_pestana('4');" data-toggle="tab" href="#">
                                    <span class="hidden-sm-up"><i class="ti-home"></i></span> 
                                    <span class="hidden-xs-down">Aprobadas</span></a> 
                            </li>
                            <li class="nav-item"> 
                                <a class="nav-link" onclick="cambiar_pestana('5');" data-toggle="tab" href="#">
                                    <span class="hidden-sm-up"><i class="ti-home"></i></span> 
                                    <span class="hidden-xs-down">Pagadas</span></a> 
                            </li>
                        </ul>
                    </div>

                        <div id="cnt_tabla_solicitudes"></div>
                        
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

<div style="display:none;">
    <button  id="submit_ubi" name="submit_ubi" type="button"  >clicks</button>
</div>

<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Viáticos encontrados</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body" id="contenedor_viatico">

                <div class="table-responsive">
                    <table class="table table-hover table-bordered" width="100%">
                        <thead class="bg-inverse text-white">
                            <tr>
                                <th>Fecha</th>
                                <th>Viático</th>
                                <th align="right">Monto ($)</th>
                                <th>(*)</th>
                            </tr>
                        </thead>
                        <tbody id="body_viaticos_encontrados" name="body_viaticos_encontrados">
                        </tbody>
                    </table>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success waves-effect" data-dismiss="modal">Aceptar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div id="modal_viaticos" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Viáticos asociados</h4>
            </div>
            <div class="modal-body" id="">
                <div id="cnt_viaticos_encontrados"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info waves-effect text-white" data-dismiss="modal">Aceptar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div id="modal_rutas_mapa" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Asistente de rutas almacenadas</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                 <div class="row container">
                    <div class="col-lg-12">
                        <select id="municipios_rutas" name="municipios_rutas" class="select2" onchange="tabla_rutas_almacenadas();" style="width: 100%" required>
                            <option value=''>[Elija el municipio]</option>
                            <?php
                                $municipio = $this->db->query("SELECT * FROM org_municipio");
                                if($municipio->num_rows() > 0){
                                    foreach ($municipio->result() as $fila2) {              
                                       echo '<option class="m-l-50" value="'.$fila2->id_municipio.'">'.$fila2->municipio.'</option>';
                                    }
                                }
                             ?>
                        </select>
                    </div>
                 </div>
                <div id="cnt_rutas_almacenadas"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info waves-effect text-white" data-dismiss="modal">Aceptar</button>
            </div>
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
            endDate: moment().format("DD-MM-YYYY"),
            daysOfWeekDisabled: [0,6]
        }).datepicker("setDate", new Date());

        $('#fecha_mision_fin').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true,
            todayHighlight: true,
            endDate: moment().format("DD-MM-YYYY"),
            daysOfWeekDisabled: [0,6]
        }).datepicker("setDate", new Date());

        $('#dirigir').click(function(){ //Id del elemento cliqueable
            $('html, body').animate({scrollTop:0}, 1000);
            return false;
        });

    });

    $("#formajax").on("submit", function(e){
        e.preventDefault();
        $("#subiendo_mision").show(0);
        var formData = new FormData(document.getElementById("formajax"));
        var nombre = $("#nr option:selected").text().split("-");
        nombre = nombre[0].trim();
        formData.append('nombre_completo', nombre);
        var justificacion_value = $('#summernote').val();
        formData.append('ruta_justificacion', justificacion_value);
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
            $("#subiendo_mision").hide(0);
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

        var hs = $("#hora_salida").val();
        var hl = $("#hora_llegada").val();

        if(contar_registros_tabla_viaticos() > 0){
            calcular_alojamiento(hs, hl);
        }

        var total_alojamiento = total_aloj;

        if((validar_horarios_viaticos() && validar_factura()) || $("#band_viatico").val() == "delete"){
            var formData = new FormData(document.getElementById("form_empresas_viaticos"));
            //formData.append('nombre_completo', $("#nr option:selected").text());
            formData.append("nombre_origen", $("#id_origen option:selected").text().trim());
            formData.append("nombre_destino", $("#id_destino option:selected").text().trim());
            formData.append("kilometraje", $("#id_distancia option:selected").text().trim());
            formData.append("id_mision", $("#id_mision").val());
            formData.append("total_alojamiento", total_alojamiento);
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
                        obtener_ultima_ruta();
                    }else if($("#band_viatico").val() == "edit"){
                        swal({ title: "¡Modificación exitosa!", type: "success", showConfirmButton: true });
                    }else{
                        swal({ title: "¡Borrado exitoso!", type: "success", showConfirmButton: true });
                        cambiar_nuevo_viatico();
                    }
                }else{
                    swal({ title: "¡Ups! Error", text: "Intentalo nuevamente.", type: "error", showConfirmButton: true });
                }
            });
        }
    });


    $("#form_empresas_visitadas").on("submit", function(e){
        e.preventDefault();
        var tipo = $('input[name=r_destino]:checked').val();
        var existe = $("#existe").val();

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
            "id_ruta_visitada" : $("#id_ruta_visitada").val(),
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
                tabla_empresas_visitadas(function(){ limpiar_empresas_visitadas() });
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

        document.getElementById('submit_ubi').addEventListener('click', function() {
          geocodeAddress(geocoder, map);
        });

        function geocodeAddress(geocoder, resultsMap) {
          var address = $("#address").val();
          geocoder.geocode({'address': address}, function(results, status) {
            if (status === google.maps.GeocoderStatus.OK) {
              resultsMap.setCenter(results[0].geometry.location);
                deleteMarkers_D();
                LatDestino = results[0].geometry.location;
                addMarker_destino(results[0].geometry.location, resultsMap);
                name_company = "";
                address_company = "";
                id_ruta_visitada = "";
                calcula_distancia(0);
            } else {
              //$.toast({ heading: 'Ocurrió un error', text: 'No logramos calcular la distancia, intentalo nuevamente', position: 'top-right', loaderBg:'#3c763d', icon: 'info', hideAfter: 4000, stack: 6 });
            }
          });
        }


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
            name_company = "";
            address_company = "";
            id_ruta_visitada = "";
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

                            if(document.getElementById('destino_municipio').checked == 1){
                                $("#distancia").val(distancia_total_mapa);
                            }

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