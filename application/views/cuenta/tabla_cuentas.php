<div class="table-responsive">
    <table id="myTable" class="table table-hover product-overview">
        <thead class="bg-inverse text-white">
            <tr>
                <th>Banco</th>
                <th>Numero de cuenta</th>
                <th>(*)</th>
            </tr>
        </thead>
        <tbody>
        <?php 
            $cuenta = $this->db->query("SELECT c.*, b.nombre FROM vyp_empleado_cuenta_banco AS c JOIN vyp_bancos AS b ON b.id_banco = c.id_banco");
            if($cuenta->num_rows() > 0){
                foreach ($cuenta->result() as $fila) {
                  echo "<tr>";
                    echo "<td>".$fila->nombre."</td>";
                    echo "<td>".$fila->numero_cuenta."</td>";
                    echo "<td>";
                    $array = array($fila->id_empleado_banco, $fila->id_banco, $fila->numero_cuenta);
                    array_push($array, "edit");
                    echo generar_boton($array,"cambiar_editar","btn-info","fa fa-wrench","Editar");
                    unset($array[endKey($array)]); //eliminar el ultimo elemento de un array
                    array_push($array, "delete");
                    echo generar_boton($array,"cambiar_editar","btn-danger","fa fa-close","Eliminar");
                    echo "</td>";
                  echo "</tr>";
                }
            }else{
            	echo "<tr>";
                	echo "<td colspan='4'>No hay registros...</td>";
                echo "</tr>";
            }
        ?>
        </tbody>
    </table>
</div>
 