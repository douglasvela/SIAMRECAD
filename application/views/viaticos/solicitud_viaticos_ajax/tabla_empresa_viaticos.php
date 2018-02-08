        <div class="table-responsive">
			<table id="tabla_viaticos" name="tabla_viaticos" class="table table-hover table-bordered" width="100%">
			  	<thead class="bg-inverse text-white" style="font-size: 15px;">
			        <tr>
			        	<th>Fecha misión</th>
			      		<th>Lugar de salida</th>
			      		<th>Lugar de llegada</th>
			      		<th>Hora de salida</th>
			      		<th>Hora de llegada</th>
			      		<th>Distancia (Km)</th>
			      		<th>Viaticos ($)</th>
			      		<th>Pasaje ($)</th>
			    	</tr>
			  	</thead>
			  	<tbody>
<?php
    $id_mision = $_GET["id_mision"];
    $tipo = $_GET["tipo"];
    $nr_usuario = $_GET["nr"];


    $empresa_viatico = $this->db->query("SELECT * FROM vyp_empresa_viatico WHERE id_mision = '".$id_mision."'");
    if($empresa_viatico->num_rows() > 0){
        foreach ($empresa_viatico->result() as $filam) {
?>
        <tr>
            <td><?php echo $filam->fecha; ?></td>
            <td><?php echo $filam->nombre_origen; ?></td>
            <td><?php echo $filam->nombre_destino; ?></td>
            <td><?php echo $filam->hora_salida; ?></td>
            <td><?php echo $filam->hora_llegada; ?></td>
            <td><?php echo $filam->fecha; ?></td>
            <td><?php echo $filam->viatico; ?>
                <?php if(floatval($filam->alojamiento)){ ?>
                 <p><span class="mytooltip tooltip-effect-5" style="z-index: 0;">
                    <span class="tooltip-item">Fact.</span> 
                        <span class="tooltip-content clearfix">
                          <a class="image-popup-no-margins" href="<?php echo base_url(); ?>assets/viaticos/facturas/<?php echo $filam->factura."?".rand(); ?>" title="Estadia en: <?php echo $filam->nombre_destino; ?>"><img src="<?php echo base_url(); ?>assets/viaticos/facturas/<?php echo $filam->factura."?".rand(); ?>" style="height: 140;" width="180"/></a>
                        </span>
                    </span>
                </p>
                <?php } ?>
            </td>
            <td><?php echo $filam->pasaje; ?></td>
        </tr>
<?php
        }
    }

?>
			  	</tbody>
			</table>
		</div>


		<div class="form-group m-b-5" style="display: none;">
            <textarea class="form-control" id="area" rows="4"></textarea>
            <span class="bar"></span>
            <label for="input7">Text area</label>
        </div>

		<div class="row">
			<div class="form-group col-lg-12 m-b-5" align="right">
		        <button type="button" onclick="tabla_empresas_viaticos('guardar');" class="pull-right btn btn-info">
		        Actualizar solicitud
		        </button>
		    </div>
		</div>