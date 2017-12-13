<div class="table-responsive">
	<table id="target" class="table table-bordered table-hover">
	  	<thead>
	        <tr>
	        	<th style="display: none;">Inputs</th>
	      		<th>Empresa visitada</th>
	      		<th>Dirección</th>
	      		<th>Orden</th>
	      		<th>(*)</th>
	    	</tr>
	  	</thead>
	  	<tbody>

	  		<?php 
	  			$id_mision = $_GET["id_mision"];

                $empresas = $this->db->query("SELECT * FROM vyp_empresas_visitadas WHERE id_mision_oficial = '".$id_mision."'");

                $registros = count($empresas->result());

                if($empresas->num_rows() > 0){
                    foreach ($empresas->result() as $fila) {
                    	$registros--;
                    	if($registros > 0){
                      	echo "<tr>";
                        ?>
                        <td style="display: none;">
		            		<input type="text" class="form-control" value="<?php echo $fila->id_municipio; ?>">
		            		<input type="text" class="form-control" value="<?php echo $fila->nombre_empresa; ?>">
		            		<input type="text" class="form-control" value="<?php echo $fila->direccion_empresa; ?>">
		            		<input type="text" class="form-control" value="<?php echo $fila->tipo_destino; ?>">
		            		<input type="text" class="form-control" value="<?php echo $fila->id_departamento ?>">
            			</td>
            			<td><?php echo $fila->nombre_empresa; ?></td>
		            	<td><?php echo $fila->direccion_empresa; ?></td>
		            	<td><button type="button" onclick="remove(this,'editar');" class="btn btn-xs btn-danger"><span class="fa fa-remove"></span></button></td>
		            	<td>
		            		<button type="button" onclick="subirFila(this, 'editar');" data-toggle="tooltip" title="Subir la fila" class="btn btn-xs btn-success"><span class="fa fa-chevron-up"></span></button>
		            		<button type="button" onclick="bajarFila(this, 'editar');" data-toggle="tooltip" title="Bajar la fila" class="btn btn-xs btn-success"><span class="fa fa-chevron-down"></span></button>
				        </td>
                        <?php
                      	echo "</tr>";
                  		}
                    }
                }
            ?>

	  	</tbody>
	</table>
</div>