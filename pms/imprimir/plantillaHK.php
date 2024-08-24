<?php
require_once '../../res/fpdf/fpdf.php';

class PDF extends FPDF
{
	function Header()
	{
		$this->Image('../../img/' . LOGO, 10, 1, 25);
		$this->SetFont('Arial', 'B', 12);
		$this->Cell(195, 4, NAME_EMPRESA, 0, 1, 'C');
	}

	function Footer()
	{
		$this->SetY(-15);
		$this->SetFont('Arial', '', 8);
		$this->Cell(95, 5, WEB_EMPRESA, 0, 0, 'L');
		$this->Cell(95, 5, CORREO_EMPRESA, 0, 1, 'R');
	}
}
