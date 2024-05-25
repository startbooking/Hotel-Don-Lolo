<?php 
  require '../../res/php/app_topHotel.php'; 
  require 'plantillaFpdf.php';


  $file = $_POST['file'];

  $pdf = new PDF();
  $pdf->AddPage();

  $habitaciones = $hotel->traeEstadoHabitaciones();

  $pdf->SetFont('Arial','B',9);
  $pdf->Cell(195,5,strtoupper('Estado Habitaciones Hotel'),0,1,'C');
  $pdf->Cell(195,5,'Fecha :'.FECHA_PMS,0,0,'C');
  $pdf->Ln(5);
  $pdf->SetFont('Arial','B',9);
  $pdf->Cell(15,5,'Nro Hab.',1,0,'C');
  $pdf->Cell(60,5,'Tipo Habitacion',1,0,'C');
  $pdf->Cell(30,5,'Estado',1,1,'C');
  $pdf->SetFont('Arial','',9);
  
  foreach ($habitaciones as $habitacion) {
    $estado = 'LIMPIA';
    if($habitacion['sucia']==1){
      $estado = 'SUCIA' ;
    };
    if($habitacion['mantenimiento']==1){
      $estado = 'MANTENIMIENTO';
    };
    if($habitacion['ocupada']==1){
      $estado = 'OCUPADA';
      
    };
    $pdf->Cell(15,4,$habitacion['numero_hab'],0,0,'R');
    $pdf->Cell(60,4,utf8_decode($habitacion['descripcion_habitacion']),0,0,'L');
    $pdf->Cell(30,4,$estado,0,1,'L');

  }
  
  $pdfFile = $pdf->Output('', 'S');
  $base64String = chunk_split(base64_encode($pdfFile));

  echo $base64String;
  
?>
