<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script type="text/javascript">
		function mostrarReporteViaticosMayoraMenor(tipo){
	       var fecha = $("#fecha_monto").val();
	       var dir,recursividad;
	       dir = $("#seccion_principal").val();
	       if(document.getElementById('recursividad').checked==true){
	       	recursividad="si";
	       }else{
			recursividad="no";
	       }
	        
	       if(fecha=="" || dir=="0"){
	          swal({ title: "¡Ups! Error", text: "Completa los campos.", type: "error", showConfirmButton: true });
	       }else{
	         var xhr = "<?php echo base_url()?>";

	         if(document.getElementById('radio_pdf_pagado').checked==true && tipo==""){
	         	 window.open(xhr+"index.php/informes/menu_reportes/reporte_monto_viatico_mayor_a_menor/pdf/"+fecha+"/"+dir+"/"+recursividad,"_blank");
	         }else if(document.getElementById('radio_excel_pagado').checked==true && tipo==""){
	         	 window.open(xhr+"index.php/informes/menu_reportes/reporte_monto_viatico_mayor_a_menor/excel/"+fecha+"/"+dir+"/"+recursividad,"_blank");
	         }else{
	         	var html="<embed src='"+xhr+"index.php/informes/menu_reportes/reporte_monto_viatico_mayor_a_menor/vista/"+fecha+"/"+dir+"/"+recursividad+"'  width='780' height='400'>";
    				$("#informe_vista").html(html);
	         }

	         
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
	                <h3 class="text-themecolor m-b-0 m-t-0">Viaticos por Empleado de Mayor a Menor</h3>
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
                                <h5>Año: <span class="text-danger">*</span></h5>
                                <input type="text" value="<?php echo date('Y'); ?>" class="date-own form-control" id="fecha_monto" name="fecha_monto" placeholder="yyyy">
                             </div>
                             <div class="form-group">
                                <h5>Dirección: <span class="text-danger">*</span></h5>
                                <select id="seccion_principal" name="seccion_principal" class="select2" style="width: 100%" >
                                <option value="0">[Seleccione]</option>
                                <?php
                                    $datos = $this->db->query("SELECT * FROM org_seccion order by depende ");
                                    if($datos->num_rows() > 0){
                                    foreach ($datos->result() as $filadatos) {
                                    echo "<option class='m-l-50' value='$filadatos->id_seccion'>".preg_replace ('/[ ]+/', ' ',$filadatos->nombre_seccion)."</option>";
                                        }
                                    }
                                //$u_rec_id = $this->session->userdata('rec_id');
                                ?>
                                </select>
                            </div>
                            <div class="form-group">
                            	<div class="demo-checkbox">
                                    <input type="checkbox" id="recursividad" checked="">
                                    <label for="recursividad">Incluir Secciones Internas</label>
                                </div>
                            </div>
                            <div align="right">
                            	<button type="button" onclick="mostrarReporteViaticosMayoraMenor('vista')" class="btn waves-effect waves-light btn-success2"><i class="mdi mdi-view-dashboard"></i> Vista Preliminar</button>
                            </div><br>
                            <div class="card-body b-t">
	                            	<div class="demo-radio-button">
	                                    <input name="group1" type="radio" id="radio_pdf_pagado" checked="">
	                                    <label for="radio_pdf_pagado">PDF</label>
	                                    <input name="group1" type="radio" id="radio_excel_pagado">
	                                    <label for="radio_excel_pagado">EXCEL</label>
	                                </div>

	                            </div>
	                            <div align="right">
	                            <button type="button" onclick="mostrarReporteViaticosMayoraMenor('')" class="btn waves-effect waves-light btn-success2"><i class="mdi mdi-file-pdf"></i> Exportar Reporte</button>
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