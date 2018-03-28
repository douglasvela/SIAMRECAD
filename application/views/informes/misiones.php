<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script type="text/javascript">
		function mostrarreporte(tipo){
			 var xhr = "<?php echo base_url()?>";
			 var nr = $("#id_empleado").val();
	          if(document.getElementById('radio_pdf').checked==true && tipo==""){
	          	window.open(xhr+"index.php/informes/menu_reportes/reporte_misiones/pdf/"+nr,"_blank");
	          }else if(document.getElementById('radio_excel').checked==true && tipo==""){
	          	window.open(xhr+"index.php/informes/menu_reportes/reporte_misiones/excel/"+nr,"_blank");
	          }else{
	          	var html="<embed src='"+xhr+"index.php/informes/menu_reportes/reporte_misiones/vista/"+nr+"'  width='780' height='400'>";
    				$("#informe_vista").html(html);
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
	                <h3 class="text-themecolor m-b-0 m-t-0">Misiones de Empleados</h3>
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
                            	<h5>Empleado:</h5>
                            	<select id="id_empleado" name="id_empleado" class="select2"  style="width: 100%">
                                <option value='todos'>[Todos]</option>
                                <?php
                                    $datasEmpleado = $this->db->query("SELECT * FROM sir_empleado");
                                    
                                    if($datasEmpleado->num_rows() > 0){
                                        foreach ($datasEmpleado->result() as $fila2) {
                                    ?>
<option class="m-l-50" value="<?php echo $fila2->nr; ?>"><?php echo preg_replace('/[ ]+/', ' ',$fila2->primer_nombre." ".$fila2->segundo_nombre." ".$fila2->primer_apellido." ".$fila2->segundo_apellido." - ".$fila2->nr); ?></option>
                                                            <?php
                                                              }
                                                          }
                                                          ?>
                                </select>
                            </div>
                             <div align="right">
                            	<button type="button" onclick="mostrarreporte('vista')" class="btn waves-effect waves-light btn-success2"><i class="mdi mdi-view-dashboard"></i> Vista Previa</button>
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
	                            <button type="button" onclick="mostrarreporte('')" class="btn waves-effect waves-light btn-success2"><i class="mdi mdi-file-pdf"></i> Exportar Reporte</button>
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