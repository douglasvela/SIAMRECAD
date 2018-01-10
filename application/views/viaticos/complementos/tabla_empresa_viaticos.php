<div class="row">
			<div class="form-group col-lg-12 m-b-5" align="right">
		        <button type="button" onclick="form_viaticos()" class="pull-right btn btn-info">
		        Actualizar
		        </button>
		    </div>
		</div>
<?php
	$id_mision = $_GET["id_mision"];
	$tipo = $_GET["tipo"];
?>

        <div class="table-responsive">
			<table id="tabla_viaticos" class="table table-hover table-bordered">
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
			  			

			  			$id_origen = "9";
			  			$origen = "Oficina central (San Salvador)";
			  			$viaticos = 0; $pasajes = 0;

		                $empresas = $this->db->query("SELECT * FROM vyp_empresas_visitadas WHERE id_mision_oficial = '".$id_mision."' ORDER BY orden");
		                if($empresas->num_rows() > 0){
		                    foreach ($empresas->result() as $fila) {
		                    	$id_destino = $fila->id_municipio;

		                    	$direcciones = $this->db->query("SELECT m.*, d.* FROM org_municipio AS m INNER JOIN org_departamento AS d WHERE m.id_departamento_pais = d.id_departamento AND id_municipio = '".$id_destino."'");
		                    	if($direcciones->num_rows() > 0){
		                    		foreach ($direcciones->result() as $fila3) { 
		                    			$dm_direccion = "(".$fila3->departamento."/".$fila3->municipio.")";
		                    		}
		                    	}

		                    	$kilometraje = $this->db->query("SELECT km_vyp_rutas FROM vyp_rutas WHERE id_municipio_vyp_rutas = '".$id_destino."' AND id_oficina_origen_vyp_rutas = ".$id_origen);
		                    	if($kilometraje->num_rows() > 0){
		                    		foreach ($kilometraje->result() as $fila2) { $km = $fila2->km_vyp_rutas; }
		                    	}else{
		                    		$km = "0.00";
		                    	}
		                      echo "<tr>";
		                        ?>
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
				            		<p style="position: absolute;"><span class="mytooltip tooltip-effect-2">
	                                    <span class="tooltip-item" style="opacity: 0;">Toolt.</span> <span class="tooltip-content clearfix <?php if($fila->viaticos != 0){ echo "bg-danger"; }else{ echo "bg-success"; } ?>" style="padding-left: 10px; padding-right: 10px; width: 200px; margin: 0 0 20px -100px;">
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
		                        <?php
		                      	echo "</tr>";
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

		<div class="form-group m-b-5" style="display: block;">
            <textarea class="form-control" id="area" rows="4"></textarea>
            <span class="bar"></span>
            <label for="input7">Text area</label>
        </div>

		<div class="row">
			<div class="form-group col-lg-12 m-b-5" align="right">
		        <button type="button" onclick="validar_solicitud()" class="pull-right btn btn-info">
		        Actualizar solicitud
		        </button>
		    </div>
		</div>