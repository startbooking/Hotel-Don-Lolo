<?php 
  $reservas = $hotel->getExtranjerosLlegando(ID_PAIS_EMPRESA, FECHA_PMS,"SA"); 
  $regis    = count($reservas);

  $pdf = new PDF();
  $pdf->AddPage('P','letter');
  $pdf->SetFont('Arial','B',11);
  $pdf->Cell(190,5,'EXTRANJEROS LLEGANDO',0,1,'C');
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(190,5,'Fecha '.FECHA_PMS,0,1,'C');
  $pdf->Ln(3); 

  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(25,5,'Llegada',0,0,'L');
  $pdf->Cell(25,5,'Salida',0,0,'L');
  $pdf->Cell(70,5,'Huesped',0,0,'L');
  $pdf->Cell(35,5,'Nacionalidad',0,0,'L');
  $pdf->Cell(5,5,'H',0,0,'L');
  $pdf->Cell(5,5,'M',0,0,'L');
  $pdf->Cell(5,5,'N',0,0,'L');
  $pdf->Cell(25,5,'Tarifa',0,1,'C');
  $pdf->SetFont('Arial','',9);

  if($regis==0){
      $pdf->Cell(190,6,'SIN EXTRANJEROS LLEGANDO ESTE DIA',0,0,'C');    
  }else{
    foreach ($reservas as $reserva) {
      $nombrepais = $hotel->buscaNacionalidad($reserva['pais']);
      $pdf->Cell(25,4,$reserva['fecha_llegada'],0,0,'L');
      $pdf->Cell(25,4,$reserva['fecha_salida'],0,0,'L');
      $pdf->Cell(70,4,($reserva['apellido1'].' '.$reserva['apellido2'].' '.$reserva['nombre1'].' '.$reserva['nombre2']),0,0,'L');
      $pdf->Cell(35,4,$nombrepais,0,0,'L');
      $pdf->Cell(5,4,$reserva['can_hombres'],0,0,'C');
      $pdf->Cell(5,4,$reserva['can_mujeres'],0,0,'C');
      $pdf->Cell(5,4,$reserva['can_ninos'],0,0,'C');
      $pdf->Cell(25,4,number_format($reserva['valor_diario'],2),0,1,'R'); 
    }    
  }
  $file = '../../imprimir/auditorias/Extranjeros_llegando_'.FECHA_PMS.'.pdf';

  $pdf->Output($file,'F');
?>
