<?php 
    $nr_empleado = $_GET["nr"];

    if(!empty($nr_empleado)){

    $empleado_informacion = $this->db->query("SELECT e.id_empleado, e.nr, cf.id_nivel FROM sir_empleado AS e, sir_cargo_funcional AS cf WHERE cf.id_cargo_funcional IN (SELECT i.id_cargo_funcional FROM sir_empleado_informacion_laboral AS i WHERE e.id_empleado = i.id_empleado AND i.fecha_inicio = (SELECT MAX(i2.fecha_inicio) FROM sir_empleado_informacion_laboral AS i2 WHERE e.id_empleado = i2.id_empleado)) AND e.nr = '".$nr_empleado."'");
    if($empleado_informacion->num_rows() > 0){
        foreach ($empleado_informacion->result() as $filainfoe) {              
        }
    }

    $vyp_info_empleado = $this->db->query("SELECT * FROM vyp_informacion_empleado WHERE nr = '".$nr_empleado."'");
    if($vyp_info_empleado->num_rows() > 0){
        foreach ($vyp_info_empleado->result() as $fila4) {
            $nr_jefe_inmediato = $fila4->nr_jefe_inmediato;
            $id_oficina = $fila4->id_oficina_departamental;
        }
    }else{
        $nr_jefe_inmediato = '';
        $id_oficina = '';
    }

    
    $id_empleado = $filainfoe->id_empleado;
    $nivel_cargo_funcional = $filainfoe->id_nivel;

?>
<div class="row">
    <div class="form-group col-lg-6"> 
        <h5>Jefe inmediato: <span class="text-danger">*</span></h5>                           
        <select id="id_empleado" name="id_empleado" class="select2" style="width: 100%" required="">
            <option value="">[Elija el jefe inmediato]</option>
            <?php 
                $otro_empleado = $this->db->query("SELECT e.id_empleado, e.nr, UPPER(CONCAT_WS(' ', e.primer_nombre, e.segundo_nombre, e.tercer_nombre, e.primer_apellido, e.segundo_apellido, e.apellido_casada)) AS nombre_completo FROM sir_empleado AS e, sir_cargo_funcional AS cf WHERE cf.id_cargo_funcional IN (SELECT i.id_cargo_funcional FROM sir_empleado_informacion_laboral AS i WHERE e.id_empleado = i.id_empleado AND i.fecha_inicio = (SELECT MAX(i2.fecha_inicio) FROM sir_empleado_informacion_laboral AS i2 WHERE e.id_empleado = i2.id_empleado)) AND e.id_estado = '00001' AND cf.id_nivel <= '".$nivel_cargo_funcional."' AND e.nr <> '".$nr_empleado."' ORDER BY e.primer_nombre, e.segundo_nombre, e.tercer_nombre, e.primer_apellido, e.segundo_apellido, e.apellido_casada");
                if($otro_empleado->num_rows() > 0){
                    foreach ($otro_empleado->result() as $fila) {                    
                        if($fila->nr == $nr_jefe_inmediato){
                            echo '<option class="m-l-50" value="'.$fila->nr.'" selected>'.preg_replace ('/[ ]+/', ' ', $fila->nombre_completo.' - '.$fila->nr).'</option>';
                        }else{
                            echo '<option class="m-l-50" value="'.$fila->nr.'">'.$fila->nombre_completo.'</option>';
                        }        
                    }
                }
            ?>
        </select>
        <div class="help-block"></div>
    </div>
    <div class="form-group col-lg-6"> 
        <h5>Oficina departamental: <span class="text-danger">*</span></h5>
        <select id="id_oficina" name="id_oficina" class="select2" style="width: 100%" required="">
            <option value="">[Elija oficina en que labora]</option>
            <?php 
                $oficina = $this->db->query("SELECT * FROM vyp_oficinas");
                if($oficina->num_rows() > 0){
                    foreach ($oficina->result() as $fila2){
                        if($fila2->id_oficina == $id_oficina){
                            echo '<option class="m-l-50" value="'.$fila2->id_oficina.'" selected>'.$fila2->nombre_oficina.'</option>';
                        }else{
                            echo '<option class="m-l-50" value="'.$fila2->id_oficina.'">'.$fila2->nombre_oficina.'</option>';
                        }
                    }
                }
            ?>
        </select>
        <div class="help-block"></div>
    </div>

</div>

<div id="cnt_firma_digital"></div>

<?php }else{

?>
    <h5 class="text-muted m-b-0">Seleccione un empleado para configurar sus datos</h5>
    <div id="cnt_firma_digital"></div>
<?php
    }
?>