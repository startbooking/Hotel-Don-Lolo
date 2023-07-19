<?php 
  require '../../res/php/titles.php';
  require '../../res/php/app_topHotel.php'; 
  require 'plantillaFpdf.php';


  $file = $_POST['file'];

  $pdf = new PDF();
  $pdf->AddPage();

  $habitaciones = $hotel->traeHabitacionesMmto();

  // echo print_r($habitaciones);

  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(195,5,strtoupper('Habitaciones en Mantenimiento'),0,1,'C');
  $pdf->Cell(195,5,'Fecha :'.FECHA_PMS,0,0,'C');
  $pdf->Ln(5);
  $pdf->SetFont('Arial','B',9);
  $pdf->Cell(15,6,'Nro Hab.',1,0,'C');
  $pdf->Cell(90,6,'Mantenimiento',1,0,'C');
  $pdf->Cell(30,6,'Desde',1,0,'C');
  $pdf->Cell(30,6,'Hasta',1,1,'C');
  // $pdf->Cell(30,6,'Estado',1,1,'C');
  $pdf->SetFont('Arial','',9);
  
  foreach ($habitaciones as $habitacion) {
   
    $pdf->Cell(15,4,$habitacion['numero_hab'],0,0,'R');
    $pdf->Cell(90,4,utf8_decode($habitacion['descripcion_grupo']),0,0,'L');
    $pdf->Cell(30,4,$habitacion['desde_fecha'],0,0,'L');
    $pdf->Cell(30,4,$habitacion['hasta_fecha'],0,1,'L');
    // $pdf->Cell(30,4,$estado,0,1,'L');

  }
  
  $fileOut = '../imprimir/informes/'.$file.'.pdf';
  $pdf->Output($fileOut, 'F');
  echo $file.'.pdf';
  
?>
