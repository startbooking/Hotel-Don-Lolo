<?php  
  // require 'plantillaAuditoria.php';

  $reservas = $hotel->getSalidasRealizadas(FECHA_PMS,2,"SA"); 
  $regis    = count($reservas);

  $pdf = new PDF();
  $pdf->AddPage('P','letter');
  $pdf->SetFont('Arial','B',11);
  $pdf->Cell(190,5,'SALIDAS DEL DIA ',0,1,'C');
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(190,5,'Fecha '.FECHA_PMS,0,1,'C');
  $pdf->Ln(3);

  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(15,5,'Tipo Hab. ',1,0,'C');
  $pdf->Cell(70,5,'Huesped',1,0,'C');
  $pdf->Cell(25,5,'Llegada',1,0,'C'); 
  $pdf->Cell(25,5,'Salida',1,0,'C');
  $pdf->Cell(5,5,'Noc',1,0,'C');
  $pdf->Cell(5,5,'H',1,0,'C');
  $pdf->Cell(5,5,'M',1,0,'C');
  $pdf->Cell(5,5,'N',1,0,'C');
  $pdf->Cell(25,5,'Tarifa',1,1,'C');
  $pdf->SetFont('Arial','',9);
  if($regis==0){
      $pdf->Cell(190,6,'SIN SALIDAS EN ESTE DIA',1,1,'C');    
  }else{
    foreach ($reservas as $reserva) {
      $pdf->Cell(15,4,$reserva['num_habitacion'],0,0,'C');
      $pdf->Cell(70,4,($reserva['apellido1'].' '.$reserva['apellido2'].' '.$reserva['nombre1'].' '.$reserva['nombre2']),0,0,'L');
      $pdf->Cell(25,4,$reserva['fecha_llegada'],0,0,'L');
      $pdf->Cell(25,4,$reserva['salida_checkout'],0,0,'L');
      $pdf->Cell(5,4,$reserva['dias_reservados'],0,0,'L');
      $pdf->Cell(5,4,$reserva['can_hombres'],0,0,'C');
      $pdf->Cell(5,4,$reserva['can_mujeres'],0,0,'C');
      $pdf->Cell(5,4,$reserva['can_ninos'],0,0,'C');
      $pdf->Cell(25,4,number_format($reserva['valor_diario'],2),0,1,'R'); 
    }    
  }

  $file = '../../imprimir/auditorias/Salidas_del_Dia_'.FECHA_PMS.'.pdf';
  $pdf->Output($file,'F');
?>
