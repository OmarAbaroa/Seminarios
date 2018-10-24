<?php

namespace App;

use Anouar\Fpdf\Fpdf;
use Anouar\Fpdf\MakeFont\MakeFont;
class PDFConstanciasAlumnos extends Fpdf
{
    private $titulo = '';
    private $tarjeta = '';

    function __construct($orientacion, $medida, $tamanio, $titulo, $tarjeta)
    {
        $this->titulo = 'TITULO';
        return parent::__construct('P', 'mm', 'Letter');
    }

    function Header()
    {

        $this->AddFont('MSSansSerif', '', 'MSSansSerif.php');
        $this->AddFont('calibri', '', 'calibri.php');
        $this->AddFont('calibrib', '', 'calibrib.php');
        $this->AddFont('SoberanaSans-Regular', '', 'SoberanaSans-Regular.php');
        $this->AddFont('SoberanaSans-Black', '', 'SoberanaSans-Black.php');

        //Fecha y número de tarjeta
        setlocale(LC_ALL,'es_MX', 'es_MX', 'esp');

        $encabezado1 = '"70 Aniversario de la Escuela Superior de Ingeniería Química e Industrias Extractivas"';
        $encabezado2 = '"40 Aniversario del CECyT 15 Diódoro Antúnez Echegaray"';
        $encabezado3 = '"30 Aniversario del Centro de Innovación y Desarrollo Tecnológico en Cómputo"';
        $encabezado4 = '"25 Aniversario de la Escuela Superior de Cómputo"';
        
        $this->SetMargins(20,10,20);
        $this->Image('img/encabezadoSEP.png', 20,10,68,20,'PNG');
        $this->Image('img/ENCABEZADO_DES_2.png', 138,10,58,15,'PNG');
        $this->Image('img/fondo.jpg', 36,69.75,144,139.5,'JPEG');

        $this->SetXY(90,27);
        $this->SetFont('Arial', '', 6.5);
        $this->Cell(0, 3, utf8_decode($encabezado1), 0, 2, 'R');
        $this->Cell(0, 3, utf8_decode($encabezado2), 0, 2, 'R');
        $this->Cell(0, 3, utf8_decode($encabezado3), 0, 2, 'R');
        $this->Cell(0, 3, utf8_decode($encabezado4), 0, 2, 'R');

        $this->SetFont('SoberanaSans-Regular', '', 11);
        $this->SetXY(20,55.8);
        $this->Cell(0, 3, utf8_decode("Otorga la presente"), 0, 2, 'C');
        
        $this->SetXY(20,70);
        $this->SetFontSize(16);
        $this->Cell(0, 3, utf8_decode("CONSTANCIA"), 0, 2, 'C');
        
        $this->SetFontSize(11);
        $this->SetXY(20,78);
        $this->Cell(0, 3, utf8_decode("a"), 0, 2, 'C');
        
        
        
        
        
    }

    function Footer()
    {
        
        $this->SetY(183);
        $this->SetFont('calibrib', '', 11);
        $this->Cell(0,3,utf8_decode('ATENTAMENTE'),0,2,'C');
        //$this->SetY(180);
        $this->Cell(0,3,utf8_decode('"La Técnica al Servicio de la Patria"'),0,2,'C');
        $this->SetY(214);
        $this->SetFont('calibrib', '', 12);
        $this->Cell(0,5,utf8_decode('M. EN C. ROSALÍA MARÍA DEL CONSUELO TORRES BEZAURY DIRECTORA'),0,2,'C');
        $this->Cell(0,3,utf8_decode('DIRECTORA'),0,2,'C');
        $this->SetFont('calibri', '', 8);
        $this->SetY(260);
        $this->Cell(0,3,utf8_decode('Unidad Profesional "Adolfo López Mateos", Col. Zacatenco, Deleg. Gustavo A. Madero, Ciudad de México, C.P. 07738.'),0,0,'C');
        $this->Ln();
        $this->Cell(0,3,utf8_decode('Conmutador 5729-6000 Extensión 50520'),0,0,'C');
        $this->Ln();
        $this->Cell(0,3,utf8_decode('www.ipn.mx, www.des.ipn.mx'),0,0,'C');
    }
}

?>