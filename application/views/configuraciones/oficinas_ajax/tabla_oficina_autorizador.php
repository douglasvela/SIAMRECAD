<table class="table table-hover product-overview">
    <thead class="bg-inverse text-white">
        <tr>
            <th>#</th>
            <th>Autorizador</th>
            <th>Sistema</th>
            <th width="100px">(*)</th>
        </tr>
    </thead>
    <tbody>
    	<?php 
    		$id_oficina = $_GET["id_oficina"];

            $descripcion = $this->db->query("SELECT oa.*, s.*, e.id_empleado, e.nr, UPPER(CONCAT_WS(' ', e.primer_nombre, e.segundo_nombre, e.tercer_nombre, e.primer_apellido, e.segundo_apellido, e.apellido_casada)) AS nombre_completo FROM sir_empleado AS e JOIN vyp_oficina_autorizador AS oa ON oa.nr_autorizador = e.nr AND e.id_estado = '00001' AND oa.id_oficina = '".$id_oficina."' JOIN org_sistema AS s ON s.id_sistema = oa.id_sistema ORDER BY e.primer_nombre, e.segundo_nombre, e.tercer_nombre, e.primer_apellido, e.segundo_apellido, e.apellido_casada");
            if($descripcion->num_rows() > 0){
            	$contador = 0;
                foreach ($descripcion->result() as $fila) {
                	$contador++;
                    echo "<tr>";
                    echo "<td>".$contador."</td>";
                    echo "<td>".$fila->nombre_completo."</td>";
                    echo "<td>".$fila->nombre_sistema."</td>";
                    echo "<td>";

                    $array = array($fila->id_oficina_autorizador, $fila->nr_autorizador, $fila->id_sistema);
                    array_push($array, "edit");
                    echo generar_boton($array,"cambiar_autorizador","btn-info","fa fa-wrench","Editar");
                    unset($array[endKey($array)]); //eliminar el ultimo elemento de un array
                    array_push($array, "delete");
                    echo generar_boton($array,"cambiar_autorizador","btn-danger","fa fa-close","Eliminar");
                    echo "</td>";

                   echo "</tr>";
                }
            }
        ?>
        <tr>
        	<td colspan="4" align="center">
        		<button type="button" class="btn waves-effect waves-light btn-success2" onclick="nuevo_autorizador()"><span class="fa fa-plus"></span> Clic para agregar un nuevo autorizador</button>
        	</td>
        </tr>
    </tbody>
</table>