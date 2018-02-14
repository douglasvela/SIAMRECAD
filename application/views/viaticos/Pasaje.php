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



   /* function cambiar_editar(id, nr, id_banco, cuenta, estado, band){
        $("#id_empleado_banco").val(id);
        $("#nr2").val(nr);
        $("#id_banco").val(id_banco).trigger('change.select2');
        $("#cuenta").val(cuenta);
        $("#estado").val(estado);

        if(band == 'edit'){
            $("#modal_cuenta_bancaria").modal('show');
            $("#band").val(band);
        }else{
            $("#band").val(band);
            $("#submitbutton").click();
        }
    }*/




    /*function cambiar_editar(id,fecha,expediente,empresa,direccion,nr_usuario, monto,bandera){
          tabla_pasaje_unidad();
        $("#idb").val(id);
        $("#fecha").val(fecha);
        $("#expediente").val(expediente);
        $("#empresa").val(empresa);
        $("#direccion").val(direccion);
        $("#nr_usuario").val(nr_usuario)
        $("#monto").val(monto);

        if(bandera == "edit"){
            $("#ttl_form").removeClass("bg-success");
            $("#ttl_form").addClass("bg-info");
            $("#btnadd").hide(0);
            $("#btnedit").show(0);
            $("#cnt-tabla").hide(0);
            $("#cnt_form").show(0);
            $("#ttl_form").children("h4").html("<span class='fa fa-wrench'></span> Editar Pasaje");
        }else{
            eliminar_pasaje();
        }
    }*/

    function editar_pasaje(){

        $("#band").val("edit");
        $("#submit").click();
    }
 function cerrar_mantenimiento(){
        $("#cnt-tabla").show(0);
        $("#cnt_form").hide(0);
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

function eliminar_pasaje(){
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
            $("#submit").click(); 
        });
    }
   

    function iniciar(){
        tabla_pasaje_unidad();
      // cambiar_nuevo();
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
        xmlhttpB.open("GET","<?php echo site_url(); ?>/viatico/pasaje/tabla_pasaje_unidad?nr="+nr,true);
        xmlhttpB.send(); 
    }



   

    function tablapasajes(){          
        $( "#cnt-tabla" ).load("<?php echo site_url(); ?>/viatico/Pasaje/tabla_pasajes", function() {
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
            <div class="col-lg-10" id="cnt_form" >
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
                        <div class="form-group col-lg-8"> 
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
                    </div>
                    <h5>Pasajes del empleado</h5>
                    <blockquote class="m-t-10">
                                               
                                <div id="cnt_pasaje"></div> <!--para imprimir la tabla -->
                                 
                        </blockquote>
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
<!-- ============================================================== -->
<!-- Fin de DIV de inicio (ENVOLTURA) -->
<!-- ============================================================== -->
<script src="<?php echo base_url(); ?>assets/plugins/cropper/cropper-init.js"></script>
<script>

$(function(){

$("#formcuentas2").on("submit", function(e){
   
        e.preventDefault();

        var f = $(this);
        var formData = new FormData(document.getElementById("formcuentas2"));
        formData.append("dato", "valor");
       
        /*$("#band").val('save')
        $("#fecha_mision").val($("#fecha").val());
         $("#expediente").val($("#expediente").val());
          $("#empresa").val($("#empresa").val());
           $("#direccion").val($("#direccion").val());

           $("#nr").val($("#nr").val())
            $("#monto").val($("#monto").val());
        

        //$("#modal_cuenta_bancaria").modal('show')
        $("#submitbutton").click();*/
        
     


       /* $("#formajax2").on("submit", function(e){
        e.preventDefault();
        var f = $(this);
        var formData = new FormData(document.getElementById("formajax2"));
        formData.append("dato", "valor");*/
        
        $.ajax({
            url: "<?php echo site_url(); ?>/viatico/pasaje/gestionar_pasaje",
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
                //tabla_cuentas();
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



