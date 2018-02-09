        <div class="table-responsive" style="font-size: 14px;">
			<table id="tabla_viaticos" name="tabla_viaticos" class="table table-hover table-bordered" width="100%">
			  	<thead class="bg-inverse text-white" style="font-size: 13px;">
			        <tr>
			        	<th>Fecha misión</th>
			      		<th>Lugar de salida a lugar de llegada</th>
			      		<th>Hora de salida</th>
			      		<th>Hora de llegada</th>
			      		<th>Distancia (Km)</th>
			      		<th>54403 ($)</th>
			      		<th>54401 ($)</th>
                        <th>(*)</th>
			    	</tr>
			  	</thead>
			  	<tbody>
<?php
    $id_mision = $_GET["id_mision"];
    $tipo = $_GET["tipo"];
    $nr_usuario = $_GET["nr"];

    function hora($time){
        return date("H:i A",strtotime(date("Y-m-d")." ".$time));
    }

    function fecha_es($date){
        return date("d-m-Y",strtotime($date));
    }


    $empresa_viatico = $this->db->query("SELECT * FROM vyp_empresa_viatico WHERE id_mision = '".$id_mision."'");
    if($empresa_viatico->num_rows() > 0){
        foreach ($empresa_viatico->result() as $filam) {
?>
        <tr>
            <td><?php echo fecha_es($filam->fecha); ?></td>
            <td><?php echo $filam->nombre_origen." - ".$filam->nombre_destino; ?></td>
            <td><?php echo hora($filam->hora_salida); ?></td>
            <td><?php echo hora($filam->hora_llegada); ?></td>
            <td><?php echo $filam->kilometraje; ?></td>
            <td><?php if(floatval($filam->alojamiento) > 0){ ?>
                 <p><span class="mytooltip tooltip-effect-5" style="z-index: 0;">
                    <span class="tooltip-item nueva_clase"><?php echo number_format((($filam->viatico)+($filam->alojamiento)), 2); ?></span> 
                        <span class="tooltip-content clearfix">
                          <a class="image-popup-no-margins" href="<?php echo base_url(); ?>assets/viaticos/facturas/<?php echo $filam->factura."?".rand(); ?>" title="Estadia en: <?php echo $filam->nombre_destino; ?>"><img src="<?php echo base_url(); ?>assets/viaticos/facturas/<?php echo $filam->factura."?".rand(); ?>" style="height: 140;" width="180"/></a>
                        </span>
                    </span>
                </p>
                <?php }else{
                    echo ($filam->viatico);
                } ?>
            </td>
            <td><?php echo $filam->pasaje; ?></td>
            <?php
                echo "<td>";
                $array = array($filam->id_empresa_viatico, $filam->id_origen, $filam->id_destino,$filam->hora_salida, $filam->hora_llegada, $filam->pasaje,$filam->viatico, $filam->alojamiento, $filam->horarios_viaticos, $filam->fecha, $filam->id_mision, $filam->factura, $filam->kilometraje);
                array_push($array, "edit");
                echo generar_boton($array,"cambiar_editar_viatico","btn-info","fa fa-wrench","Editar");
                unset($array[endKey($array)]); //eliminar el ultimo elemento de un array
                array_push($array, "delete");
                echo generar_boton($array,"cambiar_editar_viatico","btn-danger","fa fa-close","Eliminar");
                echo "</td>";
            ?>
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