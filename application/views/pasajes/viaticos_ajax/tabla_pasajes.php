 <div class="table-responsive">
    <table id="myTable" class="table table-hover product-overview" style="margin-bottom: 0px;">
        <thead class="bg-inverse text-white">
            <tr>
                <th>#</th>
                <th>Fecha Solicitud</th>
                <th>NR</th>
                <th>Nombre Solicitante</th>
                 <th style="min-width: 165px; max-width: 165px;">Estado</th>
                 <th>Monto Total</th>
                <th>(*)</th>
            </tr>
        </thead>
        <tbody>
        <?php
          $nr_empleado = $_GET["nr"];
         $fecha_mes = $_GET["fecha1"];
         $estado = $_GET['estado']; 
         $add = "";
         if(!empty($estado)){
            if($estado == "1"){
              $add .= " AND p.estado = '0'";
            }else if($estado == "2"){
              $add .= " AND (p.estado = '1' || p.estado = '3' || p.estado = '5')";
            }else if($estado == "3"){
              $add .= " AND (p.estado = '2' || p.estado = '4' || p.estado = '6')";
            }else if($estado == "4"){
              $add .= " AND p.estado = '7'";
            }else{
              $add .= " AND p.estado = '8'";
            }
          }
      $otrafecha= explode ("-",$fecha_mes); 
      $mes = $otrafecha[1];
      $anios = $otrafecha[0];

      $cuenta = $this->db->query("SELECT * FROM vyp_mision_pasajes AS p WHERE p.nr = '".$nr_empleado."' ".$add." ORDER BY p.id_mision_pasajes DESC LIMIT 50");
      $cont = 0;
            if($cuenta->num_rows() > 0){
                foreach ($cuenta->result() as $fila) {
                  if(!in_array($fila->estado, array(1,3,5)) && $fila->estado < 7){
                    if($fila->estado == 0){
                        $restante = 2 - get_days_count(date("Y-m-t", strtotime($fila->fecha_solicitud_pasaje)), date("Y-m-d"));
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

                  $cont++;
                  echo "<tr>";
                            echo "<td>".$fila->id_mision_pasajes."</td>";
                            echo "<td>".mes(date("m",strtotime($fila->fecha_solicitud_pasaje)))." ".$fila->anio_pasaje."</td>";
                            echo "<td>".$fila->nr."</td>";
                            echo "<td>".$fila->nombre_empleado."</td>";

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
                            } echo "<br>".$restante."</td>";
                            
                            
                            $m_ = $fila->id_mision_pasajes;
                            $monto = $this->db->query("SELECT sum(monto_pasaje) as monto_total FROM vyp_pasajes WHERE id_mision='".$m_."'");
                            if($monto->num_rows() > 0){
                                foreach ($monto->result() as $montofila) {
                                  echo "<td>$ ".number_format($montofila->monto_total,2)."</td>";
                                }
                            }else{
                              echo "<td>0.00</td>";
                            }
                    echo "<td>";
                    $array = array($fila->id_mision_pasajes,date("Y-m-d",strtotime($fila->fecha_solicitud_pasaje)),$fila->nr,$fila->anio_pasaje."-".$fila->mes_pasaje);
                    if($fila->estado < 7){
                        if(tiene_permiso($segmentos=2,$permiso=4)){
                      array_push($array, "edit");
                      echo generar_boton($array,"cambiar_editar","btn-info","fa fa-wrench","Editar");
                      }
                    }
                    
                    echo generar_boton(array($fila->nr,$fila->mes_pasaje,$fila->id_mision_pasajes),"mostrar_reporte","btn-default","fa fa-print","Reporte");
                    echo generar_boton(array($fila->id_mision_pasajes, 1),"bitacora","btn-warning","mdi mdi-information-variant","Bitácora de la solicitud");
                    if($fila->estado == 0){
                      if(tiene_permiso($segmentos=2,$permiso=3)){
                      unset($array[endKey($array)]); //eliminar el ultimo elemento de un array
                      echo generar_boton(array($fila->id_mision_pasajes),"eliminar_solicitud","btn-danger","fa fa-close","Eliminar");
                      }
                    }
                     
                    echo "</td>";
                  echo "</tr>";
                }
            }
        ?>
        </tbody>
    </table>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
</script>