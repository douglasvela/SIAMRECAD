<?php
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

    $empleado = $this->db->query("SELECT e.id_empleado, e.correo, e.telefono_casa, e.telefono_contacto, e.direccion, UPPER(CONCAT_WS(' ', e.primer_nombre, e.segundo_nombre, e.tercer_nombre, e.primer_apellido, e.segundo_apellido, e.apellido_casada)) AS nombre_completo FROM sir_empleado AS e WHERE e.nr = '".$nr_usuario."' ORDER BY primer_nombre");

    if($empleado->num_rows() > 0){
        foreach ($empleado->result() as $fila) {              
           $nombre_completo = trim($fila->nombre_completo);
           $correo = $fila->correo;
           $tel_casa = $fila->telefono_casa;
           $tel_contacto = $fila->telefono_contacto;
           $direccion = $fila->direccion;
        }
    }

    $info_empleado = $this->db->query("SELECT * FROM vyp_informacion_empleado WHERE nr = '".$nr_usuario."'");

    $cuenta_banco = $this->db->query("SELECT * FROM vyp_empleado_cuenta_banco WHERE nr = '".$nr_usuario."' AND estado = 1");

?>
<script type="text/javascript">
	
	function iniciar(){
		<?php if($info_empleado->num_rows() > 0){ 
				foreach ($info_empleado->result() as $fila3) {
			?>
			$('#id_empleado').val('<?php echo $fila3->nr_jefe_inmediato; ?>').trigger('change.select2');
			$('#id_oficina').val('<?php echo $fila3->id_oficina_departamental; ?>').trigger('change.select2');
			$('#id_region').val('<?php echo $fila3->id_region; ?>').trigger('change.select2');
		<?php } } ?>
	}

</script>
<!-- ============================================================== -->
<!-- Inicio de DIV de inicio (ENVOLTURA) -->
<!-- ============================================================== -->
<div class="page-wrapper">
    <div class="container-fluid">


    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0">Profile</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Profile</li>
            </ol>
        </div>
        <div class="col-md-7 col-4 align-self-center">
            <div class="d-flex m-t-10 justify-content-end">
                <div class="d-flex m-r-20 m-l-10 hidden-md-down">
                    <div class="chart-text m-r-10">
                        <h6 class="m-b-0"><small>THIS MONTH</small></h6>
                        <h4 class="m-t-0 text-info">$58,356</h4></div>
                    <div class="spark-chart">
                        <div id="monthchart"></div>
                    </div>
                </div>
                <div class="d-flex m-r-20 m-l-10 hidden-md-down">
                    <div class="chart-text m-r-10">
                        <h6 class="m-b-0"><small>LAST MONTH</small></h6>
                        <h4 class="m-t-0 text-primary">$48,356</h4></div>
                    <div class="spark-chart">
                        <div id="lastmonthchart"></div>
                    </div>
                </div>
                <div class="">
                    <button class="right-side-toggle waves-effect waves-light btn-success btn btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <!-- Row -->
    <div class="row">
        <!-- Column -->
        <div class="col-lg-4 col-xlg-3 col-md-5">
            <div class="card">
                <div class="card-body">
                    <center class="m-t-30">
                    	<span style="font-size: 35px; line-height: 100px; width: 100px; height: 100px;" class="round round-success"><?php echo $inicialUser; ?></span>
                        <h4 class="card-title m-t-10"><?php echo strtoupper($user); ?></h4>

                            	<?php if($info_empleado->num_rows() > 0 && $cuenta_banco->num_rows() > 0){ ?>
                            		<h5 class="m-t-30">Perfil completado <span class="pull-right">100%</span></h5>
                            		<div class="progress">
		                                <div class="progress-bar bg-info" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%; height:6px;"> <span class="sr-only">50% Complete</span> </div>
		                            </div>
                            	<?php }else if($info_empleado->num_rows() > 0 && $cuenta_banco->num_rows() <= 0){ ?>
                            		<h5 class="m-t-30">Perfil completado <span class="pull-right">75%</span></h5>
                            		<div class="progress">
		                                <div class="progress-bar bg-success" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width:75%; height:6px;"> <span class="sr-only">50% Complete</span> </div>
		                            </div>
		                        <?php }else if($info_empleado->num_rows() <= 0 && $cuenta_banco->num_rows() > 0){ ?>
                            		<h5 class="m-t-30">Perfil completado <span class="pull-right">50%</span></h5>
                            		<div class="progress">
		                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:50%; height:6px;"> <span class="sr-only">50% Complete</span> </div>
		                            </div>
                            	<?php }else if($info_empleado->num_rows() <= 0 && $cuenta_banco->num_rows() <= 0){ ?>
                            		<h5 class="m-t-30">Perfil completado <span class="pull-right">25%</span></h5>
                            		<div class="progress">
		                                <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width:25%; height:6px;"> <span class="sr-only">50% Complete</span> </div>
		                            </div>
                            	<?php } ?>

                    </center>
                </div>
                <div>
                    <hr> </div>
                <div class="card-body"><small class="text-muted">Correo institucional </small>
                    <h6><?php echo $correo; ?></h6> <small class="text-muted p-t-30 db">Número(s) de teléfono</small>
                    <h6><span class="mdi mdi-cellphone-android" data-toggle='tooltip' title='Teléfono contacto'></span> <?php echo $tel_contacto; ?><br>
                    	<span class="mdi mdi-phone-classic" data-toggle='tooltip' data-placement="bottom" title='Teléfono casa'></span> <?php echo $tel_casa; ?></h6> <small class="text-muted p-t-30 db">Dirección</small>
                    <h6><?php echo $direccion; ?></h6>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="col-lg-8 col-xlg-9 col-md-7">
            <div class="card">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs profile-tab" role="tablist">
                    <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home" role="tab">Perfil</a> </li>
                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile" role="tab">Cuenta bancaria</a> </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane active" id="home" role="tabpanel">
                        <div class="card-body">

                        	<div class="row">
                                <div class="col-md-10 col-xs-6 b-r"> <strong>Nombre completo</strong>
                                    <br>
                                    <p class="text-muted"><?php echo $nombre_completo; ?></p>
                                </div>
                                <div class="col-md-2 col-xs-6 b-r"> <strong>NR</strong>
                                    <br>
                                    <p class="text-muted"><?php echo $nr_usuario; ?></p>
                                </div>
                            </div>
                            <hr>
                            <?php if($info_empleado->num_rows() <= 0){ ?>
                            <p class="m-t-30 text-danger">Completa tu perfil. La información es requerida para completar las solicitudes de viáticos que efectúes</p>
                            <?php } ?>

                            <?php echo form_open('', array('id' => 'formajax', 'style' => 'margin-top: 0px;', 'class' => 'm-t-40', 'novalidate' => '')); ?>
	                            <input type="hidden" id="nr" name="nr" value="<?php echo $nr_usuario; ?>">

	                            <div class="row">
	                                <div class="form-group col-lg-6"> 
	                                    <h5>Empleado: <span class="text-danger">*</span></h5>                           
	                                    <select id="id_empleado" name="id_empleado" class="select2" style="width: 100%" required="">
	                                        <option value="">[Elija el empleado]</option>
	                                        <?php 
	                                            $otro_empleado = $this->db->query("SELECT e.id_empleado, e.nr, UPPER(CONCAT_WS(' ', e.primer_nombre, e.segundo_nombre, e.tercer_nombre, e.primer_apellido, e.segundo_apellido, e.apellido_casada)) AS nombre_completo FROM sir_empleado AS e WHERE id_estado = '00001' AND nr <> '".$nr_usuario."' ORDER BY e.primer_nombre, e.segundo_nombre, e.tercer_nombre, e.primer_apellido, e.segundo_apellido, e.apellido_casada");
	                                            if($otro_empleado->num_rows() > 0){
	                                                foreach ($otro_empleado->result() as $fila) {              
	                                                   echo '<option class="m-l-50" value="'.$fila->nr.'">'.$fila->nombre_completo.'</option>';
	                                                }
	                                            }
	                                        ?>
	                                    </select>
	                                    <div class="help-block"></div>
	                                </div>
	                                <div class="form-group col-lg-6"> 
	                                    <h5>Oficina departamental: <span class="text-danger">*</span></h5>
	                                    <select id="id_oficina" name="id_oficina" class="select2" style="width: 100%" required="">
	                                        <option value="">[Elija oficina en que labora]</option>
	                                        <?php 
	                                            $oficina = $this->db->query("SELECT * FROM vyp_oficinas");
	                                            if($oficina->num_rows() > 0){
	                                                foreach ($oficina->result() as $fila) {              
	                                                   echo '<option class="m-l-50" value="'.$fila->id_oficina.'">'.$fila->nombre_oficina.'</option>';
	                                                }
	                                            }
	                                        ?>
	                                    </select>
	                                    <div class="help-block"></div>
	                                </div>
	                            </div>

	                            <div class="row">
	                                <div class="form-group col-lg-6"> 
	                                    <h5>Región o zona: <span class="text-danger">*</span></h5>
	                                    <select id="id_region" name="id_region" class="select2" style="width: 100%" required="">
	                                        <option value="">[Elija zona laboral]</option>
	                                        <?php 
	                                            $regional = $this->db->query("SELECT * FROM org_pagaduria");
	                                            if($regional->num_rows() > 0){
	                                                foreach ($regional->result() as $fila) {              
	                                                   echo '<option class="m-l-50" value="'.$fila->id_pagaduria.'">'.$fila->pagaduria.'</option>';
	                                                }
	                                            }
	                                        ?>
	                                    </select>
	                                    <div class="help-block"></div>
	                                </div>
	                            </div>
	                            
	                            <div align="right" id="btnadd">
	                                <button type="submit" class="btn waves-effect waves-light btn-info"><i class="mdi mdi-pencil"></i> Actualizar información</button>
	                            </div>

	                        <?php echo form_close(); ?>

                        </div>
                    </div>
                    <!--second tab-->
                    <div class="tab-pane" id="profile" role="tabpanel">
                        <div class="card-body">
                            
                            
                            <h4 class="font-medium m-t-30">Skill Set</h4>
                            <hr>
                            <?php echo form_open('', array('id' => 'formajax2', 'style' => 'margin-top: 0px;', 'class' => 'm-t-40', 'novalidate' => '')); ?>
	                            <input type="hidden" id="nr" name="nr" value="<?php echo $nr_usuario; ?>">

	                            <div class="row">
	                                <div class="form-group col-lg-6"> 
	                                    <h5>Empleado: <span class="text-danger">*</span></h5>                           
	                                    <select id="id_empleado" name="id_empleado" class="select" style="width: 100%" required="">
	                                        <option value="">[Elija el empleado]</option>
	                                        <?php 
	                                            $empleado = $this->db->query("SELECT e.id_empleado, UPPER(CONCAT_WS(' ', e.primer_nombre, e.segundo_nombre, e.tercer_nombre, e.primer_apellido, e.segundo_apellido, e.apellido_casada)) AS nombre_completo FROM sir_empleado AS e  ORDER BY primer_nombre, segundo_nombre, primer_apellido, segundo_apellido");
	                                            if($empleado->num_rows() > 0){
	                                                foreach ($empleado->result() as $fila) {              
	                                                   echo '<option class="m-l-50" value="'.$fila->id_empleado.'">'.$fila->nombre_completo.'</option>';
	                                                }
	                                            }
	                                        ?>
	                                    </select>
	                                    <div class="help-block"></div>
	                                </div>
	                                <div class="form-group col-lg-6"> 
	                                    <h5>Oficina departamental: <span class="text-danger">*</span></h5>
	                                    <select id="id_oficina" name="id_oficina" class="select2" style="width: 100%" required="">
	                                        <option value="">[Elija oficina en que labora]</option>
	                                        <?php 
	                                            $oficina = $this->db->query("SELECT * FROM vyp_oficinas");
	                                            if($oficina->num_rows() > 0){
	                                                foreach ($oficina->result() as $fila) {              
	                                                   echo '<option class="m-l-50" value="'.$fila->id_oficina.'">'.$fila->nombre_oficina.'</option>';
	                                                }
	                                            }
	                                        ?>
	                                    </select>
	                                    <div class="help-block"></div>
	                                </div>
	                            </div>

	                            <div class="row">
	                                <div class="form-group col-lg-6"> 
	                                    <h5>Región o zona: <span class="text-danger">*</span></h5>
	                                    <select id="id_region" name="id_region" class="select2" style="width: 100%" required="">
	                                        <option value="">[Elija zona laboral]</option>
	                                        <?php 
	                                            $regional = $this->db->query("SELECT * FROM org_pagaduria");
	                                            if($regional->num_rows() > 0){
	                                                foreach ($regional->result() as $fila) {              
	                                                   echo '<option class="m-l-50" value="'.$fila->id_pagaduria.'">'.$fila->pagaduria.'</option>';
	                                                }
	                                            }
	                                        ?>
	                                    </select>
	                                    <div class="help-block"></div>
	                                </div>
	                            </div>

	                            <div class="row">
	                                <div class="form-group col-lg-6">
	                                    <h5>Nombre: <span class="text-danger">*</span></h5>
	                                    <div class="controls">
	                                        <input type="text" id="nombre" name="nombre" class="form-control" required="" data-validation-required-message="Este campo es requerido">
	                                        <div class="help-block"></div>
	                                    </div>
	                                </div>

	                                <div class="form-group col-lg-6">
	                                    <h5>Características: </h5>
	                                    <div class="controls">
	                                        <input type="text" id="caracteristicas" name="caracteristicas" class="form-control">
	                                        <div class="help-block"></div>
	                                    </div>
	                                </div>
	                            </div>
	                            
	                            <div align="right" id="btnadd">
	                                <button type="submit" class="btn waves-effect waves-light btn-info"><i class="mdi mdi-pencil"></i> Actualizar información</button>
	                            </div>

	                        <?php echo form_close(); ?>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
    </div>
    <!-- Row -->
    <!-- ============================================================== -->
    <!-- End PAge Content -->
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
            url: "<?php echo site_url(); ?>/cuenta/perfil/info_empleado",
            type: "post",
            dataType: "html",
            data: formData,
            cache: false,
            contentType: false,
            processData: false
        })
        .done(function(res){
            if(res == "exito"){
                swal({ title: "¡Registro exitoso!", type: "success", showConfirmButton: true });
            }else{
                swal({ title: "¡Ups! Error", text: "Intentalo nuevamente.", type: "error", showConfirmButton: true });
            }
        });
            
    });


    $("#formajax2").on("submit", function(e){
        e.preventDefault();
        var f = $(this);
        var formData = new FormData(document.getElementById("formajax2"));
        formData.append("dato", "valor");
        
        $.ajax({
            url: "<?php echo site_url(); ?>/configuraciones/bancos/gestionar_bancos",
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
                tablabancos();
            }else{
                swal({ title: "¡Ups! Error", text: "Intentalo nuevamente.", type: "error", showConfirmButton: true });
            }
        });
            
    });
});

</script>