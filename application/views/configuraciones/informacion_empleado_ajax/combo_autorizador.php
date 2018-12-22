<div class="row">
    <div class="col-lg-6">
    </div>
    <div class="form-group col-lg-6"> 
        <h5>Dirección o Jefatura Regional: <span class="text-danger">*</span></h5>
        <select id="nr_autorizador" name="nr_autorizador" class="custom-select" style="width: 100%" required="">
            <option value="">[Elija el autorizador departamental o regional]</option>
            <?php 
                $oficina = $this->db->query("SELECT e.id_empleado, e.nr, UPPER(CONCAT_WS(' ', e.primer_nombre, e.segundo_nombre, e.tercer_nombre, e.primer_apellido, e.segundo_apellido, e.apellido_casada)) AS nombre_completo FROM sir_empleado AS e JOIN vyp_oficina_autorizador AS oa ON oa.nr_autorizador = e.nr AND e.id_estado = '00001' AND oa.id_oficina = '".$_GET["id_oficina"]."' ORDER BY e.primer_nombre, e.segundo_nombre, e.tercer_nombre, e.primer_apellido, e.segundo_apellido, e.apellido_casada");
                if($oficina->num_rows() > 0){
                    foreach ($oficina->result() as $fila2){
                            echo '<option class="m-l-50" value="'.$fila2->nr.'">'.$fila2->nombre_completo.'</option>';
                    }
                }
            ?>
        </select>
    </div>
</div>