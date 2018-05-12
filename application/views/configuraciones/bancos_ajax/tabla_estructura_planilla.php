

        <div class="table-responsive">
            <table class="table table-hover product-overview">
                <thead class="bg-info text-white">
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>(*)</th>
                    </tr>
                </thead>
                <tbody>
                <?php 

                    $id_banco = $_GET["id_banco"];

                    $estructura = $this->db->query("SELECT * FROM vyp_estructura_planilla WHERE id_banco = '".$id_banco."' ORDER BY orden");

                    if($estructura->num_rows() > 0){
                        $contador = 0;
                        foreach ($estructura->result() as $fila) {
                            $contador++;
                            echo "<tr>";
                            echo "<td>".$fila->orden."</td>";
                            echo "<td>".$fila->nombre_campo."</td>";
                            echo "<td>".$fila->valor_campo."</td>";

                            echo "<td>";
                            $array = array($fila->id_estructura);
                            $array2 = array($fila->id_banco, $fila->id_estructura, $fila->orden, $fila->orden-1);
                            $array3 = array($fila->id_banco, $fila->id_estructura, $fila->orden, $fila->orden+1);

                            if($contador == $estructura->num_rows()){
                                echo generar_boton_bloqueado($array3,"cambiar_orden","btn-default","fa fa-chevron-down","Bajar");
                            }else{
                                echo generar_boton($array3,"cambiar_orden","btn-info","fa fa-chevron-down","Bajar");
                            }

                            if($contador == 1){
                                echo generar_boton_bloqueado($array2,"cambiar_orden","btn-default","fa fa-chevron-up","Subir");
                            }else{
                                echo generar_boton($array2,"cambiar_orden","btn-info","fa fa-chevron-up","Subir");
                            }
                            
                            echo generar_boton($array,"preguntar_eliminar_columna","btn-danger","fa fa-close","Eliminar");
                            echo "</td>";

                           echo "</tr>";
                        }
                    }else{
                        echo "<tr>";
                            echo "<td colspa='4'>No hay registros disponibles</td>";
                        echo "</tr>";
                    }
                ?>
                </tbody>
            </table>
        </div>
   