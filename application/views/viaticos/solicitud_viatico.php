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
                $('#myTable').DataTable();
                $('[data-toggle="tooltip"]').tooltip();
            }
        }
        xmlhttpB.open("GET","<?php echo site_url(); ?>/viatico/solicitud/tabla_solicitudes",true);
        xmlhttpB.send(); 
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
                  combo_municipio(tipo);
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
        xmlhttp_municipio.open("GET","<?php echo site_url(); ?>/viatico/solicitud/input_distancia?id_departamento="+id_departamento+"&id_municipio="+id_municipio+"&tipo="+tipo,true);
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
        combo_oficina_departamento("oficina");
        $("#nombre_empresa").parent().hide(0);
        $("#direccion_empresa").parent().hide(0);
        $("#municipio").parent().hide(0);
        $("#nombre_empresa").val("");
        $("#direccion_empresa").val("");
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
        
    }

    function editar_mision(){
        $("#band").val("edit");
        $("#formajax").submit();
    }

    function cerrar_mantenimiento(){
        $("#cnt_tabla").show(0);
        $("#cnt_form").hide(0);
    }

    function cambiar_nuevo(){
        $("#id_mision").val("");
        $("#nombre_empresa").val("");
        $("#direccion_empresa").val("");
        $("#actividad").val("");
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

    function cambiar_editar(id,nombre,fecha_mision,actividad_realizada,bandera){
        $("#id_mision").val(id);
        $("#nombre_empleado").val(nombre);
        $("#fecha_mision").val(fecha_mision);
        $("#nombre_empresa").val("");
        $("#direccion_empresa").val("");
        $("#actividad").val(actividad_realizada);        

        if(bandera == "edit"){
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

    function verficar_oficina_destino(){
        var filas = $("#target").find("tbody").find("tr");
        var celdas = $(filas[0]).find("td");

        if(celdas.length > 1){
            var nr = $("#nr").val();
            var id_mision = $("#id_mision").val();

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
            ajax.send("&nr="+nr+"&id_mision="+id_mision)
        }else{
            swal({ title: "Ninguna empresa visitada", text: "Registra al menos una empresa visitada en la misión.", type: "warning", showConfirmButton: true });
        }
    }

    function ordenar_empresas_visitadas(){
        var filas = $("#target").children("tbody").children("tr");
        var input,idqr = "", query = "UPDATE vyp_empresas_visitadas \nSET orden = CASE id_empresas_visitadas\n";

        for(i=0; i<filas.length; i++){
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

                        if(((bd_inicio <= hora_inicio && bd_inicio >= hora_inicio) || (bd_inicio >= hora_inicio && bd_fin <= hora_fin) || (bd_inicio <= hora_fin && bd_fin >= hora_fin)) && viaticos[i][5] == ''){
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
                    estado_revision();
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
                    swal({ title: "!Solicitud exitosa!", type: "success", showConfirmButton: true });
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
                    if((hora_inicio >= $(celdas2[0]).html() && hora_inicio <= $(celdas2[1]).html()) || (hora_fin >= $(celdas2[0]).html() && hora_fin <= $(celdas2[1]).html()) ||  (hora_inicio <= $(celdas2[0]).html() && hora_fin >= $(celdas2[1]).html())){
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

        <!-- ============================================================== -->
        <!-- Fin TITULO de la página de sección -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Inicio del CUERPO DE LA SECCIÓN -->
        <!-- ============================================================== -->
        <div class="row">

            <div class="col-lg-1"></div>
            <div class="col-lg-10" id="cnt_form" style="display: none;">

                <?php 
                    $id_mision = 1;
                    $query = $this->db->query("SELECT * FROM vyp_empresas_visitadas WHERE id_mision_oficial = '".$id_mision."' AND observacion <> '' AND observacion IS NOT NULL");

                    $query2 = $this->db->query("SELECT * FROM vyp_observacion_solicitud WHERE id_mision = '".$id_mision."'");

                    if($query->num_rows() > 0 || $query2->num_rows > 0){
                ?>
                <div class="card">
                    <div class="card-header bg-danger">
                        <h4 class="card-title m-b-0 text-white">Observaciones</h4>
                    </div>
                    <div class="card-body b-t">


                        <ul class="list-task list-group m-b-0" data-role="tasklist">

                        <?php 
                            if($query->num_rows() > 0){ 
                                foreach ($query->result() as $fila) {
                        ?>
                            <li class="list-group-item" data-role="task" style="border: 0; padding: 7px;">
                                <div class="checkbox checkbox-info">
                                    <input type="checkbox" id="inputCall" name="inputCheckboxesCall">
                                    <label for="inputCall" class=""> <span><?php echo $fila->observacion; ?></span></label>
                                </div>
                            </li>
                        <?php 
                                }
                           }
                        ?>

                        <?php 
                            if($query2->num_rows() > 0){ 
                                    echo "Más observaciones en el Paso 3";
                        ?>
                            <li class="list-group-item" data-role="task" style="border: 0; padding: 7px;">
                                <div class="checkbox checkbox-info">
                                    <input type="checkbox" id="inputBook" name="inputCheckboxesBook" disabled="">
                                    <label for="inputBook" class=""> <span>Mas observaciones en Paso 3</span></label>
                                </div>
                            </li>
                        <?php 
                           }
                        ?>
                        </ul>
                    </div>
                </div>
                <?php } ?>
                
                <div class="card">
                    <div class="card-header bg-success2" id="ttl_form">
                        <div class="card-actions text-white">
                            <a style="font-size: 16px;" onclick="cerrar_mantenimiento();"><i class="mdi mdi-window-close"></i></a>
                        </div>
                        <h4 class="card-title m-b-0 text-white"></h4>
                    </div>
                    <div class="card-body b-t">


                        <!-- ============================================================== -->
                        <!-- Inicio del FORMULARIO DATOS DE MISIÓN -->
                        <!-- ============================================================== -->
                        <div id="cnt_mision">

                            <h3 class="box-title" style="margin: 0px;">
                                <button type="button" class="btn waves-effect waves-light btn-lg btn-danger" style="padding: 1px 10px 1px 10px;">Paso 1</button>&emsp;
                                Datos de la misión
                            </h3>
                            <hr class="m-t-0 m-b-30">
                            <?php echo form_open('', array('id' => 'formajax', 'style' => 'margin-top: 0px;', 'class' => 'm-t-40', 'novalidate' => '')); ?>
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
                                    <input type="text" pattern="\d{1,2}-\d{1,2}-\d{4}" data-date-end-date="0d" data-date-start-date="-5d" onkeyup="FECHA('fecha_mision')" required="" value="<?php echo date('d-m-Y'); ?>" class="form-control" id="fecha_mision" name="fecha_mision" placeholder="dd/mm/yyyy">
                                    <div class="help-block"></div>                   
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-lg-12" style="height: 83px;">
                                    <h5>Actividad realizada: <span class="text-danger">*</span></h5>
                                    <textarea type="text" onkeyup="TEXTO('actividad',3,500);" id="actividad" name="actividad" class="form-control" required="" placeholder="Describa la actividad realizada en la misión" minlength="3" data-validation-required-message="Este campo es requerido"></textarea>
                                    <div class="help-block"></div>
                                </div>
                            </div>

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
                                    <label for="destino_municipio" onclick="form_folleto_viaticos();">Folleto de distancias</label>&emsp;
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


<script>
$(function(){  

    $(document).ready(function(){         
        $('#fecha_mision').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true,
            todayHighlight: true
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
        var formData = {
            "id_mision" : $("#id_mision").val(),
            "departamento" : $("#departamento").val(),
            "municipio" : $("#municipio").val(),
            "nombre_empresa" : $("#nombre_empresa").val(),
            "direccion_empresa" : $("#direccion_empresa").val(),
            "distancia" : $("#distancia").val(),
            "tipo" : $('input[name=r_destino]:checked').val(),
            "band" : $("#band2").val()
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

});

</script>