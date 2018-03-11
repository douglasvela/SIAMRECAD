<?php
    $id_mision = $_GET["id_mision"];
    $tipo = $_GET["tipo"];
    $nr_usuario = $_GET["nr"];

?>
        <div class="table-responsive" style="font-size: 14px;">
			<table id="tabla_viaticos" name="tabla_viaticos" class="table table-hover table-bordered" width="100%">
			  	<thead class="bg-inverse text-white" style="font-size: 13px;">
			        <tr>
			        	<th width="75px">Fecha misión</th>
			      		<th>Lugar de salida a lugar de llegada</th>
			      		<th>Hora de salida</th>
			      		<th>Hora de llegada</th>
			      		<th align="right">Viático ($)</th>
			      		<th align="right">Pasaje ($)</th>
                        <th align="right">Aloj. ($)</th>
                        <th width="90px">(*)</th>
			    	</tr>
			  	</thead>
			  	<tbody>
<?php

    function hora($time){
        return date("H:i",strtotime(date("Y-m-d")." ".$time));
    }

    function hora2($time){
        return substr($time,0,5);
    }

    function fecha_es($date){
        return date("d/m/Y",strtotime($date));
    }

    $subviaticos = 0;
    $subpasajes = 0;
    $subalojamientos = 0;    

    $empresa_viatico = $this->db->query("SELECT v.* FROM vyp_empresa_viatico AS v WHERE v.id_mision = '".$id_mision."' ORDER BY v.fecha, v.hora_salida");
    if($empresa_viatico->num_rows() > 0){
        foreach ($empresa_viatico->result() as $filam) {
            $subviaticos += $filam->viatico;
            $subpasajes += $filam->pasaje;
            $subalojamientos += $filam->alojamiento;
?>
        <tr>
            <td><?php echo fecha_es($filam->fecha); ?>
                <input type="hidden" style="width: 25px;" value="<?php echo $filam->id_empresa_viatico; ?>">
                <input type="hidden" style="width: 50px;" value="<?php echo $filam->id_destino; ?>">
                <input type="hidden" style="width: 50px;" value="<?php echo $filam->fecha; ?>">
                <input type="hidden" style="width: 50px;" value="<?php echo $filam->kilometraje; ?>">
            </td>
            <td><?php 
                echo $filam->nombre_origen." - ".$filam->nombre_destino;
            ?>
            </td>
            <td><?php echo hora($filam->hora_salida); ?></td>
            <td><?php echo hora($filam->hora_llegada); ?></td>
            <td align="right" onclick="tabla_viaticos_encontrados('<?php echo $filam->id_empresa_viatico; ?>')"><?php echo $filam->viatico; ?>
                <input type="hidden" value="<?php echo $filam->horarios_viaticos; ?>">
            </td>
            <td align="right"><?php echo $filam->pasaje; ?></td>
            <td align="right"><?php if(floatval($filam->alojamiento) > 0){ ?>
                 <a target="_Blank" href="<?php echo base_url(); ?>assets/viaticos/facturas/<?php echo $filam->factura."?".rand(); ?>" class="nueva_clase text-dark" data-toggle="tooltip" title="Clic para ver factura"><?php echo number_format($filam->alojamiento, 2); ?></a>
                <?php }else{
                    echo $filam->alojamiento;
                } ?>
            </td>

            <?php
                echo "<td>";
                $array = array($filam->id_empresa_viatico, $filam->id_origen, $filam->id_destino,hora2($filam->hora_salida), hora2($filam->hora_llegada), $filam->pasaje,$filam->viatico, $filam->alojamiento, $filam->horarios_viaticos, $filam->fecha, $filam->id_mision, $filam->factura, $filam->kilometraje);
                array_push($array, "edit");
                //echo generar_boton($array,"cambiar_editar_viatico","btn-info","fa fa-wrench","Editar");
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
        <tr>
            <td colspan="4">Total</td>
            <td align="right"><?php echo number_format($subviaticos, 2); ?></td>
            <td align="right"><?php echo number_format($subpasajes, 2); ?></td>
            <td align="right"><?php echo number_format($subalojamientos, 2); ?></td>
            <td align="right">
                <b>$ <?php
                    $total_viaticos = $subviaticos+$subpasajes+$subalojamientos;
                    echo number_format($total_viaticos, 2);
                ?>
                <input type="hidden" id="total_viaticos" name="total_viaticos" value="<?php echo $subviaticos; ?>">
                </b>

            </td>
        </tr>
			  	</tbody>
			</table>
		</div>


		<div class="form-group m-b-5" style="display: none;">
            <textarea class="form-control" id="area" rows="4"></textarea>
            <span class="bar"></span>
            <label for="input7">Text area</label>
        </div>

<div align="right">
    <div class="pull-left">
    <?php
            echo generar_boton_normal(array(),"form_rutas","btn-default","mdi mdi-undo","Volver al paso 2","Volver");
    ?>
    </div>
    <button type="button" onclick="verificar_fechas()" class="pull-right btn btn-info">
    Actualizar solicitud
    </button>
</div>
</div>