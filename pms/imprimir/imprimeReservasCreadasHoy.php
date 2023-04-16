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
  $pdf->SetFont('Arial','B',12);
  $pdf->Cell(190,5,'REPORTE RESERVAS CREADAS EN EL DIA ',0,1,'C');
  $pdf->Cell(190,5,FECHA_PMS,0,1,'C');
  $pdf->Ln(3);

  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(20,6,'Reserva ',0,0,'C');
  $pdf->Cell(30,6,'Fecha Llegada',0,0,'L');
  $pdf->Cell(30,6,'Fecha Salida',0,0,'L');
  $pdf->Cell(70,6,'Huesped',0,0,'L');
  $pdf->Cell(5,6,'H',0,0,'L');
  $pdf->Cell(5,6,'M',0,0,'L');
  $pdf->Cell(5,6,'N',0,0,'L');
  $pdf->Cell(25,6,'Tarifa',0,1,'C');
  $pdf->SetFont('Arial','',9);
  if($regis==0){
      $pdf->Cell(190,6,'SIN RESERVAS CREADAS HOY ACTIVAS ',0,0,'C');    
  }else{
    foreach ($reservas as $reserva) {
      $pdf->Cell(20,6,$reserva['num_reserva'],0,0,'C');
      $pdf->Cell(30,6,$reserva['fecha_llegada'],0,0,'L');
      $pdf->Cell(30,6,$reserva['fecha_salida'],0,0,'L');
      $pdf->Cell(70,6,utf8_decode($reserva['apellido1'].' '.$reserva['apellido2'].' '.$reserva['nombre1'].' '.$reserva['nombre2']),0,0,'L');
      $pdf->Cell(5,6,$reserva['can_hombres'],0,0,'C');
      $pdf->Cell(5,6,$reserva['can_mujeres'],0,0,'C');
      $pdf->Cell(5,6,$reserva['can_ninos'],0,0,'C');
      $pdf->Cell(25,6,number_format($reserva['valor_diario'],2),0,1,'R'); 
    }    
  }

  $fileOut = '../imprimir/informes/'.$file.'.pdf'; 
  $pdf->Output($fileOut,'F');
  echo $file.'.pdf';
?>
