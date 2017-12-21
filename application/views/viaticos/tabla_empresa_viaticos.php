<?php
	$id_mision = $_GET["id_mision"];
	$tipo = $_GET["tipo"];

	echo $tipo;

	if($tipo == "guardar"){
?>

<div class="card">
    <div class="card-header">
    	<div class="card-actions text-black">
            <a style="font-size: 16px;" onclick="cerrar_mantenimiento_viaticos();"><i class="mdi mdi-window-close"></i></a>
        </div>
        <h4 class="card-title m-b-0">Listado de misiones oficiales</h4>
    </div>
    <div class="card-body b-t" style="padding-top: 7px;">
        <div class="table-responsive">
			<table id="tabla_viaticos" class="table table-bordered table-hover">
			  	<thead style="font-size: 15px;">
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
			  	<tbody style="font-size: 15px;">

			  		<?php 
			  			

			  			$id_origen = "1";
			  			$origen = "OFICINA SAN SALVADOR";

		                $empresas = $this->db->query("SELECT * FROM vyp_empresas_visitadas WHERE id_mision_oficial = '".$id_mision."'");
		                if($empresas->num_rows() > 0){
		                    foreach ($empresas->result() as $fila) {
		                    	$id_destino = $fila->id_municipio;
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
				            		echo $fila->direccion_empresa;
				            		?>				            		
				            	</td>
				            	<td><input class="form-control" onchange="verificar_viaticos(this);" type='time'></td>
				            	<td><input class="form-control" onchange="verificar_viaticos(this);" type='time'></td>
				            	<td>
                                    <input type="number" class="form-control" placeholder="0.00" min="0.00" value="<?php echo $km; ?>">
				            	</td>
				            	<td>
                                    <input type="number" readonly="" class="form-control" placeholder="0.00" min="0.00" value="0.00">
				            	</td>
				            	<td>
                                    <input type="number" class="form-control" placeholder="0.00" min="0.00" value="0.00">
				            	</td>
		                        <?php
		                      echo "</tr>";
		                      $origen = $fila->direccion_empresa;
		                    }
		                }
		            ?>

			  	</tbody>
			</table>
		</div>

		<div class="form-group m-b-5">
            <textarea class="form-control" id="area" rows="4" id="input7"></textarea>
            <span class="bar"></span>
            <label for="input7">Text area</label>
        </div>

		<div class="row">
			<div class="form-group col-lg-12 m-b-5" align="right">
		        <button type="button" onclick="recorrer_solicitud()" class="pull-right btn btn-primary">
		        Actualizar solicitud
		        </button>
		    </div>
		</div>

    </div>
</div>

<?php
}else{
?>

<div class="card">
    <div class="card-header">
    	<div class="card-actions text-black">
            <a style="font-size: 16px;" onclick="cerrar_mantenimiento_viaticos();"><i class="mdi mdi-window-close"></i></a>
        </div>
        <h4 class="card-title m-b-0">Listado de misiones oficiales</h4>
    </div>
    <div class="card-body b-t" style="padding-top: 7px;">
        <div class="table-responsive">
			<table id="tabla_viaticos" class="table table-bordered table-hover">
			  	<thead style="font-size: 15px;">
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
			  	<tbody style="font-size: 15px;">

			  		<?php 
			  			

			  			$id_origen = "1";
			  			$origen = "OFICINA SAN SALVADOR";

		                $empresas = $this->db->query("SELECT * FROM vyp_empresas_visitadas WHERE id_mision_oficial = '".$id_mision."'");
		                if($empresas->num_rows() > 0){
		                    foreach ($empresas->result() as $fila) {
		                    	$id_destino = $fila->id_municipio;
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
				            		echo $fila->direccion_empresa;
				            		?>				            		
				            	</td>
				            	<td><input class="form-control" onchange="verificar_viaticos(this);" type='time' value="<?php echo substr($fila->hora_salida,0,5); ?>"></td>
				            	<td><input class="form-control" onchange="verificar_viaticos(this);" type='time' value="<?php echo substr($fila->hora_llegada,0,5); ?>"></td>
				            	<td>
                                    <input type="number" class="form-control" placeholder="0.00" min="0.00" value="<?php echo $km; ?>">
				            	</td>
				            	<td>
                                    <input type="number" readonly="" class="form-control" placeholder="0.00" min="0.00" value="<?php echo $fila->viaticos; ?>">
				            	</td>
				            	<td>
                                    <input type="number" class="form-control" placeholder="0.00" min="0.00" value="<?php echo $fila->pasajes; ?>">
				            	</td>
		                        <?php
		                      echo "</tr>";
		                      $origen = $fila->direccion_empresa;
		                    }
		                }
		            ?>

			  	</tbody>
			</table>
		</div>

		<div class="form-group m-b-5">
            <textarea class="form-control" id="area" rows="4" id="input7"></textarea>
            <span class="bar"></span>
            <label for="input7">Text area</label>
        </div>

		<div class="row">
			<div class="form-group col-lg-12 m-b-5" align="right">
		        <button type="button" onclick="recorrer_solicitud()" class="pull-right btn btn-primary">
		        Actualizar solicitud
		        </button>
		    </div>
		</div>

    </div>
</div>

<?php
}
?>