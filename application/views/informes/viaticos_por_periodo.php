<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script type="text/javascript">
		function mostrarReportePorPeriodo(tipo){
			$primer_mes = "0";
       		$segundo_mes = "0";
        	$tercer_mes = "0";
        	$cuarto_mes = "0";
        	$quinto_mes = "0";
        	$sexto_mes = "0";
	       $anio = $("#anio_actual").val();
	       if(document.getElementById('radio_mensual').checked==true){
	       		$primer_mes = $("#mes").val();
	       }
	       if(document.getElementById('radio_trimestral').checked==true){
	       		if($("#trimestre").val()=="1"){
	       			$primer_mes = "1";
	        		$segundo_mes = "2";
	        		$tercer_mes = "3";
	       		}else if($("#trimestre").val()=="2"){
	       			$primer_mes = "4";
	        		$segundo_mes = "5";
	        		$tercer_mes = "6";
	       		}else if($("#trimestre").val()=="3"){
	       			$primer_mes = "7";
	        		$segundo_mes = "8";
	        		$tercer_mes = "9";
	       		}else if($("#trimestre").val()=="4"){
	       			$primer_mes = "10";
	        		$segundo_mes = "11";
	        		$tercer_mes = "12";
	       		}
	       }
	       if(document.getElementById('radio_semestral').checked==true){
	       		if($("#semestre").val()=="1"){
	       			$primer_mes = "1";
	        		$segundo_mes = "2";
	        		$tercer_mes = "3";
	        		$cuarto_mes = "4";
	        		$quinto_mes = "5";
	        		$sexto_mes = "6";
	       		}else{
	       			$primer_mes = "7";
	        		$segundo_mes = "8";
	        		$tercer_mes = "9";
	        		$cuarto_mes = "10";
	        		$quinto_mes = "11";
	        		$sexto_mes = "12";
	       		}
	       }
	        
	        if($anio!="" &&  (($("#mes").val()!="0" && document.getElementById('radio_mensual').checked==true)
	         || ($("#trimestre").val()!="0" && document.getElementById('radio_trimestral').checked==true)
	         || ($("#semestre").val()!="0" && document.getElementById('radio_semestral').checked==true)
	         || document.getElementById('radio_anual').checked==true
	         )){
	          var xhr = "<?php echo base_url()?>";

	          if(document.getElementById('radio_pdf').checked==true && tipo==""){
	          	window.open(xhr+"index.php/informes/menu_reportes/reporte_viaticos_por_periodo/pdf/"+$anio+"/"+$primer_mes+"/"+$segundo_mes+"/"+$tercer_mes+"/"+$cuarto_mes+"/"+$quinto_mes+"/"+$sexto_mes,"_blank");
	          }else if(document.getElementById('radio_excel').checked==true && tipo==""){
	          	window.open(xhr+"index.php/informes/menu_reportes/reporte_viaticos_por_periodo/excel/"+$anio+"/"+$primer_mes+"/"+$segundo_mes+"/"+$tercer_mes+"/"+$cuarto_mes+"/"+$quinto_mes+"/"+$sexto_mes,"_blank");
	          }else{
	          	var html="<embed src='"+xhr+"index.php/informes/menu_reportes/reporte_viaticos_por_periodo/vista/"+$anio+"/"+$primer_mes+"/"+$segundo_mes+"/"+$tercer_mes+"/"+$cuarto_mes+"/"+$quinto_mes+"/"+$sexto_mes+"'  width='780' height='400'>";
    				$("#informe_vista").html(html);
	          }
	        }else{
	          swal({ title: "¡Ups! Error", text: "Completa los campos.", type: "error", showConfirmButton: true });
	        }
	     }
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
	     function iniciar() {
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
	                <h3 class="text-themecolor m-b-0 m-t-0">Viaticos Por Periodo</h3>
	            </div>
	        </div>
	         <div class="row "  id="cnt_form" >
	            <div class="col-lg-4"style="display: block;">
	                <div class="card">
	                    <div class="card-header bg-success2" id="">
	                        <h4 class="card-title m-b-0 text-white">Datos</h4>
	                    </div>
	                    <div class="card-body b-t">
							<div class="form-group">
                                <h5>Año: <span class="text-danger">*</span></h5>
                                <input type="text" value="<?php echo date('Y'); ?>" class="date-own form-control" id="anio_actual" name="anio_actual" placeholder="yyyy">
                            </div>
                            <div class="demo-radio-button">
                            	<h5>Periodo: <span class="text-danger"></span></h5>
                                    <input name="group1" type="radio" onchange="mostrar_ocultar_selects()" class="with-gap" id="radio_mensual" checked="">
                                    <label for="radio_mensual">Mensual</label>
                                    <input name="group1" type="radio" onchange="mostrar_ocultar_selects()" class="with-gap" id="radio_trimestral">
                                    <label for="radio_trimestral">Trimestral</label>
                                    <input name="group1" type="radio" onchange="mostrar_ocultar_selects()" class="with-gap" id="radio_semestral">
                                    <label for="radio_semestral">Semestral</label>
                                    <input name="group1" type="radio" onchange="mostrar_ocultar_selects()" class="with-gap" id="radio_anual">
                                    <label for="radio_anual">Anual</label>
                                </div>
                            <div class="form-group" id="input_mes">
                                <h5>Mes: <span class="text-danger"></span></h5>
                                <select id="mes" name="mes" class="select2" onchange="" style="width: 100%" >
                                    <option value="0">[Seleccione]</option>
                                    <option class="m-l-50" value="1">Enero</option>
                                    <option class="m-l-50" value="2">Febrero</option>
                                    <option class="m-l-50" value="3">Marzo</option>
                                    <option class="m-l-50" value="4">Abril</option>
                                    <option class="m-l-50" value="5">Mayo</option>
                                    <option class="m-l-50" value="6">Junio</option>
                                    <option class="m-l-50" value="7">Julio</option>
                                    <option class="m-l-50" value="8">Agosto</option>
                                    <option class="m-l-50" value="9">Septiembre</option>
                                    <option class="m-l-50" value="10">Octubre</option>
                                    <option class="m-l-50" value="11">Noviembre</option>
                                    <option class="m-l-50" value="12">Diciembre</option>
                                </select>
                            </div>
                            <div class="form-group" id="input_trimestre" style="display:none">
                                <h5>Trimestre: <span class="text-danger"></span></h5>
                                <select id="trimestre" name="trimestre" class="select2" onchange="" style="width: 100%" >
                                    <option value="0">[Seleccione]</option>
                                    <option class="m-l-50" value="1">1er Trimestre</option>
                                    <option class="m-l-50" value="2">2do Trimestre</option>
                                    <option class="m-l-50" value="3">3er Trimestre</option>
                                    <option class="m-l-50" value="4">4ta Trimestre</option>
                                </select>
                            </div>
                            <div class="form-group" id="input_semestre" style="display:none">
                                <h5>Semestre: <span class="text-danger"></span></h5>
                                <select id="semestre" name="semestre" class="select2" onchange="" style="width: 100%" >
                                    <option value="0">[Seleccione]</option>
                                    <option class="m-l-50" value="1">1er Semestre</option>
                                    <option class="m-l-50" value="2">2do Semestre</option>
                                </select>
                            </div>
                            <div class="form-group" align="right">
                            	<button type="button" onclick="mostrarReportePorPeriodo('vista')" class="btn waves-effect waves-light btn-success2"><i class="mdi mdi-view-dashboard"></i> Vista Preliminar</button>
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
	                            <button type="button" onclick="mostrarReportePorPeriodo('')" class="btn waves-effect waves-light btn-success2"><i class="mdi mdi-file-pdf"></i> Exportar Reporte</button>
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
								<div id="informe_vista"  >
									
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