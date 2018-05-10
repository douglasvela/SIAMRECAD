<?php
	$id_tipo = $_GET["id_tipo"];
	if($id_tipo == 1){
?>
<div class="col-lg-4" style="display: none;">
    <div class="form-group">
        <h5>Categoría: <span class="text-danger">*</span></h5>
        <select id="id_categoria" name="id_categoria" class="form-control custom-select"  style="width: 100%" required="">
            <option class="m-l-50" value="1">Alimentación</option>
        </select>
        <div class="help-block"></div>
    </div>
</div>
<div class="col-lg-4" style="display: none;">
    <div class="form-group">
        <h5>Viático a restringir: <span class="text-danger">*</span></h5>
        <select id="id_viatico_restriccion" name="id_viatico_restriccion" class="form-control custom-select"  style="width: 100%" required="">
            <option value="0">[Elija el viatico a restringir]</option>
        </select>
        <div class="help-block"></div>
    </div>
</div>
<?php
	}else{
?>
<div class="col-lg-4">
    <div class="form-group">
        <h5>Aplica a: <span class="text-danger">*</span></h5>
        <select id="id_categoria" name="id_categoria" class="form-control custom-select"  style="width: 100%" required="">
            <option value="">[Elija el tipo]</option>
            <option class="m-l-50" value="1">Hora Inicio</option>
            <option class="m-l-50" value="2">Hora Fin</option>
            <option class="m-l-50" value="3">Hora inicio y hora fin</option>
            <option class="m-l-50" value="4">Hora inicio ó hora fin</option>
        </select>
        <div class="help-block"></div>
    </div>
</div>
<div class="col-lg-4">
    <div class="form-group">
        <h5>Viático a restringir: <span class="text-danger">*</span></h5>
        <select id="id_viatico_restriccion" name="id_viatico_restriccion" class="form-control custom-select"  style="width: 100%" required="">
            <option value="">[Elija el viatico a restringir]</option>
            <?php
                $horario_viaticos = $this->db->query("SELECT * FROM vyp_horario_viatico WHERE id_tipo = '1' AND estado = '1'");
                $restric_viaticos = $this->db->query("SELECT * FROM vyp_horario_viatico WHERE id_tipo = '2' AND estado = '1'");
                if($horario_viaticos->num_rows() > 0){
                    foreach ($horario_viaticos->result() as $filahor) {
            ?>
                <option class="m-l-50" value="<?php echo $filahor->id_horario_viatico; ?>"><?php echo $filahor->descripcion; ?></option>
            <?php
                    }
                }
            ?>
        </select>
        <div class="help-block"></div>
    </div>
</div>

<?php
	}
?>