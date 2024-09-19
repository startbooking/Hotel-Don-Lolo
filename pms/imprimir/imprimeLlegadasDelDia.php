<?php 

  $reservas = $hotel->getReservasDia(FECHA_PMS,2,"CA"); 
  $TotRooms = count($hotel->cantidadHabitaciones(1));
  // $dis      = count($disp);
  $regis    = count($reservas);
  $habMmto = count($hotel->traeHabitacionesMmtoDia(1));
  $habDisp = $TotRooms - $habMmto ;

  $pdf = new PDF();
  $pdf->AddPage('P','letter');
  $pdf->SetFont('Arial','B',11);
  $pdf->Cell(190,5,'LLEGADAS DEL DIA',0,1,'C');
  $pdf->SetFont('Arial','',11);
  $pdf->Cell(190,5,'Fecha : '.FECHA_PMS,0,1,'C');
  $pdf->Ln(3);

  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(15,5,'Hab.',0,0,'C');
  $pdf->Cell(70,5,'Huesped',0,0,'C');
  $pdf->Cell(25,5,'Llegada',0,0,'C');
  $pdf->Cell(25,5,'Salida',0,0,'C');
  $pdf->Cell(5,5,'Noc',0,0,'C');
  $pdf->Cell(5,5,'H',0,0,'C');
  $pdf->Cell(5,5,'M',0,0,'C');
  $pdf->Cell(5,5,'N',0,0,'C');
  $pdf->Cell(25,5,'Tarifa',0,1,'C');
  $pdf->SetFont('Arial','',9);
  $hab = 0;
  $hom = 0;
  $muj = 0;
  $nin = 0;
  $tar = 0;
  if($regis==0){
      $pdf->Cell(190,6,'SIN LLEGADAS EN EL DIA',0,0,'C');    
  }else{
    foreach ($reservas as $reserva) {
      $pdf->Cell(15,4,$reserva['num_habitacion'],0,0,'C');
      $pdf->Cell(70,4,($reserva['apellido1'].' '.$reserva['apellido2'].' '.$reserva['nombre1'].' '.$reserva['nombre2']),0,0,'L');
      $pdf->Cell(25,4,$reserva['fecha_llegada'],0,0,'L');
      $pdf->Cell(25,4,$reserva['fecha_salida'],0,0,'L');
      $pdf->Cell(5,4,$reserva['dias_reservados'],0,0,'L');
      $pdf->Cell(5,4,$reserva['can_hombres'],0,0,'C');
      $pdf->Cell(5,4,$reserva['can_mujeres'],0,0,'C');
      $pdf->Cell(5,4,$reserva['can_ninos'],0,0,'C');
      $pdf->Cell(25,4,number_format($reserva['valor_diario'],2),0,1,'R');
      if($reserva['num_habitacion'] <= 2000){
        $hab = $hab + 1;
      }
      $hom = $hom + $reserva['can_hombres'];
      $muj = $muj + $reserva['can_mujeres'];
      $nin = $nin + $reserva['can_ninos'];
      $tar = $tar + $reserva['valor_diario'];
    }
  }
  $pdf->Rect(10, 235, 190, 36);

  $pdf->SetY(235);
  $pdf->SetFont('Arial','',9);
  $pdf->Cell(45,6,'Habitaciones Disponibles',1,0,'L');
  $pdf->Cell(25,6,$habDisp,1,0,'C');
  $pdf->Cell(45,6,'Habitaciones Llegadas Hoy',1,0,'L');
  $pdf->Cell(25,6,$hab,1,0,'C');
  $pdf->Cell(25,6,'% Ocupacion',1,0,'L');
  $pdf->Cell(25,6,number_format((($hab/$habDisp)*100),2).' %',1,1,'C');
  $pdf->Cell(30,6,'Total Huespedes',1,0,'L');
  $pdf->Cell(20,6,$hom+$muj+$nin,1,0,'C');
  $pdf->Cell(25,6,'Hombres '.$hom,1,0,'C');
  $pdf->Cell(25,6,'Mujeres '.$muj,1,0,'C');
  $pdf->Cell(20,6,('Ninos ').$nin,1,0,'C');
  $pdf->Cell(40,6,'Ingreso Alojamiento',1,0,'L');
  $pdf->Cell(30,6,number_format($tar,2),1,1,'R');

  $pdf->Cell(65,6,'Ingreso Promedio por Llegadas del Dia',1,0,'L');
  if($hab==0){
    $pdf->Cell(30,6,number_format($hab,2),1,0,'R');
  }else{
    $pdf->Cell(30,6,number_format($tar/$hab,2),1,0,'R');
  }
  $pdf->Cell(65,6,'Ingreso Promedio por Huesped',1,0,'L');
  if(($hom+$muj)==0){
    $pdf->Cell(30,6,number_format($hom+$muj,2),1,1,'R');
  }else{
    $pdf->Cell(30,6,number_format($tar/($hom+$muj),2),1,1,'R');
  }  
  
  $file = '../../imprimir/auditorias/Llegadas_del_Dia_'.FECHA_PMS.'.pdf';
  $pdf->Output($file,'F');  
?>
