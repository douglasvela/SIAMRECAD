<div class="table-responsive container pull-left">
	<table id="target" class="table table-hover product-overview" style="margin-bottom: 0px;">
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
            	<td colspan="4">No se ha registrado empresas visitadas</td>
            </tr>
            <?php } ?>

	  	</tbody>
	</table>
	<hr style="margin-top: 0px;">

<?php 
    $mision = $this->db->query("SELECT m.*, a.nombre_vyp_actividades AS nombre_actividad FROM vyp_mision_oficial AS m JOIN vyp_actividades AS a ON m.id_actividad_realizada = a.id_vyp_actividades AND id_mision_oficial = '".$id_mision."'");
    if($mision->num_rows() > 0){
        foreach ($mision->result() as $fila) {

            if(!in_array($fila->estado, array(1,3,5)) && $fila->estado < 7){
                if($fila->estado == 0){
                    $restante = 2 - get_days_count($fila->fecha_mision_fin, date("Y-m-d"));
                }else{
                    $restante = 2 - get_days_count(substr($fila->ultima_observacion,0,10), date("Y-m-d"));
                }
                $priority = "text-danger";
                if($restante == 2){
                    $priority = "text-primary";
                }elseif($restante == 1){
                    $priority = "text-warning";
                }elseif($restante == 1){
                    $priority = "text-danger";
                }
                // FAlta php diff without weekend
                if($restante < 0){
                    $vencida = true;
                    $restante = "<h6 class='".$priority."'>PLAZO VENCIDO</h6>";
                }else{
                    $restante = "<h6 class='".$priority."'>RESTA: ".$restante." día(s)</h6>";
                    $vencida = false;
                }
            }else{
                if($fila->estado >= 7){
                    $restante = "";
                }else{
                    $restante = "<h6 class='text-info'>EN ESPERA</h6>";
                }
                $vencida = false;
            }
            if($fila->ultima_observacion == "0000-00-00 00:00:00"){
                $fecha_observacion = "falta";
            }else{
                $fecha_observacion = date("Y-m-d",strtotime($fila->ultima_observacion));
            }

        $array = array($fila->id_mision_oficial, $fila->nr_empleado, date("d-m-Y",strtotime($fila->fecha_mision_inicio)), date("d-m-Y",strtotime($fila->fecha_mision_fin)), $fila->id_actividad_realizada, $fila->detalle_actividad, $fila->estado, $fila->ruta_justificacion, date("Y-m-d",strtotime($fila->fecha_solicitud)), $fecha_observacion, $fila->oficina_solicitante_motorista,$fila->observaciones, $vencida);
            
        }
    }
?>