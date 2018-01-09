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
         $this->pdf->SetAligns(array('L','C','C','R'));
        $this->pdf->SetWidths(array(65,30,60,30)); 
 
        $viatico = $this->Reportes_viaticos_model->obtenerListaviatico();
        foreach ($viatico->result() as $viaticos) {
        $this->pdf->Row(
        array(trim(utf8_decode($viaticos->nombre_completo)),$viaticos->fecha_mision,utf8_decode($viaticos->actividad_realizada),$viaticos->estado),
        array('RL','RL','RL','RL'),
        array(array('Arial','','10'),array('','',''),array('','',''),array('','','')),
        array(false,false,false,false),
        array(array('220','20','233'),array('','',''),array('','',''),array('55','22','255')),
        array(array('255','211','0'),array('192','192','192'),array('33','92','19'),array('192','10','2')));


          //Se agrega un salto de linea
      
        }
        $this->pdf->Ln(10);
        $viatico = $this->Reportes_viaticos_model->obtenerListaviatico();
        $this->pdf->cabecera(array('NOMBRE','FECHA','ACTIVIDAD','ESTADO'),array('60','20','90','20'),array('5','5','5','5'));
        foreach ($viatico->result() as $viaticos) {
        $this->pdf->TablaBasica(array(utf8_decode($viaticos->nombre_completo),$viaticos->fecha_mision,utf8_decode($viaticos->actividad_realizada),$viaticos->estado),array('60','20','90','20'),array('10','10','10','10'));
         }


       $this->pdf->Output(); //Salida al navegador
    }
  
}
?>