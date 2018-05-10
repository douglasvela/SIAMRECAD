<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script type="text/javascript">
		function mostrar_ocultar_selects(){
	     	if(document.getElementById('radio_mensual').checked==true){
	     		document.getElementById("input_mes").style.display="block";
	     		document.getElementById("input_semestre").style.display="none";
	     		document.getElementById("input_trimestre").style.display="none";

	     	}else if(document.getElementById('radio_trimestral').checked==true){
	     		document.getElementById("input_mes").style.display="none";
	     		document.getElementById("input_semestre").style.display="none";
	     		document.getElementById("input_trimestre").style.display="block";
	     	}else if(document.getElementById('radio_semestral').checked==true){
	     		document.getElementById("input_mes").style.display="none";
	     		document.getElementById("input_semestre").style.display="block";
	     		document.getElementById("input_trimestre").style.display="none";
	     	}else if(document.getElementById('radio_anual').checked==true){
	     		document.getElementById("input_mes").style.display="none";
	     		document.getElementById("input_semestre").style.display="none";
	     		document.getElementById("input_trimestre").style.display="none";
	     	}
	     }
	     function mostrarReportePorActividad(tipo){
			 
	      	var slider = $("#range_04").data("ionRangeSlider");
	        var anio_minimo = slider.result.from;
			var anio_maximo = slider.result.to;
			var anios="";
			var id_vyp_actividades = $("#id_vyp_actividades").val();

			for (var i = anio_minimo; i <= anio_maximo; i++) {
				anios+=i;
			}  
	        
	        if($("#id_vyp_actividades").val()!="0"){
	          var xhr = "<?php echo base_url()?>";

	          if(document.getElementById('radio_pdf').checked==true && tipo==""){
	          	window.open(xhr+"index.php/informes/menu_reportes/reporte_detalle_viaticos_por_actividad/pdf/"+anios+"/"+id_vyp_actividades,"_blank");
	          }else if(document.getElementById('radio_excel').checked==true && tipo==""){
	          	window.open(xhr+"index.php/informes/menu_reportes/reporte_detalle_viaticos_por_actividad/excel/"+anios+"/"+id_vyp_actividades,"_blank");
	          }else{
	          	var html="<embed src='"+xhr+"index.php/informes/menu_reportes/reporte_detalle_viaticos_por_actividad/vista/"+anios+"/"+id_vyp_actividades+"'  width='780' height='400'>";
    				$("#informe_vista").html(html);
	          }
	        }else{
	          swal({ title: "¡Ups! Error", text: "Completa los campos.", type: "error", showConfirmButton: true });
	        }
	     }
	     function iniciar() {
	     	var slider = $("#range_04").data("ionRangeSlider");
	     	slider.update({
	     		from: 2017,
	     		to: 2018
	     	});
	     	<?php if(!tiene_permiso($segmentos=3,$permiso=1)){ ?>
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
	                <h3 class="text-themecolor m-b-0 m-t-0">Detalle Viaticos por Actividad</h3>
	            </div>
	        </div>
	         <div class="row " id="cnt_form" >
	            <div class="col-lg-4" style="display: block;">
	                <div class="card">
	                    <div class="card-header bg-success2" id="">
	                        <h4 class="card-title m-b-0 text-white">Datos</h4>
	                    </div>
	                    <div class="card-body b-t">
							
                            <div class="form-group">
                                <h5>Actividad: <span class="text-danger">*</span></h5>
                                <select class="select2" name="id_vyp_actividades" id="id_vyp_actividades" style="width: 100%">
                                	<option value="0">[Seleccione]</option>
                                 <?php
                                 	$datos = $this->db->query("SELECT * FROM vyp_actividades ");
                                    if($datos->num_rows() > 0){
                                    foreach ($datos->result() as $filadatos) {
    						echo '<option value="'.$filadatos->id_vyp_actividades.'">'.preg_replace ('/[ ]+/', ' ',$filadatos->nombre_vyp_actividades).'</option>';
                                 ?>


                                 <?php
                                       }
                                    }
                                 ?>
                                 </select>
                            </div>
                            <div class="form-group">
                            	<h5>Periodo</h5>
                            		<div id="range_04" data-min="2016" data-max="<?php echo date('Y');?>"></div>
                            </div>
                            <div align="right">
                            	<button type="button" onclick="mostrarReportePorActividad('vista')" class="btn waves-effect waves-light btn-success2"><i class="mdi mdi-view-dashboard"></i> Vista Previa</button>
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
	                            <button type="button" onclick="mostrarReportePorActividad('')" class="btn waves-effect waves-light btn-success2"><i class="mdi mdi-file-pdf"></i> Exportar Reporte</button>
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