<?php 

  $hab  = $hotel->getCountHuespedesenCasa('CMA',FECHA_PMS);
  $cmas = $hotel->getCountCuentasMaestrasenCasa('CMA',FECHA_PMS);

  $rooms    = $hotel->cantidadHabitaciones();
  $pm       = $hotel->cantidadPM();
  $dis      = $rooms-$pm;

  $pdf = new PDF();
  $pdf->AddPage('P','letter');
  $pdf->SetFont('Arial','B',13);
  $pdf->Cell(190,5,'HUESPEDES EN CASA ',0,1,'C');
  $pdf->SetFont('Arial','',11);
  $pdf->Cell(190,5,'Fecha : '.FECHA_PMS,0,1,'C');
  $pdf->Ln(3);

  $pdf->Rect(10, 235, 60, 36);
  $pdf->SetFont('Arial','',9);
  $pdf->Cell(45,6,'Habitaciones Ocupadas',1,0,'L');
  $pdf->Cell(25,6,$regis,1,0,'C');
  $pdf->Cell(45,6,'Habitaciones Disponibles',1,0,'L');
  $pdf->Cell(25,6,$dis,1,0,'C');
  $pdf->Cell(25,6,'% Ocupacion',1,0,'L');
  $pdf->Cell(25,6,number_format((($hab/$dis)*100),2).' %',1,1,'C');

  $file = '../../imprimir/auditorias/Informe_Diario_Gerencia_'.FECHA_PMS.'.pdf';
  $pdf->Output($file,'F');
?>
