<?php


require_once('../fpdf/fpdf.php');
require_once('../fpdi/Fpdi.php');

$pdf = new FPDI();
$pdf->setSourceFile('../pms/imprimir/facturas/factura_2.pdf');

$pages = $pdf->getNumPages();
