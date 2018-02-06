<?php
    $user = $this->session->userdata('usuario_viatico');
    if(empty($user)){
        header("Location: ".site_url()."/login");
        exit();
    }


    $pos = strpos($user, ".")+1;
    $inicialUser = strtoupper(substr($user,0,1).substr($user, $pos,1));

    setlocale(LC_ALL,"es_ES");
    date_default_timezone_set('America/El_Salvador');
?>


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
    

    <script src="<?php echo base_url(); ?>assets/js/jquery-3.2.1.min.js"></script>


    <title>SIAMRECAD</title>
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url(); ?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/plugins/wizard/steps.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>assets/plugins/toast-master/css/jquery.toast.css" rel="stylesheet">
    <!-- Cropper CSS -->
    <link href="<?php echo base_url(); ?>assets/plugins/cropper/cropper.min.css" rel="stylesheet">
    <!-- chartist CSS -->
    <link href="<?php echo base_url(); ?>assets/plugins/chartist-js/dist/chartist.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/plugins/chartist-js/dist/chartist-init.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/plugins/footable/css/footable.core.css" rel="stylesheet">
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
<script>
   //var barra = setTimeout(function(){ $("#clic").click(); }, 500);
    var minutos = 10;
    var warning = 9.90;
    var danger = 3;

    $(document).ready(function() {
        $("#password_val").val("");
        if(hora() >= 60*minutos || localStorage["expira"] == "expirada"){
            cerrar_sesion(0);
        }
    });

    function cambiar_hora_expira(s){
        if(localStorage["expira"] == "expirada"){
            $("#contador").text("Expira: expirada");
        }else{
            s = (60*minutos) - s;
            var secs = s % 60;
            s = (s - secs) / 60;
            var mins = s % 60;
            var hrs = (s - mins) / 60;
            horas = addZ(mins) + ':' + addZ(secs);

            $("#contador").text("Expira: "+horas);
        }
    }

    window.onbeforeunload = function() {
        //localStorage["expira"] = 0;
    }

    function hora(){
        var c = new Date();
        var a = new Date(c.getFullYear(),c.getMonth(),c.getDate(),c.getHours(),c.getMinutes(),c.getSeconds());
        var b = new Date(localStorage["expira"]);
        //La diferencia se da en milisegundos así que debes dividir entre 1000
        var result = ((a-b)/1000);
        cambiar_hora_expira(result);
        return result; // resultado 5;;
    }

    function addZ(n) {
        return (n<10? '0':'') + n;
    }

    var iniciar_conteo = (function(){
        var condicion;
        var moviendo= false;
        document.onmousemove = function(){
            moviendo= true;
        };
        setInterval (function() {
            if (!moviendo || localStorage["expira"] == "expirada") {
                // No ha habido movimiento desde hace un segundo, aquí tu codigo
                condicion = ((60*minutos)-hora())
                if(hora() >= 60*minutos){
                    cerrar_sesion(1000);
                }
                if(localStorage["expira"] == "expirada"){
                    cerrar_sesion(0);
                }
                if(condicion < (warning*60) && condicion > (danger*60)){
                    $("#initial_user").removeClass("text-danger animacion_nueva");
                    $("#initial_user").addClass("text-warning");
                    $("#initial_user").show(0);
                }
                if(condicion <= (danger*60)){
                    $("#initial_user").removeClass("text-warning");
                    $("#initial_user").addClass("text-danger animacion_nueva");
                    $("#initial_user").show(0);
                }

            } else {
                moviendo=false;
                var c = new Date();
                localStorage["expira"] = new Date(c.getFullYear(),c.getMonth(),c.getDate(),c.getHours(),c.getMinutes(),c.getSeconds());
                hora();
                $("#initial_user").hide(0);
            }
       }, 1000); // Cada segundo, pon el valor que quieras.
    })()

    function cerrar_sesion(t){
        $("#congelar").fadeIn(t);
        $("#main-wrapper").fadeOut(t);
        localStorage["expira"] = "expirada";
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

    function verificar_usuario2(){
        var usuario = $("#ususario_val").val();
        var password = $("#password_val").val();

        jugador = document.getElementById('jugador');

        ajax = objetoAjax();
        ajax.open("POST", "<?php echo site_url(); ?>/login/verificar_usuario2", true);
        ajax.onreadystatechange = function() {
            if (ajax.readyState == 4){
                jugador.value = (ajax.responseText);
                if(jugador.value == "exito"){
                    continuar_sesion();
                }else{
                    swal({ title: "¡Error!", text: "la contraseña no es válida", type: "warning", showConfirmButton: true });
                    $("#password_val").val("");
                }
            }
        }

        ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
        ajax.send("&usuario="+usuario+"&password="+password)
    }

    function continuar_sesion(){
        $("#congelar").fadeOut(1000);
        $("#main-wrapper").fadeIn(1000);
        var c = new Date();
        localStorage["expira"] = new Date(c.getFullYear(),c.getMonth(),c.getDate(),c.getHours(),c.getMinutes(),c.getSeconds());
    }

    function esEnter(e) {
        if (e.keyCode == 13) {
            $("#btnClickUser").click();
        }
    }

</script>
<style>
.animacion_nueva {
    animation : scales 4.0s ease infinite;
  -webkit-animation: scales 1.9s ease-in infinite alternate;
  -moz-animation: scales 1.9s ease-in infinite alternate;
  animation: scales 1.9s ease-in infinite alternate;
}
@-moz-keyframes scales {
  from {
    -webkit-transform: scale(0.8);
    -moz-transform: scale(0.8);
    transform: scale(0.8);
  }
  to {
    -webkit-transform: scale(1.1);
    -moz-transform: scale(1.1);
    transform: scale(1.1);
  }
}
@-webkit-keyframes scales {
  from {
    -webkit-transform: scale(1.0);
    -moz-transform: scale(1.0);
    transform: scale(1.0);
  }
  to {
    -webkit-transform: scale(1.2);
    -moz-transform: scale(1.2);
    transform: scale(1.2);
  }
}
@-o-keyframes scales {
  from {
    -webkit-transform: scale(1.0);
    -moz-transform: scale(1.0);
    transform: scale(1.0);
  }
  to {
    -webkit-transform: scale(1.2);
    -moz-transform: scale(1.2);
    transform: scale(1.2);
  }
}
@keyframes scales {
  from {
    -webkit-transform: scale(1.0);
    -moz-transform: scale(1.0);
    transform: scale(1.0);
  }
  to {
    -webkit-transform: scale(1.2);
    -moz-transform: scale(1.2);
    transform: scale(1.2);
  }
}

    </style>





<body class="fix-header fix-sidebar card-no-border mini-sidebar" onload="iniciar();">

    <!-- ============================================================== -->
    <!-- Icono de cargando página... -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>

<input type="hidden" name="jugador" id="jugador">
<section id="congelar" style="display: none;">
    <div class="login-register" style="background-image: url(<?php echo base_url()."assets/images/portadas/seguridad7.jpg"; ?>); background-color: rgb(238, 245, 249);" >
        <div class="login-box card">
            <div class="card-body" style="z-index: 999;">
                <div class="form-group">
                  <div class="col-xs-12 text-center">
                    <div class="user-thumb text-center">
                        <h3 class="text-warning"><span class="mdi mdi-information"></span> La sesión ha expirado</h3>
                        <h4 style="font-size: 70px; margin-bottom: 0;" class="text-info mdi mdi-account"></h4>
                        <h4><?php echo ucwords(strtolower($this->session->userdata('nombre_usuario_viatico'))); ?></h4>
                    </div>
                  </div>
                </div>
                <input type="hidden" name="ususario_val" id="ususario_val" value="<?php echo $this->session->userdata('usuario_viatico') ?>">
                <div class="form-group ">
                  <div class="col-xs-12">
                    <input onkeypress="esEnter(event);" class="form-control" type="password" id="password_val" name="password_val" required="" placeholder="password">
                  </div>
                </div>
                <div class="form-group text-center">
                  <div class="col-xs-12">
                    <button id="btnClickUser" class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" onclick="verificar_usuario2()" type="button">Continuar</button>
                  </div>
                </div>
            </div>
          </div>
    </div>

</section>


<div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Barra superior -->
        <!-- ============================================================== -->
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.html">
                        <!-- Logo icono --><b>
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <img src="<?php echo base_url(); ?>assets/images/logo_min.png" height='45px' alt="homepage" class="dark-logo" />
                            <!-- Light Logo icon -->
                            <img src="<?php echo base_url(); ?>assets/images/logo_min.png" height='45px' alt="homepage" class="light-logo" />
                        </b>
                        <!--Fin Logo icon -->
                        <!-- Logo text --><span>
                         <!-- dark Logo text -->
                         <img src="<?php echo base_url(); ?>assets/images/logo_text.png" height='15px;' alt="homepage" class="dark-logo" />
                         <!-- Light Logo text -->
                         <img src="<?php echo base_url(); ?>assets/images/logo_text.png" style="margin-left: 10px; margin-top: 10px;"  height='15px;' class="light-logo" alt="homepage" /></span> </a>
                </div>
                <!-- ============================================================== -->
                <!-- Fin Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav mr-auto mt-md-0">
                        <!-- This is  -->
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
                        <li class="nav-item"> <a id="clic" class="nav-link sidebartoggler hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                        <!-- ============================================================== -->
                        <!-- End Messages -->
                        <!-- ============================================================== -->
                    </ul>
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav my-lg-0">
                        <!-- ============================================================== -->
                        <!-- Comment -->
                        <!-- ============================================================== -->
                     <li class="nav-item"> <a id="initial_user" style="display: none;" class="nav-link waves-effect waves-dark" href="javascript:void(0)"><span id="contador"></span></a> </li>

                        <?php
                            /*$notificaciones = 0;

                            $notificacion_rutas = $this->db->query("SELECT * FROM vyp_rutas WHERE estado_vyp_rutas = 0");
                            $notificacion_rutas = $notificacion_rutas->num_rows();
                            if($notificacion_rutas > 0){
                                $notificaciones++;
                            }*/


                        ?>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i style="font-size: 25px;" class="mdi mdi-bell"></i>
                                <?php //if($notificaciones > 0){ ?>
                                <span class="label label-danger" style=" font-size: 10px; position: absolute; top: 9px; right: 5px; border-radius: 50%; padding: 3px 8px;"><?php //echo $notificaciones; ?></span>
                                <?php //} ?>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right mailbox scale-up">
                                <ul>
                                    <li>
                                        <div class="drop-title">Notifications</div>
                                    </li>
                                    <li>
                                        <div class="message-center">
                                            <!-- Message -->
                                            <a href="<?php echo site_url(); ?>/configuraciones/rutas">
                                                <div class="btn btn-danger btn-circle"><i style="font-size: 20px;" class="mdi mdi-map"></i></div>
                                                <div class="mail-contnet">
                                                    <h5>Revisión de rutas <span class="label label-danger"><?php //echo $notificacion_rutas; ?></span></h5>
                                                    <span class="mail-desc">Clic para revisar rutas pendientes</span>
                                                </div>
                                            </a>
                                        </div>
                                    </li>
                                    <li>
                                        <a class="nav-link text-center" href="javascript:void(0);"> <strong>Check all notifications</strong> <i class="fa fa-angle-right"></i> </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- End Comment -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- Profile -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="round round-success"><?php echo $inicialUser; ?></span></a>
                            <div class="dropdown-menu dropdown-menu-right scale-up">
                                <ul class="dropdown-user">
                                    <li>
                                        <div class="dw-user-box">
                                            <div class="u-text">
                                                <h4><?php echo $this->session->userdata('nombre_usuario_viatico'); ?></h4>
                                                <p class="text-muted" align="right"><a href="<?php echo site_url().'/cuenta/perfil'; ?>" class="btn btn-rounded btn-danger btn-sm">Ver Perfil</a></p>
                                            </div>
                                        </div>
                                    </li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="<?php echo site_url().'/cuenta/perfil'; ?>"><i class="ti-user"></i> Mi Perfil</a></li>
                                    <li><a href="#"><i class="ti-email"></i> Inbox</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="#"><i class="ti-settings"></i> Account Setting</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="<?php echo site_url(); ?>/cerrar_sesion"><i class="fa fa-power-off"></i> Salir</a></li>
                                </ul>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- End Profile -->
                        <!-- ============================================================== -->
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="nav-small-cap text-center">MENÚ</li>


                        <li class="nav-devider" style="margin:5px;"></li>
                        <?php
                        $id_sistema=15;
                            $modulos = $this->db->query("SELECT * FROM org_modulo WHERE id_sistema = ".$id_sistema." AND (dependencia = '' OR dependencia = 0 OR dependencia IS NULL) ORDER BY orden");
                            if($modulos->num_rows() > 0){
                                foreach ($modulos->result() as $fila) {
                        ?>
                            <li> <a class="has-arrow waves-effect waves-dark" href="<?php echo $fila->url_modulo; ?>" aria-expanded="false"><i class="<?php echo $fila->img_modulo; ?>"></i><span class="hide-menu"> <?php echo $fila->nombre_modulo; ?></span></a>
                                <?php
                                    $modulos2 = $this->db->query("SELECT * FROM org_modulo WHERE id_sistema = $id_sistema AND dependencia = ".$fila->id_modulo." ORDER BY orden");
                                    if($modulos2->num_rows() > 0){
                                        echo '<ul aria-expanded="false" class="collapse">';
                                        foreach ($modulos2->result() as $fila2) {
                                ?>
                                    <li><a href="<?php echo site_url()."/"; ?><?php echo $fila2->url_modulo."/index/".$fila2->id_modulo; ?>"><span class="<?php echo $fila2->img_modulo; ?>"></span> <?php echo $fila2->nombre_modulo; ?></a></li>
                                <?php
                                        }
                                        echo "</ul>";
                                    }
                                ?>
                            </li>
                        <?php
                                }
                            }
                        ?>


                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
            <!-- Bottom points-->
            <div class="sidebar-footer">
                <!-- item--><a href="" class="link" data-toggle="tooltip" title="Settings"><i class="ti-settings"></i></a>
                <!-- item--><a href="" class="link" data-toggle="tooltip" title="Email"><i class="mdi mdi-gmail"></i></a>
                <!-- item--><a href="" class="link" data-toggle="tooltip" title="Logout"><i class="mdi mdi-power"></i></a> </div>
            <!-- End Bottom points-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
