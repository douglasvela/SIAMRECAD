<?php
include_once("../mpdf.php");
$mpdf = new mPDF('R','A4', 11,'Arial');
$mpdf -> SetTitle('Ejemplo de generación de PDF');
$mpdf -> WriteHTML('<body>');
$mpdf -> WriteHTML('Aquí puedes poner todas las etiquetas HTML que mpdf te permite utilizar.');
$mpdf -> WriteHTML('</body>');
$mpdf -> Output('NombreDeTuArchivo.pdf', 'I');
exit;
?>