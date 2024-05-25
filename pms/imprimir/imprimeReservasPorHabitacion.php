<?php 
  $file      = $_POST['file'];
  $usuario   = $_POST['usuario'];
  $apellidos = $_POST['apellidos'];
  $nombres   = $_POST['nombres'];

  require_once '../../res/php/app_topHotel.php';
  require_once '../imprimir/plantillaFpdf.php'; 

  $reservas = $hotel->getReservasActuales(1); 
  
  array_sort_by($reservas, 'num_habitacion', $order = SORT_ASC);  

  $regis    = count($reservas);

  $pdf = new PDF();
  $pdf->AddPage('P','letter');
  $pdf->SetFont('Arial','B',11);
  $pdf->Cell(190,5,'REPORTE RESERVAS POR NUMERO DE HABITACION ',0,1,'C');
  $pdf->Cell(190,5,FECHA_PMS,0,1,'C');
  $pdf->Ln(3);

  $pdf->SetFont('Arial','B',9);
  $pdf->Cell(10,5,'Hab.',1,0,'C');
  $pdf->Cell(70,5,'Huesped',1,0,'C');
  $pdf->Cell(25,5,'Llegada',1,0,'L');
  $pdf->Cell(25,5,'Salida',1,0,'L');
  $pdf->Cell(5,5,'H',1,0,'L');
  $pdf->Cell(5,5,'M',1,0,'L');
  $pdf->Cell(5,5,'N',1,0,'L');
  $pdf->Cell(25,5,'Tarifa',1,0,'C');
  $pdf->Cell(10,5,'Res. ',1,0,'C');
  $pdf->Cell(20,5,'Est. ',1,1,'C');
  $pdf->SetFont('Arial','',9);
  if($regis==0){
      $pdf->Cell(190,6,'SIN RESERVAS ACTIVAS ',0,0,'C');    
  }else{
    foreach ($reservas as $reserva) {
      $pdf->Cell(10,4,$reserva['num_habitacion'],0,0,'L');
      $pdf->Cell(70,4,substr(utf8_decode($reserva['apellido1'].' '.$reserva['apellido2'].' '.$reserva['nombre1'].' '.$reserva['nombre2']),0,35),0,0,'L');
      $pdf->Cell(25,4,$reserva['fecha_llegada'],0,0,'L');
      $pdf->Cell(25,4,$reserva['fecha_salida'],0,0,'L');
      $pdf->Cell(5,4,$reserva['can_hombres'],0,0,'C');
      $pdf->Cell(5,4,$reserva['can_mujeres'],0,0,'C');
      $pdf->Cell(5,4,$reserva['can_ninos'],0,0,'C');
      $pdf->Cell(25,4,number_format($reserva['valor_diario'],2),0,0,'R'); 
      $pdf->Cell(10,4,$reserva['num_reserva'],0,0,'C');
      $pdf->Cell(20,4,$reserva['estado'],0,1,'C');
    }    
  }
  $pdfFile = $pdf->Output('', 'S');
  $base64String = chunk_split(base64_encode($pdfFile));

  echo $base64String;
?>
