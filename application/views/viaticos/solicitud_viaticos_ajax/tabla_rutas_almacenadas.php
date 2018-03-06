<div class="table-responsive container">
	<table id="tabla_rutas" class="table table-hover product-overview" style="margin-bottom: 0px;">
	  	<thead class="bg-inverse text-white">
	        <tr>
	      		<th>Empresa visitada</th>
	      		<th>Dirección</th>
                <th>Distancia</th>
	      		<th>(*)</th>
	    	</tr>
	  	</thead>
	  	<tbody>

	  		<?php 
	  			$id_municipio = $_GET["id_municipio"];
	  			$id_oficina = $_GET["id_oficina_origen"];

                $empresas = $this->db->query("SELECT * FROM vyp_rutas WHERE id_municipio_vyp_rutas = '".$id_municipio."' AND id_oficina_origen_vyp_rutas = '".$id_oficina."' AND opcionruta_vyp_rutas = 'destino_mapa'");

                if($empresas->num_rows() > 0 && $id_municipio != ""){
                    foreach ($empresas->result() as $fila) {
                      	echo "<tr>";
                        ?>
            			<td><?php echo $fila->nombre_empresa_vyp_rutas; ?></td>
		            	<td><?php echo $fila->direccion_empresa_vyp_rutas; ?></td>
                        <td><?php echo $fila->km_vyp_rutas; ?></td>
                        <?php
                        echo "<td>";
                        	$array = array($fila->latitud_destino_vyp_rutas, $fila->longitud_destino_vyp_rutas, $fila->nombre_empresa_vyp_rutas, $fila->direccion_empresa_vyp_rutas, $fila->id_vyp_rutas);
                            echo generar_boton($array,"abrir_mapa","btn-info","mdi mdi-send","Abrir en mapa");
                        echo "</td>";

                      	echo "</tr>";
                    }

                }else{
            ?>
            <tr>
            	<td colspan="4">No se han registrado rutas para el municipio</td>
            </tr>
            <?php } ?>

	  	</tbody>
	</table>
	<hr style="margin-top: 0px;">


