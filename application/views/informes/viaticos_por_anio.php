<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<div class="page-wrapper">
	    <div class="container-fluid">
	        <button id="notificacion" style="display: none;" class="tst1 btn btn-success2">Info Message</button>

	        <div class="row page-titles">
	            <div class="align-self-center" align="center">
	                <h3 class="text-themecolor m-b-0 m-t-0">Viaticos Por Año</h3>
	            </div>
	        </div>
	         <div class="row ">
	            <div class="col-lg-4" id="cnt_form" style="display: block;">
	                <div class="card">
	                    <div class="card-header bg-success2" id="">
	                        <h4 class="card-title m-b-0 text-white">Datos</h4>
	                    </div>
	                    <div class="card-body b-t">
							<div class="form-group">
                                <label for="">Años:</label>
                                <select class="select2" style="width: 100%">
                                <?php 
                                    $anio = $anio2 = date('Y');
                                    for ($i=0; $i <= 5; $i++) { 
                                ?>
                                <option value="<?php echo $anio2--;?>"><?php echo $anio2;?></option>
                                
                                <?php 
                                    }
                                ?>
                                </select>
                            </div>
                            <div class="form-group">
                            		<div id="range_22"></div>
                            </div>
	                    </div>
	                </div>
	            </div>
	            <div class="col-lg-8" id="cnt_form" style="display: block;">
	                <div class="card">
	                    <div class="card-header bg-success2" id="">
	                        <h4 class="card-title m-b-0 text-white">Vista Preliminar</h4>
	                    </div>
	                    <div class="card-body b-t">
							
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>


</body>
</html>