<?php 
  // require 'plantillaAuditoria.php';

  $pdf = new PDF();
  $pdf->AddPage('P','letter');
  $pdf->SetFont('Arial','B',11);
  $pdf->Cell(195,4,'BALANCE DIARIO ',0,1,'C');
  $pdf->SetFont('Arial','',11);
  $pdf->Cell(195,4,'Fecha : '.FECHA_PMS,0,1,'C');
  $pdf->Ln(4);

  $saldo  = $hotel->getBalanceSaldoAnterior(FECHA_PMS);
  $diario = $hotel->getBalanceSaldodelDia(FECHA_PMS);

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
  $ventasdia = $hotel->getCargosDia(FECHA_PMS,1);
  $pdf->Ln(4);
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(80,5,'Descripcion ',0,0,'C');
  $pdf->Cell(10,5,'Cant. ',0,0,'C');
  $pdf->Cell(30,5,'Monto',0,0,'C');
  $pdf->Cell(30,5,'Impuesto',0,0,'C');
  $pdf->Cell(30,5,'Total',0,1,'C');
  $pdf->SetFont('Arial','',10);
  $totalCargos = 0 ;
  $totalPagos = 0;
  foreach ($ventasdia as $ventadia) { 
    $pdf->Cell(80,4,$ventadia['descripcion_cargo'],0,0,'L');
    $pdf->Cell(10,4,$ventadia['canti'],0,0,'L');
    $pdf->Cell(30,4,number_format($ventadia['cargos'],2),0,0,'R');
    $pdf->Cell(30,4,number_format($ventadia['imptos'],2),0,0,'R');
    $pdf->Cell(30,4,number_format($ventadia['total_cargo'],2),0,1,'R');
    $totalCargos = $totalCargos + $ventadia['total_cargo'] ;
  }
  $pagosdia = $hotel->getCargosDia(FECHA_PMS,3);

  $pdf->Ln(4);
  $pdf->SetFont('Arial','B',10);
  $pdf->Cell(80,6,'Descripcion ',0,0,'C');
  $pdf->Cell(10,6,'Cant. ',0,0,'C');
  $pdf->Cell(30,6,'Valor Pago',0,1,'C');
  $pdf->SetFont('Arial','',10);

  foreach ($pagosdia as $pagodia) { 
    $pdf->Cell(80,4,$pagodia['descripcion_cargo'],0,0,'L');
    $pdf->Cell(10,4,$pagodia['canti'],0,0,'L');
    $pdf->Cell(30,4,number_format($pagodia['pagos'],2),0,1,'R');
    $totalPagos = $totalPagos + $pagodia['pagos'] ;
  }

  $file = '../../imprimir/auditorias/Balance_Diario_'.FECHA_PMS.'.pdf';
  $pdf->Output($file,'F');

?>
