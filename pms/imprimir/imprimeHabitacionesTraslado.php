<?php 
  require '../../res/php/titles.php';
  require '../../res/php/app_topHotel.php'; 
  require 'plantillaHK.php';


  $pdf = new PDF();
  $pdf->AddPage();

  $habitaciones = $hotel->traeHabitacionesTraslado();

  $pdf->SetFont('Arial','B',9);
  $pdf->Cell(195,5,strtoupper('Traslado de Habitaciones'),0,1,'C');
  $pdf->Cell(195,5,'Fecha :'.FECHA_PMS,0,0,'C');
  $pdf->Ln(5);
  $pdf->SetFont('Arial','B',9);
  $pdf->Cell(30,5,'Tipo Habitacion',1,0,'C');
  $pdf->Cell(15,5,'Nro Hab',1,0,'C');
  $pdf->Cell(30,5,'Destino Tipo',1,0,'C');
  $pdf->Cell(15,5,'Num',1,0,'C');
  $pdf->Cell(45,5,'Motivo',1,0,'C');
  // $pdf->Cell(40,5,'Observaciones',1,0,'C');
  $pdf->Cell(35,5,'Fecha',1,0,'C');
  $pdf->Cell(20,5,'Usuario',1,1,'C');
  $pdf->SetFont('Arial','',9);
  
  foreach ($habitaciones as $habitacion) {
    
    
    $pdf->Cell(30,4,trim(substr($habitacion['desdetipo'],strpos(($habitacion['desdetipo']),' '))),0,0,'L');
    $pdf->Cell(15,4,($habitacion['hab_desde']),0,0,'C');
    $pdf->Cell(30,4,trim(substr($habitacion['destinotipo'],strpos(($habitacion['desdetipo']),' '))),0,0,'L');
    $pdf->Cell(15,4,$habitacion['hab_hasta'],0,0,'C');
    $pdf->Cell(45,4,$habitacion['descripcion_motivo'],0,0,'L');
    // $pdf->Cell(40,4,$habitacion['observaciones'],0,0,'L');
    $pdf->Cell(35,4,$habitacion['fecha'],0,0,'L');
    $pdf->Cell(15,4,$habitacion['usuario'],0,1,'L');

  }
  
  $pdfFile = $pdf->Output('', 'S');
  $base64String = chunk_split(base64_encode($pdfFile));

  echo $base64String;  
?>
