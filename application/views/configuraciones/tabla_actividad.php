<div class="card">
    <div class="card-header">
        <div class="card-actions">

        </div>
        <h4 class="card-title m-b-0">Listado de Actividades</h4>
    </div>
    <div class="card-body b-t"  style="padding-top: 7px;">
        <div class="pull-right">
          <?php 
          $data['id_modulo'] = $id_modulo;
          $data['id_usuario'] = $this->session->userdata('id_usuario_viatico');
          $data['id_permiso']="2";
          if(buscar_permiso($data)){
          ?>
            <button type="button" onclick="cambiar_nuevo();" class="btn waves-effect waves-light btn-success2"><span class="mdi mdi-plus"></span> Nuevo registro</button>
          <?php
          } 
          ?>
        </div>


        <div class="table-responsive">
          
            <table id="myTable" class="table table-bordered product-overview">
                <thead class="bg-info text-white">
                    <tr>
                        <th>Id</th>
                        <th>Nombre de la Actividad</th>
                        <th>Depende</th>

                        <th style="min-width: 85px;">(*)</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                	$actividad = $this->db->get("vyp_actividades");
                    if($actividad->num_rows() > 0){
                        foreach ($actividad->result() as $fila) {
                          echo "<tr>";
                          echo "<td>".$fila->id_vyp_actividades."</td>";
                          echo "<td>".$fila->nombre_vyp_actividades."</td>";
                          $this->db->where("id_vyp_actividades",$fila->depende_vyp_actividades);
                          $actividad_depende = $this->db->get("vyp_actividades");
                            if($actividad_depende->num_rows()>0){
                                foreach ($actividad_depende->result() as $fila_depende) {
                                    echo "<td>".$fila_depende->nombre_vyp_actividades."</td>";
                                }
                              }else{
                                echo "<td>"."-"."</td>";
                              }
                          echo "<td>";
                          $array = array($fila->id_vyp_actividades,$fila->nombre_vyp_actividades,$fila->depende_vyp_actividades);
                          $data1['id_modulo'] = $this->uri->segment(4);
                          $data1['id_usuario'] = $this->session->userdata('id_usuario_viatico');
                          $data1['id_permiso']="4";
                          if(buscar_permiso($data1)){
                            array_push($array, "edit");
                            echo generar_boton($array,"cambiar_editar","btn-info","fa fa-wrench","Editar");
                          }
                          $data2['id_modulo'] = $this->uri->segment(4);
                          $data2['id_usuario'] = $this->session->userdata('id_usuario_viatico');
                          $data2['id_permiso']="3";
                          if(buscar_permiso($data2)){
                            unset($array[endKey($array)]); //eliminar el ultimo elemento de un array
                            array_push($array, "delete");
                            echo generar_boton($array,"cambiar_editar","btn-danger","fa fa-close","Eliminar");
                          }
                          echo "</td>";
                          echo "</tr>";
                        }
                    }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
$(function(){
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
});
</script>
