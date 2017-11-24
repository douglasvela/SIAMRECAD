<?php
    $user = $this->session->userdata('usuario_viatico');
    if(empty($user)){
        header("Location: ".site_url()."/login");
        exit();
    }
    

    $pos = strpos($user, ".")+1;
    $inicialUser = strtoupper(substr($user,0,1).substr($user, $pos,1));    
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
<script>
   var barra = setTimeout(function(){ $("#clic").click(); }, 500);
    var minutos = 0.15;
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
        var a = new Date(c.getFullYear()+"-"+c.getMonth()+"-"+c.getDate()+" "+c.getHours()+":"+c.getMinutes()+":"+c.getSeconds());
        var b = new Date(localStorage["expira"]);
        //La diferencia se da en milisegundos así que debes dividir entre 1000
        var result = ((a-b)/1000);
        cambiar_hora_expira(result);
        return result; // resultado 5;;
    }

    function addZ(n) {
        return (n<10? '0':'') + n;
    }

    var otra = (function(){
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
                localStorage["expira"] = new Date(c.getFullYear()+"-"+c.getMonth()+"-"+c.getDate()+" "+c.getHours()+":"+c.getMinutes()+":"+c.getSeconds());
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
                alert(jugador.value);
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
        localStorage["expira"] = new Date(c.getFullYear()+"-"+c.getMonth()+"-"+c.getDate()+" "+c.getHours()+":"+c.getMinutes()+":"+c.getSeconds());
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





<body class="fix-header fix-sidebar card-no-border logo-center" onload="iniciar();">

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

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-message"></i>
                                <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right mailbox scale-up">
                                <ul>
                                    <li>
                                        <div class="drop-title">Notifications</div>
                                    </li>
                                    <li>
                                        <div class="message-center">
                                            <!-- Message -->
                                            <a href="#">
                                                <div class="btn btn-danger btn-circle"><i class="fa fa-link"></i></div>
                                                <div class="mail-contnet">
                                                    <h5>Luanch Admin</h5> <span class="mail-desc">Just see the my new admin!</span> <span class="time">9:30 AM</span> </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="#">
                                                <div class="btn btn-success btn-circle"><i class="ti-calendar"></i></div>
                                                <div class="mail-contnet">
                                                    <h5>Event today</h5> <span class="mail-desc">Just a reminder that you have event</span> <span class="time">9:10 AM</span> </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="#">
                                                <div class="btn btn-info btn-circle"><i class="ti-settings"></i></div>
                                                <div class="mail-contnet">
                                                    <h5>Settings</h5> <span class="mail-desc">You can customize this template as you want</span> <span class="time">9:08 AM</span> </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="#">
                                                <div class="btn btn-primary btn-circle"><i class="ti-user"></i></div>
                                                <div class="mail-contnet">
                                                    <h5>Pavan kumar</h5> <span class="mail-desc">Just see the my admin!</span> <span class="time">9:02 AM</span> </div>
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
                                                <p class="text-muted" align="right"><a href="profile.html" class="btn btn-rounded btn-danger btn-sm">Ver Perfil</a></p>
                                            </div>
                                        </div>
                                    </li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="#"><i class="ti-user"></i> Mi Perfil</a></li>
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
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-settings"></i><span class="hide-menu">Configuraciones </span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="<?php echo site_url(); ?>/configuraciones/bancos"><span class="mdi mdi-label"></span> Bancos</a></li>
                                <li><a href="<?php echo site_url(); ?>/configuraciones/horarios"><span class="mdi mdi-label"></span> Horarios de viáticos</a></li>
                                <li><a href="<?php echo site_url(); ?>/configuraciones/oficinas"><span class="mdi mdi-label"></span> Oficinas del MTPS</a></li>
                                <li><a href="<?php echo site_url(); ?>/configuraciones/rutas"><span class="mdi mdi-label"></span> Gestion de Rutas</a></li>
                                <li class="nav-devider" style="margin:1px;"></li>
                            </ul>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-bus"></i><span class="hide-menu">Viáticos y pasajes</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="<?php echo site_url(); ?>/viaticos"><span class="mdi mdi-label"></span> Crear solicitud</a></li>
                                <li><a href="<?php echo site_url(); ?>/justificacion"><span class="mdi mdi-label"></span> Crear justificación</a></li>
                                <li><a href="<?php echo site_url(); ?>/aprobacion"><span class="mdi mdi-label"></span> Solicitudes de viáticos</a></li>
                                <li class="nav-devider" style="margin:1px;"></li>
                            </ul>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-account-multiple"></i><span class="hide-menu">Usuarios</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="<?php echo site_url(); ?>/usuarios/usuarios"><span class="mdi mdi-label"></span> Usuarios</a></li>
                                <li><a href="<?php echo site_url(); ?>/cargos/cargos"><span class="mdi mdi-label"></span> Cargos</a></li>
                            </ul>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-email"></i><span class="hide-menu">Inbox</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="app-email.html">Mailbox</a></li>
                                <li><a href="app-email-detail.html">Mailbox Detail</a></li>
                                <li><a href="app-compose.html">Compose Mail</a></li>
                            </ul>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-chart-bubble"></i><span class="hide-menu">Ui Elements</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="ui-cards.html">Cards</a></li>
                                <li><a href="ui-user-card.html">User Cards</a></li>
                                <li><a href="ui-buttons.html">Buttons</a></li>
                                <li><a href="ui-modals.html">Modals</a></li>
                                <li><a href="ui-tab.html">Tab</a></li>
                                <li><a href="ui-tooltip-popover.html">Tooltip &amp; Popover</a></li>
                                <li><a href="ui-tooltip-stylish.html">Tooltip stylish</a></li>
                                <li><a href="ui-sweetalert.html">Sweet Alert</a></li>
                                <li><a href="ui-notification.html">Notification</a></li>
                                <li><a href="ui-progressbar.html">Progressbar</a></li>
                                <li><a href="ui-nestable.html">Nestable</a></li>
                                <li><a href="ui-range-slider.html">Range slider</a></li>
                                <li><a href="ui-timeline.html">Timeline</a></li>
                                <li><a href="ui-typography.html">Typography</a></li>
                                <li><a href="ui-horizontal-timeline.html">Horizontal Timeline</a></li>
                                <li><a href="ui-session-timeout.html">Session Timeout</a></li>
                                <li><a href="ui-session-ideal-timeout.html">Session Ideal Timeout</a></li>
                                <li><a href="ui-bootstrap.html">Bootstrap Ui</a></li>
                                <li><a href="ui-breadcrumb.html">Breadcrumb</a></li>
                                <li><a href="ui-bootstrap-switch.html">Bootstrap Switch</a></li>
                                <li><a href="ui-list-media.html">List Media</a></li>
                                <li><a href="ui-ribbons.html">Ribbons</a></li>
                                <li><a href="ui-grid.html">Grid</a></li>
                                <li><a href="ui-carousel.html">Carousel</a></li>
                                <li><a href="ui-date-paginator.html">Date-paginator</a></li>
                                <li><a href="ui-dragable-portlet.html">Dragable Portlet</a></li>
                            </ul>
                        </li>
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
