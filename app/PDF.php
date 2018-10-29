<?php

namespace App;

use Anouar\Fpdf\Fpdf;
use Anouar\Fpdf\MakeFont\MakeFont;

class PDF extends Fpdf
{
    private $titulo = '';
    private $tarjeta = '';

    function __construct($orientacion, $medida, $tamanio, $titulo, $tarjeta)
    {
        $this->titulo = $titulo;
        $this->tarjeta = 'TARJETA';
        return parent::__construct('P', 'mm', 'Letter');
    }
    
    function Header()
    {
        $this->SetMargins(10, 4, 6);
        
        //Fuentes
        $this->AddFont('MSSansSerif', '', 'MSSansSerif.php');

        //Fecha y número de tarjeta
        setlocale(LC_ALL,'es_MX', 'es_MX', 'esp');
        $this->SetFont('MSSansSerif', '', 8.1);
        $this->Cell(0, 5, utf8_decode('Ciudad de México, a ' . strftime("%d de %B de %Y", strtotime('now'))), 0, 1, 'R');
        $this->Image('img/encabezadoIPN.png',10,10,25,30,'png');
        $this->SetFont('Arial', 'B', 9);
        $this->SetXY(36, 17);
        $this->Cell(45,3,utf8_decode('Instituto Politécnico Nacional'),0,1,'C');
        $this->SetXY(36, 21);
        $this->Cell(45,3,utf8_decode('Secretaria Académica'),0,1,'C');
        $this->SetXY(36, 25);
        $this->Cell(45,3,utf8_decode('Dirección de Educación Superior'),0,1,'C');
        $this->SetXY(36, 29);
        $this->Cell(45,3,utf8_decode('División de Procesos Formativos'),0,1,'C');

        //Título
        $this->SetY(45);
        $this->SetFont('Arial', 'B', 13);
        $this->SetFillColor(150, 150, 150);
        $this->MultiCell(197.9, 5, utf8_decode($this->titulo), 2, 'C', true);
        $this->SetFont('Arial', 'B', 12);
    }

    function Footer()
    {
        
    }
}

?>