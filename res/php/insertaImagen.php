<?php

require_once('../tcpdf/tcpdf.php');

// Ruta del archivo PDF original
// $pdfPath = 'ruta/al/archivo/original.pdf';
$pdfPath = '../pms/imprimir/facturas/factura_2.pdf';

// Ruta de la imagen que deseas incrustar o del marco de agua
// $imagePath = 'ruta/a/la/imagen/marco_de_agua.png';
$imagePath = '../img/facturaanulada.png';

// Ruta donde deseas guardar el nuevo archivo PDF
$outputPath = 'ruta/donde/guardar/nuevo.pdf';
$outputPath = '../pms/imprimir/facturas/factura_2a.pdf';


// Crear una instancia de TCPDF
$pdf = new TCPDF();

// Establecer el formato del papel y la orientación
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->SetMargins(0, 0, 0, true);
$pdf->AddPage('P', 'A4');

// Agregar la imagen o el marco de agua
$pdf->Image($imagePath, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);

// Agregar el contenido del PDF original
$pageCount = $pdf->setSourceFile($pdfPath);
for ($i = 1; $i <= $pageCount; $i++) {
  $tplIdx = $pdf->importPage($i);
  $pdf->useTemplate($tplIdx, 0, 0, 210, 297, true);
}

// Guardar el archivo PDF modificado
$pdf->Output($outputPath, 'F');

// Mostrar un mensaje de éxito
echo 'El archivo PDF se ha modificado correctamente.';
