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

            $descripcion = $this->db->query("SELECT * FROM vyp_oficina_autorizador WHERE id_oficina = '".$id_oficina."'");
            if($descripcion->num_rows() > 0){
            	$contador = 0;
                foreach ($descripcion->result() as $fila) {
                	$contador++;
                    echo "<tr>";
                    echo "<td>".$contador."</td>";
                    echo "<td>".$fila->nr_autorizador."</td>";
                    echo "<td>".$fila->id_sistema."</td>";
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