<?php
    
    header("Cache-Control: no-store, no-cache, must-revalidate");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
    header("Expires: Sat, 1 Jul 2000 05:00:00 GMT"); // Fecha en el pasado
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
    
    $cuenta_banco = $this->db->query("SELECT * FROM vyp_pasajes WHERE nr = '".$nr_usuario."' AND estado = 1");
?>



<script type="text/javascript">

   function ver_pasajes(id,nombre,fecha_solicitud, fecha_observacion,estado1,bandera){
     var nr = $("#nr").val();   
     var fechas = $("#fecha2").val();
     var fechita = $("#fecha").val();
      var nr1 = $("#nr1").val();
       var bandera="edit";
        var id1 = $("#id").val();
        var estado=$("#estado1").val();
       // alert(estado1);
        //alert(bandera);
        //alert(id);
    // alert(nr);

        if(window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttpB=new XMLHttpRequest();
        }else{// code for IE6, IE5
            xmlhttpB=new ActiveXObject("Microsoft.XMLHTTPB");
        }
        xmlhttpB.onreadystatechange=function(){
            if (xmlhttpB.readyState==4 && xmlhttpB.status==200){
                document.getElementById("cnt_pasaje").innerHTML=xmlhttpB.responseText;

                 $('[data-toggle="tooltip"]').tooltip();
                 
                $('#fecha').datepicker({
                    format: 'dd-mm-yyyy',
                    autoclose: true,
                    todayHighlight: true
                });
            }
        }
        
       // xmlhttp.open("GET","getuser.php?q=" + q + "&r=" + r, true);
       location.href = "<?php echo site_url(); ?>/pasajes/pasaje?nr="+nr + "&fecha2="+fechas+ "&nr1="+nr1+ "&fecha="+fechita+ "&bandera="+"edit" + "&id="+id + "&estado="+estado1+ "&fecha_observacion="+fecha_observacion;
        //xmlhttpB.open("GET","<?php //echo site_url(); ?>/pasajes/lista_pasaje/tabla_pasaje_lista?nr="+nr + "&fecha2="+fechas, true);
         
        xmlhttpB.send();  
       
   
    }


function info_pasajes()
{ //para la validacion
        var nr = $("#nr1").val();
        var fechap = $("#fecha").val();
        if(window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp_A=new XMLHttpRequest();
        }else{// code for IE6, IE5
            xmlhttp_A=new ActiveXObject("Microsoft.XMLHTTPB");
        }
        xmlhttp_A.onreadystatechange=function(){
            if (xmlhttp_A.readyState==4 && xmlhttp_A.status==200){
                  document.getElementById("cnt_info_pasajes").innerHTML=xmlhttp_A.responseText;

            }
        }
       var date = new Date();
       

// Display the month, day, and year. getMonth() returns a 0-based number.
var month1 = date.getMonth()+1;
var day1 = date.getDate();
var year1 = date.getFullYear();
var hoy=month1+" "+day1+" "+year1;
 // date.setHours(0,0,0,0);

var ultimoDia = new Date(date.getFullYear(), date.getMonth() + 1, 0);
       // alert(ultimoDia);
    var dias=5;

    tiempo=ultimoDia.getTime();
    milisegundos=parseInt(dias*24*60*60*1000);
    total=ultimoDia.setTime(tiempo+milisegundos);
    day=ultimoDia.getDate();
    month=ultimoDia.getMonth()+1;
    year=ultimoDia.getFullYear();
var mes1;
mes1=month-1;
//alert(date);
var fecha_nueva=mes1+" "+day+" "+year;
//alert(hoy);
//alert(fecha_nueva);
   //alert("Fecha modificada: "+day+"/"+mes1+"/"+year);

        xmlhttp_A.open("GET","<?php echo site_url(); ?>/pasajes/pasaje/info_pasajes?nr="+nr+"&fecha="+fechap,true);
        xmlhttp_A.send();
}


    function iniciar(){
      
     
        tabla_pasaje_lista();
        form_folleto_viaticos();
        $('html,body').animate({
            scrollTop: $("body").offset().top
        }, 500);
    
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
    function tabla_pasaje_lista(){ 
        var nr = $("#nr").val();   
        var fechas = $("#fecha2").val();
        if(window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttpB=new XMLHttpRequest();
        }else{// code for IE6, IE5
            xmlhttpB=new ActiveXObject("Microsoft.XMLHTTPB");
        }
        xmlhttpB.onreadystatechange=function(){
            if (xmlhttpB.readyState==4 && xmlhttpB.status==200){
                document.getElementById("cnt_pasaje").innerHTML=xmlhttpB.responseText;
                 $('[data-toggle="tooltip"]').tooltip();
                 
                $('#fecha').datepicker({
                    format: 'dd-mm-yyyy',
                    autoclose: true,
                    todayHighlight: true
                });
            }
        }
       // xmlhttp.open("GET","getuser.php?q=" + q + "&r=" + r, true);
        xmlhttpB.open("GET","<?php echo site_url(); ?>/pasajes/lista_pasaje/tabla_pasaje_lista?nr="+nr + "&fecha2="+fechas, true);
         
        xmlhttpB.send(); 
    }
 function imprimir_solicitud(nr, fecha_de_pasaje, id){
   // alert(id);
        window.open("<?php echo site_url(); ?>/pasajes/Lista_pasaje/imprimir_solicitud?nr="+nr + "&fecha2="+fecha_de_pasaje + "&id="+id, '_blank');
    }

function cambiar_nuevo(){
        $("#idb2").val("");
       
        $("#fecha").datepicker("");
        $("#expediente").val("");
        $("#empresa").val("");
        $("#direccion").val("");
        $("#nr1").val("").trigger('change.select2');
        $("#id_departamento").val("").trigger("change.select2");
         $("#id_municipio").val("").trigger("change.select2");
           $("#id_actividad").val("").trigger('change.select2');
        $("#pasaje").val("");
        $("#band2").val("save");

       /* $("#idb").val("");
        $("#nombre").val("");
        $("#caracteristicas").val("");
        $("#band").val("save");*/
        $("#ttl_form").addClass("bg-success");
        $("#ttl_form").removeClass("bg-info");

        $("#btnadd").show(0);
        $("#btnedit").hide(0);

       $("#cnt-tabla").hide(0);
        $("#cnt_form1").hide(0);
        $("#cnt_form").show(0);


        $("#ttl_form").children("h4").html("<span class='mdi mdi-plus'></span> Nuevo Pasaje");
    }
function cerrar_mantenimiento(){
       $("#cnt-tabla").show(0);
       $("#cnt_form").hide(0);
       $("#cnt_form1").show(0);
    }
   
    function tablapasajes(){ 
              
       $("#cnt_form").hide(0);
       ver_pasajes();
       //$("#cnt_form1").show(0);
         
 }

function combo_oficina_departamento(tipo){
        var nr = $("#nr").val();
        var newName = 'Otro nombre',
        xhr = new XMLHttpRequest();

        xhr.open('GET', "<?php echo site_url(); ?>/pasajes/Lista_pasaje/combo_oficinas_departamentos?tipo="+tipo+"&nr="+nr);
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
        xhr.open('GET', "<?php echo site_url(); ?>/pasajes/Lista_pasaje/combo_municipios?id_departamento="+id_departamento+"&tipo="+tipo);
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
                       
                        $("#municipio").parent().hide(0);
                        
                    }
                   // input_distancia(tipo);
                }else if(tipo == "departamento"){
                  
                    $("#municipio").parent().show(0);
                   // input_distancia(tipo);
                }
            }
            else if (xhr.status !== 200) {
                swal({ title: "Ups! ocurrió un Error", text: "Al parecer no todos los objetos se cargaron correctamente por favor recarga la página e intentalo nuevamente", type: "error", showConfirmButton: true });
            }
        };
        xhr.send(encodeURI('name=' + newName));
    }

    


function obtener_id_municipio(municipio){
        var formData = new FormData();
        formData.append("id_municipio", municipio);

        $.ajax({
            url: "<?php echo site_url(); ?>/pasajes/Lista_pasaje/obtener_id_municipio",
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
            url: "<?php echo site_url(); ?>/pasajes/Lista_pasaje/obtener_id_municipio",
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
               // input_distancia("mapa");
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
            url: "<?php echo site_url(); ?>/pasajes/Lista_pasaje/obtener_id_departamento",
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

function form_folleto_viaticos(){
      //  $("#bntadd").hide(0);
      
        combo_oficina_departamento("departamento");
  
        $("#municipio").parent().show(0);
      
    }

     function validar_monto_pasaje(obj, max){
        monto = parseFloat(obj.value);
        if(monto > max){
            obj.value = max;
        }
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
                <h3 class="text-themecolor m-b-0 m-t-0">Control de pasajes</h3>
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
            <div class="col-lg-12" id="cnt_form" style="display: none;" >
                <div class="card">
                    <div class="card-header bg-success2" id="ttl_form">
                        <div class="card-actions text-white">
                            <a style="font-size: 16px;" onclick="cerrar_mantenimiento();"><i class="mdi mdi-window-close"></i></a>
                        </div>
                        <h4 class="card-title m-b-0 text-white">Pasajes</h4>
                    </div>

                    <div class="card-body b-t">
                      <div id="cnt_observaciones"></div>

            <?php echo form_open('', array('id' => 'formajax', 'style' => 'margin-top: 0px;', 'class' => 'm-t-40', 'novalidate' => '')); ?>
                            <input type="hidden" id="band2" name="band2" value="save">
                            <input type="hidden" id="idb2" name="idb2" value="">
                            <div class="row">
              <div class="col-lg-12" id="cnt_info_pasajes">
                
              </div>
      </div>
                            <div class="row">
                              <div class="form-group col-lg-6"> 
                            <h5>Empleado: <span class="text-danger">*</span></h5>                           
                            <select id="nr1" name="nr1" class="select2"  required="" style="width: 100%;" >
                                <option value="">[Elija el empleado a editar sus datos]</option>
                                <?php 
                                    $otro_empleado = $this->db->query("SELECT e.id_empleado, e.nr, UPPER(CONCAT_WS(' ', e.primer_nombre, e.segundo_nombre, e.tercer_nombre, e.primer_apellido, e.segundo_apellido, e.apellido_casada)) AS nombre_completo FROM sir_empleado AS e WHERE e.id_estado = '00001' ORDER BY e.primer_nombre, e.segundo_nombre, e.tercer_nombre, e.primer_apellido, e.segundo_apellido, e.apellido_casada");
                                    if($otro_empleado->num_rows() > 0){
                                        foreach ($otro_empleado->result() as $fila) {  
                                        $nombre=$fila->nombre_completo;          
                                           echo '<option class="m-l-50" value="'.$fila->nr.'">'.$fila->nombre_completo.' - '.$fila->nr.'</option>';
                                        }
                                    }
                                ?>
                            </select>
                            <div class="help-block"></div>
                        </div>
                                <div class="form-group col-lg-5">
                                    <h5>Fecha: <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" pattern="\d{1,2}-\d{1,2}-\d{4}" required=""  class="form-control" id="fecha" name="fecha" placeholder="dd/mm/yyyy" onchange ="info_pasajes();">
                                        <div class="help-block" style="width: 100%;"></div>
                                    </div>
                                </div>

                             
                            </div>
                    <div class="row">
                    <div class="form-group col-lg-6" id="combo_departamento">
                                </div>
                                <div class="form-group col-lg-6" id="combo_municipio">
                                </div>

                    </div>                           
                         <div class="row">
                                <div class="form-group col-lg-6">
                                    <h5>Empresa Visitada: <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                         <input type="text" id="empresa" name="empresa" class="form-control" required="" placeholder="Escriba la dirección" minlength="3" data-validation-required-message="Este campo es requerido" style="width: 100%;"> 
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            <div class="form-group col-lg-6">
                                    <h5>Dirección empresa:<span class="text-danger">*</span> </h5>
                                    <div class="controls">
                                    <input type="text"  id="direccion" name="direccion" class="form-control" required="" placeholder="Escriba la dirección" minlength="3" data-validation-required-message="Este campo es requerido" style="width: 100%;">
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                                 
                                </div>
                                <div class="row">

                                 <div class="form-group col-lg-6">
                                    <h5>Expediente N°: <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                    <input type="text" id="expediente" name="expediente" class="form-control" style="width: 100%;" required="" placeholder="Escriba el expediente">
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                                <?php
            $generalidades = $this->db->query("SELECT * FROM vyp_generalidades");

            $id_generalidad = ""; $pasaje = "0.00"; $alojamiento = "0.00";
            if($generalidades->num_rows() > 0){
                foreach ($generalidades->result() as $filag) {
                   
                    $pasaje = $filag->pasaje;
                   
                }
            }
        ?>

         <div class="form-group col-lg-6"> 
                                    <h5>Actividad realizada: <span class="text-danger">*</span></h5>
                                    <div class="input-group">
                                        <select id="id_actividad" name="id_actividad" class="select2" style="width: 100%" required=''>
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
            <div class="form-group col-lg-3 validate">
            <h5>Pasaje: <span class="text-danger">*</span></h5>
             <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-dollar"></i></div>
                <input type="number" id="monto" name="monto" onkeyup="validar_monto_pasaje(this, '<?php echo number_format($pasaje,2); ?>');" class="form-control" required="" placeholder="0.00" step="0.01" value="0.00" >
            </div>
             <div class="help-block"></div>
            </div>
                                 </div>
                            
                        <button id="submit" type="submit" style="display: none;"></button>
                            <div align="right" id="btnadd">
                                <button type="reset" class="btn waves-effect waves-light btn-success"><i class="mdi mdi-recycle"></i> Limpiar</button>
                                <button type="submit" class="btn waves-effect waves-light btn-success2"><i class="mdi mdi-plus"></i> Guardar</button>
                            </div>
                            
           
                           
                             <div class="col-lg-12" id="cnt-tabla">
                 
            </div>
            </div>
             </div>
              </div>
              <div class="col-lg-1"></div>

            <div class="col-lg-12" id="cnt_form1">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title m-b-0">Pasajes</h4>
                    </div>
 <div class="card-body b-t">
                     <div class="pull-right">
                            <button type="button" onclick="cambiar_nuevo();" class="btn waves-effect waves-light btn-success2" data-toggle="tooltip" title="Clic para agregar un nuevo registro"><span class="mdi mdi-plus"></span> Nuevo registro</button>
                        </div>

                          
                    <?php echo form_open('', array('id' => 'formcuentas2', 'style' => 'margin-top: 0px;', 'class' => 'm-t-40')); ?>
                        <input type="hidden" id="band" name="band" value="save">
                           
                            <input type="hidden" id="idb" name="idb" value="">
                           <div class="row">                        
                        <div class="form-group col-lg-6"> 
                            <h5>Empleado a modificar: <span class="text-danger">*</span></h5>                           
                            <select id="nr" name="nr" class="select2" style="width: 100%" required="" onchange="tabla_pasaje_lista();">
                                <option value="">[Elija el empleado a editar sus datos]</option>
                                <?php 
                                    $otro_empleado = $this->db->query("SELECT e.id_empleado, e.nr, UPPER(CONCAT_WS(' ', e.primer_nombre, e.segundo_nombre, e.tercer_nombre, e.primer_apellido, e.segundo_apellido, e.apellido_casada)) AS nombre_completo FROM sir_empleado AS e WHERE e.id_estado = '00001' ORDER BY e.primer_nombre, e.segundo_nombre, e.tercer_nombre, e.primer_apellido, e.segundo_apellido, e.apellido_casada");
                                    if($otro_empleado->num_rows() > 0){
                                        foreach ($otro_empleado->result() as $fila) {  
                                        $nombre=$fila->nombre_completo;          
                                           echo '<option class="m-l-50" value="'.$fila->nr.'">'.$fila->nombre_completo.' - '.$fila->nr.'</option>';
                                        }
                                    }
                                ?>
                            </select>
                            <div class="help-block"></div>
                        </div>

                <div class="form-group col-lg-6">  

                <h5>Fecha: <span class="text-danger">*</span></h5>
                <input type="month"  class="form-control" id="fecha2" name="fecha2"  onchange="tabla_pasaje_lista();">
                
                <div class="help-block"></div>

                </div>

                </div>

                    
                    <h5>Pasajes del empleado</h5>
                    <blockquote class="m-t-10">
                                               
                                <div id="cnt_pasaje"></div> <!--para imprimir la tabla -->
                                 
                        </blockquote>
                        <div class="row" align="right">
                        <div class="col-lg-12">
                            <button type="button" onclick="tablapasajes()" class="pull-right btn btn-info">
                           Ver registros individuales 
                            </button>
                        </div>
                        </div>
                          <?php echo form_close(); ?>
                    <?php echo form_close(); ?>
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
<script src="<?php echo base_url(); ?>assets/plugins/cropper/cropper-init.js"></script>
<script>
$(function(){
    $('#fecha').datepicker({
                    format: 'dd-mm-yyyy',
                    autoclose: true,
                    todayHighlight: true
                });
$("#formajax").on("submit", function(e){
   
        e.preventDefault();
        var f = $(this);
        var formData = new FormData(document.getElementById("formajax"));
/*        var nombre_empleado = $("#nr option:selected").text().split("-");

var fecha = $("#fecha").val().split("-");
        formData.append("dato", "valor");
       formData.append("nombre_emple", nombre_empleado[0].trim());
formData.append("mes", fecha[1].trim()); 
formData.append("anio", fecha[0].trim());*/
        
        $.ajax({
            url: "<?php echo site_url(); ?>/pasajes/Lista_pasaje/gestionar_pasaje2",
            type: "post",
            dataType: "html",
            data: formData,
            cache: false,
            contentType: false,
            processData: false
        })
        .done(function(res){
            //alert(res)
            if(res == "exito"){
                if($("#band2").val() == "save"){
                    swal({ title: "¡Registro exitoso!", type: "success", showConfirmButton: true });

                }else if($("#band2").val() == "edit"){
                    swal({ title: "¡Modificación exitosa!", type: "success", showConfirmButton: true });
                }else{
                    swal({ title: "¡Borrado exitoso!", type: "success", showConfirmButton: true });
                }
                $("#band2").val('save');
               tablapasajes();
                          }
               else{
                swal({ title: "¡Ups! Error", text: "Intentalo nuevamente.", type: "error", showConfirmButton: true });
            }
        });
           });    
    });
 
  

</script>  



 <script>
    $(document).ready(function(){         
        
        $('#dirigir').click(function(){ //Id del elemento cliqueable
            $('html, body').animate({scrollTop:0}, 1000);
            return false;
        });
    });
    
</script>