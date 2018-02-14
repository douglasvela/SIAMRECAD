<?php
	$id_mision = $_GET["id_mision"];
	$tipo = $_GET["tipo"];
	$fecha_mision_es = date("d/m/Y",strtotime($_GET["fecha_mision"]));
	$fecha_mision_en = date("Y-m-d",strtotime($_GET["fecha_mision"]));
	$nr_usuario = $_GET["nr"];


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
    }

	function hora($time){
	    return date("H:i A",strtotime(date("Y-m-d")." ".$time));
	}

?>


        <div class="table-responsive">
			<table id="tabla_viaticos" name="tabla_viaticos" class="table table-hover table-bordered" width="100%">
			  	<thead class="bg-inverse text-white" style="font-size: 15px;">
			        <tr>
			        	<th style="display: none;">Inputs</th>
			      		<th>Lugar de salida</th>
			      		<th>Lugar de llegada</th>
			      		<th>Hora de salida</th>
			      		<th>Hora de llegada</th>
			      		<th>Distancia (Km)</th>
			      		<th>Viaticos ($)</th>
			      		<th>Pasaje ($)</th>
			    	</tr>
			  	</thead>
			  	<tbody style="font-size: 15px; color: grey;">

			  		<?php 

			  			$info_empleado = $this->db->query("SELECT * FROM vyp_informacion_empleado WHERE nr = '".$nr_usuario."'");

		                if($info_empleado->num_rows() > 0){ 
		                    foreach ($info_empleado->result() as $filas) {}
		                }

		                $origenes = $this->db->query("SELECT * FROM vyp_oficinas WHERE id_oficina = '".$filas->id_oficina_departamental."'");

		                if($origenes->num_rows() > 0){
		                    foreach ($origenes->result() as $fila4) {}
		                }

			  			$id_origen = $fila4->id_oficina;
			  			$origen = $fila4->nombre_oficina;
			  			$viaticos = 0; $pasajes = 0;

		                $empresas = $this->db->query("SELECT * FROM vyp_empresas_visitadas WHERE id_mision_oficial = '".$id_mision."' ORDER BY orden");
		                if($empresas->num_rows() > 0){
		                    foreach ($empresas->result() as $fila) {
		                    	$id_destino = $fila->id_destino;
		                    	$km = $fila->kilometraje;

		                    	$direcciones = $this->db->query("SELECT m.*, d.* FROM org_municipio AS m INNER JOIN org_departamento AS d WHERE m.id_departamento_pais = d.id_departamento AND id_municipio = '".$id_destino."'");
		                    	if($direcciones->num_rows() > 0){
		                    		foreach ($direcciones->result() as $fila3) { 
		                    			$dm_direccion = "(".$fila3->departamento."/".$fila3->municipio.")";
		                    		}
		                    	}

		                        ?>
		                        <tr>
		                        <td style="display: none;">
		                        	<input type="text" class="form-control" value="<?php echo $fila->id_empresas_visitadas; ?>">
				            		<input type="text" class="form-control" value="<?php echo $fila->id_municipio; ?>">
				            		<input type="text" class="form-control" value="<?php echo $fila->nombre_empresa; ?>">
				            		<input type="text" class="form-control" value="<?php echo $fila->direccion_empresa; ?>">
				            		<input type="text" class="form-control" value="<?php echo $fila->tipo_destino; ?>">
				            		<input type="text" class="form-control" value="<?php echo $fila->id_departamento ?>">
		            			</td>
		            			<td><?php echo $origen; ?></td>
				            	<td>
				            		<?php
				            		if($fila->tipo_destino == "destino_oficina"){
				            			echo $fila->nombre_empresa;
				            		}else{
				            			echo $fila->nombre_empresa." ".$dm_direccion;
				            		}
				            		?>				            		
				            	</td>
				            	<td width="130px" style="max-width: 130px;">
				            		<div class="dataTables_filter" align="left">
				            			<input type="time" min="05:00" max="22:00" style="max-width: 110px; margin-left: 0; color: gray;" onchange="verificar_viaticos(this);" value="<?php if($fila->hora_salida != "00:00:00"){ echo substr($fila->hora_salida,0,5); } ?>">
				            		</div>
				            	</td>
				            	<td width="130px" style="max-width: 130px;">
				            		<div class="dataTables_filter" align="left">
				            			<input type="time" min="05:00" max="22:00" style="max-width: 110px; margin-left: 0; color: gray;" onchange="verificar_viaticos(this);" value="<?php if($fila->hora_llegada != "00:00:00"){ echo substr($fila->hora_llegada,0,5); } ?>">
				            		</div>
				            	</td>
				            	<td width="82px" style="max-width: 82px;">
				            		<div class="dataTables_filter" align="left">
				            			<input type="number" placeholder="0.00" min="0.00" value="<?php echo $km; ?>" style="max-width: 60px; margin-left: 0; color: gray;" readonly>
				            		</div>
				            	</td>
				            	<td width="82px" style="max-width: 82px; position: relative;">
				            		<p style="position: absolute;">
				            			<span class="mytooltip tooltip-effect-2">
	                                    <span class="tooltip-item" style="opacity: 0;">Toolt.</span> 
	                                    <span class="tooltip-content clearfix <?php if($fila->viaticos != 0){ echo "bg-danger"; }else{ echo "bg-success"; } ?>" style="padding-left: 10px; padding-right: 10px; width: 200px; margin: 0 0 20px -100px;">
	                                        <span class="tooltip-text text-center" style="padding-right: 0; font-size: 15px;">
	                                            <output style="cursor: pointer; <?php if($fila->viaticos != 0){ echo "display: none;"; } ?>" onclick="verificar_viaticos(this);">Agregar viáticos</output>
	                                            <output style="cursor: pointer; <?php if($fila->viaticos == 0){ echo "display: none;"; } ?>" onclick="eliminar_viaticos(this,'<?php echo $fila->id_empresas_visitadas; ?>');">Quitar viáticos</output>
	                                        </span> 
	                                    </span>
	                                    </span>
                                	</p>
				            		<div class="dataTables_filter" align="left">
				            			<input type="number" placeholder="0.00" min="0.00" value="<?php if($fila->viaticos != 0){ echo number_format($fila->viaticos, 2, '.', ''); }else{ echo "0.00"; } ?>" style="max-width: 60px; margin-left: 0; color: gray;" readonly="">
				            		</div>
				            		<?php $viaticos += number_format($fila->viaticos, 2, '.', ''); ?>
				            	</td>
				            	<td width="82px" style="max-width: 82px;">
				            		<div class="dataTables_filter" align="left">
				            			<input type="number" placeholder="0.00" min="0.00" value="<?php if($fila->pasajes != 0){ echo number_format($fila->pasajes, 2, '.', ''); }else{ echo "0.00"; } ?>" style="max-width: 60px; margin-left: 0; color: gray;">
				            		</div>
				            		<?php $pasajes += number_format($fila->pasajes, 2, '.', ''); ?>
				            	</td>
				            	</tr>
		                        <?php
		                      	if($fila->tipo_destino == "destino_oficina"){
			            			$origen = $fila->nombre_empresa;
			            		}else{
			            			$origen = $fila->nombre_empresa." ".$dm_direccion;
			            		}
		                    }
		            ?>
		            	<tr style="color: black; font-weight: 500;">
		            		<td colspan="5" align="right">TOTAL</td>
		            		<td>
		            			<div class="dataTables_filter" align="left">
			            			<input type="number" id="total_viatico" min="0.00" value="<?php echo number_format($viaticos, 2, '.', ''); ?>" style="max-width: 60px; margin-left: 0; font-weight: 500;" readonly="">
			            		</div>
		            		</td>
		            		<td>
		            			<div class="dataTables_filter" align="left">
			            			<input type="number" id="total_pasaje" min="0.00" value="<?php echo number_format($pasajes, 2, '.', ''); ?>" style="max-width: 60px; margin-left: 0; font-weight: 500;" readonly="">
			            		</div>
		            		</td>
		            	</tr>
		            <?php
		                }
		            ?>
			  	</tbody>
			</table>
		</div>

		<div class="table-responsive">
		<table id="tabla_hora_repetida" name="tabla_hora_repetida" class="table table-hover table-bordered">
			<thead>			
<?php

	if($mision_oficial->num_rows() > 0){ 
        foreach ($mision_oficial->result() as $filam) {
        	$hora_mision = $this->db->query("SELECT MIN(hora_salida) AS hora_salida, MAX(hora_llegada) AS hora_llegada FROM vyp_empresas_visitadas WHERE id_mision_oficial = '".$filam->id_mision_oficial."'");
		    if($hora_mision->num_rows() > 0){
		        foreach ($hora_mision->result() as $filah) {
		        	echo "<tr><td>".substr($filah->hora_salida,0,5)."</td>";
		        	echo "<td>".substr($filah->hora_llegada,0,5)."</td></tr>";
		        }
		    }
        }
    }

?>			</thead>
		</table>
	</div>

		<div class="form-group m-b-5" style="display: none;">
            <textarea class="form-control" id="area" rows="4"></textarea>
            <span class="bar"></span>
            <label for="input7">Text area</label>
        </div>

		<div class="row">
			<div class="form-group col-lg-12 m-b-5" align="right">
		        <button type="button" onclick="verificar_horario_repetido()" class="pull-right btn btn-info">
		        Actualizar solicitud
		        </button>
		    </div>
		</div>