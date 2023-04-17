<?php

  $file      = $_POST['file'];
  $usuario   = $_POST['usuario'];
  $apellidos = $_POST['apellidos'];
  $nombres   = $_POST['nombres'];

  require_once '../../res/php/app_topHotel.php';
  require_once '../imprimir/plantillaFpdf.php'; 

  $reservas = $hotel->getReservasDia(FECHA_PMS,1,"ES"); 
  $regis    = count($reservas);

  $pdf = new PDF();
  $pdf->AddPage('P','letter');
  $pdf->Cell(190,5,'REPORTE RESERVAS ESPERADAS EN EL DIA ',0,1,'C');
  $pdf->Cell(190,5,FECHA_PMS,0,1,'C');
  $pdf->Ln(3);

  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(20,5,'Reserva ',0,0,'C');
  $pdf->Cell(10,5,'Hab ',0,0,'C');
  $pdf->Cell(25,5,'Fec. Llegada',0,0,'L');
  $pdf->Cell(25,5,'Fec. Salida',0,0,'L');
  $pdf->Cell(70,5,'Huesped',0,0,'L');
  $pdf->Cell(5,5,'H',0,0,'L');
  $pdf->Cell(5,5,'M',0,0,'L');
  $pdf->Cell(5,5,'N',0,0,'L');
  $pdf->Cell(25,5,'Tarifa',0,1,'C');
  $pdf->SetFont('Arial','',9);
  if($regis==0){
      $pdf->Cell(190,6,'SIN RESERVAS ACTIVAS ',0,0,'C');    
  }else{
    $hab = 0;
    $hom = 0;
    $muj = 0;
    $nin = 0;
    $tar = 0;
    foreach ($reservas as $reserva) {
      $pdf->Cell(20,5,$reserva['num_reserva'],0,0,'C');
      $pdf->Cell(10,5,$reserva['num_habitacion'],0,0,'C');
      $pdf->Cell(25,5,$reserva['fecha_llegada'],0,0,'L');
      $pdf->Cell(25,5,$reserva['fecha_salida'],0,0,'L');
      $pdf->Cell(70,5,utf8_decode($reserva['nombre_completo']),0,0,'L');
      $pdf->Cell(5,5,$reserva['can_hombres'],0,0,'C');
      $pdf->Cell(5,5,$reserva['can_mujeres'],0,0,'C');
      $pdf->Cell(5,5,$reserva['can_ninos'],0,0,'C');
      $pdf->Cell(25,5,number_format($reserva['valor_diario'],2),0,1,'R'); 
      $hab = $hab + 1;
      $hom = $hom + $reserva['can_hombres'];
      $muj = $muj + $reserva['can_mujeres'];
      $nin = $nin + $reserva['can_ninos'];
      $tar = $tar + $reserva['valor_diario'];
    }    
    $pdf->Ln(3);
    $pdf->SetFont('Arial','B',9);
    $pdf->Cell(10,6,$hab,0,0,'R');
    $pdf->Cell(140,6,'Reservas Esperadas ',0,0,'L');
    $pdf->Cell(5,6,$hom,0,0,'R');
    $pdf->Cell(5,6,$muj,0,0,'R');
    $pdf->Cell(5,6,$nin,0,0,'R');
    $pdf->Cell(25,6,number_format($tar,2),0,1,'R');
  }

  $fileOut = '../imprimir/informes/'.$file.'.pdf'; 
  $pdf->Output($fileOut,'F');
  echo $file.'.pdf';

?>