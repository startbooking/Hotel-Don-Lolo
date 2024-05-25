<?php 
  require '../../res/php/titles.php';
  require '../../res/php/app_topHotel.php'; 
  require 'plantillaFpdf.php';

  $pdf = new PDF();
  $pdf->AddPage();

  $habitaciones = $hotel->traeHabitacionesMmto();

  $pdf->SetFont('Arial','B',9);
  $pdf->Cell(195,5,strtoupper('Habitaciones en Mantenimiento'),0,1,'C');
  $pdf->Cell(195,5,'Fecha :'.FECHA_PMS,0,0,'C');
  $pdf->Ln(5);
  $pdf->SetFont('Arial','B',9);
  $pdf->Cell(15,5,'Nro Hab.',1,0,'C');
  $pdf->Cell(90,5,'Mantenimiento',1,0,'C');
  $pdf->Cell(30,5,'Desde',1,0,'C');
  $pdf->Cell(30,5,'Hasta',1,1,'C');
  $pdf->SetFont('Arial','',9);
  
  foreach ($habitaciones as $habitacion) {
   
    $pdf->Cell(15,4,$habitacion['numero_hab'],0,0,'R');
    $pdf->Cell(90,4,utf8_decode($habitacion['descripcion_grupo']),0,0,'L');
    $pdf->Cell(30,4,$habitacion['desde_fecha'],0,0,'L');
    $pdf->Cell(30,4,$habitacion['hasta_fecha'],0,1,'L');

  }
  
  $pdfFile = $pdf->Output('', 'S');
  $base64String = chunk_split(base64_encode($pdfFile));

  echo $base64String;  
?>
