<?php  
 
	include_once('PDF_Valuos.php');
	 

header("Content-Type: text/html;charset=utf-8");

 
$pdf = new PDF('P','mm','Letter');
$pdf->SetAutoPageBreak(true, 15);
$pdf->SetMargins(9,3,6);
$pdf->Setentidad(array($valuePerito[0]));
$pdf->SetUsuario(array($valuePerito[1]));
$pdf->Set_id_val_valuos(array($idvaluos));
$pdf->AddPage();
 


$pdf->Output(); //Salida al navegador
?>