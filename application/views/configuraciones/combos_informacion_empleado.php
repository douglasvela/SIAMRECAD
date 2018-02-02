<?php 
    $nr_empleado = $_GET["nr"];

    if(!empty($nr_empleado)){

    $empleado_informacion = $this->db->query("SELECT e.id_empleado, e.nr, cf.id_nivel FROM sir_empleado AS e, sir_cargo_funcional AS cf WHERE cf.id_cargo_funcional IN (SELECT i.id_cargo_funcional FROM sir_empleado_informacion_laboral AS i WHERE e.id_empleado = i.id_empleado AND i.fecha_inicio = (SELECT MAX(i2.fecha_inicio) FROM sir_empleado_informacion_laboral AS i2 WHERE e.id_empleado = i2.id_empleado)) AND e.nr = '".$nr_empleado."'");
    if($empleado_informacion->num_rows() > 0){
        foreach ($empleado_informacion->result() as $filainfoe) {              
        }
    }

    echo $id_empleado = $filainfoe->id_empleado;
    echo $nivel_cargo_funcional = $filainfoe->id_nivel;

?>
<div class="row">
    <div class="form-group col-lg-6"> 
        <h5>Jefe inmediato: <span class="text-danger">*</span></h5>                           
        <select id="id_empleado" name="id_empleado" class="select2" style="width: 100%" required="">
            <option value="">[Elija el jefe inmediato]</option>
            <?php 
                $otro_empleado = $this->db->query("SELECT e.id_empleado, e.nr, UPPER(CONCAT_WS(' ', e.primer_nombre, e.segundo_nombre, e.tercer_nombre, e.primer_apellido, e.segundo_apellido, e.apellido_casada)) AS nombre_completo FROM sir_empleado AS e, sir_cargo_funcional AS cf WHERE cf.id_cargo_funcional IN (SELECT i.id_cargo_funcional FROM sir_empleado_informacion_laboral AS i WHERE e.id_empleado = i.id_empleado AND i.fecha_inicio = (SELECT MAX(i2.fecha_inicio) FROM sir_empleado_informacion_laboral AS i2 WHERE e.id_empleado = i2.id_empleado)) AND e.id_estado = '00001' AND cf.id_nivel < '".$nivel_cargo_funcional."' ORDER BY e.primer_nombre, e.segundo_nombre, e.tercer_nombre, e.primer_apellido, e.segundo_apellido, e.apellido_casada");
                if($otro_empleado->num_rows() > 0){
                    foreach ($otro_empleado->result() as $fila) {              
                       echo '<option class="m-l-50" value="'.$fila->nr.'">'.$fila->nombre_completo.'</option>';
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
                    foreach ($oficina->result() as $fila) {              
                       echo '<option class="m-l-50" value="'.$fila->id_oficina.'">'.$fila->nombre_oficina.'</option>';
                    }
                }
            ?>
        </select>
        <div class="help-block"></div>
    </div>
</div>

<div class="row">
    <div class="form-group col-lg-6"> 
        <h5>Región o zona: <span class="text-danger">*</span></h5>
        <select id="id_region" name="id_region" class="select2" style="width: 100%" required="">
            <option value="">[Elija zona laboral]</option>
            <?php 
                $regional = $this->db->query("SELECT * FROM org_pagaduria");
                if($regional->num_rows() > 0){
                    foreach ($regional->result() as $fila) {              
                       echo '<option class="m-l-50" value="'.$fila->id_pagaduria.'">'.$fila->pagaduria.'</option>';
                    }
                }
            ?>
        </select>
        <div class="help-block"></div>
    </div>
    <div class="form-group col-lg-6"> 
        <?php 
        $path = 'assets/firmas/'.$nr_empleado.".png";
        // guardamos la imagen en el server

        if (file_exists($path)) {
        ?>
            <img data-toggle="tooltip" title="Haz clic sobre la imagen para cambiar la firma" style="cursor: pointer;" onclick="mostrar_firma();" src="<?php echo base_url(); ?>assets/firmas/<?php echo $nr_empleado.".png"; ?>" alt="firma digital">
        <?php }else{ ?>
            <h5>Agrega tu firma digital: <span class="text-danger">*</span></h5>
            <button type="button" class="btn btn-block waves-effect waves-light btn-success2" onclick="mostrar_firma();"><i class="mdi mdi-plus"></i> Agregar firma digital</button>
        <?php } ?>
    </div>
</div>

<?php }else{

?>
    Seleccione un empleado
<?php
    }
?>