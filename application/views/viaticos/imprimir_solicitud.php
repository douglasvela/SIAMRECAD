<?php
$id_mision = $_GET["id_mision"];

$empresas = $this->db->query("SELECT * FROM vyp_empresas_visitadas WHERE id_mision_oficial = '".$id_mision."'");

$monto = 0.00;

if($empresas->num_rows() > 0){
	foreach ($empresas->result() as $fila) {
		$monto += $fila->viaticos;
		$monto += $fila->pasajes;
	}
}

echo $monto;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="http://localhost/viaticos/assets/images/logo_min.png">
    
    <title>SIAMRECAD</title>
</head>
<style type="text/css">
	p{
		margin-bottom: 3px;
		margin-top: 3px;
	}
</style>
<body>
<p align="center"><b>MINISTERIO DE TRABAJO Y PREVISIÓN SOCIAL</b></p>
<p align="center"> San Salvador, El Salvador, C.A.</p>
</body>

</html>