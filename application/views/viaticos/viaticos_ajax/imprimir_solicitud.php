<?php


$user = $this->session->userdata('usuario_viatico');
if(empty($user)){
    header("Location: ".site_url()."/login");
    exit();
}

$nr = $this->db->query("SELECT * FROM org_usuario WHERE usuario = '".$user."' LIMIT 1");
$nr_usuario = "";
if($nr->num_rows() > 0){
    foreach ($nr->result() as $fila) { 
        $nr_usuario = $fila->nr; 
    }
}

$id_mision = $_GET["id_mision"];

$empresas = $this->db->query("SELECT * FROM vyp_empresas_visitadas WHERE id_mision_oficial = '".$id_mision."' ORDER BY orden");

$viaticos = 0.00;
$pasajes = 0.00;

$registros = count($empresas->result());

if($empresas->num_rows() > 0){
	foreach ($empresas->result() as $fila) {
		$viaticos += $fila->viaticos;
		$pasajes += $fila->pasajes;
	}
}

$monto = number_format(($pasajes+$viaticos), 2, '.', '');

$decs = (($monto-intval($monto))*100);

if($decs == 0){
	$decs = "00";
}

$formato_dinero = NumeroALetras::convertir($monto)." ".$decs."/100";

function mes($mes){
 setlocale(LC_TIME, 'spanish');  
 $nombre=strftime("%B",mktime(0, 0, 0, $mes, 1, 2000)); 
 return $nombre;
}

?>
<?php
  
class NumeroALetras
{
    private static $UNIDADES = [
        '',
        'UN ',
        'DOS ',
        'TRES ',
        'CUATRO ',
        'CINCO ',
        'SEIS ',
        'SIETE ',
        'OCHO ',
        'NUEVE ',
        'DIEZ ',
        'ONCE ',
        'DOCE ',
        'TRECE ',
        'CATORCE ',
        'QUINCE ',
        'DIECISEIS ',
        'DIECISIETE ',
        'DIECIOCHO ',
        'DIECINUEVE ',
        'VEINTE '
    ];
    private static $DECENAS = [
        'VENTI',
        'TREINTA ',
        'CUARENTA ',
        'CINCUENTA ',
        'SESENTA ',
        'SETENTA ',
        'OCHENTA ',
        'NOVENTA ',
        'CIEN '
    ];
    private static $CENTENAS = [
        'CIENTO ',
        'DOSCIENTOS ',
        'TRESCIENTOS ',
        'CUATROCIENTOS ',
        'QUINIENTOS ',
        'SEISCIENTOS ',
        'SETECIENTOS ',
        'OCHOCIENTOS ',
        'NOVECIENTOS '
    ];
    public static function convertir($number, $moneda = '', $centimos = '', $forzarCentimos = false)
    {
        $converted = '';
        $decimales = '';
        if (($number < 0) || ($number > 999999999)) {
            return 'No es posible convertir el numero a letras';
        }
        $div_decimales = explode('.',$number);
        if(count($div_decimales) > 1){
            $number = $div_decimales[0];
            $decNumberStr = (string) $div_decimales[1];
            if(strlen($decNumberStr) == 2){
                $decNumberStrFill = str_pad($decNumberStr, 9, '0', STR_PAD_LEFT);
                $decCientos = substr($decNumberStrFill, 6);
                $decimales = self::convertGroup($decCientos);
            }
        }
        else if (count($div_decimales) == 1 && $forzarCentimos){
            $decimales = 'CERO ';
        }
        $numberStr = (string) $number;
        $numberStrFill = str_pad($numberStr, 9, '0', STR_PAD_LEFT);
        $millones = substr($numberStrFill, 0, 3);
        $miles = substr($numberStrFill, 3, 3);
        $cientos = substr($numberStrFill, 6);
        if (intval($millones) > 0) {
            if ($millones == '001') {
                $converted .= 'UN MILLON ';
            } else if (intval($millones) > 0) {
                $converted .= sprintf('%sMILLONES ', self::convertGroup($millones));
            }
        }
        if (intval($miles) > 0) {
            if ($miles == '001') {
                $converted .= 'MIL ';
            } else if (intval($miles) > 0) {
                $converted .= sprintf('%sMIL ', self::convertGroup($miles));
            }
        }
        if (intval($cientos) > 0) {
            if ($cientos == '001') {
                $converted .= 'UN ';
            } else if (intval($cientos) > 0) {
                $converted .= sprintf('%s ', self::convertGroup($cientos));
            }
        }
        if(empty($decimales)){
            $valor_convertido = $converted . strtoupper($moneda);
        } else {
            $valor_convertido = $converted . strtoupper($moneda);// . ' CON ' . $decimales . ' ' . strtoupper($centimos);
        }
        return $valor_convertido;
    }
    private static function convertGroup($n)
    {
        $output = '';
        if ($n == '100') {
            $output = "CIEN ";
        } else if ($n[0] !== '0') {
            $output = self::$CENTENAS[$n[0] - 1];
        }
        $k = intval(substr($n,1));
        if ($k <= 20) {
            $output .= self::$UNIDADES[$k];
        } else {
            if(($k > 30) && ($n[2] !== '0')) {
                $output .= sprintf('%sY %s', self::$DECENAS[intval($n[1]) - 2], self::$UNIDADES[intval($n[2])]);
            } else {
                $output .= sprintf('%s%s', self::$DECENAS[intval($n[1]) - 2], self::$UNIDADES[intval($n[2])]);
            }
        }
        return $output;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="http://localhost/viaticos/assets/images/logo_min.png">
    
    <title>SIAMRECAD</title>
</head>
<script type="text/javascript">
	function imprimir(){
		window.print();
	}
</script>
<style type="text/css">
	p{
		margin-bottom: 3px;
		margin-top: 3px;
	}

	table, th, td {
	   border: 1px solid black;
	   border-collapse: collapse;
	   text-align: center;
	   padding: 3px;
       font-size: 13px;
	}
</style>
<body onload="imprimir();" style="margin: 30px;">
<p align="center"><b>MINISTERIO DE TRABAJO Y PREVISIÓN SOCIAL</b></p>
<p align="center"> San Salvador, El Salvador, C.A.</p>
<p style="margin-bottom: 10px; margin-top: 10px;" align="center"><b>POR $&emsp; <?php echo $monto; ?></b><p>
<p align="justify">Recibí del Fondo Circunte del Monto Fijo del Ministerio de Trabajo y Previsión Social, la candidad de <?php echo $formato_dinero; ?> Dólares en concepto de viáticos y pasaje la interior, el nombre y dirección de las empresas visitadas son las siguientes: </p>

<?php
if($empresas->num_rows() > 0){
	foreach ($empresas->result() as $fila) {
		$registros--;
        if($registros > 0){
?>
	<ul style="margin: 0px 3px;">
		<li><?php echo $fila->nombre_empresa.". Dirección: ".$fila->direccion_empresa; ?></li>
	</ul>

<?php
		}
	}
}
?>



<table style="width: 100%;">
  	<thead>
        <tr>
        	<th>Fecha Misión</th>
      		<th>Lugar de salida y llegada</th>
      		<th>Hora de salida</th>
      		<th>Hora de llegada</th>
      		<th>Viaticos ($)</th>
      		<th>Pasaje ($)</th>
    	</tr>
  	</thead>
  	<tbody>

  		<?php 

        $mision = $this->db->query("SELECT * FROM vyp_mision_oficial WHERE id_mision_oficial = '".$id_mision."'");
        if($mision->num_rows() > 0){
            foreach ($mision->result() as $fila2) { $fecha_mision = $fila2->fecha_mision; }
        }

        $fecha_mision = date("d/m/Y",strtotime($fecha_mision));

            $contador=0;
  			if($empresas->num_rows() > 0){
				foreach ($empresas->result() as $fila) {
                  echo "<tr>";
                    ?>
        			<td><?php if($contador==0){ echo $fecha_mision; } ?></td>
	            	<td>
	            		<?php
	            		echo $fila->origen." - ".$fila->direccion_empresa;
	            		?>				            		
	            	</td>
	            	<td><?php echo substr($fila->hora_salida,0,5); ?></td>
	            	<td><?php echo substr($fila->hora_llegada,0,5); ?></td>
	            	<td>
                        <?php echo number_format($fila->viaticos, 2, '.', ''); ?>
	            	</td>
	            	<td>
                        <?php echo number_format($fila->pasajes, 2, '.', ''); ?>
	            	</td>
                    <?php
                  echo "</tr>";
                  $origen = $fila->direccion_empresa;
                  $contador++;
                }
            }
        ?>
        <tr>
        	<td colspan="4">Total</td>
        	<td><?php echo number_format($viaticos, 2, '.', ''); ?></td>
        	<td><?php echo number_format($pasajes, 2, '.', ''); ?></td>
       	</tr>

  	</tbody>
</table>
<br>
<p>Lugar y Fecha: San Salvador, <?php echo date("d")." de ".mes(date("m"))." de ".date("Y");  ?></p>
<?php


$empleado = $this->db->query("SELECT eil.*, e.id_empleado, e.telefono_contacto, UPPER(CONCAT_WS(' ', e.primer_nombre, e.segundo_nombre, e.tercer_nombre, e.primer_apellido, e.segundo_apellido, e.apellido_casada)) AS nombre_completo FROM sir_empleado AS e INNER JOIN sir_empleado_informacion_laboral AS eil ON e.id_empleado = eil.id_empleado AND e.nr = '".$nr_usuario."' ORDER BY eil.fecha_inicio DESC LIMIT 1");

    if($empleado->num_rows() > 0){
        foreach ($empleado->result() as $filae) {              
        }
    }

    $linea_trabajo = $this->db->query("SELECT * FROM org_linea_trabajo WHERE id_linea_trabajo = '".$filae->id_linea_trabajo."'");
    $cargo_nominal = $this->db->query("SELECT * FROM sir_cargo_nominal WHERE id_cargo_nominal = '".$filae->id_cargo_nominal."'");
    $cargo_funcional = $this->db->query("SELECT * FROM sir_cargo_funcional WHERE id_cargo_funcional = '".$filae->id_cargo_funcional."'");

    if($linea_trabajo->num_rows() > 0){
        foreach ($linea_trabajo->result() as $filalt) {              
        }
    }
    if($cargo_nominal->num_rows() > 0){
        foreach ($cargo_nominal->result() as $filacn) {              
        }
    }
    if($cargo_funcional->num_rows() > 0){
        foreach ($cargo_funcional->result() as $filacf) {              
        }
    }

    $cuenta = $this->db->query("SELECT c.*, b.nombre FROM vyp_empleado_cuenta_banco AS c JOIN vyp_bancos AS b ON b.id_banco = c.id_banco WHERE estado = 1");

    if($cuenta->num_rows() > 0){
        foreach ($cuenta->result() as $filac) {}
    }
?>
<br>
<div style="width: 50%; float: left;">
<p>Nombre: <?php echo nombres($filae->nombre_completo); ?></p>
<p>Cargo nominal: <?php echo parrafo($filacn->cargo_nominal); ?></p>
<p>Cargo funcional: <?php echo parrafo($filacf->funcional); ?></p>
<p>Nombre del banco: <?php echo parrafo($filac->nombre); ?></p>
<p>Cuenta del banco No: <?php echo $filac->numero_cuenta; ?></p>
</div>
<div style="width: 50%; float: left;">

<p style="position: relative;">Firma: <img style="max-height: 70px; max-width: 250px; position: absolute; bottom: 5px;" src="<?php echo base_url(); ?>assets/firmas/<?php echo $nr_usuario.".png"; ?>" alt="firma digital">________________________________</p>
<p align="center"><b>Recibido conforme</b></p>
<p>Código: <?php echo $nr_usuario; ?>&emsp;&emsp;Sueldo: $<?php echo number_format($filae->salario, 2, '.', ''); ?></p>
<p>Unidad Pres. / Línea de Trabajo: <?php echo $filalt->linea_trabajo; ?></p>
<p>Teléfono oficial: <?php echo $filae->telefono_contacto; ?></p>
</div>

</body>

</html>