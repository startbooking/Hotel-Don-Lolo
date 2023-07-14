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
  $pdf->Cell(190,4,'REPORTE RESERVAS ESPERADAS EN EL DIA ',0,1,'C');
  $pdf->Cell(190,4,FECHA_PMS,0,1,'C');
  $pdf->Ln(1);

  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(20,4,'Reserva ',0,0,'C');
  $pdf->Cell(10,4,'Hab ',0,0,'C');
  $pdf->Cell(25,4,'Fec. Llegada',0,0,'L');
  $pdf->Cell(25,4,'Fec. Salida',0,0,'L');
  $pdf->Cell(70,4,'Huesped',0,0,'L');
  $pdf->Cell(5,4,'H',0,0,'L');
  $pdf->Cell(5,4,'M',0,0,'L');
  $pdf->Cell(5,4,'N',0,0,'L');
  $pdf->Cell(25,4,'Tarifa',0,1,'C');
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
      $pdf->Cell(20,4,$reserva['num_reserva'],0,0,'C');
      $pdf->Cell(10,4,$reserva['num_habitacion'],0,0,'C');
      $pdf->Cell(25,4,$reserva['fecha_llegada'],0,0,'L');
      $pdf->Cell(25,4,$reserva['fecha_salida'],0,0,'L');
      $pdf->Cell(70,4,utf8_decode($reserva['nombre_completo']),0,0,'L');
      $pdf->Cell(5,4,$reserva['can_hombres'],0,0,'C');
      $pdf->Cell(5,4,$reserva['can_mujeres'],0,0,'C');
      $pdf->Cell(5,4,$reserva['can_ninos'],0,0,'C');
      $pdf->Cell(25,4,number_format($reserva['valor_diario'],2),0,1,'R'); 
      $hab = $hab + 1;
      $hom = $hom + $reserva['can_hombres'];
      $muj = $muj + $reserva['can_mujeres'];
      $nin = $nin + $reserva['can_ninos'];
      $tar = $tar + $reserva['valor_diario'];
    }    
    $pdf->Ln(3);
    $pdf->SetFont('Arial','B',9);
    $pdf->Cell(10,4,$hab,0,0,'R');
    $pdf->Cell(140,4,'Reservas Esperadas ',0,0,'L');
    $pdf->Cell(5,4,$hom,0,0,'R');
    $pdf->Cell(5,4,$muj,0,0,'R');
    $pdf->Cell(5,4,$nin,0,0,'R');
    $pdf->Cell(25,4,number_format($tar,2),0,1,'R');
  }

  $fileOut = '../imprimir/informes/'.$file.'.pdf'; 
  $pdf->Output($fileOut,'F');
  echo $file.'.pdf';

?>