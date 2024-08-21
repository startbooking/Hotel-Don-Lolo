<?php

require '../../res/php/app_topFE.php';
require '../../res/fpdf/fpdf.php';
require '../../res/phpqrcode/qrlib.php';
$postBody = json_decode(file_get_contents('php://input'), true);
extract($postBody);

$size = 100; // Tamaño en píxeles
$level = 'L'; // Nivel de corrección (L, M, Q, H)

// Generar el código QR

$cude = $recibe['cude'];
$timeCrea = $recibe['ResponseDian']['Envelope']['Header']['Security']['Timestamp']['Created'];

$eToken     = $user->datosTokenFE();
$prefDS     = $eToken[0]['prefijoDS'];
$productos  = $user->getProductosDS($idDoc);
$infoDoc    = $user->getInfoDS($idDoc);

$filename = '../../img/ds/QR_'.$prefDS.'-'.$consecutivoDS.'.png';

QRcode::png($QRStr, $filename, $level, $size);

$pdf = new FPDF();

$pdf->AddPage('P', 'letter');
$pdf->Rect(10, 46, 195, 105);
$pdf->Image('../../img/'.LOGO, 10, 5, 35);

$pdf->Image($filename, 173, 5, 25);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(190, 4, utf8_decode(NAME_EMPRESA), 0, 1, 'C');
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(190, 4, 'NIT: '.NIT_EMPRESA, 0, 1, 'C');
$pdf->Cell(190, 4, utf8_decode(ADRESS_EMPRESA), 0, 1, 'C');
$pdf->Cell(40, 4, '', 0, 0, 'C');
$pdf->Cell(110, 4, utf8_decode(CIUDAD_EMPRESA).' '.PAIS_EMPRESA, 0, 1, 'C');
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(40, 4, '', 0, 0, 'C');
$pdf->Cell(110, 4, utf8_decode(TIPOEMPRESA), 0, 1, 'C');
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(40, 4, '', 0, 0, 'C');
$pdf->Cell(110, 4, utf8_decode(MAIL_HOTEL), 0, 1, 'C');
$pdf->setY(30);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(150, 4, '', 0, 0, 'C');
$pdf->MultiCell(45, 4, 'DOCUMENTO SOPORTE ELECTRONICO', 1, 'C');
$pdf->Cell(40, 4, '', 0, 0, 'C');
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(110, 4, 'Telefono '.TELEFONO_EMPRESA.' Movil '.CELULAR_EMPRESA, 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 8);

$pdf->SetFont('Arial', '', 8);
$pdf->Cell(40, 4, '', 0, 0, 'C');
$pdf->Cell(110, 4, utf8_decode(ACTIVIDAD), 0, 1, 'C');
$pdf->setY(38);
$pdf->Cell(150, 4, '', 0, 0, 'C');
// $pdf->MultiCell(45, 4, 'Fecha / Hora '.date('Y-m-d H:m:s'), 1, 'C');
$pdf->SetFont('Arial', 'B', 8);
$pdf->MultiCell(45, 4, 'Nro '.$prefDS.'-'.str_pad($consecutivoDS, 4, '0', STR_PAD_LEFT), 1, 'C');
$pdf->SetFont('Arial', '', 8);
$pdf->setY(45);
$pdf->Cell(40, 4, '', 0, 0, 'C');
$pdf->Ln(1);

$pdf->SetFont('Arial', '', 8);
$pdf->Cell(30, 4, 'PROVEEDOR', 0, 0, 'L');
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(120, 4, utf8_decode($infoDoc[0]['empresa']), 0, 0, 'L');
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(10, 4, 'NIT.', 0, 0, 'L');
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(30, 4, number_format($infoDoc[0]['nit'], 0).'-'.$infoDoc[0]['dv'], 0, 1, 'L');
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(30, 4, 'DIRECCION', 0, 0, 'L');
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(70, 4, substr(utf8_decode($infoDoc[0]['direccion']), 0, 35), 0, 0, 'L');
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(20, 4, 'CIUDAD', 0, 0, 'L');
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(30, 4, utf8_decode(substr($hotel->getCityName($infoDoc[0]['ciudad']), 0, 12)), 0, 0, 'L');
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(21, 4, 'TELEFONO', 0, 0, 'L');
$pdf->SetFont('Arial', 'B');
$pdf->Cell(20, 4, $infoDoc[0]['celular'], 0, 1, 'L');
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(30, 4, 'Nro Documento', 0, 0, 'L');
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(15, 4, utf8_decode($infoDoc[0]['numeroDocumento']), 0, 0, 'L');
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(15, 4, 'Fecha', 0, 0, 'L');
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(20, 4, utf8_decode($infoDoc[0]['fechaDocumento']), 0, 0, 'L');
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(20, 4, 'Vencimiento', 0, 0, 'L');
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(20, 4, utf8_decode($infoDoc[0]['fechaVencimiento']), 0, 1, 'L');

$pdf->Cell(65, 5, 'CONCEPTO', 1, 0, 'C');
$pdf->Cell(35, 5, 'UNIDAD', 1, 0, 'C');
$pdf->Cell(35, 5, 'VALOR UNIT.', 1, 0, 'C');
$pdf->Cell(25, 5, 'CANT', 1, 0, 'C');
$pdf->Cell(35, 5, 'VALOR TOTAL', 1, 1, 'C');
$pdf->SetFont('Arial', '', 8);

$total = 0;
foreach ($productos as $producto) {
    $pdf->Cell(65, 4, utf8_decode($producto['descripcion_cargo']), 0, 0, 'L');
    $pdf->Cell(35, 4, utf8_decode($producto['descripcion_unidad']), 0, 0, 'L');
    $pdf->Cell(35, 4, number_format($producto['valorUnitario'], 2), 0, 0, 'R');
    $pdf->Cell(25, 4, number_format($producto['cantidad'], 0), 0, 0, 'R');
    $pdf->Cell(35, 4, number_format($producto['valorTotal'], 2), 0, 1, 'R');
    $total = $total + $producto['valorTotal'];
}
$pdf->Ln(10);
$pdf->Cell(100, 4, '', 0, 0, 'L');
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(60, 4, 'TOTAL DOCUMENTO SOPORTE', 1, 0, 'l');
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(35, 4, number_format($total, 2), 1, 1, 'R');
$pdf->SetFont('Arial', '', 8);

$pdf->MultiCell(195, 4, 'SON :'.numtoletras($total), 1, 'L');
$pdf->SetFont('Arial', '', 8);

$pdf->MultiCell(195, 4, utf8_decode('Documento Soporte Nro : ').$prefDS.' '.$consecutivoDS.' '.utf8_decode(' Fecha Validación Dian ').$timeCrea.' CUFE '.$cude, 1, 'L');
$pdf->SetFont('Arial', '', 8);
$pdf->MultiCell(195, 5, utf8_decode('Observaciones ').utf8_decode(strtoupper($infoDoc[0]['observaciones'])), 1, 'L');

$pdf->SetFont('Arial', '', 8);

$pdf->SetY(143);
$pdf->Cell(95, 4, 'ELABORADO POR ', 0, 0, 'C');
$pdf->Cell(95, 4, 'RECIBO ', 0, 1, 'C');
$pdf->Cell(95, 4, $usuario, 0, 0, 'C');
$pdf->Cell(95, 4, 'C.C - NIT.', 0, 1, 'C');

$arcPdf = 'documentoSoporte_'.$prefDS.'-'.str_pad($consecutivoDS, 5, '0', STR_PAD_LEFT).'.pdf';

$file = '../impresos/'.$arcPdf;

$pdf->Output($file, 'F');

$pdfFile = $pdf->Output('', 'S');
$base64NC = chunk_split(base64_encode($pdfFile));

echo $base64NC;

?>

