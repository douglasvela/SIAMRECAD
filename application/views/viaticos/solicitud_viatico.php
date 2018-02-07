<?php
    $user = $this->session->userdata('usuario_viatico');
    if(empty($user)){
        header("Location: ".site_url()."/login");
        exit();
    }

    $pos = strpos($user, ".")+1;
    $inicialUser = strtoupper(substr($user,0,1).substr($user, $pos,1));

    $nr = $this->db->query("SELECT * FROM org_usuario WHERE usuario = '".$user."' LIMIT 1");
    $nr_usuario = ""; $nombre_usuario;
    if($nr->num_rows() > 0){
        foreach ($nr->result() as $fila) { 
            $nr_usuario = $fila->nr; 
            $nombre_usuario = $fila->nombre_completo;
        }
    }

    $empleado = $this->db->query("SELECT e.id_empleado, e.correo, e.telefono_casa, e.telefono_contacto, e.direccion, UPPER(CONCAT_WS(' ', e.primer_nombre, e.segundo_nombre, e.tercer_nombre, e.primer_apellido, e.segundo_apellido, e.apellido_casada)) AS nombre_completo FROM sir_empleado AS e WHERE e.nr = '".$nr_usuario."' ORDER BY primer_nombre");

    if($empleado->num_rows() > 0){
        foreach ($empleado->result() as $fila) {              
           $nombre_completo = trim($fila->nombre_completo);
           $correo = $fila->correo;
           $tel_casa = $fila->telefono_casa;
           $tel_contacto = $fila->telefono_contacto;
           $direccion = $fila->direccion;
        }
    }

    $info_empleado = $this->db->query("SELECT * FROM vyp_informacion_empleado WHERE nr = '".$nr_usuario."'");

    $cuenta_banco = $this->db->query("SELECT * FROM vyp_empleado_cuenta_banco WHERE nr = '".$nr_usuario."' AND estado = 1");

?>

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
    var km_minimo = 15;
    var viaticos = [];

    function cargar_viaticos(){
        var id_mision = $("#id_mision").val();
        var cadena, prueba, termina = false, j = 0;

        viaticos = [];

        ajax = objetoAjax();
        ajax.open("POST", "<?php echo site_url(); ?>/viatico/solicitud/cargar_viaticos", true);
        ajax.onreadystatechange = function() {
            if (ajax.readyState == 4){
                
                cadena = ajax.responseText;
                while(!termina){
                    inicio = cadena.indexOf('[');
                    fin = cadena.indexOf(']');
                    if(inicio == -1){
                        termina = true;
                    }else{
                        prueba = cadena.substring(inicio+1,fin);
                        viaticos.push([]);
                        for(var i = 0; i<6; i++){
                            inicio2 = prueba.indexOf("'");
                            fin2 = prueba.indexOf("',");
                            viaticos[j].push(prueba.substring(inicio2+1,fin2));
                            prueba = prueba.substring(parseInt(fin2)+2)
                        }
                        cadena = cadena.substring(parseInt(fin)+1)
                        j++;
                    }
                }

                form_viaticos();
                
            }
        } 
        ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded"); 
        ajax.send("&id_mision="+id_mision)
    }


    function iniciar(){
        tabla_solicitudes();
        <?php if($info_empleado->num_rows() <= 0 || $cuenta_banco->num_rows() <= 0){ ?>
            $('#modal_perfil').modal({backdrop: 'static', keyboard: false});
            $("#modal_perfil").modal('show');
        <?php } ?>

        initMap();
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
        xmlhttpB.open("GET","<?php echo site_url(); ?>/viatico/solicitud/tabla_solicitudes",true);
        xmlhttpB.send(); 
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
        xmlhttpB.open("GET","<?php echo site_url(); ?>/viatico/solicitud/observaciones?id_mision="+id_mision,true);
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
        xmlhttp_municipio.open("GET","<?php echo site_url(); ?>/viatico/solicitud/combo_actividad_realizada",true);
        xmlhttp_municipio.send();
    }

    function combo_oficina_departamento(tipo){
        if(window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp_municipio=new XMLHttpRequest();
        }else{// code for IE6, IE5
            xmlhttp_municipio=new ActiveXObject("Microsoft.XMLHTTPB");
        }        
        xmlhttp_municipio.onreadystatechange=function(){
            if (xmlhttp_municipio.readyState==4 && xmlhttp_municipio.status==200){
                  document.getElementById("combo_departamento").innerHTML=xmlhttp_municipio.responseText;
                  $(".select2").select2();
                  if(tipo == "mapa"){
                    $('#departamento').val(id_departamento_mapa).trigger('change.select2');
                  }else{
                    combo_municipio(tipo);
                  }
            }
        }
        xmlhttp_municipio.open("GET","<?php echo site_url(); ?>/viatico/solicitud/combo_oficinas_departamentos?tipo="+tipo,true);
        xmlhttp_municipio.send();
    }

    function combo_municipio(tipo){
        var id_departamento = $("#departamento").val();
        if(window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp_municipio=new XMLHttpRequest();
        }else{// code for IE6, IE5
            xmlhttp_municipio=new ActiveXObject("Microsoft.XMLHTTPB");
        }

        xmlhttp_municipio.onreadystatechange=function(){
            if (xmlhttp_municipio.readyState==4 && xmlhttp_municipio.status==200){
                  document.getElementById("combo_municipio").innerHTML=xmlhttp_municipio.responseText;
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
                    //input_distancia(tipo);
                  }
            }
        }
        xmlhttp_municipio.open("GET","<?php echo site_url(); ?>/viatico/solicitud/combo_municipios?id_departamento="+id_departamento+"&tipo="+tipo,true);
        xmlhttp_municipio.send();
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
            }
        }
        xmlhttp_municipio.open("GET","<?php echo site_url(); ?>/viatico/solicitud/input_distancia?id_departamento="+id_departamento+"&id_municipio="+id_municipio+"&tipo="+tipo+"&distancia="+distancia_total_mapa,true);
        xmlhttp_municipio.send();
    }

    function tabla_empresas_visitadas(callback){
        var id_mision = $("#id_mision").val();
        var nr = $("#nr").val();
        var fecha_mision = $("#fecha_mision").val();
        if(window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp_municipio=new XMLHttpRequest();
        }else{// code for IE6, IE5
            xmlhttp_municipio=new ActiveXObject("Microsoft.XMLHTTPB");
        }
        xmlhttp_municipio.onreadystatechange=function(){
            if (xmlhttp_municipio.readyState==4 && xmlhttp_municipio.status==200){
                  document.getElementById("cnt_empresas").innerHTML=xmlhttp_municipio.responseText;
                  if(typeof callback != "undefined"){
                    callback();
                  }
            }
        }
        xmlhttp_municipio.open("GET","<?php echo site_url(); ?>/viatico/solicitud/tabla_empresas_visitadas?id_mision="+id_mision+"&nr="+nr+"&fecha_mision="+fecha_mision,true);
        xmlhttp_municipio.send();
    }

    function tabla_empresas_viaticos(tipo){
        var id_mision = $("#id_mision").val();
        var nr = $("#nr").val();
        var fecha_mision = $("#fecha_mision").val();
        if(window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp_municipio=new XMLHttpRequest();
        }else{// code for IE6, IE5
            xmlhttp_municipio=new ActiveXObject("Microsoft.XMLHTTPB");
        }
        xmlhttp_municipio.onreadystatechange=function(){
            if (xmlhttp_municipio.readyState==4 && xmlhttp_municipio.status==200){
                  document.getElementById("tabla_viaticos").innerHTML=xmlhttp_municipio.responseText;
                  $('[data-toggle="tooltip"]').tooltip();

            }
        }
        xmlhttp_municipio.open("GET","<?php echo site_url(); ?>/viatico/solicitud/tabla_empresas_viaticos?id_mision="+id_mision+"&nr="+nr+"&tipo="+tipo+"&fecha_mision="+fecha_mision,true);
        xmlhttp_municipio.send();
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

    function form_viaticos(){
        $("#cnt_mision").hide(0);
        $("#cnt_rutas").hide(0);
        $("#cnt_viaticos").show(0);
        tabla_empresas_viaticos("guardar");
    }

    function form_oficinas(){
        $("#nombre_empresa").parent().hide(0);
        $("#direccion_empresa").parent().hide(0);
        $("#municipio").parent().hide(0);
        $("#nombre_empresa").val("");
        $("#direccion_empresa").val("");
        var explode = function(){
          combo_oficina_departamento("oficina")
        };
        setTimeout(explode, 150);        
    }

    function form_folleto_viaticos(){
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
        $("#cnt_mapa").animate({height: '500px', opacity: '1'}, 750);
        $.when(initMap()).then($("#dirigir").click());

        combo_oficina_departamento("mapa");
        $("#nombre_empresa").parent().show(0);
        $("#direccion_empresa").parent().show(0);
        $("#municipio").parent().show(0);
        $("#nombre_empresa").val("");
        $("#direccion_empresa").val("");
    }

    function editar_mision(){
        $("#band").val("edit");
        $("#submit_button").click();
    }

    function cerrar_mantenimiento(){
        $("#cnt_tabla").show(0);
        $("#cnt_form").hide(0);
    }

    function cambiar_nuevo(){
        $("#id_mision").val("");
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

    function cambiar_editar(id,nr,fecha_mision,actividad_realizada,detalle_actividad,bandera){
        $("#id_mision").val(id);
        $("#nombre_empleado").val(nombre);
        $("#fecha_mision").val(fecha_mision);
        $("#nombre_empresa").val("");
        $("#direccion_empresa").val("");
        $("#detalle_actividad").val(detalle_actividad);
        $('#id_actividad').val(actividad_realizada).trigger('change.select2');       

        if(bandera == "edit"){
            observaciones(id);
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
        ajax.open("POST", "<?php echo site_url(); ?>/viatico/solicitud/eliminar_destino", true);
        ajax.onreadystatechange = function() {
            if (ajax.readyState == 4){
               tabla_empresas_visitadas();
            }
        } 
        ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded"); 
        ajax.send("&id_empresa_visitada="+id_empresa_visitada)
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

    function gestionar_destino(band){
        $("#band2").val(band);
        $("#btn_submit").click();
    }

    function buscar_idmision(){
        var nr = $("#nr").val();

        ajax = objetoAjax();
        ajax.open("POST", "<?php echo site_url(); ?>/viatico/solicitud/obtener_ultima_mision", true);
        ajax.onreadystatechange = function() {
            if (ajax.readyState == 4){
                $("#id_mision").val(ajax.responseText);
                form_rutas();              
            }
        } 
        ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded"); 
        ajax.send("&nr="+nr)
    }

    function verficar_oficina_destino(distancia){
        var filas = $("#target").find("tbody").find("tr");
        var celdas = $(filas[0]).find("td");

        if(celdas.length > 1){
            var nr = $("#nr").val();
            var id_mision = $("#id_mision").val();

            for(i=0; i<filas.length; i++){
                celdas = $(filas[i]).children("td");
                if((i+1) < filas.length){
                    distancia_ultima = $(celdas[2]).html();
                }else{
                    if($(celdas[2]).is(":visible")){
                        distancia_ultima = $(celdas[2]).html();
                    }
                }         
            }

            distancia_ultima = distancia_ultima.substr(0, distancia_ultima.length-3)

            ajax = objetoAjax();
            ajax.open("POST", "<?php echo site_url(); ?>/viatico/solicitud/verficar_oficina_destino", true);
            ajax.onreadystatechange = function() {
                if (ajax.readyState == 4){
                    if(ajax.responseText == "exito"){
                        tabla_empresas_visitadas(function(){ ordenar_empresas_visitadas() });
                    }else if(ajax.responseText == "viaticos"){
                        swal({ title: "Kilometraje inválido", text: "Las empresas no cumplen con distancia > 15 Km para recibir viáticos.", type: "warning", showConfirmButton: true });
                    }else{
                        swal({ title: "¡Ups! Error", text: "Intentalo nuevamente.", type: "error", showConfirmButton: true });
                    }
                }
            } 
            ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded"); 
            ajax.send("&nr="+nr+"&id_mision="+id_mision+"&distancia="+distancia_ultima)
        }else{
            swal({ title: "Ninguna empresa visitada", text: "Registra al menos una empresa visitada en la misión.", type: "warning", showConfirmButton: true });
        }
    }

    function ordenar_empresas_visitadas(){
        var filas = $("#target").children("tbody").children("tr");
        var input,idqr = "", query = "UPDATE vyp_empresas_visitadas \nSET orden = CASE id_empresas_visitadas\n";

        var celdas = $(filas[0]).find("td");
        var distancia_ultima = 0.00;

        if(celdas.length > 1){

            for(i=0; i<filas.length; i++){
                celdas = $(filas[i]).children("td");
                input = $(filas[i]).children("td").children("input");
                if((i+1) < filas.length){
                    query += "WHEN "+$(input[0]).val()+" THEN "+(i+1)+"\n";
                    idqr += $(input[0]).val()+", ";
                }else{
                    query += "WHEN "+$(input[0]).val()+" THEN "+(i+1)+"\nEND\n";
                    idqr += $(input[0]).val();
                    
                }         
            }

            query += "WHERE id_empresas_visitadas IN ("+idqr+");";

            ajax = objetoAjax();
            ajax.open("POST", "<?php echo site_url(); ?>/viatico/solicitud/ordenar_empresas_visitadas", true);
            ajax.onreadystatechange = function() {
                if (ajax.readyState == 4){
                    if(ajax.responseText == "exito"){
                        cargar_viaticos();
                    }else{
                        swal({ title: "¡Ups! Error", text: "Intentalo nuevamente.", type: "error", showConfirmButton: true });
                    }           
                }
            } 
            ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded"); 
            ajax.send("&query="+query)
        }else{
            swal({ title: "Ninguna empresa visitada", text: "Registra al menos una empresa visitada en la misión.", type: "warning", showConfirmButton: true });
        }
    }

    function validar_solicitud(){
        var filas = $("#tabla_viaticos").find("tbody").find("tr");
        var hora_inicio, hora_fin, utlima_hora;

        var vacio = false;
        var horarios_malos = false;

        for(i=0; i<(filas.length-1); i++){
            var celdas = $(filas[i]).find("td");
            hora_inicio = $($(celdas[3]).find("input")[0]).val();
            hora_fin = $($(celdas[4]).find("input")[0]).val();
            if(hora_inicio == "" || hora_fin == ""){
                vacio = true;
            }
            if(hora_inicio >= hora_fin){
                horarios_malos = true;
            }
            if(i>0){
                if(utlima_hora >= hora_inicio){
                    horarios_malos = true;
                }
            }
            utlima_hora = hora_fin;
        }

        if(vacio){
            swal({ title: "Faltan horarios", text: "Complete las horas de salida y llegada.", type: "warning", showConfirmButton: true });
        }else{
            if(horarios_malos){
                swal({ title: "Horarios incorrectos", text: "Por favor verifique que los horarios estén ingresados de menor a mayor", type: "warning", showConfirmButton: true });
            }else{
                if($("#total_viatico").val() == 0){
                    swal({ title: "Sin viáticos", text: "El valor en viáticos no puede ser $0.00", type: "warning", showConfirmButton: true });
                }else{
                    guardar_registros_viaticos();
                }
            }
        }
    }

    function eliminar_viaticos(obj,id_empre){
        for(var i = 0; i < viaticos.length; i++){
            if(viaticos[i][5] == id_empre){
                viaticos[i][5] = '';
                input = $("#cnt"+viaticos[i][0]).find("input");
                input[0].checked = false;                
            }
        }

        $(obj).siblings("output").show(0);
        $(obj).hide(0);
        $(obj).parent("span").parent("span").addClass("bg-success");
        $(obj).parent("span").parent("span").removeClass("bg-danger");

        input = $(obj).parents("td").find("input");
        input.val("0.00");
        sumar_viaticos();
    }

    var input_monto, id_empresa;

    function verificar_viaticos(obj){
        if(!$("myModal").is(":visible")){
            var celdas = $(obj).parents("tr").children("td");
            var hora_inicio, hora_fin, km;
            var bd_inicio, bd_fin, monto, tiene = false;
            var total_viatico = 0.00;
            
            hora_inicio = $($(celdas[3]).find("input")).val();
            hora_fin = $($(celdas[4]).find("input")).val();
            km = $($(celdas[5]).find("input")).val();
            id_empresa = $($(celdas[0]).find("input")[0]).val();

            var array = new Array(viaticos.length);

            if(hora_inicio != "" && hora_fin != ""){
                if(km >= km_minimo){
                    for(var i = 0; i < viaticos.length; i++){
                        bd_inicio = viaticos[i][1];
                        bd_fin = viaticos[i][2];
                        monto = parseFloat(viaticos[i][4]);

                        input_monto = $($(celdas[6]).find("input"));

                        if(((hora_inicio < bd_inicio && hora_fin >= bd_inicio) || (hora_inicio >= bd_inicio && hora_inicio <= bd_fin)) && viaticos[i][5] == ''){
                            tiene = true;
                            array[i] = [viaticos[i][0],viaticos[i][3],viaticos[i][4],viaticos[i][5],i];
                        }else{
                            array[i] = [viaticos[i][0],"vacio"];
                        }
                    }

                    if(tiene){
                        preguntar_viaticos(array);
                    }
                    //input_monto.val(total_viatico.toFixed(2));
                }else{
                    $($(celdas[6]).find("input")).val("0.00");
                }
            }
        }
    }

    function preguntar_viaticos(array){
        var divs = $("#contenedor_viatico").children("div");
        for(var j = 0; j < array.length; j++){
            if(array[j][1] == "vacio"){
                $("#cnt"+array[j][0]).hide(0);
            }else{
                if(array[j][3] == ''){
                    $("#cnt"+array[j][0]).show(0);
                }else{
                    $("#cnt"+array[j][0]).hide(0);
                }
            }
        }
        $('#myModal').modal({backdrop: 'static', keyboard: false});
        $("#myModal").modal('show');
    }

    function recorrer_modal(){
        var divs = $("#contenedor_viatico").children("div");
        var total_viatico = 0.00;

        for(var j = 0; j < divs.length; j++){
            var input = $(divs[j]).find("input");

            if($(input).is(':checked') && $(divs[j]).is(":visible")){
                total_viatico += parseFloat(viaticos[j][4]);
                for(var i = 0; i < viaticos.length; i++){
                    if(viaticos[i][0] == $(input).val()){
                        viaticos[i][5] = id_empresa;
                    }
                }
            }/*else{
               for(var i = 0; i < viaticos.length; i++){
                    if(viaticos[i][0] == $(input).val()){
                        viaticos[i][5] = '';
                    }
                } 
            }*/
        }

        if(total_viatico > 0){
            botones = $(input_monto).parents("td").find("output");
            $(botones[0]).hide(0);
            $(botones[1]).show(0);
            $(botones[0]).parent("span").parent("span").removeClass("bg-success");
            $(botones[0]).parent("span").parent("span").addClass("bg-danger");
        }

        input_monto.val(total_viatico.toFixed(2));
        sumar_viaticos();

        $('#myModal').modal('hide');
    }

    function sumar_viaticos(){
        var tabla_v = $("#tabla_viaticos").find("tbody").find("tr");
        var res_viatico = 0.00;
        for(var k = 0; k< (tabla_v.length-1); k++){
            filas = $(tabla_v[k]).find("td");
            input = $(filas[6]).find("input").val();
            res_viatico += parseFloat(input);
            $("#total_viatico").val(res_viatico.toFixed(2));
        }
    }

    function guardar_registros_viaticos(){
        var query = "INSERT INTO vyp_viatico_empresa_horario (id_empresa, id_horario, id_mision) VALUES \n";
        var id_mision = $("#id_mision").val();

        for(var i = 0; i < viaticos.length; i++){
            if(viaticos[i][5] != ""){
                query += "('"+viaticos[i][5]+"','"+viaticos[i][0]+"','"+id_mision+"'),\n";
            }
        }

        query = query.substr(0,(query.length-2))+";";

        ajax = objetoAjax();
        ajax.open("POST", "<?php echo site_url(); ?>/viatico/solicitud/guardar_registros_viaticos", true);
        ajax.onreadystatechange = function() {
            if (ajax.readyState == 4){
                if(ajax.responseText == "exito"){
                    recorrer_solicitud();
                }else{
                    swal({ title: "¡Ups! Error", text: "Intentalo nuevamente.", type: "error", showConfirmButton: true });
                }           
            }
        } 
        ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded"); 
        ajax.send("&query="+query+"&id_mision="+id_mision)
    }

    function recorrer_solicitud(){
        var filas = $("#tabla_viaticos").find("tbody").find("tr");

        var query = "UPDATE vyp_empresas_visitadas SET\n";

        var origenes = "origen = CASE id_empresas_visitadas\n";
        var hora_salida = "hora_salida = CASE id_empresas_visitadas\n";
        var hora_llegada = "hora_llegada = CASE id_empresas_visitadas\n";
        var kilometraje = "kilometraje = CASE id_empresas_visitadas\n";
        var viaticos = "viaticos = CASE id_empresas_visitadas\n";
        var pasajes = "pasajes = CASE id_empresas_visitadas\n";

        var id_empre = "";

        var id;

        for(i=0; i<(filas.length-1); i++){
            var celdas = $(filas[i]).find("td");
            id = $($(celdas[0]).find("input")[0]).val();
            id_empre += id+",";
            origenes += "WHEN "+id+" THEN '"+$(celdas[1]).html()+"'\n";
            hora_salida += "WHEN "+id+" THEN '"+$($(celdas[3]).find("input")).val()+"'\n";
            hora_llegada += "WHEN "+id+" THEN '"+$($(celdas[4]).find("input")).val()+"'\n";
            kilometraje += "WHEN "+id+" THEN '"+$($(celdas[5]).find("input")).val()+"'\n";
            viaticos += "WHEN "+id+" THEN '"+$($(celdas[6]).find("input")).val()+"'\n";
            pasajes += "WHEN "+id+" THEN '"+$($(celdas[7]).find("input")).val()+"'\n";
        }

        origenes += "END,\n";
        hora_salida += "END,\n";
        hora_llegada += "END,\n";
        kilometraje += "END,\n";
        viaticos += "END,\n";
        pasajes += "END\n";

        id_empre = id_empre.substr(0,id_empre.length-1);

        query += origenes+hora_salida+hora_llegada+kilometraje+viaticos+pasajes+" WHERE id_empresas_visitadas IN ("+id_empre+");";

        completar_tabla_viatico(query);
    }

    function completar_tabla_viatico(query){
        var id_mision = $("#id_mision").val();

        ajax = objetoAjax();
        ajax.open("POST", "<?php echo site_url(); ?>/viatico/solicitud/completar_tabla_viatico", true);
        ajax.onreadystatechange = function() {
            if (ajax.readyState == 4){
                if(ajax.responseText == "exito"){
                    if(recorre_observaciones()){
                        estado_revision();
                    }else{
                        swal({ title: "Observaciones pendientes", text: "Parece que aún no ha resuelto todas las observaciones, verifique y marque todas las observaciones resueltas", type: "warning", showConfirmButton: true });
                    }
                }else{
                    swal({ title: "¡Ups! Error", text: "Intentalo nuevamente.", type: "error", showConfirmButton: true });
                }           
            }
        } 
        ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded"); 
        ajax.send("&query="+query+"&id_mision="+id_mision)
    }

    function estado_revision(){
        var id_mision = $("#id_mision").val();

        ajax = objetoAjax();
        ajax.open("POST", "<?php echo site_url(); ?>/viatico/solicitud/estado_revision", true);
        ajax.onreadystatechange = function() {
            if (ajax.readyState == 4){
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
    }

    function imprimir_solicitud(id_mision){
        window.open("<?php echo site_url(); ?>/viatico/solicitud/imprimir_solicitud?id_mision="+id_mision, '_blank');
    }
   
    function verificar_horario_repetido(){
        var fhora_rep = $("#tabla_hora_repetida").find("tr");
        var repetido = false;


        if(fhora_rep.length == 0){
            validar_solicitud();
        }else{
            var filas = $("#tabla_viaticos").find("tbody").find("tr");
            //var celdas = $(obj).parents("tr").children("td");

            for(i=0; i<(filas.length-1); i++){
                celdas = $(filas[i]).children("td");
                hora_inicio = $($(celdas[3]).find("input")).val();
                hora_fin = $($(celdas[4]).find("input")).val();
                
                for(j=0; j<fhora_rep.length; j++){
                    celdas2 = $(fhora_rep[i]).children("td");

                    if((hora_inicio < $(celdas2[0]).html() && hora_fin >= $(celdas2[0]).html()) || (hora_inicio >= $(celdas2[0]).html() && hora_inicio <= $(celdas2[1]).html())){
                        repetido = true;
                    }
                }
            }            
        }

        if(repetido){
            swal({ title: "Choque de horarios", text: "Ya existe una solicitud con esos horarios, no puede solicitar viáticos en ese horario", type: "warning", showConfirmButton: true });
        }else{
            validar_solicitud()
        }
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

    function finalizarBusquedaMapa(){
        $("#cnt_mapa").animate({height: '0', opacity: '0'}, 750);

        $("#direccion_empresa").val(direccion_mapa);

        var municipio = municipio_mayus(direccion_mapa);
        
        obtener_id_municipio(municipio);
    }

    var id_departamento_mapa;
    var id_municipio_mapa;

    function obtener_id_municipio(municipio){
        var formData = new FormData();
        formData.append("id_municipio", municipio);

        $.ajax({
            url: "<?php echo site_url(); ?>/viatico/solicitud/obtener_id_municipio",
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
            url: "<?php echo site_url(); ?>/viatico/solicitud/obtener_id_municipio",
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
            url: "<?php echo site_url(); ?>/viatico/solicitud/obtener_id_departamento",
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

    function nuevaActividad(){
        $('#modal_actividad').modal({backdrop: 'static', keyboard: false});
        $("#modal_actividad").modal('show');
    }

    function poner_linea(obj){      
        var input = $(obj).siblings("input");
        if(input[0].checked){
            $(obj).css('text-decoration','none')
        }else{
            $(obj).css('text-decoration','line-through')
        }
    }

    function recorre_observaciones(){
        var checkbox = $("#tasklist").find("input");
        var imprimir = "";

        var tiene_observaciones = false;

        for(i=0; i<checkbox.length; i++){
            if(!checkbox[i].checked){
                tiene_observaciones = true;
            }
        }

        if(tiene_observaciones){
            return false;
        }else{
            return true;
        }
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
                            <?php
                                $user = $this->session->userdata('usuario_viatico');
                                $nr = $this->db->query("SELECT * FROM org_usuario WHERE usuario = '".$user."' LIMIT 1");
                                $nr_usuario = ""; $nombre_usuario;
                                if($nr->num_rows() > 0){
                                    foreach ($nr->result() as $fila) { 
                                        $nr_usuario = $fila->nr; 
                                        $nombre_usuario = $fila->nombre_completo;
                                    }
                                }

                                if($info_empleado->num_rows() > 0){ 
                                    foreach ($info_empleado->result() as $filas) {}
                                }

                                $oficina_origen = $this->db->query("SELECT * FROM vyp_oficinas WHERE id_oficina = '".$filas->id_oficina_departamental."'");

                                if($oficina_origen->num_rows() > 0){ 
                                    foreach ($oficina_origen->result() as $filaofi) {}
                                }

                                $director_jefe_regional = $this->db->query("SELECT nr FROM sir_empleado WHERE id_empleado = '".$filaofi->jefe_oficina."'");

                                if($director_jefe_regional->num_rows() > 0){ 
                                    foreach ($director_jefe_regional->result() as $filadir) {}
                                }

                                $nr_jefe_inmediato = $filas->nr_jefe_inmediato;
                                $nr_jefe_regional = $filadir->nr;

                                $empleado = $this->db->query("SELECT e.id_empleado, UPPER(CONCAT_WS(' ', e.primer_nombre, e.segundo_nombre, e.tercer_nombre, e.primer_apellido, e.segundo_apellido, e.apellido_casada)) AS nombre_completo FROM sir_empleado AS e WHERE e.nr = '".$nr_usuario."' ORDER BY primer_nombre");

                                if($empleado->num_rows() > 0){
                                    foreach ($empleado->result() as $fila) {              
                                       $nombre_usuario = trim($fila->nombre_completo);
                                    }
                                }

                            ?>
                            <input type="hidden" id="id_mision" name="id_mision" value="">
                            <input type="hidden" id="nr" name="nr" value="<?php echo $nr_usuario; ?>">
                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <h5>Nombre del empleado: <span class="text-danger">*</span></h5>
                                    <input type="text" id="nombre_empleado" name="nombre_empleado" class="form-control" required="" minlength="3" value="<?php echo $nombre_usuario; ?>" readonly data-validation-required-message="Este campo es requerido">
                                    <div class="help-block"></div>
                                </div>
                                <div class="form-group col-lg-6">   
                                    <h5>Fecha de misión: <span class="text-danger">*</span></h5>
                                    <input type="text" pattern="\d{1,2}-\d{1,2}-\d{4}" data-date-end-date="0d" data-date-start-date="-5d" required="" value="<?php echo date('d-m-Y'); ?>" class="form-control" id="fecha_mision" name="fecha_mision" placeholder="dd/mm/yyyy">
                                    <div class="help-block"></div>                   
                                </div>
                            </div>

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
                                <button type="button" onclick="verficar_oficina_destino();" class="btn waves-effect waves-light btn-success2">Continuar <i class="mdi mdi-chevron-right"></i></button>
                            </div>

                        </div>
                        <!-- ============================================================== -->
                        <!-- Fin del FORMULARIO EMPRESAS VISITADAS -->
                        <!-- ============================================================== -->


                        <!-- ============================================================== -->
                        <!-- Inicio del FORMULARIO DE VIÁTICOS Y PASAJES -->
                        <!-- ============================================================== -->
                        <div id="cnt_viaticos">
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
        <?php 
    if($info_empleado->num_rows() > 0){ 
        foreach ($info_empleado->result() as $filas) {}
    }

    $oficina_origen = $this->db->query("SELECT * FROM vyp_oficinas WHERE id_oficina = '".$filas->id_oficina_departamental."'");

    if($oficina_origen->num_rows() > 0){ 
        foreach ($oficina_origen->result() as $filaofi) {}
    }
?>
        <input type="hidden" id="id_oficina_origen" name="id_oficina_origen" value="<?php echo $filaofi->id_oficina; ?>">
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

        alert(LatOrigen)

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