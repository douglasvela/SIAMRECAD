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
        tabla_observaciones();
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

    function tabla_observaciones(){    
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
                //var ths = $("#myTable").find("thead").find("th");
                //$(ths[0]).click();
            }
        }
        xmlhttpB.open("GET","<?php echo site_url(); ?>/viaticos/observaciones_director_regional/tabla_observaciones",true);
        xmlhttpB.send(); 
    }

    function tabla_empresas_visitadas(id_mision){    
        var iframe = $('<embed onload="funcion(this)">');
            iframe.attr('width','100%');
            iframe.attr('src',"<?php echo site_url(); ?>/viaticos/solicitud_viatico/imprimir_solicitud?id_mision="+id_mision);
            //$('#cnt_tabla_empresas').append(iframe);
            $('#cnt_tabla_empresas').append(iframe, funcion(iframe) );
    }

    function funcion(iframe){
        $(iframe).attr('height','500px;');
        listado_observaciones();
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
                $('[data-toggle="tooltip"]').tooltip();
            }
        }
        xmlhttpB.open("GET","<?php echo site_url(); ?>/viaticos/observaciones_director_regional/listado_observaciones?id_mision="+gid_mision,true);
        xmlhttpB.send(); 
    }


    function eliminar_saltos(obj){        
        var cadena = $(obj).val();
        var sin_salto = cadena.split("\n").join("");
        $(obj).val(sin_salto);
    }

    function eliminar_observacion(id_observacion){
        ajax = objetoAjax();
        ajax.open("POST", "<?php echo site_url(); ?>/viaticos/observaciones_director_regional/eliminar_observacion", true);
        ajax.onreadystatechange = function() {
            if (ajax.readyState == 4){
                if(ajax.responseText == "exito"){
                    $.toast({ heading: 'Observación eliminada', text: 'El registro de observación fue eliminado exitosamente.', position: 'top-right', loaderBg:'#fc4b6c', icon: 'error', hideAfter: 3500, stack: 6
                    });
                    listado_observaciones();
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
        ajax.open("POST", "<?php echo site_url(); ?>/viaticos/observaciones_director_regional/verificar_observaciones", true);
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
                        if(estado_solicitud == "3"){    //si la solicitud es revisada por el jefe inmediato
                            cambiar_estado_solicitud(4);    //cambiar estado solicitud a observada por jefe inmediato
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
                        if(estado_solicitud == "3"){    //si la solicitud es revisada por el jefe inmediato
                            cambiar_estado_solicitud(5);    //enviar a revision a director o jefe de regional
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
        ajax.open("POST", "<?php echo site_url(); ?>/viaticos/observaciones_director_regional/cambiar_estado_solicitud", true);
        ajax.onreadystatechange = function() {
            if (ajax.readyState == 4){
                if(ajax.responseText == "exito"){
                    swal({ title: "¡Cambios aplicados!", type: "success", showConfirmButton: true });
                    cerrar_mantenimiento();
                    tabla_observaciones();
                    $('[data-toggle="tooltip"]').tooltip();
                }else{
                    swal({ title: "¡Ups! Error", text: "Intentalo nuevamente.", type: "error", showConfirmButton: true });
                }
            }
        } 
        ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded"); 
        ajax.send("&id_mision="+gid_mision+"&estado="+estado)
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
            <div class="col-lg-1"></div>
            <div class="col-lg-10" id="cnt_form" style="display: none;">
                <div class="card">
                    <div class="card-header bg-info" id="ttl_form">
                        <div class="card-actions text-white">
                            <a style="font-size: 16px;" onclick="cerrar_mantenimiento();"><i class="mdi mdi-window-close"></i></a>
                        </div>
                        <h4 class="card-title m-b-0 text-white">Listado de solicitudes</h4>
                    </div>
                    <div class="card-body b-t">


                        <div id="cnt_tabla_empresas"></div>
                        <input type="hidden" name="estado" id="estado">
                        <input type="hidden" id="nr_observador" name="nr_observador" value="<?php echo $nr_usuario; ?>">


                        <?php echo form_open('', array('id' => 'formajax2', 'style' => 'margin-top: 0px;', 'class' => 'input-form', 'novalidate' => '')); ?>
                            <label class="control-label m-t-20" for="example-input1-group2">Nueva observación</label>
                            <div class="row">
                                <div class="col-lg-12 form-group">
                                    <div class="input-group">
                                        <input type="text" id="observacion" name="observacion" class="form-control" placeholder="Detalle de la observación" required="" minlength="5">
                                        <span class="input-group-btn">
                                          <button class="btn btn-success2" type="submit">Agregar</button>
                                        </span>
                                    </div>
                                    <div class="help-block"></div>
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
            <div class="col-lg-1"></div>
            <!-- ============================================================== -->
            <!-- Fin del FORMULARIO de gestión -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Inicio de la TABLA -->
            <!-- ============================================================== -->
            <div class="col-lg-12" id="cnt_tabla">

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
    $("#formajax2").on("submit", function(e){
        e.preventDefault();

        var formData = {
            "id_mision" : gid_mision,
            "observacion" : $("#observacion").val(),
            "nr_observador" : $("#nr_observador").val(),
            "id_tipo_observador" : "1",
            "tipo_observador" : "Jefe inmediato"
        };
        $.ajax({
            type:  'POST',
            url:   '<?php echo site_url(); ?>/viaticos/observaciones_director_regional/otra_observacion',
            data: formData,
            cache: false
        })
        .done(function(res){
            if(res == "exito"){
                $.toast({ heading: 'Observación registrada', text: 'La observación se registró exitosamente.', position: 'top-right', loaderBg:'#3c763d', icon: 'success', hideAfter: 3500, stack: 6
                });
                listado_observaciones();
            }else{
                swal({ title: "¡Ups! Error", text: "Intentalo nuevamente.", type: "error", showConfirmButton: true });
            }
        });
            
    });
});

</script>