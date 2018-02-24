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

   function ver_pasajes(){
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
       location.href = "<?php echo site_url(); ?>/viatico/pasaje?nr="+nr + "&fecha2="+fechas;
        //xmlhttpB.open("GET","<?php echo site_url(); ?>/viatico/lista_pasaje/tabla_pasaje_lista?nr="+nr + "&fecha2="+fechas, true);
         
        xmlhttpB.send();      
    }
   

    function iniciar(){
        tabla_pasaje_lista();
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
        xmlhttpB.open("GET","<?php echo site_url(); ?>/viatico/lista_pasaje/tabla_pasaje_lista?nr="+nr + "&fecha2="+fechas, true);
         
        xmlhttpB.send(); 
    }

 function imprimir_solicitud(nr, fecha_de_pasaje){
        window.open("<?php echo site_url(); ?>/viatico/Lista_pasaje/imprimir_solicitud?nr="+nr + "&fecha2="+fecha_de_pasaje, '_blank');
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
                    <input type="text" pattern="\d{1,2}-\d{1,2}-\d{4}"  required=""  class="form-control" id="fecha3" name="fecha3" placeholder="dd/mm/yyyy">
                </div>
                <div class="form-group col-lg-12">
                    <h5>Expediente: <span class="text-danger">*</span></h5>
                    <input type="text" id="expediente3" name="expediente3" class="form-control">
                </div>
                <div class="form-group col-lg-12">
                    <h5>Empresa: <span class="text-danger">*</span></h5>
                    <input type="text" id="empresa3" name="empresa3" class="form-control" required="" > 
                </div>
                <div class="form-group col-lg-12">
                    <h5>Direccion: <span class="text-danger">*</span></h5>
                   <input type="text"  id="direccion3" name="direccion3" class="form-control" required="" placeholder="Escriba la dirección" minlength="3">
                </div>

                <div class="form-group col-lg-12">
                    <h5>Monto: <span class="text-danger">*</span></h5>
                    <input type="text" id="monto3" name="monto3" class="form-control" required="">
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

    $('#fecha3').datepicker({
                    format: 'dd-mm-yyyy',
                    autoclose: true,
                    todayHighlight: true


                });

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



