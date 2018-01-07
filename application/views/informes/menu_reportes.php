 <style>

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
     
    function editar_oficina(id_vyp_rutas,id_oficina_origen_vyp_rutas,descripcion_destino_vyp_rutas,id_oficina_destino_vyp_rutas,km_vyp_rutas){
        limpiar();
        $("#cnt-tabla").hide(0);
        $("#cnt_form").show(0);
        mostrarpanel_oficina();
         
        
       document.getElementById('destino_oficina').checked = true;
        $("#id_vyp_rutas").val(id_vyp_rutas);
        $("#id_oficina_origen_vyp_rutas").val(id_oficina_origen_vyp_rutas);
        $("#descripcion_destino_vyp_rutas").val(descripcion_destino_vyp_rutas);
        $("#id_oficina_destino_vyp_rutas").val(id_oficina_destino_vyp_rutas);
        $("#km_vyp_rutas").val(km_vyp_rutas);
         $("#btnadd").hide(0);
        $("#btnedit").show(0);  
        $("#band").val("edit");
     }
     function editar_municipio(id_vyp_rutas,id_oficina_origen_vyp_rutas,descripcion_destino_vyp_rutas,id_departamento_vyp_rutas,id_municipio_vyp_rutas,km_vyp_rutas){
        limpiar();
         $("#cnt-tabla").hide(0);
        $("#cnt_form").show(0);
        mostrarpanel_municipio();
        
        document.getElementById('destino_municipio').checked = true;
        $("#id_vyp_rutas").val(id_vyp_rutas);
        $("#id_oficina_origen_vyp_rutas").val(id_oficina_origen_vyp_rutas);
        $("#descripcion_destino_vyp_rutas").val(descripcion_destino_vyp_rutas);
        $("#id_departamento_vyp_rutas").val(id_departamento_vyp_rutas);
       buscarMunicipio(id_departamento_vyp_rutas,id_municipio_vyp_rutas);
        $("#km_vyp_rutas").val(km_vyp_rutas);
        $("#btnadd").hide(0);
        $("#btnedit").show(0);  
        $("#band").val("edit");
    }
     
    function editar_mapa(id_vyp_rutas,id_oficina_origen_vyp_rutas,descripcion_destino_vyp_rutas,id_departamento_vyp_rutas,id_municipio_vyp_rutas,km_vyp_rutas,latitud_destino_vyp_rutas,longitud_destino_vyp_rutas){
        limpiar();
        $("#cnt-tabla").hide(0);
        $("#cnt_form").show(0);
        $("#cnt_form").removeClass("col-lg-10");
        $("#cnt_form").addClass("col-lg-6");
        $("#form_mapa").show(500);
        $("#panel_municipio").show(50);$("#panel_oficina").hide(50);
        
        document.getElementById('destino_mapa').checked = true;
        $("#id_vyp_rutas").val(id_vyp_rutas);
        $("#id_oficina_origen_vyp_rutas").val(id_oficina_origen_vyp_rutas);
        $("#descripcion_destino_vyp_rutas").val(descripcion_destino_vyp_rutas);
        $("#id_departamento_vyp_rutas").val(id_departamento_vyp_rutas);

        obtenerOrigen(id_oficina_origen_vyp_rutas,"1",latitud_destino_vyp_rutas,longitud_destino_vyp_rutas);
        buscarMunicipio(id_departamento_vyp_rutas,id_municipio_vyp_rutas);
        $("#km_vyp_rutas").val(km_vyp_rutas);
        $("#latitud_destino_vyp_rutas").val(latitud_destino_vyp_rutas);
        $("#longitud_destino_vyp_rutas").val(longitud_destino_vyp_rutas);
            $("#btnadd").hide(0);
        $("#btnedit").show(0);  
        $("#band").val("edit");
    }
    function cambiar_nuevo(){
        

        $("#band").val("save");

        $("#ttl_form").addClass("bg-success");
        $("#ttl_form").removeClass("bg-info");

        $("#btnadd").show(0);
        $("#btnedit").hide(0);

        $("#cnt-tabla").hide(0);
        $("#cnt_form").show(0);
        
        $("#ttl_form").children("h4").html("<span class='mdi mdi-plus'></span> Nueva Ruta");
        limpiar();
    }


    function cerrar_mantenimiento(){
        $("#cnt-tabla").show(0);
        $("#cnt_form").hide(0);
        $("#form_mapa").hide(0);
        limpiar();
    }
    function limpiar(){
        //$("input[name='t_destinos']:checked").removeAttr("checked");
        document.getElementById('destino_mapa').checked = false;
        document.getElementById('destino_municipio').checked = false;
        document.getElementById('destino_oficina').checked = false;
        $('#id_oficina_destino_vyp_rutas').val("");
        $('#id_oficina_origen_vyp_rutas').val("");
        $('#descripcion_destino_vyp_rutas').val("");
        $('#km_vyp_rutas').val("");
        $('#id_departamento').val("");
        $('#id_municipio').val("");
        $('#latitud_destino_vyp_rutas').val("");
        $('#longitud_destino_vyp_rutas').val("");
        $("#direccion_origen1").val("");
        $("#direccion_origen2").val("");
    }

    
    function eliminar_ruta(id){
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
            $("#id_vyp_rutas").val(id);
            preparar_ruta($("#band").val());
        });
    }

    function iniciar(){
       // tablaRutas("destino_oficina"); 
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

    function tablaoficinas(){          
        $( "#cnt-tabla" ).load("<?php echo site_url(); ?>/configuraciones/oficinas/tabla_oficinas", function() {
            $('#myTable').DataTable();
            $('[data-toggle="tooltip"]').tooltip();
        });  
    }

    function tablaRutas(destino){

        $( "#cnt-tabla" ).load("<?php echo site_url(); ?>/configuraciones/rutas/tabla_rutas/"+destino, function() {
            $('#myTable').DataTable();
            $('[data-toggle="tooltip"]').tooltip();
        });  
    }
    


    function mostrarpanel_oficina(){
        $("#panel_oficina").show(50);
        $("#cnt_form").removeClass("col-lg-6");
        $("#cnt_form").addClass("col-lg-10");
        $("#panel_municipio").hide(50);$("#form_mapa").hide(10);
    }


    function mostrarpanel_mapa(){
       //$("#btnadd").hide(0);
        $("#cnt_form").removeClass("col-lg-10");
        $("#cnt_form").addClass("col-lg-6");
        $("#form_mapa").show(500);initMap();
        $("#panel_municipio").show(50);$("#panel_oficina").hide(50);
        if($('#id_oficina_origen_vyp_rutas').val()!=""){
            obtenerOrigen($("#id_oficina_origen_vyp_rutas").val(),"2");            
        }

    }
    function mostrarpanel_municipio(){
        $("#form_mapa").hide(10);
        $("#cnt_form").removeClass("col-lg-6");
        $("#cnt_form").addClass("col-lg-10");
        $("#panel_municipio").show(50);
        $("#panel_oficina").hide(50);
    }
    function buscarMunicipio(id_departamento,seleccion){
        id=id_departamento+="x"+seleccion;
        if(window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp_municipio=new XMLHttpRequest();
        }else{// code for IE6, IE5
            xmlhttp_municipio=new ActiveXObject("Microsoft.XMLHTTPB");
        }

        xmlhttp_municipio.onreadystatechange=function(){
            if (xmlhttp_municipio.readyState==4 && xmlhttp_municipio.status==200){
                  document.getElementById("municipios").innerHTML=xmlhttp_municipio.responseText;
            }
        }

        xmlhttp_municipio.open("GET","<?php echo site_url(); ?>/configuraciones/oficinas/mostrarComboMunicipi2/"+id,true);
        xmlhttp_municipio.send();
    }
    function manttorutas(id_vyp_rutas,band,opcionruta_vyp_rutas,id_oficina_origen_vyp_rutas,id_oficina_destino_vyp_rutas,descripcion_destino_vyp_rutas,km_vyp_rutas,id_departamento,id_municipio,latitud_destino_vyp_rutas,longitud_destino_vyp_rutas){
        var formData = new FormData();
        formData.append("id_vyp_rutas", id_vyp_rutas);
        formData.append("id_oficina_origen_vyp_rutas", id_oficina_origen_vyp_rutas);
        formData.append("id_oficina_destino_vyp_rutas", id_oficina_destino_vyp_rutas);
        formData.append("opcionruta_vyp_rutas", opcionruta_vyp_rutas);
        formData.append("band", band);
        formData.append("descripcion_destino_vyp_rutas",descripcion_destino_vyp_rutas);
        formData.append("km_vyp_rutas",km_vyp_rutas);
        formData.append("id_departamento",id_departamento);
        formData.append("id_municipio",id_municipio);
        formData.append("latitud_destino_vyp_rutas",latitud_destino_vyp_rutas);
        formData.append("longitud_destino_vyp_rutas",longitud_destino_vyp_rutas);

        $.ajax({
            url: "<?php echo site_url(); ?>/configuraciones/rutas/gestionar_rutas",
            type: "post",
            dataType: "html",
            data: formData,
            cache: false,
            contentType: false,
            processData: false
        })
        .done(function(res){

            if(res == "exito"){
               $("input[name='t_destinos']:checked").removeAttr("checked"); cerrar_mantenimiento();
                if($("#band").val() == "save"){
                    swal({ title: "¡Registro exitoso!", type: "success", showConfirmButton: true });
                }else if($("#band").val() == "edit"){
                    swal({ title: "¡Modificación exitosa!", type: "success", showConfirmButton: true });
                }else{
                    swal({ title: "¡Borrado exitoso!", type: "success", showConfirmButton: true });
                }
                tablaRutas("destino_oficina");$("#band").val('save');limpiar();
            }else{
                swal({ title: "¡Ups! Error", text: "Intentalo nuevamente.", type: "error", showConfirmButton: true });
            }
        });
    }
     
 
    function obtenerOrigen(id,opcionCargarMapa,latitud_destino_vyp_rutas,longitud_destino_vyp_rutas){
        if($('input[id="destino_mapa"]').is(':checked')){
            var formData = new FormData();
            formData.append("id_oficina_origen_vyp_rutas", id);

            $.ajax({
                url: "<?php echo site_url(); ?>/configuraciones/rutas/obtener_origen",
                type: "post",
                dataType: "html",
                data: formData,
                cache: false,
                contentType: false,
                processData: false
            })
            .done(function(res){
                //console.log(res);
                var algo = res.split(",");
     
                $("#direccion_origen1").val(algo[0]);
                $("#direccion_origen2").val(algo[1]);
                 if(opcionCargarMapa==1){
                    
                    initMap(algo[0],algo[1],latitud_destino_vyp_rutas,longitud_destino_vyp_rutas);
                 }
            });
        }
    }
     function buscarmapa(){
        var departamento = $("#id_departamento_vyp_rutas option:selected").html();
        var municipio = $("#id_municipio option:selected").html();
        $("#address").val(municipio.trim()+","+departamento.trim());
        $("#submit_ubi").click();
     }







     function mostrarReporte(){
        window.open("reporte_viatico_pendiente","_blank");
     }

</script>

<!-- ============================================================== -->
<!-- Inicio de DIV de inicio (ENVOLTURA) -->
<!-- ============================================================== -->
<div class="page-wrapper">
    <div class="container-fluid">
        <button id="notificacion" style="display: none;" class="tst1 btn btn-success2">Info Message</button>
 
        <div class="row page-titles">
            <div class="align-self-center" align="center">
                <h3 class="text-themecolor m-b-0 m-t-0">Listado de Reportes</h3>
            </div>
        </div>
 
        <div class="row justify-content-center">
            
            <div class="col-lg-12 " id="cnt_form" style="display: block;">
                <div class="card">
                    <div class="card-header bg-success2" id="ttl_form">
                        <div class="card-actions text-white">
                            <a style="font-size: 16px;" onclick=""><i class="mdi mdi-window-close"></i></a>
                        </div>
                        <h4 class="card-title m-b-0 text-white">Reportes</h4>
                    </div>
                    <div class="card-body b-t">

                        <?php echo form_open('', array('id' => 'formajax', 'style' => 'margin-top: 0px;', 'class' => 'm-t-40', 'novalidate' => '')); ?>
                             
                            <div align="center">
                                <button type="button" onclick="mostrarReporte();" class="btn waves-effect waves-light btn-success"><i class="mdi mdi-recycle"></i> Ejemplo</button>
                                <button type="button" onclick="" class="btn waves-effect waves-light btn-success2"><i class="mdi mdi-plus"></i> Guardar</button>
                           
                            </div>
                            

                        <?php echo form_close(); ?>
                    </div>

                </div>
            </div>
           
            <div class="col-lg-1"></div>
                <div class="col-lg-12" id="cnt-tabla">
            </div>

        </div>



    </div>
</div>

<script>

$(function(){
    $("#formajax").on("submit", function(e){
        e.preventDefault();
        var f = $(this);
        var formData = new FormData(document.getElementById("formajax"));
        formData.append("dato", "valor");

        $.ajax({
            url: "<?php echo site_url(); ?>/configuraciones/rutas/gestionar_rutas",
            type: "post",
            dataType: "html",
            data: formData,
            cache: false,
            contentType: false,
            processData: false
        })
        .done(function(res){
            if(res == "exito"){
                cerrar_mantenimiento();
                if($("#band").val() == "save"){
                    swal({ title: "¡Registro exitoso!", type: "success", showConfirmButton: true });
                }else if($("#band").val() == "edit"){
                    swal({ title: "¡Modificación exitosa!", type: "success", showConfirmButton: true });
                }else{
                    swal({ title: "¡Borrado exitoso!", type: "success", showConfirmButton: true });
                }
                tablaRutas();$("#band").val('save');
            }else{
                swal({ title: "¡Ups! Error", text: "Intentalo nuevamente.", type: "error", showConfirmButton: true });
            }
        });

    });


});

</script>
 