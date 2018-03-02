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

var nr_empleado = "<?php echo $_GET["nr"]; ?>"
var fecha_p = "<?php echo $_GET["fecha2"]; ?>"

    function cambiar_editar(id,fecha,expediente,empresa,direccion,nr_usuario, monto,bandera){
          tabla_pasaje_unidad();
        $("#id_pasaje").val(id);
        $("#fecha2").datepicker("setDate", fecha );
        $("#expediente2").val(expediente);
        $("#empresa2").val(empresa);
        $("#direccion2").val(direccion);
        $("#monto2").val(monto);

       $("#modal_pasaje").modal("show")
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
        var formData = new FormData();
        formData.append("id_pasaje", $("#id_pasaje").val());
        formData.append("fecha", $("#fecha2").val());
        formData.append("expediente", $("#expediente2").val());
        formData.append("empresa", $("#empresa2").val());
        formData.append("direccion", $("#direccion2").val());
        formData.append("monto", $("#monto2").val());
        formData.append("band", "edit");

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
            alert(res)
            if(res == "exito"){
                tabla_pasaje_unidad();
                swal({ title: "¡Modificación exitosa!", type: "success", showConfirmButton: true });
            }else{
                swal({ title: "¡Ups! Error", text: "Intentalo nuevamente.", type: "error", showConfirmButton: true });
            }
             
        });
    }
   /*function cambiar_nuevo(){
        tabla_pasaje_unidad();
        $("#idb").val("");
        $("#fecha").val("");
        $("#expediente").val("");
        $("#empresa").val("");
        $("#direccion").val("");
        $("#nr2").val("");
        $("#monto").val("");
        $("#band").val("save");
        $("#ttl_form").addClass("bg-success");
        $("#ttl_form").removeClass("bg-info");

        $("#btnadd").show(0);
        $("#btnedit").hide(0);

        $("#cnt-tabla").hide(0);
        $("#cnt_form").show(0);

        $("#ttl_form").children("h4").html("<span class='mdi mdi-plus'></span> Pasajes");
    }*/
   

    function iniciar(){
        tabla_pasaje_unidad();
      // cambiar_nuevo();

      $("#nr").val(nr_empleado).trigger('change.select2');
     $("#fecha1").val(fecha_p).trigger('change.select2');
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
                 $('[data-toggle="tooltip"]').tooltip();
                 
                $('#fecha').datepicker({
                    format: 'dd-mm-yyyy',
                    autoclose: true,
                    todayHighlight: true


                });

            }
        }
       // xmlhttp.open("GET","getuser.php?q=" + q + "&r=" + r, true);
        xmlhttpB.open("GET","<?php echo site_url(); ?>/pasajes/pasaje/tabla_pasaje_unidad?nr="+nr + "&fecha1="+fechas, true);
         
        xmlhttpB.send(); 
    }



   

    function tablapasajes(){          
        $( "#cnt-tabla" ).load("<?php echo site_url(); ?>/pasajes/Pasaje/tabla_pasajes", function() {
            $('#myTable').DataTable();
            $('[data-toggle="tooltip"]').tooltip();
        });  

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
                        <div class="form-group col-lg-6"> 
                            <h5>Empleado a modificar: <span class="text-danger">*</span></h5>                           
                            <select id="nr" name="nr" class="select2" style="width: 100%" required="" onchange="tabla_pasaje_unidad();">
                                <option value="">[Elija el empleado a editar sus datos]</option>
                                <?php 
                                    $otro_empleado = $this->db->query("SELECT e.id_empleado, e.nr, UPPER(CONCAT_WS(' ', e.primer_nombre, e.segundo_nombre, e.tercer_nombre, e.primer_apellido, e.segundo_apellido, e.apellido_casada)) AS nombre_completo FROM sir_empleado AS e WHERE e.id_estado = '00001' ORDER BY e.primer_nombre, e.segundo_nombre, e.tercer_nombre, e.primer_apellido, e.segundo_apellido, e.apellido_casada");
                                    if($otro_empleado->num_rows() > 0){
                                        foreach ($otro_empleado->result() as $fila) {              
                                           echo '<option class="m-l-50" value="'.$fila->nr.'">'.$fila->nombre_completo.' - '.$fila->nr.'</option>';
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
                            <button type="button" onclick="" class="pull-right btn btn-info">
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
                <div class="form-group col-lg-12">
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
            url: "<?php echo site_url(); ?>/pasajes/pasaje/gestionar_pasaje",
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
        ajax.open("POST", "<?php echo site_url(); ?>/pasajes/solicitud_viatico/fecha_repetida", true);
        ajax.onreadystatechange = function() {
            if (ajax.readyState == 4){
                $("#area").val(ajax.responseText)
                if(ajax.responseText == "exito"){
                    generar_solicitud();
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



 <script>

    $(document).ready(function(){         
        

        $('#dirigir').click(function(){ //Id del elemento cliqueable
            $('html, body').animate({scrollTop:0}, 1000);
            return false;
        });

    });

    

</script>



