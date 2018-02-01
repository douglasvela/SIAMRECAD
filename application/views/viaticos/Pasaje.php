<script type="text/javascript">


    function cambiar_editar(id,fecha,expediente,empresa,direccion,nr_usuario,hora_inicio,hora_fin, monto,bandera){
          tabla_pasaje_unidad();
        $("#idb").val(id);
        $("#fecha").val(fecha);
        $("#expediente").val(expediente);
        $("#empresa").val(empresa);
        $("#direccion").val(direccion);
        $("#nr_usuario").val(nr_usuario);
        $("#hora_inicio").val(hora_inicio);
        $("#hora_fin").val(hora_fin);
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
    }

    function editar_pasaje(){

        $("#band").val("edit");
        $("#submit").click();
    }
 function cerrar_mantenimiento(){
        $("#cnt-tabla").show(0);
        $("#cnt_form").hide(0);
    }
    function cambiar_nuevo(){
        tabla_pasaje_unidad();
        $("#idb").val("");
        $("#fecha").val("");
        $("#expediente").val("");
        $("#empresa").val("");
        $("#direccion").val("");
        $("#nr_usuario").val("");
        $("#hora_inicio").val("");
        $("#hora_fin").val("");
        $("#monto").val("");
        $("#band").val("save");
        $("#ttl_form").addClass("bg-success");
        $("#ttl_form").removeClass("bg-info");

        $("#btnadd").show(0);
        $("#btnedit").hide(0);

        $("#cnt-tabla").hide(0);
        $("#cnt_form").show(0);

        $("#ttl_form").children("h4").html("<span class='mdi mdi-plus'></span> Pasajes");
    }

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
        tablapasajes();
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
        if(window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttpB=new XMLHttpRequest();
        }else{// code for IE6, IE5
            xmlhttpB=new ActiveXObject("Microsoft.XMLHTTPB");
        }
        xmlhttpB.onreadystatechange=function(){
            if (xmlhttpB.readyState==4 && xmlhttpB.status==200){
                document.getElementById("cnt_pasaje").innerHTML=xmlhttpB.responseText;
                $('#myTable').DataTable();
                $('[data-toggle="tooltip"]').tooltip();
            }
        }
        xmlhttpB.open("GET","<?php echo site_url(); ?>/viatico/pasaje/tabla_pasaje_unidad",true);
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
            <div class="col-lg-1"></div>
            <div class="col-lg-10" id="cnt_form" style="display: none;">
                <div class="card">
                    <div class="card-header bg-success2" id="ttl_form">
                        <div class="card-actions text-white">
                            <a style="font-size: 16px;" onclick="cerrar_mantenimiento();"><i class="mdi mdi-window-close"></i></a>
                        </div>
                        <h4 class="card-title m-b-0 text-white">Pasajes</h4>
                    </div>
                    <div class="card-body b-t">
                        
                        <?php echo form_open('', array('id' => 'formajax', 'style' => 'margin-top: 0px;', 'class' => 'm-t-40', 'novalidate' => '')); ?>
                            <input type="hidden" id="band" name="band" value="save">
                            <input type="hidden" id="idb" name="idb" value="">
                            <div class="row">
                                <div class="form-group col-lg-6">
                                    
                                         <h5>Fecha de misión: <span class="text-danger">*</span></h5>
                                    <input type="text" pattern="\d{1,2}-\d{1,2}-\d{4}" data-date-end-date="0d" data-date-start-date="-5d" onkeyup="FECHA('fecha')" required="" value="<?php echo date('d-m-Y'); ?>" class="form-control" id="fecha" name="fecha" placeholder="dd/mm/yyyy">

                                          <div class="help-block"></div>
                                   
                                </div>


                                 <?php 
                             $pasajes = $this->db->get("vyp_pasajes");
                      $user = $this->session->userdata('usuario_viatico');
                                $nr = $this->db->query("SELECT * FROM org_usuario WHERE usuario = '".$user."' LIMIT 1");
                                $nr_usuario = ""; $nombre_usuario;
                    if(!empty($pasajes) && ($nr->num_rows() > 0)){

                        foreach ($pasajes->result() as $fila) {
                           foreach($nr->result() as $fila1){
                                        $nr_usuario = $fila1->nr; 
                                        }
                                        }
                                        }
            
              ?>
                                <div class="form-group col-lg-6">
                                    <h5>NR: </h5>
                                    <div class="controls">
                                        <input type="text" id="nr" name="nr" class="form-control" value="<?php echo $nr_usuario; ?>" readonly>
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>

                             <div class="row">

                             <div class="form-group col-lg-6">
                                    <h5>Número de expediente: </h5>
                                    <div class="controls">
                                        <input type="text" id="expediente" name="expediente" class="form-control">
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <h5>Empresa visitada: <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" id="empresa" name="empresa" class="form-control" required="" data-validation-required-message="Este campo es requerido">
                                        <div class="help-block"></div>
                                    </div>
                                </div>

                               
                            </div>

                           <div class="row">
                                <div class="form-group col-lg-12" style="height: 83px;">
                                    <h5>Direccion: <span class="text-danger">*</span></h5>
                                    <textarea type="text"  id="direccion" name="direccion" class="form-control" required="" placeholder="Escriba la dirección" minlength="3" data-validation-required-message="Este campo es requerido"></textarea>
                                    <div class="help-block"></div>
                                </div>
                            </div>
                             
                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <h5>Hora de salida: <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                       <input type="time" id="hora_inicio" name="hora_inicio" class="form-control" required=""  data-validation-required-message="Formato de hora no válido">
                                        <div class="help-block"></div>
                                    </div>
                                </div>

                                <div class="form-group col-lg-6">
                                    <h5>Hora de llegada: </h5>
                                    <div class="controls">
                                       <input type="time" id="hora_fin" name="hora_fin" class="form-control" required="" data-validation-required-message="Formato de hora no válido">
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <h5>Monto: <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" id="monto" name="monto" class="form-control" required="" data-validation-required-message="Este campo es requerido">
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>

                           

                            <button id="submit" type="submit" style="display: none;"></button>
                            <div align="right" id="btnadd">
                                <button type="reset" class="btn waves-effect waves-light btn-success"><i class="mdi mdi-recycle"></i> Limpiar</button>
                                 <button type="submit"  class="btn waves-effect waves-light btn-success2"><i class="mdi mdi-plus"></i> Agregar</button>
                            </div>
                             <div align="right" id="btnedit" style="display: none;">
                                <button type="reset" class="btn waves-effect waves-light btn-success"><i class="mdi mdi-recycle"></i> Limpiar</button>
                                <button type="button" onclick="editar_pasaje()" class="btn waves-effect waves-light btn-info"><i class="mdi mdi-pencil"></i> Editar</button>
                            </div>
                            <div id="cnt_pasaje"> <!--para imprimir la tabla -->
                                
                                </div>

                                   </div>   
                        <?php echo form_close(); ?>
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
            <div class="col-lg-12" id="cnt-tabla">

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
    $("#formajax").on("submit", function(e){
        e.preventDefault();
        var f = $(this);
        var formData = new FormData(document.getElementById("formajax"));
        formData.append("dato", "valor");
        
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
       alert(res);
            if(res == "exito"){

                cerrar_mantenimiento();
                if($("#band").val() == "save"){
                    swal({ title: "¡Registro exitoso!", type: "success", showConfirmButton: true });
                }else if($("#band").val() == "edit"){ 
                    swal({ title: "¡Modificación exitosa!", type: "success", showConfirmButton: true });
                }else{
                    swal({ title: "¡Borrado exitoso!", type: "success", showConfirmButton: true });
                }
                tablapasajes();
            }else{
                swal({ title: "¡Ups! Error", text: "Intentalo nuevamente.", type: "error", showConfirmButton: true });
            }
        });
            
    });
});

</script>  -->



 <script>

    $(document).ready(function(){         
        $('#fecha').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true,
            todayHighlight: true
        });

        $('#dirigir').click(function(){ //Id del elemento cliqueable
            $('html, body').animate({scrollTop:0}, 1000);
            return false;
        });

    });

    

</script>



