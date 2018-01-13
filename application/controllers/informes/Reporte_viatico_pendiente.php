<?php
class Reporte_viatico_pendiente extends CI_Controller {

    function __construct(){
        parent::__construct();
    }
    function index(){
        $this->load->library('pdf');
        $this->load->model('Reportes_viaticos_model');
        $this->pdf = new Pdf('P','mm','Letter');
        $this->pdf->SetAutoPageBreak(true, 15);
       $this->pdf->SetMargins(9,3,6);
        $this->pdf->AddPage();
         $this->pdf->Cuadros(); //MUESTRA LOS CUADROS
         $this->pdf->SetAligns(array('L','L','L'));
        $this->pdf->SetWidths(array(26,129,28));
        $viatico = $this->Reportes_viaticos_model->obtenerListaviatico();
        foreach ($viatico->result() as $viaticos) {
            $this->pdf->Row(
            array(date('d-m-Y',strtotime($viaticos->fecha_mision)),utf8_decode($viaticos->actividad_realizada),$viaticos->estado),
            array('0','0','0'),
            array(array('Arial','','10'),array('','',''),array('','','')),
            array(false,false,false,false),
            array(array('220','20','233'),array('0','0','0'),array('55','22','255')),
            array(array('255','211','0'),array('33','92','19'),array('192','10','2')));
            //Se agrega un salto de linea
            //otra prueba para atom
            //siguiente prueba
            $this->pdf->Ln(5);
            }
        /*
        $viatico = $this->Reportes_viaticos_model->obtenerListaviatico();
            $this->pdf->cabecera(array('NOMBRE','FECHA','ACTIVIDAD','ESTADO'),array('60','20','90','20'),array('5','5','5','5'));
        for ($i=0; $i < 15; $i++) {
            foreach ($viatico->result() as $viaticos) {
            $this->pdf->TablaBasica(array(utf8_decode($viaticos->nombre_completo),$viaticos->fecha_mision,utf8_decode($viaticos->actividad_realizada),$viaticos->estado),array('60','20','90','20'),array('10','10','10','10'));
             }
        }*/
       //$this->pdf->cuadrogrande(9,90,90,25,0,'D');
       //$this->pdf->cuadrogrande(99,90,90,25,0,'D');
       $this->pdf->Output(); //Salida al navegador
    }

}
?>
