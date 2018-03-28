<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script type="text/javascript">
		function mostrarReportePagados(tipo){
	       var id = $("#id_empleado2").val();
	       var fecha_min = $("#fecha_min").val();
	       var fecha_max = $("#fecha_max").val();
	       if(id=="" || fecha_max=="" || fecha_min==""){
	         swal({ title: "¡Ups! Error", text: "Completa los campos.", type: "error", showConfirmButton: true });
	       }else{
	         var xhr = "<?php echo base_url()?>";

	         if(document.getElementById('radio_pdf_pagado').checked==true && tipo==""){
	         		window.open(xhr+"index.php/informes/menu_reportes/reporte_viatico_pagado_empleado/pdf/"+id+"/"+fecha_min+"/"+fecha_max,"_blank");
	      		}else if(document.getElementById('radio_excel_pagado').checked==true && tipo==""){
	      			window.open(xhr+"index.php/informes/menu_reportes/reporte_viatico_pagado_empleado/excel/"+id+"/"+fecha_min+"/"+fecha_max,"_blank");
	      		}else{
	      			var html="<embed src='"+xhr+"index.php/informes/menu_reportes/reporte_viatico_pagado_empleado/vista/"+id+"/"+fecha_min+"/"+fecha_max+"'  width='780' height='400'>";
    				$("#informe_vista").html(html);
	      		}
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
	                <h3 class="text-themecolor m-b-0 m-t-0">Viaticos Pagados</h3>
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
                                <h5>Empleado: <span class="text-danger">*</span></h5>
                                <select id="id_empleado2" name="id_empleado2" class="select2" onchange="" style="width: 100%" required>';
                                <option value=''>[Elija el empleado]</option>
                                <?php
                                    $datasEmpleado = $this->db->query("SELECT * FROM sir_empleado");
                                    $sess2= $this->session->userdata('id_usuario_viatico');
                                    $datasEmpleado2 = $this->db->query("SELECT nr FROM org_usuario where id_usuario='$sess2'");
                                    if($datasEmpleado2->num_rows()>0){
                                        foreach ($datasEmpleado2->result() as $fila4) {}
                                    }
                                    if($datasEmpleado->num_rows() > 0){
                                        foreach ($datasEmpleado->result() as $fila2) {
                                    ?>
<option class="m-l-50" value="<?php echo $fila2->nr; ?>" <?php if(isset($fila4)){ if($fila2->nr==$fila4->nr){ echo "selected";} } ?>><?php echo preg_replace ('/[ ]+/', ' ',$fila2->primer_nombre." ".$fila2->segundo_nombre." ".$fila2->primer_apellido." ".$fila2->segundo_apellido) ?></option>
                                                            <?php
                                                              }
                                                          }
                                                          ?>
                                                        </select>
                                                      </div>
                                <div class="form-group">
                                    <h5>Fecha Mínima: <span class="text-danger">*</span></h5>
                                    <input type="text" pattern="\d{1,2}-\d{1,2}-\d{4}" data-date-end-date="0d"  onkeyup="FECHA('fecha_mision')" required="" value="<?php echo date('d-m-Y'); ?>" class="form-control" id="fecha_min" name="fecha_min" placeholder="dd/mm/yyyy">
                                </div>
								<div class="form-group">
                                    <h5>Fecha Maxima: <span class="text-danger">*</span></h5>
                                    <input type="text" pattern="\d{1,2}-\d{1,2}-\d{4}" data-date-end-date="0d"  onkeyup="FECHA('fecha_mision')" required="" value="<?php echo date('d-m-Y'); ?>" class="form-control" id="fecha_max" name="fecha_max" placeholder="dd/mm/yyyy">
                                </div>
                                <div align="right">
                                	 <button type="button" onclick="mostrarReportePagados('vista')" class="btn waves-effect waves-light btn-success2"><i class="mdi mdi-view-dashboard"></i> Vista Previa</button>
                                </div>
                                 <div class="card-body b-t">
	                            	<div class="demo-radio-button">
	                                    <input name="group1" type="radio" id="radio_pdf_pagado" checked="">
	                                    <label for="radio_pdf_pagado">PDF</label>
	                                    <input name="group1" type="radio" id="radio_excel_pagado">
	                                    <label for="radio_excel_pagado">EXCEL</label>
	                                </div>

	                            </div>
	                            <div align="right">
	                            <button type="button" onclick="mostrarReportePagados('')" class="btn waves-effect waves-light btn-success2"><i class="mdi mdi-file-pdf"></i> Exportar Reporte</button>
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
<script >
	$(document).ready(function(){
          $('#fecha_min').datepicker({
              format: 'dd-mm-yyyy',
              autoclose: true,
              todayHighlight: true
          });
      });
      $(document).ready(function(){
          $('#fecha_max').datepicker({
              format: 'dd-mm-yyyy',
              autoclose: true,
              todayHighlight: true
          });
      });
      $(document).ready(function(){
          $('.date-own').datepicker({
            minViewMode: 2,
            format: 'yyyy',
            autoclose: true,
            todayHighlight: true
          });
      });
</script>