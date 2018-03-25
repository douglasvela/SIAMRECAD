<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script>
		 
		function mostrarReportePorAnio(tipo){
			var slider = $("#range_04").data("ionRangeSlider");
	        var minimo = slider.result.from;
			var maximo = slider.result.to;
			var anios= "";
			
			for (var i = minimo ; i <= maximo ; i++ ) {
				anios+=i;
			};
	        
	        if(anios){
	          var xhr = "<?php echo base_url()?>";
	          if(document.getElementById('radio_pdf').checked==true && tipo==""){ 
	          window.open(xhr+"index.php/informes/menu_reportes/reporte_viaticos_x_anio/pdf/"+anios,"_blank");
	          }else if(document.getElementById('radio_excel').checked==true && tipo==""){
	          window.open(xhr+"index.php/informes/menu_reportes/reporte_viaticos_x_anio/excel/"+anios,"_blank");
	          }else{
	          	var html="<embed src='"+xhr+"index.php/informes/menu_reportes/reporte_viaticos_x_anio/vista/"+anios+"'  width='780' height='400'>";
    				$("#informe_vista").html(html);
	          }
	        }else{
	          swal({ title: "¡Ups! Error", text: "Completa los campos.", type: "error", showConfirmButton: true });
	        }
	     }
	     function iniciar() {
	     	<?php
	          $data['id_modulo'] = $this->uri->segment(5);
	          $data['id_usuario'] = $this->session->userdata('id_usuario_viatico');
	          $data['id_permiso']="1";
	          if(!buscar_permiso($data)){
	         ?>
	            $("#cnt_form").html("Usted no tiene permiso para este formulario.");     
	        <?php
	          }
	        ?>
	     }
	</script>
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
	         <div class="row " id="cnt_form">
	            <div class="col-lg-4"  style="display: block;">
	                <div class="card">
	                    <div class="card-header bg-success2" id="">
	                        <h4 class="card-title m-b-0 text-white">Datos</h4>
	                    </div>
	                    <div class="card-body b-t">
							 
                            <div class="form-group">
                            	<h5>Años</h5>
                            		<div id="range_04" data-min="2010" data-max="<?php echo date('Y');?>"></div>
                            </div>
                            <div align="right">
                            	<button type="button" onclick="mostrarReportePorAnio('vista')" class="btn waves-effect waves-light btn-success2"><i class="mdi mdi-file-pdf"></i> Vista Previa</button>
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
	                            <button type="button" onclick="mostrarReportePorAnio('')" class="btn waves-effect waves-light btn-success2"><i class="mdi mdi-file-pdf"></i> Exportar Reporte</button>
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