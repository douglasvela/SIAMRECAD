<?php
class Reporte_viatico_pendiente extends CI_Controller {
 
    function __construct()
    {
        parent::__construct();
    }

    function index(){
        $this->load->library('pdf');
        $this->load->model('Reportes_viaticos_model');
       
 
        $this->pdf = new Pdf('P','mm','Letter');
        $this->pdf->SetAutoPageBreak(true, 15);
       $this->pdf->SetMargins(9,3,6);
        $this->pdf->AddPage();
         $x = 1;
        $viatico = $this->Reportes_viaticos_model->obtenerListaviatico();
        foreach ($viatico->result() as $viaticos) {
           // $this->pdf->Text(89,12,$viaticos->nombre_completo,0,'C', 0);
          $this->pdf->Cell(25,5,$viaticos->nombre_completo,'B',0,'L',0);
          $this->pdf->Cell(70,5,$viaticos->fecha_mision,'B',0,'R',0);

          //Se agrega un salto de linea
          $this->pdf->Ln(10);
        }
        
         


       $this->pdf->Output(); //Salida al navegador
    }
  
}
?>