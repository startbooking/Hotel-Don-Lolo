<?php 
  $fechaBus = $_SESSION['fechaPro'];

  $pdf = new PDF();
  $pdf->AddPage('P','letter');
  $pdf->SetFont('Arial','B',11);
  $pdf->Cell(195,5,'BALANCE DIARIO ',0,1,'C');
  $pdf->SetFont('Arial','',11);
  $pdf->Cell(195,4,'Fecha : '.$fechaBus,0,1,'C');
  $pdf->Ln(4);

  $saldo  = $hotel->getHistoricoBalanceSaldoAnterior($fechaBus);
  $diario = $hotel->getHistoricoBalanceSaldodelDia($fechaBus);

  $cartera = 0;
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(65,6,'SALDO ANTERIOR ',1,1,'C');
  $pdf->Rect(10, 68, 65, 18);
  $pdf->Cell(35,6,'CARGOS',0,0,'L');
  $pdf->SetFont('Arial','',10);
  if(count($saldo)==0){
    $pdf->Cell(30,6,number_format(0,2),0,1,'R');
  }else{
    $pdf->Cell(30,6,number_format($saldo[0]['saldo_viene'],2),0,1,'R');
  }
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(35,6,'IMPUESTOS ',0,0,'L');
  $pdf->SetFont('Arial','',10);
  if(count($saldo)==0){
    $pdf->Cell(30,6,number_format(0,2),0,1,'R');
  }else{  
    $pdf->Cell(30,6,number_format($saldo[0]['impto_viene'],2),0,1,'R');
  }
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(35,6,'ABONOS ',0,0,'L');
  $pdf->SetFont('Arial','',10);
  if(count($saldo)==0){
    $pdf->Cell(30,6,number_format(0,2),0,1,'R');
  }else{
    $pdf->Cell(30,6,number_format($saldo[0]['pagos_viene'],2),0,1,'R');
  }
  $pdf->SetFont('Arial','B',10);
  $ventasdia = $hotel->getHistoricoCargosDia($fechaBus,1);

  $pdf->Ln(4);
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(60,6,'Descripcion ',0,0,'C');
  $pdf->Cell(10,6,'Cant. ',0,0,'C');
  $pdf->Cell(30,6,'Monto',0,0,'C');
  $pdf->Cell(30,6,'Impuesto',0,0,'C');
  $pdf->Cell(30,6,'Total',0,1,'C');
  $pdf->SetFont('Arial','',10);
  $totalCargos = 0 ;
  $totalPagos = 0;
  foreach ($ventasdia as $ventadia) { 
    $pdf->Cell(60,6,$ventadia['descripcion_cargo'],0,0,'L');
    $pdf->Cell(10,6,$ventadia['canti'],0,0,'L');
    $pdf->Cell(30,6,number_format($ventadia['cargos'],2),0,0,'R');
    $pdf->Cell(30,6,number_format($ventadia['imptos'],2),0,0,'R');
    $pdf->Cell(30,6,number_format($ventadia['total_cargo'],2),0,1,'R');
    $totalCargos = $totalCargos + $ventadia['total_cargo'] ;
  }
  $pagosdia = $hotel->getHistoricoCargosDia($fechaBus,3);

  $pdf->Ln(4);
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(60,6,'Descripcion ',0,0,'C');
  $pdf->Cell(10,6,'Cant. ',0,0,'C');
  $pdf->Cell(30,6,'Valor Pago',0,1,'C');
  $pdf->SetFont('Arial','',10);

  foreach ($pagosdia as $pagodia) { 
    $pdf->Cell(60,6,$pagodia['descripcion_cargo'],0,0,'L');
    $pdf->Cell(10,6,$pagodia['canti'],0,0,'L');
    $pdf->Cell(30,6,number_format($pagodia['pagos'],2),0,1,'R');
    $totalPagos = $totalPagos + $pagodia['pagos'] ;
  }

  $file = '../../imprimir/cajeros/Balance_diario_'.$fechaBus.'.pdf';
  $pdf->Output($file,'F');

?>
