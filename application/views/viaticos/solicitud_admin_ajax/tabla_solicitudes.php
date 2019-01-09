<div class="table-responsive">
    <table id="myTable" class="table table-hover product-overview" width="100%">
        <thead class="bg-info text-white">
            <tr>
                <th style="display: none;">Fecha</th>
                <th width="130px">Fecha</th>
                <th>Actividad realizada</th>
                <th>Persona solicitante</th>
                <th style="min-width: 165px; max-width: 165px;">Estado</th>
                <th width="150px">(*)</th>
            </tr>
        </thead>
        <tbody>
        <?php 
            $add = ""; /*$nr = $_GET["nr"]; $tipo = $_GET["tipo"]; 
            if(!empty($nr)){ $add .= "AND m.nr_empleado = '".$nr."'"; }

            if(!empty($tipo)){
                if($tipo == "1"){ $add .= " AND m.estado = '0'";
                }else if($tipo == "2"){ $add .= " AND (m.estado = '1' || m.estado = '3' || m.estado = '5')";
                }else if($tipo == "3"){ $add .= " AND (m.estado = '2' || m.estado = '4' || m.estado = '6')";
                }else if($tipo == "4"){ $add .= " AND m.estado = '7'";
                }else{ $add .= " AND m.estado = '8'"; }
            }*/

            $mision = $this->db->query("SELECT m.*, a.nombre_vyp_actividades AS nombre_actividad FROM vyp_mision_oficial AS m LEFT JOIN vyp_actividades AS a ON m.id_actividad_realizada = a.id_vyp_actividades  ".$add." WHERE recibida_fisico = 1 ORDER BY m.id_mision_oficial DESC LIMIT 500");
            if($mision->num_rows() > 0){
                $contador = 0;
                /***************** verificacion de permisos **********************/
                $puede_editar = tiene_permiso($segmentos=2,$permiso=4);
                $puede_eliminar = tiene_permiso($segmentos=2,$permiso=3);
                /***************** fin de verificacion de permisos **********************/
                foreach ($mision->result() as $fila) {
                    $contador++;
                  echo "<tr>";
                    echo "<td style='display: none;'>".$contador."</td>";
                    echo "<td>".date("d/m/Y",strtotime($fila->fecha_solicitud))."</td>";
                    echo "<td>".$fila->nombre_actividad."</td>";
                    echo "<td>".$fila->nombre_completo."</td>";
                    echo "<td align='center'>";
                    if($fila->estado == 0){
                        echo '<span style="width: 100%;" class="label label-light-danger">Incompleta</span>';
                    }else if($fila->estado == 1){
                        echo '<span class="label label-light-info">Revisión jefatura inmediata</span>';
                    }else if($fila->estado == 2){
                        echo '<span class="label label-warning">Observación jefatura inmediata</span>';
                    }else if($fila->estado == 3){
                        echo '<span class="label label-light-info">Revisión dirección / jefatura regional</span>';
                    }else if($fila->estado == 4){
                        echo '<span class="label label-warning">Observación dirección / jefatura regional</span>';
                    }else if($fila->estado == 5){
                        echo '<span class="label label-light-info">Revisión fondo circulante</span>';
                    }else if($fila->estado == 6){
                        echo '<span class="label label-warning">Observación fondo circulante</span>';
                    }else if($fila->estado == 7){
                        echo '<span style="width: 100%;" class="label label-success">Aprobada</span>';
                    }else if($fila->estado == 8){
                        echo '<span style="width: 100%;" class="label label-danger">Pagada</span>';
                    };
                    
                    echo "<td>";

                    $array = array($fila->id_mision_oficial);

                    if($puede_editar){
                        array_push($array, "edit");
                        echo generar_boton($array,"cambiar_editar","btn-info","fa fa-wrench","Editar");
                        unset($array[endKey($array)]); //eliminar el ultimo elemento de un array
                    }
                    if($fila->estado == 0){
                        if($puede_eliminar){
                            array_push($array, "delete");
                            echo generar_boton($array,"cambiar_editar","btn-danger","fa fa-close","Eliminar");
                        }
                    }else{
                        echo generar_boton(array($fila->id_mision_oficial),"ver_solicitud_html","btn-default","mdi mdi-file-document","Visualizar solicitud");
                    }

                    echo generar_boton(array($fila->id_mision_oficial, 1),"bitacora","btn-warning","mdi mdi-information-variant","Bitácora de la solicitud");

                    echo "</td>";
                  echo "</tr>";
                }
            }
        ?>
        </tbody>
    </table>
</div>