<?php 
  $file      = $_POST['file'];
  $usuario   = $_POST['usuario'];
  $apellidos = $_POST['apellidos'];
  $nombres   = $_POST['nombres'];

  require_once '../../res/php/app_topHotel.php';
  require_once '../imprimir/plantillaFpdf.php'; 

  $reservas = $hotel->getReservasActuales(1); 
  
  array_sort_by($reservas, 'fecha_llegada', $order = SORT_ASC);  

  $regis    = count($reservas);

  $pdf = new PDF();
  $pdf->AddPage('P','letter');
  $pdf->SetFont('Arial','B',13);
  $pdf->Cell(190,5,'REPORTE RESERVAS POR FECHA DE LLEGADA ',0,1,'C');
  $pdf->Cell(190,5,FECHA_PMS,0,1,'C');
  $pdf->Ln(3);

  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(25,6,'Llegada',0,0,'L');
  $pdf->Cell(25,6,'Salida',0,0,'L');
  $pdf->Cell(10,6,'Hab.',0,0,'C');
  $pdf->Cell(70,6,'Huesped',0,0,'C');
  $pdf->Cell(5,6,'H',0,0,'L');
  $pdf->Cell(5,6,'M',0,0,'L');
  $pdf->Cell(5,6,'N',0,0,'L');
  $pdf->Cell(25,6,'Tarifa',0,0,'C');
  $pdf->Cell(10,6,'Res. ',0,0,'C');
  $pdf->Cell(20,6,'Est. ',0,1,'C');
  $pdf->SetFont('Arial','',9);
  if($regis==0){
      $pdf->Cell(190,6,'SIN RESERVAS',0,0,'C');    
  }else{
    foreach ($reservas as $reserva) {
      $pdf->Cell(25,5,$reserva['fecha_llegada'],0,0,'L');
      $pdf->Cell(25,5,$reserva['fecha_salida'],0,0,'L');
      $pdf->Cell(10,5,$reserva['num_habitacion'],0,0,'L');
      $pdf->Cell(70,5,utf8_decode($reserva['apellido1'].' '.$reserva['apellido2'].' '.$reserva['nombre1'].' '.$reserva['nombre2']),0,0,'L');
      $pdf->Cell(5,5,$reserva['can_hombres'],0,0,'C');
      $pdf->Cell(5,5,$reserva['can_mujeres'],0,0,'C');
      $pdf->Cell(5,5,$reserva['can_ninos'],0,0,'C');
      $pdf->Cell(25,5,number_format($reserva['valor_diario'],2),0,0,'R'); 
      $pdf->Cell(10,5,$reserva['num_reserva'],0,0,'C');
      $pdf->Cell(20,5,$reserva['estado'],0,1,'C');
    }    
  }
  $fileOut = '../imprimir/informes/'.$file.'.pdf'; 
  $pdf->Output($fileOut,'F');
  echo $file.'.pdf';
?>
