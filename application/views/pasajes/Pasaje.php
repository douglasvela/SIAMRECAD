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

$pasajitos = $this->db->query("SELECT * FROM vyp_mision_pasajes");

         
            if($pasajitos->num_rows() > 0){

                foreach ($pasajitos->result() as $filap) {
                   
                    $mestabla = $filap->mes_pasaje;
                    $aniotabla = $filap->anio_pasaje;
                    $nreste= $filap->nr;                   
                   $id_este= $filap->id_mision_pasajes;  
                }
            } else {

                $mestabla=NULL;
                $aniotabla=NULL;
                $nreste=NULL;
                $id_este=NULL;
            }
?>



<script type="text/javascript">
var nr_empleado = "<?php echo $_GET["nr"]; ?>"
var fecha_p = "<?php echo $_GET["fecha2"]; ?>"


    function cambiar_editar(id,fecha,expediente,empresa,direccion,nr_usuario, monto,departamento, municipio,bandera){
         tabla_pasaje_unidad();
    //form_folleto_viaticos1();

        $("#id_pasaje").val(id);
        $("#fecha2").datepicker("setDate", fecha );

        $("#expediente2").val(expediente);

         $('#id_departamento').val(departamento).trigger('change.select2');

        $('#id_municipio').val(municipio).trigger('change.select2');
//alert(departamento);
//alert(municipio);
        $("#empresa2").val(empresa);
        $("#direccion2").val(direccion);
        $("#monto2").val(monto);

       $("#modal_pasaje").modal("show");
      form_folleto_viaticos_otro();
       // form_folleto_viaticos();
        
//editar_pasaje(departamento, municipio);


    }
 function cerrar_mantenimiento(){
        $("#cnt-tabla").show(0);
        $("#cnt_form").hide(0);
    }
    function eliminar_pasaje(id_pasaje)
    {
        swal({   
            title: "¿Está seguro?",   
            text: "¡Desea eliminar el registro!",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#fc4b6c",   
            confirmButtonText: "Sí, deseo eliminar!",   
            closeOnConfirm: true 
        }, function(){   
            eliminar(id_pasaje); 
        });        
    }
    function eliminar(id_pasaje){
        var formData = new FormData();
        formData.append("id_pasaje", id_pasaje);
        formData.append("band", "delete");
        $.ajax({
            url: "<?php echo site_url(); ?>/pasajes/pasaje/gestionar_pasaje",
            type: "post",
            dataType: "html",
            data: formData,
            cache: false,
            contentType: false,
            processData: false
        })
        .done(function(res){
            if(res == "exito"){
                tabla_pasaje_unidad();
                 swal({ title: "¡Registro eliminado!", type: "success", showConfirmButton: true });
            }else{
               swal({ title: "¡Error!", type: "success", showConfirmButton: true });
            }
             
        });
    }
    function editar_pasaje(){
        tabla_pasaje_unidad();
          //form_folleto_viaticos_otro();
          var id_municipio= $("#municipio1").val();



        var formData = new FormData();
       // var depto = $("#departamento option:selected").text();
        formData.append("id_pasaje", $("#id_pasaje").val());
        
        formData.append("fecha", $("#fecha2").val());
        formData.append("departamento", $("#departamento1").val());
        formData.append("municipio", $("#municipio1").val());
        formData.append("expediente", $("#expediente2").val());
        //formData.append ($("#departamento").val("#id_departamento").trigger("change.select2"));
//formData.append($("#departamento").val("#departamento1").trigger("change.select2"));
        //formData.append("departamento", $("#id_departamento").trigger("change.select2").val());

       // formData.append("municipio", $("#id_municipio").trigger("change.select2").val());
        formData.append("empresa", $("#empresa2").val());
        formData.append("direccion", $("#direccion2").val());
        formData.append("monto", $("#monto2").val());
        formData.append("band", "edit");

        $.ajax({
            url: "<?php echo site_url(); ?>/pasajes/Lista_pasaje/gestionar_pasaje3",
            type: "post",
            dataType: "html",
            data: formData,
            cache: false,
            contentType: false,
            processData: false
        })
        .done(function(res){
            alert(res)
            if(res == "exito"){
                tabla_pasaje_unidad();
                swal({ title: "¡Modificación exitosa!", type: "success", showConfirmButton: true });
            }else{
                swal({ title: "¡Ups! Error", text: "Intentalo nuevamente.", type: "error", showConfirmButton: true });
            }
             
        });
    }
function recorre_tabla(viaticos_visibles){
       // var fecha = $("#fecha_mision option:selected").text();
        var celdas;
        var filas = $("#cnt_pasaje").find("tbody").find("tr");
//        var horarios = $("#horarios").val();
        //var id_horarios;
        var band_visible = false;

        for(l=0; l< (filas.length-1); l++){
            celdas = $(filas[l]).children("td");
           // horarios2 = $($(celdas[4]).children("input")[0]).val();
            //fecha2 = $(celdas[0]).text();
          
        }

    

        return band_visible;
    }
    function iniciar(){

        tabla_pasaje_unidad();

      // cambiar_nuevo();
      $("#nr").val(nr_empleado).trigger('change.select2');
     $("#fecha1").val(fecha_p).trigger('change.select2');
      form_folleto_viaticos();
     // form_folleto_viaticos_otro();

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
    function tabla_pasaje_unidad(){ 



        var nr = $("#nr").val();   
        var fechas = $("#fecha1").val();

        if(window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttpB=new XMLHttpRequest();
        }else{// code for IE6, IE5
            xmlhttpB=new ActiveXObject("Microsoft.XMLHTTPB");
        }
        xmlhttpB.onreadystatechange=function(){
            if (xmlhttpB.readyState==4 && xmlhttpB.status==200){
                document.getElementById("cnt_pasaje").innerHTML=xmlhttpB.responseText;
               form_folleto_viaticos();
 
 

                 $('[data-toggle="tooltip"]').tooltip();
                 
                $('#fecha').datepicker({
                    format: 'dd-mm-yyyy',
                    autoclose: true,
                    todayHighlight: true
                });
             
               
            }


        }
        
       // xmlhttp.open("GET","getuser.php?q=" + q + "&r=" + r, true);
        xmlhttpB.open("GET","<?php echo site_url(); ?>/pasajes/pasaje/tabla_pasaje_unidad?nr="+nr+"&fecha1="+fechas, true);
        xmlhttpB.send(); 
   
}
function info_pasajes(){ //para la validacion
        //var nr_usuario = $("#nr").val();
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
        xmlhttp_A.open("GET","<?php echo site_url(); ?>/pasajes/pasaje/info_pasajes?nr="+nr_empleado+"&fecha="+fechap,true);
        xmlhttp_A.send();
    }

function guardar_pasaje()//guarda en la tabla vyp_mision_pasajes
{

var fecha = $("#fecha1").val().split("-");
var mest = fecha[1].trim();
var aniot = fecha[0].trim();
var mesv = "<?php echo $mestabla ?>";
var aniov = "<?php echo $aniotabla ?>";
var otronr = "<?php echo $nreste ?>";
var id_este1= "<?php echo $id_este ?>"; 
/*alert(mesv);
alert(mest);
alert(aniov);*/

var nr = $("#nr").val();
if(mesv== mest && aniov == aniot && otronr == nr)
{


swal({ title: "¡Ups! Error", text: "Solicitud de mes ya enviada a revisión.", type: "error", showConfirmButton: true });

} else {

    guardar_pasaje1();
      
      }

}



function guardar_pasaje1()//guarda en la tabla vyp_mision_pasajes
{


 var filas = $("#cnt_pasaje").find("tbody").find("tr");

var fechass;
var fechass1;
var celdas;
 
var res1=" ";
var valor=filas.length;
        for(l=0; l< (valor); l++){
            
           //res=fechass;
  celdas = $(filas[l]).children("td");
         
     
            for(otro=0; otro<l; otro++)
            {
              
  fechass = $(celdas[0]).text(); 
//var fechitas = $($(celdas[4]).children("input")[0]).val();
   

 res1+=fechass.concat(",");  
}

alert(res1);
}
var f = $(this);
var formData = new FormData();
var nombre_empleado = $("#nr option:selected").text().split("-");

var fecha = $("#fecha1").val().split("-");
 
//alert($("#nr").val()+" --> "+nombre_empleado[0]+" --> "+fecha[0]+" --> "+fecha[1])
formData.append("nr", $("#nr").val());
formData.append("nombre_emple", nombre_empleado[0].trim());
formData.append("jefe_inmediato", $("#nr_jefe_inmediato").val());
formData.append("jefe_regional", $("#nr_jefe_regional").val());
formData.append("mes", fecha[1].trim()); 
formData.append("anio", fecha[0].trim());

formData.append("fechas_p", res1);


       $.ajax({
            url: "<?php echo site_url(); ?>/pasajes/pasaje/gestionar_pasaje_fecha",
            type: "post",
            dataType: "html",
            data: formData,
            cache: false,
            contentType: false,
            processData: false
        })


       .done(function(res){
           alert(res)
            if(res == "exito"){
                if($("#band").val() == "save"){
                    swal({ title: "¡Registro exitoso!", type: "success", showConfirmButton: true });
                }else if($("#band").val() == "edit"){
                    swal({ title: "¡Modificación exitosa!", type: "success", showConfirmButton: true });
                }else{
                    swal({ title: "¡Borrado exitoso!", type: "success", showConfirmButton: true });
                }
                $("#band").val('save');
                tabla_pasaje_unidad();
            }else{
                swal({ title: "¡Ups! Error", text: "Intentalo nuevamente.", type: "error", showConfirmButton: true });
            }
        });


}
    function tablapasajes(){          
        $( "#cnt-tabla" ).load("<?php echo site_url(); ?>/pasajes/Pasaje/tabla_pasajes", function() {
            $('#myTable').DataTable();
            $('[data-toggle="tooltip"]').tooltip();
        });  
 }



function combo_oficina_departamento(tipo){
        var nr = $("#nr").val();
        var newName = 'Otro nombre',
        xhr = new XMLHttpRequest();

        xhr.open('GET', "<?php echo site_url(); ?>/pasajes/Lista_pasaje/combo_oficinas_departamentos1?tipo="+tipo+"&nr="+nr);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status === 200 && xhr.responseText !== newName) {
                document.getElementById("combo_departamento").innerHTML = xhr.responseText;
                // document.getElementById("combo_departamento1").innerHTML = xhr.responseText;
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
        xhr.open('GET', "<?php echo site_url(); ?>/pasajes/Lista_pasaje/combo_municipios1?id_departamento="+id_departamento+"&tipo="+tipo);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status === 200 && xhr.responseText !== newName) {
                document.getElementById("combo_municipio").innerHTML = xhr.responseText;
                // document.getElementById("combo_municipio1").innerHTML = xhr.responseText;
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
            url: "<?php echo site_url(); ?>/pasajes/Lista_pasaje/obtener_id_municipio1",
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
            url: "<?php echo site_url(); ?>/pasajes/Lista_pasaje/obtener_id_municipio1",
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
            url: "<?php echo site_url(); ?>/pasajes/Lista_pasaje/obtener_id_departamento1",
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



function combo_oficina_departamento1(tipo){
        var nr = $("#nr").val();
        var newName = 'Otro nombre',
        xhr1 = new XMLHttpRequest();
//xhr1 = new XMLHttpRequest();
        xhr1.open('GET', "<?php echo site_url(); ?>/pasajes/Lista_pasaje/combo_oficinas_departamentos2?tipo="+tipo+"&nr="+nr);
        xhr1.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr1.onload = function() {
            if (xhr1.status === 200 && xhr1.responseText !== newName) {
              //  document.getElementById("combo_departamento").innerHTML = xhr.responseText;
                  document.getElementById("combo_departamento1").innerHTML = xhr1.responseText;
                  //document.getElementById("combo_departamento").innerHTML = xhr1.responseText;
                $(".select2").select2();
                if(tipo == "mapa"){
                    $('#departamento1').val(id_departamento_mapa).trigger('change.select2');
                }else{
                    combo_municipio1(tipo);
                }
            }else if (xhr1.status !== 200) {
                swal({ title: "Ups! ocurrió un Error", text: "Al parecer no todos los objetos se cargaron correctamente por favor recarga la página e intentalo nuevamente", type: "error", showConfirmButton: true });
            }
        };
        xhr1.send(encodeURI('name=' + newName));
    }

    function combo_municipio1(tipo){     
        var id_departamento = $("#departamento1").val();
                var newName = 'John Smith',

        xhr1 = new XMLHttpRequest();
        // xhr1 = new XMLHttpRequest();
        xhr1.open('GET', "<?php echo site_url(); ?>/pasajes/Lista_pasaje/combo_municipios2?id_departamento="+id_departamento+"&tipo="+tipo);
        xhr1.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr1.onload = function() {
            if (xhr1.status === 200 && xhr1.responseText !== newName) {
               // document.getElementById("combo_municipio").innerHTML = xhr.responseText;
                 document.getElementById("combo_municipio1").innerHTML = xhr1.responseText;
                 //document.getElementById("combo_municipio").innerHTML = xhr1.responseText;
                $(".select2").select2();
                if(tipo == "oficina"){
                    if($("#departamento1").val() != ""){
                        $("#nombre_empresa").val($("#departamento1 option:selected").text());
                        $("#direccion_empresa").val($("#departamento1 option:selected").text());
                        $("#nombre_empresa").parent().parent().hide(0);
                        $("#direccion_empresa").parent().hide(0);
                        $("#municipio1").parent().hide(0);
                    }else{
                       
                        $("#municipio1").parent().hide(0);
                        
                    }
                   // input_distancia(tipo);
                }else if(tipo == "departamento1"){
                  
                    $("#municipio1").parent().show(0);
                   // input_distancia(tipo);
                }
            }

            else if (xhr1.status !== 200) {
                swal({ title: "Ups! ocurrió un Error", text: "Al parecer no todos los objetos se cargaron correctamente por favor recarga la página e intentalo nuevamente", type: "error", showConfirmButton: true });
            }
        };
        xhr1.send(encodeURI('name=' + newName));
    }


function obtener_id_municipio1(municipio){
        var formData = new FormData();

formData.append("id_municipio", municipio);

        $.ajax({
            url: "<?php echo site_url(); ?>/pasajes/Lista_pasaje/obtener_id_municipio2",
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
                obtener_id_municipio3(municipio);
            }else{
                id_municipio_mapa = res;
                obtener_id_departamento1(res);
            }
             
        });
    }

    function obtener_id_municipio3(municipio){
        var formData = new FormData();
        formData.append("id_municipio", municipio);

        $.ajax({
            url: "<?php echo site_url(); ?>/pasajes/Lista_pasaje/obtener_id_municipio2",
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
                obtener_id_departamento1(res);
                swal({ title: "Verificar municipio", text: "La direccion no se encontro completa, es posible que el municipio mostrado no se el correcto. De ser así, seleccionelo manualmente", type: "warning", showConfirmButton: true });
            }
             
        });
    }

    function obtener_id_departamento1(id_municipio){
        var formData = new FormData();
        formData.append("id_municipio", id_municipio);

        $.ajax({
            url: "<?php echo site_url(); ?>/pasajes/Lista_pasaje/obtener_id_departamento2",
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
                combo_oficina_departamento1("mapa");
            }
        });
    }


function form_folleto_viaticos(){
      //  $("#bntadd").hide(0);
//combo_oficina_departamento("departamento");
    combo_oficina_departamento("departamento");
       //combo_oficina_departamento1("departamento");
  
        $("#municipio").parent().show(0);


      
    }
    function form_folleto_viaticos_otro(){
      //  $("#bntadd").hide(0);
      
     //combo_oficina_departamento("departamento");
        combo_oficina_departamento1("departamento1");
  
        $("#municipio1").parent().show(0);

      
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
            <div class="col-lg-12" id="cnt_form" >
                <div class="card">
                    <div class="card-header bg-success2" id="ttl_form">
                        <div class="card-actions text-white">
                            <a style="font-size: 16px;" onclick="cerrar_mantenimiento();"><i class="mdi mdi-window-close"></i></a>
                        </div>
                        <h4 class="card-title m-b-0 text-white">Pasajes</h4>
                    </div>
                    <div class="card-body b-t">
                    <?php echo form_open('', array('id' => 'formcuentas2', 'style' => 'margin-top: 0px;', 'class' => 'm-t-40')); ?>
                        <input type="hidden" id="band" name="band" value="save">
                           
                            <input type="hidden" id="idb" name="idb" value="">
                             <div class="row">
              <div class="col-lg-12" id="cnt_info_pasajes">
                
              </div>
      </div>
                           <div class="row">                        
                        <div class="form-group col-lg-6"> 
                            <h5>Empleado a modificar: <span class="text-danger">*</span></h5>                           
                            <select id="nr" name="nr" class="select2" style="width: 100%" required="" onchange="tabla_pasaje_unidad();">
                                <option value="">[Elija el empleado a editar sus datos]</option>
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
                <div class="form-group col-lg-6">  
                <h5>Fecha: <span class="text-danger">*</span></h5>
                <input type="month"  class="form-control" id="fecha1" name="fecha1"  onchange="tabla_pasaje_unidad();">
                
                <div class="help-block"></div>
                </div>
                </div>

                    <h5>Pasajes del empleado</h5>
                    <blockquote class="m-t-10">
                                               
                                <div id="cnt_pasaje"></div> <!--para imprimir la tabla -->

                                 
                        </blockquote>
                        <div class="row" align="right">
                        <div class="col-lg-12">
                            <button type="button" onclick="guardar_pasaje()" class="pull-right btn btn-info">
                            Enviar solicitud
                            </button>
                        </div>
                        </div>
                    <?php echo form_close(); ?>
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



<div id="modal_pasaje" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <?php echo form_open('', array('id' => 'form_pasaje', 'style' => 'margin-top: 0px;', 'class' => 'm-t-40')); ?>
            <div class="modal-header">
                <h4 class="modal-title">Editar pasajes</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="id_pasaje" name="id_pasaje">
                <div class="form-group col-lg-12">
                    <h5>Fecha: <span class="text-danger">*</span></h5>
                    <input type="text" pattern="\d{1,2}-\d{1,2}-\d{4}"  required=""  class="form-control" id="fecha2" name="fecha2" placeholder="dd/mm/yyyy">
                </div>
                
                <h5>Departamento: <span class="text-danger">*</span></h5>
                 <div  class="form-group col-lg-12" id="combo_departamento1">
               
                </div>

               <h5>Municipio: <span class="text-danger">*</span></h5>
                  <div class="form-group col-lg-12" id="combo_municipio1">
               
                </div>
                <div class="form-group col-lg-12" >
                    <h5>Expediente: <span class="text-danger">*</span></h5>
                    <input type="text" id="expediente2" name="expediente2" class="form-control">
                </div>
                <div class="form-group col-lg-12">
                    <h5>Empresa: <span class="text-danger">*</span></h5>
                    <input type="text" id="empresa2" name="empresa2" class="form-control" required="" > 
                </div>
                <div class="form-group col-lg-12">
                    <h5>Direccion: <span class="text-danger">*</span></h5>
                   <input type="text"  id="direccion2" name="direccion2" class="form-control" required="" placeholder="Escriba la dirección" minlength="3">
                </div>

                <div class="form-group col-lg-12">
                    <h5>Monto: <span class="text-danger">*</span></h5>
                    <input type="text" id="monto2" name="monto2" class="form-control" required="">
                </div>

            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-success waves-effect" data-dismiss="modal">Cancelar</button>
                <button type="button" onclick="editar_pasaje();" class="btn btn-info waves-effect" data-dismiss="modal">Editar</button>
            </div>
            <?php echo form_close(); ?>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>





<!-- ============================================================== -->
<!-- Fin de DIV de inicio (ENVOLTURA) -->
<!-- ============================================================== -->
<script src="<?php echo base_url(); ?>assets/plugins/cropper/cropper-init.js"></script>
<script>
$(function(){
    $('#fecha2').datepicker({
                    format: 'dd-mm-yyyy',
                    autoclose: true,
                    todayHighlight: true
                });
$("#formcuentas2").on("submit", function(e){
   
        e.preventDefault();
        var f = $(this);
        var formData = new FormData(document.getElementById("formcuentas2"));
        formData.append("dato", "valor");
       
        
        $.ajax({
            url: "<?php echo site_url(); ?>/pasajes/Lista_pasaje/gestionar_pasaje3",
            type: "post",
            dataType: "html",
            data: formData,
            cache: false,
            contentType: false,
            processData: false
        })
        .done(function(res){
         alert(res)
            if(res == "exito"){
                if($("#band").val() == "save"){
                    swal({ title: "¡Registro exitoso!", type: "success", showConfirmButton: true });
                }else if($("#band").val() == "edit"){
                    swal({ title: "¡Modificación exitosa!", type: "success", showConfirmButton: true });
                }else{
                    swal({ title: "¡Borrado exitoso!", type: "success", showConfirmButton: true });
                }
                $("#band").val('save');
                tabla_pasaje_unidad();
            }else{
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


<script>
/*$(function(){     
    $("#formcuentas2").on("submit", function(e){
        e.preventDefault();
        var f = $(this);
        var formData = new FormData(document.getElementById("formcuentas2"));
        formData.append("dato", "valor");
        
        $.ajax({
            url: "<?php //echo site_url(); ?>/pasajes/pasaje/gestionar_mision_pasajes",
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
                }
                tabla_pasaje_unidad();
            }else{
                swal({ title: "¡Ups! Error", text: "Intentalo nuevamente.", type: "error", showConfirmButton: true });
            }
        });
            
    });
});
*/
</script>
