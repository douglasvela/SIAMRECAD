<?php
	$id_mision = $_GET["id_mision"];
	$tipo = $_GET["tipo"];
	$nr_usuario = $_GET["nr"];


	$mision_oficial = $this->db->query("SELECT * FROM vyp_mision_oficial WHERE id_mision_oficial = '".$id_mision."'");
    if($mision_oficial->num_rows() > 0){
    	foreach ($mision_oficial->result() as $filam) {
    		$fecha_inicio = $filam->fecha_mision_inicio;
    		$fecha_fin = $filam->fecha_mision_fin;
    	}
    }

    $info_empleado = $this->db->query("SELECT * FROM vyp_informacion_empleado WHERE nr = '".$nr_usuario."'");

    if($info_empleado->num_rows() > 0){ 
        foreach ($info_empleado->result() as $filas) {}
    }


    $id_oficina_origen = "";
    $nombre_oficina_origen = "";

    $oficina_origen = $this->db->query("SELECT * FROM vyp_oficinas WHERE id_oficina = '".$filas->id_oficina_departamental."'");
    if($oficina_origen->num_rows() > 0){ 
        foreach ($oficina_origen->result() as $filaofi) {}
        $id_oficina_origen = $filaofi->id_oficina;
        $nombre_oficina_origen = $filaofi->nombre_oficina;
    }

    function duracion($fechaA, $fechaB){
    	$fechaA = explode("-",$fechaA);
    	$fechaB = explode("-",$fechaB);
    	$fecha1 = mktime(0,0,0,$fechaA[1],$fechaA[2],$fechaA[0]);
    	$fecha2 = mktime(0,0,0,$fechaB[1],$fechaB[2],$fechaB[0]);

    	$diferencia = $fecha2-$fecha1;
		$dias = $diferencia/(60*60*24);
		return $dias;
    }

    $duracion = duracion($fecha_inicio, $fecha_fin);


// Características del navegador
$ua=$this->config->item("navegator");
$navegatorless = false;
if(floatval($ua['version']) < $this->config->item("last_version")){
    $navegatorless = true;
}
?>
<br>
	<h5>Registro de lugares visitados</h5>
	<blockquote>
    <input type="hidden" id="id_empresa_viatico" name="id_empresa_viatico">
    <input type="hidden" id="horarios" name="horarios">
    <input type="hidden" id="band_viatico" name="band_viatico" value="save">
	<div class="row">
		<div class="form-group col-lg-2 <?php if($navegatorless){ echo "pull-left"; } ?>">
            <h5>Fecha visita: <span class="text-danger">*</span></h5>
            <select id="fecha_mision" name="fecha_mision" class="form-control custom-select" required="" onchange="verificar_fecha_diferente();">
                <?php
                	$nuevafecha = $fecha_inicio;
                	for($i=0; $i<=$duracion; $i++){
                		echo '<option value="'.date( 'Y-m-d', strtotime($nuevafecha)).'">'.date( 'd/m/Y', strtotime($nuevafecha)).'</option>';
                		
                        $nuevafecha = strtotime ( '+1 day' , strtotime ( $nuevafecha ) ) ;
                        // if(date( 'w', $nuevafecha) == 6){
                        //     $nuevafecha = strtotime ( '+2 day' , $nuevafecha ) ;
                        //     $i += 2;
                        // }else if(date( 'w', $nuevafecha) == 6){
                        //     $nuevafecha = strtotime ( '+1 day' , $nuevafecha ) ;
                        //     $i++;
                        // }
                		$nuevafecha = date( 'Y-m-d', $nuevafecha);
                	}
                ?>
            </select>
            <div class="help-block"></div>
        </div>
		<div class="form-group col-lg-5 <?php if($navegatorless){ echo "pull-left"; } ?>">   
            <h5>Lugar de salida: <span class="text-danger">*</span></h5>
            <select id="id_origen" name="id_origen" class="form-control custom-select" required="">
                <?php
                	echo '<option value="'.$id_oficina_origen.'">'.$nombre_oficina_origen.'</option>';
                	$origenes = $this->db->query("SELECT * FROM vyp_empresas_visitadas WHERE id_mision_oficial = '".$id_mision."'");
				    if($origenes->num_rows() > 0){
				    	foreach ($origenes->result() as $filao) {
                            $ubicacion = $this->db->query("SELECT m.municipio, d.departamento FROM org_municipio AS m JOIN org_departamento AS d ON d.id_departamento = m.id_departamento_pais AND m.id_municipio = '".$filao->id_municipio."'");
                            if($ubicacion->num_rows() > 0){
                                foreach ($ubicacion->result() as $filaubi) {}
                            }

                            if($filao->tipo_destino == "destino_oficina"){
                                echo '<option value="'.$filao->id_destino.'">'.$filao->nombre_empresa.'</option>';
                            }else{
                                echo '<option value="'.$filao->id_destino.'">'.$filao->nombre_empresa." (".parrafo($filaubi->municipio)."/".parrafo($filaubi->departamento).")".'</option>';
                            }
				    		
				    	}
				    }
                ?>
            </select>
            <div class="help-block"></div>
        </div>
        <div class="form-group col-lg-5 <?php if($navegatorless){ echo "pull-left"; } ?>">   
            <h5>Lugar de llegada: <span class="text-danger">*</span></h5>
            <select id="id_destino" name="id_destino" class="form-control custom-select" required="" onchange="cambiarkilometraje(this.value);">
                <?php
                	$destinos = $this->db->query("SELECT * FROM vyp_empresas_visitadas WHERE id_mision_oficial = '".$id_mision."'");
				    if($destinos->num_rows() > 0){
				    	foreach ($destinos->result() as $filad) {
				    		$ubicacion = $this->db->query("SELECT m.municipio, d.departamento FROM org_municipio AS m JOIN org_departamento AS d ON d.id_departamento = m.id_departamento_pais AND m.id_municipio = '".$filad->id_municipio."'");
                            if($ubicacion->num_rows() > 0){
                                foreach ($ubicacion->result() as $filaubi) {}
                            }

                            if($filad->tipo_destino == "destino_oficina"){
                                echo '<option value="'.$filad->id_destino.'">'.$filad->nombre_empresa.'</option>';
                            }else{
                                echo '<option value="'.$filad->id_destino.'">'.$filad->nombre_empresa." (".parrafo($filaubi->municipio)."/".parrafo($filaubi->departamento).")".'</option>';
                            }
				    	}
				    }
				    echo '<option value="'.$id_oficina_origen.'">'.$nombre_oficina_origen.'</option>';
                ?>
            </select>
            <div class="help-block"></div>
        </div>
	</div>
	<div class="row">
		<div class="form-group col-lg-3 <?php if($navegatorless){ echo "pull-left"; } ?>">
            <h5>Hora salida: <span class="text-danger">*</span></h5>
            <div class="controls">
                <?php if($navegatorless || (floatval($ua['version']) < 57 && floatval($ua['name']) == 'Mozilla Firefox')){ ?>
                    <input type="time" id="hora_salida" name="hora_salida" data-mask="99:99" class="form-control" required="">
                <?php }else{ ?>
                    <input type="time" id="hora_salida" name="hora_salida" class="form-control" required="">
                <?php } ?>
                <div class="help-block"></div>
            </div>
        </div>
        <div class="form-group col-lg-3 <?php if($navegatorless){ echo "pull-left"; } ?>">
            <h5>Hora llegada: <span class="text-danger">*</span></h5>
            <div class="controls">
                <?php if($navegatorless || (floatval($ua['version']) < 57 && floatval($ua['name']) == 'Mozilla Firefox')){ ?>
                    <input type="time" id="hora_llegada" name="hora_llegada" data-mask="99:99" class="form-control" required="">
                <?php }else{ ?>
                    <input type="time" id="hora_llegada" name="hora_llegada" class="form-control" required="">
                <?php } ?>
            </div>
        </div>


        <?php
            $generalidades = $this->db->query("SELECT * FROM vyp_generalidades");

            $id_generalidad = ""; $pasaje = "0.00"; $alojamiento = "0.00";
            if($generalidades->num_rows() > 0){
                foreach ($generalidades->result() as $filag) {
                    $id_generalidad = $filag->id_generalidad;
                    $pasaje = $filag->pasaje;
                    $alojamiento = $filag->alojamiento;
                }
            }
        ?>



        <div class="form-group col-lg-3 <?php if($navegatorless){ echo "pull-left"; } ?>">
            <h5>Pasaje: <span class="text-danger">*</span></h5>
            <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-dollar"></i></div>
                <input type="number" id="pasaje" name="pasaje" onkeyup="validar_monto_pasaje(this, '<?php echo number_format($pasaje,2); ?>');" class="form-control" required="" placeholder="0.00" step="any" value="0.00">
            </div>
            <div class="help-block"></div>
        </div>
        <div class="form-group col-lg-3 <?php if($navegatorless){ echo "pull-left"; } ?>">
            <h5>Viático: <span class="text-danger">*</span></h5>
            <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-dollar"></i></div>
                <input type="number" id="viatico" name="viatico" class="form-control <?php if($navegatorless){ echo "pull-left"; } ?>" required="" step="any" readonly="" placeholder="0.00" value="0.00" <?php if($navegatorless){ echo "style='width: 35%;'"; } ?>>
                <div class="input-group-addon btn btn-success" onclick="verificar_viaticos();" data-toggle="tooltip" title="Verificar viáticos"><i class="fa fa-check"></i></div>
            </div>
            <div class="help-block"></div>
        </div>
	</div>
	<div class="row">
		<div class="form-group col-lg-4 <?php if($navegatorless){ echo "pull-left"; } ?>">   
            <h5>Distancia: <span class="text-danger">*</span></h5>
            <div class="input-group">
            	<div class="input-group-addon">Km</div>
	            <select id="id_distancia" name="id_distancia" class="form-control custom-select"  style="width: 83%" required disabled>
	                <?php
	                	$kilometrajes = $this->db->query("SELECT * FROM vyp_empresas_visitadas WHERE id_mision_oficial = '".$id_mision."'");
					    if($kilometrajes->num_rows() > 0){
					    	foreach ($kilometrajes->result() as $filak) {
					    		echo '<option value="'.$filak->id_destino.'">'.number_format($filak->kilometraje,2).'</option>';
					    	}
					    }
	                ?>
	            </select>
	        </div>
            <div class="help-block"></div>
        </div>
        <div class="form-group col-lg-4 <?php if($navegatorless){ echo "pull-left"; } ?>" style="margin-bottom: 5px;" align="center">
            <h5>¿utilizó alojamiento? <span class="text-danger">*</span></h5>
            <div class="switch">
	            <label>No<input type="checkbox" id="band_factura" onchange="cambiarFactura()"><span class="lever"></span>Sí</label>
	        </div>
        </div>
        <div class="form-group col-lg-3 <?php if($navegatorless){ echo "pull-left"; } ?>" style="display: none;">
            <h5>Salida alojamiento: <span class="text-danger">*</span></h5>
            <select id="fecha_alojamiento" name="fecha_alojamiento" class="form-control custom-select"  style="width: 100%">
                <?php
                    $nuevafecha = $fecha_inicio;
                    for($i=0; $i<=$duracion; $i++){
                        echo '<option value="'.date( 'Y-m-d', strtotime($nuevafecha)).'">'.date( 'd/m/Y', strtotime($nuevafecha)).'</option>';
                        $nuevafecha = strtotime ( '+1 day' , strtotime ( $nuevafecha ) ) ;
                        $nuevafecha = date( 'Y-m-d', $nuevafecha);
                    }
                ?>
            </select>
            <div class="help-block"></div>
        </div>
        <div class="form-group col-lg-4 <?php if($navegatorless){ echo "pull-left"; } ?>" style="margin-bottom: 5px; display: none;" id="cnt_alojamiento">
            <h5>Monto por día: <span class="text-danger">*</span></h5>
            <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-dollar"></i></div>
                <input type="number" id="alojamiento" name="alojamiento" class="form-control" required="" onkeyup="validar_monto_alojamiento(this, '<?php echo number_format($alojamiento,2); ?>');" placeholder="0.00" value="0.00" step="any">
            </div>
            <div class="help-block"></div>
        </div>
	</div>

    <div class="row">
	<div id="factura" style="display: none; width: 100%;">
	    
	</div>

</div>

	<hr style="margin: 10px;">
	<button style="display: none;" type="submit" id="btn_submit3" class="btn waves-effect waves-light btn-success2">submit</button>
    <div align="right" id="btnadd3">
        <button type="submit" class="btn waves-effect waves-light btn-success2"><i class="mdi mdi-plus"></i> Agregar destino</button>
    </div>
    <div align="right" id="btnedit3" style="display: none;">
        <button type="submit" class="btn waves-effect waves-light btn-info"><i class="mdi mdi-pencil"></i> Editar</button>
    </div>
    </blockquote>