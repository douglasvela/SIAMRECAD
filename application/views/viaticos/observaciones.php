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

    // Características del navegador
    $ua=$this->config->item("navegator");
    $navegatorless = false;
    if(floatval($ua['version']) < $this->config->item("last_version")){
        $navegatorless = true;
    }

?>
<script type="text/javascript">   

    var gid_mision;
    function cambiar_mision(id_mision, estado){  
        gid_mision = id_mision;     
        $("#btnadd").show(0);
        $("#btnedit").hide(0);
        $("#cnt_tabla").hide(0);
        $("#cnt_form").show(0);
        $("#ttl_form").children("h4").html("<span class='mdi mdi-wrench'></span> Revisando solicitud");
        $("#estado").val(estado);
        tabla_empresas_visitadas(gid_mision);
    }

    function cerrar_mantenimiento(){
        $("#cnt_tabla").show(0);
        $("#cnt_form").hide(0);
        $("#cnt_tabla_empresas").html('');
    }

    function iniciar(){
        //tabla_observaciones();
         
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

    function tabla_observaciones1(){    
        if(window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttpB=new XMLHttpRequest();
        }else{// code for IE6, IE5
            xmlhttpB=new ActiveXObject("Microsoft.XMLHTTPB");
        }
            xmlhttpB.onreadystatechange=function(){
            if (xmlhttpB.readyState==4 && xmlhttpB.status==200){
                
                document.getElementById("cnt_tabla1").innerHTML=xmlhttpB.responseText;
               
                $("#id_tipo_observador").val("1");
                $('#myTable1').DataTable();
                $('[data-toggle="tooltip"]').tooltip();

                if($("#numObservacion1").val() != "0"){
                    $("#notify1").html('<span class="label label-danger" style="padding: 3px 5px;">'+$("#numObservacion1").val()+'</span>');
                }else{
                    $("#notify1").html('');
                }
            }
        }
        xmlhttpB.open("GET","<?php echo site_url(); ?>/viaticos/observaciones/tabla_observaciones1",true);
        xmlhttpB.send();  
        
    }

    function tabla_observaciones2(){    
        if(window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttpB=new XMLHttpRequest();
        }else{// code for IE6, IE5
            xmlhttpB=new ActiveXObject("Microsoft.XMLHTTPB");
        }
        xmlhttpB.onreadystatechange=function(){
            if (xmlhttpB.readyState==4 && xmlhttpB.status==200){
                document.getElementById("cnt_tabla2").innerHTML=xmlhttpB.responseText;
                $('#myTable2').DataTable();
                $("#id_tipo_observador").val("2");
                $('[data-toggle="tooltip"]').tooltip();
                if($("#numObservacion2").val() != "0"){
                    $("#notify2").html('<span class="label label-danger" style="padding: 3px 5px;">'+$("#numObservacion2").val()+'</span>');
                }else{
                    $("#notify2").html('');
                }
            }
        }
        xmlhttpB.open("GET","<?php echo site_url(); ?>/viaticos/observaciones/tabla_observaciones2",true);
        xmlhttpB.send(); 
    }

    function tabla_observaciones3(){
        var linea = $("#linea").val();
        if(window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttpB=new XMLHttpRequest();
        }else{// code for IE6, IE5
            xmlhttpB=new ActiveXObject("Microsoft.XMLHTTPB");
        }
        xmlhttpB.onreadystatechange=function(){
            if (xmlhttpB.readyState==4 && xmlhttpB.status==200){
                document.getElementById("cnt_tabla3").innerHTML=xmlhttpB.responseText;
                $('#myTable3').DataTable();
                $("#id_tipo_observador").val("3");
                $('[data-toggle="tooltip"]').tooltip();
                if($("#numObservacion3").val() != "0"){
                    $("#notify3").html('<span class="label label-danger" style="padding: 3px 5px;">'+$("#numObservacion3").val()+'</span>');
                }else{
                    $("#notify3").html('');
                }
            }
        }
        xmlhttpB.open("GET","<?php echo site_url(); ?>/viaticos/observaciones/tabla_observaciones3?linea="+linea,true);
        xmlhttpB.send(); 
    }

    function tabla_empresas_visitadas(id_mision){    
        var iframe = $('<embed onload="funcion(this)">');
            iframe.attr('width','100%');
            iframe.attr('height','1190px;');
            iframe.attr('src',"<?php echo site_url(); ?>/viaticos/solicitud_viatico/imprimir_solicitud_detallada?id_mision="+id_mision);
            //$('#cnt_tabla_empresas').append(iframe);
            $('#cnt_tabla_empresas').append(iframe, funcion(iframe) );
    }

    function funcion(iframe){
        justificacion();
    }

    function listado_observaciones(){    
        if(window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttpB=new XMLHttpRequest();
        }else{// code for IE6, IE5
            xmlhttpB=new ActiveXObject("Microsoft.XMLHTTPB");
        }
        xmlhttpB.onreadystatechange=function(){
            if (xmlhttpB.readyState==4 && xmlhttpB.status==200){
                document.getElementById("cnt_lista_observaciones").innerHTML=xmlhttpB.responseText;
                if($("#id_tipo_observador").val() == "3"){
                    cnt_notificaciones();
                }
                $('[data-toggle="tooltip"]').tooltip();
            }
        }
        xmlhttpB.open("GET","<?php echo site_url(); ?>/viaticos/observaciones/listado_observaciones?id_mision="+gid_mision,true);
        xmlhttpB.send(); 
    }


    function eliminar_saltos(obj){        
        var cadena = $(obj).val();
        var sin_salto = cadena.split("\n").join("");
        $(obj).val(sin_salto);
    }

    function eliminar_observacion(id_observacion){
        ajax = objetoAjax();
        ajax.open("POST", "<?php echo site_url(); ?>/viaticos/observaciones/eliminar_observacion", true);
        ajax.onreadystatechange = function() {
            if (ajax.readyState == 4){
                if(ajax.responseText == "exito"){
                    $.toast({ heading: 'Observación eliminada', text: 'El registro de observación fue eliminado exitosamente.', position: 'top-right', loaderBg:'#fc4b6c', icon: 'error', hideAfter: 3500, stack: 6
                    });
                    listado_observaciones();
                    limpiar_observaciones();
                }else{
                    swal({ title: "¡Ups! Error", text: "Intentalo nuevamente.", type: "error", showConfirmButton: true });
                }
            }
        } 
        ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded"); 
        ajax.send("&id_observacion="+id_observacion)
    }

    function verificar_observaciones(){
        var estado_solicitud = $("#estado").val();
        ajax = objetoAjax();
        ajax.open("POST", "<?php echo site_url(); ?>/viaticos/observaciones/verificar_observaciones", true);
        ajax.onreadystatechange = function() {
            if (ajax.readyState == 4){
                if(ajax.responseText == "observaciones"){
                    swal({   
                        title: "Observaciones encontradas",   
                        text: "¿Desea observar la solicitud?",   
                        type: "warning",   
                        showCancelButton: true,   
                        confirmButtonColor: "#fc4b6c",   
                        confirmButtonText: "Sí, deseo observar!",   
                        closeOnConfirm: true 
                    }, function(){   
                        if(estado_solicitud == "1"){    //si la solicitud es revisada por el jefe inmediato
                            cambiar_estado_solicitud(2);    //cambiar estado solicitud a observada por jefe inmediato
                        }else if(estado_solicitud == "3"){    //si la solicitud es revisada por el jefe inmediato
                            cambiar_estado_solicitud(4);    //cambiar estado solicitud a observada por jefe inmediato
                        }else if(estado_solicitud == "5"){    //si la solicitud es revisada por el jefe inmediato
                            cambiar_estado_solicitud(6);    //cambiar estado solicitud a observada por jefe inmediato
                        }
                    });
                }else if(ajax.responseText == "aprobar"){
                    swal({   
                        title: "Sin observaciones",   
                        text: "¿Desea aprobar la solicitud?",   
                        type: "warning",   
                        showCancelButton: true,   
                        confirmButtonColor: "#fc4b6c",   
                        confirmButtonText: "Sí, deseo aprobar!",   
                        closeOnConfirm: true 
                    }, function(){
                        if(estado_solicitud == "1"){    //si la solicitud es revisada por el jefe inmediato
                            cambiar_estado_solicitud(3);    //enviar a revision a director o jefe de regional
                        }else if(estado_solicitud == "3"){    //si la solicitud es revisada por el jefe inmediato
                            cambiar_estado_solicitud(5);    //cambiar estado solicitud a observada por jefe inmediato
                        }else if(estado_solicitud == "5"){    //si la solicitud es revisada por el jefe inmediato
                            cambiar_estado_solicitud(7);    //cambiar estado solicitud a observada por jefe inmediato
                        }
                    });
                }else{
                    swal({ title: "¡Ups! Error", text: "Intentalo nuevamente.", type: "error", showConfirmButton: true });
                }
            }
        } 
        ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded"); 
        ajax.send("&id_mision="+gid_mision)
    }

    function cambiar_estado_solicitud(estado){
        ajax = objetoAjax();
        ajax.open("POST", "<?php echo site_url(); ?>/viaticos/observaciones/cambiar_estado_solicitud", true);
        ajax.onreadystatechange = function() {
            if (ajax.readyState == 4){
                if(ajax.responseText == "exito"){
                    swal({ title: "¡Cambios aplicados!", type: "success", showConfirmButton: true });
                    cerrar_mantenimiento();
                    if($("#id_tipo_observador").val() == "1"){
                        tabla_observaciones1();
                    }else if($("#id_tipo_observador").val() == "2"){
                        tabla_observaciones2();
                    }else if($("#id_tipo_observador").val() == "3"){
                        tabla_observaciones3();
                    }
                    $('[data-toggle="tooltip"]').tooltip();
                }else{
                    swal({ title: "¡Ups! Error", text: "Intentalo nuevamente.", type: "error", showConfirmButton: true });
                }
            }
        } 
        ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded"); 
        ajax.send("&id_mision="+gid_mision+"&estado="+estado)
    }


    function justificacion(){
        var newName = 'Otro nombre',
        xhr = new XMLHttpRequest();

        var id_mision = gid_mision;

        xhr.open('GET', "<?php echo site_url(); ?>/viaticos/solicitud_viatico/cnt_justificacion?id_mision="+id_mision);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status === 200 && xhr.responseText !== newName) {
                document.getElementById("cnt_justificacion").innerHTML = xhr.responseText;
                listado_observaciones();
            }else if (xhr.status !== 200) {
                swal({ title: "Ups! ocurrió un Error", text: "Al parecer no todos los objetos se cargaron correctamente por favor recarga la página e intentalo nuevamente", type: "error", showConfirmButton: true });
            }
        };
        xhr.send(encodeURI('name=' + newName));
    }

    function cnt_notificaciones(){
        var newName = 'Otro nombre',
        xhr = new XMLHttpRequest();

        var id_mision = gid_mision;

        xhr.open('GET', "<?php echo site_url(); ?>/viaticos/observaciones/cnt_notificaciones?id_mision="+id_mision);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status === 200 && xhr.responseText !== newName) {
                document.getElementById("cnt_notificaciones").innerHTML = xhr.responseText;
            }else if (xhr.status !== 200) {
                swal({ title: "Ups! ocurrió un Error", text: "Al parecer no todos los objetos se cargaron correctamente por favor recarga la página e intentalo nuevamente", type: "error", showConfirmButton: true });
            }
        };
        xhr.send(encodeURI('name=' + newName));
    }

    function actualizar_tooltip(){
        $('[data-toggle="tooltip"]').tooltip();
    }

    function consultar_pago_solicitud(id_mision, id_pago, fecha_pago, tipo_pago, num_cheque){
        swal({   
            title: "¿Está seguro(a)?",   
            text: "La solicitud será aprobada y se aplicarán los cambios del pago",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#fc4b6c",   
            confirmButtonText: "Sí, deseo aprobar!",   
            closeOnConfirm: true 
        }, function(){
            actualizar_pago_solicitud(id_mision, id_pago, fecha_pago, tipo_pago, num_cheque)
        });
    }

    function actualizar_pago_solicitud(id_mision, id_pago, fecha_pago, tipo_pago, num_cheque){
        var formData = {
            "id_mision" : gid_mision,
            "id_pago" : id_pago,
            "fecha_pago" : fecha_pago,
            "tipo_pago" : tipo_pago,
            "num_cheque" : num_cheque
        };
        $.ajax({
            type:  'POST',
            url:   '<?php echo site_url(); ?>/viaticos/observaciones/pagar_solicitud',
            data: formData,
            cache: false
        })
        .done(function(res){
            console.log(res)
            if(res == "exito"){
                swal({ title: "¡Cambios aplicados!", text: "Solicitud pagada y aprobada exitosamente", type: "success", showConfirmButton: true });
                cerrar_mantenimiento();
                if($("#id_tipo_observador").val() == "1"){
                    tabla_observaciones1();
                }else if($("#id_tipo_observador").val() == "2"){
                    tabla_observaciones2();
                }else if($("#id_tipo_observador").val() == "3"){
                    tabla_observaciones3();
                }
                $('[data-toggle="tooltip"]').tooltip();
            }else{
                swal({ title: "¡Ups! Error", text: "Intentalo nuevamente.", type: "error", showConfirmButton: true });
            }
        });
    }

    function bitacora(id_mision, disponibilidad){
        if(disponibilidad == 0){
            swal({ title: "No disponible", text: "La bitácora está disponible para solicitudes elaboradas a partir del: 25/10/2018", type: "info", showConfirmButton: true });
        }else{
            var newName = 'AjaxCall', xhr = new XMLHttpRequest();
            xhr.open('GET', "<?php echo site_url(); ?>/viaticos/solicitud_viatico/bitacora?id_mision="+id_mision);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200 && xhr.responseText !== newName) {
                    document.getElementById("cnt_bitacora").innerHTML = xhr.responseText;
                    $("#modal_bitacora").modal('show');
                    $('[data-toggle="tooltip"]').tooltip();
                }else if (xhr.status !== 200) {
                    swal({ title: "Ups! ocurrió un Error", text: "Al parecer la tabla de bitácora no se cargó correctamente por favor recarga la página e intentalo nuevamente", type: "error", showConfirmButton: true });
                }
            };
            xhr.send(encodeURI('name=' + newName));
        }
    }

    function combo_opciones(paso){
        var newName = 'Otro nombre',
        xhr = new XMLHttpRequest();

        var id_mision = gid_mision;
        xhr.open('GET', "<?php echo site_url(); ?>/viaticos/observaciones/combo_opciones?id_mision="+id_mision+"&paso="+paso);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status === 200 && xhr.responseText !== newName) {
                document.getElementById("cnt_opciones").innerHTML = xhr.responseText;
            }else if (xhr.status !== 200) {
                swal({ title: "Ups! ocurrió un Error", text: "Al parecer no todos los objetos se cargaron correctamente por favor recarga la página e intentalo nuevamente", type: "error", showConfirmButton: true });
            }
        };
        xhr.send(encodeURI('name=' + newName));

        if(paso == 2 || paso == 3){
            $("#cnt_opciones").show(500);
        }else{
            $("#cnt_opciones").hide(500);
            $("#opciones").val('');
        }
    }

    function limpiar_observaciones(){
        $("#paso").val('');
        $("#observacion").val('');
        $("#id_observado").val('');
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
                <h3 class="text-themecolor m-b-0 m-t-0">Gestión de observación de solicitudes</h3>
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
            <div class="col-lg-12" id="cnt_form" style="display: none;">
                <div class="card">
                    <div class="card-header bg-info" id="ttl_form">
                        <div class="card-actions text-white">
                            <a style="font-size: 16px;" onclick="cerrar_mantenimiento();"><i class="mdi mdi-window-close"></i></a>
                        </div>
                        <h4 class="card-title m-b-0 text-white">Listado de solicitudes</h4>
                    </div>
                    <div class="card-body b-t">

                        <div id="cnt_notificaciones"></div>

                        <div id="cnt_tabla_empresas"></div>

                        <div id="cnt_justificacion" class="row"></div>
                        
                        <input type="hidden" name="estado" id="estado">
                        <input type="hidden" id="nr_observador" name="nr_observador" value="<?php echo $nr_usuario; ?>">
                        <input type="hidden" id="id_tipo_observador" name="id_tipo_observador" value="1">


                        <?php echo form_open('', array('id' => 'formajax2', 'style' => 'margin-top: 0px;', 'class' => 'input-form')); ?>
                            <label class="control-label m-t-20" for="example-input1-group2">Nueva observación</label>
                            <div class="row">
                                <div class="form-group col-lg-4 <?php if($navegatorless){ echo "pull-left"; } ?>">
                                    <h5>Tipo: <span class="text-danger">*</span></h5>
                                    <select id="paso" name="paso" class="form-control custom-select"  style="width: 100%" required="" onchange="combo_opciones(this.value);">
                                        <option class="m-l-50" value="">[SELECCIONE]</option>
                                        <option class="m-l-50" value="2">EMPRESAS VISITADAS</option>
                                        <option class="m-l-50" value="3">DETALLE DEL RECORRIDO</option>
                                        <option class="m-l-50" value="1">DETALLE DE LA ACTIVIDAD</option>
                                        <option class="m-l-50" value="0">OTROS...</option>
                                    </select>
                                </div>
                                <div class="form-group col-lg-8 <?php if($navegatorless){ echo "pull-left"; } ?>" id="cnt_opciones">
                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 form-group">
                                    <div class="input-group">
                                        <input type="text" id="observacion" name="observacion" class="form-control" placeholder="Detalle de la observación" required="" minlength="5">
                                        
                                        <span class="input-group-btn">
                                          <button class="btn btn-success2" type="submit">Agregar</button>
                                        </span>
                                         
                                    </div>
                                </div>
                            </div>

                        <?php echo form_close(); ?>


                        <div id="cnt_lista_observaciones"></div>

                        <div align="right">
                            <button type="button" onclick="verificar_observaciones();" class="btn waves-effect waves-light btn-success"><i class="mdi mdi-plus"></i>Finalizar observaciones</button>
                        </div>


                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- Fin del FORMULARIO de gestión -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Inicio de la TABLA -->
            <!-- ============================================================== -->

            <div class="col-lg-12" id="cnt_tabla">
            

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title m-b-0">Listado de solicitudes</h4>
                </div>
                <div class="card-body b-t"  style="padding-top: 7px;">

                    
                        <?php
                            $id_modulo_observaciones = busca_id_org_modulo($segmentos = 2);
                            $modulos = $this->db->query("SELECT * FROM org_modulo WHERE dependencia = '".$id_modulo_observaciones."' ORDER BY orden");
                            if($modulos->num_rows() > 0){
                                $correlativo = 0;
                                $contadorp = 0;
                                $active = 0;
                                foreach ($modulos->result() as $fila) {
                                    $correlativo++;
                                    $data['id_modulo'] = $fila->id_modulo;
                                    $data['id_usuario'] = $this->session->userdata('id_usuario_viatico');
                                    $data['id_permiso']="1";
                                    if(buscar_permiso($data)){
                                        $contadorp++;
                                        if($contadorp == 1){
                                            echo '<ul class="nav nav-tabs customtab2" role="tablist">';
                                            $active = $correlativo;
                                        }
                        ?>
                            <li class="nav-item"> 
                                <a class="nav-link <?php if($contadorp == 1){ echo "active"; } ?>" data-toggle="tab" href="#observacion<?php echo $correlativo; ?>" role="tab" onClick="<?php echo 'tabla_observaciones'.$correlativo.'();'; ?>">
                                    <span class="hidden-sm-up"><i class="ti-home"></i></span> 
                                    <span class="hidden-xs-down"><?php echo $fila->nombre_modulo; ?> <output id="notify<?php echo $correlativo; ?>"></output></span></a> 
                            </li>
                        <?php
                                    }
                                }
                                if($contadorp > 0){
                                echo "</ul>";
                        ?>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane p-20 <?php if($active == 1){ echo "active"; } ?>" id="observacion1" role="tabpanel">
                                
                                <div id="cnt_tabla1"> Cargando <span class="fa fa-spinner fa-spin"></span></div>

                            </div>
                            <div class="tab-pane p-20 <?php if($active == 2){ echo "active"; } ?>" id="observacion2" role="tabpanel">

                                <div id="cnt_tabla2"> Cargando <span class="fa fa-spinner fa-spin"></span></div>

                            </div>
                            <div class="tab-pane p-20 <?php if($active == 3){ echo "active"; } ?>" id="observacion3" role="tabpanel">
                                <select class="custom-select pull-right" id="linea" name="linea" onchange="tabla_observaciones3();">
                                    <option value="">Todas las líneas</option>
                                    <?php 
                                        $linea = $this->db->query("SELECT * FROM org_linea_trabajo ORDER BY linea_trabajo");
                                        if($linea->num_rows() > 0){
                                            foreach ($linea->result() as $fila2) {
                                                echo "<option value='".$fila2->linea_trabajo."'>".$fila2->linea_trabajo."</option>";
                                            }
                                        }
                                    ?>
                                </select>
                                <div id="cnt_tabla3"> Cargando <span class="fa fa-spinner fa-spin"></span></div>

                            </div>
                        </div>
                        <?php
                                }
                            } 
                            echo "<script>";
                            echo 'setTimeout( tabla_observaciones'.$active.' , 500);';
                            echo "</script>";
                        ?>



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
<div id="modal_bitacora" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Bitácora de la solicitud</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body" id="cnt_bitacora">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success waves-effect" data-dismiss="modal">Aceptar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<script>

$(function(){     
    $("#formajax2").on("submit", function(e){
        e.preventDefault();
        var tipo_jefe = "Jefatura inmediata";
        if($("#id_tipo_observador").val() == "1"){
            tipo_jefe = "Jefatura inmediato";
        }else if($("#id_tipo_observador").val() == "2"){
            tipo_jefe = "Dirección o Jefatura regional";
        }else if($("#id_tipo_observador").val() == "3"){
            tipo_jefe = "Fondo Circulante";
        }

        var formData = {
            "id_mision" : gid_mision,
            "observacion" : $("#observacion").val(),
            "nr_observador" : $("#nr_observador").val(),
            "id_tipo_observador" : $("#id_tipo_observador").val(),
            "paso" : $("#paso").val(),
            "id_observado" : $("#id_observado").val(),
            "tipo_observador" : tipo_jefe
        };
        $.ajax({
            type:  'POST',
            url:   '<?php echo site_url(); ?>/viaticos/observaciones/otra_observacion',
            data: formData,
            cache: false
        })
        .done(function(res){
            if(res == "exito"){
                $.toast({ heading: 'Observación registrada', text: 'La observación se registró exitosamente.', position: 'top-right', loaderBg:'#3c763d', icon: 'success', hideAfter: 3500, stack: 6
                });
                listado_observaciones();
                limpiar_observaciones();
            }else{
                swal({ title: "¡Ups! Error", text: "Intentalo nuevamente.", type: "error", showConfirmButton: true });
            }
        });
            
    });
});

</script>