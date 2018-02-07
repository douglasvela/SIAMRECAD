<?php
	$id_mision = $_GET["id_mision"];
	$tipo = $_GET["tipo"];
	$nr_usuario = $_GET["nr"];
	/*$fecha_mision_es = date("d/m/Y",strtotime($_GET["fecha_mision"]));
	$fecha_mision_en = date("Y-m-d",strtotime($_GET["fecha_mision"]));

	$mision_oficial = $this->db->query("SELECT * FROM vyp_mision_oficial WHERE fecha_mision = '".$fecha_mision_en."' AND nr_empleado = '".$nr_usuario."' AND id_mision_oficial <> '".$id_mision."' AND estado <> 'incompleta'");
    if($mision_oficial->num_rows() > 0){ 
    	echo '<div class="alert alert-warning"> <i class="fa fa-warning"></i> Ya existe solicitud de viáticos para la fecha: '.$fecha_mision_es." y no podrás cobrar viáticos en los horarios siguientes:";
        foreach ($mision_oficial->result() as $filam) {
        	echo '<hr style="margin: 5px;"">&emsp;&emsp;'.$filam->actividad_realizada.' ('.$filam->estado.')';
        	$hora_mision = $this->db->query("SELECT MIN(hora_salida) AS hora_salida, MAX(hora_llegada) AS hora_llegada FROM vyp_empresas_visitadas WHERE id_mision_oficial = '".$filam->id_mision_oficial."'");
		    if($hora_mision->num_rows() > 0){ 
		        foreach ($hora_mision->result() as $filah) {
		        	echo '<br>&emsp;&emsp;<i class="fa fa-circle"></i> Horario de la misión: '.hora($filah->hora_salida)." - ".hora($filah->hora_llegada);
		        }
		    }
        }
        echo '</div>';
    }*/

	function hora($time){
	    return date("H:i A",strtotime(date("Y-m-d")." ".$time));
	}


	$mision_oficial = $this->db->query("SELECT * FROM vyp_mision_oficial WHERE id_mision_oficial = '".$id_mision."'");
    if($mision_oficial->num_rows() > 0){
    	foreach ($mision_oficial->result() as $filam) {
    		$fecha_inicio = $filam->fecha_mision_inicio;
    		$fecha_fin = $filam->fecha_mision_fin;
    	}
    }

    function duracion($fechaA, $fechaB){
    	$fechaA = explode("-",$fechaA);
    	$fechaB = explode("-",$fechaB);
    	$fecha1 = mktime(0,0,0,$fechaA[1],$fechaA[2],$fechaA[0]);
    	$fecha2 = mktime(0,0,0,$fechaB[1],$fechaB[2],$fechaB[0]);

    	$diferencia = $fecha2-$fecha1;
		$dias = $diferencia/(60*60*24);
		return $dias;
    }

    $duracion = duracion($fecha_inicio, $fecha_fin);

?>
<br>
	<h5>Registro de lugares visitados</h5>
	<blockquote>
	<div class="row">
		<div class="form-group col-lg-2">   
            <h5>Fecha visita: <span class="text-danger">*</span></h5>
            <select id="fecha_mision" name="fecha_mision" class="form-control custom-select"  style="width: 100%" required="">
                <?php
                	$nuevafecha = $fecha_inicio;
                	for($i=0; $i<=$duracion; $i++){
                		echo '<option value="'.date( 'Y-m-d', strtotime($nuevafecha)).'">'.date( 'd/m/Y', strtotime($nuevafecha)).'</option>';
                		$nuevafecha = strtotime ( '+1 day' , strtotime ( $nuevafecha ) ) ;
                		$nuevafecha = date( 'Y-m-d', $nuevafecha);
                	}
                ?>
            </select>
            <div class="help-block"></div>
        </div>
		<div class="form-group col-lg-5">   
            <h5>Lugar de salida: <span class="text-danger">*</span></h5>
            <select id="id_origen" name="id_origen" class="form-control custom-select"  style="width: 100%" required="">
                <?php
                	$origenes = $this->db->query("SELECT * FROM vyp_empresas_visitadas WHERE id_mision_oficial = '".$id_mision."'");
				    if($origenes->num_rows() > 0){
				    	foreach ($origenes->result() as $filao) {
				    		echo '<option value="'.$filao->id_destino.'">'.$filao->nombre_empresa.'</option>';
				    	}
				    }
                ?>
            </select>
            <div class="help-block"></div>
        </div>
        <div class="form-group col-lg-5">   
            <h5>Lugar de llegada: <span class="text-danger">*</span></h5>
            <select id="id_destino" name="id_destino" class="form-control custom-select"  style="width: 100%" required="">
                <?php
                	$origenes = $this->db->query("SELECT * FROM vyp_empresas_visitadas WHERE id_mision_oficial = '".$id_mision."'");
				    if($origenes->num_rows() > 0){
				    	foreach ($origenes->result() as $filao) {
				    		echo '<option value="'.$filao->id_destino.'">'.$filao->nombre_empresa.'</option>';
				    	}
				    }
                ?>
            </select>
            <div class="help-block"></div>
        </div>
	</div>
	<div class="row">
		<div class="form-group col-lg-4" style="margin-bottom: 5px;">
            <h5>Hora salida: <span class="text-danger">*</span></h5>
            <div class="controls">
                <input type="time" id="hora_inicio" name="hora_inicio" class="form-control" required="" placeholder="desayuno, almuerzo, cena" data-validation-required-message="Formato de hora no válido">
                <div class="help-block"></div>
            </div>
        </div>
        <div class="form-group col-lg-4" style="margin-bottom: 5px;">
            <h5>Hora llegada: <span class="text-danger">*</span></h5>
            <div class="controls">
                <input type="time" id="hora_fin" name="hora_fin" class="form-control" required="" placeholder="desayuno, almuerzo, cena" data-validation-required-message="Formato de hora no válido">
                <div class="help-block"></div>
            </div>
        </div>
        <div class="form-group col-lg-4" style="margin-bottom: 5px;">
            <h5>Pasaje: <span class="text-danger">*</span></h5>
            <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-dollar"></i></div>
                <input type="number" id="pasaje" name="pasaje" class="form-control" required="" placeholder="0.00" value="0.00">
            </div>
            <div class="help-block"></div>
        </div>
	</div>
	<hr style="margin: 10px;">
	<button style="display: none;" type="submit" id="btn_submit3" class="btn waves-effect waves-light btn-success2">submit</button>

    <div align="right" id="btnadd3">
        <button type="button" onclick="gestionar_destino('save')" class="btn waves-effect waves-light btn-success2"><i class="mdi mdi-plus"></i> Agregar destino</button>
    </div>
    <div align="right" id="btnedit3" style="display: none;">
        <button type="button" onclick="editar_mision()" class="btn waves-effect waves-light btn-success2">Continuar <i class="mdi mdi-chevron-right"></i></button>
    </div>
    </blockquote>
        <div class="table-responsive">
			<table id="tabla_viaticos" name="tabla_viaticos" class="table table-hover table-bordered" width="100%">
			  	<thead class="bg-inverse text-white" style="font-size: 15px;">
			        <tr>
			        	<th>Fecha misión</th>
			      		<th>Lugar de salida</th>
			      		<th>Lugar de llegada</th>
			      		<th>Hora de salida</th>
			      		<th>Hora de llegada</th>
			      		<th>Distancia (Km)</th>
			      		<th>Viaticos ($)</th>
			      		<th>Pasaje ($)</th>
			    	</tr>
			  	</thead>
			  	<tbody>
			  		<td>
			  			
			  		</td>
			  		<td>
			  			
			  		</td>
			  		<td>
			  			
			  		</td>
			  		<td>
			  			
			  		</td>
			  		<td>
			  			
			  		</td>
			  		<td>
			  			
			  		</td>
			  		<td>
			  			
			  		</td>
			  		<td>
			  			
			  		</td>
			  	</tbody>
			</table>
		</div>


		<div class="form-group m-b-5" style="display: none;">
            <textarea class="form-control" id="area" rows="4"></textarea>
            <span class="bar"></span>
            <label for="input7">Text area</label>
        </div>

		<div class="row">
			<div class="form-group col-lg-12 m-b-5" align="right">
		        <button type="button" onclick="tabla_empresas_viaticos('guardar');" class="pull-right btn btn-info">
		        Actualizar solicitud
		        </button>
		    </div>
		</div>