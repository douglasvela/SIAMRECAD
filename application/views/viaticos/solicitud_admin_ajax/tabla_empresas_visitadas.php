
<div class="table-responsive container pull-left">
	<table id="target" class="table table-hover product-overview" style="margin-bottom: 0px;">
	  	<thead class="bg-inverse text-white">
	        <tr>
	      		<th>Nombre de la empresa</th>
	      		<th>Municipio</th>
                <th>Dirección</th>
	      		<th>(*)</th>
	    	</tr>
	  	</thead>
	  	<tbody>

	  		<?php 
	  			$id_mision = $_GET["id_mision"];
                $nr_usuario = $_GET["nr"];

                $info_empleado = $this->db->query("SELECT * FROM vyp_informacion_empleado WHERE nr = '".$nr_usuario."'");

                if($info_empleado->num_rows() > 0){ 
                    foreach ($info_empleado->result() as $filas) {}
                }

                $oficina_origen = $this->db->query("SELECT * FROM vyp_oficinas WHERE id_oficina = '".$filas->id_oficina_departamental."'");

                if($oficina_origen->num_rows() > 0){ 
                    foreach ($oficina_origen->result() as $filaofi) {}
                }

                $id_municipio = $filaofi->id_municipio;
                $id_departamento = $filaofi->id_departamento;

                $empresas = $this->db->query("SELECT * FROM vyp_empresas_visitadas WHERE id_mision_oficial = '".$id_mision."'");

                if($empresas->num_rows() > 0){
                    foreach ($empresas->result() as $fila) {
                        $query = $this->db->query("SELECT * FROM vyp_observacion_solicitud WHERE id_mision = '".$id_mision."' AND corregido = 0 AND paso = '2' AND id_observado = '".$fila->id_empresas_visitadas."'");
                        if($query->num_rows() > 0){
                            echo "<tr class='table-warning' title='".$query->row(0)->observacion."' data-toggle='tooltip'>";
                        }else{
                            echo "<tr>";
                        }
                        ?>
            			<td><?php echo $fila->nombre_empresa; ?><input type="hidden" value="<?php echo $fila->id_empresas_visitadas; ?>"></td>
		            	<td><?php echo $fila->direccion_empresa; ?></td>
                        <td><?php echo $fila->kilometraje." Km"; ?></td>
                        <?php
                        echo "<td align='right'>";
                        	$array = array($fila->id_empresas_visitadas, $fila->id_departamento, $fila->id_municipio, $fila->nombre_empresa, $fila->direccion_empresa, $fila->tipo_destino);
                            if($fila->tipo_destino != "destino_oficina"){
                                echo generar_boton(array($fila->id_empresas_visitadas, $fila->id_departamento, $fila->id_municipio, $fila->nombre_empresa, $fila->direccion_empresa, $fila->tipo_destino, $fila->id_mision_oficial, $fila->id_destino),"editar_empresa_visitada","btn-info","fa fa-wrench","Editar");
                            }
                            array_push($array, "delete");
                            echo generar_boton(array($fila->id_empresas_visitadas),"cambiar_eliminar_destino","btn-danger","fa fa-close","Eliminar");
                        echo "</td>";

                      	echo "</tr>";
                    }

                }else{
            ?>
            <tr>
            	<td>
                    <input type="text" id="nombre_empresa" name="nombre_empresa" class="form-control" placeholder="Ingrese el nombre de la empresa" required>
                </td>
                <td>
                    <select id="municipio" name="municipio" class="select2" style="width: 100%" required>
                        <option value=''>[Elija la municipio]</option>
                        <?php 
                            $municipio = $this->db->query("SELECT * FROM org_municipio m JOIN org_departamento d ON m.id_departamento_pais = d.id_departamento ORDER BY municipio");
                            if($municipio->num_rows() > 0){
                                foreach ($municipio->result() as $fila2) {              
                                   echo '<option class="m-l-50" value="'.$fila2->id_municipio.'">'.$fila2->municipio." / ".$fila2->departamento.'</option>';
                                }
                            }
                        ?>
                    </select>
                </td>
                <td>
                    <textarea id="direccion_empresa" name="direccion_empresa" class="form-control" placeholder="Ingrese la dirección de la empresa" rows="2" required></textarea>
                </td>
            </tr>
            <?php } ?>

	  	</tbody>
	</table>
	<hr style="margin-top: 0px;">