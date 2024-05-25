<?php 

  $file      = $_POST['file'];
  $usuario   = $_POST['usuario'];
  $apellidos = $_POST['apellidos'];
  $nombres   = $_POST['nombres'];

  require_once '../../res/php/app_topHotel.php';
  require_once '../imprimir/plantillaFpdf.php';

  $reservas = $hotel->getReservasCreadasHoy(FECHA_PMS,1); 

  $regis    = count($reservas); 

  $pdf = new PDF();
  $pdf->AddPage('P','letter');
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(190,4,'REPORTE RESERVAS CREADAS EN EL DIA ',0,1,'C');
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(190,4,'Fecha :'. FECHA_PMS,0,1,'C');
  $pdf->Ln(1);

  $pdf->SetFont('Arial','B',9);
  $pdf->Cell(20,5,'Reserva ',1,0,'C');
  $pdf->Cell(30,5,'Fecha Llegada',1,0,'L');
  $pdf->Cell(30,5,'Fecha Salida',1,0,'L');
  $pdf->Cell(70,5,'Huesped',1,0,'C');
  $pdf->Cell(5,5,'H',1,0,'L');
  $pdf->Cell(5,5,'M',1,0,'L');
  $pdf->Cell(5,5,'N',1,0,'L');
  $pdf->Cell(25,5,'Tarifa',1,1,'C');
  $pdf->SetFont('Arial','',9);
  if($regis==0){
      $pdf->Cell(190,4,'SIN RESERVAS CREADAS HOY ACTIVAS ',0,0,'C');    
  }else{
    foreach ($reservas as $reserva) {
      $pdf->Cell(20,4,$reserva['num_reserva'],0,0,'C');
      $pdf->Cell(30,4,$reserva['fecha_llegada'],0,0,'L');
      $pdf->Cell(30,4,$reserva['fecha_salida'],0,0,'L');
      $pdf->Cell(70,4,utf8_decode($reserva['apellido1'].' '.$reserva['apellido2'].' '.$reserva['nombre1'].' '.$reserva['nombre2']),0,0,'L');
      $pdf->Cell(5,4,$reserva['can_hombres'],0,0,'C');
      $pdf->Cell(5,4,$reserva['can_mujeres'],0,0,'C');
      $pdf->Cell(5,4,$reserva['can_ninos'],0,0,'C');
      $pdf->Cell(25,4,number_format($reserva['valor_diario'],2),0,1,'R'); 
    }    
  }

  $pdfFile = $pdf->Output('', 'S');
  $base64String = chunk_split(base64_encode($pdfFile));
  echo $base64String;
    
?>
