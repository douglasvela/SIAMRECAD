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



       document.getElementById('destino_oficina').checked = true;
        $("#id_vyp_rutas").val(id_vyp_rutas);
        $("#id_oficina_origen_vyp_rutas").val(id_oficina_origen_vyp_rutas);
        $("#descripcion_destino_vyp_rutas").val(descripcion_destino_vyp_rutas);
        $("#id_oficina_destino_vyp_rutas").val(id_oficina_destino_vyp_rutas);
        $("#km_vyp_rutas").val(km_vyp_rutas);
         $("#btnadd").hide(0);
        $("#btnedit").show(0);
        mostrarpanel_oficina();$("#panel_mapa").hide(50);
        $("#band").val("edit");
     }
     function editar_municipio(id_vyp_rutas,id_oficina_origen_vyp_rutas,descripcion_destino_vyp_rutas,id_departamento_vyp_rutas,id_municipio_vyp_rutas,km_vyp_rutas){
        limpiar();
         $("#cnt-tabla").hide(0);
        $("#cnt_form").show(0);
        mostrarpanel_municipio();
        $("#panel_mapa").hide(50);
        document.getElementById('destino_municipio').checked = true;
        $("#id_vyp_rutas").val(id_vyp_rutas);
        $("#id_oficina_origen_vyp_rutas").val(id_oficina_origen_vyp_rutas);
        $("#descripcion_destino_vyp_rutas").val(descripcion_destino_vyp_rutas);
        $("#id_departamento_vyp_rutas").val(id_departamento_vyp_rutas);
obtenerOrigen(id_oficina_origen_vyp_rutas,'2');
       buscarMunicipio(id_departamento_vyp_rutas,id_municipio_vyp_rutas,'buscar');


        $("#km_vyp_rutas").val(km_vyp_rutas);
        $("#btnadd").hide(0);
        $("#btnedit").show(0);
        $("#band").val("edit");
    }

    function editar_mapa(id_vyp_rutas,id_oficina_origen_vyp_rutas,descripcion_destino_vyp_rutas,id_departamento_vyp_rutas,id_municipio_vyp_rutas,km_vyp_rutas,latitud_destino_vyp_rutas,longitud_destino_vyp_rutas,nombre_empresa_vyp_rutas,direccion_empresa_vyp_rutas){
        limpiar();
        $("#cnt-tabla").hide(0);
        $("#cnt_form").show(0);
        $("#cnt_form").removeClass("col-lg-10");
        $("#cnt_form").addClass("col-lg-6");
        $("#form_mapa").show(500);
        $("#panel_municipio").show(50);$("#panel_oficina").hide(50);
        $("#panel_mapa").show(50);
        document.getElementById('destino_mapa').checked = true;
        $("#id_vyp_rutas").val(id_vyp_rutas);
        $("#id_oficina_origen_vyp_rutas").val(id_oficina_origen_vyp_rutas);
        $("#descripcion_destino_vyp_rutas").val(descripcion_destino_vyp_rutas);
        $("#id_departamento_vyp_rutas").val(id_departamento_vyp_rutas);

        obtenerOrigen(id_oficina_origen_vyp_rutas,"1",latitud_destino_vyp_rutas,longitud_destino_vyp_rutas);
        buscarMunicipio(id_departamento_vyp_rutas,id_municipio_vyp_rutas,'');
        $("#km_vyp_rutas").val(km_vyp_rutas);
        $("#latitud_destino_vyp_rutas").val(latitud_destino_vyp_rutas);
        $("#longitud_destino_vyp_rutas").val(longitud_destino_vyp_rutas);
        $("#nombre_empresa_vyp_rutas").val(nombre_empresa_vyp_rutas);
        $("#direccion_empresa_vyp_rutas").val(direccion_empresa_vyp_rutas);
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
        $("#cnt_form").removeClass("col-lg-6");
        $("#cnt_form").addClass("col-lg-10");
        $("#panel_mapa").hide(10);
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
        $("#nombre_empresa_vyp_rutas").val("");
        $("#direccion_empresa_vyp_rutas").val("");
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
        tablaRutas("destino_oficina");
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
        $("#cnt_form").removeClass("col-lg-10");
        $("#cnt_form").addClass("col-lg-6");
        $("#panel_mapa").hide(10);

        $("#panel_municipio").hide(50);$("#form_mapa").show(10);initMap();
          if($('#id_oficina_origen_vyp_rutas').val()!=""){
            obtenerOrigen($("#id_oficina_origen_vyp_rutas").val(),"2");
            obtenerDestino($("#id_oficina_destino_vyp_rutas").val(),"1");
          }
    }


    function mostrarpanel_mapa(){
       //$("#btnadd").hide(0);
        $("#cnt_form").removeClass("col-lg-10");
        $("#cnt_form").addClass("col-lg-6");
        $("#panel_mapa").show(10);
        $("#form_mapa").show(500);initMap();
        $("#panel_municipio").show(50);$("#panel_oficina").hide(50);
        if($('#id_oficina_origen_vyp_rutas').val()!=""){
            obtenerOrigen($("#id_oficina_origen_vyp_rutas").val(),"2");
        }

    }
    function mostrarpanel_municipio(){
        $("#form_mapa").hide(10);
        $("#cnt_form").addClass("col-lg-6");
        $("#cnt_form").removeClass("col-lg-10");
        $("#panel_municipio").show(50);$("#panel_oficina").hide(50);
        $("#form_mapa").show(500);initMap();
        $("#panel_mapa").hide(10);
    }
    function buscarMunicipio(id_departamento,seleccion,buscar){
        id=id_departamento+="x"+seleccion;
        if(window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp_municipio=new XMLHttpRequest();
        }else{// code for IE6, IE5
            xmlhttp_municipio=new ActiveXObject("Microsoft.XMLHTTPB");
        }

        xmlhttp_municipio.onreadystatechange=function(){
            if (xmlhttp_municipio.readyState==4 && xmlhttp_municipio.status==200){
                  document.getElementById("municipios").innerHTML=xmlhttp_municipio.responseText;
                if(buscar=="buscar")buscarmapa();
            }
        }

        xmlhttp_municipio.open("GET","<?php echo site_url(); ?>/configuraciones/oficinas/mostrarComboMunicipi2/"+id,true);
        xmlhttp_municipio.send();
    }
    function manttorutas(id_vyp_rutas,band,opcionruta_vyp_rutas,id_oficina_origen_vyp_rutas,id_oficina_destino_vyp_rutas,descripcion_destino_vyp_rutas,km_vyp_rutas,id_departamento,id_municipio,latitud_destino_vyp_rutas,longitud_destino_vyp_rutas,nombre_empresa_vyp_rutas,direccion_empresa_vyp_rutas){
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
        formData.append("nombre_empresa_vyp_rutas",nombre_empresa_vyp_rutas);
        formData.append("direccion_empresa_vyp_rutas",direccion_empresa_vyp_rutas);

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
    function preparar_ruta(bandera){

        switch(bandera){
            case 'save':
                if($('input[id="destino_oficina"]').is(':checked')){
                    if($("#id_oficina_origen_vyp_rutas").val()=="" || $("#id_oficina_destino_vyp_rutas").val()=="" || $("#descripcion_destino_vyp_rutas").val()=="" || $("#km_vyp_rutas").val()==""){
                        swal({ title: "¡Ups!", text: "Verifique los campos vacios", type: "error", showConfirmButton: true });
                        return;
                    }else{
                      manttorutas("",
                            $("#band").val(),
                            $("#destino_oficina").val(),
                            $("#id_oficina_origen_vyp_rutas").val(),
                            $("#id_oficina_destino_vyp_rutas").val(),
                            $("#descripcion_destino_vyp_rutas").val(),
                            $("#km_vyp_rutas").val(),
                            "",
                            "",
                            "",
                            "",
                            "",
                            ""
                        );
                  }
                }else if($('input[id="destino_municipio"]').is(':checked')){
                    if($("#id_oficina_origen_vyp_rutas").val()=="" || $("#id_municipio").val()==""  || $("#id_departamento_vyp_rutas").val()=="" || $("#descripcion_destino_vyp_rutas").val()=="" || $("#km_vyp_rutas").val()==""){
                        swal({ title: "¡Ups!", text: "Verifique los campos vacios", type: "error", showConfirmButton: true });
                        return;
                    }else{
                        manttorutas("",
                            $("#band").val(),
                            $("#destino_municipio").val(),
                            $("#id_oficina_origen_vyp_rutas").val(),
                            "",
                            $("#descripcion_destino_vyp_rutas").val(),
                            $("#km_vyp_rutas").val(),
                            $("#id_departamento_vyp_rutas").val(),
                            $("#id_municipio").val(),
                            "",
                            "",
                            "",
                            ""
                        );
                    }
                }else if($('input[id="destino_mapa"]').is(':checked')){
                    if($("#id_oficina_origen_vyp_rutas").val()=="" || $("#id_municipio").val()==""  || $("#id_departamento_vyp_rutas").val()=="" || $("#descripcion_destino_vyp_rutas").val()=="" || $("#km_vyp_rutas").val()==""   || $("#latitud_destino_vyp_rutas").val()=="" || $("#longitud_destino_vyp_rutas").val()==""){
                        swal({ title: "¡Ups!", text: "Verifique los campos vacios", type: "error", showConfirmButton: true });
                        return;
                    }else{
                        manttorutas("",
                            $("#band").val(),
                            $("#destino_mapa").val(),
                            $("#id_oficina_origen_vyp_rutas").val(),
                            "",
                            $("#descripcion_destino_vyp_rutas").val(),
                            $("#km_vyp_rutas").val(),
                            $("#id_departamento_vyp_rutas").val(),
                            $("#id_municipio").val(),
                            $("#latitud_destino_vyp_rutas").val(),
                            $("#longitud_destino_vyp_rutas").val(),
                            $("#nombre_empresa_vyp_rutas").val(),
                            $("#direccion_empresa_vyp_rutas").val()
                        );
                    }
                }else{
                    swal({ title: "¡Ups!", text: "Verifique los campos vacios", type: "error", showConfirmButton: true });
                        return;
                }
            break;
            case 'edit':
                if($('input[id="destino_oficina"]').is(':checked')){
                    if($("#id_oficina_origen_vyp_rutas").val()=="" || $("#id_oficina_destino_vyp_rutas").val()=="" || $("#descripcion_destino_vyp_rutas").val()=="" || $("#km_vyp_rutas").val()==""){
                        swal({ title: "¡Ups!", text: "Verifique los campos vacios", type: "error", showConfirmButton: true });
                        return;
                    }else{
                      manttorutas($("#id_vyp_rutas").val(),
                            $("#band").val(),
                            $("#destino_oficina").val(),
                            $("#id_oficina_origen_vyp_rutas").val(),
                            $("#id_oficina_destino_vyp_rutas").val(),
                            $("#descripcion_destino_vyp_rutas").val(),
                            $("#km_vyp_rutas").val(),
                            "",
                            "",
                            "",
                            "",
                            "",
                            ""
                        );
                  }
                }else if($('input[id="destino_municipio"]').is(':checked')){
                    if($("#id_oficina_origen_vyp_rutas").val()=="" || $("#id_municipio").val()==""  || $("#id_departamento_vyp_rutas").val()=="" || $("#descripcion_destino_vyp_rutas").val()=="" || $("#km_vyp_rutas").val()==""){
                        swal({ title: "¡Ups!", text: "Verifique los campos vacios", type: "error", showConfirmButton: true });
                        return;
                    }else{
                        manttorutas($("#id_vyp_rutas").val(),
                            $("#band").val(),
                            $("#destino_municipio").val(),
                            $("#id_oficina_origen_vyp_rutas").val(),
                            "",
                            $("#descripcion_destino_vyp_rutas").val(),
                            $("#km_vyp_rutas").val(),
                            $("#id_departamento_vyp_rutas").val(),
                            $("#id_municipio").val(),
                            "",
                            "",
                            "",
                            ""
                        );
                    }
                }else if($('input[id="destino_mapa"]').is(':checked')){
                    if($("#id_oficina_origen_vyp_rutas").val()=="" || $("#id_municipio").val()==""  || $("#id_departamento_vyp_rutas").val()=="" || $("#descripcion_destino_vyp_rutas").val()=="" || $("#km_vyp_rutas").val()==""   || $("#latitud_destino_vyp_rutas").val()=="" || $("#longitud_destino_vyp_rutas").val()==""){
                        swal({ title: "¡Ups!", text: "Verifique los campos vacios", type: "error", showConfirmButton: true });
                        return;
                    }else{
                        manttorutas($("#id_vyp_rutas").val(),
                            $("#band").val(),
                            $("#destino_mapa").val(),
                            $("#id_oficina_origen_vyp_rutas").val(),
                            "",
                            $("#descripcion_destino_vyp_rutas").val(),
                            $("#km_vyp_rutas").val(),
                            $("#id_departamento_vyp_rutas").val(),
                            $("#id_municipio").val(),
                            $("#latitud_destino_vyp_rutas").val(),
                            $("#longitud_destino_vyp_rutas").val(),
                            $("#nombre_empresa_vyp_rutas").val(),
                            $("#direccion_empresa_vyp_rutas").val()
                        );
                    }
                }else{
                    swal({ title: "¡Ups!", text: "Verifique los campos vacios", type: "error", showConfirmButton: true });
                        return;
                }
            break;
            case 'delete':
                manttorutas($("#id_vyp_rutas").val(),$("#band").val());
            break;
        }

    }

    function obtenerOrigen(id,opcionCargarMapa,latitud_destino_vyp_rutas,longitud_destino_vyp_rutas){
      //  if($('input[id="destino_mapa"]').is(':checked') || $('input[id="destino_oficina"]').is(':checked')){
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

                    initMap(algo[0],algo[1],latitud_destino_vyp_rutas,longitud_destino_vyp_rutas,'0');
                 }
            });
        //}
    }
    function obtenerDestino(id,opcionCargarMapa,latitud_destino_vyp_rutas,longitud_destino_vyp_rutas){
        if( $('input[id="destino_oficina"]').is(':checked')){
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

                $("#latitud_destino_vyp_rutas").val(algo[0]);
                $("#longitud_destino_vyp_rutas").val(algo[1]);
                 if(opcionCargarMapa==1){

                    initMap($("#direccion_origen1").val(),$("#direccion_origen2").val(),algo[0],algo[1],'1');
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
</script>

<!-- ============================================================== -->
<!-- Inicio de DIV de inicio (ENVOLTURA) -->
<!-- ============================================================== -->
<div class="page-wrapper">
    <div class="container-fluid">
        <button id="notificacion" style="display: none;" class="tst1 btn btn-success2">Info Message</button>
        <!-- ============================================================== -->
        <!-- TITULO de la página de sección -->
        <!-- ============================================================== -->
        <div class="row page-titles">
            <div class="align-self-center" align="center">
                <h3 class="text-themecolor m-b-0 m-t-0">Gestión de Rutas</h3>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Fin TITULO de la página de sección -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Inicio del CUERPO DE LA SECCIÓN -->
        <!-- ============================================================== -->
        <div class="row justify-content-center">

            <div class="col-lg-10 " id="cnt_form" style="display: none;">
                <div class="card">
                    <div class="card-header bg-success2" id="ttl_form">
                        <div class="card-actions text-white">
                            <a style="font-size: 16px;" onclick="cerrar_mantenimiento();"><i class="mdi mdi-window-close"></i></a>
                        </div>
                        <h4 class="card-title m-b-0 text-white">Listado de Rutas</h4>
                    </div>
                    <div class="card-body b-t">

                        <?php echo form_open('', array('id' => 'formajax', 'style' => 'margin-top: 0px;', 'class' => 'm-t-40', 'novalidate' => '')); ?>
                            <input type="hidden" id="band" name="band" value="save">
                            <input type="hidden" placeholder="id#" id="id_vyp_rutas" name="id_vyp_rutas">


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="id_oficina_origen_vyp_rutas" class="font-weight-bold">Origen de la Ruta: <span class="text-danger">*</span></label>
                                        <select id="id_oficina_origen_vyp_rutas" name="id_oficina_origen_vyp_rutas" class="form-control" onchange="obtenerOrigen(this.value,'2');">
                                            <option value="">[Seleccione]</option>
                                            <?php
                                                $seccion = $this->db->get("vyp_oficinas");

                                                if(!empty($seccion)){
                                                    foreach ($seccion->result() as $fila) {
                                            ?>
                                                <option  value="<?php echo $fila->id_oficina ?>"  >
                                                    <?php echo $fila->nombre_oficina ?>
                                                </option>;
                                            <?php
                                                    }
                                                }
                                            ?>
                                        </select>
                                       <div class="help-block"></div>
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="" class="font-weight-bold">Opcion de destino: <span class="text-danger">*</span></label><br>
                                    <input type="radio" id="destino_oficina"   name="t_destinos" value="destino_oficina" onclick="mostrarpanel_oficina()">
                                         <label for="destino_oficina">Oficina</label>
                                    <input type="radio" id="destino_municipio"  name="t_destinos" value="destino_municipio" onclick="mostrarpanel_municipio()">
                                          <label for="destino_municipio">Municipio</label>
                                    <input type="radio" id="destino_mapa"   name="t_destinos" value="destino_mapa" onclick="mostrarpanel_mapa();">
                                          <label for="destino_mapa">Buscar en Mapa</label>
                                    </div>
                                </div>
                            </div>
                             <div class="row" id="panel_municipio" style="display: none">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="" class="font-weight-bold">Departamento destino: <span class="text-danger">*</span></label><br>
                                        <select class="form-control" id="id_departamento_vyp_rutas" onchange="buscarMunicipio(this.value,'null','')">
                                            <option value="">[Seleccione]</option>
                                            <?php
                                                $this->db->where("id_departamento <","15");
                                                $seccion = $this->db->get("org_departamento");

                                                if(!empty($seccion)){
                                                    foreach ($seccion->result() as $fila) {
                                            ?>
                                                <option  value="<?php echo $fila->id_departamento; ?>" onclick="buscarMunicipio('<?php echo $fila->id_departamento;?>','null','')" >
                                                    <?php echo $fila->departamento ?>
                                                </option>;
                                            <?php
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="" class="font-weight-bold">Municipio destino: <span class="text-danger">*</span></label><br>
                                        <div id="municipios">
                                            <select class="form-control" id="id_municipio">
                                                <option>[Seleccione]</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="panel_mapa" style="display:none">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="" class="font-weight-bold">Nombre Empresa: <span class="text-danger">*</span></label><br>
                                        <input type="text" id="nombre_empresa_vyp_rutas" name="nombre_empresa_vyp_rutas" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="" class="font-weight-bold">Dirección Empresa: <span class="text-danger">*</span></label><br>
                                        <input type="text" id="direccion_empresa_vyp_rutas" name="direccion_empresa_vyp_rutas" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="" class="font-weight-bold">Descripción de destino: <span class="text-danger">*</span></label><br>
                                        <input type="text" id="descripcion_destino_vyp_rutas" name="descripcion_destino_vyp_rutas" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="" class="font-weight-bold">Kilometros: <span class="text-danger">*</span></label><br>
                                        <input type="text" id="km_vyp_rutas" name="km_vyp_rutas" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="row" id="panel_oficina" style="display: none">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="" class="font-weight-bold">Oficina de destino: <span class="text-danger">*</span></label><br>
                                        <select id="id_oficina_destino_vyp_rutas" name="id_oficina_destino_vyp_rutas" class="form-control" onchange="obtenerDestino(this.value,'1')">
                                            <option value="">[Seleccione]</option>
                                            <?php
                                                $seccion = $this->db->get("vyp_oficinas");

                                                if(!empty($seccion)){
                                                    foreach ($seccion->result() as $fila) {
                                            ?>
                                                <option  value="<?php echo $fila->id_oficina ?>" onclick="" >
                                                    <?php echo $fila->nombre_oficina ?>
                                                </option>;
                                            <?php
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>



                            <button id="submit" type="submit" style="display: none;"></button>
                            <div align="right" id="btnadd">
                                <button type="reset" class="btn waves-effect waves-light btn-success"><i class="mdi mdi-recycle"></i> Limpiar</button>
                                <button type="button" onclick="preparar_ruta($('#band').val());" class="btn waves-effect waves-light btn-success2"><i class="mdi mdi-plus"></i> Guardar</button>

                            </div>
                            <div align="right" id="btnedit" style="display: none;">

                                <button type="button" onclick="preparar_ruta($('#band').val());" class="btn waves-effect waves-light btn-info"><i class="mdi mdi-pencil"></i> Editar</button>
                            </div>

                        <?php echo form_close(); ?>
                    </div>

                </div>
            </div>
             <div class="col-lg-6" style="display: none;" id="form_mapa">
                 <div class="card">
                     <div class="card-body b-t">
                     <div  class="row" id="divider">

                                <div class="col-lg-4 col-md-5" >
                                    <div class="form-group">
                                        <label>Buscar ubicación</label>
                                        <input id="address" class="form-control form-control-line" type="text" placeholder="municipio, departamento, pais">
                                    </div>
                                    <div align="right">
                                        <button id="submit_ubi" class="btn waves-effect waves-light btn-success" type="button"><i class="mdi mdi-magnify"></i> Buscar</button>
                                    </div>
                                    <br><br>
                                    <input class="form-control" type="text" id="latitud_destino_vyp_rutas" name="latitud_destino_vyp_rutas">
                                    <input class="form-control" type="text" id="longitud_destino_vyp_rutas" name="longitud_destino_vyp_rutas">
                                    <input type="text" class="form-control" id="direccion_origen1" name="">
                                    <input type="text" class="form-control" id="direccion_origen2" name="">
                                    <div>
                                        <strong>Resultados</strong>
                                    </div>
                                   <div id="output">Los resultados aparecerán aquí</div>


                                    <br><br><br><br><br><br><br><br>
                                </div>
                                <div class="col-lg-8 col-md-7 otro" >
                                        <div id="map" ></div>
                                </div>
                            </div>
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
            }else if(res == "fracaso"){
                swal({ title: "¡Ups! Error", text: "Intentalo nuevamente.!", type: "error", showConfirmButton: true });
            }else if (res=="duplicado"){
                swal({ title: "¡Ups! Error", text: "Ruta duplicada.", type: "error", showConfirmButton: true });
            }
        });

    });


});

</script>
<script>
      var markersO = [];
      var markersD = [];

      var distancia = "";
      var origen;
      function initMap(latOrigen,lngOrigen,latDestino,lngDestino,bandOffice) {
        var bounds = new google.maps.LatLngBounds;
        var markersArray = [];

        var origin1 = "";
        var destinationA = "";

        var flightPath = ""; //Agregado para dibujar linea recta (Para mostrar distancia lineal)

        var geocoder = new google.maps.Geocoder;

        var service = new google.maps.DistanceMatrixService;

        var directionsService = new google.maps.DirectionsService();

        if(latOrigen){
            var map = new google.maps.Map(document.getElementById('map'), {
                center:  new google.maps.LatLng(latOrigen, lngDestino),
                zoom: 12
            });
            origin1 = new google.maps.LatLng(latOrigen, lngOrigen);
            destinationA = new google.maps.LatLng(latDestino, lngDestino);

            deleteMarkers_D();
            if(bandOffice=="1"){
              addMarker_destino(origin1, map);
              addMarker_destino(destinationA, map);
             calcula_distancia();pinta_recorrido();
            }else{
             addMarker_destino(destinationA, map);
            calcula_distancia();pinta_recorrido();
            }
        }else{
            var map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: 13.705542923582362, lng: -89.20029401779175},
                zoom: 12
            });
        }
        var directionsDisplay = new google.maps.DirectionsRenderer({
          map: map
        });
        /*map.addListener('click', function(e) {
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
        });*/
        map.addListener('click', function(e) {

             if($("#id_oficina_origen_vyp_rutas").val()!=""){
                origin1 = new google.maps.LatLng($("#direccion_origen1").val(),$("#direccion_origen2").val());
             }else{
                swal({ title: "¡Ups!", text: "Debe seleccionar un Origen.", type: "error", showConfirmButton: true });
             }
             destinationA=e.latLng;

            var cadenaOrigen = String(destinationA);

            var separadorD= ",";
            arregloDeSubCadenasDestino = cadenaOrigen.split(separadorD);
            arregloDestino1 = arregloDeSubCadenasDestino[0].substring(1);

            pos_destino=arregloDeSubCadenasDestino[1].indexOf(')');
            arregloDestino2 = arregloDeSubCadenasDestino[1].substring(0,pos_destino);

            document.getElementById('latitud_destino_vyp_rutas').value=arregloDestino1;
            document.getElementById('longitud_destino_vyp_rutas').value=arregloDestino2;
           //alert(origin1)
            if(origin1!="(0, 0)" || !origin1){
                deleteMarkers_D();
             addMarker_destino(e.latLng, map);
              calcula_distancia();
            }else{

                swal({ title: "¡Ups!", text: "Debe seleccionar un Origen.", type: "error", showConfirmButton: true });
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

            /**************************************************************************************/
            /***************** Inicio para dibujar y calcular distancia lineal ********************/
            if(flightPath != ""){
                flightPath.setMap(null);
            }

            flightPath = new google.maps.Polyline({
              path: [origin1, destinationA],
              strokeColor: '#FF0000',
              strokeOpacity: 1.0,
              strokeWeight: 2
            });

            var distancia = google.maps.geometry.spherical.computeDistanceBetween(origin1, destinationA);
            if(distancia != 0){
                distancia = (distancia/1000).toFixed(2);
            }

            pinta_recorrido();



            /***************** Fin de dibujo y cálculo de distancia lineal ********************/
            /**********************************************************************************/

             var outputDiv = document.getElementById('output');
            outputDiv.innerHTML = '';
            var showGeocodedAddressOnMap = function(asDestination) {
              return function(results, status) {
                if (status === 'OK') {
                  map.fitBounds(bounds.extend(results[0].geometry.location));
                  //alert(results[0].geometry.location)
                } else {
                  //alert('Geocode no tuvo éxito debido a: ' + status);
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

                outputDiv.innerHTML += "<b>Origen:</b> "+originList[i] +
                    '<br><b>Destino:</b> ' + destinationList[j] +
                    '<br><b>Distancia:</b> ' + results[j].distance.text+    //Distancia carretera
                    '<br><b>Distancia Lineal:</b> ' + distancia +" Km"+     //Distancia lineal
                    '<br><b>Tiempo:</b> ' + results[j].duration.text + '<br>';
                    var km = results[j].distance.text;
                    var km_nuevo = km.substr(0,km.length-3);
                    $("#km_vyp_rutas").val(km_nuevo.replace(',','.'));

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
        //   flightPath.setMap(map);

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


        document.getElementById('submit_ubi').addEventListener('click', function() {
            origen = new google.maps.LatLng($("#direccion_origen1").val(),$("#direccion_origen2").val());
          geocodeAddress(geocoder, map);
        });
        function geocodeAddress(geocoder, resultsMap) {

          var address = document.getElementById('address').value;
          geocoder.geocode({'address': address}, function(results, status) {
            if (status === google.maps.GeocoderStatus.OK) {
              resultsMap.setCenter(results[0].geometry.location);

              if( $('input[id="destino_municipio"]').is(':checked')){
                deleteMarkers_D();
                deleteMarkers_O();
                addMarker_destino(origen, map);
                addMarker_origen(results[0].geometry.location, resultsMap);
                origin1 = origen;
                destinationA = results[0].geometry.location;
                //addMarker_destino(destinationA, map);
               calcula_distancia();pinta_recorrido();
              }
            } else {
              alert('Geocode no tuvo éxito por la siguiente razón: ' + status);

            }
          });
        }
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


    </script>
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA4M5mZA-qqtRgioLuZ4Kyg6ojl71EJ3ek&callback=initMap">
</script>
