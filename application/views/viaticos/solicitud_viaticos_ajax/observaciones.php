<?php 
                    $id_mision = $_GET["id_mision"];                   
                    $correlativo = 0;
                    $query = $this->db->query("SELECT * FROM vyp_observacion_solicitud WHERE id_mision = '".$id_mision."' AND corregido = 0 ORDER BY paso");
                    if($query->num_rows() > 0){
                ?>
                <div class="card">
                    <div class="card-header bg-danger">
                        <h4 class="card-title m-b-0 text-white">Observaciones</h4>
                    </div>
                    <div class="card-body b-t" style="padding-top: 5px; padding-bottom: 5px;">


                        <ul class="list-task list-group m-b-0" data-role="tasklist" id="tasklist">

                        <?php 
                            $array = array();
                            if($query->num_rows() > 0){ 
                                foreach ($query->result() as $fila) {
                                    $correlativo++;
                        ?>
                            <li class="list-group-item" data-role="task" style="border: 0; padding: 0px;">
                                <div class="checkbox checkbox-info">
                                    <input type="checkbox" id="inputCall<?php echo $correlativo; ?>" name="inputCall<?php echo $correlativo; ?>">
                                    <label for="inputCall<?php echo $correlativo; ?>" class=""> <span><?php 

                                    if($fila->paso == 1){
                                        array_push($array, $fila->observacion);
                                    }

                                    if($fila->paso==0){
                                        echo "OTROS: ".$fila->observacion;
                                    }else{
                                        echo "PASO ".$fila->paso.": ".$fila->observacion;
                                    } 

                                    ?></span></label>
                                </div>
                            </li>
                        <?php 
                                }
                                echo "<input type='hidden' id='hay_observaciones' value='1'>";
                                echo "<input type='hidden' id='observaciones_actividad' value='".implode(", ",$array)."'>";
                           }else{
                                echo "<input type='hidden' id='hay_observaciones' value='0'>";
                                echo "<input type='hidden' id='observaciones_actividad' value=''>";
                           }
                        ?>
                        
                        </ul>
                    </div>
                </div>
                <?php }else{echo "<input type='hidden' id='hay_observaciones' value='0'>";
                                echo "<input type='hidden' id='observaciones_actividad' value=''>";} ?>