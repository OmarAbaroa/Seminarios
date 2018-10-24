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
        $this->SetMargins(4, 4, 4);
        
        //Fuentes
        $this->AddFont('MSSansSerif', '', 'MSSansSerif.php');

        //Fecha y número de tarjeta
        setlocale(LC_ALL,'es_MX', 'es_MX', 'esp');
        $this->SetFont('MSSansSerif', '', 8.1);
        $this->Cell(0, 5, utf8_decode('Ciudad de México, a ' . strftime("%d de %B de %Y", strtotime('now'))), 0, 1, 'R');
        $this->Ln();
        //Título
        $this->SetFont('Arial', 'B', 13);
        $this->SetFillColor(150, 150, 150);
        $this->MultiCell(0, 5, utf8_decode($this->titulo), 2, 'C', true);
    }

    function Footer()
    {
        
    }
}

?>