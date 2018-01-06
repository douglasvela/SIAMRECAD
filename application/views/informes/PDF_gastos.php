<?php
require('../fpdf/fpdf.php');
 
class PDF extends FPDF
{
/****************************************************************************************************/
var $widths;
var $aligns;

function SetWidths($w)
{
    //Set the array of column widths
    $this->widths=$w;
}

function SetAligns($a)
{
    //Set the array of column alignments
    $this->aligns=$a;
}

function Row($data,$dibujacelda,$fuente,$v=true)
{
    //Calculate the height of the row
    $nb=0;
    for($i=0;$i<count($data);$i++)
        $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
    $h=4*$nb;
    //Issue a page break first if needed
    $this->CheckPageBreak($h);
    //Draw the cells of the row
    for($i=0;$i<count($data);$i++)
    {
        $w=$this->widths[$i];
        $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
        //Save the current position
        $x=$this->GetX();
        $y=$this->GetY();
        //Draw the border
        
        $this->Rect($x,$y,$w,$h);
        $this->SetFont($fuente[$i][0],$fuente[$i][1],$fuente[$i][2]);
        $this->MultiCell($w,4,$data[$i],$dibujacelda[$i],$a,$v);
        //Put the position to the right of the cell
        $this->SetXY($x+$w,$y);
    }
    //Go to the next line
    $this->Ln($h);
}

function CheckPageBreak($h)
{
    //If the height h would cause an overflow, add a new page immediately
    if($this->GetY()+$h>$this->PageBreakTrigger)
        $this->AddPage($this->CurOrientation);
}

function NbLines($w,$txt)
{
    //Computes the number of lines a MultiCell of width w will take
    $cw=&$this->CurrentFont['cw'];
    if($w==0)
        $w=$this->w-$this->rMargin-$this->x;
    $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
    $s=str_replace("\r",'',$txt);
    $nb=strlen($s);
    if($nb>0 and $s[$nb-1]=="\n")
        $nb--;
    $sep=-1;
    $i=0;
    $j=0;
    $l=0;
    $nl=1;
    while($i<$nb)
    {
        $c=$s[$i];
        if($c=="\n")
        {
            $i++;
            $sep=-1;
            $j=$i;
            $l=0;
            $nl++;
            continue;
        }
        if($c==' ')
            $sep=$i;
        $l+=$cw[$c];
        if($l>$wmax)
        {
            if($sep==-1)
            {
                if($i==$j)
                    $i++;
            }
            else
                $i=$sep+1;
            $sep=-1;
            $j=$i;
            $l=0;
            $nl++;
        }
        else
            $i++;
    }
    return $nl;
}

function Header()
{
$this->Image('logo.gif',13,10,38,13);

$this->leyendasColor(145,10,'Arial','B',10,135,8,"Visítanos: www.cajasanvicente.com",0,109,82);
$this->leyendasColor(149,14,'Arial','B',10,135,8,"E-mail: info@cajasanvicente.com",0,109,82);//167,194,39
$this->Ln(5);
}

function Footer()
{
    /*$this->leyendasColor(12,252,'Arial','B',10,135,8,('__________________________'),0,0,0);
    $this->leyendasColor(75,252,'Arial','B',10,135,8,('__________________________'),0,0,0);
    $this->leyendasColor(140,252,'Arial','B',10,135,8,('__________________________'),0,0,0);*/
    $this->leyendasColor(55,266,'Arial','B',10,135,8,'5ta Calle Oriente Barrio El Santuario, San Vicente, El Salvador',0,109,82);
    $this->leyendasColor(75,270,'Arial','B',10,135,8,('Créditos: 2347-3309, FAX: 2393-4555'),0,109,82);


}
/**********************************************************************************************/









    function cabeceraHorizontal($cabecera)
    {
        $this->SetXY(10, 10);
        $this->SetFont('Arial','B',10);
        $this->SetFillColor(2,157,116);//Fondo verde de celda
        $this->SetTextColor(240, 255, 240); //Letra color blanco
        $ejeX = 10;
        foreach($cabecera as $fila)
        {
            $this->RoundedRect($ejeX, 10, 30, 7, 2, 'FD');
            $this->CellFitSpace(30,7, utf8_decode($fila),0, 0 , 'C');
            $ejeX = $ejeX + 30;
        }
    }

 
    function datosHorizontal($datos)
    {
        $this->SetXY(10,17);
        $this->SetFont('Arial','',10);
        $this->SetFillColor(229, 229, 229); //Gris tenue de cada fila
        $this->SetTextColor(3, 3, 3); //Color del texto: Negro
        $bandera = false; //Para alternar el relleno
        $ejeY = 17; //Aquí se encuentra la primer CellFitSpace e irá incrementando
        $letra = 'D'; //'D' Dibuja borde de cada CellFitSpace -- 'FD' Dibuja borde y rellena
        foreach($datos as $fila)
        {
            //Por cada 3 CellFitSpace se crea un RoundedRect encimado
            //El parámetro $letra de RoundedRect cambiará en cada iteración
            //para colocar FD y D, la primera iteración es D
            //Solo la celda de enmedio llevará bordes, izquierda y derecha
            //Las celdas laterales colocarlas sin borde
            $this->RoundedRect(10, $ejeY, 90, 7, 2, $letra);
            $this->CellFitSpace(30,7, utf8_decode($fila['nombre']),0, 0 , 'L' );
            $this->CellFitSpace(30,7, utf8_decode($fila['apellido']),'LR', 0 , 'L' );
            $this->CellFitSpace(30,7, utf8_decode($fila['matricula']),0, 0 , 'L' );
 
            $this->Ln();
            //Condición ternaria que cambia el valor de $letra
            ($letra == 'D') ? $letra = 'FD' : $letra = 'D';
            //Aumenta la siguiente posición de Y (recordar que X es fijo)
            //Se suma 7 porque cada celda tiene esa altura
            $ejeY = $ejeY + 7;
        }
    }
    function cuadropequeño($ejex,$ejey,$ancho,$alto,$curva,$relleno){
         $this->SetXY($ejex,$ejey);
         $this->RoundedRect($ejex, $ejey, $ancho, $alto, $curva, $relleno);
    }
    function leyendas($x,$y,$font,$estilo,$tamaño,$ancho,$alto,$datos)
    {
        $this->SetXY($x,$y);
        $this->SetFont($font,$estilo,$tamaño);
       // $this->SetFillColor(229, 229, 229); //Gris tenue de cada fila
        //$this->SetTextColor(3, 3, 3); //Color del texto: Negro
        $this->CellFitSpace($ancho,$alto, utf8_decode($datos),0, 0 , 'L' );
        $this->Ln();
            
    }
    function leyendasColor($x,$y,$font,$estilo,$tamaño,$ancho,$alto,$datos,$color1,$color2,$color3)
    {
        $this->SetXY($x,$y);
        $this->SetFont($font,$estilo,$tamaño);
       // $this->SetFillColor(229, 229, 229); //Gris tenue de cada fila
        $this->SetTextColor($color1, $color2, $color3); //Color del texto: Negro
        $this->CellFitSpace($ancho,$alto, utf8_decode($datos),0, 0 , 'L' );
        $this->Ln();
            
    }
    function multicelda($x,$y,$multiAncho,$multiAlto,$font,$estilo,$tamaño,$ancho,$alto,$datos,$justi='')
    {
        $this->SetXY($x,$y);
        $this->SetFont($font,$estilo,$tamaño);
      //  $this->SetFillColor(229, 229, 229); //Gris tenue de cada fila
        //$this->SetTextColor(3, 3, 3); //Color del texto: Negro
        //$this->CellFitSpace($ancho,$alto, utf8_decode($datos),0, 0 , 'L' );
        $this->MultiCell($multiAncho,$multiAlto,$datos,0, $justi);
        $this->Ln();
            
    }
    function cuadrogrande($ejex,$ejey,$ancho,$alto,$curva,$relleno){
        /*
        datos:
        1er valor: ancho de lado izquierdo
        2do valor: ancho de arriba
        3er valor: ancho del cuadro
        4to valor: alto del cuadro
        5to valor: ancho de las esquinas
        6to valor: D: dibuja borde; FD: dibuja borde y rellena
        */
         $this->SetXY($ejex,$ejey);
         $this->RoundedRect($ejex, $ejey, $ancho, $alto, $curva, $relleno);
         
    }
    function tablaHorizontal($cabeceraHorizontal, $datosHorizontal)
    {
        $this->cabeceraHorizontal($cabeceraHorizontal);
        $this->datosHorizontal($datosHorizontal);
    }
 
    //**************************************************************************************************************
    function CellFit($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='', $scale=false, $force=true)
    {
        //Get string width
        $str_width=$this->GetStringWidth($txt);
 
        //Calculate ratio to fit cell
        if($w==0)
            $w = $this->w-$this->rMargin-$this->x;
        $ratio = ($w-$this->cMargin*2)/$str_width;
 
        $fit = ($ratio < 1 || ($ratio > 1 && $force));
        if ($fit)
        {
            if ($scale)
            {
                //Calculate horizontal scaling
                $horiz_scale=$ratio*100.0;
                //Set horizontal scaling
                $this->_out(sprintf('BT %.2F Tz ET',$horiz_scale));
            }
            else
            {
                //Calculate character spacing in points
                $char_space=($w-$this->cMargin*2-$str_width)/max($this->MBGetStringLength($txt)-1,1)*$this->k;
                //Set character spacing
                $this->_out(sprintf('BT %.2F Tc ET',$char_space));
            }
            //Override user alignment (since text will fill up cell)
            $align='';
        }
 
        //Pass on to Cell method
        $this->Cell($w,$h,$txt,$border,$ln,$align,$fill,$link);
 
        //Reset character spacing/horizontal scaling
        if ($fit)
            $this->_out('BT '.($scale ? '100 Tz' : '0 Tc').' ET');
    }
 
    function CellFitSpace($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='')
    {
        $this->CellFit($w,$h,$txt,$border,$ln,$align,$fill,$link,false,false);
    }
 
    //Patch to also work with CJK double-byte text
    function MBGetStringLength($s)
    {
        if($this->CurrentFont['type']=='Type0')
        {
            $len = 0;
            $nbbytes = strlen($s);
            for ($i = 0; $i < $nbbytes; $i++)
            {
                if (ord($s[$i])<128)
                    $len++;
                else
                {
                    $len++;
                    $i++;
                }
            }
            return $len;
        }
        else
            return strlen($s);
    }
//**********************************************************************************************
 
 function RoundedRect($x, $y, $w, $h, $r, $style = '', $angle = '1234')
    {
        $k = $this->k;
        $hp = $this->h;
        if($style=='F')
            $op='f';
        elseif($style=='FD' or $style=='DF')
            $op='B';
        else
            $op='S';
        $MyArc = 4/3 * (sqrt(2) - 1);
        $this->_out(sprintf('%.2f %.2f m', ($x+$r)*$k, ($hp-$y)*$k ));
 
        $xc = $x+$w-$r;
        $yc = $y+$r;
        $this->_out(sprintf('%.2f %.2f l', $xc*$k, ($hp-$y)*$k ));
        if (strpos($angle, '2')===false)
            $this->_out(sprintf('%.2f %.2f l', ($x+$w)*$k, ($hp-$y)*$k ));
        else
            $this->_Arc($xc + $r*$MyArc, $yc - $r, $xc + $r, $yc - $r*$MyArc, $xc + $r, $yc);
 
        $xc = $x+$w-$r;
        $yc = $y+$h-$r;
        $this->_out(sprintf('%.2f %.2f l', ($x+$w)*$k, ($hp-$yc)*$k));
        if (strpos($angle, '3')===false)
            $this->_out(sprintf('%.2f %.2f l', ($x+$w)*$k, ($hp-($y+$h))*$k));
        else
            $this->_Arc($xc + $r, $yc + $r*$MyArc, $xc + $r*$MyArc, $yc + $r, $xc, $yc + $r);
 
        $xc = $x+$r;
        $yc = $y+$h-$r;
        $this->_out(sprintf('%.2f %.2f l', $xc*$k, ($hp-($y+$h))*$k));
        if (strpos($angle, '4')===false)
            $this->_out(sprintf('%.2f %.2f l', ($x)*$k, ($hp-($y+$h))*$k));
        else
            $this->_Arc($xc - $r*$MyArc, $yc + $r, $xc - $r, $yc + $r*$MyArc, $xc - $r, $yc);
 
        $xc = $x+$r ;
        $yc = $y+$r;
        $this->_out(sprintf('%.2f %.2f l', ($x)*$k, ($hp-$yc)*$k ));
        if (strpos($angle, '1')===false)
        {
            $this->_out(sprintf('%.2f %.2f l', ($x)*$k, ($hp-$y)*$k ));
            $this->_out(sprintf('%.2f %.2f l', ($x+$r)*$k, ($hp-$y)*$k ));
        }
        else
            $this->_Arc($xc - $r, $yc - $r*$MyArc, $xc - $r*$MyArc, $yc - $r, $xc, $yc - $r);
        $this->_out($op);
    }
 
    function _Arc($x1, $y1, $x2, $y2, $x3, $y3)
    {
        $h = $this->h;
        $this->_out(sprintf('%.2f %.2f %.2f %.2f %.2f %.2f c ', $x1*$this->k, ($h-$y1)*$this->k,
            $x2*$this->k, ($h-$y2)*$this->k, $x3*$this->k, ($h-$y3)*$this->k));
    }
} // FIN Class PDF
?>