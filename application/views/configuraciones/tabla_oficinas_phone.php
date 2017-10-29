<div class="card">
    <div class="card-header">
        <div class="card-actions">
           
            <a style="font-size: 16px;" onclick="cerrar_tabla_phone();"><i class="mdi mdi-window-close"></i></a>
                       
        </div>
        <h4 class="card-title m-b-0">Listado de Telefonos</h4>
    </div>
    <div class="card-body b-t"  style="padding-top: 7px;">

        <div class="pull-right">
            <button type="button" onclick="cambiar_nuevo_phone();" class="btn waves-effect waves-light btn-success2"><span class="mdi mdi-plus"></span> Nuevo registro</button>
        </div>
        <?php
                  $oficinas = $this->db->where("id_oficina_vyp_oficnas_telefono",$id);
                  $oficinas = $this->db->get("vyp_oficinas_telefono");

                  $nombre_of = $this->db->where("id_oficina",$id);
                  $nombre_of = $this->db->get("vyp_oficinas");
                  foreach ($nombre_of->result() as $fila_of) {
        ?>
        <label>Nombre de la oficina: <?php echo $fila_of->nombre_oficina; }?></label>
        <div class="table-responsive">
            <table id="myTable_phone" class="table table-bordered">
                <thead class="bg-info text-white">
                    <tr>
                        <th>Id</th>
                        <th>Tel.</th>
                        <th>(*)</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                	
                    if(!empty($oficinas)){
                        foreach ($oficinas->result() as $fila) {
                           echo "<tr>";
                           echo "<td>".$fila->id_vyp_oficinas_telefono."</td>";
                           echo "<td>".$fila->telefono_vyp_oficnas_telefono."</td>";

                           $arrayTel = array($fila->id_vyp_oficinas_telefono,$fila->id_oficina_vyp_oficnas_telefono,$fila->telefono_vyp_oficnas_telefono);
                           echo boton_form_telefono2($arrayTel,"cambiar_editar_phone");
                           

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
        $('#myTable_phone').DataTable();
    });
});
</script>