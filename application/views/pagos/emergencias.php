<script type="text/javascript">
    function cambiar_editar(id,nr,fecha_mision_inicio,fecha_mision_fin,id_actividad,tipo_pago,monto,num_cheque,fecha_pago,bandera){
        $("#id_pago_emergencia").val(id);
        $("#id_actividad").val(id_actividad).trigger('change.select2');
        $("#num_cheque").val(num_cheque);
        $("#nr").val(nr).trigger('change.select2');
        $("#monto").val(monto);

        if(tipo_pago == "efectivo"){
            document.getElementById("cbx_efectivo").checked = 1;
        }else{
            document.getElementById("cbx_cheque").checked = 1;
        }

        $("#fecha_mision_inicio").datepicker("setDate", fecha_mision_inicio );
        $("#fecha_mision_fin").datepicker("setDate", fecha_mision_fin );
        $("#fecha_pago").datepicker("setDate", fecha_pago );

        if(bandera == "edit"){
            $("#ttl_form").removeClass("bg-success");
            $("#ttl_form").addClass("bg-info");
            $("#btnadd").hide(0);
            $("#btnedit").show(0);
            $("#cnt_tabla").hide(0);
            $("#cnt_form").show(0);
            $("#ttl_form").children("h4").html("<span class='fa fa-wrench'></span> Editar pago de emergencia");
        }else{
            eliminar_pago_emergencia(bandera);
        }
    }

    function cambiar_nuevo(){
        $("#id_pago_emergencia").val("");
        $("#id_actividad").val("").trigger('change.select2');
        $("#num_cheque").val("");
        $("#nr").val("").trigger('change.select2');
        $("#monto").val("0.00");
        
        var nueva_fecha =  moment();
        if(nueva_fecha.format("e") == 6){
            nueva_fecha.add('days',2);
            document.getElementById("cbx_efectivo").checked = 1;
        }else if(nueva_fecha.format("e") == 0){
            nueva_fecha.add('days',1);
        }

        $("#fecha_mision_inicio").datepicker("setDate", nueva_fecha.format("DD-MM-YYYY") );
        $("#fecha_mision_fin").datepicker("setDate", nueva_fecha.format("DD-MM-YYYY") );
        $("#fecha_pago").datepicker("setDate", nueva_fecha.format("DD-MM-YYYY") );


        $("#ttl_form").addClass("bg-success");
        $("#ttl_form").removeClass("bg-info");
        $("#btnadd").show(0);
        $("#btnedit").hide(0);
        $("#cnt_tabla").hide(0);
        $("#cnt_form").show(0);
        $("#ttl_form").children("h4").html("<span class='mdi mdi-plus'></span> Nuevo pago de emergencia");
    }

    function cerrar_mantenimiento(){
        $("#cnt_tabla").show(0);
        $("#cnt_form").hide(0);
    }

    function editar_pago_emergencia(){
        $("#band").val("edit");
        $("#submit").click();
    }

    function eliminar_pago_emergencia(bandera){
        $("#band").val(bandera);
        if(bandera == "delete"){
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
        }else{
           swal({   
                title: "¿Está seguro?",   
                text: "¡Desea cambiar el estado del registro!",   
                type: "warning",   
                showCancelButton: true,   
                confirmButtonColor: "#fc4b6c",   
                confirmButtonText: "Sí, deseo cambiarlo!",   
                closeOnConfirm: false 
            }, function(){   
                $("#submit").click(); 
            }); 
        }
        
    }

    function iniciar(){
        <?php if(tiene_permiso($segmentos=2,$permiso=1)){ ?>
        tabla_emergencias();
        <?php }else{ ?>
            $("#cnt_tabla").html("Usted no tiene permiso para este formulario.");     
      <?php } ?>
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

    function tabla_emergencias(){          
        $( "#cnt_tabla" ).load("<?php echo site_url(); ?>/pagos/emergencias/tabla_emergencias", function() {
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
                <h3 class="text-themecolor m-b-0 m-t-0">Gestión de pagos de emergencia</h3>
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
                        <h4 class="card-title m-b-0 text-white">Listado pagos de emergencia</h4>
                    </div>
                    <div class="card-body b-t">
                        
                        <?php echo form_open('', array('id' => 'formajax', 'style' => 'margin-top: 0px;', 'class' => 'm-t-40')); ?>
                            <input type="hidden" id="band" name="band" value="save">
                            <input type="hidden" id="id_pago_emergencia" name="id_pago_emergencia" value="">



                            <div class="row">
                                <div class="form-group col-lg-6"> 
			                        <h5>Empleado: <span class="text-danger">*</span></h5>                           
			                        <select id="nr" name="nr" class="select2" style="width: 100%" required="">
			                            <option value="">[Elija el empleado]</option>
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
                                <div class="form-group col-lg-3">   
                                    <h5>Fecha de misión (inicio): <span class="text-danger">*</span></h5>
                                    <input type="text" pattern="\d{1,2}-\d{1,2}-\d{4}" required="" class="form-control" id="fecha_mision_inicio" name="fecha_mision_inicio" placeholder="dd/mm/yyyy" readonly="">
                                    <div class="help-block"></div>
                                </div>
                                <div class="form-group col-lg-3">   
                                    <h5>Fecha misión (fin): <span class="text-danger">*</span></h5>
                                    <input type="text" pattern="\d{1,2}-\d{1,2}-\d{4}" required="" class="form-control" id="fecha_mision_fin" name="fecha_mision_fin" placeholder="dd/mm/yyyy" readonly="">
                                    <div class="help-block"></div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="form-group col-lg-8"> 
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

                                <div class="col-lg-4" align="center">
                                    <h5>Tipo de pago: <span class="text-danger">*</span></h5>
                                    <div class="">
	                                    <input name="tipo_pago" type="radio" class="with-gap" id="cbx_efectivo" checked value="efectivo">
	                                    <label for="cbx_efectivo">Efectivo</label>
	                                    &emsp;
	                                    <input name="tipo_pago" type="radio" id="cbx_cheque" class="with-gap" value="cheque">
	                                    <label for="cbx_cheque">Cheque</label>	                                    
	                                </div>
                                </div>
                                                               
                            </div>

                            <div class="row">
                            	<div class="form-group col-lg-3">
                                    <h5>Monto: <span class="text-danger">*</span></h5>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-dollar"></i></div>
                                        <input type="number" id="monto" name="monto" class="form-control" value="0.00">
                                    </div>
                                </div>
                                <div class="form-group col-lg-5">
                                    <h5>Número de cheque: <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" id="num_cheque" name="num_cheque" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group col-lg-4">   
                                    <h5>Fecha de pago: <span class="text-danger">*</span></h5>
                                    <input type="text" pattern="\d{1,2}-\d{1,2}-\d{4}" required="" class="form-control" id="fecha_pago" name="fecha_pago" placeholder="dd/mm/yyyy" readonly="">
                                </div>
                            </div>
                            
                            <button id="submit" type="submit" style="display: none;"></button>
                            <div align="right" id="btnadd">
                                <button type="reset" class="btn waves-effect waves-light btn-success"><i class="mdi mdi-recycle"></i> Limpiar</button>
                                <button type="submit" class="btn waves-effect waves-light btn-success2"><i class="mdi mdi-plus"></i> Guardar</button>
                            </div>
                            <div align="right" id="btnedit" style="display: none;">
                                <button type="reset" class="btn waves-effect waves-light btn-success"><i class="mdi mdi-recycle"></i> Limpiar</button>
                                <button type="button" onclick="editar_pago_emergencia()" class="btn waves-effect waves-light btn-info"><i class="mdi mdi-pencil"></i> Editar</button>
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

$(document).ready(function(){  

	var date = new Date();
        var currentMonth = date.getMonth();
        var currentDate = date.getDate();
        var currentYear = date.getFullYear();

    $('#fecha_mision_inicio').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true,
        todayHighlight: true,
        daysOfWeekDisabled: [0,6]
    }).datepicker("setDate", new Date());

    $('#fecha_mision_fin').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true,
        todayHighlight: true,
        daysOfWeekDisabled: [0,6]
    }).datepicker("setDate", new Date());

    $('#fecha_pago').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true,
        todayHighlight: true,
        daysOfWeekDisabled: [0,6]
    }).datepicker("setDate", new Date());
});

$(function(){     
    $("#formajax").on("submit", function(e){
        e.preventDefault();
        var f = $(this);
        var formData = new FormData(document.getElementById("formajax"));
        formData.append("dato", "valor");
        
        $.ajax({
            url: "<?php echo site_url(); ?>/pagos/emergencias/gestionar_pago_emergencia",
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
                tabla_emergencias();
            }else{
                swal({ title: "¡Ups! Error", text: "Intentalo nuevamente.", type: "error", showConfirmButton: true });
            }
        });
            
    });
});

</script>