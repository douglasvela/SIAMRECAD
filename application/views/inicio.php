<script type="text/javascript">
	function iniciar(){}

	function OpenWindowWithPost(url, params){
	    var form = document.createElement("form");
	    form.setAttribute("method", "post");
	    form.setAttribute("action", url);
	    form.setAttribute("target", "_SELF");

	    for (var i in params) {
	        if (params.hasOwnProperty(i)) {
	            var input = document.createElement('input');
	            input.type = 'hidden';
	            input.name = i;
	            input.value = params[i];
	            form.appendChild(input);
	        }
	    }
	    document.body.appendChild(form);
	    form.submit();
	    document.body.removeChild(form);
	}

	function redireccionar_solicitud(estado){
        var param = { 'estado' : estado };
        OpenWindowWithPost("<?php echo site_url(); ?>/viaticos/solicitud_viatico", param);
	}

	function redireccionar_pasaje(estado){
        var param = { 'estado' : estado };
        OpenWindowWithPost("<?php echo site_url(); ?>/pasajes/pasaje", param);
	}

</script>
<div class="page-wrapper">
    <div class="container-fluid">
    	<div class="row page-titles">
           <div class="align-self-center" align="center">
               <h3 class="text-themecolor m-b-0 m-t-0">Indicadores de solicitud de viáticos</h3>
           </div>
       	</div>

       	<div class="row">
	    	<?php if($tiene_permiso_autorizar){ ?>
	        <!-- Column -->
	        <a class="col-md-6 col-lg-3 col-xlg-3" href="<?=site_url().'/viaticos/observaciones'?>">
	            <div class="card card-inverse card-dark">
	                <div class="box text-center">
	                    <h1 class="font-light text-white"><?php echo $solicitudes_para_autorizar; ?></h1>
	                    <h5 class="text-white">Solicitudes para autorizar</h5>
	                </div>
	            </div>
	        </a>
	        <!-- Column -->
	    	<?php } ?>
	        <!-- Column -->
	        <div class="col-md-6 col-lg-3 col-xlg-3">
	            <a class="card card-inverse card-info" onclick="redireccionar_solicitud(2);" href="#!">
	                <div class="box bg-info text-center">
	                    <h1 class="font-light text-white"><?php echo $solicitudes_en_revision; ?></h1>
	                    <h5 class="text-white">Solicitudes en revisión</h5>
	                </div>
	            </a>
	        </div>
	        <!-- Column -->
	        <a class="col-md-6 col-lg-3 col-xlg-3"  onclick="redireccionar_solicitud(3);" href="#!">
	            <div class="card card-primary card-inverse">
	                <div class="box text-center">
	                    <h1 class="font-light text-white"><?php echo $solicitudes_observadas; ?></h1>
	                    <h5 class="text-white">Solicitudes observadas</h5>
	                </div>
	            </div>
	        </a>
	        <!-- Column -->
	        <a class="col-md-6 col-lg-3 col-xlg-3" onclick="redireccionar_solicitud(5);" href="#!">
	            <div class="card card-inverse card-success">
	                <div class="box text-center">
	                    <h1 class="font-light text-white"><?php echo $solicitudes_pagadas; ?></h1>
	                    <h5 class="text-white">Solicitudes pagadas</h5>
	                </div>
	            </div>
	        </a>
	    </div>

       	<div class="row page-titles">
           <div class="align-self-center" align="center">
               <h3 class="text-themecolor m-b-0 m-t-0">Indicadores de solicitud de pasajes</h3>
           </div>
       	</div>
	    
	    <div class="row">
	    	<?php if($tiene_permiso_autorizar){ ?>
	        <!-- Column -->
	        <a class="col-md-6 col-lg-3 col-xlg-3" href="<?=site_url().'/pasajes/observaciones'?>">
	            <div class="card card-inverse card-dark">
	                <div class="box text-center">
	                    <h1 class="font-light text-white"><?php echo $pasajes_para_autorizar; ?></h1>
	                    <h5 class="text-white">Solicitudes para autorizar</h5>
	                </div>
	            </div>
	        </a>
	        <!-- Column -->
	    	<?php } ?>
	        <!-- Column -->
	        <div class="col-md-6 col-lg-3 col-xlg-3">
	            <a class="card card-inverse card-info" onclick="redireccionar_pasaje(2);" href="#!">
	                <div class="box bg-info text-center">
	                    <h1 class="font-light text-white"><?php echo $pasajes_en_revision; ?></h1>
	                    <h5 class="text-white">Solicitudes en revisión</h5>
	                </div>
	            </a>
	        </div>
	        <!-- Column -->
	        <a class="col-md-6 col-lg-3 col-xlg-3"  onclick="redireccionar_pasaje(3);" href="#!">
	            <div class="card card-primary card-inverse">
	                <div class="box text-center">
	                    <h1 class="font-light text-white"><?php echo $pasajes_observados; ?></h1>
	                    <h5 class="text-white">Solicitudes observadas</h5>
	                </div>
	            </div>
	        </a>
	        <!-- Column -->
	        <a class="col-md-6 col-lg-3 col-xlg-3" onclick="redireccionar_pasaje(5);" href="#!">
	            <div class="card card-inverse card-success">
	                <div class="box text-center">
	                    <h1 class="font-light text-white"><?php echo $pasajes_pagados; ?></h1>
	                    <h5 class="text-white">Solicitudes pagadas</h5>
	                </div>
	            </div>
	        </a>
	    </div>
    </div>
</div>