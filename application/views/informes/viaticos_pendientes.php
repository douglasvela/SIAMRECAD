<!DOCTYPE html>
<html>
<head>
	<script type="text/javascript">
//var pdfUrl = xhr+"index.php/informes/menu_reportes/reporte_viatico_pendiente_empleado/"+id;
	       	//var pdfViewerEmbed = document.getElementById("myPdfEmbed");
			//pdfViewerEmbed.setAttribute("src", pdfUrl);
			//pdfViewerEmbed.outerHTML = pdfViewerEmbed.outerHTML.replace(/src="(.+?)"/, 'src="' + pdfUrl + '"');
	      	 //$("#informe").attr("src",xhr+"index.php/informes/menu_reportes/reporte_viatico_pendiente_empleado/"+id);


   //var html="<object data='"+xhr+"index.php/informes/menu_reportes/reporte_viatico_pendiente_empleado/"+id+"' type='application/pdf' width='780' height='400'> alt : <a href='goodies/pdfs/indice_contenido.pdf'></a></object>";
 
    //$("#informe").html(html);



		function mostrarReporteEmpleado(tipo){
	       var id = $("#id_empleado").val();
	       var xhr = "<?php echo base_url()?>";
	       if(id==""){
	         swal({ title: "¡Ups! Error", text: "Completa los campos.", type: "error", showConfirmButton: true });
	       }else{
	        
	        if(document.getElementById('radio_pdf_pendiente').checked==true && tipo==""){
	         	window.open(xhr+"index.php/informes/menu_reportes/reporte_viatico_pendiente_empleado/pdf/"+id,"_blank");
	        }else if(document.getElementById('radio_excel_pendiente').checked==true && tipo==""){
	        	window.open(xhr+"index.php/informes/menu_reportes/reporte_viatico_pendiente_empleado/excel/"+id,"_blank");
	        }else{
	           
	        	var html="<embed src='"+xhr+"index.php/informes/menu_reportes/reporte_viatico_pendiente_empleado/vista/"+id+"'  width='780' height='400'>";
 
    			$("#informe_vista").html(html);
	           /*$( "#informe_vista" ).load("<?php echo site_url(); ?>/informes/menu_reportes/reporte_viatico_pendiente_empleado/vista/"+id, function() {
		       });*/


	        }
	       	
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
	                <h3 class="text-themecolor m-b-0 m-t-0">Viaticos Pendientes de Pago</h3>
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
							 	<h5>Empleado: <span class="text-danger">*</span></h5>
                                <select id="id_empleado" name="id_empleado" class="select2" onchange="" style="width: 100%" required>
                                <option value=''>[Elija el empleado]</option>
                                <?php
                                    $dataEmpleado = $this->db->query("SELECT * FROM sir_empleado");
                                    $sess= $this->session->userdata('id_usuario_viatico');
                                    $dataEmpleado2 = $this->db->query("SELECT nr FROM org_usuario where id_usuario='$sess'");
                                        if($dataEmpleado2->num_rows()>0){
                                            foreach ($dataEmpleado2->result() as $fila3) {}
                                        }
                                        if($dataEmpleado->num_rows() > 0){
                                            foreach ($dataEmpleado->result() as $fila2) {
                                 ?>
<option class="m-l-50" value="<?php echo $fila2->nr; ?>" <?php if(isset($fila3)){ if($fila2->nr==$fila3->nr){ echo "selected"; }} ?>><?php echo $fila2->primer_nombre." ".$fila2->segundo_nombre." ".$fila2->primer_apellido." ".$fila2->segundo_apellido; ?></option>
                                <?php
                                        }
                                    }
                                    //$u_rec_id = $this->session->userdata('rec_id');
                                ?>
                                </select>
                            </div>
                            <div align="right">
                            <button type="button" onclick="mostrarReporteEmpleado('vista')" class="btn waves-effect waves-light btn-success2"><i class="mdi mdi-file-pdf"></i> Vista Previa</button>
                            </div><br>
                            <div class="card-body b-t">
                            	<div class="demo-radio-button">
                                    <input name="group1" type="radio" id="radio_pdf_pendiente" checked="">
                                    <label for="radio_pdf_pendiente">PDF</label>
                                    <input name="group1" type="radio" id="radio_excel_pendiente">
                                    <label for="radio_excel_pendiente">EXCEL</label>
                                </div>

                            </div>
                            <div align="right">
                            <button type="button" onclick="mostrarReporteEmpleado('')" class="btn waves-effect waves-light btn-success2"><i class="mdi mdi-file-pdf"></i> Exportar Reporte</button>
                            </div>
	                    </div>
	                </div>
	            </div>
	            <div class="col-lg-8" id="cnt_form" style="display: block;">
	                <div class="card">
	                    <div class="card-header bg-success2" id="">
	                        <h4 class="card-title m-b-0 text-white">Vista Preliminar</h4>
	                    </div>
	                    <div class="card-body b-t"  >
							 <!-- <embed src="" width="770" height="400"> -->
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