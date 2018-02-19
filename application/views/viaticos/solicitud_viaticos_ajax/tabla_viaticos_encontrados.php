<div class="table-responsive">
    <table class="table table-hover table-bordered" width="100%">
        <thead class="bg-inverse text-white">
            <tr>
                <th>Fecha</th>
                <th>Viático</th>
                <th align="right">Monto ($)</th>
            </tr>
        </thead>
        <tbody>
        	<?php
        		$id_ruta_visitada = $_GET["id_ruta_visitada"];
        		$id_mision = $_GET["id_mision"];

        		$viaticos_ruta = $this->db->query("SELECT v.fecha_ruta, h.* FROM vyp_horario_viatico_solicitud AS v JOIN vyp_horario_viatico AS h ON h.id_horario_viatico = v.id_horario_viatico  AND v.id_ruta_visitada = '".$id_ruta_visitada."' AND v.id_mision = '".$id_mision."' ORDER BY v.fecha_ruta");
        		if($viaticos_ruta->num_rows() > 0){ 
			        foreach ($viaticos_ruta->result() as $fila) {
			?>
				<tr>
					<td><?php echo $fila->fecha_ruta; ?></td>
					<td><?php echo $fila->descripcion; ?></td>
					<td><?php echo $fila->monto; ?></td>
				</tr>
			<?php
			        }
			    }else{
			?>
				<tr>
					<td colspan="3">Ningún registro de viático asociado...</td>
				</tr>
			<?php
			    }
        	?>
        </tbody>
    </table>
</div>