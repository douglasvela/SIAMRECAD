<h5>Distancia: <span class="text-danger">*</span></h5>
<div class="input-group">
    <div class="input-group-addon">Km</div>
    <?php 
        	$id_departamento = $_GET["id_departamento"];
        	$id_municipio = $_GET["id_municipio"];
        	$tipo = $_GET["tipo"];
        	$sql = "";
        	$km = "";

        	if($tipo == "oficina"){
        		$sql = " AND opcionruta_vyp_rutas = 'destino_oficina'";
                $distancia = $this->db->query("SELECT * FROM vyp_rutas WHERE id_departamento_vyp_rutas = '".$id_departamento."' AND id_municipio_vyp_rutas = '".$id_municipio."'".$sql);
        	}else if($tipo == "departamento"){
                $sql = " AND opcionruta_vyp_rutas = 'destino_municipio'";
                $distancia = $this->db->query("SELECT * FROM vyp_rutas WHERE id_departamento_vyp_rutas = '".$id_departamento."' AND id_municipio_vyp_rutas = '".$id_municipio."'".$sql);
            }else if($tipo == "mapa"){
                $distancia = $this->db->query("SELECT * FROM vyp_rutas WHERE id_departamento_vyp_rutas = '-----' AND id_municipio_vyp_rutas = '-----'");
            }

            if($distancia->num_rows() > 0){
                foreach ($distancia->result() as $fila2) {              
                   $km = $fila2->km_vyp_rutas;
                }
                echo '<input type="number" id="distancia" name="distancia" class="form-control" required="" placeholder="0.00" data-validation-required-message="Este campo es requerido" min="0.00" step="0.01" readonly value="'.$km.'">';
            }else{
                echo '<input type="number" id="distancia" name="distancia" class="form-control" required="" placeholder="0.00" data-validation-required-message="Este campo es requerido" min="0.00" step="0.01" value="0.00">';
            }
        ?>
    
</div>
<div class="help-block"><?php if($km > 15){ echo "Incluye viáticos"; }else{ echo "No cuenta con viáticos"; } ?></div>