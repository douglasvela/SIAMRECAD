<?php 
    $nr_empleado = $_GET["nr"];

    if(!empty($nr_empleado)){

    $empleado_informacion = $this->db->query("SELECT e.id_empleado, e.nr, cf.id_nivel FROM sir_empleado AS e, sir_cargo_funcional AS cf WHERE cf.id_cargo_funcional IN (SELECT i.id_cargo_funcional FROM sir_empleado_informacion_laboral AS i WHERE e.id_empleado = i.id_empleado AND i.id_empleado_informacion_laboral = (SELECT MAX(i2.id_empleado_informacion_laboral) FROM sir_empleado_informacion_laboral AS i2 WHERE e.id_empleado = i2.id_empleado)) AND e.nr = '".$nr_empleado."'");
    if($empleado_informacion->num_rows() > 0){
        foreach ($empleado_informacion->result() as $filainfoe) {              
        }
    }

    $vyp_info_empleado = $this->db->query("SELECT * FROM vyp_informacion_empleado WHERE nr = '".$nr_empleado."'");
    if($vyp_info_empleado->num_rows() > 0){
        foreach ($vyp_info_empleado->result() as $fila4) {
            $nr_jefe_inmediato = $fila4->nr_jefe_inmediato;
            $nr_jefe_departamento = $fila4->nr_jefe_departamento;
            $id_oficina = $fila4->id_oficina_departamental;
        }
    }else{
        $nr_jefe_inmediato = '';
        $nr_jefe_departamento = '';
        $id_oficina = '';
    }

    
    $id_empleado = $filainfoe->id_empleado;
    $nivel_cargo_funcional = $filainfoe->id_nivel;

?>
<input type="hidden" id="nr_jefe_copy" value="<?php echo $nr_jefe_inmediato; ?>">
<input type="hidden" id="nr_autorizador_copy" value="<?php echo $nr_jefe_departamento; ?>">
<input type="hidden" id="id_oficina_copy" value="<?php echo $id_oficina; ?>">
<div id="cnt_firma_digital"></div>
<?php }else{

?>
    <input type="hidden" id="nr_jefe_copy" value="">
    <input type="hidden" id="nr_autorizador_copy" value="">
    <input type="hidden" id="id_oficina_copy" value="">
    <h5 class="text-muted m-b-0">Seleccione un empleado para configurar sus datos</h5>
    <div id="cnt_firma_digital"></div>
<?php
    }
?>