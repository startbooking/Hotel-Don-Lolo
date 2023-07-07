<?php

require_once '../../res/fpdf/fpdf.php';

class PDF extends FPDF
{
    public function Header()
    {
        $this->Image('../../img/'.LOGO, xPOS, yPOS, tPOS);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(260, 5, NAME_EMPRESA, 0, 1, 'C');
        $this->SetFont('Arial', '', 10);
        $this->Cell(260, 4, 'Nit: '.NIT_EMPRESA, 0, 1, 'C');
        $this->Cell(260, 4, ADRESS_EMPRESA, 0, 1, 'C');
        $this->Cell(260, 4, utf8_decode(CIUDAD_EMPRESA.', '.PAIS_EMPRESA), 0, 1, 'C');
        $this->Cell(260, 4, 'Telefono '.TELEFONO_EMPRESA.' Movil '.CELULAR_EMPRESA, 0, 1, 'C');
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(260, 4, NAME_HOTEL, 0, 1, 'C');
        $this->Ln(1);
    }

    public function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', '', 8);
        $this->Cell(130, 4, WEB_EMPRESA, 0, 0, 'L');
        $this->Cell(130, 4, CORREO_EMPRESA, 0, 1, 'R');
    }
}
