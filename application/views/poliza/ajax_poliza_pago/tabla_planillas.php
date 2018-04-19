<?php

$sql = $_POST["sql"];



	//SELECT p0.* FROM vyp_poliza AS p0 WHERE no_poliza = '1' AND mes_poliza = 'ENERO' AND anio = '2017' UNION SELECT p1.* FROM vyp_poliza AS p1 WHERE no_poliza = '2' AND mes_poliza = 'ENERO' AND anio = '2017' UNION SELECT p2.* FROM vyp_poliza AS p2 WHERE no_poliza = '3' AND mes_poliza = 'FEBRERO' AND anio = '2017'



?>
<h5>Bancos encontrados</h5>
<select id="id_banco2" name="id_banco2" class="select2" style="width: 100%" required="">
    <option value="">[Elija el banco]</option>
    <?php 
        $bancos = $this->db->query("SELECT b.* FROM vyp_bancos AS b WHERE b.id_banco IN (SELECT ec.id_banco FROM vyp_empleado_cuenta_banco AS ec WHERE ec.nr IN (SELECT pol.nr FROM (".$sql.") AS pol))");
		    if($bancos->num_rows() > 0){
		        foreach ($bancos->result() as $fila) {              
               echo '<option class="m-l-50" value="'.$fila->id_banco.'">'.$fila->nombre.'</option>';
            }
        }
    ?>
</select>

<br>

<?php
$estruc = "";
$array = array();

$estructura = $this->db->query("SELECT * FROM vyp_estructura_planilla");
if($estructura->num_rows() > 0){
    foreach ($estructura->result() as $fila2) {              
   		$estruc .= $fila2->valor_campo.", ";
   		$buscada = explode(" AS ", $fila2->valor_campo);
   		array_push($array, $buscada[1]);
    }
}
$estruc = substr($estruc, 0,-2);

$consulta = "SELECT ".$estruc." FROM (".$sql.") AS p JOIN sir_empleado AS e ON p.nr = e.nr JOIN vyp_empleado_cuenta_banco AS ec ON ec.nr = p.nr GROUP BY p.nr";

$planilla = $this->db->query($consulta);

$count = count($array);
$planilla->num_rows();
$correlativo = 0;
$resumen = "";
if($planilla->num_rows() > 0){
    foreach ($planilla->result() as $fila3) {
    	$correlativo++;
   		for ($i = 0; $i < $count; $i++) {
   			$otra = $array[$i];
   			if($i == ($count-1)){
   				if($otra == "correlativo"){
   					$resumen .= $correlativo."<br>";
   				}else{
   					if($otra == "no_poliza"){
   						$resumen .= "PAGO DE VIATICOS Y PASAJES POLIZAS ".$fila3->$otra."<br>";
   					}else{
   						$resumen .= $fila3->$otra."<br>";
   					}
   				}
   			}else{
   				if($otra == "correlativo"){
   					$resumen .= $correlativo.",";
   				}else{
   					if($otra == "no_poliza"){
   						$resumen .= "PAGO DE VIATICOS Y PASAJES POLIZAS ".$fila3->$otra.",";
   					}else{
   						$resumen .= $fila3->$otra.",";
   					}
   				}
   			}
		}
    }
}

echo $resumen;

?>