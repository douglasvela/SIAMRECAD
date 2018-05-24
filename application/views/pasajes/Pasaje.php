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
var nr1 = "<?php echo $_GET["nr1"]; ?>"
var fechitas = "<?php echo $_GET["fecha"]; ?>"
var id="<?php echo $_GET["id"]; ?>"
var estado="<?php echo $_GET["estado"]; ?>"
var bandera="<?php echo $_GET["bandera"]; ?>"
var fecha_observacion="<?php echo $_GET["fecha_observacion"]; ?>"
//alert(bandera);
var id_mision = <?php echo $id_este; ?>

function cambiar_editar(id,fecha,expediente,empresa,direccion,nr_usuario, monto,departamento, municipio, actividad,bandera){
         tabla_pasaje_unidad();
    //form_folleto_viaticos1();
//alert(actividad);
        $("#id_pasaje").val(id);
        $("#fecha2").datepicker("setDate", fecha );

        $("#expediente2").val(expediente);

         $("#id_departamento1").val(departamento).trigger("change.select2");
//$("#id_departamento").val(id_departamento).trigger("change.select2");
        $("#municipio1").val(municipio).trigger("change.select2");
//alert(departamento);
//alert(municipio);
        $("#empresa2").val(empresa);
        $("#direccion2").val(direccion);

        $("#monto2").val(monto);
       //  $("#depende_vyp_actividades").val(depende_vyp_actividades);

$("#id_actividad1").val(actividad).trigger("change.select2");
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
        formData.append("id_actividad1", $("#id_actividad1").val());
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
           // alert(res)
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
//  
        var band_visible = false;

        for(l=0; l< (filas.length-1); l++){
            celdas = $(filas[l]).children("td");
          
        }

    

        return band_visible;
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
                 ver_con_observaciones();
 
 

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

function info_pasajes()
{ //para la validacion
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

function info_pasajes1()
{ //para la validacion
        var nr = $("#nr").val();
        var fechap = $("#fecha2").val();
        if(window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp_A=new XMLHttpRequest();
        }else{// code for IE6, IE5
            xmlhttp_A=new ActiveXObject("Microsoft.XMLHTTPB");
        }
        xmlhttp_A.onreadystatechange=function(){
            if (xmlhttp_A.readyState==4 && xmlhttp_A.status==200){
                  document.getElementById("cnt_info_pasajes1").innerHTML=xmlhttp_A.responseText;
            }
        }
        xmlhttp_A.open("GET","<?php echo site_url(); ?>/pasajes/pasaje/info_pasajes?nr="+nr+"&fecha="+fechap,true);
        xmlhttp_A.send();
}
//codigo para validar que la solicitud no se pase de los 5 dias finalizado el mes//
var date = new Date();
var month1 = date.getMonth()+1;
var day1 = date.getDate();
var year1 = date.getFullYear();
var hoy=month1+"-"+day1+"-"+year1;
//date.setHours(0,0,0,0);

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
var fecha_nueva=mes1+"-"+day+"-"+year;
///
function guardar_pasaje()//guarda en la tabla vyp_mision_pasajes
{
if(id_mision==id)
            {

 editar_mision();
            }   
                else 

            {
            guardar_pasaje1();
 
             }

}



function editar_mision()//edit en la tabla vyp_mision_pasajes
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

//alert(res1);
}
var f = $(this);
var formData = new FormData();
var nombre_empleado = $("#nr option:selected").text().split("-");

var fecha = $("#fecha1").val().split("-");
 
//alert($("#nr").val()+" --> "+nombre_empleado[0]+" --> "+fecha[0]+" --> "+fecha[1])
//
formData.append("id_mision", id);
formData.append("nr", $("#nr").val());
formData.append("nombre_emple", nombre_empleado[0].trim());
formData.append("jefe_inmediato", $("#nr_jefe_inmediato").val());
formData.append("jefe_regional", $("#nr_jefe_regional").val());
formData.append("mes", fecha[1].trim()); 
formData.append("anio", fecha[0].trim());

formData.append("fechas_p", res1);
formData.append("band", "edit");


       $.ajax({
            url: "<?php echo site_url(); ?>/pasajes/pasaje/gestionar_pasaje_fecha",
            type: "post",
            dataType: "html",
            data: formData,
            cache: false,
            contentType: false,
            processData: false
        })

   /*var arreglo = fechap.split("-");
      var dia = arreglo[0];
      var mes = arreglo[1];
      var anno = arreglo[2];
var date = new Date();
var ultimoDia = new Date(anno, mes, dia);
       // alert(ultimoDia);
    var dias=5;
var mes1;
    tiempo=ultimoDia.getTime();
    milisegundos=parseInt(dias*24*60*60*1000);
    total=ultimoDia.setTime(tiempo+milisegundos);
    day=ultimoDia.getDate();
    month=ultimoDia.getMonth()+1;
    year=ultimoDia.getFullYear();
    mes1=month-1
    var fecha_nueva=day+"/"+mes1+"/"+year;
    alert(fecha_nueva);
*/
/*var date = new Date();
  
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
var fecha_nueva=day+"/"+mes1+"/"+year;*/
       .done(function(res){
           //alert(res)
            if(res == "exito" && (hoy <= fecha_nueva)){
                 recorre_observaciones();
                if($("#band").val() == "save"){
//swal({ title: "¡Registro exitoso!", type: "success", showConfirmButton: true });
                buscar_idmision();
                }else if($("#band").val() == "edit"  ){
                   // alert(fecha_nueva);
                   // alert(hoy);
                   // swal({ title: "¡Modificación exitosa!", type: "success", showConfirmButton: true });
                }else{
                    swal({ title: "¡Borrado exitoso!", type: "success", showConfirmButton: true });
                }
                $("#band").val('edit');
                tabla_pasaje_lista();
            }else{
                swal({ title: "¡Ups! Error", text: "Intentalo nuevamente.", type: "error", showConfirmButton: true });
            }
        });


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

//alert(res1);
}
var f = $(this);
var formData = new FormData();
var nombre_empleado = $("#nr option:selected").text().split("-");

var fecha = $("#fecha1").val().split("-");
 
//alert($("#nr").val()+" --> "+nombre_empleado[0]+" --> "+fecha[0]+" --> "+fecha[1])
//
//formData.append("id_mision", id);
formData.append("nr", $("#nr").val());
formData.append("nombre_emple", nombre_empleado[0].trim());
formData.append("jefe_inmediato", $("#nr_jefe_inmediato").val());
formData.append("jefe_regional", $("#nr_jefe_regional").val());
formData.append("mes", fecha[1].trim()); 
formData.append("anio", fecha[0].trim());

formData.append("fechas_p", res1);
 //validar_dia_limite("0", "save");
formData.append("band", "save");



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
           //alert(res)
            if(res == "exito"){
                 recorre_observaciones();
                if($("#band").val() == "save"){
//swal({ title: "¡Registro exitoso!", type: "success", showConfirmButton: true });
buscar_idmision();
                }else if($("#band").val() == "edit"){
                    swal({ title: "¡Modificación exitosa!", type: "success", showConfirmButton: true });
                }else{
                    swal({ title: "¡Borrado exitoso!", type: "success", showConfirmButton: true });
                }
                $("#band").val('save');
                tabla_pasaje_lista1();
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




  function tabla_pasaje_lista1(){ 
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
    function buscar_idmision(){
        var nr = $("#nr").val();

        ajax = objetoAjax();
        ajax.open("POST", "<?php echo site_url(); ?>/pasajes/pasaje/obtener_ultima_mision", true);
        ajax.onreadystatechange = function() {
            if (ajax.readyState == 4){
                $("#id_mision").val(ajax.responseText);
                tabla_pasaje_unidad();//(function(){ form_rutas() });
            }
        } 
        ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded"); 
        ajax.send("&nr="+nr)
    }


 function gcheckbox(indice){      
        return  '<div class="form-check">'+
                    '<label class="custom-control custom-checkbox">'+
                        '<input type="checkbox" onchange="" class="custom-control-input" checked value="'+indice+'">'+
                        '<span class="custom-control-indicator"></span>'+
                        '<span class="custom-control-description"></span>'+
                    '</label>'+
                '</div>';
    }
     

function generar_solicitud(){
       
            ajax = objetoAjax();
            ajax.open("POST", "<?php echo site_url(); ?>/pasajes/pasaje/generar_solicitud", true);
            ajax.onreadystatechange = function() {
                if (ajax.readyState == 4){
                    tabla_pasaje_unidad();
                       // alert("entra2");
                       // tabla_pasaje_unidad();
                        swal({ title: "!Solicitud exitosa!", type: "success", showConfirmButton: true });
                        //cerrar_mantenimiento();
                        //imprimir_solicitud(id_mision);
                  
                    }           
                }
             
            ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded"); 
            ajax.send("&id_mision="+id)
       
        
        
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
                       // $("#nombre_empresa").val($("#departamento option:selected").text());
                        //$("#direccion_empresa").val($("#departamento option:selected").text());
                        //$("#nombre_empresa").parent().parent().hide(0);
                        //$("#direccion_empresa").parent().hide(0);
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

function ver_con_observaciones(){

    var observacion_habilitada = true;

        if(estado == "2" || estado == "4" || estado == "6"){
            var ufobservacion = moment(fecha_observacion).add('days',1);
            var fhoy = moment();

            var reducir = 0;

            if(ufobservacion.format("e") == 6){
                ufobservacion.add('days',2);
                reducir = 2;
            }else if(ufobservacion.format("e") == 0){
                ufobservacion.add('days',1);
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


        if(bandera == "edit"){

          //  $('#summernote').summernote('code', decodeURIComponent(escape(atob(ruta_justificacion))));

            if(observacion_habilitada){

                $("#band").val(bandera);
                observaciones(id);
 /*if(estado == "0"){
                    valor = validar_dia_limite(estado, "edit", newdate);
                }else{
                    valor = validar_dia_limite(estado, "edit", fecha_solicitud);
                }
    */

            }else{
                swal({ title: "Plazo agotado", text: "El plazo de observaciones finalizó el: "+ufobservacion.format("DD-MM-YYYY"), type: "error", showConfirmButton: true });
//$("#cnt_form").show(0);
      // $("#cnt_form1").show(0);
       $("#cnt-tabla").show(0);
      
     location.href = "<?php echo site_url(); ?>/pasajes/Lista_pasaje/";
            
            }
}

 $( "html, body" ).animate({scrollTop:0}, '500');
        $('[data-toggle="tooltip"]').tooltip();
}


    var primer_fecha_inicio = "";
    var primer_fecha_fin = "";
    var fecha_de_hoy = moment().format("DD/MM/YYYY");
    var ultima_fecha_inicio = "";
    var ultima_fecha_fin = "";

   

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
               // form_mision();
            }
        }
        xmlhttpB.open("GET","<?php echo site_url(); ?>/pasajes/pasaje/observaciones?id_mision="+id_mision,true);
        xmlhttpB.send(); 
    }

 
 function iniciar(){

        tabla_pasaje_unidad();
    // cambiar_nuevo();
   
      if(nr_empleado!="")
      {
      $("#nr").val(nr_empleado).trigger('change.select2');
     $("#fecha1").val(fecha_p).trigger('change.select2');
        }
else{
    $("#nr").val(nr1).trigger('change.select2');
    $("#fecha1").val(fechitas).trigger('change.select2');
}

      form_folleto_viaticos();
   
     // form_folleto_viaticos_otro();

        $('html,body').animate({
            scrollTop: $("body").offset().top
        }, 500);
         
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
                        <div id="cnt_observaciones"></div>   
                    <?php echo form_open('', array('id' => 'formcuentas2', 'style' => 'margin-top: 0px;', 'class' => 'm-t-40')); ?>
                        <input type="hidden" id="bandita" name="bandita" value="save">
                           
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
                
              <div class="row">
              <div class="col-lg-12" id="cnt_info_pasajes1">
                
              </div>
      </div>
                <div class="form-group col-lg-12">
                    <h5>Fecha: <span class="text-danger">*</span></h5>
                    <input type="text" pattern="\d{1,2}-\d{1,2}-\d{4}"  required=""  class="form-control" id="fecha2" name="fecha2" placeholder="dd/mm/yyyy" onchange ="info_pasajes1();">
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
        // alert(res)
        // alert(bandera)
            if(res == "exito"){
                if($("#bandita").val() == "save"){
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
