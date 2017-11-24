<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url(); ?>assets/images/logo_min.png">
    <title>Login - Pago de Viáticos</title>
    <!-- Bootstrap Core CSS -->
  <script src="<?php echo base_url(); ?>assets/js/jquery-3.2.1.min.js"></script>
    <!--nestable CSS -->
    <link href="<?php echo base_url(); ?>assets/plugins/nestable/nestable.css" rel="stylesheet" type="text/css" />
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url(); ?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/plugins/wizard/steps.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>assets/plugins/toast-master/css/jquery.toast.css" rel="stylesheet">
    <!-- chartist CSS -->
    <link href="<?php echo base_url(); ?>assets/plugins/chartist-js/dist/chartist.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/plugins/chartist-js/dist/chartist-init.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet">
    <!-- Page plugins css -->
    <link href="<?php echo base_url(); ?>assets/plugins/clockpicker/dist/jquery-clockpicker.min.css" rel="stylesheet">
    <!-- Color picker plugins css -->
    <link href="<?php echo base_url(); ?>assets/plugins/jquery-asColorPicker-master/css/asColorPicker.css" rel="stylesheet">
    <!-- Date picker plugins css -->
    <link href="<?php echo base_url(); ?>assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
    <!-- Select plugins css -->
    <link href="<?php echo base_url(); ?>assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/plugins/switchery/dist/switchery.min.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>assets/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>assets/plugins/multiselect/css/multi-select.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/plugins/icheck/skins/all.css" rel="stylesheet">
    <!-- Daterange picker plugins css -->
    <link href="<?php echo base_url(); ?>assets/plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <!--This page css - Morris CSS -->
    <link href="<?php echo base_url(); ?>assets/plugins/c3-master/c3.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="<?php echo base_url(); ?>assets/css/colors/blue.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body class="fix-header fix-sidebar card-no-border logo-center">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->

    <!-- ============================================================== -->
    <!-- Barra Superior -->
    <!-- ============================================================== -->
    <header class="topbar">
        <nav class="navbar top-navbar navbar-light">
            <!-- ============================================================== -->
            <!-- Content -->
            <!-- ============================================================== -->
            <div class="navbar-header" align="center">
                <li style="margin-left: 10px;" class="navbar-brand text-white" href="index.html"><b><i class="icon-login"></i> &emsp;Inicio de Sesión</b></li>
            </div>
            <!-- ============================================================== -->
            <!-- End Content -->
            <!-- ============================================================== -->
        </nav>
    </header>
    <!-- ============================================================== -->
    <!-- End Barra Superior -->
    <!-- ============================================================== --> 


    <section id="wrapper" class="login-register img-responsive login-sidebar" style="background-image:url(<?php echo base_url(); ?>assets/images/portadas/viaticos2.jpg);">
    
  <div class="login-box card">
    <div class="card-body">
     <?php echo form_open('', array('id' => 'loginform', 'style' => 'margin-top: 0px;', 'class' => 'form-horizontal form-material')); ?>
        <a href="javascript:void(0)" class="text-center db"><img width="230px;" src="<?php echo base_url(); ?>assets/images/logo_completo.png" alt="Home" /></a>  
        
       <div class="form-group m-t-40">
          <div class="col-xs-12">
            <input class="form-control" type="text" name="usuario" required="" placeholder="Usuario">
          </div>
        </div>
        <div class="form-group">
          <div class="col-xs-12">
            <input class="form-control" type="password" name="password" required="" placeholder="Contraseña">
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-12">
            <a href="javascript:void(0)" id="to-recover" class="text-dark pull-right"><i class="fa fa-lock m-r-5"></i> ¿Olvidaste tu contraseña?</a> </div>
        </div>
        <div class="form-group text-center m-t-20">
          <div class="col-xs-12">
            <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Ingresar</button>
          </div>
        </div>
        <div class="form-group m-b-0">
          <div class="col-sm-12 text-center">
            <p>¿No tienes una cuenta? <a href="register" class="text-primary m-l-5"><b>Regístrate</b></a></p>
          </div>
        </div>
      </form>
      <form class="form-horizontal" id="recoverform" action="index.html">
        <div class="form-group ">
          <div class="col-xs-12">
            <h3>Recover Password</h3>
            <p class="text-muted">Enter your Email and instructions will be sent to you! </p>
          </div>
        </div>
        <div class="form-group ">
          <div class="col-xs-12">
            <input class="form-control" type="text" required="" placeholder="Email">
          </div>
        </div>
        <div class="form-group text-center m-t-20">
          <div class="col-xs-12">
            <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Reset</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</section>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->



<script>

$(function(){     
    $("#loginform").on("submit", function(e){
        e.preventDefault();
        var f = $(this);
        var formData = new FormData(document.getElementById("loginform"));
        formData.append("dato", "valor");
        
        $.ajax({
            url: "<?php echo site_url(); ?>/login/verificar_usuario",
            type: "post",
            dataType: "html",
            data: formData,
            cache: false,
            contentType: false,
            processData: false
        })
        .done(function(res){
          //  alert (res);
            if(res == "exito"){
                var c = new Date();
                localStorage["expira"] = c.getFullYear()+"-"+c.getMonth()+"-"+c.getDate()+" "+c.getHours()+":"+c.getMinutes()+":"+c.getSeconds();
                location.href = "<?php echo base_url(); ?>";
            }else if(res == "usuario"){
                swal({ title: "¡Usuario no existe!", text: "El usuario que intenta identificar no exíste.", type: "warning", showConfirmButton: true });
            }else if(res == "estado"){
                swal({ title: "¡Cuenta inactiva!", text: "La cuenta de este usuario esta deshabilitada.", type: "warning", showConfirmButton: true });
            }else if(res == "password"){
                swal({ title: "¡Clave no válida!", text: "La clave ingresada no es válida.", type: "warning", showConfirmButton: true });
            }else if(res == "activeDirectory"){
                swal({ title: "¡No encontrado en Active Directory!", text: "Usurio o contraseña no encontrado en Active Directory.", type: "warning", showConfirmButton: true });
            }else if(res == "sesion"){
                swal({ title: "¡Ocurrió un error!", text: "Falló el inicio de sesión. Por favor intentelo nuevamente.", type: "error", showConfirmButton: true });
            }else{
                swal({ title: "¡Ocurrió un error!", text: "El usuario o contraseña son incorrectos, o no se logró conectar a Active Directory.", type: "error", showConfirmButton: true });
            }
        });
            
    });
});

</script>