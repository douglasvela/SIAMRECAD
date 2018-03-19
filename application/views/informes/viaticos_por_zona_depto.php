<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script>
		 function mostrarReportePorZonaDepto(tipo){
		        var anios = $("#anio_actual_zona_depto").val();
		        if(anios){
		          var xhr = "<?php echo base_url()?>";
		          if(document.getElementById('radio_pdf').checked==true && tipo==""){ 
		          	window.open(xhr+"index.php/informes/menu_reportes/reporte_viaticos_x_zona_depto/pdf/"+anios,"_blank");
		          }else if(document.getElementById('radio_excel').checked==true && tipo==""){
		          	window.open(xhr+"index.php/informes/menu_reportes/reporte_viaticos_x_zona_depto/excel/"+anios,"_blank");
		          }else{
		          	var html="<embed src='"+xhr+"index.php/informes/menu_reportes/reporte_viaticos_x_zona_depto/vista/"+anios+"'  width='780' height='400'>";
    				$("#informe_vista").html(html);
		          }
		        }else{
		          swal({ title: "¡Ups! Error", text: "Completa los campos.", type: "error", showConfirmButton: true });
		        } 
		  }
	</script>
</head>
<body>

	<div class="page-wrapper">
	    <div class="container-fluid">
	        <button id="notificacion" style="display: none;" class="tst1 btn btn-success2">Info Message</button>

	        <div class="row page-titles">
	            <div class="align-self-center" align="center">
	                <h3 class="text-themecolor m-b-0 m-t-0">Viaticos Por Zona Departamental</h3>
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
                                <h5>Año: <span class="text-danger">*</span></h5>
                                <input type="text" value="<?php echo date('Y'); ?>" class="date-own form-control" id="anio_actual_zona_depto" name="anio_actual" placeholder="yyyy">
                             </div>
                             <div class="form-group" align="right">
                             	<button type="button" onclick="mostrarReportePorZonaDepto('vista')" class="btn waves-effect waves-light btn-success2"><i class="mdi mdi-file-pdf"></i> Vista Preliminar</button>
                             </div>
                             <br>
                            <div class="card-body b-t">
	                            	<div class="demo-radio-button">
	                                    <input name="group2" type="radio" id="radio_pdf" checked="">
	                                    <label for="radio_pdf">PDF</label>
	                                    <input name="group2" type="radio" id="radio_excel">
	                                    <label for="radio_excel">EXCEL</label>
	                                </div>

	                            </div>
	                         <div align="right">
	                            <button type="button" onclick="mostrarReportePorZonaDepto('')" class="btn waves-effect waves-light btn-success2"><i class="mdi mdi-file-pdf"></i> Exportar Reporte</button>
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
							<div id="informe_vista">
								</div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>


</body>
</html>
<script>
	$(document).ready(function(){
          $('.date-own').datepicker({
            minViewMode: 2,
            format: 'yyyy',
            autoclose: true,
            todayHighlight: true
          });
      });
</script>