

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

                    $estructura = $this->db->query("SELECT * FROM vyp_estructura_planilla WHERE id_banco = '".$id_banco."'");
                    if($estructura->num_rows() > 0){
                        foreach ($estructura->result() as $fila) {
                            echo "<tr>";
                            echo "<td>".$fila->id_estructura."</td>";
                            echo "<td>".$fila->nombre_campo."</td>";
                            echo "<td>".$fila->valor_campo."</td>";

                            echo "<td>";
                            $array = array($fila->id_estructura);

                            $data['id_modulo'] = $this->uri->segment(4);
                            $data['id_usuario'] = $this->session->userdata('id_usuario_viatico');
                            $data['id_permiso']="3";
                              if(buscar_permiso($data)){
                            echo generar_boton($array,"preguntar_eliminar_columna","btn-danger","fa fa-close","Eliminar");
                            }
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
   