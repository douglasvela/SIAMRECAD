<?php 
                    $id_mision = $_GET["id_mision"];
                    $query = $this->db->query("SELECT * FROM vyp_empresas_visitadas WHERE id_mision_oficial = '".$id_mision."' AND observacion <> '' AND observacion IS NOT NULL");

                    $query2 = $this->db->query("SELECT * FROM vyp_observacion_solicitud WHERE id_mision = '".$id_mision."'");

                    if($query->num_rows() > 0 || $query2->num_rows > 0){
                ?>
                <div class="card">
                    <div class="card-header bg-danger">
                        <h4 class="card-title m-b-0 text-white">Observaciones</h4>
                    </div>
                    <div class="card-body b-t">


                        <ul class="list-task list-group m-b-0" data-role="tasklist">

                        <?php 
                            if($query->num_rows() > 0){ 
                                foreach ($query->result() as $fila) {
                        ?>
                            <li class="list-group-item" data-role="task" style="border: 0; padding: 7px;">
                                <div class="checkbox checkbox-info">
                                    <input type="checkbox" id="inputCall" name="inputCheckboxesCall">
                                    <label for="inputCall" class=""> <span><?php echo $fila->observacion; ?></span></label>
                                </div>
                            </li>
                        <?php 
                                }
                           }
                        ?>

                        <?php 
                            if($query2->num_rows() > 0){ 
                                    echo "Más observaciones en el Paso 3";
                        ?>
                            <li class="list-group-item" data-role="task" style="border: 0; padding: 7px;">
                                <div class="checkbox checkbox-info">
                                    <input type="checkbox" id="inputBook" name="inputCheckboxesBook" >
                                    <label for="inputBook" class=""> <span>Mas observaciones en Paso 3</span></label>
                                </div>
                            </li>
                        <?php 
                           }
                        ?>
                        </ul>
                    </div>
                </div>
                <?php } ?>