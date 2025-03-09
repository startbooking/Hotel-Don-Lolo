<?php

require_once '../../res/php/app_topHotel.php';
require_once '../../res/fpdf/fpdf.php';
$postBody = json_decode(file_get_contents('php://input'), true);
extract($postBody);

$recaudos = $hotel->traeRecaudoCartera($numero);
$prefijo = $hotel->traePrefijoRecaudo();

$pdf = new FPDF();
$pdf->AddPage('P', 'letter');
$pdf->Rect(10, 43, 190, 105);
$pdf->Image('../../img/'.LOGO, 10, 5, 35);
// $pdf->Image($filename, 173, 5, 25);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(190, 4, (NAME_EMPRESA), 0, 1, 'C');
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(190, 4, 'NIT: '.NIT_EMPRESA, 0, 1, 'C');
$pdf->Cell(190, 4, (ADRESS_EMPRESA), 0, 1, 'C');
$pdf->Cell(40, 4, '', 0, 0, 'C');
$pdf->Cell(110, 4, (CIUDAD_EMPRESA).' '.PAIS_EMPRESA, 0, 1, 'C');
// $pdf->Cell(40, 4, '', 0, 1, 'C');
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(40, 4, '', 0, 0, 'C');
$pdf->Cell(110, 4, (REGIMEN), 0, 1, 'C');
$pdf->SetFont('Arial', '', 7);
$pdf->Cell(40, 4, '', 0, 0, 'C');
$pdf->Cell(110, 4, (MAIL_HOTEL), 0, 0, 'C');
$pdf->MultiCell(40, 4, 'NOTA BANCARIA', 1, 'C');
$pdf->Cell(40, 4, '', 0, 0, 'C');
$pdf->Cell(110, 4, 'Telefono '.TELEFONO_EMPRESA.' Movil '.CELULAR_EMPRESA, 0, 0, 'C');
$pdf->SetFont('Arial', 'B', 8);
$pdf->MultiCell(40, 4, 'Nro '.$prefijo.'-'.str_pad($numero, 4, '0', STR_PAD_LEFT), 1, 'C');
$pdf->SetFont('Arial', '', 7);

$pdf->Cell(40, 4, '', 0, 0, 'C');
$pdf->Cell(110, 4, (ACTIVIDAD), 0, 0, 'C');
$pdf->MultiCell(40, 4, 'Fecha / Hora '.date('Y-m-d H:m:s'), 1, 'C');
$pdf->SetFont('Arial', '', 7);
$pdf->setY(42);
$pdf->Cell(40, 4, '', 0, 0, 'C');
$pdf->Ln(1);

  $pdf->SetFont('Arial', 'B', 8);
  $pdf->SetFont('Arial', '', 8);
  $pdf->Cell(30, 4, 'RAZON SOCIAL', 0, 0, 'L');
  $pdf->SetFont('Arial', 'B', 8);
  $pdf->Cell(120, 4, ($recaudos[0]['empresa']), 0, 0, 'L');
  $pdf->SetFont('Arial', '', 8);
  $pdf->Cell(10, 4, 'NIT.', 0, 0, 'L');
  $pdf->SetFont('Arial', 'B', 8);
  $pdf->Cell(30, 4, number_format($recaudos[0]['nit'], 0).'-'.$recaudos[0]['dv'], 0, 1, 'L');
  $pdf->SetFont('Arial', '', 8);
  $pdf->Cell(30, 4, 'DIRECCION', 0, 0, 'L');
  $pdf->SetFont('Arial', 'B', 8);
  $pdf->Cell(70, 4, substr(($recaudos[0]['direccion']), 0, 35), 0, 0, 'L');
  $pdf->SetFont('Arial', '', 8);
  $pdf->Cell(20, 4, 'CIUDAD', 0, 0, 'L');
  $pdf->SetFont('Arial', 'B', 8);
  $pdf->Cell(30, 4, (substr($recaudos[0]['municipio'], 0, 50)), 0, 0, 'L');
  $pdf->SetFont('Arial', '', 8);
  $pdf->Cell(21, 4, 'TELEFONO', 0, 0, 'L');
  $pdf->SetFont('Arial', 'B');
  $pdf->Cell(20, 4, $recaudos[0]['telefono'], 0, 1, 'L');
  $pdf->SetFont('Arial', '', 8);
  $pdf->Cell(30, 4, 'FECHA RECAUDO', 0, 0, 'L');
  $pdf->SetFont('Arial', 'B', 8);
  $pdf->Cell(20, 4, (substr($recaudos[0]['fechaRecaudo'], 0, 50)), 0, 0, 'L');
  $pdf->SetFont('Arial', '', 8);
  $pdf->Cell(20, 4, 'DETALLE', 0, 0, 'L');
  $pdf->SetFont('Arial', 'B');
  $pdf->Cell(120, 4, $recaudos[0]['detalleRecaudo'], 0, 1, 'L');
  $pdf->Ln(1);


$pdf->Cell(20, 5, 'FACTURA', 1, 0, 'C');
$pdf->Cell(20, 5, 'FECHA', 1, 0, 'C');
$pdf->Cell(25, 5, 'VALOR', 1, 0, 'C');
$pdf->Cell(25, 5, 'RETEFUENTE', 1, 0, 'C');
$pdf->Cell(25, 5, 'RETEIVA', 1, 0, 'C');
$pdf->Cell(25, 5, 'RETEICA', 1, 0, 'C');
$pdf->Cell(25, 5, 'COMISION', 1, 0, 'C');
$pdf->Cell(25, 5, 'TOTAL FACT', 1, 1, 'C');
$pdf->SetFont('Arial', '', 8);
$pdf->Ln(1);


$total = 0;
$retFue = 0;
$retIca = 0;
$retIva = 0;
$comisi = 0;
$pago = 0;
foreach ($recaudos as $folio1) {
    $pdf->Cell(20, 4, $folio1['facturaNumero'], 0, 0, 'L');
    $pdf->Cell(20, 4, ($folio1['fechaFactura']), 0, 0, 'L');
    $pdf->Cell(25, 4, number_format($folio1['valorFactura'], 2), 0, 0, 'R');
    $pdf->Cell(25, 4, number_format($folio1['reteFuente'], 2), 0, 0, 'R');
    $pdf->Cell(25, 4, number_format($folio1['reteIca'], 2), 0, 0, 'R');
    $pdf->Cell(25, 4, number_format($folio1['reteIva'], 2), 0, 0, 'R');
    $pdf->Cell(25, 4, number_format($folio1['comision'], 2), 0, 0, 'R');
    $pdf->Cell(25, 4, number_format($folio1['valorPago'], 2), 0, 1, 'R');

    $total = $total + $folio1['valorFactura'];
    $retFue = $retFue + $folio1['reteFuente'];
    $retIca = $retIca + $folio1['reteIca'];
    $retIva = $retIva + $folio1['reteIva'];
    $comisi = $comisi + $folio1['comision'];
    $pago = $pago + $folio1['valorPago'];

}

$pdf->Ln(2);

$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(40, 4, 'TOTAL ', 1, 0, 'C');
$pdf->Cell(25, 4, number_format($total, 2), 1, 0, 'R');
$pdf->Cell(25, 4, number_format($retFue, 2), 1, 0, 'R');
$pdf->Cell(25, 4, number_format($retIca, 2), 1, 0, 'R');
$pdf->Cell(25, 4, number_format($retIva, 2), 1, 0, 'R');
$pdf->Cell(25, 4, number_format($comisi, 2), 1, 0, 'R');
$pdf->Cell(25, 4, number_format($pago, 2), 1, 1, 'R');

$pdf->Ln(1);

$pdf->SetFont('Arial', '', 8);

$pdf->SetY(133);
$pdf->Cell(190, 5, 'ELABORADO POR ', 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(190, 5, $folio1['apellidos'].' '.$folio1['nombres'], 0, 1, 'C');
$arcPdf = 'recaudoCartera_'.$prefijo.'-'.$numero.'.pdf';

$file = 'recaudos/'.$arcPdf;

$pdf->Output($file, 'F');

echo $file;

?>

