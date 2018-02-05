<?php
	$id_tipo = $_GET["id_tipo"];
	if($id_tipo == 1){
?>
<div class="form-group">
    <h5>Categoría: <span class="text-danger">*</span></h5>
    <select id="id_categoria" name="id_categoria" class="form-control custom-select"  style="width: 100%" required="">
        <option value="">[Elija el tipo]</option>
        <option class="m-l-50" value="1">Alimentación</option>
        <option class="m-l-50" value="2">Alojamiento</option>
    </select>
    <div class="help-block"></div>
</div>
<?php
	}else{
?>
<div class="form-group">
    <h5>Aplica a: <span class="text-danger">*</span></h5>
    <select id="id_categoria" name="id_categoria" class="form-control custom-select"  style="width: 100%" required="">
        <option value="">[Elija el tipo]</option>
        <option class="m-l-50" value="1">Hora Inicio</option>
        <option class="m-l-50" value="2">Hora Fin</option>
        <option class="m-l-50" value="3">Ambas</option>
    </select>
    <div class="help-block"></div>
</div>
<?php
	}
?>