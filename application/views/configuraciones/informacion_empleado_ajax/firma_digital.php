<?php 
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
    $nr_empleado = $_GET["nr"];

    if(!empty($nr_empleado)){

?>
<div class="row">
    <div class="form-group col-lg-6"> 
        <?php 
        $path = 'assets/firmas/'.$nr_empleado.".png";
        // guardamos la imagen en el server

        if (file_exists($path)) {
             if(tiene_permiso($segmentos=2,$permiso=4)){
        ?>
            <h5>Editar firma escaneada: <span class="text-danger">*</span></h5>
            <button type="button" class="btn btn-block waves-effect waves-light btn-info" onclick="mostrar_firma();"><i class="mdi mdi-pencil"></i> Editar firma escaneada</button>
        <?php } }else{ 
                 if(tiene_permiso($segmentos=2,$permiso=2)){ 
            ?>
            <h5>Agregar firma escaneada: <span class="text-danger">*</span></h5>
            <button type="button" class="btn btn-block waves-effect waves-light btn-success2" onclick="mostrar_firma();"><i class="mdi mdi-plus"></i> Agregar firma escaneada</button>
        <?php } }?>
    </div>
    <div class="form-group col-lg-6"> 
        <?php 
        $path = 'assets/firmas/'.$nr_empleado.".png";
        // guardamos la imagen en el server

        if (file_exists($path)) {
        ?>
            <img data-toggle="tooltip" id="imagen_firma" title="Haz clic sobre la imagen para cambiar la firma" style="cursor: pointer; max-height: 100px; max-width: 450px;" onclick="mostrar_firma();" src="<?php echo base_url(); ?>assets/firmas/<?php echo $nr_empleado.".png?".rand(); ?>" alt="firma escaneada">
        <?php } ?>
    </div>

</div>
<hr>
<?php if(tiene_permiso($segmentos=2,$permiso=4)){?>
<div align="right" id="btnadd">
        <button type="submit" class="btn waves-effect waves-light btn-info"><i class="mdi mdi-pencil"></i> Actualizar información</button>
    </div>

<?php 
	} }
?>